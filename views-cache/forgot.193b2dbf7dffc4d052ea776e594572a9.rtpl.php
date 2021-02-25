<?php if(!class_exists('Rain\Tpl')){exit;}?><div  style="background-color: #D2D3DE;">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="product-big-title-area ">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="product-bit-title text-center">
                                <h2>Esqueceu a Senha?</h2>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">   
                <div class="col-md-4"></div>             
                <div class="col-md-4">
                    <form id="login-form-wrap" class="login" method="post" action="/forgot">
                        <h2 style="text-align: center; color: black;">Recuperar senha</h2>
                        <p class="form-row form-row-first">
                            <label for="email">E-mail <span class="required">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="input-text" style="width:350px" placeholder="E-mail cadastrado">
                        </p>
                        <div class="clear"></div>
                        <p class="form-row">
                            <input type="submit" value="Enviar" name="login" class="button">
                            
                        </p>
    
                        <div class="clear"></div>
                    </form>                    
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>