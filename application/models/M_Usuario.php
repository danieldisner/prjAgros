<?php

class M_Usuario extends CI_Model{
    
    // Função responsável por buscar o usuário
    public function logar($usuario = null, $email = null){
        $this->db->select('usuario.*,grupousuario.nrotentativa');
        $this->db->from('usuario');
        $this->db->join('grupousuario', 'usuario.grupo = grupousuario.id');
        $consulta=null;
        if(!empty($email)){
            $this->db->where('email', $email);
            $consulta = $this->db->get();
        }else if(!empty($usuario)){
            $this->db->where('usuario', $usuario);
            $consulta = $this->db->get();
        }
        return $consulta;
    }
    
    // Função Adicionar Tentativa ou Bloquear o Usuário
    public function addTentativa($usuario, $tentativa, $bloqueado = 0){
        $data = array(
                       'numerodatentativa' => $tentativa,
                       'bloqueado' => $bloqueado
                    );
        $this->db->where('usuario', $usuario);
        $this->db->update('usuario', $data); 
    }
    
    // Função para inserir um registro
    public function inserir($dados){
       return $this->db->insert('usuario',$dados);
    }
    
    // Busca um determinado registro pelo email
    public function buscarRegistroEmail($email){
        $this->db->select('email');
        $this->db->from('usuario'); 
        $this->db->where('email',$email);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Busca um determinado registro pelo usuario
    public function buscarRegistroUsuario($usuario){
        $this->db->select('email');
        $this->db->from('usuario'); 
        $this->db->where('usuario',$usuario);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Busca um determinado registro pelo usuario
    public function buscarRegistroToken($usuario,$token){
        $this->db->select('usuario');
        $this->db->from('usuario'); 
        $this->db->where('usuario',$usuario);
        $this->db->where('token', $token);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Busca um determinado registro pelo email
    public function buscarUsuarioEmail($email){
        $this->db->select('*');
        $this->db->from('usuario'); 
        $this->db->where('email',$email);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Confirmar o Email
    public function confirmarEmail($usuario){
        $this->db->where('usuario', $usuario);
        $this->db->set('confirmado',true);
        return $this->db->update('usuario'); 
    }
    
    // Função Adicionar Tentativa ou Bloquear o Usuário
    public function mudarSenha($usuario, $senha){
        $data = array(
                       'senha' => $senha
                    );
        $this->db->where('usuario', $usuario);
        return $this->db->update('usuario', $data); 
    }
}