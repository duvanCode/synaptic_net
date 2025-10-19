<?php

namespace SynapticNet\Layers;

use SynapticNet\Layers\Layer;
use SynapticNet\Neurons\Neuron;
use InvalidArgumentException;

class SimpleLayer extends Layer {
    protected array $neurons = [];
    protected array $lastInputs = [];

    public function __construct(
        int $sizeNeuron,
        string $typeNeuron,
        float $learningRate,
        string $activateFunction,
        array $weights = [],
        array $bias = []
    ) {
        if (!is_subclass_of($typeNeuron, Neuron::class) && $typeNeuron !== Neuron::class) {
            throw new InvalidArgumentException("The neuron type must extend the base Neuron class");
        }

        for ($i = 0; $i < $sizeNeuron; $i++) {

            $this->neurons[] = new $typeNeuron(
                $weights[$i] ?? [],
                $bias[$i] ?? 0,
                $learningRate,
                new $activateFunction,
            );
            
        }
    }

    public function activateLayer(array $inputs): array
    {
        $outputs = [];
        $this->lastInputs = $inputs;
        foreach ($this->neurons as $neuron) {
            $outputs[] = $neuron->activate($inputs);
        }
        return $outputs;
    }

    public function getLastInputs(): array
    {
        return $this->lastInputs;
    }


    public function learnLayer(float $error, array $inputs)
    {
        $errors = [];
        foreach ($this->neurons as $i => $neuron) {
          $errors[] = $neuron->learn($error, $inputs);
        }
        return $errors;
    }
}