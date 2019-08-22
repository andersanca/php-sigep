<?php

namespace PhpSigep\Model;

/**
 * @author: denisbr
 */
class CancelarPedidoReversoResposta extends AbstractModel
{

    /**
     * @var string
     */
    protected $numeroPedido;


    /**
     * @var string
     */
    protected $statuPedido;

    /**
     * @var string
     */
    protected $dataHora;


    /**
     * @return string
     */
    public function getNumeroPedido()
    {
        return $this->numeroPedido;
    }

    /**
     * @param string $numeroPedido
     */
    public function setNumeroPedido($numeroPedido)
    {
        $this->numeroPedido = $numeroPedido;
    }

    /**
     * @return string
     */
    public function getStatuPedido()
    {
        return $this->statuPedido;
    }

    /**
     * @param string $statuPedido
     */
    public function setStatuPedido($statuPedido)
    {
        $this->statuPedido = $statuPedido;
    }

    /**
     * @return string
     */
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * @param string $dataHora
     */
    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;
    }


}
