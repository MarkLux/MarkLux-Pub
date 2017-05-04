<?php
/**
 * Created by PhpStorm.
 * User: lumin
 * Date: 17/5/4
 * Time: 下午5:36
 */

namespace App\Exceptions;


class PasswordErrorException extends BaseException
{
    protected $code = 1003;
    protected $data = '密码错误';
}