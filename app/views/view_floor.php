<!-- Content -->
<?php $dp=0;?>
<div class="content" id="container">
    <input style="display:none" id="floor" value="<?php echo $f_id; ?>"/>
    <?php
    $ci = & get_instance();
    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name').' > '.$flr_name; ?><?php

    ?>
        </h5></div>

    <a href="#"><input type="button" id ="roomregform" value="Add New Room" class="greenBtn right"/></a>
    <!--<a href="<?php echo base_url(); ?>floors/billed/<?php echo $floor ?>">
        <input type="button" value="View Billed Rooms" class="greenBtn right"/>
    </a>-->
    <a href="#">
        <input id="ed_floor" type="button" value="Edit Floor Name" class="greenBtn right"/>
    </a>


    <div class="table">
        <div class="head"><h5 class="iFrames">Rooms List:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="fl_rooms">
            <thead>
                <tr>
                    <th><b>Room</b></th>
                    <th><b>Tenant</b></th>
                    <th><b>Status</b></th>
                    <th><b>Rent Amount</b></th>
                    <!--<th><b>Room Balance</b></th>-->
                    <th width="218px"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
               
                <?php 
                foreach ($rooms as $room): ?>
                    <tr class="gradeA" id="fl_rm_<?php echo $room['rm_id']; ?>">
                        <td class="center"><?php echo $room['room_name'] ?></td>
                        <td class="center" id="t_<?php echo $room['rm_id']; ?>"><?php echo $room['f_name'] . " " . $room['l_name'] ?></td>
                        <td class="center" id="st_<?php echo $room['rm_id']; ?>"><?php if($room['rm_status']=='PENDING'){ echo "BOOKED";}else{echo $room['rm_status'];}?></td>
                        <td class="center"><?php echo number_format($room['rm_cost'],$dp); ?></td>
                        <!--<td class="center"><?php echo number_format($room['credit']-$room['debit'], $dp); ?></td>-->
                        <td class="center">                            
                            <a class="btn14 topDir mr5 Rinfo" original-title="More Info" id="<?php echo $room['rm_id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>
                            <a class="btn14 topDir mr5 Redit" original-title="Edit" id="<?php echo $room['rm_id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>
                            <!--<a class="btn14 topDir mr5 Rbalance" original-title="Edit Balance" id="<?php echo $room['rm_id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pdfDoc.png"/></a>-->
                            <?php
                            if (($room['rm_status'] != 'VACANT')) {
                                echo "<a class='btn14 topDir mr5 Revict' original-title='Evict Tenant' id='" . $room['rm_id'] . "' href='#'><img src='" . base_url() . "images/icons/dark/record.png' /></a>";
                            }
                            ?>
                            <!--<a class="btn14 topDir mr5 Revict" original-title="Evict tenant" id="<?php echo $room['rm_id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/record.png"/></a>-->
                            <a class="btn14 topDir mr5 Rdel" original-title="Delete Room" id="<?php echo $room['rm_id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/trash.png"/></a>
                            <?php
                            if (($room['rm_status'] == 'VACANT')) {
                                echo "<a class='btn14 topDir mr5 Rassign' original-title='Assign Tenant' id='" . $room['rm_id'] . "' href='#'><img src='" . base_url() . "images/icons/dark/user.png' /></a>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                endforeach;

                ?>
            </tbody>
        </table>
        <!--<input type="button" value="Total Billled Amount = <?php
        if(isset($total)){
        
        if ($total) {
            echo $total;
        } else {
            echo"0.00";
        }}
        ?>" class="greenBtn" />-->
    </div>
    <div id="rinfoDialog" title="Room Information" style="display:none;">
        <table style="line-height: 25px; width: 100%;">
            <tr>
                <td ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name :</span></td>
                <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="rmname"></span></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Floor :</span></td>
                <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="rmfloor"></span></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Status :</span></td>
                <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="rmstatus"></span></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Rent Amount :</span></td>
                <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="rmrent"></span></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Tenant :</span></td>
                <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="rmtenant"></span></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Description :</span></td>
                <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="rmdesc"></span></td>
            </tr>

        </table>
    </div>
    <div id="rinfoEdit" title="Edit Room Information" style="display:none;">
        <input type="text" value="" id="editrm_id" style="display:none;" /><input type="text" value="" id="editrm_bal" style="display:none;" /><input type="text" value="<?php echo $floor; ?>" id="edt_floor_id" style="display:none;" />
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><input type="text" name="regular" id="editrmname" value=""/></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Monthly Rent :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><input type="text" name="regular" class="positivenumeric" id="editrmrent" value=""/></td>
            </tr>  
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Description :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><textarea id="editrmdesc" name="textarea" cols="1" rows="2"></textarea></span></td>
            </tr>                     

        </table>
    </div>
    <div id="rbalanceEdit" title="Edit Room Balance" style="display:none;">
        <input type="text" value="" id="balrm_id" style="display:none;" /><input type="text" value="" id="rm_costx" style="display:none;" />
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><input type="text" name="regular" id="balancermname" value=""/></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Balance:</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><input type="text" name="regular" class="positivenumeric" id="editrmbalance" value=""/></td>
            </tr>
        </table>
    </div>
    <div id="rinfoEvict" title="Evict Room Tenant" style="display:none;">
        <input type="text" value="" id="evictrm_id" style="display:none;" /><input type="text" value="" id="evicten_id" style="display:none;" />
        <table style="width: 90%;">
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span value="" style="float:left; margin-left: 5px; font-family: tahoma" id="evictrmname"></span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Tenant :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span value="" style="float:left; margin-left: 5px; font-family: tahoma" id="evictrmtenantname"></span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Floor :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span value="" style="float:left; margin-left: 5px; font-family: tahoma" id="evictrmfloor"></span></td>
            </tr> 
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Monthly Rent :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><span value="" style="float:left; margin-left: 5px; font-family: tahoma" id="evictrmrent"></span></td>
            </tr>
            <tr>
                <td style="vertical-align: middle; padding-left: 20px;" ><span style="float:right; font-weight: 600; font-family: tahoma">Reason for Departure :</span></td>
                <td style="vertical-align: middle; padding-left: 20px;" ><textarea id="evictrmreason" name="textarea" cols="1" rows="2"></textarea></span></td>
            </tr>
                                             

        </table>
    </div>

    <div id="editFloor" title="Editing Floor Name" style="display:none;">
        <input type="text" value="<?php echo $f_id; ?>" id="floor_id" style="display:none;" />
        <table style="width:300px;">
            <tr>
                <th>Floor Name: </th>
                <td ><input type="text" name="regular" id="flr_name" value="<?php echo $flr_name; ?>" /></td>
            </tr>
            
        </table>
    </div>    

    <div id="rinfoDelete" title="Deleting Room!" style="display:none;">
        <input type="text" value="" id="rm_id" style="display:none; verticle-align: middle" />
        <p>Are you sure you want to delete the Room: <b><span id="roomname"></span></b>?</p>
    </div>
    <div id="roomreg" title="Add New Room" style="display:none;">
        <input type="text" value="<?php echo $floor; ?>" id="floor" style="display:none;" />
        <table style="width:300px;">
            <tr>
                <th>Room Name: </th>
                <td ><input type="text" name="regular" id="room" value=""/></td>                
            </tr>            
            <tr>
                <th>Description: </th>
                <td ><input type="text" name="regular" id="desc" value=""/></td>
            </tr>
            <tr>
                <th>Room Amount: </th>
                <td ><input type="text" name="regular" id="rent" value=""/></td>
            </tr>
        </table>
    </div>

    <div id="rassignDialog" title="Assign Room Dialog" style="display:none;">
        <input id="room_id" style="display:none" value=""/>
        <input id="floor_x" style="display:none" value="<?php echo $floor; ?>"/>
        <table style="line-height: 25px; width: 100%;">
            <tr>
                <td ><span style="float:right; font-weight: 600; font-family: tahoma">Room Name :</span></td>
                <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="r_name"></span></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Tenant Name :</span></td>
                <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="ass_ten" tabindex="2">
                        <option value="Select Option">Select Option</option>
                        <?php if (isset($tenants)) { ?>
                            <?php foreach ($tenants as $v): ?>
                                <?php echo '<option value="' . $v['id'] . '">' . $v['f_name'] . ' ' . $v['l_name'] . '</option>'; ?>
                                <?php
                            endforeach;
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Down Payment :</span></td>
                <td><input type="text" id="rm_dpay" value="" class="positivenumeric"/></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Security Deposit :</span></td>
                <td><input type="text" id="rm_sdepo" value="" class="positivenumeric"/></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Starting Date :</span></td>
                <td ><input type="text" name="regular" id="rm_start" value="" class="datepicker"/></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Handover Date :</span></td>
                <td ><input type="text" name="regular" id="rm_end" value="" class="datepicker"/></td>
            </tr>
            <tr>
                <td><span style="float:right; font-weight: 600; font-family: tahoma">Purpose :</span></td>
                <td><input type="text" id="rm_purpose" value="" /></td>
            </tr>
        </table>
    </div>

</div>

<script>
    var domain = "<?php echo base_url(); ?>";
    var dynamic = dynamic || {};
    dynamic.dynptable=$('#fl_rooms').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""f>t<"F"lp>'
    });
    
    $('.positivenumeric').numeric();
    $('.positivenumeric').keyup(function(){
        var n = $(this).val().replace(/,/g, '');
        $(this).val(add_commas(n));
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
    //===========Room Registration=======================//
    $(document).on('click',"#roomregform",function(){
        $('#floor').val()
        $('#roomreg').dialog('open');
    }); 
    
    //===========register New Room completion=======================//
    $( "#roomreg" ).dialog({
        autoOpen: false,
        width: 400,
        modal: true,
        buttons: [
            {
                text: "Add",
                "class": "btnSavex",
                click: function(){
                    var room = $('#room').val();
                    var desc = $('#desc').val(); 
                    var rent = $('#rent').val();
                    var floor = $('#floor').val();
                    //alert('>>'+floor);
                    if(room!=''){
                        $.ajax({
                            type: 'POST',
                            url: domain+"floors/addroom",
                            data:{room:room,rent:rent,desc:desc,floor:floor},
                            success : function(response)
                            {
                                if(response.status){                                            
                                    $( "#roomreg" ).dialog("close");
                                    jAlert("Succesfull added new room!","SUCCESS!");
                                    window.location = domain+"floors/floor/"+floor;
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
                    $( "#roomreg" ).dialog( "close" );
                }
                    
            }
        ]
               
    });
    
    //================================================
    
    $('#rinfoDialog').dialog({
        resizable: false,
        autoOpen: false,
        width: 290,
        modal: true,
        buttons: [
            {
                text: "OK",
                "class": 'btnSavex',
                click: function() {
                    $(this).dialog( "close" );
                }            
            }
        ]
    });
    
    //.dialog("widget").find(".ui-dialog-buttonpane button").eq(0).addClass("btnSave").end();
    
    $(document).on('click',"tr .Rinfo",function(){
        var rm_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"floors/view_room1",
            data:{rm_id:rm_id},
            success : function(response)
            {   
                if(response.status){
                    //alert(response.data.room_name);
                    $('#rmname').html(response.data.room_name);
                    $('#rmfloor').html(response.data.flr_name);
                    $('#rmstatus').html(response.data.rm_status);
                    $('#rmrent').html(response.data.rm_cost);
                    $('#rmtenant').html(response.data.f_name+' '+response.data.l_name);
                    $('#rmdesc').html(response.data.description);
                    $('#rinfoDialog').dialog("open");
                }
            },
            dataType:'json'
        });
        return false;
    });
    //=====================Room Balance Edit=========================//
    $(document).on('click', "tr .Rbalance", function() {
        var rm_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"floors/edit_balance",
            data:{rm_id:rm_id},
            success : function(response)
            {   
                if(response.status){
                    $('#balrm_id').val(rm_id);
                    $('#balancermname').val(response.rm_name);
                    $('#rm_costx').val(response.rm_cost);
                    $('#rbalanceEdit').dialog("open");
                }
            },
            dataType:'json'
        });
    });

    //=====================Room Balance Dialog=======================//
    $('#rbalanceEdit').dialog({
        resizable: false,
        autoOpen: false,
        width: 350,
        modal: true,
        buttons: [
                {
                    text: "SAVE",
                    "class": 'btnSavex',
                    click: function(){
                        var bal = $('#editrmbalance').val();
                        var rm_id = $('#balrm_id').val();
                        var rm_name = $('#balancermname').val();
                        var rm_cost = $('#rm_costx').val();
                        $.ajax({
                            type: 'POST',
                            url: domain+"floors/edit_room_balance",                            
                            data:{room_id:rm_id, bal:bal},
                            success : function(response){
                                jAlert('The room '+rm_name+' balance has been succesfully edited','SUCCESS!');
                                $('#rbalanceEdit').dialog("close");
                                var editrow='<tr class="gradeA" id="fl_rm_'+rm_id+'">'+
                                        '<td class="center">'+room_name+'</td>'+
                                        '<td class="center" id="t_'+rm_id+'">'+$('#t_'+rm_id).html()+'</td>'+
                                        '<td class="center" id="st_'+rm_id+'">'+$('#st_'+rm_id).html()+'</td>'+
                                        '<td class="center">'+rm_cost+'</td>'+
                                        '<td class="center">'+bal+'</td>'+
                                        '<td>'+                            
                                        '<a class="btn14 topDir mr5 Rinfo" original-title="More Info" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Redit" original-title="Edit" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Rbalance" original-title="Edit Balance" id="'+rm_id+' href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pdfDoc.png"/></a>'+
                                        //'<a class="btn14 topDir mr5 Revict" original-title="Evict tenant" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/record.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Rdel" original-title="Delete Room" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/trash.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Rassign" original-title="Assign Tenant" id="'+rm_id+'" href="#"><img src="<?php echo base_url(); ?>images/icons/dark/user.png" /></a>'+
                                        '</td>'+
                                        '</tr>';
                                    var index = $('#fl_rm_'+rm_id).closest("tr").get(0);
                                    dynamic.dynptable.fnDeleteRow(dynamic.dynptable.fnGetPosition(index));
                                    //console.log(editrow);
                                    dynamic.dynptable.fnAddTr($(editrow)[0],true);
                            },
                            dataType: 'json'
                        });

                    }
                }, {
                    text: "Cancel",
                    "class": "btnCancelx",
                    click: function(){
                        $('#rbalanceEdit').dialog("close");
                    }
                }]});

    //=====================Room Edit=================================//
    $(document).on('click',"tr .Redit",function(){
        var rm_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"floors/view_room1",
            data:{rm_id:rm_id},
            success : function(response)
            {   
                if(response.status){
                    //alert(response.data.room_name);
                    $('#editrm_id').val(rm_id);
                    $('#editrmname').val(response.data.room_name);
                    $('#editrmrent').val(response.data.rm_cost);
                    $('#editrmdesc').val(response.data.description);
                    //$('#editrm_bal').val(response.data.debit - response.data.credit);
                    $('#rinfoEdit').dialog("open");
                }
            },
            dataType:'json'
        });
        return false;
    });
    $('#rinfoEdit').dialog({
        resizable: false,
        autoOpen: false,
        width: 350,
        modal: true,
        buttons: [
            {
                text: "SAVE",
                "class": 'btnSavex',
                click: function() {
                    var ed_floor_id = $('#edt_floor_id').val();
                    var room_name = $('#editrmname').val();
                    var rm_cost = $('#editrmrent').val(); 
                    var description = $('#editrmdesc').val();
                    var rm_id = $('#editrm_id').val();
                    //var bal = $('#editrm_bal').val();
                    
                    if(room_name!='' && rm_id!=''){
                        $.ajax({
                            type: 'POST',
                            url: domain+"floors/edit_room",
                            data:{room_name:room_name,rm_cost:rm_cost,description:description,rm_id:rm_id},
                            success : function(response)
                            {
                                if(response.status){  
                                    jAlert('Congs! The room '+room_name+' Has been succesfully edited','SUCCESS!')
                                    $( "#rinfoEdit" ).dialog("close");
                                    //window.location = domain+"floors/floor/"+ed_floor_id;
                                    var editrow='<tr class="gradeA" id="fl_rm_'+rm_id+'">'+
                                        '<td class="center">'+room_name+'</td>'+
                                        '<td class="center" id="t_'+rm_id+'">'+$('#t_'+rm_id).html()+'</td>'+
                                        '<td class="center" id="st_'+rm_id+'">'+$('#st_'+rm_id).html()+'</td>'+
                                        '<td class="center">'+rm_cost+'</td>'+
                                        //'<td class="center">'+bal+'</td>'+
                                        '<td>'+                            
                                        '<a class="btn14 topDir mr5 Rinfo" original-title="More Info" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Redit" original-title="Edit" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Rbalance" original-title="Edit Balance" id="'+rm_id+' href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pdfDoc.png"/></a>'+
                                        //'<a class="btn14 topDir mr5 Revict" original-title="Evict tenant" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/record.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Rdel" original-title="Delete Room" id="'+rm_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/trash.png"/></a>'+
                                        '<a class="btn14 topDir mr5 Rassign" original-title="Assign Tenant" id="'+rm_id+'" href="#"><img src="<?php echo base_url(); ?>images/icons/dark/user.png" /></a>'+
                                        '</td>'+
                                        '</tr>';
                                    var index = $('#fl_rm_'+rm_id).closest("tr").get(0);
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
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#rinfoEdit').dialog("close");
                }
            }
        ]
    });
    //==========================Evict=====================//
    $(document).on('click',"tr .Revict",function(){
        var rm_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"floors/view_room1",
            data:{rm_id:rm_id},
            success : function(response)
            {                   
                if(response.status){
                    $('#evictrm_id').val(rm_id);
                    $('#evicten_id').val(response.data.tenant_id);
                    if(response.data.tenant_id+"" == '0' || response.data.tenant_id+"" == ''){
                        jAlert('No Tenant!','Information!');
                    }else{
                        $('#evictrmname').html(response.data.room_name);
                        $('#evictrmtenantname').html(response.data.f_name+' '+response.data.l_name);
                        $('#evictrmname').val(response.data.room_name);
                        $('#evictrmfloor').html(response.data.flr_name);
                        $('#evictrmfloor').val(response.data.flr_name);
                        $('#evictrmrent').html(response.data.rm_cost);
                        $('#evictrmrent').val(response.data.rm_cost);
                        $('#rinfoEvict').dialog("open");
                    }
                    
                }
            },
            dataType:'json'
        });
        return false;
    });
    
    $('#rinfoEvict').dialog({
        resizable: false,
        autoOpen: false,
        width: 450,
        modal: true,
        buttons: [
            {
                text: "Evict",
                "class": 'btnSavex',
                click: function(){
                    var rm_id = $('#evictrm_id').val();
                    var reason = $('#evictrmreason').val();
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: domain+"floors/evict_tenant/"+rm_id,
                        data: {rm_id:rm_id, reason:reason},
                        success: function(response) {
                            if(response.status){
                                jAlert('Successfully evicted the tenant', 'INFO');
                                window.location = domain+"floors/floor/"+response.floor;
                            }else{jAlert('There was an error evicting the tenant', 'ERROR');}
                        }
                    });
                } 
            },
            {
                text: "Cancel",
                "class": 'btnCancelx',
                click: function(){
                    $('#rinfoEvict').dialog("close");
                    
                }
            }
        ]
    });

    //==============Assign Tenant ===============================//
    $(document).on('click',"tr .Rassign",function(){
        var rm_id = $(this).attr('id');
        
        $.ajax({
            type: "POST",
            url: domain+"floors/room_encode",
            data: {rm_id:rm_id},
            dataType: 'json',
            success: function(response){
                $('#r_name').html(response.rm_name);
                $('.selectElement').chosen();
                $('#room_id').val(rm_id);
                $('#rassignDialog').dialog('open');
            }
        }); 
    });

    //===============Assign Tenant Dialog========================//
    $('#rassignDialog').dialog({
        resizable: false,
        autoOpen: false,
        width: 450,
        modal: true,
        buttons: [
            {
                text: "Assign Room",
                "class": 'btnSavex',
                click: function() {
                    var rm_id = $('#room_id').val();
                    var floor = $('#floor_x').val();
                    //alert("Rm ID: "+rm_id+" Floor: "+floor);
                    if(($('#ass_ten').val()!='')&&($('#rm_dpay').val()!='')&&($('#rm_start').val()!='')&&($('#rm_purpose').val()!='')){
                        $.ajax({
                        type: "POST",
                        url: domain+"floors/assign_tenant",
                        data:{
                            rm_id:rm_id,
                            ten_id:$('#ass_ten').val(),
                            d_pay:$('#rm_dpay').val(),
                            s_depo:$('#rm_sdepo').val(),
                            start:$('#rm_start').val(),
                            end:$('#rm_end').val(),
                            purpose:$('#rm_purpose').val()
                        },
                        success : function(response){
                            if(response.status){
                                $().dialog('close');
                                window.location = domain+"floors/floor/"+floor;
                            }
                        },
                        dataType:'json'
                    });
                    }else{
                        jAlert("Fill in all required fields", 'ERROR');
                    }                    
                }            
            },
            {
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#rassignDialog').dialog("close");
                }
            }
        ]
    });

    //===============Edit Floor Name ============================//
    $(document).on('click',"#ed_floor", function(){
        $('#editFloor').dialog('open');
    });

    //===============Edit FLoor Dialog ==========================//
    $('#editFloor').dialog({
        resizable: false,
        autoOpen: false,
        width: 450,
        modal: true,
        buttons: [{ text: "Edit Floor",
                "class": 'btnSavex',
                click: function() {
                    var flr_id = $('#floor_id').val(); 
                    var flr_name = $('#flr_name').val();
                    var flr_rms = $('#flr_rms').val();
                   // alert("Flr_id: "+flr_id+" Flr_name: "+flr_name+" Flr_rms: "+flr_rms);
                    if(flr_name!=''){
                        $.ajax({
                            type: "POST",
                            url: domain+"floors/edit_floor",
                            data: {flr_id: flr_id, flr_name: flr_name},
                            dataType: 'json',
                            success: function(response) {
                                //jAlert("Floor successfully Ediited");
                                $('#x_flr_name').html(flr_name);
                                window.location = "<?php echo base_url();?>floors/floor/"+flr_id;
                                $('#editFloor').dialog('close');
                            }
                        });
                    }else{
                        jAlert("Fill in the Floor Name", "Error");
                    }
                        
                }
            },
            {
                text: "Cancel",
                "class": "btnCancelx",
                click: function() {$('#editFloor').dialog("close");}
            }]
    });
</script>