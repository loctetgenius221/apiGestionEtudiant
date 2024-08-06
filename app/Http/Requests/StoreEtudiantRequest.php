<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEtudiantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "prenom" => ["required", "string", "max:255"],
            "nom" => ["required", "string", "max:255"],
            "adresse" => ["required", "string", "max:255"],
            "telephone" => ["required", "integer", "unique:etudiants,telephone"],
            "date_de_naissance" => ["required", "date", "before:today"],
            "matricule" => ["required", "string", "unique:etudiants,matricule"],
            "email" => ["required", "string", "email", "max:255", "unique:etudiants,email"],
            "mot_de_pass" => ["nullable", "string", "min:8"],
            "photo" => ["nullable", "image", "mimes:jpeg,png,jpg,gif", "max:2048"]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ['success' => false, 'errors' => $validator->errors()],
            422
        ));
    }

}
