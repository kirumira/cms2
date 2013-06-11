<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5>Register An expense:</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Expense Details.</h5></div>

                <div class="rowElem nobg"><label>Expense Code :</label><div class="formRight">
                        <select name="e_code" value="<?php echo set_value('e_code'); ?>"><?php echo $e_code ?></select>
                    </div>
                    <div class="fix"></div></div>
                <div class="rowElem nobg"><label>Amount :</label><div class="formRight">
                        <input type="text" name="e_amount" class="validate[required]"/></div>
                    <?php
                    if (form_error('e_amount')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('e_amount') . '</p>
                                    </div>
                                ';
                    }
                    ?>
                    <div class="fix"></div></div>
                <div class="rowElem nobg"><label>Building :</label><div class="formRight">
                        <select name="b_id" value="<?php echo set_value('b_id'); ?>"><?php echo $e_b ?></select>
                    </div><div class="fix"></div></div>
                <div class="rowElem nobg"><label>Floor :</label><div class="formRight">
                        <select name="e_floor" value="<?php echo set_value('floor'); ?>">
                            <option value="" >-Select-</option>
                            <?php echo $fl ?></select>

                        <div class="fix"></div></div></div>
                    <div class="rowElem nobg"><label>Room :</label><div class="formRight">
                            <select name="e_room" value="<?php echo set_value('room_name'); ?>">
                                <option value="" >-Select-</option>
                                <?php echo $rm ?></select>
                            <?php
                            if (form_error('e_room')) {
                                echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('e_room') . '</p>
                                    </div>
                                ';
                            }
                            ?>
                            <div class="fix"></div></div>

                        <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
                    </div>
                    </fieldset>
                    </form>


                </div>