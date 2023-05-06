<?php
namespace App\Repositories\Enoun;

use App\Models\Produto;
use App\Models\Servico;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class EnounEloquentORM implements EnounInterface{
    public function __construct(
    protected Slide $modelSlide,
    protected Servico $modelServico,
    protected Produto $modelProduto,
    )
    {}
    public function buscar(string $search) : Collection
    {
        $produtos = $this->modelProduto->where('nome','like','%'. $search. '%')->get();
        $servicos = $this->modelServico->where('nome','like','%'. $search. '%')->get();
        return collect(['produtos'=>collect($produtos),'servicos'=>$servicos]);
    }
    public function slides() : Collection
    {
        $slides = $this->modelSlide->all();
        return collect($slides);
    }
}