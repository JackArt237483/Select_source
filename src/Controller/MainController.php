<?php
namespace Src\Controller;

use Src\Service\NewsSource;
use Src\Service\WeatherSource;

class ApiController {
    public function fetch(string $source, int $page): array {
        switch ($source) {
            case 'news':
                $service = new NewsSource(NEWS_API_KEY);
                break;
            case 'weather':
                $service = new WeatherSource(WEATHER_API_KEY);
                break;
            default:
                return ['error' => 'Invalid data source'];
        }

        return $service->fetchData($page);
    }

}
