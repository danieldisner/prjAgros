<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller{
    // Ação principal, chama a página de Login
    public function index(){
        // Carrega a view Login
        $this->load->view('v_principal');
    }
    
    public function enviarEmailContato(){     
        // Controle de erro
        $error = false;
        
        $mensagem = 'Email enviado com sucesso. Rertornaremos a mensagem em breve.';
                    
        // Carrega a biblioteca de email
        $this->load->library('email');

        // Configurações dos emails
        $mailConfig['smtp_host'] = 'ssl://br486.hostgator.com.br';
        $mailConfig['smtp_port'] = 465;
        $mailConfig['smtp_user'] = 'agrossis@disnerdev.com.br';
        $mailConfig['smtp_pass'] = 'agrossis741';
        $mailConfig['protocol']  = 'smtp';
        $mailConfig['validate']  = TRUE;
        $mailConfig['mailtype']  = 'html';
        $mailConfig['charset']   = 'utf-8';
        $mailConfig['newline']   = '\r\n';

        // Inicializa as configurações do e-mail
        $this->email->initialize($mailConfig);

        $this->email->from('agrossis@disnerdev.com.br', 'Suporte Agrosis');
        $this->email->subject('Contato através do Site - Sistema AGROS (não responda)');
        // Envia para o próprio email de contato
        $this->email->to('agrossis@disnerdev.com.br');

        $mensagemEmail = 'Contato através do Site.<br/><br/>';
        $mensagemEmail .= 'Nome: '. $this->input->post('nome'). '<br/>';
        $mensagemEmail .= 'Email Contato: '. $this->input->post('email'). '<br/>';
        $mensagemEmail .= 'Telefone Contato: '. $this->input->post('telefone'). '<br/>';
        $mensagemEmail .= 'Mensagem: '. $this->input->post('mensagem'). '<br/>';

        $this->email->message($mensagemEmail);
        if(!$this->email->send()){  
            $error = true; 
            $mensagem = 'Não foi possível entrar em contato.';
        }
        
        $response = array(
           'msg' => $mensagem,
           'error' => $error
        );
        echo json_encode($response);
    }
}
