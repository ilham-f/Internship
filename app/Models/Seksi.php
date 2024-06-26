<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function kebutuhan_magang()
    {
        return $this->hasMany(KebutuhanMagang::class);
    }

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class);
    }
}
