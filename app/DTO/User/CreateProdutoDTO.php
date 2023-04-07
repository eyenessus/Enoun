<?php 
namespace App\DTO\User;

use App\Http\Requests\CreateProdutoEnounService;

class createProdutoDto {
    public function __construct(
        public string $nome,
        public string $marca,
        public string $valor,
        public string $categoria_id,
        public int $codigo,
        public string $descricao,
        public string $imagem,
         
    ){}

    public static function makeFromRequest(CreateProdutoEnounService $request) : self
    {
        
        return new self(
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