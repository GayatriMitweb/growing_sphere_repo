<?php
include "../../../model/model.php";
$emp_id= $_SESSION['emp_id'];
$role = $_SESSION['role']; 
$branch_admin_id = $_SESSION['branch_admin_id']; 
$year = $_POST['year'];

$query = "select * from employee_performance_master where 1 ";

if($emp_id != '0' && $role !='Admin' && $role != 'Branch Admin'){
	$query .= " and emp_id='$emp_id'";
}
if($year!=""){
  $query .= " and year='$year'";
}
if($role == 'Branch Admin'){
	$query .= " and emp_id in(select emp_id from emp_master where branch_id='$branch_admin_id')";
}
?>
<div class="row mg_tp_20"> <div class="col-md-12 no-pad mg_tp_20"> <div class="table-responsive">
<table class="table table-hover" id="tbl_performance_list" style="margin: 20px 0 !important;">
	<thead>
		<tr class="table-heading-row">
			<th>User_NAME</th>
			<th>Year</th>
			<th class="text-center">Teamwork</th>  
		    <th class="text-center">Leadership</th>
		    <th class="text-center">Communication</th>
		    <th class="text-center">Analytical Skills</th>  
		    <th class="text-center">Ethics</th>
		    <th class="text-center">Conceptual_Thinking</th>
		    <th class="text-center">Average Rating</th>  
		</tr>
	</thead>
	<tbody>
		<?php 
		$count = 0;
		$sq_c = mysql_query($query);
		while($row_c = mysql_fetch_assoc($sq_c)){
			 $sq_emp = mysql_fetch_assoc(mysql_query("select * from emp_master where emp_id='$row_c[emp_id]'"));
			?>
			<tr>
				<td><?= $sq_emp['first_name'].' '.$sq_emp['last_name'] ?>
				<td><?= $row_c['year'] ?>
				<td class="text-center"><?= ($row_c['leadership']!="") ? $row_c['leadership'] : '-' ?></td>   
			      <td class="text-center"><?= ($row_c['communication']!="") ? $row_c['communication'] : '-' ?></td> 
			      <td class="text-center"><?= ($row_c['analytical_skills']!="") ? $row_c['analytical_skills'] : '-' ?></td>
			      <td class="text-center"><?= ($row_c['ethics']) ? $row_c['ethics'] : '-' ?></td>
			      <td class="text-center"><?= ($row_c['conceptual_thinking']) ? $row_c['conceptual_thinking'] : '-' ?></td>
			      <td class="text-center"><?= ($row_c['teamwork']!="") ? $row_c['teamwork'] : '-' ?></td>   
			      <td class="text-center"><?= ($row_c['ave_ratings']!="") ? $row_c['ave_ratings'] : '-' ?></td> 
			</tr>
			<?php
		}
		?>
	</tbody>
</table>	
</div> </div> </div>
<script type="text/javascript">
$('#tbl_performance_list').dataTable({
		"pagingType": "full_numbers"
});
</script> 