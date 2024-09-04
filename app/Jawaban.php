<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    public function sample()
    {
        return $this->hasOne(Jawaban::class);
    }
}
