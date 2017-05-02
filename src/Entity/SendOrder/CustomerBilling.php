<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:54
 */

namespace ClearSale\Entity\SendOrder;


use ClearSale\Exception\RequiredFieldException;

class CustomerBilling extends AbstractCustomer
{

    /**
     * @var \DateTime
     */
    private $birthDate;


    /**
     * CustomerBilling constructor.
     * @param $id
     * @param $type
     * @param $document1
     * @param $name
     * @param $birthDate
     */
    public function __construct($id = null, $type = null, $document1 = null, $name = null, $birthDate = null)
    {
        parent::__construct($id, $type, $document1, $name);
        if($type === AbstractCustomer::TYPE_PESSOA_FISICA){
            if(!is_null($birthDate)){
                $this->setBirthDate($birthDate);
            }
        }
    }


    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     * @return CustomerBilling
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function toXML(\SimpleXMLElement &$order)
    {
        $customer = $order->addChild('BillingData');

        parent::toXML($customer);

        if(parent::getType() == AbstractCustomer::TYPE_PESSOA_FISICA) {
            if ($this->birthDate) {
                $customer->addChild('BirthDate', $this->birthDate->format(Order::DATE_TIME_FORMAT));
            } else {
                throw new RequiredFieldException('Field BirthDate of the CustomerBillingData object is required');
            }
        }

    }
}