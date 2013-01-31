<?php
include("modulos/seguranca/ACL/assets/php/database.php"); 
use \seguranca\modelo\acl;

$acesso = new acl($_SESSION['usuario_id']);

$usuario = explode (' ',$_SESSION['usuario_nome']) ;
$usuario = $usuario[0] ;

?>

<div class="navbar navbar-static">
  <div class="navbar-inner ">
    <div class="">
      <a class="brand" href="/painel/painel">MGA</a>
        <ul class="nav" role="navigation">
					<li class="divider-vertical"></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Discipulo<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<ul>	
								<li><a href = "/discipulo/discipulo/listarAtualizar" ><i class = "icon-list-alt " ></i> Listar</a></li>
								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
								<li><a href = "/discipulo/discipulo/novoCompleto" ><i class = "icon-plus " ></i> Novo</a></li>
								<li><a href = "/discipulo/discipulo/chamar" ><i class = "icon-search " ></i> Pesquisar</a></li>

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
								
								<li class = "dropdown-submenu">
									<a href = "/rede/listarTipoRede" >Rede</a>
									<ul class="dropdown-menu">	
										<li><a href = "/rede/novoTipoRede">Nova Rede</a></li>
										<li><a href = "/rede/listarTipoRede">Listar Redes</a></li>
										<li><a href = "/rede/novaFuncaoRede" >Nova Função</a></li>
										<li><a href = "/rede/listarFuncaoRede" >Listar Função</a></li>
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
					</ul>

			</li>
            </ul>
          </li>

<?php if ($acesso->hasPermission('celula_acesso') == true): ?>
					<li class = "dropdown"><a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = "" ></i> Célula<b class="caret"></b></a>
						<ul  class="dropdown-menu">	
							<ul>
								<li><a href = "/celula/celula" ><i class = "icon-list " ></i> Listar</a></li>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
								<li><a href = "/celula/celula/novo" ><i class = "icon-plus " ></i> Nova</a></li>
								<li><a href = "/celula/celula/lideresCelula" >Líderes de Célula</a></li>
								<li><a href = "/celula/celula/chamar">Pesquisar</a></li>
<?php endif ; ?>

							</ul>
						</ul>
					</li>
<?php endif ; ?>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
					<li class = "dropdown" >
						<a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = " " ></i> Relatorios<b class="caret"></b></a>
						<ul class = "dropdown-menu" >	
							<ul>
								<li><a href = "/relatorio/relatorio/relatorioResumido" >Resumido</a></li>
								<li><a href = "/discipulo/discipulo/fichaPorStatus/id/8" >Ficha Encontro</a></li>
								<li><a href = "/discipulo/discipulo/cracha/id/8" >Cracha</a></li>
								<li><a href = "/relatorio/relatorio/aniversariantes" ><i class = "icon-gift " ></i> Aniversariantes</a></li>
								<li><a href = "/relatorio/relatorio/relatorioCelula" ><i class = "" ></i> Relatorio de Célula</a></li>
	  					</ul>
						</ul>
					</li>
<?php endif ; ?>

        </ul>

				<div class = "nav pull-right" >
					<li class = "dropdown" >
						<a href = "#" class="dropdown-toggle" data-toggle="dropdown"><i class = "icon-user" ></i> <?php echo $usuario?>
						<b class="caret"></b></a>
						<ul class = "dropdown-menu" >	
							<ul>
								<li><a href="/seguranca/seguranca/sair" class = "" ><i class = "icon-off" ></i> Sair</a></li>
	  					</ul>
						</ul>
					</li>
				</div>

      </div><!-- /.nav-collapse -->
    </div>
  </div><!-- /navbar-inner -->
</div>
