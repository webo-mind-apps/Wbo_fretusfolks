<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fretus Folks</title>
   <style>
      .table1 td {
         font-size: 12px;
      }

      td:nth-child(2),
      td:nth-child(3) {
         text-align: right;
      }
      Ol li{
         margin-bottom:20px;
      }
      .table1 td,.table1 th{
         padding:3px 3px 3px 3px;
      }
   </style>
</head>

<body onload="window.print();">
<h1 style="font-size:18px;text-align:center;text-decoration:underline;margin-top:20px">Appointment Letter</h1>
   <div style="margin:0 35px">
      <p style="line-height:1.8;font-size:14px;font-family:times;">
      <span>To,</span> <br>
         <span>Mr. /Mrs. /Ms. : <b><?php echo $letter_details[0]['emp_name']; ?></b></span> <br>
         <span>Emp : <b><?php echo $letter_details[0]['employee_id']; ?></b></span> <br>
         <span>Address : <b><?php echo $letter_details[0]['location']; ?></b></span> <br>
      </p>
   </div>
   <div style="position: absolute;
                  top: 160px;
                  right: 60px;
                  font-size: 18px;margin:0 35px">
      <p style="line-height:1.8;font-size:14px;font-family:times; ">
         <span>Date : <b><?php echo date("d-M-Y", strtotime($letter_details[0]['joining_date'])); ?></b></span> <br>
      </p>
   </div>
 
   <div style="margin:0 35px">
      <p style="font-size:12px;line-height:1.5;text-align:justify">
         <b>Dear Mr./Mrs./Ms <?php echo $letter_details[0]['emp_name']; ?></b><br><br>
         <span>
            We are pleased to offer you employment to work as “<b><?php echo $letter_details[0]['designation']; ?></b>” as on <b><?php echo date("d-M-Y", strtotime($letter_details[0]['joining_date'])); ?></b>, on deputation with our client/s, <b><?php echo $letter_details[0]['client_name']; ?></b>. for a fixed period of employment, on the following terms and conditions:
         </span>
      </p>
         <ol type="1" style="font-size:12px;line-height:1.8;text-align:justify;margin-bottom:10px;">

         <li>
         You will be working at the site assigned from our client <b><?php echo $letter_details[0]['client_name']; ?></b>, under this probation if you are found guilty of activities such as Cash mismanagement, Theft, Bike Meter tampering, Fake delivery, Disrespect to <b><?php echo $letter_details[0]['client_name']; ?></b>. Employee and other delivery associate, irregularity at work, Client is liable to separate  you with immediate effect and we shall end your contract on the day of separation from client.
         </li>
         <li>
         Duration of your contract is <b><?php echo $letter_details[0]['tenure_month']; ?></b> months.  
         </li>
         <li>
         Notwithstanding anything above, depending upon the afore mentioned project/work, the company reserves its right to extend your temporary appointment for such a period or periods as may be necessary depending upon the exigencies relatable to the work for which you are hereby engaged. The same shall be informed to you in advance. In the event, the company shall be in writing extend your temporary assignment on the terms as may be indicated in such extension of the assignment you shall be governed by such terms and conditions as may be indicated therein.
         </li>
         <li>
         You will be entitled for leaves as per shops and establishment act and other applicable laws in India.
         </li>
         <li>
         During the period of fixed contract of twelve months, your services could be deputed at the sole discretion of the management to any of our client’s company to do work pertaining to or incidental to the client’s business. Your service can be transferred from one location to another (within state) as per business requirement. 
         </li>
         <li>
         In case of any adverse remarks found from the reference given by you, the documents submitted by you/outcome of the police verification report then this appointment will stand withdrawn immediately.
         </li>
         <li>
         You will not be absent from your duty without sufficient reasons, you will obtain prior written permission / sanction from the supervisor about your absence giving reasons thereof and probable duration immediately, failing which, the same will be treated as loss of Pay. 
         </li>
         <li>
         If you <b>did not report to work for continuous 3 days</b> without proper notification of absenteeism, company is liable to end your contract on immediate basis, on request from client.
         </li>
         <li>
         Client holds the discretion to do a through background verification of your candidature as seems fit and can initiate police verification, background check, court cases verification.
         </li>
         <li>
         If you found guilty in any one of them, Client have the full authority to end your contract immediately and report the findings to nearest police station. 
         </li>
         <li>
         You will be governed by the conduct, discipline, rules and regulations as laid down by the management.
         </li>
         <li>
         The salary will be paid to you, subject to the receipt of payment from <b><?php echo $letter_details[0]['client_name']; ?></b>  (to which you have been deputed). You will receive your salary on <?=$letter_details[0]['salary_date'];?>th of every month.
         </li>
         <li>
         This contract shall be terminable by either party giving <?=$letter_details[0]['notice_period'];?> days’ notice in writing or salary on lieu of notice, to the other.
         </li>
         <li>
         You will be provided assets (mobile phone and uniform) during your work which has to be returned at the time of leaving company and on failing to submit the assets to the client amount will be deduct against the assets. 
         </li>
         </ol>
         <p style="font-size:14px;line-height:1.5;text-align:justify">
         We are consciously endeavoring to build an atmosphere of trust, openness, responsiveness, autonomy and growth among all members to the <b>Fretus Folks India Pvt Ltd.</b> As a new entrant, we would like you to whole-heartedly contribute in this process. 
         </p>
         <p style="font-size:14px;line-height:1.5;text-align:justify">
         As a token of acceptance of the above terms and conditions, you are requested to sign the duplicate copy of this letter and return to us. 
         </p>
         <p style="font-size:14px;line-height:1.5;text-align:justify">
         With warm regards,
         </p>
         
         <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
            <tbody>
               <tr>
                  <td>
                     <p style="font-size:12px;line-height:1.8;text-align:justify"><br>
                        <span>
                           You are requested to return the enclosed copy duly signed as a token of your acceptance of the terms and conditions of your employment.</span><br><br>
                        <span>
                           Hope that this will be the beginning of a long and successful career with us.
                        </span>
                     </p>
                  </td>
               </tr>
            </tbody>
         </table> -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
         <tbody>
            <tr>
               <td style="font-size:12px;text-align:left;margin-left:-5px;">
                  <br>
                  <b>For : Fretus Folks India Pvt Ltd.</b> <br>
                  &nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" style="margin-top:2%;" width="100"><br>
                  <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>

               </td>
            </tr>
         </tbody>
      </table>
      <pagebreak />
      <h1 style="font-size:17px;text-align:center;text-decoration: underline;">Annexure Salary BreakUp</h1>
     
      <table cellpadding="8px" class="table table1" border="1" style="border-collapse:collapse; width:60%;font-size: 10px;margin-left:auto;margin-right:auto;">
      <tbody>
               <tr>
                  <th style="font-size:13px;text-align:left;padding:7px;border-top: 1px solid #000;">
                     Components
                  </th>
                  <th style="font-size:13px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
                     Monthly salary
                  </th>
               </tr>
               <tr>
                  <td>Basic + DA</td>
                  <td><?php echo $letter_details[0]['basic_salary']; ?></td>
               </tr>
               <tr>
                  <td>HRA</td>
                  <td><?php echo $letter_details[0]['hra']; ?></td>
               </tr>
               <tr>
                  <td>Conveyance</td>
                  <td><?php echo $letter_details[0]['conveyance']; ?></td>
               </tr>
               <tr>
                  <td>St.Bonus</td>
                  <td><?php echo $letter_details[0]['st_bonus']; ?></td>
               </tr>
               <tr>
                  <td>Leave Wages</td>
                  <td><?php echo $letter_details[0]['leave_wage']; ?></td>
               </tr>
               <tr>
               <tr>
                  <td>Special Allowance</td>
                  <td><?php echo $letter_details[0]['special_allowance']; ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>Gross Salary</td>
                  <td><?php echo $letter_details[0]['gross_salary']; ?></td>
               </tr>
               <tr>
                  <td>Employee PF</td>
                  <td><?php echo $letter_details[0]['emp_pf']; ?></td>
               </tr>
               <tr>
                  <td>Employee ESIC</td>
                  <td><?php echo $letter_details[0]['emp_esic']; ?></td>
               </tr>
               <tr>
                  <td>PT</td>
                  <td><?php echo $letter_details[0]['pt']; ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>Total Deduction</td>
                  <td><?php echo $letter_details[0]['total_deduction']; ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>Take Home </td>
                  <td><?php echo $letter_details[0]['take_home']; ?></td>
               </tr>
              
               <tr>
                  <td>Employer PF</td>
                  <td><?php echo $letter_details[0]['employer_pf']; ?></td>
               </tr>
               <tr>
                  <td>Employer ESIC</td>
                  <td><?php echo $letter_details[0]['employer_esic']; ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>CTC</td>
                  <td><?php echo ($letter_details[0]['ctc']); ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>Annual CTC</td>
                  <td><?php echo (($letter_details[0]['ctc']) * 12); ?></td>
               </tr>
            </tbody>
         </table>
      <table style="border-collapse:collapse;width:100%;margin-top:15px;">
                        <tbody>
                           <tr>
                              <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                                 <p style="line-height:1.8;font-size:14px">
                                    <br><b>For : Fretus Folks India Pvt Ltd.</b> <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
                                    <br><b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                                 </p>
                              </td>
                              <td style="font-size:12px;padding:7px;width:40%">
                                 <p style="line-height:1.8;font-size:14px">
                                    <br>
                                    Name: <b><?php echo $letter_details[0]['emp_name']; ?></b>
                                    <br/><br/><br/>
                                    Signature:
                            
                                 </p>
                              </td>
                           </tr>
                        </tbody>
                     </table>
   </div>

</body>

</html>
