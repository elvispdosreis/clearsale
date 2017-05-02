<?php

namespace ClearSale\Environment;

use Psr\Log\LoggerInterface;

class Production extends AbstractEnvironment
{
    public function __construct($entityCode, LoggerInterface $log = null)
    {
        //http://aplicacao.clearsale.com.br/Login.aspx
        $webService = 'https://integracao.clearsale.com.br/service.asmx';
        parent::__construct($entityCode, $webService, $log);
    }
}
