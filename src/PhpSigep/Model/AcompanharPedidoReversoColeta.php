<?php
namespace PhpSigep\Model;

/**
 * @author: andersanca
 */
class AcompanharPedidoReversoColeta extends AbstractModel
{
    /**
     * @var string
     */
    protected $numero_pedido;


    /**
     * @var int
     */
    protected $controle_cliente;


    /**
     * @var AcompanharPedidoReversoHistorico[]
     */
    protected $historicos;


    /**
     * @var AcompanharPedidoReversoObjeto
     */
    protected $objeto;



    /**
     * @return string
     */
    public function getNumeroPedido()
    {
        return $this->numero_pedido;
    }

    /**
     * @param string $numero_pedido
     */
    public function setNumeroPedido($numero_pedido)
    {
        $this->numero_pedido = $numero_pedido;
    }

    /**
     * @return int
     */
    public function getControleCliente()
    {
        return $this->controle_cliente;
    }

    /**
     * @param int $controle_cliente
     */
    public function setControleCliente($controle_cliente)
    {
        $this->controle_cliente = $controle_cliente;
    }

    /**
     * @return AcompanharPedidoReversoHistorico[]
     */
    public function getHistoricos()
    {
        return $this->historicos;
    }

    /**
     * @param AcompanharPedidoReversoHistorico[] $historico
     */
    public function setHistoricos(array $historico)
    {
        $this->historicos = $historico;

        return $this;
    }

    /**
     * @param \PhpSigep\Model\AcompanharPedidoReversoHistorico[] $eventos
     * @return $this;
     */
    public function addHistorico(AcompanharPedidoReversoHistorico $historico)
    {
        if (!is_array($this->historicos)) {
            $this->historicos = array();
        }

        $this->historicos[] = $historico;

        return $this;
    }

    /**
     * @return AcompanharPedidoReversoObjeto
     */
    public function getObjeto()
    {
        return $this->objeto;
    }

    /**
     * @param AcompanharPedidoReversoObjeto $objeto
     */
    public function setObjeto(\PhpSigep\Model\AcompanharPedidoReversoObjeto $objeto)
    {
        $this->objeto = $objeto;
    }

}
