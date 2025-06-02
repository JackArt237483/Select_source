<?php

class NewsSourse {
    private $apiKey;
    public function __construct($apiKey){
        $this->apiKey = $apiKey;
    }
    public function fetchData($page){
        $url = 'https://newsapi.org/v2/everything?q=keyword&apiKey={$this->apiKey}&pageSize=10&page='.$page . ITEMS_PER_PAGE;
        $responce = @file_get_contents($url);
        
        if($responce === false){
            return ['data' => [],'total_pages' => 0];
        }

        $data = json_encode($responce, true);
        if( !$data || !isset($data['articles'])){
            return ['data' => [],'total_pages' => 0];
        }

        return [
            'data' => $data['articles'],
            'total_pages' => ceil($data['totalResults'] )
        ];
    }
}
