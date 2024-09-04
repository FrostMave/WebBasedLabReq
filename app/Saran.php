<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $table = 'saran';
    protected $fillable = ['sample_id', 'saran', ];


    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

}
