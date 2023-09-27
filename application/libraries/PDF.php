<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class PDF extends TCPDF{
    private $segundaVia;
    
    public function getSegundaVia(){
        return $this->segundaVia;
    }
    
    public function setSegundaVia($segundaVia){
        $this->segundaVia = $segundaVia;
    }
    
    private $imprimeHora = true;
    
    public function getImprimeHora(){
        return $this->imprimeHora;
    }
    
    public function setImprimeHora($imprimeHora){
        $this->imprimeHora = $imprimeHora;
    }
    
    private $dataRelatorio;
    
    public function getDataRelatorio(){
        return $this->dataRelatorio;
    }
    
    public function setDataRelatorio($dataRelatorio){
        $this->dataRelatorio = $dataRelatorio;
    }
    
    private $margemEsquerda = 2;
    
    public function getMargemEsquerda(){
        return $this->margemEsquerda;
    }
    
    public function setMargemEsquerda($margemEsquerda){
        $this->margemEsquerda = $margemEsquerda;
    }
    
    private $semCor = false;

    public function getSemCor(){
        return $this->semCor;
    }

    public function setSemCor($semCor){
        $this->semCor = $semCor;
    }

    public function Header(){        
        // Largura da Página
        $largura = $this->getPageWidth();
        
        $this->setDataRelatorio(isset($this->dataRelatorio) ? $this->dataRelatorio :  date('d/m/Y'));
        
        // Linha que separa o cabeçalho
        $this->Line($this->margemEsquerda, 18, $largura-2, 18);

        // Carrega o Model
        $this->CI->load->model('M_Empresa', 'modelEmpresa');

        // Busca os dados da Empresa
        $result = $this->CI->modelEmpresa->buscarRegistro($this->CI->session->userdata('empresa'));
        
        // Verifica se a empresa possui um logo para imprimir
        $arquivoImagem = null;
        if($result->row()->logo){
            // Ponteiro para o arquivo de imagem
            $fp      = null;
            $arquivo = TEMP_DIR . '/logo'. $this->CI->session->userdata('empresa') . '.jpg';
            if($fp = fopen($arquivo, 'wb')){
                // Escreve a imagem no arquivo
                fwrite($fp,$result->row()->logo);
                // Fecha o arquivo
                fclose($fp);
            }
            // Recupera o arquivo temporario da imagem
            $arquivoImagem = $arquivo;
        }
        // Caso a imagem exista, imprime no relatório
        if($arquivoImagem){
            $this->Image($arquivoImagem, $this->margemEsquerda, 2, 40, 15);
        }
        // Segunda Via
        if($this->segundaVia === true){
           $this->SetFont(PDF_FONT_NAME_MAIN, 'B', 20);
           $this->SetTextColor(180,200,220);
           $this->setY(2); $this->setX($largura-50);
           $this->Cell(22, 15, '2ª VIA', 0, 1,'C');
        }
        $this->SetTextColor(0,0,0);
        $this->setY(4); $this->setX($largura-27);
        $this->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $this->Cell(20, 5, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 1);
        $this->setY(8); $this->setX($largura-27);
        // Hora do relatório
        if($this->imprimeHora === true){
            $this->Cell(20, 5, 'Hora: ' . date('H:i:s'), 0, 1);
        }
        $this->setY(12); $this->setX($largura-27);
        $this->Cell(20, 5, 'Data: ' . $this->dataRelatorio , 0, 1);

        // Cabeçalho Empresa
        $this->setY(2);$this->setX($this->margemEsquerda);
        $this->SetFont(PDF_FONT_NAME_MAIN, 'BI', 24);
        $this->Cell($largura - $this->margemEsquerda, 16, strtoupper($result->row()->nomefantasia), 0, 1, 'C');
    }

    public function Footer() {
        // Largura da Página
        $largura = $this->getPageWidth();
        $altura = $this->getPageHeight();
        // Linha que separa o rodapé
        $this->Line($this->margemEsquerda, $altura-8, $largura-2, $altura-8);
                
        // Carrega o Model
        $this->CI->load->model('M_Empresa', 'modelEmpresa');
        
        // Carrega o Helper de Formatação
        $this->CI->load->helper('format');

        // Busca os dados da Empresa
        $result = $this->CI->modelEmpresa->buscarRegistro($this->CI->session->userdata('empresa'));
        
        // Verifica se a empresa possui um logo para imprimir
        $arquivoImagem = null;
        if($result->row()->logo){
            // Recupera o arquivo temporario da imagem
            $arquivoImagem = TEMP_DIR . '/logo'. $this->CI->session->userdata('empresa') . '.jpg';
        }

        // Caso a imagem exista, imprime no relatório
        if($arquivoImagem){
            $this->Image($arquivoImagem, $this->margemEsquerda, $altura-7,  13, 5.5);
        }
        // Linha do Rodapé
        $this->SetY(-7.5);
        $this->SetX($this->margemEsquerda+14);
        $this->SetFont('helvetica', 'I', 7);
        $this->Cell(0, 3,$result->row()->nomefantasia, 0, 1, 'L');
        $this->SetX($this->margemEsquerda+14);
        $this->Cell(0, 3,$result->row()->endereco. ', ' . $result->row()->nroendereco . '. ' . $result->row()->bairro . '. ' .$result->row()->municipioDesc. '-' .$result->row()->uf. '.  Contato: '. format::formatarTelefone($result->row()->fone1), 0, 1, 'L');
    }
}