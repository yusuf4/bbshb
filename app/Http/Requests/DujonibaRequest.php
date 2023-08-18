<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DujonibaRequest extends FormRequest
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
            'name' => 'required|min:5',
            'shartnoma_file.*' => 'required|mimes:jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx',
            'jonibi_tj' => 'required',
            'jonibi_digar' => 'required',
            'namud' => 'required',
            'tartib' => 'required',
            //'files_scan.*' => 'mimes:jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx',
            'muhlat' => 'required',
            //'vakolat.*' => 'mimes:jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Иловаи номи шартнома ҳатмист!',
            'name.min' => 'Номи шартнома на камтар аз 5 рамз бошад!',
            'shartnoma_file.*.required' => 'Шаклии электронии шартномаро замима намоед: !',
            'shartnoma_file.*.mimes' => 'Файл бояд фармати зерин бошад: jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx',
            'jonibi_tj.required' => 'Иловаи ҷонибҳо ҳатмист!',
            'jonibi_digar.required' => 'Иловаи ҷонибҳо ҳатмист!',
            'namud.required' => 'Намуди шартномаро интихоб намоед!',
            'tartib.required' => 'Тартиби пайдо намудани эътибор ҳатмист!',
            //'files_scan.*.mimes' => 'Файл :attribute бояд фармати зерин бошад: jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx',
            'muhlat.required' => 'Муҳлати эътибори шартнома ҳатмист!',
            //'vakolat.mimes' => 'Файл бояд фармати зерин бошад: jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx'
        ];
    }
}
