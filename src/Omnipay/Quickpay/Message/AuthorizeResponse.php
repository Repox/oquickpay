<?php

namespace Omnipay\Quickpay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Dummy Response
 */
class AuthorizeResponse extends AbstractResponse implements RedirectResponseInterface
{	
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {	
        return true;
    }

    public function getRedirectUrl()
    {
    	
        return $this->getRequest()->getEndpoint();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
