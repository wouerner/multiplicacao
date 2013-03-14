<?php
include("modulos/seguranca/ACL/assets/php/database.php"); 
use \seguranca\modelo\acl;

$acesso = new acl($_SESSION['usuario_id']);

$usuario = explode (' ',$_SESSION['usuario_nome']) ;
$usuario = $usuario[0] ;

?>

<div class="navbar ">
  <div class="navbar-inner ">
    <div class="">

      <a class="brand" href="/painel/painel">MGA</a>
        <ul class="nav" role="navigation">

					<li class="divider-vertical"></li>

								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
								<li><a href = "/aviso/aviso" ><i class = "icon-plus " ></i>Avisos</a></li>
								<li class = "dropdown">
									<a href = "#" class="dropdown-toggle" data-toggle="dropdown" role = "button">Rede<b class="caret"></b></a>
									<ul class="dropdown-menu">	
										<li><a href = "/rede/rede/novoTipoRede"><i class = "icon-plus " ></i > Nova</a></li>
										<li><a href = "/rede/rede/listarTipoRede"><i class = "icon-list-alt " ></i> Listar</a></li>
										<li class="divider"></li>
										<li><a href = "/rede/rede/novaFuncaoRede" >Nova Função</a></li>
										<li><a href = "/rede/rede/listarFuncaoRede" >Listar Função</a></li>
									</ul>
								</li>
								<?php endif ; ?>

					<li class = "dropdown" >
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role = "button" >Discipulo<b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" >
								<?php if ($acesso->hasPermission('discipulo_criar') == true): ?>
								<li><a href = "/discipulo/discipulo/novoCompleto" ><i class = "icon-plus " ></i> Novo</a></li>
								<?php endif ; ?>
								<li class = "dropdown-submenu" role = "presentation">
									<a href = "/discipulo/discipulo" role="menuitem" ><i class = "icon-list-alt " ></i> Listar</a>

								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
									<ul class="dropdown-menu">	
										<li><a href = "/discipulo/discipulo/inativos" ><i class = "icon-arrow-down" ></i>Inativos</a></li>
									</ul>
								<?php endif ; ?>

								</li>

								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
								<li><a href = "/discipulo/discipulo/rank" role="menuitem" ><i class = "icon-list-alt " ></i> Rank Ativos</a>
								<li><a href = "/discipulo/discipulo/rankInativos" role="menuitem" ><i class = "icon-list-alt " ></i> Rank Inativos</a>
								<li><a href = "/discipulo/discipulo/chamar" ><i class = "icon-search " ></i> Pesquisar</a></li>

										<li class="divider"></li>
								<li class="dropdown-submenu">
									<a href = "#" class="dropdown-toggle" data-toggle="dropdown">StatusCelular</a>
									<ul class="dropdown-menu">	
										<li><a href = "/statusCelular/statusCelular/novoTipoStatusCelular">Novo</a></li>
										<li><a href = "/statusCelular/statusCelular/listarTipoStatusCelular" >Lista</a></li>
									</ul>
								</li>
								</li>

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
					<li class = "dropdown"><a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = "" ></i> Célula<b class="caret"></b></a>
						<ul  class="dropdown-menu">	
								<li><a href = "/celula/celula" ><i class = "icon-list " ></i> Listar</a></li>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
								<li><a href = "/celula/celula/novo" ><i class = "icon-plus " ></i> Nova</a></li>
								<li><a href = "/celula/celula/lideresCelula" >Líderes de Célula</a></li>
								<li><a href = "/celula/celula/chamar">Pesquisar</a></li>

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
						<a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = " " ></i> Relatorios<b class="caret"></b></a>
						<ul class = "dropdown-menu" >	
								<li><a href = "/relatorio/relatorio/relatorioResumido" >Resumido</a></li>
								<li><a href = "/discipulo/discipulo/fichaPorStatus/id/8" >Ficha Encontro</a></li>
								<li><a href = "/discipulo/discipulo/cracha/id/8" >Cracha</a></li>
								<li><a href = "/relatorio/relatorio/aniversariantes" ><i class = "icon-gift " ></i> Aniversariantes</a></li>

								<li class = "dropdown-submenu" >
									<a href = "#" ><i class = "" ></i>Relatorio de Célula</a>
									<ul class = "dropdown-menu" >
										<li><a href = "/relatorio/relatorio/relatorioCelulaEnvio" ><i class = "" ></i> Por Data</a></li>
										<li><a href="/relatorio/relatorio/relatorioCelulaEnvioPorTema">Por Tema</a></li>
									</ul>
								</li>
						</ul>
					</li>
<?php endif ; ?>

        </ul>

				<div class = "nav pull-right" >
					<li class = "dropdown" >
						<a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = "icon-user" ></i> <?php echo $usuario?>
						<b class="caret"></b></a>
						<ul class = "dropdown-menu" >	
						<li><a href="/seguranca/seguranca/trocarSenha/id/<?php echo $_SESSION['usuario_id']?>" class = "" ><i class = "icon-lock" ></i> trocar senha</a></li>
								<li><a href="/seguranca/seguranca/sair" class = "" ><i class = "icon-off" ></i> Sair</a></li>
						</ul>
					</li>
				</div>

      </div><!-- /.nav-collapse -->
    </div>
  </div><!-- /navbar-inner -->
</div>
