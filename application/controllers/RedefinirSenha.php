<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RedefinirSenha extends CI_Controller{
    public function index(){
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');
        
        // Verifica se o email já está cadastrado
        $result = $this->modelUsuario->buscarRegistroToken($this->input->get('user'),$this->input->get('tokenuser'));
        // Se estiver envia mensagem ao usuário
        if($result->num_rows() > 0){
            $dados = array('usuario'=> $this->input->get('user'));
            // Carrega a view Login
            $this->load->view('v_redefinirSenha',$dados);
        }else{
            echo 'Link para redefinição de Senha Inválido.';
        }
    }
    
    public function redefinir(){
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');
        
        // Redefine a Senha:
        if($this->modelUsuario->mudarSenha($this->input->post('usuario'),sha1($this->input->post('senhacadastro1')))){
            $mensagem = 'Senha Redefinida com sucesso.';
        }else{
            $mensagem = 'Não foi possível redefinir a senha.';
        }

        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
        
        //redirect(base_url('Login'));
    }
}
