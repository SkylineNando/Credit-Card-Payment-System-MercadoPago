# Credit-Card-Payment-System-MercadoPago
Sistema de pagamento com cartão de credito
Para implementar um sistema de pagamento com cartão de crédito usando o Mercado Pago e PHP, siga os passos abaixo:

### Passo 1: Criar uma conta no Mercado Pago

1. Acesse o site do [Mercado Pago](https://www.mercadopago.com.br/) e crie uma conta ou faça login se já tiver uma.

2. No painel de controle do Mercado Pago, obtenha as credenciais necessárias (Client ID e Client Secret).

### Passo 2: Configurar o ambiente PHP

1. Certifique-se de que você tem o PHP instalado no seu servidor.

2. Se você não tiver o Composer instalado, faça o download e instale a partir do site oficial: [Composer](https://getcomposer.org/).

3. Crie um novo diretório para o seu projeto e dentro dele, crie um arquivo `composer.json` com o seguinte conteúdo:

```json
{
    "require": {
        "mercadopago/dx-php": "*"
    }
}
```

4. No terminal, dentro do diretório do seu projeto, execute o comando `composer install` para instalar a biblioteca do Mercado Pago.

### Passo 3: Criar a página de pagamento

Crie um arquivo HTML para o formulário de pagamento (por exemplo, `checkout.html`):

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento com Mercado Pago</title>
</head>
<body>
    <h1>Formulário de Pagamento</h1>
    <form action="processar_pagamento.php" method="post">
        <label for="amount">Valor:</label>
        <input type="text" name="amount" required><br>

        <label for="description">Descrição:</label>
        <input type="text" name="description" required><br>

        <input type="submit" value="Efetuar Pagamento">
    </form>
</body>
</html>
```

### Passo 4: Criar o script PHP para processar o pagamento

Crie um arquivo PHP para processar o pagamento (por exemplo, `processar_pagamento.php`):

```php
<?php
require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('SEU_ACCESS_TOKEN');

$payment_data = [
    'transaction_amount' => floatval($_POST['amount']),
    'description' => $_POST['description'],
    'payment_method_id' => 'visa', // Método de pagamento (pode ser 'visa', 'master', etc.)
    'payer' => [
        'email' => 'comprador@example.com' // E-mail do comprador
    ]
];

try {
    $payment = new MercadoPago\Payment();
    $payment->create($payment_data);

    // Redirecionar para a página de sucesso
    header("Location: sucesso.php");
} catch (Exception $e) {
    echo 'Ocorreu um erro: ' . $e->getMessage();
}
?>
```

### Passo 5: Criar a página de sucesso (`sucesso.php`)

Crie uma página `sucesso.php` para lidar com o retorno bem-sucedido do pagamento:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Bem-Sucedido</title>
</head>
<body>
    <h1>Pagamento Bem-Sucedido!</h1>
</body>
</html>
```

Lembre-se de substituir `'SEU_ACCESS_TOKEN'` pelo seu token de acesso do Mercado Pago.

Este é um exemplo simples e básico. Em uma implementação real, você deve considerar a segurança, a validação dos dados do formulário e a manipulação apropriada de erros. Além disso, certifique-se de ler a documentação do Mercado Pago para entender completamente como lidar com pagamentos de forma segura e em conformidade com as regulamentações locais.
