<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    protected $table = 'persetujuan';
    protected $fillable = ['sample_id', 'status_persetujuan', 'keterangan'];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
