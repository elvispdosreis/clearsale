<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 24/04/2017
 * Time: 13:54
 */

namespace ClearSale\Entity\SendOrder;


class CustomerShipping extends AbstractCustomer
{
    public function toXML(\SimpleXMLElement &$order)
    {
        $customer = $order->addChild('ShippingData');
        parent::toXML($customer);
    }
}