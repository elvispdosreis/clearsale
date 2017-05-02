<?php

namespace ClearSale\Environment;

use Psr\Log\LoggerInterface;

abstract class AbstractEnvironment
{
    protected $entityCode;
    protected $webService;
    protected $log;
    private $client;

    public function __construct($entityCode, $webService, LoggerInterface $log = null)
    {
        $this->entityCode = $entityCode;
        $this->webService = $webService;
        $this->log = $log;
        $this->client = new \SoapClient($this->webService . '?WSDL');
    }

    public function getEntityCode(){
        return $this->entityCode;
    }

    public function doRequest($function, $parameters)
    {
        $arguments = array($function => $parameters);
        $options = array('location' => $this->webService);

        if ($this->log) {
            // TODO: Implement Resquest log
        }

        $response = $this->client->__soapCall($function, $arguments, $options);

        if ($this->log) {
            // TODO: Implement Response log
        }

        return $response;
    }
}
