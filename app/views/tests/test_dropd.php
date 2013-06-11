<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>css/jquery.validity.css" />
        <script src="<?php echo base_url(); ?>js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/forms/jquery.validity.min.js"></script>
        
        <title>Simple</title>
    </head>
    <body>
        <div id="buildingreg" title="Add New Building" >
    <form id="buildingregformx">
    <table style="width:720px;">
        <tr>
            <th>Building Name: </th>
            <td ><input type="text" name="regular" id="regbname" value=""/></td>
            <th>P.O.BOX: </th>
            <td ><input type="text" name="regular" id="regaddress" value=""/></td>
        </tr>            
        <tr>
            <th>Town: </th>
            <td ><input type="text" name="regular" id="regtown" value=""/></td>
            <th>District: </th>
            <td ><input type="text" name="regular" id="regdistrict" value=""/></td>
        </tr>            
        <tr>
            <th>Number of floors: </th>
            <td ><input type="text" name="regular" id="regfloors" value=""/></td>
            <th>Manager:</th>
            <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regmanager" tabindex="2">
                    <option value="Select Option">Select Option</option>
                    <?php if (isset($managers)) { ?>
                        <?php foreach ($managers as $v): ?>
                            <?php echo '<option value="' . $v['id'] . '">' . $v['name'] . '</option>'; ?>
                        <?php endforeach;
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Landlord:</th>
            <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="reglandlord" tabindex="2">
                    <option value="Select Option">Select Option</option>
                    <?php if (isset($landlords)) { ?>
                        <?php foreach ($landlords as $v): ?>
                            <?php echo '<option value="' . $v['id'] . '">' . $v['name'] . '</option>'; ?>
                        <?php endforeach;
                    }
                    ?>
                </select>
            </td>
            <th>Type:</th>
            <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regtype" tabindex="2">
                    <option>Select Option</option>
                    <option>COMMERCIAL</option>
                    <option>RESIDENTIAL</option>
                    <option>WAREHOUSE</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Currency:</th>
            <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regcurrency" tabindex="2">
                    <option>UGX</option>
                    <option>USD</option>
                </select>
            </td>
            <th>Plot Number: </th>
            <td ><input type="text" name="regular" id="regplotno" value=""/></td>
        </tr>
        <tr>
            <th>Property Number: </th>
            <td ><input type="text" name="regular" id="regpropno" value=""/></td>
            <th>Block Number: </th>
            <td ><input type="text" name="regular" id="regblockno" value=""/></td>
        </tr>
        <tr>
            <th>Street Name: </th>
            <td ><input type="text" name="regular" id="regstreetname" value=""/></td>
            
        </tr>
    </table> 
        <br/><br/>
        <button id="bb">Test it!</button>
    </form>
    
<!--    <div style="margin-left: 62px;"><img id="adminregloader" style=" display:none;" class="p12" alt="" src="images/loaders/loader7.gif" /></div>-->
</div>
<!--        <form method="get" action="simple.htm">-->
<!--        <form id="tt">
            Number of Vehicles:
            <input type="text" id="vehicles" name="vehicles" title="Vehicle Count" />
            <br /><br />
            Date of birth:
            <input type="text" id="dob" name="dob" title="Birthday" />
            <br /><br />
            <input type="submit" />
            <button id="bb">Test it!</button>
        </form>-->
    </body>
    <footer>
        <script>
            $('#bb').on('click',function(){
                $("#buildingregformx").validity(function() {
                    console.log('validating!');
                    $("#regbname")                      // The first input:    
                        .require();                         // Required:
//                        .match("number")                    // In the format of a number:
//                        .range(4, 12);                      // Between 4 and 12 (inclusively):

//                    $("#dob")                           // The second input:
//                        .require()                          // Required:
//                        .match("date")                      // In the format of a date:
//                        .lessThanOrEqualTo(new Date());     // In the past (less than or equal to today):
                });
            });
                


            
        </script>
    </footer>    
</html>
