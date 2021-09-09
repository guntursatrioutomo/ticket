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

        $concert = (Concert::factory())->create([
            'date'  => Carbon::parse('2019-12-01, 8:00pm'),
        ]);

        $this->assertEquals('December 1, 2019', $concert->formatted_date);
    }

      /** @test */
      public function can_get_formatted_start_time()
      {
        $this->withoutExceptionHandling();

        $concert = (Concert::factory())->create([
            'date'  => Carbon::parse('2019-12-01, 17:00:00'),
        ]);

        $this->assertEquals('5:00pm', $concert->formatted_start_time);
      }
}
