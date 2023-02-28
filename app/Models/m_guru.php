<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function buku_tamu(){
        return $this->hasMany(BukuTamu::class, 'guru_id');
    }
}
