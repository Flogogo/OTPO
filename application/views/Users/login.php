<div class="container" style="text-align: center;margin-top:40px;">
 <h1>Login</h1>

   <!-- Message d'explicatin si fail sur le login -->
   <?php echo ( "<b> " ); ?>
   <?php echo validation_errors() ;?>
   <?php echo ( "</b> " ); ?>
   <!-- Fin explication -->
   
   <?php echo form_open(base_url('index.php/Users/user_control/verify_login')); ?>
      <div class="input-prepend">
        <span class="add-on"><i class="icon-user"></i></span>
        <input class="span2" type="text" size="20" id="username" name="username"/>
      </div>
      <br/>

      <div class="input-prepend">
        <span class="add-on"><i class="icon-key"></i></span>
        <input class="span2" type="password" placeholder="Password" id="passowrd" name="password"/>
      </div>
      <br/>
     <input type="submit" value="Login" class="btn"/>
   </form>
</div>