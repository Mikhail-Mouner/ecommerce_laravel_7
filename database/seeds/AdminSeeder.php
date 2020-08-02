<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = Admin::where('email',"admin@info.com")->first();
        if (!$admin){
            $admin = Admin::create([
                'name' => 'admin',
                'email' => 'admin@info.com',
                'password' => bcrypt('1234')
            ]);
        }
    }
}
