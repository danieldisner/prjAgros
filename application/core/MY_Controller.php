<?php

class MY_Controller extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // Verifica se o usuário está logado e se não estiver redireciona para página de login     
        if(empty($this->session->userdata('usuario'))){
            redirect(base_url('login'));
        }
        
        // Carrega o Model de Autorização
        $this->load->model('M_Autorizacao', 'modelAutorizacao');
        
        // Verifica se possui autorização passando o grupo e a classe (menu) que foi chamado
        $consulta = $this->modelAutorizacao->buscarAutorizacao($this->session->userdata('grupo'),$this->router->fetch_class());
       
        // Verifica se não encontrou autorização e se não é a página principal
        if($this->router->fetch_class() !== 'home'){
            if($consulta->num_rows() <= 0){
                $this->session->set_flashdata('mensagem','Usuário não possui Permissão de Acesso.');
                redirect(base_url('home'));
            }
        }
    }
}
