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


   



/*


    $formlogin.submit(event=>{
        alert('HELLOW')
        event.preventDefault();

    })
  */  
    
  

/*
   $enviar.submit(function( event ) {
        alert( "Handler for .submit() called." );
        event.preventDefault();
      });

    let $inputNome = $('#nome').val();
    let $inputNome = $('#nome').val();
    let $inputNome = $('#nome').val();
    let $inputNome = $('#nome').val();
*/
   

})