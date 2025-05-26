<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class nhaBaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return User::findOrFail(Auth::user()->id)->hasRole('journalist');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'TieuDe'=>'required|min:5',
            'thumbnail'=>'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'TomTat'=>'min:5',
            'NoiDung'=>'required|min:15',
            'idLT'=>'required'
        ];
    }
}
