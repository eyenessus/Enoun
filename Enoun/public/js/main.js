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


    

    $formCadastro.submit(event =>{
        event.preventDefault();
        const $array = [
            $inputNome,$inputSnome,$inputSenha,
            $inputUser,$inputEndereco,$inputCidade,
            $inputCep
        ];
        
        for(let i=0; i<$array.length; i++){
            if(!$array[i].val()){
                alert("Preencha todos os campos por favor.");
                return
            }
        }
       
/*
        if($inputNome.val() ==""){
            alert('Preencha o campo');
            return;
        }
        if($inputSnome.val() ==""){
            alert('Preencha o campo');
            return;
        }
        if($inputSenha.val() ==""){
            alert('Preencha o campo');
            return;
        }
        if($inputUser.val() ==""){
            alert('Preencha o campo');
            return;
        }
        if($inputEndereco.val() ==""){
            alert('Preencha o campo');
            return;
        }
        if($inputCidade.val() ==""){
            alert('Preencha o campo');
            return;
        }
        if($inputCep.val() ==""){
            alert('Preencha o campo');
            return;
        }
        */


    })


   

})