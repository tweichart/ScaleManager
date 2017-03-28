<?php
/**
 * Part of the InterNetX ScaleManager
 *
 * @copyright  Copyright (C) 2017 InterNetX GmbH. All rights reserved.
 * @license    MIT license; see LICENSE
 */

require_once __DIR__ . '../../conf/conf.inc.php';

use Curl\Curl;

/**
 * Class IsacApiConnector
 *
 */
class IsacApiConnector {

    var $token = "";
    var $cookies = array();
    var $curl = null;


    public function __construct()
    {
        $this->curl = new \Curl\Curl();
    }

    /**
     * Authenticates against the ISAC API
     *
     * @return bool Success
     */
    public function authenticate(){

        $loginEndPoint = APIURL . LOGINPATH;

        $this->curl->post($loginEndPoint, array(
            'grant_type' => 'client_credentials',
            'client_id' => ISACUSERNAME,
            'client_secret' => ISACPASSWORD,
            'devKey' => DEVKEY,
            'appKey' => APPKEY,
        ));

        if ($this->curl->error) {
            return FALSE;
        }
            $loginRespone = $this->curl->response;

            if($loginRespone == null){
                return FALSE;
            }
            $this->token = $loginRespone->access_token;
            $responeCookies = $this->curl->responseCookies;

            foreach($responeCookies as $responeCookieName => $responeCookieValue){
                $cookie = new stdClass();
                $cookie->name = $responeCookieName;
                $cookie->value = $responeCookieValue;
                $this->cookies[] = $cookie;
            }
    }

    /**
     * Finds an instance by ip address
     *
     * @param string $ip ip of the searched instance
     *
     * @return null or instance
     */
    public function findInstanceByIP(string $ip){

        $instances = $this->getInstances();

        $foundInstance = null;
        foreach($instances as $instance) {

            if (strcasecmp($instance->ip_address, $ip) == 0) {
                $foundInstance = $instance;
            }
        }
        return $foundInstance;
    }

    /**
     * Retrieves all instances
     *
     * @return bool|instance array
     */
    public function getInstances()
    {
        $instanceEndPoint = APIURL . INSTANCEPATH;
        $this->addAuthentication();
        $this->curl->get($instanceEndPoint, array());

        if ($this->curl->error) {
            return FALSE;
        }
            $instances = $this->curl->response;

            if ($instances == null) {
                return FALSE;
            }

            return $instances;

    }

    /**
     * Adds the authentication to the curl request
     */
    public function addAuthentication(){

        // adding the cookies
        foreach($this->cookies as $cookie){
            $this->curl->setCookie($cookie->name, $cookie->value);
        }

        // adding the authentication header
        $this->curl->setHeader("authorization", "bearer " . $this->token );
    }

    /**
     * Triggers the instance resize
     *
     * @param $instance instance object with the new parameter (cpu/ram/storage)
     *
     * @return bool|null resize result/resized parameter
     */
    public function resizeInstance($instance){

        $instanceResizeEndPoint = APIURL . INSTANCERESIZEPATH . "/" . $instance->instance_id;

        $this->addAuthentication();
        $this->curl->put($instanceResizeEndPoint, array("cpu" => $instance->cpu, "ram" => $instance->ram, "storage" => $instance->storage));

        if ($this->curl->error) {
            return FALSE;
        }

        $resizeResult = $this->curl->response;

        if ($resizeResult == null) {
            return FALSE;
        }

        return $resizeResult;
    }
}