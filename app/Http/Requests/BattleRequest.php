<?php

namespace App\Http\Requests;

use App\ExtraModels\Settings;

use Illuminate\Foundation\Http\FormRequest;

class BattleRequest extends FormRequest
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
        $settings = Settings::where('title', 'battle')->firstOrFail();
        $rounds_max= $settings->attributes['rounds_max'];
        $rounds_min= $settings->attributes['rounds_min'];
        return [
            'gap' => 'required|numeric',
            'rounds' => "required|numeric|min:$rounds_min|max:$rounds_max" ,
            'title' => 'required|string|min:2|max:50',
            'description' => 'required|string|min:2|max:256'
        ];
    }
}
