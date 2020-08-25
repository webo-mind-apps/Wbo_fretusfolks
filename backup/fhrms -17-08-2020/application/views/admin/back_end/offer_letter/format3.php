<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
					<meta content="telephone=no" name="format-detection" />
					<title>Fretus Folks</title>
					
					<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
					<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
					<style>
					p{font-size:16px !important;margin-bottom:1%;text-align:justify;line-height:27px;font-family: 'Open Sans', sans-serif;}
					ol, ul{font-size:16px !important;margin-bottom:1%;text-align:justify;font-family: 'Open Sans', sans-serif;}
					li{margin-bottom:1%;text-align:justify;font-family: 'Open Sans', sans-serif;}
					h4{padding-top:1%;font-family: 'Open Sans', sans-serif;text-decoration:underline;font-weight:bold;}
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
					</style>
				</head>
	<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
											<tr>
												
												<td style="padding-left:5%;padding-right:5%;">
													
													<div>
														<div style="color:#000;font-size: 21px;margin-top: 4%;margin-bottom: 5%;">
																											
														<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
															<div><br>
																<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
																	<tbody>
																	  <tr>
																		<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
																				<p style="line-height:1.8;font-size:18px !important;">	
																				<b>E code :</b><?php echo $letter_details[0]['ffi_emp_id'];?><br>
																				
																		  </td>
																		 
																		<td style="font-size:12px;text-align:left;padding:7px;width:30%">
																			<p style="line-height:1.8;font-size:14px">
																			<b>Date :  <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?><b></a></p>
																			</td>
																	  </tr>
																	</tbody>
																</table>
																
															</div>
														</div>
														<h2 style="text-align:center;text-decoration:underline;">OFFER LETTER</h2>
											<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
												
												<br>
												<p style="font-size:12px;line-height:1.8;"><b>To,
Mr.<?php echo $letter_details[0]['emp_name'];?></br>
S/o <?php echo $letter_details[0]['father_name'];?></br>
<?php echo $letter_details[0]['location'];?></br>
</b><br>
</p>
												<p style="margin-left:0%;">
												
													We are pleased to offer you employment at <b><?php echo $letter_details[0]['client_name'];?></b> for a fixed period of employment as per the following terms: 
												</p>
												
												<div style="margin-top: 3% !important;">
												<h4>DEPUTATION:</h4>
												<p style="font-size:12px;line-height:1.5;margin-top: 1% !important;">
												You are deputed to <b><?php echo $letter_details[0]['client_name'];?></b> under this contract. The terms of employment is exclusively with <b><?php echo $letter_details[0]['client_name'];?></b> which are summarised as under.

										</br>You will with effect from be deputed by <b><?php echo $letter_details[0]['client_name'];?></b> to work at client's office / premises at any of their locations.
										</p>
										</div>
										
									<br>
												<p style="font-size:12px;line-height:1.8;">
													<h4>TENURE:</h4>
													<p>The term of your Contract shall be valid from <b><?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?> to <?php echo date("d-m-Y",strtotime($letter_details[0]['contract_date']));?></b> .</p>
											
													
													<h4>COTERMINOUS:</h4>
													<p>Notwithstanding the Tenure of this Contract, in the event of the project / work / deputation for which you are being employed terminates before your Contract end period, this Contract shall be coterminous with the project / work.

														</br>You are required to work at client's location at <b><?php echo $letter_details[0]['location'];?></b>
														</p>
											<br>
												<h4>POSITION:</h4>
													<p>You are appointed as <b><?php echo $letter_details[0]['designation'];?></b>.</p>
												
												
												<h4>TRANING: </h4>
													<p>You will have to undergo with an On The Job Training (OJT) for 4 days. During this period the 
												company will not assign any work. This training will be given to only enhance your knowledge and skills about the work to be performed. The Payment of that 4 days of training period will be provided to you once you complete  3 Months in the system.</br>
												In case you have not been certified in 4 days training then this Letter stands null and Void.
												</p>
												
												<br><br>	
												<br><h4>REMUNERATION:</h4>
													<p>The details of your salary break up with components are as per the enclosure attached herewith in annexture – A.</p>
												
												
												<h4>EXTENSION:</h4>
													<p>Unless otherwise notified to you in writing this contract of employment would be valid till  from the date of your joining <b><?php echo $letter_details[0]['client_name'];?></b>
											</br>This contract may be considered for an extension depending on the client and <b><?php echo $letter_details[0]['client_name'];?></b> requirements. The extension of contract period would be considered on fresh terms as agreed between you and <b><?php echo $letter_details[0]['client_name'];?></b> through a separate mutually executed contract of employment. Fretus Folks India Pvt Ltd. shall inform you in writing of the extension requirements, if any.
											</p>
												
											
												<h4>WORKING HOURS:</h4>
													<p>You will follow the working hours of the client where you will be deputed. You may have to work on shifts, based on the client's requirement. Your attendance will be maintained by the Reporting Officer of the client, who shall at the end of the month share the attendance with the contact person at <b><?php echo $letter_details[0]['client_name'];?></b> for pay-roll processing.</p>	
												
												
													
												<h4>TERMINATION & SUSPENSION:</h4>
													<p>At the time of termination of the employment either due to termination by either you or the Company or upon the lapse of the term of employment, if there are any dues owing from you to the Company, the same may be adjusted against any money due to you by the Company on account of salary including bonus or any other payment owned to you under the terms of your employment.  

							</br>During the tenure of your Contract, any deviation or misconduct in any form that were noticed by the company  or if there are any breach of internal policies or any regulation that was mutually agreed to be complied with, <b><?php echo $letter_details[0]['client_name'];?></b> or principal employer has the rights and authority to suspend your services until you are notified to resume work in writing. <b><?php echo $letter_details[0]['client_name'];?></b> reserves all such right to withheld full or a portion of your salary during such suspension period.
							</p>	
												
												
												<h4>NOTICE PERIOD:</h4>
													<p>In the eventuality if you wish to separate from the organization you will need to serve 7day's notice in writing or 7 day's basic pay in lieu thereof, in case you have not completed 3 months time working with our client. In case you have completed more than 3 months time working with our client than you will have to serve 15 days notice period in writing or 15 day's basic pay in lieu thereof. The Contract can be terminated at the discretion of , <b><?php echo $letter_details[0]['client_name'];?></b> subject to 7 day's notice.

								</br>However due to breach of code of conduct, misbehavior  or indiscipline etc, then in such cases, <b><?php echo $letter_details[0]['client_name'];?></b> will have / reserve rights to terminate immediately without giving notice period.
								</p>	
										
											<br><br>	<br><br><br>
											<h4>INDEMNITY:</h4>
													<p>You shall be responsible for protecting any property of the Client entrusted to you in the due discharge of your duties and you shall indemnify the Client if there is a loss of any kind to the said property.
</br>To the fullest extent permitted by the Applicable Law, you shall hold the Client, its agents, employees and assigns, free and harmless and indemnify and defend Client from and against any and all suits, actions, proceedings, claims, demands, liabilities, costs and charges, legal expenses, damages or penalties of any nature actually or allegedly arising out of or related to your services at the Location or to any alleged actions or omissions by you, including, but not limited to, those resulting from, or claimed to result from injury, death or damage to you.
</p>					
												
												
									<h4>TRANSFER:</h4>
					<p>You are liable to be transferred to any other department of the Client or <b><?php echo $letter_details[0]['client_name'];?></b> or at any other branches across India in which the client or ARCOS or any of the employer subsidiary company has any kind of interest. That also upon such transfer, the present terms and conditions shall be applicable, to such a post or at the place of transfer.</p>				
												
												
										<h4>CODE OF CONDUCT:</h4>
					<p>You shall not engage in any act subversive of discipline in the course of your duty/ies for the Client either within the Client's organization or outside it, and if you were at any time found indulging in such act/s, the Company shall reserve the right to initiate disciplinary action as is deemed fit against you.</p>				
												
												
											<h4>ADDRESS FOR COMMUNICATION:</h4>
					<p>The address of communication for the purpose of service of notice and other official communication to the company shall be the registered address of the company which is, <b><?php echo $letter_details[0]['client_name'];?></b>  
</br>M 20, 3rd Floor, UKS Heights, Sector XI, Jeevan Bhima Nagar,Bangalore-560075. The address of communication and service of notice and other official communication is the address set out as above and your present residential address namely. In the event there is a change in your address, you shall inform the same in writing to the Management and that shall be the address last furnished by you, shall be deemed to be sufficient for communication and shall be deemed to be effective on you.
</p>				

					<h4>BACKGROUND VERIFICATION:</h4>
					<p>The company reserves the right to have your back ground verified directly or through an outside agency. If on such verification it is found that you have furnished wrong information or concealed any material information your services are liable to be terminated.</p>	

<br><br>	
		<h4>ABSENTEEISM:</h4>
					<p>You should be regular and punctual in your attendance. If you remain absent for 3 consecutive working days or more without sanction of leave or prior permission or if you over stay sanctioned leave beyond 3
consecutive working days or more it shall be deemed that you have voluntarily abandonment your employment with the company and your services are liable to be terminated accordingly.
</p>	



		<h4>RULES AND REGULATIONS:</h4>
	<p>You shall be bound by the Rules & Regulations framed by the company from time to time in relation to conduct, discipline and other service conditions which will be deemed as Rules, Regulation and order and shall form part and parcel of this letter of appointment.</p>	


	<h4>OTHER TERMS OF CONTRACT:</h4>
	<p>In addition to the terms of appointment mentioned above, you are also governed by the standard employment rules of ,<b><?php echo $letter_details[0]['client_name'];?></b> (as per Associate Manual). The combined rules and procedures as contained in this letter will constitute the standard employment rules and you are required to read both of them in conjunction.</p>	

	<h4>JURISDICTION:</h4>
	<p>Notwithstanding the place of working or placement or the normal or usual residence of the employee concerned or the place where this instrument is signed or executed this Contract shall only be subject to the jurisdiction of the High Court of Judicature of <b><b><?php echo $letter_details[0]['location'];?></b></b> and its subordinate Courts</p>	

<h4>DEEMED CANCELLATION OF CONTRACT:</h4>
	<p>The Contract stands cancelled and revoked if you do not report to duty within 3 days from the date of joining & your act will be construed as deemed and implied rejection of the offer of employment from your side; hence no obligation would arise on the part of the company in lieu of such Employment Contract issued.
</br>You are requested to bring the following documents at the time of joining: 
</p>	

<ol>
<li>Educational Certificates for 10th and 12 standard or the highest qualification held by you.</li>
 <li>Experience Letter / Relieving letter of the past company, if any.</li>
   <li> Latest month pay slip,if any.</li>
  <li>Photo ID proof (Aadhar Card/Driving Licence/Election I-Card/Passport/Pan Card)</li>
 <li>Address Proof  (Aadhar Card/Driving Licence/Election I-Card/Passport/Pan Card)</li>
    <li> passport size photographs  </li>

 	  <li> PAN card, if any.</li>
 <li> UAN Card, if any.</li>
   <li> Aadhaar Card</li>
</ol>

<p>
Here's wishing you the very best in your assignment with us and as a token of your understanding and accepting of the standard terms of employment, you are requested to sign the duplicate copy of this letter and return to us within a day. 
</br>
With warm regards,
</p>

												
														<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr>
																<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
																		<p style="line-height:1.8;font-size:14px">	
																		Yours faithfully,<br>
																		<b>For : <b><?php echo $letter_details[0]['client_name'];?></b></b> <br> <br>
																		<b>Authorized Signatory</b> <br>
																		</p>
																  </td>
																 
																
															  </tr>
															</tbody>
														</table>
											
												
											</div>
											<br><br><br>	
											<br><br><br>	
											<br><br><br>
											<br><br><br>	
											<br><br><br>	
											<br><br><br>											
											<br><br><br>											
											<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
												<h1 style="font-size:20px;text-align:center;text-decoration: underline;">Annexure A </h1>
												<h2  style="font-size:18px;text-align:left;">Compensation Sheet </h2>
												
												
												
												
												
													<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
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
																<td><?php echo $letter_details[0]['hra'];?></td>
																<td><?php echo ($letter_details[0]['hra']*12);?></td>
															  </tr>
															   <tr>
																<td>HRA</td>
																<td><?php echo $letter_details[0]['conveyance'];?></td>
																<td><?php echo ($letter_details[0]['conveyance']*12);?></td>
															  </tr>
															   <tr>
																<td>Conveyance</td>
																<td><?php echo $letter_details[0]['medical_reimbursement'];?></td>
																<td><?php echo ($letter_details[0]['medical_reimbursement']*12);?></td>
															  </tr>
															 
															   <tr>
																<td>Special Allowance</td>
																<td><?php echo $letter_details[0]['special_allowance'];?></td>
																<td><?php echo ($letter_details[0]['special_allowance']*12);?></td>
															  </tr>
															   
															  <tr style="background-color:pink;">
																<td>Gross Salary</td>
																<td><?php echo $letter_details[0]['gross_salary'];?></td>
																<td><?php echo ($letter_details[0]['gross_salary']*12);?></td>
															  </tr>
															  
															  <tr>
																<td>Employee PF @ <?php echo $letter_details[0]['pf_percentage'];?>%</td>
																<td><?php echo $letter_details[0]['emp_pf'];?></td>
																<td><?php echo ($letter_details[0]['emp_pf']*12);?></td>
															  </tr>
															  <tr>
																<td>Employee ESIC  PF @ <?php echo $letter_details[0]['esic_percentage'];?>%</td>
																<td><?php echo $letter_details[0]['emp_esic'];?></td>
																<td><?php echo ($letter_details[0]['emp_esic']*12);?></td>
															  </tr>
															  
															  <tr>
																<td>PT</td>
																<td><?php echo $letter_details[0]['pt'];?></td>
																<td><?php echo ($letter_details[0]['pt']*12);?></td>
															  </tr>
															  <tr>
																<td>Total Deduction</td>
																<td><?php echo $letter_details[0]['total_deduction'];?></td>
																<td><?php echo ($letter_details[0]['total_deduction']*12);?></td>
															  </tr> 
															 <tr class="gross" style="background: #ecbfbf;">
																<td>Take-home</td>
																<td><?php echo ($letter_details[0]['gross_salary']-$letter_details[0]['total_deduction']);?></td>
																<td><?php echo (($letter_details[0]['gross_salary']-$letter_details[0]['total_deduction'])*12);?></td>
															  </tr>
															  
															   <tr>
																<td>Employer PF @ <?php echo $letter_details[0]['employer_pf_percentage'];?>%</td>
																<td><?php echo $letter_details[0]['employer_pf'];?></td>
																<td><?php echo ($letter_details[0]['employer_pf']*12);?></td>
															  </tr>
															  <tr>
																<td>Employer ESIC  PF @ <?php echo $letter_details[0]['employer_esic_percentage'];?>%</td>
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
											</div>
											</br>
											<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr>
																<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
																	<p ><b>Signature</b></p>
																	<p ><b>Name: <?php echo $letter_details[0]['emp_name'];?> </b></p>	
																	<p ><b>Designation:  <?php echo $letter_details[0]['designation'];?></b></p>	
																	<p ><b>Ref. No. : <?php echo $letter_details[0]['ffi_emp_id'];?>	</b></p>
																	</br>
																 </td>
																</tr>
															</tbody>
														</table>
														<br><br>
														<br><br>
														<br><br>
												<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr>
																<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
													<p><b>To,</br>
														<b><?php echo $letter_details[0]['client_name'];?></b>,</b></br>
														M 20, 3rd Floor, UKS Heights, </br>
														Sector XI, Jeevan Bhima Nagar </br>
														Bangalore-560075                   
														</p>
																  </td>
																 
																<td style="font-size:12px;text-align:left;padding:7px;width:22%">
																	<p style="line-height:1.8;font-size:14px">	
																	
																		<b>  Date :- <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?></b> <br>
																		
																		</p>
																</td>
															  </tr>
															</tbody>
														</table>
										
														
														<p><b> Subject :- Acknowledgement and receipt of Offer Letter</b></p>
														<p>Dear Sir,</p>
														
														<p>I have read and understood the above mentioned terms and conditions of the Contract. I voluntarily accept the same. I have received <b><?php echo $letter_details[0]['client_name'];?></b> Associate Manual and I shall abide to the terms and conditions mentioned therein and any amendments from time to time. 

<br>On receipt of the first salary, all terms & conditions in this fixed term employment contract would be deemed as acknowledged & accepted. 
</p>
						
</br></br>

<p><b>Name: <?php echo $letter_details[0]['emp_name'];?></br>

Signature:..........................</br>

Place:  <?php echo $letter_details[0]['location'];?></br>          
Date:<?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?></br>
</b></p>						
														</div>
														<br>
													</div>
												</td>
											</tr>
										</tbody>
										</table>
	</body>
</html>