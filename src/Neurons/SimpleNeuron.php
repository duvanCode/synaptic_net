<?php
namespace SynapticNet\neurons;

use SynapticNet\ActivationFunctions\ActivateFunction;

class SimpleNeuron extends Neuron
{
    private $weights = [];
    private $bias = 0;
    private float $learningRate;
    private ActivateFunction $activateFunction;
    private float $lastNeto;

    function __construct(array $weights, float $bias,float $learningRate, ActivateFunction $activateFunction)
    {
        $this->weights = $weights;
        $this->bias = $bias;
        $this->learningRate = $learningRate;
        $this->activateFunction = $activateFunction;
    }

    function activate(array $inputs) : float
    {
        $result = 0;
        if (count($inputs) !== count($this->weights)) {
            throw new \InvalidArgumentException('Number of inputs must match number of weights');
        }

        foreach ($this->weights as $key => $valPesos) {
            $result += $inputs[$key] * $this->weights[$key];
        }

        $result += $this->bias; //sesgo

        $this->lastNeto = $result;

        return $this->activateFunction->activate($result);

    }


    function learn(float $error,array $inputs) : float
    {
        $derivadaDeValorNeto = $this->activateFunction->derivative($this->lastNeto);

        $error *= $derivadaDeValorNeto;

        foreach ($this->weights as $key => $weight) {
        $this->weights[$key] += $this->learningRate * $error * $inputs[$key];
        }

        $this->bias += ($error * $this->learningRate);

        return $error;
    }


}
