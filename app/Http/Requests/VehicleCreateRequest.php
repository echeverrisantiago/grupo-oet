<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class VehicleCreateRequest extends FormRequest
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
            'plate' => 'required|unique:sys_vehicles|string',
            'brand' => 'required|string|max:45',
            'color' => 'required|string|max:20',
            'type' => 'required|integer',
            'owner_id' => 'required|integer',
            'driver_id' => 'required|integer'
        ];
    }
}
