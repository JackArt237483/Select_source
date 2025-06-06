<?php
namespace Src\Service;

require_once __DIR__ . '/DataSourceInterface.php';

class WeatherSourse implements DataSourceInterface {
    private string $apiKey;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function fetchData(int $page): array {
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid={$this->apiKey}&units=metric";
        $data = @file_get_contents($url);
        if (!$data) return ['data' => [], 'total_pages' => 0, 'error' => 'Weather API fetch failed'];

        $json = json_decode($data, true);
        if (!isset($json['weather'][0]['description'])) {
            return ['data' => [], 'total_pages' => 0, 'error' => 'Invalid weather data'];
        }

        return [
            'data' => [[
                'title' => $json['name'] ?? 'Unknown location',
                'description' => $json['weather'][0]['description'],
                'temp' => $json['main']['temp'] . '°C'
            ]],
            'total_pages' => 1
        ];
    }
}
