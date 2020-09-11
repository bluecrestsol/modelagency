<?php

use Illuminate\Database\Seeder;

use App\Models\Eyes;

class EyesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eyes = [
        	'black',
        	'blue',
        	'brown',
        	'gray',
        	'green',
        	'hazel',
        	'maroon',
        	'pink',
        	'multicolored'
        ];

        foreach ($eyes as $e) {
        	Eyes::create([
        		'name' => $e
        	]);
        }
    }
}
