<?php
namespace Src\Service;



class WeatherSourse {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function fetchData($page) {
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid={$this->apiKey}&cnt=" . ITEMS_PER_PAGE;
        $response = @file_get_contents($url);

        if ($response === false) {
            return ['data' => [], 'total_pages' => 0];
        }

        $data = json_decode($response, true);
        if (!$data || !isset($data['list'])) {
            return ['data' => [], 'total_pages' => 0];
        }

        return [
            'data' => $data['list'],
            'total_pages' => 1
        ];
    }
}
