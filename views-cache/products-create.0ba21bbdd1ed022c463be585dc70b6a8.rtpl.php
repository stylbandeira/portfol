<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Produtos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/categories">Categorias</a></li>
    <li class="active"><a href="/admin/categories/create">Cadastrar</a></li>
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
        <form role="form" action="/admin/products/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="NOME_ITEM">Nome do produto</label>
              <input type="text" class="form-control" id="NOME_ITEM" name="NOME_ITEM" placeholder="Digite o nome do produto">
            </div>
            <div class="form-group">
              <label for="PRECO_ITEM">Preço</label>
              <input type="number" class="form-control" id="PRECO_ITEM" name="PRECO_ITEM" step="0.01" placeholder="0.00">
            </div>
            <div class="form-group">
              <label for="ID_CATEGORIA">Categoria</label>
              <select class="form-control" id="ID_CATEGORIA" name="ID_CATEGORIA">
                <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>

                <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>

              </select>

            </div>

            <div class="form-group">
              <label for="SRC_IMG">URL</label>
              <input type="text" class="form-control" id="SRC_IMG" name="SRC_IMG">
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