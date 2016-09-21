<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

<script>

jQuery(document).ready(function(){
    jQuery('#bu').on("click",function(e){
        //console('teste');
        e.preventDefault();
        pdf.save('Test.pdf');
        });


var pdf = new jsPDF('p', 'pt', 'letter')

, source = jQuery('#div')[0]

, specialElementHandlers = {
	// element with id of "bypass" - jQuery style selector
	'#bypassme': function(element, renderer){
		// true = "handled elsewhere, bypass text extraction"
		return true
	}
}

margins = {
    top: 80,
    bottom: 60,
    left: 40,
    width: 522
  };

pdf.fromHTML(
  	source // HTML string or DOM elem ref.
  	, margins.left // x coord
  	, margins.top // y coord
  	, {
  		'width': margins.width // max width of content on PDF
  		, 'elementHandlers': specialElementHandlers
  	},
  	function (dispose) {
  	  // dispose: object with X, Y of the last line add to the PDF
  	  //          this allow the insertion of new lines after html
        //pdf.save('Test.pdf');
      },
  	margins
  )

});
</script>

    </head>

    <body style="background: none">
        <section class = "container-fluid">
        <section>
            <article>
                <button id="bu" >imprimir</button>
                <div id="div" class = "row-fluid" >
                <h3>Quantidade de Encontrista: <?php echo $total?></h3>
                        <table class = "table bordered-table">
                            <caption><h3>Homens</h3></caption>
                            <thead>
                                <th>#</th>
                                <th style="color:red">Nome</th>
                                <th>Líder</th>
                            </thead>
                    <?php foreach ( $discipulos as $d) : ?>
                        <?php if ($d->sexo == 'm') :?>
                                <tr class = "" >
                                    <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                                    <td><?php echo $d->nome ; ?></td>
                                    <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                            </tr>
                            <?php endif?>
                        <?php endforeach ; ?>
                        </table>
                        <!-- ADD_PAGE -->
                        <table class = "table bordered-table">
                            <caption><h3>Mulheres</h3></caption>
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Líder</th>
                            </thead>
                            <?php foreach ( $discipulos as $d) : ?>
                                <?php if ($d->sexo == 'f') :?>
                                <tr class = "" >
                                    <td><?php echo !isset($a) ? $a=1 : ++$a ; ?></td>
                                    <td><?php echo $d->nome ; ?></td>
                                    <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                            </tr>
                            <?php endif?>
                        <?php endforeach ; ?>
                        </table>
                </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
