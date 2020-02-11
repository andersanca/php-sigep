<?php
require_once __DIR__ . '/bootstrap-exemplos.php';


$accessDataParaAmbienteDeHomologacao = new \PhpSigep\Model\AccessDataHomologacaoReversa();

$config = new \PhpSigep\Config();
$config->setAccessData($accessDataParaAmbienteDeHomologacao);
$config->setEnv(\PhpSigep\Config::ENV_DEVELOPMENT);
$config->setCacheOptions(
    array(
        'storageOptions' => array(
            'enabled' => false,
            'ttl' => 10,// "time to live" de 10 segundos
            'cacheDir' => sys_get_temp_dir(), // Opcional. Quando não inforado é usado o valor retornado de "sys_get_temp_dir()"
        ),
    )

);

\PhpSigep\Bootstrap::start($config);

$phpSigep = new PhpSigep\Services\SoapClient\Real();
$result = $phpSigep->cancelarPedidoReverso($accessDataParaAmbienteDeHomologacao->getCodAdministrativo(),'1041506541','A');

if (!$result->hasError()) {
    /** @var $buscaClienteResult \PhpSigep\Model\BuscaClienteResult */
    $pedidoReversoResult = $result->getResult();
    var_dump($pedidoReversoResult->getStatuPedido());
}

echo 'TESTE ANDERSON<pre>';
var_dump($result);
echo '</pre>';
