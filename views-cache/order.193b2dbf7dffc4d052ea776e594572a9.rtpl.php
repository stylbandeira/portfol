<?php if(!class_exists('Rain\Tpl')){exit;}?><main>

    <section class="py-5 text-center container">
        <form role="form" action="/order" method="post">
            <div class="box-body">
              <div class="form-group">
                  <label for="ID_MESA">Selecione a Mesa</label>
                  <select class="form-control" id="ID_MESA" name="ID_MESA">
                    <?php $counter1=-1;  if( isset($freeTables) && ( is_array($freeTables) || $freeTables instanceof Traversable ) && sizeof($freeTables) ) foreach( $freeTables as $key1 => $value1 ){ $counter1++; ?>
                    <option><?php echo htmlspecialchars( $value1["ID_MESA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                  <!-- <input type="number" class="form-control" id="ID_MESA" name="ID_MESA" placeholder="Digite o ID_MESA"> -->
              </div>
              <div class="form-group">
                <label for="NOME_CLIENTE">Seu nome <b class="opcional">(opcional)</b></label>
                <?php if( checkLogin(false) ){ ?>
                <input type="text" class="form-control" id="NOME_CLIENTE" name="NOME_CLIENTE" disabled value="<?php echo getUserName(); ?>">
                <?php }else{ ?>
                <input type="text" class="form-control" id="NOME_CLIENTE" name="NOME_CLIENTE" placeholder="Digite seu nome">
                <?php } ?>
                
              </div>
              
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Fazer Pedido</button>
            </div>
          </form>
    </section>
  
    <div class="album py-5 bg-light">
      <div class="container">
  
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php $counter1=-1;  if( isset($itens) && ( is_array($itens) || $itens instanceof Traversable ) && sizeof($itens) ) foreach( $itens as $key1 => $value1 ){ $counter1++; ?>
          <div class="col">
            <div class="card shadow-sm">
              <!-- <img class="imgCrop" src="/res/site/img/products/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" role="img" aria-label="Placeholder: Item" ><title>Placeholder</title></img> -->
              <img class="imgCrop" src="/res/site/img/products/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" alt="">
  
              <div class="card-body">
                <p class="card-text">Aqui é onde fica uma descrição mais abrangente do item, como ingredientes, etc.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Adicionar ao pedido</button>
                    
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
        <?php } ?> 
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Item" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Item</text></svg>
  
              <div class="card-body">
                <p class="card-text">Aqui é onde fica uma descrição mais abrangente do item, como ingredientes, etc.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Adicionar ao pedido</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  
  </main>
  
  
      <script src="dist/js/bootstrap.bundle.min.js"></script>
  
        
    </body>
  </html>
  