<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $guarded = [];

    //melindungi variable dates untuk field data
    protected $dates = ['date'];

    //menentukan format dateattribut
    public function getFormattedDateAttribute()
    {
        return $this->date->format('F j, Y');
    }   

    //menetukan format start time attribut
    public function getFormattedStartTimeAttribute()
    {
        return $this->date->format('g:ia');
    }

    //menentukan batasan pada skup field published_at
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    //menempatkan business plan konversi harga tiket ke dollar pada model
    public function getTicketPriceInDollarsAttribute()
    {
        return number_format($this->ticket_price / 100, 2);
    }

}

