<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-speedometer"></i> Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Dashboard</li>
                    

            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->

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
                            <span class="widget-title">  Total Projects</span><br>
                            <span class="counter"><?php $cid = $this->login->id;
                            $whereArr = array('user_id'=>$cid);
                            $clientData = $this->common_model->getData('tbl_clients',$whereArr);
                            $query = "select * from tbl_project_info where clientid=".$clientData[0]->id;
                             $clientsData = $this->common_model->coreQuery($query);
                             $totalPro =  count($clientsData);
                              echo $totalPro; ?></span>
                          
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
                                <span class="bg-warning-gradient"><i class="ti-ticket"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title">  Unsolved Ticket</span><br>
                            <span class="counter"><?php
                           /* $whereArrT = array('status' => 1);
                            $ticketData = $this->common_model->getData('tbl_ticket',$whereArrT);*/
                            $query = "select * from tbl_ticket where status = 1 OR status = 2";
                            $ticketData = $this->common_model->coreQuery($query);


                           //echo $this->db->last_query();die;
                             $totalTicketUn =  count($ticketData);
                              echo $totalTicketUn; ?></span>
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
                                <span class="bg-info-gradient"><i class="ti-ticket"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right">
                            <span class="widget-title"> Paid Amount</span><br>
                            <span style="font-size: 20px;">49490 hrs </span>
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
                            <span class="widget-title"> Outstanding Amount</span><br>
                            <span class="counter">15</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card c-wrapp">
                <div class="card-header">PROJECT ACTIVITY TIMELINE</div>
                <div class="card-wrapper collapse show">
                    <div class="card-body">
                        <ul class="list-task list-group border-none" data-role="tasklist">
                            <li class="list-group-item" data-role="task">
                                1. <a class="text-danger" href="#"> Gryphon. '--you advance twice--' 'Each with a deep voice, 'are done.</a> <i>2 Months Ago</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                2. <a class="text-danger" href="#"> However, when they hit her; and the executioner went off like an.</a> <i>4 Days From Now</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                3. <a class="text-danger" href="#"> WHAT?' said the Gryphon, half to itself, 'Oh dear! Oh dear! I'd.</a> <i>6 Months Ago</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                4. <a class="text-danger" href="#"> Alice was not quite know what a dear quiet thing,' Alice went on.</a> <i>11 Months Ago</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                5. <a class="text-danger" href="#"> Mouse, frowning, but very politely: 'Did you say things are worse.</a> <i>1 Day From Now</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                6. <a class="text-danger" href="#"> And the muscular strength, which it gave to my right size: the next.</a> <i>2 Days From Now</i>
                            </li>
                            <li class="list-group-item" data-role="task">
                                7. <a class="text-danger" href="#"> At last the Mouse, who was peeping anxiously into its eyes were.</a> <i>4 Days From Now</i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- ends of contentwrap -->