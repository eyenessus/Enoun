<?php
namespace App\DTO\Servico;

use App\Http\Requests\Servico\UpdateServicoRequest;
use Illuminate\Http\Request;

class  UpdateServicoDTO
{
    public function __construct(
        public string $id,
        public string $categoria_id,
        public string $nome,
        public string $descricao,
        public string $valor,
        public string $codigo,
        public string $imagem,
    ){}
    public static function makeRequest(UpdateServicoRequest $request):self
    {
        return new self(
            $request->id,
            $request->categoria_id,
            $request->nome,
            $request->descricao,
            $request->valor,
            $request->codigo,
            $request->file('imagem'),
        );
    }
}
