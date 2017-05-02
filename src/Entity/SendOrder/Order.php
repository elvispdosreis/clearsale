<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:53
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\InvalidArgumentException;
use ClearSale\Exception\RequiredFieldException;

class Order
{
    const DATE_TIME_FORMAT = 'Y-m-d\TH:i:s';
    const ECOMMERCE_B2B = 'b2b';
    const ECOMMERCE_B2C = 'b2c';

    private static $ecommerceTypes = array(
        self::ECOMMERCE_B2B,
        self::ECOMMERCE_B2C,
    );

    const STATUS_NOVO = 0;
    const STATUS_APROVADO = 9;
    const STATUS_CANCELADO = 41;
    const STATUS_REPROVADO = 45;

    private static $statuses = array(
        self::STATUS_NOVO,
        self::STATUS_APROVADO,
        self::STATUS_CANCELADO,
        self::STATUS_REPROVADO,
    );

    const PRODUCT_A_CLEAR_SALE = 1;
    const PRODUCT_M_CLEAR_SALE = 2;
    const PRODUCT_T_CLEAR_SALE = 3;
    const PRODUCT_TG_CLEAR_SALE = 4;
    const PRODUCT_TH_CLEAR_SALE = 5;
    const PRODUCT_TG_LIGHT_CLEAR_SALE = 6;
    const PRODUCT_TG_FULL_CLEAR_SALE = 7;
    const PRODUCT_T_MONITORADO = 8;
    const PRODUCT_SCORE_DE_FRAUDE = 9;
    const PRODUCT_CLEAR_ID = 10;
    const PRODUCT_ANALISE_INTERNACIONAL = 11;

    /*
    private static $products = array(
        self::PRODUCT_A_CLEAR_SALE,
        self::PRODUCT_M_CLEAR_SALE,
        self::PRODUCT_T_CLEAR_SALE,
        self::PRODUCT_TG_CLEAR_SALE,
        self::PRODUCT_TH_CLEAR_SALE,
        self::PRODUCT_TG_LIGHT_CLEAR_SALE,
        self::PRODUCT_TG_FULL_CLEAR_SALE,
        self::PRODUCT_T_MONITORADO,
        self::PRODUCT_SCORE_DE_FRAUDE,
        self::PRODUCT_CLEAR_ID,
        self::PRODUCT_ANALISE_INTERNACIONAL,
    );

    const LIST_TYPE_NAO_CADASTRADA = 1;
    const LIST_TYPE_CHA_DE_BEBE = 2;
    const LIST_TYPE_CASAMENTO = 3;
    const LIST_TYPE_DESEJOS = 4;
    const LIST_TYPE_ANIVERSARIO = 5;
    const LIST_TYPE_CHA_BAR_OU_CHA_PANELA = 6;

    private static $listTypes = array(
        self::LIST_TYPE_NAO_CADASTRADA,
        self::LIST_TYPE_CHA_DE_BEBE,
        self::LIST_TYPE_CASAMENTO,
        self::LIST_TYPE_DESEJOS,
        self::LIST_TYPE_ANIVERSARIO,
        self::LIST_TYPE_CHA_BAR_OU_CHA_PANELA,
    );

    */

    private $id;
    /**
     * @var FingerPrint
     */
    private $fingerPrint;
    /**
     * @var \DateTime
     */
    private $date;
    private $email;
    private $type;
    private $shippingPrice;
    private $totalItems;
    private $totalOrder;
    private $quantityInstallments;
    private $deliveryTimeCD;
    private $quantityItems;
    private $ip;
    private $shippingType;
    private $gift;
    private $giftMessage;
    private $notes;
    private $status;
    private $reanalise;
    private $origin;
    /**
     * @var CustomerBilling
     */
    private $billing;
    /**
     * @var CustomerShipping
     */
    private $shipping;
    /**
     * @var Payment[]
     */
    private $payments;
    /**
     * @var Item[]
     */
    private $itens;

    //private $SlaCustom;
    //private $ReservationDate;
    //private $Country;
    //private $Nationality;
    //private $Product;
    //private $ListTypeID;
    //private $ListID;
    //private $Passangers;
    //private $Connections;
    //private $HotelReservations
    //private $PurchaseInformationData

    /**
     * Order constructor.
     * @param $id
     * @param FingerPrint $fingerPrint
     * @param \DateTime $date
     * @param $email
     * @param $type
     * @param $totalItems
     * @param $totalOrder
     * @param $quantityInstallments
     * @param $ip
     * @param $origin
     */
    public function __construct()
    {
        /*
        $id, FingerPrint $fingerPrint, \DateTime $date, $email, $type, $totalItems, $totalOrder, $quantityInstallments, $ip, $origin
        $this->setId($id);
        $this->setFingerPrint($fingerPrint);
        $this->setDate($date);
        $this->setEmail($email);
        $this->setType($type);
        $this->setTotalItems($totalItems);
        $this->setTotalOrder($totalOrder);
        $this->setQuantityInstallments($quantityInstallments);
        $this->setIp($ip);
        $this->setOrigin($origin);
        */
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
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFingerPrint()
    {
        return $this->fingerPrint;
    }

    /**
     * @param mixed $fingerPrint
     * @return Order
     */
    public function setFingerPrint($fingerPrint)
    {
        $this->fingerPrint = $fingerPrint;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Order
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Order
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
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
     * @return Order
     */
    public function setType($type)
    {
        if (!in_array($type, self::$ecommerceTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid ecommerce type (%s)', $type));
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingPrice()
    {
        return $this->shippingPrice;
    }

    /**
     * @param mixed $shippingPrice
     * @return Order
     */
    public function setShippingPrice($shippingPrice)
    {
        $this->shippingPrice = $shippingPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param mixed $totalItems
     * @return Order
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalOrder()
    {
        return $this->totalOrder;
    }

    /**
     * @param mixed $totalOrder
     * @return Order
     */
    public function setTotalOrder($totalOrder)
    {
        $this->totalOrder = $totalOrder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantityInstallments()
    {
        return $this->quantityInstallments;
    }

    /**
     * @param mixed $quantityInstallments
     * @return Order
     */
    public function setQuantityInstallments($quantityInstallments)
    {
        $this->quantityInstallments = $quantityInstallments;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getDeliveryTimeCD()
    {
        return $this->deliveryTimeCD;
    }

    /**
     * @param mixed $deliveryTimeCD
     * @return Order
     */
    public function setDeliveryTimeCD($deliveryTimeCD)
    {
        $this->deliveryTimeCD = $deliveryTimeCD;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantityItems()
    {
        return $this->quantityItems;
    }

    /**
     * @param mixed $quantityItems
     * @return Order
     */
    public function setQuantityItems($quantityItems)
    {
        $this->quantityItems = $quantityItems;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return Order
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShippingType()
    {
        return $this->shippingType;
    }

    /**
     * @param mixed $shippingType
     */
    public function setShippingType($shippingType)
    {
        $this->shippingType = $shippingType;
    }

    /**
     * @return mixed
     */
    public function getGift()
    {
        return $this->gift;
    }

    /**
     * @param mixed $gift
     * @return Order
     */
    public function setGift($gift)
    {
        $this->gift = $gift;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGiftMessage()
    {
        return $this->giftMessage;
    }

    /**
     * @param mixed $giftMessage
     * @return Order
     */
    public function setGiftMessage($giftMessage)
    {
        $this->giftMessage = $giftMessage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     * @return Order
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Order
     */
    public function setStatus($status)
    {
        if (!in_array($status, self::$statuses)) {
            throw new InvalidArgumentException(sprintf('Invalid status (%s)', $status));
        }

        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReanalise()
    {
        return $this->reanalise;
    }

    /**
     * @param mixed $reanalise
     * @return Order
     */
    public function setReanalise($reanalise)
    {
        $this->reanalise = $reanalise;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     * @return Order
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * @param mixed $billing
     * @return Order
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     * @return Order
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param Payment|Payment[] $payments
     * @return Order
     */
    public function setPayments($payments)
    {
        foreach ((array)$payments as $payment) {
            $this->addPayment($payment);
        }
        return $this;
    }

    /**
     * @param Payment $payment
     * @return Order
     */
    public function addPayment(Payment $payment)
    {
        $this->payments[] = $payment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItens()
    {
        return $this->itens;
    }

    /**
     * @param mixed Item|Item[] $Items
     * @return Order
     */
    public function setItens($itens)
    {
        foreach ((array)$itens as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    /**
     * @param mixed $Items
     * @return Order
     */
    public function addItem(Item $Item)
    {
        $this->itens[] = $Item;
        return $this;
    }

    public function toXML(\SimpleXMLElement &$orders)
    {
        $order = $orders->addChild('Order');

        if ($this->id) {
            $order->addChild('ID', $this->id);
        } else {
            throw new RequiredFieldException('Field ID of the Order object is required');
        }

        if ($this->fingerPrint) {
            $this->fingerPrint->toXML($order);
        } else {
            throw new RequiredFieldException('Field FingerPrint of the Order object is required');
        }

        if ($this->date) {
            $order->addChild('Date', $this->date->format(Order::DATE_TIME_FORMAT));
        } else {
            throw new RequiredFieldException('Field Date of the Order object is required');
        }

        if ($this->email) {
            $order->addChild('Email', $this->email);
        } else {
            throw new RequiredFieldException('Field Email of the Order object is required');
        }

        if ($this->shippingPrice) {
            $order->addChild('ShippingPrice', $this->shippingPrice);
        }

        if ($this->totalItems) {
            $order->addChild('TotalItems', $this->totalItems);
        } else {
            throw new RequiredFieldException('Field TotalItems of the Order object is required');
        }

        if ($this->totalOrder) {
            $order->addChild('TotalOrder', $this->totalOrder);
        } else {
            throw new RequiredFieldException('Field TotalOrder of the Order object is required');
        }

        if ($this->quantityInstallments) {
            $order->addChild('QtyInstallments', $this->quantityInstallments);
        } else {
            throw new RequiredFieldException('Field QtyInstallments of the Order object is required');
        }

        if ($this->deliveryTimeCD) {
            $order->addChild('DeliveryTimeCD', $this->deliveryTimeCD);
        }

        if ($this->itens) {
            $order->addChild('QtyItems', count($this->itens));
        }

        if ($this->payments) {
            $order->addChild('QtyPaymentTypes', count($this->payments));
        }

        if ($this->ip) {
            $order->addChild('IP', $this->ip);
        } else {
            throw new RequiredFieldException('Field IP of the Order object is required');
        }

        if ($this->shippingType) {
            $order->addChild('shippingType', $this->shippingType);
        }

        if ($this->gift) {
            $order->addChild('Gift', $this->gift);
        }

        if ($this->giftMessage) {
            $order->addChild('GiftMessage', $this->giftMessage);
        }

        if ($this->notes) {
            $order->addChild('Obs', $this->notes);
        }

        if ($this->notes) {
            $order->addChild('Obs', $this->notes);
        }

        if ($this->status) {
            $order->addChild('Status', $this->status);
        }

        if ($this->reanalise) {
            $order->addChild('Reanalise', $this->reanalise);
        }

        if ($this->origin) {
            $order->addChild('Origin', $this->origin);
        } else {
            throw new RequiredFieldException('Field Origin of the Order object is required');
        }

        if ($this->billing) {
            $this->billing->toXML($order);
        } else {
            throw new RequiredFieldException('Field BillingData of the Order object is required');
        }

        if ($this->shipping) {
            $this->shipping->toXML($order);
        } else {
            throw new RequiredFieldException('Field ShippingData of the Order object is required');
        }

        if ($this->payments) {
            $payments = $order->addChild('Payments');
            foreach ($this->payments as $payment) {
                $payment->toXML($payments);
            }
        } else {
            throw new RequiredFieldException('Field Payments of the Order object is required');
        }

        if ($this->itens) {
            $itens = $order->addChild('Items');
            foreach ($this->itens as $item) {
                $item->toXML($itens);
            }
        } else {
            throw new RequiredFieldException('Field Items of the Order object is required');
        }

        return $order;

    }


}