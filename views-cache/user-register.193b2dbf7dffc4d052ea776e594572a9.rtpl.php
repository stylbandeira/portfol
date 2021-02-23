<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portfol | Cadastro de Usuário</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../res/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../res/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../res/admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="login-page">
  
<!-- Content Wrapper. Contains page content -->
<!-- CADASTRO -->
<div class="content col-md-6">
  <div class="login-logo">
    <a href="/"><b>Portfol</b> - Cadastro</a>
  </div>


    
    <!-- Main content -->
    <section class="content">

      <?php if( $error != '' && $typeError == 'register' ){ ?>
    <div class="alert alert-danger">
      <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $typeError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
    </div>
    <?php } ?>
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Novo Usuário</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/register" method="post">
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
               
              </div>
              <!-- /.box-body -->
              <!-- <div class="box-footer md" >
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <button style="-webkit-box-align: ;" type="submit" class="btn btn-success">Cadastrar</button>
              </div> -->

              
                <div class="box-footer">
                  <div class="col-md-6">
                    <button type="submit" name="register" class="btn btn-success">Cadastrar</button>
                  </div>
                  <div class="col-md-6">
                    <button href="/" class="btn btn-google">Voltar</button>
                  </div>
                </div>
              
            </form>
          </div>
          </div>
      </div>
    
    </section>
    <!-- /.content -->
    </div>

<!-- LOGIN -->
    <div class="content col-md-6">
      <div class="login-logo">
        <a href="/"><b>Portfol</b> - Login</a>
      </div>

      <!-- Main content -->
    <section class="content">
      <?php if( $error != '' && $typeError == 'login' ){ ?>
    <div class="alert alert-danger">
      <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
    </div>
    <?php } ?>
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Login</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/login" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="LOGIN_USUARIO">Login</label>
                  <input type="text" class="form-control" id="LOGIN_USUARIO" name="LOGIN_USUARIO" placeholder="Digite o login">
                </div>
                <div class="form-group">
                  <label for="PASS_USUARIO">Senha</label>
                  <input type="password" class="form-control" id="PASS_USUARIO" name="PASS_USUARIO" placeholder="Digite a senha">
                </div>
               
              </div>
              <!-- /.box-body -->
              <!-- <div class="box-footer md" >
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <button style="-webkit-box-align: ;" type="submit" class="btn btn-success">Cadastrar</button>
              </div> -->

              
                <div class="box-footer">
                  <div class="col-md-6">
                    <button type="submit" name="login" class="btn btn-success">Cadastrar</button>
                  </div>
                  <div class="col-md-6">
                    <button href="/" class="btn btn-google">Voltar</button>
                  </div>
                </div>
              
            </form>
          </div>
          </div>
      </div>
    
    </section>
    </div>
    <!-- /.content-wrapper -->
</body>
</html>
