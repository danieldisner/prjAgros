<div id='janelaPrincipal' title='Cadastro de Clientes' style='display: none'>
    <div class='form-dialog-ui' style='height: 100%'>
        <form id='frmCadCliente' method='post'>
            <input type='hidden' id='dadosSemoventes' name='dadosSemoventes'/>
            <input type='hidden' id='dadosImoveis' name='dadosImoveis'/>
            <input type='hidden' id='dadosMoveis' name='dadosMoveis'/>
            <div id='tabs'>
                <ul>
                    <li><a id='aba1' href='#abaDadosPessoais'>Dados Pessoais</a></li>
                    <li><a href='#abaImoveis'>Bens Imóveis</a></li>
                    <li><a href='#abaSemoventes'>Semoventes</a></li>
                    <li><a href='#abaMoveis'>Bens Móveis</a></li>
                </ul>
                <div id='abaDadosPessoais' style='height: 100%'>
                    <div class='form-group'>    
                        <div class='row'>
                            <div class='col-xs-1'>
                                <label for='btnProcCliente'></label>
                            </div>
                            <div id='rdGroup' class='col-xs-10'>
                                <input type='radio' id='rdCPF' name='rdTipoCliente' checked='checked'/><label for='rdCPF'>CPF</label>
                                <input type='radio' id='rdCNPJ' name='rdTipoCliente'/><label for='rdCNPJ'>CNPJ</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-1'>
                                <button id='btnProcCliente' name='btnProcCliente' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                            </div>
                            <div class='col-xs-3'>
                                <input type='text' class='form-control cpf' id='cpfcnpj' name='cpfcnpj' placeholder='CPF Cliente' style='max-width: 150px'/>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-6'>
                                <label class='control-label'>Nome Completo</label>
                                <input type='text' class='form-control required' id='nome' name='nome' placeholder='Nome Completo'/>
                            </div>
                            <div class='col-xs-3'>
                                <label class='control-label'>RG</label>
                                <input type='text' class='form-control' id='rg' name='rg' placeholder='RG'/>
                            </div>
                        </div>
                        <div class='row'>
                           <div class='col-xs-4'>
                                <label class='control-label'>CPF Cônjuge</label>
                                <input type='text' class='form-control cpf' id='cpfconjuge' name='cpfconjuge' placeholder='CPF Cônjuge' style='max-width: 150px'/>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-6'>
                                <label class='control-label'>Nome Cônjuge</label>
                                <input type='text' class='form-control' id='nomeconjuge' name='nomeconjuge' placeholder='Nome do Cônjuge'/>
                            </div>
                            <div class='col-xs-3'>
                                <label class='control-label'>RG Cônjuge</label>
                                <input type='text' class='form-control' id='rgconjuge' name='rgconjuge' placeholder='RG'/>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-2'>
                                <label class='control-label'>CEP</label>
                                <input type='text' class='form-control cep' id='cep' name='cep' placeholder='CEP'/>
                            </div>
                            <div class='col-xs-7'>
                                <label class='control-label'>Endereço</label>
                                <input type='text' class='form-control required' id='endereco' name='endereco' placeholder='Endereço'/>
                            </div>
                             <div class='col-xs-1'>
                              <label class='control-label'>Nº</label>
                              <input type='text' class='form-control' id='nroendereco' name='nroendereco' placeholder='Número' />
                            </div>
                            <div class='col-xs-2'>
                              <label class='control-label'>Complemento</label>
                              <input type='text' class='form-control' id='complemento' name='complemento' placeholder='Complemento'>
                            </div>
                            <div class='col-xs-3'>
                              <label class='control-label'>Bairro</label>
                              <input type='text' class='form-control' id='bairro' name='bairro' placeholder='Bairro'>
                            </div>
                            <div class='col-xs-3'>
                                <label class='control-label'>Estado</label>
                                <select  class='form-control required' id='estado' name='estado'>
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
                            <div class='col-xs-1' style='min-width: 110px'>
                              <label class='control-label'>Telefone</label>
                              <input type='text' class='form-control telefone required' id='fone1' name='fone1' placeholder='Telefone'/>
                            </div>
                            <div class='col-xs-1' style='min-width: 110px'>
                               <label class='control-label'>Celular</label>
                              <input type='text' class='form-control telefone' id='fone2' name='fone2' placeholder='Celular'/>
                            </div>
                            <div class='col-xs-3'>
                               <label class='control-label'>E-Mail</label>
                               <input type='email' class='form-control' id='email' name='email' placeholder='E-Mail'/>
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                              <label class='control-label'></label>
                              <button id='btnProcAgencia' name='btnProcAgencia' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                            </div>
                            <div class='col-xs-2'>
                                <input type='hidden' id='agencia' name='agencia'/>
                               <label class='control-label'>Nome Agência</label>
                               <input type='text' class='form-control required' id='nomeAgencia' name='nomeAgencia' placeholder='Nome da Agência' readonly='readonly'/>
                            </div>
                            <div class='col-xs-1'>
                               <label class='control-label'>Prefixo</label>
                               <input type='text' class='form-control' id='prefixoAgencia' name='prefixoAgencia' placeholder='Prefixo'readonly='readonly'/>   
                            </div>
                            <div class='col-xs-2'>
                               <label class='control-label'>Conta</label>
                               <input type='text' class='form-control' id='conta' name='conta' placeholder='Conta'/>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='abaImoveis'>
                    <div class='form-group'>
                        <div class='row'>
                            <div class='col-xs-1'>
                                <label class='control-label'>Tipo</label>
                                <select class='form-control' id='tipoimovel' name='tipoimovel'>
                                    <?php foreach($tiposImovel as $tipoImovel){ ?>
                                        <option value='<?php echo $tipoImovel['id']?>'><?php echo $tipoImovel['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 200px'>
                                <label class='control-label'>Nome</label>
                                <input type='text' class='form-control' id='nomeImovel' name='nomeImovel' placeholder='Nome do Imóvel'/>
                            </div>
                            <div class='col-xs-1' style='min-width: 130px'>
                                <label class='control-label'>Espécie</label>
                                <select class='form-control' id='especieImovel' name='especieImovel'>
                                    <?php foreach($especiesImovel as $especieImovel){ ?>
                                        <option value='<?php echo $especieImovel['id']?>'><?php echo $especieImovel['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 60px'>
                                <label class='control-label'>Matricula</label>
                                <input type='text' class='form-control' id='matriculaImovel' name='matriculaImovel' placeholder='Matrícula'/>  
                            </div>
                            <div class='col-xs-1' style='min-width: 100px'>
                                <label class='control-label'>Cart. Registro</label>
                                <input type='text' class='form-control' id='registro' name='registro' placeholder='Cart. Registro'/>  
                            </div>
                            <div class='col-xs-1' style='min-width: 80px'>
                                <label class='control-label'>Part.</label>
                                <div class='input-group'>
                                    <input type='text' class='form-control onlynumbers' id='partImovel' name='partImovel' value='100' maxlength='3'/>
                                    <div class='input-group-addon'>%</div>
                                </div>
                            </div>
                            <div class='col-xs-1' style='min-width: 120px'>
                                <label class='control-label'>Situação</label>
                                <select class='form-control' id='sitpropriedadeImovel' name='sitpropriedadeImovel'>
                                    <?php foreach($situacoesPropriedade as $situacaoPropriedade){ ?>
                                        <option value='<?php echo $situacaoPropriedade['id']?>'><?php echo $situacaoPropriedade['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 120px;'>
                                <label class='control-label'>Conservação</label>
                                <select class='form-control' id='estadoconservacaoImovel' name='estadoconservacaoImovel'>
                                    <?php foreach($estadosConservacao as $estadoConservacao){ ?>
                                        <option value='<?php echo $estadoConservacao['id']?>'><?php echo $estadoConservacao['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 85px'>
                                <label class='control-label'>Gravame</label>
                                <select class='form-control' id='gravameImovel' name='gravameImovel'>
                                    <?php foreach($gravames as $gravame){ ?>
                                        <option value='<?php echo $gravame['id']?>'><?php echo $gravame['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-2 divCamposRurais' style='min-width: 120px'>
                                <label class='control-label'>CCIR</label>
                                <input type='text' class='form-control' id='ccir' name='ccir' placeholder='CCIR'/>
                            </div>     
                            <div class='col-xs-2 divCamposRurais' style='min-width: 120px'>
                                <label class='control-label'>NIRF</label>
                                <input type='text' class='form-control' id='nirf' name='nirf' placeholder='NIRF'/>
                            </div>
                            <div class='col-xs-2 divCamposRurais' style='min-width: 140px'>
                                <label class='control-label'>Latitude</label>
                                <input type='text' class='form-control' id='latitude' name='latitude' placeholder='(GMS)' value='-'/>
                            </div>
                            <div class='col-xs-2 divCamposRurais' style='min-width: 140px'>
                                <label class='control-label'>Longitude</label>
                                <input type='text' class='form-control' id='longitude' name='longitude' placeholder='(GMS)' value='-'/>
                            </div>
                            <div class='col-xs-2 divCamposUrbanos'>
                                <label class='control-label'>CEP</label>
                                <input type='text' class='form-control cep' id='cepImovel' name='cepImovel' placeholder='CEP'/>
                            </div>
                            <div class='col-xs-3 divCamposUrbanos'>
                                <label class='control-label'>Endereço</label>
                                <input type='text' class='form-control' id='enderecoImovel' name='enderecoImovel' placeholder='Endereco'/>
                            </div>
                             <div class='col-xs-1 divCamposUrbanos'>
                              <label class='control-label'>Nº</label>
                              <input type='text' class='form-control' id='nroenderecoImovel' name='nroenderecoImovel' placeholder='Número' />
                            </div>
                            <div class='col-xs-2'>
                              <label class='control-label'>Bairro/Distrito</label>
                              <input type='text' class='form-control' id='bairroImovel' name='bairroImovel' placeholder='Bairro'>
                            </div>
                            <div class='col-xs-1' style='min-width: 55px'>
                                <label class='control-label'>UF</label>
                                <select class='form-control' id='ufImovel' name='ufImovel'>
                                    <option value=''>UF</option> 
                                    <option value='AC'>AC</option> 
                                    <option value='AL'>AL</option> 
                                    <option value='AM'>AM</option> 
                                    <option value='AP'>AP</option> 
                                    <option value='BA'>BA</option> 
                                    <option value='CE'>CE</option> 
                                    <option value='DF'>DF</option> 
                                    <option value='ES'>ES</option> 
                                    <option value='GO'>GO</option> 
                                    <option value='MA'>MA</option> 
                                    <option value='MT'>MT</option> 
                                    <option value='MS'>MS</option> 
                                    <option value='MG'>MG</option> 
                                    <option value='PA'>PA</option> 
                                    <option value='PB'>PB</option> 
                                    <option value='PR'>PR</option> 
                                    <option value='PE'>PE</option> 
                                    <option value='PI'>PI</option> 
                                    <option value='RJ'>RI</option> 
                                    <option value='RN'>RN</option> 
                                    <option value='RO'>RO</option> 
                                    <option value='RS'>RS</option> 
                                    <option value='RR'>RR</option> 
                                    <option value='SC'>SC</option> 
                                    <option value='SE'>SE</option> 
                                    <option value='SP'>SP</option> 
                                    <option value='TO'>TO</option> 
                                </select>
                            </div>
                            <div class='col-xs-3 selectContainer'>
                                <label class='control-label'>Município</label>
                                <select class='form-control' id='municipioImovel' name='municipioImovel' disabled='disabled'>
                                    <option value=''>Selecione o Município</option>
                                </select>
                            </div>
                            <div id='dadosImovelRural'>
                                <div class='col-xs-1' style='min-width: 90px'>
                                    <label class='control-label'>Cessão 3º(s)</label>
                                    <select class='form-control' id='cessaoterceiros' name='cessaoterceiros'>
                                        <option value='0'>NÃO</option>
                                        <option value='1'>SIM</option>
                                    </select>
                                </div>
                                <input type='hidden' id='areatotal' name='areatotal'/>
                                <input type='hidden' id='valorhectare' name='valorhectare'/>
                                <input type='hidden' id='valorterranua' name='valorterranua'/>
                            </div>
                            <div id='dadosImovelUrbano' style='display:none'>
                                <div class='col-xs-2'>
                                    <label class='control-label'>Área Terreno</label>
                                    <div class='input-group'>
                                        <input type='text' class='form-control decimal' id='areaterreno' name='areaterreno' placeholder='100,00'/>
                                        <div class='input-group-addon'>m²</div>
                                    </div>
                                </div>
                                <div class='col-xs-2' style='min-width: 140px'>
                                    <label class='control-label'>Área Construída</label>
                                    <div class='input-group'>
                                        <input type='text' class='form-control decimal' id='areaconstruida' name='areaconstruida' placeholder='100,00'/>
                                        <div class='input-group-addon'>m²</div>
                                    </div>
                                </div>
                                <div class='col-xs-3'>
                                    <label class='control-label'>Valor Total</label>
                                    <div class='input-group' >
                                        <div class='input-group-addon'>R$</div>
                                        <input type='text' class='form-control decimal' id='valortotalImovel' name='valortotalImovel' placeholder='100,00'/>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                                <label class='control-label'>&nbsp;</label>
                                <button id='btnAddImovel' name='btnAddImovel' class='form-control jqbutton'/><span class='glyphicon glyphicon-plus'></span> </button> 
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                                <label class='control-label'>&nbsp;</label>
                                <button id='btnRemImovel' name='btnRemImovel' class='form-control jqbutton' disabled='disabled'/><span class='glyphicon glyphicon-minus'></span> </button>  
                            </div>
                            <input type='hidden' id='exploradoAgricola' name='exploradoAgricola'/>
                            <input type='hidden' id='exploradoPecuaria' name='exploradoPecuaria'/>
                        </div>
                    </div>    
                    <div id='accordion'>
                        <h3 id='accordionRurais'>IMÓVEIS RURAIS</h3>
                        <div class='groupAccordion' style='height: 170px'>
                            <div id='gridRurais'></div>
                        </div>
                        <h3 id='accordionUrbanos' >IMÓVEIS URBANOS</h3>
                        <div id='divUrbanos' class='groupAccordion' style='height: 170px'>
                            <div id='gridUrbanos'></div>
                        </div>
                    </div>
                </div>
                <div id='abaSemoventes'>
                    <div class='form-group'>
                        <div class='row'>
                            <div class='col-xs-2'>
                                <label class='control-label'>Espécie</label>
                                <select class='form-control' id='especieSemovente' name='especieSemovente'>
                                    <?php foreach($especiesSemovente as $especieSemovente){ ?>
                                        <option value='<?php echo $especieSemovente['id']?>'><?php echo $especieSemovente['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Qtd</label>
                                <input type='text' class='form-control onlynumbers' id='quantidade' name='quantidade' placeholder='Qtd.'/>
                            </div>
                            <div class='col-xs-3'>
                                <label class='control-label'>Finalidade</label>
                                <select class='form-control' id='finalidade' name='finalidade'>
                                    <?php foreach($finalidades as $finalidade){ ?>
                                        <option value='<?php echo $finalidade['id']?>'><?php echo $finalidade['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Raça</label>
                                <select class='form-control' id='raca' name='raca'>
                                </select>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Pelagem</label>
                                <input type='text' class='form-control' id='pelagem' name='pelagem' placeholder='Palegem'/>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Mestiçagem</label>
                                <input type='text' class='form-control' id='graumesticagem' name='graumesticagem' placeholder='Grau'/>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Idade(Meses)</label>
                                <input type='text' class='form-control' id='idade' name='idade' placeholder='Meses'/>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Gravame</label>
                                <select class='form-control' id='gravameSemovente' name='gravameSemovente'>
                                    <?php foreach($gravames as $gravame){ ?>
                                        <option value='<?php echo $gravame['id']?>'><?php echo $gravame['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Seguro</label>
                                <select class='form-control' id='seguroSemovente' name='seguroSemovente'>
                                    <option value='0'>NÃO</option>
                                    <option value='1'>SIM</option>
                                </select>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Situação</label>
                                <select class='form-control' id='sitpropriedadeSemovente' name='sitpropriedadeSemovente'>
                                    <?php foreach($situacoesPropriedade as $situacaoPropriedade){ ?>
                                        <option value='<?php echo $situacaoPropriedade['id']?>'><?php echo $situacaoPropriedade['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 80px'>
                                <label class='control-label'>Part.</label>
                                <div class='input-group'>
                                    <input type='text' class='form-control onlynumbers' id='partSemovente' name='partSemovente' value='100' maxlength='3'/>
                                    <div class='input-group-addon'>%</div>
                                </div>
                            </div>
                            <div class='col-xs-1' style='min-width: 130px'>
                                <label class='control-label'>Valor Uni.</label>
                                <div class='input-group' >
                                    <div class='input-group-addon'>R$</div>
                                    <input type='text' class='form-control decimal' id='valorunitario' name='valorunitario' placeholder='100,00'/>
                                </div>
                            </div>
                            <div class='col-xs-1' style='min-width: 150px'>
                                <label class='control-label'>Valor Total</label>
                                <div class='input-group' >
                                    <div class='input-group-addon'>R$</div>
                                    <input type='text' class='form-control decimal' id='valortotalSemovente' name='valortotalSemovente' readonly='readonly' placeholder='100,00' tabindex='-1'/>
                                </div>
                            </div>
                            <div class='col-xs-1' style='max-width: 60px'>
                              <label class='control-label'>Imóvel</label>
                              <button id='btnProcImovelSemovente' name='btnProcImovelSemovente' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Matrícula</label>
                                <input type='hidden' id='tipoimovelSemovente' name='tipoimovelSemovente'/>
                                <input type='hidden' id='imovelSemovente' name='imovelSemovente'/>
                                <input type='text' class='form-control' id='matriculaSemovente' name='matriculaSemovente' readonly='readonly' placeholder='Matrícula'/>  
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                                <label class='control-label'>&nbsp;</label>
                                <button id='btnAddSemovente' name='btnAddSemovente' class='form-control jqbutton'/><span class='glyphicon glyphicon-plus'></span> </button>                          </div>
                            <div class='col-xs-1' style='max-width: 60px;'> 
                                <label class='control-label'>&nbsp;</label>
                                <button id='btnRemSemovente' name='btnRemSemovente' class='form-control jqbutton' disabled='disabled'/><span class='glyphicon glyphicon-minus'></span> </button>  
                            </div>
                        </div>
                    </div>    
                    <div id='gridSemovente'></div>
                </div>
                <div id='abaMoveis'>
                    <div class='form-group'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <label class='control-label'>Espécie</label>
                                <select class='form-control' id='especieMovel' name='especieMovel'>
                                    <?php foreach($especiesMovel as $especieMovel){ ?>
                                        <option value='<?php echo $especieMovel['id']?>'><?php echo $especieMovel['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Fabricante</label>
                                <input type='text' class='form-control' id='fabricante' name='fabricante' placeholder='Fabricante'/>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Modelo</label>
                                <input type='text' class='form-control' id='modelo' name='modelo' placeholder='Modelo'/>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Ano</label>
                                <input type='text' class='form-control onlynumbers' id='anomodelo' name='anomodelo' placeholder='Ano'/>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Situação</label>
                                <select class='form-control' id='sitpropriedadeMovel' name='sitpropriedadeMovel'>
                                    <?php foreach($situacoesPropriedade as $situacaoPropriedade){ ?>
                                        <option value='<?php echo $situacaoPropriedade['id']?>'><?php echo $situacaoPropriedade['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Gravame</label>
                                <select class='form-control' id='gravameMovel' name='gravameMovel'>
                                    <?php foreach($gravames as $gravame){ ?>
                                        <option value='<?php echo $gravame['id']?>'><?php echo $gravame['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 120px'>
                                <label class='control-label'>Série/Chassi</label>
                                <input type='text' class='form-control' id='seriechassi' name='seriechassi' placeholder='Série/Chassi'/>
                            </div>
                            <div class='col-xs-1' style='min-width: 90px'>
                                <label class='control-label'>Potência/Cap</label>
                                    <input type='text' class='form-control onlynumbers' id='potencia' name='potencia' placeholder='100'/>
                            </div>
                            <div class='col-xs-1' style='min-width: 120px'>
                                <label class='control-label'>Medida</label>
                                <select class='form-control' id='potenciatipo' name='potenciatipo'>
                                    <option value='CV'>CAVALOS</option>
                                    <option value='L'>LITROS</option>
                                    <option value='Kg'>QUILOGRAMAS</option>
                                    <option value='T'>TONELADAS</option>
                                    <option value='KW'>QUILOWATTS</option>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 120px;'>
                                <label class='control-label'>Conservação</label>
                                <select class='form-control' id='estadoconservacaoMovel' name='estadoconservacaoMovel'>
                                    <?php foreach($estadosConservacao as $estadoConservacao){ ?>
                                        <option value='<?php echo $estadoConservacao['id']?>'><?php echo $estadoConservacao['nome']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-xs-1' style='min-width: 80px;'>
                                <label class='control-label'>Part.</label>
                                <div class='input-group'>
                                    <input type='text' class='form-control onlynumbers' id='partMovel' name='partMovel' value='100'  maxlength='3'/>
                                    <div class='input-group-addon'>%</div>
                                </div>
                            </div>
                            <div class='col-xs-2'>
                                <label class='control-label'>Valor</label>
                                <div class='input-group' >
                                    <div class='input-group-addon'>R$</div>
                                    <input type='text' class='form-control decimal' id='valorMovel' name='valorMovel' placeholder='100,00'/>
                                </div>
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                              <label class='control-label'>Imóvel</label>
                              <button id='btnProcImovelMovel' name='btnProcImovelMovel' class='form-control jqbutton'/><span class='glyphicon glyphicon-search'></span></button>
                            </div>
                            <div class='col-xs-1'>
                                <label class='control-label'>Matrícula</label>
                                <input type='hidden' id='tipoimovelMovel' name='tipoimovelMovel'/>
                                <input type='hidden' id='imovelMovel' name='imovelMovel'/>
                                <input type='text' class='form-control' id='matriculaMovel' name='matriculaMovel' readonly='readonly' placeholder='Matrícula'/>  
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                                <label class='control-label'>&nbsp;</label>
                                <button id='btnAddMovel' name='btnAddMovel' class='form-control jqbutton'/><span class='glyphicon glyphicon-plus'></span> </button>
                            </div>
                            <div class='col-xs-1' style='max-width: 60px;'>
                                <label class='control-label'>&nbsp;</label>
                                <button id='btnRemMovel' name='btnRemMovel' class='form-control jqbutton' disabled='disabled'/><span class='glyphicon glyphicon-minus'></span> </button>  
                            </div>
                        </div>
                    </div>    
                    <div id='gridMoveis'></div>
                </div>
            </div>
            <div class='groupBotoes'>
                <input type='button' id='btnIncluir' name='btnIncluir' class='btn btn-lg btn-default' disabled='disabled' value='Incluir'/>
                <input type='button' id='btnAlterar' name='btnAlterar' class='btn btn-lg btn-default' disabled='disabled' value='Alterar'/>
                <input type='button' id='btnExcluir' name='btnExcluir' class='btn btn-lg btn-default' disabled='disabled' value='Excluir'/>
                <input type='button' id='btnCancelar' name='btnCancelar' class='btn btn-lg btn-default' value='Cancelar'/>
                <input type='button' id='btnFechar' name='btnFechar' class='btn btn-lg btn-default' value='Fechar'/>
            </div>
        </form>
    </div>
</div>
<div id='procuraCliente' title='Procura Cliente' style='display: none'>
    <input type='text' class='form-control required' id='nomeBusca' name='nomeBusca' placeholder='Nome Cliente'/>
    <div id='gridCliente'></div>
</div>
<div id='procuraAgencia' title='Procura Agencia' style='display: none'>
    <div id='gridAgencia'></div>
</div>
<div id='procuraImoveis' title='Procura Imóveis' style='display: none'>
    <div id='gridProcImoveis'></div>
</div>
<script>    
$(function(){
    var spamEdit = '<span class=\'glyphicon glyphicon-edit\'></span>';
    var spamAdd = '<span class=\'glyphicon glyphicon-plus\'></span>';
    var empresa = <?php echo $this->session->userdata('empresa'); ?>;
    // Janela Principal da Tela
    $('#janelaPrincipal').dialog({
        dialogClass: 'no-close',
        width: '85%',
        height: '610',
        modal: true,
        resizable: false,
        autoResize:true
    });
    $('#cpfcnpj').focus();
    
    // Arruma o conflito nos botões do JQuery UI para estilizar os radio Buttons
    if($.fn.button.noConflict){
        $.fn.btn = $.fn.button.noConflict();
    };
    
    // Abas
    $('#tabs').tabs({
        heightStyle: 'content'
    });
    
    // Accordion
    $('#accordion').accordion({
        heightStyle: 'content'
    });
    
    // Inicia o grupo dos radios com o JQueryUI
    $('#rdGroup').buttonset();$('#rdGroup2').buttonset();
    
    // Inicia os botões para a classe jqbutton
    $('.jqbutton').button();
    
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
            
    // Tela de Procura de Agência
    $('#procuraAgencia').dialog({
      dialogClass: 'no-close',
      resizable: false,
      modal: true,
      autoOpen: false,
      buttons: {
        'Limpar': function(){
            $('#agencia').val('');
            $('#nomeAgencia').val('');
            $('#prefixoAgencia').val('');
            $('#conta').val('');
            $(this).dialog('close');
        },
        'Fechar': function(){
            $(this).dialog('close');
        }
      }
    });
    // Botão de Procura de Agência
    $('#btnProcAgencia').click(function(event){
        event.preventDefault();
        $('#procuraAgencia').dialog('open');
    });
    // Função responsável pelo carregamento da tela de procura de agência
    var $dgAgencia = $('#gridAgencia');
    function gridAgenciaLoad(){
        $dgAgencia.datagrid({
            jsonStore: {
                url:' <?php echo base_url('CadAgencia/dadosGrid') ?>'
            },
            height : 80,
            pagination: false,
            mapper:[
                {name: 'id', hidden: 'hidden'},
                {name: 'nome', title: 'Descrição', width: '150px', align: 'left'},       
                {name: 'prefixo', title: 'Prefixo', width: '40px', align: 'left'}
            ]        
            ,eventController: {
                onClickRow: function(tr) {
                    $('#procuraAgencia').dialog('close');
                    $('#agencia').val(tr.cells[0].innerHTML);
                    $('#nomeAgencia').val(tr.cells[1].innerHTML);
                    $('#prefixoAgencia').val(tr.cells[2].innerHTML);
                }
            }  
        });
    };
    gridAgenciaLoad();    
    
    // Tela de Procura de Imóvel
    var opcaoBuscaImovel;
    $('#procuraImoveis').dialog({
      dialogClass: 'no-close',
      resizable: false,
      width: '40%',
      height: '300',
      modal: true,
      autoOpen: false,
      buttons: {
        'Limpar': function(){
            if(opcaoBuscaImovel==='semovente'){
                $('#imovelSemovente').val('');
                $('#tipoimovelSemovente').val('');
                $('#matriculaSemovente').val('');
            }else if(opcaoBuscaImovel==='movel'){
                $('#imovelMovel').val('');
                $('#tipoimovelMovel').val('');
                $('#matriculaMovel').val('');
            }
            $(this).dialog('close');
        },
        'Fechar': function(){
            $(this).dialog('close');
        }
      }
    });
    
    // Botão de Procura de Imóvel (Semoventes)
    $('#btnProcImovelSemovente').click(function(event){
        event.preventDefault();
        gridProcImoveisLoad();
        opcaoBuscaImovel = 'semovente';
        $('#procuraImoveis').dialog('open');
    });
    
    // Botão de Procura de Imóvel (Bens Móveis)
    $('#btnProcImovelMovel').click(function(event){
        event.preventDefault();
        gridProcImoveisLoad();
        opcaoBuscaImovel = 'movel';
        $('#procuraImoveis').dialog('open');
    });
    
    // Função responsável pelo carregamento da tela de procura de agência
    var $dgProcImovel = $('#gridProcImoveis');
    $dgProcImovel.datagrid({
        jsonStore: {
            url:''
        },
        height : 160,
        pagination: false,
        mapper:[
            {name: 'id', title: 'ID', width: '30px', align: 'center'},
            {name: 'tipo', hidden:'hidden'},
            {name: 'tipoDesc', title: 'Tipo', width: '100px', align: 'left'},
            {name: 'nome', title: 'Nome', width: '150px', align: 'left'},            
            {name: 'especie', title: 'Espécie', width: '100px', align: 'left'},
            {name: 'matricula', title: 'Matrícula', width: '70px', align: 'left'},
            {name: 'registro', title: 'Cart. Registro', width: '100px', align: 'left'},
            {name: 'cep', title: 'CEP', width: '80px', align: 'left'},
            {name: 'endereco', title: 'Endereço', width: '200px', align: 'left'},
            {name: 'nroendereco', title: 'Nº', width: '50px', align: 'left'},
            {name: 'bairro', title: 'Bairro', width: '250px', align: 'left'},
            {name: 'municipio', title: 'Município', width: '200px', align: 'left'}
        ]        
        ,eventController: {
            onClickRow: function(tr){
                $('#procuraImoveis').dialog('close');
                // Verifica qual opção de busca foi selecionada e atribui ao formulário
                if(opcaoBuscaImovel==='semovente'){
                    $('#imovelSemovente').val(tr.cells[0].innerHTML);
                    $('#tipoimovelSemovente').val(tr.cells[1].innerHTML);
                    $('#matriculaSemovente').val(tr.cells[5].innerHTML);
                }else if(opcaoBuscaImovel==='movel'){
                    $('#imovelMovel').val(tr.cells[0].innerHTML);
                    $('#tipoimovelMovel').val(tr.cells[1].innerHTML);
                    $('#matriculaMovel').val(tr.cells[5].innerHTML);
                } 
            }
        }
    });
    
    // Carrega os dados do grid da procura de imóveis 
    function gridProcImoveisLoad(){
        var array = [];
        // Pega as linhas do grid rurais
        rows = $dgRurais.datagrid('getRows');
        // Percorre o grid dos imóveis rurais
        for(i=0;i<rows.length;i++){
            var obJson = {
                'id': rows[i].cells[0].innerHTML,
                'nome': rows[i].cells[1].innerHTML,
                'tipo': '1',
                'tipoDesc': 'RURAL',
                'especie': rows[i].cells[3].innerHTML,	 
                'matricula': rows[i].cells[4].innerHTML,
                'registro': rows[i].cells[5].innerHTML,
                'cep': rows[i].cells[13].innerHTML,
                'endereco': rows[i].cells[14].innerHTML,
                'nroendereco': rows[i].cells[15].innerHTML,
                'bairro': rows[i].cells[16].innerHTML,
                'municipio': rows[i].cells[19].innerHTML
            };
            array.push(obJson);
        }
        rows = $dgUrbanos.datagrid('getRows');
        for(i=0;i<rows.length;i++){
            var obJson = {
                'id': rows[i].cells[0].innerHTML,
                'nome': rows[i].cells[1].innerHTML,
                'tipo': '2',
                'tipoDesc': 'URBANO',
                'especie': rows[i].cells[3].innerHTML,	 
                'matricula': rows[i].cells[4].innerHTML,
                'registro': rows[i].cells[5].innerHTML,
                'cep': rows[i].cells[13].innerHTML,
                'endereco': rows[i].cells[14].innerHTML,
                'nroendereco': rows[i].cells[15].innerHTML,
                'bairro': rows[i].cells[16].innerHTML,
                'municipio': rows[i].cells[19].innerHTML
            };
            array.push(obJson);
        }
        $dgProcImovel.datagrid('loadLocalData', array);
    };
    
    // Função de Callback do Post do Formulario
    function showResponse(response){
        limparForm();
        $('#msgAlerta').html(response.msg);
        $('#alertMessage').dialog('open');
    };
    
    // Função Responsável por desabilitar os botões
    function desabilitaBotoes(){
        $('#btnIncluir').attr('disabled', 'disabled');
        $('#btnAlterar').attr('disabled', 'disabled');
        $('#btnExcluir').attr('disabled', 'disabled');
    };
    
    // Função Responsável pela Validação do Formulário
    function validaForm(){
        // Verifica item a item do formulário           if(!$('#nome').val() || !$('#id').val()){
        if(!validarCamposDiv('#abaDadosPessoais')){
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
    
    function changeRurais(){
        // Limpa as linha selecionadas no grid e desabilita o botão de remover
        limparCamposImoveis();
        $dgRurais.datagrid('clearSelectedRows');
        $dgUrbanos.datagrid('clearSelectedRows');
        $('#dadosImovelRural').show();
        $('#dadosImovelUrbano').hide();
        $('.divCamposUrbanos').hide();
        $('.divCamposRurais').show();
        // Adiciona obrigatórios rurais
        //$('#areareserva').addClass('required');  
        // Remove obrigatórios urbanos
        //$('#areaterreno').removeClass('required');
    };
    
    function changeUrbanos(){
        // Limpa as linha selecionadas no grid e desabilita o botão de remover
        limparCamposImoveis();
        $dgRurais.datagrid('clearSelectedRows');
        $dgUrbanos.datagrid('clearSelectedRows');
        $('#dadosImovelUrbano').show();
        $('#dadosImovelRural').hide();
        $('.divCamposUrbanos').show();
        $('.divCamposRurais').hide();
        // Adiciona obrigatórios urbanos
        //$('#areaterreno').addClass('required');
        // Remove obrigatórios rurais
        //$('#areareserva').removeClass('required'); 
    }
    $('#accordionRurais').click(function(){
        $('#tipoimovel').val('1');
        changeRurais();
    });
    
    $('#accordionUrbanos').click(function(){
        $('#tipoimovel').val('2');
       changeUrbanos();
    });

    // Muda o accordion e os campos de acordo com o tipo de imóvel
    $('.divCamposUrbanos').hide();
    $('#tipoimovel').change(function(){
        $('#btnRemImovel').button('disable');
        if($('#tipoimovel').val() === '1'){
            $('#accordionRurais').click();
            changeRurais();
        }else{
            $('#accordionUrbanos').click();
            changeUrbanos();
        }
    });
    
    // Controle do combobox com as raças
    var racaSelecionada = '';
    $('#raca').load('<?php echo base_url('CadCliente/carregarRaca?') ?>'+'especie='+$('#especieSemovente').val(), function(){ 
        $('#raca').removeAttr('disabled');
    });
    // Quando mudar a raça
    $('#especieSemovente').change(function(){
        $('#raca').load('<?php echo base_url('CadCliente/carregarRaca?') ?>'+'especie='+$('#especieSemovente').val()+'&raca='+racaSelecionada, function(){ 
            $('#raca').removeAttr('disabled');
        });
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
    
    // Função que conecta com API para consultar o CEP
    var municipioDescSelecionadoImovel = '';
    $('#cepImovel').change(function(){
        municipioDescSelecionadoImovel = '';
        municipioIDSelecionadoImovel = '';
        var cep_code = $(this).val();
        if( cep_code.length <= 0 ) return;
        $.get('http:\/\/apps.widenet.com.br\/busca-cep\/api\/cep.json',{code: cep_code},
        function(result){
            if(result.status!==1){
                $('#msgAlerta').html(result.message || 'Houve um erro desconhecido');
                $('#alertMessage').dialog('open');
                return;
            }
            $('#cepImovel').val(result.code);
            municipioDescSelecionadoImovel = result.city;
            $('#ufImovel').val(result.state);
            $('#ufImovel').change();
            $('#bairroImovel').val(result.district);
            $('#enderecoImovel').val(result.address);
        });
    });
    
    // Controle do combobox com os municípios (Imóveis)
    var municipioIDSelecionadoImovel = '';
    $('#ufImovel').change(function(){
        if($('#ufImovel').val()){
            $('#municipioImovel').load('<?php echo base_url('CadCliente/carregarMunicipio?') ?>'+'uf='+$('#ufImovel').val()+'&municipioID='+municipioIDSelecionadoImovel+'&municipioDesc='+municipioDescSelecionadoImovel, function(){ 
                $('#municipioImovel').removeAttr('disabled');
            });
        }else{
            $('#municipioImovel').val('');
            $('#municipioImovel').attr('disabled','disabled');
        }
    });
    
    /*
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S DOS IMÓVEIS
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S DOS IMÓVEIS
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S DOS IMÓVEIS
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S DOS IMÓVEIS
    */
    // Percorre o grid e cria um JSON para inserir no banco de dados
    function getDadosImoveisGrid(){
        // Pega as linhas do grid Rurais
        var rows = $dgRurais.datagrid('getRows');
        var txtReg = '[';
        // Percorre o grid dos imóveis rurais
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var varAreaTotal = rows[i].cells[26].innerHTML.split('.').join('');
            varAreaTotal = varAreaTotal.replace(',','.');
            var varValorHectare = rows[i].cells[27].innerHTML.split('.').join('');
            varValorHectare = varValorHectare.replace(',','.');
            var varValorTerraNua = rows[i].cells[28].innerHTML.split('.').join('');
            varValorTerraNua = varValorTerraNua.replace(',','.');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'id': rows[i].cells[0].innerHTML,
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'tipo': 1,
                            'nome': rows[i].cells[1].innerHTML,
                            'especie': rows[i].cells[2].innerHTML,	 
                            'matricula': rows[i].cells[4].innerHTML,
                            'registro': rows[i].cells[5].innerHTML,
                            'cep': rows[i].cells[17].innerHTML,
                            'endereco': rows[i].cells[18].innerHTML,
                            'nroendereco': rows[i].cells[19].innerHTML,
                            'bairro': rows[i].cells[20].innerHTML,
                            'municipio': rows[i].cells[22].innerHTML,
                            'part': rows[i].cells[6].innerHTML,
                            'sitpropriedade': rows[i].cells[7].innerHTML,
                            'estadoconservacao': rows[i].cells[9].innerHTML,
                            'gravame': rows[i].cells[11].innerHTML,
                            'ccir': rows[i].cells[13].innerHTML,
                            'nirf': rows[i].cells[14].innerHTML,
                            'latitude': rows[i].cells[15].innerHTML,
                            'longitude': rows[i].cells[16].innerHTML,
                            'cessaoterceiros': rows[i].cells[24].innerHTML,
                            'areatotal': varAreaTotal,
                            'valorhectare': varValorHectare,
                            'valorterranua': varValorTerraNua,
                            'areaterreno': '',
                            'areaconstruida': '',
                            'valortotal': '',
                            'exploradoagricola' :rows[i].cells[29].innerHTML,
                            'exploradopecuaria' :rows[i].cells[30].innerHTML
                        }); 
            txtReg += ',';
        }
        // Pega as linhas do grid urbanos
        rows = $dgUrbanos.datagrid('getRows');
        // Percorre o grid dos imóveis urbanos
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var varAreaTerreno = rows[i].cells[20].innerHTML.split('.').join('');
            varAreaTerreno = varAreaTerreno.replace(',','.');
            var varAreaConstruida = rows[i].cells[21].innerHTML.split('.').join('');
            varAreaConstruida = varAreaConstruida.replace(',','.');
            var varValorTotal = rows[i].cells[22].innerHTML.split('.').join('');
            varValorTotal = varValorTotal.replace(',','.');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'id': rows[i].cells[0].innerHTML,
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'tipo': 2,
                            'nome': rows[i].cells[1].innerHTML,
                            'especie': rows[i].cells[2].innerHTML,	 
                            'matricula': rows[i].cells[4].innerHTML,
                            'registro': rows[i].cells[5].innerHTML,
                            'cep': rows[i].cells[13].innerHTML,
                            'endereco': rows[i].cells[14].innerHTML,
                            'nroendereco': rows[i].cells[15].innerHTML,
                            'bairro': rows[i].cells[16].innerHTML,
                            'municipio': rows[i].cells[18].innerHTML,
                            'part': rows[i].cells[6].innerHTML,
                            'sitpropriedade': rows[i].cells[7].innerHTML,
                            'estadoconservacao': rows[i].cells[9].innerHTML,
                            'gravame': rows[i].cells[11].innerHTML,
                            'cessaoterceiros': '',
                            'areatotal': '',
                            'valorhectare': '',
                            'valorterranua': '',
                            'areaterreno': varAreaTerreno,
                            'areaconstruida': varAreaConstruida,
                            'valortotal': varValorTotal
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosImoveis').val(txtReg);
    };
    
    // Função responsável pelo carregamento do grid
    var imovelRuralSelecionado = null;
    var linhaGridRurais = null;
    var $dgRurais = $('#gridRurais');
    function gridRuraisLoad(){
        $dgRurais.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadCliente/dadosGridRurais?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height: 105,
            mapper:
            [
                {name: 'id', title: 'ID', width: '30px', align: 'center'},
                {name: 'nome', title: 'Nome', width: '200px', align: 'left'},            
                {name: 'especie', hidden: 'hidden'},
                {name: 'especieDesc', title: 'Espécie', width: '100px', align: 'left'},
                {name: 'matricula', title: 'Matrícula', width: '70px', align: 'left'},
                {name: 'registro', title: 'Cart. Registro', width: '100px', align: 'left'},
                {name: 'part', title: 'Part(%)', width: '60px', align: 'center'},
                {name: 'sitpropriedade', hidden: 'hidden'},
                {name: 'sitpropriedadeDesc', title: 'Situação Prop.', width: '100px', align: 'center'},
                {name: 'estadoconservacao', hidden: 'hidden'},
                {name: 'estadoconservacaoDesc', title: 'Conservação', width: '90px', align: 'center'},
                {name: 'gravame', hidden: 'hidden'},
                {name: 'gravameDesc', title: 'Gravame', width: '70px', align: 'center'},
                {name: 'ccir', title: 'CCIR', width: '120px', align: 'left'},
                {name: 'nirf', title: 'NIRF', width: '80px', align: 'left'},
                {name: 'latitude', title: 'Latitude', width: '120px', align: 'left'},
                {name: 'longitude', title: 'Longitude', width: '120px', align: 'left'},
                {name: 'cep', hidden: 'hidden'},
                {name: 'endereco', hidden: 'hidden'},
                {name: 'nroendereco',  hidden: 'hidden'},
                {name: 'bairro', title: 'Bairro', width: '250px', align: 'left'},
                {name: 'uf', hidden: 'hidden'},
                {name: 'municipio', hidden: 'hidden'},
                {name: 'municipioDesc', title: 'Município', width: '250px', align: 'left'},
                {name: 'cessaoterceiros', hidden: 'hidden'},
                {name: 'cessaoterceirosDesc', title: 'Cessão 3º(s)', width: '90px', align: 'left'},
                {name: 'areatotal', title: 'Área Total', width: '80px', align: 'left'},
                {name: 'valorhectare', title: 'Valor Hectare', width: '100px', align: 'left'},
                {name: 'valorterranua', title: 'Valor Terra Nua', width: '100px', align: 'left'},
                {name: 'exploradoagricola', hidden: 'hidden'},
                {name: 'exploradopecuaria', hidden: 'hidden'}
            ],
            eventController: {
                onClickRow: function(tr){
                    $('#tipoimovel').val(1);
                    $('#tipoimovel').change();
                    municipioDescSelecionadoImovel = '';
                    municipioIDSelecionadoImovel = '';
                    // Verifica se possui alguma linha selecionada e marca qual linha foi
                    // Para poder remover ou substituir
                    $(this).datagrid('clearSelectedRows');
                    // Limpa os imóveis urbanos selecionados
                    $dgUrbanos.datagrid('clearSelectedRows');
                    imovelUrbanoSelecionado = null;
                    // Se foi selecionada alguma linha, atribui aos campos do formulário
                    if(imovelRuralSelecionado !== tr.cells[0].innerHTML){
                        $(this).datagrid('selectRow',tr);
                        imovelRuralSelecionado = tr.cells[0].innerHTML;
                        $('#btnRemImovel').button('enable');
                        $('#nomeImovel').val(tr.cells[1].innerHTML);
                        $('#especieImovel').val(tr.cells[2].innerHTML);
                        $('#matriculaImovel').val(tr.cells[4].innerHTML);
                        $('#registro').val(tr.cells[5].innerHTML);
                        $('#partImovel').val(tr.cells[6].innerHTML);
                        $('#sitpropriedadeImovel').val(tr.cells[7].innerHTML);
                        $('#estadoconservacaoImovel').val(tr.cells[9].innerHTML);
                        $('#gravameImovel').val(tr.cells[11].innerHTML);
                        $('#ccir').val(tr.cells[13].innerHTML);
                        $('#nirf').val(tr.cells[14].innerHTML);
                        $('#latitude').val(tr.cells[15].innerHTML);
                        $('#longitude').val(tr.cells[16].innerHTML);
                        // Formata o cep e o insere no campo
                        var cep = tr.cells[17].innerHTML;
                        cep = (cep !== '') ?  cep.substr(0, 5) + '-' + cep.substr(5, 3) : '';
                        $('#cepImovel').val(cep);
                        $('#enderecoImovel').val(tr.cells[18].innerHTML);
                        $('#nroenderecoImovel').val(tr.cells[19].innerHTML);
                        $('#bairroImovel').val(tr.cells[20].innerHTML);
                        $('#ufImovel').val(tr.cells[21].innerHTML);
                        // Seleciona o municipio
                        municipioIDSelecionadoImovel = tr.cells[22].innerHTML;
                        $('#ufImovel').change();
                        // Fim das linhas em comum para os tipos de imóvel
                        $('#cessaoterceiros').val(tr.cells[24].innerHTML);
                        $('#areatotal').val(tr.cells[26].innerHTML);
                        $('#valorhectare').val(tr.cells[27].innerHTML);
                        $('#valorterranua').val(tr.cells[28].innerHTML);
                        $('#exploradoAgricola').val(tr.cells[29].innerHTML);
                        $('#exploradoPecuaria').val(tr.cells[30].innerHTML);
                        linhaGridRurais = tr;
                        $('#btnAddImovel').html(spamEdit);
                    }else{
                        imovelRuralSelecionado = null;
                        linhaGridRurais = null;
                        limparCamposImoveis();
                        $('#btnAddImovel').html(spamAdd);
                        $('#btnRemImovel').button('disable');
                    }
                }
            }
        });
    };
    gridRuraisLoad();
    
    // Função responsável pelo carregamento do grid
    var imovelUrbanoSelecionado = null;
    var linhaGridUrbanos = null;
    var $dgUrbanos = $('#gridUrbanos');
    function gridUrbanosLoad(){
        $dgUrbanos.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadCliente/dadosGridUrbanos?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()},
            pagination: false,
            height: 105,
            mapper:
            [
                {name: 'id', title: 'ID', width: '30px', align: 'center'},
                {name: 'nome', title: 'Nome', width: '200px', align: 'left'},            
                {name: 'especie', hidden: 'hidden'},
                {name: 'especieDesc', title: 'Espécie', width: '100px', align: 'left'},
                {name: 'matricula', title: 'Matrícula', width: '70px', align: 'left'},
                {name: 'registro', title: 'Cart. Registro', width: '100px', align: 'left'},
                {name: 'part', title: 'Part(%)', width: '60px', align: 'center'},
                {name: 'sitpropriedade', hidden: 'hidden'},
                {name: 'sitpropriedadeDesc', title: 'Situação Prop.', width: '100px', align: 'center'},
                {name: 'estadoconservacao', hidden: 'hidden'},
                {name: 'estadoconservacaoDesc', title: 'Conservação', width: '90px', align: 'center'},
                {name: 'gravame', hidden: 'hidden'},
                {name: 'gravameDesc', title: 'Gravame', width: '70px', align: 'center'},
                {name: 'cep', title: 'CEP', width: '80px', align: 'left'},
                {name: 'endereco', title: 'Endereço', width: '200px', align: 'left'},
                {name: 'nroendereco', title: 'Nº', width: '50px', align: 'left'},
                {name: 'bairro', title: 'Bairro', width: '250px', align: 'left'},
                {name: 'uf', hidden: 'hidden'},
                {name: 'municipio', hidden: 'hidden'},
                {name: 'municipioDesc', title: 'Município', width: '250px', align: 'left'},
                {name: 'areaterreno', title: 'Área Terreno', width: '90px', align: 'left'},
                {name: 'areaconstruida', title: 'Área Construída', width: '110px', align: 'left'},
                {name: 'valortotal', title: 'Valor Total', width: '80px', align: 'left'}

            ],
            eventController: {
                onClickRow: function(tr){
                    $('#tipoimovel').val(2);
                    $('#tipoimovel').change();
                    municipioDescSelecionadoImovel = '';
                    municipioIDSelecionadoImovel = '';
                    // Verifica se possui alguma linha selecionada e marca qual linha foi
                    // Para poder remover ou substituir
                    $(this).datagrid('clearSelectedRows');
                    // Limpa os imóveis rurais selecionados
                    $dgRurais.datagrid('clearSelectedRows');
                    imovelRuralSelecionado = null;
                    // Se foi selecionada alguma linha, atribui aos campos do formulário
                    if(imovelUrbanoSelecionado !== tr.cells[0].innerHTML){
                        $(this).datagrid('selectRow',tr);
                        imovelUrbanoSelecionado = tr.cells[0].innerHTML;
                        $('#btnRemImovel').button('enable');
                        $('#nomeImovel').val(tr.cells[1].innerHTML);
                        $('#especieImovel').val(tr.cells[2].innerHTML);
                        $('#matriculaImovel').val(tr.cells[4].innerHTML);
                        $('#registro').val(tr.cells[5].innerHTML);
                        $('#partImovel').val(tr.cells[6].innerHTML);
                        $('#sitpropriedadeImovel').val(tr.cells[7].innerHTML);
                        $('#estadoconservacaoImovel').val(tr.cells[9].innerHTML);
                        $('#gravameImovel').val(tr.cells[11].innerHTML);
                        // Formata o cep e o insere no campo
                        var cep = tr.cells[13].innerHTML;
                        cep = (cep !== '') ?  cep.substr(0, 5) + '-' + cep.substr(5, 3) : '';
                        $('#cepImovel').val(cep);
                        $('#enderecoImovel').val(tr.cells[14].innerHTML);
                        $('#nroenderecoImovel').val(tr.cells[15].innerHTML);
                        $('#bairroImovel').val(tr.cells[16].innerHTML);
                        $('#ufImovel').val(tr.cells[17].innerHTML);
                        // Seleciona o municipio
                        municipioIDSelecionadoImovel = tr.cells[18].innerHTML;
                        $('#ufImovel').change();
                        // Fim das linhas em comum para os tipos de imóvel
                        $('#areaterreno').val(tr.cells[20].innerHTML);
                        $('#areaconstruida').val(tr.cells[21].innerHTML);
                        $('#valortotalImovel').val(tr.cells[22].innerHTML);
                        linhaGridUrbanos = tr;
                        $('#btnAddImovel').html(spamEdit);
                    }else{
                        linhaGridUrbanos = null;
                        imovelUrbanoSelecionado = null;
                        limparCamposImoveis();
                        $('#btnRemImovel').button('disable');
                    }

                }
            }
        });
    };
    gridUrbanosLoad();
    
    // Botões Grid
    $('#btnAddImovel').click(function(event){
        event.preventDefault();
        if(validarCamposDiv('#abaImoveis')){
            var id;
            // Se for do tipo rural
            if($('#tipoimovel').val() ==='1'){
                if(imovelRuralSelecionado !== null){
                    linhaGridRurais.cells[1].innerHTML = $('#nomeImovel').val();
                    linhaGridRurais.cells[2].innerHTML = $('#especieImovel').val();
                    linhaGridRurais.cells[3].innerHTML = $('#especieImovel option:selected').text();
                    linhaGridRurais.cells[4].innerHTML = $('#matriculaImovel').val();
                    linhaGridRurais.cells[5].innerHTML = $('#registro').val();
                    linhaGridRurais.cells[6].innerHTML = $('#partImovel').val();
                    linhaGridRurais.cells[7].innerHTML = $('#sitpropriedadeImovel').val();
                    linhaGridRurais.cells[8].innerHTML = $('#sitpropriedadeImovel option:selected').text();
                    linhaGridRurais.cells[9].innerHTML = $('#estadoconservacaoImovel').val();
                    linhaGridRurais.cells[10].innerHTML = $('#estadoconservacaoImovel option:selected').text();
                    linhaGridRurais.cells[11].innerHTML = $('#gravameImovel').val();
                    linhaGridRurais.cells[12].innerHTML = $('#gravameImovel option:selected').text();
                    linhaGridRurais.cells[13].innerHTML = $('#nirf').val();
                    linhaGridRurais.cells[14].innerHTML = $('#ccir').val();
                    linhaGridRurais.cells[15].innerHTML = $('#latitude').val();
                    linhaGridRurais.cells[16].innerHTML = $('#longitude').val();
                    linhaGridRurais.cells[17].innerHTML = $('#cepImovel').val().replace(/[^\d]+/g,'');
                    linhaGridRurais.cells[18].innerHTML = $('#enderecoImovel').val();
                    linhaGridRurais.cells[19].innerHTML = $('#nroenderecoImovel').val();
                    linhaGridRurais.cells[20].innerHTML = $('#bairroImovel').val();
                    linhaGridRurais.cells[21].innerHTML = $('#ufImovel').val();
                    linhaGridRurais.cells[22].innerHTML = $('#municipioImovel').val();
                    linhaGridRurais.cells[23].innerHTML = ($('#municipioImovel').val() != '') ? $('#municipioImovel option:selected').text() : '';
                    // Fim das linhas em comum para os tipos de imóvel
                    linhaGridRurais.cells[24].innerHTML = $('#cessaoterceiros').val();
                    linhaGridRurais.cells[25].innerHTML = $('#cessaoterceiros option:selected').text();
                    linhaGridRurais.cells[26].innerHTML = $('#areatotal').val();
                    linhaGridRurais.cells[27].innerHTML = $('#valorhectare').val();    
                    linhaGridRurais.cells[28].innerHTML = $('#valorterranua').val();    
                    linhaGridRurais.cells[29].innerHTML = $('#exploradoAgricola').val();
                    linhaGridRurais.cells[30].innerHTML = $('#exploradoPecuaria').val();                        
                    imovelRuralSelecionado = null;
                    linhaGridRurais = null;
                }else{
                    // Controle do id, se for não for a primeira linha coloca 0, se não coloca 1
                    var linha = $dgRurais.datagrid('getRowCount');
                    if(linha!=0){
                        var row = $dgRurais.datagrid('getRow',linha-1);
                        id = parseInt(row.cells[0].innerHTML)+1;
                    }else id = 1;
                    
                    var obJson = {                
                        'id':id,
                        'nome': $('#nomeImovel').val(),
                        'especie': $('#especieImovel').val(),
                        'especieDesc': $('#especieImovel option:selected').text(),
                        'matricula': $('#matriculaImovel').val(),
                        'registro': $('#registro').val(),
                        'part': $('#partImovel').val(),
                        'sitpropriedade': $('#sitpropriedadeImovel').val(),
                        'sitpropriedadeDesc': $('#sitpropriedadeImovel option:selected').text(),
                        'estadoconservacao': $('#estadoconservacaoImovel').val(),
                        'estadoconservacaoDesc': $('#estadoconservacaoImovel option:selected').text(),
                        'gravame': $('#gravameImovel').val(),
                        'ccir': $('#ccir').val(),
                        'nirf': $('#nirf').val(),
                        'latitude': $('#latitude').val(),
                        'longitude': $('#longitude').val(),
                        'gravameDesc': $('#gravameImovel option:selected').text(),
                        'cep': $('#cepImovel').val().replace(/[^\d]+/g,''),
                        'endereco': $('#enderecoImovel').val(),
                        'nroendereco': $('#nroenderecoImovel').val(),
                        'bairro': $('#bairroImovel').val(),
                        'uf': $('#ufImovel').val(),
                        'municipio': $('#municipioImovel').val(),
                        'municipioDesc': ($('#municipioImovel').val() != '') ? $('#municipioImovel option:selected').text() : '',
                        'cessaoterceiros': $('#cessaoterceiros').val(),
                        'cessaoterceirosDesc': $('#cessaoterceiros option:selected').text(),
                        'areatotal': $('#areatotal').val(),  
                        'valorhectare': $('#valorhectare').val(),
                        'valorterranua': $('#valorterranua').val(),
                        'exploradoagricola': $('#exploradoAgricola').val(),
                        'exploradopecuaria': $('#exploradoPecuaria').val()
                    };
                    $dgRurais.datagrid('addRow', [obJson]);
                }
                $dgRurais.datagrid('clearSelectedRows');
            // Urbano
            }else{
                if(imovelUrbanoSelecionado !== null){
                    id = imovelUrbanoSelecionado;
                    linhaGridUrbanos.cells[1].innerHTML = $('#nomeImovel').val();
                    linhaGridUrbanos.cells[2].innerHTML = $('#especieImovel').val();
                    linhaGridUrbanos.cells[3].innerHTML = $('#especieImovel option:selected').text();
                    linhaGridUrbanos.cells[4].innerHTML = $('#matriculaImovel').val();
                    linhaGridUrbanos.cells[5].innerHTML = $('#registro').val();
                    linhaGridUrbanos.cells[6].innerHTML = $('#partImovel').val();
                    linhaGridUrbanos.cells[7].innerHTML = $('#sitpropriedadeImovel').val();
                    linhaGridUrbanos.cells[8].innerHTML = $('#sitpropriedadeImovel option:selected').text();
                    linhaGridUrbanos.cells[9].innerHTML = $('#estadoconservacaoImovel').val();
                    linhaGridUrbanos.cells[10].innerHTML = $('#estadoconservacaoImovel option:selected').text();
                    linhaGridUrbanos.cells[11].innerHTML = $('#gravameImovel').val();
                    linhaGridUrbanos.cells[12].innerHTML = $('#gravameImovel option:selected').text();
                    linhaGridUrbanos.cells[13].innerHTML = $('#cepImovel').val().replace(/[^\d]+/g,'');
                    linhaGridUrbanos.cells[14].innerHTML = $('#enderecoImovel').val();
                    linhaGridUrbanos.cells[15].innerHTML = $('#nroenderecoImovel').val();
                    linhaGridUrbanos.cells[16].innerHTML = $('#bairroImovel').val();
                    linhaGridUrbanos.cells[17].innerHTML = $('#ufImovel').val();
                    linhaGridUrbanos.cells[18].innerHTML = $('#municipioImovel').val();
                    linhaGridUrbanos.cells[19].innerHTML = ($('#municipioImovel').val() != '') ? $('#municipioImovel option:selected').text() : '';
                    // Fim das linhas em comum para os tipos de imóvel
                    linhaGridUrbanos.cells[20].innerHTML = $('#areaterreno').val();
                    linhaGridUrbanos.cells[21].innerHTML = $('#areaconstruida').val();
                    linhaGridUrbanos.cells[22].innerHTML = $('#valortotalImovel').val();
                    imovelUrbanoSelecionado = null;
                    linhaGridUrbanos = null;
                }else{
                    // Controle do id, se for não for a primeira linha coloca 0, se não coloca 1
                    var linha = $dgUrbanos.datagrid('getRowCount');
                    if(linha!=0){
                        var row = $dgUrbanos.datagrid('getRow',linha-1);
                        id = parseInt(row.cells[0].innerHTML)+1;
                    }else id = 1;
                    
                    var obJson = {                
                        'id':id,
                        'nome': $('#nomeImovel').val(),
                        'especie': $('#especieImovel').val(),
                        'especieDesc': $('#especieImovel option:selected').text(),
                        'matricula': $('#matriculaImovel').val(),
                        'registro': $('#registro').val(),
                        'part': $('#partImovel').val(),
                        'sitpropriedade': $('#sitpropriedadeImovel').val(),
                        'sitpropriedadeDesc': $('#sitpropriedadeImovel option:selected').text(),
                        'estadoconservacao': $('#estadoconservacaoImovel').val(),
                        'estadoconservacaoDesc': $('#estadoconservacaoImovel option:selected').text(),
                        'gravame': $('#gravameImovel').val(),
                        'gravameDesc': $('#gravameImovel option:selected').text(),
                        'cep': $('#cepImovel').val().replace(/[^\d]+/g,''),
                        'endereco': $('#enderecoImovel').val(),
                        'nroendereco': $('#nroenderecoImovel').val(),
                        'bairro': $('#bairroImovel').val(),
                        'uf': $('#ufImovel').val(),
                        'municipio': $('#municipioImovel').val(),
                        'municipioDesc': ($('#municipioImovel').val() != '') ? $('#municipioImovel option:selected').text() : '',
                        'areaterreno': $('#areaterreno').val(),
                        'areaconstruida': $('#areaconstruida').val(),
                        'valortotal': $('#valortotalImovel').val()
                    };
                    $dgUrbanos.datagrid('addRow', [obJson]);
                }
                $dgUrbanos.datagrid('clearSelectedRows');
            }
            limparCamposImoveis(); 
            $('#btnRemImovel').button('disable');
        }
    });
    
    $('#btnRemImovel').click(function(event){
        event.preventDefault();
        if($('#tipoimovel').val() ==='1'){
            linhaGridRurais.remove();
            imovelRuralSelecionado = null;
        }else{
            linhaGridUrbanos.remove();
            imovelUrbanoSelecionado = null;
        }
        limparCamposImoveis();
        $('#btnRemImovel').button('disable');
    });
    
    /*
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS SEMOVENTES
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS SEMOVENTES
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS SEMOVENTES
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS SEMOVENTES
    */
    // Percorre o grid e cria um JSON para inserir no banco de dados
    function getDadosSemoventesGrid(){
        var rows = $dgSemovente.datagrid('getRows');
        var txtReg = '[';
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var varUnitario = rows[i].cells[18].innerHTML.split('.').join('');
            varUnitario = varUnitario.replace(',','.');
            var varTotal = rows[i].cells[19].innerHTML.split('.').join('');
            varTotal = varTotal.replace(',','.');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'id': rows[i].cells[0].innerHTML,
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'especie': rows[i].cells[1].innerHTML,
                            'quantidade': rows[i].cells[3].innerHTML,	
                            'finalidade': rows[i].cells[4].innerHTML,
                            'raca': rows[i].cells[6].innerHTML,
                            'pelagem': rows[i].cells[8].innerHTML,
                            'graumesticagem': rows[i].cells[9].innerHTML,
                            'idade': rows[i].cells[10].innerHTML,
                            'gravame': rows[i].cells[11].innerHTML,
                            'seguro': rows[i].cells[13].innerHTML,
                            'sitpropriedade': rows[i].cells[15].innerHTML,
                            'part': rows[i].cells[17].innerHTML,
                            'valorunitario': varUnitario,
                            'valortotal': varTotal,
                            'imovel': rows[i].cells[20].innerHTML,
                            'tipoimovel': rows[i].cells[21].innerHTML
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosSemoventes').val(txtReg);
    };  
  
    // Função responsável pelo carregamento do grid
    var semoventeSelecionado = null;
    var linhaGridSemovente = null;
    var $dgSemovente = $('#gridSemovente');
    function gridSemoventeLoad(){
        $dgSemovente.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadCliente/dadosGridSemovente?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height:250,
            mapper:
            [
                {name: 'id', title: 'ID', width: '30px', align: 'center'},            
                {name: 'especie', hidden: 'hidden'},
                {name: 'especieDesc', title: 'Espécie', width: '170px', align: 'left'},
                {name: 'quantidade', title: 'Qtd.',width: '50px', align: 'center'},
                {name: 'finalidade', hidden: 'hidden'},
                {name: 'finalidadeDesc', title: 'Finalidade', width: '250px', align: 'left'},
                {name: 'raca', hidden: 'hidden'},
                {name: 'racaDesc', title: 'Raça', width: '200px', align: 'left'},
                {name: 'pelagem', title: 'Pelagem', width: '150px', align: 'left'},
                {name: 'graumesticagem', title: 'Mest.', width: '50px', align: 'center'},
                {name: 'idade', title: 'Idade', width: '50px', align: 'center'},
                {name: 'gravame', hidden: 'hidden'},
                {name: 'gravameDesc', title: 'Gravame', width: '70px', align: 'center'},
                {name: 'seguro', hidden: 'hidden'},
                {name: 'seguroDesc', title: 'Seguro', width: '50px', align: 'center'},
                {name: 'sitpropriedade', hidden: 'hidden'},
                {name: 'sitpropriedadeDesc', title: 'Situação', width: '90px', align: 'center'},
                {name: 'part', title: 'Part(%)', width: '60px', align: 'center'},
                {name: 'valorunitario', title: 'Valor Uni.', width: '90px', align: 'center'},
                {name: 'valortotal', title: 'Valor Total', width: '90px', align: 'center'},
                {name: 'imovel', hidden: 'hidden'},
                {name: 'tipoimovel', hidden: 'hidden'},
                {name: 'matricula', title: 'Matrícula', width: '50px', align: 'center'}
            ],
            eventController: {
                onClickRow: function(tr){
                    // Verifica se possui alguma linha selecionada e marca qual linha foi
                    // Para poder remover ou substituir
                    $(this).datagrid('clearSelectedRows');
                    // Se foi selecionada alguma linha, atribui aos campos do formulário
                    if(semoventeSelecionado !== tr.cells[0].innerHTML){
                        $(this).datagrid('selectRow',tr);
                        semoventeSelecionado = tr.cells[0].innerHTML;
                        $('#btnRemSemovente').button('enable');
                        $('#especieSemovente').val(tr.cells[1].innerHTML);
                        // Atualiza as raças selecionadas
                        racaSelecionada = tr.cells[6].innerHTML;
                        $('#especieSemovente').change();
                        $('#quantidade').val(tr.cells[3].innerHTML);
                        $('#finalidade').val(tr.cells[4].innerHTML);
                        $('#raca').val(tr.cells[6].innerHTML);
                        $('#pelagem').val(tr.cells[8].innerHTML);
                        $('#graumesticagem').val(tr.cells[9].innerHTML);
                        $('#idade').val(tr.cells[10].innerHTML);
                        $('#gravameSemovente').val(tr.cells[11].innerHTML);
                        $('#seguroSemovente').val(tr.cells[13].innerHTML);
                        $('#sitpropriedadeSemovente').val(tr.cells[15].innerHTML);
                        $('#partSemovente').val(tr.cells[17].innerHTML);
                        $('#valorunitario').val(tr.cells[18].innerHTML);
                        $('#valortotalSemovente').val(tr.cells[19].innerHTML);
                        $('#imovelSemovente').val(tr.cells[20].innerHTML);
                        $('#tipoimovelSemovente').val(tr.cells[21].innerHTML);
                        $('#matriculaSemovente').val(tr.cells[22].innerHTML);
                        linhaGridSemovente = tr;
                        $('#btnAddSemovente').html(spamEdit);
                    }else{
                        semoventeSelecionado = null;
                        racaSelecionada = '';
                        linhaGridSemovente = null;
                        limparCamposSemovente();
                        $('#btnRemSemovente').button('disable');
                    }
                }
            }
        });
    };
    gridSemoventeLoad();
    
    // Botões Grid
    $('#btnAddSemovente').click(function(event){
        event.preventDefault();
        if(validarCamposDiv('#abaSemoventes')){
            var id;
            // Verifica se algum semovente do grid está selecionado
            if(semoventeSelecionado !== null){
                linhaGridSemovente.cells[1].innerHTML  = $('#especieSemovente').val();
                linhaGridSemovente.cells[2].innerHTML  = $('#especieSemovente option:selected').text();
                linhaGridSemovente.cells[3].innerHTML  = $('#quantidade').val();
                linhaGridSemovente.cells[4].innerHTML  = $('#finalidade').val();
                linhaGridSemovente.cells[5].innerHTML  = $('#finalidade option:selected').text();
                linhaGridSemovente.cells[6].innerHTML  = $('#raca').val();
                linhaGridSemovente.cells[7].innerHTML  = $('#raca option:selected').text();
                linhaGridSemovente.cells[8].innerHTML  = $('#pelagem').val();
                linhaGridSemovente.cells[9].innerHTML  = $('#graumesticagem').val();
                linhaGridSemovente.cells[10].innerHTML  = $('#idade').val();
                linhaGridSemovente.cells[11].innerHTML = $('#gravameSemovente').val();
                linhaGridSemovente.cells[12].innerHTML = $('#gravameSemovente option:selected').text();
                linhaGridSemovente.cells[13].innerHTML = $('#seguroSemovente').val();
                linhaGridSemovente.cells[14].innerHTML = $('#seguroSemovente option:selected').text();
                linhaGridSemovente.cells[15].innerHTML = $('#sitpropriedadeSemovente').val();
                linhaGridSemovente.cells[16].innerHTML = $('#sitpropriedadeSemovente option:selected').text();
                linhaGridSemovente.cells[17].innerHTML = $('#partSemovente').val();
                linhaGridSemovente.cells[18].innerHTML = $('#valorunitario').val();
                linhaGridSemovente.cells[19].innerHTML = $('#valortotalSemovente').val();
                linhaGridSemovente.cells[20].innerHTML = $('#imovelSemovente').val();
                linhaGridSemovente.cells[21].innerHTML = $('#tipoimovelSemovente').val();
                linhaGridSemovente.cells[22].innerHTML = $('#matriculaSemovente').val();
                linhaGridSemovente = null;
                semoventeSelecionado = null;
            }else{
                // Controle do id, se for não for a primeira linha coloca 0, se não coloca 1
                var linha = $dgSemovente.datagrid('getRowCount');
                if(linha!=0){
                    var row = $dgSemovente.datagrid('getRow',linha-1);
                    id = parseInt(row.cells[0].innerHTML)+1;
                }else id = 1;
                
                var obJson = {
                    'id':id,
                    'especie': $('#especieSemovente').val(),
                    'especieDesc': $('#especieSemovente option:selected').text(),
                    'quantidade': $('#quantidade').val(),
                    'finalidade': $('#finalidade').val(),
                    'finalidadeDesc': $('#finalidade option:selected').text(),
                    'raca': $('#raca').val(),
                    'racaDesc': $('#raca option:selected').text(),
                    'pelagem': $('#pelagem').val(),
                    'graumesticagem': $('#graumesticagem').val(),
                    'idade': $('#idade').val(),
                    'gravame': $('#gravameSemovente').val(),
                    'gravameDesc': $('#gravameSemovente option:selected').text(),
                    'seguro': $('#seguroSemovente').val(),
                    'seguroDesc': $('#seguroSemovente option:selected').text(),
                    'sitpropriedade': $('#sitpropriedadeSemovente').val(),
                    'sitpropriedadeDesc': $('#sitpropriedadeSemovente option:selected').text(),
                    'part': $('#partSemovente').val(),
                    'valorunitario': $('#valorunitario').val(),
                    'valortotal': $('#valortotalSemovente').val(),
                    'imovel': $('#imovelSemovente').val(),
                    'tipoimovel': $('#tipoimovelSemovente').val(),
                    'matricula': $('#matriculaSemovente').val()
                };
                $dgSemovente.datagrid('addRow', [obJson]);
            }
            $dgSemovente.datagrid('clearSelectedRows');
            limparCamposSemovente();  
            $('#btnRemSemovente').button('disable');
        }
    });
    
    $('#btnRemSemovente').click(function(event){
        event.preventDefault();
        linhaGridSemovente.remove();
        semoventeSelecionado = null;
        limparCamposSemovente();
        $('#btnRemSemovente').button('disable');
    });
    
    /*
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS BENS MÓVEIS
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS BENS MÓVEIS
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS BENS MÓVEIS
    * INICIO DAS FUNÇÕES RESPONSÁVEIS PELO GRID DOS BENS MÓVEIS
    */
    // Percorre o grid e cria um JSON para inserir no banco de dados
    function getDadosMovelGrid(){
        var rows = $dgMovel.datagrid('getRows');
        var txtReg = '[';
        for(i=0;i<rows.length;i++){
            // Limpa os valores pois o campo é float
            var varTotal = rows[i].cells[16].innerHTML.split('.').join('');
            varTotal = varTotal.replace(',','.');
            // Cria o JSON o JSON
            txtReg +=  JSON.stringify({
                            'empresa': empresa,
                            'id': rows[i].cells[0].innerHTML,
                            'cpfcnpj': $('#cpfcnpj').val().replace(/[^\d]+/g,''),
                            'especie': rows[i].cells[1].innerHTML,
                            'fabricante': rows[i].cells[3].innerHTML,	
                            'modelo': rows[i].cells[4].innerHTML,
                            'anomodelo': rows[i].cells[5].innerHTML,
                            'sitpropriedade': rows[i].cells[6].innerHTML,
                            'gravame': rows[i].cells[8].innerHTML,
                            'seriechassi': rows[i].cells[10].innerHTML,
                            'potencia': rows[i].cells[11].innerHTML,
                            'potenciatipo': rows[i].cells[12].innerHTML,
                            'estadoconservacao': rows[i].cells[13].innerHTML,
                            'part': rows[i].cells[15].innerHTML,
                            'valor': varTotal,
                            'imovel': rows[i].cells[17].innerHTML,
                            'tipoimovel': rows[i].cells[18].innerHTML
                        }); 
            txtReg += ',';
        }
        // Retira a ultima vírgula
        txtReg = txtReg.substring(0,(txtReg.length - 1));
        txtReg += ']';
        $('#dadosMoveis').val(txtReg);
    };    
    
    // Função responsável pelo carregamento do grid
    var movelSelecionado = null;
    var linhaGridMovel = null;
    var $dgMovel = $('#gridMoveis');
    function gridMovelLoad(){
        $dgMovel.datagrid({
            jsonStore: {
                url:' <?php echo base_url('cadCliente/dadosGridMovel?') ?>' + 'cpfcnpj=' + $('#cpfcnpj').val()
            },
            pagination: false,
            height:250,
            mapper:
            [
                {name: 'id', title: 'ID', width: '30px', align: 'center'},            
                {name: 'especie', hidden: 'hidden'},
                {name: 'especieDesc', title: 'Espécie', width: '170px', align: 'left'},
                {name: 'fabricante', title: 'Fabricante',width: '100px', align: 'left'},
                {name: 'modelo', title: 'Modelo',width: '100px', align: 'left'},
                {name: 'anomodelo', title: 'Ano', width: '50px', align: 'center'},
                {name: 'sitpropriedade', hidden: 'hidden'},
                {name: 'sitpropriedadeDesc', title: 'Situação', width: '90px', align: 'center'},
                {name: 'gravame', hidden: 'hidden'},
                {name: 'gravameDesc', title: 'Gravame', width: '70px', align: 'center'},
                {name: 'seriechassi', title: 'Série/Chassi', width: '90px', align: 'left'},
                {name: 'potencia', title: 'Potência', width: '60px', align: 'center'},
                {name: 'potenciatipo', title: 'Tipo', width: '40px', align: 'center'},
                {name: 'estadoconservacao', hidden: 'hidden'},
                {name: 'estadoconservacaoDesc', title: 'Conservação', width: '85px', align: 'center'},
                {name: 'part', title: 'Part(%)', width: '60px', align: 'center'},
                {name: 'valor', title: 'Valor', width: '90px', align: 'center'},
                {name: 'imovel', hidden: 'hidden'},
                {name: 'tipoimovel', hidden: 'hidden'},
                {name: 'matricula', title: 'Matrícula', width: '50px', align: 'center'}
            ],
            eventController: {
                onClickRow: function(tr){
                    // Verifica se possui alguma linha selecionada e marca qual linha foi
                    // Para poder remover ou substituir
                    $(this).datagrid('clearSelectedRows');
                    // Se foi selecionada alguma linha, atribui aos campos do formulário
                    if(movelSelecionado !== tr.cells[0].innerHTML){
                        $(this).datagrid('selectRow',tr);
                        movelSelecionado = tr.cells[0].innerHTML;
                        $('#btnRemMovel').button('enable');
                        $('#especieMovel').val(tr.cells[1].innerHTML);
                        $('#fabricante').val(tr.cells[3].innerHTML);
                        $('#modelo').val(tr.cells[4].innerHTML);
                        $('#anomodelo').val(tr.cells[5].innerHTML);
                        $('#sitpropriedadeMovel').val(tr.cells[6].innerHTML);
                        $('#gravameMovel').val(tr.cells[8].innerHTML);
                        $('#seriechassi').val(tr.cells[10].innerHTML);
                        $('#potencia').val(tr.cells[11].innerHTML);
                        $('#potenciatipo').val(tr.cells[12].innerHTML);
                        $('#estadoconservacaoMovel').val(tr.cells[13].innerHTML);
                        $('#partMovel').val(tr.cells[15].innerHTML);
                        $('#valorMovel').val(tr.cells[16].innerHTML);
                        $('#imovelMovel').val(tr.cells[17].innerHTML);
                        $('#tipoimovelMovel').val(tr.cells[18].innerHTML);
                        $('#matriculaMovel').val(tr.cells[19].innerHTML);
                        linhaGridMovel = tr;
                        $('#btnAddMovel').html(spamEdit);
                    }else{
                        movelSelecionado = null;
                        linhaGridMovel = null;
                        limparCamposMovel();
                        $('#btnRemMovel').button('disable');
                    }
                }
            }
        });
    };
    gridMovelLoad();
    
    // Botões Grid
    $('#btnAddMovel').click(function(event){
        event.preventDefault();
        if(validarCamposDiv('#abaMoveis')){
            var id;
            // Verifica se algum semovente do grid está selecionado
            if(movelSelecionado !== null){
                linhaGridMovel.cells[1].innerHTML  = $('#especieMovel').val();
                linhaGridMovel.cells[2].innerHTML  = $('#especieMovel option:selected').text();
                linhaGridMovel.cells[3].innerHTML  = $('#fabricante').val();
                linhaGridMovel.cells[4].innerHTML  = $('#modelo').val();
                linhaGridMovel.cells[5].innerHTML  = $('#anomodelo').val();
                linhaGridMovel.cells[6].innerHTML  = $('#sitpropriedadeMovel').val();
                linhaGridMovel.cells[7].innerHTML  = $('#sitpropriedadeMovel option:selected').text();
                linhaGridMovel.cells[8].innerHTML  = $('#gravameMovel').val();
                linhaGridMovel.cells[9].innerHTML  = $('#gravameMovel option:selected').text();
                linhaGridMovel.cells[10].innerHTML = $('#seriechassi').val();
                linhaGridMovel.cells[11].innerHTML = $('#potencia').val();
                linhaGridMovel.cells[12].innerHTML = $('#potenciatipo').val();
                linhaGridMovel.cells[13].innerHTML = $('#estadoconservacaoMovel').val();
                linhaGridMovel.cells[14].innerHTML = $('#estadoconservacaoMovel option:selected').text();
                linhaGridMovel.cells[15].innerHTML = $('#partMovel').val();
                linhaGridMovel.cells[16].innerHTML = $('#valorMovel').val();
                linhaGridMovel.cells[17].innerHTML = $('#imovelMovel').val();
                linhaGridMovel.cells[18].innerHTML = $('#tipoimovelMovel').val();
                linhaGridMovel.cells[19].innerHTML = $('#matriculaMovel').val();
                linhaGridMovel = null;
                movelSelecionado = null;
            }else{
                // Controle do id, se for não for a primeira linha coloca 0, se não coloca 1
                var linha = $dgMovel.datagrid('getRowCount');
                if(linha!=0){
                    var row = $dgMovel.datagrid('getRow',linha-1);
                    id = parseInt(row.cells[0].innerHTML)+1;
                }else id = 1;
                
                var obJson = {
                        'id':id,
                        'especie': $('#especieMovel').val(),
                        'especieDesc': $('#especieMovel option:selected').text(),
                        'fabricante': $('#fabricante').val(),
                        'modelo': $('#modelo').val(),
                        'anomodelo': $('#anomodelo').val(),
                        'sitpropriedade': $('#sitpropriedadeMovel').val(),
                        'sitpropriedadeDesc': $('#sitpropriedadeMovel option:selected').text(),
                        'gravame': $('#gravameMovel').val(),
                        'gravameDesc': $('#gravameMovel option:selected').text(),
                        'seriechassi': $('#seriechassi').val(),
                        'potencia': $('#potencia').val(),
                        'potenciatipo': $('#potenciatipo').val(),
                        'estadoconservacao': $('#estadoconservacaoMovel').val(),
                        'estadoconservacaoDesc': $('#estadoconservacaoMovel option:selected').text(),
                        'part': $('#partMovel').val(),
                        'valor': $('#valorMovel').val(),
                        'imovel': $('#imovelMovel').val(),
                        'tipoimovel': $('#tipoimovelMovel').val(),
                        'matricula': $('#matriculaMovel').val()
                };
                $dgMovel.datagrid('addRow', [obJson], id);
            }
            $dgMovel.datagrid('clearSelectedRows');
            limparCamposMovel();        
            $('#btnRemMovel').button('disable');
        }
    });
    
    $('#btnRemMovel').click(function(event){
        event.preventDefault();
        linhaGridMovel.remove();
        movelSelecionado = null;
        limparCamposMovel();
        $('#btnRemMovel').button('disable');
    });
    
    /*
    * FIM DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S
    * FIM DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S
    * FIM DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S
    * FIM DAS FUNÇÕES RESPONSÁVEIS PELOS GRID'S
    */
    // Ação dos Botões
    $('#btnIncluir').click(function(){
        getDadosImoveisGrid();
        getDadosSemoventesGrid();
        getDadosMovelGrid();
        $('#frmCadCliente').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadCliente/incluir') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmCadCliente').submit();
    });
    
    $('#btnAlterar').click(function(){
        getDadosImoveisGrid();
        getDadosSemoventesGrid();
        getDadosMovelGrid();
        $('#frmCadCliente').ajaxForm({
            clearForm: true,
            beforeSubmit: validaForm,
            success: showResponse,
            url: '<?php echo base_url('CadCliente/alterar') ?>',
            type:'post',
            dataType : 'json'
        });
        $('#frmCadCliente').submit();
    });
    
    $('#btnExcluir').click(function(){
        $('#frmCadCliente').ajaxForm({
            clearForm: true,
            success:  showResponse,
            url: '<?php echo base_url('CadCliente/excluir') ?>',
            type:'post',
            dataType : 'json'
        }); 
        $('#frmCadCliente').submit();
    });

    $('#btnFechar').click(function(){
        $('#janelaPrincipal').dialog('close');
    });
    
    $('#btnCancelar').click(function(){
        limparForm();
    });
    
    function limparForm(){
        $('#cpfcnpj').val(''); 
        $('#frmCadCliente').resetForm();
        limparCamposImoveis();
        limparCamposSemovente();
        limparCamposMovel();
        $('input[type=radio][name=rdTipoCliente]').change();
        $('#municipio').val('');
        $('#municipio').attr('disabled','disabled');
        $('#municipioImovel').val('');
        $('#municipioImovel').attr('disabled','disabled');
        desabilitaBotoes();
        gridRuraisLoad();
        gridUrbanosLoad();
        gridSemoventeLoad();
        gridMovelLoad();
        $('#tipoimovel').change();
        $('#aba1').click();
        $('#accordionRurais').click();
        $('#cpfcnpj').focus();
        $('.required').css('background-color','#fff');
    };

    function limparCamposImoveis(){
        $('#btnAddImovel').html(spamAdd);
        // Linhas em comum para os tipos de imóvel
        $('#nomeImovel').val('');
        $('#especieImovel').val('1');
        $('#matriculaImovel').val('');
        $('#registro').val('');
        $('#partImovel').val('');
        $('#sitpropriedadeImovel').val('1');
        $('#estadoconservacaoImovel').val('1');
        $('#gravameImovel').val('1');
        $('#cepImovel').val('');
        $('#enderecoImovel').val('');
        $('#nroenderecoImovel').val('');
        $('#bairroImovel').val('');
        $('#ufImovel').val('');
        $('#ufImovel').val('');
        $('#municipioImovel').val('');
        $('#municipioImovel').attr('disabled','disabled');
        // Rurais
        $('#ccir').val('');
        $('#nirf').val('');
        $('#latitude').val('-');
        $('#longitude').val('-');
        $('#cessaoterceiros').val('0');
        $('#areatotal').val('');
        $('#valorhectare').val('');
        $('#valorterranua').val('');
        $('#exploradoAgricola').val('');
        $('#exploradoPecuaria').val('');      
        // Urbanos
        $('#areaterreno').val('');
        $('#areaconstruida').val('');
        $('#valortotalImovel').val('');
        $('.required').css('background-color','#fff');
    };
    
    function limparCamposSemovente(){
        $('#btnAddSemovente').html(spamAdd);
        $('#especieSemovente').val('1');
        $('#quantidade').val('');
        $('#finalidade').val('1');
        $('#raca').val('1');
        $('#pelagem').val('');
        $('#graumesticagem').val('');
        $('#idade').val('');
        $('#gravameSemovente').val('1');
        $('#seguroSemovente').val('0');
        $('#sitpropriedadeSemovente').val('1');
        $('#partSemovente').val('');
        $('#valorunitario').val('');
        $('#valortotalSemovente').val('');
        $('#imovelSemovente').val('');
        $('#tipoimovelSemovente').val('');
        $('#matriculaSemovente').val('');
        $('.required').css('background-color','#fff');
    };
    
    function limparCamposMovel(){
        $('#btnAddMovel').html(spamAdd);
        $('#especieMovel').val('1');
        $('#fabricante').val('');
        $('#modelo').val('');
        $('#anomodelo').val('');
        $('#sitpropriedadeMovel').val('1');
        $('#gravameMovel').val('1');
        $('#seriechassi').val('');
        $('#potencia').val('');
        $('#potenciatipo').val('CV');
        $('#estadoconservacaoMovel').val('1');
        $('#partMovel').val('');
        $('#valorMovel').val('');
        $('#imovelMovel').val('');
        $('#tipoimovelMovel').val('');
        $('#matriculaMovel').val('');
        $('.required').css('background-color','#fff');
    };
    
    var cpfcnpjAnterior = '';    
    function cpfcnpjBlur(){
        municipioDescSelecionado = '';
        municipioIDSelecionado = '';
        if(cpfcnpjAnterior !== $('#cpfcnpj').val().replace(/[^\d]+/g,'') && !($('#rdCNPJ').is(':checked') && $('#cpfcnpj').val().replace(/[^\d]+/g,'').length < 14) ){           
            if(validarCPFCNPJ($('#cpfcnpj').val())){
                $.post('<?php echo base_url('CadCliente/buscaRegistro') ?>',{
                    cpfcnpj : $('#cpfcnpj').val()
                }, function(data){
                    $('#nome').val(data.nome);
                    $('#rg').val(data.rg);
                    $('#cep').val(data.cep);
                    $('#endereco').val(data.endereco);
                    $('#nroendereco').val(data.nroendereco);
                    $('#complemento').val(data.complemento);
                    $('#bairro').val(data.bairro);
                    municipioIDSelecionado = data.municipio;
                    $('#estado').val(data.uf);
                    $('#estado').change();
                    $('#fone1').val(data.fone1);
                    $('#fone2').val(data.fone2);
                    $('#email').val(data.email);
                    $('#nomeconjuge').val(data.nomeconjuge);
                    $('#rgconjuge').val(data.rgconjuge);
                    $('#cpfconjuge').val(data.cpfconjuge);
                    $('#agencia').val(data.agencia);
                    $('#nomeAgencia').val(data.nomeAgencia);
                    $('#prefixoAgencia').val(data.prefixoAgencia);
                    $('#conta').val(data.conta);
                    gridSemoventeLoad();
                    gridRuraisLoad();
                    gridUrbanosLoad();
                    gridMovelLoad();
                    (data.btnIncluir !== true) ? $('#btnIncluir').attr('disabled', 'disabled') : $('#btnIncluir').removeAttr('disabled');
                    (data.btnAlterar !== true) ? $('#btnAlterar').attr('disabled', 'disabled') : $('#btnAlterar').removeAttr('disabled');
                    (data.btnExcluir !== true) ? $('#btnExcluir').attr('disabled', 'disabled') : $('#btnExcluir').removeAttr('disabled');
                },'json');
            }else{
                $('#msgAlerta').html('CPF ou CNPJ Inválido');
                $('#alertMessage').dialog('open');
                desabilitaBotoes();
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
    
    function cpfconjugeBlur(){
        if(!validarCPFCNPJ($('#cpfconjuge').val()) && $('#cpfconjuge').val().replace(/[^\d]+/g,'') != ''){
            $('#msgAlerta').html('CPF do Cônjuge Inválido');
            $('#alertMessage').dialog('open');
            $('#cpfconjuge').val('');
        }
    }
    $('#cpfconjuge').blur(cpfconjugeBlur);
    
    function calcularValorTotalSemoventes(){
        var unitario = $('#valorunitario').val().split('.').join('');
        unitario = unitario.replace(',','.');
        if(parseInt($('#quantidade').val()) > 0){
            var total = parseFloat(unitario) * parseFloat($('#quantidade').val());
            $('#valortotalSemovente').val(total.toString().replace('.',','));
            $('#valortotalSemovente').blur();
        }
    };
    $('#quantidade').blur(calcularValorTotalSemoventes);
    $('#valorunitario').blur(calcularValorTotalSemoventes);
    
});
</script>