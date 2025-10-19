<?php

namespace App\Thresholds;

abstract class Thresholds
{
    abstract function index(float $x): float;
}
