<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <meta content="telephone=no" name="format-detection" />
      <title>Fretus Folks</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <style>
         .cash
            {
               text-align:right;
            }
         li
            {
               line-height:1.5;
               margin-bottom:13px;
            }
         b
            {
               font-weight:bold;
            }
      </style>
   </head>

   <body >
      <div style="margin:0px 50px 0px 50px;">
         <p style="text-align:right;font-weight:bold">
            Date :  <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?>
         </p>
         <h1 style="font-size:20px;text-decoration:underline;text-align:center;font-weight:bold">Appointment  letter</h1><br><br>
         <p style="font-size:14px;line-height:2;font-weight:bold; ">
            To,<br/> Mr. /Mrs. /Ms. <?php echo $letter_details[0]['emp_name'];?></br>
            Emp  : <?php echo $letter_details[0]['ffi_emp_id'];?> <br> 
            Address : <?php echo $letter_details[0]['branch'];?> <br>   
            Location : <?php echo $letter_details[0]['location'];?> <br>
         </p><br> 
         <p style="font-size:12px;font-weight:bold">
            Dear <?php echo $letter_details[0]['emp_name'];?>,   
         </p> 
         <p style="font-size:12px;line-height:1.5;text-align:justify;"> 
            <span>
               We are pleased to offer you employment to work as “<b><?php echo $letter_details[0]['designation'];?>
               </b>” as on <?php echo date("d-m-Y",strtotime($letter_details[0]['joining_date']));?></b>, on deputation with our client/s, <b><?php echo $letter_details[0]['client_name'];?></b>. for a fixed period of employment, on the following terms and conditions:
            </span>
         </p> 
         <ol type="1" style="font-size:12px;">
            <li style="text-align:justify;">
               <span>
					You will be working at the site assigned from our client  <b><?php echo $letter_details[0]['client_name'];?></b>, under this probation if you are found guilty of activities such <b>as Cash mismanagement, Theft, Bike Meter tampering, Fake delivery, Disrespect to <?php echo $letter_details[0]['client_name'];?>. Employee and other delivery associate, irregularity at work,</b> Client is liable to separate you with immediate effect and we shall end your contract on the day of separation from client. 
               </span>
				</li>
            <li style="text-align:justify;">
					Duration of your contract is 11 months.
				</li>
				<li style="text-align:justify;">
					Not with standing anything above, depending upon the afore mentioned project/work, the company reserves its right to extend your temporary appointment for such a period or periods as may be necessary depending upon the exigencies relatable to the work for which you are hereby engaged. The same shall be informed to you in advance. In the event, the company shall be in writing extend your temporary assignment on the terms as may be indicated in such extension of the assignment you shall be governed by such terms and conditions as may be indicated therein.
				</li>
				<li style="text-align:justify;">
					You will be entitled for leaves as per shops and establishment act and other applicable laws in India.
				</li>
				<li style="text-align:justify;">
					During the period of fixed contract of twelve months, your services could be deputed at the sole discretion of the management to any of our client’s company to do work pertaining to or incidental to the client’s business. Your service can be transferred from one location to another (within state) as per business requirement. 
				</li>
				<li style="text-align:justify;">
					In case of any adverse remarks found from the reference given by you, the documents submitted by you/outcome of the police verification report then this appointment will stand withdrawn immediately.
				</li>
				<li style="text-align:justify;">
					You will not be absent from your duty without sufficient reasons, you will obtain prior written permission / sanction from the supervisor about your absence giving reasons thereof and probable duration immediately, failing which, the same will be treated as loss of Pay.
				</li>
				<li style="text-align:justify;">
					<p style="text-align:justify;"> 
					<b>If you did not report to work for continuous 3 days</b> without proper notification of absenteeism, company is liable to end your contract on immediate basis, on request from client.
					</p> 
				</li>
				<li style="text-align:justify;">
               Client holds the discretion to do a thorough background verification of your candidature as seems fit and can initiate police verification, background check, court cases verification.
				</li>
				<li style="text-align:justify;">
					If you found guilty in any one of them, Client have the full authority to end your contract immediately and report the findings to nearest police station.
				</li>
            <li style="text-align:justify;">
                  You will be governed by the conduct, discipline, rules and regulations as laid down by the management.
				</li>
            <li style="text-align:justify;">
						The salary will be paid to you, subject to the receipt of payment from <b><?php echo $letter_details[0]['client_name'];?></b>.  (to which you have been deputed). You will receive your salary on 7th of every month.
				</li>
				<li style="text-align:justify;">
						This contract shall be terminable by either party giving 15 days’ notice in writing or salary on lieu of notice, to the other.
				</li>
				<li style="text-align:justify;">
						You will be provided assets (mobile phone and uniform) during your work which has to be returned at the time of leaving company and on failing to submit the assets to the client amount will be deduct against the assets.
				</li>  
			</ol>
         <p style="font-size:12px;text-align:justify;"> 
				We are consciously endeavoring to build an atmosphere of trust, openness, responsiveness, autonomy and growth among all members to the <b>Fretus Folks India Pvt Ltd.</b>. As a new entrant, we would like you to whole-heartedly contribute in this process.<br/><br/>
				As a token of acceptance of the above terms and conditions, you are requested to sign the duplicate copy of this letter and return to us.<br/><br/>
				<span style="float:right;">With warm regards,</span>
			</p> <br>
         <p style="line-height:1.8;font-size:14px">
            <b>For Fretus Folks India Pvt Ltd</b> <br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" style="margin-top:2%;" width="100"><br>
            <b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
         </p><br><br><br><br><br><br><br><br><br>
         <h1 style="font-size:20px;text-decoration:underline;text-align:center;font-weight:bold">Annexure Salary Break Up</h1>
         <div style="align:center;">
            <table class="table table1" border="1" style="border-collapse:collapse;width:100%;font-size: 12px;">
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
                     <td class="cash"><?php echo $letter_details[0]['basic_salary'];?></td> 
                  </tr>
                  <tr style="bg-color:pink;">
                     <td>HRA</td>
                     <td class="cash"><?php echo $letter_details[0]['hra'];?></td> 
                  </tr>
                  <tr>
                     <td>St. Bonus</td>
                     <td class="cash"><?php echo $letter_details[0]['st_bonus'];?></td> 
                  </tr>
                  <tr>
                     <td>Special Allowance</td>
                     <td class="cash"><?php echo $letter_details[0]['special_allowance'];?></td> 
                  </tr>
                  <tr>
                     <td>Gross Salary</td>
                     <td class="cash"><?php echo $letter_details[0]['gross_salary'];?></td> 
                  </tr>
                  <tr>
                     <td>Employee PF @ 12%</td>
                     <td class="cash"><?php echo $letter_details[0]['emp_pf'];?></td> 
                  </tr>
                  <tr>
                     <td>Employee ESIC @ 1.75%</td>
                     <td class="cash"><?php echo $letter_details[0]['emp_esic'];?></td> 
                  </tr>
                  <tr>
                     <td>PT</td>
                     <td class="cash"><?php echo $letter_details[0]['pt'];?></td> 
                  </tr>
                  <tr>
                     <td>Total Deduction</td>
                     <td class="cash"><?php echo $letter_details[0]['total_deduction'];?></td> 
                  </tr>
                  <tr>
                     <td style="background-color: #ecbfbf;">Take-home</td>
                     <td style="background-color: #ecbfbf;" class="cash"><?php echo ($letter_details[0]['take_home']);?></td> 
                  </tr>
                  <tr>
                     <td>Employer PF @ 13%</td>
                     <td class="cash"><?php echo $letter_details[0]['employer_pf'];?></td> 
                  </tr>
                  <tr>
                     <td>Employer ESIC @ 4.75%</td>
                     <td class="cash"><?php echo $letter_details[0]['employer_esic'];?></td> 
                  </tr>
                  <tr style="background-color: #ecbfbf;">
                     <td style="background-color: #ecbfbf;" >CTC</td>
                     <td style="background-color: #ecbfbf;" class="cash"><?php echo ($letter_details[0]['ctc']);?></td> 
                  </tr>
               </tbody>
            </table><br><br><br><br>
         </div>
         <table  style="border-collapse:collapse;width:100%;">
            <tbody>
               <tr>
                  <td colspan="3" style="text-align:left;">
                     <p style="line-height:1.8;font-size:14px">
                        <b>For Fretus Folks India Pvt Ltd</b> <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" style="margin-top:2%;" width="100"><br>
                        <b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                     </p>
                  </td>
						<td style="text-align:right;">
							<p style="line-height:1.8;font-size:14px"><br>
							  <b>Name : <b><?php echo $letter_details[0]['emp_name'];?></b></b> <br><br><br><br>
							  <b>Signature</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
							 </p>
						</td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>