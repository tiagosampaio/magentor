#!/bin/env php
<?php

function main($argv)
{
    Phar::mapPhar('magentor.phar');
    require_once 'phar://magentor.phar/app/bootstrap.php';
}

main($argv);
__HALT_COMPILER();