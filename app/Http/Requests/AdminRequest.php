<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        if (request()->route()->getName() == 'admins.store')
        {
            return [

                'first_name' => 'required|string|min:2|max:32',
                'last_name'  => 'required|string|min:2|max:32',
                'middle_name'  => 'nullable|string|min:2|max:32',
                'email'      => 'required|email|unique:admins',
                'state'      => 'required',
                'city'       => 'required',
                'country'    => 'required',
                'additional' => 'nullable|min:2|max:255',
                'avatar'       => 'nullable|image|max:2048|mimes:png,jpeg'
            ];
        } elseif(request()->route()->getName() == 'admins.update') {

            return [
                'first_name' => 'required|string|min:2|max:32',
                'last_name'  => 'required|string|min:2|max:32',
                'middle_name'  => 'nullable|string|min:2|max:32',
                'email'      => 'required|email|unique:admins,email,'.request()->route()->parameter('admin'),
                'additional' => 'nullable|min:2|max:255',
                'avatar'       => 'nullable|image|max:2048|mimes:png,jpeg'
            ];
        } else {
            return [];
        }
    }
}
