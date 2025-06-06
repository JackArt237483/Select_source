<?php
namespace Src\Controller;

use Src\Service\NewsSource;
use Src\Service\WeatherSource;

require_once __DIR__ . '/../Service/NewsSource.php';
require_once __DIR__ . '/../Service/WeatherSource.php';

class MainController
{
    /**
     * Fetch data from selected source and page number
     *
     * @param string $source Data source identifier ('news' or 'weather')
     * @param int $page Page number, 1-based
     * @return array Data with keys: data[], total_pages, error (optional)
     */
    public function fetch(string $source, int $page): array
    {
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
