<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

	<?php 	$this->load->view('common/head');   ?>

    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
				<?php $this->load->view('common/sidebar');   ?>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
				
				
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
					<?php $this->load->view('common/navigation_vertical');   ?>
				<!-- END X-NAVIGATION VERTICAL -->                           
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                   <!--  <li><a href="#">Home</a></li>
                    <li><a href="#">Forms Stuff</a></li>
                    <li><a href="#">Form Layout</a></li>
                    <li class="active">One Column</li> -->
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  
                    <div class="row">
                        <div class="col-md-12">
                            
                           
                                <div class="panel panel-default">

                                    
                                    <?php 
                                        if(isset($message['success']))
                                        {
                                    ?>
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="icon fa fa-check"></i>
                                            <?php echo $message['success']; ?>
                                            </div>
                                    <?php 
                                        }
                                    ?>

                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong><?php if(isset($create)) echo 'Create';  if(isset($update)) echo 'Update'; ?> </strong> User</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">                                                                        
                                        
                                    <form method="POST" action="<?php if(isset($create)) echo site_url('users/create/'); if(isset($update)) echo site_url('users/update/'.$update);   ?>" accept-charset="UTF-8" class="form-horizontal">
                                        <input name='token' type="hidden" value="z123z321" />
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Username</label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input name="username" type="text" class="form-control" placeholder="Enter Username" value="<?php if(isset($users[0]->username)) echo $users[0]->username;  echo set_value('username'); ?>"/>
                                                </div>                                            
                                                <?php 
                                                    if(isset($message['username']))
                                                    {
                                                ?>                             
                                                        <span class="error-text"><?php echo $message['username']; ?></span>
                                                <?php 
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Email</label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input name="email" type="text" class="form-control" placeholder="Enter Email"   value="<?php if(isset($users[0]->email)) echo $users[0]->email;  echo set_value('email'); ?>"   />
                                                </div>               
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
                                            <label class="col-md-3 col-xs-12 control-label">Password</label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input name="password" type="password" class="form-control" placeholder="Enter Password"  />
                                                </div>                                            
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
                                            <label class="col-md-3 col-xs-12 control-label">Phone</label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input name="phone" type="text" class="form-control" placeholder="Enter Phone" value="<?php if(isset($users[0]->phone)) echo $users[0]->phone; else  echo set_value('phone'); ?>" />
                                                </div>                                            
                                                <?php 
                                                    if(isset($message['phone']))
                                                    {
                                                ?>                             
                                                        <span class="error-text"><?php echo $message['phone']; ?></span>
                                                <?php 
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                        

                                    
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Status </label>
                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                <select name="status" class="form-control select">
                                                    <option value="">Select Status</option>
                                                    <option <?php if(set_value('status')=='1') echo 'selected'; else if(isset($users[0]->status)) if($users[0]->status==1) echo 'selected';    ?> value="1">Active</option>
                                                    <option <?php if(set_value('status')=='0') echo 'selected'; else if(isset($users[0]->status)) if($users[0]->status==0) echo 'selected'; ?> value="0">Inactive</option>
                                                </select>
                                                <?php 
                                                    if(isset($message['status']))
                                                    {
                                                ?>                             
                                                        <span class="error-text"><?php echo $message['status']; ?></span>
                                                <?php 
                                                    }
                                                ?>
                                            </div>
                                        </div>






                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Clear Form</button>                                    
                                        <button class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        


        

        <!-- MESSAGE BOX-->
                                                    
		    <?php $this->load->view('common/messagebox');   ?>

        <!-- END MESSAGE BOX-->
        


        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo site_url('public/template/audio/alert.mp3'); ?>" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo site_url('public/template/audio/fail.mp3'); ?>" preload="auto"></audio>
        <!-- END PRELOADS -->             
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/jquery/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/jquery/jquery-ui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/bootstrap/bootstrap.min.js'); ?>"></script>                
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='<?php echo site_url("public/template/js/plugins/icheck/icheck.min.js"); ?>'></script>
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/bootstrap/bootstrap-datepicker.js'); ?>"></script>                
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/bootstrap/bootstrap-file-input.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/bootstrap/bootstrap-select.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tagsinput/jquery.tagsinput.min.js'); ?>"></script>
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?php echo site_url('public/template/js/settings.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins.js'); ?>"></script>        
        <script type="text/javascript" src="<?php echo site_url('public/template/js/actions.js'); ?>"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->                   
    </body>
</html>






