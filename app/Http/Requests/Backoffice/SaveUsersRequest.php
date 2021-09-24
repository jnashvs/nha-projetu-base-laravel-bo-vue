<?php namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class SaveUsersRequest extends FormRequest
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

    // protected function prepareForValidation()
    // {
    //     if($this->request->get('update_password') != '1' ) {
    //         $this->request->remove('new_password');
    //     }
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            //'email' => ['required', 'email', 'unique:users,email,'.$this->request->get('id')],
            'email' => 'required|unique:users,email,'.$this->request->get('id'),
            'password' => ['sometimes', 'required', 'min:6', 'confirmed'],
            'password_confirmation' => ['sometimes' ,'required', 'min:6']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'E-mail',
            'password' => 'Palavra-passe',
            'password_confirmation' => 'Confirmação da Palavra-passe'
        ];
    }

}
