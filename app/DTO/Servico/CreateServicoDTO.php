<?php
namespace App\DTO\Servico;

use App\Http\Requests\CreateServicoEnounRequest;

class CreateServicoDTO {
    public function __construct(
        public string $nome,
        public string $codigo,
        public string $valor,
        public string $imagem,
        public string $descricao,
        public string $categoria_id,
        public int $user_id,
    ){}

    public static function makeRequest(CreateServicoEnounRequest $request): self
    {
        return new self(
           
            $request->nome,
            $request->codigo,
            $request->valor,
            $request->imagem,
            $request->descricao,
            $request->categoria_id,
            $request->user_id  ?? 0
        );
    }

}