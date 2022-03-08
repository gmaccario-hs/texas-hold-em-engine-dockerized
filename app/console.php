#!/usr/local/bin/php
<?php
/*
Name: Texas Hold'em Validation
URI:
Description: Texas Hold’em poker hands validation rule engine in PHP, Command application
Version: 1.0
Author: Giuseppe Maccario
Author URI: giuseppemaccario.com
*/

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Symfony\Component\Console\Application;
use TexasHoldem\Command\HandsEngineCommand;
use TexasHoldem\Engine\HandsEngine;
use TexasHoldem\Service\FileParser;

$appName = php_sapi_name() == 'cli' ? 'console' : 'http';

if ($appName == 'console') {
    $app = new Application();
    $app->add(new HandsEngineCommand(new FileParser(), new HandsEngine()));

    try {
        $app->run();
    } catch (Exception $e) {
        dump($e->getMessage());
    }
}
