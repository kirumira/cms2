<!-- Content -->

    <div class="content" id="container">
        <div class="title"><h5>Landlords:</h5></div>
        
        <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

                <div class="widget first">

                    <div class="head"><h5 class="iList">Enter Landlord Details.</h5></div>

                    <div class="rowElem nobg">
                        <label>First Name:</label><div class="formRight"><input type="text" name="f_name" class="validate[required]" value="<?php echo $landlord_data[0]['l_name_first']?>"/></div>
                        <div class="fix"><?php echo form_error('f_name'); ?></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Last Name:</label><div class="formRight"><input type="text" name="l_name" class="validate[required]" value="<?php echo $landlord_data[0]['l_name_last']?>"/></div>
                        <div class="fix"><?php echo form_error('l_name'); ?></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Email:</label><div class="formRight"><input type="text" name="email" class="validate[required]" value="<?php echo $landlord_data[0]['l_email']?>"/></div>
                        <div class="fix"><?php echo form_error('email'); ?></div>
                    </div>
                    <div class="rowElem nobg">
                        <label>Telephone:</label><div class="formRight"><input type="text" name="telephone" class="validate[required]" value="<?php echo $landlord_data[0]['telephone']?>"/></div>
                        <div class="fix"><?php echo form_error('telephone'); ?></div>
                    </div>
                    
                    <div class="rowElem"><input type="submit" value="Submit form" class="basicBtn submitForm" /><div class="fix"></div></div>
                </div>
       </fieldset>
       </form>
    </div>
