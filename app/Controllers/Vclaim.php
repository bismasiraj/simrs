<?php

namespace App\Controllers;

class Vclaim extends \App\Controllers\BaseController
{
    public function getFaskes($search_term)
    {
        $url = $this->baseurlvclaim . "/referensi/faskes/$search_term/2";
        $method = 'GET';

        $postdata = '';

        unset($result);
        $headers = $this->AuthBridging('vclaim');
        // return json_encode($postdata);
        array_push($headers, "Content-length: " . strlen($postdata));
        return $this->sendVclaim($url, $method, $postdata);
    }
}
