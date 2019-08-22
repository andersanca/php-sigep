<?php
namespace PhpSigep\Model;

/**
 * @author: andersanca
 */
class AcompanharPedidoReverso extends AbstractModel
{
    const LOGISTICA_REVERSA_DOMICILIAR  = 'C';
    const AUTORIZACAO_DE_POSTAGEM       = 'A';

    const BUSCAR_TODOS_STATUS           = 'H';
    const BUSCAR_ULTIMO_STATUS          = 'U';


    /**
     * @var AccessData
     */
    protected $accessData;

    /**
     * Número da coleta ou autorização de postagem que deverá ser cancelada.
     * @var int
     */
    protected $numeroPedido;



    /**
     * H – Buscar todos os status do pedido U – Buscar somente o último status do pedido
     * @var string(1)
     */
    protected $tipoBusca = self::BUSCAR_TODOS_STATUS;

    /**
     * Indica se o pedido é de coleta domiciliária ou uma autorização de postagem. C = Logística Reversa Domiciliária A = Autorização de Postagem
     * @var string(2)
     */
    protected $tipoSolicitacao = self::AUTORIZACAO_DE_POSTAGEM;

    /**
     * @param \PhpSigep\Model\AccessData $accessData
     */
    public function setAccessData($accessData)
    {
        $this->accessData = $accessData;
    }

    /**
     * @return \PhpSigep\Model\AccessData
     */
    public function getAccessData()
    {
        return $this->accessData;
    }

    /**
     * @return int
     */
    public function getNumeroPedido()
    {
        return $this->numeroPedido;
    }

    /**
     * @param int $numeroPedido
     */
    public function setNumeroPedido($numeroPedido)
    {
        $this->numeroPedido = $numeroPedido;
    }

    /**
     * @return string
     */
    public function getTipoBusca()
    {
        return $this->tipoBusca;
    }

    /**
     * @param string $tipoBusca
     */
    public function setTipoBusca($tipoBusca)
    {
        $this->tipoBusca = $tipoBusca;
    }

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
}
