<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/dotenv-loader.php';
?>
<script src="https://cdn.auth0.com/js/auth0/9.11/auth0.min.js"></script>
<script type="text/javascript">
    var domain = '<?=getenv("AUTH0_DOMAIN");?>';
    var client_id = '<?=getenv("AUTH0_CLIENT_ID")?>';
    var webAuth = new auth0.WebAuth({
        domain:       domain,
        clientID:     client_id,
        state:        'login'
    });
    var params = window.location.hash.slice(1);
    params = params.split('&');
    var access_token = params[0].split('=')[1];

    webAuth.client.userInfo(access_token, function(err, user) {
        // Now you have the user's information
        if (err) {
            alert(JSON.stringify(err));
            window.location.href = "index.php";
        } else {
            var params = {
                "token" : access_token,
                "user"  : user
            };
            $.ajax({
                url: "api/auth0-api/validation.php",
                method: "POST",
                data: params,
                success: function(data) {
                    var response = JSON.parse(data);
                    if(response['status'] == 200) {
                        window.location.href = "<?=$base_url;?>/evaluation.php";
                    } else {
                        window.location.href = "<?=$base_url;?>/index.php";
                    }
                }
            })
        }

    });
</script>

<!--   Core JS Files   -->
<script src="<?=$base_url;?>/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<h3>You are being redirected. Please wait....</h3>


