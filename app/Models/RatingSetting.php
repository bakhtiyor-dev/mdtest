<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'settings',
    ];

    protected $casts = [
        'settings' => 'object'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/rating-settings/' . $this->getKey());
    }
}
