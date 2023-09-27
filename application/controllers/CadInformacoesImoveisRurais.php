<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadInformacoesImoveisRurais extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_cadInformacoesImoveisRurais';
        
        // Busca as benfeitorias
        $this->load->model('M_Benfeitoria', 'modelBenfeitoria');
        $tiposBenfeitoria = $this->modelBenfeitoria->buscaBenfeitoriaCombo();
        $dados['tiposBenfeitoria'] = $tiposBenfeitoria->result_array(); 
        
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        $this->load->view('v_layout',$dados);
    }
    
    public function confirmar(){
        // Carrega o Models
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_ImovelSolo', 'modelImovelSolo');
        $this->load->model('M_ImovelProprietario', 'modelImovelProprietario');
        $this->load->model('M_ImovelBenfeitoria', 'modelImovelBenfeitoria');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
                
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');
        
        // Pega os parametros passados
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
       
        // Prepara o Array com os dados a serem inseridos
        $dadosImovel = array(
            'id' => $this->input->post('idImovel'),
            'endereco' => $this->input->post('endereco'),
            'areatotal' => format::monetarioTofloat($this->input->post('areatotal')),
            'valorhectare' => format::monetarioTofloat($this->input->post('valorhectare')),
            'valorterranua' => format::monetarioTofloat($this->input->post('valorterranua'))
        );
        
        // Insere os dados
        $result = $this->modelImovel->alterarInformacoesImovel($this->session->userdata('empresa'),$cpfcnpj,$dadosImovel['id'],$dadosImovel);
        
        // Se conseguiu inserir
        if($result){
            // Decodifica o JSON enviado por post com os solos do grid
            $solos = json_decode($this->input->post('dadosSolo'), true);
            // Exclui todos os solos do cliente para reinserir
            if($this->modelImovelSolo->excluir($this->session->userdata('empresa'),$cpfcnpj,$dadosImovel['id'])){
                // Se houver solos
                if($solos){
                    // Percorre os solos inserindo um a um
                    foreach($solos as $solo){
                        // Trata o array para inserir null nos campos ao invés de vazio
                        $solo = tratamento::null_array($solo);
                        // Insere o registro
                        $this->modelImovelSolo->inserir($solo);
                    }
                }
            }

            // Decodifica o JSON enviado por post com os proprietarios do grid
            $proprietarios = json_decode($this->input->post('dadosProprietario'), true);
            // Exclui todos os proprietarios do cliente para reinserir
            if($this->modelImovelProprietario->excluir($this->session->userdata('empresa'),$cpfcnpj,$dadosImovel['id'])){
                // Se houver proprietarios
                if($proprietarios){
                    // Percorre os proprietarios inserindo um a um
                    foreach($proprietarios as $proprietario){
                        // Trata o array para inserir null nos campos ao invés de vazio
                        $proprietario = tratamento::null_array($proprietario);
                        // Insere o registro
                        $this->modelImovelProprietario->inserir($proprietario);
                    }
                }
            }

            // Decodifica o JSON enviado por post com os benfeitorias do grid
            $benfeitorias = json_decode($this->input->post('dadosBenfeitoria'), true);
            // Exclui todos os benfeitorias do cliente para reinserir
            if($this->modelImovelBenfeitoria->excluir($this->session->userdata('empresa'),$cpfcnpj,$dadosImovel['id'])){
                // Se houver benfeitorias
                if($benfeitorias){
                    // Percorre os benfeitorias inserindo um a um
                    foreach($benfeitorias as $benfeitoria){
                        // Trata o array para inserir null nos campos ao invés de vazio
                        $benfeitoria = tratamento::null_array($benfeitoria);
                        // Insere o registro
                        $this->modelImovelBenfeitoria->inserir($benfeitoria);
                    }
                }
            }
                        
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 47,
              'registro'=> 'Imóvel: ' . $this->input->post('idImovel')
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Informações atualizadas com sucesso.';
        }else{
            $mensagem = 'Erro ao atualizar informações.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function dadosGridSolo(){
        // Carrega o Model
        $this->load->model('M_ImovelSolo', 'modelImovelSolo');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);
        
        $result = $this->modelImovelSolo->buscarDadosGrid($this->session->userdata('empresa'),$cpfcnpj, $this->input->get('imovel')); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
    
    public function dadosGridProprietario(){
        // Carrega o Model
        $this->load->model('M_ImovelProprietario', 'modelImovelProprietario');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);
        
        $result = $this->modelImovelProprietario->buscarDadosGrid($this->session->userdata('empresa'),$cpfcnpj, $this->input->get('imovel')); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
    
    public function dadosGridBenfeitoria(){
        // Carrega o Model
        $this->load->model('M_ImovelBenfeitoria', 'modelImovelBenfeitoria');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);
        
        $result = $this->modelImovelBenfeitoria->buscarDadosGrid($this->session->userdata('empresa'),$cpfcnpj, $this->input->get('imovel')); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
}
