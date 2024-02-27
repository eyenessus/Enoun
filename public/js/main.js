$(document).ready(() => {
    //menu categorias




    $.ajax({
        type: "method",
        url: "url",
        data: {
            "reference_id": "ex-00001",
            "customer": {
                "name": "Jose da Silva",
                "email": "email@test.com",
                "tax_id": "12345678909",
                "phones": [
                    {
                        "country": "55",
                        "area": "11",
                        "number": "999999999",
                        "type": "MOBILE"
                    }
                ]
            },
            "items": [
                {
                    "reference_id": "referencia do item",
                    "name": "nome do item",
                    "quantity": 1,
                    "unit_amount": 500
                }
            ],
            "shipping": {
                "address": {
                    "street": "Avenida Brigadeiro Faria Lima",
                    "number": "1384",
                    "complement": "apto 12",
                    "locality": "Pinheiros",
                    "city": "São Paulo",
                    "region_code": "SP",
                    "country": "BRA",
                    "postal_code": "01452002"
                }
            },
            "notification_urls": [
                "https://meusite.com/notificacoes"
            ],
            "charges": [
                {
                    "reference_id": "referencia da cobranca",
                    "description": "descricao da cobranca",
                    "amount": {
                        "value": 500,
                        "currency": "BRL"
                    },
                    "payment_method": {
                        "type": "CREDIT_CARD",
                        "installments": 1,
                        "capture": true,
                        "card": {
                            "encrypted":"V++53ir0qvoK/rUSzNjCqP8Hz9ZTa+HohR779n63CV+NvCeYj4J4lQevL4NKN7Di3BxKQGqfQW5cfS7/4rHw4w8URuOV/j/mGau2GXxkKQ6/szJ6BQr//C4e4XgfCHDwcONQhuPDHMdOB1C+4lzyBbsPJUZ/8TUQrxhMMiMFjwGeg62uf7cUqdFjp+Q5dqJXwhLgH3d1EoX+JKStBLqVzF0lW3gHtFOyfvFhuxxBgB0xrzTKfbTqnL5aSYBoGXRFM0gLodMm6knx7bW+syThxyQffnaigCwj2aNohsu+fuXII+3WnlgrHQxaBx3ChRuWKy+loV2L2USiGulp/bPEcg==",
                            "security_code": "123",
                            "holder": {
                                "name": "Jose da Silva"
                            },
                            "store": false
                        }
                    }
                }
            ]
        },
        dataType: 'json',
        success: function (response) {
            console.log(json)
        }
    });



    
    const $menu = $('#menu');
    const $botaocategoria = $('#botaocategoria')

    $botaocategoria.on('click', () => {
        $menu.slideToggle('fast');
    })


    //fomrmulario login
    const $formulariologin = $('#formlogin');
    let $inputuser = $('#user');
    let $inputsenha = $('#senha');

    $formulariologin.submit(event => {
        event.preventDefault();

        if ($inputuser.val() === "") {
            alert('Preencha o campo de login')
            return;
        }

        if ($inputsenha.val() === "") {
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


    $formCadastro.submit(event => {
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

        for (let i = 0; i < $array.length; i++) {
            if (!$array[i].val()) {
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
    $inputCep.blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $inputEndereco.val("...");

                $inputCidade.val("...");
                $estado.val("...");


                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

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





    const $resuladoJSON = $.getJSON("https://jsonplaceholder.typicode.com/photos", dados => {

        const $fotos = [];
        $.each(dados, function (index, valor) {
            $fotos.push(valor);
        });

        for (let i = 0; i < 6; i++) {
            $('#titulobusca').append(`
        <div class="text-capitalize">
        <h1>${$fotos[i].title}</h1>
        </div>`)
                .append(`<img src="${$fotos[i].thumbnailUrl}"/>`)
        }

    })


    //busca de comentarios
    const $buscaCommentarios = $.getJSON("https://jsonplaceholder.typicode.com/comments", dados => {

        const comments = [];
        $.each(dados, function (index, valor) {
            comments.push(valor);
        });

        for (let i = 0; i < 6; i++) {
            $('#comentariosServicos').append(

                `<div class="bg-light p-1 m-2 rounded">
            <div class="container text-success pt-4" >
            <p class="text-capitalize text-dark">Titulo :${comments[i].name}</p>
            </div>

            <div class="text-danger mb-3 container">
            <span>Descrição:  ${comments[i].body}</span>
            </div>
            </div>
            `
            )
        }

    })

    //imagens de servicos
    $('img').closest('.card').on('mouseenter', event => {
        $(event.currentTarget).toggleClass('shadow-lg  bg-body-tertiary rounded border-info border')
    }).on('mouseleave', event => {
        $(event.currentTarget).toggleClass('shadow-lg  border-info  bg-body-tertiary rounded')
    })



    //aba de categorias
    $botaocategoria.on('mouseenter', () => {
        $menu.show()
    }).on('mouseleave', () => {
        $menu.hide()
    });

    $menu.on('mouseenter', () => {
        $menu.show()
    }).on('mouseleave', () => {
        $menu.hide()
    })

    const $imagemNot = $('.noticias')

    $($imagemNot).css({
        backgroundColor: 'white',
        width: '60rem',
        height: 'auto'
    })

    $slide = $('.slide')

    //verificação de carrinho se existem itens dentro do carrinho
    const $valorFinalCarrinho = $('.valorFinal').html();

    if ($valorFinalCarrinho === '0,00') {
        $('.botaopross').toggleClass('disabled')
    } else {
        $('.botaopross').removeClass('disabled')
    }


    setInterval(() => {
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/obterInfor",
            dataType: "json",
            success: function (response) {
                $.each(response, function (indexInArray, valueOfElement) {
                   
                        $(`#status-${valueOfElement.id}`).html(valueOfElement.status)
                    
                });


            },
            error: function (error) {
                console.log(error)
            }
        });
    }, 8000);



})
