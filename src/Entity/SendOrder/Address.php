<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:54
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\InvalidArgumentException;
use ClearSale\Exception\RequiredFieldException;

class Address
{
    private $street;
    private $number;
    private $complement;
    private $neighborhood;
    private $city;
    private $state;
    private $country;
    private $zipCode;
    private $reference;

    /**
     * Address constructor.
     * @param $street
     * @param $number
     * @param $neighborhood
     * @param $city
     * @param $state
     * @param $country
     * @param $zipCode
     */
    public function __construct($street, $number, $neighborhood, $country, $city, $state, $zipCode)
    {
        $this->street = $street;
        $this->number = $number;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        if (empty($street)) {
            throw new InvalidArgumentException('Street is empty!');
        }

        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Address
     */
    public function setNumber($number)
    {
        if (empty($number)) {
            throw new InvalidArgumentException('Number is empty!');
        }

        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param string $complement
     * @return Address
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * @param string $neighborhood
     * @return Address
     */
    public function setNeighborhood($neighborhood)
    {
        if (empty($neighborhood)) {
            throw new InvalidArgumentException('Neighborhood is empty!');
        }

        $this->neighborhood = $neighborhood;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        if (empty($city)) {
            throw new InvalidArgumentException('City is empty!');
        }

        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Address
     */
    public function setState($state)
    {
        if (empty($state)) {
            throw new InvalidArgumentException('State is empty!');
        }

        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $zipCode = preg_replace('/[^0-9]/', '', $zipCode);

        if (empty($zipCode)) {
            throw new InvalidArgumentException('ZipCode is empty!');
        }

        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Address
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function toXML(\SimpleXMLElement &$customer)
    {

        $address = $customer->addChild('Address');

        if ($this->street) {
            $address->addChild('Street', $this->street);
        } else {
            throw new RequiredFieldException('Field Street of the Address object is required');
        }

        if ($this->number) {
            $address->addChild('Number', $this->number);
        } /*else {
            throw new RequiredFieldException('Field Number of the Address object is required');
        }*/

        if ($this->complement) {
            $address->addChild('Comp', $this->complement);
        }

        if ($this->neighborhood) {
            $address->addChild('County', $this->neighborhood);
        } else {
            throw new RequiredFieldException('Field County of the Address object is required');
        }

        if ($this->city) {
            $address->addChild('City', $this->city);
        } else {
            throw new RequiredFieldException('Field City of the Address object is required');
        }

        if ($this->state) {
            $address->addChild('State', $this->state);
        } else {
            throw new RequiredFieldException('Field State of the Address object is required');
        }

        if ($this->country) {
            $address->addChild('Country', $this->country);
        }

        if ($this->zipCode) {
            $address->addChild('ZipCode', $this->zipCode);
        } else {
            throw new RequiredFieldException('Field ZipCode of the Address object is required');
        }

        if ($this->reference) {
            $address->addChild('Reference', $this->reference);
        }
    }


}