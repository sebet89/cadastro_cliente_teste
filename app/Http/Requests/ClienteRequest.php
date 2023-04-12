<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'cpf' => 'required|size:11',
            'nome' => 'required|max:255',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|size:1',
            'endereco' => 'required|max:255',
            'estado' => 'required|size:2',
            'cidade' => 'required|max:255',
        ];

        if ($this->isMethod('post')) {
            $rules['cpf'] .= '|unique:clientes,cpf';
        } elseif ($this->isMethod('put')) {
            $rules['cpf'] .= '|unique:clientes,cpf,' . $this->cliente;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter exatamente 11 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.max' => 'O Nome deve ter no máximo 255 caracteres.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
            'sexo.required' => 'O campo Sexo é obrigatório.',
            'sexo.size' => 'O campo Sexo deve ter exatamente 1 caractere.',
            'endereco.required' => 'O campo Endereço é obrigatório.',
            'endereco.max' => 'O Endereço deve ter no máximo 255 caracteres.',
            'estado.required' => 'O campo Estado é obrigatório.',
            'estado.size' => 'O campo Estado deve ter exatamente 2 caracteres.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'cidade.max' => 'A Cidade deve ter no máximo 255 caracteres.',
        ];
    }
}
