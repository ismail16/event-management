<?php
/**
 * Created by PhpStorm.
 * User: shihan
 * Date: 5/3/19
 * Time: 4:18 PM
 */

namespace App\Sms;


use App\Sms\Contracts\Result;

class SmsFailedException extends \Exception
{
    /**
     * @var Result
     */
    private $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
        parent::__construct($this->result->toJson(), 0, $this);
    }

    /**
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }
}