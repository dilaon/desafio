<?php if($s->getMetodo()=='form'){ ?>
        <form id="formulario" name="formulario" method="post" action="">
            <div class="box"> 
		<h1>Serviços</h1>
                <?=($s->getId()) ? "<label>Editando Serviço Cód.:{$s->getId()} - {$s->getNome()}</label>" : ''?>
                <?=($s->getAlerta()) ? $s->getAlerta() : ''?>
                <?=($s->getErro()) ? $s->getErro() : ''?>
                <label>
                    <a title="Listar serviços" href="?p=servico&metodo=pesquisa"><button type="button">Pesquisar</button></a>
                    <a title="Novo serviço" href="?p=servico"><button type="button">Novo</button></a>
                </label>
                <label>
                    <span class="prompt">Nome:</span>
                    <input class="campo" type="text" name="nome" id="nome" value="<?=$s->getNome()?>" />
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
		<h1>Serviços</h1>
                <label>
                    <a title="Novo Serviço" href="?p=servico"><button type="button">Novo</button></a>
                </label>
<?php   if($s->getLista()){ ?>
                <table>
                    <tr>
                        <th>Cód.</th>
                        <th>Nome</th>
                        <th></th>
                    </tr>
<?php
            foreach($s->getLista() as $lista){
                $i++;
?>
                    <tr class="<?=($i%2==0)?'tr1':'tr2'?>">
                        <td><?=$lista["id"]?></td>
                        <td><?=$lista["nome"]?></td>
                        <td><a href="?p=servico&id=<?=$lista["id"]?>"><button type="button">Editar</button></a></td>
                    </tr>
<?php       } ?>
<?php   } ?>
                </table>
            </div>
<?php } ?>
