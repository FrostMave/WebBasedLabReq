<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['user_id', 'telepon', 'alamat'];

    public function sample()
    {
        return $this->belongsTo(User::class);
    }
}
