<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Mesas
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <div class="box-header">
              <a href="/admin/users/create" class="btn btn-success">Cadastrar Mesa</a>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Número da mesa</th>
                    <th>Pedido da Mesa</th>
                    <th>Código do Pedido</th>
                    <th style="width: 140px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($tables) && ( is_array($tables) || $tables instanceof Traversable ) && sizeof($tables) ) foreach( $tables as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["ID_MESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><a href="/admin/users/<?php echo htmlspecialchars( $value1["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"<?php if( $value1["ID_PEDIDO"] == NULL ){ ?>disabled<?php }else{ ?>Não<?php } ?>><i class="fa fa-cart"></i> Pedido</a></td>
                    <td><?php echo htmlspecialchars( $value1["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["ID_MESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                      <a href="/admin/users/<?php echo htmlspecialchars( $value1["ID_MESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->