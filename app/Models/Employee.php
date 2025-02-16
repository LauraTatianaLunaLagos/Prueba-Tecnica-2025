<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'identification', 'address',
        'phone', 'country', 'city', 'boss_id'
    ];

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employee_position');
    }

    public function boss()
    {
        return $this->belongsTo(Employee::class, 'boss_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'boss_id');
    }
}

