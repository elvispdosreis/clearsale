<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:52
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\InvalidArgumentException;
use ClearSale\Exception\RequiredFieldException;

class FingerPrint
{
    private $sessionId;

    /**
     * FingerPrint constructor.
     * @param $SessionID
     */
    public function __construct($sessionId)
    {
        $this->setSessionId($sessionId);
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param mixed $sessionId
     * @return FingerPrint
     */
    public function setSessionId($sessionId)
    {
        if (empty($sessionId)) {
            throw new InvalidArgumentException('SessionID is empty!');
        }
        $this->sessionId = $sessionId;
        return $this;
    }

    public function toXML(\SimpleXMLElement &$order)
    {
        $fingerprint = $order->addChild('FingerPrint');

        if ($this->sessionId) {
            $fingerprint->addChild('SessionID', $this->getSessionId());
        } else {
            throw new RequiredFieldException('Field SessionID of the FingerPrint object is required');
        }

    }

}