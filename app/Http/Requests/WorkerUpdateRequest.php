<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class WorkerUpdateRequest extends FormRequest
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
            'identification' => 'nullable|unique:sys_workers,identification,'.$this->route->parameters('worker')['worker']->id.'|integer',
            'first_name' => 'nullable|string|max:45',
            'second_name' => 'nullable|string|max:45',
            'last_name' => 'nullable|string|max:45',
            'address' => 'nullable|string|max:255',
            'telephone' => 'nullable|integer',
            'city' => 'nullable|string|max:45',
        ];
    }
}
