<?php

class dateUtil{

    public static function dateToString($date){
        // Cria um array com os componentes da data
        $data = explode('/', $date);

        $mes = '';
        switch($data[1]) {
                case '01':
                        $mes = 'JANEIRO';
                        break;
                case '02':
                        $mes = 'FEVEREIRO';
                        break;
                case '03':
                        $mes = 'MARÇO';
                        break;
                case '04':
                        $mes = 'ABRIL';
                        break;
                case '05':
                        $mes = 'MAIO';
                        break;
                case '06':
                        $mes = 'JUNHO';
                        break;
                case '07':
                        $mes = 'JULHO';
                        break;
                case '08':
                        $mes = 'AGOSTO';
                        break;
                case '09':
                        $mes = 'SETEMBRO';
                        break;
                case '10':
                        $mes = 'OUTUBRO';
                        break;
                case '11':
                        $mes = 'NOVEMBRO';
                        break;
                case '12':
                        $mes = 'DEZEMBRO';
                        break;
        }
        // Retorna a string da data no formato dd/mm/yyyy
        return $data[0] . ' DE ' . $mes . ' DE ' . $data[2];
    }
    
    // Pega o período informado e transforma em um array com a data inicial e final
    public static function periodoToArrayDatas($mes1,$ano1,$mes2,$ano2){
        // Prepara as datas para extração do relatório
        $dataInicio = '01/'. $mes1. '/'. $ano1;

        $result  = strtotime((int)$ano2 . '-' . (int)$mes2 . '-01');
        $result  = strtotime('-1 second', strtotime('+1 month', $result));
        $dataFim = date('d/m/Y', $result);

        return array('dataInicio'=>$dataInicio,'dataFim'=>$dataFim);
    }

    public static function formatDateDB($data){
        $data = date('Y-m-d',strtotime(str_replace('/','-',$data)));  
        return  date('Y-m-d', strtotime($data));
    }
    
    public static function abreviaPeriodoString($dataInicio,$dataFim){
        $dataInicioArray = explode('/', $dataInicio);
        $dataFimArray = explode('/', $dataFim);
        
        $stringData = '';
        // Se os anos forem iguais
        if($dataInicioArray[2] == $dataFimArray[2]){
            // Se os meses forem iguais
            if($dataInicioArray[1] == $dataFimArray[1]){
                //  Coloca apenas o mês concatenado com o ano
                $stringData = dateUtil::abreviaMes($dataInicioArray[1]) . '-' . $dataInicioArray[2];
            // Se for um ano inteiro, concatena somente o ano (janeiro à dezembro)
            }else if($dataInicioArray[1] == '01' && $dataFimArray[1] == '12'){
                $stringData =  $dataInicioArray[2];
            }else{
                // Se não, coloca o mes dataInicio "a" mes dataFim, concatenado com o ano
                $stringData = dateUtil::abreviaMes($dataInicioArray[1]) . ' a ' . dateUtil::abreviaMes($dataFimArray[1]) . '-' . $dataInicioArray[2];
            }
        }else{
            // Se não, mes DataInicio concatenado com o ano "a" mes DataFim concatenado com o ano
            $stringData = dateUtil::abreviaMes($dataInicioArray[1]) . '-' . $dataInicioArray[2] . ' a ' . dateUtil::abreviaMes($dataFimArray[1]) . '-' . $dataFimArray[2];
        }
        return $stringData;
    }
    
    public static function abreviaMes($mes){
        $abreviado = '';
        switch($mes){
                case '01':
                        $abreviado = 'jan.';
                        break;
                case '02':
                        $abreviado = 'fev.';
                        break;
                case '03':
                        $abreviado = 'mar.';
                        break;
                case '04':
                        $abreviado = 'abr.';
                        break;
                case '05':
                        $abreviado = 'maio';
                        break;
                case '06':
                        $abreviado = 'jun.';
                        break;
                case '07':
                        $abreviado = 'jul.';
                        break;
                case '08':
                        $abreviado = 'ago.';
                        break;
                case '09':
                        $abreviado = 'set.';
                        break;
                case '10':
                        $abreviado = 'out.';
                        break;
                case '11':
                        $abreviado = 'nov.';
                        break;
                case '12':
                        $abreviado = 'dez.';
                        break;
        }
        // Retorna o mês abreviado
        return $abreviado;
    }
}