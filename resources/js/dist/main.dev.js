"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
  var formularioLogin = $('#formularioLogin');
  var botaoLogin = $('#botaoLogin');
  var formularioCadastro = $('#formularioCadastro');
  var botaoCadastro = $('#botaoCadastro');

  function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#ibge").val("");
  } //Quando o campo cep perde o foco.


  $("#cep").blur(function () {
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, ''); //Verifica se campo cep possui valor informado.

    if (cep != "") {
      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/; //Valida o formato do CEP.

      if (validacep.test(cep)) {
        //Preenche os campos com "..." enquanto consulta webservice.
        $("#rua").val("...");
        $("#bairro").val("...");
        $("#cidade").val("...");
        $("#uf").val("...");
        $("#ibge").val("..."); //Consulta o webservice viacep.com.br/

        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
          if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $("#rua").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#uf").val(dados.uf);
            $("#ibge").val(dados.ibge);
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
  }); //formulario de login

  botaoLogin.on('click', function (event) {
    event.preventDefault();
    var camposVazio = false;
    $('#botaoLogin input').each(function () {
      if ($(this).val() == "") {
        var _$$css;

        $(this).css((_$$css = {
          'border-width': '2px',
          'border-style': 'solid',
          'border-radius': '5px'
        }, _defineProperty(_$$css, "border-width", '2px'), _defineProperty(_$$css, 'border-color', 'red'), _defineProperty(_$$css, 'backgroundColor', 'red'), _$$css));
        camposVazio = true;
        return false;
      } else {
        $(this).css({
          'backgroundColor': 'green',
          'color': 'white',
          'border-color': 'green'
        });
      }
    });

    if (camposVazio) {
      return false;
    }

    $(formularioLogin).trigger("submit");
  }); //formulario de cadastro

  botaoCadastro.on('click', function (event) {
    event.preventDefault();
    var camposVazio = false;
    $('#formularioCadastro input').each(function () {
      if ($(this).val() == "") {
        var _$$css2;

        $(this).css((_$$css2 = {
          'border-width': '2px',
          'border-style': 'solid',
          'border-radius': '5px'
        }, _defineProperty(_$$css2, "border-width", '2px'), _defineProperty(_$$css2, 'border-color', 'red'), _defineProperty(_$$css2, 'backgroundColor', 'red'), _$$css2));
        camposVazio = true;
        return false;
      } else {
        $(this).css({
          'backgroundColor': 'green',
          'color': 'white',
          'border-color': 'green'
        });
      }
    });

    if (camposVazio) {
      return false;
    }

    $(formularioCadastro).trigger("submit");
  }); //formularioEndreco

  $('#cadastroEndereco').on('click', function (event) {
    event.preventDefault();
    var camposVazio = false;
    $('#formEndereco input').each(function () {
      if ($(this).val() == "") {
        $(this).css({
          "backgroundColor": 'red'
        });
        camposVazio = true;
        return false;
      } else {
        $(this).css({
          "backgroundColor": 'green'
        });
      }
    });

    if (camposVazio) {
      return false;
    }

    $('#formEndereco').trigger("submit");
  }); //formulario de identidade

  $('#botaoCadastroIdentidade').on('click', function (event) {
    event.preventDefault();
    var camposVazio = false;
    $('#formIdentidade input').each(function () {
      if ($(this).val() == "") {
        var _$$css3;

        $(this).css((_$$css3 = {
          'border-width': '2px',
          'border-style': 'solid',
          'border-radius': '5px'
        }, _defineProperty(_$$css3, "border-width", '2px'), _defineProperty(_$$css3, 'border-color', 'red'), _defineProperty(_$$css3, 'backgroundColor', 'red'), _$$css3));
        camposVazio = true;
        return false;
      } else {
        $(this).css({
          'backgroundColor': 'green',
          'color': 'white',
          'border-color': 'green'
        });
      }
    });

    if (camposVazio) {
      return false;
    }

    $('#formIdentidade').trigger("submit");
  });
});