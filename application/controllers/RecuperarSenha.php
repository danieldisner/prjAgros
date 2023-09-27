<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecuperarSenha extends CI_Controller{
    public function index(){
        // Carrega a view Login
        $this->load->view('v_esqueciSenha');
    }
    
    public function enviarRegistro(){
        
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');

        // Carrega a biblioteca de email
        $this->load->library('email');

        // Busca o Usuário
        $usuario = $this->modelUsuario->buscarUsuarioEmail($this->input->post('email'));
        
        // Verifica se encontrou o usuário
        if($usuario->num_rows() > 0){
            // Configurações dos emails
            $mailConfig['smtp_host'] = '';
            $mailConfig['smtp_port'] = 465;
            $mailConfig['smtp_user'] = '';
            $mailConfig['smtp_pass'] = '';
            $mailConfig['protocol']  = 'smtp';
            $mailConfig['validate']  = TRUE;
            $mailConfig['mailtype']  = 'html';
            $mailConfig['charset']   = 'utf-8';
            $mailConfig['newline']   = '\r\n';

            // Inicializa as configurações do e-mail
            $this->email->initialize($mailConfig);

            $this->email->from('', 'Suporte Agrosis');
            $this->email->subject('Redefinição de Senha - Sistema AGROS (não responda)');
            // Colocar o e-mail recebido por post:
            $this->email->to($this->input->post('email'));

            $mensagemEmail = 'Mensagem automática, não responda.<br/> Seu cadastro foi efetuado com sucesso, para concluir, confirme o seu endereço de e-mail clicando no link abaixo:<br/><br/>';
            $mensagemEmail .= '<a href=' .base_url() . 'redefinirSenha?user='. $usuario->row()->usuario . '&tokenuser=' . $usuario->row()->token . '>REDEFINIR SENHA</a>';

            $this->email->message($mensagemEmail);
            if($this->email->send()){
                $mensagem = '<br/>' . 'Email de confirmação do endereço de Email enviado.';
            }
        }else{
            $mensagem = 'Email não registrado no Sistema.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
}
