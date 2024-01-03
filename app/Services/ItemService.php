<?php

namespace App\Services;

class ItemService
{
    /**
     * Filter items of Items != null and return array_values
     * @param array $items
     * @return array
     * */
    public function getArrayItems(array $items): array
    {
        $data = array_filter($items, function ($item) {
            return $item != null;
        });

        return array_values($data);
    }

    /**
     * Sum item of Items
     * @param array $items
     * @param int $result
     * @return integer $result
     */
    public function countArrayItems(array $items, int $result = 0): int
    {
        foreach ($items as $item) {
            $result += $item;
        }
        return $result;
    }
}