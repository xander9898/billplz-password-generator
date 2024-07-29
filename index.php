<?php
require __DIR__ . '/vendor/autoload.php';

use Xander\BillplzPassword\Password;

$generator = new Password();

$generated = $generator->from(
    Password::OPTIONS['SPECIAL_CHARS'],
    Password::OPTIONS['CAPITAL_LETTERS']
)->generate(length: 20);

//$generated = $generator->generate();

echo $generated;