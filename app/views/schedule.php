<!-- Content -->

<div class="content" id="container">
    <?php    $ci = & get_instance();    ?>
    <div class="title"><h5><?php echo $ci->session->userdata('building_name') ?> > Schedule Payments:</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Schedule Details.</h5></div>

                
                <div class="rowElem nobg">
                    <label>Room:</label><div class="formRight"><input type="text" name="room"  value="<?=$room[0]['room_name']?>" class="validate[required]"/></div>
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
                </div>

                <div class="rowElem nobg">
                    <label>Balance Due:</label><div class="formRight"><input type="text" name="room"  value="<?=$room[0]['room_name']?>" class="validate[required]"/></div>
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
                </div>

                <?php for($i = 1; $i <= $num; $i++){
                    echo "<div class='rowElem nobg'>
                                <label>Date: </label>
                                <input type='text' name='date".$i."' class='datepicker' class='validate['required]'/>
                                <label2>Amount: </label>
                                <input type='text' name='amount".$i."' class='validate['required]'>
                        </div>";
                }?>
                <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>


</div>
