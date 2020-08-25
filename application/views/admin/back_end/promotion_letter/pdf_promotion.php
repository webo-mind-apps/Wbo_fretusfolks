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
      <div style="margin:0 35px">
      <p style=";font-size:14px;font-family:times; ">
          <span>Date :<b><?php echo date("d-M-Y", strtotime($letter_details[0]['date'])); ?></b> </span> <br>
       </p>
         <p style="font-size:14px;font-family:times; ">
         
         <span><b>To,</b></span><br>
         </p>
         <p style="font-size:14px;font-family:times;">
            <span><b>Associate Name :  <?php echo $letter_details[0]['emp_name']; ?></b></span> <br>
            <span><b>FFI ID : <?php echo $letter_details[0]['employee_id']; ?></b></span> <br>
            <span><b>Designation: <?php echo $letter_details[0]['designation']; ?></span></b> <br>
         </p>
      </div>
      <div class="content" style="margin:0 35px;">
         <p style="font-size:14px"><b>Sub : Promotiont Letter</b></p>
      </div>
      <div class="content" style="margin:0 35px;font-size:14px">
         <p style="font-size:14px">Dear <b><?php echo $letter_details[0]['emp_name']; ?></b>,</p>
      </div>
      <?php
         $content = str_replace("{{effective_date}}", "<b>" . date('d-M-Y', strtotime($letter_details[0]['effective_date'])) . "</b>", $letter_details[0]['content']);
         $content = str_replace("{{Old_Designation}}", "<b>" . $letter_details[0]['old_designation'] . "</b>", $content);
         $content = str_replace("{{Current_Designation}}","<b>"  . $letter_details[0]['designation'] . "</b>", $content);
          $content = str_replace("{{Take_home}}","<b>"  . $letter_details[0]['net_take_home'] . "</b>", $content);
          $content = str_replace("{{ctc_annual}}","<b>"  . ($letter_details[0]['ctc']*12) . "</b>", $content);
         
         ?>
      <div class="content1" style="margin:0 35px">
         <p style="font-size:12px;text-align:justify;"> <?php echo $content; ?></p>
      </div>
      <table style="border-collapse:collapse;width:100%;margin:0 35px">
       <tbody>
          <tr>
             <td colspan="3" style="font-size:12px;text-align:left;">
                <p style=".8;font-size:14px">
                   <br>
                   <b>For : Fretus Folks India Pvt Ltd.</b> <br>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
                   <br>
                   <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                </p>
             </td>
             <td>
                <p style=".8;font-size:14px">
                   <br>
                   <b>I accept:</b> <br><br><br>
                   <b>Signature and Date</b> <br>
                </p>
             </td>
          </tr>
       </tbody>
    </table>
               <div style='page-break-after:always'></div>
                  <div style="margin:0 35px;color: #000;font-family: Tahoma;font-size: 17px;text-align: justify; padding-left: 0%;">
                     <h1 style="font-size:16px;text-align:center;text-decoration: underline; ">Annexure Salary Break Up </h1><br>
                     </div>
                     
                        <table cellpadding="8px" class="table table1" border="1" style="border-collapse:collapse; width:80%;font-size: 10px;margin-left:auto;margin-right:auto;">
                           <tbody>
                           <tr class="gross" style="background: #ecbfbf;">
                                 <th>Particulars</th>
                                 <th>Monthly (INR)</th>
                                 <th>Annual (INR)</th>
                              </tr>
                              <tr>

                                 <td>Basic</td>
                                 <td><?php echo $letter_details[0]['basic_salary']; ?></td>
                                 <td><?php echo ($letter_details[0]['basic_salary']*12); ?></td>
                              </tr>
                              <tr>
                                 <td>HRA</td>
                                 <td><?php echo $letter_details[0]['hra']; ?></td>
                                 <td><?php echo ($letter_details[0]['hra']*12); ?></td>
                              </tr>
                             
                              <tr>
                                 <td>Special Allowance</td>
                                 <td><?php echo $letter_details[0]['st_bonus']; ?></td>
                                 <td><?php echo ($letter_details[0]['st_bonus']*12); ?></td>

                              <tr>
                              <tr>
                                 <td>Statutory Bonus</td>
                                 <td><?php echo $letter_details[0]['special_allowance']; ?></td>
                                 <td><?php echo ($letter_details[0]['special_allowance']*12); ?></td>

                           <tr class="gross" style="background: #ecbfbf;">

                                 <td>Gross Salary</td>
                                 <td><?php echo $letter_details[0]['gross_salary']; ?></td>
                                 <td><?php echo ($letter_details[0]['gross_salary']*12); ?></td>

                              </tr>
                              <tr>
                                 <td>Employee PF</td>
                                 <td><?php echo $letter_details[0]['emp_pf']; ?></td>
                                 <td><?php echo ($letter_details[0]['emp_pf']*12); ?></td>

                              </tr>
                              <tr>
                                 <td>Employee ESIC</td>
                                 <td><?php echo $letter_details[0]['emp_esic']; ?></td>
                                 <td><?php echo ($letter_details[0]['emp_esic']*12); ?></td>

                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>Cost to Company</td>
                                 <td><?php echo $letter_details[0]['ctc']; ?></td>
                                 <td><?php echo ($letter_details[0]['ctc']*12); ?></td>
                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td colspan="3">Employee Deduction</td>
                                
                              </tr>
                              <tr>
                                 <td>Employer PF</td>
                                 <td><?php echo $letter_details[0]['employer_pf']; ?></td>
                                 <td><?php echo ($letter_details[0]['employer_pf']*12); ?></td>

                              </tr>
                              <tr>
                                 <td>Employer ESIC</td>
                                 <td><?php echo $letter_details[0]['employer_esic']; ?></td>
                                 <td><?php echo ($letter_details[0]['employer_esic']*12); ?></td>

                              </tr>
                              <tr class="gross" style="background: #ecbfbf;">
                                 <td>Net Take Home</td>
                                 <td><?php echo $letter_details[0]['net_take_home']; ?></td>
                                 <td><?php echo ($letter_details[0]['net_take_home']*12); ?></td>

                              </tr>
                              
                           </tbody>
                        </table><br>
                     
                     <div style="margin:0 35px">
                     <table style="border-collapse:collapse;width:100%;margin:0 35px 160px;">
                        <tbody>
                           <tr>
                              <td colspan="3" style="font-size:12px;text-align:left;">
                                 <p style=".8;font-size:14px">
                                    <br>
                                    <b>For : Fretus Folks India Pvt Ltd.</b> <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="admin_assets/seal.png" width="100">
                                    <br>
                                    <b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
                                 </p>
                              </td>
                              <td>
                                 <p style=".8;font-size:14px">
                                    <br>
                                    <b>I accept:</b> <br><br><br>
                                    <b>Signature and Date</b> <br>
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
