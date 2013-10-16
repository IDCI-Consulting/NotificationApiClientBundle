<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use IDCI\Bundle\NotificationApiClientBundle\Exception\ApiResponseException;

class NotifyCommand extends ContainerAwareCommand
{
    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setName('tms:notification:notify')
            ->setDescription('Sends notifications from command line')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command can send different type of notifications such as Email, Mail, SMS, Twitter or Facebook.
Here is an example of usage of this command <info>php app/console %command.name%</info>, you juste have to specify a type and the parameters.
The parameters are mandatory, see below for example of usage.

Example with an Email notification.

<info>
php app/console %command.name% email '{"to":"test@email.fr","subject":"notification via command line","message":"message to send"}'
</info>

EOT
            )
            ->addArgument(
                'type',
                InputArgument::REQUIRED,
                'Specify the type of notification (email, mail, facebook, twitter, sms)'
            )
            ->addArgument(
                'parameters',
                InputArgument::REQUIRED,
                'Enter your notification parameters in json format'
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
        $type = $input->getArgument('type');
        $parameters = $input->getArgument('parameters');

        try {
            $this
                ->getContainer()
                ->get('notification_api_client.notifier')
                ->addNotification($type, $parameters)
                ->notify()
            ;
            $output->writeln('<info>Notification sent</info>');
        } catch(ApiResponseException $are) {
            $output->writeln(sprintf('<error>%s</error>', $are->getMessage()));
        }
    }
}

