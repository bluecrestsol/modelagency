<?php

use Illuminate\Database\Seeder;

use App\Models\Admin;

use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
        	'email' => 'admin@admin.com',
        	'password' => bcrypt('123456'),
        	'first_name' => 'Alex',
        	'last_name' => 'Scalia',
        	'role' => 1
        ]);
    }
}
