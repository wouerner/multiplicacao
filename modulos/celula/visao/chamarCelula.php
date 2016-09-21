                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                <form action = "/celula/chamar" method = "GET" class = "well form-inline" >
                <label>Pesquisar Célula:</label>
                <input class = "search-query" type = "search" name = "nome">
                <button type = "submit" class = "btn" >OK</button>
</form>
<?php endif ; ?>
