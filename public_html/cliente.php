<?php if($s->getMetodo()=='form'){ ?>
        <form id="formulario" name="formulario" method="post" action="">
            <div class="box"> 
		<h1>Clientes</h1>
                <?=($s->getId()) ? "<label>Editando Cliente Cód.:{$s->getId()} - {$s->getNome()}</label>" : ''?>
                <?=($s->getAlerta()) ? $s->getAlerta() : ''?>
                <?=($s->getErro()) ? $s->getErro() : ''?>
                <label>
                    <a title="Listar clientes" href="?p=cliente&metodo=pesquisa"><button type="button">Pesquisar</button></a>
                    <a title="Novo cliente" href="?p=cliente"><button type="button">Novo</button></a>
                </label>
                <label>
                    <span class="prompt">Nome:</span>
                    <input class="campo" type="text" name="nome" id="nome" value="<?=$s->getNome()?>" />
                </label>
                <label>
                    <span class="prompt">Sexo:</span>
                    <select class="campo" name="sexo" id="sexo">
                        <option value="M"<?=($s->getSexo()=='M')?' selected="selected"':''?>>Masculino</option>
                        <option value="F"<?=($s->getSexo()=='F')?' selected="selected"':''?>>Feminino</option>
                    </select>
                </label>
                <label>
                    <span class="prompt">CPF:</span>
                    <input class="campo" type="text" name="cpf" id="cpf" value="<?=$s->getCpf()?>" />
                </label>
                <label>
                    <span class="prompt">Telefone:</span>
                    <input class="campo" type="text" name="telefone" id="telefone" value="<?=$s->getTelefone()?>" />
                </label>
                <label>
                    <span class="prompt">Telefone Secundário:</span>
                    <input class="campo" type="text" name="telefone2" id="telefone2" value="<?=$s->getTelefone2()?>" />
                </label>
                <label>
                    <span class="prompt">CEP:</span>
                    <input class="campo" type="text" name="endereco_cep" id="endereco_cep" onchange="endereco()" value="<?=$s->getEndereco_cep()?>" />
                </label>
                <label>
                    <span class="prompt">Endereço:</span>
                    <div id="endereco">(Digite o CEP)</div>
                </label>
                <label>
                    <span class="prompt">N&ordm;:</span>
                    <input class="campo" type="text" name="endereco_numero" id="endereco_numero" value="<?=$s->getEndereco_numero()?>" />
                </label>
                <label>
                    <span class="prompt">Complemento:</span>
                    <input class="campo" type="text" name="endereco_complemento" id="endereco_complemento" value="<?=$s->getEndereco_complemento()?>" />
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
		<h1>Clientes</h1>
                <label>
                    <a title="Novo Cliente" href="?p=cliente"><button type="button">Novo</button></a>
                </label>
<?php   if($s->getLista()){ ?>
                <table>
                    <tr>
                        <th>Cód.</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th></th>
                    </tr>
<?php
            foreach($s->getLista() as $lista){
                $i++;
?>
                    <tr class="<?=($i%2==0)?'tr1':'tr2'?>">
                        <td><?=$lista["id"]?></td>
                        <td><?=$lista["nome"]?></td>
                        <td><?=$lista["cpf"]?></td>
                        <td><?=$lista["telefone"]?></td>
                        <td><a href="?p=cliente&id=<?=$lista["id"]?>"><button type="button">Editar</button></a></td>
                    </tr>
<?php       } ?>
<?php   } ?>
                </table>
            </div>
<?php } ?>
