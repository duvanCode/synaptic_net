<?php

namespace SynapticNet\ActivationFunctions;


class EscalonActivateFunction extends ActivateFunction
{
    function activate(float $x) : float
    {
        return $x <= 0 ? 0 : 1 ;
    }
    
    function derivative(float $x) : float {
        return 1;
    }
}
