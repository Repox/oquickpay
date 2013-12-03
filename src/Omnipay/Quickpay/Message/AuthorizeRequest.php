<?php

namespace Omnipay\Quickpay\Message;

/**
 * Dummy Authorize Request
 */
class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {   
        $this->getParameter('cardReference');
        $this->getCard()->validate();

        $data['currency'] = $this->getParameter('currency');
        $data['amount'] = $this->getParameter('amount');
        $data['ordernumber'] = $this->getParameter('ordernumber');
        $data['cardnumber'] = $this->getParameter('cardnumber');
        $data['expirationdate'] = $this->getParameter('expirationyear').$this->getParameter('expirationmonth');
        $data['cvd'] = 
        $data['msgtype'] = 'authorize';

        return $data;
    }
}
