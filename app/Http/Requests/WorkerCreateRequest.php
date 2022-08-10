<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class WorkerCreateRequest extends FormRequest
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
            'identification' => 'required|unique:sys_workers|integer',
            'first_name' => 'required|string|max:45',
            'second_name' => 'nullable|string|max:45',
            'last_name' => 'required|string|max:45',
            'address' => 'required|string|max:255',
            'telephone' => 'required|integer',
            'city' => 'required|string|max:45',
        ];
    }
}
