<?php
namespace MessageHttp;

use GuzzleHttp\Client as HttpClient;

class Client
{
    private $secret_key;
    private $api = [];
    private $host ;


    private $client = null;

    public function __construct(array $config)
    {
        $this->secret_key = $config['secret_key'];
        $this->api = $config['api'];
        $this->host = $config['host'];
        $this->init();
    }

    protected function init()
    {
        $this->client = new HttpClient;(['base_uri' =>$this->host]);
    }

    public function signature(array $parameter)
    {
        $sort_Arr = ksort($parameter);
        $sort_Arr_string = http_build_query($sort_Arr);
        return  md5($this->secret_key.$sort_Arr_string);
    }

    public function request(string $api_name , array $parameter = [])
    {
        $api_detail = $this->api[$api_name];
        $method = $api_detail[0];
        $path = $api_detail[1];

        $signature = $this->signature($parameter);

        $options = [
          'headers' => [
              'signature' => $signature,
          ],
          'body' =>   $parameter,
        ];
        $response = $this->client->request($method, $path,$options);
        $body = $response->getBody();
        return json_decode($body,true);
    }





}