<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Sekou KOÏTA <sekou.koita@supinfo.com>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\NotificationApiClientBundle\Notification;

abstract class AbstractNotification implements QueryStringableInterface
{
    protected $notifierAlias;

    /**
     * Set notifier alias
     *
     * @param string $notifierAlias
     * @return AbstractNotification
     */
    public function setNotifierAlias($notifierAlias)
    {
        $this->notifierAlias = $notifierAlias;

        return $this;
    }

    /**
     * Get notifier alias
     *
     * @return string
     */
    public function getNotifierAlias()
    {
        return $this->notifierAlias;
    }

    /**
     * {@inheritdoc}
     */
    public function toQueryString()
    {
        return json_encode(array_merge(
            array('notifierAlias' => $this->getNotifierAlias()),
            $this->getData()
        ));
    }

    /**
     * Get data
     *
     * @return array
     */
    abstract public function getData();
}
