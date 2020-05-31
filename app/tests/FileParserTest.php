<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TexasHoldem\Service\FileParser;

final class FileParserTest extends TestCase
{
    public function testFileParserClassExists() : void
    {
        $class = new FileParser();

        $this->assertInstanceOf(FileParser::class, $class, "FileParser is not a FileParser Class");
    }

    public function testSetFileName() : void
    {
        $fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

        $class = new FileParser();

        $class->setFileName($fileName);

        $this->assertEquals($fileName, $class->getFileName());
    }

    public function testParseFile() : void
    {
        $fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

        $class = new FileParser();

        $class->setFileName($fileName);

        $array = $class->parseFile();

        $this->assertIsArray($array);
    }
}
