<?php

namespace SynapticNet\neurons;

use SynapticNet\ActivationFunctions\ActivateFunction;

abstract class Neuron
{
    private $weights = [];
    private $bias = 0;
    private float $learningRate;
    private ActivateFunction $activateFunction;
    private float $lastNeto;

    function __construct(array $weights, float $bias, float $learningRate, ActivateFunction $activateFunction)
    {
        $this->weights = $weights;
        $this->bias = $bias;
        $this->learningRate = $learningRate;
        $this->activateFunction = $activateFunction;
    }

    abstract function activate(array $inputs): float;


    abstract function learn(float $error, array $inputs): float;
}
