<?php

if (!function_exists('pluck_bulk_items')) {
    function pluck_bulk_items(array $array): array
    {
        return collect($array)->filter(fn($item) => $item)->keys()->toArray();
    }
}