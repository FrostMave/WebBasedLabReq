<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $table = 'penerimaan';
    protected $fillable = ['sample_id', 'tanggal_terima', 'status_penerimaan_sample'];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
