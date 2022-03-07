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

use TexasHoldem\Models\Rankings;
use TexasHoldem\Service\FileParser;
use TexasHoldem\Engine\Ranking;
use TexasHoldem\Engine\HandsRulesEngine;

$fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

$fileParser = new FileParser();
$fileParser->setFileName($fileName);

$originalHands = $fileParser->parseFile();

dump("Original Hands", $originalHands);

$ranking = new Ranking();
$handsRulesEngine = new HandsRulesEngine($ranking);
$handsRulesEngine->setHands($originalHands);


$rankings = array(
    new Rankings\RoyalFlush(),
    new Rankings\StraightFlush(),
    new Rankings\FourOfAKind(),
    new Rankings\FullHouse(),
    new Rankings\Flush(),
    new Rankings\Straight(),
    new Rankings\ThreeOfAKind(),
    new Rankings\TwoPair(),
    new Rankings\Pair(),
    new Rankings\HighCard(),
    new Rankings\EmptyHand(),
);



$ranked = $handsRulesEngine->getSortedHands($rankings);

dump("Poker Hands Rankings - from highest to lowest", $ranked);
