<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5><?php $ci = & get_instance(); echo $ci->session->userdata('building_name'); ?>> Add More Floors</h5></div>
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Enter Number of Additional Floors</h5></div>

                <div class="rowElem nobg">
                    <label>Number of Floors:</label><div class="formRight">
                        <input type="text" name="f_num" class="validate[required]"/></div>
                    <?php
                    if (form_error('f_num')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('f_num') . '</p>
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
