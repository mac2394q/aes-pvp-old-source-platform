<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js ie6 oldie" lang=en><![endif]-->
<!--[if IE 7]><html class="no-js ie7 oldie" lang=en><![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang=en><![endif]-->
<!--[if gt IE 8]><!-->
<html class=no-js lang=en>
<!--<![endif]-->
<head>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL?><?=CSS_LOCATION ?>login.css">
<meta charset=iso-8859-1>
<meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">
<title>Login :: Asociaci&oacute;n de Empresas Seguras - PVP</title>
<link href="favicon.ico" rel="shortcut icon"/>
<meta name=viewport content="width=device-width,initial-scale=1">
<link rel=stylesheet href='css/b4b1f29.css'>
<script>
function send(){
document.loginForm.submit();
}
</script>
</head>
<body class=special_page>
<div class=top>
  <div class=gradient></div>
  <div class=white></div>
  <div class=shadow></div>
</div>
<div class="content">
  <h1>PVP | Login</h1>
  <div class="background"></div>
  <div class="wrapper">
    <div class="box">
      <div class="header grey"> <img src="<?=SITE_URL?><?=IMG_LOCATION ?>lock.png" width="16" height="16">
        <h3>Login</h3>
      </div>
      <form method="POST" name="loginForm" id="loginForm" action="<?=SITE_URL?>auth/login">
        <div class="content no-padding">
          <?php if($MSG_fpass !=""){ ?>
            <div class="errorbox"><?php echo $MSG_fpass; ?></div>
          <?php } ?>
          <div class="section _100">
            <label> Usuario </label>
            <div>
              <input name="username" type="text" id="username" class="required" />
            </div>
          </div>
          <div class="section _100">
            <label> Contrase&ntilde;a </label>
            <div>
              <input name="password" type="password" id="password" class="required" />
            </div>
          </div>
        </div>
        <div class="actions">
          <div class="actions-left2" style="margin-top: 8px;">
            <select name="language" id="language" class="actions-left">
              <option value="es">
                <?=LBL_SEL_SPANISH ?>
              </option> 
            </select>
            <div class="actions-right"> </div>
          </div>
          <div align="right" class="logbutton">
            <input type="button" id="btnLogin" value="Login" onClick="send();"/>
          </div>
        </div>
      </form>
    </div>
    <div class="shadow"></div>
  <a href="<?=SITE_URL?>auth/fpass">Recuperar Contrase&ntilde;a</a>
  </div>
</div>
  <!-- <a href="http://aes.org.co/ayuda/proveedor1/proveedor1.htm" target="_blank">Proveedor Paso 1</a> <a href="http://aes.org.co/ayuda/proveedor2/proveedor2.htm" target="_blank">Proveedor Paso 2</a></div> --> 
 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script> 
<script>window.jQuery||document.write('<script src="<?=SITE_URL?><?=JS_LOCATION ?>jquery-1.6.4.min.js"><\/script>');</script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script> 
<!--[if lt IE 7 ]><script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script defer>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})});</script><![endif]-->
</body>
</html>