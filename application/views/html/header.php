<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700i]talic" rel="stylesheet" type="text/css"> -->

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/theme.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/prism.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/clockpicker.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dataTables.bootstrap.min.css">
<!-- 
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.dataTables.min.css">
 -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jQuery.print.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/buttons.print.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/highcharts.src.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/clockpicker/highlight.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/clockpicker/bootstrap-clockpicker.min.js"></script>
 



<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel">Login Bos</h4>
          	</div>
        	<form class="form-horizontal" action="<?php echo site_url('Home_C/login/') ?>" method="POST" role="form">
          		<div class="modal-body ">
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="Username" name="l_username" value="<?php echo set_value('l_username'); ?>">
                		</div>
              		</div>
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="password" class="form-control" placeholder="Password" name="l_password" value="<?php echo set_value('l_password'); ?>">
                		</div>
              		</div>
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	            	<button type="submit" class="btn btn-primary">Masuk</button>
	          	</div>
        	</form>
        </div>
    </div>
</div>

<script type='text/javascript'>
//<![CDATA[
jQuery(function($) { 'use strict';
    
    $('button#print_btn').on('click', function(e) {
      console.log('head');
      $('#exampli').DataTable().destroy();
      $('#examplo').DataTable().destroy();
      $('#examplw').DataTable().destroy();
      $('#examplq').DataTable().destroy();
      $('#examplij').DataTable().destroy();
      $('#exampld').DataTable().destroy();
      
      $('#exampli').DataTable({paging: false});
      $('#examplo').DataTable({paging: false});
      
      $('#examplw').DataTable({paging: false});
      $('#examplq').DataTable({paging: false});
      
      $('#exampld').DataTable({paging: false});
      $('#examplij').DataTable({paging: false});
      
      $(".absen_print").print({
        globalStyles : false,
        mediaPrint : false,
        stylesheet : "<?php echo base_url("assets/css/bootstrap.css") ?>",
        iframe : false,
        deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
      });
      $('#exampli').DataTable().destroy();
      $('#examplo').DataTable().destroy();
      $('#examplw').DataTable().destroy();
      $('#examplq').DataTable().destroy();
      $('#examplij').DataTable().destroy();
      $('#exampld').DataTable().destroy();
      $('#exampli').DataTable();
      $('#examplo').DataTable();
      $('#examplw').DataTable();
      $('#examplq').DataTable();
      $('#exampld').DataTable();
      $('#examplij').DataTable();
    });
    // Fork https://github.com/sathvikp/jQuery.print for the full list of options
});
//]]>
</script>

<style type="text/css">
  .a{
    width: 90px;
    overflow: hidden;
    display: inline-block;
    white-space: nowrap;
}
</style>