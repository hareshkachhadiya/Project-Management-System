<!DOCTYPE HTML>
<html>

<head>
</head>

<body>
	<div class="container">
    	<div class="row">
    		<div class="col-md-3">
			<h3>Complete Task</h3>
				<div id="fig1" ondrop="dropThis(event,'3')" ondragover="allowDropThis(event)">
					<?php
					$wherearr = array('status' =>3);
					$compdata = $this->common_model->getData('tbl_task',$wherearr);
					for($i = 0;$i<=count($compdata)-1;$i++){ ?>
						<p class="task_status" draggable="true" ondragstart="dragThis(event,'<?php echo $compdata[$i]->id; ?>')" id="<?php echo $compdata[$i]->status; ?>"><?php echo $compdata[$i]->title; ?></p>
				<?php }
					?>
				</div>
			</div>	
			<div class="col-md-3">
				<h3>InComplete Task</h3>
				<div id="fig2" ondrop="dropThis(event,'0')" ondragover="allowDropThis(event)">
					<?php
						$wherearr = array('status' =>0);
						$incompdata = $this->common_model->getData('tbl_task',$wherearr);
						for($i = 0;$i<=count($incompdata)-1;$i++){ ?>
							<p class="task_status" draggable="true" ondragstart="dragThis(event,'<?php echo $incompdata[$i]->id; ?>')" id="<?php echo $incompdata[$i]->status; ?>"><?php echo $incompdata[$i]->title; ?></p>
					<?php }
						?>
				</div>
			</div>
			<div class="col-md-3">
				<h3>ToDo Task</h3>
				<div id="fig3" ondrop="dropThis(event,'1')" ondragover="allowDropThis(event)">
					<?php
						$wherearr = array('status' =>1);
						$tododata = $this->common_model->getData('tbl_task',$wherearr);
						for($i = 0;$i<=count($tododata)-1;$i++){ ?>
							<p class="task_status" draggable="true" ondragstart="dragThis(event,'<?php echo $tododata[$i]->id; ?>')" id="<?php echo $tododata[$i]->status; ?>"><?php echo $tododata[$i]->title; ?></p>
					<?php }
						?>
				</div>
			</div>
			<div class="col-md-3">
				<h3>Doing Task</h3>
				<div id="fig4" ondrop="dropThis(event,'2')" ondragover="allowDropThis(event)">
					<?php
						$wherearr = array('status' =>2);
						$doingdata = $this->common_model->getData('tbl_task',$wherearr);
						for($i = 0;$i<=count($doingdata)-1;$i++){ ?>
							<p class="task_status" draggable="true" ondragstart="dragThis(event,'<?php echo $doingdata[$i]->id; ?>')" id="<?php echo $doingdata[$i]->status; ?>"><?php echo $doingdata[$i]->title; ?></p>
					<?php }
						?>
				</div>
			</div>
	</div>
</div>
</body>
</html>
<style type="text/css">
	#fig1, #fig2 ,#fig3,#fig4{
    float: left;
    width: 220px;
    height: 280px;
    margin: 20px;
    padding: 20px;
    border: 2px solid black;
}
.task_status{
	border: 2px solid blue;
}
</style>

<script type="text/javascript">
	function allowDropThis(i) {
    i.preventDefault();
}

function dragThis(i,id) {
	i.dataTransfer.setData("id", id);
    i.dataTransfer.setData("status", i.target.id);
}

function dropThis(i,newstatus) {
    i.preventDefault();
    var status = i.dataTransfer.getData("status");
    var taskid = i.dataTransfer.getData("id");
    alert(status);
    alert(taskid);
    $.ajax({
    	url:base_url+'task/editstatus',
    	type:'POST',
    	dataType: 'html',
    	data:{userid:taskid,dragStatus:status,newstatus:newstatus},
    	success: function(data) {
    		//i.target.appendChild(document.getElementById(status));
    		
    		//detail = para.innerHTML(data);
    		i.target.append(data);
    	}
    });
    
}
</script>