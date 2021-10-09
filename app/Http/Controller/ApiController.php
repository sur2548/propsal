<?php

namespace App\Http\Controller;

class ApiController
{
    public function index()
    {
        $data = [
            'firstname' => $_REQUEST['first_name'],
            'lastname' => $_REQUEST['last_name'],
        ];

        $response = json_decode($this->post($data));

        $hits = $response->hits->hits;
        $result = [];

        foreach ($hits as $hit) {
            $result[] = $hit->_source;
        }


        return json_encode($result);
    }

    protected function post($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://www.britisharmyancestors.co.uk:8080/v1/person',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Site: Interview'
            ),
        ));

        return curl_exec($curl);
    }
}