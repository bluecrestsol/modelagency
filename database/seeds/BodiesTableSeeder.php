<?php

use Illuminate\Database\Seeder;
use App\Models\Body;
class BodiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$bodies = [
    		'Skinny',
    		'Thin',
    		'Average',
    		'Athletic',
    		'Curvy',
    		'Overweight',
    		'Obese',
    	];
        
        foreach ($bodies as $body) {
        	Body::create([
        		'owner' => 1,
        		'name' => $body
        	]);
        }
    }
}
