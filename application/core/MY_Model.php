<?php
class MY_Model extends CI_Model
{
    /**
     * Fun��o que constr�i o model para ser utilizado com o load do CI.
     */
    protected $table;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fun��o que retorna em formato de array um determinado registro.
     *
     * @param $id
     * @return boolean|array
     */
    public function get($id)
    {
        if ( ! empty($id))
        {
            $query = $this->db->get_where($this->table, array('id' => $id));
            $retorno = $query->row_array();
        }
        else
        {
            $retorno = FALSE;
        }
        return $retorno;
    }

    /**
     * Fun��o que insere no banco de dados.
     *
     * @param array $dados_ins
     * @return boolean|id da cidade
     */
    public function insert($dados_ins)
    {
        if (is_array($dados_ins))
        {
            $ok_ins = $this->db->insert($this->table, $dados_ins);

            if ($ok_ins)
            {
                $retorno = $this->db->insert_id();
            }
            else
            {
                $retorno = FALSE;
            }
        }
        else
        {
            $retorno = FALSE;
        }
        return $retorno;
    }

    /**
     * Fun��o que atualiza um determinado registro.
     *
     * @param $id
     * @param $dados_alt
     * @return boolean|rows-affected
     */
    public function update($id,$dados_alt)
    {
        if (is_array($dados_alt))
        {
            if ( ! empty($dados_alt))
            {
                $this->db->where('id', $id);
                $retorno = $this->db->update($this->table, $dados_alt);
            }
            else
            {
                $retorno = FALSE;
            }
        }
        else
        {
            $retorno = FALSE;
        }

        return $retorno;
    }

    /**
     * Fun��o que retorna do banco de dados um array com restri��es ($where), ordenado ($order_by)
     * com um limite de linhas ($limit) come�ando da linha ($offset).
     *
     * @param array $where
     * @param array $order_by
     * @param $limit
     * @param $offset
     * @return array
     */
    public function lista($where = '', $order_by = '', $limit = '', $offset = '')
    {
        if ( is_array($where) || $where !== '' )
        {
            foreach ($where as $campo => $valor)
            {                
                if (($campo == 'ic_status1 !=') || ($campo == 'ic_status2 !='))
                {
                    $campo = 'ic_status !=';
                }

                $this->db->where($campo,$valor);
            }            
        }

        if ( is_array($order_by) )
        {
            foreach ($order_by as $campo => $ASC_DESC)
            {
                $this->db->order_by($campo, $ASC_DESC);
            }
        }

        if (($limit !== '') && ($offset !== ''))
        {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get($this->table);

        return $query->result_array();
    }
    
    /**
     * Fun��o que retorna do banco de dados um array com restri��es ($where) OR, ordenado ($order_by)
     * com um limite de linhas ($limit) come�ando da linha ($offset).
     *
     * @param array $where
     * @param array $order_by
     * @param $limit
     * @param $offset
     * @return array
     */
    public function lista_or($where = '', $order_by = '', $limit = '', $offset = '')
    {
        if ( is_array($where) || $where !== '' )
        {
//            echo '<br>========<br>';
//            print_r($where);
//            echo '<br>========<br>';
//            exit();
            foreach ($where as $campo => $valor)
            {
                if (($campo == 'ic_status1') || ($campo == 'ic_status2'))
                {
                    $campo = 'ic_status';
                }
                $this->db->or_where($campo,$valor);
            }
        }

        if ( is_array($order_by) )
        {
            foreach ($order_by as $campo => $ASC_DESC)
            {
                $this->db->order_by($campo, $ASC_DESC);
            }
        }

        if (($limit !== '') && ($offset !== ''))
        {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get($this->table);

        return $query->result_array();
    }

    /**
     * Fun��o que contar� os registros da tabela, recebendo um campo $where de par�metro
     *
     * @param array $where
     */
    public function count($where = '')
    {
        if ( is_array($where) )
        {
            $this->db->where($where);
        }

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function get_by_name($nome)
    {
        $this->db->like('ds_nome', $nome);
        $query = $this->db->get($this->table);

        return $query->result_array();
    }
}

/* End of file MY_Model.php */
/* Location: ./application/models/MY_Model.php */