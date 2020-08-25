<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
					<meta content="telephone=no" name="format-detection" />
					<title>Pay Slip</title>
					
					<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
					<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
					<style>
					p{font-size:10px !important;margin-bottom:1%;text-align:justify;    line-height: 1.7;font-family: 'Open Sans', sans-serif;}
					ol, ul{font-size:16px !important;margin-bottom:1%;text-align:justify;font-family: 'Open Sans', sans-serif;}
					li{margin-bottom:1%;text-align:justify;font-family: 'Open Sans', sans-serif;}
					h4{padding-top:1%;font-family: 'Open Sans', sans-serif;text-decoration:underline;font-weight:bold;}
					</style>
					
						<style>
	
	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	table { 
		width: 100%; 
		border: 2px solid #333;
		border-collapse: collapse; font-family: 'Open Sans', sans-serif;
		font-size:10px !important;
	}
	
	th { 
		color: #333;
    font-weight: bold;
    border-bottom: 2px solid #333;font-family: 'Open Sans', sans-serif;
	font-size:10px !important;
	}
	td, th { 
		padding: 3px; 
		border-right: 2px solid #333;font-family: 'Open Sans', sans-serif;
		text-align: left; 
		font-size:8px !important;
	}
	
	</style>
				<style>
						@media print 
						{
							body { 
						padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none;font-family: times;
						}

						a { color:#00b8e4; text-decoration:underline;font-family: times; }
						h3 a { color:#1f1f1f; text-decoration:none;font-family: times; }
						.text2 a { color:#ea4261; text-decoration:none;font-family: times; }
						
						/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
						p { padding:0 !important; margin:0 !important;font-family: times; } 
						ol {font-family: times; } 
						ol li {margin-top:1%;line-height:1.7}
							.table1 td,.table1 th 
								{
									    padding: 7px;
										border: 1px solid black;
								}	
								.gross td
								{
									background: #ecbfbf !important;
								}
							@page { margin-top: 0; }
							@page { margin-bottom: 0; }
							@page { margin-left: 0; }
							@page { margin-right: 0; }
							
								.container
								{
									margin-left: 2%;
									 margin-right: 2%;
								}
							
							}
							
					</style>
				</head>
				<?php
				if(empty($data['emp_name']) || $data['emp_name']=='null'){$data['emp_name']='0';}
				if(empty($data['middle_name']) || $data['middle_name']=='null'){$data['middle_name']='0';}
				if(empty($data['last_name']) || $data['last_name']=='null'){$data['last_name']='0';}
				if(empty($data['month']) || $data['month']=='null'){$data['month']='0';}
				if(empty($data['year']) || $data['year']=='null'){$data['year']='0';}
				if(empty($data['uan_no']) || $data['uan_no']=='null'){$data['uan_no']='0';}
				if(empty($data['emp_id']) || $data['emp_id']=='null'){$data['emp_id']='0';}
				if(empty($data['pf_no']) || $data['pf_no']=='null'){$data['pf_no']='0';}
				if(empty($data['designation']) || $data['designation']=='null'){$data['designation']='0';}
				if(empty($data['esi_no']) || $data['esi_no']=='null'){$data['esi_no']='0';}
				if(empty($data['doj']) || $data['doj']=='null'){$data['doj']='0';}
				if(empty($data['bank_name']) || $data['bank_name']=='null'){$data['bank_name']='0';}
				if(empty($data['department']) || $data['department']=='null'){$data['department']='0';}
				if(empty($data['account_no']) || $data['account_no']=='null'){$data['account_no']='0';}
				if(empty($data['location']) || $data['location']=='null'){$data['location']='0';}
				if(empty($data['ifsc_code']) || $data['ifsc_code']=='null'){$data['ifsc_code']='0';}
				if(empty($data['client_name']) || $data['client_name']=='null'){$data['client_name']='0';}
				if(empty($data['month_days']) || $data['month_days']=='null'){$data['month_days']='0';}
				if(empty($data['leave_days']) || $data['leave_days']=='null'){$data['leave_days']='0';}
				if(empty($data['arrears_days']) || $data['arrears_days']=='null'){$data['arrears_days']='0';}
				if(empty($data['leave_balance']) || $data['leave_balance']=='null'){$data['leave_balance']='0';}
				if(empty($data['payable_days']) || $data['payable_days']=='null'){$data['payable_days']='0';}
				if(empty($data['lop_days']) || $data['lop_days']=='null'){$data['lop_days']='0';}
				if(empty($data['ot_hours']) || $data['ot_hours']=='null'){$data['ot_hours']='0';}
				if(empty($data['fixed_basic_da']) || $data['fixed_basic_da']=='null'){$data['fixed_basic_da']='0';}
				if(empty($data['earn_basic']) || $data['earn_basic']=='null'){$data['earn_basic']='0';}
				if(empty($data['epf']) || $data['epf']=='null'){$data['epf']='0';}
				if(empty($data['fixed_hra']) || $data['fixed_hra']=='null'){$data['fixed_hra']='0';}
				if(empty($data['earn_hr']) || $data['earn_hr']=='null'){$data['earn_hr']='0';}
				if(empty($data['esic']) || $data['esic']=='null'){$data['esic']='0';}
				if(empty($data['fixed_conveyance']) || $data['fixed_conveyance']=='null'){$data['fixed_conveyance']='0';}
				if(empty($data['earn_conveyance']) || $data['earn_conveyance']=='null'){$data['earn_conveyance']='0';}
				if(empty($data['pt']) || $data['pt']=='null'){$data['pt']='0';}
				if(empty($data['fix_education_allowance']) || $data['fix_education_allowance']=='null'){$data['fix_education_allowance']='0';}
				if(empty($data['earn_education_allowance']) || $data['earn_education_allowance']=='null'){$data['earn_education_allowance']='0';}
				if(empty($data['it']) || $data['it']=='null'){$data['it']='0';}
				if(empty($data['fixed_medical_reimbursement']) || $data['fixed_medical_reimbursement']=='null'){$data['fixed_medical_reimbursement']='0';}
				if(empty($data['earn_medical_allowance']) || $data['earn_medical_allowance']=='null'){$data['earn_medical_allowance']='0';}
				if(empty($data['lwf']) || $data['lwf']=='null'){$data['lwf']='0';}
				if(empty($data['fixed_special_allowance']) || $data['fixed_special_allowance']=='null'){$data['fixed_special_allowance']='0';}
				if(empty($data['earn_special_allowance']) || $data['earn_special_allowance']=='null'){$data['earn_special_allowance']='0';}
				if(empty($data['salary_advance']) || $data['salary_advance']=='null'){$data['salary_advance']='0';}
				if(empty($data['fixed_other_allowance']) || $data['fixed_other_allowance']=='null'){$data['fixed_other_allowance']='0';}
				if(empty($data['earn_other_allowance']) || $data['earn_other_allowance']=='null'){$data['earn_other_allowance']='0';}
				if(empty($data['other_deduction']) || $data['other_deduction']=='null'){$data['other_deduction']='0';}
				if(empty($data['fixed_st_bonus']) || $data['fixed_st_bonus']=='null'){$data['fixed_st_bonus']='0';}
				if(empty($data['earn_st_bonus']) || $data['earn_st_bonus']=='null'){$data['earn_st_bonus']='0';}
				if(empty($data['fix_leave_wages']) || $data['fix_leave_wages']=='null'){$data['fix_leave_wages']='0';}
				if(empty($data['earn_leave_wages']) || $data['earn_leave_wages']=='null'){$data['earn_leave_wages']='0';}
				if(empty($data['fixed_holiday_wages']) || $data['fixed_holiday_wages']=='null'){$data['fixed_holiday_wages']='0';}
				if(empty($data['earn_holiday_wages']) || $data['earn_holiday_wages']=='null'){$data['earn_holiday_wages']='0';}
				if(empty($data['fixed_attendance_bonus']) || $data['fixed_attendance_bonus']=='null'){$data['fixed_attendance_bonus']='0';}
				if(empty($data['earn_attendance_bonus']) || $data['earn_attendance_bonus']=='null'){$data['earn_attendance_bonus']='0';}
				if(empty($data['fixed_ot_wages']) || $data['fixed_ot_wages']=='null'){$data['fixed_ot_wages']='0';}
				if(empty($data['earn_ot_wages']) || $data['earn_ot_wages']=='null'){$data['earn_ot_wages']='0';}
				if(empty($data['fix_incentive_wages']) || $data['fix_incentive_wages']=='null'){$data['fix_incentive_wages']='0';}
				if(empty($data['earn_incentive_wages']) || $data['earn_incentive_wages']=='null'){$data['earn_incentive_wages']='0';}
				if(empty($data['fix_arrear_wages']) || $data['fix_arrear_wages']=='null'){$data['fix_arrear_wages']='0';}
				if(empty($data['earn_arrear_wages']) || $data['earn_arrear_wages']=='null'){$data['earn_arrear_wages']='0';}
				if(empty($data['fixed_other_wages']) || $data['fixed_other_wages']=='null'){$data['fixed_other_wages']='0';}
				if(empty($data['earn_other_wages']) || $data['earn_other_wages']=='null'){$data['earn_other_wages']='0';}
				if(empty($data['fixed_total_earnings']) || $data['fixed_total_earnings']=='null'){$data['fixed_total_earnings']='0';}
				if(empty($data['earn_total_gross']) || $data['earn_total_gross']=='null'){$data['earn_total_gross']='0';}
				if(empty($data['total_deduction']) || $data['total_deduction']=='null'){$data['total_deduction']='0';}
				if(empty($data['net_salary']) || $data['net_salary']=='null'){$data['net_salary']='0';}
				if(empty($data['in_words']) || $data['in_words']=='null'){$data['in_words']='0';}

				?>
	<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none;">
		
		<section class="about-company-area" id="store" style="margin-top: 4%;padding-bottom:6%;">
    <div class="container">
       
        <div class="row">
		<div class="col-md-12" style="border:2px solid #333;">
			<div class="col-md-12">
				<img src="admin_assets\assets\main_logo.png" width="200" style="padding: 3px;"/>
				<span><h4 style="float:right;text-decoration:none;font-size:12px">Payslip <?php	echo substr(date("F", mktime(0, 0, 0, $data['month'], 3)),0,3).' - '.$data['year']; ?></h4></span>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
		  <div class="col-md-12" style="border-left:2px solid #333;border-right:2px solid #333;">
				<p style="text-align:center;margin: 0px 0;">M-20, 3rd Floor, UKS Heights, 10th Main, Jeevanbhima Nagar, Banagalore-560075. Ph- 080 -43726370</p>
			</div>
		 <div class="col-md-12" style="border-left:2px solid #333;border-right:2px solid #333;">
				<p style="text-align:center;margin: 0px 0;">FORM XIX</p>
			</div>
		 <div class="col-md-12" style="border-left:2px solid #333;border-right:2px solid #333;">
				<p style="text-align:center;margin: 0px 0;">[See Rule 78(1)(b)]</p>
			</div>
		
		
		<table>
		<thead>
		
		</thead>
		<tbody>
		<tr>
			<td style="width: 50%;">Employee Name : <?php echo $data['emp_name'];?></td>
			<td>UAN No. : <?php echo $data['uan_no'];?></td>
			
		</tr>
		<tr>
		  <td>Emp. ID : <?php echo $data['emp_id'];?></td>
		  <td>PF No : <?php echo $data['pf_no'];?></td>
	
		</tr>
		<tr>
		  <td>Designation : <?php echo $data['designation'];?></td>
		  <td>ESI No. : <?php echo $data['esi_no'];?></td>
	
		</tr>
		<tr>
		  <td>Date of Joining : <?php if($data['doj'] !="0000-00-00"){ echo date("d-m-Y",strtotime($data['doj']));}?></td>
		  <td>Bank Name : <?php echo $data['bank_name'];?></td>
		
		</tr>
		<tr> 
		  <td>Department : <?php echo $data['department'];?></td>
		  <td>Account No. : <?php echo $data['account_no'];?></td>
		</tr>
		<tr> 
		  <td>Location : <?php echo $data['location'];?></td> 
		  <td>IFSC Code : <?php echo $data['ifsc_code'];?></td>
		</tr>
		<tr> 
		  <td>Client Name : <?php echo $data['client_name'];?></td> 
		  <td></td>
		</tr>
		</tbody>
	</table>
		
		
		<table style=" margin-top: 3px;">
		
		<tbody>
		<tr>
			<td style="width: 38%;">Month Days : <?php echo $data['month_days'];?></td>
			<td>Leave Taken : <?php echo $data['leave_days'];?></td>
			 <td>Arrears Days : <?php echo $data['arrears_days'];?></td> 
			 <td>Leave Balance : <?php echo $data['leave_balance'];?></td> 
		
		</tr>
		<tr>
		  <td>Payable Days : <?php echo $data['payable_days'];?></td>
		  <td>LOP Days : <?php echo $data['lop_days'];?></td> 
		  <td>OT Hours : <?php echo $data['ot_hours'];?></td>  
		  <td></td>  
		</tr>
		

	
		</tbody>
	</table>
		<table style="margin-top: 3px;">
		<thead>
		<tr>
			<th style="width: 20%;">Particulars </th>
			<th>Fixed Wages</th>
			<th>Earned Wages</th>  
			<th>Particulars </th>
			<th style="width: 13%;">Deductions</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Basic + DA</td>
			<td><?php echo $data['fixed_basic_da'];?></td>
			<td><?php echo $data['earn_basic'];?></td>  
			<td>EPF </td>
			<td><?php echo $data['epf'];?></td>
			
		</tr>
		<tr>
		  <td>HRA</td>
		  <td><?php echo $data['fixed_hra'];?></td>
		  <td><?php echo $data['earn_hr'];?></td>  
		  <td>ESIC</td>
		  <td><?php echo $data['esic'];?></td>
		
		</tr>
		<tr>
		  <td>Conveyance Allowance</td>
		  <td><?php echo $data['fixed_conveyance'];?></td>
		  <td><?php echo $data['earn_conveyance'];?></td>  
		  <td>PT</td>
		  <td><?php echo $data['pt'];?></td>
		</tr>
		
		<tr>
		  <td>Education Allowance</td>
		  <td><?php echo $data['fix_education_allowance'];?></td>
		  <td><?php echo $data['earn_education_allowance'];?></td>  
		  <td>IT</td>
		  <td><?php echo $data['it'];?></td>
		</tr>
		
		<tr>
		  <td>Medical Reimbursement</td>
		  <td><?php echo $data['fixed_medical_reimbursement'];?></td>
		  <td><?php echo $data['earn_medical_allowance'];?></td>  
		   <td>LWF</td>
		  <td><?php echo $data['lwf'];?></td> 
		</tr>
		<tr>
		  <td>Special Allowance</td>
		  <td><?php echo $data['fixed_special_allowance'];?></td>
		  <td><?php echo $data['earn_special_allowance'];?></td>  
		  <td>Salary Advance</td>
		  <td><?php echo $data['salary_advance'];?></td>
		</tr>
		
		<tr>
		  <td>Other Allowance</td>
		  <td><?php echo $data['fixed_other_allowance'];?></td>
		  <td><?php echo $data['earn_other_allowance'];?></td>  
		 <td>Other Deduction</td>
		  <td><?php echo $data['other_deduction'];?></td>
		</tr>
		
		<tr>
		  <td>St.Bonus</td>
		  <td><?php echo $data['fixed_st_bonus'];?></td>
		  <td><?php echo $data['earn_st_bonus'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		
		<tr>
		  <td>Leave Wages</td>
		  <td><?php echo $data['fix_leave_wages'];?></td>
		  <td><?php echo $data['earn_leave_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		
		<tr>
		  <td>Holiday Wages</td>
		  <td><?php echo $data['fixed_holiday_wages'];?></td>
		  <td><?php echo $data['earn_holiday_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		 
			
		<tr>
		  <td>Attendance Bonus</td>
		  <td><?php echo $data['fixed_attendance_bonus'];?></td>
		  <td><?php echo $data['earn_attendance_bonus'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		<tr>
		  <td>OT Wage </td>
		  <td><?php echo $data['fixed_ot_wages'];?></td>
		  <td><?php echo $data['earn_ot_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		<tr>
		  <td>Incentive </td>
		  <td><?php echo $data['fix_incentive_wages'];?></td>
		  <td><?php echo $data['earn_incentive_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		
		<tr>
		  <td>Arrear Wages </td>
		  <td><?php echo $data['fix_arrear_wages'];?></td>
		  <td><?php echo $data['earn_arrear_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
	 
		<tr>
		  <td>Other wages</td>
		  <td><?php echo $data['fixed_other_wages'];?></td>
		  <td><?php echo $data['earn_other_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		<tr style="border-top: 2px solid;">
			<th style="width: 20%;">Total Gross </th>
			<th style="width: 134px;"><?php echo $data['fixed_total_earnings'];?></th>
			<th style="width: 151px;"><?php echo $data['earn_total_gross'];?></th>  
			<th>Total Deduction </th>
			<th style="width: 13%;"><?php echo $data['total_deduction'];?></th>
		</tr>
		</tbody>
	</table>
<table style=" margin-top: 3px;">
		
		<tbody>
		
		<tr>
			<td style="border-right:none;"><b>Net Salary:</b></td>
			<td colspan="6"><b><?php echo $data['net_salary'];?></b></td>
		
		
		</tr>
		<tr style="border-top: 2px solid;">
			<td style="border-right:none;"><b>In Words:</b></td>
			<td colspan="6"><b><?php echo $data['in_words'];?></b></td>
		
		
		</tr>
	
	
		</tbody>
	</table>
	<table style="    border-top: none;">
		
		<tbody>
		
		
		
	
	
		</tbody>
	</table>
		<table style="border-top: none;">
		
		<tbody>
		
		
		
	
	
		</tbody>
	</table>
	</div>
		<p style="text-align:center;margin-bottom:80%">This is computer generated payslip signatory not required, </p>
	</div>
	
	</section>
	
	</body>
</html>
