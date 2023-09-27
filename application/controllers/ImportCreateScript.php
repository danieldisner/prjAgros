<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportCreateScript extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_importCreateScript';
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        $this->load->view('v_layout',$dados);
    }
    
    public function enviarArquivo(){
        // Localização do diretório Temporário
        $config['upload_path']          = TEMP_DIR;
        // Formatos Permitidos  || Ex: 'gif|jpg|png';
        $config['allowed_types']        = 'txt';
        // Tamanho Máximo Ṕermitido
        $config['max_size']             = 30000;
        // Carrega biblioteca de upload
        $this->load->library('upload', $config);

        // Se conseguir fazer o Upload do Arquivo
        if($this->upload->do_upload('arquivo')){
            $data = array('upload_data' => $this->upload->data());
            var_dump($data);
            $this->importarArquivo($this->upload->data());
        }else{
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        }
    }
    
    private function importarArquivo($dadosArq){        
        // Abre o arquivo
        $arquivo = fopen($dadosArq['full_path'], 'r');        
        $arqScript = fopen(TEMP_DIR.'/script1.sql', 'w+');
        $countReg = 1;
        
        // Enquanto conseguir ler o arquivo
        while($linha = fgets($arquivo)){
            $escreverLinha = "INSERT INTO NOME_TABELA VALUES('".$countReg. "',";
            $colunas = explode(';',$linha);
            $countCol = 1;
            foreach($colunas as $coluna){
                if($countCol != 37 && $countCol != 38){
                    $escreverLinha .= '\''. str_replace(',','.', $coluna) . '\',';
                }else{
                    $escreverLinha .= '\''. $coluna . '\',';
                }
                $countCol++;
            }
            
            $escreverLinha .= ');';
            fwrite($arqScript, $escreverLinha);
            $countReg++;
        }
        fclose($arquivo);
    }
}
