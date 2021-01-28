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

      <!-- Latest jQuery form server -->
      <script src="https://code.jquery.com/jquery.min.js"></script>
    
      <!-- Bootstrap JS form CDN -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      
      <!-- jQuery sticky menu -->
      <script src="/res/site/js/owl.carousel.min.js"></script>
      <script src="/res/site/js/jquery.sticky.js"></script>
      
      <!-- jQuery easing -->
      <script src="/res/site/js/jquery.easing.1.3.min.js"></script>
      
      <!-- Main Script -->
      <script src="/res/site/js/main.js"></script>
      
      <!-- Slider -->
      <script type="text/javascript" src="/res/site/js/bxslider.min.js"></script>
    <script type="text/javascript" src="/res/site/js/script.slider.js"></script>

    <!-- JS`s -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/94900f0f42.js" crossorigin="anonymous"></script>

    </body>
  </html>