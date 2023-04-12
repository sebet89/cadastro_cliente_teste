<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ClienteRequest;

class ClienteService
{
    public function getAll()
    {
        return Cliente::all();
    }

    public function get($id)
    {
        return Cliente::find($id);
    }

    public function create(array $data)
    {
        $validator = Validator::make($data, (new ClienteRequest)->rules());

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $cliente = Cliente::create($data);
        return ['success' => true, 'cliente' => $cliente];
    }

    public function update($id, array $data)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return ['success' => false, 'errors' => 'Cliente não encontrado'];
        }

        $validator = Validator::make($data, (new ClienteRequest)->rules());

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $cliente->update($data);
        return ['success' => true, 'cliente' => $cliente];
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return ['success' => false, 'errors' => 'Cliente não encontrado'];
        }

        $cliente->delete();
        return ['success' => true];
    }
}
