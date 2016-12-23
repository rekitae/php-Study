<?php
/*
output(1);
output(2);
output(3);
output(4);
output(5);

$flag = 4;
echo $flag & 1 ? '3 - 1 ok' : '3 - 1 no', PHP_EOL;
echo $flag & 2 ? '3 - 1 ok' : '3 - 1 no', PHP_EOL;
echo $flag & 3 ? '3 - 1 ok' : '3 - 1 no', PHP_EOL;
echo $flag & 4 ? '3 - 1 ok' : '3 - 1 no', PHP_EOL;
*/

function output($flag)
{
    printf('%s : %s : %s(hex) %s',
        $flag,
        base_convert($flag, 10, 2),
        base_convert($flag, 10, 16),
        PHP_EOL);
}

function checkMask($flag, $mask)
{
    $is = ' in ';

    if (!($flag & $mask))
        $is = ' not in ';

    echo $flag , $is , $mask , PHP_EOL;
}

const DECK1_SLOT1 = 1; // 1
const DECK1_SLOT2 = 2; // 2
const DECK1_SLOT3 = 2 << 1; // 4
const DECK2_SLOT1 = 2 << 2; // 8
const DECK2_SLOT2 = 2 << 3; // 16
const DECK2_SLOT3 = 2 << 4; // 32

const SLOT1 = DECK1_SLOT1 | DECK2_SLOT1;
const SLOT2 = DECK1_SLOT2 | DECK2_SLOT2;
const SLOT3 = DECK1_SLOT3 | DECK2_SLOT3;

output(SLOT1);
output(SLOT2);
output(SLOT3);

checkMask(DECK1_SLOT1, SLOT1);
checkMask(DECK1_SLOT2, SLOT1);
checkMask(DECK2_SLOT1, SLOT1);
