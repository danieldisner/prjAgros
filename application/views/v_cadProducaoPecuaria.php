<div id='janelaPrincipal' title='Cadastro de Produção Pecuária' style='display: none;'>
    <div class='form-dialog-ui' style='height: 100%'>
        <form id='frmCadProducaoPecuaria' method='post'>
            <input type='hidden' id='dadosImoveisExploradosPecuaria' name='dadosImoveisExploradosPecuaria'/>
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
                        <h3 id='accordionExploracao'><strong>Explorações Pecuárias</strong></h3>
                        <div id='divAccordionExploracao' class='groupAccordion' style='height: 285px'>
                            <button id='btnProcExploracao' name='btnProcExploracao' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span><strong> Procura de Exploração Pecuária</strong></button>
                            <table class='table table-responsive table-bordered table-exploracao'>
                                <thead>
                                    <tr>                              
                                        <th class='table-header' style='width:30%'>Explorações Pecuárias Obtidas/Previstas</th>
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
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo $atividade['nome']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Atividade Código</th>
                                        <td colspan='2' style='padding: 3px'>
                                            <select style='width:100%;background-color: #ddd;' class='input-cell-content select-no-style' id='atividadecodigo' name='atividadecodigo' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo $atividade['atividade']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Sistema de Produção</td>
                                        <td style='padding: 3px'><input style='width:100%' class='input-cell-content onlynumbers' type='text' id='sistemaproducaoobtida' name='sistemaproducaoobtida' placeholder='Nr. Planilha RTA'/></td>
                                        <td style='padding: 3px'><input style='width:100%' class='input-cell-content onlynumbers' type='text' id='sistemaproducaoprevista' name='sistemaproducaoprevista' placeholder='Nr. Planilha RTA'/></td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Fase Exploração</td>
                                        <td colspan='2' style='padding: 3px'>
                                            <select style='width:100%;background-color: #ddd;' class='input-cell-content select-no-style' id='faseexploracao' name='faseexploracao' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo $atividade['faseexploracao']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Informar a produtividade em:</td>
                                        <td colspan='2' style='padding: 3px;text-align: center;'>
                                            <select style='width:100%;background-color: #ddd;' class='input-cell-content select-no-style' id='unidadeprodutividade' name='unidadeprodutividade' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo $atividade['unidadeprodutividade']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Produtividade</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='produtividadeobtida' id='produtividadeobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='produtividadeprevista' id='produtividadeprevista' placeholder='100,00'/>    
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
                                        <th class='table-sub-header'>Participação (%)</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='participacaoobtida' id='participacaoobtida' maxlength='3' placeholder='100%'/>    
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content onlynumbers' style='width: 100%' type='text' name='participacaoprevista' id='participacaoprevista' maxlength='3' placeholder='100%'/>     
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>
                                            <select style='width:100%;height: 100%;font-size: 13px' class='select-table-header' id='quantidadeth' name='quantidadeth' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'>Quantidade de <?php echo $atividade['unidadefinanciamento']?> (s)</option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='quantidadeobtida' id='quantidadeobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='quantidadeprevista' id='quantidadeprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header' colspan='3'>
                                            <select style='width:100%;height: 100%;' class='input-cell-content select-table-header' id='obs1' name='obs1' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo $atividade['obs1']?></option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Quantidade de Ciclos por Ano:</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='quantidadeciclosanoobtida' id='quantidadeciclosanoobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='quantidadeciclosanoprevista' id='quantidadeciclosanoprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>
                                            <select style='width:100%;height: 100%;font-size: 13px' class='select-table-header' id='precoth' name='precoth' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'>Preço obt. ou prev/<?php echo $atividade['unidadeproducao']?> de <?php echo $atividade['produtoprincipal']?> (R$)</option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal4' style='width: 100%' type='text' name='precoobtida' id='precoobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal4' style='width: 100%' type='text' name='precoprevista' id='precoprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>
                                            <select style='width:100%;height: 100%;font-size: 13px' class='select-table-header' id='producaototalth' name='producaototalth' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'>Produção total(<?php echo $atividade['unidadeproducao']?> de <?php echo $atividade['produtoprincipal']?>/ANO)</option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='producaototalobtida' id='producaototalobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='producaototalprevista' id='producaototalprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header' colspan='3'>
                                            <select style='width:100%;height: 100%;' class='input-cell-content select-table-header' id='obs2' name='obs2' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo $atividade['obs2']?></option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Produção por Unidade de Financiamento</th>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='producaounidadefinanciamentoobtida' id='producaounidadefinanciamentoobtida' readonly='readonly' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='producaounidadefinanciamentoprevista' id='producaounidadefinanciamentoprevista' readonly='readonly' placeholder='100,00'/>    
                                        </td> 
                                    </tr>                                    
                                    <tr>
                                        <th class='table-sub-header'>
                                            <select style='width:100%;height: 100%;font-size: 13px' class='select-table-header' id='producaounidadeth' name='producaounidadeth' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'>Custo de Produção/<?php echo $atividade['unidadefinanciamento']?> (R$/Ciclo)</option>
                                                <?php } ?>
                                            </select>
                                        </th>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaounidadeobtida' id='custoproducaounidadeobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaounidadeprevista' id='custoproducaounidadeprevista' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Custo de Produção Total (R$/Ciclo)</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaoobtida' id='custoproducaoobtida' readonly='readonly' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custoproducaoprevista' id='custoproducaoprevista' readonly='readonly' placeholder='100,00'/>    
                                        </td> 
                                    </tr>    
                                    <tr>
                                        <td class='table-sub-header'>
                                            <select style='width:100%;height: 100%;font-size: 11px' class='select-table-header' id='receitacomvendath' name='receitacomvendath' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'>Receita com venda de <?php echo $atividade['produtoprincipal']?> (Obt. ou prev./ANO)(R$)</option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitacomvendaobtida' id='receitacomvendaobtida' readonly='readonly' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitacomvendaprevista' id='receitacomvendaprevista' readonly='readonly' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>                              
                                        <th class='table-header text-center' colspan='3'>Receitas com Produtos Secundários (R$/ANO)</td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header' style='width: 30%'>
                                            <select style='width:100%;height: 100%;font-size: 10px' class='select-table-header' id='produto2th' name='produto2th' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo !empty($atividade['produto2']) ? 'Venda de ' . $atividade['produto2'] : ''; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto2obtida' id='vendasproduto2obtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto2prevista' id='vendasproduto2prevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header' style='width: 30%'>
                                            <select style='width:100%;height: 100%;font-size: 10px' class='select-table-header' id='produto3th' name='produto3th' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo !empty($atividade['produto3']) ? 'Venda de ' . $atividade['produto3'] : ''; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto3obtida' id='vendasproduto3obtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto3prevista' id='vendasproduto3prevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header' style='width: 30%'>
                                            <select style='width:100%;height: 100%;font-size: 10px' class='select-table-header' id='produto4th' name='produto4th' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo !empty($atividade['produto4']) ? 'Venda de ' . $atividade['produto4'] : ''; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto4obtida' id='vendasproduto4obtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto4prevista' id='vendasproduto4prevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header' style='width: 30%'>
                                            <select style='width:100%;height: 100%;font-size: 10px' class='select-table-header' id='produto5th' name='produto5th' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo !empty($atividade['produto5']) ? 'Venda de ' . $atividade['produto5'] : ''; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto5obtida' id='vendasproduto5obtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto5prevista' id='vendasproduto5prevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header' style='width: 30%'>
                                            <select style='width:100%;height: 100%;font-size: 10px' class='select-table-header' id='produto6th' name='produto6th' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo !empty($atividade['produto6']) ? 'Venda de ' . $atividade['produto6'] : ''; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto6obtida' id='vendasproduto6obtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto6prevista' id='vendasproduto6prevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header' style='width: 30%'>
                                            <select style='width:100%;height: 100%;font-size: 10px' class='select-table-header' id='produto7th' name='produto7th' disabled='disabled'>
                                                <?php foreach($atividadesPecuaria as $atividade){ ?>
                                                    <option value='<?php echo $atividade['id']?>'><?php echo !empty($atividade['produto7']) ? 'Venda de ' . $atividade['produto7'] : ''; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>                                        
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto7obtida' id='vendasproduto7obtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='vendasproduto7prevista' id='vendasproduto7prevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>                              
                                        <th class='table-header text-center' colspan='3'></td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Receita Total (Obtida ou prevista/ano):</td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitatotalobtida' id='receitatotalobtida' readonly='readonly' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitatotalprevista' id='receitatotalprevista' readonly='readonly' placeholder='100,00'/>    
                                        </td> 
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Receita TOTAL Por unidade de Financiamento</th>                                 
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitatotalunidadefinanciamentoobtida' id='receitatotalunidadefinanciamentoobtida' readonly='readonly' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitatotalunidadefinanciamentoprevista' id='receitatotalunidadefinanciamentoprevista' readonly='readonly' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class='table-sub-header'>Custo total c/ arrendamento(R$/ano)</th>                                 
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custototalcomarrendamentoobtida' id='custototalcomarrendamentoobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='custototalcomarrendamentoprevista' id='custototalcomarrendamentoprevista' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>Receita Líquida / ano (R$)</td>                                 
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitaliquidaanoobtida' id='receitaliquidaanoobtida' readonly='readonly' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='receitaliquidaanoprevista' id='receitaliquidaanoprevista' readonly='readonly' placeholder='100,00'/>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='table-sub-header'>% tratores/implementos de terceiros:</td>                                 
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='tratoresimplementosterceirosobtida' id='tratoresimplementosterceirosobtida' placeholder='100,00'/>  
                                        </td>
                                        <td style='padding: 3px;text-align: center;'>
                                            <input class='input-cell-content decimal' style='width: 100%' type='text' name='tratoresimplementosterceirosprevista' id='tratoresimplementosterceirosprevista' placeholder='100,00'/>    
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
<div id='procuraExploracao' title='Procura Exploração Pecuária' style='display: none'>
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
        width: '52%',
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
    
    // Busca a exploração Pecuária e preenche o formulário
    function buscarExploracao(){
        $.post('<?php echo base_url('cadProducaoPecuaria/buscaRegistro') ?>',{
            id : $('#idProducao').val(),
            cpfcnpj : $('#cpfcnpj').val()
        }, function(data){
            $('#idProducao').val(data.idProducao);
            $('#municipio').val(data.municipio);
            $('#sistemaproducaoobtida').val(data.sistemaproducaoobtida);
            $('#sistemaproducaoprevista').val(data.sistemaproducaoprevista);
            $('#atividade').val(data.atividade);
            $('#atividade').change();
            $('#produtividadeobtida').val(data.produtividadeobtida);
            $('#produtividadeprevista').val(data.produtividadeprevista);

            $('#producaoObtidaMes1').val(data.producaoObtidaMes1);
            $('#producaoObtidaAno1').val(data.producaoObtidaAno1);
            $('#producaoObtidaMes2').val(data.producaoObtidaMes2);
            $('#producaoObtidaAno2').val(data.producaoObtidaAno2);
            $('#producaoPrevistaMes1').val(data.producaoPrevistaMes1);
            $('#producaoPrevistaAno1').val(data.producaoPrevistaAno1);
            $('#producaoPrevistaMes2').val(data.producaoPrevistaMes2);
            $('#producaoPrevistaAno2').val(data.producaoPrevistaAno2);

            $('#participacaoobtida').val(data.participacaoobtida);
            $('#participacaoprevista').val(data.participacaoprevista);
            $('#quantidadeobtida').val(data.quantidadeobtida);
            $('#quantidadeprevista').val(data.quantidadeprevista);
            $('#quantidadeciclosanoobtida').val(data.quantidadeciclosanoobtida);
            $('#quantidadeciclosanoprevista').val(data.quantidadeciclosanoprevista);
            $('#precoobtida').val(data.precoobtida);
            $('#precoprevista').val(data.precoprevista);
            $('#producaototalobtida').val(data.producaototalobtida);
            $('#producaototalprevista').val(data.producaototalprevista);
            $('#producaounidadefinanciamentoobtida').val(data.producaounidadefinanciamentoobtida);
            $('#producaounidadefinanciamentoprevista').val(data.producaounidadefinanciamentoprevista);
            $('#custoproducaoobtida').val(data.custoproducaoobtida);
            $('#custoproducaoprevista').val(data.custoproducaoprevista);
            $('#custoproducaounidadeobtida').val(data.custoproducaounidadeobtida);
            $('#custoproducaounidadeprevista').val(data.custoproducaounidadeprevista);
            $('#receitacomvendaobtida').val(data.receitacomvendaobtida);
            $('#receitacomvendaprevista').val(data.receitacomvendaprevista);
            $('#receitatotalobtida').val(data.receitatotalobtida);
            $('#receitatotalprevista').val(data.receitatotalprevista);
            $('#receitatotalunidadefinanciamentoobtida').val(data.receitatotalunidadefinanciamentoobtida);
            $('#receitatotalunidadefinanciamentoprevista').val(data.receitatotalunidadefinanciamentoprevista);
            $('#custototalcomarrendamentoobtida').val(data.custototalcomarrendamentoobtida);
            $('#custototalcomarrendamentoprevista').val(data.custototalcomarrendamentoprevista);
            $('#receitaliquidaanoobtida').val(data.receitaliquidaanoobtida);
            $('#receitaliquidaanoprevista').val(data.receitaliquidaanoprevista);
            $('#tratoresimplementosterceirosobtida').val(data.tratoresimplementosterceirosobtida);
            $('#tratoresimplementosterceirosprevista').val(data.tratoresimplementosterceirosprevista);
            
            // Limpa os produtos secundários
            $('#vendasproduto2obtida').val('');
            $('#vendasproduto2prevista').val('');
            $('#vendasproduto3obtida').val('');
            $('#vendasproduto3prevista').val('');
            $('#vendasproduto4obtida').val('');
            $('#vendasproduto4prevista').val('');
            $('#vendasproduto5obtida').val('');
            $('#vendasproduto5prevista').val('');
            $('#vendasproduto6obtida').val('');
            $('#vendasproduto6prevista').val('');
            $('#vendasproduto7obtida').val('');
            $('#vendasproduto7prevista').val(''); 

            // Habilita desabilita os botões
            (data.btnIncluir !== true) ? $('#btnIncluir').attr('disabled', 'disabled') : $('#btnIncluir').removeAttr('disabled');
            (data.btnAlterar !== true) ? $('#btnAlterar').attr('disabled', 'disabled') : $('#btnAlterar').removeAttr('disabled');
            (data.btnExcluir !== true) ? $('#btnExcluir').attr('disabled', 'disabled') : $('#btnExcluir').removeAttr('disabled');
            $(':checkbox').change();
            $('.input-areaexplorada').val('');
            
            // Pega o Json dos Produtos Secundários
            if(data.produtosSecundarios){
                var objJsonProdutosSecundarios = $.parseJSON(data.produtosSecundarios);
                // Percorre cada "nó" atribuindo aos campos
                $.each(objJsonProdutosSecundarios, function(i, node){
                    var idObtida = 'vendasproduto' + node.id + 'obtida';
                    var idPrevista = 'vendasproduto' + node.id + 'prevista';
                    $('#' + idObtida).val(node.vendasobtida);
                    $('#' + idPrevista).val(node.vendasprevista);
                });
            }

            // Pega o Json dos Imoveis Explorados
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
                url:' <?php echo base_url('cadProducaoPecuaria/dadosProcuraProducaoPecuaria?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height: 180,
            mapper:
            [
                {name: 'id', hidden: 'hidden'},
                {name: 'atividade', hidden: 'hidden'},
                {name: 'atividadeDesc', title: 'Atividade', width: '260px', align: 'left'},            
                {name: 'periodoproducaoObtida', title: 'Periodo Produção Obtida', width: '150px', align: 'left'},
                {name: 'periodoproducaoPrevista', title: 'Periodo Produção Prevista', width: '150px', align: 'left'},
                {name: 'null', hidden: 'hidden'}
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
        $('#faseexploracao').val($('#atividade').val());
        $('#atividadecodigo').val($('#atividade').val());
        $('#unidadeprodutividade').val($('#atividade').val());
        $('#quantidadeth').val($('#atividade').val());
        $('#precoth').val($('#atividade').val());
        $('#producaototalth').val($('#atividade').val());
        $('#producaounidadeth').val($('#atividade').val());
        $('#receitacomvendath').val($('#atividade').val());
        $('#produto2th').val($('#atividade').val());
        $('#produto3th').val($('#atividade').val());
        $('#produto4th').val($('#atividade').val());
        $('#produto5th').val($('#atividade').val());
        $('#produto6th').val($('#atividade').val());
        $('#produto7th').val($('#atividade').val());
        $('#obs1').val($('#atividade').val());
        $('#obs2').val($('#atividade').val());
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
        $('#dadosImoveisExploradosPecuaria').val(txtReg);
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
                {name: 'exploradopecuaria',title:'Explorado',width:'80px',align:'center',render: function(v) { var t = v = (!!parseInt(v)) ? 'checked=\'checked\'' : '' ; return '<input id=\'chk' + idCheckBox++ + '\' type=\'checkbox\''  +t+ ' />'; } },
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
                        $('#msgAlerta').html('Certifique-se de marcar como "Explorado" todos imóveis utilizados na exploração e evite desmarcar após já ter cadastrado informações de Exploração Pecuária no Imóvel.');
                        $('#alertMessage').dialog('open');  
                        alertaImoveis = false;
                    }
                    // Limpa e carrega o formulário da exploração Pecuaria
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
        $('#frmCadProducaoPecuaria').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadProducaoPecuaria/incluir') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmCadProducaoPecuaria').submit();
    });
    
    $('#btnAlterar').click(function(){
        getDadosImoveisExplorados();
        getExploracaoImoveis();
        $('#frmCadProducaoPecuaria').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadProducaoPecuaria/alterar') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmCadProducaoPecuaria').submit();
    });
    
    $('#btnExcluir').click(function(){
        $('#frmCadProducaoPecuaria').ajaxForm({
            clearForm: true,
            success:  showResponse,
            url: '<?php echo base_url('CadProducaoPecuaria/excluir') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmCadProducaoPecuaria').submit();
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
        $('#frmCadProducaoPecuaria').resetForm();
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
    
    // producaounidadefinanciamentoobtida = producaototalobtida/(quantidadeobtida * quantidadeciclosanoobtida)
    function calcularProducaoUnidadeFinanciamentoObtida(){
        var producaototalobtida = $('#producaototalobtida').val().split('.').join('');
        producaototalobtida = producaototalobtida.replace(',','.');
        producaototalobtida = (!producaototalobtida) ? 0 : producaototalobtida;
        var quantidadeobtida = $('#quantidadeobtida').val().split('.').join('');
        quantidadeobtida = quantidadeobtida.replace(',','.');
        quantidadeobtida = (!quantidadeobtida) ? 0 : quantidadeobtida;
        var quantidadeciclosanoobtida = $('#quantidadeciclosanoobtida').val().split('.').join('');
        quantidadeciclosanoobtida = quantidadeciclosanoobtida.replace(',','.');
        quantidadeciclosanoobtida = (!quantidadeciclosanoobtida) ? 0 : quantidadeciclosanoobtida;
        
        var total = parseFloat(producaototalobtida) / (parseFloat(quantidadeobtida) * parseFloat(quantidadeciclosanoobtida));
        total = total || 0;
        $('#producaounidadefinanciamentoobtida').val(total.toString().replace('.',','));
        $('#producaounidadefinanciamentoobtida').blur();
    };
    $('#producaototalobtida').keydown(calcularProducaoUnidadeFinanciamentoObtida);
    $('#quantidadeobtida').keydown(calcularProducaoUnidadeFinanciamentoObtida);
    $('#quantidadeciclosanoobtida').keydown(calcularProducaoUnidadeFinanciamentoObtida);
    $('#producaounidadefinanciamentoobtida').keydown(calcularProducaoUnidadeFinanciamentoObtida);

    // producaounidadefinanciamentoprevista = producaototalprevista/(quantidadeprevista * quantidadeciclosanoprevista)
    function calcularProducaoUnidadeFinanciamentoPrevista(){
        var producaototalprevista = $('#producaototalprevista').val().split('.').join('');
        producaototalprevista = producaototalprevista.replace(',','.');
        producaototalprevista = (!producaototalprevista) ? 0 : producaototalprevista;
        var quantidadeprevista = $('#quantidadeprevista').val().split('.').join('');
        quantidadeprevista = quantidadeprevista.replace(',','.');
        quantidadeprevista = (!quantidadeprevista) ? 0 : quantidadeprevista;
        var quantidadeciclosanoprevista = $('#quantidadeciclosanoprevista').val().split('.').join('');
        quantidadeciclosanoprevista = quantidadeciclosanoprevista.replace(',','.');
        quantidadeciclosanoprevista = (!quantidadeciclosanoprevista) ? 0 : quantidadeciclosanoprevista;
        
        var total = parseFloat(producaototalprevista) / (parseFloat(quantidadeprevista) * parseFloat(quantidadeciclosanoprevista));
        total = total || 0;
        $('#producaounidadefinanciamentoprevista').val(total.toString().replace('.',','));
        $('#producaounidadefinanciamentoprevista').blur();
    };
    $('#producaototalprevista').keydown(calcularProducaoUnidadeFinanciamentoPrevista);
    $('#quantidadeprevista').keydown(calcularProducaoUnidadeFinanciamentoPrevista);
    $('#quantidadeciclosanoprevista').keydown(calcularProducaoUnidadeFinanciamentoPrevista);
    $('#producaounidadefinanciamentoprevista').keydown(calcularProducaoUnidadeFinanciamentoPrevista);

    // Calcular Custo Produção Obtida 
    function calcularCustoProducaoObtida(){
        var custoproducaounidadeobtida = $('#custoproducaounidadeobtida').val().split('.').join('');
        custoproducaounidadeobtida = custoproducaounidadeobtida.replace(',','.');
        custoproducaounidadeobtida = (!custoproducaounidadeobtida) ? 0 : custoproducaounidadeobtida;
        var quantidadeobtida = $('#quantidadeobtida').val().split('.').join('');
        quantidadeobtida = quantidadeobtida.replace(',','.');
        quantidadeobtida = (!quantidadeobtida) ? 0 : quantidadeobtida;  
        
        var total = parseFloat(custoproducaounidadeobtida) * parseFloat(quantidadeobtida);
        total = total || 0;
        $('#custoproducaoobtida').val(total.toString().replace('.',','));
        $('#custoproducaoobtida').blur();
    };
    $('#custoproducaounidadeobtida').keydown(calcularCustoProducaoObtida);
    $('#quantidadeobtida').keydown(calcularCustoProducaoObtida);
    $('#custoproducaoobtida').keydown(calcularCustoProducaoObtida);
    
    // Calcular custoProdução Prevista 
    function calcularCustoProducaoPrevista(){
        var custoproducaounidadeprevista = $('#custoproducaounidadeprevista').val().split('.').join('');
        custoproducaounidadeprevista = custoproducaounidadeprevista.replace(',','.');
        custoproducaounidadeprevista = (!custoproducaounidadeprevista) ? 0 : custoproducaounidadeprevista;
        var quantidadeprevista = $('#quantidadeprevista').val().split('.').join('');
        quantidadeprevista = quantidadeprevista.replace(',','.');
        quantidadeprevista = (!quantidadeprevista) ? 0 : quantidadeprevista;  
        
        var total = parseFloat(custoproducaounidadeprevista) * parseFloat(quantidadeprevista);
        total = total || 0;
        $('#custoproducaoprevista').val(total.toString().replace('.',','));
        $('#custoproducaoprevista').blur();
    };
    $('#custoproducaounidadeprevista').keydown(calcularCustoProducaoPrevista);
    $('#quantidadeprevista').keydown(calcularCustoProducaoPrevista);
    $('#custoproducaoprevista').keydown(calcularCustoProducaoPrevista);
    
    // receitacomvendaobtida = producaototalobtida*precoobtida
    function calcularReceitaComVendaObtida(){
        var producaototalobtida = $('#producaototalobtida').val().split('.').join('');
        producaototalobtida = producaototalobtida.replace(',','.');
        producaototalobtida = (!producaototalobtida) ? 0 : producaototalobtida;
        var precoobtida = $('#precoobtida').val().split('.').join('');
        precoobtida = precoobtida.replace(',','.');
        precoobtida = (!precoobtida) ? 0 : precoobtida;
        
        var total = parseFloat(producaototalobtida) * parseFloat(precoobtida);
        total = total || 0;
        $('#receitacomvendaobtida').val(total.toString().replace('.',','));
        $('#receitacomvendaobtida').blur();
    };
    $('#producaototalobtida').keydown(calcularReceitaComVendaObtida);
    $('#precoobtida').keydown(calcularReceitaComVendaObtida);
    $('#receitacomvendaobtida').keydown(calcularReceitaComVendaObtida);
    
    // receitacomvendaprevista = producaototalprevista*precoprevista
    function calcularReceitaComVendaPrevista(){
        var producaototalprevista = $('#producaototalprevista').val().split('.').join('');
        producaototalprevista = producaototalprevista.replace(',','.');
        producaototalprevista = (!producaototalprevista) ? 0 : producaototalprevista;
        var precoprevista = $('#precoprevista').val().split('.').join('');
        precoprevista = precoprevista.replace(',','.');
        precoprevista = (!precoprevista) ? 0 : precoprevista;
        
        var total = parseFloat(producaototalprevista) * parseFloat(precoprevista);
        total = total || 0;
        $('#receitacomvendaprevista').val(total.toString().replace('.',','));
        $('#receitacomvendaprevista').blur();
    };
    $('#producaototalprevista').keydown(calcularReceitaComVendaPrevista);
    $('#precoprevista').keydown(calcularReceitaComVendaPrevista);
    $('#receitacomvendaprevista').keydown(calcularReceitaComVendaPrevista);
    
    // receitatotalobtida = receitacomvendaobtida + produtossecundários
    function calcularReceitaTotalObtida(){
        var receitacomvendaobtida = $('#receitacomvendaobtida').val().split('.').join('');
        receitacomvendaobtida = receitacomvendaobtida.replace(',','.');
        receitacomvendaobtida = (!receitacomvendaobtida) ? 0 : receitacomvendaobtida;
        var vendasproduto2obtida = $('#vendasproduto2obtida').val().split('.').join('');
        vendasproduto2obtida = vendasproduto2obtida.replace(',','.');
        vendasproduto2obtida = (!vendasproduto2obtida) ? 0 : vendasproduto2obtida;
        var vendasproduto3obtida = $('#vendasproduto3obtida').val().split('.').join('');
        vendasproduto3obtida = vendasproduto3obtida.replace(',','.');
        vendasproduto3obtida = (!vendasproduto3obtida) ? 0 : vendasproduto3obtida;
        var vendasproduto4obtida = $('#vendasproduto4obtida').val().split('.').join('');
        vendasproduto4obtida = vendasproduto4obtida.replace(',','.');
        vendasproduto4obtida = (!vendasproduto4obtida) ? 0 : vendasproduto4obtida;
        var vendasproduto5obtida = $('#vendasproduto5obtida').val().split('.').join('');
        vendasproduto5obtida = vendasproduto5obtida.replace(',','.');
        vendasproduto5obtida = (!vendasproduto5obtida) ? 0 : vendasproduto5obtida;
        var vendasproduto6obtida = $('#vendasproduto6obtida').val().split('.').join('');
        vendasproduto6obtida = vendasproduto6obtida.replace(',','.');
        vendasproduto6obtida = (!vendasproduto6obtida) ? 0 : vendasproduto6obtida;
        var vendasproduto7obtida = $('#vendasproduto7obtida').val().split('.').join('');
        vendasproduto7obtida = vendasproduto7obtida.replace(',','.');
        vendasproduto7obtida = (!vendasproduto7obtida) ? 0 : vendasproduto7obtida;
        
        var total = parseFloat(receitacomvendaobtida) + parseFloat(vendasproduto2obtida) + parseFloat(vendasproduto3obtida) +
                    parseFloat(vendasproduto4obtida) + parseFloat(vendasproduto5obtida) + parseFloat(vendasproduto6obtida) + parseFloat(vendasproduto7obtida);
        total = total || 0;
        $('#receitatotalobtida').val(total.toString().replace('.',','));
        $('#receitatotalobtida').blur();
    };
    $('#receitacomvendaobtida').keydown(calcularReceitaTotalObtida);
    $('#receitatotalobtida').keydown(calcularReceitaTotalObtida);
    $('#vendasproduto2obtida').keydown(calcularReceitaTotalObtida);
    $('#vendasproduto3obtida').keydown(calcularReceitaTotalObtida);
    $('#vendasproduto4obtida').keydown(calcularReceitaTotalObtida);
    $('#vendasproduto5obtida').keydown(calcularReceitaTotalObtida);
    $('#vendasproduto6obtida').keydown(calcularReceitaTotalObtida);
    $('#vendasproduto7obtida').keydown(calcularReceitaTotalObtida);

    // receitatotalprevista = receitacomvendaprevista + produtossecundários
    function calcularReceitaTotalPrevista(){
        var receitacomvendaprevista = $('#receitacomvendaprevista').val().split('.').join('');
        receitacomvendaprevista = receitacomvendaprevista.replace(',','.');
        receitacomvendaprevista = (!receitacomvendaprevista) ? 0 : receitacomvendaprevista;
        var vendasproduto2prevista = $('#vendasproduto2prevista').val().split('.').join('');
        vendasproduto2prevista = vendasproduto2prevista.replace(',','.');
        vendasproduto2prevista = (!vendasproduto2prevista) ? 0 : vendasproduto2prevista;
        var vendasproduto3prevista = $('#vendasproduto3prevista').val().split('.').join('');
        vendasproduto3prevista = vendasproduto3prevista.replace(',','.');
        vendasproduto3prevista = (!vendasproduto3prevista) ? 0 : vendasproduto3prevista;
        var vendasproduto4prevista = $('#vendasproduto4prevista').val().split('.').join('');
        vendasproduto4prevista = vendasproduto4prevista.replace(',','.');
        vendasproduto4prevista = (!vendasproduto4prevista) ? 0 : vendasproduto4prevista;
        var vendasproduto5prevista = $('#vendasproduto5prevista').val().split('.').join('');
        vendasproduto5prevista = vendasproduto5prevista.replace(',','.');
        vendasproduto5prevista = (!vendasproduto5prevista) ? 0 : vendasproduto5prevista;
        var vendasproduto6prevista = $('#vendasproduto6prevista').val().split('.').join('');
        vendasproduto6prevista = vendasproduto6prevista.replace(',','.');
        vendasproduto6prevista = (!vendasproduto6prevista) ? 0 : vendasproduto6prevista;
        var vendasproduto7prevista = $('#vendasproduto7prevista').val().split('.').join('');
        vendasproduto7prevista = vendasproduto7prevista.replace(',','.');
        vendasproduto7prevista = (!vendasproduto7prevista) ? 0 : vendasproduto7prevista;
        
        var total = parseFloat(receitacomvendaprevista) + parseFloat(vendasproduto2prevista) + parseFloat(vendasproduto3prevista) +
                    parseFloat(vendasproduto4prevista) + parseFloat(vendasproduto5prevista) + parseFloat(vendasproduto6prevista) + parseFloat(vendasproduto7prevista);
        total = total || 0;
        $('#receitatotalprevista').val(total.toString().replace('.',','));
        $('#receitatotalprevista').blur();
    };
    $('#receitacomvendaprevista').keydown(calcularReceitaTotalPrevista);
    $('#receitatotalprevista').keydown(calcularReceitaTotalPrevista);
    $('#vendasproduto2prevista').keydown(calcularReceitaTotalPrevista);
    $('#vendasproduto3prevista').keydown(calcularReceitaTotalPrevista);
    $('#vendasproduto4prevista').keydown(calcularReceitaTotalPrevista);
    $('#vendasproduto5prevista').keydown(calcularReceitaTotalPrevista);
    $('#vendasproduto6prevista').keydown(calcularReceitaTotalPrevista);
    $('#vendasproduto7prevista').keydown(calcularReceitaTotalPrevista);
    
    // receitatotalunidadefinanciamentoobtida = receitatotalobtida/(quantidadeobtida * quantidadeciclosanoobtida)
    function calcularReceitaTotalUnidadeFinanciamentoObtida(){
        var receitatotalobtida = $('#receitatotalobtida').val().split('.').join('');
        receitatotalobtida = receitatotalobtida.replace(',','.');
        receitatotalobtida = (!receitatotalobtida) ? 0 : receitatotalobtida;
        var quantidadeobtida = $('#quantidadeobtida').val().split('.').join('');
        quantidadeobtida = quantidadeobtida.replace(',','.');
        quantidadeobtida = (!quantidadeobtida) ? 0 : quantidadeobtida;
        var quantidadeciclosanoobtida = $('#quantidadeciclosanoobtida').val().split('.').join('');
        quantidadeciclosanoobtida = quantidadeciclosanoobtida.replace(',','.');
        quantidadeciclosanoobtida = (!quantidadeciclosanoobtida) ? 0 : quantidadeciclosanoobtida;
        
        var total =  parseFloat(receitatotalobtida) / (parseFloat(quantidadeobtida) * parseFloat(quantidadeciclosanoobtida));
        total = total || 0;
        $('#receitatotalunidadefinanciamentoobtida').val(total.toString().replace('.',','));
        $('#receitatotalunidadefinanciamentoobtida').blur();
    };
    $('#receitatotalobtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#quantidadeobtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#quantidadeciclosanoobtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#receitatotalunidadefinanciamentoobtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#vendasproduto2obtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#vendasproduto3obtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#vendasproduto4obtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#vendasproduto5obtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#vendasproduto6obtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    $('#vendasproduto7obtida').keydown(calcularReceitaTotalUnidadeFinanciamentoObtida);
    

    // receitatotalunidadefinanciamentoprevista = receitatotalprevista/(quantidadeprevista * quantidadeciclosanoprevista)
    function calcularReceitaTotalUnidadeFinanciamentoPrevista(){
        var receitatotalprevista = $('#receitatotalprevista').val().split('.').join('');
        receitatotalprevista = receitatotalprevista.replace(',','.');
        receitatotalprevista = (!receitatotalprevista) ? 0 : receitatotalprevista;
        var quantidadeprevista = $('#quantidadeprevista').val().split('.').join('');
        quantidadeprevista = quantidadeprevista.replace(',','.');
        quantidadeprevista = (!quantidadeprevista) ? 0 : quantidadeprevista;
        var quantidadeciclosanoprevista = $('#quantidadeciclosanoprevista').val().split('.').join('');
        quantidadeciclosanoprevista = quantidadeciclosanoprevista.replace(',','.');
        quantidadeciclosanoprevista = (!quantidadeciclosanoprevista) ? 0 : quantidadeciclosanoprevista;
        
        var total =  parseFloat(receitatotalprevista) / (parseFloat(quantidadeprevista) * parseFloat(quantidadeciclosanoprevista));
        total = total || 0;
        $('#receitatotalunidadefinanciamentoprevista').val(total.toString().replace('.',','));
        $('#receitatotalunidadefinanciamentoprevista').blur();
    };
    $('#receitatotalprevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#quantidadeprevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#quantidadeciclosanoprevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#receitatotalunidadefinanciamentoprevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#vendasproduto2prevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#vendasproduto3prevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#vendasproduto4prevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#vendasproduto5prevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#vendasproduto6prevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);
    $('#vendasproduto7prevista').keydown(calcularReceitaTotalUnidadeFinanciamentoPrevista);

    // receitaliquidaanoobtida = (quantidadeciclosanoobtida = '') ? (receitatotalobtida - custoproducaoobtida - custototalcomarrendamentoobtida) : (receitatotalobtida - custoproducaoobtida-(custototalcomarrendamentoobtida/quantidadeciclosanoobtida))
    function calcularReceitaLiquidaAnoObtida(){
        var quantidadeciclosanoobtida = $('#quantidadeciclosanoobtida').val().split('.').join('');
        quantidadeciclosanoobtida = quantidadeciclosanoobtida.replace(',','.');
        quantidadeciclosanoobtida = (!quantidadeciclosanoobtida) ? 0 : quantidadeciclosanoobtida;
        var receitatotalobtida = $('#receitatotalobtida').val().split('.').join('');
        receitatotalobtida = receitatotalobtida.replace(',','.');
        receitatotalobtida = (!receitatotalobtida) ? 0 : receitatotalobtida;
        var custoproducaoobtida = $('#custoproducaoobtida').val().split('.').join('');
        custoproducaoobtida = custoproducaoobtida.replace(',','.');
        custoproducaoobtida = (!custoproducaoobtida) ? 0 : custoproducaoobtida;
        var custototalcomarrendamentoobtida = $('#custototalcomarrendamentoobtida').val().split('.').join('');
        custototalcomarrendamentoobtida = custototalcomarrendamentoobtida.replace(',','.');
        custototalcomarrendamentoobtida = (!custototalcomarrendamentoobtida) ? 0 : custototalcomarrendamentoobtida;
        
        var total = 0;
        // Verifica se está vazio
        if(quantidadeciclosanoobtida == 0 || !quantidadeciclosanoobtida){
            total =  parseFloat(receitatotalobtida) - parseFloat(custoproducaoobtida) - parseFloat(custototalcomarrendamentoobtida);
        }else{
            total =  parseFloat(receitatotalobtida) - parseFloat(custoproducaoobtida) - (parseFloat(custototalcomarrendamentoobtida)/parseFloat(quantidadeciclosanoobtida));
        }
        total = total || 0;
        $('#receitaliquidaanoobtida').val(total.toString().replace('.',','));
        $('#receitaliquidaanoobtida').blur();
    };    
    $('#quantidadeciclosanoobtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#receitatotalobtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#custoproducaoobtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#custototalcomarrendamentoobtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#receitaliquidaanoobtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#vendasproduto2obtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#vendasproduto3obtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#vendasproduto4obtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#vendasproduto5obtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#vendasproduto6obtida').keydown(calcularReceitaLiquidaAnoObtida);
    $('#vendasproduto7obtida').keydown(calcularReceitaLiquidaAnoObtida);
    
    // receitaliquidaanoprevista = (quantidadeciclosanoprevista = '') ? (receitatotalprevista - custoproducaoprevista - custototalcomarrendamentoprevista) : (receitatotalprevista - custoproducaoprevista-(custototalcomarrendamentoprevista/quantidadeciclosanoprevista))
    function calcularReceitaLiquidaAnoPrevista(){
        var quantidadeciclosanoprevista = $('#quantidadeciclosanoprevista').val().split('.').join('');
        quantidadeciclosanoprevista = quantidadeciclosanoprevista.replace(',','.');
        quantidadeciclosanoprevista = (!quantidadeciclosanoprevista) ? 0 : quantidadeciclosanoprevista;
        var receitatotalprevista = $('#receitatotalprevista').val().split('.').join('');
        receitatotalprevista = receitatotalprevista.replace(',','.');
        receitatotalprevista = (!receitatotalprevista) ? 0 : receitatotalprevista;
        var custoproducaoprevista = $('#custoproducaoprevista').val().split('.').join('');
        custoproducaoprevista = custoproducaoprevista.replace(',','.');
        custoproducaoprevista = (!custoproducaoprevista) ? 0 : custoproducaoprevista;
        var custototalcomarrendamentoprevista = $('#custototalcomarrendamentoprevista').val().split('.').join('');
        custototalcomarrendamentoprevista = custototalcomarrendamentoprevista.replace(',','.');
        custototalcomarrendamentoprevista = (!custototalcomarrendamentoprevista) ? 0 : custototalcomarrendamentoprevista;
        
        var total = 0;
        // Verifica se está vazio
        if(quantidadeciclosanoprevista == 0 || !quantidadeciclosanoprevista){
            total =  parseFloat(receitatotalprevista) - parseFloat(custoproducaoprevista) - parseFloat(custototalcomarrendamentoprevista);
        }else{
            total =  parseFloat(receitatotalprevista) - parseFloat(custoproducaoprevista) - (parseFloat(custototalcomarrendamentoprevista)/parseFloat(quantidadeciclosanoprevista));
        }
        total = total || 0;
        $('#receitaliquidaanoprevista').val(total.toString().replace('.',','));
        $('#receitaliquidaanoprevista').blur();
    };
    $('#quantidadeciclosanoprevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#receitatotalprevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#custoproducaoprevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#custototalcomarrendamentoprevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#receitaliquidaanoprevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#vendasproduto2prevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#vendasproduto3prevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#vendasproduto4prevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#vendasproduto5prevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#vendasproduto6prevista').keydown(calcularReceitaLiquidaAnoPrevista);
    $('#vendasproduto7prevista').keydown(calcularReceitaLiquidaAnoPrevista);

    /*
    $('#accordionImoveis').click(function(){
        alert(validaPeriodo($('#colheitaObtidaMes1').val(),$('#colheitaObtidaAno1').val(),$('#colheitaObtidaMes2').val(),$('#colheitaObtidaAno2').val()));
    });
    */
});
</script>
