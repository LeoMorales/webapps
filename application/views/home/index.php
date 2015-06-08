<!-- 
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.

-->
<!-- include the Google Platform Library on your web pages that integrate Google Sign-In. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Specify the client ID you created for your app in the Google Developers Console with the google-signin-client_id meta element. -->
<meta name="google-signin-client_id" content="247475190591-e59sg0qhf5j10udhp805nt3lsmoucu10.apps.googleusercontent.com">

<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/styles_home.css"> 
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
        // $.ajax({  
        //     //controller path
        //     url: url_autenticacion,  
        //     type: "POST",  
        //     dataType: "json",  
        //     contentType: "json",  
        //     data: {'token': "aaaaaah"},
        //     success: function(response){              
        //         console.log(response);
        //     },  
        //     error: function(response){  
        //         console.log(response);
        //     }  
        // }); //ajax close
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
            $("#hello").html(msg);
        });

    }
    // https://www.googleapis.com/oauth2/v1/tokeninfo?id_token=XYZ123

</script>
<center><h1>Home!</h1></center>
<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">                                
                        <div class="row-fluid user-row">
                            <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                        <a href="#" onclick="signOut();">Sign out</a>
                        <script>
                          function signOut() {
                            var auth2 = gapi.auth2.getAuthInstance();
                            auth2.signOut().then(function () {
                              console.log('User signed out.');
                            });
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
