<?php
/**
 * Created by PhpStorm.
 * User: lumin
 * Date: 17/5/4
 * Time: 下午5:21
 */

namespace App\Exceptions;


class BaseException extends \Exception
{
    protected $data;

    public function getData()
    {
        return $this->data;
    }
}