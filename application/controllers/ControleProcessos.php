<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControleProcessos extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_controleProcessos';
        
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        $this->load->view('v_layout',$dados);
    }
    
    
    public function buscaRegistro(){
        // Carrega o Model
        $this->load->model('M_Operacoes', 'modelOperacoes');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega o CPF/CNPJ sem formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);

        // Busca o Registro
        $result = $this->modelOperacoes->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj,$this->input->post('tipooperacao'),$this->input->post('finalidade'),$this->input->post('ciclocanoinicio'),$this->input->post('ciclocanofim'));
        
        // Array Para preenchimento dos campos do formulário
        $camposForm = array();
        
        // Verifica se encontrou o registro e atribui os dados aos campos do formulário
        if($result->num_rows() > 0){
            $camposForm['tipooperacao']            = $result->row()->tipooperacao;
            $camposForm['finalidade']              = $result->row()->finalidade;
            $camposForm['ciclocanoinicio']         = $result->row()->ciclocanoinicio;
            $camposForm['ciclocanofim']            = $result->row()->ciclocanofim;
            $camposForm['status']                  = $result->row()->status;
            $camposForm['linhacreditoprojeto']     = $result->row()->linhacreditoprojeto;
            $camposForm['taxajurosprojeto']        = $result->row()->taxajurosprojeto;
            $camposForm['datainicioprojeto']       = $result->row()->datainicioprojeto;
            $camposForm['dataconclusaoprojeto']    = $result->row()->dataconclusaoprojeto;
            $camposForm['aprovado']                = empty($result->row()->aprovado) ? 0 : 1;
            $camposForm['linhacreditoanalise']     = $result->row()->linhacreditoanalise;
            $camposForm['dataliberacaoanalise']    = $result->row()->dataliberacaoanalise;
            $camposForm['taxajurosanalise']        = $result->row()->taxajurosanalise;
            $camposForm['prazoanalise']            = $result->row()->prazoanalise;
            $camposForm['datareembolsoanalise']    = $result->row()->datareembolsoanalise;
            $camposForm['dataconclusaoanalise']    = $result->row()->dataconclusaoanalise;
            
            // Botões
            $camposForm['btnIncluir']     = false;
            $camposForm['btnAlterar']     = true;
            $camposForm['btnExcluir']     = true;
        }else{
            $camposForm['tipooperacao']            = 'AGRÍCOLA';
            $camposForm['finalidade']              = 'CUSTEIO';
            $camposForm['ciclocanoinicio']         = '';
            $camposForm['ciclocanofim']            = '';
            $camposForm['status']                  = 'PROJETO';
            $camposForm['linhacreditoprojeto']     = '';
            $camposForm['taxajurosprojeto']        = '';
            $camposForm['datainicioprojeto']       = '';
            $camposForm['dataconclusaoprojeto']    = '';
            $camposForm['aprovado']                = 1;
            $camposForm['linhacreditoanalise']     = '';
            $camposForm['dataliberacaoanalise']    = '';
            $camposForm['taxajurosanalise']        = '';
            $camposForm['prazoanalise']            = '';
            $camposForm['datareembolsoanalise']    = '';
            $camposForm['dataconclusaoanalise']    = '';
            
            // Botões
            $camposForm['btnIncluir']     = true;
            $camposForm['btnAlterar']     = false;
            $camposForm['btnExcluir']    = false;
        }
        echo json_encode($camposForm);
    }
    
    public function incluir(){
       // Carrega o Model
        $this->load->model('M_Operacoes', 'modelOperacoes');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');
        
          // Carrega o Helper de Formatação
        $this->load->helper('dateutil');
        
        // Cria array com os dados da empresa
        $operacao = array();
        
        // Limpa o array antes de concluir ou trata as datas de outra maneira.        
        $operacao['empresa']                 = $this->session->userdata('empresa');
        $operacao['cpfcnpj']                 = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        $operacao['tipooperacao']            = $this->input->post('tipooperacao');
        $operacao['finalidade']              = $this->input->post('finalidade');
        $operacao['ciclocanoinicio']         = $this->input->post('ciclocanoinicio');
        $operacao['ciclocanofim']            = $this->input->post('ciclocanofim');
        $operacao['status']                  = $this->input->post('status');
        $operacao['linhacreditoprojeto']     = $this->input->post('linhacreditoprojeto');
        $operacao['taxajurosprojeto']        = $this->input->post('taxajurosprojeto');
        $operacao['datainicioprojeto']       = empty($this->input->post('datainicioprojeto')) ? null : dateUtil:: formatDateDB($this->input->post('datainicioprojeto'));
        $operacao['dataconclusaoprojeto']    = empty($this->input->post('dataconclusaoprojeto')) ? null : dateUtil:: formatDateDB($this->input->post('dataconclusaoprojeto'));
        $operacao['aprovado']                = $this->input->post('aprovado');
        $operacao['linhacreditoanalise']     = $this->input->post('linhacreditoanalise');
        $operacao['dataliberacaoanalise']    = empty($this->input->post('dataliberacaoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('dataliberacaoanalise'));
        $operacao['taxajurosanalise']        = format::monetarioTofloat($this->input->post('taxajurosanalise'));
        $operacao['prazoanalise']            = empty($this->input->post('prazoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('prazoanalise'));
        $operacao['datareembolsoanalise']    = empty($this->input->post('datareembolsoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('datareembolsoanalise'));
        $operacao['dataconclusaoanalise']    = empty($this->input->post('dataconclusaoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('dataconclusaoanalise'));
        
        // Insere o registro
        $result = $this->modelOperacoes->incluir($operacao);
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 48,
              'registro'=> 'Empresa:'. $operacao['empresa'] .  '; CPF/CNPJ: ' . $operacao['cpfcnpj'] . '; tipooperacao:'. $operacao['tipooperacao'] . '; finalidade:'. $operacao['finalidade']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Controle de Operação incluido com sucesso.';
        }else{
            $mensagem = 'Erro ao inserir Controle de Operação.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function alterar(){
        // Carrega o Model
        $this->load->model('M_Operacoes', 'modelOperacoes');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');
        
          // Carrega o Helper de Formatação
        $this->load->helper('dateutil');
        
        // Cria array com os dados da empresa
        $operacao = array();
        
        // Limpa o array antes de concluir ou trata as datas de outra maneira.        
        $operacao['empresa']                 = $this->session->userdata('empresa');
        $operacao['cpfcnpj']                 = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        $operacao['tipooperacao']            = $this->input->post('tipooperacao');
        $operacao['finalidade']              = $this->input->post('finalidade');
        $operacao['ciclocanoinicio']         = $this->input->post('ciclocanoinicio');
        $operacao['ciclocanofim']            = $this->input->post('ciclocanofim');
        $operacao['status']                  = $this->input->post('status');
        $operacao['linhacreditoprojeto']     = $this->input->post('linhacreditoprojeto');
        $operacao['taxajurosprojeto']        = $this->input->post('taxajurosprojeto');
        $operacao['datainicioprojeto']       = empty($this->input->post('datainicioprojeto')) ? null : dateUtil:: formatDateDB($this->input->post('datainicioprojeto'));
        $operacao['dataconclusaoprojeto']    = empty($this->input->post('dataconclusaoprojeto')) ? null : dateUtil:: formatDateDB($this->input->post('dataconclusaoprojeto'));
        $operacao['aprovado']                = $this->input->post('aprovado');
        $operacao['linhacreditoanalise']     = $this->input->post('linhacreditoanalise');
        $operacao['dataliberacaoanalise']    = empty($this->input->post('dataliberacaoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('dataliberacaoanalise'));
        $operacao['taxajurosanalise']        = format::monetarioTofloat($this->input->post('taxajurosanalise'));
        $operacao['prazoanalise']            = empty($this->input->post('prazoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('prazoanalise'));
        $operacao['datareembolsoanalise']    = empty($this->input->post('datareembolsoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('datareembolsoanalise'));
        $operacao['dataconclusaoanalise']    = empty($this->input->post('dataconclusaoanalise')) ? null : dateUtil:: formatDateDB($this->input->post('dataconclusaoanalise'));
        
        // Insere OU Atualiza se o registro já existir
       $result = $this->modelOperacoes->alterar($operacao['empresa'],$operacao['cpfcnpj'],$operacao['tipooperacao'],$operacao['finalidade'],$operacao['ciclocanoinicio'],$operacao['ciclocanofim'],$operacao);
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 49,
              'registro'=> 'Empresa:'. $operacao['empresa'] .  '; CPF/CNPJ: ' . $operacao['cpfcnpj'] . '; tipooperacao:'. $operacao['tipooperacao'] . '; finalidade:'. $operacao['finalidade']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Controle de Operação Alterado com sucesso.';
        }else{
            $mensagem = 'Erro ao alterar Controle de Operação.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function excluir(){
        // Carrega o Model
        $this->load->model('M_Operacoes', 'modelOperacoes');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Cria array com os dados da empresa
        $operacao = array();        
        
        $operacao['empresa']                 = $this->session->userdata('empresa');
        $operacao['cpfcnpj']                 = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        $operacao['tipooperacao']            = $this->input->post('tipooperacao');
        $operacao['finalidade']              = $this->input->post('finalidade');
        $operacao['ciclocanoinicio']         = $this->input->post('ciclocanoinicio');
        $operacao['ciclocanofim']            = $this->input->post('ciclocanofim');
        
        // Exclui o registro
       $result = $this->modelOperacoes->excluir($operacao['empresa'],$operacao['cpfcnpj'],$operacao['tipooperacao'],$operacao['finalidade'],$operacao['ciclocanoinicio'],$operacao['ciclocanofim']);
          
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 50,
              'registro'=> 'Empresa:'. $operacao['empresa'] .  '; CPF/CNPJ: ' . $operacao['cpfcnpj'] . '; tipooperacao:'. $operacao['tipooperacao'] . '; finalidade:'. $operacao['finalidade']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Controle de Operação Excluído com sucesso.';
        }else{
            $mensagem = 'Erro ao Excluir Controle de Operação.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }

    public function dadosGrid(){
        // Carrega o Model
        $this->load->model('M_Operacoes', 'modelOperacoes');

        // Carrega o Helper de Formatação
        $this->load->helper('format');

        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);

        // Busca os imoveis do cliente
        $result = $this->modelOperacoes->buscarDadosGrid($this->session->userdata('empresa'),$cpfcnpj); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
}
