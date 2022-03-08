# PHP Texas Hold'em Hands Validation Engine

## Installation
```
git clone https://github.com/gmaccario/texas-hold-em-engine-dockerized.git texas-hold-em-engine
cd texas-hold-em-engine
docker-compose up -d

docker exec -it texas-hold-em-engine-php /bin/bash
composer install
```

### General Commands
```
php ./console.php -V
```

### Texas Hold'em Engine Commands
Run the command with the filename or the filepath as input of the command. Without a path, the application looks into "/var/www/html/data/" folder (default path with a test input file), otherwise the file will be opened from the original location.
```
php ./console.php app:hands-validation inputfile.txt
php ./console.php app:hands-validation /var/www/html/data/inputfile.txt
php ./console.php app:hands-validation /tmp/inputfile.txt
```

### PHPUnit
```
php ./vendor/bin/phpunit --version
php ./vendor/bin/phpunit tests/
php ./vendor/bin/phpunit tests/FileParserTest.php
php ./vendor/bin/phpunit tests/HandsEngineTest.php
```

### Web
[On your localhost](http://localhost/application.php)

### Sample application
```
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use TexasHoldem\Models\Rankings;
use TexasHoldem\Service\FileParser;
use TexasHoldem\Engine\HandsEngine;

$fileName = 'data' . DIRECTORY_SEPARATOR . 'inputfile.txt';

$fileParser = new FileParser();
$fileParser->setFileName($fileName);

$originalHands = $fileParser->parseFile();

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
```

#### Texas Hold'em Hands
1. Royal flush A, K, Q, J, 10, all the same suit.
2. Straight flush Five cards in a sequence, all in the same suit.
3. Four of a kind All four cards of the same rank.
4. Full house Three of a kind with a pair.
5. Flush Any five cards of the same suit, but not in a sequence.
6. Straight Five cards in a sequence, but not of the same suit.
7. Three of a kind Three cards of the same rank.
8. Two pair Two different pairs.
9. Pair Two cards of the same rank.
10. High Card When you haven't made any of the hands above, the highest card plays.

### Change log
* 2020-06-21 Implemented hands sorting on equal rank
* 2022-03-08 Implemented feedback for better software: removed big if statement, clean up code, and implemented interfaces

### TODO
* No separation of concerns
* File loader (in his example) does not apply tell dont ask principle
* Replace array with collection
* ...
