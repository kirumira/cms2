<!-- Content -->

    <div class="content" id="container">

    	<div class="title"><h5>Add New Manager:</h5></div>
        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

                <div class="widget first">

                    <div class="head"><h5 class="iList">Enter Manager Details.</h5></div>

                    <div class="rowElem nobg">
                        <label>First Name:</label><div class="formRight"><input type="text" name="f_name" class="validate[required]" value="<?php echo set_value('f_name');?>"/></div>
                        <?php
                        if(form_error('f_name') != null){
                            echo '<div class="nNote nFailure">'.form_error('f_name').'</div>';
                        }?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Last Name:</label><div class="formRight"><input type="text" name="l_name" class="validate[required]" value="<?php echo set_value('l_name');?>"/></div>
                        <?php
                        if(form_error('l_name') != null){
                            echo '<div class="nNote nFailure">'.form_error('l_name').'</div>';
                        }?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Email:</label><div class="formRight"><input type="text" name="email" class="validate[required]" value="<?php echo set_value('email');?>"/></div>
                        <?php
                        if(form_error('email') != null){
                            echo '<div class="nNote nFailure">'.form_error('email').'</div>';
                        }?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Password:</label><div class="formRight"><input type="password" name="pass" class="validate[required]" value="<?php echo set_value('pass');?>"/></div>
                        <?php
                        if(form_error('pass') != null){
                            echo '<div class="nNote nFailure">'.form_error('pass').'</div>';
                        }?>
                        <div class="fix"></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Confirm Password:</label><div class="formRight"><input type="password" name="pass_confirm" class="validate[required]" value="<?php echo set_value('pass_confirm');?>"/></div>
                        <?php
                        if(form_error('pass_confirm') != null){
                            echo '<div class="nNote nFailure">'.form_error('pass_confirm').'</div>';
                        }?>
                        <div class="fix"></div>
                    </div>

                    <div class="rowElem nobg">
                        <label>User Type :</label><div class="formRight"><select name="type" value="<?php echo set_value('type');?>"><option>Select User Type</option><?php echo $types ?></select></div>
                        <?php
                        if(form_error('type') != null){
                            echo '<div class="nNote nFailure">'.form_error('type').'</div>';
                        }?>
                        <div class="fix"></div>
                    </div>


                    <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
                </div>
       </fieldset>
       </form>


    </div>
