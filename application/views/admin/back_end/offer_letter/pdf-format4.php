<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
   <meta content="telephone=no" name="format-detection" />
   <title>Fretus Folks</title>
   <style>
      .cash {
         text-align: right;
      }

      li {
         line-height: 1.5;
         margin-bottom: 13px;
      }

      b {
         font-weight: bold;
      }

      .table1 td:nth-child(2),
      td:nth-child(3) {
         text-align: right;
      }
   </style>
</head>

<body>
   <div style="margin:0px 50px 0px 50px;">
      <table style="border-collapse:collapse;width:100%;">
         <tbody>
            <tr>
               <td style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                     <b>Mr. /Mrs. /Ms. : <?php echo $letter_details[0]['emp_name']; ?></b> <br>
               </td>
               <td style="font-size:14px;text-align:right;width:30%">
                  <p style="line-height:1.8;">
                     <b>Date : <?php echo date("d-m-Y", strtotime($letter_details[0]['joining_date'])); ?><b></a>
                  </p>
               </td>
            </tr>
            <tr>
               <td style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                     <b>Employee ID : <?php echo $letter_details[0]['ffi_emp_id']; ?></b> <br>
               </td>
               <td>
               </td>
            </tr>
            <tr>
               <td style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                     <b>Place : <?php echo $letter_details[0]['location']; ?></b> <br>
               </td>
               <td>
               </td>
            </tr>
         </tbody>
      </table>
      <p style="font-size:12px;line-height:1.5;">
         <b>Dear Mr./Mrs./Ms <?php echo $letter_details[0]['emp_name']; ?></b>
      </p>
      <p style="font-size:12px;line-height:1.5;text-align:justify;">
         <span style="">
            Further to your interview , we are pleased to inform you that you are hereby appointed as <b><?php echo $letter_details[0]['designation']; ?></b> in the <b><?php echo $letter_details[0]['department']; ?></b> Department of our associate company <b><?php echo $letter_details[0]['client_name']; ?></b>. You are assigned to work at Bangalore as per terms and conditions discussed and agreed upon as <br>under :-
         </span><br>
      </p>
      <ol type="1" style="font-size:12px;">
         <li style="text-align:justify;">
            This appointment is effective from <b><?php echo date("d-m-Y", strtotime($letter_details[0]['joining_date'])); ?></b> the date of your joining our Organization.
         </li>
         <li style="text-align:justify;">
            Your salary and other allowances shall be as per <b>Annexure-1</b>.
         </li>
         <li style="text-align:justify;">
            You will agree to work with us for the period of client’s agreement, during which period of engagement can be terminated by either side by giving 15 Days pay in lieu thereof at company’s direction. In case of notice pay take over, the same will be recovered if you leave the company before completion of your tenure dated
         </li>
         <li style="text-align:justify;">
            Your future increments or promotion or any other salary increase shall be based on merit considering your periodic and consistent overall performance, business conditions and other parameters fixed from time to time at the discretion of the management and shall not be considered merely as a matter of right.
         </li>
         <li style="text-align:justify;">
            During the period of service with the company, you shall not indulge and/ or take part in any activity of formation of council and / or association or become a member being part of management staff which are found to be detrimental in the interest of the company in any way. Such an action shall be deemed as infringement to service conditions of the company and amount to causing damage to its interest and shall call for disciplinary action being taken against you, as it may deem fit and appropriate.
         </li><br><br>
         <li style="text-align:justify;">
            During the tenure of your services, you will wholly devote yourself to the work assigned to you and will not undertake any other employment either on full or part time basis without prior permission of the Company in writing. Any contravention of this condition will entail termination of your services from the Company.<br><br>
         
            &nbsp;&nbsp;&nbsp; i. Your services are liable to be transferred or loaned or assigned with / without transfer, wholly or partially, from one department to another or to office/ branch and vice-versa or office/ branch to another office/ branch of an associate company, existing or to come into existence in future or any of the Company’s branch office or locations anywhere in India or abroad or any other concern where this Company has any interest. In such case, you will abide by responsibilities expressly vested or implied or communicated and shall follow rules and regulations of the department / office, establishment, jointly or separately, without any compensation or extra remuneration or provision of accommodation. You, thereupon, may be governed by service conditions and other terms of the said concern as may be applicable.<br><br>
          
            &nbsp;&nbsp;&nbsp;ii. The aforesaid Clause (i) will not give you any right to claim employment in any associate or / sister concern or ask for a common seniority with the employee of sister / associate concern.
         </li>
         

         <li style=" text-align:justify;">
            In the event you are absent from duty without information or permission of leave or you overstay your sanctioned leave, the Management will treat you as having voluntarily abandoned the services of the Company.
         </li>
         <li style="text-align:justify;">
            You will keep the Company informed of any change in your residential address that may happen during the course of employment of your service with the company.
         </li>
         <li style="text-align:justify;">
            Your services are liable to be terminated at any time :
            <ol type="i">
               <li style="text-align:justify;">
                  During your employment , in case you are found to be medically unfit by the Company’s Authorized Medical practitioner, on examination;
               </li>
               <li style="text-align:justify;">
                  as and when the Company comes to know of any conviction by the Court of Law during the tenure of your service with us or conviction and / or any bad record in the past under the previous employer, or because of your giving false information at the time of your appointment or concealed any material information or given any false details in the application form or otherwise as regard age, education qualification , experience , salary etc.
               </li>
               <li style="text-align:justify;">
                  if you are found to be not possessing desired qualification which do not conform to custom authority and / govt. regulation as may be required from time to time and necessary for continuation of business or its exigencies or on account of redundancy.
               </li>
            </ol>
         </li>
         <li style="text-align:justify;">
            All documents, plans, drawings, prints, trade secrets, technical information, reports, statements, correspondence etc., written or unwritten and also information and instructions that pass through you or come to your knowledge shall be treated as confidential. You shall not utilize them for your own use or disclose to other persons during or after your employment.<br><br><span style="margin-top:1% !important;">During the course of employment with the Company, you will acquire, gain, generate, gather and develop knowledge of and be given access to business information about products activities, know – how, methods or refinements and business plans and business secrets and other information concerning the products / business of the Company, hereinafter called the “SECRETS”. You will be liable for prosecution for damages for divulgence, sharing or parting any of such information during course of employment and on cessation for at least 2 years period.</span>
         </li>
         <li style="text-align:justify;">
            You shall carry out the job of <b><?php echo $letter_details[0]['designation']; ?></b> and such other jobs connected with or incidental to which is necessary for business of the Company. You shall do any other work assigned to you, which you are capable of doing or work at any other post which has been temporarily assigned to you.
         </li>
         <li style="margin-bottom:70px;text-align:justify;">
            You shall faithfully and to the best of your ability perform your duties that may be entrusted to you from time to time by the management. You will be bound by rules, regulations and orders promulgated by the management in relation to conduct, discipline and policy matters.<br>

            You will not seek membership of any local or public bodies without first obtaining specific permission of the management. In the event of your becoming member without following due process as mentioned , it shall amount to contravention of provision of employment condition and the management reserves the right to take appropriate action including dispensing with your services , as it may deem fit.<br>

            You will not give out to any one, by word of mouth or otherwise, particulars of our business or administrative or organizational matters of a confidential nature which may be your privilege to know by virtue of your being our employee.
         </li><br><br>
         <li style="text-align:justify;">
            While you are in employment of the company, you may be given or handed over company’s property and / or equipment for official use and you shall take care of them including their upkeep. On cessation of employment with the Company, you shall return all documents, books, papers relating to the affairs of the Company, purchased with the Company’s money, which may have come to you, and also any property of the Company in your possession.
         </li>
         <li style="text-align:justify;">
            Any balance of advance or loan taken by you from the Company, shall be fully recovered from your salary and any other legal dues including Gratuity, at the time of you’re leaving the services of the Company.
         </li>
         <li style="text-align:justify;">
            While working as an employee if you enter into any business transaction with any party on behalf of the company within your permissible limits, it shall be your responsibility to ensure recovery of outstanding. If any outstanding remains at the time of leaving the services of the company, it shall be your responsibility to recover for remittance to the company before you proceed to settle your legal dues in full and final settlement of your account.
         </li>
         <li style="text-align:justify;">
            The company is obliged to deduct Income Tax at source as per provision of Income Tax Act / Rules . Accordingly, you are required to submit all required proof of permitted savings / investments and other details from time to time to enable the company to comply with the provisions of law. In the event of non compliance by you as aforesaid if the company is required to pay any interest or payment under Income Tax Act , it shall deduct the amount as may be paid or payable from your salary or other payments and you shall allow the company to comply with these requirements without objection.
         </li>
         <li>
            All disputes arising out of this letter will be subject to the jurisdiction of the Bangalore Court. And that the courts, tribunals and/or authorities at Bangalore only shall have jurisdiction to entertain, try and decide such disputes or differences arising out of or pertaining to this contract of employment, irrespective of your working HQ being elsewhere at that times.
         </li>
      </ol>
      <p style="font-size:12px;line-height:1.8;text-align:justify;"><br>
         <span style="margin-left:0%;">
            You are requested to return the enclosed copy duly signed as a token of your acceptance of the terms and conditions of your employment.</span><br><br>
         <span style="text-align:justify;">
            Hope that this will be the beginning of a long and successful career with us.
         </span>
      </p>
      <table width="100%" border="0">
         <tbody>
            <tr>
               <td colspan="3" style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                     Yours faithfully,<br><br><br>
                     <b>For : Fretus Folks India Pvt Ltd.</b> <br><br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" style="" width="100"><br>
                     <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                  </p>
               </td>
               <td style="font-size:14px;text-align:right;">
                  <p style="line-height:1.8;">
                     <br><br><br><br>
                     <b>Accepted :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br><br>
                     <b>(Signature of an Employee) </b> <br>
                  </p>
               </td>
            </tr>
         </tbody>
      </table><br><br><br><br><br><br>
      <h1 style="font-size:20px;text-decoration:underline;text-align:center;font-weight:bold">Annexure - 1</h1>
      <table class="table table1" border="1" style="align:center;border-collapse:collapse;width:100%;">
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
      </table><br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
         <tbody>
            <tr>
               <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                  <b>For : Fretus Folks India Pvt Ltd.</b> <br><br><br><br>
                  <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                  </p>
               </td>
               <td style="font-size:12px;text-align:right;padding:7px;width:40%">
                  <p style="line-height:1.8;font-size:14px">
                     <br><br><br><br>
                     <b>Accepted :<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b> <br>
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</body>

</html>