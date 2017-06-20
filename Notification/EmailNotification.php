<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmailNotification extends AbstractApiNotification
{
    /**
     * {@inheritdoc}
     */
    protected function configureParameters(OptionsResolverInterface $resolver)
    {
        parent::configureParameters($resolver);
        $resolver
            ->setDefaults(array(
                'transport'   => null,
                'from'        => null,
                'fromName'    => null,
                'replyTo'     => null,
                'server'      => null,
                'login'       => null,
                'password'    => null,
                'port'        => null,
                'encryption'  => null,
                'cc'          => null,
                'bcc'         => null,
                'message'     => null,
                'htmlMessage' => null,
                'attachments' => null,
            ))
            ->setRequired(array(
                'to',
                'subject',
            ))
            ->setAllowedTypes(array(
                'port' => array('null', 'integer'),
            ))
            ->setAllowedValues(array(
                'transport'  => array(null, 'smtp', 'sendmail', 'mail'),
                'encryption' => array(null, 'ssl', 'tsl')
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFrom()
    {
        return array(
            'transport'  => $this->parameters['transport'],
            'from'       => $this->parameters['from'],
            'fromName'   => $this->parameters['fromName'],
            'replyTo'    => $this->parameters['replyTo'],
            'server'     => $this->parameters['server'],
            'login'      => $this->parameters['login'],
            'password'   => $this->parameters['password'],
            'port'       => $this->parameters['port'],
            'encryption' => $this->parameters['encryption']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataTo()
    {
        return array(
            'to'  => $this->parameters['to'],
            'cc'  => $this->parameters['cc'],
            'bcc' => $this->parameters['bcc']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataContent()
    {
        return array(
            'subject'     => $this->parameters['subject'],
            'message'     => $this->parameters['message'],
            'htmlMessage' => $this->parameters['htmlMessage'],
            'attachments' => $this->parameters['attachments']
        );
    }
}
