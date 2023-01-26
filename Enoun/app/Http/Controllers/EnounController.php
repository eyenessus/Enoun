<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\Inicio;
use App\Models\Contato;
use App\Models\Slide;
use PHPUnit\Framework\Error\Notice;

class EnounController extends Controller
{
    public function index(){
        //pagina inicial
        $slides = Slide::all();
        $inforday = Inicio::all();
        return view('Inicio.inicio',
        ['inicio' => $inforday,'slides' => $inforday]
    );
    }

    public function Login(){

       return view('Login.login'); 
    }

    public function create()
    {
        return view('Cadastro.cadastro');
    }

    public function Contato(){

        return view('Contato.contato');
    }

    public function Servicos(){

        $services =  Servico::all();
    
        return view('Servicos.servicos',['serv'=>$services]);
    }

    public function Buscar(){
        $busca = request('pesquisa');
        if($busca){
            $servicosBusca = Servico::where([['nome', 'like', '%' . $busca . '%']])->get();
        }
        else{
            $servicosBusca = Servico::all();
        }
        return view('Busca.search',['idbusca'=>$busca, 'services'=>$servicosBusca]);
    }
 
    public function store(Request $requisicao){

        Usuario::create($requisicao->all());
        return redirect('/')->with('mensagem', 'Cadastrado com sucesso!');
    }

    public function RService(){

        return view('Registro.service');
    }

    public function RNoti(){

        return view('Registro.noticiasini');
    }
    public function SaveNoticia(Request $request){

        $noticias = new Inicio;
        $noticias->titulo = $request->titulo;
        $noticias->descricao = $request->descricao;
        //imagem
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicnoticias'), $nomeImagem);
            $noticias->imagem = $nomeImagem;
        }
        $noticias->save();

        return redirect('/');
    }
    public function SaveService(Request $request){
        $service = new Servico;
        $service->nome = $request->nome;
        $service->descricao = $request->descricao;
        $service->categoria = $request->categoria;
        $service->codigo = $request->codigo;
        $service->inforextra = $request->inforextra;

        //imagem
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requisaoImagem = $request->imagem;
            $extensao = $requisaoImagem->extension();
            $nomeImagem = md5($requisaoImagem->getClientOriginalName() . strtotime("now") . $extensao);
            $requisaoImagem->move(public_path('img/publicserivces'), $nomeImagem);
            $service->imagem = $nomeImagem;
        }


        $usuarioLogado = auth()->user(); //usuario logado

        $service->user_id = $usuarioLogado->id; //atribuindo o id do usuario logado no data base


          $service->save();

      

        return redirect('/');
    }

        public function show($id){
            $servico = Servico::findOrFail($id); //filtro de registros


        $donoDoServico = User::where('id', $servico->user_id)->first()->toArray();

    

      
        return view('Servicos.resultado',['resultadoId'=>$servico, 'donoDoServico'=>$donoDoServico]);
        }


        public function showNoticias($id){
            $resultado = Inicio::findOrFail($id);
            return view('Inicio.resultado',['resultadoNoticia'=>$resultado]);
        }

        public function MessContats(Request $request){
            $contatos = new Contato();
            $contatos->usuario = $request->usuario;
            $contatos->mensagem = $request->mensagem;
            $contatos->save();        
            return redirect('/')->with('contato','Mensagem enviada com sucesso!');
        }

        public function Dash(){
        $usuarioLogado = auth()->user();

        $servico = $usuarioLogado->servicos;



        return view('dashboard', ['servico' => $servico]);
        }
}
