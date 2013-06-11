<!-- Content -->
<?php $dp = 0;?>
<div class="content" id="container">

    <div class="title"><h5> Manage Currency Here</h5></div>
    <a href='#' id='curregform' title="">
        <input type="button" value="Add New Currency" class="greenBtn right" />
    </a>
     <a href="<?php echo base_url(); ?>currency/report" title="">
        <input type="button" value="View currency report" class="greenBtn right" />
    </a>
    <?php if(count($umeme)==0){
        echo "<a href='#' id='rateregform' >
                <input type='button' value='Add Umeme Rate' class='greenBtn right'/>
            </a>";
    }  else {
         echo "<a href='".base_url()."currency/ureport' >
                <input type='button' value='View Umeme Report' class='greenBtn right'/>
            </a>";
}?>
    
    <div class="widget first">
        <div class="head"><h5 class="iUpload">Current Exchange Rates</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="b_curr">
            <thead>
                <tr>
                    <th>Currency</th>
                    <th>Rate (Ushs)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                foreach ($curr as $cur):
                    ?>
                    <tr class="gradeA" id="building_c_<?php echo $cur['id'] ?>">
                        <td class="center" id="c_<?php echo $cur['id'] ?>"><?php echo $cur['currency'] ?></td>
                        <td class="center" id="r_<?php echo $cur['id'] ?>"><?php echo number_format($cur['rate'],$dp) ?></td>
                        <td width ="20%">
                            <a class="btn14 topDir mr5 cinfo" original-title="More Info" id="<?php echo $cur['id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>
                            <a class="btn14 topDir mr5 cedit" original-title="Edit" id="<?php echo $cur['id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>
                            <a class="btn14 topDir mr5 cdel" original-title="Delete" id="<?php echo $cur['id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/trash.png"/></a>
                        </td>
                    </tr>
                    <?php
                    $x++;
                endforeach
                ?>
            </tbody>
        </table>
    </div>
    <div class="title"><h5> Manage Umeme Rates Here</h5></div>

    <div class="widget first">
        <div class="head"><h5 class="iUpload">Current Umeme Rates</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="b_umeme">
            <thead>
                <tr>
                    <th>Units</th>
                    <th>Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                foreach ($umeme as $cur):
                    ?>
                    <tr class="gradeA" id="building_u_<?php echo $cur['id'] ?>">
                        <td class="center">1</td>
                        <td class="center" id="ur_<?php echo $cur['id'] ?>"><?php echo number_format($cur['rate'],$dp); ?></td>
                        <td width ="20%">
                            <a class="btn14 topDir mr5 uinfo" original-title="More Info" id="<?php echo $cur['id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>
                            <a class="btn14 topDir mr5 uedit" original-title="Edit Umeme Rate" id="<?php echo $cur['id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>
                            <a class="btn14 topDir mr5 udel" original-title="Delete" id="<?php echo $cur['id']; ?>" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/trash.png"/></a>
                        </td>
                    </tr>
    <?php
    $x++;
endforeach
?>
            </tbody>
        </table>
    </div>
</div>

<div id="cdialoginfo" title="More Currency Information" style="display:none;">
    <table style="line-height: 25px;">
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">ID: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="id"></span></td>
        </tr>
        <tr>
            <td ><span style="float:right; font-weight: 600; font-family: tahoma">Currency: </span></td>
            <td ><span style="float:left; margin-left: 5px; font-family: tahoma" id="currency"></span></td>
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma">Rate: </span></td>
            <td><span style="float:left; margin-left: 5px; font-family: tahoma" id="x"></span></td>
        </tr>

    </table>
</div>

<!--currency registration form-->
<div id="curreg" title="Add New Currency" style="display:none;">
    <table style="width:300px;">

        <tr>
            <th>Currency: </th>
            <td ><input type="text" name="regular" id="cur" value=""/></td>                
        </tr>            
        <tr>
            <th>Rate(Ushs): </th>
            <td ><input type="text" name="regular" id="rate" value=""/></td>
        </tr>            

    </table>
</div>
<!-- Rate registration form-->
<div id="ratereg" title="Add New Umeme Rate" style="display:none;">
    <table style="width:300px;">
                  
        <tr>
            <th>Unit Rate(Ushs): </th>
            <td ><input type="text" name="regular" id="urate" value=""/></td>
        </tr>            

    </table>
</div>

<!--Edit Currency-->

<div id="cdialogedit" title="Edit Currency Record">
    <input type="text" value="" id="currency_id" style="display:none;" />
    <table style="width:380px">
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Currency:</span></td>
            <td><input type="text" name="regular" id="currencyedit" value=""/></td>                       
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Rate:</span></td>
            <td><input type="text" name="regular" id="r" value=""/></td>                      
        </tr>        
    </table>
</div>

<!--Edit Umeme Rate-->

<div id="udialogedit" title="Edit Umeme Rate">
    <input type="text" value="" id="umeme_id" style="display:none;" />
    <table style="width:380px">

        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Unit Rate:</span></td>
            <td><input type="text" name="regular" id="ur" value=""/></td>                      
        </tr>        
    </table>
</div>
<!---Deleting Currency--->
<div id="cdialogdel" title="Delete Currency">
    <input type="text" value="" id="cten_id" style="display:none;" />
    <p>Are you sure you want to delete the currency: <b><span id="delcname"></span></b>?</p>
</div>
<!--Add New Umeme Rate-->
<div id="add_u_dialog" title="Add Building Umeme Rate" style="display:none">
    <input value="<?php echo $this->session->userdata('building_id');?>" id="b_u_id" style="display:none;" />
    <table style="width:380px">
        
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Building Name:</span></td>
            <td><?php echo $this->session->userdata('building_name');?></td>                      
        </tr>
        <tr>
            <td><span style="float:right; font-weight: 600; font-family: tahoma;padding-right: 10px;">Unit Rate:</span></td>
            <td><input type="text" name="regular" id="b_rate" value=""/></td>                      
        </tr>        
    </table>
</div>

<script>
    $(function() {
        var domain = "<?php echo base_url(); ?>"; 
        var dynamic = dynamic || {};
    dynamic.dynptable=$('#b_curr').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""f>t<"F"lp>'
    });
	
   var dynamic = dynamic || {};
    dynamic.dynptable=$('#b_umeme').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""f>t<"F"lp>'
    });	
        //==============Umeme Edit=======================================//
        $(document).on('click',"tr .uedit",function(){
            $('.selectElement').chosen();
            $('#udialogedit').dialog('open');
            var umeme_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: domain+"umeme/umeme_info",
                data:{umeme_id:umeme_id},
                success : function(response)
                {
                    if(response.status){
                        $('#umeme_id').val(umeme_id);
                        $('#umemeedit').val(response.data.quantity);
                        $('#ur').val(response.data.rate);                                      
                        $('.selectElement').trigger("liszt:updated");
                        $('.selectElement').chosen();                    
                        $('#udialogedit').dialog('open');
                    }
                },
                dataType:'json'
            });
            return false;
        });
        $( "#udialogedit" ).dialog({
            autoOpen: false,
            width: 420,
            resizable: false,
            modal: true,
            buttons: [
                {
                    text: "Edit",
                    "class": "btnSavex",
                    click: function(){
                        var quantity = $('#umemeedit').val();
                        var rate = $('#ur').val(); 
                        var umeme_id = $('#umeme_id').val();

                        if(quantity!='' && rate!=''){
                            $.ajax({
                                type: 'POST',
                                url: domain+"umeme/edit",
                                data:{umeme_id:umeme_id,quantity:quantity,rate:rate},
                                success : function(response)
                                {
                                    if(response.status){  
                                        jAlert('Congs! The Umeme rate Has been succesfully edited','SUCCESS!')
                                        $( "#udialogedit" ).dialog("close");
                                        //update the view automatically
                                         var editrow='<tr class="gradeA" id="building_u_'+umeme_id+'">'+
                                        '<td class="center">1</td>'+
                                        '<td class="center" id="ur_'+umeme_id+'">'+rate+'</td>'+                                        
                                        '<td class="center">'+                            
                                        '<a class="btn14 topDir mr5 uinfo" original-title="More Info" id="'+umeme_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>'+
                                        '<a class="btn14 topDir mr5 uedit" original-title="Edit" id="'+umeme_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>'+
                                        '<a class="btn14 topDir mr5 udel" original-title="Evict tenant" id="'+umeme_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/record.png"/></a>'+
                                                
                                        '</td>'+
                                        '</tr>';
                                    var index = $('#building_u_'+umeme_id).closest("tr").get(0);
                                    dynamic.dynptable.fnDeleteRow(dynamic.dynptable.fnGetPosition(index));
                                    //console.log(editrow);
                                    dynamic.dynptable.fnAddTr($(editrow)[0],true);
                                    }                                        
                                },
                                dataType: 'json'

                            });
                               $.ajax({
                                type: 'POST',
                                url: domain+"currency/add_uedit",
                                data:{u_edit_rate:rate},
                                success : function(response)
                                {
                                    if(response.status){ 
                                        $( "#cdialogedit" ).dialog("close");
                                        //update the view automatically
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
                        $( "#udialogedit" ).dialog( "close" );
                    }
                }
            ]
        });
        
        //==============Currency Edit=======================================//
        $(document).on('click',"tr .cedit",function(){
            $('.selectElement').chosen();
            $('#cdialogedit').dialog('open');
            var currency_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: domain+"currency/currency_info",
                data:{currency_id:currency_id},
                success : function(response)
                {
                    if(response.status){
                        $('#currency_id').val(currency_id);
                        $('#currencyedit').val(response.data.currency);
                        $('#r').val(response.data.rate);                                      
                        $('.selectElement').trigger("liszt:updated");
                        $('.selectElement').chosen();                    
                        $('#cdialogedit').dialog('open');
                    }
                },
                dataType:'json'
            });
            return false;
        });
        $( "#cdialogedit" ).dialog({
            autoOpen: false,
            width: 420,
            resizable: false,
            modal: true,
            buttons: [
                {
                    text: "Edit",
                    "class": "btnSavex",
                    click: function(){
                        var currency = $('#currencyedit').val();
                        var rate = $('#r').val(); 
                        var currency_id = $('#currency_id').val();

                        if(currency!='' && rate!=''){
                            $.ajax({
                                type: 'POST',
                                url: domain+"currency/edit",
                                data:{currency_id:currency_id,currency:currency,rate:rate},
                                success : function(response)
                                {
                                    if(response.status){ 
                                        url:domain+"currency/add_edit"
                                        jAlert('Congs! The currency '+currency+' Has been succesfully edited','SUCCESS!')
                                        $( "#cdialogedit" ).dialog("close");
                                        //update the view automatically
                                        
                                        var editrow='<tr class="gradeA" id="building_c_'+currency_id+'">'+
                                        '<td class="center" id="r_'+currency_id+'">'+currency+'</td>'+
                                        '<td class="center" id="r_'+currency_id+'">'+rate+'</td>'+                                        
                                        '<td class="center">'+                            
                                        '<a class="btn14 topDir mr5 cinfo" original-title="More Info" id="'+currency_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/cog3.png"/></a>'+
                                        '<a class="btn14 topDir mr5 cedit" original-title="Edit" id="'+currency_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/pencil.png"/></a>'+
                                        '<a class="btn14 topDir mr5 cdel" original-title="Evict tenant" id="'+currency_id+'" href="#"><img alt="" src="<?php echo base_url(); ?>images/icons/dark/record.png"/></a>'+
                                                
                                        '</td>'+
                                        '</tr>';
                                    var index = $('#building_c_'+currency_id).closest("tr").get(0);
                                    dynamic.dynptable.fnDeleteRow(dynamic.dynptable.fnGetPosition(index));
                                    //console.log(editrow);
                                    dynamic.dynptable.fnAddTr($(editrow)[0],true);
                                    }                                        
                                },
                                dataType: 'json'

                            });
                            
                            //adding currency edit details
                            $.ajax({
                                type: 'POST',
                                url: domain+"currency/add_edit",
                                data:{edit_rate:rate},
                                success : function(response)
                                {
                                    if(response.status){ 
                                        $( "#cdialogedit" ).dialog("close");
                                        //update the view automatically
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
                        $( "#cdialogedit" ).dialog( "close" );
                    }
                }
            ]
        });
        //============Currency info==================//
        $(document).on('click',"tr .cinfo",function(){
            var currency_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: domain+"currency/currency_info",
                data:{currency_id:currency_id},
                success : function(response)
                {
                    if(response.status){
                        $('#id').html(response.data.id);
                        $('#currency').html(response.data.currency);
                        $('#x').html(response.data.rate);
                                        
                        $('#cdialoginfo').dialog('open');
                    }
                },
                dataType:'json'
            });
            return false;
        });
        $("#cdialoginfo").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Ok: function() {
                    $(this).dialog( "close" );
                }
            }
        });
        
        ///=========Currency delete===================//
        $("#cdialogdel").dialog({
            autoOpen: false,
            width: 395,
            modal: true,
            buttons: [
                {
                    text: "Ok",
                    "class": "btnSavex",
                    click: function(){
                        var currency_id = $('#cten_id').val();
                        $.ajax({
                            type: "POST",
                            url: domain+"currency/delete",
                            data:{currency_id:currency_id},
                            success : function(response)
                            {          
                                if(response.status){                                        
                                    $("#cdialogdel").dialog("close");
                                    window.location = domain+"currency/manage";
                                }  
                            },
                            dataType:'json'
                        });
                        return false;
                    }
                },
                {
                    text: "Cancel",
                    "class":"btnCancelx",
                    click: function(){
                        $("#cdialogdel").dialog("close");
                    } 
                }
            ]
                
        });
    
        $(document).on('click',"tr .cdel",function(){
            var currency_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: domain+"currency/del_info",
                data:{currency_id:currency_id},
                success : function(response)
                {
                    $('#cten_id').val(currency_id);
                    $('p #delcname').html(response.currency);
                    $('#cdialogdel').dialog('open');

                },
                dataType:'json'
            });
            return false;
        });
        
        $(document).on('click', '#rateregform', function(){
            $('#add_u_dialog').dialog("open");
        });
        
        $('#add_u_dialog').dialog({
            autoOpen: false,
            width: 400,
            modal: true,
            buttons: [
                {
                    text: "Ok",
                    "class": "btnSavex",
                    click: function(){
                        var rate = $('#b_rate').val();
                        var b_id = $('#b_u_id').val();
                        $.ajax({
                            type: "POST",
                            url: domain+"umeme/add_umeme",
                            data: {rate:rate, b_id:b_id},
                            dataType: "json",
                            success: function(response) {
                                if(response.status){
                                     $.ajax({
                                type: 'POST',
                                url: domain+"currency/add_uedit",
                                data:{u_edit_rate:rate},
                                success : function(response)
                                {
                                    if(response.status){ 
                                        $( "#cdialogedit" ).dialog("close");
                                        //update the view automatically
                                    }                                        
                                },
                                dataType: 'json'

                            });
                                    $('#add_u_dialog').dialog('close');
                                }
                            }
                        });
                    }
                },
                {
                    text: "Cancel",
                    "class":"btnCancelx",
                    click: function(){
                        $("#add_u_dialog").dialog("close");
                    } 
                }
            ]
        });

    
    });

</script>
