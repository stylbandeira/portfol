<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/<?php echo htmlspecialchars( $user["ID_USUARIO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="NOME_USUARIO">Nome</label>
              <input type="text" class="form-control" id="NOME_USUARIO" name="NOME_USUARIO" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["NOME_USUARIO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="LOGIN_USUARIO">Login</label>
              <input type="text" class="form-control" id="LOGIN_USUARIO" name="LOGIN_USUARIO" placeholder="Digite o login"  value="<?php echo htmlspecialchars( $user["LOGIN_USUARIO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="TELEFONE_USUARIO">Telefone</label>
              <input type="tel" class="form-control" id="TELEFONE_USUARIO" name="TELEFONE_USUARIO" placeholder="Digite o telefone"  value="<?php echo htmlspecialchars( $user["TELEFONE_USUARIO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="EMAIL_USUARIO">E-mail</label>
              <input type="email" class="form-control" id="EMAIL_USUARIO" name="EMAIL_USUARIO" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $user["EMAIL_USUARIO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="ISADMIN_USUARIO" value="1" <?php if( $user["ISADMIN_USUARIO"] == 1 ){ ?>checked<?php } ?>> Acesso de Administrador
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->