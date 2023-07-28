<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function tests()
    {
        return $this->hasMany(Test::class, 'category_id');
    }

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/test-categories/' . $this->getKey());
    }
}
