<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedCategoriaRequest extends FormRequest
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
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúñÁÉÍÓÚ]+( [a-zA-ZáéíóúñÁÉÍÓÚ]+)*$/|max:20|unique:categorias,nombre,' . $this->route('categoria') . ',id_categoria',
            'descripcion' => 'required'
        ];
    }

    public function messages() {

        return [
            'nombre.required' => 'el campo nombre es requerido',
            'nombre.regex' => 'el campo nombre solo debe contener letras',
            'nombre.max' => 'el campo nombre debe contener un maximo de 20 caracteres',
            'nombre.unique' => 'ya existe una categoria con este nombre',
            'descripcion'   => 'el campo descripcion es requerido'
        ];
    }
}
