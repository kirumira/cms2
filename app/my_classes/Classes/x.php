<!-- Content -->

    <div class="content" id="container">
        <div class="title"><h5>Monthly Cash Flow: </h5></div>
        <div class="fix"></div>
        <?php
            for($i=1; $i<=$num_semis; $i++){
                echo "<a href='".base_url()."/budgets/view_cash_flow/".$project_id."/".$i."'><input type='button' value='Semi ".$i."' class='greenBtn right'/></a>";

            }
        ?>


      <div class="table">
            <div class="head"><h5 class="iFrames">Budget Monthly Cash Flow:</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <?php
                            for($index=$semi_start; $index<=$semi_end; $index++){
                                echo "<th>Month ".($index-$start_month+1)."</th>";
                            }
                        ?>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <td>Budget</td>
                    <?php
                        $semi_cost = 0;
                        for($i=$semi_start;$i<=$semi_end;$i++){
                        if(isset($months[$i])){
                            echo "<td>".$months[$i]."</td>";
                        }else{
                            echo "<td>-</td>";
                        }

                        $semi_cost += $months[$i];
                    }
                    echo "<td>".$semi_cost."</td>";
                    ?>
                    </tr>
                    <tr class="gradeA">
                        <td colspan="8" class="center">Requisitions</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table">
            <div class="head"><h5 class="iFrames">Requisition Monthly Cash Flow:</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <?php
                            for($index=$semi_start; $index<=$semi_end; $index++){
                                echo "<th>Month ".($index-$start_month+1)."</th>";
                            }
                        ?>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $i=$semi_start;

                        //$variable['total'] = 0;
                        //$variable[$i] = 0;
                        foreach($items as $item){
                            echo "<tr class='gradeA'>";
                            echo "<td>".$item['name']."</td>";
                            $semi_req = 0;
                            for($i=$semi_start;$i<=$semi_end;$i++){
                                if(isset($item[$i])){
                                    echo "<td>".$item[$i]."</td>";
                                }else{
                                    echo "<td>-</td>";
                                }
                                //$variable[$i] += $item[$i];
                                if(isset($item[$i])){$semi_req = $semi_req+$item[$i];}else{}
                            }
                            echo "<td>".$semi_req."</td>";
                            echo "</tr>";
                        }
//                            echo "<tr><td>Total Expenditure</td>";
//                            for($i=$semi_start;$i<=$semi_end;$i++){
//                                if(isset($variable[$i])){
//                                    echo "<td>".$variable[$i]."</td>";
//                                    $variable['total']+= $variable[$i];
//                                }else{}
//                            }
//                            echo "<td>".$variable['total']."</td></tr>";
                        ?>
                </tbody>
            </table>
        </div>
    </div>
