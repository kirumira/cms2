<script src="<?php echo base_url(); ?>js/knockout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/knockout.validation.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.numeric.js"></script>-->
<div class="content" style="height:100%;" id="container">
    <?php $ci = & get_instance(); ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name'); ?> > Payment Scheduling</h5></div>
    <div class="widgets">
        <div class="left" style="margin-top: 12px;">
            <div class="head" style="margin-left:0%;">
<!--                <h5 style="margin-left:5%">Room Details: </h5>-->
                <div class="body alignleft">
                    <label style="margin-left: 4%;">Room Name</label>
                    <select class="selectElement" id="room" data-bind="event:{change:refresh}">
                        <option>Select Room</option>
                        <?php echo $rooms;?>                        
                    </select>
                    
                    <span id="xxxx" style="display: none;">
                        <label>Number of installments</label>
                        <input type="text" style="height: 24px;width: 10% !important;padding-left:15px;" data-bind="value: n_installments, valueUpdate: 'afterkeydown'" id="d_ins"/>
                    </span>
                </div>
            </div>
            <div class="supTicket nobg" style="visibility:hidden;" id="tn_rm_dt">
                <div class="issueType" style="width:100%;margin-left: 0%;">
                        <span class="issueInfo"><a href="#" title="">Tenant Name:</a></span>
                    <span class="issueNum"><a href="#" title="" id="t_name">Silas Kaggwa</a></span>
                    <div class="fix"></div>
                </div>

                <div class="issueSummary">
                    <table style="width:100%;margin-left: 0%;">
                        <tr>
                            <td style="vertical-align:top;"><a href="#" title="" class="floatleft"><img id ="t_pic" width="80px" height="80px" src="<?php echo base_url();?>images/user.png" alt="" /></a></td>
                            <td style="vertical-align:middle;">
                                Room Name :<br>
                                Amount Owed :<br>
                                Phone number:<br>
                                Email:<br>
                            </td>
                            <td style="vertical-align:middle;">
                                <strong class="green" style="float:right;" id="rm_nm">15000</strong><br>
                                <strong class="green" style="float:right;" value="" id="am_ow" >15000</strong><br>
                                <strong class="green" style="float:right;" id="t_4n">15000</strong><br>
                                <a href="#" title="" style="float:right;" id="t_em">silakag@gmail.com</a></li>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
<!--    </div>-->
    
        <div class="right" style="margin-top: 12px;" >
            <div class="head">
                <h5 style="margin-left:5%; margin-top: 8px;">Scheduling Panel > (<?php echo $ci->session->userdata('currency');?>)</h5>
            </div>
            <div id="sch_panel">
                <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic" data-bind="visible: viz">
                    <thead>
                        <tr>
                            <td width="auto">Installment</td>
                            <td width="auto">Date</td>
                            <td width="auto">Amount</td>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: installments">
                        <tr>
                            <td data-bind="text: i_name" style="text-align: center;"></td>
<!--                            <td><input type="text" class="datepicker" data-bind="value: i_date"/></td>-->
                            <td style="text-align: center;"><input style="padding-left:15px;height: 24px;width:100px;" data-bind="value: i_date" class="xdatepicker"/></td><!--afterkeydown-->
                            <td style="text-align: center;"><input class="positivenumeric" type="text" data-bind="id: i_name,id:id , value: i_amount, valueUpdate: 'change'" style="width:85%"/></td>
<!--                            <td><input type="text" data-bind="numericText: i_amount" style="width:85%"/></td>-->
                        </tr>
                    </tbody>
                </table>
                <div class="head" data-bind="visible: viz">
                    <table width="100%">
                        <tr>
                            <td><h5 style="margin-left:5%;margin-top:8px;"><b>Amount Owed: <?php echo $ci->session->userdata('currency');?>. <span style="font-size:15px;" data-bind="text: owed"></span></b></h5></td>
                            <td>
                                <a style="margin-right:5%;float:right; margin-top:3px; border-radius: 17px 17px 17px 17px;"  class="btnIconLeft mr10" title="" href="#" data-bind="click: $root.schedule">
                                    <img class="icon" alt="" src="<?php echo base_url();?>images/icons/dark/cart.png"/>
                                    <span>Finish</span>
                                </a>
                            </td>  
                            
                        </tr>
                    </table>
                </div>
            </div>    
        </div>    
    </div>
</div>
<script>
    $('.selectElement').chosen();
    $('.positivenumeric').numeric();
    
    var am = null;
    var ten_id = null;
    $(document).on('change','#room',function(){
        
        var rm_id = $('#room').val();
        if(rm_id != 'Select Room'){
            $('#xxxx').show();
        }else{
            $('#xxxx').hide();
        }
        $('#tn_rm_dt').slideUp("fast");        
        $.ajax({
            type: "POST",
            url:  "<?php echo base_url();?>bills/get_room_debtors",
            data: {rm_id:rm_id},
            dataType: 'json',
            success: function(response){
                am = response.data.debit-response.data.credit;
                ten_id = response.data.tenant_id;
                $('#am_ow').html(add_commas(am));
                $('#am_ow').val(am);
                $('#rm_nm').html(response.data.room_name);
                $('#t_name').html(response.data.f_name+" "+response.data.l_name);
                $('#t_4n').html(response.data.telephone);
                $('#t_em').html(response.data.email);
                $('#t_pic').attr('src', "<?php echo base_url();?>"+response.data.pic_path);
                $("#tn_rm_dt").css("visibility", "visible");
                $('#tn_rm_dt').slideDown("slow");
                
            }
            
        });
    });
    
    function rowModel(i_name){
        var self = this;
        self.i_date = ko.observable();
        
        self.i_amount = ko.observable('');
        self.i_name = ko.observable(i_name);
        self.id = self.i_name;
        
        self.i_amount.subscribe(function(){
            //console.log("check-->"+self.i_amount());
            nStr = ''+self.i_amount().replace(/,/g, '');
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            var ret = x1 + x2;
            self.i_amount(ret);
            //console.log('>>>>'+self.i_amount());
        });
        
       
    }
    function scheduleViewModel(){
        var self = this;
        self.room = ko.observable();
        
        
        self.n_installments = ko.observable(0);
        self.refresh = function(){
            self.n_installments(0);
        }
        self.viz = ko.computed(function(){
            
            if(parseInt(self.n_installments())>0){
                return true;
            }else{
                return false;
            }
        });
        self.installments = ko.observableArray([]);
        self.n_installments.subscribe(function(){
            self.installments([]);
            var n = self.n_installments();
            var i = 1;
            
            while(n>0){
                self.installments.push(new rowModel(i));                
                $('.positivenumeric').numeric();
//                $('.positivenumeric').keyup(function(){
//                    var n = $(this).val().replace(/,/g, '');
//                    var n1 = add_commas(n);
//                    $(this).val(n1);
//                    
//                });
                $('.xdatepicker').datepicker({//$.datepicker.setDefaults({ dateFormat: 'dd-mm-yy' });
                    defaultFormat: 'dd-mm-yy'
                    
                });
                n = n-1;
                i++;
            }
        });
        self.owed = ko.computed(function(){
            var paid = 0;
            var amount = 0;
            var l = 0;
            while(l<self.installments().length){
                
                var ff = self.installments()[l].i_amount()+"";
                if(ff == ''){
                    amount = 0;
                }else{
                    amount = ff.replace(/,/g, '');
                }
                paid += parseInt(amount);
                l++;
            }
            return add_commas(am-paid);
        });
        
//        self.owed.subscribe(function(){
//            var n_empty = 0;//self.n_installments();
//            var emp_index = null;
//            if(self.installments().length == self.n_installments()){
//                for(var r=0;r<self.installments().length;r++){
//                    if(self.installments()[r].i_amount()==''){
//                        n_empty = n_empty + 1;
//                        emp_index = r;
//                    }else{
//                        continue;                    
//                    }
//                }
//
//                if(n_empty == 1){
//                    var last = null;
//                    var curr = 0;
//                    for(var nn=0;nn<self.installments().length;nn++){
//                        if(self.installments()[nn].i_amount()!=''){
//                            curr += parseInt(self.installments()[nn].i_amount().replace(/,/g,''));
//                            //console.log("888>"+curr);
//                        }                        
//                    }
//                    last = am-curr;
//                    last = self.owed();
//                    //console.log("am:"+am+",curr:"+curr+",***>"+last);
//                    self.installments()[emp_index].i_amount(add_commas(last));//(self.owed());
//                    self.owed(0);
//                    //console.log('>>>>'+self.owed());
//                }
//            }
//            
//            
//        });
        //self.rw_am_ch = ko.observable();
        
        
        
        self.schedule = function(){
            var installments = ko.toJS(self.installments);
            var no_installments = self.n_installments();
            var am_owed = $('#am_ow').val();
            var rm_id = $('#room').val()
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>schedules/add",
                data: {installments:installments,no_installments:no_installments,rm_id:rm_id,am_owed:am_owed,tenant_id:ten_id},
                dataType:'json',
                success: function(response){
                    if(response.status){
                        jAlert("Payment scheduled successfully","SUCCESS!");
                        $('#room').val('Select Room');
                        $('.selectElement').trigger("liszt:updated");
                        self.n_installments(0);
                        $('#tn_rm_dt').hide("slow");
                        $('#room').html(response.rooms);
                    }else{
                        jAlert(response.msg,"ERROR!");
                    }
                }
            });
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
    
    ko.applyBindings(new scheduleViewModel());
</script>