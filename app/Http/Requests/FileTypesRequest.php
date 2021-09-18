<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileTypesRequest extends FormRequest
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
        return [
            'directory' => 'required|unique:file_types|max:255',
            'title' => 'required|unique:file_types|max:255',
            'extensions' => 'required',
            'max_file_size' => 'required',
        ]; 
    }
}
