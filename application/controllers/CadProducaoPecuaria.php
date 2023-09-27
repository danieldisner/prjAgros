<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadProducaoPecuaria extends MY_Controller{

    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        $dados['nome_view'] = 'v_cadProducaoPecuaria';
        $dados['menus'] = $consulta->result_array();
        
        // Busca Atividades Pecuária para o combobox
        $this->load->model('M_AtividadePecuaria', 'modelAtividadePecuaria');
        $buscaAtividadePecuaria = $this->modelAtividadePecuaria->buscaAtividadePecuariaCombo();
        $dados['atividadesPecuaria'] = $buscaAtividadePecuaria->result_array();
        
        $this->load->view('v_layout',$dados);
    }

    public function buscaRegistro(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Model
        $this->load->model('M_ExploracaoPecuaria', 'modelExploracaoPecuaria');
        $this->load->model('M_ProdutosSencudariosExploracaoPecuaria', 'modelProdutosSencudariosExploracaoPecuaria');
        $this->load->model('M_ImovelExploradoPecuaria', 'modelImovelExploradoPecuaria');
        
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
              
        // Busca o Registro
        $result = $this->modelExploracaoPecuaria->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj,$this->input->post('id'));
        
        // Verifica se encontrou o registro e atribui os dados aos campos do formulário
        if($result->num_rows() > 0){
            $camposForm['idProducao']                  = $result->row()->id;
            $camposForm['municipio']                   = $result->row()->municipio;
            $camposForm['atividade']                   = $result->row()->atividade;
            $camposForm['sistemaproducaoobtida']       = $result->row()->sistemaproducaoobtida;
            $camposForm['sistemaproducaoprevista']     = $result->row()->sistemaproducaoprevista;
            $camposForm['produtividadeobtida']         = number_format($result->row()->produtividadeobtida, 2, ',', '.');
            $camposForm['produtividadeprevista']       = number_format($result->row()->produtividadeprevista, 2, ',', '.');

            // Tratamento dos campos da Data (ano[0] mes[1] dia[2])           
            $arrayDataInicioProducaoObtida = explode('-', $result->row()->datainicioproducaoobtida);
            $arrayDataFimProducaoObtida = explode('-', $result->row()->datafimproducaoobtida);    
            
            $arrayDataInicioProducaoPrevista = explode('-', $result->row()->datainicioproducaoprevista);
            $arrayDataFimProducaoPrevisa = explode('-', $result->row()->datafimproducaoprevista); 
            
            // Verificação das datas            
            $camposForm['producaoObtidaMes1']            = $arrayDataInicioProducaoObtida[1];
            $camposForm['producaoObtidaAno1']            = $arrayDataInicioProducaoObtida[0];
            $camposForm['producaoObtidaMes2']            = $arrayDataFimProducaoObtida[1];
            $camposForm['producaoObtidaAno2']            = $arrayDataFimProducaoObtida[0];
            
            $camposForm['producaoPrevistaMes1']          = $arrayDataInicioProducaoPrevista[1];
            $camposForm['producaoPrevistaAno1']          = $arrayDataInicioProducaoPrevista[0];
            $camposForm['producaoPrevistaMes2']          = $arrayDataFimProducaoPrevisa[1];
            $camposForm['producaoPrevistaAno2']          = $arrayDataFimProducaoPrevisa[0];
            
            // Campos
            $camposForm['participacaoobtida']                       = $result->row()->participacaoobtida;
            $camposForm['participacaoprevista']                     = $result->row()->participacaoprevista;
            $camposForm['quantidadeobtida']                         = number_format($result->row()->quantidadeobtida, 2, ',', '.');
            $camposForm['quantidadeprevista']                       = number_format($result->row()->quantidadeprevista, 2, ',', '.');
            $camposForm['quantidadeciclosanoobtida']                = number_format($result->row()->quantidadeciclosanoobtida, 2, ',', '.');
            $camposForm['quantidadeciclosanoprevista']              = number_format($result->row()->quantidadeciclosanoprevista, 2, ',', '.');
            $camposForm['precoobtida']                              = number_format($result->row()->precoobtida, 4, ',', '.');
            $camposForm['precoprevista']                            = number_format($result->row()->precoprevista, 4, ',', '.');
            $camposForm['producaototalobtida']                      = number_format($result->row()->producaototalobtida, 2, ',', '.');
            $camposForm['producaototalprevista']                    = number_format($result->row()->producaototalprevista, 2, ',', '.');
            $camposForm['producaounidadefinanciamentoobtida']       = number_format($result->row()->producaounidadefinanciamentoobtida, 2, ',', '.');
            $camposForm['producaounidadefinanciamentoprevista']     = number_format($result->row()->producaounidadefinanciamentoprevista, 2, ',', '.');
            $camposForm['custoproducaoobtida']                      = number_format($result->row()->custoproducaoobtida, 2, ',', '.');
            $camposForm['custoproducaoprevista']                    = number_format($result->row()->custoproducaoprevista, 2, ',', '.');
            $camposForm['custoproducaounidadeobtida']               = number_format($result->row()->custoproducaounidadeobtida, 2, ',', '.');
            $camposForm['custoproducaounidadeprevista']             = number_format($result->row()->custoproducaounidadeprevista, 2, ',', '.');
            $camposForm['receitacomvendaobtida']                    = number_format($result->row()->receitacomvendaobtida, 2, ',', '.');
            $camposForm['receitacomvendaprevista']                  = number_format($result->row()->receitacomvendaprevista, 2, ',', '.');
            $camposForm['receitatotalobtida']                       = number_format($result->row()->receitatotalobtida, 2, ',', '.');
            $camposForm['receitatotalprevista']                     = number_format($result->row()->receitatotalprevista, 2, ',', '.');            
            $camposForm['receitatotalunidadefinanciamentoobtida']   = number_format($result->row()->receitatotalunidadefinanciamentoobtida, 2, ',', '.');
            $camposForm['receitatotalunidadefinanciamentoprevista'] = number_format($result->row()->receitatotalunidadefinanciamentoprevista, 2, ',', '.');  
            $camposForm['custototalcomarrendamentoobtida']          = number_format($result->row()->custototalcomarrendamentoobtida, 2, ',', '.');
            $camposForm['custototalcomarrendamentoprevista']        = number_format($result->row()->custototalcomarrendamentoprevista, 2, ',', '.');  
            $camposForm['receitaliquidaanoobtida']                  = number_format($result->row()->receitaliquidaanoobtida, 2, ',', '.');
            $camposForm['receitaliquidaanoprevista']                = number_format($result->row()->receitaliquidaanoprevista, 2, ',', '.');
            $camposForm['tratoresimplementosterceirosobtida']       = number_format($result->row()->tratoresimplementosterceirosobtida, 2, ',', '.');
            $camposForm['tratoresimplementosterceirosprevista']     = number_format($result->row()->tratoresimplementosterceirosprevista, 2, ',', '.');
            
            // Busca os Produtos Secundários
            $produtosSecundarios = $this->modelProdutosSencudariosExploracaoPecuaria->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$this->input->post('id'));
           
                 // Cria um Objeto JSON para preencher os dados dos Produtos Secundários
            $camposForm['produtosSecundarios'] = json_encode($produtosSecundarios);
            
            // Busca o Registro dos Imóveis Explorados
            $imoveisExploradosPecuaria = $this->modelImovelExploradoPecuaria->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$this->input->post('id'));
           
            // Cria um Objeto JSON para preencher os dados da tabela de exploração de imóveis 
            $camposForm['areaImoveisExplorados'] = json_encode($imoveisExploradosPecuaria);
            
            // Botões
            $camposForm['btnIncluir']               = false;
            $camposForm['btnAlterar']               = true;
            $camposForm['btnExcluir']               = true;
        }else{
            // Seta os valores iniciais para "limpar" os campo
            $camposForm['id']                           = '';
            $camposForm['atividade']                    = '1';
            $camposForm['municipio']                    = '';
            $camposForm['producaoObtidaMes1']           = '01';
            $camposForm['producaoObtidaMes2']           = '01';
            $camposForm['producaoPrevistaMes1']         = '01';
            $camposForm['producaoPrevistaMes2']         = '01';
            
            // Botões
            $camposForm['btnIncluir']               = !empty($cpfcnpj)  ? true : false;
            $camposForm['btnAlterar']               = false;
            $camposForm['btnExcluir']               = false;
        }
        echo json_encode($camposForm);
    }

    public function incluir(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Datas
        $this->load->helper('dateutil');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');

        // Carrega os Models
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_ExploracaoPecuaria', 'modelExploracaoPecuaria');
        $this->load->model('M_ProdutosSencudariosExploracaoPecuaria', 'modelProdutosSencudariosExploracaoPecuaria');
        $this->load->model('M_ImovelExploradoPecuaria', 'modelImovelExploradoPecuaria');
        
        // Recupera o CPF/CNPJ enviado por post sem a formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Decodifica o JSON enviado por post com os dados dos Imóveis utilizados na Exploração Ágricola
        $imoveisExplorados = json_decode($this->input->post('dadosImoveisExploradosPecuaria'), true);
        
        // Se houver imoveis atualiza aqueles que são explorados
        if($imoveisExplorados){
            // Percorre os imoveis atualizando um a um
            foreach($imoveisExplorados as $imovel){
                // Trata o array para inserir null nos campos ao invés de vazio
                $imovel = tratamento::null_array($imovel);
                // Atualiza o Registro
                $this->modelImovel->alterarImovelExploracaoPecuaria($this->session->userdata('empresa'),$cpfcnpj,$imovel['id'],$imovel['explorado']);
            }
        }
                
        // Pega os Períodos informados e Transforma em Arrays
        $arrayDataProducaoObtida = dateUtil::periodoToArrayDatas($this->input->post('producaoObtidaMes1'), $this->input->post('producaoObtidaAno1'), $this->input->post('producaoObtidaMes2'), $this->input->post('producaoObtidaAno2'));
        $arrayDataProducaoPrevista = dateUtil::periodoToArrayDatas($this->input->post('producaoPrevistaMes1'), $this->input->post('producaoPrevistaAno1'), $this->input->post('producaoPrevistaMes2'), $this->input->post('producaoPrevistaAno2')); 
        
        // Procura Próximo ID para o registro
        $proximoID = $this->modelExploracaoPecuaria->nextID($this->session->userdata('empresa'),$cpfcnpj);
        
        // Cria o array com os dados da produção pecuária
        $producaoPecuaria = array();
        $producaoPecuaria['empresa']                                = $this->session->userdata('empresa');
        $producaoPecuaria['id']                                     = $proximoID;
        $producaoPecuaria['cpfcnpj']                                = $cpfcnpj;
        $producaoPecuaria['municipio']                              = $this->input->post('municipio');
        $producaoPecuaria['atividade']                              = $this->input->post('atividade');
        $producaoPecuaria['sistemaproducaoobtida']                  = $this->input->post('sistemaproducaoobtida');
        $producaoPecuaria['sistemaproducaoprevista']                = $this->input->post('sistemaproducaoprevista');
        $producaoPecuaria['produtividadeobtida']                    = format::monetarioTofloat($this->input->post('produtividadeobtida'));
        $producaoPecuaria['produtividadeprevista']                  = format::monetarioTofloat($this->input->post('produtividadeprevista'));

        // Datas
        $producaoPecuaria['datainicioproducaoobtida']               = dateUtil::formatDateDB($arrayDataProducaoObtida['dataInicio']);
        $producaoPecuaria['datafimproducaoobtida']                  = dateUtil::formatDateDB($arrayDataProducaoObtida['dataFim']);
        $producaoPecuaria['datainicioproducaoprevista']             = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataInicio']);
        $producaoPecuaria['datafimproducaoprevista']                = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataFim']);

        $producaoPecuaria['participacaoobtida']                     = $this->input->post('participacaoobtida');
        $producaoPecuaria['participacaoprevista']                   = $this->input->post('participacaoprevista');
        
        $producaoPecuaria['quantidadeobtida']                           = format::monetarioTofloat($this->input->post('quantidadeobtida'));
        $producaoPecuaria['quantidadeprevista']                         = format::monetarioTofloat($this->input->post('quantidadeprevista'));
        $producaoPecuaria['quantidadeciclosanoobtida']                  = format::monetarioTofloat($this->input->post('quantidadeciclosanoobtida'));
        $producaoPecuaria['quantidadeciclosanoprevista']                = format::monetarioTofloat($this->input->post('quantidadeciclosanoprevista'));
        $producaoPecuaria['precoobtida']                                = format::monetarioTofloat($this->input->post('precoobtida'));
        $producaoPecuaria['precoprevista']                              = format::monetarioTofloat($this->input->post('precoprevista'));
        
        $producaoPecuaria['producaototalobtida']                        = format::monetarioTofloat($this->input->post('producaototalobtida'));
        $producaoPecuaria['producaototalprevista']                      = format::monetarioTofloat($this->input->post('producaototalprevista'));
        $producaoPecuaria['producaounidadefinanciamentoobtida']         = format::monetarioTofloat($this->input->post('producaounidadefinanciamentoobtida'));
        $producaoPecuaria['producaounidadefinanciamentoprevista']       = format::monetarioTofloat($this->input->post('producaounidadefinanciamentoprevista'));
        $producaoPecuaria['custoproducaoobtida']                        = format::monetarioTofloat($this->input->post('custoproducaoobtida'));
        $producaoPecuaria['custoproducaoprevista']                      = format::monetarioTofloat($this->input->post('custoproducaoprevista'));
        $producaoPecuaria['custoproducaounidadeobtida']                 = format::monetarioTofloat($this->input->post('custoproducaounidadeobtida'));
        $producaoPecuaria['custoproducaounidadeprevista']               = format::monetarioTofloat($this->input->post('custoproducaounidadeprevista'));
        $producaoPecuaria['receitacomvendaobtida']                      = format::monetarioTofloat($this->input->post('receitacomvendaobtida'));
        $producaoPecuaria['receitacomvendaprevista']                    = format::monetarioTofloat($this->input->post('receitacomvendaprevista'));
        $producaoPecuaria['receitatotalobtida']                         = format::monetarioTofloat($this->input->post('receitatotalobtida'));
        $producaoPecuaria['receitatotalprevista']                       = format::monetarioTofloat($this->input->post('receitatotalprevista'));
        $producaoPecuaria['receitatotalunidadefinanciamentoobtida']     = format::monetarioTofloat($this->input->post('receitatotalunidadefinanciamentoobtida'));
        $producaoPecuaria['receitatotalunidadefinanciamentoprevista']   = format::monetarioTofloat($this->input->post('receitatotalunidadefinanciamentoprevista'));
        
        $producaoPecuaria['custototalcomarrendamentoobtida']            = format::monetarioTofloat($this->input->post('custototalcomarrendamentoobtida'));
        $producaoPecuaria['custototalcomarrendamentoprevista']          = format::monetarioTofloat($this->input->post('custototalcomarrendamentoprevista'));
        $producaoPecuaria['receitaliquidaanoobtida']                    = format::monetarioTofloat($this->input->post('receitaliquidaanoobtida'));
        $producaoPecuaria['receitaliquidaanoprevista']                  = format::monetarioTofloat($this->input->post('receitaliquidaanoprevista'));
       
        $producaoPecuaria['tratoresimplementosterceirosobtida']         = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosobtida'));
        $producaoPecuaria['tratoresimplementosterceirosprevista']       = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosprevista'));
        
        // Trata o Array setando como null os campos em branco
        $producaoPecuaria = tratamento::null_array($producaoPecuaria);
        
        // Insere os dados
        $result = $this->modelExploracaoPecuaria->inserir($producaoPecuaria);
        
        // Inserção dos Produtos secundários:
        for($i=2;$i<8;$i++){
            // Adiciona os campos necessários para inclusão
            if(!empty($this->input->post('vendasproduto'.$i.'obtida')) || !empty($this->input->post('vendasproduto'.$i.'obtida'))){
                $produtoSecundario = array();
                $produtoSecundario['empresa'] = $this->session->userdata('empresa');
                $produtoSecundario['id'] = $i;
                $produtoSecundario['cpfcnpj'] = $cpfcnpj;
                $produtoSecundario['exploracaopecuaria'] = $proximoID;
                $produtoSecundario['vendasobtida'] = format::monetarioTofloat($this->input->post('vendasproduto'.$i.'obtida'));
                $produtoSecundario['vendasprevista'] = format::monetarioTofloat($this->input->post('vendasproduto'.$i.'prevista'));
                // Trata o array para inserir null nos campos ao invés de vazio
                $produtoSecundario = tratamento::null_array($produtoSecundario);
                // Atualiza o Registro
                $this->modelProdutosSencudariosExploracaoPecuaria->inserir($produtoSecundario);
            }
        }
        
        // Decodifica o JSON enviado por post com os dados dos Imóveis utilizados na Exploração Pecuária
        $areasExploradasImoveis = json_decode($this->input->post('dadosAreaExploradaImoveis'), true);
        
        // Se houver imoveis atualiza aqueles que são explorados
        if($areasExploradasImoveis){
            // Percorre os imoveis atualizando um a um
            foreach($areasExploradasImoveis as $exploracaoImovel){
                // Trata o array para inserir null nos campos ao invés de vazio
                $exploracaoImovel = tratamento::null_array($exploracaoImovel);
                // Adiciona os campos necessários para inclusão
                $exploracaoImovel['empresa'] = $this->session->userdata('empresa');
                $exploracaoImovel['cpfcnpj'] = $cpfcnpj;
                $exploracaoImovel['exploracaopecuaria'] = $proximoID;
                $exploracaoImovel['areaexploradaobtida'] = format::monetarioTofloat($exploracaoImovel['areaexploradaobtida']);
                $exploracaoImovel['areaexploradaprevista'] = format::monetarioTofloat($exploracaoImovel['areaexploradaprevista']);
                // Atualiza o Registro
                $this->modelImovelExploradoPecuaria->inserir($exploracaoImovel);
            }
        }
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 44,
              'registro'=> 'Empresa:'. $producaoPecuaria['empresa'] . '; ID:'. $producaoPecuaria['id'] .  '; CPF/CNPJ: ' . $producaoPecuaria['cpfcnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Produção Pecuária inserida com sucesso.';
        }else{
            $mensagem = 'Erro ao inserir Produção Pecuária.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function alterar(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Datas
        $this->load->helper('dateutil');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');

        // Carrega os Models
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_ExploracaoPecuaria', 'modelExploracaoPecuaria');
        $this->load->model('M_ProdutosSencudariosExploracaoPecuaria', 'modelProdutosSencudariosExploracaoPecuaria');
        $this->load->model('M_ImovelExploradoPecuaria', 'modelImovelExploradoPecuaria');
        
        // Recupera o CPF/CNPJ enviado por post sem a formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Decodifica o JSON enviado por post com os dados dos Imóveis utilizados na Exploração Pecuária
        $imoveisExplorados = json_decode($this->input->post('dadosImoveisExploradosPecuaria'), true);
        
        // Se houver imoveis atualiza aqueles que são explorados
        if($imoveisExplorados){
            // Percorre os imoveis atualizando um a um
            foreach($imoveisExplorados as $imovel){
                // Trata o array para inserir null nos campos ao invés de vazio
                $imovel = tratamento::null_array($imovel);
                // Atualiza o Registro
                $this->modelImovel->alterarImovelExploracaoPecuaria($this->session->userdata('empresa'),$cpfcnpj,$imovel['id'],$imovel['explorado']);
            }
        }
        
        // Pega os Períodos informados e Transforma em Arrays
        $arrayDataProducaoObtida = dateUtil::periodoToArrayDatas($this->input->post('producaoObtidaMes1'), $this->input->post('producaoObtidaAno1'), $this->input->post('producaoObtidaMes2'), $this->input->post('producaoObtidaAno2'));
        $arrayDataProducaoPrevista = dateUtil::periodoToArrayDatas($this->input->post('producaoPrevistaMes1'), $this->input->post('producaoPrevistaAno1'), $this->input->post('producaoPrevistaMes2'), $this->input->post('producaoPrevistaAno2')); 
        
        // Cria o array com os dados da produção pecuária
        $producaoPecuaria = array();
        $producaoPecuaria['empresa']                                = $this->session->userdata('empresa');
        $producaoPecuaria['id']                                     = $this->input->post('idProducao');
        $producaoPecuaria['cpfcnpj']                                = $cpfcnpj;
        $producaoPecuaria['municipio']                              = $this->input->post('municipio');
        $producaoPecuaria['atividade']                              = $this->input->post('atividade');
        $producaoPecuaria['sistemaproducaoobtida']                  = $this->input->post('sistemaproducaoobtida');
        $producaoPecuaria['sistemaproducaoprevista']                = $this->input->post('sistemaproducaoprevista');
        $producaoPecuaria['produtividadeobtida']                    = format::monetarioTofloat($this->input->post('produtividadeobtida'));
        $producaoPecuaria['produtividadeprevista']                  = format::monetarioTofloat($this->input->post('produtividadeprevista'));

        // Datas
        $producaoPecuaria['datainicioproducaoobtida']               = dateUtil::formatDateDB($arrayDataProducaoObtida['dataInicio']);
        $producaoPecuaria['datafimproducaoobtida']                  = dateUtil::formatDateDB($arrayDataProducaoObtida['dataFim']);
        $producaoPecuaria['datainicioproducaoprevista']             = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataInicio']);
        $producaoPecuaria['datafimproducaoprevista']                = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataFim']);

        $producaoPecuaria['participacaoobtida']                     = $this->input->post('participacaoobtida');
        $producaoPecuaria['participacaoprevista']                   = $this->input->post('participacaoprevista');
        
        $producaoPecuaria['quantidadeobtida']                           = format::monetarioTofloat($this->input->post('quantidadeobtida'));
        $producaoPecuaria['quantidadeprevista']                         = format::monetarioTofloat($this->input->post('quantidadeprevista'));
        $producaoPecuaria['quantidadeciclosanoobtida']                  = format::monetarioTofloat($this->input->post('quantidadeciclosanoobtida'));
        $producaoPecuaria['quantidadeciclosanoprevista']                = format::monetarioTofloat($this->input->post('quantidadeciclosanoprevista'));
        $producaoPecuaria['precoobtida']                                = format::monetarioTofloat($this->input->post('precoobtida'));
        $producaoPecuaria['precoprevista']                              = format::monetarioTofloat($this->input->post('precoprevista'));
        
        $producaoPecuaria['producaototalobtida']                        = format::monetarioTofloat($this->input->post('producaototalobtida'));
        $producaoPecuaria['producaototalprevista']                      = format::monetarioTofloat($this->input->post('producaototalprevista'));
        $producaoPecuaria['producaounidadefinanciamentoobtida']         = format::monetarioTofloat($this->input->post('producaounidadefinanciamentoobtida'));
        $producaoPecuaria['producaounidadefinanciamentoprevista']       = format::monetarioTofloat($this->input->post('producaounidadefinanciamentoprevista'));
        $producaoPecuaria['custoproducaoobtida']                        = format::monetarioTofloat($this->input->post('custoproducaoobtida'));
        $producaoPecuaria['custoproducaoprevista']                      = format::monetarioTofloat($this->input->post('custoproducaoprevista'));
        $producaoPecuaria['custoproducaounidadeobtida']                 = format::monetarioTofloat($this->input->post('custoproducaounidadeobtida'));
        $producaoPecuaria['custoproducaounidadeprevista']               = format::monetarioTofloat($this->input->post('custoproducaounidadeprevista'));
        $producaoPecuaria['receitacomvendaobtida']                      = format::monetarioTofloat($this->input->post('receitacomvendaobtida'));
        $producaoPecuaria['receitacomvendaprevista']                    = format::monetarioTofloat($this->input->post('receitacomvendaprevista'));
        $producaoPecuaria['receitatotalobtida']                         = format::monetarioTofloat($this->input->post('receitatotalobtida'));
        $producaoPecuaria['receitatotalprevista']                       = format::monetarioTofloat($this->input->post('receitatotalprevista'));
        $producaoPecuaria['receitatotalunidadefinanciamentoobtida']     = format::monetarioTofloat($this->input->post('receitatotalunidadefinanciamentoobtida'));
        $producaoPecuaria['receitatotalunidadefinanciamentoprevista']   = format::monetarioTofloat($this->input->post('receitatotalunidadefinanciamentoprevista'));
        
        $producaoPecuaria['custototalcomarrendamentoobtida']            = format::monetarioTofloat($this->input->post('custototalcomarrendamentoobtida'));
        $producaoPecuaria['custototalcomarrendamentoprevista']          = format::monetarioTofloat($this->input->post('custototalcomarrendamentoprevista'));
        $producaoPecuaria['receitaliquidaanoobtida']                    = format::monetarioTofloat($this->input->post('receitaliquidaanoobtida'));
        $producaoPecuaria['receitaliquidaanoprevista']                  = format::monetarioTofloat($this->input->post('receitaliquidaanoprevista'));
       
        $producaoPecuaria['tratoresimplementosterceirosobtida']         = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosobtida'));
        $producaoPecuaria['tratoresimplementosterceirosprevista']       = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosprevista'));
        
        // Trata o Array setando como null os campos em branco
        $producaoPecuaria = tratamento::null_array($producaoPecuaria);
        
        // Altera os dados da produção Pecuária
        $result = $this->modelExploracaoPecuaria->alterar($this->session->userdata('empresa'),$cpfcnpj,$producaoPecuaria['id'],$producaoPecuaria);
        
        // Exclui todos os registros dos produtos secundários
        $this->modelProdutosSencudariosExploracaoPecuaria->excluirRegistrosExploracao($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'));
        
        // Inserção dos Produtos secundários:
        for($i=2;$i<8;$i++){
            // Adiciona os campos necessários para inclusão
            if(!empty($this->input->post('vendasproduto'.$i.'obtida')) || !empty($this->input->post('vendasproduto'.$i.'obtida'))){
                $produtoSecundario = array();
                $produtoSecundario['empresa'] = $this->session->userdata('empresa');
                $produtoSecundario['id'] = $i;
                $produtoSecundario['cpfcnpj'] = $cpfcnpj;
                $produtoSecundario['exploracaopecuaria'] = $producaoPecuaria['id'];
                $produtoSecundario['vendasobtida'] = format::monetarioTofloat($this->input->post('vendasproduto'.$i.'obtida'));
                $produtoSecundario['vendasprevista'] = format::monetarioTofloat($this->input->post('vendasproduto'.$i.'prevista'));
                // Trata o array para inserir null nos campos ao invés de vazio
                $produtoSecundario = tratamento::null_array($produtoSecundario);
                // Atualiza o Registro
                $this->modelProdutosSencudariosExploracaoPecuaria->inserir($produtoSecundario);
            }
        }
        
        // Exclui todos os registros de areas Exploradas do Imovel
        $this->modelImovelExploradoPecuaria->excluirRegistrosExploracao($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'));

        // Decodifica o JSON enviado por post com os dados dos Imóveis utilizados na Exploração Ágricola
        $areasExploradasImoveis = json_decode($this->input->post('dadosAreaExploradaImoveis'), true);
        
        // Se houver imoveis atualiza aqueles que são explorados
        if($areasExploradasImoveis){
            // Percorre os imoveis atualizando um a um
            foreach($areasExploradasImoveis as $exploracaoImovel){
                // Trata o array para inserir null nos campos ao invés de vazio
                $exploracaoImovel = tratamento::null_array($exploracaoImovel);
                // Adiciona os campos necessários para inclusão
                $exploracaoImovel['empresa'] = $this->session->userdata('empresa');
                $exploracaoImovel['cpfcnpj'] = $cpfcnpj;
                $exploracaoImovel['exploracaopecuaria'] = $this->input->post('idProducao');
                $exploracaoImovel['areaexploradaobtida'] = format::monetarioTofloat($exploracaoImovel['areaexploradaobtida']);
                $exploracaoImovel['areaexploradaprevista'] = format::monetarioTofloat($exploracaoImovel['areaexploradaprevista']);
                // Atualiza o Registro
                $this->modelImovelExploradoPecuaria->inserir($exploracaoImovel);
            }
        }
        
        // Se conseguiu alterar
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 45,
              'registro'=> 'Empresa:'. $producaoPecuaria['empresa'] . '; ID:'. $producaoPecuaria['id'] .  '; CPF/CNPJ: ' . $producaoPecuaria['cpfcnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Produção Pecuária alterada com sucesso.';
        }else{
            $mensagem = 'Erro ao altarar Produção Pecuária.';
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
        $this->load->model('M_ExploracaoPecuaria', 'modelExploracaoPecuaria');
        $this->load->model('M_ProdutosSencudariosExploracaoPecuaria', 'modelProdutosSencudariosExploracaoPecuaria');
        $this->load->model('M_ImovelExploradoPecuaria', 'modelImovelExploradoPecuaria');
        
        // Recupera o CPF/CNPJ enviado por post sem a formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Exclui todos os registros dos produtos secundários
        if($this->modelProdutosSencudariosExploracaoPecuaria->excluirRegistrosExploracao($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'))){
            // Exclui todos os registros das areas exploradas da produção Pecuaria
            if($this->modelImovelExploradoPecuaria->excluirRegistrosExploracao($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'))){
                // Exclui o registro da exploração
                $result = $this->modelExploracaoPecuaria->excluir($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'));
            }
        }
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 46,
              'registro'=> 'Empresa:'. $this->session->userdata('empresa') . '; ID:'. $this->input->post('idProducao') .  '; CPF/CNPJ: ' . $cpfcnpj
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Produção Pecuária excluída com sucesso.';
        }else{
            $mensagem = 'Erro ao excluir Produção Pecuária.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function dadosProcuraProducaoPecuaria(){
        // Carrega o Model
        $this->load->model('M_ExploracaoPecuaria', 'modelExploracaoPecuaria');

        // Carrega o Helper de Formatação
        $this->load->helper('format');

        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);

        // Busca os dados da Exploração Pecuária
        $result = $this->modelExploracaoPecuaria->buscarProducaoPecuariaTelaProcura($this->session->userdata('empresa'),$cpfcnpj); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
}