<?php if(!class_exists('Rain\Tpl')){exit;}?><main>

    <section class="py-5 text-center container">
        <div class="container">
            <h2>Detalhes do Pedido</h2>
        </div>
    </section>

    <div class="container">
      <div class="row">
        <!-- ADICIONAR AO PEDIDO -->
        <div class="col-md-6">
          <section class="container">
            <div class="container">
              <div class="row">
                <?php $counter1=-1;  if( isset($itens) && ( is_array($itens) || $itens instanceof Traversable ) && sizeof($itens) ) foreach( $itens as $key1 => $value1 ){ $counter1++; ?>
                <div class="col-md-6 col-lg-4 col-sm-6">
                  <div class="card">

                    
                    <!-- FORM -->
                    <form role="form" action="/order/<?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/add" method="post">
                      
                      <div class="itensPedido">
                        <div class="IPItem"><?php echo htmlspecialchars( $value1["NOME_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
                        <div class="IPFoto">
                          <img class="imgItemPedido" src="/res/site/img/products/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" alt="">
                        </div>
                        <div class="card">
                          <input type="number" for="QTD" name="QTD" id="QTD" placeholder="Quantidade">
                        </div>
                        <div class="IPBotoes">
                          <button><i class="fa fa-arrow-right" aria-hidden="true" action="/order/<?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/add" method="post"></i></button>
                        </div>
                      </div>
                    </form>
                    <!-- FORM -->
                    
                  </div>
                </div>
              <?php } ?> 
              </div>
            </div>
          </section>
        </div>

        <!-- DETALHES DO PEDIDO -->
        <div class="col-md-6">
          <section class="container">
            <div class="container">
              <div class="row">
                  <div class="col-md-6">
                    <h3>Mesa :<?php echo htmlspecialchars( $order["ID_MESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                    <h3>Nº Pedido : <?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                  </div>
              </div>
  
              <div class="row order-itens">
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
                <h4 style="text-align: right;">Valor Total : R$<?php echo formatPrice($order["VAL_TOTAL"]); ?></h4>
              </div>
              <div class="ST_divAway">
                <!-- FALTA IMPLEMENTAR PARA REDIRECIONAR À FORMA DE PAGAMENTO -->
                <a type="button" class="btn btn-success" href="/order/<?php echo htmlspecialchars( $order["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/pay">Pagar</a>
              </div>
            </div>
      </section>        
        </div>
      </div>
    </div>
    
  

  
  </main>
  
  
      <script src="dist/js/bootstrap.bundle.min.js"></script>
  
        
    </body>
  </html>
  