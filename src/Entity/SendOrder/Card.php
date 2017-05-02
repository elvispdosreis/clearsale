<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 16:55
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\InvalidArgumentException;

class Card
{

    const DINERS = 1;
    const MASTERCARD = 2;
    const VISA = 3;
    const OUTROS = 4;
    const AMERICAN_EXPRESS = 5;
    const HIPERCARD = 6;
    const AURA = 7;

    private static $cards = array(
        self::DINERS,
        self::MASTERCARD,
        self::VISA,
        self::OUTROS,
        self::AMERICAN_EXPRESS,
        self::HIPERCARD,
        self::AURA,
    );
    private $type;
    private $name;
    private $number;
    private $securityCode;
    private $expirationDate;
    private $bin;
    private $nsu;

    /**
     * Card constructor.
     * @param $type
     * @param $number
     */
    public function __construct($type, $number)
    {
        $this->setType($type);
        $this->setNumber($number);
    }


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Card
     */
    public function setType($type)
    {
        if (!in_array($type, self::$cards)) {
            throw new InvalidArgumentException(sprintf('Invalid type (%s)', $type));
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Card
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return Card
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * @param mixed $securityCode
     * @return Card
     */
    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param mixed $expirationDate
     * @return Card
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * @param mixed $bin
     * @return Card
     */
    public function setBin($bin)
    {
        $this->bin = $bin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNsu()
    {
        return $this->nsu;
    }

    /**
     * @param mixed $nsu
     * @return Card
     */
    public function setNsu($nsu)
    {
        $this->nsu = $nsu;
        return $this;
    }


    public function toXML(\SimpleXMLElement &$card)
    {
        if ($this->number) {
            $card->addChild('CardNumber', $this->number);
        }

        if ($this->bin) {
            $card->addChild('CardBin', $this->bin);
        }

        if ($this->securityCode) {
            $card->addChild('CardEndNumber', $this->securityCode);
        }

        if ($this->type) {
            $card->addChild('CardType', $this->type);
        }

        if ($this->expirationDate) {
            $card->addChild('CardExpirationDate', $this->expirationDate);
        }

        if ($this->name) {
            $card->addChild('name', $this->name);
        }

        if ($this->nsu) {
            $card->addChild('Nsu', $this->nsu);
        }
    }


}