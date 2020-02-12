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
   </style>
</head>

<body onload="window.print();">

   <div style="position: absolute;
                  top: 153px;
                  right: 20px;
                  font-size: 18px;margin:0 35px">
      <p style="line-height:1.8;font-size:14px;font-family:times; ">
         <span>Date : <?php echo date("d-m-Y", strtotime($letter_details[0]['joining_date'])); ?></span> <br>
      </p>
   </div>

   <div style="margin:0 35px">
      <p style="line-height:1.8;font-size:14px;font-family:times;">
         <span>Mr. /Mrs. /Ms. : <?php echo $letter_details[0]['emp_name']; ?></span> <br>
         <span>Employee ID : <?php echo $letter_details[0]['ffi_emp_id']; ?></span> <br>
         <span>Place : <?php echo $letter_details[0]['location']; ?></span> <br>
      </p>
   </div>
   <h1 style="font-size:18px;text-align:center;text-decoration:underline;margin-top:20px">Appointment Letter</h1>
   <div style="margin:0 35px">
      <p style="font-size:12px;line-height:1.5;text-align:justify">
         <b>Dear Mr./Mrs./Ms <?php echo $letter_details[0]['emp_name']; ?></b><br>
         <span>
            Further to your interview , we are pleased to inform you that you are hereby appointed as <b><?php echo $letter_details[0]['designation']; ?></b> in the <b><?php echo $letter_details[0]['department']; ?></b> Department of our company <b><?php echo $letter_details[0]['client_name']; ?></b> You are assigned to work at Bangalore as per terms and conditions discussed and agreed upon as <br>under :-
         </span>
      </p>

      <p style="font-size:12px;line-height:1.5;text-align:justify;margin-bottom:110px;">
         <span>1. This appointment is effective from <b><?php echo date("d-m-Y", strtotime($letter_details[0]['joining_date'])); ?></b> the date of your joining our Organization.</span><br>
         <span>2. Your salary and other allowances shall be as per <b>Annexure-1</b>.</span><br>
         <span>3. You will be placed on probation for a period of six months and the said period can be extended by another three months and on the expiry of the period of probation or extended period of probation, if you are not confirmed in writing, your services shall be deemed to be automatically terminated. However, unless you are confirmed in writing, you shall not be deemed to be permanent.</span><br>
         <span>4. During probation, the notice period for termination / resignation will be 24 hours from either side. After confirmation, the notice period required from either side is one month.</span><br>
         <span>5. After successful completion of your probation , you will be confirmed in writing as a permanent employee of the Company. You will be entitled to statutory and service benefits and be governed by discipline and other rules existing or may come into existence from time to time , as and when applicable as per rules of the Company and such other benefits as applicable to employees in force from time to time to the location / place wherever you are working.The company depending upon need shall take suitable cover of GPA to take care of liability under Workmen Compensation Act provided you are not covered under ESI Scheme.</span><br>
         <span>6. Your future increments or promotion or any other salary increase shall be based on merit considering your periodic and consistent overall performance, business conditions and other parameters fixed from time to time at the discretion of the management and shall not be considered merely as a matter of right.</span><br>
         <span>7. During the period of service with the company, you shall not indulge and/ or take part in any activity of formation of council and / or association or become a member being part of management staff which are found to be detrimental in the interest of the company in any way. Such an action shall be deemed as infringement to service conditions of the company and amount to causing damage to its interest and shall call for disciplinary action being taken against you, as it may deem fit and appropriate.</span><br>
         <span>8. During the tenure of your services, you will wholly devote yourself to the work assigned to you and will not undertake any other employment either on full or part time basis without prior permission of the Company in writing. Any contravention of this condition will entail termination of your services from the Company.</span><br>
      </p>

      <p style="font-size:12px;line-height:1.5;text-align:justify;margin-bottom:10px;">
         <span>9. </span><br>&nbsp;&nbsp;
         <span>1. services are liable to be transferred or loaned or assigned with / without transfer, wholly or partially, from one department to another or to office/ branch and vice-versa or office/ branch to another office/ branch of an associate company, existing or to come into existence in future or any of the Company’s branch office or locations anywhere in India or abroad or any other concern where this Company has any interest. In such case, you will abide by responsibilities expressly vested or implied or communicated and shall follow rules and regulations of the department / office, establishment, jointly or separately, without any compensation or extra remuneration or provision of accommodation. You, thereupon, may be governed by service conditions and other terms of the said concern as may be applicable.</span><br>&nbsp;&nbsp;
         <span>2. The aforesaid Clause (i) will not give you any right to claim employment in any associate or / sister concern or ask for a common seniority with the employee of sister / associate concern.
         </span><br>

         <span>10. In the event you are absent from duty without information or permission of leave or you overstay your sanctioned leave, the Management will treat you as having voluntarily abandoned the services of the Company.</span><br>
         <span>11. </span><br>&nbsp;&nbsp;
         <span>1. During your employment , in case you are found to be medically unfit by the Company’s Authorized Medical practitioner, on examination</span><br>&nbsp;&nbsp;
         <span>2. As and when the Company comes to know of any conviction by the Court of Law during the tenure of your service with us or conviction and / or any bad record in the past under the previous employer, or because of your giving false information at the time of your appointment or concealed any material information or given any false details in the application form or otherwise as regard age, education qualification , experience , salary etc.
         </span><br>&nbsp;&nbsp;
         <span>3. if you are found to be not possessing desired qualification which do not conform to custom authority and / govt. regulation as may be required from time to time and necessary for continuation of business or its exigencies or on account of redundancy .</span><br>

         <span>12. You will keep the Company informed of any change in your residential address that may happen during the course of employment of your service with the company.</span><br>
         <span>13. All documents, plans, drawings, prints, trade secrets, technical information, reports, statements, correspondence etc., written or unwritten and also information and instructions that pass through you or come to your knowledge shall be treated as confidential. You shall not utilize them for your own use or disclose to other persons during or after your employment.<br>
            <span style="margin-top:1% !important;">During the course of employment with the Company, you will acquire, gain, generate, gather and develop knowledge of and be given access to business information about products activities, know how, methods or refinements and business plans and business secrets and other information concerning the products / business of the Company, hereinafter called the “ SECRETS ”. You will be liable for prosecution for damages for divulgence, sharing or parting any of such information during course of employment and on cessation for at least 2 years period.</span></span><br>
         <span>14. You shall carry out the job of <b><?php echo $letter_details[0]['designation']; ?></b> and such other jobs connected with or incidental to which is necessary for business of the Company. You shall do any other work assigned to you, which you are capable of doing or work at any other post which has been temporarily assigned to you.</span><br>
         <span>15. You shall faithfully and to the best of your ability perform your duties that may be entrusted to you from time to time by the management. You will be bound by rules, regulations and orders promulgated by the management in relation to conduct, discipline and policy matters.<br>
            You will not seek membership of any local or public bodies without first obtaining specific permission of the management. In the event of your becoming member without following due process as mentioned , it shall amount to contravention of provision of employment condition and the management reserves the right to take appropriate action including dispensing with your services , as it may deem fit. <br>
            You will not give out to any one, by word of mouth or otherwise, particulars of our business or administrative or organizational matters of a confidential nature which may be your privilege to know by virtue of your being our employee.</span><br>
      </p>

      <p style="font-size:12px;line-height:1.5;text-align:justify">

         <span>16. While you are in employment of the company, you may be given or handed over company’s property and / or equipment for official use and you shall take care of them including their upkeep. On cessation of employment with the Company, you shall return all documents, books, papers relating to the affairs of the Company, purchased with the Company’s money, which may have come to you, and also any property of the Company in your possession.</span><br>
         <span>17. Any balance of advance or loan taken by you from the Company, shall be fully recovered from your salary and any other legal dues including Gratuity, at the time of you’re leaving the services of the Company. </span><br>
         <span>18. While working as an employee if you enter into any business transaction with any party on behalf of the company within your permissible limits, it shall be your responsibility to ensure recovery of outstanding. If any outstanding remains at the time of leaving the services of the company, it shall be your responsibility to recover for remittance to the company before you proceed to settle your legal dues in full and final settlement of your account.</span><br>
         <span>19. The company is obliged to deduct Income Tax at source as per provision of Income Tax Act / Rules . Accordingly, you are required to submit all required proof of permitted savings / investments and other details from time to time to enable the company to comply with the provisions of law. In the event of non compliance by you as aforesaid if the company is required to pay any interest or payment under Income Tax Act , it shall deduct the amount as may be paid or payable from your salary or other payments and you shall allow the company to comply with these requirements without objection.
         </span>20. <br>
         <span>All disputes arising out of this letter will be subject to the jurisdiction of the Bangalore Court. And that the courts, tribunals and/or authorities at Bangalore only shall have jurisdiction to entertain, try and decide such disputes or differences arising out of or pertaining to this contract of employment, irrespective of your working HQ being elsewhere at that times.</span><br>
      </p>
   </div>
   <div style="margin:0 35px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
         <tbody>
            <tr>
               <td>
                  <p style="font-size:12px;line-height:1.5;text-align:justify"><br>
                     <span>
                        You are requested to return the enclosed copy duly signed as a token of your acceptance of the terms and conditions of your employment.</span><br><br>
                     <span>
                        Hope that this will be the beginning of a long and successful career with us.
                     </span>
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
         <tbody>
            <tr>
               <td style="font-size:12px;text-align:left;margin-left:-5px;">
               <br> 
                     Yours faithfully,<br>
                     <b>For : Fretus Folks India Pvt Ltd.</b> <br>
                     &nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" style="margin-top:2%;" width="100"><br>
                     <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                   
               </td>
               <td style="font-size:12px;text-align:right;padding:7px;width:40%">
                  <p>
                     <br>
                     <b style="text-align: center">I accept:</b> <br><br><br><br><br><br>
                     <b>(Signature of an Employee) </b> <br>
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
   </div>

   <div style="margin:200px 35px 0">
      <h1 style="font-size:17px;text-align:center;text-decoration: underline;">Annexure - 1</h1>
      <center>
         <table class="table1" cellpadding="6" border="1" style="border-collapse:collapse;width:100%;margin-bottom:5px;">
            <tbody>
               <tr>
                  <th style="font-size:13px;text-align:left;padding:7px;border-top: 1px solid #000;">
                     Components
                  </th>
                  <th style="font-size:13px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
                     Monthly salary
                  </th>
                  <th style="font-size:13px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
                     Annual salary
                  </th>
               </tr>
               <tr>
                  <td>Basic</td>
                  <td><?php echo $letter_details[0]['basic_salary']; ?></td>
                  <td><?php echo ($letter_details[0]['basic_salary'] * 12); ?></td>
               </tr>
               <tr>
                  <td>HRA</td>
                  <td><?php echo $letter_details[0]['hra']; ?></td>
                  <td><?php echo ($letter_details[0]['hra'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Conveyance</td>
                  <td><?php echo $letter_details[0]['conveyance']; ?></td>
                  <td><?php echo ($letter_details[0]['conveyance'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Medical Reimbursement</td>
                  <td><?php echo $letter_details[0]['medical_reimbursement']; ?></td>
                  <td><?php echo ($letter_details[0]['medical_reimbursement'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Special Allowance</td>
                  <td><?php echo $letter_details[0]['special_allowance']; ?></td>
                  <td><?php echo ($letter_details[0]['special_allowance'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Other Allowance</td>
                  <td><?php echo $letter_details[0]['other_allowance']; ?></td>
                  <td><?php echo ($letter_details[0]['other_allowance'] * 12); ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>Gross Salary</td>
                  <td><?php echo $letter_details[0]['gross_salary']; ?></td>
                  <td><?php echo ($letter_details[0]['gross_salary'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Employee PF @ 12%</td>
                  <td><?php echo $letter_details[0]['emp_pf']; ?></td>
                  <td><?php echo ($letter_details[0]['emp_pf'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Employee ESIC @ 1.75%</td>
                  <td><?php echo $letter_details[0]['emp_esic']; ?></td>
                  <td><?php echo ($letter_details[0]['emp_esic'] * 12); ?></td>
               </tr>
               <tr>
                  <td>PT</td>
                  <td><?php echo $letter_details[0]['pt']; ?></td>
                  <td><?php echo ($letter_details[0]['pt'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Total Deduction</td>
                  <td><?php echo $letter_details[0]['total_deduction']; ?></td>
                  <td><?php echo ($letter_details[0]['total_deduction'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Take Home Salary</td>
                  <td><?php echo $letter_details[0]['take_home']; ?></td>
                  <td><?php echo ($letter_details[0]['take_home'] * 12); ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>Take-home</td>
                  <td><?php echo ($letter_details[0]['gross_salary'] - $letter_details[0]['total_deduction']); ?></td>
                  <td><?php echo (($letter_details[0]['gross_salary'] - $letter_details[0]['total_deduction']) * 12); ?></td>
               </tr>
               <tr>
                  <td>Employer PF 13%</td>
                  <td><?php echo $letter_details[0]['employer_pf']; ?></td>
                  <td><?php echo ($letter_details[0]['employer_pf'] * 12); ?></td>
               </tr>
               <tr>
                  <td>Employer ESIC @ 4.75%</td>
                  <td><?php echo $letter_details[0]['employer_esic']; ?></td>
                  <td><?php echo ($letter_details[0]['employer_esic'] * 12); ?></td>
               </tr>
               <tr class="gross" style="background: #ecbfbf;">
                  <td>CTC</td>
                  <td><?php echo ($letter_details[0]['ctc']); ?></td>
                  <td><?php echo (($letter_details[0]['ctc']) * 12); ?></td>
               </tr>
            </tbody>
         </table>
      </center>

   </div>

</body>

</html>