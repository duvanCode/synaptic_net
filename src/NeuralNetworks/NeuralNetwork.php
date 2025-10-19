<?php

namespace SynapticNet\NeuralNetworks;

abstract class NeuralNetwork
{
  protected array $layers = [];

  abstract public function backpropagation(array $errorsOuput, array $rawData);
  abstract public function calculateError(array $output, array $expected): array;
  abstract public function learn(int $stages, array $data);
  abstract public function activate(array $data): array;
}
