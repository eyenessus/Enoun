"use strict";

var butao = document.getElementById('submit');
butao.addEventListener('click', function () {
  var nomeCartao = document.getElementById('nome').value;
  var numero = document.getElementById('numero').value;
  var mes = document.getElementById('mes').value;
  var ano = document.getElementById('ano').value;
  var codigo = document.getElementById('codigo').value;
  var card = PagSeguro.encryptCard({
    publicKey: "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAr+ZqgD892U9/HXsa7XqBZUayPquAfh9xx4iwUbTSUAvTlmiXFQNTp0Bvt/5vK2FhMj39qSv1zi2OuBjvW38q1E374nzx6NNBL5JosV0+SDINTlCG0cmigHuBOyWzYmjgca+mtQu4WczCaApNaSuVqgb8u7Bd9GCOL4YJotvV5+81frlSwQXralhwRzGhj/A57CGPgGKiuPT+AOGmykIGEZsSD9RKkyoKIoc0OS8CPIzdBOtTQCIwrLn2FxI83Clcg55W8gkFSOS6rWNbG5qFZWMll6yl02HtunalHmUlRUL66YeGXdMDC2PuRcmZbGO5a/2tbVppW6mfSWG3NPRpgwIDAQAB    ",
    holder: nomeCartao,
    number: numero,
    expMonth: mes,
    expYear: ano,
    securityCode: codigo
  });
  var encrypted = card.encryptedCard;
  var token = document.getElementById('token').value = encrypted;
  var form = document.getElementById('meuFormulario').onsubmit();
});