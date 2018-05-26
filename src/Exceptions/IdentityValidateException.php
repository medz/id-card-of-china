<?php

namespace Medz\IdentityCard\China\Exceptions;

class IdentityValidateException extends \Exception
{
    /**
     * Create a identity validate exception instance.
     * 
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function __construct()
    {
        parent::__construct('Identity card number verification failed.');
    }
}
