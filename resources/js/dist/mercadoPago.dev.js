"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var mp = new MercadoPago("TEST-42b1ad1c-e71d-43a1-8c7b-f9196876039e");
var cardNumberElement = mp.fields.create('cardNumber', {
  placeholder: "Número do cartão"
}).mount('form-checkout__cardNumber');
var expirationDateElement = mp.fields.create('expirationDate', {
  placeholder: "MM/YY"
}).mount('form-checkout__expirationDate');
var securityCodeElement = mp.fields.create('securityCode', {
  placeholder: "Código de segurança"
}).mount('form-checkout__securityCode');

(function getIdentificationTypes() {
  var identificationTypes, identificationTypeElement;
  return regeneratorRuntime.async(function getIdentificationTypes$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.prev = 0;
          _context.next = 3;
          return regeneratorRuntime.awrap(mp.getIdentificationTypes());

        case 3:
          identificationTypes = _context.sent;
          identificationTypeElement = document.getElementById('form-checkout__identificationType');
          createSelectOptions(identificationTypeElement, identificationTypes);
          _context.next = 11;
          break;

        case 8:
          _context.prev = 8;
          _context.t0 = _context["catch"](0);
          return _context.abrupt("return", console.error('Error getting identificationTypes: ', _context.t0));

        case 11:
        case "end":
          return _context.stop();
      }
    }
  }, null, null, [[0, 8]]);
})();

function createSelectOptions(elem, options) {
  var labelsAndKeys = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {
    label: "name",
    value: "id"
  };
  var label = labelsAndKeys.label,
      value = labelsAndKeys.value;
  elem.options.length = 0;
  var tempOptions = document.createDocumentFragment();
  options.forEach(function (option) {
    var optValue = option[value];
    var optLabel = option[label];
    var opt = document.createElement('option');
    opt.value = optValue;
    opt.textContent = optLabel;
    tempOptions.appendChild(opt);
  });
  elem.appendChild(tempOptions);
}

var paymentMethodElement = document.getElementById('paymentMethodId');
var issuerElement = document.getElementById('form-checkout__issuer');
var installmentsElement = document.getElementById('form-checkout__installments');
var issuerPlaceholder = "Banco emissor";
var installmentsPlaceholder = "Parcelas";
var currentBin;
cardNumberElement.on('binChange', function _callee(data) {
  var bin, _ref, results, paymentMethod;

  return regeneratorRuntime.async(function _callee$(_context2) {
    while (1) {
      switch (_context2.prev = _context2.next) {
        case 0:
          bin = data.bin;
          _context2.prev = 1;

          if (!bin && paymentMethodElement.value) {
            clearSelectsAndSetPlaceholders();
            paymentMethodElement.value = "";
          }

          if (!(bin && bin !== currentBin)) {
            _context2.next = 13;
            break;
          }

          _context2.next = 6;
          return regeneratorRuntime.awrap(mp.getPaymentMethods({
            bin: bin
          }));

        case 6:
          _ref = _context2.sent;
          results = _ref.results;
          paymentMethod = results[0];
          paymentMethodElement.value = paymentMethod.id;
          updatePCIFieldsSettings(paymentMethod);
          updateIssuer(paymentMethod, bin);
          updateInstallments(paymentMethod, bin);

        case 13:
          currentBin = bin;
          _context2.next = 19;
          break;

        case 16:
          _context2.prev = 16;
          _context2.t0 = _context2["catch"](1);
          console.error('error getting payment methods: ', _context2.t0);

        case 19:
        case "end":
          return _context2.stop();
      }
    }
  }, null, null, [[1, 16]]);
});

function clearSelectsAndSetPlaceholders() {
  clearHTMLSelectChildrenFrom(issuerElement);
  createSelectElementPlaceholder(issuerElement, issuerPlaceholder);
  clearHTMLSelectChildrenFrom(installmentsElement);
  createSelectElementPlaceholder(installmentsElement, installmentsPlaceholder);
}

function clearHTMLSelectChildrenFrom(element) {
  var currOptions = _toConsumableArray(element.children);

  currOptions.forEach(function (child) {
    return child.remove();
  });
}

function createSelectElementPlaceholder(element, placeholder) {
  var optionElement = document.createElement('option');
  optionElement.textContent = placeholder;
  optionElement.setAttribute('selected', "");
  optionElement.setAttribute('disabled', "");
  element.appendChild(optionElement);
} // Esta etapa melhora as validações cardNumber e securityCode


function updatePCIFieldsSettings(paymentMethod) {
  var settings = paymentMethod.settings;
  var cardNumberSettings = settings[0].card_number;
  cardNumberElement.update({
    settings: cardNumberSettings
  });
  var securityCodeSettings = settings[0].security_code;
  securityCodeElement.update({
    settings: securityCodeSettings
  });
}

function updateIssuer(paymentMethod, bin) {
  var additional_info_needed, issuer, issuerOptions;
  return regeneratorRuntime.async(function updateIssuer$(_context3) {
    while (1) {
      switch (_context3.prev = _context3.next) {
        case 0:
          additional_info_needed = paymentMethod.additional_info_needed, issuer = paymentMethod.issuer;
          issuerOptions = [issuer];

          if (!additional_info_needed.includes('issuer_id')) {
            _context3.next = 6;
            break;
          }

          _context3.next = 5;
          return regeneratorRuntime.awrap(getIssuers(paymentMethod, bin));

        case 5:
          issuerOptions = _context3.sent;

        case 6:
          createSelectOptions(issuerElement, issuerOptions);

        case 7:
        case "end":
          return _context3.stop();
      }
    }
  });
}

function getIssuers(paymentMethod, bin) {
  var paymentMethodId;
  return regeneratorRuntime.async(function getIssuers$(_context4) {
    while (1) {
      switch (_context4.prev = _context4.next) {
        case 0:
          _context4.prev = 0;
          paymentMethodId = paymentMethod.id;
          _context4.next = 4;
          return regeneratorRuntime.awrap(mp.getIssuers({
            paymentMethodId: paymentMethodId,
            bin: bin
          }));

        case 4:
          return _context4.abrupt("return", _context4.sent);

        case 7:
          _context4.prev = 7;
          _context4.t0 = _context4["catch"](0);
          console.error('error getting issuers: ', _context4.t0);

        case 10:
        case "end":
          return _context4.stop();
      }
    }
  }, null, null, [[0, 7]]);
}

;

function updateInstallments(paymentMethod, bin) {
  var installments, installmentOptions, installmentOptionsKeys;
  return regeneratorRuntime.async(function updateInstallments$(_context5) {
    while (1) {
      switch (_context5.prev = _context5.next) {
        case 0:
          _context5.prev = 0;
          _context5.next = 3;
          return regeneratorRuntime.awrap(mp.getInstallments({
            amount: document.getElementById('transactionAmount').value,
            bin: bin,
            paymentTypeId: 'credit_card'
          }));

        case 3:
          installments = _context5.sent;
          installmentOptions = installments[0].payer_costs;
          installmentOptionsKeys = {
            label: 'recommended_message',
            value: 'installments'
          };
          createSelectOptions(installmentsElement, installmentOptions, installmentOptionsKeys);
          _context5.next = 12;
          break;

        case 9:
          _context5.prev = 9;
          _context5.t0 = _context5["catch"](0);
          console.error('error getting installments: ', e);

        case 12:
        case "end":
          return _context5.stop();
      }
    }
  }, null, null, [[0, 9]]);
}

var formElement = document.getElementById('form-checkout');
formElement.addEventListener('submit', createCardToken);

function createCardToken(event) {
  var tokenElement, token;
  return regeneratorRuntime.async(function createCardToken$(_context6) {
    while (1) {
      switch (_context6.prev = _context6.next) {
        case 0:
          _context6.prev = 0;
          tokenElement = document.getElementById('token');

          if (tokenElement.value) {
            _context6.next = 9;
            break;
          }

          event.preventDefault();
          _context6.next = 6;
          return regeneratorRuntime.awrap(mp.fields.createCardToken({
            cardholderName: document.getElementById('form-checkout__cardholderName').value,
            identificationType: document.getElementById('form-checkout__identificationType').value,
            identificationNumber: document.getElementById('form-checkout__identificationNumber').value
          }));

        case 6:
          token = _context6.sent;
          tokenElement.value = token.id;
          formElement.requestSubmit();

        case 9:
          _context6.next = 14;
          break;

        case 11:
          _context6.prev = 11;
          _context6.t0 = _context6["catch"](0);
          console.error('error creating card token: ', _context6.t0);

        case 14:
        case "end":
          return _context6.stop();
      }
    }
  }, null, null, [[0, 11]]);
}