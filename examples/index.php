<?php

include_once __DIR__ . '/../vendor/autoload.php';

use SynapticNet\ActivationFunctions\SigmoidActivateFunction;
use SynapticNet\Layers\SimpleLayer;
use SynapticNet\NeuralNetworks\SimpleNeuralNetwork;
use SynapticNet\Neurons\SimpleNeuron;

// Define a multilayer neural network
$network = new SimpleNeuralNetwork([
    (object)[
        'type' => SimpleLayer::class,
        'typeNeuron' => SimpleNeuron::class,
        'sizeNeuron' => 4,
        'learningRate' => 0.2,
        'activateFunction' => SigmoidActivateFunction::class,
        'weights' => [
            [rand(-100, 100) / 100, rand(-100, 100) / 100],
            [rand(-100, 100) / 100, rand(-100, 100) / 100],
            [rand(-100, 100) / 100, rand(-100, 100) / 100],
            [rand(-100, 100) / 100, rand(-100, 100) / 100],
        ],
        'bias' => [0, 0, 0, 0]
    ],
    (object)[
        'type' => SimpleLayer::class,
        'typeNeuron' => SimpleNeuron::class,
        'sizeNeuron' => 1,
        'learningRate' => 0.2,
        'activateFunction' => SigmoidActivateFunction::class,
        'weights' => [
            [rand(-100, 100) / 100, rand(-100, 100) / 100, rand(-100, 100) / 100, rand(-100, 100) / 100]
        ],
        'bias' => [0]
    ]
]);

// XOR training data
$training = [
    [[0, 0], [0]],
    [[0, 1], [1]],
    [[1, 0], [1]],
    [[1, 1], [0]],
    [[0.1, 0.9], [1]],
    [[0.9, 0.1], [1]],
    [[0.8, 0.8], [0]],
    [[0.2, 0.2], [0]]
];

$stages = 5000;

$network->learn($stages, $training);

// Test results
$tests = [
    [[0, 0], [0]],
    [[0, 1], [1]],
    [[1, 0], [1]],
    [[1, 1], [0]],
    [[0.2, 0.8], [1]],
    [[0.9, 0.2], [1]],
    [[0.7, 0.7], [0]],
    [[0.3, 0.3], [0]]
];

echo "<h3>TEST MULTILAYER XOR RESULTS</h3>";

foreach ($tests as $val) {
    $inputs = $val[0];
    $expected = $val[1][0];

    $output = $network->activate($inputs);
    $result = round($output[0]);

    $color = $result == $expected ? 'green' : 'red';
    $text = $result == $expected ? 'good' : 'bad';

    echo "Input: [" . implode(',', $inputs) . "] → Output: " .
        number_format($output[0], 3) .
        " | Expected: $expected <span style='color:$color'>$text</span><br>";
}
