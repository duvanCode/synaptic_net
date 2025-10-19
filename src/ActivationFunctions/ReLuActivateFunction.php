<?php

namespace SynapticNet\ActivationFunctions;


class ReLuActivateFunction extends ActivateFunction
{
    function activate(float $x) : float
    {
        return max(0.0, $x);
    }

    function derivative(float $x) : float {
        return $x > 0 ? 1 : 0;
    }
}
