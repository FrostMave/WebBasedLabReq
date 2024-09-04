<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';
    protected $fillable = ['sample_id', 'status_laporan', 'laporan'];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
