<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Dashboard</li>
                <li><!-- <a href="javascript:;">Start Timer <i class="fa fa-check-circle text-success"></i> --></a>

                 <a href="javascript:;" id="holiday" data-toggle="modal" data-target="#data-tasktimer" onclick="modal_open();"><b>Start Timer</b><i class="fa fa-plus" aria-hidden="true"></i></a></li> 
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="row">

 <div><input type="button" name="btn" id='btn1' value="stop" onclick="to_start()"; class="btn btn-success" style="display:none;"></div>
</div>
<p id="tasktimer"></p>

<div class="content-in">  
    <div class="row db-stats">
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-layers"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Total Projects</span><br>
                            <span class="counter"><?php if(!empty($totalProject)) { echo $totalProject; } else echo 0; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-info-gradient"><i class="icon-clock"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Hours Logged</span><br>
                            <span style="font-size: 20px;"><?php if(!empty($totalHours)) { echo $totalHours; } else echo 0; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-warning-gradient"><i class="ti-alert"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">

                            <span class="widget-title"> Pending Tasks</span><br>
                            <span class="counter"><?php if(!empty($totalTaskPending)) { echo $totalTaskPending; } else echo 0; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="ti-check-box"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Completed Tasks</span><br>
                            <span class="counter"><?php if(!empty($totalTaskComplete)) { echo $totalTaskComplete; } else echo 0; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="stats-box">
                <h3 class="box-title mb-0">Recent Earnings</h3>
                <?php
                    $str='';
                    $str1='';
                    foreach($finalTempArr as $key=>$value){
                        $str.= '"'.$key.'"'.',';
                        $str1.= $value['totalEarning'].',';
                    }
                ?>
                <div id="container" style="height: 400px"></div>
                <script type="text/javascript">
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'EARNINGS'
                        },
                      
                        xAxis: {
                            categories: [<?php echo rtrim($str,',');?>],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: ''
                            }
                        },
                           series: [{
                            name: 'Total Earning',
                            data: [<?php  echo rtrim($str1,',');?>]

                        }]
                    });
                </script>                        
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card c-wrapp">
                <div class="card-header">New Tickets</div>
                <div class="card-wrapper collapse show">
                    <div class="card-body">
                        <ul class="list-task list-group border-none" data-role="tasklist">
                            <?php  foreach($ticketNew as $row){ ?>
                                <li class="list-group-item" data-role="task">
                                    <a class="text-danger" href="<?php echo base_url().'ticket/'?>"> <b><?php echo $row->ticketsubject;?></b></a>&nbsp;&nbsp;&nbsp;<i><?php echo $row->created_at; ?></i>
                                </li>
                            <?php 
                            }
                        ?>  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
          <div class="col-md-6">
            <div class="card c-wrapp">
                <div class="card-header">New Task</div>
                <div class="card-wrapper collapse show">
                    <div class="card-body">
                        <ul class="list-task list-group border-none" data-role="tasklist">
                            <?php  foreach($taskData as $row){ ?>
                                <li class="list-group-item" data-role="task">
                                    <a class="text-danger" href="<?php echo base_url().'ticket/'?>"> <b><?php echo $row->title;?></b></a>&nbsp;&nbsp;&nbsp;<i><?php echo $row->created_at; ?></i>
                                </li>
                            <?php 
                            }
                        ?>  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ends of contentwrap -->

    
<div  class="modal fade defaultholiday" id="data-tasktimer" tabindex="-1" role="dialog" aria-labelledby="holiday" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content br-0">
                        <div class="modal-header">
                            <h2 class="modal-title"><i class=" ti-plus"></i>Start Timer</h2>
                            <button type="button" class="closedata" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       <?php  if(empty($taskEmpData)) { ?>
                         <div class="modal-body">
                            <h3>No Task Assigned</h3>
                         </div>
                       <?php } else { ?>
                        <div class="modal-body">
                            <form id="modeldefaultholiday" class="" name="modeldefaultholiday" method="post">
                                <div class="form-body">
                                <div id="dynamic">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <h4>select Project</h4>
                                               <select class="select2 form-control" id="clientname">
                                        <option value="">Select</option>
                                        <?php
                                            foreach($projectDetailData as $row)
                                            {
                                                if(!empty($row->projectname)){
                                                    echo '<option value="'.$row->id.'" >'.$row->projectname.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>   
                                            </div>
                                        </div>
                                        <div class="col-md-12">  
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <input type="text" name="memo" id="memo">
                                                <input type ='hidden' id="userid" value="<?php echo $this->user_id; ?>">

                                            </div>
                                        </div>
                                        <div><input type="button" name="btn" id='btn' value="Start" onclick="to_start(<?php echo $row->id?>)"; class="btn btn-success"></div>
                                    </div>

                                </div>
                               
                                </div>
                                
                                <!-- a -->
                            </form>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>