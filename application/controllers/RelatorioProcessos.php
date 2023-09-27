<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RelatorioProcessos extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_relatorioProcessos';
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
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
        $this->load->model('M_Operacoes', 'modelOperacoes');

        // Pega o CPF/CNPJ sem formatação
        $cpfcnpj = format::formatarCPF_CNPJ($this->input->post('cpfcnpj'),false);
        
        // Busca o Registro
        $clientes = $this->modelCliente->buscarRegistroRelatorioProcessos($this->session->userdata('empresa'),$cpfcnpj);
        
        // Inicio do Relatório
        /*
         * DADOS DO RELATÓRIO
         */
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->setY(20);$pdf->setX(2);
        // Cor do Cabeçalho Principal
        $pdf->SetFillColor(86,135,161);
        $pdf->Cell($largura-4, 6, 'Relatório de Status das Operações', 1, 1, 'C', 1);        
        $pdf->Ln(3);
        
        // Controle de registro do cliente
        $registro = 0;
        // Percorre os clientes
        foreach($clientes as $cliente){
            if($registro > 0){
                // Controle de quebra de páginas
                $pdf->AddPage();
                $pdf->setY(20);$pdf->setX(2);
                $pdf->Cell($largura-4, 6, 'Relatório de Status das Operações', 1, 1, 'C', 1);        
                $pdf->Ln(3);                
            }
            
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
            $pdf->setX(2);
            $pdf->Cell(50, 6, 'CPF/CNPJ Cliente', 1, 0, 'C', 1);
            $pdf->Cell(156, 6, 'Nome', 1, 1, 'C', 1);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
            $pdf->setX(2);
            $pdf->Cell(50, 6, format::formatarCPF_CNPJ($cliente->cpfcnpj), 1, 0, 'C', 1);
            $pdf->Cell(156, 6, $cliente->nome, 1, 1, 'C', 1);
          
            // Busca as operações
            $operacoes = $this->modelOperacoes->buscarDadosRelatorioProcessos($this->session->userdata('empresa'),format::formatarCPF_CNPJ($cliente->cpfcnpj,false),$this->input->post('cicloanoinicio'),$this->input->post('cicloanofim'));

            // Percorre as operações
            foreach($operacoes as $operacao){
                // Verifica se cabe na página
                if($pdf->GetY() >= ($limiteAltura - 60)){
                    $pdf->AddPage();
                    $pdf->SetY(20);
                }
                $pdf->setX(2);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
                $pdf->Cell($largura-4, 6, 'Operação', 1, 1, 'C', 1);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9);
                $pdf->setX(2);
                $pdf->Cell(50, 4, 'Atividade', 1, 0, 'C', 1);
                $pdf->Cell(156, 4, $operacao->tipooperacao, 1, 1, 'C', 0);
                $pdf->setX(2);
                $pdf->Cell(50, 4, 'Finalidade', 1, 0, 'C', 1);
                $pdf->Cell(156, 4, $operacao->finalidade, 1, 1, 'C', 0);
                $pdf->setX(2);
                $pdf->Cell(50, 4, 'Ciclo', 1, 0, 'C', 1);
                $pdf->Cell(156, 4, $operacao->ciclocanoinicio . ' / ' . $operacao->ciclocanofim , 1, 1, 'C', 0);
                $pdf->setX(2);
                $pdf->Cell(50, 4, 'Status', 1, 0, 'C', 1);
                $pdf->Cell(156, 4, $operacao->status, 1, 1, 'C', 0);
                // Se for análise
                if($operacao->status == 'ANÁLISE'){
                    $pdf->setX(2);
                    $pdf->Cell(50, 4, 'Situação', 1, 0, 'C', 1);
                    $pdf->Cell(156, 4, ($operacao->aprovado) ? 'APROVADO' : 'NEGADO', 1, 1, 'C', 0);
                    // Se for aprovado
                    if($operacao->aprovado){
                        $pdf->setX(2);
                        $pdf->Cell(50, 4, 'Linha de Crédito', 1, 0, 'C', 1);
                        $pdf->Cell(156, 4, $operacao->linhacreditoanalise, 1, 1, 'C', 0);
                        $pdf->setX(2);
                        $pdf->Cell(50, 4, 'Data Liberação', 1, 0, 'C', 1);
                        $pdf->Cell(156, 4, $operacao->dataliberacaoanalise, 1, 1, 'C', 0);
                        $pdf->setX(2);
                        $pdf->Cell(50, 4, 'Taxa Juros', 1, 0, 'C', 1);
                        $pdf->Cell(156, 4, $operacao->taxajurosanalise, 1, 1, 'C', 0);
                        $pdf->setX(2);
                        $pdf->Cell(50, 4, 'Prazo', 1, 0, 'C', 1);
                        $pdf->Cell(156, 4, $operacao->prazoanalise, 1, 1, 'C', 0);
                        $pdf->setX(2);
                        $pdf->Cell(50, 4, 'Data Reembolso', 1, 0, 'C', 1);
                        $pdf->Cell(156, 4, $operacao->datareembolsoanalise, 1, 1, 'C', 0);
                    // Se for negado
                    }else{
                        $pdf->setX(2);
                        $pdf->Cell(50, 4, 'Data Conclusão', 1, 0, 'C', 1);
                        $pdf->Cell(156, 4, $operacao->dataconclusaoanalise, 1, 1, 'C', 0);
                    }
                // Se for Projeto
                }else{
                    $pdf->setX(2);
                    $pdf->Cell(50, 4, 'Linha de Crédito', 1, 0, 'C', 1);
                    $pdf->Cell(156, 4, $operacao->linhacreditoprojeto, 1, 1, 'C', 0);
                    $pdf->setX(2);
                    $pdf->Cell(50, 4, 'Taxa Juros', 1, 0, 'C', 1);
                    $pdf->Cell(156, 4, $operacao->taxajurosprojeto, 1, 1, 'C', 0);
                    $pdf->setX(2);
                    $pdf->Cell(50, 4, 'Data Início', 1, 0, 'C', 1);
                    $pdf->Cell(156, 4, $operacao->datainicioprojeto, 1, 1, 'C', 0);
                    $pdf->setX(2);
                    $pdf->Cell(50, 4, 'Data Conclusão', 1, 0, 'C', 1);
                    $pdf->Cell(156, 4, $operacao->dataconclusaoprojeto, 1, 1, 'C', 0);
                }
                $pdf->Ln(3);
            }
            $pdf->Ln();
            $registro++;
        }
        
        // Log de usuário
        $log = array(
            'empresa' => $this->session->userdata('empresa'),
            'usuario' => $this->session->userdata('usuario'),
            'acao'    => 34,
            'registro'=> 'CPF/CNPJ: ' . $cpfcnpj
        );
        $this->modelLogUsuario->gravarLog($log);

        // Dá saída no relatório
        $pdf->Output('Status_Processos'. '.pdf', 'D');
    }
}
