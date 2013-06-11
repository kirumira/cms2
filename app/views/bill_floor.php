<div class="content" id="container"> 
    <div class="title"><h5>Billing Per Floor:</h5></div>
    <div class="table">
        <div class="head"><h5 class="iFrames">Floors:</h5></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>FLOOR</th>
                    <th>RENT</th>
                    <th>UMEME</th>
                    <th>WATER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $f = $floors[0]['b_num_floors'];
                for ($i = 1; $i <= $f; $i++) {
                    echo '<tr class="gradeA">';
                    if (($i == 1) || ($i == 21) || ($i == 31) || ($i == 41)) {
                        echo "<td><a href='" . base_url() . "floors/floor/" . $i . "'>" . $i . "st Floor</a></td>";
                    } elseif (($i == 2) || ($i == 22) || ($i == 32) || ($i == 42)) {
                        echo "<td><a href='" . base_url() . "floors/floor/" . $i . "'>" . $i . "nd Floor</a></td>";
                    } elseif (($i == 3) || ($i == 23) || ($i == 33) || ($i == 43)) {
                        echo "<td><a href='" . base_url() . "floors/floor/" . $i . "'>" . $i . "rd Floor</a></td>";
                    } else {
                        echo "<td><a href='" . base_url() . "floors/floor/" . $i . "'>" . $i . "th Floor</a></td>";
                    }
                    echo ' <td><a href="' . base_url() . 'bills/bill_floor/' . $i . '">BILL FOR RENT</a></td>
                           
                            <td><a href="' . base_url() . 'umeme/umeme_floors/' . $i . '">BILL FOR UMEME</a></td>
                            <td><a href="' . base_url() . 'floors/floor/' . $i . '">BILL FOR WATER</a></td>
                  </tr>';
                }
                ?>

            </tbody>
        </table></div></div>