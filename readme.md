# Synaptic Net

**Synaptic Net** is a lightweight PHP library for building and training simple neural networks from scratch.  
It’s designed for learning and experimenting with how neurons, layers, activation functions, and backpropagation interact internally — without relying on any external machine learning frameworks.

---

## Features

- Customizable neuron and layer classes  
- Backpropagation training process implemented from scratch  
- Multiple activation functions (Sigmoid, ReLU, etc.)  
- Supports multilayer perceptrons (MLP)  
- Educational and fully readable code structure  

---

## Installation

```bash
composer require synaptic-net/core
```

---

## Basic Example

Below is a simple example of how to create and train a multilayer neural network using **Synaptic Net** to learn the XOR problem:

```php
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
```

### Expected Output

```
TEST MULTILAYER XOR RESULTS
Input: [0,0] → Output: 0.035 | Expected: 0 good
Input: [0,1] → Output: 0.981 | Expected: 1 good
Input: [1,0] → Output: 0.987 | Expected: 1 good
Input: [1,1] → Output: 0.042 | Expected: 0 good
Input: [0.2,0.8] → Output: 0.739 | Expected: 1 good
Input: [0.9,0.2] → Output: 0.867 | Expected: 1 good
Input: [0.7,0.7] → Output: 0.061 | Expected: 0 good
Input: [0.3,0.3] → Output: 0.059 | Expected: 0 good
```

---

## License

MIT License  
See the [LICENSE](LICENSE) file for details.
