<?php 
    include_once("login.func.php");

    if(!defined('RSALoginVersion')) {
       die('Direct access not permitted'); // Make this page inaccessible directly
    }
?>

<div class="container">
<div class="row">
    <div class="col-lg-3 col-md-2"></div>
    <div class="col-lg-6 col-md-8 login-box">
        <div class="col-lg-12 login-key">
            <i class="fa fa-key" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 login-title">
            LOGIN<br/>
            <p><strong>Auth code to sign: </strong><pre><?php echo GetAuthToken();?></pre></p>
        </div>
        <div class="col-lg-12 login-form">
            
            <div class="col-lg-12 login-form">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="form-control-label">USERNAME</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">SIGNATURE</label>
                        <input type="password" class="form-control" name="signature">
                    </div>

                    <div class="col-lg-12 loginbttm">
                        <div class="col-lg-6 login-btm login-text">
                            <!-- Error Message -->
                        </div>
                        <div class="col-lg-6 login-btm login-button">
                            <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3 col-md-2"></div>
    </div>
</div>
