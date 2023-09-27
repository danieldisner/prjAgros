<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportMunicipios extends MY_Controller{
    // Campos Usados no Preenchimento dos Formularios
    protected $camposForm = array('arquivo'=>'', 'btnConfirmar'=>'false');

    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_importMunicipios';
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        $this->load->view('v_layout',$dados);
    }
    
    public function enviarArquivo(){
        // Localização do diretório Temporário
        $config['upload_path']          = TEMP_DIR;
        // Formatos Permitidos  || Ex: 'gif|jpg|png';
        $config['allowed_types']        = 'csv';
        // Tamanho Máximo Ṕermitido
        $config['max_size']             = 3000;
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
        // Carrega o Model
        $this->load->model('M_Municipio', 'modelMunicipio');
        
        // Abre o arquivo
        $arquivo = fopen($dadosArq['full_path'], 'r');
        
        $estados = array('Acre','Alagoas','Amapá','Amazonas','Bahia ','Ceará','Distrito Federal','Espírito Santo','Goiás','Maranhão',
                         'Mato Grosso','M Grosso do Sul','Minas Gerais','Pará','Paraíba','Paraná','Pernambuco','Piauí','Rio de Janeiro',
                         'Rio Grande do Norte','Rio Grande do Sul','Rondônia','Roraima','Santa Catarina','São Paulo','Sergipe','Tocantins');
        
        $ufs = array('AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR',
                     'SC','SP','SE','TO');
        
        $i = 0; 
        // Enquanto conseguir ler o arquivo
        while($linha = fgetcsv($arquivo, $dadosArq['file_size'], ';')){
            if($i != 0){
                // Prepara os dados
                $dados = array(
                    "nome" => $linha[0],
                    "uf" => str_replace($estados, $ufs, $linha[1])
                );
                // Insere os dados
                $this->modelMunicipio->inserir($dados);
            }
            $i++;
        }
        fclose($arquivo);
    }

    public function dadosGrid(){
        // Carrega o Model
        $this->load->model('M_Municipio', 'modelMunicipio');
        
        $result = $this->modelMunicipio->buscarDadosGrid(); 
        
        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result
        );
        echo json_encode($dados);
    }
}
