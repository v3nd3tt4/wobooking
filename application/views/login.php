<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets_srtdash/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/metisMenu.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/slicknav.min.css">

    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/typography.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/default-css.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/styles.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_srtdash/css/responsive.css">

    <script src="<?=base_url()?>assets_srtdash/js/vendor/modernizr-2.8.3.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="<?=base_url()?>login/proses_login">
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Silahkan login dengan memasukkan username dan password</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="username" id="exampleInputEmail1">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                        </div>
                        
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Login <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <!-- <p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?=base_url()?>assets_srtdash/js/vendor/jquery-2.2.4.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>

    <script src="<?=base_url()?>assets_srtdash/js/popper.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script src="<?=base_url()?>assets_srtdash/js/bootstrap.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script src="<?=base_url()?>assets_srtdash/js/owl.carousel.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script src="<?=base_url()?>assets_srtdash/js/metisMenu.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script src="<?=base_url()?>assets_srtdash/js/jquery.slimscroll.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script src="<?=base_url()?>assets_srtdash/js/jquery.slicknav.min.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>

    <script src="<?=base_url()?>assets_srtdash/js/plugins.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script src="<?=base_url()?>assets_srtdash/js/scripts.js" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="ad83a1791808bcb2d6dcc861-text/javascript"></script>
    <script type="ad83a1791808bcb2d6dcc861-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="ad83a1791808bcb2d6dcc861-|49" defer=""></script>
</body>

</html>