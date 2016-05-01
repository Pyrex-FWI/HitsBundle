<?php

namespace HitsBundle\Command;

use HitsBundle\Source\SourceManager;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AbstractCommand extends ContainerAwareCommand
{
    /** @var  SourceManager*/
    protected $manager;

    /** @var InputInterface */
    protected $input;

    /**     * @var OutputInterface */
    protected $output;

    /** @var  ProgressBar */
    protected $progressBar;

    /** @var EventDispatcher */
    protected $eventDispatcher;

    /** @var Logger; */
    protected $logger;

    public function __construct(
        SourceManager $manager,
        $eventDispatcher,
        \Psr\Log\LoggerInterface $logger = null)
    {
        $this->logger = $logger ? $logger : new NullLogger();
        $this->manager = $manager;
        $this->eventDispatcher = $eventDispatcher;
        parent::__construct();
    }
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function init(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function initProgressBar($max)
    {
        $this->progressBar = new ProgressBar($this->output, $max);
        ProgressBar::setFormatDefinition(
            'debug', "%message%\n%current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%");
        $this->progressBar->setFormat('debug');
    }
}
