<?php

use Illuminate\Database\Seeder;
use App\Jawaban;

class JawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jawaban::create([
            'jawaban' => 'Baik'
        ]);
        Jawaban::create([
            'jawaban' => 'Sedang'
        ]);
        Jawaban::create([
            'jawaban' => 'Kurang'
        ]);
    }
}
