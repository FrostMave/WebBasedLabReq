<?php

use Illuminate\Database\Seeder;
use App\Pertanyaan;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pertanyaan::create([
            'pertanyaan' => 'Pelayanan'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Kejelasan informasi prosedur analisa'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Penanganan contoh'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Waktu proses analisis'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Bentuk/isi laporan hasil uji contoh'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Prosedur administrasi'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Kondisi lingkungan laboratorium'
        ]);
        Pertanyaan::create([
            'pertanyaan' => 'Biaya analisis'
        ]);
    }
}
