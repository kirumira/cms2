<!-- Content -->
<div class="content" id="container" style="width:50%;">

    <div class="title"><h5><?php $ci = & get_instance(); echo $ci->session->userdata('building_name'); ?> > <?php echo $flr_name; ?> > Set Number of Rooms</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first" >

                <div class="head"><h5 class="iList">Enter Number of Rooms</h5></div>

                <div class="rowElem nobg">
                    <input type="text" name="flr" style="display: none;" value="<?php echo $flr; ?>"/>
                    <label>Number of Rooms:</label><div class="formRight">                        
                        <input type="text" name="rm_num" class="validate[required]"/></div>
                    <?php
                    if (form_error('rm_num')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('rm_num') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div>
                </div>
                

                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>


</div>
