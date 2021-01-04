<?php if(!class_exists('Rain\Tpl')){exit;}?> 
    <!--Footer-->
    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <footer class="st-footer footer">
      <div id="concact-area">
        <div class="container">
          <h3 class="main-title">Port<b>Fol</b></h3> 
          <div class="row">
            <div class="col">
              <p>Site-Portfólio que simula um site de pedidos.</p>
              <h6>O site pretende simular pedidos em mesa - via QRCode - ou para entrega. Possui cadastro de produtos
                onde é possível cadastrar também fotos desse produto, cadastro de funcionários, entre outras funcionalidades
                ainda a serem implementadas.
              </h6>
            </div>
            <div class="col">
              <i class="fab fa-github"></i>
              <p><a href="https://github.com/stylbandeira/portfol" target="blank">Contribua comigo</a></p>
            </div>
            <div class="col">
              <i class="fab fa-linkedin"></i>
              <p><a href="https://www.linkedin.com/in/styl-bandeira-894b02b2/">LinkedIn</a></p>
            </div>
            <div class="col">
              <h3>Categorias</h3>
              <ul>
                <?php require $this->checkTemplate("categories-menu");?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    </body>
  </html>