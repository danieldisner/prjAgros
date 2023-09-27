<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImpResumoCliente extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_impResumoCliente';
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
    
    public function imprimir(){
        // Carrega a biblioteca de criação de pdf
        $this->load->library('PDF');
        
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Cria o novo documento PDF
        $pdf = new PDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // informações do documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Daniel Disner');
        $pdf->SetTitle('Impressão de Resumo Cliente');
        
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
        
        // Adiciona a Primeira Página
        $pdf->AddPage();
        
        // Pega a altura e largura da página
        $largura = $pdf->getPageWidth();
        $altura = $pdf->getPageHeight();
        $limiteAltura = $altura - 13;
        
        // Carrega os Models
        $this->load->model('M_Cliente', 'modelCliente');
        $this->load->model('M_Imovel', 'modelImovel');
        $this->load->model('M_Semovente', 'modelSemovente');
        $this->load->model('M_Movel', 'modelMovel');
        
        // Pega o CPF/CNPJ sem formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);

        // Busca o Registro
        $result = $this->modelCliente->buscarRegistro($this->session->userdata('empresa'),$cpfcnpj);
        
        // Inicio do Relatório
        
        /*
         * DADOS DO CLIENTE
         */
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->setY(20);$pdf->setX(2);
        // Cor do Cabeçalho Principal
        $pdf->SetFillColor(86,135,161);
        $pdf->Cell($largura-4, 6, 'RESUMO DO CLIENTE', 0, 1, 'C', 1);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
        $pdf->setX(2);
        $pdf->Cell(30, 6, 'Nome: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, $result->row()->nome, 0, 1, 'L', 0);
        $pdf->setX(2);
        $pdf->Cell(30, 6, 'CPF/CNPJ: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6,format::formatarCPF_CNPJ($result->row()->cpfcnpj), 0, 1, 'L', 0);
        $pdf->setX(2);
        $pdf->Cell(30, 6, 'Nome Cônjuge: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, $result->row()->nomeconjuge, 0, 1, 'L', 0);
        $pdf->setX(2);        
        $pdf->Cell(30, 6, 'CPF Cônjuge: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, format::formatarCPF_CNPJ($result->row()->cpfconjuge), 0, 1, 'L', 0);
        $pdf->setX(2);
        $pdf->Cell(30, 6, 'CEP: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, !empty($result->row()->cep) ? format::formatarCEP($result->row()->cep) : 'Não Informado.', 0, 1, 'L', 0);
        
        // Prepara o Endereço
        $endereco = $result->row()->endereco;
        $endereco .= empty($result->row()->nroendereco) ? '' : ', Nº '. $result->row()->nroendereco;    
        $endereco .= empty($result->row()->bairro) ? '' : ', ' . $result->row()->bairro;
        
        $pdf->setX(2);        
        $pdf->Cell(30, 6, 'Endereço: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, $endereco, 0, 1, 'L', 0); 
        $pdf->setX(2);        
        $pdf->Cell(30, 6, 'Município/UF: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, $result->row()->munDesc. '-' . $result->row()->uf, 0, 1, 'L', 0); 
        $pdf->setX(2);        
        $pdf->Cell(30, 6, 'Telefone: ', 0, 0, 'L', 0);
        $pdf->Cell(($largura/2)-15, 6, format::formatarTelefone($result->row()->fone1), 0, 0, 'L', 0); 
        $pdf->Cell(15, 6, 'Celular: ', 0, 0, 'L', 0);
        $pdf->Cell(($largura/2)-34, 6, format::formatarTelefone($result->row()->fone2), 0, 1, 'L', 0);
        $pdf->setX(2);
        $pdf->Cell(30, 6, 'Agencia: ', 0, 0, 'L', 0);
        $pdf->Cell($largura-34, 6, $result->row()->nomeAgencia, 0, 1, 'L', 0); 
        $pdf->setX(2);
        $pdf->Cell(30, 6, 'Prefixo: ', 0, 0, 'L', 0);
        $pdf->Cell(($largura/2)-15, 6, $result->row()->prefixoAgencia, 0, 0, 'L', 0); 
        $pdf->Cell(28, 6, 'Conta Corrente: ', 0, 0, 'L', 0);
        $pdf->Cell(($largura/2)-47, 6, $result->row()->conta, 0, 1, 'L', 0); 
        $pdf->Ln(1);

        /*
         * IMÓVEIS RURAIS
        */        
        // Busca os imoveis do cliente
        $imoveisRurais = $this->modelImovel->buscarDadosRurais($this->session->userdata('empresa'),$cpfcnpj);
        
        // Imprime o Sub Cabeçalho para os imóveis
        $this->imprimeSubCabecalhoRurais($pdf,$pdf->GetY());
        
        // Cor do fundo para "zebrar" as linhas
        $pdf->SetFillColor(240);
        
        // Controle preenchimento
        $fill = 1;
        
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
        $total = 0;
        foreach($imoveisRurais as $imovel){
            // Controle de quebra de páginas
            $posY = $pdf->getY();
            if($limiteAltura <= $posY){
                $pdf->AddPage();
                $this->imprimeSubCabecalhoRurais($pdf,20);
            }       
            $pdf->setX(2);
            $pdf->Cell(30, 5, $imovel->nome, '', 0, 'L', $fill,'',1);
            $pdf->Cell(28, 5, $imovel->matricula. ' - ' . $imovel->registro, 'L', 0, 'L', $fill,'',1);
            $pdf->Cell(30, 5, $imovel->bairro, 'L', 0, 'L', $fill,'',1);
            $pdf->Cell(33, 5, $imovel->municipioDesc . '-' . $imovel->uf , 'L', 0, 'L', $fill,'',1);
            $pdf->Cell(10, 5, $imovel->part .'%', 'L', 0, 'C', $fill);
            $pdf->Cell(16, 5, $imovel->cessaoterceirosDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(16, 5, $imovel->sitpropriedadeDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, $imovel->estadoconservacaoDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(12, 5, $imovel->gravameDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(15, 5, $imovel->areareserva . ' ha', 'L', 0, 'C', $fill);
            $pdf->Cell(15, 5, $imovel->areacultura . ' ha', 'L', 0, 'C', $fill);
            $pdf->Cell(15, 5, $imovel->areapastagem . ' ha', 'L', 0, 'C', $fill);
            $pdf->Cell(15, 5, $imovel->areaoutras . ' ha', 'L', 0, 'C', $fill);
            $pdf->Cell(15, 5, $imovel->areatotal . ' ha', 'L', 0, 'C', $fill);
            $pdf->Cell(25, 5,'R$ '. $imovel->valorterranua, 'L', 1, 'C', $fill);
            $total += format::monetarioTofloat($imovel->valorterranua);
            $fill = !$fill;
        }
        // Cor do totalizador
        $pdf->SetFillColor(145);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
        $pdf->setX(2);
        $pdf->Cell($largura-4, 6,'Total de Imóveis Rurais: '. count($imoveisRurais), 0, 0, 'C', 1);
        $pdf->setX(270);
        $pdf->Cell(25, 6,'R$ '. number_format($total, 2, ',', '.'), 0, 1, 'C', 1);
        $pdf->Ln();
        
        /*
         * IMÓVEIS URBANOS
         */
        // Busca os imoveis Urbanos
        $imoveisUrbanos = $this->modelImovel->buscarDadosUrbanos($this->session->userdata('empresa'),$cpfcnpj); 

        // Imprime o Sub Cabeçalho para os imóveis
        $this->imprimeSubCabecalhoUrbanos($pdf,$pdf->GetY());
        
        // Controle preenchimento
        $fill = 1;
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
        
        $total = 0;
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
            $pdf->setX(2);
            $pdf->Cell(30, 5, $imovel->especieDesc, '', 0, 'L', $fill);
            $pdf->Cell(28, 5, $imovel->matricula. ' - ' . $imovel->registro, 'L', 0, 'L', $fill,'',1);
            $pdf->Cell(13, 5, format::formatarCEP($imovel->cep), 'L', 0, 'C', $fill);
            $pdf->Cell(70, 5, $endereco, 'L', 0, 'L', $fill,'',1);
            $pdf->Cell(33, 5, $imovel->municipioDesc . '-' . $imovel->uf , 'L', 0, 'L', $fill,'',1);
            $pdf->Cell(10, 5, $imovel->part .'%', 'L', 0, 'C', $fill);
            $pdf->Cell(16, 5, $imovel->sitpropriedadeDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, $imovel->estadoconservacaoDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(12, 5, $imovel->gravameDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(17, 5, $imovel->areaterreno . ' m²', 'L', 0, 'C', $fill);
            $pdf->Cell(21, 5, $imovel->areaconstruida . ' m²', 'L', 0, 'C', $fill);
            $pdf->Cell(25, 5,'R$ '. $imovel->valortotal, 'L', 1, 'C', $fill);
            $total += format::monetarioTofloat($imovel->valortotal);
            $fill = !$fill;
        }
        // Cor do totalizador
        $pdf->SetFillColor(145);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
        $pdf->setX(2);
        $pdf->Cell($largura-4, 6,'Total de Imóveis Urbanos: '. count($imoveisUrbanos), 0, 0, 'C', 1);
        $pdf->setX(270);
        $pdf->Cell(25, 6,'R$ '. number_format($total, 2, ',', '.'), 0, 1, 'C', 1);
        $pdf->Ln();       
        
        /*
         * SEMOVENTES
         */        
        // Busca os Semoventes
        $semoventes = $this->modelSemovente->buscarDadosSemoventes($this->session->userdata('empresa'),$cpfcnpj); 
        
        // Imprime o Sub Cabeçalho para os semoventes
        $this->imprimeSubCabecalhoSemoventes($pdf,$pdf->GetY());

        // Controle preenchimento
        $fill = 1;
        
        $valorTotal = 0;
        $qtdTotalSemoventes = 0;
        foreach($semoventes as $semovente){
            // Controle de quebra de páginas
            $posY = $pdf->getY();
            if($limiteAltura <= $posY){
                $pdf->AddPage();
                $this->imprimeSubCabecalhoSemoventes($pdf,20);
            }
            $pdf->setX(2);
            $pdf->Cell(50, 5, $semovente->especieDesc, '', 0, 'L', $fill,'',1);
            $pdf->Cell(10, 5, $semovente->quantidade, 'L', 0, 'C', $fill);
            $pdf->Cell(40, 5, $semovente->finalidadeDesc, 'L', 0, 'C', $fill,'',1);
            $pdf->Cell(30, 5, $semovente->racaDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, $semovente->graumesticagem, 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, $semovente->idade, 'L', 0, 'C', $fill);
            $pdf->Cell(16, 5, $semovente->gravameDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(16, 5, $semovente->seguroDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(20, 5, $semovente->sitpropriedadeDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(10, 5, $semovente->part . '%', 'L', 0, 'C', $fill);
            $pdf->Cell(20, 5, $semovente->matricula, 'L', 0, 'C', $fill);   
            $pdf->Cell(20, 5,'R$ '. $semovente->valorunitario, 'L', 0, 'C', $fill);
            $pdf->Cell(25, 5,'R$ '. $semovente->valortotal, 'L', 1, 'C', $fill);
            $qtdTotalSemoventes += $semovente->quantidade;
            $valorTotal += format::monetarioTofloat($semovente->valortotal);
            $fill = !$fill;
        }
        // Cor do totalizador
        $pdf->SetFillColor(145);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
        $pdf->setX(2);
        $pdf->Cell($largura-4, 6,'Total de Semoventes: '. $qtdTotalSemoventes, 0, 0, 'C', 1);
        $pdf->setX(270);
        $pdf->Cell(25, 6,'R$ '. number_format($valorTotal, 2, ',', '.'), 0, 1, 'C', 1);
        $pdf->Ln();       
        
        /*
         * BENS MÓVEIS
         */
        // Busca os Móveis
        $moveis = $this->modelMovel->buscarDadosMoveis($this->session->userdata('empresa'),$cpfcnpj); 
        
        // Imprime o Sub Cabeçalho para os imóveis
        $this->imprimeSubCabecalhoMoveis($pdf,$pdf->GetY());
        
        // Controle preenchimento
        $fill = 1;
        $total = 0;
        foreach($moveis as $movel){
            // Controle de quebra de páginas
            $posY = $pdf->getY();
            if($limiteAltura <= $posY){
                $pdf->AddPage();
                $this->imprimeSubCabecalhoMoveis($pdf,20);
            }
            $pdf->setX(2);
            $pdf->Cell(50, 5, $movel->especieDesc, '', 0, 'C', $fill,'',1);
            $pdf->Cell(35, 5, $movel->fabricante, 'L', 0, 'C', $fill);
            $pdf->Cell(35, 5, $movel->modelo, 'L', 0, 'C', $fill,'',1);
            $pdf->Cell(20, 5, $movel->anomodelo, 'L', 0, 'C', $fill);
            $pdf->Cell(20, 5, $movel->sitpropriedadeDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, $movel->gravameDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(20, 5, $movel->seriechassi, 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, empty($movel->potencia)? '-': $movel->potencia . ' '. $movel->potenciatipo , 'L', 0, 'C', $fill);
            $pdf->Cell(18, 5, $movel->estadoconservacaoDesc, 'L', 0, 'C', $fill);
            $pdf->Cell(14, 5, $movel->part . '%', 'L', 0, 'C', $fill);
            $pdf->Cell(20, 5, $movel->matricula, 'L', 0, 'C', $fill);   
            $pdf->Cell(25, 5,'R$ '. $movel->valor, 'L', 1, 'C', $fill);
            $total += format::monetarioTofloat($movel->valor);
            $fill = !$fill;
        }
        // Cor do totalizador
        $pdf->SetFillColor(145);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 9);
        $pdf->setX(2);
        $pdf->Cell($largura-4, 6,'Total de Bens Móveis: '.  count($moveis), 0, 0, 'C', 1);
        $pdf->setX(270);
        $pdf->Cell(25, 6,'R$ '. number_format($total, 2, ',', '.'), 0, 1, 'C', 1);
        $pdf->Ln();       
        
        // Log de usuário
        $log = array(
            'empresa' => $this->session->userdata('empresa'),
            'usuario' => $this->session->userdata('usuario'),
            'acao'    => 34,
            'registro'=> 'CPF/CNPJ: ' . $cpfcnpj
        );
        $this->modelLogUsuario->gravarLog($log);

        // Dá saída no relatório
        $pdf->Output('Resumo_Cliente_' . format::primeiroNome($result->row()->nome) . '.pdf', 'D');
    }
    
    private static function configSubHeader($pdf,$y,$titulo){
        // Pega a Largura da mágina
        $largura = $pdf->getPageWidth();
        // Fonte
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->setY($y);$pdf->setX(2);
        // Cor do Cabeçalho Principal
        $pdf->SetFillColor(86,135,161);
        $pdf->Cell($largura-4, 6, $titulo, 0, 1, 'C', 1);
        $pdf->setX(2);
        // Cor do Sub Cabeçalho
        $pdf->SetFillColor(168,197,214);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 7);
    }
    
    private function imprimeSubCabecalhoRurais($pdf,$y){
        $this->configSubHeader($pdf, $y, 'BENS IMÓVEIS RURAIS');
        $pdf->Cell(30, 5, 'Nome', '', 0, 'C', 1);
        $pdf->Cell(28, 5, 'Cart.Registro/Matr.', 'L', 0, 'C', 1);
        $pdf->Cell(30, 5, 'Bairro/Distrito', 'L', 0, 'C', 1);
        $pdf->Cell(33, 5, 'Municipio', 'L', 0, 'C', 1);
        $pdf->Cell(10, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell(16, 5, 'Cessão 3º(s)', 'L', 0, 'C', 1);
        $pdf->Cell(16, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Conservação', 'L', 0, 'C', 1);
        $pdf->Cell(12, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell(15, 5, 'A.Reserva', 'L', 0, 'C', 1);
        $pdf->Cell(15, 5, 'A.Cultura', 'L', 0, 'C', 1);
        $pdf->Cell(15, 5, 'A.Pastagem', 'L', 0, 'C', 1);
        $pdf->Cell(15, 5, 'A.Outras', 'L', 0, 'C', 1);
        $pdf->Cell(15, 5, 'A.Total', 'L', 0, 'C', 1);
        $pdf->Cell(25, 5, 'Valor Terra Nua', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }
    
    private function imprimeSubCabecalhoUrbanos($pdf,$y){
        $this->configSubHeader($pdf, $y, 'BENS IMÓVEIS URBANOS');
        $pdf->Cell(30, 5, 'Espécie/Tipo', '', 0, 'C', 1);
        $pdf->Cell(28, 5, 'Cart.Registro/Matr.', 'L', 0, 'C', 1);
        $pdf->Cell(13, 5, 'CEP', 'L', 0, 'C', 1);
        $pdf->Cell(70, 5, 'Endereço', 'L', 0, 'C', 1);
        $pdf->Cell(33, 5, 'Município', 'L', 0, 'C', 1);
        $pdf->Cell(10, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell(16, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Conservação', 'L', 0, 'C', 1);
        $pdf->Cell(12, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell(17, 5, 'Área Terreno', 'L', 0, 'C', 1);
        $pdf->Cell(21, 5, 'Área Construída', 'L', 0, 'C', 1);
        $pdf->Cell(25, 5, 'Valor', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }
    
    private function imprimeSubCabecalhoSemoventes($pdf,$y){
        $this->configSubHeader($pdf, $y, 'SEMOVENTES');
        $pdf->Cell(50, 5, 'Espécie/Tipo', '', 0, 'C', 1);
        $pdf->Cell(10, 5, 'Qtd.', 'L', 0, 'C', 1);
        $pdf->Cell(40, 5, 'Finalidade', 'L', 0, 'C', 1);
        $pdf->Cell(30, 5, 'Raça', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Mestiçagem', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Idade(Meses)', 'L', 0, 'C', 1);
        $pdf->Cell(16, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell(16, 5, 'Seguro', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell(10, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Local (Imóvel)', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Valor Unitário.', 'L', 0, 'C', 1);
        $pdf->Cell(25, 5, 'Valor Total.', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }

    private function imprimeSubCabecalhoMoveis($pdf,$y) {
        $this->configSubHeader($pdf, $y, 'BENS MÓVEIS');
        $pdf->Cell(50, 5, 'Espécie/Tipo', '', 0, 'C', 1);
        $pdf->Cell(35, 5, 'Fabricante', 'L', 0, 'C', 1);
        $pdf->Cell(35, 5, 'Modelo', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Ano/Mod', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Situação', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Gravame', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Série/Chassi', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Potência', 'L', 0, 'C', 1);
        $pdf->Cell(18, 5, 'Conservação', 'L', 0, 'C', 1);
        $pdf->Cell(14, 5, 'Part.', 'L', 0, 'C', 1);
        $pdf->Cell(20, 5, 'Local (Imóvel)', 'L', 0, 'C', 1);
        $pdf->Cell(25, 5, 'Valor.', 'L', 1, 'C', 1);
        // Cor de fundo das células para zebrar as células
        $pdf->SetFillColor(240);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 7);
    }
}
