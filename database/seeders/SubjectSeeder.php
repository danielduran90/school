<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subjects;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects1 = Subjects::Create([
            'title' => 'Matematicas',
            'exponent_id' => 2
        ]);

        $subjects2 = Subjects::Create([
            'title' => 'Quimica',
            'exponent_id' => 4
        ]);

        $subjects3= Subjects::Create([
            'title' => 'Ingles',
            'exponent_id' => 5
        ]);
    }
}
