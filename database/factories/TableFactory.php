<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TableFactory extends Factory
{
    private $str = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n',
        'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ];
    private $num = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'
    ];
    private $i = 0;
    private $f = 0;

    public function definition()
    {
        if ($this->i <= count($this->str) - 1) {
            $this->i++;
            if ($this->f == count($this->num) - 1) {
                $this->f = 0;
            }
        } else {
            $this->i = 1;
            $this->f++;
        }
        return [
            'num_table' => $this->num[$this->f] . $this->str[$this->i - 1]
        ];
    }
}
