<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fretus Folks</title>
   <style>
      p {
         text-align: justify;
      }

      .table1 td {
         font-size: 12px;
      }

      td:nth-child(2),
      td:nth-child(3) {
         text-align: right;
      }
      .table1 tr td,.table1 tr th{
         padding:10px 15px;
      }
		.abc-bottom{
		 width:100%;
		 position: fixed;
		 bottom: 0;
	 }
		@media print {
    .pagebreak { page-break-before: always; }
	 @page { margin: 0 50px; }
	 .abc-bottom{
		 width:100%;
		 position: fixed;
		 bottom: 0;
	 }}
	 }
   </style>
</head>

<body onload="window.print();">
<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
   <br/>
   <img class="abc-bottom" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg">
      <table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
         <tbody>
            <tr>
               <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                  <p style="line-height:1.8;font-size:14px !important;">
                     <b>Offer No :</b> <?php echo $letter_details[0]['employee_id']; ?> <br>

               </td>
               <td style="font-size:12px;text-align:right;padding:7px;width:30%">
                  <p style="line-height:1.8;font-size:14px">
                     <b>Date :</b> <?php echo date("d-M-Y", strtotime($letter_details[0]['joining_date'])); ?>
                  </p>
            </tr>
         </tbody>
      </table>
   <h4 style="text-align: center;text-decoration: underline;margin-bottom:30px;">OFFER LETTER</h4>
      <p style="line-height:1.8;font-size:13px;">
         <span><b>To,</b></span> <br>
         <span><b>/Mrs. /Ms. : <?php echo $letter_details[0]['emp_name']; ?></b></span> <br>
         <span><b>S/o <?php echo $letter_details[0]['father_name']; ?></span></b> <br>
         <span><b>Location : <?php echo $letter_details[0]['location']; ?></b></span> <br>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span style="margin-left:0%;">
            We are pleased to offer you employment at <b>Fretus Folks India Pvt Ltd.</b> for a fixed period of employment as per the following terms:
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span style="margin-left:0%;">
            <b style="text-decoration: underline;"> DEPUTATION: </b> You are deputed to <b><?php echo $letter_details[0]['client_name']; ?></b> under this contract. The terms of employment is exclusively with <b>Fretus Folks India Pvt Ltd.</b> which are summarised as under.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span style="margin-left:0%;">
            You will with effect from be deputed by <b>Fretus Folks India Pvt Ltd.</b> to work at client's office / premises at any of their locations.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span style="margin-left:0%;">
            <b style="text-decoration: underline;"> TENURE: </b> The term of your Contract will be valid till <b><?php echo $letter_details[0]['tenure_month'];?></b> months from the date of joining
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span style="margin-left:0%;">
            <b style="text-decoration: underline;">POSITION: </b> You are appointed as <b><?php echo $letter_details[0]['designation'];?></b>.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">REMUNERATION: </b> The details of your salary break up with components are as per the enclosure attached herewith in annexture – A.
         </span>
      </p>
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">EXTENSION: </b> Unless otherwise notified to you in writing this contract of employment would be valid till  from the date of your joining <b>Fretus Folks India Pvt Ltd.</b>
            This contract may be considered for an extension depending on the client and <b>Fretus Folks India Pvt Ltd.</b> requirements. The extension of contract period would be considered on fresh terms as agreed between you and Fretus <b>Fretus Folks India Pvt Ltd.</b> through a separate mutually executed contract of employment. <b>Fretus Folks India Pvt Ltd.</b> shall inform you in writing of the extension requirements, if any.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">WORKING HOURS: </b> You will follow the working hours of the client where you will be deputed. You may have to work on shifts, based on the client's requirement. Your attendance will be maintained by the Reporting Officer of the client, who shall at the end of the month share the attendance with the contact person at <b>Fretus Folks India Pvt Ltd.</b> for pay-roll processing.
         </span>
      </p>
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">TERMINATION & SUSPENSION: </b> At the time of termination of the employment either due to termination by either you or the Company or upon the lapse of the term of employment, if there are any dues owing from you to the Company, the same may be adjusted against any money due to you by the Company on account of salary including bonus or any other payment owned to you under the terms of your employment.  
         </span>
      </p>
      <p style="font-size:12px;line-height:1.8;">
         <span>
         During the tenure of your Contract, any deviation or misconduct in any form that were noticed by the company  or if there are any breach of internal policies or any regulation that was mutually agreed to be complied with, <b>Fretus Folks India Pvt Ltd.</b> or principal employer has the rights and authority to suspend your services until you are notified to resume work in writing. <b>Fretus Folks India Pvt Ltd.</b> reserves all such right to withheld full or a portion of your salary during such suspension period.
         </span>
      </p>
		<div class="pagebreak"> </div>
		<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">NOTICE PERIOD: </b> In the eventuality if you wish to separate from the organization you will need to serve 7day's notice in writing or 7 day's basic pay in lieu thereof. The Contract can be terminated at the discretion of , <b>Fretus Folks India Pvt Ltd.</b> subject to 7 day's noticeor basic pay in lieu thereof. However due to breach of code of conduct, misbehavior  or indiscipline etc, then in such cases, <b>Fretus Folks India Pvt Ltd.</b> will have / reserve rights to terminate immediately without giving notice period.

         </span>
      </p>
		
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">INDEMNITY: </b> You shall be responsible for protecting any property of the Client entrusted to you in the due discharge of your duties and you shall indemnify the Client if there is a loss of any kind to the said property.To the fullest extent permitted by the Applicable Law, you shall hold the Client, its agents, employees and assigns, free and harmless and indemnify and defend Client from and against any and all suits, actions, proceedings, claims, demands, liabilities, costs and charges, legal expenses, damages or penalties of any nature actually or allegedly arising out of or related to your services at the Location or to any alleged actions or omissions by you, including, but not limited to, those resulting from, or claimed to result from injury, death or damage to you.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">TRANSFER: </b> You are liable to be transferred to any other department of the Client or <b>Fretus Folks India Pvt Ltd.</b> or at any other branches across India in which the client or <b>Fretus Folks India Pvt Ltd</b> or any of the employer subsidiary company has any kind of interest. That also upon such transfer, the present terms and conditions shall be applicable, to such a post or at the place of transfer.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">CODE OF CONDUCT: </b> You shall not engage in any act subversive of discipline in the course of your duty/ies for the Client either within the Client's organization or outside it, and if you were at any time found indulging in such act/s, the Company shall reserve the right to initiate disciplinary action as is deemed fit against you.
         </span>
      </p>
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">ADDRESS FOR COMMUNICATION: </b> The address of communication for the purpose of service of notice and other official communication to the company shall be the registered address of the company which is, <b>Fretus Folks India Pvt Ltd. No. M 20, 3rd Floor, UKS Heights, Sector XI, Jeevan Bhima Nagar,Bangalore-560075.</b> The address of communication and service of notice and other official communication is the address set out as above and your present residential address namely. In the event there is a change in your address, you shall inform the same in writing to the Management and that shall be the address last furnished by you, shall be deemed to be sufficient for communication and shall be deemed to be effective on you.
         </span>
      </p>

     
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">BACKGROUND VERIFICATION: </b> The company reserves the right to have your back ground verified directly or through an outside agency. If on such verification it is found that you have furnished wrong information or concealed any material information your services are liable to be terminated.
         </span>
      </p>
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">ABSENTEEISM: </b> You should be regular and punctual in your attendance. If you remain absent for 3 consecutive working days or more without sanction of leave or prior permission or if you over stay sanctioned leave beyond 3 consecutive working days or more it shall be deemed that you have voluntarily abandonment your employment with the company and your services are liable to be terminated accordingly.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">RULES AND REGULATIONS: </b> You shall be bound by the Rules & Regulations framed by the company from time to time in relation to conduct, discipline and other service conditions which will be deemed as Rules, Regulation and order and shall form part and parcel of this letter of appointment.
         </span>
      </p>

      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">OTHER TERMS OF CONTRACT: </b> In addition to the terms of appointment mentioned above, you are also governed by the standard employment rules of , <b>Fretus Folks India Pvt Ltd.</b> (as per Associate Manual). The combined rules and procedures as contained in this letter will constitute the standard employment rules and you are required to read both of them in conjunction.
         </span>
      </p>
		<div class="pagebreak"> </div>
		<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">JURISDICTION: </b> Notwithstanding the place of working or placement or the normal or usual residence of the employee concerned or the place where this instrument is signed or executed this Contract shall only be subject to the jurisdiction of the High Court of Judicature of  <b>Delhi At Delhi</b> and its subordinate Courts.
         </span>
      </p>
      <p style="font-size:12px;line-height:1.8;">
         <span>
            <b style="text-decoration: underline;">DEEMED CANCELLATION OF CONTRACT: </b> The Contract stands cancelled and revoked if you do not report to duty within 3 days from the date of joining & your act will be construed as deemed and implied rejection of the offer of employment from your side; hence no obligation would arise on the part of the company in lieu of such Employment Contract issued.
         </span>
      </p>
      <p><b>You are requested to bring the following documents at the time of joining: </b> </p>
      <ol style="font-size:12px;line-height:1.8;">
         <li>Educational Certificates for 10th and 12 standard or the highest qualification held by you.</li>
         <li> Experience Letter / Relieving letter of the past company, if any.</li>
         <li> Latest month pay slip,if any</li>
         <li>Photo ID proof (Aadhar Card/Driving Licence/Election I-Card/Passport/Pan Card).</li>
         <li>Address Proof (Aadhar Card/Driving Licence/Election I-Card/Passport/Pan Card).</li>
         <li>5 passport size photographs</li>
         <li>PAN card, if any.</li>
         <li>UAN Card, if any.</li>
         <li>Aadhaar Card.</li>
      </ol>

      <p style="font-size:12px;line-height:1.8;"><br>
         <span style="margin-left:0%;">
            Here's wishing you the very best in your assignment with us and as a token of your understanding and accepting of the standard terms of employment, you are requested to sign the duplicate copy of this letter and return to us within a day.</span><br /><br />
         <span style="margin-left:0%;">With warm regards,
         </span>
      </p>

      <p style="line-height:1.8;font-size:14px">
         <b>For : Fretus Folks India Pvt Ltd.</b> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ;?>admin_assets/seal.png" style="margin-top:2%;" width="100"><br>
         <b>Authorized Signatory</b> <br>
      </p>
		<div class="pagebreak"> </div>
		<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">

      <div style="color: #000;font-family: Tahoma;font-size: 10px;line-height: 1.5px;text-align: justify; padding-left: 0%;">
         <h1 style="font-size:15px;text-align:center;text-decoration: underline;">Annexure - A</h1>
         <p style="line-height:1.8;font-size:14px ;">
            <span style="margin-left:10%;text-decoration:underline;">
               <b>Compensation Sheet</b> <br>
            </span>
            <span style="margin-left:10%;">Offer No : <?php echo $letter_details[0]['employee_id']; ?> <br></span>
            <span style="margin-left:10%;"> Associate Name : <?php echo $letter_details[0]['emp_name']; ?> <br></span>
            <span style="margin-left:10%;"> Designation : <?php echo $letter_details[0]['designation']; ?> <br></span>
            <span style="margin-left:10%;"> Location : <?php echo $letter_details[0]['location']; ?> <br></span>
         </p><br /><br /><br />
            <table cellpadding="8px" class="table table1" border="1" style="border-collapse:collapse; width:80%;font-size: 10px;margin-left:auto;margin-right:auto;">
               <tbody>
                  <tr>
                     <th >
                        Components
                     </th>
                     <th >
                        Monthly salary
                     </th>
                     <th >
                        Annual salary
                     </th>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">Basic</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['basic_salary']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['basic_salary'] * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">HRA</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['hra']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['hra'] * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">Conveyance</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['conveyance']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['conveyance'] * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">St. Bonus</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['st_bonus']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['st_bonus'] * 12); ?></td>
                  </tr>
                  <tr style="background-color:pink;">
                     <td style="font-size:12px;">Gross Salary</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['gross_salary']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['gross_salary'] * 12); ?></td>
                  </tr>
                  <!-- <tr>
                     <td style="font-size:12px;">Other Allowance</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['other_allowance']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['other_allowance'] * 12); ?></td>
                  </tr> -->
                 
                  <tr>
                     <td style="font-size:12px;">Employee PF</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['emp_pf']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['emp_pf'] * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">Employee ESIC PF</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['emp_esic']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['emp_esic'] * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">PT</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['pt']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['pt'] * 12); ?></td>
                  </tr>
                  <tr style="background-color:pink;">
                     <td style="background: #ecbfbf;">Total Deduction</td>
                     <td style="background: #ecbfbf;"><?php echo $letter_details[0]['total_deduction']; ?></td>
                     <td style="background: #ecbfbf;"><?php echo ($letter_details[0]['total_deduction'] * 12); ?></td>
                  </tr>
                  <tr class="gross" style="background: #ecbfbf;">
                     <td style="font-size:12px;">Take-home</td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['take_home']); ?></td>
                     <td style="font-size:12px;"><?php echo (($letter_details[0]['take_home']) * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">Employer PF</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['employer_pf']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['employer_pf'] * 12); ?></td>
                  </tr>
                  <tr>
                     <td style="font-size:12px;">Employer ESIC</td>
                     <td style="font-size:12px;"><?php echo $letter_details[0]['employer_esic']; ?></td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['employer_esic'] * 12); ?></td>
                  </tr>
                  <tr class="gross" style="background: #ecbfbf;">
                     <td style="font-size:12px;">CTC</td>
                     <td style="font-size:12px;"><?php echo ($letter_details[0]['ctc']); ?></td>
                     <td style="font-size:12px;"><?php echo (($letter_details[0]['ctc']) * 12); ?></td>
                  </tr>
               </tbody>
            </table>
         <p style="margin-top:40px;font-size:13px"><b>Signature</b></p> <br /> <br /><br/>
         <p style="font-size:12px"><b>Name:</b><?php echo $letter_details[0]['emp_name']; ?></p><br/>
         <p style="font-size:12px"><b>Designation:</b> <?php echo $letter_details[0]['designation']; ?></p>

      </div>
		<div class="pagebreak"> </div>
		<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">

      <table>
         <tbody>
            <tr>
               <td colspan="3" style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;font-size:14px !important;margin:0;padding:0">
                     <b>Ref.No. :</b> <?php echo $letter_details[0]['employee_id']; ?> <br>
                  </p>
               </td>
               <td style="font-size:14px;text-align:right;width:20%;padding-left:20px;">
                  <p style="line-height:1.8;font-size:13px;float:right">
                     <b>Date:</b>&nbsp;&nbsp;<?php echo date("d-M-Y", strtotime($letter_details[0]['joining_date'])); ?>
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
      <p style="font-size:12px;margin-top:30px;">
         <b style="font-size:13px">To,</b> <br>
         <b style="font-size:13px">Fretus Folks India Pvt Ltd.,</b><br>
         M 20, 3rd Floor, UKS Heights, <br />
         Sector XI, Jeevan Bhima Nagar, <br />
         Bangalore-560075.
         </b><br>
      </p>
      <p style="font-size:13px">
         <span>
            <b>Subject :- Acknowledgement and receipt of Offer Letter</b>
         </span>
      </p>
      <p style="font-size:12px;margin-bottom:10px;">
         <span>
            Dear Sir,<br /><br />
            I have read and understood the above mentioned terms and conditions of the Contract. I voluntarily accept the same. I have received <b>Fretus Folks India Pvt Ltd.</b> Associate Manual and I shall abide to the terms and conditions mentioned therein and any amendments from time to time.
            <br /><br/>
            On receipt of the first salary, all terms & conditions in this fixed term employment contract would be deemed as acknowledged & accepted.
         </span>
      </p>
      <p style="font-size:12px">
         <span>
            <b>Name:</b><span style="font-size:12px"><?php echo $letter_details[0]['emp_name']; ?></span> <br /><br />
            <p><b>Signature:<span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></b></p><br /> <br />

            <b>Place:</b> <span style="font-size:12px"><?php echo $letter_details[0]['location']; ?></span> <br />
            <b>Date:</b> <span style="font-size:12px"><?php echo date("d-m-Y", strtotime($letter_details[0]['joining_date'])); ?></span> <br />
         </span>
      </p>
</body>

</html>
