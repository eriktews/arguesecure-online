<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TreeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'title' => 'required|max:255|unique:trees,title'.( (isset($this->tree) && $this->tree->id) ? ','.$this->tree->id : ''),
        ];
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
