<?php
namespace SynapticNet\ActivationFunctions;

class SigmoidActivateFunction extends ActivateFunction
{
    public function activate(float $x) : float
    {
        return 1 / (1 + exp(-$x));
    }

    public function derivative(float $x) : float
    {
        $fx = $this->activate($x);
        return $fx * (1 - $fx);
    }
}
