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

 <body>
    <div style="position: absolute;
                  top: 117px;
                  right: 20px;
                  font-size: 18px;margin:0 35px">
       <p style="line-height:1.8;font-size:14px;font-family:times; ">
          <span>Date :<b><?php echo date("d-m-Y", strtotime($letter_details[0]['joining_date'])); ?></b> </span> <br>
       </p>
    </div>

    <div style="margin:0 35px">
       <p style="line-height:1.8;font-size:14px;font-family:times;">
          <span><b>To</b></span><br>
          <span><b> Mr. /Mrs. /Ms. : <?php echo $letter_details['emp_name']; ?></b></span> <br>
          <span>Employee ID : <?php echo $letter_details['ffi_emp_id']; ?></span> <br>
          <span>Place : <?php echo $letter_details['location']; ?></span> <br>
       </p>
    </div>

    <br>
    <div class="content" style="margin:0 35px;line-height:2;font-size:14px">
       <p style="line-height:1.8;font-size:14px"><b>Sub : Increment Letter</b></p>
    </div>

    <div class="content" style="margin:0 35px;line-height:2;font-size:14px">
       <p style="line-height:1.8;font-size:14px"><b>Dear <?php echo $letter_details['emp_name']; ?>,</b></p>
    </div>
    
    <div class="content1" style="margin:0 35px;line-height:1.8;font-size:14px;overflow:wrap">
       <?php echo $letter_details['content']; ?>
    </div>
    <br>
    <br>
    <table style="border-collapse:collapse;width:100%;margin:0 35px 160px;">
       <tbody>
          <tr>
             <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                <p style="line-height:1.8;font-size:14px">
                   <br>
                   <b>For : Fretus Folks India Pvt Ltd.</b> <br>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
                   <br>
                   <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                </p>
             </td>
             <td style="font-size:12px;text-align:right;padding:7px;width:40%">
                <p style="line-height:1.8;font-size:14px">
                   <br>
                   <b>I accept:</b> <br><br><br>
                   <b>Signature and Date</b> <br>
                </p>
             </td>
          </tr>
       </tbody>
    </table>

    <table width="100%" border="0" cellspacing="0">
       <tbody>
          <tr>
             <td style="padding-left:5%;padding-right:5%;">
                <div style="margin:0 35px;color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
                   <h1 style="font-size:16px;text-align:center;text-decoration: underline; ">Annexure - 1 
                  </h1><br>
                   <center>
                      <table cellpadding="10px" class="table table1" border="1" style="border-collapse:collapse; width:80%;margin-bottom:0px;font-size: 10px;">
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
                               <td><?php echo $letter_details['basic_salary']; ?></td>
                               <td><?php echo ($letter_details['basic_salary'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>HRA</td>
                               <td><?php echo $letter_details['hra']; ?></td>
                               <td><?php echo ($letter_details['hra'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Conveyance</td>
                               <td><?php echo $letter_details['conveyance']; ?></td>
                               <td><?php echo ($letter_details['conveyance'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Medical Reimbursement</td>
                               <td><?php echo $letter_details['medical_reimbursement']; ?></td>
                               <td><?php echo ($letter_details['medical_reimbursement'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Special Allowance</td>
                               <td><?php echo $letter_details['special_allowance']; ?></td>
                               <td><?php echo ($letter_details['special_allowance'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Other Allowance</td>
                               <td><?php echo $letter_details['other_allowance']; ?></td>
                               <td><?php echo ($letter_details['other_allowance'] * 12); ?></td>
                            </tr>
                            <tr class="gross" style="background: #ecbfbf;">
                               <td>Gross Salary</td>
                               <td><?php echo $letter_details['gross_salary']; ?></td>
                               <td><?php echo ($letter_details['gross_salary'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Employee PF @ 12%</td>
                               <td><?php echo $letter_details['emp_pf']; ?></td>
                               <td><?php echo ($letter_details['emp_pf'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Employee ESIC @ 1.75%</td>
                               <td><?php echo $letter_details['emp_esic']; ?></td>
                               <td><?php echo ($letter_details['emp_esic'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>PT</td>
                               <td><?php echo $letter_details['pt']; ?></td>
                               <td><?php echo ($letter_details['pt'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Total Deduction</td>
                               <td><?php echo $letter_details['total_deduction']; ?></td>
                               <td><?php echo ($letter_details['total_deduction'] * 12); ?></td>
                            </tr>
                            <tr class="gross" style="background: #ecbfbf;">
                               <td>Take-home</td>
                               <td><?php echo ($letter_details['take_home']); ?></td>
                               <td><?php echo (($letter_details['take_home']) * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Employer PF</td>
                               <td><?php echo $letter_details['employer_pf']; ?></td>
                               <td><?php echo ($letter_details['employer_pf'] * 12); ?></td>
                            </tr>
                            <tr>
                               <td>Employer ESIC</td>
                               <td><?php echo $letter_details['employer_esic']; ?></td>
                               <td><?php echo ($letter_details['employer_esic'] * 12); ?></td>
                            </tr>
                            <tr class="gross" style="background: #ecbfbf;">
                               <td>CTC</td>
                               <td><?php echo ($letter_details['ctc']); ?></td>
                               <td><?php echo (($letter_details['ctc']) * 12); ?></td>
                            </tr>
                         </tbody>
                      </table>
                      <table style="border-collapse:collapse;width:100%;margin-top:15px;">
                         <tbody>
                            <tr>
                               <td colspan="3" style="font-size:12px;text-align:left;padding:7px">
                                  <p style="line-height:1.8;font-size:14px">
                                     <br><b>For : Fretus Folks India Pvt Ltd.</b> <br>
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
                                     <br><b>&nbsp;&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br></p>
                               </td>
                               <td style="font-size:12px;text-align:right;padding:7px;width:40%">
                                  <p style="line-height:1.8;font-size:14px">
                                     <br>
                                     <b>I accept:</b> <br><br><br>
                                     <b>Signature and Date</b> <br>
                                  </p>
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </center>
                </div>
             </td>
          </tr>
       </tbody>
    </table>
 </body>

 </html>