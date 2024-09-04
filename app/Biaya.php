<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    protected $table = 'biaya';
    protected $fillable = ['sample_id', 'biaya', 'status_pembayaran', 'bukti'];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
