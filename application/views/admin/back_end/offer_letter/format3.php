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
                  <div style="color:#000;font-size: 21px;margin-top: 1%;margin-bottom: 1%;">
                     <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                        <br>
                        <table style="border-collapse:collapse;width:100%;margin-bottom:5px;">
                           <tbody>
                              <tr>
                                 <td colspan="3" style="font-size:12px;text-align:left;padding:7px;width:70%">
                                    <p style="line-height:1.8;font-size:12px !important;">	
                                       
                                 </td>
                                 <td style="font-size:12px;text-align:left;padding:7px;width:30%">
                                    <p style="line-height:1.8;font-size:12px">
                                       <b>Date :  <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?>
                                       <b>
                                       </a>
                                    </p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <h1 style="font-size:18px;text-align:center;text-decoration:underline;">Appointment  letter</h1>
                  <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                     <p style="font-size:12px;line-height:1.8;"><b>To,<br/>
                        Mr. /Mrs. /Ms. <?php echo $letter_details[0]['emp_name'];?></br>
						<b>Emp  : <?php echo $letter_details[0]['ffi_emp_id'];?></b> <br> 
                      <b>Address : <?php echo $letter_details[0]['branch'];?></b> <br>   
                     <b>Location : <?php echo $letter_details[0]['location'];?></b> <br>
                        </b>
                     </p><br> 
                     <p style="font-size:12px;margin-left:0%;margin-top: 1% !important;">
                      <b> Dear <?php echo $letter_details[0]['emp_name'];?>,</b>   
                     </p>   
					 
                        <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
						   We are pleased to offer you employment to work as “<b><?php echo $letter_details[0]['designation'];?></b>” as on <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?></b>, on deputation with our client/s, <b><?php echo $letter_details[0]['client_name'];?></b>. for a fixed period of employment, on the following terms and conditions:
                        </p> 
						<br>
						 
						  <ol type="1" style="font-size:12px;line-height:1.8;">
                            <li>
							  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
							   You will be working at the site assigned from our client  <b><?php echo $letter_details[0]['client_name'];?></b>, under this probation if you are found guilty of activities such <b>as Cash mismanagement, Theft, Bike Meter tampering, Fake delivery, Disrespect to <?php echo $letter_details[0]['client_name'];?>. Employee and other delivery associate, irregularity at work,</b> Client is liable to separate you with immediate effect and we shall end your contract on the day of separation from client. 
								</p>  
							</li>
							
                             <li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								   Duration of your contract is 11 months.  
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								   Not with standing anything above, depending upon the afore mentioned project/work, the company reserves its right to extend your temporary appointment for such a period or periods as may be necessary depending upon the exigencies relatable to the work for which you are hereby engaged. The same shall be informed to you in advance. In the event, the company shall be in writing extend your temporary assignment on the terms as may be indicated in such extension of the assignment you shall be governed by such terms and conditions as may be indicated therein.
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								    You will be entitled for leaves as per shops and establishment act and other applicable laws in India.
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
									During the period of fixed contract of twelve months, your services could be deputed at the sole discretion of the management to any of our client’s company to do work pertaining to or incidental to the client’s business. Your service can be transferred from one location to another (within state) as per business requirement. 
								  </p> 
							</li>
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
									 In case of any adverse remarks found from the reference given by you, the documents submitted by you/outcome of the police verification report then this appointment will stand withdrawn immediately.
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								  You will not be absent from your duty without sufficient reasons, you will obtain prior written permission / sanction from the supervisor about your absence giving reasons thereof and probable duration immediately, failing which, the same will be treated as loss of Pay.
								  </p> 
							</li>
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								  <b>If you did not report to work for continuous 3 days</b> without proper notification of absenteeism, company is liable to end your contract on immediate basis, on request from client.
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								  Client holds the discretion to do a thorough background verification of your candidature as seems fit and can initiate police verification, background check, court cases verification.
								  </p> 
							</li>
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								  If you found guilty in any one of them, Client have the full authority to end your contract immediately and report the findings to nearest police station.
								  </p> 
							</li>
							
						</ol>
						<br>
                   
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
      <br>  <br>  
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:3.5%;">
    
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="padding-left:5%;padding-right:5%;">
                  <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                  <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">                 
                 <br><br>
                  
				  <ol type="1" start="11" style="font-size:12px;line-height:1.8;">
                            <li>
							  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
							   You will be governed by the conduct, discipline, rules and regulations as laid down by the management.
								</p>  
							</li>
							
                             <li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								  The salary will be paid to you, subject to the receipt of payment from <b><?php echo $letter_details[0]['client_name'];?></b>.  (to which you have been deputed). You will receive your salary on 7th of every month.
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								   This contract shall be terminable by either party giving 15 days’ notice in writing or salary on lieu of notice, to the other.
								  </p> 
							</li>
							
							<li>
								  <p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
								   You will be provided assets (mobile phone and uniform) during your work which has to be returned at the time of leaving company and on failing to submit the assets to the client amount will be deduct against the assets.
								  </p> 
							</li>  
						</ol>
						
						<p style="font-size:12px;line-height:1.5;margin-top: 1% !important;"> 
							We are consciously endeavoring to build an atmosphere of trust, openness, responsiveness, autonomy and growth among all members to the <b>Fretus Folks India Pvt Ltd.</b>. As a new entrant, we would like you to whole-heartedly contribute in this process.<br/>

							As a token of acceptance of the above terms and conditions, you are requested to sign the duplicate copy of this letter and return to us.<br/><br/>
							
							<span style="float:right;">With warm regards, </span>
						</p> 
                     </div>  
				  
               </td>
            </tr>
         </tbody>
      </table>
		<table style="border-collapse:collapse;width:100%;margin-bottom:20px;margin-left:4%;">
                        <tbody>
                           <tr>
                              <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                                 <p style="line-height:1.8;font-size:14px">	
                                  
                                    <b>For Fretus Folks India Pvt Ltd</b> <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url()?>admin_assets/seal.png" style="margin-top:2%;" width="100">
									<br>
                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                                 </p>
                              </td>
                           </tr>
                        </tbody>
                     </table>
					 
      </br></br> </br></br> </br> 
	    </br></br> </br></br> </br> 
		  </br></br> </br></br> </br> 
		</br></br> </br></br> </br> 
</br></br>  		
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-bottom:2.5%;">
     
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="padding-left:5%;padding-right:5%;">
                  <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;margin-top:-4%">
                <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
                  <div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 1.5;text-align: justify; padding-left: 0%;">
                     <h1 style="font-size:14px;text-align:center;text-decoration: underline;">Annexure Salary Break Up</h1>
                     
                     <center>
                        <table class="table table1" border="1" style="border-collapse:collapse;width:80%;margin-bottom:5px;font-size: 10px;">
                           <tbody>
                              <tr>
                                 <th style="font-size:10px;text-align:left;padding:7px;border-top: 1px solid #000;">
                                    Components	
                                 </th>
                                 <th style="font-size:10px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
                                    Monthly Rate
                                 </th>
                                  
                              </tr>
                              <tr>
                                 <td>Basic + DA</td>
                                 <td><?php echo $letter_details[0]['basic_salary'];?></td> 
                              </tr>
                              <tr>
                                 <td>HRA</td>
                                 <td><?php echo $letter_details[0]['hra'];?></td> 
                              </tr>
                              <tr>
                                 <td>St. Bonus</td>
                                 <td><?php echo $letter_details[0]['st_bonus'];?></td> 
                              </tr>
                              <tr>
                                 <td>Special Allowance</td>
                                 <td><?php echo $letter_details[0]['special_allowance'];?></td> 
                              </tr>
                              <tr style="background-color:pink;">
                                 <td>Gross Salary</td>
                                 <td><?php echo $letter_details[0]['gross_salary'];?></td> 
                              </tr>
                              <tr>
                                 <td>Employee PF @ 12%</td>
                                 <td><?php echo $letter_details[0]['emp_pf'];?></td> 
                              </tr>
                              <tr>
                                 <td>Employee ESIC @ 1.75%</td>
                                 <td><?php echo $letter_details[0]['emp_esic'];?></td> 
                              </tr>
                              <tr>
                                 <td>PT</td>
                                 <td><?php echo $letter_details[0]['pt'];?></td> 
                              </tr>
                              <tr>
                                 <td>Total Deduction</td>
                                 <td><?php echo $letter_details[0]['total_deduction'];?></td> 
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>Take-home</td>
                                 <td><?php echo ($letter_details[0]['take_home']);?></td> 
                              </tr>
                              <tr>
                                 <td>Employer PF @ 13%</td>
                                 <td><?php echo $letter_details[0]['employer_pf'];?></td> 
                              </tr>
                              <tr>
                                 <td>Employer ESIC @ 4.75%</td>
                                 <td><?php echo $letter_details[0]['employer_esic'];?></td> 
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>CTC</td>
                                 <td><?php echo ($letter_details[0]['ctc']);?></td> 
                              </tr>
                           </tbody>
                        </table>
                     </center>
                  </div>
                  <br>	
                  
               </td>
            </tr>
         </tbody>
      </table>
	  <table style="border-collapse:collapse;width:100%;margin-bottom:20px;margin-left:4%;">
                        <tbody>
                           <tr>
                              <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                                 <p style="line-height:1.8;font-size:14px">	
                                  
                                    <b>For Fretus Folks India Pvt Ltd</b> <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url()?>admin_assets/seal.png" style="margin-top:2%;" width="100">
									<br>
                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                                 </p>
                              </td>
							  </td>
							  <td style="font-size:12px;text-align:left;padding:7px;width:40%">
							  <p style="line-height:1.8;font-size:14px">	
							  <br>
							  <b>Name : <b><?php echo $letter_details[0]['emp_name'];?></b></b> <br><br><br>
							  <b>Signature : </b> <br>
							  </p>
							  </td>
                           </tr>
                        </tbody>
                     </table>
	  </br> </br> </br> 
	   </br> </br> </br> 
	  </br> </br> </br> </br>
      <img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" style="margin-top:1.2%;">
    
       
   </body>
</html>
