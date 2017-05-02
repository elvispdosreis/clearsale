<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:56
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\InvalidArgumentException;
use ClearSale\Exception\RequiredFieldException;

class Item
{
    private $id;
    private $name;
    private $value;
    private $quantity;
    private $isGift;
    private $categoryId;
    private $categoryName;

    /**
     * Item constructor.
     * @param $id
     * @param $name
     * @param $value
     * @param $quantity
     */
    public function __construct($id, $name, $value, $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Item
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Name is empty!');
        }

        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Item
     */
    public function setValue($value)
    {
        if (!is_float($value)) {
            throw new InvalidArgumentException(sprintf('Invalid value', $value));
        }

        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        if (!is_int($quantity)) {
            throw new InvalidArgumentException(sprintf('Invalid quantity', $quantity));
        }

        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsGift()
    {
        return $this->isGift;
    }

    /**
     * @param mixed $isGift
     * @return Item
     */
    public function setIsGift($isGift)
    {
        if (!is_bool($isGift)) {
            throw new InvalidArgumentException(sprintf('Invalid gift value', $isGift));
        }

        $this->isGift = $isGift;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     * @return Item
     */
    public function setCategoryId($categoryId)
    {
        if (!is_int($categoryId)) {
            throw new InvalidArgumentException(sprintf('Invalid categoryId', $categoryId));
        }

        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     * @return Item
     */
    public function setCategoryName($categoryName)
    {
        if (empty($categoryName)) {
            throw new InvalidArgumentException('Category name is empty!');
        }

        $this->categoryName = $categoryName;
        return $this;
    }

    public function toXML(\SimpleXMLElement &$itens)
    {
        $item = $itens->addChild('Item');

        if ($this->id) {
            $item->addChild('ID', $this->id);
        } else {
            throw new RequiredFieldException('Field ID of the Item object is required');
        }

        if ($this->name) {
            $item->addChild('Name');
            $item->Name = $this->name;
        } else {
            throw new RequiredFieldException('Field Name of the Item object is required');
        }

        if ($this->value) {
            $item->addChild('ItemValue', $this->value);
        } else {
            throw new RequiredFieldException('Field ItemValue of the Item object is required');
        }

        if ($this->quantity) {
            $item->addChild('Qty', $this->quantity);
        } else {
            throw new RequiredFieldException('Field Qty of the Item object is required');
        }
        if ($this->isGift) {
            $item->addChild('Gift', (int)$this->isGift);
        }

        if ($this->categoryId) {
            $item->addChild('CategoryID', (int)$this->categoryId);
        }

        if ($this->categoryName) {
            $item->addChild('CategoryName', (int)$this->categoryName);
        }

    }


}