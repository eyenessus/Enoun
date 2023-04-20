<?php

namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use stdClass;

interface UserEnounInterface
{
    public function getAllUser(): array;

    public function findOneUser(string $id): stdClass | null;

    public function deleteUser(string $id): void;

    public function createUser(CreateUserDTO $dto): stdClass | null;

    public function updateUser(string $id): stdClass | null;
    
    public function meusRegistros(): array;

    public function  finalizarPedido(string $data=null,int $id=null) : Collection;

    public function verPedidos();

    public function salvarCategoria(Request $request);

    public function valorFinal(): array;

    public function  criarIdentidade(Request $request);
   

    public function criarEndereco(Request $request);
    public function buscarItensCarrinho(): array;
}
