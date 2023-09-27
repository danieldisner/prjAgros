<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfirmarEmail extends CI_Controller{
    
    // Ação principal, chama a página de Login
    public function index(){
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');
        
        // Verifica se o email já está cadastrado
        $result = $this->modelUsuario->buscarRegistroToken($this->input->get('user'),$this->input->get('tokenuser'));
        
        $dados = array();
        // Se estiver envia mensagem ao usuário
        if($result->num_rows() < 0){
            $dados['mensagem'] = 'Não foi encontrado o usuário no qual deseja confirmar o email, entre em contato com o administrador.';
        }else if($this->modelUsuario->confirmarEmail($this->input->get('user'))){
            $dados['mensagem'] = 'O Email da sua conta foi confirmado com sucesso!';
        }else{
            $dados['mensagem'] = 'Não foi possível confirmar o email, entre em contato com o administrador.';
        }
        // Carrega a view Login
        $this->load->view('v_ConfirmarEmail',$dados);
    }
}
