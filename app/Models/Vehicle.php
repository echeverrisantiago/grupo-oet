<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vehicle extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'sys_vehicles';
    public $timestamps = true;

    protected $fillable = [
        'plate',
        'brand',
        'color',
        'type',
        'owner_id',
        'driver_id'
    ];
    
    /**
     * owner
     *
     * @return void
     */
    public function owner() {
        return $this->belongsTo(Worker::class, 'owner_id');
    }
    
    /**
     * driver
     *
     * @return void
     */
    public function driver() {
        return $this->belongsTo(Worker::class, 'driver_id');
    }

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
