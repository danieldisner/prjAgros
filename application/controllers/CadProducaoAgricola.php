<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadProducaoAgricola extends MY_Controller{

    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        $dados['nome_view'] = 'v_cadProducaoAgricola';
        $dados['menus'] = $consulta->result_array();
        
        // Busca Produtos Agrícola para o combobox
        $this->load->model('M_ProdutosAgricola', 'modelProdutosAgricola');
        $buscaProdutosAgricola = $this->modelProdutosAgricola->buscaProdutosAgricolaCombo();
        $dados['produtosAgricola'] = $buscaProdutosAgricola->result_array();
        
        // Busca Tipos de Cultivo para o combobox
        $this->load->model('M_TipoCultivo', 'modelTipoCultivo');
        $buscaTiposCultivo = $this->modelTipoCultivo->buscaTipoCultivoCombo();
        $dados['tiposCultivo'] = $buscaTiposCultivo->result_array();
        
        $this->load->view('v_layout',$dados);
    }

    public function buscaRegistro(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Model
        $this->load->model('M_ExploracaoAgricola', 'modelExploracaoAgricola');
        $this->load->model('M_ImovelExploradoAgricola', 'modelImovelExploradoAgricola');
        
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
              
        // Busca o Registro
        $result = $this->modelExploracaoAgricola->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj,$this->input->post('id'));
        
        // Verifica se encontrou o registro e atribui os dados aos campos do formulário
        if($result->num_rows() > 0){
            $camposForm['idProducao']                  = $result->row()->id;
            $camposForm['municipio']                   = $result->row()->municipio;
            $camposForm['atividade']                   = $result->row()->atividade;
            $camposForm['sistemaproducaoobtida']       = $result->row()->sistemaproducaoobtida;
            $camposForm['sistemaproducaoprevista']     = $result->row()->sistemaproducaoprevista;
            $camposForm['tipocultivo']                 = $result->row()->tipocultivo;
            $camposForm['irrigacao']                   = ($result->row()->irrigacao) ? true : false;
            
            // Tratamento dos campos da Data (ano[0] mes[1] dia[2])
            $arrayDataInicioColheitaObtida = explode('-', $result->row()->datainiciocolheitaobtida);
            $arrayDataFimColheitaObtida = explode('-', $result->row()->datafimcolheitaobtida);
            
            $arrayDataInicioColheitaPrevista = explode('-', $result->row()->datainiciocolheitaprevista);
            $arrayDataFimColheitaPrevista = explode('-', $result->row()->datafimcolheitaprevista);
            
            $arrayDataInicioComercializacaoObtida = explode('-', $result->row()->datainiciocomercializacaoobtida);
            $arrayDataFimComercializacaoObtida = explode('-', $result->row()->datafimcomercializacaoobtida);
            
            $arrayDataInicioComercializacaoPrevista = explode('-', $result->row()->datainiciocomercializacaoprevista);
            $arrayDataFimComercializacaoPrevista = explode('-', $result->row()->datafimcomercializacaoprevista);            
            
            $arrayDataInicioProducaoObtida = explode('-', $result->row()->datainicioproducaoobtida);
            $arrayDataFimProducaoObtida = explode('-', $result->row()->datafimproducaoobtida);    
            
            $arrayDataInicioProducaoPrevista = explode('-', $result->row()->datainicioproducaoprevista);
            $arrayDataFimProducaoPrevisa = explode('-', $result->row()->datafimproducaoprevista); 
            
            // Verificação das datas
            $camposForm['colheitaObtidaMes1']          = $arrayDataInicioColheitaObtida[1];
            $camposForm['colheitaObtidaAno1']          = $arrayDataInicioColheitaObtida[0];
            $camposForm['colheitaObtidaMes2']          = $arrayDataFimColheitaObtida[1];
            $camposForm['colheitaObtidaAno2']          = $arrayDataFimColheitaObtida[0];
            
            $camposForm['colheitaPrevistaMes1']        = $arrayDataInicioColheitaPrevista[1];
            $camposForm['colheitaPrevistaAno1']        = $arrayDataInicioColheitaPrevista[0];
            $camposForm['colheitaPrevistaMes2']        = $arrayDataFimColheitaPrevista[1];
            $camposForm['colheitaPrevistaAno2']        = $arrayDataFimColheitaPrevista[0];
            
            $camposForm['comercializacaoObtidaMes1']   = $arrayDataInicioComercializacaoObtida[1];
            $camposForm['comercializacaoObtidaAno1']   = $arrayDataInicioComercializacaoObtida[0];
            $camposForm['comercializacaoObtidaMes2']   = $arrayDataFimComercializacaoObtida[1];
            $camposForm['comercializacaoObtidaAno2']   = $arrayDataFimComercializacaoObtida[0];
            
            $camposForm['comercializacaoPrevistaMes1']   = $arrayDataInicioComercializacaoPrevista[1];
            $camposForm['comercializacaoPrevistaAno1']   = $arrayDataInicioComercializacaoPrevista[0];
            $camposForm['comercializacaoPrevistaMes2']   = $arrayDataFimComercializacaoPrevista[1];
            $camposForm['comercializacaoPrevistaAno2']   = $arrayDataFimComercializacaoPrevista[0];
            
            $camposForm['producaoObtidaMes1']            = $arrayDataInicioProducaoObtida[1];
            $camposForm['producaoObtidaAno1']            = $arrayDataInicioProducaoObtida[0];
            $camposForm['producaoObtidaMes2']            = $arrayDataFimProducaoObtida[1];
            $camposForm['producaoObtidaAno2']            = $arrayDataFimProducaoObtida[0];
            
            $camposForm['producaoPrevistaMes1']          = $arrayDataInicioProducaoPrevista[1];
            $camposForm['producaoPrevistaAno1']          = $arrayDataInicioProducaoPrevista[0];
            $camposForm['producaoPrevistaMes2']          = $arrayDataFimProducaoPrevisa[1];
            $camposForm['producaoPrevistaAno2']          = $arrayDataFimProducaoPrevisa[0];
            
            $camposForm['anosafrainicioobtida']                 = $result->row()->anosafrainicioobtida;
            $camposForm['anosafrafimobtida']                    = $result->row()->anosafrafimobtida;
            $camposForm['anosafrainicioprevista']               = $result->row()->anosafrainicioprevista;
            $camposForm['anosafrafimprevista']                  = $result->row()->anosafrafimprevista;
            $camposForm['participacaoobtida']                   = $result->row()->participacaoobtida;
            $camposForm['participacaoprevista']                 = $result->row()->participacaoprevista;
            $camposForm['areaobtida']                           = number_format($result->row()->areaobtida, 2, ',', '.');
            $camposForm['areaprevista']                         = number_format($result->row()->areaprevista, 2, ',', '.');
            $camposForm['precounitarioobtida']                  = number_format($result->row()->precounitarioobtida, 4, ',', '.');
            $camposForm['precounitarioprevista']                = number_format($result->row()->precounitarioprevista, 4, ',', '.');
            $camposForm['produtividadeprevistaobtida']          = number_format($result->row()->produtividadeprevistaobtida, 2, ',', '.');
            $camposForm['produtividadeprevistaprevista']        = number_format($result->row()->produtividadeprevistaprevista, 2, ',', '.');
            $camposForm['produtividadeobtidaobtida']            = number_format($result->row()->produtividadeobtidaobtida, 2, ',', '.');
            $camposForm['frustracaosafraobtida']                = ($result->row()->frustracaosafraobtida) ? true : false;
            $camposForm['receitabrutaobtida']                   = number_format($result->row()->receitabrutaobtida, 2, ',', '.');
            $camposForm['receitabrutaprevista']                 = number_format($result->row()->receitabrutaprevista, 2, ',', '.');
            $camposForm['custoproducaohectareobtida']           = number_format($result->row()->custoproducaohectareobtida, 2, ',', '.');
            $camposForm['custoproducaohectareprevista']         = number_format($result->row()->custoproducaohectareprevista, 2, ',', '.');
            $camposForm['custoproducaototalobtida']             = number_format($result->row()->custoproducaototalobtida, 2, ',', '.');
            $camposForm['custoproducaototalprevista']           = number_format($result->row()->custoproducaototalprevista, 2, ',', '.');
            $camposForm['custototalcomarrendamentoobtida']      = number_format($result->row()->custototalcomarrendamentoobtida, 2, ',', '.');
            $camposForm['custototalcomarrendamentoprevista']    = number_format($result->row()->custototalcomarrendamentoprevista, 2, ',', '.');
            $camposForm['tratoresimplementosterceirosobtida']   = number_format($result->row()->tratoresimplementosterceirosobtida, 2, ',', '.');
            $camposForm['tratoresimplementosterceirosprevista'] = number_format($result->row()->tratoresimplementosterceirosprevista, 2, ',', '.');
            $camposForm['colheitadeirasterceirosobtida']        = number_format($result->row()->colheitadeirasterceirosobtida, 2, ',', '.');
            $camposForm['colheitadeirasterceirosprevista']      = number_format($result->row()->colheitadeirasterceirosprevista, 2, ',', '.');
            $camposForm['receitaunidadeproducaoobtida']         = number_format($result->row()->receitaunidadeproducaoobtida, 2, ',', '.');
            $camposForm['receitaunidadeproducaoprevista']       = number_format($result->row()->receitaunidadeproducaoprevista, 2, ',', '.');
            $camposForm['receitaliquidaobtida']                 = number_format($result->row()->receitaliquidaobtida, 2, ',', '.');
            $camposForm['receitaliquidaprevista']               = number_format($result->row()->receitaliquidaprevista, 2, ',', '.');

            // Busca o Registro
            $imoveisExploradosAgricola = $this->modelImovelExploradoAgricola->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$this->input->post('id'));
           
            // Cria um Objeto JSON para preencher os dados da tabela de exploração de imóveis 
            $camposForm['areaImoveisExplorados'] = json_encode($imoveisExploradosAgricola);
            
            // Botões
            $camposForm['btnIncluir']               = false;
            $camposForm['btnAlterar']               = true;
            $camposForm['btnExcluir']               = true;
        }else{
            // Seta os valores iniciais para "limpar" os campo
            $camposForm['id']                           = '';
            $camposForm['atividade']                    = '1';
            $camposForm['municipio']                    = '';
            $camposForm['tipocultivo']                  = '1';
            $camposForm['irrigacao']                    = false;
            $camposForm['colheitaObtidaMes1']           = '01';
            $camposForm['colheitaObtidaMes2']           = '01';
            $camposForm['colheitaPrevistaMes1']         = '01';
            $camposForm['colheitaPrevistaMes2']         = '01';
            $camposForm['comercializacaoObtidaMes1']    = '01';
            $camposForm['comercializacaoObtidaMes2']    = '01';
            $camposForm['comercializacaoPrevistaMes1']  = '01';
            $camposForm['comercializacaoPrevistaMes2']  = '01';
            $camposForm['producaoObtidaMes1']           = '01';
            $camposForm['producaoObtidaMes2']           = '01';
            $camposForm['producaoPrevistaMes1']         = '01';
            $camposForm['producaoPrevistaMes2']         = '01';
            $camposForm['frustracaosafraobtida']        = false;
            
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
        $this->load->model('M_ExploracaoAgricola', 'modelExploracaoAgricola');
        $this->load->model('M_ImovelExploradoAgricola', 'modelImovelExploradoAgricola');
        
        // Recupera o CPF/CNPJ enviado por post sem a formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Decodifica o JSON enviado por post com os dados dos Imóveis utilizados na Exploração Ágricola
        $imoveisExplorados = json_decode($this->input->post('dadosImoveisExploradosAgricola'), true);
        
        // Se houver imoveis atualiza aqueles que são explorados
        if($imoveisExplorados){
            // Percorre os imoveis atualizando um a um
            foreach($imoveisExplorados as $imovel){
                // Trata o array para inserir null nos campos ao invés de vazio
                $imovel = tratamento::null_array($imovel);
                // Atualiza o Registro
                $this->modelImovel->alterarImovelExploracaoAgricola($this->session->userdata('empresa'),$cpfcnpj,$imovel['id'],$imovel['explorado']);
            }
        }
                
        // Pega os Períodos informados e Transforma em Arrays
        $arrayDataColheitaObtida = dateUtil::periodoToArrayDatas($this->input->post('colheitaObtidaMes1'), $this->input->post('colheitaObtidaAno1'), $this->input->post('colheitaObtidaMes2'), $this->input->post('colheitaObtidaAno2'));
        $arrayDataColheitaPrevista = dateUtil::periodoToArrayDatas($this->input->post('colheitaPrevistaMes1'), $this->input->post('colheitaPrevistaAno1'), $this->input->post('colheitaPrevistaMes2'), $this->input->post('colheitaPrevistaAno2'));
       
        $arrayDataComercializacaoObtida = dateUtil::periodoToArrayDatas($this->input->post('comercializacaoObtidaMes1'), $this->input->post('comercializacaoObtidaAno1'), $this->input->post('comercializacaoObtidaMes2'), $this->input->post('comercializacaoObtidaAno2'));
        $arrayDataComercializacaoPrevista = dateUtil::periodoToArrayDatas($this->input->post('comercializacaoPrevistaMes1'), $this->input->post('comercializacaoPrevistaAno1'), $this->input->post('comercializacaoPrevistaMes2'), $this->input->post('comercializacaoPrevistaAno2'));

        $arrayDataProducaoObtida = dateUtil::periodoToArrayDatas($this->input->post('producaoObtidaMes1'), $this->input->post('producaoObtidaAno1'), $this->input->post('producaoObtidaMes2'), $this->input->post('producaoObtidaAno2'));
        $arrayDataProducaoPrevista = dateUtil::periodoToArrayDatas($this->input->post('producaoPrevistaMes1'), $this->input->post('producaoPrevistaAno1'), $this->input->post('producaoPrevistaMes2'), $this->input->post('producaoPrevistaAno2')); 
        
        // Procura Próximo ID para o registro
        $proximoID = $this->modelExploracaoAgricola->nextID($this->session->userdata('empresa'),$cpfcnpj);
        
        // Cria o array com os dados da produção agrícola
        $producaoAgricola = array();
        $producaoAgricola['empresa']                                = $this->session->userdata('empresa');
        $producaoAgricola['id']                                     = $proximoID;
        $producaoAgricola['cpfcnpj']                                = $cpfcnpj;
        $producaoAgricola['municipio']                              = $this->input->post('municipio');
        $producaoAgricola['atividade']                              = $this->input->post('atividade');
        $producaoAgricola['sistemaproducaoobtida']                  = $this->input->post('sistemaproducaoobtida');
        $producaoAgricola['sistemaproducaoprevista']                = $this->input->post('sistemaproducaoprevista');
        $producaoAgricola['tipocultivo']                            = $this->input->post('tipocultivo');
        $producaoAgricola['irrigacao']                              = empty($this->input->post('irrigacao')) ? 0 : 1;

        // Datas
        $producaoAgricola['datainiciocolheitaobtida']               = dateUtil::formatDateDB($arrayDataColheitaObtida['dataInicio']);
        $producaoAgricola['datafimcolheitaobtida']                  = dateUtil::formatDateDB($arrayDataColheitaObtida['dataFim']);
        $producaoAgricola['datainiciocolheitaprevista']             = dateUtil::formatDateDB($arrayDataColheitaPrevista['dataInicio']);
        $producaoAgricola['datafimcolheitaprevista']                = dateUtil::formatDateDB($arrayDataColheitaPrevista['dataFim']);
        $producaoAgricola['datainiciocomercializacaoobtida']        = dateUtil::formatDateDB($arrayDataComercializacaoObtida['dataInicio']);
        $producaoAgricola['datafimcomercializacaoobtida']           = dateUtil::formatDateDB($arrayDataComercializacaoObtida['dataFim']);
        $producaoAgricola['datainiciocomercializacaoprevista']      = dateUtil::formatDateDB($arrayDataComercializacaoPrevista['dataInicio']);
        $producaoAgricola['datafimcomercializacaoprevista']         = dateUtil::formatDateDB($arrayDataComercializacaoPrevista['dataFim']);
        $producaoAgricola['datainicioproducaoobtida']               = dateUtil::formatDateDB($arrayDataProducaoObtida['dataInicio']);
        $producaoAgricola['datafimproducaoobtida']                  = dateUtil::formatDateDB($arrayDataProducaoObtida['dataFim']);
        $producaoAgricola['datainicioproducaoprevista']             = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataInicio']);
        $producaoAgricola['datafimproducaoprevista']                = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataFim']);

        $producaoAgricola['anosafrainicioobtida']                   = $this->input->post('anosafrainicioobtida');
        $producaoAgricola['anosafrafimobtida']                      = $this->input->post('anosafrafimobtida');
        $producaoAgricola['anosafrainicioprevista']                 = $this->input->post('anosafrainicioprevista');
        $producaoAgricola['anosafrafimprevista']                    = $this->input->post('anosafrafimprevista');
        $producaoAgricola['participacaoobtida']                     = $this->input->post('participacaoobtida');
        $producaoAgricola['participacaoprevista']                   = $this->input->post('participacaoprevista');
        $producaoAgricola['areaobtida']                             = format::monetarioTofloat($this->input->post('areaobtida'));
        $producaoAgricola['areaprevista']                           = format::monetarioTofloat($this->input->post('areaprevista'));
        $producaoAgricola['precounitarioobtida']                    = format::monetarioTofloat($this->input->post('precounitarioobtida'));
        $producaoAgricola['precounitarioprevista']                  = format::monetarioTofloat($this->input->post('precounitarioprevista'));
        $producaoAgricola['produtividadeprevistaobtida']            = format::monetarioTofloat($this->input->post('produtividadeprevistaobtida'));
        $producaoAgricola['produtividadeprevistaprevista']          = format::monetarioTofloat($this->input->post('produtividadeprevistaprevista'));
        $producaoAgricola['produtividadeobtidaobtida']              = format::monetarioTofloat($this->input->post('produtividadeobtidaobtida'));
        
        $producaoAgricola['frustracaosafraobtida']                  = empty($this->input->post('frustracaosafraobtida')) ? 0 : 1;
       
        $producaoAgricola['receitabrutaobtida']                     = format::monetarioTofloat($this->input->post('receitabrutaobtida'));
        $producaoAgricola['receitabrutaprevista']                   = format::monetarioTofloat($this->input->post('receitabrutaprevista'));
        $producaoAgricola['custoproducaohectareobtida']             = format::monetarioTofloat($this->input->post('custoproducaohectareobtida'));
        $producaoAgricola['custoproducaohectareprevista']           = format::monetarioTofloat($this->input->post('custoproducaohectareprevista'));
        $producaoAgricola['custoproducaototalobtida']               = format::monetarioTofloat($this->input->post('custoproducaototalobtida'));
        $producaoAgricola['custoproducaototalprevista']             = format::monetarioTofloat($this->input->post('custoproducaototalprevista'));
        $producaoAgricola['custototalcomarrendamentoobtida']        = format::monetarioTofloat($this->input->post('custototalcomarrendamentoobtida'));
        $producaoAgricola['custototalcomarrendamentoprevista']      = format::monetarioTofloat($this->input->post('custototalcomarrendamentoprevista'));
        $producaoAgricola['tratoresimplementosterceirosobtida']     = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosobtida'));
        $producaoAgricola['tratoresimplementosterceirosprevista']   = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosprevista'));
        $producaoAgricola['colheitadeirasterceirosobtida']          = format::monetarioTofloat($this->input->post('colheitadeirasterceirosobtida'));
        $producaoAgricola['colheitadeirasterceirosprevista']        = format::monetarioTofloat($this->input->post('colheitadeirasterceirosprevista'));
        $producaoAgricola['receitaunidadeproducaoobtida']           = format::monetarioTofloat($this->input->post('receitaunidadeproducaoobtida'));
        $producaoAgricola['receitaunidadeproducaoprevista']         = format::monetarioTofloat($this->input->post('receitaunidadeproducaoprevista'));
        $producaoAgricola['receitaliquidaobtida']                   = format::monetarioTofloat($this->input->post('receitaliquidaobtida'));
        $producaoAgricola['receitaliquidaprevista']                 = format::monetarioTofloat($this->input->post('receitaliquidaprevista'));
        
        // Trata o Array setando como null os campos em branco
        $producaoAgricola = tratamento::null_array($producaoAgricola);
        
        // Insere os dados
        $result = $this->modelExploracaoAgricola->inserir($producaoAgricola);
        
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
                $exploracaoImovel['exploracaoagricola'] = $proximoID;
                $exploracaoImovel['areaexploradaobtida'] = format::monetarioTofloat($exploracaoImovel['areaexploradaobtida']);
                $exploracaoImovel['areaexploradaprevista'] = format::monetarioTofloat($exploracaoImovel['areaexploradaprevista']);
                // Atualiza o Registro
                $this->modelImovelExploradoAgricola->inserir($exploracaoImovel);
            }
        }
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 40,
              'registro'=> 'Empresa:'. $producaoAgricola['empresa'] . '; ID:'. $producaoAgricola['id'] .  '; CPF/CNPJ: ' . $producaoAgricola['cpfcnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Produção Agrícola inserida com sucesso.';
        }else{
            $mensagem = 'Erro ao inserir Produção Agrícola.';
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
        $this->load->model('M_ExploracaoAgricola', 'modelExploracaoAgricola');
        $this->load->model('M_ImovelExploradoAgricola', 'modelImovelExploradoAgricola');
        
        // Recupera o CPF/CNPJ enviado por post sem a formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Decodifica o JSON enviado por post com os dados dos Imóveis utilizados na Exploração Ágricola
        $imoveisExplorados = json_decode($this->input->post('dadosImoveisExploradosAgricola'), true);
        
        // Se houver imoveis atualiza aqueles que são explorados
        if($imoveisExplorados){
            // Percorre os imoveis atualizando um a um
            foreach($imoveisExplorados as $imovel){
                // Trata o array para inserir null nos campos ao invés de vazio
                $imovel = tratamento::null_array($imovel);
                // Atualiza o Registro
                $this->modelImovel->alterarImovelExploracaoAgricola($this->session->userdata('empresa'),$cpfcnpj,$imovel['id'],$imovel['explorado']);
            }
        }
                
        // Pega os Períodos informados e Transforma em Arrays
        $arrayDataColheitaObtida = dateUtil::periodoToArrayDatas($this->input->post('colheitaObtidaMes1'), $this->input->post('colheitaObtidaAno1'), $this->input->post('colheitaObtidaMes2'), $this->input->post('colheitaObtidaAno2'));
        $arrayDataColheitaPrevista = dateUtil::periodoToArrayDatas($this->input->post('colheitaPrevistaMes1'), $this->input->post('colheitaPrevistaAno1'), $this->input->post('colheitaPrevistaMes2'), $this->input->post('colheitaPrevistaAno2'));
       
        $arrayDataComercializacaoObtida = dateUtil::periodoToArrayDatas($this->input->post('comercializacaoObtidaMes1'), $this->input->post('comercializacaoObtidaAno1'), $this->input->post('comercializacaoObtidaMes2'), $this->input->post('comercializacaoObtidaAno2'));
        $arrayDataComercializacaoPrevista = dateUtil::periodoToArrayDatas($this->input->post('comercializacaoPrevistaMes1'), $this->input->post('comercializacaoPrevistaAno1'), $this->input->post('comercializacaoPrevistaMes2'), $this->input->post('comercializacaoPrevistaAno2'));

        $arrayDataProducaoObtida = dateUtil::periodoToArrayDatas($this->input->post('producaoObtidaMes1'), $this->input->post('producaoObtidaAno1'), $this->input->post('producaoObtidaMes2'), $this->input->post('producaoObtidaAno2'));
        $arrayDataProducaoPrevista = dateUtil::periodoToArrayDatas($this->input->post('producaoPrevistaMes1'), $this->input->post('producaoPrevistaAno1'), $this->input->post('producaoPrevistaMes2'), $this->input->post('producaoPrevistaAno2')); 
        
        // Cria o array com os dados da produção agrícola
        $producaoAgricola = array();
        $producaoAgricola['empresa']                                = $this->session->userdata('empresa');
        $producaoAgricola['id']                                     = $this->input->post('idProducao');
        $producaoAgricola['cpfcnpj']                                = $cpfcnpj;
        $producaoAgricola['municipio']                              = $this->input->post('municipio');
        $producaoAgricola['atividade']                              = $this->input->post('atividade');
        $producaoAgricola['sistemaproducaoobtida']                  = $this->input->post('sistemaproducaoobtida');
        $producaoAgricola['sistemaproducaoprevista']                = $this->input->post('sistemaproducaoprevista');
        $producaoAgricola['tipocultivo']                            = $this->input->post('tipocultivo');
        $producaoAgricola['irrigacao']                              = empty($this->input->post('irrigacao')) ? 0 : 1;

        // Datas
        $producaoAgricola['datainiciocolheitaobtida']               = dateUtil::formatDateDB($arrayDataColheitaObtida['dataInicio']);
        $producaoAgricola['datafimcolheitaobtida']                  = dateUtil::formatDateDB($arrayDataColheitaObtida['dataFim']);
        $producaoAgricola['datainiciocolheitaprevista']             = dateUtil::formatDateDB($arrayDataColheitaPrevista['dataInicio']);
        $producaoAgricola['datafimcolheitaprevista']                = dateUtil::formatDateDB($arrayDataColheitaPrevista['dataFim']);
        $producaoAgricola['datainiciocomercializacaoobtida']        = dateUtil::formatDateDB($arrayDataComercializacaoObtida['dataInicio']);
        $producaoAgricola['datafimcomercializacaoobtida']           = dateUtil::formatDateDB($arrayDataComercializacaoObtida['dataFim']);
        $producaoAgricola['datainiciocomercializacaoprevista']      = dateUtil::formatDateDB($arrayDataComercializacaoPrevista['dataInicio']);
        $producaoAgricola['datafimcomercializacaoprevista']         = dateUtil::formatDateDB($arrayDataComercializacaoPrevista['dataFim']);
        $producaoAgricola['datainicioproducaoobtida']               = dateUtil::formatDateDB($arrayDataProducaoObtida['dataInicio']);
        $producaoAgricola['datafimproducaoobtida']                  = dateUtil::formatDateDB($arrayDataProducaoObtida['dataFim']);
        $producaoAgricola['datainicioproducaoprevista']             = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataInicio']);
        $producaoAgricola['datafimproducaoprevista']                = dateUtil::formatDateDB($arrayDataProducaoPrevista['dataFim']);

        $producaoAgricola['anosafrainicioobtida']                   = $this->input->post('anosafrainicioobtida');
        $producaoAgricola['anosafrafimobtida']                      = $this->input->post('anosafrafimobtida');
        $producaoAgricola['anosafrainicioprevista']                 = $this->input->post('anosafrainicioprevista');
        $producaoAgricola['anosafrafimprevista']                    = $this->input->post('anosafrafimprevista');
        $producaoAgricola['participacaoobtida']                     = $this->input->post('participacaoobtida');
        $producaoAgricola['participacaoprevista']                   = $this->input->post('participacaoprevista');
        $producaoAgricola['areaobtida']                             = format::monetarioTofloat($this->input->post('areaobtida'));
        $producaoAgricola['areaprevista']                           = format::monetarioTofloat($this->input->post('areaprevista'));
        $producaoAgricola['precounitarioobtida']                    = format::monetarioTofloat($this->input->post('precounitarioobtida'));
        $producaoAgricola['precounitarioprevista']                  = format::monetarioTofloat($this->input->post('precounitarioprevista'));
        $producaoAgricola['produtividadeprevistaobtida']            = format::monetarioTofloat($this->input->post('produtividadeprevistaobtida'));
        $producaoAgricola['produtividadeprevistaprevista']          = format::monetarioTofloat($this->input->post('produtividadeprevistaprevista'));
        $producaoAgricola['produtividadeobtidaobtida']              = format::monetarioTofloat($this->input->post('produtividadeobtidaobtida'));
        
        $producaoAgricola['frustracaosafraobtida']                  = empty($this->input->post('frustracaosafraobtida')) ? 0 : 1;
        
        $producaoAgricola['receitabrutaobtida']                     = format::monetarioTofloat($this->input->post('receitabrutaobtida'));
        $producaoAgricola['receitabrutaprevista']                   = format::monetarioTofloat($this->input->post('receitabrutaprevista'));
        $producaoAgricola['custoproducaohectareobtida']             = format::monetarioTofloat($this->input->post('custoproducaohectareobtida'));
        $producaoAgricola['custoproducaohectareprevista']           = format::monetarioTofloat($this->input->post('custoproducaohectareprevista'));
        $producaoAgricola['custoproducaototalobtida']               = format::monetarioTofloat($this->input->post('custoproducaototalobtida'));
        $producaoAgricola['custoproducaototalprevista']             = format::monetarioTofloat($this->input->post('custoproducaototalprevista'));
        $producaoAgricola['custototalcomarrendamentoobtida']        = format::monetarioTofloat($this->input->post('custototalcomarrendamentoobtida'));
        $producaoAgricola['custototalcomarrendamentoprevista']      = format::monetarioTofloat($this->input->post('custototalcomarrendamentoprevista'));
        $producaoAgricola['tratoresimplementosterceirosobtida']     = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosobtida'));
        $producaoAgricola['tratoresimplementosterceirosprevista']   = format::monetarioTofloat($this->input->post('tratoresimplementosterceirosprevista'));
        $producaoAgricola['colheitadeirasterceirosobtida']          = format::monetarioTofloat($this->input->post('colheitadeirasterceirosobtida'));
        $producaoAgricola['colheitadeirasterceirosprevista']        = format::monetarioTofloat($this->input->post('colheitadeirasterceirosprevista'));
        $producaoAgricola['receitaunidadeproducaoobtida']           = format::monetarioTofloat($this->input->post('receitaunidadeproducaoobtida'));
        $producaoAgricola['receitaunidadeproducaoprevista']         = format::monetarioTofloat($this->input->post('receitaunidadeproducaoprevista'));
        $producaoAgricola['receitaliquidaobtida']                   = format::monetarioTofloat($this->input->post('receitaliquidaobtida'));
        $producaoAgricola['receitaliquidaprevista']                 = format::monetarioTofloat($this->input->post('receitaliquidaprevista'));
        
        // Trata o Array setando como null os campos em branco
        $producaoAgricola = tratamento::null_array($producaoAgricola);
        
        // Altera os dados da produção agrícola
        $result = $this->modelExploracaoAgricola->alterar($this->session->userdata('empresa'),$cpfcnpj,$producaoAgricola['id'],$producaoAgricola);
        
        // Exclui todos os registros de areas Exploradas do Imovel
        $this->modelImovelExploradoAgricola->excluirRegistrosExploracao($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'));

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
                $exploracaoImovel['exploracaoagricola'] = $this->input->post('idProducao');
                $exploracaoImovel['areaexploradaobtida'] = format::monetarioTofloat($exploracaoImovel['areaexploradaobtida']);
                $exploracaoImovel['areaexploradaprevista'] = format::monetarioTofloat($exploracaoImovel['areaexploradaprevista']);
                // Atualiza o Registro
                $this->modelImovelExploradoAgricola->inserir($exploracaoImovel);
            }
        }
        
        // Se conseguiu alterar
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 41,
              'registro'=> 'Empresa:'. $producaoAgricola['empresa'] . '; ID:'. $producaoAgricola['id'] .  '; CPF/CNPJ: ' . $producaoAgricola['cpfcnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Produção Agrícola alterada com sucesso.';
        }else{
            $mensagem = 'Erro ao altarar Produção Agrícola.';
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
        $this->load->model('M_ExploracaoAgricola', 'modelExploracaoAgricola');
        $this->load->model('M_ImovelExploradoAgricola', 'modelImovelExploradoAgricola');
        
        // Recupera o CPF/CNPJ enviado por post sem a formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Exclui todos os registros das areas exploradas da produção agricola
        if($this->modelImovelExploradoAgricola->excluirRegistrosExploracao($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'))){
            // Exclui o registro da exploração
            $result = $this->modelExploracaoAgricola->excluir($this->session->userdata('empresa'), $cpfcnpj, $this->input->post('idProducao'));
        }
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 42,
              'registro'=> 'Empresa:'. $this->session->userdata('empresa') . '; ID:'. $this->input->post('idProducao') .  '; CPF/CNPJ: ' . $cpfcnpj
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Produção Agrícola excluída com sucesso.';
        }else{
            $mensagem = 'Erro ao excluir Produção Agrícola.';
        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function dadosProcuraProducaoAgricola(){
        // Carrega o Model
        $this->load->model('M_ExploracaoAgricola', 'modelExploracaoAgricola');

        // Carrega o Helper de Formatação
        $this->load->helper('format');

        // Pega os parametros passado pro get
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->get('cpfcnpj'),false);

        // Busca os dados da Exploração Agrícola
        $result = $this->modelExploracaoAgricola->buscarProducaoAgricolaTelaProcura($this->session->userdata('empresa'),$cpfcnpj); 

        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
}