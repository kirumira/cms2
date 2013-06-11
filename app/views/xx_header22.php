<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crane Property Management System</title>


<link href="<?php echo base_url(); ?>css/chozen.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" media="screen"/>
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<!--<script src="<?php echo base_url(); ?>js/jquery-1.4.4.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>js/jquery.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/fileManager/elfinder.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg/wysiwyg.table.js"></script>

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
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.js"></script>
</head>
<body>



<!-- Top navigation bar -->

<div id="topNav">

    <div class="fixed">

        <div class="wrapper">

            <div class="welcome">
                <a href="#" title=""><img src="<?php
                        $ci = & get_instance();
                        if($ci->session->userdata("name_pic_path")){
                            echo base_url().$ci->session->userdata("name_pic_path");
                        }else{
                            echo base_url()."images/userPic.png";
                        }
                        ?>" alt="" width="30" height="25" /></a>
                <span>
                    <?php 
                    $ci = & get_instance();
                    if($ci->session->userdata("name_first")){
                        echo "Welcome Mr. ".$ci->session->userdata("name_first")." ".$ci->session->userdata("name_last");
                    }else{
                        echo "Hello User...";
                    }
                    ?>
                </span>
<!--                <div style="color:#DB6A16;">&nbsp<h5><b>CRANE MANAGEMENT SYSTEM</b></h5></div>-->
            </div>

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

    <div class="logo"><a href="/" title=""><img src="<?php // echo base_url(); ?>images/CMSlogo_103.png" alt="" /></a></div>
    <div class="middleNav" >
    <?php $xb_id = $ci->session->userdata('building_id');
    echo '>>>>>>>>>>'.$ci->session->userdata('building_id');
    ?>
    <?php if($xb_id != null || $xb_id !=''){
        echo '>>>>>>>>>>'.$ci->session->userdata('building_id');
        
        echo '
            <ul>
            <li class="iPay"><a id="d7" href="'.base_url().'payments" title="Payments" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><span><b>Payments</b></span></a></li>
            <li class="iOrders">
                <a id="d1" class="dropdown-toggle" data-toggle="dropdown" href="#"><span style="width:110px;"><b>Billing</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;" id="bill"><a href="#">Bill for rent</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="'.base_url().'/bills/umeme">Bill for UMEME</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="#">Bill per floor</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="'.base_url().'bills/rooms/'.$ci->session->userdata('building_id').'">Bill per room</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="#">UMEME bill statement</a></div>
                </ul>
            </li>
            <li class="iSch">
                <a id="d2" class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>Payments Schedule</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="'.base_url().'bills/schedule_payment/'.$ci->session->userdata('building_id').'">Schedule payments</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="'.base_url().'schedules/view_schedule/'.$ci->session->userdata('building_id').'">View schedule</a></div>
                </ul>
            </li> 
            <li class="iRm"><a id="d3" href="'.base_url().'bills/view_rooms/'.$ci->session->userdata('building_id').'" title=""><span><b>Rooms bill status</b></span></a></li>
            <li class="itBill"><a id="d4" href="'.base_url().'bills/view_tenants_bills/'.$ci->session->userdata('building_id').'" title=""><span><b>Tenant bill status</b></span></a></li>
            <li class="icRates"><a id="d5" href="'.base_url().'currency/manage" title=""><span><b>Manage Rates</b></span></a></li>           
            <li class="itNote"><a href="#" title="" id="addnotes" style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;"><span><b>Add Notes</b></span></a></li>
        </ul>
        ';
     }
    
    ?>
    
    	
    </div>
    
    <div class="fix"></div>
    

</div>
<div id="billdialog" title="Building Billing Dialogue" style="display:none;">
    <p align ="center"><h4>You are about to bill the entire building. </h4></p></br>
    <p align ="center"><h4>Would You like to continue? </h4></p></br>
</div>
<script>
    
    $(function() {

    var domain = "<?php echo base_url();?>";
    //===========Building Billing dialog=======================//
    $(document).on('click',"#bill",function(){       
        $('#billdialog').dialog('open');
    }); 
     ///=========tenant delete===================//
    $("#billdialog").dialog({
        autoOpen: false,
        width: 400,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Yes",
            "class": "btnSavex",
            click: function(){
                var tenant_id = $('#dten_id').val();
                $.ajax({
                    type: "GET",
                    url: domain+"bills/bill",
                    success : function(response)
                    { 
                        //alert(response.changed);
                        if(response.status){
                            if (parseInt(response.b_n) > 0){
                                $("#billdialog").dialog("close");
                                jAlert('The following rooms were billed:<br>'+response.changed,"SUCCESS!");
                                //window.location = domain+response.page;
                            }else{
                                $("#billdialog").dialog("close");
                                jAlert('No rooms to bill!','INFO');
                                //window.location = domain+response.page;
                            }                            
                        }  
                    },
                    dataType:'json'
                });
                return false;
            }
        },
        {
            text: "No",
            "class": "btnCancelx",
            click: function(){
                $("#billdialog").dialog("close");
            }
        }
        ]
    });
    });

</script>


<!-- Main wrapper -->

<div class="wrapper" style="margin: 0 2%;">
    
  