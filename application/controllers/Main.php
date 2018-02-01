<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    /**
    * Controller principal
    *      * 
    */
    public function index()
    {    
        $this->load->view('header');
        $this->load->view('insert');
        $this->load->view('footer');
    }
    
    public function insert()
    {
        header('Content-Type: application/json');
        
        $ds_nome = $this->input->post('ds_nome');
        
        $array_retorno = array();
        
        if (empty($ds_nome))
        {
            $array_retorno['status'] = '0';
            $array_retorno['msg']  = 'Por pavor, preencha o campo "Nome"';
        }
        else
        {
            $ok_ins = $this->usuarios_model->insert(array('ds_nome' => $ds_nome));
            if ($ok_ins)
            {
                $array_retorno['status'] = '1';
                $array_retorno['msg']  = 'Nome cadastrado com sucesso. ID = ' . $ok_ins;                
            }
            else
            { 
                $array_retorno['status'] = '0';
                $array_retorno['msg']  = 'Erro ao cadastrar nome';                
            }            
        }
        
        echo json_encode($array_retorno);
    }
    
    public function lista()
    {   
        $this->load->view('header');
        $this->load->view('lista');
        $this->load->view('footer');
    }
    
    public function lista_ajax()
    {
        header('Content-Type: application/json');
        
        $lista_usuarios = $this->usuarios_model->lista();
        
        echo json_encode($lista_usuarios);
    }
}