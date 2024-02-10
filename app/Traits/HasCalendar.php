<?php

namespace App\Traits;

use App\Models\Calendar;

trait HasCalendar 
{
    
    public function calendar()
    {
        return $this->morphOne(Calendar::class, 'entity');
    }
}