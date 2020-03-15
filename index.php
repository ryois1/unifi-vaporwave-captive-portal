<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="/assets/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/assets/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/fa/css/all.min.css">
        <link rel="stylesheet" href="/assets/main.css">
        <title>Guest Network | Captive Portal</title>
    </head>
    <body>
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3><?php echo strip_tags($_GET["ssid"]);?></h3>
                    </div>
                    <div class="card-body">
                        <form id="form" method="post" action="/login.php" autocomplete="off">
                        <input type="hidden" id="client-mac" name="client" value="<?php echo strip_tags($_GET["id"]);?>">
                        <input type="hidden" id="ap-mac" name="ap" value="<?php echo strip_tags($_GET["ap"]);?>">
                        <input type="hidden" id="redirect-url" name="url" value="<?php echo strip_tags($_GET["url"]);?>">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input autocomplete="off" type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div id="submit-div" class="form-group">
                                <button id="submit" type="submit" class="btn float-right login_btn">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                    <b><span id="error-message" class="error text-white"></span></b>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/jquery.min.js"></script>
        <script src="/assets/main.js"></script>
    </body>
</html>