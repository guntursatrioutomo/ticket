<?php

namespace Tests\Feature;

use App\Models\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class concertlistTest extends TestCase
{
    use RefreshDatabase;

   
    /** @test */
    public function tets_a_user_can_view_published_concert_listing()
    {
        $this->withoutExceptionHandling();
        // Arrange
        // Membuat field database concert
        $concert = Concert::factory()->published()->create([
            'title' => 'The Red Chord',
            'subtitle' => 'With Animosity and Lethargy',
            'date'  => Carbon::parse('August 13th, 2019, 8:00pm'),
            'ticket_price'  => 550,
            'venue' => 'Spens - Mala sala', 
            'venue_address'  => 'Maksima Gorkog 4',
            'city'  => 'Novi Sad',
            'state' => 'Srbija',
            'zip' => '21000',
            'additional_information' => 'For tickets call +381642233444',
        ]);

        // Act
        // Menampilakan Concert pada web routing
        $response = $this->get('/concerts/'. $concert->id);



        // Assert
        // Melihat pengetesan sesuai dengan isi field yang ditentukan
        $response->assertSee('The Red Chord');
        $response->assertSee('With Animosity and Lethargy');
        $response->assertSee('August 13, 2019');
        $response->assertSee('8:00pm');
        $response->assertSee('5.50');
        $response->assertSee('Spens - Mala sala');
        $response->assertSee('Maksima Gorkog 4');
        $response->assertSee('Novi Sad');
        $response->assertSee('Srbija');
        $response->assertSee('21000');
        $response->assertSee('For tickets call +381642233444');


    }
   

      /** @test */
      //mengatur user tidak dapat melihat list konser yang belum di publis

      public function a_user_cannot_view_unpublished_concert_listing()
      {
          $concert = Concert::factory()->unpublished()->make();
  
             $response = $this->get('/concerts/'. $concert->id);
  
            $response->assertStatus(404);
      }
}
