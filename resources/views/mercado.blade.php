<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Pago</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("APP_USR-4070c3e7-5cb0-4a7d-9b2f-0d1420b5fb71");
    </script>
</head>

<body>

    <style>
        #form-checkout {
            display: flex;
            flex-direction: column;
            max-width: 600px;
        }

        .container {
            height: 18px;
            display: inline-block;
            border: 1px solid rgb(118, 118, 118);
            border-radius: 2px;
            padding: 1px 2px;
        }
    </style>
    <form id="form-checkout" action="/assinatura" method="POST">
        <div id="form-checkout__cardNumber" class="container"></div>
        <div id="form-checkout__expirationDate" class="container"></div>
        <div id="form-checkout__securityCode" class="container"></div>
        <input type="text" id="form-checkout__cardholderName" placeholder="Titular do cartão" />
        <select id="form-checkout__issuer" name="issuer">
            <option value="" disabled selected>Banco emissor</option>
        </select>

        <select id="form-checkout__identificationType" name="identificationType">
            <option value="" disabled selected>Tipo de documento</option>
        </select>
        <input type="text" id="form-checkout__identificationNumber" name="identificationNumber"
            placeholder="Número do documento" />
        <input type="email" id="form-checkout__email" name="email" placeholder="E-mail" />

        <input id="token" name="token" type="hidden">
        <input id="paymentMethodId" name="paymentMethodId" type="hidden">
        <input id="transactionAmount" name="transactionAmount" type="hidden" value="100">
        <input id="description" name="description" type="hidden" value="Nome do Produto">

        <button type="submit" id="form-checkout__submit">Pagar</button>
    </form>
    <script>
        const cardNumberElement = mp.fields.create('cardNumber', {
            placeholder: "Número do cartão"
        }).mount('form-checkout__cardNumber');
        const expirationDateElement = mp.fields.create('expirationDate', {
            placeholder: "MM/YY",
        }).mount('form-checkout__expirationDate');
        const securityCodeElement = mp.fields.create('securityCode', {
            placeholder: "Código de segurança"
        }).mount('form-checkout__securityCode');

        (async function getIdentificationTypes() {
            try {
                const identificationTypes = await mp.getIdentificationTypes();
                const identificationTypeElement = document.getElementById('form-checkout__identificationType');

                createSelectOptions(identificationTypeElement, identificationTypes);
            } catch (e) {
                return console.error('Error getting identificationTypes: ', e);
            }
        })();

        function createSelectOptions(elem, options, labelsAndKeys = {
            label: "name",
            value: "id"
        }) {
            const {
                label,
                value
            } = labelsAndKeys;

            elem.options.length = 0;

            const tempOptions = document.createDocumentFragment();

            options.forEach(option => {
                const optValue = option[value];
                const optLabel = option[label];

                const opt = document.createElement('option');
                opt.value = optValue;
                opt.textContent = optLabel;

                tempOptions.appendChild(opt);
            });

            elem.appendChild(tempOptions);
        }

        const paymentMethodElement = document.getElementById('paymentMethodId');
        const issuerElement = document.getElementById('form-checkout__issuer');
        const installmentsElement = document.getElementById('form-checkout__installments');

        const issuerPlaceholder = "Banco emissor";
        const installmentsPlaceholder = "Parcelas";

        let currentBin;
        cardNumberElement.on('binChange', async (data) => {
            const {
                bin
            } = data;
            try {
                if (!bin && paymentMethodElement.value) {
                    clearSelectsAndSetPlaceholders();
                    paymentMethodElement.value = "";
                }

                if (bin && bin !== currentBin) {
                    const {
                        results
                    } = await mp.getPaymentMethods({
                        bin
                    });
                    const paymentMethod = results[0];

                    paymentMethodElement.value = paymentMethod.id;
                    updatePCIFieldsSettings(paymentMethod);
                    updateIssuer(paymentMethod, bin);
                }

                currentBin = bin;
            } catch (e) {
                console.error('error getting payment methods: ', e)
            }
        });

        function clearSelectsAndSetPlaceholders() {
            clearHTMLSelectChildrenFrom(issuerElement);
            createSelectElementPlaceholder(issuerElement, issuerPlaceholder);

            clearHTMLSelectChildrenFrom(installmentsElement);
            createSelectElementPlaceholder(installmentsElement, installmentsPlaceholder);
        }

        function clearHTMLSelectChildrenFrom(element) {
            const currOptions = [...element.children];
            currOptions.forEach(child => child.remove());
        }

        function createSelectElementPlaceholder(element, placeholder) {
            const optionElement = document.createElement('option');
            optionElement.textContent = placeholder;
            optionElement.setAttribute('selected', "");
            optionElement.setAttribute('disabled', "");

            element.appendChild(optionElement);
        }

        // Esta etapa melhora as validações cardNumber e securityCode
        function updatePCIFieldsSettings(paymentMethod) {
            const {
                settings
            } = paymentMethod;

            const cardNumberSettings = settings[0].card_number;
            cardNumberElement.update({
                settings: cardNumberSettings
            });

            const securityCodeSettings = settings[0].security_code;
            securityCodeElement.update({
                settings: securityCodeSettings
            });
        }

        async function updateIssuer(paymentMethod, bin) {
            const {
                additional_info_needed,
                issuer
            } = paymentMethod;
            let issuerOptions = [issuer];

            if (additional_info_needed.includes('issuer_id')) {
                issuerOptions = await getIssuers(paymentMethod, bin);
            }

            createSelectOptions(issuerElement, issuerOptions);
        }

        async function getIssuers(paymentMethod, bin) {
            try {
                const {
                    id: paymentMethodId
                } = paymentMethod;
                return await mp.getIssuers({
                    paymentMethodId,
                    bin
                });
            } catch (e) {
                console.error('error getting issuers: ', e)
            }
        };

        const formElement = document.getElementById('form-checkout');
        formElement.addEventListener('submit', createCardToken);

        async function createCardToken(event) {
            try {
                const tokenElement = document.getElementById('token');
                if (!tokenElement.value) {
                    event.preventDefault();
                    const token = await mp.fields.createCardToken({
                        cardholderName: document.getElementById('form-checkout__cardholderName').value,
                        identificationType: document.getElementById('form-checkout__identificationType').value,
                        identificationNumber: document.getElementById('form-checkout__identificationNumber')
                            .value,
                    });
                    tokenElement.value = token.id;
                    formElement.requestSubmit();
                }
            } catch (e) {
                console.error('error creating card token: ', e)
            }
        }
    </script>
</body>

</html>
