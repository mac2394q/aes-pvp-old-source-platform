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
    <title>Recuperar Contrase&ntilde;a :: Asociaci&oacute;n de Empresas Seguras - PVP</title> 
    <link href="favicon.ico" rel="shortcut icon"/>  
    <meta name=viewport content="width=device-width,initial-scale=1"> 
    <link rel=stylesheet href='css/b4b1f29.css'> 
  </head> 
  <body class=special_page> 
    <div class=top> 
      <div class=gradient></div> 
       <div class=white></div> 
         <div class=shadow></div> 
    </div> 
    <div class=content> 
      <h1>PVP | Recuperar Contrase&ntilde;a</h1> 
      <div class=background></div> 
      <div class=wrapper> 
         <div class=box> 
           <div class="header grey"> 
             <img src="<?=SITE_URL?><?=IMG_LOCATION ?>lock.png" width=16 height=16> 
              <h3>Recuperar Contrase&ntilde;a</h3> 
           </div> 
           <form method="POST" name="loginForm" action="<?=SITE_URL?>auth/fpass"> 
             <div class="content no-padding">
               <?php if($MSG_fpass !=""){ ?> 
               <div class="errorbox"><?php echo $MSG_fpass; ?></div>  
               <?php } ?>
               <div class="section _100"> 
                  <label> Usuario </label> 
                 <div><input name='username' id="username" class='required'> </div> 
               </div> 
               <div class="section _100"> 
                  <label> Correo Electr&oacute;nico </label> 
                 <div><input name='email' id="email" class='required'> </div> 
               </div> 
             </div> 
             <div class=actions>
                <div class="actions-left2"> 
                   <input type=submit id="btnLogin" value="Recuperar Contrase&ntilde;a" />
                </div>
             </div>
           </form> 
          </div> 
          <div class=shadow><br/>
            <a href="<?=SITE_URL?>auth/login">Iniciar Sesi&oacute;n</a>
          </div> 
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