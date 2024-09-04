<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['sample_id', 'pertanyaan_id', 'jawaban_id', 'keterangan'];


    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban');
    }

}
