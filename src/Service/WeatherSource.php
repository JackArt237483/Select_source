<?php
namespace Src\Service;

class WeatherSource implements DataSourceInterface
{
    private string $apiKey;

    /**
     * Constructor
     *
     * @param string $apiKey API key for OpenWeatherMap
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Fetch current weather data (pagination ignored since only one data point)
     *
     * @param int $page Ignored
     * @return array ['data' => [...], 'total_pages' => 1, 'error' => string|null]
     */
    public function fetchData(int $page): array
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid=" .
            urlencode($this->apiKey) . "&units=metric";

        // Use curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return ['data' => [], 'total_pages' => 0, 'error' => 'Failed to fetch data from Weather API'];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return ['data' => [], 'total_pages' => 0, 'error' => 'Weather API returned HTTP ' . $httpCode];
        }

        $json = json_decode($response, true);

        if (!isset($json['weather'][0]['description'], $json['main']['temp'], $json['name'])) {
            return ['data' => [], 'total_pages' => 0, 'error' => 'Invalid weather data received'];
        }

        return [
            'data' => [[
                'title' => $json['name'],
                'description' => $json['weather'][0]['description'],
                'temp' => $json['main']['temp'] . '°C'
            ]],
            'total_pages' => 1
        ];
    }
}
