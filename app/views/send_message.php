

<!-- Content -->

<div class="content" id="container">
    <?php    $ci = & get_instance();    ?>
    <div class="title"><h5>Send Message</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Message Details.</h5></div>

                <div class="rowElem nobg">
                    <div class="firstLabel">
                        <label class="label2">By Email</label>
                        <input type="checkbox" name="email" value="accept" checked="checked"  class=""/>
                    </div>
                    <div class="secondLabel">
                        <label class="label2">By SMS</label>
                        <input type="checkbox" name="sms" value="accept" checked="checked"  class=""/>
                    </div>
                    <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                        <label>Send To Building :</label><div class="formRight"><select id="b_id" name="building" value="<?=set_value('building');?>"><?php echo $buildings?></select></div>
                        <?php
                            if (form_error('building')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('building') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                        <label>Send To Floor :</label><div id="floor" class="formRight"><select  id="sfloor" name="floor" value="<?=set_value('floor');?>"><?php echo $floors?></select></div>
                        <?php
                            if (form_error('floor')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('floor') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                </div>

                <div class="rowElem nobg">
                        <label>Send To Room :</label><div class="formRight"><select name="room" value="<?=set_value('room');?>"><?php echo $rooms?></select></div>
                        <?php
                            if (form_error('floor')) {
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
                    <label>Message :</label><div class="formRight"><textarea rows="4" cols="50" placeholder="Message" name="message"></textarea></div>
                        <?php
                            if (form_error('floor')) {
                                echo'
                                            <div class="nNote nFailure hideit">
                                                <p><strong>FAILURE: </strong>' . form_error('room') . '</p>
                                            </div>
                                        ';
                            }
                            ?>
                        <div class="fix"></div>
                </div>

                <div class="rowElem"><input type="submit" value="Send" class="basicBtn submitForm" /><div class="fix"></div></div>
            </div>
        </fieldset>
    </form>


</div>

