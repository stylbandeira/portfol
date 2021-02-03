<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="st-container container">
    <div class="row">
        <div class="col-md-12">
            <div class="st-categoria">
                <h2><?php echo htmlspecialchars( $category["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-md-3 col-sm-6 card">
                <div class="ST-ssp itensCart">
                    <div class="product-upper IPFoto">
                        <img class="imgItemPedido" src="/res/site/img/products/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" alt="">
                    </div>
                    <div class="dadosItens">
                        <h2><a href="/products/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["NOME_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></h2>
                        <div class="product-carousel-price">
                            <ins>R$<?php echo formatPrice($value1["PRECO_ITEM"]); ?></ins>
                        </div>  
                    </div>
                    
                    
                    <div class="addCart">
                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Adicionar ao carrinho</a>
                    </div>                       
                </div>
            </div>
            <?php } ?>

            
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

              <li class="page-item"><a class="page-link" href="<?php echo htmlspecialchars( $value1["link"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["page"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                <?php } ?>

            </ul>
          </nav>
    </div>
</div>