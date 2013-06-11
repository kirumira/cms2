
$(function() {

    var domain = "http://localhost/cms/";
    //var domain = "<?php echo base_url(); ?>";

    //===========Bounced Cheque Report=========================//
    $(document).on('click', '#bounced_report', function() {
        $.ajax({
            type: "POST",
            url: domain+"landlords/all_landlords",
            dataType: "json",
            success: function(response){
                if(response.status){
                    $( "#report_bounc_l" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#bounced_chq_report').dialog('open');
                }
            }
        });
        
    })

    //=========Bounced Cheque Report Dialog=====================//
    $('#bounced_chq_report').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var l_id = $('#report_bounc_l').val();
                    var s_date = $('#bounce_start').val();
                    var e_date = $('#bounce_end').val();
                     if((s_date!="")&&(e_date!='')){
                        $('#bounced_chq_report').dialog("close");
                        window.location = domain+"reports/bounced_report/"+l_id+"/"+s_date+"/"+e_date;
                     }else{jAlert('You must fill in the date fields');}
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#bounced_chq_report').dialog("close");
                }
        }]
    });


    //===========Daily General Report=========================//
    $(document).on('click', '#dai_gen_report', function() {
        $('#xxx').dialog('open');
    })

    //=========Daily General Report Dialog=====================//
    $('#xxx').dialog({
        autoOpen: false,
        width: 400,
        height: 200,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var s_date = $('#xxx_date').val();
                     if((s_date!="")){
                        $('#xxx').dialog("close");
                        window.location = domain+"reports/general_payments_report/"+s_date;                    
                     }else{jAlert('You must fill in the date fields');}
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#xxx').dialog("close");
                }
        }]
    });


    //=========Landlords Detailed Report=======================//
    $(document).on('click', '#land_report2', function() {
//        alert('Fake');
        $.ajax({
            type: "POST",
            url: domain+"landlords/all_landlords",
            dataType: "json",
            success: function(response){
                if(response.status){
                    $( "#report_l2" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#xl_report2').dialog('open');
                }
            }
        });
    })

    //=========Landlords Detailed Report Dialog=================//
    $('#xl_report2').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var l_id = $('#report_l2').val();
                    var s_date = $('#r_start_l2').val();
                    var e_date = $('#r_end_l2').val();
                     if((s_date!="")&&(e_date!="")){
                        if(l_id!='Select Option'){
                        $('#xl_report2').dialog("close");
                        window.location = domain+"reports/landlords_collections/"+l_id+"/"+s_date+"/"+e_date;
                    }
                     }else{jAlert('You must fill in the date fields');}
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#xl_report2').dialog("close");
                }
        }]
    });


    //=========daily Report===================//
    $(document).on('click', '#dai_report', function() {
        $('#dy_report').dialog('open');
    });

    //=========Daily Report Dialog==============//
    $('#dy_report').dialog({
        autoOpen: false,
        width: 400,
        height: 200,
        modal: true,
        buttons: [{
              text: "OK",
              "class": "btnSavex",
              click: function(){
                  var date = $('#dy_date').val();
                  //console.log(date);
                  $('#dy_report').dialog('close');
                  window.location = domain+"reports/daily_report/"+date;
              }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#dy_report').dialog("close");
                }
        }]
    });

    //=====Debtors Report====================//
    $(document).on('click', '#dr_report', function() {
        $('#d_report').dialog('open');
    });


    //===========Debtors Dialog================//
    $('#d_report').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function() {
                    var b_id = $('#D_report_val').val();
                    $('#d_report').dialog('close');
                    window.location = domain+"reports/debtors_report/"+b_id;
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#d_report').dialog("close");
                }
        }]
    });

    //=====Landlord Report=========//
    $(document).on('click', '#land_report', function(){
        $.ajax({
            type: "POST",
            url: domain+"landlords/all_landlords",
            dataType: "json",
            success: function(response){
                if(response.status){
                    $( "#report_l" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#l_report').dialog('open');
                }
            }
        });
    });

    //=====Landlord Report Dialog================//
    $('#l_report').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var l_id = $('#report_l').val();
                    var s_date = $('#r_start_l').val();
                    var e_date = $('#r_end_l').val();
                     if((s_date!="")&&(e_date!="")){
                        if(l_id!='Select Option'){
                        $('#l_report').dialog("close");
                        window.location = domain+"reports/landlords_report/"+l_id+"/"+s_date+"/"+e_date;
                    }
                     }else{jAlert('You must fill in the date fields');}
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#l_report').dialog("close");
                }
        }]
    });

    //=========Edit Room Balance===========================================//
    $(document).on('click', '#rm_balance_edit', function(){
        $.ajax({
            type: "POST",
            url: domain+"floors/all_rooms",
            dataType: 'json',
            success: function(response){
                if(response.status){
                    $( "#balance_rm" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#room_balance_edit').dialog('open');
                }
            }
        });
    });
    //====Edit Room Balance dialog====//
    $('#room_balance_edit').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var r_id = $('#balance_rm').val();
                    var credit = $('#balance_cr').val();
                    var debit = $('#balance_dr').val();
                    if((r_id!='Select Option')&&(credit!='')&&(debit!='')){                        
                        $.ajax({
                            type: "POST",
                            url: domain+"floors/edit_room_balance",
                            data: {room_id:r_id, credit:credit, debit:debit},
                            dataType: 'json',
                            success: function(response){
                                if(response.status){
                                    jAlert('Successfully updated room balance', 'SUCCESS');
                                    $('#room_balance_edit').dialog("close");
                                    window.location = domain+"bills/view_rooms2/";
                                }else{
                                    jAlert('There was an error editing the room balance', 'ERROR');
                                }
                            }
                        });
                    }else{
                        jAlert('Fill in all required fields', 'ERROR');
                    }
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#room_balance_edit').dialog("close");
                }
        }]
    });
    //=========Room Report===========================================//
    $(document).on('click', '#rm_report', function(){
        $.ajax({
            type: "POST",
            url: domain+"floors/all_rooms",
            dataType: 'json',
            success: function(response){
                if(response.status){
                    $( "#report_r" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#r_report').dialog('open');
                }
            }
        });
    });
    //====Room report dialog====//
    $('#r_report').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var r_id = $('#report_r').val();
                    var s_date = $('#r_start_r').val();
                    var e_date = $('#r_end_r').val();
                    if(r_id!='Select Option'){
                        $('#r_report').dialog("close");
                        window.location = domain+"reports/rooms_report/"+r_id+"/"+s_date+"/"+e_date;
                    }
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#r_report').dialog("close");
                }
        }]
    });

    //====Tenant Report======================//
    $(document).on('click', '#ten_report', function(){
        $.ajax({
            type: "POST",
            url: domain+"tenants/all_tenants",
            dataType: "json",
            success: function(response){
                if(response.status){
                    $( "#report_t" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#t_report').dialog('open');
                }
            }
        });
    });

    //=====Tenant Report Dialog=========================//
    $('#t_report').dialog({
        autoOpen: false,
        width: 400,
        height: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var t_id = $('#report_t').val();
                    var s_date = $('#r_start_t').val();
                    var e_date = $('#r_end_t').val();
                    if((s_date!="")&&(e_date!="")){
                        if(t_id!='Select Option'){
                            $('#t_report').dialog("close");
                            window.location = domain+"reports/tenants_report/"+t_id+"/"+s_date+"/"+e_date;
                        }
                    }else{
                        jAlert("You must fill in the date fields", "ERROR");
                    }
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#t_report').dialog("close");
                }
        }]
    });
    //=====Agent Report==================//
    $(document).on('click', '#agent_report', function() {
        window.location = domain+"reports/agent_report/";
    });

    //=====Pending Report==================//
    $(document).on('click', '#pending_report', function() {
        window.location = domain+"reports/pending_report/";
    });
    
    //=====Umeme Report==================//
    $(document).on('click', '#umem_report', function() {
        $.ajax({
            type: "POST",
            url: domain+"floors/all_rooms",
            dataType: "json",
            success: function(response){
                if(response.status){
                    $( "#report_um" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#um_report').dialog('open');
                }
            }
        });
    });

    //========Umeme Report Dialog============//
    $('#um_report').dialog({
         autoOpen: false,
         width: 290,
         height: 290,
         resizable: false,
         modal: true,
         buttons: [
             {
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var rm_id = $('#report_um').val();
                    var s_date = $('#um_start_r').val();
                    var e_date = $('#um_end_r').val();
                    if((s_date!="")&&(e_date!="")){
                        $('#um_report').dialog("close");
                        window.location = domain+"reports/Umeme_report/"+rm_id+"/"+s_date+"/"+e_date;
                    }else{
                        jAlert("You must fill in the date fields", "ERROR");
                    }

                }
             },{
                 text: "Cancel",
                 "class": "btnCancelx",
                click: function(){
                    $('#um_report').dialog("close");
                }
             }]
    });

     //====Building Report==========//
     $(document).on('click', '#build_report', function() {
         $('#b_report').dialog('open');
     });

     //======Building Report Dialog=========//
     $('#b_report').dialog({
         autoOpen: false,
         width: 290,
         resizable: false,
         modal: true,
         buttons: [
             {
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    //var b_id = $('#B_report_val').val();
                    var s_date = $('#r_start').val();
                    var e_date = $('#r_end').val();
                    if((s_date!="")&&(e_date!="")){
                        $('#b_report').dialog("close");
                        window.location = domain+"reports/building_report/"+s_date+"/"+e_date;
                    }else{
                        jAlert("You must fill in the date fields", "ERROR");
                    }

                }
             },{
                 text: "Cancel",
                 "class": "btnCancelx",
                click: function(){
                    $('#b_report').dialog("close");
                }
             }]
     });
     //================Floor plan upload=======================================//
     $(document).on('click', '#flr_plan', function() {
        $.ajax({
             type: 'POST',
             url: domain+"floors/get_all_floors",
             dataType: 'json',
             success: function(response) {
                 if(response.status){
                    $( "#all_flrs" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#fPlanUpload').dialog('open');
                 }
             }
         });
     });

     //==============Floor Plan Upload Dialog=============================//
     $('#fPlanUpload').dialog({
         autoOpen: false,
         width: 400,
         height: 400,
         resizable: false,
         modal: true,
         buttons:[{
            text: "Upload",
            "class": "btnSavex",
            click: function(){
                var f_id = $('#all_flrs').val();
                //alert(">>"+l_id);

                $.ajaxFileUpload({
                    type         :   "POST",
//                    url          :   domain+"upload/uploadLandlordImage",
                    url: domain+"upload2/uploadFloorPlan",
                    dataType     :   "json",
                    fileElementId:   'txtURL16',
                    data         :   {
                        'title':'File Uploading',
                        floor_id:f_id
                    },
                    success      :   function(response){
                        if(response.status){
                            $('#fPlanUpload').dialog("close");
                            jAlert('File Uploaded Successfully', 'OK');
                        }else{
                            jAlert(response.msg,"ERROR!");
                        }
                    },
                    error        :   function(response){
                        jAlert(response.msg,"ERROR!");
                    }
                });

            }
        },
        {
            text: "Cancel",
            "class": "btnCancelx",
            click: function(){
                $('#fPlanUpload').dialog("close");
            }
        }
        ]
     });




     //================Tenant Document Upload==================================//
     $(document).on('click', '#addtenDocs', function (){
         $.ajax({
             type: 'POST',
             url: domain+"tenants/all_tenants",
             dataType: 'json',
             success: function(response) {
                 if(response.status){
                    $( "#all_tens_xr" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#tdocupload').dialog('open');
                 }
             }
         });
     });

     //==============Tenant Document Upload Dialog=============================//
     $('#tdocupload').dialog({
         autoOpen: false,
         width: 400,
         height: 400,
         resizable: false,
         modal: true,
         buttons:[{
            text: "Upload",
            "class": "btnSavex",
            click: function(){
                var l_id = $('#all_tens_xr').val();
                //alert(">>"+l_id);

                $.ajaxFileUpload({
                    type         :   "POST",
//                    url          :   domain+"upload/uploadLandlordImage",
                    url: domain+"upload2/uploadDoc",
                    dataType     :   "json",
                    fileElementId:   'txtURL15',
                    data         :   {
                        'title':'File Uploading',
                        tenant_id:l_id
                    },
                    success      :   function(response){
                        if(response.status){
                            //alert(response.status);
                            $('#tdocupload').dialog("close");
                            //$('#logoPreview').attr('src', response.path);
                            //$('#previewx').dialog("open");
                            jAlert('File Uploaded Successfully', 'OK');
                        }else{
                            jAlert(response.msg,"ERROR!");
                        }
                    },
                    error        :   function(response){
                        jAlert(response.msg,"ERROR!");
                    }
                });

            }
        },
        {
            text: "Cancel",
            "class": "btnCancelx",
            click: function(){
                $('#tdocupload').dialog("close");
            }
        }
        ]
     });

     //=========View Tenant Documents==========================//
     $(document).on('click', '#viewtenDocs', function() {
         $.ajax({
             type: 'POST',
             url: domain+"tenants/all_tenants",
             dataType: 'json',
             success: function(response) {
                 if(response.status){
                    $( "#all_tens_dx" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#show_ten_doc').dialog('open');
                 }
             }
         });
     });

     //============Show Tenant Documents Dialog==============================//
     $('#show_ten_doc').dialog({
         autoOpen: false,
         width: 400,
         height: 400,
         resizable: false,
         modal: true,
         buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    $(this).dialog("close");
                    var ten_id = $('#all_tens_dx').val();
                    window.location = domain+"tenants/view_files/"+ten_id;
                }
         },{
             text: "Cancel",
                "class": "btnSavex",
                click: function(){
                    $(this).dialog("close");
                }
         }]
     });


    //====Landlord pic upload==========//
    $(document).on('click',"#upload_l_pic",function(){
        $.ajax({
            type: 'GET',
            url: domain+"landlords/all_landlords",
            success : function(response)
            {
                if(response.status){
                    $( "#all_landlords" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#lpicupload').dialog('open');
                }
            },
            dataType: 'json'
        });
    });

    $('#ldialogdel').dialog({
        autoOpen: false,
        width: 290,
        resizable: false,
        modal: true,
        buttons:[
        {
            text: "OK",
            "class": "btnSavex",
            click: function(){
                $(this).dialog("close");
            }
        }
        ]
    });

    $('#lpicupload').dialog({
        autoOpen: false,
        width: 410,
        height:300,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Upload",
            "class": "btnSavex",
            click: function(){
                var l_id = $('#all_landlords').val();
                //alert(">>"+l_id);

                $.ajaxFileUpload({
                    type         :   "POST",
//                    url          :   domain+"upload/uploadLandlordImage",
                    url: domain+"upload2/uploadImage",
                    dataType     :   "json",
                    fileElementId:   'txtURL1',
                    data         :   {
                        'title':'Image Uploading',
                        landlord_id:l_id
                    },
                    success      :   function(response){
                        if(response.status){
                            //alert(response.status);
                            $('#lpicupload').dialog("close");
                            $('#logoPreview').attr('src', response.path);
                            $('#previewx').dialog("open");
                        }else{
                            jAlert(response.msg,"ERROR!");
                        }
                    },
                    error        :   function(response){
                        jAlert(response.msg,"ERROR!");
                    }
                });

            }
        },
        {
            text: "Cancel",
            "class": "btnCancelx",
            click: function(){
                $('#lpicupload').dialog("close");
            }
        }
        ]
    });

     //====System User pic upload==========//
    $(document).on('click',"#upload_user_pic",function(){

        $.ajax({
            type: 'GET',
            url: domain+"users/all_users",
            success : function(response)
            {
                if(response.status){
                    $( "#all_users" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#upicupload').dialog('open');
                }
            },
            dataType: 'json'
        });
    });

    $('#upicupload').dialog({
        autoOpen: false,
        width: 410,
        height:300,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Upload",
            "class": "btnSavex",
            click: function(){
                var u_id = $('#all_users').val();
                //alert(">>"+l_id);

                $.ajaxFileUpload({
                    type         :   "POST",
//                    url          :   domain+"upload/uploadLandlordImage",
                    url: domain+"upload3/uploadImage",
                    dataType     :   "json",
                    fileElementId:   'txtURL2',
                    data         :   {
                        'title':'Image Uploading',
                        user_id:u_id
                    },
                    success      :   function(response){
                        if(response.status){
                            //alert(response.status);
                            $('#lpicupload').dialog("close");
                            $('#logoPreview').attr('src', response.path);
                            $('#previewx').dialog("open");
                        }else{
                            jAlert(response.msg,"ERROR!");
                        }
                    },
                    error        :   function(response){
                        jAlert(response.msg,"ERROR!");
                    }
                });

            }
        },
        {
            text: "Cancel",
            "class": "btnCancelx",
            click: function(){
                $('#upicupload').dialog("close");
            }
        }
        ]
    });
})