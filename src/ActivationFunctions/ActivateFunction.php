<?php

namespace SynapticNet\ActivationFunctions;

abstract class ActivateFunction
{
    abstract function activate(float $x): float;
    abstract function derivative(float $x): float;
}
