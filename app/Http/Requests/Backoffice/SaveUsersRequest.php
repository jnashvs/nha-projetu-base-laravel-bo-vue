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
        $rules = [
            'name' => ['required'],
            'email' => 'required|unique:users,email,'. $this->request->get('id'),
        ];
        
        $rules['password'] = $this->request->get('id') ? 'nullable|required_with:password_confirmation|string|confirmed': 'required_with:password_confirmation|string|confirmed';

        return $rules;
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
