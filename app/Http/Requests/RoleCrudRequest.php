<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Backpack\PermissionManager\app\Http\Requests\RoleCrudRequest as BackpackRoleCrudRequest;

class RoleCrudRequest extends BackpackRoleCrudRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255|unique:roles',
        ];

        return $rules;
    }
}
