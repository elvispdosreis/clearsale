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

class Phone
{
    const NAO_DEFINIDO = 0;
    const RESIDENCIAL = 1;
    const COMERCIAL = 2;
    const RECADOS = 3;
    const COBRANCA = 4;
    const TEMPORARIO = 5;
    const CELULAR = 6;

    private static $types = array(
        self::NAO_DEFINIDO,
        self::RESIDENCIAL,
        self::COMERCIAL,
        self::RECADOS,
        self::COBRANCA,
        self::TEMPORARIO,
        self::CELULAR,
    );

    private $type;
    private $ddi;
    private $ddd;
    private $number;
    private $extension;

    /**
     * Phone constructor.
     * @param $type
     * @param $ddd
     * @param $number
     */
    public function __construct($type = null, $ddd = null, $number = null)
    {
        $this->setDDI(55);
        $this->setType($type);
        $this->setDDD($ddd);
        $this->setNumber($number);
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Phone
     */
    public function setType($type)
    {
        if (!array_key_exists($type, self::$types)) {
            throw new InvalidArgumentException(sprintf('Invalid type (%s)', $type));
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDDI()
    {
        return $this->ddi;
    }

    /**
     * @param string $ddi
     * @return Phone
     */
    public function setDDI($ddi)
    {
        $this->ddi = $ddi;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDDD()
    {
        return $this->ddd;
    }

    /**
     * @param string $ddd
     * @return Phone
     */
    public function setDDD($ddd)
    {
        $ddd = preg_replace('/[^0-9]/', '', $ddd);

        if (strlen($ddd) != 2) {
            throw new InvalidArgumentException(sprintf('Invalid DDD', $ddd));
        }

        $this->ddd = $ddd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Phone
     */
    public function setNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        if (strlen($number) != 9 && strlen($number) != 8) {
            throw new InvalidArgumentException(sprintf('Invalid Number', $number));
        }

        $this->number = $number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     * @return Phone
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }


    public function toXML(\SimpleXMLElement &$phones)
    {
        $phone = $phones->addChild('Phone');

        if (!is_null($this->type)) {
            $phone->addChild('Type', $this->type);
        } else {
            throw new RequiredFieldException('Field Type of the Phone object is required');
        }

        if ($this->ddi) {
            $phone->addChild('DDI', $this->ddi);
        }

        if ($this->ddd) {
            $phone->addChild('DDD', $this->ddd);
        } else {
            throw new RequiredFieldException('Field DDD of the Phone object is required');
        }

        if ($this->number) {
            $phone->addChild('Number', $this->number);
        } else {
            throw new RequiredFieldException('Field Number of the Phone object is required');
        }

        if ($this->extension) {
            $phone->addChild('Extension', $this->extension);
        }

    }

}