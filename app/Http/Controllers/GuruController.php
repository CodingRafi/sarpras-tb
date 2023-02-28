<?php

namespace App\Http\Controllers;

use App\Models\m_guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    private $telegram_token;

    public function __construct()
    {
        $this->middleware('permission:view_guru', ['only' => ['index', 'store']]);
        $this->middleware('permission:add_guru', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_guru', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_guru', ['only' => ['destroy']]);
        $this->telegram_token = config('services.telegram-bot-api.token');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = m_guru::paginate(30);
        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
        return view('guru.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(403);
        $request->validate([
            'nama' => 'required', 
            'no_telp' => 'required'
        ]);

        m_guru::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\m_guru  $m_guru
     * @return \Illuminate\Http\Response
     */
    public function show(m_guru $m_guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\m_guru  $m_guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = m_guru::findOrFail($id);
        return view('guru.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\m_guru  $m_guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required', 
            // 'no_telp' => 'required'
        ]);

        $data = m_guru::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\m_guru  $m_guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(m_guru $m_guru)
    {
        //
    }

    public function sync_telegram(){
        $url = 'https://api.telegram.org/bot' . $this->telegram_token . '/getUpdates';

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        foreach ($data['result'] as $key => $row) {
            $check = m_guru::where('id_telegram', $row['message']['from']['id'])->first();
            if (!$check) {
                m_guru::create([
                    'nama' => $row['message']['from']['first_name'] . ' ' . $row['message']['from']['last_name'],
                    'id_telegram' => $row['message']['from']['id']
                ]);
            }
        }

        return redirect()->back()->with('success', 'Berhasil di diupdate');
    }
}
