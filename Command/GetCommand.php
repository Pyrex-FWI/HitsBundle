<?php

namespace HitsBundle\Command;

use HitsBundle\Event\HitsBundleEvent;
use HitsBundle\Event\SourceEvent;
use HitsBundle\Item;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class GetCommand extends AbstractCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('hits:get')->setDescription('Check All declared Hit sources')
            ->addOption('source','src', InputOption::VALUE_REQUIRED, 'Specific source')
            ->addOption('show-sources', null, InputOption::VALUE_NONE, 'Specific source')
            ->setHelp(<<<EOF
<info>%command.name%</info>
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->init($input, $output);
        $sourceName = $this->input->getOption('source');

        $items = [];
        foreach ($this->manager->getSourceList() as $source) {
            if ($sourceName && $source->getName() != $sourceName) continue;

            $items = array_merge($items, $source->extractHits());
        }

        $this->printSummary($items);

        return 1;
    }

    public function init(InputInterface $input, OutputInterface $output) {

        parent::init($input, $output);

        if ($this->input->getOption('show-sources')) {
            foreach ($this->manager->getSourceList() as $source) {
                $this->output->writeln($source->getName());
            }
            exit(1);
        }
    }

    /**
     * @param $items Item[]
     */
    private function printSummary(array $items)
    {
        $rows = [];
        $proper = [];

        foreach ($items as $item) {
            if ($item->isProperlyDecoded()) {
                $proper[] = [
                    $item->getArtist(),
                    $item->getTitle(),
                    $item->getSourceName(),
                ];
            } else {
                $rows[] = [
                    $item->getLongTitle(),
                    $item->getSourceName(),
                ];
            }
        }

        $tableHelper = new Table($this->output);
        $tableHelper->setHeaders([
            'Artist', 'Title', 'source',
        ]);
        $tableHelper->setRows($proper);
        $tableHelper->render();

        if (count($rows)) {
            $tableHelper->setHeaders([
                'Artist - Title (unformated)', 'source',
            ]);
            $tableHelper->setRows($rows);
            $tableHelper->render();
        }

        $this->output->writeln(sprintf('%s hits', count($items)));
    }


}
