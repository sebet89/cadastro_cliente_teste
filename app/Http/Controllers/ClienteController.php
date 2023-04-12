<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = $this->clienteService->getAll();
        return response()->json($clientes);
    }

    public function store(ClienteRequest $request)
    {
        $result = $this->clienteService->create($request->validated());

        if ($result['success']) {
            return response()->json($result['cliente'], 201);
        } else {
            return response()->json(['error' => $result['errors']], 400);
        }
    }

    public function show($id)
    {
        $cliente = $this->clienteService->get($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }

    public function update(ClienteRequest $request, $id)
    {
        $result = $this->clienteService->update($id, $request->validated());

        if ($result['success']) {
            return response()->json($result['cliente'], 200);
        } else {
            return response()->json(['error' => $result['errors']], 400);
        }
    }

    public function destroy($id)
    {
        $result = $this->clienteService->delete($id);

        if ($result['success']) {
            return response()->json(null, 204);
        } else {
            return response()->json(['error' => $result['errors']], 404);
        }
    }
}
