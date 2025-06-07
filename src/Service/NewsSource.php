<?php
namespace Src\Service;

class NewsSource implements DataSourceInterface
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function fetchData(int $page): array
    {
        $maxPerPage = defined('ITEMS_PER_PAGE') ? ITEMS_PER_PAGE : 10;
        $start = ($page - 1) * $maxPerPage;

        $url = sprintf(
            'https://gnews.io/api/v4/search?q=Apple&lang=en&country=us&max=%d&apikey=%s&start=%d',
            $maxPerPage,
            urlencode($this->apiKey),
            $start
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return ['data' => [], 'total_pages' => 0, 'error' => 'Failed to fetch data from News API'];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return ['data' => [], 'total_pages' => 0, 'error' => 'News API returned HTTP ' . $httpCode];
        }

        $json = json_decode($response, true);
        if (!isset($json['articles']) || !is_array($json['articles'])) {
            return ['data' => [], 'total_pages' => 0, 'error' => 'Invalid response from News API'];
        }

        $data = array_map(fn($item) => [
            'title' => $item['title'] ?? 'No title',
            'description' => $item['description'] ?? 'No description',
            'url' => $item['url'] ?? '#'
        ], $json['articles']);

        return [
            'data' => $data,
            'total_pages' => 10
        ];
    }
}
