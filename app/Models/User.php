<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;

class User extends Authenticatable implements LdapAuthenticatable
{
    use Notifiable, HasFactory, AuthenticatesWithLdap;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password'];

    protected $guarded = [];

    protected $appends = ['resource_url'];

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function attempts()
    {
        return $this->hasMany(ExamUserAttempt::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/users/' . $this->getKey());
    }

    public static function positions()
    {
        return DB::table('users')
            ->distinct()
            ->whereNotNull('position')
            ->get('position')
            ->pluck('position');
    }

    public static function departments()
    {
        return DB::table('users')
            ->distinct()
            ->whereNotNull('department')
            ->get('department')
            ->pluck('department');
    }

    public static function organisations()
    {
        return DB::table('users')
            ->distinct()
            ->whereNotNull('organisation')
            ->get('organisation')
            ->pluck('organisation');
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['position']))
            $query->where('position', $filters['position']);

        if (isset($filters['department']))
            $query->where('department', $filters['department']);

        if (isset($filters['organisation']))
            $query->where('organisation', $filters['organisation']);

    }
}
