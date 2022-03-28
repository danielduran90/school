<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assigned_subjects;

class SubjectAssignedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects1 = Assigned_subjects::Create([
            'user_id' => 3,
            'subject_id' => 1,
            'score' => 3
        ]);

        $subjects2 = Assigned_subjects::Create([
            'user_id' => 6,
            'subject_id' => 2,
            'score' => 5
        ]);

        $subjects3 = Assigned_subjects::Create([
            'user_id' => 7,
            'subject_id' => 3,
            'score' => 2.9
        ]);

        $subjects4 = Assigned_subjects::Create([
            'user_id' => 3,
            'subject_id' => 2,
            'score' => 1.6
        ]);

        $subjects5 = Assigned_subjects::Create([
            'user_id' => 6,
            'subject_id' => 3,
            'score' => 1.6
        ]);

        $subjects6 = Assigned_subjects::Create([
            'user_id' => 7,
            'subject_id' => 1,
            'score' => 4.9
        ]);
    }
}
