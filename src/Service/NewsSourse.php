<?php
namespace Src\Service;

class NewsSourse {
    private string $apiKey;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function fetchData(int $page): array {
        $url = sprintf(
            'https://newsapi.org/v2/everything?q=Apple&sortBy=popularity&pageSize=%d&page=%d&apiKey=%s',
            ITEMS_PER_PAGE,
            $page,
            $this->apiKey
        );

        $data = @file_get_contents($url);
        if (!$data) return ['data' => [], 'total_pages' => 0, 'error' => 'News API fetch failed'];

        $json = json_decode($data, true);
        $articles = $json['articles'] ?? [];

        return [
            'data' => array_map(fn($item) => [
                'title' => $item['title'] ?? 'No title',
                'description' => $item['description'] ?? 'No description',
                'url' => $item['url'] ?? '#'
            ], $articles),
            'total_pages' => ceil(($json['totalResults'] ?? 0) / ITEMS_PER_PAGE)
        ];
    }
}
