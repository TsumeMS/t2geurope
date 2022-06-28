<?php

$numbers = str_split($argv[1]);

for($i = 0; $i < 3; ++$i) {
    foreach ($numbers as $number) {
        printLine($i, $number);
    }
    echo PHP_EOL;
}
function printLine($line, $number): void {
    switch ($line){
        case 0: printFirstLine($number);
        break;
        case 1: printSecondLine($number);
        break;
        case 2: printThirdLine($number);
        break;
    };
}
function printFirstLine($number): void {
    switch ($number) {
        case '1':
            echo '  ';
        break;
        case '3':
        case '7':
            echo '_ ';
        break;
        case '4':
            echo '   ';
        break;
        default:
            echo ' _ ';
    }
}
function printSecondLine($number): void {
    switch ($number) {
        case '0':
            echo '| |';
        break;
        case '1':
        case '7':
            echo ' |';
        break;
        case '2':
            echo ' _|';
        break;
        case '3':
            echo '_|';
        break;
        case '4':
        case '8':
        case '9':
            echo '|_|';
        break;
        case '5':
        case '6':
            echo '|_ ';
        break;
    }
}
function printThirdLine($number): void {
    switch ($number) {
        case '0':
        case '6':
        case '8':
            echo '|_|';
        break;
        case '1':
        case '7':
            echo ' |';
        break;
        case '2':
            echo '|_ ';
        break;
        case '3':
            echo '_|';
        break;
        case '4':
            echo '  |';
        break;
        case '5':
        case '9':
            echo ' _|';
        break;
    }
}
