<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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


            if ($this->route()->getName() == 'slider.store'){
                $image = 'required';
            } else{
                $image = 'nullable';
            }

        return [
            'country'     => "required|numeric|min:1|max:260" ,
            'title'       => 'required|string|min:2|max:50',
            'description' => 'required|string|min:2|max:256',
            'image'       =>  $image . "|image|max:3072"
        ];
    }
}
