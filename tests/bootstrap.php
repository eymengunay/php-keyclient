<?php

/*
 * This file is part of the KeyClient package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$loader = require_once __DIR__ . "/../vendor/autoload.php";
$loader->add('Eo\\KeyClient', '../src');
$loader->add('Eo\\KeyClient\\Tests', './Tests');
