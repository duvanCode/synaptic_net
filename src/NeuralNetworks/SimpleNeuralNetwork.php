<?php

namespace SynapticNet\NeuralNetworks;

use SynapticNet\Layers\Layer;
use SynapticNet\NeuralNetworks\NeuralNetwork;
use InvalidArgumentException;

class SimpleNeuralNetwork extends NeuralNetwork
{
    protected array $layers = [];

    public function __construct(array $layers)
    {
        foreach ($layers as $layer) {
            
            if (!is_subclass_of($layer->type, Layer::class) && $layer->type !== Layer::class) {
                throw new InvalidArgumentException("The layer type must extend the base Layer class");
            }

            $this->layers[] = new $layer->type(
                typeNeuron: $layer->typeNeuron,
                sizeNeuron: $layer->sizeNeuron,
                learningRate: $layer->learningRate,
                activateFunction: $layer->activateFunction,
                weights: $layer->weights,
                bias: $layer->bias
            );
        }
    }

    public function activate(array $data): array
    {
        foreach ($this->layers as $numLayer => $layer) {
            $data = $layer->activateLayer($data);
        }
        return $data;
    }


    public function calculateError(array $output, array $expectedoutput): array
    {
        $error = [];

        foreach ($expectedoutput as $key => $val) {
            $error[] = $val - $output[$key];
        }
        return $error;
    }


    public function backpropagation(array $errorsOuput, array $rawData)
    {

        for ($i = count($this->layers) - 1; $i >= 0; $i--) {

            foreach ($errorsOuput as $valError) {
                $lastInputs = $this->layers[$i]->getLastInputs();
                $errors[$i] = $this->layers[$i]->learnLayer($valError,$lastInputs);
            }

            $errorsOuput = $errors[$i];
        }
    }

    public function learn(int $stages, array $data)
    {

        for ($i = 1; $i <= $stages; $i++) {

            foreach ($data as $key => $val) {
                $rawData = $val[0];
                $expectedoutput = $val[1];

                $output = $this->activate($rawData);

                $errors = $this->calculateError($output, $expectedoutput);

                $this->backpropagation($errors, $rawData);
            }
        }
    }
}
