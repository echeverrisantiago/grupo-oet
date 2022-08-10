<?php

namespace App\Http\Requests;

use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;

class VehicleUpdateRequest extends FormRequest
{
    protected $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'plate' => 'nullable|unique:sys_vehicles,plate,'.$this->route->parameters('vehicle')['vehicle']->id.'|string',
            'brand' => 'nullable|string|max:45',
            'color' => 'nullable|string|max:20',
            'type' => 'nullable|integer',
            'owner_id' => 'nullable|integer',
            'driver_id' => 'nullable|integer'
        ];
    }
}
