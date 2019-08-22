<?php

namespace PhpSigep\Services\Real;
use PhpSigep\Model\RevalidarPrazoAutorizacaoPostagemReversoResposta;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;

/**
 * @author denisbr
 */
class RevalidarPrazoAutorizacaoPostagemReverso
{
    public function execute($codAdministrativo, $numeroPedido, $qtdDias)
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
            if (!$qtdDias
            ) {
                throw new Exception('Obrigatório Quantidade de dias máximo 30 ');
            }

            $soapArgs = array(
                'codAdministrativo'    => $codAdministrativo,
                'numeroPedido'          => $numeroPedido,
                'qtdeDias'                  => $qtdDias,

            );
            $soapArgs = $this->filtraValNull($soapArgs);


            $r = SoapClientFactory::getSoapReversa()->revalidarPrazoAutorizacaoPostagem($soapArgs);

            if (!$r || !is_object($r) || !isset($r->return) || ($r instanceof \SoapFault)) {
                if ($r instanceof \SoapFault) {
                    throw $r;
                }



                if ($r->revalidarPrazoAutorizacaoPostagem) {


                    if (!empty($r->revalidarPrazoAutorizacaoPostagem->msg_erro)) {
                        throw new \Exception($r->revalidarPrazoAutorizacaoPostagem->msg_erro, (int) $r->revalidarPrazoAutorizacaoPostagem->cod_erro);
                    }



                    $revalida = new RevalidarPrazoAutorizacaoPostagemReversoResposta();

                    $result->setResult((array)$r->revalidarPrazoAutorizacaoPostagem);
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
