<?php

namespace TexasHoldem\Command;

use TexasHoldem\Service\FileParser;
use TexasHoldem\Models\Rankings;
use TexasHoldem\Engine\HandsEngine;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HandsRulesEngineCommand extends Command
{
    use LockableTrait;

    protected static $defaultName = 'app:hands-validation';
    private $fileParser;

    // the name of the command (the part after "bin/console")
    private $handsRulesEngine;

    public function __construct(FileParser $fileParser, HandsEngine $handsRulesEngine)
    {
        parent::__construct();

        $this->fileParser = $fileParser;
        $this->handsRulesEngine = $handsRulesEngine;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Texas Hold\'em poker hands validation rule engine in PHP.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This rule engine is able to accept an input of multiple hands and output a list that ranks the hands.')

            // argument of the command
            ->addArgument('filename', InputArgument::REQUIRED, 'Path of the file to validate.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        $this->printInfo($output);

        $fileName = $input->getArgument('filename');

        $this->fileParser->setFileName($fileName);

        $originalHands = $this->fileParser->parseFile();

        $this->printInputHands($output, $originalHands, 'Unsorted');

        $this->handsRulesEngine->setHands($originalHands);

        $ranked = $this->handsRulesEngine->getSortedHands($this->getRankings());

        $this->printSortedHands($output, $ranked, 'Sorted');

        return 0;
    }

    private function getRankings(): array
    {
        return array(
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
    }

    private function printInfo(OutputInterface $output)
    {
        $output->writeln('<info>Running ' . $this->getDefaultName() . ' command</info>');
        $output->writeln('<info>' . $this->getDescription() . '</info>');
        $output->writeln('<info>' . $this->getHelp() . '</info>');
    }

    private function printInputHands(OutputInterface $output, array $hands, string $message)
    {
        $output->writeln('<fg=yellow>');
        $output->writeln($message);
        $output->writeln($hands);
        $output->writeln('</>');
    }

    private function printSortedHands(OutputInterface $output, array $ranked, string $message)
    {
        $output->writeln('<fg=green>');
        $output->writeln($message);

        foreach ($ranked as $rankin => $hands) {
            foreach ($hands as $index => $hand) {
                $out = array();
                foreach ($hand->getCards() as $card) {
                    array_push($out, $card->getDenomination() . $card->getSuit());
                }
                $output->writeln(join(" ", $out) . " - " . $hand->getScoreName());
            }
        }

        $output->writeln('</>');
    }
}
