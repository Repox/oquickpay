<?php

namespace Omnipay\Quickpay\Message;

/**
 * Dummy Authorize Request
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {   
    	 $this->validate('amount', 'returnUrl', 'cancelUrl', 'transactionId', 'currency');
    	     	 
    	
    	$data = $this->getBaseData();
        $data['currency'] = $this->getParameter('currency');
        $data['amount'] = $this->getParameter('amount') * 100;
        $data['cancelurl'] = $this->getParameter('cancelUrl');
        $data['continueurl'] = $this->getParameter('returnUrl');       
        $data['ordernumber'] = $this->getParameter('transactionId');
        $data['msgtype'] = 'authorize';
        $data['autocapture'] = 1;
		
        return $this->form_fields($data);
    }
    
    
	private function form_fields($input_data)
	{                
		$valid_input_ordered = array('protocol', 'msgtype', 'merchant', 'language', 'ordernumber', 'amount', 'currency', 'continueurl', 'cancelurl', 'callbackurl', 'autocapture', 'autofee', 'cardtypelock', 'description', 'group', 'testmode', 'splitpayment', 'forcemobile', 'deadline');
		
		foreach($valid_input_ordered as $key)
		{	
			if(isset($input_data[$key]))
			{
				$data_fields[$key] = $input_data[$key];
			}                        
		}		
		$data_fields['md5check'] = md5(implode("", $data_fields) . $this->getParameter('md5Secret'));
		return $data_fields;
		
	}                                                      	
    
    
    public function sendData($data)
    {    	
    	
    	return $this->response = new AuthorizeResponse($this, $data);
    }
    
    public function getEndpoint()
    {
    	return "https://secure.quickpay.dk/form/";
    }
}
