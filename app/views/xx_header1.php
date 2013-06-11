<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crane Property Management System</title>

<link href="<?php echo base_url(); ?>css/chozen.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" media="screen"/>

<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />

<!--<script src="<?php echo base_url(); ?>js/jquery-1.4.4.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/fileManager/elfinder.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.table.js"></script>

<!--<script type="text/javascript" src="js/flot/jquery.flot.js"></script>
<script type="text/javascript" src=js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/flot/excanvas.min.js"></script> -->


<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables/colResizable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dataTables/datatables.addrow.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/forms.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/autotab.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.filestyle.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/colorPicker/colorpicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/plupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/ui/progress.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ui/jquery.alerts.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jBreadCrumb.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/cal.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.smartWizard.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ToTop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.listnav.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sourcerer.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.chosen.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom_silo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom_Aziz.js"></script>

</head>
<body>



<!-- Top navigation bar -->

<div id="topNav">

    <div class="fixed">

        <div class="wrapper">

            <div class="welcome"><a href="#" title=""><img src="<?php 
                        $ci = & get_instance();
                        if($ci->session->userdata("name_pic_path")){
                            echo base_url().$ci->session->userdata("name_pic_path");
                        }else{
                            echo base_url()."images/userPic.png";
                        }                        
                        ?>" alt="" width="30" height="25"/></a><span>
                    <?php 
                    
                    if($ci->session->userdata("name_first")){
                        echo "Welcome Mr. ".$ci->session->userdata("name_first")." ".$ci->session->userdata("name_last");
                    }else{
                        echo "Hello User...";
                    }
                    ?>
                </span></div>

            <div class="userNav">

                <ul>

                    <li><a href="<?php echo base_url().'login/logout'; ?>" title=""><img src="<?php echo base_url(); ?>images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>

                </ul>

            </div>

            <div class="fix"></div>

        </div>

    </div>

</div>



<!-- Header -->

<div id="header" style="margin: 0 2%;" class="wrapper">

    <div class="logo"><a href="/" title=""><img src="<?php echo base_url(); ?>images/CMSlogo_103.png" alt="" /></a></div>

    <div class="middleNav">
    	<ul>
<!--            <li class="iMes"><a href="#" title="" id="addnotes"><span>Add Notes</span></a></li>-->
        </ul>
    </div>

    <div class="fix"></div>

</div>



<!-- Main wrapper -->

<div class="wrapper" style="margin: 0 2%;">