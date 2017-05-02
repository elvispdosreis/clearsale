<?php

namespace ClearSale\Entity\Response;


class PackageStatus
{
    const STATUS_CODE_TRANSACAO_CONCLUIDA = '00';
    const STATUS_CODE_USUARIO_INEXISTENTE = '01';
    const STATUS_CODE_ERRO_VALIDACAO_XML = '02';
    const STATUS_CODE_ERRO_TRANFORMACAO_XML = '03';
    const STATUS_CODE_ERRO_INESPERADO = '04';
    const STATUS_CODE_PEDIDO_JA_ENVIADO_OU_NAO_ESTA_EM_REANALISE = '05';
    const STATUS_CODE_ERRO_PLUGIN_ENTRADA = '06';
    const STATUS_CODE_ERRO_PLUGIN_SAIDA = '07';

    private $transactionId;
    /**
     * @var OrderReturn[]
     */
    private $orders;

    public function __construct($xml)
    {
        // FIX PHP Warning: Parser error : Document labelled UTF-16 but has UTF-8 content
        $xml = preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $xml);

        $object = simplexml_load_string($xml);

        if (isset($object->StatusCode)) {
            if (self::STATUS_CODE_TRANSACAO_CONCLUIDA !== (string)$object->StatusCode) {
                throw new \Exception(trim((string)$object->Message));
            }
            $this->setTransactionId($object->TransactionID);
        }

        if (isset($object->Orders)) {
            foreach ($object->Orders->Order as $order){
                $this->orders[] = new OrderReturn($order->ID, $order->Status, $order->Score);
            }
        }
    }


    public function getOrders()
    {
        return $this->orders;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    private function setTransactionId($transactionId)
    {
        $this->transactionId = (string)$transactionId;

        return $this;
    }
}