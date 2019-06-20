<?php

namespace Magento\MailChimpApi\Model\View;

/**
 * Request Manager Model
 *
 */
class Request 
{
    /**
     * Username API Mailchimp
     *
     */
    protected $USER = "anystring";

    /**
     * API_KEY API Mailchimp
     *
     */
    protected $KEY = "<KEY_MAILCHIMP>"; 

    /**
     * URL to API Mailchimp. Include server
     *
     */
    protected $URL = "https://<SERVER>.api.mailchimp.com/3.0/lists/";


    protected $_exampleVariable;
  
    /**
     * @return void
     */ 
    public function _construct($exampleVariable)
    {
        $this->_exampleVariable = $exampleVariable;
        echo "Request Model not work _construct()";
    }

    /**
     * Get Lists
     *
     * @return string
     */
    public function getLists()
    {
        return $this->requestCreator(
            $this->URL,
            "GET",
            true,
            $this->USER,
            $this->KEY
        );
    }

    /**
     * Get Suscribers of a list
     *
     * @param string listId
     * @return string
     */
    public function getSubscribersList($listId)
    {
        
    }

    /**
     * Add Suscriber to a list
     *
     * @param array infoSubscriber
     * @param int $listId
     * @return string
     */
    public function addSubscriberList($infoSubscriber, $listId)
    {
        return $this->requestCreator(
            $this->URL.$listId."/members/",
            "POST",
            true,
            $this->USER,
            $this->KEY,
            $infoSubscriber
        );
    }
    
    /**
     * Create a request to API Mailchimp
     *
     * @param string $url
     * @param string $action
     * @param boolean $auth
     * @param string $user
     * @param string $pass
     * @param array $data
     * @return string
     */
    private function requestCreator($url, $action, $auth = false, $user = "", $pass = "", $data = [])
    {
        $headers = ['Content-Type: application/json'];
        if($auth)
        {
            $auth = base64_encode($user.":".$pass);
            array_push($headers, 'Authorization: Basic '.$auth);
        }

        $request = curl_init();

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, $action);
        curl_setopt($request, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_TIMEOUT, 10);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($request, CURLOPT_POSTFIELDS, $data);
              
        $results = array(
            "response" => json_decode(curl_exec($request)),
            "status" => curl_getinfo($request, CURLINFO_HTTP_CODE),
            "error" => json_decode(curl_error($request))
        );

        curl_close($request);

        return $results;
    }    
}
