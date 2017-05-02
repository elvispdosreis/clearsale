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

class AbstractCustomer
{
    const TYPE_PESSOA_FISICA = 1;
    const TYPE_PESSOA_JURIDICA = 2;

    protected static $customerTypes = array(
        self::TYPE_PESSOA_FISICA,
        self::TYPE_PESSOA_JURIDICA,
    );

    const GENDER_MASCULINO = 'M';
    const GENDER_FEMININO = 'F';

    protected static $genderTypes = array(
        self::GENDER_MASCULINO,
        self::GENDER_FEMININO,
    );

    private $id;
    private $type;
    private $document1;
    private $document2;
    private $name;
    private $email;

    private $gender;
    /**
     * @var Address
     */
    private $address;
    /**
     * @var Phone[]
     */
    private $phones;

    /**
     * Customer constructor.
     * @param $id
     * @param $type
     * @param $document1
     * @param $name
     */
    public function __construct($id = null, $type = null, $document1 = null, $name = null)
    {
        $this->setId($id);
        $this->setType($type);
        $this->setDocument1($document1);
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return AbstractCustomer
     */
    public function setId($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('The id value is empty!');
        }

        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return AbstractCustomer
     */
    public function setType($type)
    {
        if (!in_array($type, self::$customerTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid type (%s)', $type));
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocument1()
    {
        return $this->document1;
    }

    /**
     * @param string $document1
     * @return AbstractCustomer
     */
    public function setDocument1($document1)
    {
        $document1 = preg_replace('/[^0-9]/', '', $document1);

        if (empty($document1)) {
            throw new InvalidArgumentException('Document1 is empty!');
        }

        $this->document1 = $document1;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocument2()
    {
        return $this->document2;
    }

    /**
     * @param string $document2
     * @return AbstractCustomer
     */
    public function setDocument2($document2)
    {
        $document2 = preg_replace('/[^0-9]/', '', $document2);

        if (empty($document2)) {
            throw new InvalidArgumentException('Document2 is empty!');
        }

        $this->document2 = $document2;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AbstractCustomer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AbstractCustomer
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return AbstractCustomer
     */
    public function setGender($gender)
    {
        if (!in_array($gender, self::$genderTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid gender (%s)', $gender));
        }

        $this->gender = $gender;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return AbstractCustomer
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return Phone[]
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param Phone|Phone[] $phones
     * @return AbstractCustomer
     */
    public function setPhones($phones)
    {
        foreach ((array)$phones as $phone) {
            $this->addPhone($phone);
        }
        return $this;
    }

    /**
     *
     * @param Phone $phone
     * @return AbstractCustomer
     */
    public function addPhone(Phone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    public function toXML(\SimpleXMLElement &$customer)
    {
        if ($this->id) {
            $customer->addChild('ID', $this->id);
        } else {
            throw new RequiredFieldException('Field ID of the Customer object is required');
        }

        if ($this->type) {
            $customer->addChild('Type', $this->type);
        } else {
            throw new RequiredFieldException('Field Type of the Customer object is required');
        }

        if ($this->document1) {
            $customer->addChild('LegalDocument1', $this->document1);
        } else {
            throw new RequiredFieldException('Field LegalDocument1 of the Customer object is required');
        }

        if ($this->document2) {
            $customer->addChild('LegalDocument2', $this->document2);
        }

        if ($this->name) {
            $customer->addChild('Name', $this->name);
        } else {
            throw new RequiredFieldException('Field name of the Customer object is required');
        }

        if ($this->email) {
            $customer->addChild('Email', $this->email);
        }

        if ($this->gender) {
            $customer->addChild('Gender', $this->gender);
        }

        if ($this->address) {
            $this->address->toXML($customer);
        }

        if (count($this->phones) > 0) {
            $phones = $customer->addChild('Phones');
            foreach ($this->phones as $phone) {
                $phone->toXML($phones);
            }
        }
    }


}