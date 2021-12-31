<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Holiday List Of <?php echo date('Y'); ?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'Dashboard'?>
                            ">Home</a></li>
                            <li class="active">Holiday List Of <?php echo date('Y'); ?></li>
                        </ol>
                    </div>
                </div>
            </nav>
    
        <div class="content-in">
            <div class="col-sm-12">
                <?php if($this->user_type == 0) { ?>
                    <div class="form-group pull-left">
                        <a href="javascript:;" id="holiday" data-toggle="modal" data-target="#data-holiday" class="btn btn-primary">Add Holiday <i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                    <div class="pull-right" style="margin-right: 10px">
                        <a class="btn btn-outline btn-sm btn-primary markHoliday" href="javascript:;" id="default-holiday" data-toggle="modal" data-target="#data-defaultholiday">
                             Mark Default Holidays<i class="fa fa-check"></i> </a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-12">
                <select id="selectyear" class="pull-right">
                <option value="2019" <?php if($selYear == '2019'){ echo 'selected'; }?>>2019</option> 
                <option value="2020" <?php if($selYear == '2020'){ echo 'selected'; }?>>2020</option>
                <option value="2021" <?php if($selYear == '2021'){ echo 'selected'; }?>>2021</option>
                <option value="2022" <?php if($selYear == '2022'){ echo 'selected'; }?>>2022</option>  
                <option value="2023" <?php if($selYear == '2023'){ echo 'selected'; }?>>2023</option> 
                </select>       
            </div>
        
   <br/>                 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#January">January</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#February">February</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#March">March</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#April">April</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#May">May</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#June">June</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#July">July</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#Augest">August</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#September">September</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#October">October</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#November">November</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#December">December</a></li>
  </ul>
  <div class="tab-content">
    <?php
        $this->login = $this->session->userdata('login');
        $this->user_id = 1;
        $wherArr = array('user_id' => $this->user_id);
        $data['holiday'] = $this->common_model->getData('tbl_holiday_settings',$wherArr);
        $SatArr = array();
        $SunArr = array();
        foreach($data['holiday'] as $row){
            $date_sat_data = $row->extract_sat_day;
            $sat_array = explode(",",$date_sat_data);
            $SatArr = $sat_array;
            $date_sun_data = $row->extract_sun_day;
            $sun_array = explode(",",$date_sun_data);
            $SunArr = $sun_array;

        }

        $SaturdayChk = $row->saturday;
        $SundayChk = $row->sunday;
       
    ?>
    <div id="January" class="tab-pane fade in active show">
      <h3>January</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?> 
                    <th> Action </th>
               <?php } ?>
            </tr>
            </thead>
            <tbody id="janTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-01-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($janArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php
                                    if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                        echo $janArr[$date].','.$dateDay;
                                    }
                                    elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                        echo $janArr[$date].','.$dateDay;
                                    }
                                    else{
                                        echo $janArr[$date];
                                    } 
                                ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td>
                                    <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }

                        else if($dateDay == 'Saturday' && $SaturdayChk == 1  && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        
                            
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="February" class="tab-pane fade">
      <h3> February </h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?> 
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="febTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-02-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($febArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                    if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                        echo $febArr[$date].','.$dateDay;
                                    }
                                    elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                        echo $febArr[$date].','.$dateDay;
                                    }
                                    else{
                                        echo $febArr[$date];
                                    } 
                                ?>
                                 </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="March" class="tab-pane fade">
      <h3>March</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?> 
                <th> Action </th>
               <?php } ?> 
            </tr>
            </thead>
            <tbody id="marTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-03-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($marArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $marArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $marArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $marArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="April" class="tab-pane fade">
      <h3>April</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?> 
                <th> Action </th>
            <?php } ?> 
            </tr>
            </thead>
            <tbody id="aprilTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-04-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($aprilArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo  $aprilArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $aprilArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $aprilArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?> 
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button> </td>
                            <?php } ?> 
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="May" class="tab-pane fade">
      <h3>May</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="mayTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-05-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($mayArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $mayArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $mayArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $mayArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td> 
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="June" class="tab-pane fade">
      <h3>June</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?> 
            </tr>
            </thead>
            <tbody id="juneTbody"> 
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-06-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($juneArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $juneArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $juneArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $juneArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="July" class="tab-pane fade">
      <h3>July</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="julyTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-07-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($julyArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo  $julyArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $julyArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $julyArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="Augest" class="tab-pane fade">
      <h3>August</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="augTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-08-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($augestArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $augArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $augArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $augestArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="September" class="tab-pane fade">
      <h3>September</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="sepTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-09-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($sepArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $sepArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $sepArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $sepArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?Php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button> </td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="October" class="tab-pane fade">
      <h3>October</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="octTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-10-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($octArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $octArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $octArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $octArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="November" class="tab-pane fade">
      <h3>November</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                <?php if($this->user_type == 0) { ?>
                <th> Action </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody id="novTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-11-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($novArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $novArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $novArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $novArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td> <button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="December" class="tab-pane fade">
      <h3>December</h3>
      <table class="table table-hover">
            <thead>
            <tr>
                <th> # </th>
                <th> Date </th>
                <th> Occasion </th>
                <th> Day </th>
                 <?php if($this->user_type == 0) { ?>
                <th> Action </th>
            <?php } ?>
            </tr>
            </thead>
            <tbody id="decTbody">
                <?php
                    $j = 1;
                    for($i=1;$i<=31;$i++){
                        $date = date('Y-m-d', strtotime($selYear.'-12-'.$i));
                        $dateDay = date('l', strtotime($date));
                        if(!empty($decArr[$date])){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                <?php
                                if($dateDay == 'Saturday'  && $SaturdayChk == 1){
                                    echo $decArr[$date].','.$dateDay;
                                }
                                elseif($dateDay == 'Sunday' && $SundayChk == 1){
                                    echo $decArr[$date].','.$dateDay;
                                }
                                else{
                                    echo $decArr[$date];
                                } 
                                ?>
                                </td>
                                <td><?php echo $dateDay; ?></td>
                                 <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++; 
                        }
                        else if($dateDay == 'Saturday' && $SaturdayChk == 1 && !in_array($date, $SatArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Saturday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                 <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        else if($dateDay == 'Sunday' && $SundayChk == 1 && !in_array($date, $SunArr)){
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo 'Sunday'; ?></td>
                                <td><?php echo $dateDay; ?></td>
                                 <?php if($this->user_type == 0) { ?>
                                <td><button type="button" onclick="deleteHoliday('<?php echo $date; ?>','1')" href="javascript:void(0);" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php } ?>
                            </tr>
                            <?php
                            $j++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

<!-- model for add holiday -->
<div class="modal fade holiday" id="data-holiday" tabindex="-1" role="dialog" aria-labelledby="holiday" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content br-0">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i>Holiday</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modelholiday" class="" name="modelholiday" method="post">
                                <div class="form-body">
                               
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <input type="text" name="holiday_name[]" id="start_date"  placeholder="Date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">  
                                                <div class="form-group">
                                                    <input type="text" name="occasion[]" id="occasion"  placeholder="Occasion" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                <div id="dynamic">
                                </div>
                                <input type="hidden" id="counter" value="1">
                                        <button type="button" id="repeate-data" class="btn btn-sm btn-info" style="margin-bottom: 20px">
                                            Add <i class="fa fa-plus"></i></button>
                                        </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="button" class="btn btn-white waves-effect close" data-dismiss="modal">Close</button>
                                    <input type="button" id="save-holiday" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


<!-- add model for default holiday -->
<div class="modal fade defaultholiday" id="data-defaultholiday" tabindex="-1" role="dialog" aria-labelledby="holiday" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content br-0">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-pencil"></i>Mark Holiday</h4>
                            <button type="button" class="closedata" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modeldefaultholiday" class="" name="modeldefaultholiday" method="post">
                                <div class="form-body">
                                <div id="dynamic">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <input type="checkbox" name="saturday" id="saturday" class="form-control" <?php if($default_holiday[0]->saturday == 1) { echo 'checked'; } ?>>
                                                    <label>Saturday</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">  
                                                <div class="form-group">
                                                    <input type="checkbox" name="sunday" id="sunday" class="form-control" <?php if($default_holiday[0]->sunday == 1) { echo 'checked'; } ?>>
                                                    <label>Sunday</label>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                               
                                </div>
                                
                                <div class="form-actions">
                                    <button type="button" class="btn btn-white waves-effect closedata" data-dismiss="modal"  name="closedata" >Close</button>
                                    <input type="button" id="save-defaultholiday" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



