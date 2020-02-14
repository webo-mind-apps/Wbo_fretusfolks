<?php
   if(!empty($letter_details))
   {
   	
   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <meta content="telephone=no" name="format-detection" />
      <title>Fretus Folks</title>
      <style type="text/css" media="screen">
         /* Linked Styles */
         body { 
         padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none;font-family: times;
         }
         a { color:#00b8e4; text-decoration:underline;font-family: times; }
         h3 a { color:#1f1f1f; text-decoration:none;font-family: times; }
         .text2 a { color:#ea4261; text-decoration:none;font-family: times; }
         /* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
         p { padding:0 !important; margin:0 !important;font-family: times; } 
         ol {font-family: times; } 
         ol li {margin-top:1%;line-height:2}
         .table1 td,.table1 th 
         {
         border: 1px solid black;
         }
         .content1 p
         {
         margin-bottom: 1% !important;
         }
      </style>
      <style>
         @media print 
         {
         ody { 
         padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none;font-family: times;
         }
         a { color:#00b8e4; text-decoration:underline;font-family: times; }
         h3 a { color:#1f1f1f; text-decoration:none;font-family: times; }
         .text2 a { color:#ea4261; text-decoration:none;font-family: times; }
         /* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
         p { padding:0 !important; margin:0 !important;font-family: times; } 
         ol {font-family: times; } 
         ol li {margin-top:1%;line-height:2}
         .table1 td,.table1 th 
         {
         border: 1px solid black;
         }	
         .gross td
         {
         background: #ecbfbf !important;
         }
         }
         .content1 p
         {
         margin-bottom: 1% !important;
         }
      </style>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body onload="window.print()" class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
	<div>
	<!-- <img src="admin_assets/ffi_header.jpg" style="padding-left:5%;padding-right:5%;">					 -->
      <br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="padding-left:5%;padding-right:5%;">
                  <div>
                     <div style="color:#000;font-size: 21px;margin-top: 4%;margin-bottom: 5%;">
                        <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                           <table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
                              <tbody>
                                 <tr>
                                    <td colspan="3" style="font-size:12px;text-align:left;padding:0px;width:70%">
                                       <p style="line-height:1.8;font-size:14px">	
                                          <b>To 
                                          <br>Mr./Mrs./Ms, <?php echo $letter_details['emp_name'];?></b>
                                          <br><?php echo $letter_details['ffi_emp_id'];?></b> 
                                          <br><?php echo $letter_details['location'];?></b> <br>
                                       </p>
                                    </td>
                                    <td style="font-size:12px;text-align:left;padding:0px;">
                                       <p style="line-height:1.8;font-size:14px"><b>Date : <?php echo date("d-m-Y",strtotime($letter_details['date']));?></b></p>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <br>
                           <div class="content" style="line-height:2;font-size:14px">
                              <p style="line-height:1.8;font-size:14px"><b>Sub : Increment Letter</b></p>
                           </div>
                           <br>
                           <div class="content" style="line-height:2;font-size:14px">
                              <p style="line-height:1.8;font-size:14px"><b>Dear <?php echo $letter_details['emp_name'];?>,</b></p>
                           </div>
                           <br>
                           <div class="content1" style="line-height:1.8;font-size:14px">
                              <?php echo $letter_details['content'];?>
                           </div>
                           <br>
                           <br>
                           <table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
                              <tbody>
                                 <tr>
                                    <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                                       <p style="line-height:1.8;font-size:14px">	
                                          <br>
                                          <b>For : Fretus Folks India Pvt Ltd.</b>  <br>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
                                          <br>
                                          <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                                       </p>
                                    </td>
                                    <td style="font-size:12px;text-align:left;padding:7px;width:40%">
                                       <p style="line-height:1.8;font-size:14px">	
                                          <br>
                                          <b>I accept:</b> <br><br><br>
                                          <b>Signature and Date</b> <br>
                                       </p>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
               </td>
            </tr>
         </tbody>
      </table>
	      <br>
      <br>
      <br>
      <!-- <img class="abc" src="admin_assets/ffi_footer.jpg" style="padding-top: 8%;">	 -->
	  </div>
		<!-- <img src="admin_assets/ffi_header.jpg" style="padding-left:5%;padding-right:5%;"> -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td style="padding-left:5%;padding-right:5%;">
					<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
						<h1 style="font-size:16px;text-align:center;text-decoration: underline;">Annexure - 1</h1>
							<center>
								<table class="table table1" border="1" style="border-collapse:collapse;width:80%;margin-bottom:0px;font-size: 10px;">
									<tbody>
										<tr>
											  <th style="font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">
											  Components	
											  </th>
											  <th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
											  Monthly salary
											  </th>
											  <th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
											  Annual salary
											  </th>
										</tr>
										<tr>
											  <td>Basic</td>
											  <td><?php echo $letter_details['basic_salary'];?></td>
											  <td><?php echo ($letter_details['basic_salary']*12);?></td>
										</tr>
										<tr>
												<td>HRA</td>
												<td><?php echo $letter_details['hra'];?></td>
												<td><?php echo ($letter_details['hra']*12);?></td>
										</tr>
										<tr>
												<td>Conveyance</td>
												<td><?php echo $letter_details['conveyance'];?></td>
												<td><?php echo ($letter_details['conveyance']*12);?></td>
										</tr>
										<tr>
												<td>Medical Reimbursement</td>
												<td><?php echo $letter_details['medical_reimbursement'];?></td>
												<td><?php echo ($letter_details['medical_reimbursement']*12);?></td>
										</tr>
										<tr>
												<td>Special Allowance</td>
												<td><?php echo $letter_details['special_allowance'];?></td>
												<td><?php echo ($letter_details['special_allowance']*12);?></td>
										</tr>
										<tr>
												<td>Other Allowance</td>
												<td><?php echo $letter_details['other_allowance'];?></td>
												<td><?php echo ($letter_details['other_allowance']*12);?></td>
										</tr> 
										<tr class="gross" style="background: #ecbfbf;">
												<td>Gross Salary</td>
												<td><?php echo $letter_details['gross_salary'];?></td>
												<td><?php echo ($letter_details['gross_salary']*12);?></td>
										</tr>
										<tr>
												<td>Employee PF @ 12%</td>
												<td><?php echo $letter_details['emp_pf'];?></td>
												<td><?php echo ($letter_details['emp_pf']*12);?></td>
										</tr>
										<tr>
												<td>Employee ESIC @ 1.75%</td>
												<td><?php echo $letter_details['emp_esic'];?></td>
												<td><?php echo ($letter_details['emp_esic']*12);?></td>
										</tr>
										<tr>
												<td>PT</td>
												<td><?php echo $letter_details['pt'];?></td>
												<td><?php echo ($letter_details['pt']*12);?></td>
										</tr>
										<tr>
												<td>Total Deduction</td>
												<td><?php echo $letter_details['total_deduction'];?></td>
												<td><?php echo ($letter_details['total_deduction']*12);?></td>
										</tr> 
										<tr class="gross" style="background: #ecbfbf;">
												<td>Take-home</td>
												<td><?php echo ($letter_details['take_home']);?></td>
												<td><?php echo (($letter_details['take_home'])*12);?></td>
										</tr>
										<tr>
												<td>Employer PF</td>
												<td><?php echo $letter_details['employer_pf'];?></td>
												<td><?php echo ($letter_details['employer_pf']*12);?></td>
										</tr>
										<tr>
												<td>Employer ESIC</td>
												<td><?php echo $letter_details['employer_esic'];?></td>
												<td><?php echo ($letter_details['employer_esic']*12);?></td>
										</tr>
										<tr class="gross" style="background: #ecbfbf;">
												<td>CTC</td>
												<td><?php echo ($letter_details['ctc']);?></td>
												<td><?php echo (($letter_details['ctc'])*12);?></td>
										</tr>
									</tbody>
								</table>
								<table style="border-collapse:collapse;width:100%;margin-bottom:0px;">
									<tbody>
										<tr>
											<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
												<p style="line-height:1.8;font-size:14px">	
												<br><b>For : Fretus Folks India Pvt Ltd.</b>  <br>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
												<br><b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br></p>
											</td>
											<td style="font-size:12px;text-align:left;padding:7px;width:40%">
													<p style="line-height:1.8;font-size:14px">	
													<br>
													<b>I accept:</b> <br><br><br>
													<b>Signature and Date</b> <br>
													</p>
											</td>
										</tr>
									</tbody>
								</table>
							</center>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	 <!-- <img class="abc" src="admin_assets/ffi_footer.jpg" style="padding-top: 8%;">	 -->
</body>
     
</html>
<?php
   }
   else
   {
   	echo "Your Increment Letter Not Available.....!";
   }
   ?>