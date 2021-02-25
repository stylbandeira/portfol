<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="row">
    <!-- CADASTRO -->
  <div class="content col-md-6">
    <div class="login-logo" style="background-color: #D2D3DE;">
      <a href="/">Cadastro</a>
    </div>
  
  
      
      <!-- Main content -->
      <section class="content">
  
        <?php if( $error != '' && $typeError == 'register' ){ ?>
      <div class="alert alert-danger">
        <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
      </div>
      <?php } ?>
      
        <div class="row">
          <div class="col-md-12" style="background-color: rgb(107, 107, 107);">
            <div class="box box-success" style="background-color: rgb(223, 223, 223);">
              
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
  
                
                  <div class="row">
                    <div class="d-grid gap-2">
                      <button type="submit" name="register" class="btn btn-success">Cadastrar</button>
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
        <div class="login-logo" style="background-color: #D2D3DE;">
          <a href="/">Login</a>
        </div>
  
        <!-- Main content -->
      <section class="content">
        <?php if( $error != '' && $typeError == 'login' ){ ?>
      <div class="alert alert-danger">
        <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
      </div>
      <?php } ?>
      
        <div class="row">
            <div class="col-md-12" style="background-color: rgb(107, 107, 107);">
                <div class="box box-success" style="background-color: rgb(223, 223, 223);">
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
                 <a href="/forgot">Esqueceu a senha?</a>
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer md" >
                  <button type="submit" class="btn btn-success">Cadastrar</button>
                  <button style="-webkit-box-align: ;" type="submit" class="btn btn-success">Cadastrar</button>
                </div> -->
  
                
                <div class="row">
                  <div class="d-grid gap-2">
                    <button type="submit" name="register" class="btn btn-success">Cadastrar</button>
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
  
  </div>
</div>