<style type='text/css'>
#imagem-logo{
    height: 285px;
    width: 570px;
    border: 1px solid #ddd;
    -webkit-border-radius: 5px 5px 5px 5px;
    -khtml-border-radius: 5px 5px 5px 5px;
    text-align: center;
    padding: 10px 10px 10px 10px;
    margin: 0 auto;
}
#input-imagem-logo{
    width: 500px;
    margin: 0 auto;
}
</style>
<div id='janelaPrincipal' title='Manutenção Dados Empresa' style='display: none'>
    <form id='frmCadEmpresa' method='post'>
        <input type='hidden' id='logo' name='logo'/>
        <input type='hidden' id='id' value='<?php echo $empresa['id'];?>' name='id'/>
        <div id='tabs'>
            <ul>
                <li><a href='#abaDadosEmpresa'>Dados da Empresa</a></li>
                <li><a href='#abaLogo'>Logo</a></li>
            </ul>
            <div id='abaDadosEmpresa' style='height: 100%'>
                <div class='form-group'>
                    <div class='row'>
                        <div class='col-xs-6'>
                            <label class='control-label'>CNPJ</label>
                            <input type='text' value='<?php echo $empresa['cnpj'];?>' class='form-control cnpj required' id='cnpj' name='cnpj' placeholder='CNPJ' style='max-width: 150px'/>
                        </div>
                    </div>
                    <div class='row'>
                         <div class='col-xs-6'>
                            <label class='control-label'>Razão Social</label>
                            <input type='text' value='<?php echo $empresa['razaosocial'];?>' class='form-control required' id='razaosocial' name='razaosocial' placeholder='Razão Social'/>
                        </div>
                        <div class='col-xs-6'>
                            <label class='control-label'>Nome Fantasia</label>
                            <input type='text ' value='<?php echo $empresa['nomefantasia'];?>'  class='form-control required' id='nomefantasia' name='nomefantasia' placeholder='Nome Completo'/>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-xs-2'>
                            <label class='control-label'>CEP</label>
                            <input type='text' value='<?php echo $empresa['cep'];?>' class='form-control cep required' id='cep' name='cep' placeholder='CEP'/>
                        </div>
                        <div class='col-xs-7'>
                            <label class='control-label'>Endereço</label>
                            <input type='text' value='<?php echo $empresa['endereco'];?>' class='form-control required' id='endereco' name='endereco' placeholder='Endereço'/>
                        </div>
                         <div class='col-xs-1'>
                          <label class='control-label'>Nº</label>
                          <input type='text' value='<?php echo $empresa['nroendereco'];?>' class='form-control' id='nroendereco' name='nroendereco' placeholder='Número' />
                        </div>
                        <div class='col-xs-2'>
                          <label class='control-label'>Complemento</label>
                          <input type='text' value='<?php echo $empresa['complemento'];?>' class='form-control' id='complemento' name='complemento' placeholder='Complemento'>
                        </div>
                        <div class='col-xs-3'>
                          <label class='control-label'>Bairro</label>
                          <input type='text' value='<?php echo $empresa['bairro'];?>' class='form-control' id='bairro' name='bairro' placeholder='Bairro'>
                        </div>
                        <div class='col-xs-3'>
                            <label class='control-label'>Estado</label>
                            <select class='form-control' id='estado' name='estado'>
                                <option value=''>Selecione o Estado</option> 
                                    <option value='AC'>ACRE</option> 
                                    <option value='AL'>ALAGOAS</option> 
                                    <option value='AM'>AMAZONAS</option> 
                                    <option value='AP'>AMAPÁ</option> 
                                    <option value='BA'>BAHIA</option> 
                                    <option value='CE'>CEARÁ</option> 
                                    <option value='DF'>DISTRITO FEDERAL</option> 
                                    <option value='ES'>ESPÍRITO SANTO</option> 
                                    <option value='GO'>GOIÁS</option> 
                                    <option value='MA'>MARANHÃO</option> 
                                    <option value='MT'>MATO GROSSO</option> 
                                    <option value='MS'>MATO GROSSO DO SUL</option> 
                                    <option value='MG'>MINAS GERAIS</option> 
                                    <option value='PA'>PARÁ</option> 
                                    <option value='PB'>PARAÍBA</option> 
                                    <option value='PR'>PARANÁ</option> 
                                    <option value='PE'>PERNAMBUCO</option> 
                                    <option value='PI'>PIAUÍ</option> 
                                    <option value='RJ'>RIO DE JANEIRO</option> 
                                    <option value='RN'>RIO GRANDE DO NORTE</option> 
                                    <option value='RO'>RONDÔNIA</option> 
                                    <option value='RS'>RIO GRANDE DO SUL</option> 
                                    <option value='RR'>RORAIMA</option> 
                                    <option value='SC'>SANTA CATARINA</option> 
                                    <option value='SE'>SERGIPE</option> 
                                    <option value='SP'>SÃO PAULO</option> 
                                    <option value='TO'>TOCANTINS</option> 
                            </select>
                        </div>
                        <div class='col-xs-5 selectContainer'>
                            <label class='control-label'>Município</label>
                            <select class='form-control required' id='municipio' name='municipio' disabled='disabled'>
                                <option value=''>Selecione o Município</option>
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-xs-4'>
                            <label class='control-label'>Nome Responsável</label>
                            <input type='text' value='<?php echo $empresa['nomeresponsavel'];?>' class='form-control required' id='nomeresponsavel' name='nomeresponsavel' placeholder='Nome do Responsável'/>
                        </div>
                        <div class='col-xs-4'>
                            <label class='control-label'>CPF Responsável</label>
                            <input type='text' value='<?php echo $empresa['cpfresponsavel'];?>' class='form-control cpf required' id='cpfresponsavel' name='cpfresponsavel' placeholder='CPF do Responsável'/>
                        </div>
                        <div class='col-xs-4'>
                            <label class='control-label'>RG Responsável</label>
                            <input type='text' value='<?php echo $empresa['rgresponsavel'];?>' class='form-control' id='rgresponsavel' name='rgresponsavel' placeholder='RG Responsável'/>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-xs-2'>
                          <label class='control-label'>Telefone</label>
                          <input type='text' value='<?php echo $empresa['fone1'];?>' class='form-control telefone required' id='fone1' name='fone1' placeholder='Telefone'/>
                        </div>
                        <div class='col-xs-2'>
                           <label class='control-label'>Telefone (2)</label>
                          <input type='text' value='<?php echo $empresa['fone2'];?>' class='form-control telefone' id='fone2' name='fone2' placeholder='Telefone'/>
                        </div>
                    </div>
                </div>
            </div>
            <div id='abaLogo' style='height: 100%'>
                <form id='frmLogo' method='post'>
                    <div class='form-group'>
                        <div class='row'>
                            <div class='col-xs-12'>
                                <div id='imagem-logo'>
                                    <img id='imgEmpresa' name='imgEmpresa' class='logo' src='<?php echo $imagemLogo; ?>' style="width: 100%;height: 100%;" alt='logo'>
                                </div>
                                <br/>
                                <div id='input-imagem-logo'>
                                    <input id='fileLogo' name='fileLogo' class='form-control' type='file' accept="image/*"/>    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="groupBotoes">
            <input type='button' id='btnConfirmar' name='btnConfirmar' class='btn btn-lg btn-default'  value='Confirmar'/>
            <input type='button' id='btnLimpar' name='btnLimpar' class='btn btn-lg btn-default' value='Limpar'/>
            <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
        </div>
    </form>
</div>
<script>
$(function(){
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '60%',
        height: '535',
        modal: true
    });
    $('#id').focus();
    
    // Abas
    $('#tabs').tabs({
        heightStyle: 'content'
    });
    
    var imagemOriginal = '<?php echo $imagemLogo; ?>';
    
    // Carrega o estado e municipio da empresa
    $('#estado').val('<?php echo $empresa['uf'];?>');
    $('#municipio').load('<?php echo base_url('CadCliente/carregarMunicipio?') ?>'+'uf='+$('#estado').val()+'&municipioID='+<?php echo $empresa['municipio'];?>, function(){ 
        $('#municipio').removeAttr('disabled');
    });
    
    // Função que conecta com API para consultar o CEP
    var municipioDescSelecionado = '';
    $('#cep').change(function(){
        municipioDescSelecionado = '';
        municipioIDSelecionado = '';
        var cep_code = $(this).val();
        if( cep_code.length <= 0 ) return;
        $.get('http:\/\/apps.widenet.com.br\/busca-cep\/api\/cep.json',{code: cep_code},
        function(result){
            if(result.status!==1){
                $('#msgAlerta').html(result.message || 'Houve um erro desconhecido');
                $('#alertMessage').dialog('open');
                return;
            }
            $('#cep').val(result.code);
            municipioDescSelecionado = result.city;
            $('#estado').val(result.state);
            $('#estado').change();
            $('#bairro').val(result.district);
            $('#endereco').val(result.address);
        });
    });   
    
    // Controle do combobox com os municípios
    var municipioIDSelecionado = '';
    $('#estado').change(function(){
        if($('#estado').val()){
            $('#municipio').load('<?php echo base_url('CadCliente/carregarMunicipio?') ?>'+'uf='+$('#estado').val()+'&municipioID='+municipioIDSelecionado+'&municipioDesc='+municipioDescSelecionado, function(){ 
                $('#municipio').removeAttr('disabled');
            });
        }else{
            $('#municipio').val('');
            $('#municipio').attr('disabled','disabled');
        }
    });
    
    // Função de Callback do Post do Formulario
    function showResponse(response){
        $('#msgAlerta').html(response.msg);
        $('#alertMessage').dialog('open');
    };
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){
        // Verifica item a item do formulário           if(!$('#nome').val() || !$('#id').val()){
        if(!validarCamposDiv('#abaDadosEmpresa')){
            $('#msgAlerta').html('Campos obrigatórios não preenchidos.');
            $('#alertMessage').dialog('open');
            return false; 
        }
    };
    
    // Ação dos Botões
    $('#btnConfirmar').click(function(){
        $('#frmCadEmpresa').ajaxForm({
            clearForm: false,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadEmpresa/atualizar') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmCadEmpresa').submit();
    });
    
    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnLimpar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#frmCadEmpresa').resetForm();
        $('#estado').val('<?php echo $empresa['uf'];?>');
        $('#imgEmpresa').prop('src',imagemOriginal);
    };
    
    // Fazer validação de tamanho de arquivo, e tipo;
    $('#fileLogo').change(function(){
        if($(this).val() !== ''){
            // Usado para criar dados como se fosse de um formulário
            var dataForm = new FormData();
            dataForm.append('arquivoLogo', this.files[0]);
            $.ajax({
                url: '<?php echo base_url('CadEmpresa/uploadLogo') ?>',
                type: 'POST',
                success: function(data){
                    // Atualiza a imagem
                    $('#imgEmpresa').prop('src',data);
                    // Atualiza o caminho do arquivo para salvar no banco
                    $('#logo').val(data);
                },
                processData: false, // important
                contentType: false, // important
                dataType : 'json',
                data: dataForm
            });
        }
    });
});
</script>