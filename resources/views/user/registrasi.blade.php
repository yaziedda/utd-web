<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>theme shared on themelock.com</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/admin/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/admin/assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="/admin/assets/css/morris.min.css">
    <link rel="stylesheet" href="/admin/assets/css/select2.min.css">
    <link rel="stylesheet" href="/admin/assets/css/jquery-jvectormap.min.css">
    <link rel="stylesheet" href="/admin/assets/css/horizontal-timeline.min.css">
    <link rel="stylesheet" href="/admin/assets/css/weather-icons.min.css">
    <link rel="stylesheet" href="/admin/assets/css/dropzone.min.css">
    <link rel="stylesheet" href="/admin/assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="/admin/assets/css/ion.rangeSlider.skinFlat.min.css">
    <link rel="stylesheet" href="/admin/assets/css/datatables.min.css">
    <link rel="stylesheet" href="/admin/assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="/admin/assets/css/style.css">

    <!-- Page Level Stylesheets -->

</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Register Page Start -->
        <div class="m-account-w" data-bg-img="/front-web/images/bg.jpg">
            <div class="m-account">
                <div class="row no-gutters flex-row-reverse">
                    <div class="col-md-6">
                        <!-- Register Content Start -->
                        <div class="m-account--content-w" data-bg-img="/front-web/images/banner-moc-1-12.png">
                            <div class="m-account--content" >
                                <h2 class="h2">Sudah punya akun?</h2>
                                <p>Klik login untuk masuk ke akun anda.</p>
                                <a href="/user/login" class="btn btn-rounded">Login</a> <a href="/" class="btn btn-rounded bg-primary">KEMBALI KE BERANDA</a>
                            </div>
                        </div>
                        <!-- Register Content End -->
                    </div>

                    <div class="col-md-6">
                        <div class="row`">
                            <form action="/user/registrasi-user" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-12" style="margin-top: 16px;">
                                    <!-- Register Form Start -->
                                    <div class="m-account--form-w" style="padding-bottom: 0; padding-top: 0; padding-bottom: 16px; padding-top: 24px">
                                        <div class="m-account--form" style="padding: 0; margin: 0;">
                                            <!-- Logo Start -->
                                            <div class="logo">
                                                <!-- <img src="/admin/assets/img/logo.png" alt=""> -->
                                            </div>
                                            <!-- Logo End -->
                                            @if(Session::has('alert-success'))
                                            <button class="btn btn-rounded btn-block btn-success">{{ Session::get('alert-success') }}</button><br>
                                            @elseif(Session::has('alert-failed'))
                                            <button class="btn btn-rounded btn-block btn-danger">{{ Session::get('alert-failed') }}</button><br>
                                            @endif
                                            

                                            <label class="m-account--title">DATA DIRI</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-ticket-alt"></i>
                                                    </div>
                                                    <input type="text" class="form-control" autocomplete="off" value="Workshop UI/UX UTD 4.0" readonly="true" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kartu Identitas</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-id-card"></i>
                                                    </div>
                                                    <fieldset id="foobar">
                                                        <input type="file" name="gambar" class="form-control" autocomplete="off" required>
                                                    </fieldset>
                                                </div>
                                                <p style="font-size: 10px; opacity: 0.5;">Kartu identitas dalam bentuk png / jpg</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <input type="text" name="no_hp" placeholder="Nomor Handphone" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-university"></i>
                                                    </div>
                                                    <input type="text" name="institusi" placeholder="Asal Institusi" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </div>
                                                    <input type="text" name="alamat" placeholder="Alamat" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: 16px;">
                                    <!-- Register Form Start -->
                                    <div class="m-account--form-w" style="padding-bottom: 0; padding-top: 0; padding-bottom: 8px; padding-top: 34px">
                                        <div class="m-account--form" style="padding: 0; margin: 0;">
                                            <label class="m-account--title" style="margin-top: -16px">DATA LOGIN</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>

                                                    <input type="email" name="email" placeholder="Email" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-key"></i>
                                                    </div>

                                                    <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <i class="fas fa-key"></i>
                                                    </div>

                                                    <input type="password" name="password_konfirmasi" placeholder="Konfirmasi Password" class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="m-account--actions">
                                                <button type="submit" class="btn btn-block btn-rounded btn-info">Register</button>
                                            </div>

                                            <div class="m-account--footer">
                                                <!-- <p>&copy; 2018 ThemeLooks</p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Register Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Page End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="/admin/assets/js/jquery.min.js"></script>
    <script src="/admin/assets/js/jquery-ui.min.js"></script>
    <script src="/admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/assets/js/perfect-scrollbar.min.js"></script>
    <script src="/admin/assets/js/jquery.sparkline.min.js"></script>
    <script src="/admin/assets/js/raphael.min.js"></script>
    <script src="/admin/assets/js/morris.min.js"></script>
    <script src="/admin/assets/js/select2.min.js"></script>
    <script src="/admin/assets/js/jquery-jvectormap.min.js"></script>
    <script src="/admin/assets/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="/admin/assets/js/horizontal-timeline.min.js"></script>
    <script src="/admin/assets/js/jquery.validate.min.js"></script>
    <script src="/admin/assets/js/jquery.steps.min.js"></script>
    <script src="/admin/assets/js/dropzone.min.js"></script>
    <script src="/admin/assets/js/ion.rangeSlider.min.js"></script>
    <script src="/admin/assets/js/datatables.min.js"></script>
    <script src="/admin/assets/js/main.js"></script>

    <script>

        $(function () {
            console.log('asds');
            $('#foobar input[type=file]').change(function(){
                var myfile= $( this ).val();
                console.log(myfile);
                var ext = myfile.split('.').pop();
                if(ext=="png" || ext=="jpg" || ext=="jpeg"){

                } else{
                    alert('File harus jpg atau png !');
                    $( this ).val('');
                }
            });
        })
        function deleteConfirm(url){
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }
    </script>

    <!-- Page Level Scripts -->

</body>
</html>
