<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator -> name = "Administrator";  
        $administrator -> email = "admin123@gmail.com";
        $administrator -> password = Hash::make('bismillah123');                
        $administrator -> status = "ACTIVE";
        $administrator -> username = "admin123";

        $administrator->save();

        $this->command->info('user Admin Berhasil Diinsert');
    }
}
