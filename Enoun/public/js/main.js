$(document).ready(()=>{
    //menu categorias
    const $menu = $('#menu');
    const $botaocategoria = $('#botaocategoria')

    $botaocategoria.on('click', ()=>{
        $menu.slideToggle('fast');
    })
    



    //fomrmulario login
    const $formulariologin = $('#formlogin');
    let $inputuser = $('#user');
    let $inputsenha = $('#senha');
   
    $formulariologin.submit(event =>{
        event.preventDefault(); 

        if($inputuser.val() === ""){
            alert('Preencha o campo de login')
            return;
        }
        
        if($inputsenha.val() === ""){
            alert('Preencha o campo de senha')
            return;
        }

     $('#formulariologin').submit();

    });


   
//formulario cadastro
    const $formCadastro = $('#formcadastro');
    let $inputNome = $('#nome');
    let $inputSnome = $('#snome');
    let $inputSenha = $('#senha');
    let $inputUser = $('#user');
    let $inputEndereco = $('#endereco');
    let $inputCidade = $('#cidade');
    let $inputCep = $('#cep');
    let $estado = $('#estado');
    let $numer = $('#numero');
    

    $formCadastro.submit(event =>{
        event.preventDefault();
        const $array = [
            $inputNome,
            $inputSnome,
            $inputSenha,
            $inputUser,
            $inputEndereco,
            $inputCidade,
            $inputCep,
            $estado,
            $numero
        ];
        
        for(let i=0; i<$array.length; i++){
            if(!$array[i].val()){
                alert("Preencha todos os campos por favor.");
                return
            }
        }
       

    })


   
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $inputEndereco.val("");
        $inputCidade.val("");
        $estado.val("");
    }
    
    //Quando o campo cep perde o foco.
    $inputCep.blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $inputEndereco.val("...");
               
                $inputCidade.val("...");
                $estado.val("...");
               

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $inputEndereco.val(dados.logradouro);
                       
                        $inputCidade.val(dados.localidade);
                        $estado.val(dados.uf);
                      
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

   



    const $resuladoJSON = $.getJSON("https://jsonplaceholder.typicode.com/photos",dados=>{
   /*
    $.each(dados,(key,value)=>{
        console.log(value.title)
        
    })*/

    for(key in dados){
        $('#titulobusca').append(`<div class="text-capitalize"><h1>${dados[key].title}</h1></div>`).append(`<img src="${dados[key].thumbnailUrl}"/>`)
    }
    })
    
    const $buscaCommentarios = $.getJSON("https://jsonplaceholder.typicode.com/comments",dados=>{
        for(key in dados){
            $('#comentariosServicos').append(

                `<div class="bg-light bg-gradient border">
                <div class="container text-success pt-4" >
                <p class="text-capitalize text-dark">Titulo :${dados[key].name}</p>
                </div>

                <div class="text-danger mb-3 container">
                <span>Descrição:  ${dados[key].body}</span>
                </div>
                </div>
                `
            )
        }
        
    })

    
})