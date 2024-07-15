<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdminModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = AdminModel::where('name', 'Synex Digital')->first();

        if (is_null($admin)) {
            $admin           = new AdminModel();
            $admin->name     = "Synex Digital";
            $admin->email    = "digitalsynex@gmail.com";
            $admin->password = Hash::make('12345678');
            $admin->role     = 1;
            $admin->save();
        }

        $this->call(RolePermissionSeeder::class);
    }
}
