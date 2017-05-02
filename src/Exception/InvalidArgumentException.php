<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 26/04/2017
 * Time: 14:07
 */

namespace ClearSale\Exception;


class InvalidArgumentException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}