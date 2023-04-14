<?php

namespace App\Http\Requests;

use App\Models\Produto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProdutoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        
        return [
            'nome' => 'required',
            'marca'=> 'required',
            'valor' => 'required',
            'categoria_id' => 'required',
            'codigo' => ['required', Rule::unique('produtos')->ignore($this->id)],
            'descricao' => ['required'],
            'imagem' => ['required','Image'],
        ];
    }
}
