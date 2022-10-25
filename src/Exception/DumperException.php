<?php

namespace Typomedia\Ini\Exception;

use Exception;

/**
 * Class DumperException
 * @package Typomedia\Ini\Exception
 */
class DumperException extends Exception
{
    /**
     * @var string
     */
    protected $message;

    /**
     * DumperException constructor.
     * @param $message
     * @param int $code
     */
    public function __construct($message, $code = 0)
    {

        $this->message = sprintf('Section "%s" is not an array!', $message);

        parent::__construct($message, $code);
    }
}
