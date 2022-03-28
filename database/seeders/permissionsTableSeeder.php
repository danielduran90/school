<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class permissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view-rol',
            'new-rol',
            'edit-rol',
            'delete-rol',
            'view-subject',
            'new-subject',
            'edit-subject',
            'delete-subject',
            'view-scores',
            'edit-scores',
            'view-user',
            'new-user',
            'edit-user',
            'delete-user',
        ];

        foreach($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
