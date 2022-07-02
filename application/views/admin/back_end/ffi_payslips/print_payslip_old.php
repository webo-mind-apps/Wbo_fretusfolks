<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
					<meta content="telephone=no" name="format-detection" />
					<title>Pay Slip</title>
					
					<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
					<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
					<style>
					p{font-size:14px !important;margin-bottom:1%;text-align:justify;line-height:27px;font-family: 'Open Sans', sans-serif;}
					ol, ul{font-size:16px !important;margin-bottom:1%;text-align:justify;font-family: 'Open Sans', sans-serif;}
					li{margin-bottom:1%;text-align:justify;font-family: 'Open Sans', sans-serif;}
					h4{padding-top:1%;font-family: 'Open Sans', sans-serif;text-decoration:underline;font-weight:bold;}
					</style>
					
						<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		tr { border: 1px solid #ccc; }
		
		td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee; 
			position: relative;font-family: 'Open Sans', sans-serif;
			padding-left: 50% !important; 
		}
		
		td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; font-family: 'Open Sans', sans-serif;
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		
	}
	
	/* Smartphones (portrait and landscape) ----------- */
	@media only screen
	and (min-device-width : 320px)
	and (max-device-width : 480px) {
		body { 
			padding: 0; 
			margin: 0; 
			width: 320px; }
		}
	
	/* iPads (portrait and landscape) ----------- */
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		body { 
			width: 495px; 
		}
	}
	
	
	
	#page-wrap {
	margin: 50px;
}
p {
	margin: 20px 0;font-family: 'Open Sans', sans-serif; font-size:10px;
}

	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	table { 
		width: 100%; 
		border: 2px solid #333;
		border-collapse: collapse; font-family: 'Open Sans', sans-serif;
	}
	/* Zebra striping */
	
	th { 
		color: #333;
    font-weight: bold;
    border-bottom: 2px solid #333;font-family: 'Open Sans', sans-serif;
	}
	td, th { 
		padding: 6px; 
		border-right: 2px solid #333;font-family: 'Open Sans', sans-serif;
		text-align: left; 
	}
	
	</style>
				</head>
				
	<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
		
		<section class="about-company-area" id="store" style="    margin-top: 4%;padding-bottom:6%;">
    <div class="container">
       
        <div class="row">
		<div class="col-md-12" style="border:2px solid #333;">
			<div class="col-md-12">
				<img src="<?php echo base_url();?>admin_assets/assets/main_logo.png" width="400" style="padding: 3px;margin-left: -3%;"/>
				<span><h4 style="float:right;text-decoration:none;">Payslip Sep - 2018</h4></span>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
		  <div class="col-md-12" style="border-left:2px solid #333;border-right:2px solid #333;">
				<p style="text-align:center;margin: 4px 0;">M-20, 3rd Floor, UKS Heights, 10th Main, Jeevanbhima Nagar, Banagalore-560075. Ph- 080 -43726370</p>
			</div>
		 <div class="col-md-12" style="border-left:2px solid #333;border-right:2px solid #333;">
				<p style="text-align:center;margin: 0px 0;">FORM XIX</p>
			</div>
		 <div class="col-md-12" style="border-left:2px solid #333;border-right:2px solid #333;">
				<p style="text-align:center;margin: 0px 0;">[See Rule 78(1)(b)]</p>
			</div>
		
		
	<table>
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
		  <td>Account No. : <?php echo $payslip[0]['account_no'];?></td>
		  <td></td>
		</tr>
		</tbody>
	</table>
		
		
		<table style=" margin-top: 3px;">
		
		<tbody>
		<tr>
			<td style="width: 38%;">Month Days : <?php echo $payslip[0]['month_days'];?></td>
			<td>LOP Days : <?php echo $payslip[0]['lop_days'];?></td>
			<td>OT Hours : <?php echo $payslip[0]['ot_hours'];?></td>
		
		</tr>
		<tr>
		  <td>Payable Days : <?php echo $payslip[0]['payable_days'];?></td>
		  <td>Arrears Days : <?php echo $payslip[0]['arrears_days'];?></td>
		  <td>Notice period Days : <?php echo $payslip[0]['notice_period_days'];?></td>
	
		</tr>
		
	
	
		</tbody>
	</table>
		<table style="margin-top: 3px;">
		<thead>
		<tr>
			<th style="width: 20%;">Particulars </th>
			<th>Fixed Wages</th>
			<th>Earned Wages</th>
			<th>Arrear Wages</th>
			<th style="width: 15%;">Total Earned wages</th>
			<th>Particulars </th>
			<th style="width: 13%;">Deduction</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Basic + DA</td>
			<td><?php echo $payslip[0]['fixed_basic_da'];?></td>
			<td><?php echo $payslip[0]['earn_basic'];?></td>
			<td><?php echo $payslip[0]['arr_basic'];?></td>
			<td><?php echo $payslip[0]['total_basic'];?></td>
			<td>EPF </td>
			<td><?php echo $payslip[0]['epf'];?></td>
			
		</tr>
		<tr>
		  <td>HRA</td>
		  <td><?php echo $payslip[0]['fixed_hra'];?></td>
		  <td><?php echo $payslip[0]['earn_hr'];?></td>
		  <td><?php echo $payslip[0]['arr_hra'];?></td>
		  <td><?php echo $payslip[0]['total_hra'];?></td>
		  <td>ESIC</td>
		  <td><?php echo $payslip[0]['esic'];?></td>
		
		</tr>
		<tr>
		  <td>Conveyance Allowance</td>
		  <td><?php echo $payslip[0]['fixed_conveyance'];?></td>
		  <td><?php echo $payslip[0]['earn_conveyance'];?></td>
		  <td><?php echo $payslip[0]['arr_conveyance'];?></td>
		  <td><?php echo $payslip[0]['total_conveyance'];?></td>
		  <td>PT</td>
		  <td><?php echo $payslip[0]['pt'];?></td>
		</tr>
		<tr>
		  <td>Medical Reimbursement</td>
		  <td><?php echo $payslip[0]['fixed_medical_reimbursement'];?></td>
		  <td><?php echo $payslip[0]['earn_medical_allowance'];?></td>
		  <td><?php echo $payslip[0]['arr_medical_reimbursement'];?></td>
		  <td><?php echo $payslip[0]['total_medical_reimbursement'];?></td>
		  <td>IT</td>
		  <td><?php echo $payslip[0]['it'];?></td>
		
		</tr>
		<tr>
		  <td>Special Allowance</td>
		  <td><?php echo $payslip[0]['fixed_special_allowance'];?></td>
		  <td><?php echo $payslip[0]['earn_special_allowance'];?></td>
		  <td><?php echo $payslip[0]['arr_special_allowance'];?></td>
		  <td><?php echo $payslip[0]['total_special_allowance'];?></td>
		  <td>LWF</td>
		  <td><?php echo $payslip[0]['lwf'];?></td>
		 
		</tr>
		<tr>
		  <td>Other Allowance</td>
		  <td><?php echo $payslip[0]['fixed_other_allowance'];?></td>
		  <td><?php echo $payslip[0]['earn_other_allowance'];?></td>
		  <td><?php echo $payslip[0]['arr_other_allowance'];?></td>
		  <td><?php echo $payslip[0]['total_other_allowance'];?></td>
		  <td>Salary Advance</td>
		  <td><?php echo $payslip[0]['salary_advance'];?></td>
		</tr>
		
		<tr>
		  <td>OT Wage </td>
		  <td><?php echo $payslip[0]['fixed_ot_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_ot_wages'];?></td>
		  <td><?php echo $payslip[0]['arr_ot_wages'];?></td>
		  <td><?php echo $payslip[0]['total_ot_wages'];?></td>
		  <td>Other Deduction</td>
		  <td><?php echo $payslip[0]['other_deduction'];?></td>
		</tr>
			
		<tr>
		  <td>Attendance Bonus</td>
		  <td><?php echo $payslip[0]['fixed_attendance_bonus'];?></td>
		  <td><?php echo $payslip[0]['earn_attendance_bonus'];?></td>
		  <td><?php echo $payslip[0]['arr_attendance_bonus'];?></td>
		  <td><?php echo $payslip[0]['total_attendance_bonus'];?></td>
		  <td></td>
		  <td></td>
		</tr>
		
		<tr>
		  <td>St.Bonus</td>
		  <td><?php echo $payslip[0]['fixed_st_bonus'];?></td>
		  <td><?php echo $payslip[0]['earn_st_bonus'];?></td>
		  <td><?php echo $payslip[0]['arr_st_bonus'];?></td>
		  <td><?php echo $payslip[0]['total_st_bonus'];?></td>
		  <td></td>
		  <td></td>
		</tr>
		
		<tr>
		  <td>Holiday Wages</td>
		  <td><?php echo $payslip[0]['fixed_holiday_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_holiday_wages'];?></td>
		  <td><?php echo $payslip[0]['arr_holiday_wages'];?></td>
		  <td><?php echo $payslip[0]['total_holiday_wages'];?></td>
		  <td></td>
		  <td></td>
		</tr>
		
		
		<tr>
		  <td>Other wages</td>
		  <td><?php echo $payslip[0]['fixed_other_wages'];?></td>
		  <td><?php echo $payslip[0]['earn_other_wages'];?></td>
		  <td><?php echo $payslip[0]['arr_other_wages'];?></td>
		  <td><?php echo $payslip[0]['total_other_wages'];?></td>
		  <td></td>
		  <td></td>
		 
		</tr>
		
		</tbody>
	</table>
<table style=" margin-top: 3px;">
		
		<tbody>
		<tr>
			<th style="width: 20%;">Total Gross </th>
			<th style="width: 134px;"><?php echo $payslip[0]['fixed_total_earnings'];?></th>
			<th style="width: 151px;"><?php echo $payslip[0]['earn_total_gross'];?></th>
			<th style="width: 147px;"><?php echo $payslip[0]['arr_total_gross'];?></th>
			<th style="width: 15%;"><?php echo $payslip[0]['total_total_gross'];?></th>
			<th>Total Deduction </th>
			<th style="width: 13%;"><?php echo $payslip[0]['total_deduction'];?></th>
		</tr>
		<tr>
			<td style="border-right:none;"><b>Net Salary:<?php echo $payslip[0]['net_salary'];?></b></td>
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
	</div>
	<p style="text-align:center;">This is computer generated payslip signatory not required, </p>
	</section>
	</body>
</html>