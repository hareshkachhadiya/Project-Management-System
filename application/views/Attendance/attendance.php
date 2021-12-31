<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-clock"></i> Attendance</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li class="active">Attendance</li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="content-in"> 
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <a href="<?php echo base_url().'Attendance/addattendance' ?>" class="btn btn-success btn-sm">Mark Attendance <i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div>
            <?php 
                $controller = $this->uri->segment(1);
                $function = $this->uri->segment(2);
            ?>
        <div class="col-md-12">
            <section class="cview-detai seven-tab">
                <div class="stats-box">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php if($controller == 'Attendance' && ($function == 'index' || $function == '')) { echo 'active'; } ?>" id="overview-tab"  href="<?php echo base_url().'Attendance'?>" role="tab" aria-controls="overview" aria-selected="true">Summary</a>
                            <hr/>
                        </li>
                        <?php  if($this->user_type == 0) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($controller == 'Attendance' && $function == 'AttendanceByMember') { echo 'active'; } ?>" id="overview-tab"  href="<?php echo base_url().'Attendance/AttendanceByMember'?>" role="tab" aria-controls="overview" aria-selected="true">Attendance By Member</a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="contetn-tab">
                    <div id="" class="">
                        <div class="tab-content" id="myTabContent">
                            <!-- tab1 -->
                            <div class="tab-pane section-1 <?php if($controller == 'Attendance' && ($function == 'index' || $function == '')) { echo 'active show'; } ?>" id="overview" aria-labelledby="overview-tab" role="tabpanel">
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="white-box p-b-0 bg-inverse " >
                                            <div class="row">
                                        <?php  if($this->user_type == 0) { ?>
                                                <div class="col-md-3">
                                                    <label >Employee</label>
                                                        <div class="form-group">
                                                            <select id='employee' name="employee" class="select2 form-control">
                                                                <option value="all">All Employee</option>
                                                                <?php
                                                                    foreach($employee as $row){
                                                                        $sel = '';
                                                                        if($row->id == $selEmployee){
                                                                            $sel = 'selected=selected';
                                                                        }
                                                                        echo '<option value="'.$row->id.'" '.$sel.'>'.$row->employeename.'</option>';
                                                                    }
                                                                ?>
                                                            </select> 
                                                        </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Department</label>
                                                        <div class="form-group">
                                                            <select id='dept' name="department" class="select2 form-control">
                                                            <option value="all">All</option>
                                                            <?php foreach($department as $row){
                                                                $seldep = '';
                                                            if($row->id == $selDepartment){
                                                            $seldep = 'selected=selected';
                                                            }
                                                            echo '<option value="'.$row->id.'" '.$seldep.'>'.$row->name.'</option>';
                                                             } ?>
                                                            </select> 
                                                        </div>
                                                </div>
                                            <?php } ?>
                                                <div class="col-md-2">
                                                    <label class="control-label">Select Month</label>
                                                        <div class="form-group">
                                                            <select id='month' name="month" class="select2 form-control">
                                                                <option value="01" <?php if($selMonth == '01'){ echo 'selected'; }?>>January</option>
                                                                <option value="02" <?php if($selMonth == '02'){ echo 'selected'; }?>>February</option>
                                                                <option value="03" <?php if($selMonth == '03'){ echo 'selected'; }?>>March</option>
                                                                <option value="04" <?php if($selMonth == '04'){ echo 'selected'; }?>>April</option>
                                                                <option value="05" <?php if($selMonth == '05'){ echo 'selected'; }?>>May</option>
                                                                <option value="06" <?php if($selMonth == '06'){ echo 'selected'; }?>>June</option>
                                                                <option value="07" <?php if($selMonth == '07'){ echo 'selected'; }?>>July</option>
                                                                <option value="08" <?php if($selMonth == '08'){ echo 'selected'; }?>>August</option>
                                                                <option value="09" <?php if($selMonth == '09'){ echo 'selected'; }?>>September</option>
                                                                <option value="10" <?php if($selMonth == '10'){ echo 'selected'; }?>>October</option>
                                                                <option value="11" <?php if($selMonth == '11'){ echo 'selected'; }?>>November</option>
                                                                <option value="12" <?php if($selMonth == '12'){ echo 'selected'; }?>>December</option>
                                                            </select> 
                                                        </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Select Year(S)</label>
                                                        <div class="form-group">
                                                            <select id='year' name="year" class="select2 form-control">
                                                            <option value="2020" <?php if($selYear == '2020'){ echo 'selected'; }?>>2020</option>
                                                            <option value="2019" <?php if($selYear == '2019'){ echo 'selected'; }?>>2019</option>
                                                            <option value="2018" <?php if($selYear == '2018'){ echo 'selected'; }?>>2018</option>
                                                            <option value="2017" <?php if($selYear == '2017'){ echo 'selected'; }?>>2017</option>
                                                            <option value="2016" <?php if($selYear == '2016'){ echo 'selected'; }?>>2016</option>
                                                            <option value="2015" <?php if($selYear == '2015'){ echo 'selected'; }?>>2015</option>
                                                            </select> 
                                                        </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group m-t-25">
                                                        <button type="button" id="apply-filter"  class="btn btn-success btn-block"><i class="fa fa-check"></i>Apply</button>
                                                        <button type="reset" id="reset-filtersAttendance"  class="btn btn-inverse btn-block"><i class="fa fa-refresh"></i>Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
           
                                <div class="col-md-12" id="attendance-data">
                                    <div class="stats-box">
                                        <div class="table-responsive tableFixHead">
                                            <table class="table table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Employee</th>
                                                            <?php 
                                                                if($selMonth == '01' || $selMonth == '03'  || $selMonth == '05'|| $selMonth == '07' || $selMonth == '08' || $selMonth == '10'|| $selMonth == '12') {
                                                                    $endLoopIndex = 31;
                                                                }
                                                                elseif($selMonth == '04' || $selMonth == '06'  || $selMonth == '09' || $selMonth == '11') {
                                                                    $endLoopIndex = 30;
                                                                }
                                                                else{
                                                                    if($selYear % 4 == 0) {  
                                                                        $endLoopIndex = 29;
                                                                    }
                                                                    else{
                                                                        $endLoopIndex = 28;
                                                                    }
                                                                }
                                                            for($i=1;$i<=$endLoopIndex;$i++)  {
                                                                echo '<th>'.$i.'</th>';
                                                            } ?>                 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <?php foreach($selEmployeeArr as $row) { 
                                                                $id=$row->id; ?>
                                                        <tr>
                                                            <td>
                                                                <img src="https://demo.worksuite.biz/img/default-profile-2.png" alt="user" class="img-circle" width="30"><br/>
                                                                <?php echo $row->employeename; ?>
                                                            </td>
                                                                <?php 
                                                                    if($selMonth == '01' || $selMonth == '03'  || $selMonth == '05'|| $selMonth == '07' || $selMonth == '08' || $selMonth == '10'|| $selMonth == '12') {
                                                                            $endLoopIndex = 31;
                                                                    }
                                                                    elseif($selMonth == '04' || $selMonth == '06'  || $selMonth == '09' || $selMonth == '11') {
                                                                        $endLoopIndex = 30;
                                                                    }
                                                                    else{
                                                                        if($selYear % 4 == 0) {  
                                                                            $endLoopIndex = 29;
                                                                        }
                                                                        else{
                                                                            $endLoopIndex = 28;
                                                                        }
                                                                    }

                                                    for($i=1;$i<=$endLoopIndex;$i++)  {
                                                        $date = date('Y-m-d', strtotime($selYear.'-'.$selMonth.'-'.$i));
                                                            $dateDay = date('l', strtotime($date));
                                                            $attendanceData=$this->db->query("select attendance from tbl_attendance where attendancedate='".$date."' and employee=".$id);
                                                            $attendanceResult = $attendanceData->result_array();
                                                            $checkattendance = !empty($attendanceResult[0]['attendance']) ? $attendanceResult[0]['attendance'] : '0';
                                                        if($checkattendance == '1' || $checkattendance == '2'){   ?>
                                                            <td> 
                                                                <i class="fa fa-check text-success"></i> 
                                                            </td>
                                                    <?php } 
                                                        else if($checkattendance == '3'){   ?>
                                                            <td> 
                                                                <i class="fa fa-times text-danger"></i>
                                                            </td>
                                                    <?php } 
                                                        else if($dateDay == 'Sunday'){   ?>
                                                            <td>    
                                                                <?php echo 'sun' ?>
                                                            </td>
                                                    <?php  }
                                                    else { ?>
                                                            <td> 
                                                                <?php echo '-'; ?>
                                                            </td>
                                                    <?php }
                                                                } ?>
                                                    </tr> 
                                                <?php } ?>      
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tab2 -->
                            <?php if($this->user_type == 0) { ?>
                            <div class="tab-pane section-1 <?php if($controller == 'Attendance' && $function == 'AttendanceByMember') { echo 'active show'; } ?>" id="overview" aria-labelledby="overview-tab" role="tabpanel">
                                <form method="POST" action="<?php echo base_url().'Attendance/AttendanceByMember'?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5>Select Date Range</h5>
                                            <?php $year=date('Y');
                                                $month=date('m');
                                                $date=$year.'-'.$month.'-01';   
                                            ?>
                                            <div class="input-group input-daterange">
                                                <input type="text" class="start-date form-control br-0" id="startdate" name="startdate" data-date-format='yyyy-mm-dd' value="<?php if(!$this->session->userdata('selSdate')) { echo $date; } else { echo $this->session->userdata('selSdate'); }   ?>">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white">To</span>
                                                </div>
                                                <input type="text" class="end-date form-control br-0" id="enddate" name="enddate" data-date-format='yyyy-mm-dd' value="<?php if(!$this->session->userdata('selEdate')) { echo date('Y-m-d'); } else { echo $this->session->userdata('selEdate'); } ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>Employee Name</h5>
                                            <div class="form-group">
                                                <select id='member' name="member" class="select2 form-control">
                                                <?php $selMember= $this->session->userdata('selMember');
                                                    foreach($employee as $row){
                                                        $sel = '';
                                                        if($row->id == $selMember){
                                                            $sel = 'selected=selected';
                                                        }
                                                        echo '<option value="'.$row->id.'" '.$sel.'>'.$row->employeename.'</option>';
                                                    } 
                                                ?>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group m-t-10">
                                                <label class="control-label col-12 mb-3">&nbsp;</label>
                                                <button type="submit" id="applybyMember" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-md-3">
                                        <h3>Total Working Days</h3>
                                        <ul class="list-inline two-part">
                                            <li class="text-right"><span id="totalWorkingDays"><?php if(!empty($wday)) { echo $wday; } else{ echo 0;} ?></span></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="white-box bg-success">
                                            <h3 class="box-title text-white">Days Present</h3>
                                            <ul class="list-inline two-part">
                                                <li><i class="icon-clock text-white"></i></li>
                                                <li class="text-right"><span id="daysPresent" class="counter text-white"><?php echo $pday; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="white-box bg-danger">
                                            <h3 class="box-title text-white">Days(s) Late</h3>
                                            <ul class="list-inline two-part">
                                                <li><i class="icon-clock text-white"></i></li>
                                                <li class="text-right"><span id="daysLate" class="counter text-white"><?php echo $lday; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="white-box bg-info">
                                            <h3 class="box-title text-white">Days(s) Absent</h3>
                                            <ul class="list-inline two-part">
                                                <li><i class="icon-clock text-white"></i></li>
                                                <li class="text-right"><span id="absentDays" class="counter text-white"><?php echo $aday; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="white-box bg-primary">
                                            <h3 class="box-title text-white"> Holidays</h3>
                                            <ul class="list-inline two-part">
                                                <li><i class="icon-clock text-white"></i></li>
                                                <li class="text-right"><span id="holidayDays" class="counter text-white"><?php if(!empty($holiday)) { echo $holiday; } else{ echo 0; } ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="stats-box">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="attendanceData"><?php if(!empty($membersArr)) { foreach($membersArr as $row) {?>
                                                            <?php
                                                                $date=$row->attendancedate;
                                                                $dateDay = date('l', strtotime($date));
                                                                $day='<lable class="label label-success">'.$dateDay.'</label>';

                                                                if($row->attendance == '1'){
                                                                    $attenstatus = $row->attndance = 'Present';
                                                                    $attendance='<lable class="label label-success">'.$attenstatus.'</label>';

                                                                }
                                                                else if($row->attendance == '2'){
                                                                    $attenstatus = $row->attndance = 'Late';
                                                                    $attendance='<lable class="label label-success">'.$attenstatus.'</label>';
                                                                }
                                                                else if($row->attendance == '3'){
                                                                    $attenstatus = $row->attendance = 'Absent';
                                                                    $attendance='<lable class="label label-danger">'.$attenstatus.'</label>';
                                                                }
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row->attendancedate."<br/>".$day ?></td>
                                                                <td><?php echo $attendance;?></td>
                                                            </tr>
                                                            <?php } }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                        <?php } ?>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

    
            


    
