<?php
use \seguranca\modelo\acl;

$acesso = new acl($_SESSION['usuario_id']);

$usuario = explode (' ',$_SESSION['usuario_nome']) ;
$usuario = $usuario[0] ;

?>

<div class="navbar ">
  <div class="navbar-inner ">

<a class="btn btn-navbar " data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>

                            <a class="brand" href="/painel/painel"> MGA</a>
<div class="nav-collapse collapse">
        <ul class="nav" role="navigation">
            <li class="divider-vertical"></li>

            <?php if ($acesso->hasPermission('aviso_acesso') == true): ?>
                <li><a href = "/aviso/aviso" ><i class = " icon-bullhorn " ></i></a></li>
            <?php endif ; ?>

            <?php if ($acesso->hasPermission('rede_acesso') == true): ?>
                <li class = "dropdown">
                    <a href = "#" class="dropdown-toggle" data-toggle="dropdown" role = "button">
                        <i class = "icon-flag" ></i> Rede <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($acesso->hasPermission('rede_criar') == true): ?>
                                <li><a href = "/rede/rede/novoTipoRede"><i class = "icon-plus " ></i > Nova</a></li>
                        <?php endif ; ?>
                                <li><a href = "/rede/rede/listarTipoRede"><i class = "icon-list-alt " ></i> Listar</a></li>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                <li class="divider"></li>
                                <li><a href = "/rede/rede/novaFuncaoRede" >Nova Função</a></li>
                                <li><a href = "/rede/rede/listarFuncaoRede" >Listar Função</a></li>
                        <?php endif ; ?>
                    </ul>
                </li>
            <?php endif ; ?>

            <li class = "dropdown">
                <a href = "#" class="dropdown-toggle" data-toggle="dropdown" role = "button">
                    <i class = "icon-screenshot" ></i> Metas<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href = "/metas/metas/detalhar/id/<?php echo $_SESSION['usuario_id']?>">
                            <i class = "icon-list-alt " ></i>Minhas metas
                        </a>
                    </li>
                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                        <li><a href = "/metas/metas"><i class = "icon-plus " ></i > Discipulos Com Metas</a></li>
                        <li><a href = "/metas/intervaloMetas/novo"><i class = "icon-plus " ></i > novo intervalo</a></li>
                        <li><a href = "/rede/rede/listarTipoRede"><i class = "icon-list-alt " ></i> Listar intervalo</a></li>
                    <?php endif ; ?>
                </ul>
            </li>

            <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                <li class="dropdown">
                    <a href = "#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class = "icon-tag" ></i>Status<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href = "/statusCelular/statusCelular/novoTipoStatusCelular">Novo</a></li>
                        <li><a href = "/statusCelular/statusCelular/listarTipoStatusCelular" >Lista</a></li>
                        <li><a href = "/celula/celula/statusPorLiderCelula" ><i class = " " ></i> Status Por Lider Célula</a></li>
                    </ul>
                </li>
            <?php endif ; ?>
            <?php if ($acesso->hasPermission('encontro') == true): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role = "button" >
                            <i class = "icon-fire " ></i>Encontro <b class="caret"></b>
                        </a>
                        <ul class="  dropdown-menu" role="menu" aria-labelledby="dLabel" >
                            <li><a href = "/encontroComDeus/encontroComDeus/novo" ><i class = "icon-plus " ></i> Novo</a></li>
                            <li><a href = "/encontroComDeus/encontroComDeus" ><i class = "icon-list-alt " ></i> Listar</a></li>
                            <li class="divider"></li>
                            <li><a href = "/encontroComDeus/tipoEquipe/novo" ><i class = "icon-plus " ></i> Novo Tipo de Equipe</a></li>
                            <li><a href = "/encontroComDeus/tipoEquipe" ><i class = "icon-list-alt " ></i> Lista Tipo de Equipe</a></li>
                        </ul>
                    </li>
            <?php endif ; ?>

                    <li class = "dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role = "button" >
                            <i class = "icon-user" ></i>Discipulo<b class="caret"></b>
                        </a>
                        <ul class="  dropdown-menu" role="menu" aria-labelledby="dLabel" >
                                <?php if ($acesso->hasPermission('discipulo_criar') == true): ?>
                                <li><a href = "/discipulo/discipulo/novoCompleto" ><i class = "icon-plus " ></i> Novo</a></li>
                                <?php endif ; ?>
                                <li class = "dropdown-submenu" role = "presentation">
                                    <a href = "#" role="menuitem" ><i class = "icon-list-alt " ></i> Listar</a>

                                    <ul class="dropdown-menu">
                                        <li><a href = "/discipulo/discipulo" ><i class = "icon-arrow-up" ></i>Ativos</a></li>
                                        <li><a href = "/discipulo/discipulo/inativos" ><i class = "icon-arrow-down" ></i>Inativos</a></li>
                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                        <li><a href = "/discipulo/discipulo/arquivo" ><i class = "icon-inbox" ></i> Arquivo</a></li>
                                <?php endif ; ?>
                                    </ul>

                                </li>

                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                <!--<li><a href = "/discipulo/discipulo/rank" role="menuitem" ><i class = "icon-list-alt " ></i> Rank Ativos</a>
                                <li><a href = "/discipulo/discipulo/rankInativos" role="menuitem" ><i class = "icon-list-alt " ></i> Rank Inativos</a>-->
                                <li><a href = "/discipulo/discipulo/chamar" ><i class = "icon-search " ></i> Pesquisar</a></li>

                                        <li class="divider"></li>

                                <li class = "dropdown-submenu">
                                    <a href = "/discipulo/discipulo/listarEstadoCivil" >Estado Civil</a>
                                    <ul class="dropdown-menu">
                                      <li><a href = "/discipulo/novoEstadoCivil" >Novo Estado Civil</a></li>
                                      <li><a href = "/discipulo/listarEstadoCivil" >Lista</a></li>
                                    </ul>
                                </li>

                                <li class = "dropdown-submenu"><a href = "/ministerio/listarMinisterio" >Ministério</a>
                                    <ul class="dropdown-menu">
                                        <li><a href = "/ministerio/novoMinisterio">Novo Ministério</a></li>
                                        <li><a href = "/ministerio/listarMinisterio">Listar Ministério</a></li>
                                        <li><a href = "/ministerio/novaFuncao" >Nova Função</a></li>
                                        <li><a href = "/ministerio/listarFuncao" >Listar Função</a></li>
                                    </ul>
                                </li>

                        <li class = "dropdown-submenu"><a href = "/admissao/listarTipoAdmissao" >Admissão</a>
                            <ul class="dropdown-menu">
                            <li><a href = "/admissao/novoTipoAdmissao">Novo</a></li>
                            <li><a href = "/admissao/listarTipoAdmissao" >Lista</a></li>
                            </ul>
                        </li>

                                <li class = "dropdown-submenu"><a href = "/evento" >Escala de Êxito</a>
                                    <ul class="dropdown-menu">
                                        <li><a href = "/evento/novo">Novo</a></li>
                                        <li><a href = "/evento" >Lista</a></li>
                                    </ul>
                                </li>
                                <?php endif ; ?>

            </li>
            </ul>
          </li>

<?php if ($acesso->hasPermission('celula_acesso') == true): ?>
                    <li class = "dropdown"><a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = "icon-home" ></i>Célula<b class="caret"></b></a>
                        <ul  class="dropdown-menu">
                                <li><a href = "/celula/celula" ><i class = "icon-list " ></i> Listar</a></li>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                <li><a href = "/celula/celula/novo" ><i class = "icon-plus " ></i> Nova</a></li>
                                <li><a href = "/celula/celula/lideresCelula" >Líderes e Discipulos</a></li>
                                <li><a href = "/celula/celula/chamar">Pesquisar</a></li>

                                <li><a href = "/celula/relatorio/lerPorTema" ><i class = "icon-plus " ></i> Ler Relatórios</a></li>
                                <li><a href = "/celula/relatorio/lerPorCelula" ><i class = " " ></i> Ler Relatórios Por Celula</a></li>
<?php endif ; ?>
                                <?php if ($acesso->hasPermission('celulaRelatorioAcesso') == true) : ?>
                                <li class = "dropdown-submenu" >
                                    <a href = "#" ><i class = "" ></i>Relatorio de Célula</a>
                                    <ul class = "dropdown-menu" >
                                        <li><a href = "/relatorio/relatorio/relatorioCelulaEnvio" ><i class = "" ></i> Por Data</a></li>
                                        <li><a href="/relatorio/relatorio/relatorioCelulaEnvioPorTema">Por Tema</a></li>
                                        <li><a href="/celula/relatorio/porMes">Por Mês</a></li>
                                    </ul>
                                </li>
                                <?php endif ; ?>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>

                                <li class = "dropdown-submenu" >
                                    <a class="" data-toggle="" href ="/celula/temaRelatorioCelula">Tema Relatório</a>
                                    <ul class = "dropdown-menu" >
                                        <li><a href = "/celula/temaRelatorioCelula/novo">Novo Tema</a></li>
                                    </ul>
                                </li>
<?php endif ; ?>

                            </ul>
                    </li>
<?php endif ; ?>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                    <li class = "dropdown" >
                        <a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = "icon-briefcase " ></i> Relatorios<b class="caret"></b></a>
                        <ul class = "dropdown-menu" >
                                <li><a href = "/relatorio/relatorio/relatorioResumido" >Dinamico</a></li>
                                <li><a href = "/celula/celula/lideresCelula" >Líderes e Discipulos</a></li>
                                <li><a href = "/relatorio/relatorio/aniversariantes" ><i class = "icon-gift " ></i> Aniversariantes</a></li>
                                <!--<li><a href = "/celula/celula/listarPorStatus" ><i class = " " ></i> Lider por Status</a></li>
                                <li><a href = "/celula/celula/listarPorStatusTodos" ><i class = " " ></i> Lider por Status Geral</a></li>
                                <li><a href = "/relatorio/relatorio/statusPorLider" ><i class = " " ></i> Status Por Lider</a></li>-->

                        </ul>
                    </li>
<?php endif ; ?>

        </ul>

                <div class = "nav pull-right" >
                    <li class="divider-vertical"></li>
                    <li class = "dropdown" >
                        <a href = "#" class="dropdown-toggle" data-toggle="dropdown"><strong><i>Oi</i>, <?php echo $usuario?></strong>
                        <b class="caret"></b></a>
                        <ul class = "dropdown-menu" >
                        <li><a href="/discipulo/discipulo/perfil/id/<?php echo $_SESSION['usuario_id']?>" class = "" ><i class = "icon-user" ></i> Perfil</a></li>
                        <li><a href="/discipulo/foto/novo/id/<?php echo $_SESSION['usuario_id']?>" class = "" ><i class = "icon-picture" ></i> Foto</a></li>
                        <li><a href="/seguranca/seguranca/trocarSenha/id/<?php echo $_SESSION['usuario_id']?>" class = "" ><i class = "icon-lock" ></i> trocar senha</a></li>
                                <li><a href="/seguranca/seguranca/sair" class = "" ><i class = "icon-off" ></i> Sair</a></li>
                        </ul>
                    </li>
                </div>
</div>
      </div><!-- /.nav-collapse -->
    </div>
  </div><!-- /navbar-inner -->
</div>
