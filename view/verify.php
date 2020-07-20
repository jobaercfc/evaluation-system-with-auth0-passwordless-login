<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Material Bootstrap Wizard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="HandheldFriendly" content="true">

    <link rel="apple-touch-icon" sizes="76x76" href="<?=$base_url;?>/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?=$base_url;?>/assets/img/favicon.png" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />


    <!-- CSS Files -->
    <link href="<?=$base_url;?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=$base_url;?>/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?=$base_url;?>/assets/css/custom.css" rel="stylesheet" />
</head>

<body>
<div class="image-container set-full-height" style="background-image: url('<?=$base_url;?>/assets/img/wizard-book.jpg')">
    <!--   Creative Tim Branding   -->
    <div class="row">
        <div class="col-md-6">
            <a href="http://creative-tim.com">
                <div class="logo-container">
                    <div class="logo">
                        <img src="<?=$base_url;?>/assets/img/new_logo.png">
                    </div>
                    <div class="brand">
                        Creative Tim
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <div class="pull-left">
                <div class="dropdown language-selector" style="margin-top: 10px;">
                    <span style="font-size: large; color: white">Language : </span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        <img src="<?=$base_url;?>/assets/img/<?=$language;?>.png" />
                    </a>
                    <ul class="dropdown-menu pull-right" id="language-selector">
                        <li class="pick-language" lang="English">
                            <a href="#">
                                <img src="<?=$base_url;?>/assets/img/English.png" />
                                <span>English</span>
                            </a>
                        </li>
                        <li class="pick-language" lang="French">
                            <a href="#">
                                <img src="<?=$base_url;?>/assets/img/French.png" />
                                <span>Français</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--  Made With Material Kit  -->
    <a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard" class="made-with-mk">
        <div class="brand">MK</div>
        <div class="made-with">Made with <strong>Material Kit</strong></div>
    </a>

    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="alert alert-success" role="alert" style="display: <?php echo isset($_SESSION["flash_success"]) ? 'block' : 'none'; ?>">
                <?php
                    if(isset($_SESSION["flash_success"])) {
                        $_SESSION["flash_success"] = $labels['auth_page']['message_magic_link_sent'];
                        echo $_SESSION["flash_success"];
                        unset($_SESSION["flash_success"]);
                    }
                ?>
            </div>
            <div class="alert alert-danger" role="alert" style="display: <?php echo isset($_SESSION["warning_flash"]) ? 'block' : 'none'; ?>">
                <?php
                    if(isset($_SESSION["warning_flash"])) {
                        echo $_SESSION["warning_flash"];
                        unset($_SESSION["warning_flash"]);
                        session_destroy();
                    }
                ?>
            </div>
            <div class="col-sm-8 col-sm-offset-2">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="blue" id="wizard">
                        <!--  You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->
                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                <?=$labels['auth_page']['welcome_message'];?>
                            </h3>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#details" data-toggle="tab"><?=$labels['auth_page']['verification_message'];?></a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="details">
                                <div class="row">
                                    <h4 class="info-text"><?=$labels['auth_page']['ask_email'];?></h4>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <form action="<?=$base_url;?>/api/auth0-api/index.php" method="post">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?=$labels['auth_page']['email_input_placeholder'];?></label>
                                                    <input name="email" type="email" class="form-control valid" aria-required="true" aria-invalid="false">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary" id="send_magic_link"><?=$labels['auth_page']['send_magic_link'];?></button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div> <!-- row -->
    </div> <!--  big container -->

    <div class="footer">
        <div class="container text-center">
            Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/material-bootstrap-wizard">here.</a>
        </div>
    </div>
</div>

</body>
<!--   Core JS Files   -->
<script src="<?=$base_url;?>/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="<?=$base_url;?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=$base_url;?>/assets/js/jquery.bootstrap.js" type="text/javascript"></script>
<script>
    $('.pick-language').click(function () {
        var clickedLanguage = $(this).attr('lang');
        //alert(clicked);
        setLanguage(clickedLanguage);
    });
    function setLanguage(clickedLanguage) {
        var language = clickedLanguage;
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                language : language,
                set_language : 1
            },
            success: function(data) {
                console.log(data);
                window.location.reload();
            }
        });

    }
</script>


<!--  Plugin for the Wizard -->
<script src="<?=$base_url;?>/assets/js/material-bootstrap-wizard.js"></script>

<!-- Custom JS -->

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="<?=$base_url;?>/assets/js/jquery.validate.min.js"></script>
</html>
