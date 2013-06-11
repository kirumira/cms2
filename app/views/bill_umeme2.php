<script src="<?php echo base_url(); ?>js/knockout.js" type="text/javascript"></script>
<input style="display:none" id="rr" value="<?php echo $rate;?>"/>
<input style="display:none" id="rb" value="<?php echo $this->session->userdata('building_id');?>"/>

<!--Umeme Report Form-->
<div id="umeme_rt_dialog" title="Set Umeme Rate" style="display:none;">
    <table width="100%">
        <tr>
            <th>Unit Rate(Ushs): </th>
            <td ><input type="text" name="regular" id="ux_rate" value=""/></td>
        </tr>
    </table>-
</div>

<script>
//    var rt = $('#rr').val();
//    if(rt == 0){
//        $('#umeme_rt_dialog').dialog('open');
//    }

    $('#umeme_rt_dialog').dialog({
        autoOpen: false,
        width: 300,
        modal: true,
        buttons: [{
                text: "OK",
                "class": "btnSavex",
                click: function(){
                    var rate = $('#ux_rate').val();
                    var b_id = $('#rb').val();
                    $.ajax({
                        type: "POST",
                            url: domain+"umeme/add_umeme",
                            data: {rate:rate, b_id:b_id},
                            dataType: "json",
                            success: function(response) {
                                if(response.status){
                                    jAlert("Umeme Rate Set", "Info");
                                    $('#umeme_rt_dialog').dialog('close');
                                    window.location = "<?php echo base_url();?>bills/umeme";
                                }
                            }
                    });
                    $('#umeme_rt_dialog').dialog('close');
                }
        },{
                text: "Cancel",
                "class": "btnCancelx",
                click: function(){
                    $('#umeme_rt_dialog').dialog("close");
                }
        }]
    });
</script>
<div class="content" id="container">
    
    <?php $ci = & get_instance();?>
    <div class="title"><h5>UMEME Billing Panel (<?php echo $ci->session->userdata('building_name'); ?>)</h5></div>
    <div style="border:1px solid #D5D5D5;height: 38px;width:100%;background-color: #EBF5B3;margin-top: 10px;margin-bottom: 10px;text-align: center;">
        <span data-bind="event:{click:bprev}" title="previous floor" style="cursor: pointer;width: 10px;float: left;margin-left: 20px;"><img style="padding-top:10px;" src="<?php echo base_url();?>images/leftArrow.png"/></span>
        <span> <b data-bind="text: floor"></b></span>
        <img style=" display:none;text-align:center;" id ="loader" class="p12" alt="" src="<?php echo base_url();?>images/loaders/loader3.gif" />
        <span data-bind="event:{click:bnext}" title="next floor" style="cursor: pointer; width: 10px;float: right;margin-right: 20px;"><img style="padding-top:10px;" src="<?php echo base_url();?>images/rightArrow.png"/></span>
    </div>
    
    <div id="utable" style="margin-bottom:10px;">
        <table id="utable1" style="border:1px solid #D5D5D5;" cellpadding="0" cellspacing="0" width="100%" class="tableStatic">
            <thead>
                <tr>
                    <td width="15%"><b>Room</b></td>
                    <td width="15%"><b>Previous Reading</b></td>
                    <td width="15"><b>Date last billed</b></td>
                    <td width="15%"><b>Current Reading</b></td>
                    <td width="15%"><b>Units</b></td>
                    <td width="20%"><b>Cost</b></td>
                </tr>
            </thead>
            <tbody data-bind="foreach: ubills">
                <tr>
                    <td data-bind="text: room_name" style="text-align: center;"></td>
                    <td style="text-align: center;" data-bind="text: meter_reading"/></td>
                    <td style="text-align: center;" data-bind="text: last_date"/></td>
                    <td style="text-align: center;"><input class="positivenumeric" style="text-align: center;height:25px;" data-bind="value: n_reading,valueUpdate: 'afterkeydown'"/></td>
                    <td data-bind="text: n_units,valueUpdate: 'afterkeydown'" style="text-align: center;"></td>
                    <td style="text-align: center;" data-bind="text: costview"></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="head" style="border:1px solid #D5D5D5;">
        <button style="margin-right:6.5%;float:right;vertical-align:middle;" data-bind="event:{click:xsave}">Save</button>
    </div>
</div>

<script>
    $(document).ready(function(){
//        var dynamic = dynamic || {};
//        dynamic.dynptable=$('#utable1').dataTable({
//                            "bJQueryUI": true,
//                            "sPaginationType": "full_numbers",
//                            "sDom": '<""f>t<"F"lp>'
//        });
    });

    var rt = $('#rr').val();
    if(rt == 0){
        $('#umeme_rt_dialog').dialog('open');
    }else{
        var n = 1;
        var floors = <?php echo $this->session->userdata('floors');?>;//$('#n_f').val();
        var rate = rt;
        //console.log(floors+'---'+rate);
        $('#loader').show();
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "<?php echo base_url();?>bills/bill_umeme_x/1",
            success: function(response){
                ko.applyBindings(new viewModel(response.fl_name,response.rooms));
                $('#loader').hide();
            }
        });
    }

    
    function viewRow(row){
        var self = this;
        //"rm_id":"147","room_name":"A1","meter_reading":"0"
        self.rm_id = ko.observable(row.rm_id);
        self.room_name = ko.observable(row.room_name);
        self.meter_reading = ko.observable(row.meter_reading);
        self.last_date = ko.observable(row.um_bill_date);
        self.n_reading = ko.observable('');
        self.n_units = ko.computed(function(){
            var ret = 0;
            var cal = self.n_reading()-self.meter_reading();
            if(cal>0){
                ret = cal;
            }            
            return ret;
        });
        self.cost = ko.computed(function(){
            return (self.n_units()*rate*1.18).toFixed(0);
        });
        self.costview = ko.computed(function(){
            return add_commas(self.cost());
        });
        self.p_invoice = function(){
            //window.location = "<?php echo base_url()?>generateInvoice";
        }
        
    }
    function viewModel(fl,rms){
        var self = this;
        self.ubills = ko.observableArray([]);
        //self.curr = ko.observable(n);
        self.floor = ko.observable(fl+' ('+rms.length+' rooms)');
        for(var i=0;i<rms.length;i++){
            self.ubills.push(new viewRow(rms[i]));
            $('.positivenumeric').numeric(); 
            $('#loader').hide();
        }
        
        self.bnext = function(){
            if(n<parseInt(floors)){
                $('#loader').show();
                $('#utable').hide("slide", { direction: "left" }, 700);
                self.ubills([]);
                setTimeout(function(){
                    $('#utable').show("slide", { direction: "right" }, 800);
                },700);            
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "<?php echo base_url();?>bills/bill_umeme_x/"+(n+1),
                    success: function(response){
                        for(var i=0;i<response.rooms.length;i++){
                            self.ubills.push(new viewRow(response.rooms[i]));
                        }                    
                        n = (n+1);
                        self.floor(response.fl_name+' ('+response.rooms.length+' rooms)');
                        $('.positivenumeric').numeric();
                        $('#loader').hide();
                    }
                });
            }
             $('.positivenumeric').numeric();   
        }
        self.bprev = function(){
            if(n>1){
                $('#loader').show();
                $('#utable').hide("slide", { direction: "right" }, 700);
                self.ubills([]);
                setTimeout(function(){
                    $('#utable').show("slide", { direction: "left" }, 800);
                },700);
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "<?php echo base_url();?>bills/bill_umeme_x/"+(n-1),
                    success: function(response){
                        for(var i=0;i<response.rooms.length;i++){
                            self.ubills.push(new viewRow(response.rooms[i]));
                        }
                        n = (n-1);
                        self.floor(response.fl_name+' ('+response.rooms.length+' rooms)');
                        $('.positivenumeric').numeric();
                        $('#loader').hide();
                    }
                });
            }
            $('.positivenumeric').numeric();
        }
        
        self.xsave = function(){
            var rdngs = ko.toJS(self.ubills);
            var len = rdngs.length;
            $.each(rdngs, function(index,value){
                if(value.n_reading==''){
                    delete rdngs[index];
                    len = len-1;
                }
            });
            if(len>0){
                $.ajax({
                    type: "POST",
                    dataType:'json',
                    url:"<?php echo base_url();?>bills/umemex",
                    data: {readings:rdngs},
                    success: function(response){  
                        //console.log(response);
                        if(response.status){
                            self.ubills([]);
                            $.ajax({
                                type: "GET",
                                dataType: 'json',
                                url: "<?php echo base_url();?>bills/bill_umeme_x/"+n,
                                success: function(response){
                                    for(var i=0;i<response.rooms.length;i++){
                                        self.ubills.push(new viewRow(response.rooms[i]));
                                        $('.positivenumeric').numeric();
                                    }
                                }
                            });
                        }                    
                    }
                });
            }else{
                jAlert('No new readings entered','INFO!');
            }
            
        }
    }
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
    