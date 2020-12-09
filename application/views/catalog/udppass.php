<?php
    require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
    require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
    require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
    <!-- Alternative Content Box Start -->
     <div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
      <div class="headings altheading">
        <h2 class="left">Cambiar su Contrase&ntilde;a - <?=$_SESSION["user"]["fullname"]?></h2>
      </div>
      <div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
        <form action="<?=SITE_URL?>catalog/savenewpass/<?=$_SESSION["user"]["id"]?>" method="post">
          <p>
            <label for="passant"><strong>Clave Anterior:</strong></label>
            <input type="password" id="passant" name="passant" class="inputbox" value="" required> <br />
          </p>
          <p>
            <label for="passnew"><strong>Nueva Contrase&ntilde;a:</strong></label>
            <input type="password" id="passnew" name="passnew" class="inputbox" value="" required><br />
          </p>          
          <p>
            <label for="passcnew"><strong>Repetir Contrase&ntilde;a:</strong></label>
            <input type="password" id="passcnew" name="passcnew" class="inputbox" value="" required><br />
          </p>          
          <p class="buttons">
            <input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
            <input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>catalog/users');">
          </p>
        </form>
      </div>
    </div>
    <!-- Alternative Content Box End -->
<?php
    require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
    require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
    require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>