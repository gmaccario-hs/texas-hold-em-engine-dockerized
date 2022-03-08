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
use TexasHoldem\Engine\HandsEngine;
use Symfony\Component\Filesystem\Filesystem;

$fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

$filesystem = new Filesystem();
if ($filesystem->exists($fileName)) {
    $originalHands = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
else {
    throw new \Exception('File not found.');
}

dump("Original Hands", $originalHands);

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
);

$handsRulesEngine = new HandsEngine();
$handsRulesEngine->setHands($originalHands);
$ranked = $handsRulesEngine->getSortedHands($rankings);

dump("Poker Hands Rankings - from highest to lowest", $ranked);
