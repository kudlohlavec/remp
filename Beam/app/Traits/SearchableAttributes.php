<?php

namespace App\Traits;

trait SearchableAttributes
{
    public function getSearchableAttributes(array $searchable, string $keyName, array $attributes): array
    {
        $indexable = $searchable;
        array_push($indexable, $keyName);

        return array_filter($attributes, function ($key) use ($indexable) {
            return in_array($key, $indexable);
        }, ARRAY_FILTER_USE_KEY);
    }
}
