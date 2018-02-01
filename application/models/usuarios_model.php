<?php
class Usuarios_model extends My_Model
{
    /**
     * Função que constrói o model para ser utilizado com o load do CI.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = 'tb_usuarios';
    }

    /**
     * Função responsável pela validação do login de usuários.
     *
     * @param $login
     * @param $senha
     * @return multitype:string NULL |boolean
     */
    public function validar($login, $senha)
    {        
        // Prepara a query
        $this->db->where('ds_login', $login);
        $this->db->where('ds_senha', md5($senha));
        $this->db->where('ic_status', '1');

        // Executa a query
        $query = $this->db->get($this->table);

        // Verifica se tem algum resultado
        if($query->num_rows == 1)
        {
            // Tem um usuário então pegamos ele.
            $row = $query->row();

            //Sempre loja de santos, por enquanto
            $data = array(
                'id_usuario' => $row->id,
                'last_login' => date("d-m-Y h:i:s"),
                'cd_loja' => '1',
                'nome' => $row->ds_nome,
                'avatar' => $row->ds_avatar,
                'nivel' => $row->ic_nivel
            );
            
            $this->session->set_userdata($data);

            // Retorna o array que irá para a sessão.
            return $data;
        }
        else
        {
            // Não houve nenhum resultado para o login e a senha,
            // então retorno é FALSE.
            return FALSE;
        }
    }
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */