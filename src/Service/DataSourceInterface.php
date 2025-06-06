<?php
namespace Src\Service;

interface DataSourceInterface
{
    /**
     * Fetch data from the source with pagination
     *
     * @param int $page Page number (1-based)
     * @return array Result with keys: 'data' (array), 'total_pages' (int), 'error' (optional string)
     */
    public function fetchData(int $page): array;
}
