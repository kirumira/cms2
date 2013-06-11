<!-- Content -->

<div class="content" id="container">
    <div class="title"><h5><?php echo $this->session->userdata('building_name'); ?> : Financial Statement:</h5></div>
    <div class="table">
        <div class="head" ><h5 class="iFrames"> Financial Statement:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="room_bill">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Room Name</th>
                    <th>Tenant</th>
                    <th>Monthly Rent</th>
                    <th>Bill For Rent</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $c = 1;
                foreach ($rooms as $room):
                    ?>
                <tr class="gradeA" id="b_p_r<?php echo $room['rm_id']; ?>">
                    <td id="nm_<?php echo $room['rm_id']; ?>"><?php echo $c ?></td>
                    <td id="rm_<?php echo $room['rm_id']; ?>"><?php echo $room['room_name'] ?></td>
                    <td id="tn_<?php echo $room['rm_id']; ?>"><?php echo $room['f_name'] . " " . $room['l_name'] ?></td>
                    <td><?php echo $room['rm_cost'] ?></td>
                    <td class ="rbill" id="<?php echo $room['rm_id']; ?>"> <a href="#">Bill For Rent</a></td>
                        <?php
                        $c++;
                    endforeach
                    ?>
            </tbody>
        </table>
    </div>



</div>

<div id="rdialogbill" title="Room Billing" style="display:none;">
    <input type="text" value="" id="rm_id" style="display:none;" />
    <input type="text" value="" id="debit" style="display:none;" />
    <input type="text" value="" id="credit" style="display:none;" />
    <input type="text" value="" id="tenant_id" style="display:none;" />
    <input type="text" value="" id="tn_tel" style="display:none;" />
    <p align ="center"><h4>Edit the required field to re bill the room for this month </h4></p></br>

<table style="width:100%">
    <tr>
        <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Room Name:</span></td>
        <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="brname"></span></td>
    </tr>
    <tr>
        <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Montly Rent:</span></td>
        <td><input type="text" name="regular" id="editrbamount" value=""/></td>
    </tr>
    <tr>
        <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Reason:</span></td>
        <td><input type="text" name="regular" id="reason" value=""/></td>
    </tr>
</table>
</div>
<!---UMEME ROOM BILLING-->
<div id="urdialogbill" title="Room UMEME Billing" style="display:none;">
    <input type="text" value="" id="urm_id" style="display:none;" />
    <input type="text" value="" id="rate" style="display:none;" />
    <input type="text" value="" id="utenant_id" style="display:none;" />
    <p align ="center"><h4>Enter the Current meter reading here </h4></p></br>

<table style="width:100%">
    <tr>
        <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Room Name:</span></td>
        <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="ubrname"></span></td>

    </tr>
    <tr>
        <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Previous Meter Reading:</span></td>
        <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="prev"></span></td>

    </tr>
    <tr>
        <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Current Meter Reading:</span></td>
        <td><input type="text" name="regular" id="current" value=""/></td>

    </tr>
</table>
</div>

<script>
    var dynamic = dynamic || {};
    dynamic.dynptable=$('#room_bill').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""f>t<"F"lp>'
    });
</script>
<script>
    $(function() {
        var domain = "<?php echo base_url(); ?>";
        $(document).on('click',"tr .rbill",function(){ 
            var rm_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: domain+"floors/get_room_details",
                data:{
                    rm_id:rm_id
                },
                success : function(response)
                {                
                    if(response.status){
                        $('#rm_id').val(rm_id)
                        $('#brname').html(response.data.room_name);
                        $('#tenant_id').val(response.data.tenant_id);
                        $('#tn_tel').val(response.data.tn_tel);
                        $('#editrbamount').val(response.data.rm_cost);
                        $('#debit').val(response.data.debit);
                        $('#credit').val(response.data.credit); 
                        $('#rdialogbill').dialog('open');
                    }
                },
                dataType:'json'
            });
            return false;

        });

        ///=========room_re-bill===================//
        $("#rdialogbill").dialog({
            autoOpen: false,
            width: 450,
            resizable: false,
            modal: true,
            buttons: [
                {
                    text: " Bill Room",
                    "class": "btnSavex",
                    click: function(){
                        var rm_id = $('#rm_id').val();
                        var tenant_id = $('#tenant_id').val();
                        var tn_tel = $('#tn_tel').val();
                        var rm_cost = $('#editrbamount').val();
                        var debit = $('#debit').val();
                        var credit = $('#credit').val();
                        var room_name = $('#brname').html();
                        var reason = $('#reason').val();
                        if(rm_id!='' && rm_cost!='' && reason!='')
                        {
                            $.ajax({
                                type: "POST",
                                url: domain+"bills/bill_room",
                                data:{
                                    rm_id:rm_id,
                                    reason:reason,
                                    rm_cost:rm_cost,
                                    debit:debit,
                                    credit:credit
                                },
                                success : function(response)
                                {          
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
                                                destination:tn_tel.replace(/-/g,''), 
                                                source:"CMS", 
                                                message:"You have been rebilled for rent; room : "+room_name+", amount: "+rm_cost+" on building; <?php echo $this->session->userdata('building_name');?> and reason; "+reason},
                         
                                            success : function()
                                            {
                                                    jAlert("Message sent");
                                                   // $("#mhhh").dialog( "close" );
                                                
                                            }
                                         });                                    
                                        $("#rdialogbill").dialog("close");
                                        jAlert("Room Billed Successfullly", "SUCCESS!");

                                    }  else {
                                        jAlert(response.msg, "ERROR!");
                                    }
                                },
                                dataType:'json'
                            });
                        }else{jAlert('fill all the required fields', "ERROR");}

                        return false;
                    }
                },
                {
                    text: "Cancel",
                    "class": "btnCancelx",
                    click: function(){
                        $("#rdialogbill").dialog("close");
                    }
                }
            ]
        });

    });
    //Room Umeme Billing
    $(function() {

        var domain = "<?php echo base_url(); ?>";
        $(document).on('click',"tr .urbill",function(){ 
            var urm_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: domain+"floors/get_room_umeme_details",
                data:{
                    urm_id:urm_id
                },
                success : function(response)
                {                
                    if(response.status){
                        $('#urm_id').val(urm_id)
                        $('#ubrname').html(response.data.room_name);
                        $('#utenant_id').val(response.data.tenant_id);
                        $('#prev').html(response.data.prev);
                        $('#rate').val(response.data.rate);
                        $('#current').val(response.data.current);                   
                        $('#urdialogbill').dialog('open');
                    }
                },
                dataType:'json'
            });
            return false;

        });

        ///=========room_umeme_bill===================//
        $("#urdialogbill").dialog({
            autoOpen: false,
            width: 450,
            resizable: false,
            modal: true,
            buttons: [
                {
                    text: " Bill Room",
                    "class": "btnSavex",
                    click: function(){
                        var rm_id = $('#urm_id').val();
                        var tenant_id = $('#utenant_id').val();
                        var current = $('#current').val();
                        var prev = $('#prev').val();   
                        var rate = $('#rate').val(); 
                        var debit = $('#debit').val(); 

                        if(rm_id!='' && current!='')
                        {
                            $.ajax({
                                type: "POST",
                                url: domain+"bills/bill_room_umeme",
                                data:{
                                    rm_id:rm_id,
                                    current:current,
                                    prev:prev,
                                    debit:debit,
                                    rate:rate,
                                    tenant_id:tenant_id
                                },
                                success : function(response)
                                {          
                                    if(response.status){  
                                        $("#urdialogbill").dialog("close");
                                        jAlert("Room Billed For UMEME Successfullly", "SUCCESS!");
                                        //window.location = domain+"tenants";
                                    }                                    
                                },
                                dataType:'json'
                            });
                        }else{jAlert("ERROR");}

                        //return false;
                    }
                },
                {
                    text: "Cancel",
                    "class": "btnCancelx",
                    click: function(){
                        $("#urdialogbill").dialog("close");
                    }
                }
            ]
        });

    });
</script>