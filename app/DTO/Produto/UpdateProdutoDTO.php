<?php
namespace App\DTO\Produto;

use App\Http\Requests\UpdateProdutoRequest;

class UpdateProdutoDTO
{
    public function __construct(
        public string $id,
        public string $nome,
        public string $marca,
        public string $valor,
        public string $categoria_id,
        public int $codigo,
        public string $descricao,
        public string $imagem,
    ){}

    public static function makeFromRequest(UpdateProdutoRequest $request) : self
    {
        
        return new self(
            $request->id,
            $request->nome , 
            $request->marca , 
            $request->valor , 
            $request->categoria_id , 
            $request->codigo , 
            $request->descricao ,
            $request->file('imagem'), 
        );
    }
}