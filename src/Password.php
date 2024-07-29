<?php

namespace Xander\BillplzPassword;
final class Password implements GenerateInterface
{
    const OPTIONS = [
        'SPECIAL_CHARS' => 'SPECIAL_CHARS',
        'CAPITAL_LETTERS' => 'CAPITAL_LETTERS',
        'SMALL_LETTERS' => 'SMALL_LETTERS',
        'NUMBERS' => 'NUMBERS'
    ];
    private const DEFAULT_LENGTH = 20;
    private const SPECIAL_CHARS = ['!', '#', '$', '%', '&', '(', ')', '*', '+', '@', '^'];

    private bool $use_special_chars = true;
    private bool $use_capital_letters = true;
    private bool $use_small_letters = true;
    private bool $use_numbers = true;

    public function generate($length = self::DEFAULT_LENGTH) : string
    {
        $password = '';

        $chars = array_merge(
            $this->use_special_chars ? self::SPECIAL_CHARS : [],
            $this->use_capital_letters ? range('A', 'Z') : [],
            $this->use_small_letters ? range('a', 'z') : [],
            $this->use_numbers ? range(0, 9) : []
        );

        $max = count($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $max)];
        }

        return $password;
    }

    public function from(...$options): Password
    {
        foreach (self::OPTIONS as $option) {
            if (!in_array($option, $options)) {
                $this->{'use_' . strtolower($option)} = false;
            }
        }

        return $this;
    }
}