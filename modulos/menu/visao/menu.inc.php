<div class = "row" >
<div class = "span12" >Olá <a href="/discipulo/detalhar/id/<?php echo $_SESSION['usuario_id'] ; ?>"><?php echo $_SESSION['usuario_nome'] ; ?></a> |
<a href="/seguranca/sair" class = "btn-mini btn-danger" >Sair</a>
</div>

<div class = "span12">
<ul id = "menu" >
	<li><a href = "/discipulo">Multiplicação</a></li>

	<li><a href = "#" >Discipulos</a>
		<ul >	
			<li><a href = "/discipulo/novo" >Criar</a></li>
			<li><a href = "/discipulo" >Igreja</a></li>
			<li><a href = "/discipulo/chamar" >Chamar</a></li>
		</ul>
	</li>
	<li><a href = "#" >Célula</a>
		<ul >	
			<li><a href = "/celula/novo" >Criar</a></li>
			<li><a href = "/celula" >Lista</a></li>
			<li><a href = "/celula/chamar">Chamar</a></li>
		</ul>
	</li>
	<li><a href = "#" >Eventos</a>
		<ul>	
			<li><a href = "/evento/novo">Novo</a></li>
			<li><a href = "/evento" >Lista</a></li>
		</ul>
	</li>
	<li><a href = "#" >Oferta</a>
		<ul>	
			<li><a href = "/oferta/novoTipoOferta">Novo</a></li>
			<li><a href = "/oferta/listarTipoOferta" >Lista</a></li>
		</ul>
	</li>
	<li><a href = "#" >Ministerio</a>
		<ul>	
			<li><a href = "/ministerio/novoMinisterio">Novo Ministerio</a></li>
			<li><a href = "/ministerio/listarMinisterio">Listar Ministerio</a></li>
			<li><a href = "/ministerio/novaFuncao" >Nova Fnção</a></li>
			<li><a href = "/ministerio/listarFuncao" >Listar Função</a></li>
		</ul>
	</li>
	<li><a href = "#" >StatusCelular</a>
		<ul>	
			<li><a href = "/statusCelular/novoTipoStatusCelular">Novo</a></li>
			<li><a href = "/statusCelular/listarTipoStatusCelular" >Lista</a></li>
		</ul>
	</li>
	<li><a href = "#" >Relatorios</a>
		<ul >	
			<li><a href = "/relatorio/discipulos" >Discipulos</a></li>
			<li><a href = "/relatorio/celulas">Celulas</a></li>
			<li><a href = "/relatorio/statusCelular">Status Celular</a></li>
			<li><a href = "/relatorio/statusCelularIndex">Status Celular Por Tipo</a></li>
		</ul>
	</li>
	
</ul>
</div>

</div>
