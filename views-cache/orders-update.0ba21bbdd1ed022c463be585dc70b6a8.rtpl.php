<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pedido
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Detalhes do Pedido</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/orders/<?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group col-md-6">
              <h3>Código do Pedido : <b><?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h3>
            </div>
            <div class="form-group col-md-6" style="text-align: right;">
                <h3>Mesa : <b><?php echo htmlspecialchars( $order["ID_MESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></h3>
            </div>
           
          </div>
          <style>
            .order-detail{
              background-color: rgb(240, 239, 203);
            }
          </style>
          <div class="box-body">
            <div class="form-group order-detail">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th style="text-align: right;">Valor</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($orderItens) && ( is_array($orderItens) || $orderItens instanceof Traversable ) && sizeof($orderItens) ) foreach( $orderItens as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["NOME_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["QTD"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td style="text-align: right;">R$<?php echo formatPrice($value1["VAL_PARCIAL"]); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="form-group col-md-12" style="text-align: right;">
              <td><a href="/admin/orders/<?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/add" class="btn btn-primary"<?php if( $order["STATUS_PEDIDO"] !== 'ABERTO' ){ ?>disabled<?php }else{ ?><?php } ?>><i class="fa fa-cart"></i>+ Adicionar</a></td>
            </div>
          </div>
          <div class="form-group col-md-12" style="text-align: right;">
            <h3>Valor Total: <b>R$<?php echo formatPrice($order["VAL_TOTAL"]); ?></b></h3>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <td><a href="/admin/orders/<?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/pay" class="btn btn-success"<?php if( $order["STATUS_PEDIDO"] !== 'ABERTO' ){ ?>disabled<?php }else{ ?><?php } ?>><i class="fa fa-cart"></i>Pagar</a></td>
            <td><a href="/admin/orders" class="btn btn-danger"><i class="fa fa-cart"></i>Voltar</a></td>
            
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->