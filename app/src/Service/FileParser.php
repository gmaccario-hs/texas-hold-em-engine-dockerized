<?php

namespace TexasHoldem\Service;

use Symfony\Component\Filesystem\Filesystem;

class FileParser extends Filesystem
{
    protected $filePath;
    protected $fileContent;

    /**
     *
     * @return void
     */
    /*public function __construct()
    {

    }*/

    /**
     *
     * @param string $fileName
     *
     * @return void
     */
    public function setFileName(string $fileName)
    {
        if ($this->exists($fileName)) {
            $this->filePath = $fileName;
        } else {
            $this->filePath = getcwd() . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $fileName;
        }
    }

    /**
     * Returns an array of file lines
     *
     * @return array
     */
    public function parseFile(): array
    {
        // file — Reads entire file into an array
        return file($this->getFileName(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    /**
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->filePath;
    }
}
