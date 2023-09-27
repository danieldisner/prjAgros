<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadEmpresa extends MY_Controller{
    public function index(){
        // Carrega o Model
        $this->load->model('M_Empresa', 'modelEmpresa');
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_cadEmpresa';
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        
        // Busca a empresa
        $empresa = $this->modelEmpresa->buscarRegistro($this->session->userdata('empresa'));
        // Atribui os dados para mostrar na view
        $dados['empresa'] = $empresa->row_array();
        
        $arquivoImagem = '';
        if($empresa->row()->logo){
            // Ponteiro para o arquivo de imagem
            $fp      = null;
            $arquivo = TEMP_DIR . '/logo'. $this->session->userdata('empresa') . '.jpg';
            if($fp = fopen($arquivo, 'wb')){
                // Escreve a imagem no arquivo
                fwrite($fp,$empresa->row()->logo);
                // Fecha o arquivo
                fclose($fp);
            }
            // Recupera o arquivo temporario da imagem
            $arquivoImagem = $arquivo;
        }
        $dados['imagemLogo'] = $arquivoImagem;
        
        $this->load->view('v_layout',$dados);
    }
    
    public function atualizar(){
        // Carrega o Helper de Formatação
        $this->load->helper('format');
        
        // Carrega o Helper de Tratamento
        $this->load->helper('tratamento');

        // Carrega os Models
        $this->load->model('M_Empresa', 'modelEmpresa');
        
        // Cria array com os dados da empresa
        $empresa = array();
        $empresa['id']              = $this->input->post('id');
        $empresa['razaosocial']     = $this->input->post('razaosocial');
        $empresa['nomefantasia']    = $this->input->post('nomefantasia');
        $empresa['cnpj']            = format::formatarCPF_CNPJ($this->input->post('cnpj'),false);
        $empresa['cep']             = format::formatarCEP($this->input->post('cep'),false);
        $empresa['endereco']        = $this->input->post('endereco');
        $empresa['nroendereco']     = $this->input->post('nroendereco');
        $empresa['complemento']     = $this->input->post('complemento');
        $empresa['bairro']          = $this->input->post('bairro');
        $empresa['municipio']       = $this->input->post('municipio');           
        $empresa['fone1']           = format::formatarTelefone($this->input->post('fone1'),false);
        $empresa['fone2']           = format::formatarTelefone($this->input->post('fone2'),false);
        $empresa['nomeresponsavel'] = $this->input->post('nomeresponsavel');
        $empresa['cpfresponsavel']  = format::formatarCPF_CNPJ($this->input->post('cpfresponsavel'),false);
        $empresa['rgresponsavel']   = $this->input->post('rgresponsavel');
        
        // Usa o file_get_contentes para pegar o conteúdo da imagem e salvar no banco
        $empresa['logo']            =  file_get_contents($this->input->post('logo'));
        
        // Trata o Array setando como null os campos em branco
        $empresa = tratamento::null_array($empresa);
        
        // Insere os dados
        $result = $this->modelEmpresa->atualizar($empresa['id'],$empresa);
        
        // Se conseguiu inserir
        if($result){
            // Log de usuário
            $log = array(
              'empresa' => $this->session->userdata('empresa'),
              'usuario' => $this->session->userdata('usuario'),
              'acao'    => 43,
              'registro'=> 'CNPJ: ' . $empresa['cnpj']
            );
            $this->modelLogUsuario->gravarLog($log);
            // Mensagem alerta
            $mensagem = 'Empresa atualizada com sucesso.';
        }else{
            $mensagem = 'Erro atualizar dados da empresa.';

        }
        $response = array(
           'msg' => $mensagem
        );
        echo json_encode($response);
    }
    
    public function uploadLogo(){   
        // Carrega o Helper de imagem
        $this->load->helper('imageutil');
        
        // Localização do diretório Temporário
        $config['upload_path']          = TEMP_DIR;
        // Formatos Permitidos  || Ex: 'gif|jpg|png';
        $config['allowed_types']        = 'gif|jpg|png';
        // Tamanho Máximo Ṕermitido
        $config['max_size']             = 30000;
        // Carrega biblioteca de upload
        $this->load->library('upload', $config);

        // Se conseguir fazer o Upload do Arquivo
        if($this->upload->do_upload('arquivoLogo')){
            // Pega as informações de upload
            $data = array('upload_data' => $this->upload->data());
            
            // Pega o arquivo e a extenção
            $arrayArquivo = explode('.', $data["upload_data"]['file_name']);
            
            // $arrayArquivo[0] = nome do arquivo; $arrayArquivo[1] = extenção
            imageutil::convertImageJPG($data["upload_data"]['file_name'], $arrayArquivo[0].'.jpg');

            // Retorna a imagem para adicionar aos dados
            echo json_encode(TEMP_DIR.'/'.$arrayArquivo[0].'.jpg');
        }else{
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        }
    }
}
