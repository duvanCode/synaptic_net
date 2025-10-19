<?php

namespace SynapticNet\Layers;

abstract class Layer
{

    protected array $neurons = [];

    abstract public function __construct(
        int $sizeNeuron,
        string $typeNeuron,
        float $learningRate,
        string $activateFunction,
        array $weights = [],
        array $bias = []
    );

    abstract public function activateLayer(array $inputs): array;

    abstract public function learnLayer(float $error, array $inputs);
}
