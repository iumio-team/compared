<?php
/**
 * Created by PhpStorm.
 * User: rafina
 * Date: 01/02/16
 * Time: 09:23
 */

namespace GException;

/**
 * Class DateException
 * Generate a date exception
 * @package GException
 */
class DateException extends AbstractException
{

    public function __construct(string $message)
    {
        parent::__construct($message, "Date error");
    }
}