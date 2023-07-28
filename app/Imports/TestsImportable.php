<?php

namespace App\Imports;

use Illuminate\Support\Collection;

abstract class TestsImportable
{
    protected ?int $category_id = null;

    public function setCategory(?int $category_id)
    {
        $this->category_id = $category_id;
    }

    public function serializeAnswers(Collection $row)
    {
        return $row->map(fn($value, $key) => ['id' => $key + 1, 'answer' => $value]);
    }

    public function shuffleAndSerializeAnswers(Collection $row)
    {
        $row = $row->shuffle();

        return $this->serializeAnswers($row);
    }

}