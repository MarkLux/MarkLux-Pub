<?php
/**
 * Created by PhpStorm.
 * User: lumin
 * Date: 17/5/4
 * Time: 下午5:23
 */

namespace App\Exceptions;


use Exception;

class FormValidationException extends BaseException
{
    protected $code = 1005;

    public function __construct(array  $data=[''])
    {
        parent::__construct();
        $this->data = $data;
    }
}