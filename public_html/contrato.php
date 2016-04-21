<?php if($s->getMetodo()=='form'){ ?>
        <form id="formulario" name="formulario" method="post" action="">
            <div class="box"> 
		<h1>Contratos</h1>
                <?=($s->getId()) ? "<label>Editando Contrato Cód.:{$s->getId()}</label>" : ''?>
                <?=($s->getAlerta()) ? $s->getAlerta() : ''?>
                <?=($s->getErro()) ? $s->getErro() : ''?>
                <label>
                    <a title="Listar contratos" href="?p=contrato&metodo=pesquisa"><button type="button">Pesquisar</button></a>
                    <a title="Novo contrato" href="?p=contrato"><button type="button">Novo</button></a>
                </label>
                <label>
                    <span class="prompt">Cliente:</span>
                    <select class="campo" name="id_cliente" id="id_cliente">
                        <?=$s->optionCliente()?>
                    </select>
                </label>
                <label>
                    <span class="prompt">Serviço:</span>
                    <select class="campo" name="id_servico" id="id_servico">
                        <?=$s->optionServico()?>
                    </select>
                </label>
                <label>
                    <span class="prompt">Início:</span>
                    <input class="campo" type="text" name="data_inicio" id="data_inicio" value="<?=$s->getData_inicio()?>" />
                </label>
                <label>
                    <span class="prompt">Término:</span>
                    <input class="campo" type="text" name="data_fim" id="data_fim" value="<?=$s->getData_fim()?>" />
                </label>
                <label>
                    <button type="button" onclick="envia('G')"><?=($s->getId())?'Atualizar':'Incluir'?></button>
                    <?=($s->getId())?"<button type=\"button\" onclick=\"envia('E')\">Excluir</button>":""?>
                </label>
            </div>
            <input type="hidden" name="id" id="id" value="<?=$s->getId()?>" />
            <input type="hidden" name="acao" id="acao" />
        </form>
<?php }elseif($s->getMetodo()=='pesquisa'){ ?>
            <div class="box list"> 
		<h1>Contratos</h1>
                <label>
                    <a title="Novo contrato" href="?p=contrato"><button type="button">Novo</button></a>
                    <a title="Lista Json" target="_blank" href="ws/json/contrato"><button type="button">Exportação Json</button></a>
                </label>
<?php   if($s->getLista()){ ?>
                <table>
                    <tr>
                        <th>Cód.</th>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th></th>
                    </tr>
<?php
            foreach($s->getLista() as $lista){
                $i++;
?>
                    <tr class="<?=($i%2==0)?'tr1':'tr2'?>">
                        <td><?=$lista["id"]?></td>
                        <td><?=$lista["cliente"]?></td>
                        <td><?=$lista["servico"]?></td>
                        <td><?=$lista["data_inicio"]?></td>
                        <td><?=$lista["data_fim"]?></td>
                        <td><a href="?p=contrato&id=<?=$lista["id"]?>"><button type="button">Editar</button></a></td>
                    </tr>
<?php       } ?>
<?php   } ?>
                </table>
            </div>
<?php } ?>
