<?php
/**
 * Created by PhpStorm.
 * User: lumin
 * Date: 17/5/4
 * Time: 下午5:24
 */

namespace App\Exceptions;


class InnerErrorException extends BaseException
{
    protected $code = 500;

    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }
}