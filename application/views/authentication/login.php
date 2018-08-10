<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

	<?php 	$this->load->view('common/head');   ?>

    <body>
            
            <div class="login-container lightmode">
                
                <div class="login-box animated fadeInDown">
                    <div class="login-logo"></div>
                    <div class="login-body">
                        <div class="login-title"><strong>Log In</strong> to your account</div>
                            <div class="login-title">
                                        <?php 
                                        if(isset($message['error']))
                                        {
                                    ?>                             
                                            <span class="error-text"><?php echo $message['error']; ?></span>
                                    <?php 
                                        }
                                    ?>
                            </div>
                            <form method="POST" action="<?php echo site_url('authentication/index');  ?>" accept-charset="UTF-8" class="form-horizontal"><input name="_token" type="hidden" value="BuGxVIckNMAiNNDAurW3VouQ9BqYLZ9G1m88Q66E">
                                <input name='token' type="hidden" value="z123z321" />
                                 <div class="form-group">
                                    <div class="col-md-12">
                                        <input name="email" class="form-control" placeholder="E-mail"  type="email" value="">
                                        <?php 
                                            if(isset($message['email']))
                                            {
                                        ?>                             
                                                <span class="error-text"><?php echo $message['email']; ?></span>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input name="password" class="form-control" placeholder="Password"  type="password" value="">
                                        <?php 
                                            if(isset($message['password']))
                                            {
                                        ?>                             
                                                <span class="error-text"><?php echo $message['password']; ?></span>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button class="btn btn-info btn-block" type="submit">Log In</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <div class="pull-left">
                            &copy; 2018 ZPanel
                        </div>
                        <!--
                        <div class="pull-right">
                            <a href="#">About</a> |
                            <a href="#">Privacy</a> |
                            <a href="#">Contact Us</a>
                        </div>
                        -->
                    </div>
                </div>
                
            </div>

            
    </body>
</html>






