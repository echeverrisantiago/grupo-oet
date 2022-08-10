<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Worker extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'sys_workers';
    public $timestamps = true;

    protected $fillable = [
        'identification',
        'first_name',
        'second_name',
        'last_name',
        'address',
        'telephone',
        'city'
    ];

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     * @param string|null $field
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = 'id')
    {
        return parent::resolveRouteBinding($value, $field);
    }
}
