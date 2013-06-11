<!-- Content -->

<div class="content" id="container">

    <div class="title"><h5> UMEME Rates</h5></div>
   
    <div class="widget first">
       
    <form action="" id="valid" class="mainForm" method="POST">
        <fieldset>

            <div class="widget first">

                <div class="head"><h5 class="iList">Edit UMEME Rates Here.</h5></div>

               <div class="rowElem nobg">
                    <label>Per Unit Rate(Ushs):</label><div class="formRight">
                        <input type="text" name="rate" class="validate[required]" value="<?php echo $curr[0]['rate']?>"/></div>
                    <?php
                    if (form_error('rate')) {
                        echo'
                                    <div class="nNote nFailure hideit">
                                        <p><strong>FAILURE: </strong>' . form_error('rate') . '</p>
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