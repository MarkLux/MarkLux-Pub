<?php
/**
 * Created by PhpStorm.
 * User: lumin
 * Date: 17/5/4
 * Time: 下午5:39
 */

namespace App\Exceptions;


class PhoneExistException extends BaseException
{
    protected $data = '手机号已经存在';
    protected $code = 1002;
}