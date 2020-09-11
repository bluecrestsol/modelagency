<?php

use Illuminate\Database\Seeder;
use App\Models\Ethnicity;

class EthnicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$ethnicities = [
    		'asian',
    		'black',
    		'hispanic',
    		'white',
    		'mixed'
    	];

    	foreach ($ethnicities as $e) {
    		Ethnicity::create([
    			'name' => $e
    		]);
    	}
        
    }
}
