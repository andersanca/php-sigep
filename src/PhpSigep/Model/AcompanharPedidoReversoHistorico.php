<?php
namespace PhpSigep\Model;

/**
 * @author: andersanca
 */
class AcompanharPedidoReversoHistorico extends AbstractModel
{
    /**
     * @var int
     */
    protected $status;
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
    protected $observacao;


    /**
     * @var string
     */
    protected $error;
    

    /**
     * @param int $status
     * @return $this;
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
    
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
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * @param string $observacao
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;
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
