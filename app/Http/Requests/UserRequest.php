<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'nasab' => 'required',
            'email' => 'required|email|unique:users',
            'is_admin' => 'required',
            'password' => 'required_with:confirm_password|same:confirm_password|min:5',
            'confirm_password' => 'min:5'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Сабти ном ҳатми мебошад!',
            'name.min' => 'Ном на камтар аз 3 ҳарф бошад!',
            'nasab.required' => 'Сабти насаб ҳатми мебошад!',
            'email.required' => 'Почтаи элетронӣ ҳатмист!',
            'email.email' => 'Почтаро дар шакли зерин сабт намоед: yusuf@mfa.tj',
            'email.unique' => 'Чунин почта алакай сабт шудааст!',
            'is_admin.required'=> 'Гуруҳро интихоб намед!',
            'password.required_with' => 'Сабти рамз ҳатми мебошад!',
            'password.same' => 'Рамз нодуруст аст!',
            'password.min' => 'Рамз на камтар аз 5 симбвол бошад!',
            //'confirmpass.required_with' => 'Рамз нодуруст илова карда шуд!'

            ];
    }
}
