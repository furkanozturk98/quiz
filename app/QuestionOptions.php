<?php


namespace App;


final class QuestionOptions
{
    public static function getLabel(string $key)
    {
        return [
            'option_a' => 'A',
            'option_b' => 'B',
            'option_c' => 'C',
            'option_d' => 'D',
            'option_e' => 'E',
        ][$key];
    }
}
