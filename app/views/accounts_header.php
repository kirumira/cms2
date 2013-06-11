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
        <script type="text/javascript" src="<?php echo base_url(); ?>js/dataTables/datatables.addrow.js"></script>

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
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/towords.js"></script>
    </head>
    <body>



        <!-- Top navigation bar -->

        <div id="topNav">

            <div class="fixed">

                <div class="wrapper">

                    <div class="welcome">
                        <a href="#" title=""><img src="<?php
$ci = & get_instance();
if ($ci->session->userdata("name_pic_path")) {
    echo base_url() . $ci->session->userdata("name_pic_path");
} else {
    echo base_url() . "images/userPic.png";
}
?>" alt="" width="30" height="25" /></a>
                        <span>
                            <?php
                            $ci = & get_instance();
                            if ($ci->session->userdata("name_first")) {
                                echo "Welcome Mr. " . $ci->session->userdata("name_first") . " " . $ci->session->userdata("name_last");
                            } else {
                                echo "Hello User...";
                            }
                            ?>
                        </span>
                        <!--                <div style="color:#DB6A16;">&nbsp<h5><b>CRANE MANAGEMENT SYSTEM</b></h5></div>-->
                    </div>

                    <div class="userNav">

                        <ul>

                            <li><a href="<?php echo base_url() . 'login/logout'; ?>" title=""><img src="<?php echo base_url(); ?>images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>

                        </ul>

                    </div>

                    <div class="fix"></div>

                </div>

            </div>

        </div>
        <div id="b_cheque_form" title="Register Bounced Cheque" style="display:none;">
            <table width="93%">
                <input id="rm_id" style="display:none;"/>
                <input id="tn_id" style="display:none;"/>
                <input id="tn_4n" style="display:none;"/>
                <input id="rec_id" style="display:none;"/>
                <input id="vat_id" style="display:none;"/>
                <tr>
                    <th style="vertical-align:top;">Cheque no.: </th>
                    <td style="width:60%;">
                        <select class="selectEl" style="width:200%;" id="chq_no">
                        </select><br>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:middle;">Amount: </th>
                    <td style="width:60%;">
                        <input style="text-align:center;" class="positivenumeric" disabled="true" type="text" name="regular" id="chq_am" value=""/>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:middle;">Tenant: </th>
                    <td style="width:60%;">
                        <input style="text-align:center;" disabled="true" type="text" name="regular" id="chq_tn" value=""/>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:middle;">Room: </th>
                    <td style="width:60%;">
                        <input style="text-align:center;" disabled="true" type="text" name="regular" id="chq_rm" value=""/>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:middle;">Penalty: </th>
                    <td style="width:60%;">
                        <input style="text-align:center;" class="positivenumeric" type="text" name="regular" id="chq_pn" value=""/>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:top;">Details:</th>
                    <td style="width:60%;">
                        <textarea id="chq_nt" name="textarea" cols="1" rows="2"></textarea>
                    </td>
                </tr>

            </table>
        </div>



        <script>
            var options = null;
            $(document).on('click','#dq1',function(){
                $.ajax({
                    type: "GET",
                    url:"<?php echo base_url(); ?>cheque/get_all_cheques",
                    dataType:'json',
                    success: function(response){
                        options = response.options;
                        $('#chq_no').append('<option>Select Cheque</option>');
                        var index = 0;
                        $.each(response.options, function(index,value){
                            //{"options":[{"cheque":"24234243","pay_amount":"130000","room":"A1","tenant":"Allan Kavuma"}

                            $('#chq_no').append('<option value="'+value.cheque+'">'+value.cheque+'</option>');
                            $('.selectEl').trigger("liszt:updated");
                        });
                        $('.selectEl').chosen();
                        $('#b_cheque_form').dialog("open");
                    }
                });

            });
            $(document).on('change','#chq_no',function(){
                var xn = $('#chq_no').val();
                if(xn == 'Select Cheque'){
                    $('#chq_am').val('');
                    $('#chq_tn').val('');
                    $('#chq_rm').val('');
                    $('#rm_id').val('');
                    $('#tn_id').val('');
                    $('#chq_nt').val('');
                    $('#chq_pn').val('');
                    $('#tn_4n').val('');
                }else{
                    var result = $.grep(options, function(e){ return e.cheque == xn; });
                    //console.log(JSON.stringify(result));
                    $('#chq_am').val(add_commas(result[0].pay_amount));
                    $('#chq_tn').val(result[0].tenant);
                    $('#chq_rm').val(result[0].room);
                    $('#rm_id').val(result[0].rm_id);
                    $('#tn_id').val(result[0].tn_id);
                    $('#tn_4n').val(result[0].tn_4n);
                    $('#rec_id').val(result[0].receit_no);
                    $('#vat_id').val(result[0].amountx);
                }

            });
            $('#b_cheque_form').dialog({
                autoOpen: false,
                width: 340,
                //height: 334,
                resizable: false,
                modal: true,
                buttons:[
                    {
                        text: "Save",
                        "class": "btnSavex",
                        click: function(){
                            var rm_id = $('#rm_id').val();
                            var tn_id = $('#tn_id').val();
                            var tn_4n = $('#tn_4n').val();
                            var amount = $('#chq_am').val().replace(/,/g,'');
                            var chq_no = $('#chq_no').val();
                            var chq_pn = $('#chq_pn').val().replace(/,/g,'');
                            var chq_nt = $('#chq_nt').val();
                            var rec_id = $('#rec_id').val();
                            var real_amount = $('#vat_id').val();
                            if(chq_no!='Select Cheque' && chq_nt!='' && chq_pn!=''){
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>cheque/reg_bounced_cheque",
                                    dataType: 'json',
                                    data: {rec_id:rec_id,room:rm_id,tenant:tn_id,cheque:chq_no,penalty:chq_pn,amount:amount,details:chq_nt, real_amount:real_amount},
                                    success: function(response){
                                        if(response.status){
                                            $.ajax({
                                                type: 'POST',
                                                //url: "http://121.241.242.114:8080/bulksms/bulksms?username=cd1-cranemgtsys&password=cms123&type=0&dlr=1&&destination="++"&source=CMS&message=tenant%20message",
                                                url: "http://121.241.242.114:8080/bulksms/bulksms?",
                                                data:{
                                                    username:"cd1-cranemgtsys",
                                                    password:"cms123",
                                                    type:"0",
                                                    dlr:"1", 
                                                    //destination:telephone.replace(/-/g,'')+",256702604010", 
                                                    destination:tn_4n.replace(/-/g,''), 
                                                    source:"CMS", 
                                                    message:"Your Cheque; cheque Number: "+chq_no+" of amount: "+amount+" has been bounced and a penalty of "+chq_pn+" has been imposed on you."},
                             
                                                success : function()
                                                {
                                                        jAlert("Message sent");
                                                       // $("#mhhh").dialog( "close" );
                                                    
                                                }
                                             });
                                            jAlert('Bounced Cheque registered successfully','SUCCESS');
                                            $('#b_cheque_form').dialog('close');
                                            $('#chq_am').val('');
                                            $('#chq_tn').val('');
                                            $('#chq_rm').val('');
                                            $('#rm_id').val('');
                                            $('#tn_id').val('');
                                            $('#tn_4n').val('');
                                            $('#chq_nt').val('');
                                            $('#chq_pn').val('');
                                            $('#chq_no').val('Select Cheque');
                                            $('.selectEl').trigger("liszt:updated");
                                        }else{
                                            jAlert('An Error Occured','ERROR');
                                        }
                                    }
                                });
                            }else{
                                jAlert('Fill all required fields','ERROR');
                            }
                        }

                    },
                    {
                        text: "Cancel",
                        "class": "btnCancelx",
                        click: function(){
                            $('#chq_am').val('');
                            $('#chq_tn').val('');
                            $('#chq_rm').val('');
                            $('#rm_id').val('');
                            $('#tn_id').val('');
                            $('#tn_4n').val('');
                            $('#chq_nt').val('');
                            $('#chq_pn').val('');
                            $('#chq_no').val('Select Cheque');
                            $('.selectEl').trigger("liszt:updated");
                            $('#b_cheque_form').dialog("close");
                        }
                    }
                ]

            });


            function add_commas(nStr){
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }


        </script>


        <!-- Header -->

        <div id="header" style="margin: 0 2%;" class="wrapper">

            <div class="logo"><a href="/" title=""><img src="<?php echo base_url(); ?>images/CMSlogo_103.png" alt="" /></a></div>
            <div class="middleNav" >
                <?php
                $xb_id = $ci->session->userdata('building_id');
                //echo '>>>>>>>>>>'.$ci->session->userdata('building_id');
                ?>
                <?php
                if ($xb_id != null || $xb_id != '') {
//        <a href="'.base_url().'payments/view_payments">
                    //echo '>>>>>>>>>>'.$ci->session->userdata('building_id');

                    if($ci->session->userdata('name_group')!=2){
                    echo '
            <ul>
            <li class="iPay">
                <a id="d7" class="dropdown-toggle" data-toggle="dropdown" href="#" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><span><b>Payments</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'payments">Make Payment</a></div>
                    <div id="px" style="border-bottom: 1px solid #E4E4E4;"><a href="#">View Payments</a></div>
                </ul>
            </li>';
            if($ci->session->userdata('name_group')!=4){ echo '
            <li class="iOrders">
                <a id="d1" class="dropdown-toggle" data-toggle="dropdown" href="#"><span style="width:85px;"><b>Billing</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;" id="bill"><a href="#">Bill for rent</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'bills/umeme">Bill for UMEME</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'bills/rooms/' . $ci->session->userdata('building_id') . '">Bill per room</a></div>'.
                    '<div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'umeme/umeme_statement">UMEME bill statement</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a id="bill_state" href="#">Rent bill statement</a></div>
                </ul>
            </li>';}
                        echo '
            <li class="iSch">
                <a id="d2" class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>Payments Schedule</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'bills/schedule_payment/' . $ci->session->userdata('building_id') . '">Schedule payments</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'schedules/view_schedule/' . $ci->session->userdata('building_id') . '">View schedule</a></div>
                </ul>
            </li> 
            <li class="iRm"><a id="d3" href="' . base_url() . 'bills/view_rooms/' . $ci->session->userdata('building_id') . '" title=""><span><b>Rooms bill status</b></span></a></li>
            <li class="itBill"><a id="d4" href="' . base_url() . 'bills/view_tenants_bills/' . $ci->session->userdata('building_id') . '" title=""><span><b>Tenant bill status</b></span></a></li>
            <li class="icRates"><a id="d5" href="' . base_url() . 'currency/manage" title=""><span><b>Manage Rates</b></span></a></li>           
            ' . //<li class="ibCheq"><a id="dq" href="#" title="Bounced Cheques"><span><b>Bounced Cheques</b></span></a></li>
                    '<li class="ibCheq">
                <a id="dq" class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>Bounced Cheques</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;" id="dq1"><a href="#">Add Bounced Cheque</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'cheque">View bounced cheques</a></div>
                </ul>
            </li>
            <li class="ibCheq2">
                <a id="dq2" class="dropdown-toggle" data-toggle="dropdown" href="#"><span><b>Credit Adjustments</b></span></a>
                <ul class="dropdown-menu" style="text-align: left;list-style: none outside none;">
                    <div style="border-bottom: 1px solid #E4E4E4;" id="dq1xx"><a href="#">Make Adjustment</a></div>
                    <div style="border-bottom: 1px solid #E4E4E4;"><a href="' . base_url() . 'payments/cr">View Adjustments</a></div>
                </ul>
            </li>
            <li class="itNote"><a href="#" title="Add Notes" id="addnotes" style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;"><span><b>Add Notes</b></span></a></li>
        </ul>
        ';}
                }
                ?>


            </div>

            <div class="fix"></div>


        </div>
        <div id="billdialog" title="Building Billing Dialogue" style="display:none;">
            <p align ="center"><h4>You are about to bill the entire building. </h4></p></br>
            <p align ="center"><h4>Would You like to continue? </h4></p></br>
        </div>

        <!-- Rate registration form-->
        <div id="payx" title="Daily Payments" style="display:none;">
            <table style="width:300px;">                  
                <tr>
                    <th>Select Date: </th>
                    <td ><input type="text" name="regular" id="datex" class="datepicker"value=""/></td>
                </tr>         
            </table>
        </div>

        <!-- Rent Bill Statement Form-->
        <div id="rent_statement_x" title="Bill Statement" style="display:none;">
            <table style="width:300px;">
                <tr>
                    <td>Room: </td>
                    <td style="padding-left: 10px;vertical-align: middle;">
                        <select style="width:200px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="rent_rm_x" tabindex="2">
                            <option value="Select Option">Select Option</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        
        <script>
    
            $(function() {

                var domain = "<?php echo base_url(); ?>";
    
                //===============Rent Bill Statement===========================//
                $(document).on('click', '#bill_state', function() {
                    $.ajax({
                        type: "GET",
                        url:"<?php echo base_url(); ?>floors/all_rooms",
                        dataType:'json',
                        success: function(response){
                            $('#rent_rm_x').html(response.data);
                            $('.selectElement').chosen();
                            $('#rent_statement_x').dialog('open');
                        }
                        
                    });
                    
                });
                
                //===============Rent Bill Statement Dialog====================//
                $('#rent_statement_x').dialog({
                    autoOpen: false,
                    modal: true,
                    width: 400,
                    height: 250,
                    resizable: false,
                    buttons: [{
                                text: "View",
                                "class": "btnSavex",
                                click: function(){
                                        var rm_id = $('#rent_rm_x').val();
                                        window.location = domain+"bills/bill_statement/"+rm_id;
                                }
                            },{
                                text: "Close",
                                    "class": "btnCancelx",
                                    click: function(){
                                        $( "#rent_statement_x" ).dialog( "close" );
                                }}]
                });


                //==============Payments=======================================//
                $(document).on('click',"#px",function(){
                    $('.selectElement').chosen();
                    $('#payx').dialog('open');                  
                });
                $( "#payx" ).dialog({
                    autoOpen: false,
                    width: 400,
                    resizable: false,
                    modal: true,
                    buttons: [
                        {
                            text: "View",
                            "class": "btnSavex",
                            click: function(){
                                var datex = $('#datex').val();
                                if(datex!=''){
                                    //jAlert('Date: '+datex);
                                    window.location = domain+"payments/view_payments/"+datex;
                                   
                                }else{
                                    jAlert("Fill all required fields!","ERROR!");
                                }
                            }
                        },
                        {
                            text: "Close",
                            "class": "btnCancelx",
                            click: function(){
                                $( "#payx" ).dialog( "close" );
                            }
                        }
                    ]
                });
        
                //===========Building Billing dialog=======================//
                $(document).on('click',"#bill",function(){       
                    $('#billdialog').dialog('open');
                }); 
                ///=========billing building=================//
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

<div id="cr_form" title="Make Credit Adjustment" style="display:none;">
            <table width="93%">
                <input id="rc_vat" style="display:none;"/>
                <input id="rc_pay" style="display:none;"/>
                <input id="re_bal" style="display:none;"/>
                <input id="records_rm_id" style="display:none;"/>
                
                <tr>
                    <th style="vertical-align:top;">Receipt Number: </th>
                    <td style="width:60%;">
                        <select class="selectEl" style="width:200%;" id="rc_no">
                        </select><br>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:middle;">Old Amount: </th>
                    <td style="width:60%;">
                        <input style="text-align:center;" class="positivenumeric" disabled="true" type="text" name="regular" id="rc_am" value=""/>
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:middle;">New Amount: </th>
                    <td style="width:60%;">
                        <input class="positivenumeric" style="text-align:center;" type="text" name="regular" id="rc_nam" value=""/>
                    </td>
                </tr>
               
            </table>
        </div>
        <script>
        var options = null;
        $(document).on('click','#dq1xx',function(){
            $.ajax({
                type: "GET",
                url:"<?php echo base_url(); ?>payments/payments_made",
                dataType:'json',
                success: function(response){
                    options = response.options;
                    $('#rc_no').append('<option>Select Receipt Number</option>');

                    var index = 0;
                    $.each(response.options, function(index,value){
                        $('#rc_no').append('<option value="'+value.receipt+'">'+value.receipt+'</option>');

                        $('.selectEl').trigger("liszt:updated");
                    });
                    $('.selectEl').chosen();
                    $('#cr_form').dialog("open");
                }
            });

        });

         $(document).on('change','#rc_no',function(){
                var xn = $('#rc_no').val();
                if(xn == 'Select Receipt Number'){
                    $('#rc_am').val('');
                   
                }else{
                    var result = $.grep(options, function(e){ return e.receipt== xn; });
                    //console.log(JSON.stringify(result));
                    $('#rc_am').val(add_commas(result[0].ammount));
                    $('#records_rm_id').val(result[0].records_rm_id);
                    $('#rc_vat').val(add_commas(result[0].vat));   
                    $('#rc_pay').val(add_commas(result[0].pay_amount));  
                     $('#re_bal').val(add_commas(result[0].re_bal));      
                }

            });
         $('#cr_form').dialog({
                autoOpen: false,
                width: 340,
                height: 300,
                resizable: false,
                modal: true,
                buttons:[
                    {
                        text: "Save",
                        "class": "btnSavex",
                        click: function(){
                            var o_amount = $('#rc_am').val().replace(/,/g,'');
                            var n_amount= $('#rc_nam').val();
                            var rc_no = $('#rc_no').val();
                            var records_rm_id = $('#records_rm_id').val();
                            var rc_vat = $('#rc_vat').val();
                            var rc_pay = $('#rc_pay').val();
                            var re_bal = $('#re_bal').val();                            
                            if(rc_no!='Select Receipt Number' && o_amount!=''&& records_rm_id!='' && n_amount!=''){
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>payments/payments_edit",
                                    dataType: 'json',
                                    data: {rc_no:rc_no, records_rm_id:records_rm_id, n_amount:n_amount, rc_vat:rc_vat, rc_pay:rc_pay, o_amount:o_amount, re_bal:re_bal},
                                    success: function(response){
                                        if(response.status){
                                            jAlert('Transaction Edited Successfully','SUCCESS');                                            
                                            $('#rc_am').val('');
                                            $('#re_bal').val('');
                                            $('#records_rm_id').val('');
                                            $('#rc_nam').val('');   
                                            $('#rc_vat').val('');
                                            $('#rc_pay').val('');
                                            $('#rc_no').val('Select Receipt Number');
                                            $('#cr_form').dialog('close');                                        
                                        }else{
                                            jAlert('An Error Occured','ERROR');
                                        }
                                    }
                                });
                            }else{
                                jAlert('Fill all required fields','ERROR');
                            }
                        }

                    },
                    {
                        text: "Cancel",
                        "class": "btnCancelx",
                        click: function(){                           
                            $('#rc_am').val(''); 
                            $('#rc_nam').val(''); 
                            $('#records_rm_id').val(''); 
                            $('#rc_pay').val(''); 
                            $('#rc_vat').val('');
                            $('#re_bal').val('');   
                            $('#rc_no').val('Select Receipt Number');  
                            $(this).dialog('close');    
                        }
                    }
                ]

            });


        </script>


        <!-- Main wrapper -->

        <div class="wrapper" style="margin: 0 2%;">

