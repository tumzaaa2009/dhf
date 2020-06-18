<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
        <link rel="manifest" href="favicon/site.webmanifest">
        <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#bc4677">
        <meta name="msapplication-TileColor" content="#da77a0">
        <meta name="theme-color" content="#bc4677">
        <title>Dengue Fever Saraburi</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../assets/media/image/favicon.png"/>

        <!-- Plugin styles -->
        <link rel="stylesheet" href="../vendors/bundle.css" type="text/css">

        <!-- App styles -->
        <link rel="stylesheet" href="../assets/css/app.min.css" type="text/css">
    </head>
    <body class="form-membership">

        <!-- begin::preloader-->
        <div class="preloader">
            <div class="preloader-icon"></div>
        </div>
        <!-- end::preloader -->

        <div class="form-wrapper">

            
            <!-- logo -->
            <div id="logo">
                <img class="logo" src="favicon/android-chrome-512x512.png" style="max-height: 150px;" alt="image">
            </div>
            <!-- ./ logo -->

            <h5>Sign in</h5>

            <!-- form -->
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" id="user" name="user" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
                </div>
                <button type="button" onclick="CheckLogin();" class="btn btn-primary btn-block">Sign in</button>
            </form>
            <!-- ./ form -->


        </div>

        <!-- Plugin scripts -->
        <script src="../vendors/bundle.js"></script>

        <!-- App scripts -->
        <script src="../assets/js/app.min.js"></script>
        <script>
            $(document).ready(function () {
                toastr.options = {
                    timeOut: 3000,
                    progressBar: true,
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    showDuration: 200,
                    hideDuration: 200
                };
                $.fn.pressEnter = function(fn) {
                    return this.each(function() {
                        $(this).bind('enterPress', fn);
                        $(this).keyup(function(e){
                            if(e.keyCode == 13)
                            {
                            $(this).trigger("enterPress");
                            }
                        })
                    });
                };
                $('#user').pressEnter(function(){ CheckLogin(); });
                $('#pass').pressEnter(function(){ CheckLogin(); });
            });
            function CheckLogin() {
                var user = $("#user").val();
                var pass = $("#pass").val();

                if(user == "" || pass == ""){
                    toastr.info('กรุณา! กรอก Username และ Password');
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "authentication.php",
                    data: {user:user, pass:pass},
                    dataType: "json",
                    success: function (response) {
                        //window.alert(response);
                        if(response.result =='yes'){
                            if(response.level == "1"){
                                window.location.assign("main/index.php");
                            }else if(response.level == "2"){
                                window.location.assign("site/index.php");
                            }
                        } else if(response.result == 'fail1') {
                            toastr.warning('ไม่พบข้อมูลผู้ใช้งาน');
                        } else if(response.result == 'fail2'){
                            toastr.warning('Username หรือ Password ไม่ถูกต้อง');
                        } else if(response.result == 'error_update'){
                            toastr.error('เกิดข้อผิดพลาด! error(01)');
                        } else if(response.result == 'error_insert'){
                            toastr.error('เกิดข้อผิดพลาด! error(02)');
                        }else {
                            toastr.error('เกิดข้อผิดพลาด! กรุณาลองใหม่อีกครั้ง');
                        } 
                    }
                });
            }
        </script>
    </body>
</html>
