<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="NOME_USUARIO">Nome</label>
              <input type="text" class="form-control" id="NOME_USUARIO" name="NOME_USUARIO" placeholder="Digite o nome">
            </div>
            <div class="form-group">
              <label for="LOGIN_USUARIO">Login</label>
              <input type="text" class="form-control" id="LOGIN_USUARIO" name="LOGIN_USUARIO" placeholder="Digite o login">
            </div>
            <div class="form-group">
              <label for="TELEFONE_USUARIO">Telefone</label>
              <input type="tel" class="form-control" id="TELEFONE_USUARIO" name="TELEFONE_USUARIO" placeholder="Digite o telefone">
            </div>
            <div class="form-group">
              <label for="EMAIL_USUARIO">E-mail</label>
              <input type="email" class="form-control" id="EMAIL_USUARIO" name="EMAIL_USUARIO" placeholder="Digite o e-mail">
            </div>
            <div class="form-group">
              <label for="PASS_USUARIO">Senha</label>
              <input type="password" class="form-control" id="PASS_USUARIO" name="PASS_USUARIO" placeholder="Digite a senha">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="ISADMIN_USUARIO" value="1"> Acesso de Administrador
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->