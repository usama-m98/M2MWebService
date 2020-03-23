<?php


namespace Coursework;

/**
class used to connect to the ee m2m web service
*/
class SoapWrapper
{
    public function __construct(){}

    public function __destruct(){}

    /**
function is used to create a soap client to connect,
to ee m2m web service client.
*/
    public function createSoapClient()
    {
        $soap_client_handle = false;
        $exception = '';
        $wsdl = WSDL;
        $soap_client_parameters = ['trace' => true, 'exceptions' => true];

        try
        {
            $soap_client_handle = new \SoapClient($wsdl, $soap_client_parameters);
//            var_dump($soap_client_handle->__getFunctions());
//            var_dump($soap_client_handle->__getTypes());
        }
        catch(\SoapFault $exception)
        {
            $soap_client_handle = 'Ooops - something went wrong when connecting to the data supplier.  Please try again later';

        }

        return $soap_client_handle;
    }
    /**
    function is used to to create a soap call to run the soap client,
    to connect to  m2m web service.
    */
    public function performSoapCall($soap_client, $webservice_function, $webservice_call_parameters, $webservice_value)
    {
        $soap_call_result = null;
        $raw_xml = '';

        if ($soap_client)
        {
            try
            {
                $webservice_call_result = $soap_client->{$webservice_function}($webservice_call_parameters);
                $soap_call_result = $webservice_call_result->{$webservice_value};
            }
            catch (\SoapFault $exception)
            {
                $soap_call_result = $exception;
            }
        }
        var_dump($soap_call_result);
        return $soap_call_result;
    }
}