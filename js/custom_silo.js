
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
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
    $(document).ready(function(){ 
        $('.positivenumeric').numeric();
        $('.positivenumeric').keyup(function(){
            var n = $(this).val().replace(/,/g, '');
            $(this).val(add_commas(n));
        });
    });
    function add_dashes(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '-' + '$2');
        }
        return x1 + x2;
    }
    $(document).ready(function(){ 
        $('.phonenumeric').numeric();
        $('.phonenumeric').keyup(function(){
            var n = $(this).val().replace(/-/g, '');
            $(this).val(add_dashes(n));
        });
    });
    var domain = "http://localhost/cms/";

    //===========Building Registration=======================//

    $(document).on('click',"#regbuildingform",function(){
        //alert('here');
        
        $('.selectElement').chosen();
        //$('#buildingreg').empty();
        //$('#buildingreg').parent().appendTo($('#xform'));
        $('#buildingreg').dialog('open');
    });
    //===========Currency Registration=======================//
    $(document).on('click',"#curregform",function(){
        //alert('here');
        
        $('.selectElement').chosen();
        $('#curreg').dialog('open');
    }); 
    //===========Tenant Registration=======================//
    $(document).on('click',"#regtenantform",function(){
        //alert('here');
        $.ajax({
            type: 'GET',
            url: domain+"buildings/get_free_rooms",
            dataType: 'json',
            success: function(response){
                    $('#regtroom').html(response.drops);
                    $.ajax({
                        type: 'GET',
                        url: domain+"users/get_all_agents",
                        dataType: 'json',
                        success: function(response){
                                $('#agentName2').html(response.dataX);
                                $('.selectElement').chosen();
                                $('#tenantreg').dialog('open');                
                        }
                    });                 
            }
        });
        
        
    }); 
  //===========Landlord Registration=======================//
    $(document).on('click',"#landlordreg",function(){
        $.ajax({
            type: "GET",
            url: domain+"landlords/reg_form",
            success: function(response)
            {
                if(response.logged_out){
                    window.location = domain+'login';
                }else{
                    $('#landlordregform').html(response);
                    $('.selectElement').chosen();
                    $('#landlordregform').dialog('open');
                }

            },
            dataType: 'html'
        });

    });
    $('#landlordregform').on("change",'#reglgroup',function(){
        var grp = $('#reglgroup').val();
        if(grp == 'New'){
            $('#n_grp').show();
        }else{
            $('#n_grp').hide();
        }
    });

    $( "#landlordregform" ).dialog({
        autoOpen: false,
        width: 350,
        modal: true,
        resizable: false,
        buttons: [
        {
            text: "Register",
            "class": 'btnSavex',
            click: function() {
                var f_name = $('#reglfname').val();
                //var l_name = '()';//$('#regllname').val();
                var email = $('#reglemail').val();
                var pass = $('#reglpass').val();
                var telephone = $('#regltel').val();
                var group = $('#reglgroup').val();
                var grpType = 'Old';
                if(group == 'New'){
                    group = $('#reglnewgrpname').val();
                    grpType = 'New';
                }

                //alert(grpType);
                if(f_name!='' && email!='' &&pass!='' && telephone!='' && group!='Select Option'){
                    $.ajax({
                        type: "POST",
                        url: domain+"landlords/add",
                        data: {
                            f_name:f_name,
                            pass:pass,
                            email:email,
                            telephone:telephone,
                            group:group,
                            grpType:grpType
                        },
                        success: function(response)
                        {
                            if(response.logged_out){
                                window.location = domain+"login";
                            }else{
                                if(response.status){
                                    $('#landlordregform').dialog('close');
                                    jAlert('<b>'+f_name+' </b> registered successfully!','SUCCESS!');
                                    window.location = domain+"landlords";
                                } else{
                                    jAlert('The landlord you have entered alresdy exists in the system');
                                }
                            }

                        },
                        dataType: 'json'
                    });
                }else{
                    jAlert("Fill all required fields!","ERROR!");
                }
            }
        },
        {
            text: "Cancel",
            "class": 'btnCancelx',
            click: function() {
                $( "#landlordregform" ).dialog( "close" );
            }
        }
        ]

    });
    //===========register Currency completion=======================//
    $( "#curreg" ).dialog({
        autoOpen: false,
        width: 400,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Register",
            "class": "btnSavex",
            click: function(){
                var currency = $('#cur').val();
                var rate = $('#rate').val();                        
                if(currency!='' && rate!=''){
                    $.ajax({
                        type: 'POST',
                        url: domain+"currency/cur",
                        data:{
                            currency:currency,
                            rate:rate
                        },
                        success : function(response)
                        {
                            if(response.status){                                            
                                $( "#curreg" ).dialog("close");
                                window.location = domain+"currency/manage";
                            }                                        
                        },
                        dataType: 'json'
                    });
                }else{
                    jAlert("Fill all required fields!","ERROR!");
                }
            }
        },
        {
            text: "Cancel",
            "class":"btnCancelx",
            click: function(){
                $( "#curreg" ).dialog( "close" );
            }
                    
        }
        ]
               
    });

    //===========Agent Registration=======================//
    $(document).on('click',"#agentRegister",function(){
        //alert('here');
        $('#agentReg').dialog('open');        
    });
    
    //===========Agent Registration Dialog=======================//
    $( "#agentReg" ).dialog({
        autoOpen: false,
        width: 350,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Add",
            "class": 'btnSavex',
            click: function() {
                var name = $('#agentName').val();
                var phone = $('#agentPhone').val();
                
                    if(name!='' && phone!=''){
                        $.ajax({
                            type: "POST",
                            url: domain+"users/add_agent",
                            data: {
                                name:name,
                                phone:phone
                            },
                            success: function(response)
                            {
                                if(response.status){
                                    $( "#agentReg" ).dialog( "close" );
                                    jAlert('<b>'+name+'</b> registered successfully!','SUCCESS!');
                                }
                            },
                            dataType: 'json'
                        });
                    }else{
                        jAlert("Fill in all required fields!");
                    }
                
            }
        },
        {
            text: "Close",
            "class": 'btnCancelx',
            click: function() {
                $( "#agentReg" ).dialog( "close" );
            }
        }
        ]
    });

    //===========Admin Registration=======================//
    $(document).on('click',"#adminreg",function(){
        //alert('here');
        $.ajax({
            type: "GET",
            url: domain+"users/reg_form",
            success: function(response)
            {
                $('#adminregform').html(response);
                $('.selectElement').chosen();
                $('#adminregform').dialog('open');
            },
            dataType: 'html'
        });
        
    });
    
    $( "#adminregform" ).dialog({
        autoOpen: false,
        width: 350,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Register",
            "class": 'btnSavex',
            click: function() {
                var f_name = $('#regufname').val();
                var l_name = $('#regulname').val();
                var email = $('#reguemail').val();
                var pass1 = $('#regupw').val();
                var pass2 = $('#regucpw').val();
                var u_type = $('#regugroup').val();
                if(pass1!=pass2){
                    jAlert("Passwords dont match!","ERROR!");
                }else{
                    if(f_name!='' && l_name!='' && email!='' && pass1!='' && pass2!='' && u_type!='Select Option'){
                        $.ajax({
                            type: "POST",
                            url: domain+"users/add",
                            data: {
                                f_name:f_name,
                                l_name:l_name,
                                email:email,
                                pass:pass1,
                                u_type:u_type
                            },
                            success: function(response)
                            {
                                if(response.status){
                                    $( "#adminregform" ).dialog( "close" );
                                    jAlert('<b>'+f_name+' '+l_name+'</b> registered successfully!','SUCCESS!');
                                    window.location = domain+"users";
                                }
                            },
                            dataType: 'json'
                        });
                    }else{
                        jAlert("Fill in all required fields!");
                    }
                }
            }
        },
        {
            text: "Close",
            "class": 'btnCancelx',
            click: function() {
                $( "#adminregform" ).dialog( "close" );
            }
        }
        ]
    });
    
    
    //=============Tenant more info====================//
    $("#tdialoginfo").dialog({
        autoOpen: false,
        resizable: false,
        width: 290,
        modal: true,
        buttons:[
        {
            text: "OK",
            "class": 'btnSavex',
            click: function() {
                $(this).dialog( "close" );
            }
        }
        ]
    });

    $(document).on('click',"tr .tinfo",function(){
        var tenant_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"tenants/tenant_details",
            data:{
                tenant_id:tenant_id
            },
            success : function(response)
            {
                
                if(response.status){
                    $('#infotname').html(response.data.f_name+' '+response.data.lname);
                    $('#infotemail').html(response.data.email);
                    $('#infottel1').html(response.data.phone1);
                    $('#infottel2').html(response.data.phone2);
                    $('#infottel3').html(response.data.phone3);
                    $('#infotcontp').html(response.data.c_person);
                    $('#infotcontptel').html(response.data.telephone);
                    $('#infotstart').html(response.data.s_date);
                    $('#infotend').html(response.data.h_date);
                    $('#infotdpay').html(response.data.d_pay);
                    $('#infotstatus').html(response.data.status);
                    $('#infotpurpose').html(response.data.purpose);s
                    $('#t_pic').attr('src', response.data.tpath);
                    
                    $('#tdialoginfo').dialog('open');
                }
            },
            dataType:'json'
        });
        return false;
    });
    //=============================edit tenant====================//
    $(document).on('click',"tr .tedit",function(){
        var tenant_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"tenants/tenant_details",
            data:{
                tenant_id:tenant_id
            },
            success : function(response)
            {
                if(response.status){
                    $('#tenant_id').val(tenant_id);
                    $('#edittfname').val(response.data.f_name);
                    $('#edittlname').val(response.data.lname);
                    $('#edittemail').val(response.data.email);
                    $('#editttel1').val(response.data.phone1);
                    $('#editttel2').val(response.data.phone2);
                    $('#editttel3').val(response.data.phone3);
                    $('#edittcontp').val(response.data.c_person);
                    $('#edittcontptel').val(response.data.telephone);
                    $('#edittstart').val(response.data.s_date);
                    $('#edittend').val(response.data.h_date);
                    $('#edittdpay').val(response.data.d_pay);
                    $('#edittstatus').val(response.data.status);
                    $('#edittpurpose').val(response.data.purpose);
                    $('#flr_name').val(response.data.floor);
                    
                    $('.selectElement').chosen();
                    $('.selectElement').trigger("liszt:updated");
                    $('#tdialogedit').dialog('open');//tenantreg
                }
            },
            dataType:'json'
        });
        return false;
    });
    
    $( "#tdialogedit" ).dialog({
        autoOpen: false,
        width: 835,
        resizable: false,
        modal: true,            
        buttons: [
        {
            text: "Edit",
            "class": 'btnSavex',
            click: function() {
                var tenant_id = $('#tenant_id').val();
                var flr_name = $('#flr_name').val();
                var floor = $('#t_fl_'+tenant_id).html();
                var room = $('#t_rm_'+tenant_id).html();
                var fname = $('#edittfname').val();
                var lname = $('#edittlname').val();
                var telephone = $('#editttel1').val();
                var email = $('#edittemail').val();
                var c_phone = $('#edittcontptel').val();
                var phone_2 = $('#editttel2').val();//0704931550
                var phone_3 = $('#editttel3').val();
                var c_person = $('#edittcontp').val();
                var purpose = $('#edittpurpose').val();
                var s_date = $('#edittstart').val();
                var h_date = $('#edittend').val();
                var d_payment = $('#edittdownp').val();
                var status = $('#edittstatus').val();
                ////

                if(tenant_id!='' && fname!='' && telephone!='' && s_date!=''  && h_date!='' && d_payment!='' && status!=''){
                    $.ajax({
                        type: 'POST',
                        url: domain+"tenants/edit",
                        data:{
                            room:room,
                            floor:floor,
                            flr_name:flr_name,
                            tenant_id:tenant_id,
                            status:status,
                            f_name:fname,
                            name_last:lname,
                            telephone1:telephone,
                            email:email,
                            telephone:c_phone,
                            telephone2:phone_2,
                            telephone3:phone_3,
                            cp:c_person,
                            purpose:purpose,
                            s_date:s_date,
                            h_date:h_date,
                            d_pay:d_payment
                        },
                        success : function(response)
                        {
                            if(response.status){                                            
                                $( "#tdialogedit" ).dialog("close");
                                jAlert("Tenant details changed successfully!","SUCCESS!");
                                //window.location = domain+"tenants";
                                $('#pdialogedit').dialog( "close" );
                                    var editrow=response.row;
                                    var index = $('#ten_'+tenant_id).closest("tr").get(0);
                                    dynamic.dynptable.fnDeleteRow(dynamic.dynptable.fnGetPosition(index));
                                    //console.log(editrow);
                                    dynamic.dynptable.fnAddTr($(editrow)[0],true);
                            }                                        
                        },
                        dataType: 'json'
                    });
                }else{
                    jAlert("Fill all required fields!","ERROR!");
                }
            }
        },
        {
            text: "Close",
            "class": 'btnCancelx',
            click: function() {
                $( "#tdialogedit" ).dialog( "close" );
            }
        }
        ]
    });
    
    ///=========tenant delete===================//
    $("#tdialogdel").dialog({
        autoOpen: false,
        width: 395,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Yes",
            "class": "btnSavex",
            click: function(){
                var tenant_id = $('#dten_id').val();
                $.ajax({
                    type: "POST",
                    url: domain+"tenants/delete",
                    data:{
                        tenant_id:tenant_id
                    },
                    success : function(response)
                    {          
                        if(response.status){                                        
                            $("#tdialogdel").dialog("close");
                            window.location = domain+"tenants";
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
                $("#tdialogdel").dialog("close");
            }
        }
        ]
    });
    
    $(document).on('click',"tr .tdel",function(){
        var tenant_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"tenants/del_info",
            data:{
                tenant_id:tenant_id
            },
            success : function(response)
            {
                $('#dten_id').val(tenant_id);
                $('p #deltname').html(response.tname);
                $('#tdialogdel').dialog('open');

            },
            dataType:'json'
        });
        return false;
    });
    
    

    //===========Building Registration completion=======================//
    function b_reg_validate(){
        //$.validity.setup({ outputMode:"modal" });
        //$.validity.setup({ outputMode:"summary" });
        $. validity. start ();
        $("#regbname,#regaddress,#regfloors,#regtown,#regdistrict,#regpropno,#regplotno,#regstreetname,#regblockno").require();
        var  result =  $. validity. end ();
        return result.valid;
    }    
    
    $( "#buildingreg" ).dialog({
        autoOpen: false,
        width: 790,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Register",
            "class": "btnSavex",
            click: function(){
                var name = $('#regbname').val();
                var p_o_box = $('#regaddress').val();
                var landlord = $('#reglandlord').val();
                var floors = $('#regfloors').val();
                var towns = $('#regtowns').val();
                var district = $('#regdistrict').val();
                var manager = $('#regmanager').val();
                var type = $('#regtype').val();
                var property_no = $('#regpropno').val();
                var plot = $('#regplotno').val();
                var street = $('#regstreetname').val();
                var block = $('#regblockno').val();
                var currency = $('#regcurrency').val();                
                var str = '';
                if(landlord=='Select Option'){str += 'landlord, ';}
                if(manager=='Select Option'){str += 'manager, '}
                if(type=='Select Option'){str += 'type, '}
                if(str != ''){
                    jAlert('<b>'+str+' </b> not selected!','ERROR!');                        
                }else{
                    //$('#xform').submit();
                    if(b_reg_validate()){
                    //if(name!='' && p_o_box!='' && landlord!='Select Option' && floors!='' && towns!=''  && district!='' && manager!='Select Option' && type!='Select Option' && property_no!=''  && plot!='' && street!='' && block!='' && currency!=''){
                        $.ajax({
                            type: 'POST',
                            url: domain+"buildings/add",
                            data:{
                                name:name,
                                p_o_box:p_o_box,
                                landlord:landlord,
                                floors:floors,
                                towns:towns,
                                district:district,
                                manager:manager,
                                type:type,
                                property_no:property_no,
                                plot:plot,
                                street:street,
                                block:block,
                                currency:currency
                            },
                            success : function(response)
                            {
                                if(response.status){                                            
                                    $( "#buildingreg" ).dialog("close");
                                    window.location = domain+"buildings";
                                }else{
                                    jAlert(response.msg,"ERROR!");
                                }
                            },
                            dataType: 'json'
                        });
                    }else{

                    }
                }                  
            }
        },
        {
            text: "Close",
            "class": "btnCancelx",
            click: function(){
                $('.validity-tooltip').remove();
                $( "#buildingreg" ).dialog( "close" );
            }
        }
        ]
    });
    
    
    //===========register Tenant completion=======================//
    
    function isUnique(element,e1,e2,e3){
        var status = true;
        if(element.value==$(e1).val()||element.value==$(e2).val()||element.value==$(e3).val()){
            if(element.value!='' || (element.value)!=undefined){
                console.log('here>>'+element.value);
                status=false;
            }
        }
        return status;
    }
    function isUnique1(element){
        var status = true;
        if(element.value==$('#regtconttel').val()||element.value==$('#regttel2').val()){if(element.value!=''){status=false;}}
        return status;
    }
    function isUnique2(element){
        var status = true;
        if(element.value==$('#regttel1').val()||element.value==$('#regttel2').val()){if(element.value!=''){status=false;}}
        return status;
    }
    function isUnique3(element){
        var status = true;
        if(element.value==$('#regttel1').val()||element.value==$('#regtconttel').val()){if(element.value!=''){status=false;}}
        return status;
    }
    function isUniquex(element){
        var status = true;
        if(element.value<$('#regtend').val()){if(element.value!=''){status=false;}}
        return status;
    }
    function t_reg_validate(){
        $. validity. start ();
        $('#regtfname,#regtlname,#regtpurpose,#regtdownp').require();
       // $('#regtemail').require().match('email');
        $('#regttel1').require().assert(isUnique1,'Telephone 1 must be unique!').minLength(15).maxLength(15);
        $('#regtconttel').assert(isUnique2,'Telephone number must be unique!').minLength(0).maxLength(15);
        $('#regttel2').assert(isUnique3,'Telephone number must be unique!');
        $('#regtstart').assert(isUniquex,'The Start date should come after the handover date!');
        if($('#regttel2').val()!=''){$('#regttel2').minLength(15).maxLength(15);}
        var  result =  $. validity. end ();
        return result.valid;
    }
    var entered = false;
    $( "#tenantreg" ).dialog({
        autoOpen: false,
        width: 800,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Register",
            "class": "btnSavex",
            click: function(){
                var fname = $('#regtfname').val();
                var lname = $('#regtlname').val();
                var telephone = $('#regttel1').val();
                var email = $('#regtemail').val();
                var c_phone = $('#regtconttel').val();
                var phone_2 = $('#regttel2').val();//0704931550
//                var phone_3 = $('#regttel3').val();
                var c_person = $('#regtcontactp').val();
                var purpose = $('#regtpurpose').val();
                var s_date = $('#regtstart').val();
                var h_date = $('#regtend').val();
                var d_payment = $('#regtdownp').val().replace(/,/g,'');
                var deposit = $('#regtsecdep').val().replace(/,/g,'');
                var room_id = $('#regtroom').val();
                var agent = $('#agentName2').val();
                var str1 = '';
                if(room_id=='Select Option'){str1+='room';}
                if(str1!=''){
                    jAlert('<b>'+str1+' </b>not selected!','ERROR!');
                }else{
                    //console.log('>>'+t_reg_validate());
                    //if(fname!='' && lname!='' && telephone!='' && email!='' && c_phone!='' && phone_2!=''  && phone_3!='' && c_person!='' && purpose!='' && s_date!=''  && h_date!='' && d_payment!='' && deposit!='' && room_id!='Select Option'){
                    if(t_reg_validate()){
                        $.ajax({
                            type: 'POST',
                            url: domain+"tenants/add",
                            data:{
                                f_name:fname,
                                l_name:lname,
                                telephone:telephone,
                                email:email,
                                c_phone:c_phone,
                                telephone2:phone_2,
                                //telephone3:phone_3,
                                cp:c_person,
                                purpose:purpose,
                                s_date:s_date,
                                h_date:h_date,
                                d_pay:d_payment,
                                deposit:deposit,
                                room:room_id,
                                agent:agent
                            },
                            success : function(response)

                            {
                  
                                if(response.status){  
                                     
                                    $.ajax({
                                        type: 'GET',
                                        url: domain+"buildings/get_free_rooms",
                                        dataType: 'json',
                                        success: function(response){
                                            $('#regtroom').html(response.drops);
                                            $('.selectElement').chosen();
                                            $('.selectElement').trigger("liszt:updated");
                                            $('#regtfname').val('');
                                            $('#regtlname').val('');
                                            $('#regttel1').val('');
                                            $('#regtemail').val('');
                                            $('#regtconttel').val('');
                                            $('#regttel2').val('');//0704931550
                                            //$('#regttel3').val('');
                                            $('#regtcontactp').val('');
                                            $('#regtpurpose').val('');
                                            $('#regtstart').val('');
                                            $('#regtend').val('');
                                            $('#regtdownp').val('');
                                            $('#regtsecdep').val('');
                                            $('#agentName2').val('');
                                            //$('#tenantreg').dialog('open');

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
                                                    destination:telephone.replace(/-/g,''), 
                                                    source:"CMS", 
                                                    message:fname+" "+lname+", you have been successfully registered as our tenant. Thanks"},
                             
                                                success : function()
                                                {
                                                        jAlert("Message sent");
                                                       // $("#mhhh").dialog( "close" );
                                                    
                                                }
                                             });
                                        }
                                    });

                                        jAlert("Tenant successfully Added.", "SUCCESS")
                                    entered = true;
                                    //window.location = domain+"tenants";
                                } else{
                                    jAlert(response.msg,"ERROR!");
                                }
                            },
                            dataType: 'json'
                        });
                    }
                    
                }                 
            }                        
        },
        {
            text: "Close",
            "class": "btnCancelx",
            click: function(){
                $('.validity-tooltip').remove();
                $('#regtfname').val('');
                $('#regtlname').val('');
                $('#regttel1').val('');
                $('#regtemail').val('');
                $('#regtconttel').val('');
                $('#regttel2').val('');//0704931550
                //$('#regttel3').val('');
                $('#regtcontactp').val('');
                $('#regtpurpose').val('');
                $('#regtstart').val('');
                $('#regtend').val('');
                $('#regtdownp').val('');
                $('#regtsecdep').val('');
                $('#regtroom').val('Select Option');
                $('#agentName2').val('Select Option');
                $('.selectElement').trigger("liszt:updated");
                if(entered){
                    entered = false;
                    window.location = domain+"tenants";
                    $( "#tenantreg" ).dialog( "close" );
                }else{
                    entered = false;
                    $( "#tenantreg" ).dialog( "close" );
                }
                
                
            }
        }
        ]
    });
    
    //====tenant pic upload==========//
    $(document).on('click',"#upload_t_pic",function(){
        $.ajax({
            type: 'GET',
            url: domain+"tenants/all_tenants",                
            success : function(response)
            {
                if(response.status){                                            
                    $( "#all_tenants" ).html(response.data);
                    $('.selectElement').trigger("liszt:updated");
                    $('.selectElement').chosen();
                    $('#tpicupload').dialog('open');
                }                                        
            },
            dataType: 'json'
        });         
    }); 
    //    $('#txtURL').on('change', function(){
    //        $('#logoPreview').attr('src', $('#txtURL').val());
    //    });
    $('#previewx').dialog({
        autoOpen: false,
        width: 290,
        resizable: false,
        modal: true,
        buttons:[
        {
            text: "OK",
            "class": "btnSavex",
            click: function(){
                $('#previewx').dialog("close");
            }
        }
        ]
    });
    
    $('#tpicupload').dialog({
        autoOpen: false,
        width: 360,
        height:300,
        //resizable: false,
        modal: true,
        buttons: [
        {
            text: "Upload",
            "class": "btnSavex",
            click: function(){
                var tenant_id = $('#all_tenants').val();
                $.ajaxFileUpload({
                    type         :   "POST",
                    url          :   domain+"upload/uploadImage",
                    dataType     :   "json",
                    fileElementId:   'txtURL',
                    data         :   {
                        'title':'Image Uploading',
                        tenant_id:tenant_id
                    },
                    success      :   function(response){
                        if(response.status){
                                
                            $('#tpicupload').dialog("close");
                            $('#logoPreview').attr('src', response.path);
                            $('#previewx').dialog("open");
                        }else{
                            jAlert("Unexpected error occured!","ERROR!");
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
                $('#tpicupload').dialog("close");
            }
        }
        ]
    });

    //=================================================Payments================================================//
    $(document).on('click',"#make_payment",function(){
        $.ajax({
            type: 'GET',
            url: domain+"bills/make_payment_form_drops",
            success : function(response)
            {
                console.log(response.drops);                                       
            },
            dataType: 'json'
        });
        $('.selectElement').chosen();
        $('#paymentform').dialog("open");
    });
    $('#paymentform').dialog({
        autoOpen: false,
        width: 420,
        resizable: false,
        modal: true,
        buttons: [
        {
            text: "Register",
            "class": "btnSavex",
            click: function(){
                   
            }
        },
        {
            text: "Cancel",
            "class": "btnCancelx",
            click: function(){
                $('#paymentform').dialog("close");
            }
        }
        ]
    });
    
    //=========================Notes==================================//
    
    $(document).on('click','#addnotes',function(){
        $('.selectEl').chosen();
        $('#addnotedialog').dialog("open");
    });
    var xtenants = null;
    var xrooms = null;
    var xfloors = null;
    var xbuildings = null;
    $.ajax({
        type: "GET",
        url: domain+"buildings/get_notes_info",
        dataType: 'json',
        success: function(response){
            //alert(response);
            xtenants = response.tenants;
            xrooms = response.rooms;
            xfloors = response.floors;
            xbuildings = response.buildings;
        }
    });
    $('#addnotedialog').on('change','#xtype',function(){        
        var type = $('#xtype').val();
        if(type=='Tenant'){
            $('#xnames').html(xtenants);
            $('.selectEl').trigger("liszt:updated");
        }else if(type=='Room'){
            $('#xnames').html(xrooms);
            $('.selectEl').trigger("liszt:updated");
        }else if(type=='Floor'){
            $('#xnames').html(xfloors);
            $('.selectEl').trigger("liszt:updated");
        }else{
            $('#xnames').html(xbuildings);
            $('.selectEl').trigger("liszt:updated");
        }           
        
    });
    
    $('#addnotedialog').dialog({
        autoOpen: false,
        width: 340,
        //height: 334,
        resizable: false,
        modal: true,
        buttons:[
        {
            text: "Add Note",
            "class": "btnSavex",
            click: function(){
                var xtype = $('#xtype').val();
                var xnames = $('#xnames').val();
                var xnote = $('#xnote').val();
                var xsubject = $('#xsubject').val();
                    
                if(xtype=='Room' || xtype=='Tenant'||xtype=='Floor' || xtype=='Building' && xsubject!=''){
                    
                    $.ajax({
                        type: 'POST',
                        url: domain+"tenants/addnotes",
                        data:{
                            xnames:xnames,
                            xnote:xnote,
                            xtype:xtype,
                            xsubject:xsubject
                        },
                        success : function(response)
                        {
                            if(response.status){        
                                jAlert("You have successfully added that note.","SUCCESS!");
                                $( "#addnotedialog" ).dialog("close");
//                                window.location = domain+"tenants";
                            }                                        
                        },
                        dataType: 'json'
                    });
                }else{
                    jAlert("Fill all required fields!","ERROR!");
                }
            }

        },    
        {
            text: "Cancel",
            "class": "btnCancelx",
            click: function(){
                $('#addnotedialog').dialog("close");
            }
        }
        ]
        
    }); 
       
    
});

