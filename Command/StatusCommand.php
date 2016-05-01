<?php

namespace HitsBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class StatusCommand extends AbstractCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('hits:status')->setDescription('Check All declared Hit sources')
            ->setHelp(<<<EOF
<info>%command.name%</info>
php app/console deejay:pool:status av_district
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);
        $radio = [];
        foreach($this->manager->getSourceList() as $source) {
            $this->output->writeln(str_pad('', 80, '=+', STR_PAD_BOTH));
            $this->output->writeln(str_pad($source->getName(), 80, ' ', STR_PAD_BOTH));
            $this->output->writeln(str_pad('', 80, '=+', STR_PAD_BOTH));
            foreach($source->getHitsPages() as $hitPage) {
                $url = $hitPage->getUrl();
                $status = (substr(get_headers($url)[0], 9));
                $success = $status == '200 OK' ? 'green' : 'red';
                $this->output->writeln(sprintf('<fg=%s>'.$status. '</> -> ' .$url, $success));
                $radio[$source->getName()][$url] = $status;
            }
            $this->output->writeln('');
        }

        return 1;
    }
}
