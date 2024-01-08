<?php

namespace App\Services;

class ItemService
{
    /**
     * Filter items of the input array removing null values and re-index the resulting array
     * @param array|null $items The input array that may contain null values
     * @return array|null The filtered array without null values or null if the input is null
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
     * Calculate the sum of integers in the input array
     * @param array $items An array of integers to sum
     * @param int|null $result The initial value for the sum (defaults to 0 if not provided)
     * @return int The sum of the integers in the array
     */
    public function sumArrayItems(array $items, ?int $result = 0): int
    {
        foreach ($items as $item) {
            $result += $item;
        }
        return $result;
    }
}