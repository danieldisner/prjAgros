<div id='janelaPrincipal' title='Cadastro de Produção Agrícola' style='display: none;'>
    <div class='form-dialog-ui' style='height: 100%'>
        <form id='frmCadProducaoAgricola' method='post'>
            <input type='hidden' id='dadosImoveisExploradosAgricola' name='dadosImoveisExploradosAgricola'/>
            <input type='hidden' id='dadosAreaExploradaImoveis' name='dadosAreaExploradaImoveis'/>
            <input type='hidden' id='idProducao' name='idProducao'/>
            <div class='form-group' style='height: 515px'>
                <div class='row'>
                    <div class='col-xs-1'>
                        <label for='btnProcCliente'></label>
                    </div>
                    <div id='rdGroupCpf' class='col-xs-10'>
                        <input type='radio' id='rdCPF' name='rdTipoCliente' checked='checked'/><label for='rdCPF'>CPF</label>
                        <input type='radio' id='rdCNPJ' name='rdTipoCliente'/><label for='rdCNPJ'>CNPJ</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-1'>
                        <button id='btnProcCliente' name='btnProcCliente' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                    </div>
                    <div class='col-xs-3'>
                        <input type='text' class='form-control cpf' id='cpfcnpj' name='cpfcnpj' placeholder='CPF Cliente'/>
                    </div>
                    <div class='col-xs-8'>
                        <input type='text' class='form-control' id='nome' name='nome' placeholder='Nome Completo'/>
                    </div>
                </div>
                <div class='row' style='padding-left: 5px;padding-right: 5px'>
                    <div id='accordion'>
                        <h3 id='accordionImoveis'>Relação de Imóveis Explorados</h3>
                        <div id='divAccordionImoveis' class='groupAccordion'>
                            <div id='gridImoveisExplorados'></div>
                        </div>
                    </div>
                    <div style='padding-top: 3px' id='accordion2'>
                        <h3 id='accordionExploracao'><strong>Explorações Agrícolas</strong></h3>
                        <div id='divAccordionExploracao' class='groupAccordion' style='height: 285px'>
                            <button id='btnProcExploracao' name='btnProcExploracao' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span><strong> Procura de Exploração Agrícola</strong></button>
                            <table class='table table-responsive table-bordered table-exploracao'>
                                <thead>
                                    <tr>                              
                                        <th class='table-header' style='width:30%'>Explorações Agrícolas Obtidas/Previstas</th>
                                        <th class='table-header text-center' style='width:35%'>Obtida</th>
                                        <th class='table-header text-center' style='width:35%'>Prevista</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class='table-sub-header'>Município</th>
                                        <td colspan='2' style='padding: 3px'>
                                            <select style='width:100%' class='input-cell-content' id='municipio' name='municipio'>
                                                <option value=''>Selecione Município</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Atividade</th>
                                        <td colspan='2' style='padding: 3px'>
                                            <select style='width:100%' class='input-cell-content' id='atividade' name='atividade'>
                                                <?php foreach($produtosAgricola as $produto){ ?>
                                                    <option value='<?php echo $produto['id']?>'><?php echo $produto['nome']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Sistema de Produção</td>
                                        <td style='padding: 3px'><input style='width:100%' class='input-cell-content onlynumbers' type='text' id='sistemaproducaoobtida' name='sistemaproducaoobtida' placeholder='Nr. Empreendimento RTA'/></td>
                                        <td style='padding: 3px'><input style='width:100%' class='input-cell-content onlynumbers' type='text' id='sistemaproducaoprevista' name='sistemaproducaoprevista' placeholder='Nr. Empreendimento RTA'/></td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Tipo de Cultivo</td>
                                        <td colspan='2' style='padding: 3px'>
                                            <select style='width:100%' class='input-cell-content' id='tipocultivo' name='tipocultivo'>
                                                <?php foreach($tiposCultivo as $tipoCultivo){ ?>
                                                    <option value='<?php echo $tipoCultivo['id']?>'><?php echo $tipoCultivo['nome']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Irrigação</td>
                                        <td colspan='2' style='padding: 3px;text-align: center;'>
                                            <input type='checkbox' id='irrigacao' name='irrigacao' value='1'/> <span>NÃO</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Época de Colheita</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <select class='input-cell-content' style='width: 30%' name='colheitaObtidaMes1' id='colheitaObtidaMes1'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='colheitaObtidaAno1' id='colheitaObtidaAno1' maxlength='4' placeholder='Ano'/>
                                            &nbsp;à&nbsp;
                                            <select class='input-cell-content' style='width: 30%' name='colheitaObtidaMes2' id='colheitaObtidaMes2'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='colheitaObtidaAno2' id='colheitaObtidaAno2' maxlength='4' placeholder='Ano'/>
                                        </td>    
                                        <td style='padding: 3px;text-align: center;'>
                                            <select class='input-cell-content' style='width: 30%' name='colheitaPrevistaMes1' id='colheitaPrevistaMes1'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='colheitaPrevistaAno1' id='colheitaPrevistaAno1' maxlength='4' placeholder='Ano'/>
                                            &nbsp;à&nbsp;
                                            <select class='input-cell-content' style='width: 30%' name='colheitaPrevistaMes2' id='colheitaPrevistaMes2'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='colheitaPrevistaAno2' id='colheitaPrevistaAno2' maxlength='4' placeholder='Ano'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Época de Comercialização</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <select class='input-cell-content' style='width: 30%' name='comercializacaoObtidaMes1' id='comercializacaoObtidaMes1'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='comercializacaoObtidaAno1' id='comercializacaoObtidaAno1' maxlength='4' placeholder='Ano'/>
                                            &nbsp;à&nbsp;
                                            <select class='input-cell-content' style='width: 30%' name='comercializacaoObtidaMes2' id='comercializacaoObtidaMes2'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='comercializacaoObtidaAno2' id='comercializacaoObtidaAno2' maxlength='4' placeholder='Ano'/>
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <select class='input-cell-content' style='width: 30%' name='comercializacaoPrevistaMes1' id='comercializacaoPrevistaMes1'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='comercializacaoPrevistaAno1' id='comercializacaoPrevistaAno1' maxlength='4' placeholder='Ano'/>
                                            &nbsp;à&nbsp;
                                            <select class='input-cell-content' style='width: 30%' name='comercializacaoPrevistaMes2' id='comercializacaoPrevistaMes2'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='comercializacaoPrevistaAno2' id='comercializacaoPrevistaAno2' maxlength='4' placeholder='Ano'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Período de Produção</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <select class='input-cell-content' style='width: 30%' name='producaoObtidaMes1' id='producaoObtidaMes1'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='producaoObtidaAno1' id='producaoObtidaAno1' maxlength='4' placeholder='Ano'/>
                                            &nbsp;à&nbsp;
                                            <select class='input-cell-content' style='width: 30%' name='producaoObtidaMes2' id='producaoObtidaMes2'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='producaoObtidaAno2' id='producaoObtidaAno2' maxlength='4' placeholder='Ano'/>
                                        </td>    
                                        <td style='padding: 3px;text-align: center;'>
                                            <select class='input-cell-content' style='width: 30%' name='producaoPrevistaMes1' id='producaoPrevistaMes1'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='producaoPrevistaAno1' id='producaoPrevistaAno1' maxlength='4' placeholder='Ano'/>
                                            &nbsp;à&nbsp;
                                            <select class='input-cell-content' style='width: 30%' name='producaoPrevistaMes2' id='producaoPrevistaMes2'>
                                                <option value='01'>JANEIRO</option>
                                                <option value='02'>FEVEREIRO</option>
                                                <option value='03'>MARÇO</option>
                                                <option value='04'>ABRIL</option>
                                                <option value='05'>MAIO</option>
                                                <option value='06'>JUNHO</option>
                                                <option value='07'>JULHO</option>
                                                <option value='08'>AGOSTO</option>
                                                <option value='09'>SETEMBRO</option>
                                                <option value='10'>OUTUBRO</option>
                                                <option value='11'>NOVEMBRO</option>
                                                <option value='12'>DEZEMBRO</option>
                                            </select> de
                                            <input class='input-cell-content onlynumbers required' style='width: 11%' type='text' name='producaoPrevistaAno2' id='producaoPrevistaAno2' maxlength='4' placeholder='Ano'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Safra</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 20%' type='text' name='anosafrainicioobtida' id='anosafrainicioobtida' maxlength='4' placeholder='Ano'/>
                                            /
                                            <input class='input-cell-content onlynumbers' style='width: 20%' type='text' name='anosafrafimobtida' id='anosafrafimobtida' maxlength='4' placeholder='Ano'/>
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 20%' type='text' name='anosafrainicioprevista' id='anosafrainicioprevista' maxlength='4' placeholder='Ano'/>
                                            /
                                            <input class='input-cell-content onlynumbers' style='width: 20%' type='text' name='anosafrafimprevista' id='anosafrafimprevista' maxlength='4' placeholder='Ano'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Participação (%)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='participacaoobtida' id='participacaoobtida' maxlength='3' placeholder='100%'/>    
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='participacaoprevista' id='participacaoprevista' maxlength='3' placeholder='100%'/>     
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Área (ha)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='areaobtida' id='areaobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='areaprevista' id='areaprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Unidade de Produtividade</td>
                                        <td colspan='2' style='padding: 3px'>
                                            <select style='width:100%;background-color: #ddd;' class='input-cell-content select-no-style' id='unidadeprodutividade' name='unidadeprodutividade' disabled='disabled'>
                                                <option value=''></option>
                                                <?php foreach($produtosAgricola as $produto){ ?>
                                                <option value='<?php echo $produto['id']?>'><?php echo $produto['unidade']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Preço Unitário (obtido ou previsto)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal4' style='width: 100%' type='text' name='precounitarioobtida' id='precounitarioobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal4' style='width: 100%' type='text' name='precounitarioprevista' id='precounitarioprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Produtividade Prevista</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='produtividadeprevistaobtida' id='produtividadeprevistaobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='produtividadeprevistaprevista' id='produtividadeprevistaprevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Produtividade Obtida</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='produtividadeobtidaobtida' id='produtividadeobtidaobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content' style='width: 100%' placeholder='-' disabled='disabled'/>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Frustração de Safra (S/N)</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input type='checkbox' id='frustracaosafraobtida' name='frustracaosafraobtida'/> <span>NÃO</span>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content' style='width: 100%' placeholder='-' disabled='disabled'/>  
                                        </td>                                
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Receita Bruta</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitabrutaobtida' id='receitabrutaobtida' readonly='readonly'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitabrutaprevista' id='receitabrutaprevista' readonly='readonly'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Custo de Produção por ha (R$/ha)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaohectareobtida' id='custoproducaohectareobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaohectareprevista' id='custoproducaohectareprevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Custo de Produção Total</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaototalobtida' id='custoproducaototalobtida' readonly='readonly'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaototalprevista' id='custoproducaototalprevista' readonly='readonly'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Custo total com arrendamento (R$/ano)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custototalcomarrendamentoobtida' id='custototalcomarrendamentoobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custototalcomarrendamentoprevista' id='custototalcomarrendamentoprevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Tratores/Implementos de terceiros (%)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='tratoresimplementosterceirosobtida' id='tratoresimplementosterceirosobtida' maxlength='3' placeholder='100%'/>    
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='tratoresimplementosterceirosprevista' id='tratoresimplementosterceirosprevista' maxlength='3' placeholder='100%'/>     
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Colheitadeiras de terceiros (%)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='colheitadeirasterceirosobtida' id='colheitadeirasterceirosobtida' maxlength='3' placeholder='100%'/>    
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='colheitadeirasterceirosprevista' id='colheitadeirasterceirosprevista' maxlength='3' placeholder='100%'/>     
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>RECEITA (R$) por Unidade de Produção (ha)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitaunidadeproducaoobtida' id='receitaunidadeproducaoobtida' readonly='readonly'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitaunidadeproducaoprevista' id='receitaunidadeproducaoprevista' readonly='readonly'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Receita líquida (R$)</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitaliquidaobtida' id='receitaliquidaobtida' readonly='readonly'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitaliquidaprevista' id='receitaliquidaprevista' readonly='readonly'/>    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class='table table-responsive table-bordered table-hover table-exploracao'>
                                <thead>
                                    <tr>                              
                                        <th class='table-header' style='width:30%'>Imóveis Explorados</th>
                                        <th class='table-header text-center' colspan="2">Área explorada (ha)</td>
                                    </tr>
                                </thead>
                                <tbody id='imoveisExplorados'>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class='groupBotoes'>
                <input type='button' id='btnIncluir' name='btnIncluir' class='btn btn-lg btn-default' disabled='disabled' value='Incluir'/>
                <input type='button' id='btnAlterar' name='btnAlterar' class='btn btn-lg btn-default' disabled='disabled' value='Alterar'/>
                <input type='button' id='btnExcluir' name='btnExcluir' class='btn btn-lg btn-default' disabled='disabled' value='Excluir'/>
                <input type='button' id='btnLimpar' name='btnLimpar' class='btn btn-lg btn-default' value='Limpar'/>
                <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
            </div>
        </form>
    </div>
</div>
<div id='procuraExploracao' title='Procura Exploração Agrícola' style='display: none'>
    <div id='gridExploracao'></div>
</div>
<div id='procuraCliente' title='Procura Cliente' style='display: none'>
    <input type='text' class='form-control required' id='nomeBusca' name='nomeBusca' placeholder='Nome Cliente'/>
    <div id='gridCliente'></div>
</div>
<script>
$(function(){
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '90%',
        height: '650',
        modal: true,
        resizable: false,
        autoResize:true
    });
    $('#cpfcnpj').focus();
    
    // Arruma o conflito nos botões do JQuery UI para estilizar os radio Buttons
    if($.fn.button.noConflict){
        $.fn.btn = $.fn.button.noConflict();
    };
    
    // Inicia o grupo dos radios com o JQueryUI
    $('#rdGroupCpf').buttonset();
        
    // Inicia os botões para a classe jqbutton
    $('.jqbutton').button();
    
    // Função de Callback do Post do Formulario
    function showResponse(response){
        limparForm();
        $('#msgAlerta').html(response.msg);
        $('#alertMessage').dialog('open');
    };
    
    // Accordion
    $('#accordion,#accordion2').accordion({
        collapsible: true,
        heightStyle: 'content'
    });
    
    // Tela de Procura de Cliente
    $('#procuraCliente').dialog({
      dialogClass: 'no-close',
      resizable: false,
      modal: true,
      width: '620px',
      height: '320',
      autoOpen: false,
      buttons: {
        'Fechar': function(){
            $(this).dialog('close');
        }
      }
    });
    
    // Botão de Procura de Cliente
    $('#btnProcCliente').click(function(event){
        event.preventDefault();
        gridClienteLoad();
        $('#procuraCliente').dialog('open');
    });
    
    // Função responsável pelo carregamento da tela de procura de agência
    var $dgCliente = $('#gridCliente');
    function gridClienteLoad(){
        $dgCliente.datagrid({
            jsonStore: {
                url:' <?php echo base_url('CadCliente/dadosGridProcCliente?') ?>'  + 'nome=' + $('#nomeBusca').val()
            },
            height : 140,
            pagination: false,
            mapper:[
                {name: 'cpfcnpj',title:'CPF/CNPJ', width: '100px', align: 'left'},  
                {name: 'nome', title: 'Nome', width: '400px', align: 'left'},       
                {name: 'hidden', hidden: 'hidden'}
            ]        
            ,eventController: {
                onClickRow: function(tr) {
                    $('#procuraCliente').dialog('close');
                    $('#cpfcnpj').val(tr.cells[0].innerHTML);
                    $('#nomeBusca').val('');
                    $('#cpfcnpj').blur();
                }
            }  
        });
    };
    
    $('#nomeBusca').change(function(){
        gridClienteLoad();
    });
    
    // Tela de Procura de Exploracao
    $('#procuraExploracao').dialog({
        dialogClass: 'no-close',
        width: '55%',
        height: '310',
        resizable: false,
        modal: true,
        autoOpen: false,
        buttons: {
            'Limpar': function(){
                $('#idProducao').val('');
                buscarExploracao();
                $(this).dialog('close');
            },
            'Fechar': function(){
                $(this).dialog('close');
            }
        }
    });
    
    // Busca a exploração agrícola e preenche o formulário
    function buscarExploracao(){
        $.post('<?php echo base_url('cadProducaoAgricola/buscaRegistro') ?>',{
            id : $('#idProducao').val(),
            cpfcnpj : $('#cpfcnpj').val()
        }, function(data){
            $('#idProducao').val(data.idProducao);
            $('#municipio').val(data.municipio);
            $('#sistemaproducaoobtida').val(data.sistemaproducaoobtida);
            $('#sistemaproducaoprevista').val(data.sistemaproducaoprevista);
            $('#atividade').val(data.atividade);
            $('#atividade').change();
            $('#tipocultivo').val(data.tipocultivo);
            $('#irrigacao').prop('checked',data.irrigacao);

            $('#colheitaObtidaMes1').val(data.colheitaObtidaMes1);
            $('#colheitaObtidaAno1').val(data.colheitaObtidaAno1);
            $('#colheitaObtidaMes2').val(data.colheitaObtidaMes2);
            $('#colheitaObtidaAno2').val(data.colheitaObtidaAno2);
            $('#colheitaPrevistaMes1').val(data.colheitaPrevistaMes1);
            $('#colheitaPrevistaAno1').val(data.colheitaPrevistaAno1);
            $('#colheitaPrevistaMes2').val(data.colheitaPrevistaMes2);
            $('#colheitaPrevistaAno2').val(data.colheitaPrevistaAno2);
            $('#comercializacaoObtidaMes1').val(data.comercializacaoObtidaMes1);
            $('#comercializacaoObtidaAno1').val(data.comercializacaoObtidaAno1);
            $('#comercializacaoObtidaMes2').val(data.comercializacaoObtidaMes2);
            $('#comercializacaoObtidaAno2').val(data.comercializacaoObtidaAno2);
            $('#comercializacaoPrevistaMes1').val(data.comercializacaoPrevistaMes1);
            $('#comercializacaoPrevistaAno1').val(data.comercializacaoPrevistaAno1);
            $('#comercializacaoPrevistaMes2').val(data.comercializacaoPrevistaMes2);
            $('#comercializacaoPrevistaAno2').val(data.comercializacaoPrevistaAno2);
            $('#producaoObtidaMes1').val(data.producaoObtidaMes1);
            $('#producaoObtidaAno1').val(data.producaoObtidaAno1);
            $('#producaoObtidaMes2').val(data.producaoObtidaMes2);
            $('#producaoObtidaAno2').val(data.producaoObtidaAno2);
            $('#producaoPrevistaMes1').val(data.producaoPrevistaMes1);
            $('#producaoPrevistaAno1').val(data.producaoPrevistaAno1);
            $('#producaoPrevistaMes2').val(data.producaoPrevistaMes2);
            $('#producaoPrevistaAno2').val(data.producaoPrevistaAno2);

            $('#anosafrainicioobtida').val(data.anosafrainicioobtida);
            $('#anosafrafimobtida').val(data.anosafrafimobtida);
            $('#anosafrainicioprevista').val(data.anosafrainicioprevista);
            $('#anosafrafimprevista').val(data.anosafrafimprevista);
            $('#participacaoobtida').val(data.participacaoobtida);
            $('#participacaoprevista').val(data.participacaoprevista);
            $('#areaobtida').val(data.areaobtida);
            $('#areaprevista').val(data.areaprevista);
            $('#precounitarioobtida').val(data.precounitarioobtida);
            $('#precounitarioprevista').val(data.precounitarioprevista);
            $('#produtividadeprevistaobtida').val(data.produtividadeprevistaobtida);
            $('#produtividadeprevistaprevista').val(data.produtividadeprevistaprevista);
            $('#produtividadeobtidaobtida').val(data.produtividadeobtidaobtida);
            $('#frustracaosafraobtida').prop('checked',data.frustracaosafraobtida);
            $('#receitabrutaobtida').val(data.receitabrutaobtida);
            $('#receitabrutaprevista').val(data.receitabrutaprevista);
            $('#custoproducaohectareobtida').val(data.custoproducaohectareobtida);
            $('#custoproducaohectareprevista').val(data.custoproducaohectareprevista);
            $('#custoproducaototalobtida').val(data.custoproducaototalobtida);
            $('#custoproducaototalprevista').val(data.custoproducaototalprevista);
            $('#custototalcomarrendamentoobtida').val(data.custototalcomarrendamentoobtida);
            $('#custototalcomarrendamentoprevista').val(data.custototalcomarrendamentoprevista);
            $('#tratoresimplementosterceirosobtida').val(data.tratoresimplementosterceirosobtida);
            $('#tratoresimplementosterceirosprevista').val(data.tratoresimplementosterceirosprevista);
            $('#colheitadeirasterceirosobtida').val(data.colheitadeirasterceirosobtida);
            $('#colheitadeirasterceirosprevista').val(data.colheitadeirasterceirosprevista);
            $('#receitaunidadeproducaoobtida').val(data.receitaunidadeproducaoobtida);
            $('#receitaunidadeproducaoprevista').val(data.receitaunidadeproducaoprevista);
            $('#receitaliquidaobtida').val(data.receitaliquidaobtida);
            $('#receitaliquidaprevista').val(data.receitaliquidaprevista);

            // Habilita desabilita os botões
            (data.btnIncluir !== true) ? $('#btnIncluir').attr('disabled', 'disabled') : $('#btnIncluir').removeAttr('disabled');
            (data.btnAlterar !== true) ? $('#btnAlterar').attr('disabled', 'disabled') : $('#btnAlterar').removeAttr('disabled');
            (data.btnExcluir !== true) ? $('#btnExcluir').attr('disabled', 'disabled') : $('#btnExcluir').removeAttr('disabled');
            $(':checkbox').change();
            $('.input-areaexplorada').val('');

            // Pega o Json
            if(data.areaImoveisExplorados){
                var objJsonAreaImoveisExplorados = $.parseJSON(data.areaImoveisExplorados);
                // Percorre cada "nó" atribuindo aos campos
                $.each(objJsonAreaImoveisExplorados, function(i, node){
                    var idObtida = node.imovel + 'obtida';
                    var idPrevista = node.imovel + 'prevista';
                    $('#' + idObtida).val(node.areaexploradaobtida);
                    $('#' + idPrevista).val(node.areaexploradaprevista);
                });
            }
        },'json');
    };

    // Grid com os imóveis usados na exploração
    var $dgExploracao = $('#gridExploracao');
    function gridExploracaoLoad(){
        $dgExploracao.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadProducaoAgricola/dadosProcuraProducaoAgricola?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height: 180,
            mapper:
            [
                {name: 'id', hidden: 'hidden'},
                {name: 'atividade', hidden: 'hidden'},
                {name: 'atividadeDesc', title: 'Atividade', width: '260px', align: 'left'},            
                {name: 'tipocultivo', hidden: 'hidden'},
                {name: 'tipocultivoDesc', title: 'Tipo Cultivo', width: '185px', align: 'left'},
                {name: 'safraObtida', title: 'Safra Obtida', width: '100px', align: 'left'},
                {name: 'safraPrevista', title: 'Safra Prevista', width: '100px', align: 'left'}
            ],
            eventController: {
                onClickRow: function(tr){
                    $('#procuraExploracao').dialog('close');
                    $('#idProducao').val(tr.cells[0].innerHTML);
                    buscarExploracao();
                }
            }
        });
    };
    
    // Botão de Procura de Agência
    $('#btnProcExploracao').click(function(event){
        event.preventDefault();
        gridExploracaoLoad();
        $('#procuraExploracao').dialog('open');
    });
    
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnIncluir').attr('disabled', 'disabled');
        $('#btnAlterar').attr('disabled', 'disabled');
        $('#btnExcluir').attr('disabled', 'disabled');
    };
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){
        // Valida os Períodos
        if(!validaPeriodo($('#colheitaObtidaMes1').val(),$('#colheitaObtidaAno1').val(),$('#colheitaObtidaMes2').val(),$('#colheitaObtidaAno2').val())){
            $('#msgAlerta').html('Época de Colheita (Obtida) Inválida, verifique.');
            $('#alertMessage').dialog('open');
            return false;
        }
        if(!validaPeriodo($('#colheitaPrevistaMes1').val(),$('#colheitaPrevistaAno1').val(),$('#colheitaPrevistaMes2').val(),$('#colheitaPrevistaAno2').val())){
            $('#msgAlerta').html('Época de Colheita (Prevista) Inválida, verifique.');
            $('#alertMessage').dialog('open');
            return false;
        }
        if(!validaPeriodo($('#comercializacaoObtidaMes1').val(),$('#comercializacaoObtidaAno1').val(),$('#comercializacaoObtidaMes2').val(),$('#comercializacaoObtidaAno2').val())){
            $('#msgAlerta').html('Época de Comercialização (Obtida) Inválida, verifique.');
            $('#alertMessage').dialog('open');
            return false;
        }
        if(!validaPeriodo($('#comercializacaoPrevistaMes1').val(),$('#comercializacaoPrevistaAno1').val(),$('#comercializacaoPrevistaMes2').val(),$('#comercializacaoPrevistaAno2').val())){
            $('#msgAlerta').html('Época de Comercialização (Prevista) Inválida, verifique.');
            $('#alertMessage').dialog('open');
            return false;
        }
        if(!validaPeriodo($('#producaoObtidaMes1').val(),$('#producaoObtidaAno1').val(),$('#producaoObtidaMes2').val(),$('#producaoObtidaAno2').val())){
            $('#msgAlerta').html('Época de Produção (Obtida) Inválida, verifique.');
            $('#alertMessage').dialog('open');
            return false;
        }
        if(!validaPeriodo($('#producaoPrevistaMes1').val(),$('#producaoPrevistaAno1').val(),$('#producaoPrevistaMes2').val(),$('#producaoPrevistaAno2').val())){
            $('#msgAlerta').html('Época de Produção (Prevista) Inválida, verifique.');
            $('#alertMessage').dialog('open');
            return false;
        }
        // Verifica item a item do formulário           if(!$('#nome').val() || !$('#id').val()){
        if(!validarCamposDiv('#divAccordionExploracao')){
            $('#msgAlerta').html('Campos obrigatórios não preenchidos.');
            $('#alertMessage').dialog('open');
            return false; 
        }
    };
    
    // Muda o Placeholder e a Máscara de acordo com a opção selecionada
    $('input[type=radio][name=rdTipoCliente]').change(function(){
        $('#cpfcnpj').val('');
        if($('#rdCPF').is(':checked')){
            $('#cpfcnpj').mask('999.999.999-99');
            $('#cpfcnpj').focus();
            $('#cpfcnpj').attr('placeholder','CPF Cliente');
        }else{
            $('#cpfcnpj').mask('99.999.999/9999-99');
            $('#cpfcnpj').focus();
            $('#cpfcnpj').attr('placeholder','CNPJ Cliente');
        }
        desabilitaBotoes();
    });
    
    // Altera tamanho do acordion
    var hidden = false;
    $('#accordionImoveis').click(function(){
        if(!hidden){
            $('#divAccordionExploracao').css('height','390px');
        }else{
            $('#divAccordionExploracao').css('height','285px');
        }
        hidden = !hidden;
    });

    $('#atividade').change(function(){
        $('#unidadeprodutividade').val($('#atividade').val());
    });
   
   $(':checkbox').change(function(){
        if($(this).prop('checked'))
            $(this).next('span').text('SIM');
        else $(this).next('span').text('NÃO');
    });
    
    // Função que percorre o grid de imóveis para atualizar a exploração
    function getDadosImoveisExplorados(){
        var rows = $dgRurais.datagrid('getRows');
        var txtReg = '[';
        for(i=0;i<rows.length;i++){
            // Recupera o ID do checkbox
            var checkID = '#'+ rows[i].cells[1].innerHTML.substring(11,15);
            $(checkID).prop('checked');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'id': rows[i].cells[0].innerHTML,
                            'explorado': ($(checkID).prop('checked')) ? 1 : 0
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosImoveisExploradosAgricola').val(txtReg);
    };

    // Função responsável pelo carregamento do grid
    var idCheckBox = 0;
    var alertaImoveis = true;
    var $dgRurais = $('#gridImoveisExplorados');
    function gridRuraisLoad(){
        $dgRurais.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadCliente/dadosGridRurais?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height: 60,
            mapper:
            [
                {name: 'id', hidden: 'hidden'},
                {name: 'exploradoagricola',title:'Explorado',width:'80px',align:'center',render: function(v) { var t = v = (!!parseInt(v)) ? 'checked=\'checked\'' : '' ; return '<input id=\'chk' + idCheckBox++ + '\' type=\'checkbox\''  +t+ ' />'; } },
                {name: 'nome', title: 'Nome', width: '250px', align: 'left'},            
                {name: 'matricula', title: 'Matrícula', width: '70px', align: 'left'},
                {name: 'registro', title: 'Cart. Registro', width: '100px', align: 'left'},
                {name: 'uf', hidden: 'hidden'},
                {name: 'municipio', hidden: 'hidden'},
                {name: 'municipioDesc', title: 'Município', width: '350px', align: 'left'},
                {name: 'areatotal', title: 'Área Total', width: '50px', align: 'center'}
            ],
            eventController: {
                onClickRow: function(tr){
                    if(alertaImoveis){
                        $('#msgAlerta').html('Certifique-se de marcar como "Explorado" todos imóveis utilizados na exploração e evite desmarcar após já ter cadastrado informações de Exploração agrícola no Imóvel.');
                        $('#alertMessage').dialog('open');  
                        alertaImoveis = false;
                    }
                    // Limpa e carrega o formulário da exploração agricola
                    $('#idProducao').val('');
                    buscarExploracao();
                    loadForm();
                }
            },
            onAjaxSuccess: function(){
                loadForm();    
            }
        });
    };
    gridRuraisLoad();
   
    // Função responsável por carregar as informações p/ preenchimento dos forms
    var countExplorados = 0;
    function loadForm(){ 
        // Pega as linhas do grid
        var rows = $dgRurais.datagrid('getRows');
        // Remove os imóveis explorados e limpa os campos
        $('#imoveisExplorados').html('');
        // Remove todas as opções exceto a primeira que é vazia
        $('#municipio').find('option:gt(0)').remove();
        countExplorados = 0;
        var idMunicipio, descMunicipio = '';
        for(i=0;i<rows.length;i++){
            // Pega o ID e descrição do municipio
            idMunicipio = rows[i].cells[6].innerHTML;
            descMunicipio = rows[i].cells[7].innerHTML;
            // Recupera o ID do checkbox
            var checkID = '#'+ rows[i].cells[1].innerHTML.substring(11,15);
            // Se estiver checado
            if($(checkID).prop('checked')){
                // Remove a opção para não repetir municipios
                $('#municipio option[value=\''+idMunicipio+'\']').remove();
                // Adiciona municipio ao combobox
                $('#municipio').append($('<option>', {value: idMunicipio, text: descMunicipio}));        
                $('#municipio').val(idMunicipio);
                
                // Adiciona as Linhas para preenchimento Tabela Imóveis Explorados
                var idObtida = rows[i].cells[0].innerHTML + 'obtida';
                var idPrevista = rows[i].cells[0].innerHTML + 'prevista';
                var colunaID = '<td style=\'display:none\' class=\'colunaID\'>' +  rows[i].cells[0].innerHTML + '</td>';
                var colunaObtida = '<td style=\'padding: 3px;text-align: center;\'><input class=\'input-cell-content input-areaexplorada\' id=\''+ idObtida +  '\' style=\'width: 100%\' type=\'text\' placeholder=\'100,00\'/></td>';
                var colunaPrevista = '<td style=\'padding: 3px;text-align: center;\'><input class=\'input-cell-content input-areaexplorada\' id=\''+ idPrevista +  '\' style=\'width: 100%\' type=\'text\' placeholder=\'100,00\'/></td>';
                var linhaImovel = '<tr style=\'height:15px\'>' + colunaID + '<td>'+ rows[i].cells[2].innerHTML +'</td>' + colunaObtida + colunaPrevista + '</tr>';
                $('#imoveisExplorados').append(linhaImovel);
                
                // Formatação em decimais
                $('#'+idObtida + ',#'+idPrevista).blur(function(){
                    if($(this).val() !== '')
                        $(this).val(blurNumeric($(this).val().split('.').join('')));
                    else $(this).val('0,00');
                });
                $('#'+idObtida + ',#'+idPrevista).bind('keydown',onlyNumbersAndComma);
                
                // Inicializa como zerado
                $('#'+idObtida + ',#'+idPrevista).val('0,00');
                
                countExplorados++;
            }
            // Controle de Permissão dos botões
            if(countExplorados > 0){
                $('#btnIncluir').removeAttr('disabled');
                $('#btnAlterar').attr('disabled', 'disabled');
                $('#btnExcluir').attr('disabled', 'disabled');
            }else{
                $('#btnIncluir').attr('disabled', 'disabled');
                $('#btnAlterar').removeAttr('disabled');
                $('#btnExcluir').removeAttr('disabled');
            }
        }
    };
    
    // Pega os dados da Area Explorada em cada Imóvel
    function getExploracaoImoveis(){
        var dados,i;
        var txtReg = '[';
        dados = $('.colunaID')
                .closest('tr')
                .map(function(){
                        if(($(this).find('input:eq(0)').val() !== '') || ($(this).find('input:eq(1)').val() !== ''))
                        return JSON.stringify({
                            'imovel' : $(this).find('td').html(),
                            'areaexploradaobtida': $(this).find('input:eq(0)').val(),
                            'areaexploradaprevista': $(this).find('input:eq(1)').val()
                            });
                }).toArray();
        for(i = 0; i<dados.length;i++){
            txtReg += dados[i] +',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosAreaExploradaImoveis').val(txtReg);       
    };

    // Ação dos Botões
    $('#btnIncluir').click(function(){
        getDadosImoveisExplorados();
        getExploracaoImoveis();
        $('#frmCadProducaoAgricola').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadProducaoAgricola/incluir') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmCadProducaoAgricola').submit();
    });
    
    $('#btnAlterar').click(function(){
        getDadosImoveisExplorados();
        getExploracaoImoveis();
        $('#frmCadProducaoAgricola').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadProducaoAgricola/alterar') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmCadProducaoAgricola').submit();
    });
    
    $('#btnExcluir').click(function(){
        $('#frmCadProducaoAgricola').ajaxForm({
            clearForm: true,
            success:  showResponse,
            url: '<?php echo base_url('CadProducaoAgricola/excluir') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmCadProducaoAgricola').submit();
    });

    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnLimpar').click(function(){
        // Remove todas as opções exceto a primeira que é vazia
        $('#municipio').find('option:gt(0)').remove();
        limparForm();
    });
    
    function limparForm(){
        $('#frmCadProducaoAgricola').resetForm();
        desabilitaBotoes();
        gridRuraisLoad();
    };
    
    var cpfcnpjAnterior = '';
    function cpfcnpjBlur(){
        if(cpfcnpjAnterior !== $('#cpfcnpj').val().replace(/[^\d]+/g,'') && !($('#rdCNPJ').is(':checked') && $('#cpfcnpj').val().replace(/[^\d]+/g,'').length < 14) ){           
            if(validarCPFCNPJ($('#cpfcnpj').val())){
                $.post('<?php echo base_url('ImpProjetoCliente/buscaRegistro') ?>',{
                    cpfcnpj : $('#cpfcnpj').val()
                }, function(data){
                    if(data.msg == ''){
                        $('#nome').val(data.nome);
                        gridRuraisLoad();
                    }else{
                        $('#msgAlerta').html(data.msg);
                        $('#alertMessage').dialog('open');
                        limparForm();
                    }
                },'json');
            }else{
                $('#msgAlerta').html('CPF ou CNPJ Inválido');
                $('#alertMessage').dialog('open');
                limparForm();
            }
        }
        cpfcnpjAnterior = $('#cpfcnpj').val().replace(/[^\d]+/g,'');
    };
    
    // Atribui com o replace para remover a máscara
    function cpfcnpjFocus(){
        cpfcnpjAnterior = $('#cpfcnpj').val().replace(/[^\d]+/g,'');
    };
    $('#cpfcnpj').blur(cpfcnpjBlur);
    $('#cpfcnpj').focus(cpfcnpjFocus);
    
    // receitabrutaobtida = aereaobtida * precounitarioobtida * produtividadeobtidaobtida
    function calcularReceitaBrutaObtida(){
        var areaobtida = $('#areaobtida').val().split('.').join('');
        areaobtida = areaobtida.replace(',','.');
        areaobtida = (!areaobtida) ? 0 : areaobtida;
        var precounitarioobtida = $('#precounitarioobtida').val().split('.').join('');
        precounitarioobtida = precounitarioobtida.replace(',','.');
        precounitarioobtida = (!precounitarioobtida) ? 0 : precounitarioobtida;
        var produtividadeobtidaobtida = $('#produtividadeobtidaobtida').val().split('.').join('');
        produtividadeobtidaobtida = produtividadeobtidaobtida.replace(',','.');
        produtividadeobtidaobtida = (!produtividadeobtidaobtida) ? 0 : produtividadeobtidaobtida;
        
        var total = parseFloat(areaobtida) * parseFloat(precounitarioobtida) * parseFloat(produtividadeobtidaobtida);
        $('#receitabrutaobtida').val(total.toString().replace('.',','));
        $('#receitabrutaobtida').blur();
    };
    $('#areaobtida').keydown(calcularReceitaBrutaObtida);
    $('#precounitarioobtida').keydown(calcularReceitaBrutaObtida);
    $('#produtividadeobtidaobtida').keydown(calcularReceitaBrutaObtida);
    
    // receitabrutaprevista = aereaprevista * precounitarioprevista * produtividadeprevistaprevista
    function calcularReceitaBrutaPrevista(){
        var areaprevista = $('#areaprevista').val().split('.').join('');
        areaprevista = areaprevista.replace(',','.');
        areaprevista = (!areaprevista) ? 0 : areaprevista;
        var precounitarioprevista = $('#precounitarioprevista').val().split('.').join('');
        precounitarioprevista = precounitarioprevista.replace(',','.');
        precounitarioprevista = (!precounitarioprevista) ? 0 : precounitarioprevista;
        var produtividadeprevistaprevista = $('#produtividadeprevistaprevista').val().split('.').join('');
        produtividadeprevistaprevista = produtividadeprevistaprevista.replace(',','.');
        produtividadeprevistaprevista = (!produtividadeprevistaprevista) ? 0 : produtividadeprevistaprevista;
        
        var total = parseFloat(areaprevista) * parseFloat(precounitarioprevista) * parseFloat(produtividadeprevistaprevista);
        $('#receitabrutaprevista').val(total.toString().replace('.',','));
        $('#receitabrutaprevista').blur();
    };
    $('#areaprevista').keydown(calcularReceitaBrutaPrevista);
    $('#precounitarioprevista').keydown(calcularReceitaBrutaPrevista);
    $('#produtividadeprevistaprevista').keydown(calcularReceitaBrutaPrevista);
    
    // custoproducaototalobtida = areaobtida * custoproducaohectareobtida
    function calcularCustoDeProducaoTotalObtida(){
        var areaobtida = $('#areaobtida').val().split('.').join('');
        areaobtida = areaobtida.replace(',','.');
        areaobtida = (!areaobtida) ? 0 : areaobtida;
        var custoproducaohectareobtida = $('#custoproducaohectareobtida').val().split('.').join('');
        custoproducaohectareobtida = custoproducaohectareobtida.replace(',','.');
        custoproducaohectareobtida = (!custoproducaohectareobtida) ? 0 : custoproducaohectareobtida;

        var total = parseFloat(areaobtida) * parseFloat(custoproducaohectareobtida);
        $('#custoproducaototalobtida').val(total.toString().replace('.',','));
        $('#custoproducaototalobtida').blur();
    };
    $('#custoproducaohectareobtida').keydown(calcularCustoDeProducaoTotalObtida);
     
    // custoproducaototalprevista = areaprevista * custoproducaohectareprevista
    function calcularCustoDeProducaoTotalPrevista(){
        var areaprevista = $('#areaprevista').val().split('.').join('');
        areaprevista = areaprevista.replace(',','.');
        areaprevista = (!areaprevista) ? 0 : areaprevista;
        var custoproducaohectareprevista = $('#custoproducaohectareprevista').val().split('.').join('');
        custoproducaohectareprevista = custoproducaohectareprevista.replace(',','.');
        custoproducaohectareprevista = (!custoproducaohectareprevista) ? 0 : custoproducaohectareprevista;

        var total = parseFloat(areaprevista) * parseFloat(custoproducaohectareprevista);
        $('#custoproducaototalprevista').val(total.toString().replace('.',','));
        $('#custoproducaototalprevista').blur();
    };
    $('#custoproducaohectareprevista').keydown(calcularCustoDeProducaoTotalPrevista);
    
    // receitaunidadeproducaoobtida = receitabrutaobtida/areaobtida
    function calcularReceitaPorUnidadeDeProducaoObtida(){
        var areaobtida = $('#areaobtida').val().split('.').join('');
        areaobtida = areaobtida.replace(',','.');
        areaobtida = (!areaobtida) ? 0 : areaobtida;
        var receitabrutaobtida = $('#receitabrutaobtida').val().split('.').join('');
        receitabrutaobtida = receitabrutaobtida.replace(',','.');
        receitabrutaobtida = (!receitabrutaobtida) ? 0 : receitabrutaobtida;

        var total = parseFloat(receitabrutaobtida) / parseFloat(areaobtida);
        $('#receitaunidadeproducaoobtida').val(total.toString().replace('.',','));
        $('#receitaunidadeproducaoobtida').blur();
    };
    $('#receitabrutaobtida').blur(calcularReceitaPorUnidadeDeProducaoObtida);
    
    // receitaunidadeproducaoprevista = receitabrutaprevista/areaprevista
    function calcularReceitaPorUnidadeDeProducaoPrevista(){
        var areaprevista = $('#areaprevista').val().split('.').join('');
        areaprevista = areaprevista.replace(',','.');
        areaprevista = (!areaprevista) ? 0 : areaprevista;
        var receitabrutaprevista = $('#receitabrutaprevista').val().split('.').join('');
        receitabrutaprevista = receitabrutaprevista.replace(',','.');
        receitabrutaprevista = (!receitabrutaprevista) ? 0 : receitabrutaprevista;

        var total = parseFloat(receitabrutaprevista) / parseFloat(areaprevista);
        $('#receitaunidadeproducaoprevista').val(total.toString().replace('.',','));
        $('#receitaunidadeproducaoprevista').blur();
    };
    $('#receitabrutaprevista').blur(calcularReceitaPorUnidadeDeProducaoPrevista);
    
    // receitaliquidaobtida = receitabrutaobtida - custoproducaototalobtida - custototalcomarrendamentoobtida
    function calcularReceitaLiquidaObtida(){
        var receitabrutaobtida = $('#receitabrutaobtida').val().split('.').join('');
        receitabrutaobtida = receitabrutaobtida.replace(',','.');
        receitabrutaobtida = (!receitabrutaobtida) ? 0 : receitabrutaobtida;
        var custoproducaototalobtida = $('#custoproducaototalobtida').val().split('.').join('');
        custoproducaototalobtida = custoproducaototalobtida.replace(',','.');
        custoproducaototalobtida = (!custoproducaototalobtida) ? 0 : custoproducaototalobtida;
        var custototalcomarrendamentoobtida= $('#custototalcomarrendamentoobtida').val().split('.').join('');
        custototalcomarrendamentoobtida = custototalcomarrendamentoobtida.replace(',','.');
        custototalcomarrendamentoobtida = (!custototalcomarrendamentoobtida) ? 0 : custototalcomarrendamentoobtida;
        
        var total = parseFloat(receitabrutaobtida) - parseFloat(custoproducaototalobtida) - parseFloat(custototalcomarrendamentoobtida);
        $('#receitaliquidaobtida').val(total.toString().replace('.',','));
        $('#receitaliquidaobtida').blur();
    };
    $('#custototalcomarrendamentoobtida').keydown(calcularReceitaLiquidaObtida);
    
    // receitaliquidaprevista = receitabrutaprevista - custoproducaototalprevista - custototalcomarrendamentoprevista
    function calcularReceitaLiquidaPrevista(){
        var receitabrutaprevista = $('#receitabrutaprevista').val().split('.').join('');
        receitabrutaprevista = receitabrutaprevista.replace(',','.');
        receitabrutaprevista = (!receitabrutaprevista) ? 0 : receitabrutaprevista;
        var custoproducaototalprevista = $('#custoproducaototalprevista').val().split('.').join('');
        custoproducaototalprevista = custoproducaototalprevista.replace(',','.');
        custoproducaototalprevista = (!custoproducaototalprevista) ? 0 : custoproducaototalprevista;
        var custototalcomarrendamentoprevista= $('#custototalcomarrendamentoprevista').val().split('.').join('');
        custototalcomarrendamentoprevista = custototalcomarrendamentoprevista.replace(',','.');
        custototalcomarrendamentoprevista = (!custototalcomarrendamentoprevista) ? 0 : custototalcomarrendamentoprevista;
        
        var total = parseFloat(receitabrutaprevista) - parseFloat(custoproducaototalprevista) - parseFloat(custototalcomarrendamentoprevista);
        $('#receitaliquidaprevista').val(total.toString().replace('.',','));
        $('#receitaliquidaprevista').blur();
    };
    $('#custototalcomarrendamentoprevista').keydown(calcularReceitaLiquidaPrevista);    
});
</script>
