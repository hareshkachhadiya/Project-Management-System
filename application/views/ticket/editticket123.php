<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ti-ticket"></i> Tickets</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="clients.html">Tickets</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
    </div>
</nav>
<!-- contetn-wrap -->
<div class="content-in">
  <form id="editticket" name="editticket" class="aj-form" method="post" action="<?php echo base_url().'ticket/editticket/'.base64_encode($editticketId); ?>">  
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
            <div class="row">
                <div class="col-md-8">
                  <div class="card br-0">
                    <div class="card-header br-0 text-right text-black">
                      Ticket # 31
                    </div>
                    <div class="card-wrapper collapse show">
                      <div class="card-body">
                        <div class="submit-alerts">
                          <div class="alert alert-success" role="alert">
                    This is a success alert
                  </div>
                  <div class="alert alert-danger" role="alert">
                    This is a danger alert
                  </div>
                  <div class="alert alert-warning" role="alert">
                    This is a warning alert
                  </div>
                        </div>
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group" id="comment_for_ticket">
                                <label class="control-label">
                              <?php
                                 echo 'Ticket Subject='.$ticketinfo[0]->ticketsubject;
                                 echo '<br/><br/>';
                                 echo $ticketinfo[0]->created_at;
                                
                               ?>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive">
                        <table class="table">
                          <thead id="thead">
                          <tr>
                            <th>#</th>
                            <th>ProfileImage</th>
                            <th>Requester</th>
                            <th>Created at</th>
                            <th></th>
                          </tr>
                          </thead>
                           <tbody id="replaytable">
                              <?php   
                               $i=1;
                                foreach($ticketcommenttest as $tcomm) { 

                                  ?>      
                                    <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo base_url().'upload/'.$tcomm->profileimg; ?>" height="50px" width="50px"></td>
                                    
                                    <td><?php echo $tcomm->comment; ?></td>
                                    <td><?php echo $tcomm->created_at; ?></td>
                                    <td>
                                      <input type='button' class='btn btn-sm btn-danger btn-rounded delete-category' onclick ="delete_t_comment('<?php echo $tcomm->id; ?>');" id='deletereply' value='Remove'>
                                    </td>
                                    </tr>
                               <?php $i++; } ?>
                          </tbody>
                        </table>
                      </div>
                            </div>
                          </div>
                          
                  <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Ticket Description <span class="text-danger">*</span></label>
                                               <textarea name="editor" id="editor" ></textarea> 
                                                
                                              
                                            </div>
                                        </div>
                              </div>
                              <div class="row">
                          <div class="col-md-6">
                            <p id="succmsg" class="text-success"></p>
                              <div class="form-group">
                                <label class="control-label">Requester Name</label>
                                  <select class="custom-select br-0" name="requestername" id="requestername">
                                  <option value="">--SELECT--</option>
                                  <?php
                            foreach($getemployee as $emp){
                            ?>
                              
                              <option value="<?php echo $emp->id?>"><?php echo $emp->employeename;?></option>
                              <?php
                              } 
                            ?>  
                            </select>
                          </div>
                        </div>
                        </div>
                              <div class="row">
                              <div class="col-md-6">
                            <div class="form-group type">
                              <label>Status <span class="text-danger">*</span></label>
                              <select class="custom-select br-0" name="status" id="status">
                              <option value="">--Select--</option>
                          <option  value="1">Open</option>
                          <option value="2">Pending</option>
                          <option value="3">Resolved</option>
                          <option value="4">Close</option>

                              </select>
                            </div>
                          </div>
                        </div>
                            </div>
                        </div>
                      </div>
                      <div class="card-footer text-right">
                        <!-- action btn -->
                                <div class="form-actions">
                                  <div class="btn-group">
                      <!-- <button type="submit" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="submitticket">
                        Submit
                      </button> -->
                      <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false" name="submitticket" id="submitticket">
                        Submit
                      </button> 
                    <!--  <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Submit Open <span style="width: 15px; height: 15px;" class="btn btn-danger btn-small btn-circle">&nbsp;</span></a>
                        <a class="dropdown-item" href="#">Submit Pending <span style="width: 15px; height: 15px;" class="btn btn-warning btn-small btn-circle">&nbsp;</span></a>
                        <a class="dropdown-item" href="#">Submit Resolved <span style="width: 15px; height: 15px;" class="btn btn-info btn-small btn-circle">&nbsp;</span></a>
                        <a class="dropdown-item" href="#">Submit Close <span style="width: 15px; height: 15px;" class="btn btn-success btn-small btn-circle">&nbsp;</span></a>
                      </div> -->
                  </div>
                              </div>
                      </div>

                    </div>
                  </div>
              </div>
            </div>
        </div>
    </form>
</div>  
<!-- ends of contentwrap -->

