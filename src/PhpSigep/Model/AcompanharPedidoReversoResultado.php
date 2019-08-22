<?php
namespace PhpSigep\Model;

/**
 * @author: andersanca
 */
class AcompanharPedidoReversoResultado extends AbstractModel
{
    /**
     * @var string
     */
    protected $tipoSolicitacao;


    /**
     * @var AcompanharPedidoReversoColeta[]
     */
    protected $coleta;
    
    
    /**
     * @return string
     */
    public function getTipoSolicitacao()
    {
        return $this->tipoSolicitacao;
    }

    /**
     * @param string $tipoSolicitacao
     */
    public function setTipoSolicitacao($tipoSolicitacao)
    {
        $this->tipoSolicitacao = $tipoSolicitacao;
    }

    /**
     * @return AcompanharPedidoReversoColeta[]
     */
    public function getColeta()
    {
        return $this->coleta;
    }

    /**
     * @param \PhpSigep\Model\AcompanharPedidoReversoColeta $coleta

     */
    public function setColeta(\PhpSigep\Model\AcompanharPedidoReversoColeta $coleta)
    {
        $this->coleta = $coleta;
    }

    


}
