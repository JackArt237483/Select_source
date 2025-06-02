<?php

namespace Src\Controller;
use NewsSourse;
use WeatherSourse;

use mysql_xdevapi\Exception;

class MainControler {
    private $ApiKey;
    public function __construct($apiKey) {
        $this->ApiKey = $apiKey;
    }
    // Method for source
    public function index($source,$page,$fetch) {
        $source = [ 'weather' => 'WEATHER API','news' => 'NEWS KEY'];
        $result = [ 'data' => [], 'total_pages' => 0];

        if($fetch){
            try {
                switch ($source){
                    case 'weather';
                        $service = new NewsSourse(WEATHER_API_KEY);
                        $result = $service->fetchData($page);
                    break;
                    case 'news';
                        $service = new WeatherSourse(NEWS_API_KEY);
                        $result = $service->fetchData($page);
                    break;
                }
            } catch (Exception $e){
                'Error in MainControler'. $e->getMessage();
            }
        }

        include_once  __DIR__ . '\views\index.php';
    }
}
