<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);
?>
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
      }
		ol li {
			font-size:12px;
			margin-top:-5px;
		}

      b {
         font-weight: bold;
      }
		.salary-details-table
		{
			border-collapse:collapse; 
			width:60%;
			font-size: 10px;
			margin-left:auto;
			margin-right:auto;
		}
		.salary-details-table tr th,
		{
			text-align:left;
			padding:5px 10px;
			width:50%;
		}
		.salary-details-table tr td
		{
			text-align:right;
			padding:5px 10px;
			width:50%;
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
	 }
	 }
   </style>
</head>

<body onload="window.print();">
   <img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
   <br/>
   <img class="abc-bottom" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg">
<h1 style="font-size:18px;text-align:center;text-decoration:underline;margin-top:20px">Offer cum Appointment letter</h1>

<p style="text-align:right;">Date : <b style="font-weight:bold;"><?= date("d-M-Y",strtotime($letter_details[0]['joining_date'])); ?></b></p>

<p style="font-size:14px;line-height:1.5;text-align:justify;">
To, <br/>
<?= ucwords($letter_details[0]['emp_name']); ?> <br/>
S/o <?= ucwords($letter_details[0]['father_name']); ?> <br/>
Emp : <?= $letter_details[0]['employee_id']; ?> <br/>
Address : <?= ucwords($letter_details[0]['location']); ?>
</p>
   
	<p style="margin:20px 0px;">Dear <?= ucwords($letter_details[0]['emp_name']); ?>,</p>

	<p style="font-size:12.7px;line-height:1.5;text-align:justify;">
		We are pleased to offer you employment to work as <?= $letter_details[0]['designation']; ?> as on <?= date("d-M-Y",strtotime($letter_details[0]['joining_date'])); ?> on deputation with our client/s, <b style="font-weight:bold;"><?= ucwords($letter_details[0]['client_name']); ?></b>. for a fixed period of employment, on the following terms and conditions:
	</p>

	<ol>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					You will be working at the site assigned from our client Blue Dart Express Ltd, under this probation if you are found guilty of activities such <b style="font-weight:bold;">as Cash mismanagement, Theft, Bike Meter tampering, Fake delivery, Disrespect to <?= ucwords($letter_details[0]['client_name']); ?> and other delivery associate, irregularity at work,</b> Client is liable to separate you with immediate effect and we shall end your contract on the day of separation from client. 
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					Duration of your contract is <?= $letter_details[0]['tenure_month']; ?>
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					Notwithstanding anything above, depending upon the afore mentioned project/work, the company reserves its right to extend your temporary appointment for such a period or periods as may be necessary depending upon the exigencies relatable to the work for which you are hereby engaged. The same shall be informed to you in advance. In the event, the company shall be in writing extend your temporary assignment on the terms as may be indicated in such extension of the assignment you shall be governed by such terms and conditions as may be indicated therein.
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					You will be entitled for leaves as per shops and establishment act and other applicable laws in India.
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					During the period of fixed contract of <?= $letter_details[0]['tenure_month']; ?>, your services could be deputed at the sole discretion of the management to any of our client’s company to do work pertaining to or incidental to the client’s business. Your service can be transferred from one location to another (within state) as per business requirement
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					 In case of any adverse remarks found from the reference given by you, the documents submitted by you/outcome of the police verification report then this appointment will stand withdrawn immediately.
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					You will not be absent from your duty without sufficient reasons, you will obtain prior written permission / sanction from the supervisor about your absence giving reasons thereof and probable duration immediately, failing which, the same will be treated as loss of Pay. 
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					If you did not report to work for continuous 3 days without proper notification of absenteeism, company is liable to end your contract on immediate basis, on request from client.
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					Client holds the discretion to do a thorough background verification of your candidature as seems fit and can initiate police verification, background check, court cases verification,
				</p>
			</li>
			</ol>
			<div class="pagebreak"> </div>
			<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
			<ol start="10">	
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					If you found guilty in any one of them, Client have the full authority to end your contract immediately and report the findings to nearest police station 
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					You will be governed by the conduct, discipline, rules and regulations as laid down by the management.
				</p>
			</li>
			
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					The salary will be paid to you, subject to the receipt of payment from <?= ucwords($letter_details[0]['client_name']); ?>. (to which you have been deputed). 
				</p>
			</li>
			
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					This contract shall be terminable by either party giving <?=$letter_details[0]['notice_period'];?> days’ notice in writing or salary on lieu of notice, to the other.
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					We are consciously endeavoring to build an atmosphere of trust, openness, responsiveness, autonomy and growth among all members to the Fretus Folks India Pvt Ltd. As a new entrant, we would like you to whole-heartedly contribute in this process. 
				</p>
			</li>
			<li>
				<p style="font-size:12px;line-height:1.5;text-align:justify;">
					As a token of acceptance of the above terms and conditions, you are requested to sign the duplicate copy of this letter and return to us.
				</p>
			</li>
	</ol>

	<p style="font-size:12px;line-height:1.5;text-align:justify;">
		With warm regards,
	</p>

	<table width="100%">
         <tbody>
            <tr>
               <td colspan="3" style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                     <b>For Fretus Folks India Pvt Ltd.</b> <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ;?>admin_assets/seal.png" style="" width="100"><br>
                     <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
	  		<div class="pagebreak"> </div>
			<img class="abc-top" src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
		<h3 style="text-align:center;font-weight:bold;">Annexure Salary Break Up</h3>
		<table class="salary-details-table" border="1">
			<tr>
				<th>Basic + DA</th>
				<td><?= $letter_details[0]['basic_salary']; ?></td>
			</tr>
			<tr>
				<th>HRA</th>
				<td><?= $letter_details[0]['hra']; ?></td>
			</tr>
			<tr>
				<th>Other Allowance</th>
				<td><?= $letter_details[0]['other_allowance']; ?></td>
			</tr>
			<tr style="background-color:#FFC300;">
				<th>Gross Salary</th>
				<td><?= $letter_details[0]['gross_salary']; ?></td>
			</tr>
			<tr>
				<th>Employee PF </th>
				<td><?= $letter_details[0]['emp_pf']; ?></td>
			</tr>
			<tr>
				<th>Employee ESIC </th>
				<td><?= $letter_details[0]['emp_esic']; ?></td>
			</tr>
			<tr>
				<th>PT</th>
				<td><?= $letter_details[0]['pt']; ?></td>
			</tr>
			<tr style="background-color:#B8E6FB;">
				<th>Total Deduction</th>
				<td><?= $letter_details[0]['total_deduction']; ?></td>
			</tr>
			<tr style="background-color:#B8E6FB;">
				<th>Take-home</th>
				<td><?= $letter_details[0]['take_home']; ?></td>
			</tr>
			<tr>
				<th>Employer PF</th>
				<td><?= $letter_details[0]['employer_pf']; ?></td>
			</tr>
			<tr>
				<th>Employer ESIC</th>
				<td><?= $letter_details[0]['employer_esic']; ?></td>
			</tr>
			<tr style="background-color:#FFC300;">
				<th>CTC</th>
				<td><?= $letter_details[0]['ctc']; ?></td>
			</tr>
			<tr style="background-color:#FFC300;">
				<th>Annual CTC</th>
				<td><?= 12 * $letter_details[0]['ctc']; ?></td>
			</tr>
		</table>

		<table width="100%" style="margin-top:75px;">
         <tbody>
            <tr>
               <td colspan="3" style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                     <b>For Fretus Folks India Pvt Ltd.</b> <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ;?>admin_assets/seal.png" style="" width="100"><br>
                     <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                  </p>
               </td>
					<td colspan="3" style="font-size:14px;text-align:left;">
                  <p style="line-height:1.8;">
                    Name : <b style="font-weight:bold;"><?= ucwords($letter_details[0]['emp_name']); ?></b><br/><br/><br/><br/>
						  Signature: 
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
</body>

</html>
