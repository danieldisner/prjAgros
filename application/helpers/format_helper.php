<?php

class format{

    public static function formatarCPF_CNPJ($campo, $formatado = true){
        // Retira Formatação
        $codigoLimpo = preg_replace('/\D+/','', $campo); 
        // Pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo) -2);
        // Verifica se o tamanho do código informado é válido
        if($tamanho != 9 && $tamanho != 12){
            return null;
        }
        if($formatado){
            // Seleciona a máscara para cpf ou cnpj
            $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';
            $indice = -1;
            for ($i=0; $i < strlen($mascara); $i++){
                if($mascara[$i]=='#'){
                    $mascara[$i] = $codigoLimpo[++$indice];
                }
            }
            // Retorna o campo formatado
            $retorno = $mascara;
        }else{
            // Se não quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }
        return $retorno;
    }

    public static function formatarCEP($campo, $formatado = true){
        // Retira o formato
        $codigoLimpo = preg_replace('/\D+/','', $campo); 
        // Pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo));
        // Verifica se o tamanho do código informado é válido
        if($tamanho != 8){
            return null;
        }
        if($formatado){
            // Seleciona a máscara para cpf ou cnpj
            $mascara = '#####-###';
            $indice = -1;
            for ($i=0; $i < strlen($mascara); $i++){
                if($mascara[$i]=='#'){
                    $mascara[$i] = $codigoLimpo[++$indice];
                }
            }
            // Retorna o campo formatado
            $retorno = $mascara;
        }else{
            // Se não quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }
        return $retorno;
    }
    
    public static function formatarTelefone($campo, $formatado = true){
        // Retira o formato
        $codigoLimpo = preg_replace('/\D+/','', $campo); 
        // Pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo));
        // Verifica se o tamanho do código informado é válido
        if($tamanho < 10){
            return null;
        }
        if($formatado){
            // Seleciona a máscara para o Telefone
            $mascara = ($tamanho == 11) ? '(##) #####-####' : '(##) ####-####';
            $indice = -1;
            for ($i=0; $i < strlen($mascara); $i++){
                if($mascara[$i]=='#'){
                    $mascara[$i] = $codigoLimpo[++$indice];
                }
            }
            // Retorna o campo formatado
            $retorno = $mascara;
        }else{
            // Se não quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }
        return $retorno;
    }
    
    public static function monetarioTofloat($valor) {
        $valor = str_ireplace('.','',$valor);
        $valor = str_ireplace(',','.',$valor);
        return $valor;
    }
    
    public static function primeiroNome($str){
        $pos_espaco = strpos($str,' ');
        $primeiro_nome = substr($str, 0, $pos_espaco);
        //$resto_nome = substr($str, $pos_espaco, strlen($str));
        return $primeiro_nome;
    }
}