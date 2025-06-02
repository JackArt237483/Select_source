<?php

class WeatherSourse {
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    public function fetchData($page){
            $url = "https://api.openweathermap.org/data/2.5/forecast?q=London&appid={$this->apiKey}&cnt=" . ITEMS_PER_PAGE;
            $responce = @file_get_contents($url);

            if($responce === false){
                return ['data' => [],'total_pages' => 0];
            }

            $data = json_encode($responce, true);
            if( !$data || !isset($data['list'])){
                return ['data' => [],'total_pages' => 0];
            }

            return [
                'data' => $data['list'],
                'total_pages' => 1
            ];
        }
}