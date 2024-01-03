<?php

namespace App\Services;

class ItemService
{
    public function getArrayItems(array $items): array
    {
        $data = array_filter($items, function ($item) {
            return $item != null;
        });

        return array_values($data);
    }

    public function countArrayItems(array $items, $result = 0)
    {
        foreach ($items as $item) {
            $result += $item;
        }
        return $result;
    }
}