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
				
	<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
		
		<section class="about-company-area" id="store" style="    margin-top: 4%;padding-bottom:6%;">
    <div class="container">
       
        <div class="row">
		<div class="col-md-12" style="border:2px solid #333;">
			<div class="col-md-12">
				<img src="<?php echo base_url();?>admin_assets/assets/main_logo.png" width="200" style="padding: 3px;margin-left: -3%;"/>
				<span><h4 style="float:right;text-decoration:none;font-size:12px">Payslip <?php	echo substr(date("F", mktime(0, 0, 0, $payslip[0]['month'], 3)),0,3).' - '.$payslip[0]['year']; ?></h4></span>
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
			<td style="width: 50%;">Employee Name : <?php echo $payslip[0]['emp_name'];?></td>
			<td>UAN No. : <?php echo $payslip[0]['uan_no'];?></td>
			
		</tr>
		<tr>
		  <td>Emp. ID : <?php echo $payslip[0]['emp_id'];?></td>
		  <td>PF No : <?php echo $payslip[0]['pf_no'];?></td>
	
		</tr>
		<tr>
		  <td>Designation : <?php echo $payslip[0]['designation'];?></td>
		  <td>ESI No. : <?php echo $payslip[0]['esi_no'];?></td>
	
		</tr>
		<tr>
		  <td>Date of Joining : <?php if($payslip[0]['doj'] !="0000-00-00"){ echo date("d-m-Y",strtotime($payslip[0]['doj']));}?></td>
		  <td>Bank Name : <?php echo $payslip[0]['bank_name'];?></td>
		
		</tr>
		<tr> 
		  <td>Department : <?php echo $payslip[0]['department'];?></td>
		  <td>Account No. : <?php echo $payslip[0]['account_no'];?></td>
		</tr>
		<tr> 
		  <td>Location : <?php echo $payslip[0]['location'];?></td> 
		  <td>IFSC Code : <?php echo $payslip[0]['ifsc_code'];?></td>
		</tr>
		<tr> 
		  <td>Client Name : <?php echo $payslip[0]['client_name'];?></td> 
		  <td></td>
		</tr>
		</tbody>
	</table>
		
		
		<table style=" margin-top: 3px;">
		
		<tbody>
		<tr>
			<td style="width: 38%;">Month Days : <?php echo $payslip[0]['month_days'];?></td>
			<td>Leave Taken : <?php echo $payslip[0]['leave_days'];?></td>
			 <td>Arrears Days : <?php echo $payslip[0]['arrears_days'];?></td> 
			 <td>Leave Balance : <?php echo $payslip[0]['leave_balance'];?></td> 
		
		</tr>
		<tr>
		  <td>Payable Days : <?php echo $payslip[0]['payable_days'];?></td>
		  <td>LOP Days : <?php echo $payslip[0]['lop_days'];?></td> 
		  <td>OT Hours : <?php echo $payslip[0]['ot_hours'];?></td>  
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
			<td><?php echo $payslip[0]['fixed_basic_da'];?></td>
			<td><?php echo $payslip[0]['earn_basic'];?></td>  
			<td>EPF </td>
			<td><?php echo $payslip[0]['epf'];?></td>
			
		</tr>
		<tr>
		  <td>HRA</td>
		  <td><?php echo $payslip[0]['fixed_hra'];?></td>
		  <td><?php echo $payslip[0]['earn_hr'];?></td>  
		  <td>ESIC</td>
		  <td><?php echo $payslip[0]['esic'];?></td>
		
		</tr>
		<tr>
		  <td>Conveyance Allowance</td>
		  <td><?php echo $payslip[0]['fixed_conveyance'];?></td>
		  <td><?php echo $payslip[0]['earn_conveyance'];?></td>  
		  <td>PT</td>
		  <td><?php echo $payslip[0]['pt'];?></td>
		</tr>
		
		<tr>
		  <td>Education Allowance</td>
		  <td><?php echo $payslip[0]['fix_education_allowance'];?></td>
		  <td><?php echo $payslip[0]['earn_education_allowance'];?></td>  
		  <td>IT</td>
		  <td><?php echo $payslip[0]['it'];?></td>
		</tr>
		
		<tr>
		  <td>Medical Reimbursement</td>
		  <td><?php echo $payslip[0]['fixed_medical_reimbursement'];?></td>
		  <td><?php echo $payslip[0]['earn_medical_allowance'];?></td>  
		   <td>LWF</td>
		  <td><?php echo $payslip[0]['lwf'];?></td> 
		</tr>
		<tr>
		  <td>Special Allowance</td>
		  <td><?php echo $payslip[0]['fixed_special_allowance'];?></td>
		  <td><?php echo $payslip[0]['earn_special_allowance'];?></td>  
		  <td>Salary Advance</td>
		  <td><?php echo $payslip[0]['salary_advance'];?></td>
		</tr>
		
		<tr>
		  <td>Other Allowance</td>
		  <td><?php echo $payslip[0]['fixed_other_allowance'];?></td>
		  <td><?php echo $payslip[0]['earn_other_allowance'];?></td>  
		 <td>Other Deduction</td>
		  <td><?php echo $payslip[0]['other_deduction'];?></td>
		</tr>
		
		<tr>
		  <td>St.Bonus</td>
		  <td><?php echo $payslip[0]['fixed_st_bonus'];?></td>
		  <td><?php echo $payslip[0]['earn_st_bonus'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		
		<tr>
		  <td>Leave Wages</td>
		  <td><?php echo $payslip[0]['fix_leave_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_leave_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		
		<tr>
		  <td>Holiday Wages</td>
		  <td><?php echo $payslip[0]['fixed_holiday_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_holiday_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		 
			
		<tr>
		  <td>Attendance Bonus</td>
		  <td><?php echo $payslip[0]['fixed_attendance_bonus'];?></td>
		  <td><?php echo $payslip[0]['earn_attendance_bonus'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		<tr>
		  <td>OT Wage </td>
		  <td><?php echo $payslip[0]['fixed_ot_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_ot_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		<tr>
		  <td>Incentive </td>
		  <td><?php echo $payslip[0]['fix_incentive_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_incentive_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		
		<tr>
		  <td>Arrear Wages </td>
		  <td><?php echo $payslip[0]['fix_arrear_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_arrear_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
	 
		<tr>
		  <td>Other wages</td>
		  <td><?php echo $payslip[0]['fixed_other_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_other_wages'];?></td>  
		  <td></td>
		  <td></td>
		 
		</tr>
		<tr style="border-top: 2px solid;">
			<th style="width: 20%;">Total Gross </th>
			<th style="width: 134px;"><?php echo $payslip[0]['fixed_total_earnings'];?></th>
			<th style="width: 151px;"><?php echo $payslip[0]['earn_total_gross'];?></th>  
			<th>Total Deduction </th>
			<th style="width: 13%;"><?php echo $payslip[0]['total_deduction'];?></th>
		</tr>
		</tbody>
	</table>
<table style=" margin-top: 3px;">
		
		<tbody>
		
		<tr>
			<td style="border-right:none;"><b>Net Salary:</b></td>
			<td colspan="6"><b><?php echo $payslip[0]['net_salary'];?></b></td>
		
		
		</tr>
		<tr style="border-top: 2px solid;">
			<td style="border-right:none;"><b>In Words:</b></td>
			<td colspan="6"><b><?php echo $payslip[0]['in_words'];?></b></td>
		
		
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
		<p style="text-align:center;">This is computer generated payslip signatory not required, </p>
	</div>
	
	</section>
	
	</body>
</html>