<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Produtos
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Produto</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/products/<?php echo htmlspecialchars( $product["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="NOME_ITEM">Nome da produto</label>
              <input type="text" class="form-control" id="NOME_ITEM" name="NOME_ITEM" placeholder="Digite o nome do produto" value="<?php echo htmlspecialchars( $product["NOME_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="PRECO_ITEM">Preço</label>
              <input type="number" class="form-control" id="PRECO_ITEM" name="PRECO_ITEM" step="0.01" placeholder="0.00" value="<?php echo htmlspecialchars( $product["PRECO_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="ID_CATEGORIA">Categoria</label>
              <select class="form-control" id="ID_CATEGORIA" name="ID_CATEGORIA">
                <?php if( $product["ID_CATEGORIA"] == 'NULL' OR $product["ID_CATEGORIA"] == '' ){ ?><option value="">Selecione a Categoria</option>
                <?php }else{ ?>

                <?php } ?>

                <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>

                
                <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $product["ID_CATEGORIA"] == $value1["ID_CATEGORIA"] ){ ?>selected<?php }else{ ?><?php } ?>><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                <?php } ?>

              </select>

            </div>
            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" value="<?php echo htmlspecialchars( $product["SRC_IMG"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo htmlspecialchars( $product["SRC_IMG"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Photo">
                </div>
              </div>
            </div>
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
<script>
document.querySelector('#file').addEventListener('change', function(){
  
  var file = new FileReader();

  file.onload = function() {
    
    document.querySelector('#image-preview').src = file.result;

  }

  file.readAsDataURL(this.files[0]);

});
</script>