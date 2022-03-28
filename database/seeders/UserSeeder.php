<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario1 = User::Create([
            'name' => 'Admin',
            'Email' => 'admin@gmail.com',
            'password' => bcrypt('12345')
        ]);

        $rol1 = Role::create(['name' => 'Admin']);
        $permisos1 = Permission::pluck('id','id')->all();
        $rol1->syncPermissions($permisos1);
        $usuario1->assignRole([$rol1->id]);


        $usuario2 = User::Create([
            'name' => 'Carlos',
            'Email' => 'carlos@gmail.com',
            'password' => bcrypt('12345')
        ]);
        $rol2 = Role::create(['name' => 'Docente']);
        $rol2->syncPermissions([5, 9, 10]);
        $usuario2->assignRole([$rol2->id]);


        $usuario3 = User::Create([
            'name' => 'Daniel',
            'Email' => 'daniel@gmail.com',
            'password' => bcrypt('12345')
        ]);
        $rol3 = Role::create(['name' => 'Estudiante']);
        $rol3->syncPermissions([5]);
        $usuario3->assignRole([$rol3->id]);


        $usuario4 = User::Create([
            'name' => 'Dayana',
            'Email' => 'dayana@gmail.com',
            'password' => bcrypt('12345')
        ]);
        $usuario4->assignRole([$rol2->id]);


        $usuario5 = User::Create([
            'name' => 'Luis',
            'Email' => 'luis@gmail.com',
            'password' => bcrypt('12345')
        ]);
        $usuario5->assignRole([$rol2->id]);


        $usuario6 = User::Create([
            'name' => 'Camila',
            'Email' => 'camila@gmail.com',
            'password' => bcrypt('12345')
        ]);
        $usuario6->assignRole([$rol3->id]);


        $usuario7 = User::Create([
            'name' => 'Oscar',
            'Email' => 'oscar@gmail.com',
            'password' => bcrypt('12345')
        ]);
        $usuario7->assignRole([$rol3->id]);
    }
}
