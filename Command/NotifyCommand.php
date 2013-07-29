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
            ->setDescription('Allow to notify')
            ->setHelp(<<<EOT
                The <info>%command.name%</info> command allows to notify.
EOT
            )
            ->addArgument(
                'email',
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'Email argument'
            )
            ->addArgument(
                'mail',
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'mail argument'
            )
            ->addArgument(
                'sms',
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'Sms argument'
            )
            ->addArgument(
                'facebook',
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'Facebook argument'
            )
            ->addArgument(
                'twitter',
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'Twitter argument'
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
        $params = $this->getParams($input);

        $output->writeln($this->get('notification_api_client.notifier')->notify($params));
    }

    /**
     * Get params
     *
     * @param sInputInterface $input
     */
    protected function getParams(InputInterface $input)
    {
        $params = array(
            'email'     => $input->getArgument('email'),
            'mail'      => $input->getArgument('mail'),
            'sms'       => $input->getArgument('sms'),
            'facebook'  => $input->getArgument('facebook'),
            'twitter'   => $input->getArgument('twitter'),
        );

        var_dump($params);
        return $params;
    }

}

