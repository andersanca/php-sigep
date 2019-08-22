<?php
namespace PhpSigep\Services\Real;

use PhpSigep\Model\AcompanharPedidoReversoColeta;
use PhpSigep\Model\AcompanharPedidoReversoHistorico;
use PhpSigep\Model\AcompanharPedidoReversoObjeto;
use PhpSigep\Model\AcompanharPedidoReversoResultado;
use PhpSigep\Model\RastrearObjetoEvento;
use PhpSigep\Model\SolicitarPostagemReversaRetorno;
use PhpSigep\Services\Exception;
use PhpSigep\Services\Result;
use Symfony\Polyfill\Php56\Php56;

/**
 * @author: Stavarengo
 * @author: davidalves1
 */
class AcompanharPedidoReverso
{

    /**
     * @param \PhpSigep\Model\RastrearObjeto $params
     * @return \PhpSigep\Services\Result<\PhpSigep\Model\RastrearObjetoResultado[]>
     * @throws Exception\RastrearObjeto\TipoResultadoInvalidoException
     * @throws Exception\RastrearObjeto\TipoInvalidoException
     */
    public function execute(\PhpSigep\Model\AcompanharPedidoReverso $params)
    {

        if (!$params instanceof \PhpSigep\Model\AcompanharPedidoReverso) {
            throw new InvalidArgument();
        }


        $result = new Result();
        try {
            if (!$params->getAccessData() || !$params->getAccessData()->getCodAdministrativo()
            ) {
                throw new Exception('Para usar este serviço você precisa setar o código administrativo.');
            }
            if (!$params->getNumeroPedido()
            ) {
                throw new Exception('Obrigatório numero do pedido (e-ticket) ');
            }

            $soapArgs = array(
                'codAdministrativo'   => $params->getAccessData()->getCodAdministrativo(),
                'tipoBusca'=> $params->getTipoBusca(),
                'tipoSolicitacao'=>$params->getTipoSolicitacao(),
                'numeroPedido'=>$params->getNumeroPedido(),
            );

            $soapArgs = $this->filtraValNull($soapArgs);

            $r = SoapClientFactory::getSoapReversa()->acompanharPedido($soapArgs);

            if (!$r || !is_object($r) || !isset($r->return) || ($r instanceof \SoapFault)) {
                if ($r instanceof \SoapFault) {
                    throw $r;
                }
                if ($r->acompanharPedido) {


                    if (!empty($r->acompanharPedido->msg_erro)) {
                        throw new \Exception($r->acompanharPedido->msg_erro, (int) $r->acompanharPedido->cod_erro);
                    }

                    $retorno = $r->acompanharPedido;

                    $objeto = $retorno->coleta;

                    $coleta = new AcompanharPedidoReversoColeta();
                    $coleta->setNumeroPedido($objeto->numero_pedido);
                    $coleta->setControleCliente($objeto->controle_cliente);

                    if (!is_array($objeto->historico))
                        $objeto->historico = array($objeto->historico);

                    foreach ($objeto->historico as $his) {
                        $historico = new AcompanharPedidoReversoHistorico();

                        $historico->setStatus($his->status);
                        $historico->setDataHora($his->data_atualizacao . ' ' . $his->hora_atualizacao);
                        $historico->setDescricao(SoapClientFactory::convertEncoding($his->descricao_status));
                        $historico->setObservacao(SoapClientFactory::convertEncoding(isset($his->observacao) ? $his->observacao : ''));

                        // Adiciona o evento ao resultado
                        $coleta->addHistorico($historico);
                    }


                    $objetoR = new AcompanharPedidoReversoObjeto();
                    $objetoR->setNumeroEtiqueta($objeto->objeto->numero_etiqueta);
                    $objetoR->setControleObjetoCliente($objeto->objeto->controle_objeto_cliente);
                    $objetoR->setUltimoStatus($objeto->objeto->ultimo_status);
                    $objetoR->setDescricao($objeto->objeto->descricao_status);
                    $objetoR->setDataHora($objeto->objeto->data_ultima_atualizacao . ' '.$objeto->objeto->hora_ultima_atualizacao);


                    $coleta->setObjeto($objetoR);

                    $acompanharPedidoReversoResultado = new AcompanharPedidoReversoResultado();
                    $acompanharPedidoReversoResultado->setColeta($coleta);
                    $acompanharPedidoReversoResultado->setTipoSolicitacao($retorno->tipo_solicitacao);


                    $result->setResult($acompanharPedidoReversoResultado);
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
