<?php
namespace Src\Service;


class NewsSourse {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function fetchData($page) {
        $url = "https://newsapi.org/v2/everything?q=Apple&from=2025-06-03&sortBy=popularity&apiKey={$this->apiKey}&pageSize=" . ITEMS_PER_PAGE . "&page=" . $page;
        $response = @file_get_contents($url);

        if ($response === false) {
            return ['data' => [], 'total_pages' => 0];
        }

        $data = json_decode($response, true);
        if (!$data || !isset($data['articles'])) {
            return ['data' => [], 'total_pages' => 0];
        }

        return [
            'data' => $data['articles'],
            'total_pages' => ceil($data['totalResults'] / ITEMS_PER_PAGE)
        ];
    }
}
