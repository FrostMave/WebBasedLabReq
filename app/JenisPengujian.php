<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPengujian extends Model
{
    protected $table = 'jenis_pengujian';

    public function sample()
    {
        return $this->hasOne(Sample::class, 'jenis_pengujian_id');
    }
}
