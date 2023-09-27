function onlyNumbers(e){
    // Teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda)
    // ctrlKey = 17, vKey = 86, cKey = 67, xKey = 88, virgula = 188/44;
    keyCodesPermitidos = new Array(8,9,37,39,46,17,86,88,67);
     
    // Numeros de 0 a 9 do teclado alfanumerico
    for(x=48;x<=57;x++){
        keyCodesPermitidos.push(x);
    }
     
    // Numeros de 0 a 9 do teclado numerico
    for(x=96;x<=105;x++){
        keyCodesPermitidos.push(x);
    }
    
    // Teclas 'F1 até F12'
    for(x=112;x<=123;x++){
        keyCodesPermitidos.push(x);
    }
    // Pega a tecla digitada
    keyCode = e.which; 
     
    // Verifica se a tecla digitada é permitida
    if($.inArray(keyCode,keyCodesPermitidos) !== -1){
        return true;
    }    
    return false;
};

function onlyNumbersAndComma(e){
    // Teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda e vírgula)
    // ctrlKey = 17, vKey = 86, cKey = 67, xKey = 88, virgula = 188/108;
    keyCodesPermitidos = new Array(8,9,37,39,46,188,17,86,88,67,108);
     
    // Numeros de 0 a 9 do teclado alfanumerico
    for(x=48;x<=57;x++){
        keyCodesPermitidos.push(x);
    }
     
    // Numeros de 0 a 9 do teclado numerico
    for(x=96;x<=105;x++){
        keyCodesPermitidos.push(x);
    }
    
    // Teclas 'F1 até F12'
    for(x=112;x<=123;x++){
        keyCodesPermitidos.push(x);
    }
    // Pega a tecla digitada
    keyCode = e.which; 
     
    // Verifica se a tecla digitada é permitida
    if($.inArray(keyCode,keyCodesPermitidos) !== -1){
        return true;
    }    
    return false;
};

// Função para validar extensão de arquivo
function validaExtensaoArquivo(arquivo, extensoes){
    var ext, valido;
    
    ext = arquivo.substring(arquivo.lastIndexOf('.')).toLowerCase();
    valido = false;
    
    for(var i = 0; i <= arquivo.length; i++){
        if(extensoes[i] === ext){
            valido = true;
            break;
        }
    }
    if(valido){
        return true;
    }
  return false;
};

// Valida os campos de uma determinada div
function validarCamposDiv(div){
    var campoVazio = null;
    var i = 0;
    var name = div + ' .required';
    $(name).each(function(){
        if($(this).val().replace(/[\._-]/g,'') == ''){
            $(this).css('background-color','#ffb7b7');
            if(i==0)
                campoVazio = $(this);
            i++;
        }else $(this).css('background-color','#fff');
    });
    if(campoVazio){
        campoVazio.focus();
        return false;
    }else{
        return true;
    }
};

function validarCPFCNPJ(string){
    var e = string.replace(/[^\d]+/g,'');
    var tam= e.length;
    if(!(tam===11 || tam===14)){
        return false;
    }
    if(tam===11){
        if(!validaCPF(e)){
            return false;
        }
        return true;
    }
    if(tam===14){
        if(!validaCNPJ(e)){
            return false;			
        }
        return true;
    }
};

function validaCPF(cpf){
    var soma = 0; 
    var Resto; 
    if(cpf === '00000000000') return false; 
    for(i=1; i<=9; i++) soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i); Resto = (soma * 10) % 11; 
    if((Resto === 10) || (Resto === 11)) Resto = 0; 
    if(Resto !== parseInt(cpf.substring(9, 10)) ) return false; 
    soma = 0; 
    for(i = 1; i <= 10; i++) soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i); 
    Resto = (soma * 10) % 11; 
    if((Resto === 10) || (Resto === 11)) Resto = 0; 
    if(Resto !== parseInt(cpf.substring(10, 11)))return false; 
    return true;
};

function validaCNPJ(cnpj){
cnpj = cnpj.replace(/[^\d]+/g,'');

if(cnpj == '') return false;
 
if(cnpj.length != 14) return false;

// Elimina CNPJs invalidos conhecidos
if (cnpj == '00000000000000' || 
	cnpj == '11111111111111' || 
	cnpj == '22222222222222' || 
	cnpj == '33333333333333' || 
	cnpj == '44444444444444' || 
	cnpj == '55555555555555' || 
	cnpj == '66666666666666' || 
	cnpj == '77777777777777' || 
	cnpj == '88888888888888' || 
	cnpj == '99999999999999')
	return false;
	 
// Valida DVs
tamanho = cnpj.length - 2
numeros = cnpj.substring(0,tamanho);
digitos = cnpj.substring(tamanho);
soma = 0;
pos = tamanho - 7;
for (i = tamanho; i >= 1; i--) {
  soma += numeros.charAt(tamanho - i) * pos--;
  if (pos < 2)
		pos = 9;
}
resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
if (resultado != digitos.charAt(0))
	return false;
	 
tamanho = tamanho + 1;
numeros = cnpj.substring(0,tamanho);
soma = 0;
pos = tamanho - 7;
for (i = tamanho; i >= 1; i--) {
  soma += numeros.charAt(tamanho - i) * pos--;
  if (pos < 2)
		pos = 9;
}
resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
if (resultado != digitos.charAt(1))
	  return false;
	   
return true;
};

function number_format(number, decimals, dec_point, thousands_sep){
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point === undefined ? ',' : dec_point;
    var t = thousands_sep === undefined ? '.' : thousands_sep, s = n < 0 ? '-' : '';
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + '', j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
}

function blurNumeric(valor,digitos){
    digitos = (!digitos) ? 2 : digitos;
    var numero = valor;
    numero = parseFloat(numero.replace(',','.'));
    return number_format(numero,digitos,',','.');
};

function validaPeriodo(mes1,ano1,mes2,ano2){
    if((parseInt(ano1)>parseInt(ano2)) || ((parseInt(ano1)==parseInt(ano2)) && (parseInt(mes1) > parseInt(mes2))))
        return false;
    else return true;
};

function validarEmail(sEmail){
    var emailFilter=/^.+@.+\..{2,}$/;
    var illegalChars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/;
    // condição
    if(!(emailFilter.test(sEmail))||sEmail.match(illegalChars)){
        return false;
    }else{
        return true;
    }
};