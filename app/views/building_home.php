<script src="<?php echo base_url(); ?>js/knockout.js" type="text/javascript"></script>
<!--<input style="display:none" id="n_f" value="<?php echo $floor[1][0]['b_num_floors'];?>"/>
<input style="display:none" id="rr" value="<?php echo $floor[1][0]['rate'];?>"/>-->
<div class="content" id="container">
    
    <?php $ci = & get_instance();?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?></h5></div>
    <div style="border:1px solid #D5D5D5;height: 38px;width:100%;background-color: #EBF5B3;margin-top: 10px;margin-bottom: 10px;text-align: center;">
        <span data-bind="event:{click:bprev}" title="previous floor" style="cursor: pointer;width: 10px;float: left;margin-left: 20px;"><img style="padding-top:10px;" src="<?php echo base_url();?>images/leftArrow.png"/></span>
        <span> <b data-bind="text: floor"></b></span>
        <img style=" display:none;text-align:center;" id ="loader" class="p12" alt="" src="<?php echo base_url();?>images/loaders/loader3.gif" />
        <span data-bind="event:{click:bnext}" title="next floor" style="cursor: pointer; width: 10px;float: right;margin-right: 20px;"><img style="padding-top:10px;" src="<?php echo base_url();?>images/rightArrow.png"/></span>
        
    </div>
    
    
    <div id="utable">
        <table width="100%" id="xtable"></table>
    </div>
    <div>
        <span id="floorPlan"></span>
    </div>

    <!--<div>
        <a href='<?php echo base_url().'';?>'></a>
    </div>-->
    
</div>
<div id="rm_dimensions" title="Room Dimensions" style="display:none;">
    <input type="text" value="" id="rm_id" style="display:none;" />
    <table style="width:100%;">
        <tr>
            <th>Room: </th>
            <td ><b id="rm_name" color="green"></b></td>
        </tr>
        <tr>
            <th>Closed: </th>
            <td><p><input type="checkbox" id="rm_state"/></p></td>
 
        </tr>
        <tr>
            <th>Dimensions: </th>
            <td ><input type="text" name="regular" id="dim" value=""/></td>
        </tr>
        <tr>
            <th>Size: </th>
            <td ><input type="text" name="regular" id="size" value=""/></td>
        </tr>
        
    </table>
</div>

<?php if ($this->session->userdata('user_type')!='landlord'){?>
<script>
    var n = 1;
    $(document).ready(function(){
        $(document).on('click','.mov',function(){
            var name = $(this).attr('name');
            var rm_id = $(this).attr('id');
            $('#rm_name').html(name);
            $('#rm_id').val(rm_id);
            $.ajax({
                type:'GET',
                url: "<?php echo base_url();?>buildings/get_rm_dimensions/"+rm_id,
                dataType: 'json',
                success: function(response){
                        $('#dim').val(response.rm_dimensions);
                        $('#size').val(response.rm_size);
                        //$('#rm_state').val(response.rm_status);
                        //$('.selectElement').chosen();
                        //$('.selectElement').trigger("liszt:updated");
                        if(response.rm_state=='CLOSED'){
                            $('#rm_state').attr('checked',true);
                        }else{
                            $('#rm_state').attr('checked',false);
                        }
                        $('#rm_dimensions').dialog('open');                    
                }
            });
        });         
    });
</script>
<?php }?>
<script>
    $('#rm_dimensions').dialog({
        autoOpen: false,
        width: 300,
        //height:350,
        modal: true,
        resizable: false,
        buttons: [
            {
                text: 'Save',
                "class": 'btnSavex',
                click: function(){
                    var rm_id = $('#rm_id').val();
                    var xdim = $('#dim').val();
                    var xsize = $('#size').val();
                    //console.log('76575757');$('#r_male').attr("checked")
                    var rm_state = $('#rm_state').attr('checked');
                    if(rm_state){
                        rm_state = 'CLOSED';
                    }else{
                        rm_state = 'OPEN';
                    }
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url();?>buildings/change_rm_dimensions",
                        dataType: 'json',
                        data: {rm_id:rm_id,dim:xdim,size:xsize,rm_state:rm_state},
                        success: function(response){
                            if(response.status){
                                $('#loader').show();
                                $.ajax({
                                    type: "GET",
                                    dataType: 'json',
                                    url: "<?php echo base_url();?>buildings/map_floor_x/"+n,
                                    success: function(response){                                    
                                        var rows = ''; 
                                        self.floor(response.fl_name+' ('+response.n_rooms+' rooms)')
                                        $.each(response.data,function(index,value){
                                            rows += '<tr>'+
                                                        '<td name="'+value[0].room_name+'" class="'+value[0].xclass+'" id="'+value[0].rm_id+'" style="border-radius:15px;background:'+value[0].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[0].room_name+'<br>('+value[0].rm_state+')'+'<br>'+value[0].tenant_id+'<br>'+value[0].rm_dimensions+'<br>'+value[0].rm_size+'</b></td>'+
                                                        '<td name="'+value[1].room_name+'" class="'+value[1].xclass+'" id="'+value[1].rm_id+'" style="border-radius:15px;background:'+value[1].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[1].room_name+'<br>('+value[1].rm_state+')'+'<br>'+value[1].tenant_id+'<br>'+value[1].rm_dimensions+'<br>'+value[1].rm_size+'</b></td>'+
                                                        '<td name="'+value[2].room_name+'" class="'+value[2].xclass+'" id="'+value[2].rm_id+'" style="border-radius:15px;background:'+value[2].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[2].room_name+'<br>('+value[2].rm_state+')'+'<br>'+value[2].tenant_id+'<br>'+value[2].rm_dimensions+'<br>'+value[2].rm_size+'</b></td>'+
                                                        '<td name="'+value[3].room_name+'" class="'+value[3].xclass+'" id="'+value[3].rm_id+'" style="border-radius:15px;background:'+value[3].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[3].room_name+'<br>('+value[3].rm_state+')'+'<br>'+value[3].tenant_id+'<br>'+value[3].rm_dimensions+'<br>'+value[3].rm_size+'</b></td>'+
                                                        '<td name="'+value[4].room_name+'" class="'+value[4].xclass+'" id="'+value[4].rm_id+'" style="border-radius:15px;background:'+value[4].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[4].room_name+'<br>('+value[4].rm_state+')'+'<br>'+value[4].tenant_id+'<br>'+value[4].rm_dimensions+'<br>'+value[4].rm_size+'</b></td>'+
                                                    '</tr>'; 
                                        });
                                        $('#xtable').html(rows);
                                        if(response.flr_path=='NONE'){                                            
                                            $('#floorPlan').hide();
                                        }else{
                                            $('#floorPlan').html('<a href="<?php echo base_url()?>'+response.flr_path+'">Floor Plan</a>');
                                            $('#floorPlan').show();                            
                                        }
                                        $('#loader').hide();   
                                        $('#rm_dimensions').dialog('close');
                                    }
                                });
                            }
                            
                            ////
                        }
                    });
                }
            },
            {
                text: 'Cancel',
                "class": "btnCancelx",
                click: function(){
                    $('#rm_dimensions').dialog('close');
                }
            }
        ]
    });

    $('#loader').show();
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "<?php echo base_url();?>buildings/map_floor_x/1",
        success: function(response){
            var rows = ''; 
            $.each(response.data,function(index,value){
                rows += '<tr>'+
                            '<td name="'+value[0].room_name+'" class="'+value[0].xclass+'" id="'+value[0].rm_id+'" style="border-radius:15px;background:'+value[0].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[0].room_name+'<br>('+value[0].rm_state+')'+'<br>'+value[0].tenant_id+'<br>'+value[0].rm_dimensions+'<br>'+value[0].rm_size+'</b></td>'+
                            '<td name="'+value[1].room_name+'" class="'+value[1].xclass+'" id="'+value[1].rm_id+'" style="border-radius:15px;background:'+value[1].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[1].room_name+'<br>('+value[1].rm_state+')'+'<br>'+value[1].tenant_id+'<br>'+value[1].rm_dimensions+'<br>'+value[1].rm_size+'</b></td>'+
                            '<td name="'+value[2].room_name+'" class="'+value[2].xclass+'" id="'+value[2].rm_id+'" style="border-radius:15px;background:'+value[2].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[2].room_name+'<br>('+value[2].rm_state+')'+'<br>'+value[2].tenant_id+'<br>'+value[2].rm_dimensions+'<br>'+value[2].rm_size+'</b></td>'+
                            '<td name="'+value[3].room_name+'" class="'+value[3].xclass+'" id="'+value[3].rm_id+'" style="border-radius:15px;background:'+value[3].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[3].room_name+'<br>('+value[3].rm_state+')'+'<br>'+value[3].tenant_id+'<br>'+value[3].rm_dimensions+'<br>'+value[3].rm_size+'</b></td>'+
                            '<td name="'+value[4].room_name+'" class="'+value[4].xclass+'" id="'+value[4].rm_id+'" style="border-radius:15px;background:'+value[4].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[4].room_name+'<br>('+value[4].rm_state+')'+'<br>'+value[4].tenant_id+'<br>'+value[4].rm_dimensions+'<br>'+value[4].rm_size+'</b></td>'+
                        '</tr>';
            });
            $('#xtable').html(rows);
            if(response.flr_path=='NONE'){
                            $('#floorPlan').hide();
                        }else{
                            $('#floorPlan').html('<a href="<?php echo base_url()?>'+response.flr_path+'">Floor Plan</a>');
                            $('#floorPlan').show();                             
                        }
            ko.applyBindings(new viewModel(response.fl_name,response.n_rooms));
            $('#loader').hide();
        }
    });
    
    function viewModel(f,r){
        
        //var n = 1;
        var floors = "<?php echo $this->session->userdata('floors');?>";
        //console.log(floors);
        self.floor = ko.observable(f+' ('+r+' rooms)');
        self.bprev = function(){
            if(n>1){
                $('#loader').show();
                $('#utable').hide("slide", { direction: "right" }, 700);
                setTimeout(function(){
                    $('#utable').show("slide", { direction: "left" }, 800);
                },700);
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "<?php echo base_url();?>buildings/map_floor_x/"+(n-1),
                    success: function(response){                        
                        var rows = ''; 
                        n = (n-1);
                        self.floor(response.fl_name+' ('+response.n_rooms+' rooms)');
                        $.each(response.data,function(index,value){
                            rows += '<tr>'+
                                        '<td name="'+value[0].room_name+'" class="'+value[0].xclass+'" id="'+value[0].rm_id+'" style="border-radius:15px;background:'+value[0].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[0].room_name+'<br>('+value[0].rm_state+')'+'<br>'+value[0].tenant_id+'<br>'+value[0].rm_dimensions+'<br>'+value[0].rm_size+'</b></td>'+
                                        '<td name="'+value[1].room_name+'" class="'+value[1].xclass+'" id="'+value[1].rm_id+'" style="border-radius:15px;background:'+value[1].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[1].room_name+'<br>('+value[1].rm_state+')'+'<br>'+value[1].tenant_id+'<br>'+value[1].rm_dimensions+'<br>'+value[1].rm_size+'</b></td>'+
                                        '<td name="'+value[2].room_name+'" class="'+value[2].xclass+'" id="'+value[2].rm_id+'" style="border-radius:15px;background:'+value[2].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[2].room_name+'<br>('+value[2].rm_state+')'+'<br>'+value[2].tenant_id+'<br>'+value[2].rm_dimensions+'<br>'+value[2].rm_size+'</b></td>'+
                                        '<td name="'+value[3].room_name+'" class="'+value[3].xclass+'" id="'+value[3].rm_id+'" style="border-radius:15px;background:'+value[3].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[3].room_name+'<br>('+value[3].rm_state+')'+'<br>'+value[3].tenant_id+'<br>'+value[3].rm_dimensions+'<br>'+value[3].rm_size+'</b></td>'+
                                        '<td name="'+value[4].room_name+'" class="'+value[4].xclass+'" id="'+value[4].rm_id+'" style="border-radius:15px;background:'+value[4].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[4].room_name+'<br>('+value[4].rm_state+')'+'<br>'+value[4].tenant_id+'<br>'+value[4].rm_dimensions+'<br>'+value[4].rm_size+'</b></td>'+
                                    '</tr>'; 
                        });
                        $('#xtable').html(rows);
                        if(response.flr_path=='NONE'){
                            $('#floorPlan').hide();
                        }else{
                            $('#floorPlan').html('<a href="<?php echo base_url()?>'+response.flr_path+'">Floor Plan</a>');
                            $('#floorPlan').show();                             
                        }
                        $('#loader').hide();                        
                    }
                });
            }
        }
        self.bnext = function(){
            if(n<parseInt(floors)){
                $('#loader').show();
                $('#utable').hide("slide", { direction: "left" }, 700);
                setTimeout(function(){
                    $('#utable').show("slide", { direction: "right" }, 800);
                },700);            
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "<?php echo base_url();?>buildings/map_floor_x/"+(n+1),
                    success: function(response){
                        var rows = ''; 
                        n = (n+1);
                        self.floor(response.fl_name+' ('+response.n_rooms+' rooms)');
                        $.each(response.data,function(index,value){
                            rows += '<tr>'+
                                        '<td name="'+value[0].room_name+'" class="'+value[0].xclass+'" id="'+value[0].rm_id+'" style="border-radius:15px;background:'+value[0].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[0].room_name+'<br>('+value[0].rm_state+')'+'<br>'+value[0].tenant_id+'<br>'+value[0].rm_dimensions+'<br>'+value[0].rm_size+'</b></td>'+
                                        '<td name="'+value[1].room_name+'" class="'+value[1].xclass+'" id="'+value[1].rm_id+'" style="border-radius:15px;background:'+value[1].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[1].room_name+'<br>('+value[1].rm_state+')'+'<br>'+value[1].tenant_id+'<br>'+value[1].rm_dimensions+'<br>'+value[1].rm_size+'</b></td>'+
                                        '<td name="'+value[2].room_name+'" class="'+value[2].xclass+'" id="'+value[2].rm_id+'" style="border-radius:15px;background:'+value[2].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[2].room_name+'<br>('+value[2].rm_state+')'+'<br>'+value[2].tenant_id+'<br>'+value[2].rm_dimensions+'<br>'+value[2].rm_size+'</b></td>'+
                                        '<td name="'+value[3].room_name+'" class="'+value[3].xclass+'" id="'+value[3].rm_id+'" style="border-radius:15px;background:'+value[3].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[3].room_name+'<br>('+value[3].rm_state+')'+'<br>'+value[3].tenant_id+'<br>'+value[3].rm_dimensions+'<br>'+value[3].rm_size+'</b></td>'+
                                        '<td name="'+value[4].room_name+'" class="'+value[4].xclass+'" id="'+value[4].rm_id+'" style="border-radius:15px;background:'+value[4].rm_status+';border:2px solid #F3F3F3;width:20%;height:100px;color:#white;text-align:center;"><b style="color:white;">'+value[4].room_name+'<br>('+value[4].rm_state+')'+'<br>'+value[4].tenant_id+'<br>'+value[4].rm_dimensions+'<br>'+value[4].rm_size+'</b></td>'+
                                    '</tr>'; 
                        });
                        $('#xtable').html(rows);
                        if(response.flr_path=='NONE'){
                            $('#floorPlan').hide();
                        }else{
                            $('#floorPlan').html('<a href="<?php echo base_url()?>'+response.flr_path+'">Floor Plan</a>');
                            $('#floorPlan').show();                             
                        }
                        $('#loader').hide();                        
                    }
                });
            }
        }        
    }    
</script>
