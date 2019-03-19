<?php
/**
 * Created by PhpStorm.
 * User: vedran
 * Date: 18/03/2019
 * Time: 14:40
 */

namespace App\External;


use GuzzleHttp\Client;

class MailchimpApi
{
    public $apiEndpoint;

    public $server;

    const STATUS_SUBSCRIBED = 'subscribed';

    public function __construct()
    {
        $this->server = config('services.mailchimp.server');
        $this->apiEndpoint = config('services.mailchimp.endpoint');
    }

    function subscribe($list_id, $email, $api_key)
    {
        $apiendpoint = sprintf($this->apiEndpoint, $this->server, $list_id);

        $json_data = [
            'email_address' => $email,
            'status' => self::STATUS_SUBSCRIBED,
        ];

        $ch = curl_init($apiendpoint);

        $auth = base64_encode('user:' . $api_key);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . $auth));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_data));

        $result = curl_exec($ch);

        $decoded_data = json_decode($result);

        if (isset($decoded_data->id)) {
            return json_encode(['id' => $decoded_data->id]);
        } else {
            return json_encode(['error' => $decoded_data->title]);
        }
    }

}