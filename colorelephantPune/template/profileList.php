<div class="container">
	<?php if(isset($_SESSION['msg'])){ ?>
		<div class="col-lg-12" style="color:green;" id="msg"><h5 style="text-align:center"><?=$_SESSION['msg'];?></h5></div>
	<?php
	$_SESSION['msg']="";
	}
	?>
	<?php
	$profileObj =new profile();
	$conn =$profileObj->connect();
	$result = $profileObj->profileListResult($conn);
	?>
	<div class="col-xs-12 col-lg-12 col-md-12">
		<form class="form-horizontal" action="index.php?page=profileSave" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="table-container  table-responsive" style="overflow-x:hidden !important; ">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">Home</a>
		</div>
		<ul class="nav navbar-nav">
			<?php 
				$publicClass = '';
				$myClass = '';
				if($_REQUEST['ref']=='public')
					$publicClass = 'active';
				else
					$myClass = 'active';
			?>
		  <li class="<?=$publicClass?>"><a href="index.php?page=profileList&ref=public">Public profiles</a></li>
		  <li class="<?=$myClass?>"><a href="index.php?page=profileList&ref=my">My profiles</a></li>
		  <li><a href="index.php?page=profileForm">Add new profile</a></li>
		  <li class="logoutMenu"><a href="index.php?page=logout">Logout</a></li>
		</ul>
	  </div>
	</nav>
				<div class="table-responsive">
					<div id="DataTables_Table__wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
						<table class="table table-striped table-bordered table-hover dataTables-example dataTable no-footer" id="DataTables_Table_profile" aria-describedby="DataTables_Table_info" role="grid">
							<thead>
								<th class="nosort" tabindex="0" aria-controls="DataTables_Table" rowspan="1" colspan="1" style="width: 60px;text-align:center;" >Name</th>
								<th class="nosort" tabindex="0" aria-controls="DataTables_Table" rowspan="1" colspan="1" style="width: 50px;text-align:center;" >E-Mail Id</th>
								<th class="nosort" tabindex="0" aria-controls="DataTables_Table" rowspan="1" colspan="1" style="width: 40px;text-align:center;" >Web Address</th>
								<th class="nosort" tabindex="0" aria-controls="DataTables_Table" rowspan="1" colspan="1" style="width: 80px;text-align:center;" >Cover Letter</th>
								<th class="nosort" tabindex="0" aria-controls="DataTables_Table" rowspan="1" colspan="1" style="width: 10px;text-align:center;" >Work Status</th>
							</thead>
						<?php if($result['message']!="No Result Found"): ?>
							<?php foreach($result['list'] as $key=> $val): ?>
								<tr class="odd" role="row">
									<td class=""><a href="index.php?page=profileView&ref=<?=$_REQUEST['ref'];?>&id=<?=$val['id'];?>"><?php echo $val['name']; ?></a></td>
									<td class=""><?php echo $val['email']; ?></td>
									<td class=""><?php echo $val['web_address']; ?></td>
									<td class=""><?php echo $val['cover_letter']; ?></td>
									<td class=""><?php echo $val['question']; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
