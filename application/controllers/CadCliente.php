<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadCliente extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        $dados['nome_view'] = 'v_cadCliente';
        $dados['menus'] = $consulta->result_array();
        
        // Busca Tipos de Imóvel
        $this->load->model('M_TipoImovel', 'modelTipoImovel');
        $tiposImovel = $this->modelTipoImovel->buscaTipoImovelCombo();
        $dados['tiposImovel'] = $tiposImovel->result_array(); 
        
        // Busca Espécies de Imóvel para o combobox
        $this->load->model('M_EspecieImovel', 'modelEspecieImovel');
        $buscaEspeciesImovel = $this->modelEspecieImovel->buscaEspeciesImovelCombo();
        $dados['especiesImovel'] = $buscaEspeciesImovel->result_array();
        
        // Busca Espécies de Móvel para o combobox
        $this->load->model('M_EspecieMovel', 'modelEspecieMovel');
        $buscaEspeciesMovel = $this->modelEspecieMovel->buscaEspeciesMovelCombo();
        $dados['especiesMovel'] = $buscaEspeciesMovel->result_array();
        
        // Busca Estado de Conservação para o combobox
        $this->load->model('M_EstadoConservacao', 'modelEstadoConservacao');
        $buscaEstadosConservacao = $this->modelEstadoConservacao->buscaEstadoConservacaoCombo();
        $dados['estadosConservacao'] = $buscaEstadosConservacao->result_array();
        
        // Busca Espécies de Semovente para o combobox
        $this->load->model('M_EspecieSemovente', 'modelEspecieSemovente');
        $buscaEspeciesSemovente = $this->modelEspecieSemovente->buscaEspeciesSemoventeCombo();
        $dados['especiesSemovente'] = $buscaEspeciesSemovente->result_array();
        
        // Busca Finalidades para o combobox
        $this->load->model('M_FinalidadeSemovente', 'modelFinalidadeSemovente');
        $buscaFinalidadeSemovente = $this->modelFinalidadeSemovente->buscaFinalidadeCombo();
        $dados['finalidades'] = $buscaFinalidadeSemovente->result_array();
        
        // Busca Gravames para o combobox
        $this->load->model('M_Gravame', 'modelGravame');
        $buscaGravame = $this->modelGravame->buscaGravameCombo();
        $dados['gravames'] = $buscaGravame->result_array();
        
        // Busca Situação para o combobox
        $this->load->model('M_SituacaoPropriedade', 'modelSituacaoPropriedade');
        $buscaSituacaoPropriedade = $this->modelSituacaoPropriedade->buscaSituacaoPropriedadeCombo();
        $dados['situacoesPropriedade'] = $buscaSituacaoPropriedade->result_array(); 
        
        $this->load->view('v_layout',$dados);
    }
    
    public function buscaRegistro(){
        // Carrega o Model
        $this->load->model('M_Cliente', 'modelCliente');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega o CPF/CNPJ sem formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);

        // Busca o Registro
        $result = $this->modelCliente->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj);
        
        // Array Para preenchimento dos campos do formulário
        $camposForm = array();
        
        // Verifica se encontrou o registro e atribui os dados aos campos do formulário
        if($result->num_rows() > 0){
            $camposForm['cpfcnpj']        = format::formatarCPF_CNPJ($result->row()->cpfcnpj);
            $camposForm['nome']           = $result->row()->nome;
            $camposForm['rg']             = $result->row()->rg;
            $camposForm['cep']            = format::formatarCEP($result->row()->cep);
            $camposForm['endereco']       = $result->row()->endereco;
            $camposForm['nroendereco']    = $result->row()->nroendereco;
            $camposForm['complemento']    = $result->row()->complemento;
            $camposForm['bairro']         = $result->row()->bairro;
            $camposForm['municipio']      = $result->row()->municipio;
            $camposForm['uf']             = $result->row()->uf;
            $camposForm['fone1']          = format::formatarTelefone($result->row()->fone1);
            $camposForm['fone2']          = format::formatarTelefone($result->row()->fone2);
            $camposForm['email']          = $result->row()->email;
            $camposForm['nomeconjuge']    = $result->row()->nomeconjuge;
            $camposForm['rgconjuge']      = $result->row()->rgconjuge;
            $camposForm['cpfconjuge']     = format::formatarCPF_CNPJ($result->row()->cpfconjuge);
            $camposForm['agencia']        = $result->row()->agencia;
            $camposForm['nomeAgencia']    = $result->row()->nomeAgencia;
            $camposForm['prefixoAgencia'] = $result->row()->prefixoAgencia;
            $camposForm['conta']          = $result->row()->conta;
            // Botões
            $camposForm['btnIncluir']     = false;
            $camposForm['btnAlterar']     = true;
            $camposForm['btnExcluir']     = true;
        }else{
            $camposForm['cpfcnpj']        = '';
            $camposForm['nome']           = '';
            $camposForm['rg']             = '';
            $camposForm['cep']            = '';
            $camposForm['endereco']       = '';
            $camposForm['nroendereco']    = '';
            $camposForm['complemento']    = '';
            $camposForm['bairro']         = '';
            $camposForm['municipio']      = '';
            $camposForm['uf']             = '';
            $camposForm['fone1']          = '';
            $camposForm['fone2']          = '';
            $camposForm['email']          = '';
            $camposForm['nomeconjuge']    = '';
            $camposForm['rgconjuge']    = '';
            $camposForm['cpfconjuge']     = '';
            $camposForm['agencia']        = '';
            $camposForm['nomeAgencia']    = '';
            $camposForm['prefixoAgencia'] = '';
            $camposForm['conta']          = '';
            // Botões
            $camposForm['btnIncluir']     = true;
            $camposForm['btnAlterar']     = false;
            $camposForm['btnExcluir']    = false;
        }
        echo json_encode($camposForm);
    }
    
    public function incluir(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');

        // Carrega os Models
        $this->load->model('M_Cliente', 'modelCliente');
        $this->load->model('M_Semovente', 'modelSemovente');
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_Movel', 'modelMovel');
        
        // Cria array com os dados do cliente
        $cliente = array();
        $cliente['empresa']     = $this->session->userdata('empresa');
        $cliente['cpfcnpj']     = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        $cliente['nome']        = $this->input->post('nome');
        $cliente['rg']          = $this->input->post('rg');
        $cliente['cep']         = format::formatarCEP($this->input->post('cep'),false);
        $cliente['endereco']    = $this->input->post('endereco');
        $cliente['nroendereco'] = $this->input->post('nroendereco');
        $cliente['complemento'] = $this->input->post('complemento');
        $cliente['bairro']      = $this->input->post('bairro');
        $cliente['municipio']   = $this->input->post('municipio');           
        $cliente['fone1']       = format::formatarTelefone($this->input->post('fone1'),false);
        $cliente['fone2']       = format::formatarTelefone($this->input->post('fone2'),false);
        $cliente['email']       = $this->input->post('email');
        $cliente['nomeconjuge'] = $this->input->post('nomeconjuge');
        $cliente['rgconjuge']   = $this->input->post('rgconjuge');
        $cliente['cpfconjuge']  = format::formatarCPF_CNPJ($this->input->post('cpfconjuge'),false);
        $cliente['agencia']     = $this->input->post('agencia');
        $cliente['conta']       = $this->input->post('conta');
        $cliente['datacadastro']= date('Y-m-d');
        // Trata o Array setando como null os campos em branco
        $cliente = tratamento::null_array($cliente);
        
        // Insere os dados
        $result = $this->modelCliente->inserir($cliente);
        
        // Se conseguiu inserir
        if($result){
            // Decodifica o JSON enviado por post com os imoveis do grid
            $imoveis = json_decode($this->input->post('dadosImoveis'), true);
            // Se houver imoveis
            if($imoveis){
                // Percorre os imoveis inserindo um a um
                foreach($imoveis as $imovel){
                    // Trata o array para inserir null nos campos ao invés de vazio
                    $imovel = tratamento::null_array($imovel);
                    // Insere o registro
                    $this->modelImovel->inserir($imovel);
                }
            }
            // Decodifica o JSON enviado por post com os semoventes do grid
            $semoventes = json_decode($this->input->post('dadosSemoventes'), true);
            // Se houver semoventes
            if($semoventes){
                // Percorre os semoventes inserindo um a um
                foreach($semoventes as $semovente){
                    // Trata o array para inserir null nos campos ao invés de vazio
                    $semovente = tratamento::null_array($semovente);
                    // Insere o registro
                    $this->modelSemovente->inserir($semovente);
                }
            }
            // Decodifica o JSON enviado por post com os moveis do grid
            $moveis = json_decode($this->input->post('dadosMoveis'), true);
            // Se houver imoveis
            if($moveis){
                // Percorre os moveis inserindo um a um
                foreach($moveis as $movel){
                    // Trata o array para inserir null nos campos ao invés de vazio
                    $movel = tratamento::null_array($movel);
                    // Insere o registro
                    $this->modelMovel->inserir($movel);
                }
            }
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 31,
              'registro'=> 'CPF/CNPJ: ' . $cliente['cpfcnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Cliente inserido com sucesso.';
        }else{
            $mensagem = 'Erro ao inserir cliente.';

        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function alterar(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');

        // Carrega os Models
        $this->load->model('M_Cliente', 'modelCliente');
        $this->load->model('M_Semovente', 'modelSemovente');
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_Movel', 'modelMovel');

        // Cria array com os dados do cliente
        $cliente = array();
        $cliente['empresa']     = $this->session->userdata('empresa');
        $cliente['cpfcnpj']     = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        $cliente['nome']        = $this->input->post('nome');
        $cliente['rg']          = $this->input->post('rg');
        $cliente['cep']         = format::formatarCEP($this->input->post('cep'),false);
        $cliente['endereco']    = $this->input->post('endereco');
        $cliente['nroendereco'] = $this->input->post('nroendereco');
        $cliente['complemento'] = $this->input->post('complemento');
        $cliente['bairro']      = $this->input->post('bairro');
        $cliente['municipio']   = $this->input->post('municipio');           
        $cliente['fone1']       = format::formatarTelefone($this->input->post('fone1'),false);
        $cliente['fone2']       = format::formatarTelefone($this->input->post('fone2'),false);
        $cliente['email']       = $this->input->post('email');
        $cliente['nomeconjuge'] = $this->input->post('nomeconjuge');
        $cliente['rgconjuge']   = $this->input->post('rgconjuge');
        $cliente['cpfconjuge']  = format::formatarCPF_CNPJ($this->input->post('cpfconjuge'),false);
        $cliente['agencia']     = $this->input->post('agencia');
        $cliente['conta']       = $this->input->post('conta');
        
        // Trata o Array setando como null os campos em branco
        $cliente = tratamento::null_array($cliente);
        
        // Atualiza os dados
        $result = $this->modelCliente->alterar($cliente['empresa'],$cliente['cpfcnpj'], $cliente);
        
        // Se conseguiu inserir
        if($result){
            // Decodifica o JSON enviado por post com os imoveis do grid
            $imoveis = json_decode($this->input->post('dadosImoveis'), true);
            // Exclui todos os imoveis do cliente para reinserir
            if($this->modelImovel->excluir($cliente['empresa'],$cliente['cpfcnpj'])){
                // Se houver imoveis
                if($imoveis){
                    // Percorre os imoveis inserindo um a um
                    foreach($imoveis as $imovel){
                        // Trata o array para inserir null nos campos ao invés de vazio
                        $imovel = tratamento::null_array($imovel);
                        // Insere o registro
                        $this->modelImovel->inserir($imovel);
                    }
                }
            }
            // Decodifica o JSON enviado por post com os semoventes do grid
            $semoventes = json_decode($this->input->post('dadosSemoventes'), true);
            // Exclui todos os semoventes do cliente para reinserir
            if($this->modelSemovente->excluir($cliente['empresa'],$cliente['cpfcnpj'])){
                // Se houver semoventes
                if($semoventes){
                    // Percorre os semoventes inserindo um a um
                    foreach($semoventes as $semovente){
                        // Trata o array para inserir null nos campos ao invés de vazio
                        $semovente = tratamento::null_array($semovente);
                        // Insere o registro
                        $this->modelSemovente->inserir($semovente);
                    }
                }
            }
            // Decodifica o JSON enviado por post com os moveis do grid
            $moveis = json_decode($this->input->post('dadosMoveis'), true);
            // Exclui todos os imoveis do cliente para reinserir
            if($this->modelMovel->excluir($cliente['empresa'],$cliente['cpfcnpj'])){
                // Se houver imoveis
                if($moveis){
                    // Percorre os imoveis inserindo um a um
                    foreach($moveis as $movel){
                        // Trata o array para inserir null nos campos ao invés de vazio
                        $movel = tratamento::null_array($movel);
                        // Insere o registro
                        $this->modelMovel->inserir($movel);
                    }
                }
            }
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 32,
              'registro'=> 'CPF/CNPJ: ' . $cliente['cpfcnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Cliente alterado com sucesso.';
        }else{
            $mensagem = 'Erro ao alterar cliente.';

        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function excluir(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega os Models
        $this->load->model('M_Cliente', 'modelCliente');
        $this->load->model('M_Semovente', 'modelSemovente');
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_Movel', 'modelMovel');

        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);

        /*
         *  ANTES DE EXCLUIR O REGISTRO, VERIFICAR TODAS AS TABELAS QUE POSSUE RELAÇÃO E 
         *  SE TIVER, APRESENTAR UMA MENSAGEM AMIGÁVEL AO USUÁRIO.
         * 
         */
        $qtdImoveis = $this->modelImovel->buscarQtdImoveis($this->session->userdata('empresa'),$cpfcnpj); 
        $qtdSemoventes = $this->modelSemovente->buscarQtdSemoventes($this->session->userdata('empresa'),$cpfcnpj); 
        $qtdMoveis = $this->modelMovel->buscarQtdMoveis($this->session->userdata('empresa'),$cpfcnpj); 
        
        // Verifica se possui Semoventes, Imóveis ou Móveis
        if($qtdSemoventes > 0 || $qtdImoveis > 0 || $qtdMoveis > 0){
            $mensagem = '<strong>Não foi possível a exclusão.</br> Cliente Possui Vínculos:</strong></br> ';
            $mensagem .= $qtdImoveis . ' Imóveis(s), ';
            $mensagem .= $qtdSemoventes . ' Semovente(s), ';
            $mensagem .= $qtdMoveis . ' Móveis(s). ';
        }else{
            $this->modelCliente->excluir($this->session->userdata('empresa'),$cpfcnpj);
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 33,
              'registro'=> 'CPF/CNPJ: ' . $cpfcnpj
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem de alerta
            $mensagem = 'Cliente excluído com sucesso.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    // Função responsável por carregar os municípios de acordo com a UF selecionada
    public function carregarMunicipio(){
        // Carrega o Model
        $this->load->model('M_Municipio', 'modelMunicipio');
        
        // Busca o Registro
        $resultBusca = $this->modelMunicipio->buscarMunicipiosUF($this->input->get('uf'));
        
        // Imprime a primeira opção sem valor
        echo '<option value=\'\'>Selecione o Município</option>';
        
        // Percorre os Municípios encontrados imprimindo a opção
        foreach ($resultBusca->result() as $municipio){
            // Converte o municipio tratando os acentos e passando em maiúsculo
            $municipioDesc = mb_strtoupper(urldecode($this->input->get('municipioDesc')),'UTF-8');
            // Se foi o Municipio buscado pelo usuário marca como selected
            if(($this->input->get('municipioID') == $municipio->id) || ($municipioDesc == $municipio->nome)){
                echo '<option value=\''.$municipio->id.'\' selected=\'selected\' >'.$municipio->nome.'</option>';
            }else{
                echo '<option value=\''.$municipio->id.'\'>'.$municipio->nome.'</option>';
            }
        }
    }
    
    // Função responsável por carregar as raças do combobox
    public function carregarRaca(){
        // Carrega o Model
        $this->load->model('M_Raca', 'modelRaca');
        
        // Busca o Registro
        $resultBusca = $this->modelRaca->buscaRacaCombo($this->input->get('especie'));
        
        // Percorre os Municípios encontrados imprimindo a opção
        foreach ($resultBusca->result() as $raca){
            $selected = ($this->input->get('raca') == $raca->id) ? 'selected=\'selected\'' : '';
            echo '<option '. $selected . ' value=\''.$raca->id.'\'>'.$raca->nome.'</option>';
        }
    }

    public function dadosGridProcCliente(){
        // Carrega o Model
        $this->load->model('M_Cliente', 'modelCliente');
        
        // Busca os imoveis do cliente
        $result = $this->modelCliente->buscarClienteProcura($this->session->userdata('empresa'),$this->input->get('nome')); 
        
        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }    
    
    public function dadosGridRurais(){
        // Carrega o Model
        $this->load->model('M_Imovel', 'modelImovel');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);
        
        // Busca os imoveis do cliente
        $result = $this->modelImovel->buscarDadosRurais($this->session->userdata('empresa'),$cpfcnpj); 
        
        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
    
    public function dadosGridUrbanos(){
        // Carrega o Model
        $this->load->model('M_Imovel', 'modelImovel');

        // Carrega o Helper de Formatação
        $this->load->helper('format');

        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);

        // Busca os imoveis do cliente
        $result = $this->modelImovel->buscarDadosUrbanos($this->session->userdata('empresa'),$cpfcnpj); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
        
    public function dadosGridSemovente(){
        // Carrega o Model
        $this->load->model('M_Semovente', 'modelSemovente');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);
        
        // Busca os semoventes do cliente
        $result = $this->modelSemovente->buscarDadosSemoventes($this->session->userdata('empresa'),$cpfcnpj); 
        
        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
    
    public function dadosGridMovel(){
        // Carrega o Model
        $this->load->model('M_Movel', 'modelMovel');

        // Carrega o Helper de Formatação
        $this->load->helper('format');

        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);

        // Busca os imoveis do cliente
        $result = $this->modelMovel->buscarDadosMoveis($this->session->userdata('empresa'),$cpfcnpj); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
}