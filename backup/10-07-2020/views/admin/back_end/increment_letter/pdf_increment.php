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
        .table1 th {
         padding: 3px 3px 3px 3px;
         }
         td:nth-child(2),
         td:nth-child(3) {
         text-align: right;
         padding: 3px 3px 3px 3px;
         }
         td:nth-child(1) {
         text-align: left;
         padding: 3px 3px 3px 3px;
         }
         /* .note li{
            padding-top:10px;
         } */
      </style>
   </head>
   <body>
      <div style="position: absolute;
         top: 117px;
         right: 20px;
         font-size: 18px;margin:0 35px">
      </div>
      <div style="margin:0 35px">
         <p style="line-height:1.5;font-size:14px;font-family:times; ">
            <span><b>Date :<?php echo date("d-M-Y", strtotime($letter_details[0]['date'])); ?></b> </span> <br>
         </p>
         <p style="line-height:1.5;font-size:14px;font-family:times;">
            <span><b>Associate Name :  <?php echo $letter_details[0]['emp_name']; ?></b></span> <br>
            <span><b>FFI ID : <?php echo $letter_details[0]['ffi_emp_id']; ?></b></span> <br>
            <span><b>Designation: <?php echo $letter_details[0]['designation']; ?></span></b> <br>
         </p>
      </div>
      <div class="content" style="margin:0 35px;">
         <p style="line-height:1;font-size:14px"><b>Sub : Increment Letter</b></p>
      </div>
      <div class="content" style="margin:0 35px;font-size:14px">
         <p style="line-height:1;font-size:14px">Dear <?php echo $letter_details[0]['emp_name']; ?>,</p>
      </div>
      <?php
         $content = str_replace("{{effective_date}}", "<b>" . date('d-M-Y', strtotime($letter_details[0]['effective_date'])) . "</b>", $letter_details[0]['content']);
         $content = str_replace("{{current_ctc}}", "<b>Rs. " . $letter_details[0]['ctc'] . "</b>", $content);

         $content = str_replace("{{old_ctc}}", "<b>Rs. " . $letter_details[0]['old_ctc'] . "</b>", $content);
         $content = str_replace("{{Old_Designation}}", "<b>" . $letter_details[0]['old_designation'] . "</b>", $content);
         $content = str_replace("{{Current_Designation}}","<b>"  . $letter_details[0]['designation'] . "</b>", $content);
         $content = str_replace("{{increment_percentage}}%","<b>"  . $letter_details[0]['Increment_Percentage'] . "%</b>", $content);

         
         ?>
      <div class="content1" style="margin:0 35px">
         <p style="font-size:12px;line-height:1;text-align:justify;"> <?php echo $content; ?></p>
      </div>
      <p style="line-height:1.5;font-size:14px;margin:0 35px">
         <br>
         <b>For : Fretus Folks India Pvt Ltd.</b> <br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
         <br>
         <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
      </p>
      <pagebreak />
      <div style="margin:0px 35px 250px 35px;">
         <p style="font-size:14px;line-height:1.5;text-align:justify">
            <b>The following are the revised term  & conditions applicable to you for your deputation at udaan henceforth:</b>
         </p>
         <ol>
            <li>
               <b>Duty & Working days</b>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  You shall be required to work from Monday to Saturday. Leaves can be taken as per the
                  Company’s policy. You shall devote your time, attention and ability towards client (where you are
                  deputed) and shall perform such duties and exercise assigned to you from time to time by the
                  client. You shall also comply with instructions, directions, and rules as laid by the client and your
                  reporting manager at work location.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  You are required to be flexible and to undertake all duties associated with your role diligently.
                  You are also expected to undertake reasonable alternative duties in addition to your normal
                  duties that may be associated with your role and as may be assigned to you by the client, from
                  time to time. The client’s decision in this regard would stand final and abiding.
                  Your Services may be transferred/ deputed either part time or full time to any other client,
                  section, subsidiary or associatedfirm by giving you a prior written notice.
               </p>
            </li>
            <li>
               <b>Period of servicesd and Notice Period</b>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  On successful completion of three months’ service your employment shall be terminated by either you
                  or by us, after giving fifteen days’ notice or compensation in lieu thereof.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  We reserve the right to terminate your employment on grounds of performance or misconduct
                  not being up to expected standards without any notice period or pay. Should you be placed on
                  Performance Improvement Plan, hereinafter referred to as “PIP”, the starting date of PIP will
                  serve as the beginning of your notice period. Should you not performing as per the expectation
                  and we decide that your performance during PIP period was not satisfactory, we shall terminate
                  your employment without giving any further notice or compensation.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  In case of notice pay recovery, the same will be recovered if you leave the client before
                  completion of the notice period.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  If you continue to be employed with us, you shall retire on your 60th birthday or the day
                  immediately preceding such date, if your birthday does not fall on a working day.
               </p>
            </li>
            <li>
               <b>Recovery of Assets</b>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  You shall be provided with an IT Asset or IT login credentials for your allotted work at the
                  client’s location. Upon termination of your engagement with the client, you need to return the IT
                  Asset to the client. In case of any damage to the IT Asset, we shall be entitled to recover the cost of
                  damage or loss of the IT Asset from you. Company, on behalf of the client, has a right to recover any
                  cash or any asset which may be handed over to you by the client at any time during your deputation
                  with the client.
               </p>
            </li>
            <li>
               <b>Service rules, Discipline and Code of conduct</b>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  During your employment with us, you will not associate yourself with such activities which the
                  Company’s opinion may be harmful or detrimental to the interest of theclient or the Company, as
                  the case may be. The Company may take appropriate disciplinary action against you, including
                  without limitation, terminating your employment without notice if you are found to be in
                  violation of any rules, discipline and code of conduct that may be communicated to you by us or
                  by the client and the Company.
               </p>
            </li>
            <li>
               <b>Background verification and other obligations</b>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  Your engagement with us is contingent upon completion of a background verification, including
                  but not limited to confirmation of prior employment, educational background, criminal history
                  check, to our satisfaction. Client may also conduct your background verification and your
                  deputation with the client shall be subject to satisfactory completion of your verification check
                  by the client or any third party that may be engaged by the client for the said purpose.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  You agree and acknowledge that your personal details may be shared by us with the client and/
                  or any third party that may engaged by the client for the purposes of conducting your
                  background verification and you further consent to such disclosure by us in this regard.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  If any time it should emerge that the details provided by you are false / incorrect, or if any
                  material or relevant information has been suppressed or concealed, this appointment will be
                  considered ineffective and would be liable to be terminated immediately without notice.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  If you are at any time found to be guilty of misconduct, commit any breach of this Letter, or
                  refuse or wilfully neglect to perform to the satisfaction of the Company or if we receive any
                  intimation about such breach or misconduct by the Client, the Company may at once, without
                  any previous notice, terminate your appointment.
               </p>
               <p style="font-size:12px;line-height:1.8;text-align:justify;">
                  During your employment with the client or at any time after termination of your services, you
                  shall comply with all confidentiality obligations imposed by the client and/or the client and shall
                  in this respect not disclose to any person, firm, the affairs of the client, their customers or any
                  classified and confidential information.
               </p>
            </li>
         </ol>
      </div>
      <!-- <table width="100%" border="0" cellspacing="0">
         <tbody>
            <tr>
               <td style="padding-left:5%;padding-right:5%;"> -->
               <!-- <pagebreak />
               <div style='page-break-after:always'></div> -->
               <pagebreak />
                  <div style="margin:0 35px;color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                     <h1 style="font-size:16px;text-align:center;text-decoration: underline; ">Annexure - Revised CTC </h1><br>
                     </div>
                     
                        <table cellpadding="8px" class="table table1" border="1" style="border-collapse:collapse; width:80%;font-size: 10px;margin-left:auto;margin-right:auto;">
                           <tbody>
                              <tr>
                                 <th style="font-size:13px;text-align:left;border-top: 1px solid #000;">
                                    Particulars
                                 </th>
                                 <th style="font-size:13px;text-align:left;width:30%;border-top: 1px solid #000;">
                                    Monthly (INR)
                                 </th>
                                 <th style="font-size:13px;text-align:left;width:30%;border-top: 1px solid #000;">
                                    Annual (INR)
                                 </th>
                              </tr>
                              <tr>
                                 <td>Basic+DA</td>
                                 <td><?php echo $letter_details[0]['basic_salary']; ?></td>
                                 <td><?php echo ($letter_details[0]['basic_salary'] * 12); ?></td>
                              </tr>
                              <tr>
                                 <td>HRA</td>
                                 <td><?php echo $letter_details[0]['hra']; ?></td>
                                 <td><?php echo ($letter_details[0]['hra'] * 12); ?></td>
                              </tr>
                              <tr>
                                 <td>Special Allowance</td>
                                 <td><?php echo $letter_details[0]['special_allowance']; ?></td>
                                 <td><?php echo ($letter_details[0]['special_allowance'] * 12); ?></td>
                              </tr>
                              <tr>
                                 <td>Statutory Bonus</td>
                                 <td><?php echo $letter_details[0]['st_bonus']; ?></td>
                                 <td><?php echo ($letter_details[0]['st_bonus'] * 12); ?></td>
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>Gross Salary</td>
                                 <td><?php echo $letter_details[0]['gross_salary']; ?></td>
                                 <td><?php echo ($letter_details[0]['gross_salary'] * 12); ?></td>
                              <tr>
                                 <td>Employer PF</td>
                                 <td><?php echo $letter_details[0]['employer_pf']; ?></td>
                                 <td><?php echo ($letter_details[0]['employer_pf'] * 12); ?></td>
                              </tr>
                              <tr>
                                 <td>Employer ESIC</td>
                                 <td><?php echo $letter_details[0]['employer_esic']; ?></td>
                                 <td><?php echo ($letter_details[0]['employer_esic'] * 12); ?></td>
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>Cost to company</td>
                                 <td><?php echo ($letter_details[0]['ctc']); ?></td>
                                 <td><?php echo (($letter_details[0]['ctc']) * 12); ?></td>
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td colspan="3">Employee Deduction</td>
                              </tr>
                              <tr>
                                 <td>Employee PF</td>
                                 <td><?php echo $letter_details[0]['emp_pf']; ?></td>
                                 <td><?php echo ($letter_details[0]['emp_pf'] * 12); ?></td>
                              </tr>
                              <tr>
                                 <td>Employee ESIC</td>
                                 <td><?php echo $letter_details[0]['emp_esic']; ?></td>
                                 <td><?php echo ($letter_details[0]['emp_esic'] * 12); ?></td>
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>Net Take Home</td>
                                 <td><?php echo ($letter_details[0]['take_home']); ?></td>
                                 <td><?php echo (($letter_details[0]['take_home']) * 12); ?></td>
                              </tr>
                           </tbody>
                        </table><br>
                     <div style="margin:0 35px">
                        <p style="font-size:14px;line-height:1;text-align:justify">
                           <b><u>Note</u></b>
                        </p>
                        <ul>
                           <li> <p style="font-size:12px;line-height:1.5;text-align:justify;">Profession tax and LWF will be deducted as per the statutory laws prevailing at the location of work.</p></li>
                           <li> <p style="font-size:12px;line-height:1.5;text-align:justify;">Employers contribution to Provident Fund (maximum 12% on 1,80,000/- of Basic Salary per annum).</p> </li>
                           <li> <p style="font-size:12px;line-height:1.5;text-align:justify;">Income tax liability arising out of these allowances, perquisites and reimbursements will be borne by the
                              employees.</p>
                           </li>
                           <li> <p style="font-size:12px;line-height:1.5;text-align:justify;">Gratuity is at 4.81% of your basic salary and its payable on separation, subject to completion of 5 years of
                              service in the client with the prevailing acts.</p>
                           </li>
                           <li> <p style="font-size:12px;line-height:1.5;text-align:justify;">Medical insurance, Group Personal Accidental, ESIC will be applicable as per eligibility.</p></li>
                           <li> <p style="font-size:12px;line-height:1.5;text-align:justify;">Incentives, Travel &amp; Daily allowance and reimbursements will be applicable as per role and schemes
                              prevailing from time to time as per policy.</p>
                           </li>
                        </ul>
                     </div>
                     <div style="margin:0 35px">
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
                                    <b>Accepted and Agreed</b> 
                                 </p>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div> 
               <!-- </td>
            </tr>
         </tbody>
      </table> -->
   </body>
</html>