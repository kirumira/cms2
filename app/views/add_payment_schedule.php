<!-- Content -->

<div class="content" id="container">
    <?php    $ci = & get_instance();    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name') ?> > Schedule Payments:</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Schedule Details.</h5></div>

                <div class="rowElem nobg">
                     <label>Room :</label>
                     <div class="select-menus" id="rm_id1">
                         <div class="formRight"><select id="rm_id" name="room" value="<?=set_value('room');?>"><?php echo $rooms; ?></select></div>
                     </div>
                        <?php
                            if (form_error('room')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('room') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>

                        <div id="figure" class="rowElem nobg"></div>
                </div>

                
                <div class="rowElem nobg">
                    <label>Number of Installments:</label><div class="formRight"><input type="text" id="num" name="num" class="validate[required]"/></div>
                        <?php
                        if (form_error('num')) {
                            echo'
                                        <div class="nNote nFailure hideit">
                                            <p><strong>FAILURE: </strong>' . form_error('num') . '</p>
                                        </div>
                                    ';
                        }
                        ?>
                    <div class="fix"></div>
                </div>

                <div id="fig" class="rowElem nobg">
                    
                </div>
                <div>
                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('#num').change(function(){
            var num_installments = $('#num').val();
            $.ajax({
                url: "<?php echo base_url();?>bills/num_installments",
                type: "POST",
                data: {num_installments:num_installments},
                success: function(response){
                    $('#fig').html(response);
                },
                dataType: "html"
            });
        });

        $('#rm_id').change(function(){           
            var rm_id = $('#rm_id').val();
            $.ajax({
                url: "<?php echo base_url();?>bills/test",
                type: "POST",
                data: {rm_id:rm_id},
                success: function(response){
                    $('#figure').html(response);
                },
                dataType:"html"
            });
        });
    });

</script>
