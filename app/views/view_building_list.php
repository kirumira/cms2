<div class="content" id="container">

    <div class="title"><h5>Active Buildings</h5></div>
    <div class="widget first">
        <div class="head"><h5 class="iHome2">Building List</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Building Name</th>
                    <th>Landlord</th>
                    <th>Manager</th>
                    <th>Location</th>                    
                    <th>Type</th>
                    <th style="width:116px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buildings as $building): ?>
                
                <tr class="gradeA">
                    <td><div class="rowElem nobg"><a href="<?php echo base_url(); ?>buildings/view_details/<?php echo $building['b_id'] ?>" title=""><span><?php echo $building['b_name'] ?></span></a></div></td>
                    <td class="center"><?php echo $building['l_name_first']. " ". $building['l_name_last']?></td>
                    <td class="center"><?php echo $building['name_first']." ".$building['name_last']?></td>
                    <td style="padding-left:10px;"><?php echo "P.O. Box ".$building['p_o_box'].", ".$building['b_town'].", ".$building['b_district']?></td>
                    <td class="center"><?php echo $building['b_type']?></td>
                    <td>
                        <a class="btn14 topDir mr5 binfo" style="margin-right:-5px; margin-left:0px; " original-title="More Info" id="<?php echo $building['b_id'];?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/cog3.png"/></a>
                        <a class="btn14 topDir mr5 bedit" style="margin-right:-5px; margin-left:0px;" original-title="Edit" id="<?php echo $building['b_id'];?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/pencil.png"/></a>
                        <a class="btn14 topDir mr5 bdel" style="margin-right:-5px; margin-left:0px;" original-title="Delete" id="<?php echo $building['b_id'];?>" href="#"><img alt="" src="<?php echo base_url();?>images/icons/dark/trash.png"/></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div id="buildingedit" title="Edit Building" style="display:none;">
    <input type="text" value="" id="building_id" style="display:none;" />
    <table style="width:720px;">
            <tr>
                <th>Building Name: </th>
                <td ><input type="text" name="regular" id="editbname" value=""/></td>
                <th>P.O.BOX: </th>
                <td ><input type="text" name="regular" id="editbaddress" value=""/></td>
            </tr>            
            <tr>
                <th>Town: </th>
                <td ><input type="text" name="regular" id="editbtown" value=""/></td>
                <th>District: </th>
                <td ><input type="text" name="regular" id="editbdistrict" value=""/></td>
            </tr>            
            <tr>
                <th>Number of floors: </th>
                <td ><input type="text" name="regular" id="editbfloors" value=""/></td>
                <th>Manager:</th>
                <td style="vertical-align:middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="editbmanager" tabindex="2">
                        <option id="mm">Select Option</option>
                        <?php if(isset($managers)){ ?>
                        <?php foreach($managers as $v):?>
                        <?php echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?>
                        <?php endforeach;}?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Landlord:</th>
                <td style="vertical-align:middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="editblandlord" tabindex="2">
                        <option id="ll">Select Option</option>
                        <?php if(isset($landlords)){ ?>
                        <?php foreach($landlords as $v):?>
                        <?php echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?>
                        <?php endforeach;}?>
                    </select>
                </td>
                <th>Type:</th>
                <td style="vertical-align:middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="editbtype" tabindex="2">
                        <option id="tt">Select Option</option>
                        <option>COMMERCIAL</option>
                        <option>RESIDENTIAL</option>
                        <option>WAREHOUSE</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Currency:</th>
                <td style="vertical-align:middle;"><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="editbcurrency" tabindex="2">
                        <option id="cc">Select Option</option>
                        <option>UGX</option>
                        <option>USD</option>
                    </select>
                </td>
                <th>Plot Number: </th>
                <td ><input type="text" name="regular" id="editbplotno" value=""/></td>
            </tr>
            <tr>
                <th>Property Number: </th>
                <td ><input type="text" name="regular" id="editbpropno" value=""/></td>
                <th>Block Number: </th>
                <td ><input type="text" name="regular" id="editbblockno" value=""/></td>
            </tr>
            <tr>
                <th>Street Name: </th>
                <td ><input type="text" name="regular" id="editbstreetname" value=""/></td>
<!--                <th></th>
                <td ><input type="text" name="regular" id="editbrooms" value=""/></td>-->
            </tr>           
            
        </table>
</div>
<div id="bdialoginfo" title="More Building Information" style="display:none;">
    <table style="line-height: 25px;">
        <tr>
            <td ><span style="float:right; font-weight: 600; font-family: tahoma">Building Name: </span></td>
            <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobname"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Address: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobaddress"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Street Name: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobstrname"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Landlord: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infoblandlord"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Manager: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobmanager"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Block Number: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobblock"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Property Number: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobpropno"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Type: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobtype"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">No. of floors: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobfloors"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">No. of Rooms: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobrooms"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">No. of occupied Rooms: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infoborooms"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">No.of free Rooms: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobfrooms"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Currency: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="infobcurrency"></span></td>
        </tr>

    </table>
</div>
<div id="bdialogdel" title="Delete Building" style="display:none;">
    <input type="text" value="" id="dbu_id" style="display:none;" />
    <p>Are you sure you want to delete the building: <b><span id="delbname"></span></b>?</p>
</div>
<script>
$(function() {
    var domain = "http://localhost/cms/";
//==============Building Edit=======================================//
    $(document).on('click',"tr .bedit",function(){
        $('.selectElement').chosen();
        $('#buildingedit').dialog('open');
         var building_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"buildings/building_details",
            data:{building_id:building_id},
            success : function(response)
            {
                if(response.status){

                    $('#building_id').val(building_id);
                    $('#editbname').val(response.data.b_name);
                    $('#editbaddress').val(response.data.p_o_box);
                    $('#editbtown').val(response.data.b_town);
                    $('#editbdistrict').val(response.data.b_district);
                    $('#editbfloors').val(response.data.b_num_floors);
                    $('#editbmanager').val(response.data.b_manager_id);
                    $('#mm').html(response.data.name_first+' '+response.data.name_last);
                    //$('#editblandlord').val(response.data.l_name_first+' '+response.data.l_name_last);
                    $('#editblandlord').val(response.data.b_landlord_id);
                    $('#ll').html(response.data.l_name_first+' '+response.data.l_name_last);
                    $('#editbtype').val(response.data.b_type);
                    $('#tt').html(response.data.b_type);
                    $('#editbcurrency').val(response.data.currency);
                    $('#cc').html(response.data.currency);
                    $('#editbplotno').val(response.data.plot);
                    $('#editbpropno').val(response.data.property_no);
                    $('#editbblockno').val(response.data.block);
                    $('#editbstreetname').val(response.data.street);
                    
                   $('.selectElement').trigger("liszt:updated");
                   $('.selectElement').chosen();
                    
                    $('#buildingedit').dialog('open');
                }
            },
            dataType:'json'
        });
        return false;
    });
    $( "#buildingedit" ).dialog({
            autoOpen: false,
            width: 790,
            modal: true,
            buttons: [
                {
                    text: "Register",
                    "class": "btnSavex",
                    click: function(){
                        var b_id = $('#building_id').val();
                        var name = $('#editbname').val();
                        var p_o_box = $('#editbaddress').val();
                        var landlord = $('#editblandlord').val();
                        var rooms = $('#editbrooms').val();
                        var floors = $('#editbfloors').val();
                        var town = $('#editbtown').val();
                        var district = $('#editbdistrict').val();
                        var manager = $('#editbmanager').val();
                        var type = $('#editbtype').val();
                        var property_no = $('#editbpropno').val();
                        var plot = $('#editbplotno').val();
                        var street = $('#editbstreetname').val();
                        var block = $('#editbblockno').val();
                        var currency = $('#editbcurrency').val();
                        
                        if(name!='' && p_o_box!='' && landlord!='Select Option' && rooms!='' && floors!='' && town!=''  && district!='' && manager!='Select Option' && type!='Select Option' && property_no!=''  && plot!='' && street!='' && block!='' && currency!=''){
                            //alert(towns);
                            $.ajax({
                                type: 'POST',
                                url: domain+"buildings/edit",
                                data:{b_id:b_id,name:name,p_o_box:p_o_box,landlord:landlord,rooms:rooms,floors:floors,town:town,district:district,manager:manager,type:type,property_no:property_no,plot:plot,street:street,block:block,currency:currency},
                                success : function(response)
                                {
                                    if(response.status){                                            
                                        $( "#buildingedit" ).dialog("close");
                                        window.location = domain+"buildings";
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
                    "class": "btnCancelx",
                    click: function(){
                        $( "#buildingedit" ).dialog( "close" );
                    }
                }
            ]
    });
    //============Building info==================//
    $(document).on('click',"tr .binfo",function(){
         var building_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"buildings/building_details",
            data:{building_id:building_id},
            success : function(response)
            {
                if(response.status){
                    $('#infobname').html(response.data.b_name);
                    $('#infobaddress').html(response.data.p_o_box);
                    $('#infobstrname').html(response.data.street);
                    $('#infoblandlord').html(response.data.l_name_first+' '+response.data.l_name_last);
                    $('#infobmanager').html(response.data.name_first+' '+response.data.name_last);
                    $('#infobblock').html(response.data.block);
                    $('#infobpropno').html(response.data.property_no);
                    $('#infobtype').html(response.data.b_type);
                    $('#infobfloors').html(response.data.b_num_floors);
                    $('#infobrooms').html(response.data.b_num_rooms);
                    $('#infoborooms').html("");
                    $('#infobfrooms').html("");
                    $('#infobcurrency').html(response.data.currency);
                    
                    $('#bdialoginfo').dialog('open');
                }
            },
            dataType:'json'
        });
        return false;
    });
    $("#bdialoginfo").dialog({
		autoOpen: false,
		modal: true,
		buttons:[
                    {
                        text: "OK",
                        "class": "btnSavex",
			click: function() {
				$(this).dialog( "close" );
			}
                    }
                ] 
	});
        
    //=============building delete===============//
    $("#bdialogdel").dialog({
		autoOpen: false,
                width: 395,
		modal: true,
		buttons: [
                    {
                        text: "Yes",
                        "class": "btnSavex",
                        click: function(){
                            var building_id = $('#dbu_id').val();
                            $.ajax({
                                type: "POST",
                                url: domain+"buildings/delete",
                                data:{building_id:building_id},
                                success : function(response)
                                {          
                                    if(response.status){                                        
                                        $("#bdialogdel").dialog("close");
                                        window.location = domain+"buildings";
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
                            $("#bdialogdel").dialog("close");
                        }
                    }
                ]
	});
    
    $(document).on('click',"tr .bdel",function(){
         var building_id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: domain+"buildings/del_info",
            data:{building_id:building_id},
            success : function(response)
            {
                    $('#dbu_id').val(building_id);
                    $('p #delbname').html(response.bname);
                    $('#bdialogdel').dialog('open');

            },
            dataType:'json'
        });
        return false;
    });
    
});

</script>
