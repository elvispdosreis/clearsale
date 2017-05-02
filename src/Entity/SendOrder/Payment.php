<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:55
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\InvalidArgumentException;
use ClearSale\Exception\RequiredFieldException;

class Payment
{
    const CARTAO_CREDITO           = 1;
    const BOLETO_BANCARIO          = 2;
    const DEBITO_BANCARIO          = 3;
    const DEBITO_BANCARIO_DINHEIRO = 4;
    const DEBITO_BANCARIO_CHEQUE   = 5;
    const TRANSFERENCIA_BANCARIA   = 6;
    const SEDEX_A_COBRAR           = 7;
    const CHEQUE                   = 8;
    const DINHEIRO                 = 9;
    const FINANCIAMENTO            = 10;
    const FATURA                   = 11;
    const CUPOM                    = 12;
    const MULTICHEQUE              = 13;
    const OUTROS                   = 14;

    private static $paymentTypes = array(
        self::CARTAO_CREDITO,
        self::BOLETO_BANCARIO,
        self::DEBITO_BANCARIO,
        self::DEBITO_BANCARIO_DINHEIRO,
        self::DEBITO_BANCARIO_CHEQUE,
        self::TRANSFERENCIA_BANCARIA,
        self::SEDEX_A_COBRAR,
        self::CHEQUE,
        self::DINHEIRO,
        self::FINANCIAMENTO,
        self::FATURA,
        self::CUPOM,
        self::MULTICHEQUE,
        self::OUTROS,
    );

    private $type;
    private $sequential;

    /**
     * @var \DateTime
     */
    private $date;
    private $amount;
    private $name;
    private $document;
    private $quantityInstallments;
    private $interest;
    private $interestValue;
    private $currency;
    /**
     * @var Address
     */
    private $address;
    /**
     * @var Card
     */
    private $card;

    /**
     * Payment constructor.
     * @param $sequential
     * @param $type
     * @param $date
     * @param $amount
     * @param $quantityInstallments
     */
    public function __construct($sequential = null, $type = null, $date = null, $amount = null)
    {
        $this->setSequential($sequential);
        $this->setType($type);
        $this->setDate($date);
        $this->setAmount($amount);
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
     * @return Payment
     */
    public function setType($type)
    {
        if (!array_key_exists($type, self::$paymentTypes)) {
            throw new InvalidArgumentException(sprintf('Invalid payment type (%s)', $type));
        }

        $this->type = $type;
        return $this;
    }

    /**
     * @return null
     */
    public function getSequential()
    {
        return $this->sequential;
    }

    /**
     * @param null $sequential
     * @return Payment
     */
    public function setSequential($sequential)
    {
        $this->sequential = $sequential;
        return $this;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Payment
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param null $amount
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }


    /**
     * @return null
     */
    public function getQuantityInstallments()
    {
        return $this->quantityInstallments;
    }

    /**
     * @param null $quantityInstallments
     * @return Payment
     */
    public function setQuantityInstallments($quantityInstallments)
    {
        $this->quantityInstallments = $quantityInstallments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param mixed $interest
     * @return Payment
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInterestValue()
    {
        return $this->interestValue;
    }

    /**
     * @param mixed $interestValue
     * @return Payment
     */
    public function setInterestValue($interestValue)
    {
        $this->interestValue = $interestValue;
        return $this;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     * @return Payment
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param null $document
     * @return Payment
     */
    public function setDocument($document)
    {
        $this->document = $document;
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
     * @return Payment
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return array
     */
    public static function getPaymentTypes()
    {
        return self::$paymentTypes;
    }

    /**
     * @param array $paymentTypes
     */
    public static function setPaymentTypes(array $paymentTypes)
    {
        self::$paymentTypes = $paymentTypes;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param Card $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    public function toXML(\SimpleXMLElement &$payments)
    {
        $payment = $payments->addChild('Payment');

        if ($this->sequential) {
            $payment->addChild('Sequential', $this->sequential);
        } else {
            throw new RequiredFieldException('Field Sequential of the Payment object is required');
        }

        if ($this->date) {
            $payment->addChild('Date', $this->date->format(Order::DATE_TIME_FORMAT));
        } else {
            throw new RequiredFieldException('Field Date of the Payment object is required');
        }

        if ($this->amount) {
            $payment->addChild('Amount', $this->amount);
        } else {
            throw new RequiredFieldException('Field Amount of the Payment object is required');
        }

        if ($this->type) {
            $payment->addChild('PaymentTypeID', $this->type);
        } else {
            throw new RequiredFieldException('Field PaymentTypeID of the Payment object is required');
        }

        if ($this->quantityInstallments) {
            $payment->addChild('QtyInstallments', $this->quantityInstallments);
        }

        if ($this->interest) {
            $payment->addChild('Interest', $this->interest);
        }

        if ($this->interestValue) {
            $payment->addChild('InterestValue', $this->interestValue);
        }

        if ($this->card) {
            $this->card->toXML($payment);
        }

        if ($this->document) {
            $payment->addChild('LegalDocument', $this->document);
        }

        if ($this->address) {
            $this->address->toXML($payment);
        }


        if ($this->currency) {
            $payment->addChild('Currency', $this->currency);
        }


    }


}