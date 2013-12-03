<?php
namespace Omnipay\Quickpay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
	protected $api_endpoint = "https://secure.quickpay.dk/api";

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

    public function getBaseData()
    {
    	$data['apikey'] = $this->getApiKey();
    	$data['testmode'] = $this->getTestMode();
    	$data['merchant'] = $this->getMerchantId();
    	$data['callback'] = $this->getCallbackUrl();
    	$data['protocol'] = 7;
    	return $data;
    }

	private function _build_data_fields( $input_data )
	{	
		$valid_fields_ordered = array('protocol', 'channel', 'msgtype', 'merchant', 'ordernumber', 'amount', 'currency', 'autocapture', 'cardnumber', 'expirationdate', 'cvd', 'mobilenumber', 'smsmessage', 'cardtypelock', 'finalize', 'transaction', 'description', 'splitpayment', 'testmode', 'fraud_remote_addr', 'fraud_http_accept', 'fraud_http_accept_language', 'fraud_http_accept_encoding', 'fraud_http_accept_charset', 'fraud_http_referer', 'fraud_http_user_agent', 'apikey');
		
		// The final field array
		$data_fields = array();
		foreach($valid_fields_ordered as $key)
		{
			if(isset($input_data[$key]))
			{
				$data_fields[$key] = $input_data[$key];
			}
		}
		
		
		$data_fields['md5check'] = md5(implode("", $data_fields).$this->getMd5Secret());
		
		return $data_fields;
	}		

	public function sendData($data)
	{
		$data = $this->_build_data_fields(array_merge($data, $this->getBaseData()));
		var_dump($data);

		exit;
		$httpResponse = $this->httpClient->post($this->api_endpoint, null, $data)->send();
	}

}