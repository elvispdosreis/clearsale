<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 26/04/2017
 * Time: 09:15
 */

namespace ClearSale\Exception;


class RequiredFieldException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}