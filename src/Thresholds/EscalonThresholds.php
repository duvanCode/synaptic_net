<?php

namespace App\thresholds;
use App\Thresholds\Thresholds;

class EscalonThresholds extends Thresholds
{
    function index(float $x) : float
    {
        return $x <= 0 ? 0 : 1 ;
    }
}
