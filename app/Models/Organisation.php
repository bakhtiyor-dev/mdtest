<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
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
        return url('/admin/organisations/' . $this->getKey());
    }
}
