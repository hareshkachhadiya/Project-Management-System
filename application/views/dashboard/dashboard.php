<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'; ?>">Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>
</nav>
<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row db-stats">
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'clients'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-user"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Total Clients</span><br>
                            <span class="counter"><?php echo $totalClient; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'employee'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-people"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Total Employees</span><br>
                            <span class="counter"><?php echo $totalEmployee; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'project'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-layers"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title">  Total Projects</span><br>
                            <span class="counter"><?php echo $totalproject; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'finance/invoice'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="icon-user"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Unpaid Invoices</span><br>
                            <?php
                            $where = array('status' => 0);
                            $unpaidinvoice = $this->common_model->getData('tbl_invoice',$where);
                            ?>
                            <span class="counter"><?php echo count($unpaidinvoice); ?></span>
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
                            <span style="font-size: 20px;">49490 hrs </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'task'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-warning-gradient"><i class="ti-alert"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title">Pending Tasks</span><br>
                            <span class="counter"><?php echo $totalTaskPending; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'task'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-success-gradient"><i class="ti-check-box"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Completed Tasks</span><br>
                            <span class="counter"><?php echo $totalTaskComplete; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="<?php echo base_url().'Attendance'?>">
                <div class="stats-box">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                <span class="bg-danger-gradient"><i class="fa fa-percent" style="display: inherit;"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Today Attendance</span><br>
                            <span class="counter">18.75</span>% 
                            <span class="text-muted">(6/32)</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="row">
    			<div class="col-md-6 col-sm-12 db-stats"> 
                	<a href="<?php echo base_url().'ticket' ?>">
                        <div class="stats-box">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div>
                                        <span class="bg-success-gradient"><i class="ti-ticket"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <span class="widget-title"> Resolved Tickets</span><br>
                                    <span class="counter"><?php echo $totalticketResolved; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 db-stats"> 
                	<a href="<?php echo base_url().'ticket'?>">
                        <div class="stats-box">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div>
                                        <span class="bg-success-gradient"><i class="ti-ticket"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <span class="widget-title"> Unresolved Tickets</span><br>
                                    <span class="counter"><?php echo $totalticketPending; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!--  -->
                <div class="col-md-12">
                	<div class="bg-theme-blue m-b-15">
                		<div id="carouselExampleIndicators" class="carousel slide p-3" data-ride="carousel">
							<h4 class="text-white p-t-0 p-b-0">Client Feedback</h4>
						  	<div class="carousel-inner">
							    <div class="carousel-item active">
							      	<h5 class="text-white">For anything tougher than suet; Yet you finished the first day,' said ...</h5>
							  		<div class="tws-user">
							  			<img class="" src="images/default-profile-2.png" alt="user">
							  			<h5 class="text-white mb-0">Willow Borer</h5>
							  			<p class="text-white">Airline Reservation System</p>
							  		</div>
							    </div>
							    <div class="carousel-item">
							      	<h5 class="text-white">Hatter said, turning to the Mock Turtle. 'And how do you know about th...</h5>
							  		<div class="tws-user">
							  			<img class="" src="images/default-profile-2.png" alt="user">
							  			<h5 class="text-white mb-0">Adella Auer</h5>
							  			<p class="text-white">User Management</p>
							  		</div>
							    </div>
							    <div class="carousel-item">
							      	<h5 class="text-white">For anything tougher than suet; Yet you finished the first day,' said ...</h5>
							  		<div class="tws-user">
							  			<img class="" src="images/default-profile-2.png" alt="user">
							  			<h5 class="text-white mb-0">Willow Borer</h5>
							  			<p class="text-white">Airline Reservation System</p>
							  		</div>
							    </div>
						  	</div>
						</div>
                	</div>
                </div>
                <!--  -->
    		</div>
    	</div>
    </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="stats-box">
    					<h3 class="box-title mb-0">Recent Earnings (Last 30 Days)</h3>
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
            <html>
                <head>
                    <style>
                    .fc-title{
                        color: white;
                    }

                         /* The Modal (background) */
                  .modal {
                    display: none; /* Hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 1; /* Sit on top */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    background-color: rgb(0,0,0); /* Fallback color */
                    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                  }

                  /* Modal Content/Box */
                  .modal-content {
                    background-color: #fefefe;
                    margin: 15% auto; /* 15% from the top and centered */
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%; /* Could be more or less, depending on screen size */
                  }

                  /* The Close Button */
                  .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                  }

                  .close:hover,
                  .close:focus {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                  } 
                    </style>
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css">
                  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css">
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css">
                  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                  <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
                  
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
                  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                  <script src="http://xoxco.com/examples/jquery.tagsinput.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
                  <script type="text/javascript">
                    $(document).ready(function() {
                      CKEDITOR.replace( 'editor1' );

                      $('.toggle-filter').click(function () {
                          $('#ticket-filters').toggle('slide');
                      })
                    });
                    
                    function modalclose(){
                      $("#data-events").css("display",'none');
                      $('#addevent')[0].reset();
                    } 
                    function modalopen(){ 
                      $('#data-events').addClass('show');
                      $('#data-events').show();
                      $('body').addClass('modal-open');
                     }
                    </script>
                    <script>
                    var setDate = '';
                    var startDate='';
                    var currentDate = '';
                    $(document).ready(function(){
                        var calendar = $('#calendar').fullCalendar({
                            editable:true,
                            header:{
                                left:'prev,next today',
                                center:'title',
                                right:'month,agendaWeek,agendaDay'
                            },
                            events:"Events/load",
                            selectable:true,
                            selectHelper:true,
                            <?php if($this->user_type == 0) { ?>
                            select:function(start, end, allDay)
                            {
                              var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                              startDate =$.fullCalendar.moment(event.start).format('YYYY/MM/DD');
                              currentDate =$.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                              var dateArr = start.split("-");
                              var setDate = dateArr[1]+'/'+dateArr[2]+'/'+dateArr[0];

                              if(start>=currentDate){
                                   /* $('#start_date').datepicker("setDate", new Date(setDate));
                                    $('#data-events').addClass('show');
                                    $('#data-events').show();
                                    $('body').addClass('modal-open');*/  
                              }
                            },
                          <?php } ?>
                            
                        });
                    $('#save-form').click(function(){
                      var title =  $('#title').val();
                      var place =  $('#place').val();
                      var description =  CKEDITOR.instances['editor1'].getData();
                      var startdate = $('#start_date').val();
                      var enddate =  $('#end_date').val();
                      $.ajax({
                        url:"Events/insert",
                        type:"POST",
                        data:{title:title, place:place,description:description,startdate:startdate,enddate:enddate},
                        success: function(){
                          $('#addevent')[0].reset();
                          $('#start_date').datepicker();
                          calendar.fullCalendar('refetchEvents');
                          $("#data-events").css("display",'none');
                        }
                      });
                    });
                    
                    });
                    </script>
                </head>

                <body >
                    <div class="content-in">
                          
                        
                    </div>
                    <div class="container">
                        <div id="calendar"></div>
                    </div>

                </body>
            </html>
        </div>
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

<div class="modal fade " id="data-events" tabindex="-1" role="dialog" aria-labelledby="designation" aria-hidden="true" style="display:none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content br-0">
                        <div class="modal-header">
                            <h4 class="modal-title">ADD EVENT</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modalclose();">
                                <span aria-hidden="true" id="close">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addevent" class="aj-form" name="addtimelog" method="post">
                            <?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
                            <div class="submit-alerts">
                                <div class="alert alert-success" role="alert" style="display:block;">
                                </div>
                            </div>
                            <div class="submit-alerts">
                                <div class="alert alert-danger" role="alert" style="display:block;">
                                 <?php echo $mess; ?>
                                </div>
                            </div>
                            <?php  } ?>
                            <div class="submit-alerts">
                                <div class="alert alert-warning" role="alert">
                                  This is a warning alert
                                </div>
                            </div>
                            
                            <div class="form-body">
                               
                                    <p id="succmsg" class="text-success"></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Event Title<span class="astric">*</span></label>
                                                        <input type="text" id="title" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label class="control-label">Place<span class="astric">*</span></label>
                                                         <input type="text" class="form-control" name="place" id="place"> 
                                                        </select>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Event Description<span class="astric">*</span></label>
                                                    <textarea name="editor1" id="editor1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="block">
                                                  <label for="date" class="control-label"> Start Date<span class="astric">*</span></label>
                                                  <input type="date" name="timelog_d1" id="start_date" data-date-format='yyyy-mm-dd' class="form-control " value=""/>
                                                  <!-- <label for="time" class="control-label">Start Time<span class="astric">*</span></label>
                                                  <input type="time" name="timelog_t1" id="timelog_t1" value=""  class="form-control"/> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="block">
                                                    <label for="date" class="control-label">End Date<span class="astric">*</span></label>
                                                    <input type="date" name="timelog_d2" id="end_date" value="" data-date-format='yyyy-mm-dd' class="form-control" />
                                                   <!--  <label for="time" class="control-label">End Time<span class="astric">*</span></label>
                                                    <input type="time" name="timelog_t2" id="timelog_t2" value="" class="form-control"/> -->
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="button" name="btnsavetime" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            </div>
                                        </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <p>2020 &copy; PMS</p>
            </footer>
            <!-- ends of footer -->
        </div>
    </div>
          <script type="text/javascript">
  

       function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);
            var time = minutes + ":" + seconds;
            if (--timer < 0) {
                timer = duration;
            }
            if (time == '00:00') {
                window.location.href = '<?php echo base_url().'login/logout'; ?>';
            }
        }, 1000);
    }

    jQuery(function ($) {
        var fiveMinutes = 60 * 60,
            display = $('#timer');
        startTimer(fiveMinutes, display);
    });
    </script>
</script>
        </div>

    </div>
</div>
<!-- ends of contentwrap -->
