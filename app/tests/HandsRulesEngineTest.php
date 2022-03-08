<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TexasHoldem\Models\Hand;
use TexasHoldem\Engine\Ranking;
use TexasHoldem\Service\FileParser;
use TexasHoldem\Engine\HandsEngine;

final class HandsRulesEngineTest extends TestCase
{
    public function testHandsRulesEngineClassExists() : void
    {
        $ranking = new Ranking();
        $class = new HandsEngine($ranking);

        $this->assertInstanceOf(HandsEngine::class, $class, "HandsEngine is not a HandsEngine Class");
    }

    public function testSetHands() : void
    {
        $fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

        $fileParser = new FileParser();
        $ranking = new Ranking();
        $handsRulesEngine = new HandsEngine($ranking);

        $fileParser->setFileName($fileName);

        $originalHands = $fileParser->parseFile();

        $handsRulesEngine->setHands($originalHands);

        $processedHands = $handsRulesEngine->getHands();

        $this->assertIsArray($processedHands);
        $this->assertEquals(count($originalHands), count($processedHands));
        $this->assertInstanceOf(Hand::class, $processedHands[0]);
    }

    public function testGetSortedHands() : void
    {
        $fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

        $fileParser = new FileParser();
        $ranking = new Ranking();
        $handsRulesEngine = new HandsEngine($ranking);

        $fileParser->setFileName($fileName);

        $originalHands = $fileParser->parseFile();

        $handsRulesEngine->setHands($originalHands);

        $ranked = $handsRulesEngine->getSortedHands();

        $countRanked = 0;
        foreach($ranked as $index => $hand)
        {
          $countRanked = $countRanked + count($hand);
        }

        $this->assertIsArray($ranked);
        $this->assertEquals(count($originalHands), $countRanked);
    }
}
