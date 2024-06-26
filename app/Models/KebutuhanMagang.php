<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanMagang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function seksi()
    {
        return $this->belongsTo(Seksi::class, 'seksi_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(Seksi::class);
    }

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class);
    }
}
