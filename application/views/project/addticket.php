
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
                <form id="creatclient" class="aj-form">  
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
                                                        <div class="form-group">
                                                            <label class="control-label">Ticket Subject <span class="text-danger">*</span></label>
                                                            <input id="ticket-sebject" class="form-control" type="text" name="ticket-sebject" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Ticket Description <span class="text-danger">*</span></label>
                                                            <textarea name="editor2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <!-- action btn -->
                                            <div class="form-actions">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Submit
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Submit Open <span style="width: 15px; height: 15px;" class="btn btn-danger btn-small btn-circle">&nbsp;</span></a>
                                                        <a class="dropdown-item" href="#">Submit Pending <span style="width: 15px; height: 15px;" class="btn btn-warning btn-small btn-circle">&nbsp;</span></a>
                                                        <a class="dropdown-item" href="#">Submit Resolved <span style="width: 15px; height: 15px;" class="btn btn-info btn-small btn-circle">&nbsp;</span></a>
                                                        <a class="dropdown-item" href="#">Submit Close <span style="width: 15px; height: 15px;" class="btn btn-success btn-small btn-circle">&nbsp;</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card br-0">
                                    <div class="card-wrapper collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Requester Name</label>
                                                        <select class="custom-select br-0">
                                                            <option selected>Select Requester Name</option>
                                                            <option>Kethi Oman[kethi@example.com]</option>
                                                            <option>Obama Donald[donald77@example.com]</option>
                                                            <option>Jequcy Trump[jequcy@example.com]</option>
                                                            <option>herry Oman[Oman@example.com]</option>
                                                            <option>Obama champ[Obama@example.com]</option>
                                                            <option>maxo Trump[Trump@example.com]</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Agent</label>
                                                        <select class="custom-select br-0">
                                                            <option selected>Agent not assigned</option>
                                                            <option>Kethi Oman[kethi@example.com]</option>
                                                            <option>Obama Donald[donald77@example.com]</option>
                                                            <option>Jequcy Trump[jequcy@example.com]</option>
                                                            <option>herry Oman[Oman@example.com]</option>
                                                            <option>Obama champ[Obama@example.com]</option>
                                                            <option>maxo Trump[Trump@example.com]</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group type">
                                                        <label>Type <a class="btn btn-sm btn-outline-info  ml-1" href="#"><i class="fa fa-plus"></i> Add Type</a></label>
                                                        <select class="custom-select br-0">
                                                            <option selected>Question</option>
                                                            <option>Problem</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group type">
                                                        <label>Priority <span class="text-danger">*</span></label>
                                                        <select class="custom-select br-0">
                                                            <option selected>Low</option>
                                                            <option>Medium</option>
                                                            <option>High</option>
                                                            <option>Urgent</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group channel">
                                                        <label class="control-label">Channel Name <a class="btn btn-sm btn-outline-info  ml-1" href="#"><i class="fa fa-plus"></i> Add channel</a></label>
                                                        <select class="custom-select br-0">
                                                            <option selected>Email</option>
                                                            <option>Phone</option>
                                                            <option>Twitter</option>
                                                            <option>Facebook</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Tags</label>
                                                        <input type="text" id="tags" class="form-control" name="tags">
                                                    </div>
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