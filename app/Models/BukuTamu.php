<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Notifications\Notifiable;

class BukuTamu extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    public static function create_image($img){
        $folderPath = "image/";
        $image_parts = explode(";base64,", $img);
        foreach ($image_parts as $key => $image){
            $image_base64 = base64_decode($image);
        }
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        return $fileName;
    }

    public static function create_sinature($signed){
        $folderPath2 = "tandaTangan/";
        $img_parts =  explode(";base64,", $signed);
        $img_type_aux = explode("image/", $img_parts[0]);
        $img_type = $img_type_aux[1];
        $img_base64 = base64_decode($img_parts[1]);
        $namaTandaTangan =   uniqid() . '.'.$img_type;
        $file = $folderPath2 . $namaTandaTangan;
        file_put_contents($file, $img_base64);

        return $namaTandaTangan;
    }

    public function scopeSearch($query, array $search)
    {
        $query->when($search['search'] ?? false, function($query, $search){
            return $query->where('buku_tamus.nama', 'like', '%' . $search . '%')
                        ->orWhere('buku_tamus.instansi', 'like', '%' . $search . '%')
                        ->orWhere('buku_tamus.alamat', 'like', '%' . $search . '%');
        });
    }

    public static function excel(){
        $datas = [];
        
        foreach (BukuTamu::all() as $key => $data) {
            $datas[] = [
                'No' => $key + 1,
                'Nama' => $data->nama,
                'No Telepon' => $data->no_telp,
                'Instansi' => $data->instansi,
                'Alamat' => $data->alamat,
                'Kategori' => ($data->kategori == 'khusus') ? 'Tamu Khusus' : 'Tamu Umum',
                'Foto' => $data->image,
                'Tanda Tangan' => $data->signed,
                'Tujuan' => $data->guru->nama,
                'Keperluan' => $data->keperluan,
                'Created_at' => \Carbon\Carbon::parse($data->created_at)->format('d, M Y H:i'),
                'Updated_at' => \Carbon\Carbon::parse($data->updated_at)->format('d, M Y H:i')
            ];
        }

        $datas = collect($datas);

        return (new FastExcel($datas))->download('data.xlsx');
    }

    public function guru(){
        return $this->belongsTo(m_guru::class, 'guru_id');
    }
}
