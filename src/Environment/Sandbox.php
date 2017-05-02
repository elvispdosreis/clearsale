<?php

namespace ClearSale\Environment;

use Psr\Log\LoggerInterface;

class Sandbox extends AbstractEnvironment
{
    public function __construct($entityCode, LoggerInterface $log = null)
    {
        //http://aplicacao.homologacao.clearsale.com.br/Login.aspx
        $webService = 'https://homologacao.clearsale.com.br/integracaov2/Service.asmx';
        parent::__construct($entityCode, $webService, $log);
    }
}
