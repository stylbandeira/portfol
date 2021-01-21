<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Produtos
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/orders">Categorias</a></li>
        <li class="active"><a href="/admin/orders/create">Cadastrar</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
          <div class="col-md-12">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Novo Produto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/admin/orders/create" method="post">
              <div class="box-body">
                <div class="form-group">
                    <label for="ID_MESA">ID_MESA</label>
                    <input type="number" class="form-control" id="ID_MESA" name="ID_MESA" placeholder="Digite o ID_MESA">
                </div>
                <div class="form-group">
                  <label for="ID_CLIENTE">ID DO CLIENTE</label>
                  <input type="number" class="form-control" id="ID_CLIENTE" name="ID_CLIENTE" placeholder="Digite o ID do cliente">
                </div>
                <div class="form-group">
                  <label for="TIPO_PEDIDO">Preço</label>
                  <input type="text" class="form-control" id="TIPO_PEDIDO" name="TIPO_PEDIDO" placeholder="Digite o TIPO_PEDIDO">
                </div>
                <div class="form-group">
                    <label for="VAL_TOTAL">Preço</label>
                    <input type="number" class="form-control" id="VAL_TOTAL" name="VAL_TOTAL" placeholder="DIGITE O VAL_TOTAL">
                </div>

                <div class="form-group">
                    <label for="STATUS_PEDIDO">STATUS_PEDIDO</label>
                    <input type="text" class="form-control" id="STATUS_PEDIDO" name="STATUS_PEDIDO" placeholder="DIGITE O STATUS_PEDIDO">
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