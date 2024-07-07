<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(User::whereHas('UserRoles',function($qry){
          return $qry->whereHas('Role',function($qry){
            return $qry->where('name','user_module');
          });
        })->find(auth()->id()))
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email"=>'required|email|unique:users',
            "name"=>'required',
            "password"=>'required',
            'dob'=>'required|date_format:Y-m-d'
        ];
    }
}
