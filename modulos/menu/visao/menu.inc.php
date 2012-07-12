<div class = "row" >
<div class = "span12" >Olá <a href="/discipulo/detalhar/id/<?php echo $_SESSION['usuario_id'] ; ?>"><?php echo $_SESSION['usuario_nome'] ; ?></a> |
<a href="/seguranca/sair" class = "btn-mini btn-danger" >Sair</a>
</div>

<div class = "span12">
<ul id = "menu" >
	<li><a href = "#"><i class = "icon-home icon-white" ></i> MGA</a></li>

	<li><a href = "/discipulo/listarAtualizar" >Discípulos</a>

		<ul >	
			<!--<li><a href = "/discipulo/novo" >Criar</a></li>-->
			<li><a href = "/discipulo/novoCompleto" >Novo Discípulo</a></li>
			<li><a href = "/discipulo/listarAtualizar" >Listar Discípulos</a>
				<ul>	
					  <li><a href = "/discipulo/semCelula" >Sem Célula</a></li>
					  <li><a href = "/discipulo/semLider" >Sem Líder</a></li>
				</ul>
			</li>
			<!--<li><a href = "/discipulo" >Igreja</a></li>-->
			<li><a href = "/discipulo/chamar" >Pesquisar</a></li>
			<li>
				<a href = "/statusCelular/listarTipoStatusCelular" >StatusCelular</a>
				<ul>	
					<li><a href = "/statusCelular/novoTipoStatusCelular">Novo</a></li>
					<li><a href = "/statusCelular/listarTipoStatusCelular" >Lista</a></li>

				</ul>
			</li>
	</li>
			<li>
				<a href = "/discipulo/listarEstadoCivil" >Estado Civil</a>
				<ul>	
					  <li><a href = "/discipulo/novoEstadoCivil" >Novo Estado Civil</a></li>
					  <li><a href = "/discipulo/listarEstadoCivil" >Lista</a></li>
				</ul>
			</li>
		<li><a href = "/rede" >Rede</a>
			<ul>	
			<li><a href = "/rede/novoTipoRede">Nova Rede</a></li>
			<li><a href = "/rede/listarTipoRede">Listar Redes</a></li>
			<li><a href = "/rede/novaFuncaoRede" >Nova Função</a></li>
			<li><a href = "/rede/listarFuncaoRede" >Listar Função</a></li>
			</ul>
		</li>

		<li><a href = "/ministerio/listarMinisterio" >Ministério</a>
			<ul>	
			<li><a href = "/ministerio/novoMinisterio">Novo Ministério</a></li>
			<li><a href = "/ministerio/listarMinisterio">Listar Ministério</a></li>
			<li><a href = "/ministerio/novaFuncao" >Nova Função</a></li>
			<li><a href = "/ministerio/listarFuncao" >Listar Função</a></li>
			</ul>
		</li>

		<li><a href = "/evento" >Escala de Êxito</a>
			<ul>	
				<li><a href = "/evento/novo">Novo</a></li>
				<li><a href = "/evento" >Lista</a></li>
			</ul>
		</li>
		</ul>

	</li>

	<li><a href = "/celula" >Célula</a>
		<ul >	
			<li><a href = "/celula/novo" >Nova Célula</a></li>
			<li><a href = "/celula" >Lista Células</a></li>
			<li><a href = "/celula/lideresCelula" >Líderes de Célula</a></li>
			<li><a href = "/celula/chamar">Pesquisar</a></li>
		</ul>
	</li>
	<!--<li><a href = "/oferta/listarTipoOferta" >Oferta</a>
		<ul>	
			<li><a href = "/oferta/novoTipoOferta">Novo</a></li>
			<li><a href = "/oferta/listarTipoOferta" >Lista</a></li>
		</ul>
	</li>-->
	<li><a href = "#" >Relatorios</a>
		<ul >	

			<li><a href = "/relatorio/discipulos" >Discipulos</a>
				<ul>
					<li><a href = "/relatorio/liderComDiscipulos">Lider com Discipulos</a></li>
					<li><a href = "/relatorio/relatorioResumido">Discipulo Resumido</a></li>
				</ul>
			</li>

			<li><a href = "/relatorio/celulas">Celulas</a>
				<ul>	
					<li><a href = "/relatorio/graficoPorCelula">Gráfico de Status</a></li>
				</ul>
			</li>	
			<li><a href = "/relatorio/statusCelular">Status Celular</a>
				<ul>	
					<li><a href = "/relatorio/statusCelularIndex">Por Tipo</a></li>
				  	<li><a href = "/relatorio/graficoPorStatusCelular" >Gráfico</a></li>
				</ul>
			</li>
			<li><a href = "#">Escala de Exito</a>
				<ul>	
					<li><a href = "/relatorio/graficoPorEvento">Participação Escala Exito</a></li>
				</ul>
			</li>	
			<li><a href = "/discipulo/fichaPorStatus/id/8" >Ficha Encontro</a></li>
	
			<li><a href = "/relatorio/aniversariantes" >Aniversariantes</a></li>
				  </ul>
			</li>
		</ul>
	</li>
	
</ul>
</div>

</div>
