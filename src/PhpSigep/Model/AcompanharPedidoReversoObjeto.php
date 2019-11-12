<?php
namespace PhpSigep\Model;

/**
 * @author: andersanca
 */
class AcompanharPedidoReversoObjeto extends AbstractModel
{
    /**
     * @var string
     */
    protected $numero_etiqueta;
    /**
     * @var string
     */
    protected $controle_objeto_cliente;

    /**
     * @var int
     */
    protected $ultimo_status;

    /**
     * @var string
     */
    protected $descricao;


    /**
     * @var string
     */
    protected $dataHora;

    /**
     * @var string
     */
    protected $valorPostagem;

    /**
     * @var string
     */
    protected $peso;


    /**
     * @var string
     */
    protected $error;


    /**
     * @param string $descricao
     * @return $this;
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }


    /**
     * @return string
     */
    public function getNumeroEtiqueta()
    {
        return $this->numero_etiqueta;
    }

    /**
     * @param string $numero_etiqueta
     */
    public function setNumeroEtiqueta($numero_etiqueta = null)
    {
        $this->numero_etiqueta = $numero_etiqueta;
    }

    /**
     * @return string
     */
    public function getControleObjetoCliente()
    {
        return $this->controle_objeto_cliente;
    }

    /**
     * @param string $controle_objeto_cliente
     */
    public function setControleObjetoCliente($controle_objeto_cliente)
    {
        $this->controle_objeto_cliente = $controle_objeto_cliente;
    }

    /**
     * @return int
     */
    public function getUltimoStatus()
    {
        return $this->ultimo_status;
    }

    /**
     * @param int $ultimo_status
     */
    public function setUltimoStatus($ultimo_status)
    {
        $this->ultimo_status = $ultimo_status;
    }

    /**
     * @param string $data_hora
     * @return $this;
     */
    public function setDataHora($data_hora)
    {
        $this->dataHora = str_replace('-','/',$data_hora);

        return $this;
    }

    /**
     * @return string
     */
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * @return string
     */
    public function getValorPostagem()
    {
        return $this->valorPostagem;
    }

    /**
     * @param string $valorPostagem
     */
    public function setValorPostagem($valorPostagem)
    {
        $this->valorPostagem = $valorPostagem;
    }

    /**
     * @return string
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @param string $peso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }



    /**
     * @param $error
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrors()
    {
        return $this->error;
    }
}
