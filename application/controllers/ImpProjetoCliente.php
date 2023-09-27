<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImpProjetoCliente extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_impProjetoCliente';
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
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
        $result = $this->modelCliente->buscarNomeCliente($this->session->userdata('empresa'),$cpfcnpj);
        
        // Array Para preenchimento dos campos do formulário
        $camposForm = array();
        
        // Verifica se encontrou o registro e atribui os dados aos campos do formulário
        if($result->num_rows() > 0){
            $camposForm['cpfcnpj']        = format::formatarCPF_CNPJ($result->row()->cpfcnpj);
            $camposForm['nome']           = $result->row()->nome;
            $camposForm['btnImprimir']    = true;
            $camposForm['msg']            = '';
        }else{
            $camposForm['cpfcnpj']        = '';
            $camposForm['nome']           = '';
            $camposForm['btnImprimir']    = false;
            $camposForm['msg']            = 'Cliente não Encontrado.';
        }
        echo json_encode($camposForm);
    }
    
    // Função responsável por carregar os Responsáveis Técnicos da empresa
    public function carregarResponsavel(){
        // Carrega o Model
        $this->load->model('M_Tecnico', 'modelTecnico');
        
        // Busca o Registro
        $resultBusca = $this->modelTecnico->buscarTecnicosEmpresa($this->session->userdata('empresa'));
        
        // Percorre os Municípios encontrados imprimindo a opção
        foreach ($resultBusca->result() as $tecnico){
            // Se foi o Municipio buscado pelo usuário marca como selected
            if($this->session->userdata('tecnico') == $tecnico->id){
                echo '<option value=\''.$tecnico->id.'\' selected=\'selected\' >'.$tecnico->nome. ' - ' . $tecnico->funcao .'</option>';
            }else{
                echo '<option value=\''.$tecnico->id.'\'>'.$tecnico->nome. ' - ' . $tecnico->funcao .'</option>';
            }
        }
    }
    
    public function imprimirPDF(){
        // Carrega a biblioteca de criação de pdf
        $this->load->library('PDF');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Datas
        $this->load->helper('dateutil');
        
        // Cria o novo documento PDF
        $pdf = new PDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // informações do documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Daniel Disner');
        $pdf->SetTitle('Impressão de Cadastro Cliente');
        
        // Impressão de Rodapé e Cabeçalho
        $pdf->setPrintFooter(true);
        $pdf->setPrintHeader(true);

        // *** OBRIGATÓRIO TCPDF ****
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // Quebra de Linha automática
        $pdf->SetAutoPageBreak(TRUE, 8);
        
        // Segunda Via
        $pdf->setSegundaVia(FALSE);
        
        // Imprime Hora
        $pdf->setImprimeHora(FALSE);
        
        // Verifica se é um relatório com Data Retroativa
        if($this->input->post('dataRetroativa')){
            $pdf->setDataRelatorio($this->input->post('dataRetroativa'));
        }
        
        // Define a margem
        if($this->input->post('chkMargem')){
            $pdf->setMargemEsquerda(20);
        }
        
        // Verifica se possui cor ou não
        if($this->input->post('chkSemCor')){
            $pdf->setSemCor(TRUE);
        }

        // Carrega os Models
        $this->load->model('M_Cliente', 'modelCliente');
        $this->load->model('M_Empresa', 'modelEmpresa');
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_ImovelSolo', 'modelImovelSolo');
        $this->load->model('M_ImovelProprietario', 'modelImovelProprietario');
        $this->load->model('M_ImovelBenfeitoria', 'modelImovelBenfeitoria');
        $this->load->model('M_Semovente', 'modelSemovente');
        $this->load->model('M_Movel', 'modelMovel');
        $this->load->model('M_Tecnico', 'modelTecnico');
        $this->load->model('M_ExploracaoAgricola', 'modelExploracaoAgricola');
        $this->load->model('M_ImovelExploradoAgricola', 'modelImovelExploradoAgricola');
        $this->load->model('M_ExploracaoPecuaria', 'modelExploracaoPecuaria');
        $this->load->model('M_ImovelExploradoPecuaria', 'modelImovelExploradoPecuaria');
        $this->load->model('M_ProdutosSencudariosExploracaoPecuaria', 'modelProdutosSencudariosExploracaoPecuaria');

        // Pega o CPF/CNPJ sem formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Busca o Registro do Cliente
        $cliente = $this->modelCliente->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj);
        
        // Busca o Registro do Técnico Responsável
        $tecnico = $this->modelTecnico->buscarRegistro($this->session->userdata('empresa'),$this->input->post('responsavel'));
        
        // Busca o Registro da Empresa
        $empresa = $this->modelEmpresa->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj);
            
        /*
         * IMPRESSÃO DA FOLHA DE ROSTO
         * IMPRESSÃO DA FOLHA DE ROSTO
         * IMPRESSÃO DA FOLHA DE ROSTO
         * IMPRESSÃO DA FOLHA DE ROSTO
         * IMPRESSÃO DA FOLHA DE ROSTO
         */
        if($this->input->post('chkRosto')){
            // Adiciona a Primeira Página
            $pdf->AddPage('P',PDF_PAGE_FORMAT);
            
            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;

            /*
             * DADOS DO CLIENTE
             */
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
            $pdf->setY(20);$pdf->SetX($margemEsquerda);
            
            // Verifica qual a cor do cabeçalho principal
            if($pdf->getSemCor()){
                $pdf->SetFillColor(150);
            }else{
                $pdf->SetFillColor(86,135,161);
            }
            $pdf->Cell($largura-2, 4, 'DADOS DO CLIENTE', 0, 1, 'C', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Nome: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $cliente->row()->nome, 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'CPF/CNPJ: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4,format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Nome Cônjuge: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $cliente->row()->nomeconjuge, 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'CPF Cônjuge: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, format::formatarCPF_CNPJ($cliente->row()->cpfconjuge), 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'CEP: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, !empty($cliente->row()->cep) ? format::formatarCEP($cliente->row()->cep) : 'Não Informado.', 0, 1, 'L', 0);

            // Prepara o Endereço
            $endereco = $cliente->row()->endereco;
            $endereco .= empty($cliente->row()->nroendereco) ? '' : ', Nº '. $cliente->row()->nroendereco;    
            $endereco .= empty($cliente->row()->bairro) ? '' : ', ' . $cliente->row()->bairro;

            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Endereço: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $endereco, 0, 1, 'L', 0); 
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Município/UF: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $cliente->row()->munDesc. '-' . $cliente->row()->uf, 0, 1, 'L', 0); 
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Telefone: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-15, 4, format::formatarTelefone($cliente->row()->fone1), 0, 0, 'L', 0); 
            $pdf->Cell(26, 4, 'Celular: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-44, 4, format::formatarTelefone($cliente->row()->fone2), 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Agencia: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $cliente->row()->nomeAgencia, 0, 1, 'L', 0); 
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Prefixo: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-15, 4, $cliente->row()->prefixoAgencia, 0, 0, 'L', 0); 
            $pdf->Cell(26, 4, 'Conta Corrente: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-44, 4, $cliente->row()->conta, 0, 1, 'L', 0); 
            $pdf->Ln(1);

            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
            $pdf->SetX($margemEsquerda);
            // Verifica qual a cor do cabeçalho principal
            if($pdf->getSemCor()){
                $pdf->SetFillColor(150);
            }else{
                $pdf->SetFillColor(86,135,161);
            }
            $pdf->Cell($largura-2, 4, 'DADOS DA EMPRESA CREDENCIADA', 0, 1, 'C', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Nome: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $empresa->row()->razaosocial, 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'CNPJ/CPF: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4,format::formatarCPF_CNPJ($empresa->row()->cnpj), 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Telefones da Empresa: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-15, 4, format::formatarTelefone($empresa->row()->fone1), 0, 0, 'L', 0); 
            $pdf->Cell(26, 4, 'Celular: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-44, 4, '(14) 3433-8655', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda); 
            $pdf->Cell(30, 4, 'Responsável Técnico: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4,$tecnico->row()->nome, 0, 1, 'L', 0);
            // Prepara o Endereço
            $endereco = $empresa->row()->endereco;
            $endereco .= empty($empresa->row()->nroendereco) ? '' : ', Nº '. $empresa->row()->nroendereco;    
            $endereco .= empty($empresa->row()->bairro) ? '' : ', ' . $empresa->row()->bairro;
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Endereço: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $endereco, 0, 1, 'L', 0); 
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Município/UF: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4, $empresa->row()->municipioDesc. '-' . $empresa->row()->uf, 0, 1, 'L', 0); 
            $pdf->SetX($margemEsquerda);        
            $pdf->Cell(30, 4, 'Telefone: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-15, 4, format::formatarTelefone($tecnico->row()->fone1), 0, 0, 'L', 0); 
            $pdf->Cell(26, 4, 'Celular: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-44, 4, format::formatarTelefone($tecnico->row()->fone2), 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Registro Profissional: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-15, 4, $tecnico->row()->registro, 0, 0, 'L', 0); 
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->Cell(26, 4, 'Conselho Regional: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-44, 4, $conselhoArray[0], 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Visto(se for o caso): ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-15, 4, $tecnico->row()->visto, 0, 0, 'L', 0); 
            $pdf->Cell(26, 4, 'Conselho Regional: ', 0, 0, 'L', 0);
            $pdf->Cell(($largura/2)-44, 4, $conselhoArray[1], 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(30, 4, 'Profissão: ', 0, 0, 'L', 0);
            $pdf->Cell($largura-32, 4,$tecnico->row()->funcao, 0, 1, 'L', 0);
            $pdf->ln(2);
            
            /*
             *  INFORMAÇÕES
             */
            $pdf->SetX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 12);
            $pdf->Cell($largura-4, 10,'INFORMAÇÕES PARA CADASTRO E CÁLCULO DE LIMITE DE CRÉDITO DE PRODUTOR RURAL', 'TB', 1, 'C', 0,'',1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 6,'DOCUMENTOS ANEXOS:', 0, 1, 'C', 0);
            $pdf->ln(2);
            $pdf->SetX($margemEsquerda+8);
            //  Coloca as opções para os campos de Formulário do Relatório
            $pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'', 'fillColor'=>array(255, 255, 255)));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk1', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'CERTIDÕES ATUALIZADAS DOS IMÓVEIS URBANOS/RURAIS OU ESCRITURAS/CERTIDÕES ACOMPANHADAS DO IPTU/ITR DO ÚLTIMO EXERCÍCIO.', 0, 1, 'L', 0,'',1);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk2', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'CÓPIA DOS CERTIFICADOS DE REGISTRO E LICENCIAMENTO DE VEÍCULOS AUTOMOTORES, COM AS CÓPIAS DAS RESPECTIVAS APÓLICES DE SEGURO,', 0, 1, 'L', 0,'',1);
            $pdf->SetX($margemEsquerda+14);
            $pdf->Cell($largura-20, 6,'QUANDO HOUVER.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk3', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'CÓPIA CPF, DOCUMENTO DE IDENTIDADE, COMPROVANTE DE RESIDÊNCIA DO MUTUÁRIO.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk4', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'CÓPIA DA CERTIDÃO DE CASAMENTO/DOCUMENTOS PESSOAIS DO CÔNJUGE.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk5', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'CÓPIA DOCUMENTO DE COMPROVAÇÃO DE RENDA DO CÔNJUGE.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk6', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'CARTA DE ANUÊNCIA E/OU CONTRATO DE ARRENDAMENTO.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk7', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'COMPROVANTE DE ENTREGA DO ITR DO ÚLTIMO EXERCÍCIO DE TODOS OS IMÓVEIS.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk8', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'COMPROVANTE DE RENDA DAS ATIVIDADES EXTRA-AGROPECUÁRIAS.', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+8);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 14);
            $pdf->CheckBox('chk9', 6,0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->Cell($largura-20, 6,'DUAS FONTES DE REFERÊNCIAS COMERCIAIS E/OU BANCÁRIAS:', 0, 1, 'L', 0);
            $pdf->SetX($margemEsquerda+14);
            $pdf->Cell(5, 4,'1- ', 0, 0, 'L', 0);
            $pdf->TextField ('txt1', $largura-24, 4);
            $pdf->Ln();
            $pdf->SetX($margemEsquerda+14);
            $pdf->Cell(5, 4,'2- ', 0, 0, 'L', 0);
            $pdf->TextField ('txt2', $largura-24, 4);
            $pdf->Ln(6);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-4, 4,'Declaro que os semoventes, bens móveis e imóveis relacionados no presente documento foram vistoriados e correspondem à real situação patrimonial do cliente.', 'T', 'L', 0, 1);
            $pdf->Ln(13);
            
            /*
             * ASSINATURAS CLIENTE/EMPRESA
             */
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + ($largura/10));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + ($largura/2));
            $pdf->Cell(70, 4,$tecnico->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + ($largura/10));
            $pdf->Cell(70, 4,'Cliente', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + ($largura/2));
            $pdf->Cell(70, 4,'Responsável Técnico', '', 1, 'C', 0);
            $pdf->Ln(3);
            $pdf->Line($margemEsquerda, $pdf->GetY(), $pdf->getPageWidth()-2, $pdf->GetY());
            $pdf->Ln(2);
            
            /*
             * ASSINATURA DO FUNCIONÁRIO DA AGÊNCIA
             */
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'U', 10);
            $pdf->setX($margemEsquerda);
            $pdf->Cell($largura-2, 4, 'VALIDAÇÃO DA AGÊNCIA', 0, 1, 'C', 0);
            $pdf->Ln(3);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4,'Validamos os dados constantes das planilhas e documentos anexos.', 0, 'C', 0, 1);
            $pdf->Ln(13);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4,'Funcionário Comissionado', 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4,'Assinatura/Carimbo', '', 1, 'C', 0);
        }
        
        /*
         * IMPRESSÃO DOS SEMOVENTES
         * IMPRESSÃO DOS SEMOVENTES
         * IMPRESSÃO DOS SEMOVENTES
         * IMPRESSÃO DOS SEMOVENTES
         * IMPRESSÃO DOS SEMOVENTES
         */
        if($this->input->post('chkSemoventes')){
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            
            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;

            // Busca os Semoventes
            $semoventes = $this->modelSemovente->buscarDadosSemoventes($this->session->userdata('empresa'),$cpfcnpj); 

            // Imprime o Sub Cabeçalho para os semoventes
            $this->imprimeSubCabecalhoSemoventes($pdf,20);

            // Controle preenchimento
            $fill = 1;
            $valorTotal = 0;
            $qtdTotalSemoventes = 0;
            $qtdGravames = 0;
            $contador = 0;
            $pelagemArray = array();
            foreach($semoventes as $semovente){
                // Controle de quebra de páginas
                $posY = $pdf->getY();
                if($limiteAltura <= $posY){
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    $this->imprimeSubCabecalhoSemoventes($pdf,20);
                }
                $pdf->setX($margemEsquerda);
                $pdf->Cell($largura/9, 5, $semovente->especieDesc, '', 0, 'L', $fill,'',1);
                $pdf->Cell($largura/30, 5, $semovente->quantidade, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/7, 5, $semovente->finalidadeDesc, 'L', 0, 'C', $fill,'',1);
                $pdf->Cell($largura/9, 5, $semovente->racaDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/16, 5, $semovente->graumesticagem, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/15, 5, $semovente->idade, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/19, 5, $semovente->gravameDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/19, 5, $semovente->seguroDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/15, 5, $semovente->sitpropriedadeDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/30, 5, $semovente->part . '%', 'L', 0, 'C', $fill);
                $pdf->Cell($largura/13, 5,'R$ '. $semovente->valorunitario, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/12, 5,'R$ '. $semovente->valortotal, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/10, 5, $semovente->matricula, 'L', 1, 'C', $fill);   
                $qtdTotalSemoventes += $semovente->quantidade;
                $valorTotal += format::monetarioTofloat($semovente->valortotal);
                if($semovente->gravame != 1){
                    $qtdGravames++;
                }
                $pelagemArray[$contador]['pelagem'] =  $semovente->pelagem;
                $fill = !$fill;
            }
            
            // Controle de quebra de páginas
            $posY = $pdf->getY();
            if($limiteAltura <= $posY){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20,'RELAÇÃO DE SEMOVENTES');
            }
            
            // Cor do totalizador
            $pdf->SetFillColor(145);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->setX($margemEsquerda);
            $pdf->Cell($largura-($largura/5.25), 6,'Total de Animais: '. $qtdTotalSemoventes, 0, 0, 'C', 1);
            $pdf->Cell($largura/12, 6,'TOTAL:', 0, 0, 'R', 1);
            $pdf->Cell($largura/10, 6,'R$ '. number_format($valorTotal, 2, ',', '.'), 0, 1, 'C', 1);
            $pdf->Ln(2);
            
            /*
            * TABELA PARA DETALHAR OS GRAVAME SE HOUVER
            */
            // Verifica
            $verifica = $pdf->GetY() + ($qtdGravames*5)+5;
            // Controle de quebra de páginas
            if($limiteAltura <= $verifica){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20,'RELAÇÃO DE SEMOVENTES');
                $pdf->ln(2);
            }
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
            // Verifica qual a cor do cabeçalho principal
            if($pdf->getSemCor()){
                $pdf->SetFillColor(150);
            }else{
                $pdf->SetFillColor(86,135,161);
            }
            $pdf->setX($margemEsquerda);
            $pdf->Cell($largura/4, 5, 'INFORMAÇÕES ADICIONAIS', 'RB', 0, 'C', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
            $pdf->Cell($largura/1.38, 5, 'GRAVAMES', 'L', 1, 'C', 1);

            // Verifica qual a cor do sub-cabeçalho
            if($pdf->getSemCor()){
                $pdf->SetFillColor(190);
            }else{
                $pdf->SetFillColor(168,197,214);
            }
            $pdf->setX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->Cell($largura/12, 8, 'COR PELAGEM', 'RB', 0, 'C', 1);
            $pdf->Cell($largura/6, 8, 'INDENTIFICAÇÃO (MARCA/LOCAL)', 'LRB', 0, 'C', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
            $pdf->Cell($largura/8, 8, 'Descrição', 'LB', 0, 'C', 1);
            $pdf->Cell($largura/10, 8, 'Quantidade', 'LB', 0, 'C', 1);
            $pdf->Cell($largura/6, 4, 'Se Interno', 'L', 0, 'C', 1);
            $pdf->Cell($largura/2.999, 4, 'Se Gravame Externo', 'L', 1, 'C', 1);
            $pdf->setX($margemEsquerda+($largura/4)+($largura/8)+($largura/10));
            $pdf->Cell($largura/12, 4, 'Data Inicio', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/12, 4, 'Valor R$', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/12, 4, 'Data Inicio', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/12, 4, 'Tipo', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/12, 4, 'Valor R$', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/12, 4, 'Instituição', 'LT', 1, 'C', 1);

            // Cria a quantidade de linhas para preencher de acordo com a quantidade de gravames
            for($i=0;$i<$qtdGravames+1;$i++){
                $pdf->setX($margemEsquerda);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                $pdf->Cell($largura/12, 5, isset($pelagemArray[$i]['pelagem'])? $pelagemArray[$i]['pelagem'] : '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/6, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/8, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/10, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                // Adiciona 0.5 ao Y para posicionar os inputs
                $pdf->SetY($pdf->GetY()+0.5);
                $mInput =  $margemEsquerda+0.5;
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
                /*$pdf->setX($mInput);
                $pdf->TextField('txtGravSemo1'.$i,($largura/12)-1, 4);*/
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo2'.$i,($largura/6)-1, 4);
                $mInput += $largura/6;
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo3'.$i,($largura/8)-1, 4);
                $mInput += $largura/8;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo4'.$i,($largura/10)-1, 4);
                $mInput += $largura/10;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo5'.$i,($largura/12)-1, 4);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo6'.$i,($largura/12)-1, 4);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo7'.$i,($largura/12)-1, 4);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $opc = array('','Alienação','Penhor','Outro');
                $pdf->ComboBox('cmbGravSemo1'.$i,($largura/12)-1, 4,$opc);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo8'.$i,($largura/12)-1, 4);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravSemo9'.$i,($largura/12)-1, 4);
                $pdf->SetY($pdf->GetY()-0.5);
                $pdf->Ln();
            }
            
            
            /*
             * ASSINATURAS
             */
            // Tamanho que ocupa as assinaturas
            $tamanhoAssinaturas = 61.409722;
            $verifica = $tamanhoAssinaturas + $pdf->GetY();
            // Controle de quebra de páginas
            if($limiteAltura <= $verifica){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20,'RELAÇÃO DE SEMOVENTES');
            }
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(20);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(15);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0);
        }

        /*
         * IMPRESSÃO DOS IMÓVEIS RURAIS
         * IMPRESSÃO DOS IMÓVEIS RURAIS
         * IMPRESSÃO DOS IMÓVEIS RURAIS
         * IMPRESSÃO DOS IMÓVEIS RURAIS
         * IMPRESSÃO DOS IMÓVEIS RURAIS
         */
        if($this->input->post('chkImoveisRurais')){
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);

            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;
            
            $this->configSubHeader($pdf, 20, 'BENS IMÓVEIS RURAIS - BÁSICO');
            
            // Inicio do preenchimento dos registros
            $yRegistros = $pdf->GetY();
            
            // Imprime o Cabeçalho
            $this->imprimeSubCabecalhoRurais($pdf,$pdf->GetY());
            
            // Variáveis de controle
            $count = 0;
            $contador = 0;
            $gravamesArray = array();
            $cessoesArray = array();
            $roteirosArray = array();
            // Busca os imoveis Urbanos
            $imoveisRurais = $this->modelImovel->buscarDadosRurais($this->session->userdata('empresa'),$cpfcnpj); 
            $margemAux = $margemEsquerda+($largura/10);
            foreach($imoveisRurais  as $imovelRural){
                // Se for mais registros do que cabem na página, cria uma nova
                if($count == 4){
                    // Adiciona a outra página
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    
                    $this->configSubHeader($pdf, 20, 'BENS IMÓVEIS RURAIS - BÁSICO');
                                
                    // Imprime o Cabeçalho
                    $this->imprimeSubCabecalhoRurais($pdf,$pdf->GetY());

                    // Reseta a margem
                    $margemAux = $margemEsquerda+($largura/10);
                    
                    // Reseta o contador
                    $count=0;
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetY($yRegistros);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->nome, 'LRTB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->matricula, 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->ccir,'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->nirf, 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->municipioDesc . '/' . $imovelRural->uf , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->bairro , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->latitude , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->longitude , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->registro , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->part , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->cessaoterceirosDesc , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->sitpropriedadeDesc , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->estadoconservacaoDesc , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->gravameDesc , 'LRB', 1, 'C', 0);
                $pdf->Ln(3);
                
                // Verifica se Possui Gravame
                if($imovelRural->gravame != 1){
                    $gravamesArray[$contador]['nome'] = $imovelRural->nome;
                    $gravamesArray[$contador]['matricula'] = $imovelRural->matricula;
                }
                // Verifica se possui cessao à terceiros
                if($imovelRural->cessaoterceiros != 0){
                    $cessoesArray[$contador]['nome'] = $imovelRural->nome;
                    $cessoesArray[$contador]['matricula'] = $imovelRural->matricula;
                }
                
                // Verifica os roteiros de acesso
                $roteirosArray[$contador]['nome'] = $imovelRural->nome;
                $roteirosArray[$contador]['matricula'] = $imovelRural->matricula;                
                $roteirosArray[$contador]['roteiro'] = $imovelRural->endereco; 
                
                // Capacidade de uso do solo
                $imoveisSolo = $this->modelImovelSolo->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$imovelRural->id);
                $total = count($imoveisSolo);
                // Verifica qual a cor do sub-cabeçalho
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/6.8, 3, 'Tipo.', 1, 0, 'C', 1);
                $pdf->Cell($largura/14, 3, 'Área (ha)', 1, 1, 'C', 1);
                for($i=0;$i<9;$i++){
                    $pdf->SetX($margemAux);
                    $pdf->Cell($largura/6.8, 3.28, ($i < $total) ? $imoveisSolo[$i]['tipo'] : '' , 'LRB', 0, 'C', 0);
                    $pdf->Cell($largura/14, 3.28, ($i < $total) ? $imoveisSolo[$i]['area'] : '', 'LRB', 1, 'C', 0);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->areatotal , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->valorhectare , 'LRB', 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/4.575, 3, $imovelRural->valorterranua , 'LRB', 1, 'C', 0);
                $pdf->Ln(2);
                
                // Proprietários 
                $proprietarios = $this->modelImovelProprietario->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$imovelRural->id);
                $total = count($proprietarios);
                // Verifica qual a cor do sub-cabeçalho
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemEsquerda);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->Cell($largura/10, 6*3.3, 'Outros Proprietarios', 'RTB', 0, 'C', 1);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/9.5, 3.28, 'Nome', 1, 0, 'C', 1);
                $pdf->Cell($largura/14, 3.28, 'CPF/CNPJ', 1, 0, 'C', 1);
                $pdf->Cell($largura/24, 3.28, '(%)', 1, 1, 'C', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                for($i=0;$i<5;$i++){
                    $pdf->SetX($margemAux);
                    $pdf->Cell($largura/9.5, 3.28, ($i < $total) ? $proprietarios[$i]['nome'] : '', 1, 0, 'C', 0);
                    $pdf->Cell($largura/14, 3.28,  ($i < $total) ? $proprietarios[$i]['cpfcnpjproprietario'] : '', 1, 0, 'C', 0);
                    $pdf->Cell($largura/24, 3.28, ($i < $total) ? $proprietarios[$i]['part'] : '', 1, 1, 'C', 0);
                }
                $pdf->Ln(2);
                
                // Benfeitorias 
                $benfeitorias = $this->modelImovelBenfeitoria->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$imovelRural->id);
                $total = count($benfeitorias);
                // Verifica qual a cor do sub-cabeçalho
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemEsquerda);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 6);
                $pdf->Cell($largura/10, 10*3.3, 'Benfeitorias', 'RTB', 0, 'C', 1);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/12.5, 3.28, 'Tipo', 1, 0, 'C', 1);
                $pdf->Cell($largura/50, 3.28, 'Cod', 1, 0, 'C', 1);
                $pdf->Cell($largura/60, 3.28, 'Un', 1, 0, 'C', 1);
                $pdf->Cell($largura/35, 3.28, 'Dim', 1, 0, 'C', 1);
                $pdf->Cell($largura/45, 3.28, 'Idade', 1, 0, 'C', 1);
                $pdf->Cell($largura/20, 3.28, 'Valor - R$', 1, 1, 'C', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 5);
                for($i=0;$i<9;$i++){
                    $pdf->SetX($margemAux);
                    $pdf->Cell($largura/12.5, 3.28, ($i < $total) ? $benfeitorias[$i]['benfeitoriaDesc'] : '', 1, 0, 'C', 0,0,1);
                    $pdf->Cell($largura/50, 3.28,($i < $total) ? $benfeitorias[$i]['codigo'] : '', 1, 0, 'C', 0);
                    $pdf->Cell($largura/60, 3.28,($i < $total) ? $benfeitorias[$i]['unidade'] : '', 1, 0, 'C', 0);
                    $pdf->Cell($largura/35, 3.28,($i < $total) ? $benfeitorias[$i]['dimensao'] : '', 1, 0, 'C', 0);
                    $pdf->Cell($largura/45, 3.28,($i < $total) ? $benfeitorias[$i]['idade'] : '', 1, 0, 'C', 0);
                    $pdf->Cell($largura/20, 3.28,($i < $total) ? $benfeitorias[$i]['valor'] : '', 1, 1, 'C', 0);
                }
                $margemAux += ($largura/4.575)+1.5;
                $count++;
                $contador++;
            }
            
            /*
             * ASSINATURAS
             */
            $pdf->Ln(1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(5);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0); 
            
            // AVANÇADO, CESSÕES, GRAVAMES ROTEIROS DE ACESSO
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            $this->configSubHeader($pdf, 20, 'BENS IMÓVEIS RURAIS - GRAVAMES/CESSÕES');
            // Verifica qual a cor do sub-cabeçalho
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->Cell($largura/2.20, 4, 'GRAVAMES',1, 0, 'C', 1);
            $pdf->Cell($largura/4, 4, 'Se Interno', 1, 0, 'C', 1);
            $pdf->Cell($largura/3.5, 4, 'Se Gravame Externo Acrescentar', 1, 1, 'C', 1);
            $pdf->SetX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->Cell($largura/5, 4, 'Descrição', 1, 0, 'C', 1);
            $pdf->Cell($largura/5, 4, 'Nome do Imóvel', 1, 0, 'C', 1);
            $pdf->Cell($largura/18.5, 4, 'Matricula', 1, 0, 'C', 1);
            $pdf->Cell($largura/20, 4, 'Grau', 1, 0, 'C', 1);
            $pdf->Cell($largura/10, 4, 'Valor R$', 1, 0, 'C', 1);
            $pdf->Cell($largura/10, 4, 'Data Início', 1, 0, 'C', 1);
            $pdf->Cell($largura/8.5, 4, 'Nº Operação', 1, 0, 'C', 1);
            $pdf->Cell($largura/5.925, 4, 'Instituição', 1, 1, 'C', 1);
            foreach ($gravamesArray as $gravame){
                $i = 0;
                $pdf->SetX($margemEsquerda);
                $pdf->Cell($largura/5, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/5, 4, $gravame['nome'], 1, 0, 'C', 0);
                $pdf->Cell($largura/18.5, 4, $gravame['matricula'], 1, 0, 'C', 0);
                $pdf->Cell($largura/20, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/10, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/10, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/8.5, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/5.925, 4, '', 1, 0, 'C', 0);
                // Adiciona 0.5 ao Y para posicionar os inputs
                $pdf->SetY($pdf->GetY()+0.5);
                $mInput =  $margemEsquerda+0.5;
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov1'.$i, ($largura/5)-1, 3);
                $mInput += (($largura/5) *2) + ($largura/18.5);
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov2'.$i, ($largura/20)-1, 3);
                $mInput += $largura/20;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov3'.$i, ($largura/10)-1, 3);
                $mInput += $largura/10;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov4'.$i, ($largura/10)-1, 3);
                $mInput += $largura/10;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov5'.$i, ($largura/8.5)-1, 3);
                $mInput += $largura/8.5;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov6'.$i, ($largura/5.925)-1, 3);
                $i++;
                $pdf->Ln(3.5);
            }
            $pdf->Ln(10);
            
            // Verifica qual a cor do sub-cabeçalho
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-2, 4, 'CESSÃO DE BENS IMÓVEIS RURAIS A TERCEIROS',1, 1, 'C', 1);
            $pdf->SetX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->Cell($largura/5, 4, 'Nome do Imóvel', 1, 0, 'C', 1);
            $pdf->Cell($largura/18.5, 4, 'Matricula', 1, 0, 'C', 1);
            $pdf->Cell($largura/8, 4, 'Cessionário', 1, 0, 'C', 1);
            $pdf->Cell($largura/11, 4, 'CPF', 1, 0, 'C', 1);
            $pdf->Cell($largura/12, 4, 'Tipo de Cessão', 1, 0, 'C', 1);
            $pdf->Cell($largura/14, 4, 'Data Início', 1, 0, 'C', 1);
            $pdf->Cell($largura/14, 4, 'Data Fim', 1, 0, 'C', 1);
            $pdf->Cell($largura/14, 4, 'Área cedida - ha', 1, 0, 'C', 1);
            $pdf->Cell($largura/8, 4, 'Descrição do Documento', 1, 0, 'C', 1);
            $pdf->Cell($largura/10, 4, 'Forma de Pagamento', 1, 1, 'C', 1);
            foreach($cessoesArray as $cessao){
                $i = 0;
                $pdf->SetX($margemEsquerda);
                $pdf->Cell($largura/5, 4, $cessao['nome'], 1, 0, 'C', 0);
                $pdf->Cell($largura/18.5, 4, $cessao['matricula'], 1, 0, 'C', 0);
                $pdf->Cell($largura/8, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/11, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/12, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/14, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/14, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/14, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/8, 4, '', 1, 0, 'C', 0);
                $pdf->Cell($largura/10, 4, '', 1, 0, 'C', 0);
                // Adiciona 0.5 ao Y para posicionar os inputs
                $pdf->SetY($pdf->GetY()+0.5);
                $mInput =  $margemEsquerda+0.5 + ($largura/5)+($largura/18.5);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov1'.$i, ($largura/8)-1, 3);
                $mInput += $largura/8;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov2'.$i, ($largura/11)-1, 3);
                $mInput += $largura/11;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov3'.$i, ($largura/12)-1, 3);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov4'.$i, ($largura/14)-1, 3);
                $mInput += $largura/14;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov5'.$i, ($largura/14)-1, 3);
                $mInput += $largura/14;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov6'.$i, ($largura/14)-1, 3);
                $mInput += $largura/14;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov6'.$i, ($largura/8)-1, 3);
                $mInput += $largura/8;
                $pdf->setX($mInput);
                $pdf->TextField('txtGravImov6'.$i, ($largura/10)-1, 3);
                $i++;
                $pdf->Ln(3.5);
            }
            $pdf->Ln();
            $pdf->Ln(1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(5);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0); 
            
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            $this->configSubHeader($pdf, 20, 'BENS IMÓVEIS RURAIS - ROTEIROS DE ACESSO');
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->SetX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->Cell($largura/5, 4, 'Nome do Imóvel', 1, 0, 'C', 1);
            $pdf->Cell($largura/18.5, 4, 'Matricula', 1, 0, 'C', 1);
            $pdf->Cell($largura/1.355, 4, 'Roteiro de Acesso', 1, 1, 'C', 1);
            foreach($roteirosArray as $roteiroAcesso){
                if(!empty( $roteiroAcesso['roteiro'])){
                    $pdf->SetX($margemEsquerda);
                    $pdf->Cell($largura/5, 12, $roteiroAcesso['nome'], 1, 0, 'C', 0);
                    $pdf->Cell($largura/18.5, 12, $roteiroAcesso['matricula'], 1, 0, 'C', 0);
                    $pdf->MultiCell($largura/1.355, 12,  $roteiroAcesso['roteiro'], 1, 'C', 0);
                }
            }
            $pdf->Ln(1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(5);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0); 
        }
        
        /*
         * IMPRESSÃO DOS IMÓVEIS URBANOS
         * IMPRESSÃO DOS IMÓVEIS URBANOS
         * IMPRESSÃO DOS IMÓVEIS URBANOS
         * IMPRESSÃO DOS IMÓVEIS URBANOS
         * IMPRESSÃO DOS IMÓVEIS URBANOS
         */
        if($this->input->post('chkImoveisUrbano')){
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            
            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;
            
            // Busca os imoveis Urbanos
            $imoveisUrbanos = $this->modelImovel->buscarDadosUrbanos($this->session->userdata('empresa'),$cpfcnpj); 

            // Imprime o Sub Cabeçalho para os imóveis
            $this->imprimeSubCabecalhoUrbanos($pdf,20);
            
            // Controle preenchimento
            $fill = 1;
            $total = 0;
            $qtdGravames = 0;
            foreach($imoveisUrbanos as $imovel){
                // Controle de quebra de páginas
                $posY = $pdf->getY();
                if($limiteAltura <= $posY){
                    $pdf->AddPage();
                    $this->imprimeSubCabecalhoUrbanos($pdf,20);
                }            
                // Prepara o Endereço
                $endereco = $imovel->endereco;
                $endereco .= empty($imovel->nroendereco) ? ', S/Nº' : ', Nº '. $imovel->nroendereco;    
                $endereco .= empty($imovel->bairro) ? '' : ', ' . $imovel->bairro;
                $pdf->setX($margemEsquerda);
                $pdf->Cell($largura/13, 5, 'APARTAMENTO', '', 0, 'C', $fill);
                $pdf->Cell($largura/10, 5, $imovel->matricula. ' - ' . $imovel->registro, 'L', 0, 'L', $fill,'',1);
                $pdf->Cell($largura/21.5, 5, format::formatarCEP($imovel->cep), 'L', 0, 'C', $fill);
                $pdf->Cell($largura/4, 5, $endereco, 'L', 0, 'L', $fill,'',1);
                $pdf->Cell($largura/9, 5, $imovel->municipioDesc . '-' . $imovel->uf , 'L', 0, 'L', $fill,'',1);
                $pdf->Cell($largura/31, 5, $imovel->part .'%', 'L', 0, 'C', $fill);
                $pdf->Cell($largura/18, 5, $imovel->sitpropriedadeDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/16, 5, $imovel->estadoconservacaoDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/24, 5, $imovel->gravameDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/16, 5, $imovel->areaterreno . ' m²', 'L', 0, 'C', $fill);
                $pdf->Cell($largura/16, 5, $imovel->areaconstruida . ' m²', 'L', 0, 'C', $fill);
                $pdf->Cell($largura/11, 5,'R$ '. $imovel->valortotal, 'L', 1, 'C', $fill);
                $total += format::monetarioTofloat($imovel->valortotal);
                if($imovel->gravame != 1){
                    $qtdGravames++;
                }
                $fill = !$fill;
            }
            
            // Controle de quebra de páginas
            $posY = $pdf->getY();
            if($limiteAltura <= $posY){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20,'RELAÇÃO DE IMÓVEIS URBANOS');
            }
            
            // Cor do totalizador
            $pdf->SetFillColor(145);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->setX($margemEsquerda);
            $pdf->Cell($largura-($largura/5.5), 6,'Total de Imóveis Urbanos: '. count($imoveisUrbanos), 0, 0, 'C', 1);
            $pdf->Cell($largura/12, 6,'TOTAL:', 0, 0, 'R', 1);
            $pdf->Cell($largura/11, 6,'R$ '. number_format($total, 2, ',', '.'), 0, 1, 'C', 1);
            $pdf->Ln(2);
                     
            /*
            * TABELA PARA DETALHAR OS GRAVAME SE HOUVER
            */
            if($qtdGravames>0){
                // Verifica
                $verifica = $pdf->GetY() + ($qtdGravames*5)+5;
                // Controle de quebra de páginas
                if($limiteAltura <= $verifica){
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    $this->configSubHeader($pdf,20, 'RELAÇÃO DE IMÓVEIS URBANOS');
                    $pdf->ln(2);
                }
                
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
                // Verifica qual a cor do cabeçalho principal
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(150);
                }else{
                    $pdf->SetFillColor(86,135,161);
                }
                $mGravame = $margemEsquerda+($largura/5);
                $pdf->setX($mGravame);
                $pdf->Cell($largura/1.5225, 5, 'GRAVAMES', '', 1, 'C', 1);
                // Verifica qual a cor do sub-cabeçalho
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
                $pdf->setX($mGravame);
                $pdf->Cell($largura/5, 8, 'Descrição', 'B', 0, 'C', 1);
                $pdf->Cell($largura/6, 4, 'Se Interno', 'L', 0, 'C', 1);
                $pdf->Cell($largura/3.45, 4, 'Se Gravame Externo', 'L', 1, 'C', 1);
                $pdf->setX($mGravame+($largura/5));
                $pdf->Cell($largura/12, 4, 'Data Inicio', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Valor R$', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/25, 4, 'Grau', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Data Inicio', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Nº Operação', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Instituição', 'LT', 1, 'C', 1);
               
                // Cria a quantidade de linhas para preencher de acordo com a quantidade de gravames
                for($i=0;$i<$qtdGravames;$i++){
                    $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                    $pdf->SetX($mGravame);
                    $pdf->Cell($largura/5, 5, '', 'TB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/25, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    // Adiciona 0.5 ao Y para posicionar os inputs
                    $pdf->SetY($pdf->GetY()+0.5);
                    $mInput = $mGravame+0.5;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame1'.$i,($largura/5)-1, 4);
                    $mInput += $largura/5;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame2'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame3'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame4'.$i,($largura/25)-1, 4);
                    $mInput += $largura/25;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame5'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame6'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame7'.$i,($largura/12)-1, 4);
                    $pdf->SetY($pdf->GetY()-0.5);
                    $pdf->Ln();
                }
            }
            
            /*
             * ASSINATURAS
             */
            // Tamanho que ocupa as assinaturas
            $tamanhoAssinaturas = 61.409722;
            $verifica = $tamanhoAssinaturas + $pdf->GetY();
            // Controle de quebra de páginas
            if($limiteAltura <= $verifica){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20,'RELAÇÃO DE IMÓVEIS URBANOS');
            }
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(20);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(15);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0);
            
            // Adiciona próxima página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            $this->configSubHeader($pdf,20,'RELAÇÃO DE IMÓVEIS URBANOS');
            $pdf->SetY(30);
            // Verifica qual a cor do sub-cabeçalho
            if($pdf->getSemCor()){
                $pdf->SetFillColor(190);
            }else{
                $pdf->SetFillColor(168,197,214);
            }
            $margemProp = ($margemEsquerda+50);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
            $pdf->setX($margemProp);
            $pdf->Cell($largura/12, 4, 'BEM', 1, 0, 'C', 1);
            $pdf->Cell($largura/3, 4, 'DEMAIS PARTICIPANTES', 1, 0, 'C', 1);
            $pdf->Cell($largura/10, 4, 'CPF', 1, 0, 'C', 1);
            $pdf->Cell($largura/20, 4, '%', 1, 1, 'C', 1);
            // Cria a quantidade de linhas para preencher de acordo com a quantidade de gravames
            for($i=0;$i<11;$i++){
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                $pdf->SetX($margemProp);
                $pdf->Cell($largura/12, 5, '', 'TB', 0, 'C', 0);
                $pdf->Cell($largura/3, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/10, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/20, 5, '', 'LTB', 0, 'C', 0);
                // Adiciona 0.5 ao Y para posicionar os inputs
                $pdf->SetY($pdf->GetY()+0.5);
                $mInput = $margemProp+0.5;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropImov1'.$i,($largura/12)-1, 4);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropImov2'.$i,($largura/3)-1, 4);
                $mInput += $largura/3;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropImov3'.$i,($largura/10)-1, 4);
                $mInput += $largura/10;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropImov4'.$i,($largura/20)-1, 4);
                $pdf->SetY($pdf->GetY()-0.5);
                $pdf->Ln();
            }
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(20);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(15);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0);
        }
        
        /*
         * IMPRESSÃO DOS BENS MÓVEIS
         * IMPRESSÃO DOS BENS MÓVEIS
         * IMPRESSÃO DOS BENS MÓVEIS
         * IMPRESSÃO DOS BENS MÓVEIS
         * IMPRESSÃO DOS BENS MÓVEIS
         */
        if($this->input->post('chkMoveis')){
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            
            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;

            // Busca os Bens Móveis
            $moveis = $this->modelMovel->buscarDadosMoveis($this->session->userdata('empresa'),$cpfcnpj); 

            // Imprime o Sub Cabeçalho para os móveis
            $this->imprimeSubCabecalhoMoveis($pdf,20);

            // Controle preenchimento
            $fill = 1;
            $total = 0;
            $qtdGravames = 0;
            foreach($moveis as $movel){
                // Controle de quebra de páginas
                $posY = $pdf->getY();
                if($limiteAltura <= $posY){
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    $this->imprimeSubCabecalhoMoveis($pdf,20);
                }
                $pdf->setX($margemEsquerda);
                $pdf->Cell($largura/5.75, 5, $movel->especieDesc, '', 0, 'C', $fill,'',1);
                $pdf->Cell($largura/9, 5, $movel->fabricante, 'L', 0, 'C', $fill,'',1);
                $pdf->Cell($largura/9, 5, $movel->modelo, 'L', 0, 'C', $fill,'',1);
                $pdf->Cell($largura/19, 5, $movel->anomodelo, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/14, 5, $movel->sitpropriedadeDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/19, 5, $movel->gravameDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/14, 5, $movel->seriechassi, 'L', 0, 'C', $fill,'',1);
                $pdf->Cell($largura/16, 5, empty($movel->potencia)? '-': $movel->potencia . ' '. $movel->potenciatipo, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/16, 5, $movel->estadoconservacaoDesc, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/30, 5, $movel->part . '%', 'L', 0, 'C', $fill);
                $pdf->Cell($largura/11, 5,'R$ '. $movel->valor, 'L', 0, 'C', $fill);
                $pdf->Cell($largura/10, 5, $movel->matricula, 'L', 1, 'C', $fill);   
                $total += format::monetarioTofloat($movel->valor);
                if($movel->gravame != 1){
                    $qtdGravames++;
                }
                $fill = !$fill;
            }
            
            // Controle de quebra de páginas
            $posY = $pdf->getY();
            if($limiteAltura <= $posY){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20, 'RELAÇÃO DE BENS MÓVEIS');
            }
            
            // Cor do totalizador
            $pdf->SetFillColor(145);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->setX($margemEsquerda);
            $pdf->Cell($largura-($largura/5.05), 6,'Total de Bens Móveis: '.  count($moveis), 0, 0, 'C', 1);
            $pdf->Cell($largura/11, 6,'TOTAL:', 0, 0, 'R', 1);
            $pdf->Cell($largura/10, 6,'R$ '. number_format($total, 2, ',', '.'), 0, 1, 'C', 1);
            $pdf->ln(2);
            
            /*
            * TABELA PARA DETALHAR OS GRAVAME SE HOUVER
            */
            if($qtdGravames>0){
                // Verifica
                $verifica = $pdf->GetY() + ($qtdGravames*5)+5;
                // Controle de quebra de páginas
                if($limiteAltura <= $verifica){
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    $this->configSubHeader($pdf,20, 'RELAÇÃO DE BENS MÓVEIS');
                    $pdf->ln(2);
                }
                
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
                // Verifica qual a cor do cabeçalho principal
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(150);
                }else{
                    $pdf->SetFillColor(86,135,161);
                }
                $mGravame = $margemEsquerda+($largura/5);
                $pdf->setX($mGravame);
                $pdf->Cell($largura/1.5225, 5, 'GRAVAMES', '', 1, 'C', 1);
                // Verifica qual a cor do sub-cabeçalho
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
                $pdf->setX($mGravame);
                $pdf->Cell($largura/5, 8, 'Descrição', 'B', 0, 'C', 1);
                $pdf->Cell($largura/6, 4, 'Se Interno', 'L', 0, 'C', 1);
                $pdf->Cell($largura/3.45, 4, 'Se Gravame Externo', 'L', 1, 'C', 1);
                $pdf->setX($mGravame+($largura/5));
                $pdf->Cell($largura/12, 4, 'Data Inicio', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Valor R$', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/25, 4, 'Grau', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Data Inicio', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Nº Operação', 'LT', 0, 'C', 1);
                $pdf->Cell($largura/12, 4, 'Instituição', 'LT', 1, 'C', 1);
               
                // Cria a quantidade de linhas para preencher de acordo com a quantidade de gravames
                for($i=0;$i<$qtdGravames;$i++){
                    $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                    $pdf->SetX($mGravame);
                    $pdf->Cell($largura/5, 5, '', 'TB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/25, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    $pdf->Cell($largura/12, 5, '', 'LTB', 0, 'C', 0);
                    // Adiciona 0.5 ao Y para posicionar os inputs
                    $pdf->SetY($pdf->GetY()+0.5);
                    $mInput = $mGravame+0.5;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame1'.$i,($largura/5)-1, 4);
                    $mInput += $largura/5;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame2'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame3'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame4'.$i,($largura/25)-1, 4);
                    $mInput += $largura/25;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame5'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame6'.$i,($largura/12)-1, 4);
                    $mInput += $largura/12;
                    $pdf->setX($mInput);
                    $pdf->TextField('txtGravame7'.$i,($largura/12)-1, 4);
                    $pdf->SetY($pdf->GetY()-0.5);
                    $pdf->Ln();
                }
            }

            /*
             * ASSINATURAS
             */
            // Tamanho que ocupa as assinaturas
            $tamanhoAssinaturas = 61.409722;
            $verifica = $tamanhoAssinaturas + $pdf->GetY();
            // Controle de quebra de páginas
            if($limiteAltura <= $verifica){
                $pdf->AddPage('L',PDF_PAGE_FORMAT);
                $this->configSubHeader($pdf,20, 'RELAÇÃO DE BENS MÓVEIS');
            }
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(20);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(15);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0);
        
            // Adiciona próxima página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            $this->configSubHeader($pdf,20,'RELAÇÃO DE BENS MÓVEIS');
            $pdf->SetY(30);
            // Verifica qual a cor do sub-cabeçalho
            if($pdf->getSemCor()){
                $pdf->SetFillColor(190);
            }else{
                $pdf->SetFillColor(168,197,214);
            }
            $margemProp = ($margemEsquerda+50);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
            $pdf->setX($margemProp);
            $pdf->Cell($largura/12, 4, 'BEM', 1, 0, 'C', 1);
            $pdf->Cell($largura/3, 4, 'DEMAIS PARTICIPANTES', 1, 0, 'C', 1);
            $pdf->Cell($largura/10, 4, 'CPF', 1, 0, 'C', 1);
            $pdf->Cell($largura/20, 4, '%', 1, 1, 'C', 1);
            // Cria a quantidade de linhas para preencher de acordo com a quantidade de gravames
            for($i=0;$i<11;$i++){
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                $pdf->SetX($margemProp);
                $pdf->Cell($largura/12, 5, '', 'TB', 0, 'C', 0);
                $pdf->Cell($largura/3, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/10, 5, '', 'LTB', 0, 'C', 0);
                $pdf->Cell($largura/20, 5, '', 'LTB', 0, 'C', 0);
                // Adiciona 0.5 ao Y para posicionar os inputs
                $pdf->SetY($pdf->GetY()+0.5);
                $mInput = $margemProp+0.5;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropMov1'.$i,($largura/12)-1, 4);
                $mInput += $largura/12;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropMov2'.$i,($largura/3)-1, 4);
                $mInput += $largura/3;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropMov3'.$i,($largura/10)-1, 4);
                $mInput += $largura/10;
                $pdf->setX($mInput);
                $pdf->TextField('txtPropMov4'.$i,($largura/20)-1, 4);
                $pdf->SetY($pdf->GetY()-0.5);
                $pdf->Ln();
            }
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 4, 'Validamos as Informações desse documento:', 0, 'C', 0, 1);
            $pdf->Ln(20);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'Assinatura Agência', 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            $pdf->Cell(70, 4, $empresa->row()->razaosocial, 'T', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->Cell(70, 4, $cliente->row()->nome, 'T', 1, 'C', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $pdf->Cell(70, 4,'(Carimbo e Rubrica)', '', 0, 'C', 0);
            $pdf->SetX($margemEsquerda + (($largura-70)/2));
            // Array que separa o conselho regional
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->MultiCell(70, 4,'<strong>ASTEC  </strong> CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj). '<br/><strong>' . $tecnico->row()->nome . '<br/>' . $conselhoArray[0].$conselhoArray[1] . '</strong>: ' . $tecnico->row()->registro, '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->SetX($margemEsquerda + (($largura-70)/1.05));
            $pdf->MultiCell(70, 4,'<strong>CLIENTE - CPF/CNPJ: </strong>' . format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 'C', 0, 0,'','',TRUE,0,TRUE);
            $pdf->Ln(15);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-4, 4, $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 1, 'R', 0);            
        }
        
        /*
         * IMPRESSÃO DA PRODUÇÃO AGRÍCOLA
         * IMPRESSÃO DA PRODUÇÃO AGRÍCOLA
         * IMPRESSÃO DA PRODUÇÃO AGRÍCOLA
         * IMPRESSÃO DA PRODUÇÃO AGRÍCOLA
         * IMPRESSÃO DA PRODUÇÃO AGRÍCOLA
         */
        if($this->input->post('chkAgricola')){
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);

            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;
            
            // Busca os imoveis rurais explorados do cliente
            $imoveisRuraisExplorados = $this->modelImovel->buscarDadosRurais($this->session->userdata('empresa'),$cpfcnpj,true);
            
            // Imprime o Cabeçalho
            $this->imprimeCabecalhoProducaoAgricola($pdf,20,$tecnico,$cliente,$empresa,$imoveisRuraisExplorados);
            
            // Inicio do preenchimento dos registros
            $yRegistros = $pdf->GetY();
            
            // Deixa em cinza o fundo das células
            $pdf->SetFillColor(240);
            
            // Cabeçalho das obtidas/previstas
            $margemAux = $margemEsquerda+($largura/4);
            
            // Busca as exploração agrícola
            $resultBuscaExploracoes = $this->modelExploracaoAgricola->buscarProducoesAgricolaCliente($this->session->userdata('empresa'),$cpfcnpj);
            
            // Variáveis de controle
            $count = 0;
            $auxCont = 1;
            $bord = 'LT';
            
            // Percorre todas as explorações agrícolas
            foreach($resultBuscaExploracoes as $exploracao){
                // Se for mais registros do que cabem na página, cria uma nova
                if($count == 4){
                    // Adiciona a outra página
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    
                    // Imprime o Cabeçalho
                    $this->imprimeCabecalhoProducaoAgricola($pdf,20,$tecnico,$cliente,$empresa,$imoveisRuraisExplorados);

                    // Inicio do preenchimento dos registros
                    $yRegistros = $pdf->GetY();
                    
                    // Reseta a margem
                    $margemAux = $margemEsquerda+($largura/4);

                    // Deixa em cinza o fundo das células
                    $pdf->SetFillColor(240);
                    
                    // Reseta o contador
                    $count = 0;
                }
                if($auxCont == count($resultBuscaExploracoes)){
                    $bord = 'LTR';
                }
                $pdf->SetY($yRegistros);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                // Imprime os dados
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/5.365, 4, $exploracao->municipioDesc , $bord, 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/5.365, 4, $exploracao->nomeproduto, $bord, 1, 'C', 0);

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/5.365, 4, $exploracao->codigoatividade, $bord, 1, 'C', 1);
                

                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, $exploracao->sistemaproducaoobtida, $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, $exploracao->sistemaproducaoprevista, $bord, 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/5.365, 4, $exploracao->tipocultivoDesc, $bord, 1, 'C', 0);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/5.365, 4, $exploracao->irrigacaoDesc, $bord, 1, 'C', 0);
                $pdf->SetX($margemAux);
                
                // Trata as Datas de Colheita
                $dataInicio = date('d/m/Y', strtotime($exploracao->datainiciocolheitaobtida));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimcolheitaobtida));
                $pdf->Cell($largura/10.75, 4, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), $bord, 0, 'C', 0);

                $dataInicio = date('d/m/Y', strtotime($exploracao->datainiciocolheitaprevista));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimcolheitaprevista));
                $pdf->Cell($largura/10.75, 4, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), $bord, 1, 'C', 0);
                
                $pdf->SetX($margemAux);
                
                // Trata as Datas de Comercialização
                $dataInicio = date('d/m/Y', strtotime($exploracao->datainiciocomercializacaoobtida));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimcomercializacaoobtida));
                $pdf->Cell($largura/10.75, 4, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), $bord, 0, 'C', 0);

                $dataInicio = date('d/m/Y', strtotime($exploracao->datainiciocomercializacaoprevista));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimcomercializacaoprevista));
                $pdf->Cell($largura/10.75, 4, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), $bord, 1, 'C', 0);
                
                $pdf->SetX($margemAux);
                
                // Trata as Datas  de Producao
                $dataInicio = date('d/m/Y', strtotime($exploracao->datainicioproducaoobtida));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimproducaoobtida));
                $pdf->Cell($largura/10.75, 4, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), $bord, 0, 'C', 0);

                $dataInicio = date('d/m/Y', strtotime($exploracao->datainicioproducaoprevista));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimproducaoprevista));
                $pdf->Cell($largura/10.75, 4, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), $bord, 1, 'C', 0);
                
                // Anos Safra
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, $exploracao->anosafrainicioobtida . '/' .  $exploracao->anosafrafimobtida, $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, $exploracao->anosafrainicioprevista . '/' .  $exploracao->anosafrafimprevista, $bord, 1, 'C', 0);
                
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, $exploracao->participacaoobtida . '%', $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, $exploracao->participacaoprevista . '%', $bord, 1, 'C', 0);

                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->areaobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->areaprevista, 2, ',', '.'), $bord, 1, 'C', 0);
                
                // Verifica qual usar (Unidade de produtividade)
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/5.365, 4, $exploracao->unidade, $bord, 1, 'C', 1);

                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->precounitarioobtida, 4, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->precounitarioprevista, 4   , ',', '.'), $bord, 1, 'C', 0);

                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->produtividadeprevistaobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->produtividadeprevistaprevista, 2, ',', '.'), $bord, 1, 'C', 0);
                
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->produtividadeobtidaobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                
                // Como é uma cell vazia, deixa o fill escuro
                $pdf->SetFillColor(110);
                $pdf->Cell($largura/10.75, 4, ' ', $bord, 1, 'C', 1);
                
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, $exploracao->frustracaosafraobtida, $bord, 0, 'C', 0);
                
                // Como é uma cell vazia, deixa o fill escuro
                $pdf->SetFillColor(110);
                $pdf->Cell($largura/10.75, 4, ' ', $bord, 1, 'C', 1);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->receitabrutaobtida, 2, ',', '.'), $bord, 0, 'C', 1);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->receitabrutaprevista, 2, ',', '.'), $bord, 1, 'C', 1);

                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->custoproducaohectareobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->custoproducaohectareprevista, 2, ',', '.'), $bord, 1, 'C', 0);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->custoproducaototalobtida, 2, ',', '.'), $bord, 0, 'C', 1);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->custoproducaototalprevista, 2, ',', '.'), $bord, 1, 'C', 1);
                
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->custototalcomarrendamentoobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->custototalcomarrendamentoprevista, 2, ',', '.'), $bord, 1, 'C', 0);
                
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->tratoresimplementosterceirosobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->tratoresimplementosterceirosprevista, 2, ',', '.'), $bord, 1, 'C', 0);
                
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->colheitadeirasterceirosobtida, 2, ',', '.'), $bord, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->colheitadeirasterceirosprevista, 2, ',', '.'), $bord, 1, 'C', 0);

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->receitaunidadeproducaoobtida, 2, ',', '.'), $bord, 0, 'C', 1);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->receitaunidadeproducaoprevista, 2, ',', '.'), $bord, 1, 'C', 1);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->receitaliquidaobtida, 2, ',', '.'), $bord .'B', 0, 'C', 1);
                $pdf->Cell($largura/10.75, 4, number_format($exploracao->receitaliquidaprevista, 2, ',', '.'), $bord.'B', 1, 'C', 1);
                $pdf->Ln();
                
                /*
                 *  Buscar os imóveis com o id da exploração e imprimir
                 */
                $resultBuscaImoveisExplorados = $this->modelImovelExploradoAgricola->buscarDadosRelatorio($this->session->userdata('empresa'),$cpfcnpj,$exploracao->id);

                foreach($resultBuscaImoveisExplorados as $imovelExplorado){
                    // Verifica qual usar
                    if($pdf->getSemCor()){
                        $pdf->SetFillColor(190);
                    }else{
                        $pdf->SetFillColor(168,197,214);
                    }
                    $pdf->SetX($margemEsquerda);
                    $pdf->Cell($largura/4, 4, $imovelExplorado->imovelDesc, 'TRB', 0, 'L', 1);
                    $pdf->SetX($margemAux);

                    $pdf->Cell($largura/10.75, 4, number_format($imovelExplorado->areaexploradaobtida, 2, ',', '.'), 1, 0, 'C', 0);
                    $pdf->Cell($largura/10.75, 4, number_format($imovelExplorado->areaexploradaprevista, 2, ',', '.'), 1, 1, 'C', 0);
                }
                $margemAux += ($largura/10.75) * 2;  
                $auxCont++;
                $count++;
            }
        }

        /*
         * IMPRESSÃO DA PRODUÇÃO PECUÁRIA
         * IMPRESSÃO DA PRODUÇÃO PECUÁRIA
         * IMPRESSÃO DA PRODUÇÃO PECUÁRIA
         * IMPRESSÃO DA PRODUÇÃO PECUÁRIA
         * IMPRESSÃO DA PRODUÇÃO PECUÁRIA
         */
        if($this->input->post('chkPecuaria')){
            // Adiciona a Primeira Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);

            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;
            
            // Busca os imoveis rurais explorados do cliente
            $imoveisRuraisExplorados = $this->modelImovel->buscarDadosRurais($this->session->userdata('empresa'),$cpfcnpj,true);
            
            // Imprime o Cabeçalho
            $this->imprimeCabecalhoProducaoPecuaria($pdf,20,$tecnico,$cliente,$empresa,$imoveisRuraisExplorados);
            
            // Inicio do preenchimento dos registros
            $yRegistros = $pdf->GetY();
            
            // Deixa em cinza o fundo das células
            $pdf->SetFillColor(240);

            // Busca as exploração pecuária
            $resultBuscaExploracoes = $this->modelExploracaoPecuaria->buscarProducoesPecuariaCliente($this->session->userdata('empresa'),$cpfcnpj);
            
            // Variáveis de controle
            $count = 0;
            $auxCont = 1;
            $margemAux = $margemEsquerda;
            // Percorre todas as explorações pecuárias
            foreach($resultBuscaExploracoes as $exploracao){
                // Se for mais registros do que cabem na página, cria uma nova
                if($count == 3){
                    // Adiciona a outra página
                    $pdf->AddPage('L',PDF_PAGE_FORMAT);
                    
                    // Imprime o Cabeçalho
                    $this->imprimeCabecalhoProducaoPecuaria($pdf,20,$tecnico,$cliente,$empresa,$imoveisRuraisExplorados);

                    // Inicio do preenchimento dos registros
                    $yRegistros = $pdf->GetY();
                    
                    // Reseta
                    $margemAux = $margemEsquerda;

                    // Deixa em cinza o fundo das células
                    $pdf->SetFillColor(240);
                    
                    // Reseta o contador
                    $count = 0;
                }

                $pdf->SetY($yRegistros);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                // Titulo
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->Cell($largura/10.75, 2, 'Obtida', 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, 2, 'Prevista', 1, 1, 'C', 1);  
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Municipio', 1, 0, 'L', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/5.365, 2, $exploracao->municipioDesc , 1, 1, 'C', 0);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Atividade', 1, 0, 'L', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/5.365, 2, $exploracao->nomeatividade, 1, 1, 'C', 0);

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Atividade (código)', 1, 0, 'L', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/5.365, 2, $exploracao->codigoatividade, 1, 1, 'C', 1);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Sistema de Produção(nr. planilha RTA)', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, 2, $exploracao->sistemaproducaoobtida, 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, $exploracao->sistemaproducaoprevista, 1, 1, 'C', 0);                
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Fase Exploracao', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/5.365, 2, $exploracao->faseexploracao, 1, 1, 'C', 1);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Informar Produtividade em:', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/5.365, 2, $exploracao->unidadeprodutividade, 1, 1, 'C', 1);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Produtividade', 1, 0, 'L', 1,'',1);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->produtividadeobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->produtividadeprevista, 2, ',', '.'), 1, 1, 'C', 0);         
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Período de Produção', 1, 0, 'L', 1,'',1);
                // Trata as Datas  de Producao
                $dataInicio = date('d/m/Y', strtotime($exploracao->datainicioproducaoobtida));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimproducaoobtida));
                $pdf->Cell($largura/10.75, 2, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), 1, 0, 'C', 0);

                $dataInicio = date('d/m/Y', strtotime($exploracao->datainicioproducaoprevista));
                $dataFim    = date('d/m/Y', strtotime($exploracao->datafimproducaoprevista));
                $pdf->Cell($largura/10.75, 2, dateUtil::abreviaPeriodoString($dataInicio, $dataFim), 1, 1, 'C', 0);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Participação', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, 2, $exploracao->participacaoobtida . '%', 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, $exploracao->participacaoprevista . '%' , 1, 1, 'C', 0);         
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 8, 'Quantidade de ' . $exploracao->unidadefinanciamento . ' (s)', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->quantidadeobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->quantidadeprevista, 2, ',', '.') , 1, 1, 'C', 0);       
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell(($largura/7.25)+($largura/5.365), 2, $exploracao->obs1, 1, 1, 'L', 1,'',1);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Quant. ciclos por ano: (máximo)', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->quantidadeciclosanoobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->quantidadeciclosanoprevista, 2, ',', '.'), 1, 1, 'C', 0);         
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 8, 'Preço obt. ou prev/'. $exploracao->unidadeproducao. ' de ' .  $exploracao->produtoprincipal . ' (R$)', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->precoobtida, 4, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->precoprevista, 4, ',', '.') , 1, 1, 'C', 1);         

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 8, 'Produção total('. $exploracao->unidadeproducao. ' de ' .  $exploracao->produtoprincipal . '/ANO)', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->producaototalobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->producaototalprevista, 2, ',', '.') , 1, 1, 'C', 0);   

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->MultiCell(($largura/7.25)+($largura/5.365), 8, $exploracao->obs2, 1, 'C', 1, 1);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 6);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 8, 'Produção por unidade de financiamento(' .$exploracao->unidadeproducao. ' de ' .  $exploracao->produtoprincipal . ')/ciclo', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->producaounidadefinanciamentoobtida, 2, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->producaounidadefinanciamentoprevista, 2, ',', '.') , 1, 1, 'C', 1);
                                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Custo de Produção total (R$/ciclo)', 1, 0, 'L', 1,'',1);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->custoproducaoobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->custoproducaoprevista, 2, ',', '.'), 1, 1, 'C', 0);   
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 10, 'CUSTO de PRODUÇÃO/' . $exploracao->unidadefinanciamento . ' (R$/ciclo)', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->custoproducaounidadeobtida, 2, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->custoproducaounidadeprevista, 2, ',', '.') , 1, 1, 'C', 1);       
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 12, 'Receita com venda de ' . $exploracao->unidadefinanciamento . ' (Obt. ou prev./ANO)(R$)', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->receitacomvendaobtida, 2, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->receitacomvendaprevista, 2, ',', '.') , 1, 1, 'C', 1); 

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell(($largura/7.25)+($largura/5.365), 2, 'Receitas com Produtos Secundários (R$/ANO):', 1, 1, 'C', 1,'',1);
                
                // Busca os Produtos Secundários
                $produtosSecundarios = $this->modelProdutosSencudariosExploracaoPecuaria->buscarDados($this->session->userdata('empresa'),$cpfcnpj,$exploracao->id);
                
                // Verifica se possui produtos secundários
                if(count($produtosSecundarios) <= 0){
                    // Verifica qual usar
                    if($pdf->getSemCor()){
                        $pdf->SetFillColor(190);
                    }else{
                        $pdf->SetFillColor(168,197,214);
                    }
                    $pdf->SetX($margemAux);
                    $pdf->Cell($largura/7.25, 2, '-', 1, 0, 'C', 1,'',1);
                    $pdf->Cell($largura/10.75, 2, '-', 1, 0, 'C', 0);
                    $pdf->Cell($largura/10.75, 2, '-', 1, 1, 'C', 0);
                }else{
                    foreach($produtosSecundarios as $produto){
                        // Verifica qual usar
                        if($pdf->getSemCor()){
                            $pdf->SetFillColor(190);
                        }else{
                            $pdf->SetFillColor(168,197,214);
                        }
                        $propriedade = 'produto'.$produto['id'];
                        $pdf->SetX($margemAux);
                        $pdf->Cell($largura/7.25, 2, $exploracao->$propriedade, 1, 0, 'L', 1,'',1);
                        $pdf->Cell($largura/10.75, 2, $produto['vendasobtida'], 1, 0, 'C', 0);
                        $pdf->Cell($largura/10.75, 2, $produto['vendasprevista'], 1, 1, 'C', 0);  
                    }
                }

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Receita Total (Obtida ou prevista/ano)', 1, 0, 'L', 1,'',1);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->receitatotalobtida, 2, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->receitatotalprevista, 2, ',', '.'), 1, 1, 'C', 1);   
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 6);
                $pdf->SetX($margemAux);
                $yHeightAux = $pdf->GetY();
                $pdf->MultiCell($largura/7.25, 8, 'RECEITA TOTAL por ' . $exploracao->unidadefinanciamento . ' e ' . $exploracao->faseexploracao .'/ciclo (R$)', 1, 'L', 1, 1);
                $yHeight = $pdf->GetY() - $yHeightAux;
                $pdf->SetY($yHeightAux);
                $pdf->SetX($margemAux+($largura/7.25));
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->receitatotalunidadefinanciamentoobtida, 2, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, $yHeight, number_format($exploracao->receitatotalunidadefinanciamentoprevista, 2, ',', '.') , 1, 1, 'C', 1); 

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Custo total c/ arrendamento(R$/ano)', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->custototalcomarrendamentoobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->custototalcomarrendamentoprevista, 2, ',', '.'), 1, 1, 'C', 0); 

                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Receita Líquida / ano (R$)', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->receitaliquidaanoobtida, 2, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->receitaliquidaanoprevista, 2, ',', '.'), 1, 1, 'C', 1); 
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, '% tratores/implementos de terceiros', 1, 0, 'L', 1,'',1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->tratoresimplementosterceirosobtida, 2, ',', '.'), 1, 0, 'C', 0);
                $pdf->Cell($largura/10.75, 2, number_format($exploracao->tratoresimplementosterceirosprevista, 2, ',', '.'), 1, 1, 'C', 0); 

                /*
                 *  Buscar os imóveis com o id da exploração e imprimir
                 */
                $resultBuscaImoveisExplorados = $this->modelImovelExploradoPecuaria->buscarDadosRelatorio($this->session->userdata('empresa'),$cpfcnpj,$exploracao->id);
                
                // Verifica qual usar
                if($pdf->getSemCor()){
                    $pdf->SetFillColor(190);
                }else{
                    $pdf->SetFillColor(168,197,214);
                }
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
                $pdf->SetX($margemAux);
                $pdf->Cell($largura/7.25, 2, 'Imóveis Explorados', 1, 0, 'L', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
                $pdf->Cell($largura/5.365, 2, 'Área explorada (ha)', '1', 1, 'C', 1);
                
                foreach($resultBuscaImoveisExplorados as $imovelExplorado){
                    $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
                    // Verifica qual usar
                    if($pdf->getSemCor()){
                        $pdf->SetFillColor(190);
                    }else{
                        $pdf->SetFillColor(168,197,214);
                    }
                    $pdf->SetX($margemAux);
                    $pdf->Cell($largura/7.25, 2, $imovelExplorado->imovelDesc,1, 0, 'L', 1);
                    // Deixa cinza o fundo das células
                    $pdf->Cell($largura/10.75, 2, number_format($imovelExplorado->areaexploradaobtida, 2, ',', '.'), 1, 0, 'C', 0);
                    $pdf->Cell($largura/10.75, 2, number_format($imovelExplorado->areaexploradaprevista, 2, ',', '.'), 1, 1, 'C', 0);
                }
                $margemAux += ($largura/7) + ($largura/5.365) + 1.5;  
                $auxCont++;
                $count++;
            }
            $pdf->SetY($altura - 19);
            // Assinaturas
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 6);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 2, 'Validamos as Informações desse documento:                                                                                                                  ' .  $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 'L', 0, 1);
            $pdf->Ln(5);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 6);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->Cell(100, 2,$tecnico->row()->nome .', '. $conselhoArray[0].$conselhoArray[1] . ',responsável pela ASTEC.', 'T', 0, 'C', 0);
            $pdf->Cell(10, 2,'', 0, 0, 'C', 0);
            $pdf->Cell(100, 2,'Assinatura do funcionário (carimbo e rubrica)', 'T', 0, 'C', 0);
        }
        /*
         * IMPRESSÃO RESUMO DE PRODUÇÃO AGROPECUÁRIO
         * IMPRESSÃO RESUMO DE PRODUÇÃO AGROPECUÁRIO
         * IMPRESSÃO RESUMO DE PRODUÇÃO AGROPECUÁRIO
         * IMPRESSÃO RESUMO DE PRODUÇÃO AGROPECUÁRIO
         * IMPRESSÃO RESUMO DE PRODUÇÃO AGROPECUÁRIO
         */
        if($this->input->post('chkResumoAgropecuaria')){
            // Adiciona a Página
            $pdf->AddPage('L',PDF_PAGE_FORMAT);

            // Pega a altura e largura da página
            $margemEsquerda = $pdf->getMargemEsquerda();
            $largura = $pdf->getPageWidth() - $margemEsquerda;
            $altura = $pdf->getPageHeight();
            $limiteAltura = $altura - 13;
            
            $this->configSubHeader($pdf, 20, 'INFORMAÇÕES SOBRE A PRODUÇÃO AGROPECUÁRIA - RESUMO');

            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->Cell(($largura/2)-1, 4, $empresa->row()->nomeresponsavel, 'B', 0, 'L', 1);
            $pdf->Cell(($largura/2)-1, 4, 'CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj), 'B', 1, 'R', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '',9);        
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(($largura/6), 4, 'Cliente: ', '', 0, 'L', 1);
            $pdf->Cell(($largura/3)-1, 4,  $cliente->row()->nome, '', 0, 'L', 1);
            $pdf->Cell(($largura/6), 4, 'CPF/CNPJ: ', '', 0, 'L', 1);
            $pdf->Cell(($largura/3)-1, 4, format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 1, 'L', 1);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(($largura/6), 4, 'Conjuge: ', '', 0, 'L', 1);
            $pdf->Cell(($largura/3)-1, 4,  $cliente->row()->nomeconjuge, '', 0, 'L', 1);
            $pdf->Cell(($largura/6), 4, 'CPF/CNPJ: ', '', 0, 'L', 1);
            $pdf->Cell(($largura/3)-1, 4, format::formatarCPF_CNPJ($cliente->row()->cpfconjuge), '', 1, 'L', 1);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell(($largura/6), 4, 'Agência: ', '', 0, 'L', 1);
            $pdf->Cell(($largura/3)-1, 4, $cliente->row()->nomeAgencia, '', 0, 'L', 1);
            $pdf->Cell(($largura/6), 4, 'Prefixo ', '', 0, 'L', 1);
            $pdf->Cell(($largura/3)-1, 4, $cliente->row()->prefixoAgencia , '', 1, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 8);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-2, 4, '4. Receita Agropecuária', 'T', 1, 'L', 0);
        
            // Busca o Resumo da Exploração Agrícola
            $resumoAgricola = $this->modelExploracaoAgricola->buscarResumoExploracaoAgricola($this->session->userdata('empresa'),$cpfcnpj);
            
            $pdf->Ln(5);
            // Verifica qual usar
            if($pdf->getSemCor()){
                $pdf->SetFillColor(190);
            }else{
                $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->SetX($margemEsquerda+($largura/3.5));
            $pdf->Cell($largura/4.25, 5, 'Bruta anual (R$)', 1, 0, 'C', 1,'',1);
            $pdf->Cell($largura/4.25, 5, 'Líquida anual (R$)', 1, 0, 'C', 1,'',1);
            $pdf->Cell($largura/4.25, 5, 'Líquida mensal (R$)', 1, 1, 'C', 1,'',1);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura/3.5, 5, 'Receita agrícola safra passada:', 1, 0, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/4.25, 5, number_format($resumoAgricola->receitabrutaanualobtida, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoAgricola->receitaliquidaanualobtida, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoAgricola->receitaliquidamensalobtida, 2, ',', '.'), 1, 1, 'R', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura/3.5, 5, 'Receita agrícola safra prevista:', 1, 0, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/4.25, 5, number_format($resumoAgricola->receitabrutaanualprevista, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoAgricola->receitaliquidaanualprevista, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoAgricola->receitaliquidamensalprevista, 2, ',', '.'), 1, 1, 'R', 1);
            
            // Busca o Resumo da Exploração Pecuária
            $resumoPecuaria = $this->modelExploracaoPecuaria->buscarResumoExploracaoPecuaria($this->session->userdata('empresa'),$cpfcnpj);
            
            $pdf->SetX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->Cell($largura/3.5, 5, 'Receita pecuária safra passada:', 1, 0, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/4.25, 5, number_format($resumoPecuaria->receitabrutaanualobtida, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoPecuaria->receitaliquidaanualobtida, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoPecuaria->receitaliquidamensalobtida, 2, ',', '.'), 1, 1, 'R', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura/3.5, 5, 'Receita pecuária safra prevista:', 1, 0, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/4.25, 5, number_format($resumoPecuaria->receitabrutaanualprevista, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoPecuaria->receitaliquidaanualprevista, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($resumoPecuaria->receitaliquidamensalprevista, 2, ',', '.'), 1, 1, 'R', 1);
            
            // Totais Passada
            $totalbrutaanualpassada = ($resumoAgricola->receitabrutaanualobtida+$resumoPecuaria->receitabrutaanualobtida);
            $totalliquidaanualpassada = ($resumoAgricola->receitaliquidaanualobtida+$resumoPecuaria->receitaliquidaanualobtida);
            $totalmensalpassada = ($resumoAgricola->receitaliquidamensalobtida+$resumoPecuaria->receitaliquidamensalobtida);
            
            // Totais Prevista
            $totalbrutaanualprevista = ($resumoAgricola->receitabrutaanualprevista+$resumoPecuaria->receitabrutaanualprevista);
            $totalliquidaanualprevista = ($resumoAgricola->receitaliquidaanualprevista+$resumoPecuaria->receitaliquidaanualprevista);
            $totalmensalprevista = ($resumoAgricola->receitaliquidamensalprevista+$resumoPecuaria->receitaliquidamensalprevista);
            
            $pdf->SetX($margemEsquerda);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
            $pdf->Cell($largura/3.5, 5, 'Total safra passada:', 1, 0, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/4.25, 5, number_format($totalbrutaanualpassada, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($totalliquidaanualpassada, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($totalmensalpassada, 2, ',', '.'), 1, 1, 'R', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura/3.5, 5, 'Total safra Prevista:', 1, 0, 'L', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/4.25, 5, number_format($totalbrutaanualprevista, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($totalliquidaanualprevista, 2, ',', '.'), 1, 0, 'R', 1);
            $pdf->Cell($largura/4.25, 5, number_format($totalmensalprevista, 2, ',', '.'), 1, 1, 'R', 1);
            
            /*
             * Informações sobre o produtor
             */
            $pdf->Ln(5);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 8);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-2, 4, '5. Informações do Produtor', 0, 1, 'L', 0);
            $pdf->Ln(5);

            $pdf->SetX($margemEsquerda+($largura/5));            
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Estrutura Fundiária (1 a 5)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('Familiar','Própria','Predominantemente própria','Predominantemente arrendada','Arrendada');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbEstrFundiaria',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Opera em M.futuro e opções (1 a 3)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('Sim,Brasil','Sim, no exterior','Não');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbOperaM',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Utiliza sistema organizado controle de receitas/despesas/resultado? (1 a 3)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('Sim, próprio','Sim, terceirizado','Não');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbSisControl',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Faz parte de Grupo Familiar ? (1 ou 2)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('Sim','Não');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbGrupoFamiliar',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'É cooperado em cooperativa rural? (1 ou 2)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('Sim','Não');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbCooperado',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Assistência técnica (1 a 5)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('Permanente Própria','Permanente Terceirizada','Temporal ou eventual','Apenas vinculada ao crédito','Sem assistência técnica');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbAssistencia',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Tempo de experiência na atividade (1 a 5)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('iniciante','1 a 4 anos','4 a 7 anos','7 a 11 anos','maior que 11 anos');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbTempoAtividade',$largura/4, 4.5,$opc,$prop);
            
            $pdf->SetY($yAux+5);
            $pdf->SetX($margemEsquerda+($largura/5));
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
            $pdf->Cell($largura/3, 5, 'Experiência em operações rurais (1 a 3)', 1, 0, 'L', 1,'',1);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->Cell($largura/4, 5, '', 1, 0, 'L', 0);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
            $opc = array('iniciante','01 a 03 operações','Mais de 03 operações');
            $prop = array('text-align:center');
            $pdf->SetY($yAux+0.2);$pdf->SetX($xAux);
            $pdf->ComboBox('cmbExperiencia',$largura/4, 4.5,$opc,$prop);
            
            /*
             * Informações sobre o produtor
             */
            $pdf->Ln(5);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 8);
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura-2, 4, 'Observações:', 0, 1, 'L', 0);
            $pdf->Ln(3);
            $xAux = $pdf->GetX();$yAux = $pdf->GetY();
            $pdf->SetX($margemEsquerda);
            $tamanho = ($largura/1.75);
            
            // Conteúdo html
            $html ='<textarea cols="'. $tamanho . '" rows="4" name="text">';
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
            $pdf->writeHTML($html, true, 0, true, 1);
            
            // Assinaturas
            $pdf->ln(25);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda);
            $pdf->MultiCell($largura-2, 3, 'Validamos as Informações desse documento:                                                                                                                  ' .  $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 'L', 0, 1);
            $pdf->Ln(10);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemEsquerda + (($largura-70)/15));
            $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
            $pdf->Cell(100, 4,$tecnico->row()->nome .', '. $conselhoArray[0].$conselhoArray[1] . ',responsável pela ASTEC.', 'T', 0, 'C', 0);
            $pdf->Cell(10, 4,'', 0, 0, 'C', 0);
            $pdf->Cell(100, 4,'Assinatura do funcionário (carimbo e rubrica)', 'T', 0, 'C', 0);
        }
        
        // Log de usuário
        $log = array(
            'empresa' => $this->session->userdata('empresa'),
            'usuario' => $this->session->userdata('usuario'),
            'acao'    => 36,
            'registro'=> 'CPF/CNPJ: ' . $cpfcnpj
        );
        $this->modelLogUsuario->gravarLog($log);
        
        // Dá saída no relatório
        $pdf->Output('Cadastro_Cliente_' . format::primeiroNome($cliente->row()->nome) . '.pdf', 'D');
    }

    private static function configSubHeader($pdf,$y,$titulo){
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        // Fonte
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->setY($y);$pdf->SetX($margemEsquerda);

        // Verifica qual a cor do cabeçalho principal
        if($pdf->getSemCor()){
            $pdf->SetFillColor(150);
        }else{
            $pdf->SetFillColor(86,135,161);
        }
        $pdf->Cell($largura-2, 6, $titulo, 0, 1, 'C', 1);
        $pdf->SetX($margemEsquerda);
        // Verifica qual a cor do sub-cabeçalho
        if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
        }else{
            $pdf->SetFillColor(168,197,214);
        }
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
    }

    private function imprimeSubCabecalhoRurais($pdf,$y){
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        
        // Verifica qual a cor do sub-cabeçalho
        if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
        }else{
            $pdf->SetFillColor(168,197,214);
        }
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
        $pdf->Cell($largura/10, 3, 'Nome Imóvel', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Matrícula', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'CCIR', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'NIRF', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Município/UF', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Distrito ou Bairro', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Latitude(G,M,S)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Longitude(G,M,S)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Local de Registro', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Participação (%)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Cessão p/Terceiros', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Situação', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Estado Conserv.', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Gravame.', 'RTB', 0, 'L', 1);

        $pdf->Ln(6.25);
        $pdf->SetX($margemEsquerda);
        $pdf->MultiCell($largura/10, 36, 'Capacidade de Uso do Solo', 'RTB', 'L', 1, 0, '', '', true, 1, false, true, 40, 'M');
        
        $y = $pdf->GetY() +(3 * 11);
        $pdf->SetY($y-0.25);
        
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Área Total', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Valor por Hectare', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/10, 3, 'Valor Total Terra Nua', 'RTB', 1, 'L', 1);

        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }
    
    private function imprimeSubCabecalhoUrbanos($pdf,$y){
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        $this->configSubHeader($pdf, $y, 'RELAÇÃO DE IMÓVEIS URBANOS');
        $pdf->Cell($largura/13, 5, 'Espécie/Tipo', '', 0, 'C', 1);
        $pdf->Cell($largura/10, 5, 'Cart.Registro/Matr.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/21.5, 5, 'CEP', 'L', 0, 'C', 1);
        $pdf->Cell($largura/4, 5, 'Endereço', 'L', 0, 'C', 1);
        $pdf->Cell($largura/9, 5, 'Município', 'L', 0, 'C', 1);
        $pdf->Cell($largura/31, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/18, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell($largura/16, 5, 'Conservação', 'L', 0, 'C', 1);
        $pdf->Cell($largura/24, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell($largura/16, 5, 'A.Terreno', 'L', 0, 'C', 1);
        $pdf->Cell($largura/16, 5, 'A.Construída', 'L', 0, 'C', 1);
        $pdf->Cell($largura/11, 5, 'Valor', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }
    
    private function imprimeSubCabecalhoSemoventes($pdf,$y){
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        $this->configSubHeader($pdf, $y, 'RELAÇÃO DE SEMOVENTES');
        $pdf->Cell($largura/9, 5, 'Espécie/Tipo', '', 0, 'C', 1);
        $pdf->Cell($largura/30, 5, 'Qtd.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/7, 5, 'Finalidade', 'L', 0, 'C', 1);
        $pdf->Cell($largura/9, 5, 'Raça', 'L', 0, 'C', 1);
        $pdf->Cell($largura/16, 5, 'Mestiçagem', 'L', 0, 'C', 1);
        $pdf->Cell($largura/15, 5, 'Idade(Meses)', 'L', 0, 'C', 1);
        $pdf->Cell($largura/19, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell($largura/19, 5, 'Seguro', 'L', 0, 'C', 1);
        $pdf->Cell($largura/15, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell($largura/30, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/13, 5, 'Valor Unitário.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/12, 5, 'Valor Total.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/10, 5, 'Local (Matri.Imóvel)', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }

    private function imprimeSubCabecalhoMoveis($pdf,$y) {
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        $this->configSubHeader($pdf, $y, 'RELAÇÃO DE BENS MÓVEIS');
        $pdf->Cell($largura/5.75, 5, 'Espécie/Tipo', '', 0, 'C', 1);
        $pdf->Cell($largura/9, 5, 'Fabricante', 'L', 0, 'C', 1);
        $pdf->Cell($largura/9, 5, 'Modelo', 'L', 0, 'C', 1);
        $pdf->Cell($largura/19, 5, 'Ano/Mod', 'L', 0, 'C', 1);
        $pdf->Cell($largura/14, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell($largura/19, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell($largura/14, 5, 'Série/Chassi', 'L', 0, 'C', 1);
        $pdf->Cell($largura/16, 5, 'Potência', 'L', 0, 'C', 1);
        $pdf->Cell($largura/16, 5, 'Conservação', 'L', 0, 'C', 1);
        $pdf->Cell($largura/30, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/11, 5, 'Valor.', 'L', 0, 'C', 1);
        $pdf->Cell($largura/10, 5, 'Local (Matri.Imóvel)', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }
    
    private function imprimeCabecalhoProducaoAgricola($pdf,$y,$tecnico,$cliente,$empresa, $imoveisRuraisExplorados){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        $altura = $pdf->getPageHeight();
        $limiteAltura = $altura - 13;
        $this->configSubHeader($pdf, $y, 'INFORMAÇÕES SOBRE A PRODUÇÃO AGRÍCOLA');
        
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
        $pdf->Cell(($largura/2)-1, 4, $empresa->row()->nomeresponsavel, 'B', 0, 'L', 1);
        $pdf->Cell(($largura/2)-1, 4, 'CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj), 'B', 1, 'R', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '',9);        
        $pdf->SetX($margemEsquerda);
        $pdf->Cell(($largura/6), 4, 'Cliente: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4,  $cliente->row()->nome, '', 0, 'L', 1);
        $pdf->Cell(($largura/6), 4, 'CPF/CNPJ: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4, format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell(($largura/6), 4, 'Conjuge: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4,  $cliente->row()->nomeconjuge, '', 0, 'L', 1);
        $pdf->Cell(($largura/6), 4, 'CPF/CNPJ: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4, format::formatarCPF_CNPJ($cliente->row()->cpfconjuge), '', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura-2, 5, '1. Relação Imóveis Explorados', 'TB', 1, 'L', 1);
        
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Descrição', 'RT', 0, 'C', 1);
        $pdf->Cell($largura/11, 4, 'Matrícula', 'LT', 0, 'C', 1);
        $pdf->Cell($largura/5, 4, 'Proprietário', 'LT', 0, 'C', 1);
        $pdf->Cell($largura/7.675, 4, 'CPF/CNPJ', 'LT', 0, 'C', 1);
        $pdf->Cell($largura/14, 4, 'Area Total(ha)', 'LT', 0, 'C', 1);
        $pdf->Cell($largura/4, 4, 'Municipio', 'LT', 1, 'C', 1);
        
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
        
        // Controle preenchimento
        $fill = 1;
        foreach ($imoveisRuraisExplorados as $imovel){
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura/4, 4, $imovel->nome, 'RT', 0, 'C', $fill);
            $pdf->Cell($largura/11, 4, $imovel->matricula, 'LT', 0, 'C', $fill);
            $pdf->Cell($largura/5, 4, $cliente->row()->nome, 'LT', 0, 'C', $fill);
            $pdf->Cell($largura/7.675, 4, format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), 'LT', 0, 'C', $fill);
            $pdf->Cell($largura/14, 4, $imovel->areatotal , 'LT', 0, 'C', $fill);
            $pdf->Cell($largura/4, 4, $imovel->municipioDesc, 'LT', 1, 'C', $fill);
            $fill = !$fill;
        }
        $pdf->Line($margemEsquerda, $pdf->GetY(), $pdf->getPageWidth()-2, $pdf->GetY());

        // Controle de quebra de páginas
        $posY = $pdf->getY();
        if($limiteAltura <= $posY){
            $pdf->AddPage('L',PDF_PAGE_FORMAT);
            $this->configSubHeader($pdf,20, 'INFORMAÇÕES SOBRE A PRODUÇÃO AGRÍCOLA');
        }
        
        // Impressão dos Resultados
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
        // Verifica qual a cor do sub-cabeçalho
        if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
        }else{
            $pdf->SetFillColor(168,197,214);
        }
        $pdf->ln(3);
        
        $yRegistros = $pdf->GetY();
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, '2. Explorações Agrícolas', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Municipio', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Atividade', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Atividade (código)', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Sistema de Produção ( nr. empreendimento RTA)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Tipo de Cultivo', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Irrigação', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Época de Colheita (mm/aa)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Época de Comercialização (mm/aa)', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Período de Produção', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Safra', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Participação (%)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Área (ha)', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Unidade de produtividade', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Preço Unitário (obtido ou previsto)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Produtividade prevista', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Produtividade obtida', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Frustração de Safra (S/N)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Receita Bruta', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'CUSTO de PRODUÇÃO por ha (R$/ha)', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Custo de Produção total', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Custo total com arrendamento (R$/ano)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, '% de tratores/implementos de terceiros:', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, '% de colheitadeiras de terceiros:', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'RECEITA (R$) por Unidade de Produção (ha)', 'RT', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura/4, 4, 'Receita líquida (R$)', 'RT', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 8);
        $pdf->Cell($largura/4, 4, 'Imóveis Explorados', 'RT', 0, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $pdf->Cell($largura-($largura/4)-2, 4, 'Área explorada (ha)', 'TL', 0, 'C', 1);

        // Cabeçalho das obtidas/previstas
        $margemAux = $margemEsquerda+($largura/4);

        for($i=0;$i<4;$i++){
            $pdf->SetY($yRegistros);
            // Verifica qual usar
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, 'Obtida', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/10.75, 4, 'Prevista', 'LT', 1, 'C', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);

            // Imprime os dados
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/5.365, 4,'', 'LT', 1, 'C', 0);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/5.365, 4, '', 'LT', 1, 'C', 0);

            // Verifica qual usar
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/5.365, 4, '', 'LT', 1, 'C', 1);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/5.365, 4, '', 'LT', 1, 'C', 0);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/5.365, 4, '', 'LT', 1, 'C', 0);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);
            
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            // Verifica qual usar (Unidade de produtividade)
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/5.365, 4, '', 'LT', 1, 'C', 1);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);

            // Como é uma cell vazia, deixa o fill escuro
            $pdf->SetFillColor(110);
            $pdf->Cell($largura/10.75, 4, ' ', 'LT', 1, 'C', 1);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);

            // Como é uma cell vazia, deixa o fill escuro
            $pdf->SetFillColor(110);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            // Verifica qual usar
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 1);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            // Verifica qual usar
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 1);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 0);

            // Verifica qual usar
            if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
            }else{
            $pdf->SetFillColor(168,197,214);
            }
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 0, 'C', 1);
            $pdf->Cell($largura/10.75, 4, '', 'LT', 1, 'C', 1);
            $pdf->SetX($margemAux);
            $pdf->Cell($largura/10.75, 4, '', 'LTB', 0, 'C', 1);
            $pdf->Cell($largura/10.75, 4, '', 'LTB', 1, 'C', 1);
            $pdf->Ln();
            $margemAux += ($largura/10.75) * 2;
        }

        // Total imóveis rurais explorados
        for($i=0;$i<count($imoveisRuraisExplorados);$i++){
            $pdf->SetX($margemEsquerda);
            $pdf->Cell($largura/4, 4, '', 1, 0, 'L', 1);
            $pdf->Cell($largura/10.75, 4, '', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4,'', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4,'', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4,'', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4, '', 'LTB', 0, 'C', 0);
            $pdf->Cell($largura/10.75, 4,'', 'LTB', 1, 'C', 0);
        }
        // Assinaturas
        $pdf->ln(1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
        $pdf->SetX($margemEsquerda);
        $pdf->MultiCell($largura-2, 3, 'Validamos as Informações desse documento:                                                                                                                  ' .  $empresa->row()->municipioDesc . ', ' . dateUtil::dateToString($pdf->getDataRelatorio()), 0, 'L', 0, 1);
        $pdf->Ln(5);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
        $pdf->SetX($margemEsquerda + (($largura-70)/15));
        $conselhoArray = explode('-',$tecnico->row()->conselhoregional);
        $pdf->Cell(100, 4,$tecnico->row()->nome .', '. $conselhoArray[0].$conselhoArray[1] . ',responsável pela ASTEC.', 'T', 0, 'C', 0);
        $pdf->Cell(10, 4,'', 0, 0, 'C', 0);
        $pdf->Cell(100, 4,'Assinatura do funcionário (carimbo e rubrica)', 'T', 0, 'C', 0);

        // Atualiza a posição dos registros
        $yRegistros += 4;
        $pdf->setY($yRegistros);
    }
    
    private function imprimeCabecalhoProducaoPecuaria($pdf,$y,$tecnico,$cliente,$empresa,$imoveisRuraisExplorados){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Pega a Largura da mágina
        $margemEsquerda = $pdf->getMargemEsquerda();
        $largura = $pdf->getPageWidth() - $margemEsquerda;
        $altura = $pdf->getPageHeight();
        $limiteAltura = $altura - 13;
        $this->configSubHeader($pdf, $y, 'INFORMAÇÕES SOBRE A PRODUÇÃO PECUÁRIA');
        
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
        $pdf->Cell(($largura/2)-1, 4, $empresa->row()->nomeresponsavel, 'B', 0, 'L', 1);
        $pdf->Cell(($largura/2)-1, 4, 'CNPJ: ' . format::formatarCPF_CNPJ($empresa->row()->cnpj), 'B', 1, 'R', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '',9);        
        $pdf->SetX($margemEsquerda);
        $pdf->Cell(($largura/6), 4, 'Cliente: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4,  $cliente->row()->nome, '', 0, 'L', 1);
        $pdf->Cell(($largura/6), 4, 'CPF/CNPJ: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4, format::formatarCPF_CNPJ($cliente->row()->cpfcnpj), '', 1, 'L', 1);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell(($largura/6), 4, 'Conjuge: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4,  $cliente->row()->nomeconjuge, '', 0, 'L', 1);
        $pdf->Cell(($largura/6), 4, 'CPF/CNPJ: ', '', 0, 'L', 1);
        $pdf->Cell(($largura/3)-1, 4, format::formatarCPF_CNPJ($cliente->row()->cpfconjuge), '', 1, 'L', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
        $pdf->SetX($margemEsquerda);
    
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 8);
        $pdf->SetX($margemEsquerda);
        $pdf->Cell($largura-2, 4, '3. Explorações Pecuárias', 'T', 1, 'L', 0);
        
        // Impressão dos Resultados
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'BI', 9);
        // Verifica qual a cor do sub-cabeçalho
        if($pdf->getSemCor()){
            $pdf->SetFillColor(190);
        }else{
            $pdf->SetFillColor(168,197,214);
        }
    }
}