<?php
/*
Name: Texas Hold'em Validation
URI:
Description: Texas Hold’em poker hands validation rule engine in PHP, Sample application
Version: 1.0
Author: Giuseppe Maccario
Author URI: giuseppemaccario.com
*/

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use TexasHoldem\Service\FileParser;
use TexasHoldem\Engine\Ranking;
use TexasHoldem\Engine\HandsRulesEngine;

$fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

$fileParser = new FileParser();
$ranking = new Ranking();
$handsRulesEngine = new HandsRulesEngine($ranking);

$fileParser->setFileName($fileName);

$originalHands = $fileParser->parseFile();

dump("Original Hands", $originalHands);

$handsRulesEngine->setHands($originalHands);

$ranked = $handsRulesEngine->getSortedHands();

dump("Poker Hands Rankings - from highest to lowest", $ranked);
