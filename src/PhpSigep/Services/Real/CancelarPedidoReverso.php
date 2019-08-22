<?php

namespace PhpSigep\Services\Real;

use PhpSigep\Model\CancelarPedidoReversoResposta;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;

/**
 * @author denisbr
 */
class CancelarPedidoReverso
{
    public function execute($codAdministrativo, $numeroPedido, $tipo)
    {




        $result = new Result();
        try {
            if (!$codAdministrativo
            ) {
                throw new Exception('Para usar este serviço você precisa setar o código administrativo.');
            }
            if (!$numeroPedido
            ) {
                throw new Exception('Obrigatório numero do pedido (e-ticket) ');
            }

            $soapArgs = array(
                'codAdministrativo'    => $codAdministrativo,
                'numeroPedido'          => $numeroPedido,
                'tipo'                  => $tipo,

            );
            $soapArgs = $this->filtraValNull($soapArgs);


            $r = SoapClientFactory::getSoapReversa()->cancelarPedido($soapArgs);

            if (!$r || !is_object($r) || !isset($r->return) || ($r instanceof \SoapFault)) {
                if ($r instanceof \SoapFault) {
                    throw $r;
                }



                if ($r->cancelarPedido) {


                    if (!empty($r->cancelarPedido->msg_erro)) {
                        throw new \Exception($r->cancelarPedido->msg_erro, (int) $r->cancelarPedido->cod_erro);
                    }



                    $objetoPostal = $r->cancelarPedido->objeto_postal;

                    $cancela = new CancelarPedidoReversoResposta();
                    $cancela->setNumeroPedido($objetoPostal->numero_pedido);
                    $cancela->setStatuPedido($objetoPostal->status_pedido);
                    $cancela->setDataHora($objetoPostal->datahora_cancelamento);


                    $result->setResult($cancela);
                }

            }else
                throw new \Exception('Falha na leitura do XML (' . var_export($r) . ')', 400);


        } catch (\Exception $e) {


            if ($e instanceof \SoapFault) {
                $result->setIsSoapFault(true);
            }
//                $result->setErrorCode($e->getCode());
//                $result->setErrorMsg("Resposta do Correios: " . SoapClientFactory::convertEncoding($e->getMessage()));
            $result->setErrorCode($e->getCode());
            $result->setErrorMsg($e->getMessage());
        }

        return $result;

    }

    private function filtraValNull($arr)
    {
        $new_arr = [];
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $new_arr[$key] = $this->filtraValNull($val);
                continue;
            }

            if (!$val) {
                continue;
            }
            $new_arr[$key] = $val;
        }

        return $new_arr;
    }




}
