    <ul class="nav nav-pills">
		<li class="<?php echo isset($ativo) ? $ativo : '' ; ?>">
			<a href = "/encontroComDeus/participantesEncontro/index/id/<?php echo $participante->encontroComDeusId ; ?>" >Encontro com Deus</a>
    </li>
		<li class="<?php echo isset($preEncontro) ? $preEncontro : '' ; ?>">
			<a href = "/encontroComDeus/participantesEncontro/preEncontro/id/<?php echo $participante->encontroComDeusId ; ?>" >Pré-Encontro</a>
    </li>
		<li class="<?php echo isset($encontro) ? $encontro : '' ; ?>">
			<a href = "/encontroComDeus/participantesEncontro/encontro/id/<?php echo $participante->encontroComDeusId ; ?>" >Encontro</a>
		<li class="<?php echo isset($posEncontro) ? $posEncontro : ''; ?>">
			<a href = "/encontroComDeus/participantesEncontro/posEncontro/id/<?php echo $participante->encontroComDeusId ; ?>" >Pos Encontro</a>
    </ul>
