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

use TexasHoldem\Service\FileParser;
use TexasHoldem\Engine\Ranking;
use TexasHoldem\Engine\HandsRulesEngine;
use TexasHoldem\Command\HandsRulesEngineCommand;
use Symfony\Component\Console\Application;

$appName = php_sapi_name() == 'cli' ? 'console' : 'http';

if ($appName == 'console')
{
  $app = new Application();
  $app->add(new HandsRulesEngineCommand(new FileParser(), new HandsRulesEngine(new Ranking())));
  $app->run();
}
