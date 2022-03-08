<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TexasHoldem\Models\Hand;
use TexasHoldem\Models\Rankings;
use TexasHoldem\Service\FileParser;
use TexasHoldem\Engine\HandsEngine;
use Symfony\Component\Filesystem\Filesystem;

final class HandsEngineTest extends TestCase
{
    public function testHandsRulesEngineClassExists() : void
    {
        $class = new HandsEngine();

        $this->assertInstanceOf(HandsEngine::class, $class, "HandsEngine is not a HandsEngine Class");
    }

    public function testSetHands() : void
    {
        $fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

        $filesystem = new Filesystem();
        if ($filesystem->exists($fileName)) {
            $originalHands = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        else {
            throw new \Exception('File not found.');
        }

        $handsRulesEngine = new HandsEngine();

        $handsRulesEngine->setHands($originalHands);

        $processedHands = $handsRulesEngine->getHands();

        $this->assertIsArray($processedHands);
        $this->assertEquals(count($originalHands), count($processedHands));
        $this->assertInstanceOf(Hand::class, $processedHands[0]);
    }

    public function testGetSortedHands() : void
    {
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

        $fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

        $filesystem = new Filesystem();
        if ($filesystem->exists($fileName)) {
            $originalHands = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        else {
            throw new \Exception('File not found.');
        }

        $handsRulesEngine = new HandsEngine();

        $handsRulesEngine->setHands($originalHands);

        $ranked = $handsRulesEngine->getSortedHands($rankings);

        $countRanked = 0;
        foreach($ranked as $index => $hand)
        {
            $countRanked = $countRanked + count($hand);
        }

        $this->assertIsArray($ranked);
        $this->assertEquals(count($originalHands), $countRanked);
    }
}
