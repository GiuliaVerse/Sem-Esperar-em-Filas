<?php

  use MercadoPago\Client\Payment\PaymentClient;
  use MercadoPago\Client\Common\RequestOptions;
  use MercadoPago\MercadoPagoConfig;

  MercadoPagoConfig::setAccessToken("YOUR_ACCESS_TOKEN");

  $client = new PaymentClient();
  $request_options = new RequestOptions();
  $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

  $payment = $client->create([
 "transaction_amount" => (float) $_POST['<TRANSACTION_AMOUNT>'],
    "payment_method_id" => $_POST['<PAYMENT_METHOD_ID>'],
    "payer" => [
      "email" => $_POST['<EMAIL>']
    ]
  ], $request_options);
  echo implode($payment);
?>

<html>
    <header>
        <script src="https://sdk.mercadopago.com/js/v2"></script>
    </header>

    <body>

    
        <form id="form-checkout" action="/process_payment" method="post">
            <div>
            <div>
                <label for="payerFirstName">Nome</label>
                <input id="form-checkout__payerFirstName" name="payerFirstName" type="text">
            </div>
            <div>
                <label for="payerLastName">Sobrenome</label>
                <input id="form-checkout__payerLastName" name="payerLastName" type="text">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input id="form-checkout__email" name="email" type="text">
            </div>
            <div>
                <label for="identificationType">Tipo de documento</label>
                <select id="form-checkout__identificationType" name="identificationType" type="text"></select>
            </div>
            <div>
                <label for="identificationNumber">Número do documento</label>
                <input id="form-checkout__identificationNumber" name="identificationNumber" type="text">
            </div>
            </div>

            <div>
            <div>
                <input type="hidden" name="transactionAmount" id="transactionAmount" value="100">
                <input type="hidden" name="description" id="description" value="Nome do Produto">
                <br>
                <button type="submit">Pagar</button>
            </div>
            </div>
        </form>


    <script>
        const mp = new MercadoPago("YOUR_PUBLIC_KEY");

        
        (async function getIdentificationTypes() {
        try {
            const identificationTypes = await mp.getIdentificationTypes();
            const identificationTypeElement = document.getElementById('form-checkout__identificationType');

            createSelectOptions(identificationTypeElement, identificationTypes);
        } catch (e) {
            return console.error('Error getting identificationTypes: ', e);
        }
        })();

        function createSelectOptions(elem, options, labelsAndKeys = { label: "name", value: "id" }) {
        const { label, value } = labelsAndKeys;

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

    </script>

    </body>

</html>