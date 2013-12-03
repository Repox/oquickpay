<?php

namespace Omnipay\Quickpay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Quickpay\Message\AuthorizeRequest;

/**
 * Dummy Gateway
 *
 * This gateway is useful for testing. It simply authorizes any payment made using a valid
 * credit card number and expiry.
 *
 * Any card number which passes the Luhn algorithm and ends in an even number is authorized,
 * for example: 4242424242424242
 *
 * Any card number which passes the Luhn algorithm and ends in an odd number is declined,
 * for example: 4111111111111111
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Dummy';
    }

    public function getDefaultParameters()
    {
        $settings['apiKey'] = '';
        $settings['merchantId'] = '';
        $settings['md5Secret'] = '';
        $settings['callbackUrl'] = '';
        $settings['testMode'] = 0;

        return $settings;
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setCallbackUrl($value)
    {
        return $this->setParameter('callbackUrl', $value);
    }

    public function getCallbackUrl()
    {
        return $this->getParameter('callbackUrl');
    }


    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMd5Secret($value)
    {
        return $this->setParameter('md5Secret', $value);
    }

    public function getMd5Secret()
    {
        return $this->getParameter('md5Secret');
    }        

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\AuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\PurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\RefundRequest', $parameters);
    }

    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\FetchTransactionRequest', $parameters);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\CreateCardRequest', $parameters);
    }

    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\UpdateCardRequest', $parameters);
    }

    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Quickpay\Message\DeleteCardRequest', $parameters);
    }
}
