<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 27/04/2017
 * Time: 11:40
 */

namespace ClearSale;

use ClearSale\Entity\Response\PackageStatus;
use ClearSale\Entity\SendOrder\Order;
use ClearSale\Environment\AbstractEnvironment;

class ClearSale
{
    private $entityCode;
    private $client;

    public function __construct(AbstractEnvironment $environment)
    {
        $this->entityCode = $environment->getEntityCode();
        $this->client = $environment;

    }

    /**
     * Retorna o status de um pedido
     *
     * @param string $orderId
     * @return PackageStatus
     */
    public function getOrderStatus($orderId)
    {
        $function   = 'GetOrderStatus';
        $parameters = array(
            'entityCode' => $this->entityCode,
            'orderID'    => $orderId
        );


        $response = $this->client->doRequest($function, $parameters);

        // TODO: Implement log -> $response->GetOrderStatusResult

        return new PackageStatus($response->GetOrderStatusResult);
    }

    /**
     * Método para envio de pedidos
     *
     * @param mixed Order[] $itens
     * @return PackageStatus
     */
    public function sendOrders(&$itens)
    {
        $xml = new \SimpleXMLElement('<ClearSale/>');
        $orders = $xml->addChild('Orders');

        foreach ($itens as &$order){
            $order->toXML($orders);
        }

        $function   = 'SendOrders';
        $parameters = array(
            'entityCode' => $this->entityCode,
            'xml'        => $xml->asXML()
        );

        $response = $this->client->doRequest($function, $parameters);
        return new PackageStatus($response->SendOrdersResult);
    }
}