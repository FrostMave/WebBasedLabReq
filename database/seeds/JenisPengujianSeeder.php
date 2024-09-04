<?php

use Illuminate\Database\Seeder;
use App\JenisPengujian;

class JenisPengujianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPengujian::create([
            'nama_pengujian' => 'CVPD',
        ]);
        JenisPengujian::create([
            'nama_pengujian' => 'CTV',
        ]);
    }
}
