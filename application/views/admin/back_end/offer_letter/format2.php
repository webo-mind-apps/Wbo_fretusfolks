<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <meta content="telephone=no" name="format-detection" />
      <title>Fretus Folks</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
         }
         @media print 
         {
         @page { margin-top: 0; }
         @page { margin-left: 0; }
         @page { margin-right: 0; }
         @page { margin-bottom: 0; }
         .abc
         {
         width: 100%;
         }
         }
      </style>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body onload="window.print();" class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="padding-left:5%;padding-right:5%;">
                  <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
                  <div>
                     <div style="color:#000;font-size: 21px;margin-top: 2%;margin-bottom: 5%;">
                        <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                           <div>
                              <table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
                                 <tbody>
                                    <tr>
                                       <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                                          <p style="line-height:1.8;font-size:14px !important;">	
										   <b>Offer No : <?php echo $letter_details[0]['ffi_emp_id'];?></b> <br>
                                           
                                       </td>
                                       <td style="font-size:12px;text-align:left;padding:7px;width:30%">
                                          <p style="line-height:1.8;font-size:14px">
                                             <b>Date :  <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?><b></a>
                                          </p>
                                    </tr>
									
                                 </tbody>
                              </table> 
                           </div>
                        </div>
                        <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
								<h4 style="text-align: center;text-decoration: underline;">OFFER CUM APPOINTMENT LETTER</h4>
								<p style="line-height:1.8;font-size:14px !important;">
									<b>To,</b> <br> 
									<b>Mr. /Mrs. /Ms. : <?php echo $letter_details[0]['emp_name'];?></b> <br> 
									<b>S/o  <?php echo $letter_details[0]['father_name'];?></b> <br> 
									<b>Location : <?php echo $letter_details[0]['location'];?></b> <br>
								</p><br/>
							<p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							  We are pleased to offer you employment at <b>Fretus Folks India Pvt Ltd.</b> for a fixed period of employment as per the following terms: 
							 </span>	
                           </p> <br/>
						   
						   <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							 <b style="text-decoration: underline;"> DEPUTATION:</b> You are deputed to <b><?php echo $letter_details[0]['client_name'];?></b> under this contract. The terms of employment is exclusively with <b>Fretus Folks India Pvt Ltd.</b> which are summarised as under.
							 </span>
                           </p><br> 
						   
						    <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							  You will with effect from be deputed by <b>Fretus Folks India Pvt Ltd.</b> to work at client's office / premises at any of their locations.
							 </span>
                           </p><br>
                           
						   <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							  <b style="text-decoration: underline;"> TENURE:</b> The term of your Contract shall be valid for 10 months from the date of joining.
							 </span>
                           </p><br>
						   
						   <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							<b style="text-decoration: underline;">COTERMINOUS:</b> Not with standing the Tenure of this Contract, in the event of the project / work / deputation for which you are being employed terminates before your Contract end period, this Contract shall be coterminous with the project / work.
							 </span>
                           </p><br>
						   
						   <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							  You are required to work at client's location at <b><?php echo $letter_details[0]['branch'];?></b>, <b><?php echo $letter_details[0]['location'];?></b>.
							 </span>
                           </p><br>
						   
						    <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							<b style="text-decoration: underline;">POSITION:</b> You are appointed as <b><?php echo $letter_details[0]['designation'];?></b>.
							 </span>
                           </p><br>
						   
						    <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							<b style="text-decoration: underline;">TRANING:</b> You will have to undergo with an On The Job Training (OJT) for 4 days. During this period the 
							company will not assign any work. This training will be given to only enhance your knowledge and skills about the work to be performed. The Payment of that 4 days of training period will be provided to you once you complete  3 Months in the system.
							In case you have not been certified in 4 days training then this Letter stands null and Void. </span>
                           </p><br>
						   
						    <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							<b style="text-decoration: underline;">REMUNERATION:</b><br/>
							The details of your salary break up with components are as per the enclosure attached here with in annexture – A. 
							 </span>
                           </p><br>
						   
						   <p style="font-size:12px;line-height:1.8;">  
                              <span style="margin-left:0%;"> 
							<b style="text-decoration: underline;">EXTENSION:</b> 
								Unless otherwise notified to you in writing this contract of employment would be valid till  from the date of your joining <b>Fretus Folks India Pvt Ltd.</b><br/>
								This contract may be considered for an extension depending on the client and <b>Fretus Folks India Pvt Ltd.</b> requirements. The extension of contract period would be considered on fresh terms as agreed between you and <b>Fretus Folks India Pvt Ltd</b>. through a separate mutually executed contract of employment. <b>Fretus Folks India Pvt Ltd.</b> shall inform you in writing of the extension requirements, if any.

							 </span>
                           </p>
                        </div>
               </td>
            </tr>
         </tbody>
      </table>
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:3.94%;">
      <br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
      <td style="padding-left:5%;padding-right:5%;">
      <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
      <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
      <br>
      <br> 
	  
		<p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">WORKING HOURS:</b> You will follow the working hours of the client where you will be deputed. You may have to work on shifts, based on the client's requirement. Your attendance will be maintained by the Reporting Officer of the client, who shall at the end of the month share the attendance with the contact person at <b>Fretus Folks India Pvt Ltd.</b> for pay-roll processing.  
			 </span>
	   </p><br>
	   
	   <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">TERMINATION & SUSPENSION:</b> At the time of termination of the employment either due to termination by either you or the Company or upon the lapse of the term of employment, if there are any dues owing from you to the Company, the same may be adjusted against any money due to you by the Company on account of salary including bonus or any other payment owned to you under the terms of your employment.  <br/>
			During the tenure of your Contract, any deviation or misconduct in any form that were noticed by the company  or if there are any breach of internal policies or any regulation that was mutually agreed to be complied with, <b>Fretus Folks India Pvt Ltd.</b> or principal employer has the rights and authority to suspend your services until you are notified to resume work in writing. <b>Fretus Folks India Pvt Ltd.</b> reserves all such right to withheld full or a portion of your salary during such suspension period.
  
			 </span>
	   </p><br>
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">NOTICE PERIOD:</b> In the eventuality if you wish to separate from the organization you will need to serve 7day's notice in writing or 7 day's basic pay in lieu thereof, in case you have not completed 3 months time working with our client. In case you have completed more than 3 months time working with our client than you will have to serve 15 days notice period in writing or 15 day's basic pay in lieu thereof. The Contract can be terminated at the discretion of , <b>Fretus Folks India Pvt Ltd.</b> subject to 7 day's notice.<br/>
			However due to breach of code of conduct, misbehavior  or indiscipline etc, then in such cases, <b>Fretus Folks India Pvt Ltd.</b> will have / reserve rights to terminate immediately without giving notice period.

  
			 </span>
	   </p><br>
	   
	   <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">INDEMNITY:</b> You shall be responsible for protecting any property of the Client entrusted to you in the due discharge of your duties and you shall indemnify the Client if there is a loss of any kind to the said property.To the fullest extent permitted by the Applicable Law, you shall hold the Client, its agents, employees and assigns, free and harmless and indemnify and defend Client from and against any and all suits, actions, proceedings, claims, demands, liabilities, costs and charges, legal expenses, damages or penalties of any nature actually or allegedly arising out of or related to your services at the Location or to any alleged actions or omissions by you, including, but not limited to, those resulting from, or claimed to result from injury, death or damage to you.
			 </span>
	   </p><br> 

	   <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">TRANSFER:</b> You are liable to be transferred to any other department of the Client or <b>Fretus Folks India Pvt Ltd.</b> or at any other branches across India in which the client or ARCOS or any of the employer subsidiary company has any kind of interest. That also upon such transfer, the present terms and conditions shall be applicable, to such a post or at the place of transfer.
			 </span>
	   </p><br>
	   
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">CODE OF CONDUCT:</b> You shall not engage in any act subversive of discipline in the course of your duty/ies for the Client either within the Client's organization or outside it, and if you were at any time found indulging in such act/s, the Company shall reserve the right to initiate disciplinary action as is deemed fit against you.
			 </span>
	   </p><br>
	   
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;"> ADDRESS FOR COMMUNICATION:</b> The address of communication for the purpose of service of notice and other official communication to the company shall be the registered address of the company which is, <b>Fretus Folks India Pvt Ltd. No.&nbsp; M 20,3rd Floor,&nbsp; UKS Heights,Sector XI, &nbsp;Jeevan Bhima Nagar, &nbsp;Bangalore-560075.</b> The address of communication and service of notice and other official communication is the address set out as above and your present residential address namely.In the event there is a change in your address, you 
			 </span>
	   </p> 
	    
      </div>	 
      </td></tr></tbody></table>
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:6.38%;">
      <br><br>
	    
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
      <td style="padding-left:5%;padding-right:5%;">
      <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
      <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
      <br><br>	
	  
	  <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;">shall inform the same in writing to the Management and that shall be the address last furnished by you, shall be deemed to be sufficient for communication and shall be deemed to be effective on you.
			 </span>
	   </p><br> 
	   
	   <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">BACKGROUND VERIFICATION:</b> The company reserves the right to have your back ground verified directly or through an outside agency. If on such verification it is found that you have furnished wrong information or concealed any material information your services are liable to be terminated.
			 </span>
	   </p><br>
	   
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">ABSENTEEISM:</b> You should be regular and punctual in your attendance. If you remain absent for 3 consecutive working days or more without sanction of leave or prior permission or if you over stay sanctioned leave beyond 3
			consecutive working days or more it shall be deemed that you have voluntarily abandonment your employment with the company and your services are liable to be terminated accordingly. 
			 </span>
	   </p><br>	   
	   
	   <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">RULES AND REGULATIONS:</b> You shall be bound by the Rules & Regulations framed by the company from time to time in relation to conduct, discipline and other service conditions which will be deemed as Rules, Regulation and order and shall form part and parcel of this letter of appointment.
			 </span>
	   </p><br>
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">OTHER TERMS OF CONTRACT:</b> In addition to the terms of appointment mentioned above, you are also governed by the standard employment rules of , <b>Fretus Folks India Pvt Ltd.</b> (as per Associate Manual). The combined rules and procedures as contained in this letter will constitute the standard employment rules and you are required to read both of them in conjunction.
			 </span>
	   </p><br>
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">JURISDICTION:</b>Not with standing the place of working or placement or the normal or usual residence of the employee concerned or the place where this instrument is signed or executed this Contract shall only be subject to the jurisdiction of the High Court of Judicature of <b>Delhi At Delhi</b> and its subordinate Courts.
			 </span>
	   </p><br>
	   
	    <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b style="text-decoration: underline;">DEEMED CANCELLATION OF CONTRACT:</b> The Contract stands cancelled and revoked if you do not report to duty within 3 days from the date of joining & your act will be construed as deemed and implied rejection of the offer of employment from your side; hence no obligation would arise on the part of the company in lieu of such Employment Contract issued.
			 </span>
	   </p><br>	   
	   
	   <p style="font-size:12px;line-height:1.8;">  
		  <span style="margin-left:0%;"> 
			<b>You are requested to bring the following documents at the time of joining:</b><br/>
			<span style="margin-left:1%;">
			 1.  Educational Certificates for 10th and 12 standard or the highest qualification held by you.<br/></span>	
			<span style="margin-left:1%;">
			 2.  Experience Letter / Relieving letter of the past company, if any.<br/></span>	
			 <span style="margin-left:1%;">
			 3.  Latest month pay slip,if any.<br/></span>	
			 <span style="margin-left:1%;">
			 4.  Photo ID proof (Aadhar Card/Driving Licence/Election I-Card/Passport/Pan Card).<br/></span>
			 <span style="margin-left:1%;">
			 5.  Address Proof  (Aadhar Card/Driving Licence/Election I-Card/Passport/Pan Card).<br/></span>
			 <span style="margin-left:1%;">
			 6.  5 passport size photographs <br/></span>
			 <span style="margin-left:1%;">
			 7.  PAN card, if any.<br/></span>
			 <span style="margin-left:1%;">
			 8.  UAN Card, if any.<br/></span>
			 <span style="margin-left:1%;">
			 9.  Aadhaar Card.<br/></span>			
		</span>
	   </p> <br/>
	   <br>
	   <br>
	   
      </div>	 
      </td></tr></tbody></table>
        <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:7.75%;">
      <br><br>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
      <td style="padding-left:5%;padding-right:5%;">
      <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
      <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
       
      <br><br>	
		
		<p style="font-size:12px;line-height:1.8;"><br>
		<span style="margin-left:0%;">
       	Here's wishing you the very best in your assignment with us and as a token of your understanding and accepting of the standard terms of employment, you are requested to sign the duplicate copy of this letter and return to us within a day.</span><br/><br/>    
		<span style="margin-left:0%;">With warm regards,
        </span>		
      </p>
 
      <table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
      <tbody>
      <tr>
      <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
      <p style="line-height:1.8;font-size:14px">      
      <b>For : Fretus Folks India Pvt Ltd.</b> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url()?>admin_assets/seal.png" style="margin-top:2%;" width="100"><br>
      <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
      </p>
      </td>
      <td style="font-size:12px;text-align:left;padding:7px;width:40%">
      <p style="line-height:1.8;font-size:14px">	
      <br>
     
      
      </p>
      </td>
      </tr>
      </tbody>
      </table>
      </div>
     
      </td>
      </tr>
      </tbody>
      </table> 
	  <br><br><br><br>
	  <br><br><br><br>
      <br><br><br><br>
	  <br><br><br><br>
	  <br><br><br><br>
	  <br><br><br><br>
	  <br><br><br> 
	  
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:1%;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
      <td style="padding-left:5%;padding-right:5%;">
      <div style="color: #000;font-family: Tahoma;font-size: 10px;line-height: 1.5px;text-align: justify; padding-left: 0%;">
      <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
      <h1 style="font-size:17px;text-align:center;text-decoration: underline;">Annexure - A</h1>
	  
		
	 	<p style="line-height:1.8;font-size:14px !important;">	
			<span style="margin-left:10%;text-decoration:underline;"><b>Compensation Sheet <br></span>
			<span style="margin-left:10%;"><b>Offer No : <?php echo $letter_details[0]['ffi_emp_id'];?></b> <br></span>
			<span style="margin-left:10%;"><b>Associate Name : <?php echo $letter_details[0]['emp_name'];?></b> <br></span>
			<span style="margin-left:10%;"><b>Designation : <?php echo $letter_details[0]['designation'];?></b> <br></span>
			<span style="margin-left:10%;"><b>Location : <?php echo $letter_details[0]['location'];?></b> <br></span>
		</p><br/><br/><br/>
      <center>
	  
      <table class="table table1" border="1" style="border-collapse:collapse;width:80%;margin-bottom:5px;">
      <tbody>
      <tr>
      <th style="font-size:10px;text-align:left;padding:3px;border-top: 1px solid #000;">
      Components	
      </th>
      <th style="font-size:10px;text-align:left;padding:3px;width:30%;border-top: 1px solid #000;">
      Monthly salary
      </th>
      <th style="font-size:10px;text-align:left;padding:3px;width:30%;border-top: 1px solid #000;">
      Annual salary
      </th>
      </tr>
      <tr>
      <td>Basic</td>
      <td><?php echo $letter_details[0]['basic_salary'];?></td>
      <td><?php echo ($letter_details[0]['basic_salary']*12);?></td>
      </tr>
      <tr>
      <td>HRA</td>
      <td><?php echo $letter_details[0]['hra'];?></td>
      <td><?php echo ($letter_details[0]['hra']*12);?></td>
      </tr>
      <tr>
      <td>Conveyance</td>
      <td><?php echo $letter_details[0]['conveyance'];?></td>
      <td><?php echo ($letter_details[0]['conveyance']*12);?></td>
      </tr>
      <!--<tr>
      <td>Medical Reimbursement</td>
      <td><?php echo $letter_details[0]['medical_reimbursement'];?></td>
      <td><?php echo ($letter_details[0]['medical_reimbursement']*12);?></td>
      </tr>
      <tr>
      <td>Special Allowance</td>
      <td><?php echo $letter_details[0]['special_allowance'];?></td>
      <td><?php echo ($letter_details[0]['special_allowance']*12);?></td>
      </tr> -->
      <tr>
      <td>Other Allowance</td>
      <td><?php echo $letter_details[0]['other_allowance'];?></td>
      <td><?php echo ($letter_details[0]['other_allowance']*12);?></td>
      </tr> 
      <tr style="background-color:pink;">
      <td>Gross Salary</td>
      <td><?php echo $letter_details[0]['gross_salary'];?></td>
      <td><?php echo ($letter_details[0]['gross_salary']*12);?></td>
      </tr>
      <tr>
      <td>Employee PF @ 12%</td>
      <td><?php echo $letter_details[0]['emp_pf'];?></td>
      <td><?php echo ($letter_details[0]['emp_pf']*12);?></td>
      </tr>
      <tr>
      <td>Employee ESIC  PF @ 1.75%</td>
      <td><?php echo $letter_details[0]['emp_esic'];?></td>
      <td><?php echo ($letter_details[0]['emp_esic']*12);?></td>
      </tr>
      <tr>
      <td>PT</td>
      <td><?php echo $letter_details[0]['pt'];?></td>
      <td><?php echo ($letter_details[0]['pt']*12);?></td>
      </tr>
      <tr>
      <td   style="background: #ecbfbf;">Total Deduction</td>
      <td style="background: #ecbfbf;"><?php echo $letter_details[0]['total_deduction'];?></td>
      <td style="background: #ecbfbf;"><?php echo ($letter_details[0]['total_deduction']*12);?></td>
      </tr> 
      <tr class="gross" style="background: #ecbfbf;">
      <td>Take-home</td>
      <td><?php echo ($letter_details[0]['take_home']);?></td>
      <td><?php echo (($letter_details[0]['take_home'])*12);?></td>
      </tr>
      <tr>
      <td>Employer PF 13%</td>
      <td><?php echo $letter_details[0]['employer_pf'];?></td>
      <td><?php echo ($letter_details[0]['employer_pf']*12);?></td>
      </tr>
      <tr>
      <td>Employer ESIC @ 4.75%</td>
      <td><?php echo $letter_details[0]['employer_esic'];?></td>
      <td><?php echo ($letter_details[0]['employer_esic']*12);?></td>
      </tr>
      <tr class="gross" style="background: #ecbfbf;">
      <td>CTC</td>
      <td><?php echo ($letter_details[0]['ctc']);?></td>
      <td><?php echo (($letter_details[0]['ctc'])*12);?></td>
      </tr>
      </tbody>
      </table>
      </center>
      </div>
      <table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
      <tbody>
      <tr>
      <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
	  <br> <br/><br/>
	  
		<p><b>Signature</b></p> <br/> <br/>
		<p><b>Name:</b><?php echo $letter_details[0]['emp_name'];?></p>	<br/>
		<p><b>Designation:</b> <?php echo $letter_details[0]['designation'];?></p>	<br/>
      </td>
      <td style="font-size:12px;text-align:left;padding:7px;width:20%">
       
      </td>
      </tr>
      </tbody>
      </table>
      </div>
      </div>
      </td>
      </tr>
      </tbody>
      </table>
	  <br><br>
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:2%;">
	  <br> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
      <td style="padding-left:5%;padding-right:5%;">
      <div style="color: #000;font-family: Tahoma;font-size: 10px;line-height: 1.5px;text-align: justify; padding-left: 0%;">
      <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
       <br/>
		
	 	<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
		 <tbody>
			<tr>
			   <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
				  <p style="line-height:1.8;font-size:14px !important;">	
				   <b>Ref. No : <?php echo $letter_details[0]['ffi_emp_id'];?></b> <br>
				   
			   </td>
			   <td style="font-size:12px;text-align:left;padding:7px;width:30%">
				  <p style="line-height:1.8;font-size:14px">
					 <b>Date :  <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?><b></a>
				  </p>
			</tr>
			 
		 </tbody>
	  </table> 
       
	   <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
								 
		<p style="line-height:1.8;font-size:14px !important;">
			<b>To,</b> <br> 
			<b>Fretus Folks India Pvt Ltd.,</b><br> 
			M 20, 3rd Floor, UKS Heights, <br/>
			Sector XI, Jeevan Bhima Nagar, <br/>
			Bangalore-560075.                   
			</b><br> 
			 
		</p><br/>
	  
   <p style="font-size:12px;line-height:1.8;">  
	  <span style="margin-left:0%;"> 
	   <b>Subject :- Acknowledgement and receipt of Offer Letter</b>
	 </span>	
   </p> <br/>
   
   <p style="font-size:12px;line-height:1.8;">  
	  <span style="margin-left:0%;"> 
	  Dear Sir,<br/><br/>
	  I have read and understood the above mentioned terms and conditions of the Contract. I voluntarily accept the same. I have received <b>Fretus Folks India Pvt Ltd.</b> Associate Manual and I shall abide to the terms and conditions mentioned therein and any amendments from time to time. 
		<br/>
	On receipt of the first salary, all terms & conditions in this fixed term employment contract would be deemed as acknowledged & accepted.
	 </span>
   </p><br> <br> 
   
   
    <p style="font-size:12px;line-height:1.8;">  
	  <span style="margin-left:0%;"> 
		<p><b>Name:</b><?php echo $letter_details[0]['emp_name'];?></p>	<br/><br/>
		<p><b>Signature:<span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b></p><br/> <br/>
		
		<p><b>Place:</b> <?php echo $letter_details[0]['location'];?></p>	<br/>
		<p><b>Date:</b> <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?></p>	<br/>
	 </span>
   </p><br> 
	
</div>
						
      </div>
      
      </div>
      </div>
      </td>
      </tr>
      </tbody>
      </table>
	  <br/><br/><br/><br/><br/><br/>
	  <br/><br/><br/><br/><br/><br/>
	  
	<img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:5%;">  
	  
   </body>
</html>