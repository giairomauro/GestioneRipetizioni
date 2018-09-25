

</head>
<body>
    <header>
        <h1>Login Gestione Ripetizioni</h1>
        
    </header>
    <br>
<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Registrati</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <!-- Login -->
                                <form id="login-form" action="http://localhost:8042/MVC/login/log_in" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="mail" id="username" tabindex="1" class="form-control" placeholder="Indirizzo Mail" pattern="\S+@\S+\.\S+\" onkeyup="convalidate(this.value, this.id, regMail)" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Login">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="http://localhost:8042/MVC/passwordRecovery" tabindex="5" class="forgot-password">Password dimenticata?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Registration -->
                                <form id="register-form" action="http://localhost:8042/MVC/login/sendMail" method="post" role="form" style="display: none;">

                                    <!-- Name input -->
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Nome" value="" required="true" onkeyup="convalidate(this.value, this.id, regLetters)">
                                    </div>
                                    
                                    <!-- Surname input -->
                                     <div class="form-group">
                                        <input type="text" name="surname" id="surname" tabindex="1" class="form-control" placeholder="Cognome" value="" required="true" onkeyup="convalidate(this.value, this.id, regLetters)">
                                    </div>
                                    
                                    <!-- Mail input -->
                                    <div class="form-group">
                                        <input type="email" name="mail" id="mail" tabindex="1" class="form-control" placeholder="Indirizzo Mail" value="" required="true" onkeyup="convalidate(this.value, this.id, regMail)">
                                    </div>
                                    
                                    <!-- Phone input -->
                                    <div class="form-group">
                                        <input type="phone" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Cellulare" value="" required="true" onkeyup="convalidate(this.value, this.id, regPhone)">
                                    </div>
                                    
                                    <!-- Via input -->
                                    <div class="form-group">
                                        <input type="text" name="via" id="via" tabindex="1" class="form-control" placeholder="via" value="" required="true" onkeyup="convalidate(this.value, this.id, regVia)">
                                    </div>
                                    
                                    <!-- Cap and city input -->
                                    <div class="form-group">
                                        <input type="text" name="cap" id="cap" tabindex="1" class="form-control" placeholder="CAP" value="" required="true" onkeyup="convalidate(this.value, this.id, regCAP)" style="width: 20%; float: left;">

                                        <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="Città" value="" required="true" onkeyup="convalidate(this.value, this.id, regLetters)" style="width: 80%">
                                    </div>

                                    <!-- role input -->
                                    <div class="form-group" id="sceltaMultipla">
                                        <?php $role =  $connection->getRole(); ?>
                                        <select name="role" required="true" id="selRole">
                                            <option value="" selected="true" disabled="true" hidden="true"> Scegli ruolo...</option>
                                            <?php for ($i=0; $i < count($role); $i++): ?>
                                                <?php if(strcmp($role[$i], "amministratore")): ?>
                                                    <option value=<?php echo"$role[$i]" ?>>
                                                        <?php echo " ".$role[$i] ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Password input -->
                                    <p style="color: red; display: none;" id="invalid-pass">Password non valida<br> (12-25 caratteri, sia lettere che numeri)</p>
                                    <div class="form-group">
                                        <input type="password" name="pass" id="pass" tabindex="2" class="form-control" placeholder="Password" onkeyup="checkPassword(this.value)">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" onkeyup="confirm()" disabled="true">
                                    </div>

                                    <!-- registration submit button -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registra" disabled="true">
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