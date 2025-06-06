<?php
namespace Src\Service;

/**
 * Interface for data sources to ensure consistent behavior
 */
interface DataSourceInterface {
    /**
     * Fetches data from the source for the given page
     * @param int $page Page number
     * @return array Data and pagination info
     */
    public function fetchData(int $page): array;
}
