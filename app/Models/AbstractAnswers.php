<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class AbstractAnswers extends Model
{
    protected $guarded = [];

    public abstract static function check($test);

    public abstract static function getImportable();

    public abstract static function getExportable();

    public abstract function hideCorrectAnswer();

    public function shuffleAnswers()
    {
        $this->attributes['answers'] = json_encode(Arr::shuffle($this->answers));
    }
}