<?php

namespace Database\Factories;

use App\Models\Concert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ConcertFactory extends Factory
{
    
    protected $model = Concert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Example Band',
            'subtitle' => 'With Fake Openers',
            'date'  => Carbon::parse('+2 weeks'),
            'ticket_price'  => 2000,
            'venue' => 'The Example Theatre', 
            'venue_address'  => 'Example Street 123',
            'city'  => 'Fakeville',
            'state' => 'Srbija',
            'zip' => '21000',
            'additional_information' => 'Some sample additinal information',
        ];
    }


    public function published ()
    {
        return $this-> state (function (array $attributes) 
        {
            return [
                'published_at' => Carbon::now()
            ];
        });

    }

    public function unpublished ()
    {
        return $this-> state (function (array $attributes) 
        {
            return [
                'published_at' => null
            ];
        });

    }

 

}


  
    

