<?php
namespace Src\Service;

interface DataSourceInterface {
    public function fetchData(int $page): array;
}
