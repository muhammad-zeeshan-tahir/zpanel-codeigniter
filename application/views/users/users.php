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
                
                <!-- START BREADCRUMB 
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Tables</a></li>
                    <li class="active">Basic</li>
                </ul>
                <!-- END BREADCRUMB -->
                
               

                <!-- PAGE TITLE -->
                <div class="page-title"></div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">                          
                            <!-- START DATATABLE EXPORT -->
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
                                    <h3 class="panel-title">Admin Users</h3>
                                    
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">                                                      
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/json.png"); ?>' width="24"/> JSON</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src='<?php echo site_url("public/template/img/icons/json.png"); ?>' width="24"/> JSON (ignoreColumn)</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'json',escape:'true'});"><img src='<?php echo site_url("public/template/img/icons/json.png"); ?>' width="24"/> JSON (with Escape)</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/xml.png"); ?>' width="24"/> XML</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'sql'});"><img src='<?php echo site_url("public/template/img/icons/sql.png"); ?>' width="24"/> SQL</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/csv.png"); ?>' width="24"/> CSV</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/txt.png"); ?>' width="24"/> TXT</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/xls.png"); ?>' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/word.png"); ?>' width="24"/> Word</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'powerpoint',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/ppt.png"); ?>' width="24"/> PowerPoint</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/png.png"); ?>' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='<?php echo site_url("public/template/img/icons/pdf.png"); ?>' width="24"/> PDF</a></li>
                                        </ul>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                            <li><a href="<?= site_url('users/create') ?>"><span class="fa fa-plus"></span></a></li>
                                        </ul>
                                    </div>                                    
                                    
                                </div>
                                
                                <div class="panel-body">
                                    <table id="customers2" class="table datatable">
                                        <thead>
                                            <tr>
                                                <?php 

                                                    foreach ( $coulmns as $row )
                                                    {
                                                        echo '<th width="'.$row['width'].'">'.$row['name'].'</th>';
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
  
                                            <?php 
                                                    $status =   ["InActive","Active"];
                                                    foreach($users as $row )
                                                    {
                                            ?>
                                                        <tr>
                                                            <td><?php echo $row->user_id; ?></td>
                                                            <td><?php echo $row->username; ?></td>
                                                            <td><?php echo $row->email; ?></td>
                                                            <td><?php echo $row->phone; ?></td>
                                                            <td><?php echo $row->password; ?></td>
                                                            <td><?php echo $status[$row->status]; ?></td>
                                                            <td><?php echo $row->created_on; ?></td>
                                                            <td><?php echo $row->updated_on; ?></td>
                                                            
                                                            <td style="width: 10%;">
                                                                    <a href="<?= site_url('users/update/'.$row->user_id) ?>" class="btn  btn-default   btn-rounded btn-sm" data-row="trow_1"><span class="fa fa-pencil"></span></a>
                                                                    <a  data-box="#delete-<?php echo $row->user_id; ?>" class="mb-control btn  btn-danger delete_row  btn-rounded btn-sm" data-row="trow_1"><span class="fa fa-trash-o"></span></a>
                                                                    
                                                                    <div class="message-box animated fadeIn" data-sound="alert" id="delete-<?php echo $row->user_id; ?>">
                                                                        
                                                                    <div class="mb-container">
                                                                        <div class="mb-middle">
                                                                            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                                                                            <div class="mb-content">
                                                                                <p>Are you sure you want to remove this row?</p>                    
                                                                                <p>Press Yes if you sure.</p>
                                                                            </div>
                                                                            <div class="mb-footer">
                                                                                <div class="pull-right">
                                                                                    <a href="<?= site_url('users/delete/'.$row->user_id) ?>" class="btn btn-success btn-lg  mb-control-yes">Yes</a>
                                                                                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        
                                                                       
                                                            
                                                            </td>

                                                        </tr>

                                            <?php 
                                                    }
                                            ?>
                                            
                                        </tbody>
                                    </table>                                    
                                    
                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->                            
                            
                          

                        </div>
                    </div>

                </div>         
                <!-- END PAGE CONTENT WRAPPER -->
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->    

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->        
        
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

            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tableexport/tableExport.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tableexport/jquery.base64.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tableexport/html2canvas.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tableexport/jspdf/libs/sprintf.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tableexport/jspdf/jspdf.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins/tableexport/jspdf/libs/base64.js'); ?>"></script>
                    
            <!-- END THIS PAGE PLUGINS -->       
            
            <!-- START TEMPLATE -->
            <script type="text/javascript" src="<?php echo site_url('public/template/js/settings.js'); ?>"></script>
            
            <script type="text/javascript" src="<?php echo site_url('public/template/js/plugins.js'); ?>"></script>        
            <script type="text/javascript" src="<?php echo site_url('public/template/js/actions.js'); ?>"></script>        
            <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->                  
    </body>
</html>






