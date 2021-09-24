<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class SaveFileTypeRequest extends FormRequest
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
            //'directory' => 'required|unique:file_types|max:255',
            'directory' => 'required|unique:file_types,directory,'.$this->request->get('id'),
            'title' => 'required|max:255',
            'extensions' => 'required',
            'max_file_size' => 'required',
        ]; 
    }

    public function attributes()
    {
        return [
            'directory' => 'Directoria',
            'title' => 'Título',
            'extensions' => 'Extensões',
            'max_file_size' => 'Tamanho Máximo'
        ];
    }
}
