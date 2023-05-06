<?php
namespace App\DTO\User;

use Illuminate\Http\Request;

class UpdateUserDTO
{
    public function __construct(
        public int $id,
        public string $nome,
        public string $sobrenome,
        public string $email,
        public string $password,
        public string $imagemPerfil,
    ) {
    }

    public static function makeRequest(Request $request): self
    {
        return new self(
            $request->id,
            $request->nome,
            $request->sobrenome,
            $request->email,
            $request->password,
            $request->imagemPerfil
        );
    }
}
