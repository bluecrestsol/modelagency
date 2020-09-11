<?php

use Illuminate\Database\Seeder;

use App\Models\Hair;
class HairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hairs = [
        	'brown',
        	'black',
        	'white',
        	'sandy',
        	'gray',
        	'red',
        	'blonde',
        	'blue',
        	'green',
        	'orange',
        	'pink',
        	'purple',
        	'bald'
        ];

        foreach ($hairs as $e) {
        	Hair::create([
        		'name' => $e
        	]);
        }
    }
}
