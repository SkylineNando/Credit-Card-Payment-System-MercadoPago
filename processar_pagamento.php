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
