<?php

namespace Tests\Feature;

use App\Models\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConcertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_formatted_date()
    {

        $concert = (Concert::factory())->make([
            'date'  => Carbon::parse('2019-12-01, 8:00pm'),
        ]);

        $this->assertEquals('December 1, 2019', $concert->formatted_date);
    }

      /** @test */
      public function can_get_formatted_start_time()
      {
        $this->withoutExceptionHandling();

        $concert = (Concert::factory())->make([
            'date'  => Carbon::parse('2019-12-01, 17:00:00'),
        ]);

        $this->assertEquals('5:00pm', $concert->formatted_start_time);
      }
          /** @test */
    public function concerts_with_published_at_date_are_published()
    {
        $publishedConcertA = (Concert::factory())->create([ 'published_at'   => Carbon::parse('-1 week') ]);
        $publishedConcertB = (Concert::factory())->create([ 'published_at'   => Carbon::parse('-1 week') ]);
        $unpublishedConcertC = (Concert::factory())->create([ 'published_at' => null ]);

        $publishedConcerts = Concert::published()->get();

        $this->assertTrue($publishedConcerts->contains($publishedConcertA));
        $this->assertTrue($publishedConcerts->contains($publishedConcertB));
        $this->assertFalse($publishedConcerts->contains($unpublishedConcertC));

    }

     /** @test */
     public function can_get_ticket_price_in_dollars()
     {
 
         $concert = (Concert::factory())->make([
             'ticket_price'  => 450,
         ]);
 
         $this->assertEquals('4.50', $concert->ticket_price_in_dollars);
     }

}
