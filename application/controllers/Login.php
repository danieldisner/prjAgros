<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    // Ação principal, chama a página de Login
    public function index(){
        // Carrega a view Login
        $this->load->view('v_login');
    }
    
    public function logar(){
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');
        
        // Verifica se o usuário digitou apenas o login ou um e-mail
        $arrayUser = explode('@',$this->input->post('usuario'));
        
        // Cria as variaveis
        $usuario = '';
        $email = '';
        
        // Se o resultado for dois é porque digitou um email
        if(count($arrayUser) == 2){
            $email = $this->input->post('usuario');
        }else{
            $usuario = $this->input->post('usuario');
        }

        // Encripta a senha
        $senha = sha1($this->input->post('senha'));
       
        // Consulta o usuário e o email
        $consulta = $this->modelUsuario->logar($usuario,$email);
        
        // Verifica se encontrou algum usuário
        if(!empty($consulta)){
            if($consulta->num_rows() > 0){
                // Verifica se não está bloqueado
                if(!$consulta->row()->bloqueado){
                    // Verifica se a senha informada esta correta
                    if($consulta->row()->senha === $senha){
                        // Inicia sessão com os dados do usuário
                        $this->session->set_userdata($consulta->row_array());
                        // Log de usuário
                        $log = array(
                          'empresa' => $this->session->userdata('empresa'),
                          'usuario' => $this->session->userdata('usuario'),
                          'acao'    => 35,
                          'registro'=> 'Usuário: ' . $this->session->userdata('usuario')
                        );
                        $this->modelLogUsuario->gravarLog($log);
                        // Redireciona para página principal da aplicação
                        redirect(base_url('home'));
                    // Se a senha estiver errada
                    }else{
                        $this->session->set_flashdata('mensagem','Senha incorreta.');
                        // Adiciona +1 ao número de tentativas
                        $tentativaAtual = $consulta->row()->numerodatentativa + 1;
                        try{
                            // Verifica se a tentativa atual é igual ao Numero de tentativas do Grupo de Usuário se for bloqueia o usuário
                            if($tentativaAtual == $consulta->row()->nrotentativa){
                               $this->modelUsuario->addTentativa($consulta->row()->usuario, 0, 1);
                               $this->session->set_flashdata('mensagem','Usuário Bloqueado, entre em contato com o Administrador.');
                            }else{
                                // Se não for, acresenta o numero da tentativa
                               $this->modelUsuario->addTentativa($consulta->row()->usuario,$tentativaAtual, 0);   
                            }
                        }catch(Exception $ex){
                           $this->session->set_flashdata('mensagem','Erro:'.$ex->getMessage().' .Entre em contato com o Administrador.'); 
                        }
                        redirect(base_url('login'));
                    }
                }else{
                    $this->session->set_flashdata('mensagem','Usuário Bloqueado, entre em contato com o Administrador.');
                    redirect(base_url('login'));
                }
            }else{
                $this->session->set_flashdata('mensagem','Usuário/Senha incorretos.');
                redirect(base_url('login'));
            }
        }else{
            $this->session->set_flashdata('mensagem','Por favor, insira o Usuário e a Senha.');
            redirect(base_url('login'));
        }    
    }
    
    public function registrarUsuario(){
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');
        
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');

        // Dados 
        $usuario['usuario'] = $this->input->post('usuariocadastro');
        $usuario['senha'] = sha1($this->input->post('senhacadastro1'));
        $usuario['nome'] = $this->input->post('nomecadastro');
        $usuario['grupo'] = 2; // Grupo padrão (usuário comum)
        //$usuario['datacadastro'] = $this->input->post('emailcadastro');
        $usuario['bloqueado'] = 0;
        $usuario['numerodatentativa'] = 0;
        $usuario['email'] = $this->input->post('emailcadastro');
        $usuario['empresa'] = 1;
        
        // Token do usuário usado para confirmar a ação
        $usuario['token'] = md5(date(time()));
        
        $usuario = tratamento::null_array($usuario);
        
        // Controle de erro
        $error = false;
        
        // Insere os dados
        if($this->modelUsuario->inserir($usuario)){
            $mensagem = 'Usuário cadastrado com sucesso.';
                    
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
            $this->email->subject('Confirmação de Cadastro - Sistema AGROS (não responda)');
            // Colocar o e-mail recebido por post:
            $this->email->to($this->input->post('emailcadastro'));
            
            $mensagemEmail = 'Mensagem automática, não responda.<br/> Seu cadastro foi efetuado com sucesso, para concluir, confirme o seu endereço de e-mail clicando no link abaixo:<br/><br/>';
            $mensagemEmail .= '<a href=' .base_url() . 'confirmarEmail?user='. $usuario['usuario'] . '&tokenuser=' . $usuario['token'] . '>Confirmação de Endereço de Email</a>';
            
            $this->email->message($mensagemEmail);
            if($this->email->send()){
                $mensagem .= '<br/>' . 'Email de confirmação do endereço de Email enviado.';
            }      
        }else{
            $error = true; 
            $mensagem = 'Não foi possível realizar o cadastro, verifique.';
        }
        
        $response = array(
           'msg' => $mensagem,
           'error' => $error
        );
        echo json_encode($response);
    }
    
    public function checkEmail(){
        // Carrega o Model Login
        $this->load->model('M_Usuario', 'modelUsuario');
        
        // Verifica se o email já está cadastrado
        $result = $this->modelUsuario->buscarRegistroEmail($this->input->post('emailcadastro'));
        
        $mensagem = '';
        
        // Se estiver envia mensagem ao usuário
        if($result->num_rows() > 0){
            $mensagem = 'O email já consta nos registros, verifique.';
        }
       
        // Verifica se o usuário já está cadastrado
        $result = $this->modelUsuario->buscarRegistroUsuario($this->input->post('usuariocadastro'));

        // Se estiver envia mensagem ao usuário
        if($result->num_rows() > 0){
            $mensagem = 'Usuário já registrado, verifique.';
        }
        
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }

    public function sair(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
