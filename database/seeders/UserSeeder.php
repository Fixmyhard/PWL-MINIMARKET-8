<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UpdateUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
use App\Models\Branch;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $roles = ['owner', 'manager', 'supervisor', 'kasir', 'gudang'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $owner = UpdateUser::create([
            'nama_user' => $faker->name,
            'peran' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('123'),
            'id_cabang' => null,
        ]);

        $owner->assignRole('owner');

        $roles = ['manager', 'supervisor', 'kasir', 'gudang'];
        
        $branches = Branch::all();
        foreach ($branches as $branch) {
            foreach ($roles as $role) {
                $user = UpdateUser::create([
                    'nama_user' => $faker->name,
                    'peran' => $role,
                    'email' => strtolower($role) . $branch->id . '@gmail.com',
                    'password' => Hash::make('password'),
                    'id_cabang' => $branch->id,
                ]);
                $user->assignRole($role); 
            }
        }
    } 
}
