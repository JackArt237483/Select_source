<?php

namespace Src\Controller;

use Exception;
use Src\Service\NewsSourse;
use Src\Service\WeatherSourse;

class MainController {
    private $apiKey;

    public function __construct(array $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function index($sourceKey, $page, $fetch) {
        $sources = ['weather' => 'Weather API', 'news' => 'News API'];
        $results = ['data' => [], 'total_pages' => 0, 'renderItems' => []];
        $source = $sourceKey;

        if ($fetch && isset($sources[$sourceKey])) {
            try {
                switch ($sourceKey) {
                    case 'weather':
                        $service = new WeatherSourse($this->apiKey['weather']);
                        break;
                    case 'news':
                        $service = new NewsSourse($this->apiKey['news']);
                        break;
                }

                $results = $service->fetchData($page);

                $results['renderItems'] = array_map(function ($item) use ($sourceKey) {
                    return $sourceKey === 'news'
                        ? ($item['title'] ?? 'No title')
                        : ($item['weather'][0]['description'] ?? 'No description');
                }, $results['data']);
            } catch (Exception $e) {
                error_log('Error in MainController: ' . $e->getMessage());
            }
        }

        require_once __DIR__ . '../../View/layout.php';
    }
}
