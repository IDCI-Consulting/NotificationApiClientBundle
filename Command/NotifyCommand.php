<?php

namespace IDCI\Bundle\NotificationApiClientBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NotifyCommand extends ContainerAwareCommand
{
    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setName('tms:notification:notify')
            ->setDescription('Sends different type of notifications')
            ->setHelp(<<<EOT
                The <info>%command.name%</info> command can send different type of notification according to a specific type
EOT
            )
            ->addOption(
                'type',
                null,
                InputOption::VALUE_REQUIRED,
                'Specify the type of notification'
            )
            ->addArgument(
                'parameters',
                InputArgument::IS_ARRAY,
                'Enter your parameters (separated by a space)'
)
        ;
    }

    /**
     * Execute
     *
     * @param sInputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getOption('type');
        $params = $input->getArgument('parameters');

        foreach($params as $notificationParameters){
            $this
                ->getContainer()
                ->get('notification_api_client.notifier')
                ->addNotification($type, $notificationParameters)
                ->notify();
        }
    }
}

