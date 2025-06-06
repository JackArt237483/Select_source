<?php
namespace Src\Controller;

use Src\Service\NewsSourse;
use Src\Service\WeatherSourse;


class MainController {
    public function fetch(string $source, int $page): array {
        switch ($source) {
            case 'news':
                $service = new NewsSourse(NEWS_API_KEY);
                break;
            case 'weather':
                $service = new WeatherSourse(WEATHER_API_KEY);
                break;
            default:
                return ['error' => 'Invalid data source'];
        }

        return $service->fetchData($page);
    }

}
