<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'identification',
        'address',
        'phone',
        'city_id',
        'boss_id'
    ];

    /**
     * ciudad de nacimiento
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * cargos que tiene el empleado
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employee_position');
    }

    /**
     * jefe inmediato
     */
    public function boss()
    {
        return $this->belongsTo(Employee::class, 'boss_id');
    }

    /**
     * empleados que dependen de este jefe
     */
    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'boss_id');
    }
}
