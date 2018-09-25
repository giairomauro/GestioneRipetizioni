<!DOCTYPE html>
<html>
<head><!--
    <link rel="stylesheet" type="text/css" href="application/views/_templates/bootstrap.min.css">
    <script type="text/javascript" src="application/views/_templates/bootstrap.min.js"></script>-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="http://eserciz.samtinfo.ch/application/views/login/javascript/login.js"></script>
    <link rel="stylesheet" type="text/css" href="http://eserciz.samtinfo.ch/application/views/login/css/login.css">
    <meta charset="utf-8">
    <!-- Include the above in your HEAD tag -->
    
    <title>Password Recovery</title>
</head>
<body>
    <header>
        <h1>Recupera la tua password</h1>
    </header>
    <br>
<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Password</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="http://eserciz.samtinfo.ch/passwordRecovery/reset" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="password" name="pass" id="username" tabindex="1" class="form-control" placeholder="Nuova Password" value="" required="true">
                                    </div>
                                     <div class="form-group">
                                        <input type="password" name="confPass" id="username" tabindex="1" class="form-control" placeholder="Conferma Password"  value="" required="true"><input type="hidden" name="mail" value="<?php  echo $mail?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Reimposta password">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>