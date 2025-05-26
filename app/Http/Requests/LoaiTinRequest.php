<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoaiTinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return User::findOrFail(Auth::user()->id)->hasRole('super-admin')||User::findOrFail(Auth::user()->id)->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "TenLoai"=>"required|min:4|max:24|regex:/^[\pL\s]+$/u",
            "AnHien"=>"required",
            "MoTa"=>"required|min:5"
        ];
    }
}
