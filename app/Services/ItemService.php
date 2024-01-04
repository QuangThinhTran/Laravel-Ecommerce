<?php

namespace App\Services;

class ItemService
{
    /**
     * Filter items of Items != null and return array_values
     * @param array|null $items
     * @return array|null
     */
    public function getArrayItems(?array $items): ?array
    {
        if (is_null($items))
        {
            return null;
        }
        $data = array_filter($items, function ($item) {
            return $item != null;
        });

        return array_values($data);
    }

    /**
     * Sum item of Items
     * @param array $items
     * @param int|null $result
     * @return integer $result
     */
    public function sumArrayItems(array $items, ?int $result = 0): int
    {
        foreach ($items as $item) {
            $result += $item;
        }
        return $result;
    }
}