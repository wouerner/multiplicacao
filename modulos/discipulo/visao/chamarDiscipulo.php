<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
<div class = "row-fluid" >

<div class = "well" >
<div class = "span6" >
	<form action = "/discipulo/discipulo/chamar" method = "GET" class = " form-search" accept-charset = "UTF-8"  >
		<fieldset> 
			<div class = "" >
			<label id = "pesquisaLabel" class = "" for= "pesquisa" >Pesquisar:</label>
			
					<div class = "input-append" >
						<input id = "pesquisa" class = "input-xlarge" type = "search" name = "nome" size = "45" placeholder = "nome do discípulo">
						<button id = "butaoPesquisa" type = "submit" class = "btn btn-primary" type = "button" > <i class = "icon-search icon-white" ></i></button>
					</div>

			</div>
		</fieldset>
	</form>
</div>

<div class = "span6" >
	<form action = "/discipulo/discipulo/chamarPorId" method = "GET" class = " form-search" accept-charset = "UTF-8"  >
		<fieldset> 
			<label id = "pesquisaLabel" class = "" for= "pesquisa" >Pesquisar por ID:</label>
				<div class = "input-append" >
					<input id = "" class = "input-xlarge" type = "search" name = "id" size = "45" placeholder = "Identificação do discípulo">
					<button id = "butaoPesquisa" type = "submit" class = "btn btn-primary" type = "button" > <i class = "icon-search icon-white" ></i></button>
				</div>
		</fieldset>
	</form>
</div>

</div>
</div>
</div>
<?php endif ; ?>
