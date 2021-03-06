<?php

namespace CL\Swiftmailer;

use Swift_Events_SendListener;
use Swift_Events_SendEvent;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2015, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ModifyPlugin implements Swift_Events_SendListener
{
    /**
     * @var callable
     */
    private $modifier;

    /**
     * @param callable $modifier
     */
    function __construct(callable $modifier)
    {
        $this->modifier = $modifier;
    }

    /**
     * @return callable
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * Apply the modifier to the Swift_Message
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        call_user_func($this->modifier, $message);
    }

    /**
     * Do nothing
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        // Do Nothing
    }
}
