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
     * {@inheritdoc}
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

Example with an Email notification:
<info>
php app/console %command.name% email '{"notifierAlias": "alias", "to": "test@email.fr", "cc": "titi@toto.fr, tutu@titi.fr", "bcc": null, "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
</info>

Example with an Sms notification:
<info>
php app/console %command.name% sms '{"notifierAlias": "alias", "to": "test@email.fr", "cc": "titi@toto.fr, tutu@titi.fr", "bcc": null, "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
</info>

Example with an Facebook notification:
<info>
php app/console %command.name% facebook '{"notifierAlias": "alias", "to": "test@email.fr", "cc": "titi@toto.fr, tutu@titi.fr", "bcc": null, "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
</info>

Example with an Mail notification:
<info>
php app/console %command.name% mail '{"notifierAlias": "alias", "to": "test@email.fr", "cc": "titi@toto.fr, tutu@titi.fr", "bcc": null, "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
</info>

Example with an Twitter notification:
<info>
php app/console %command.name% twitter '{"notifierAlias": "alias", "to": "test@email.fr", "cc": "titi@toto.fr, tutu@titi.fr", "bcc": null, "subject": "notification via command line", "message": "the message to be send", "htmlMessage": "<h1>Titre</h1><p>Message</p>", "attachments": []}'
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
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        $parameters = $input->getArgument('parameters');
        $parameters = json_decode($parameters, true);

        try {
            $this
                ->getContainer()
                ->get('notification_api_client.notifier')
                ->addNotification($type, $parameters)
                ->notify()
            ;
            $output->writeln('<info>Notification sent</info>');
        } catch(\Exception $e) {
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }
}
