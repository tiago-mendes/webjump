<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); 
        
        date_default_timezone_set('America/Sao_Paulo');
        
        $this->load->helper('url');
        
        $this->load->model('usuarios_model');               
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */