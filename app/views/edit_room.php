<!-- Content -->

    <div class="content" id="container">
        <?php $ci = & get_instance();?>
        <div class="title"><h5><?php echo $ci->session->userdata('building_name');?> > Edit Room <?php echo $room_data[0]['room_name'] ;?>:</h5></div>

        <a href="<?php echo base_url(); ?>floors/evict_tenant/<?php echo $room_data[0]['rm_id']; ?>" title="">
            <input type="button" value="Evict Tenant" class="greenBtn right" />
        </a>

        <a href="<?php echo base_url(); ?>floors/delete_room/<?php echo $room_data[0]['rm_id'] ; ?>" title="">
            <input type="button" value="Delete Room" class="greenBtn right" />
        </a>
        <a href="<?php echo base_url(); ?>floors/edit_room/<?php echo $room_data[0]['rm_id'] ; ?>" title="">
            <input type="button" value="Edit Room" class="greenBtn right" />
        </a>
        
        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

                <div class="widget first">

                    <div class="head"><h5 class="iList">Edit Room Details.</h5></div>

                     <div class="rowElem nobg">
                        <label>Room Name:</label><div class="formRight"><input type="text" name="room_name" class="validate[required]" value="<?php echo $room_data[0]['room_name']?>"/></div>
                        <?php
                            if (form_error('room_name')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('room_name') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                   
                    <div class="rowElem nobg">
                        <label>Description:</label><div class="formRight"><input type="text" name="desc" class="validate[required]" value="<?php echo $room_data[0]['description']?>"/></div>
                        <?php
                            if (form_error('desc')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('desc') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    
                    <div class="rowElem nobg">
                        <label>Monthly Rent:</label><div class="formRight"><input type="text" name="m_cost" class="validate[required]" value="<?php echo $room_data[0]['rm_cost']?>"/></div>
                        <?php
                            if (form_error('m_cost')) {
                                echo'       <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('m_cost') . '</p>
                                            </div>';
                            }
                        ?>
                        <div class="fix"></div>
                    </div>
                    

                    


                    <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
                </div>
       </fieldset>
       </form>
    </div>

