<?php

namespace App\Models;

use App\Enums\AnswerType;
use Brackets\AdminUI\Traits\HasWysiwygMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasWysiwygMediaTrait, HasFactory;

    protected $hidden = ['explanation'];

    protected $fillable = [
        'answers_id',
        'answers_type',
        'body',
        'status',
        'category_id',
        'explanation'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(TestCategory::class, 'category_id');
    }

    public function answers()
    {
        return $this->morphTo();
    }

    protected $appends = ['resource_url', 'answer_type'];

    public function getResourceUrlAttribute()
    {
        return url('/admin/tests/' . $this->getKey());
    }

    public function getAnswerTypeAttribute()
    {
        return AnswerType::TYPES[$this->answers_type];
    }

    public function hideCorrectAnswers()
    {
        $this->answers->hideCorrectAnswer();

        return $this;
    }

    public function shuffleAnswers()
    {
        $this->answers->shuffleAnswers();

        return $this;
    }

    public function scopeAvailable($query)
    {
        $query->where('status', true);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['answers_type']))
            $query->where('answers_type', $filters['answers_type']);

        if (isset($filters['category']))
            $query->where('category_id', (int)$filters['category']);

        if (isset($filters['status']))
            $query->where('status', (bool)$filters['status']);

    }

}
