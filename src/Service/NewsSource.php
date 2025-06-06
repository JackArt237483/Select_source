<?php
namespace Src\Service;

class NewsSource implements DataSourceInterface
{
    private string $apiKey;

    /**
     * Constructor
     *
     * @param string $apiKey API key for GNews API
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Fetch news articles from GNews API with pagination
     *
     * @param int $page 1-based page number
     * @return array ['data' => [...], 'total_pages' => int, 'error' => string|null]
     */
    public function fetchData(int $page): array
    {
        $maxPerPage = ITEMS_PER_PAGE;
        $start = ($page - 1) * $maxPerPage;

        // GNews API URL
        $url = sprintf(
            'https://gnews.io/api/v4/search?q=Apple&lang=en&country=us&max=%d&apikey=%s&start=%d',
            $maxPerPage,
            urlencode($this->apiKey),
            $start
        );

        // Use curl for better error handling and timeout
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
        if (!is_array($json) || !isset($json['articles'])) {
            return ['data' => [], 'total_pages' => 0, 'error' => 'Invalid response from News API'];
        }

        $articles = $json['articles'];

        // Map data to uniform format
        $data = array_map(fn($item) => [
            'title' => $item['title'] ?? 'No title',
            'description' => $item['description'] ?? 'No description',
            'url' => $item['url'] ?? '#'
        ], $articles);

        // GNews API does not provide total results count reliably, set static 10 pages max
        $totalPages = 10;

        return [
            'data' => $data,
            'total_pages' => $totalPages
        ];
    }
}
