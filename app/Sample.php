<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $fillable = ['user_id', 'jenis_pengujian_id', 'jumlah_contoh', 'status_contoh', 'tanggal_pengiriman', 'lokasi'];
    protected $with = ['user', 'biaya', 'hasil', 'jenisPengujian', 'penerimaan', 'persetujuan'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function persetujuan()
    {
        return $this->hasOne('App\Persetujuan');
    }


    public function penerimaan()
    {
        return $this->hasOne('App\Penerimaan');
    }

    public function biaya()
    {
        return $this->hasOne('App\Biaya');
    }

    public function hasil()
    {
        return $this->hasOne('App\Hasil');
    }

    public function jenisPengujian()
    {
        return $this->belongsTo('App\JenisPengujian');
    }
    public function feedback()
    {
        return $this->hasMany('App\Feedback');
    }
    public function saran()
    {
        return $this->hasOne('App\Saran');
    }
}
