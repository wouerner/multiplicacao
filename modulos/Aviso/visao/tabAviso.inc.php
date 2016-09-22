<div class="" >
    <table class="table bordered-table table-condensed">
    <caption><h3 class="text-center">Avisos</h3></caption>
        <?php foreach ( $avisos as $a ) : ?>
        <tr class="<?php echo $a['visto'] ? '':'success' ;?>">
        <td>
                <span class="label label-info">
                    <?php echo date_format(date_create($a['dataAviso']), 'd/m') ; ?><br>
                    <?php echo date_format(date_create($a['dataAviso']), 'H:i') ; ?></span>
                </td><td>
                    <?php if ( isset($a['url']) ) : ?>
                    <img src="<?php echo $a['url'] ; ?>" class = "img-polaroid" width = "30px"  >
                    <?php endif ; ?>

                    <strong>
                        <?php if (is_null($a['alcunha']) || empty($a['alcunha'])) :?>
                            <?php echo $a['nome'] ; ?>
                        <?php else : ?>
                            <?php echo $a['alcunha'] ; ?>
                        <?php endif ;  ?>
                    :
                    </strong>
            <i class = "<?php echo isset($a['icone']) ? $a['icone']:'' ; ?>"></i>
            <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                    <a href= "/<?php echo $a['modulo'] ; ?>/<?php echo isset($a['controlador']) ? $a['controlador']: '' ; ?>/<?php echo isset($a['link']) ? $a['link' ]: '' ?>/id/<?php echo isset($a['identificacao']) ? $a['identificacao'] : ''  ; ?>">
                    <?php echo isset($a['mensagem']) ? $a['mensagem']: ''   ; ?>
                    </a>
            <?php else: ?>
                    <?php echo isset($a['mensagem']) ? $a['mensagem']: ''   ; ?>
            <?php endif ; ?>
            </td>
            <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                <td>  <a class="btn btn-mini btn-primary" href="/aviso/aviso/visto/id/<?php echo isset($a['id'] ) ?$a['id'] : '' ; ?>"><i class="icon-thumbs-up icon-white" > </i></a></td>
                <td>  <a class="btn btn-mini btn-danger" href="/aviso/aviso/excluir/id/<?php echo isset($a['id'] ) ?$a['id'] : '' ; ?>"><i class="icon-remove icon-white" > </i></a></td>
            <?php endif ; ?>
            </tr>
        <?php endforeach ; ?>
    </table>
</div>
