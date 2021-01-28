<?php if(!class_exists('Rain\Tpl')){exit;}?><br>
<br>
<main class="container">
    <div class="bg-light p-5 rounded">
      <h1>Navbar example</h1>
      <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser’s viewport.</p>
      <a class="btn btn-lg btn-primary" href="#" role="button">View navbar docs &raquo;</a>
    </div>

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Produtos</h2>
                        <div class="product-carousel">
                            <?php $counter1=-1;  if( isset($itens) && ( is_array($itens) || $itens instanceof Traversable ) && sizeof($itens) ) foreach( $itens as $key1 => $value1 ){ $counter1++; ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="/res/site/img/products/<?php echo htmlspecialchars( $value1["ID_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart">Comprar</i></a>
                                            <a href="/itens/<?php echo htmlspecialchars( $value1["SRC_IMG"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="view-details-link"><i class="fa fa-link">Ver Detalhes</i></a>
                                        </div>
                                    </div>
                                    <h2><a href="/itens/<?php echo htmlspecialchars( $value1["SRC_IMG"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["NOME_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></h2>
                                    <div class="product-carousel-price">
                                        <ins>R$<?php echo htmlspecialchars( $value1["PRECO_ITEM"], ENT_COMPAT, 'UTF-8', FALSE ); ?></ins>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
