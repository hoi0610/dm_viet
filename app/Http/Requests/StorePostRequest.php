<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        return
            [
                'LoaiTin.required' =>'ban chua chon loai tin',
                'TieuDe.required'=>'ban chua nhap tieu de',
                'TomTat.required'=>'ban chua nhap tom tat',
                'TieuDe.min:3'=>'Ten tieu de phai co tu 3 den 100 ky tu',
                'Tieude.unique'=>'Ten tieu de bi trung',
                'NoiDung.required'=>'Ban phai nhap noi dung'
            ];
    }
}
