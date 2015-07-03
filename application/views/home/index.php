<!-- 
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.

-->
<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/styles_home.css"> 
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">

    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId());
        // console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        // console.log('Email: ' + profile.getEmail());
        // console.log('Token: ' + googleUser.getAuthResponse().id_token);
        // window.location.href = "<?php echo base_url(); ?>"+"Autenticacion/hello/hola";
        // $.post('/Autenticacion',{"token" : "holis"}
        url_autenticacion = "<?php echo base_url(); ?>"+"Autenticacion/hello";
        $.ajax({
            method: "POST",
            url: url_autenticacion,
            data: { 
                nombre: profile.getName(),
                email: profile.getEmail(),
                token: googleUser.getAuthResponse().id_token
            }
        })
        .done(function( msg ) {
            // alert( "Data Saved: " + msg );
            // $("#hello").html(msg);
            var url_archivo = "<?php echo base_url()?>Archivos/Propias";
            var url_nuevo = "<?php echo base_url()?>Archivos/Agregar";
            console.log("URLs: "+url_archivo+" "+url_nuevo);
            $("#super_nav_bar").append("<li><a href="+url_archivo+">Propias</a></li>");
            $("#super_nav_bar").append("<li><a href="+url_nuevo+">Nuevo</a></li>");
            var el_nombre = "<a aria-expanded=\"false\" role=\"button\" data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\">Aca va el Nombre... <span class=\"caret\"></span></a>";
            var nombre_usuario = "<ul class=\"nav navbar-nav navbar-right\"><li class=\"navbar-brand active\">"+profile.getName()+"</li></ul>";
            var nombre_usuario = "<li>"+profile.getName()+"</li>";
            
            console.log(msg);

            //$("#barra-collapse").append(nombre_usuario);
            $("#nombre_del_usuario").html(nombre_usuario);
            $(".g-signin2").html("<a href=\"<?php echo base_url(); ?>\" onclick=\"signOut();\">Sign out</a>")

        });

    }
    // https://www.googleapis.com/oauth2/v1/tokeninfo?id_token=XYZ123

</script>
<center><h1 class="titulo-ppal">Galeria Fenix</h1></center>
<!-- <body> -->
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-8">
                <div class="panel panel-default">
                    <!-- <div class="panel-heading panel-loggin"> -->                                
                    <div class="panel-loggin">
                        <div class="row-fluid user-row">
                            <img src="<?php echo base_url(); ?>static/images/camera_logo.png" class="img-responsive" width="150px" heigth="150px" alt="Conxole Admin"/>
                        </div>
                    </div>

                    <div class="panel-body">
                        <?php if(!isset($_SESSION["user_token"])){?>
                            <div class="g-signin2" data-onsuccess="onSignIn"></div>
                        <?php }else {?>
                            <a href="<?php echo base_url(); ?>" onclick="signOut();">Sign out</a>
                        <?php }?>
                        <script src="<?php echo base_url(); ?>assets/js/jquery-cookie/src/jquery.cookie.js"></script>
                        
                        <script>
                            function signOut() {
                                // var auth2 = gapi.auth2.getAuthInstance();
                                // auth2.signOut().then(function () {
                                //     console.log('User signed out.');
                                // });
                            // };
                                // if ($.removeCookie('PHPSESSID')){ // => true
                                //    console.log('cookie eliminada!'); 
                                // } 
                                // if ($.removeCookie("G_ENABLED_IDPS")){ // => true
                                //    console.log('cookie eliminada!'); 
                                // } 
                                if ($.removeCookie('G_ENABLED_IDPS', { path: '/' })){ // => true
                                   console.log('cookie eliminada!'); 
                                }
                                if ($.removeCookie('PHPSESSID', { path: '/' })){ // => true
                                   console.log('cookie eliminada!'); 
                                } 
                                
                                
                            }
                        </script>


<!--                         <form accept-charset="UTF-8" role="form" class="form-signin">
                            <fieldset>
                                <label class="panel-login">
                                    <div class="login_result"></div>
                                </label>
                                <input class="form-control" placeholder="Username" id="username" type="text">
                                <input class="form-control" placeholder="Password" id="password" type="password">
                                <br></br>
                                <input class="btn btn-lg btn-success btn-block" type="submit" id="login" value="Login »">
                            </fieldset>
                        </form>
 -->                </div>
                    <div id="hello"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- 
<script src="<?php echo base_url(); ?>static/js/js_home.js"></script>

 -->
</body>
