<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
					<meta content="telephone=no" name="format-detection" />
					<title>Fretus Folks</title>
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
						.content1 p { padding:0 !important;margin-bottom: 1% !important;font-family: times; } 
						ol {font-family: times; } 
						ol li {margin-top:1%;line-height:2}
						
						.table1 td,.table1 th 
						{
							    border: 1px solid black;
						}
						table td,th
						{
							font-family: times;
							font-size:14px;
							  padding-right: 1%;
							  padding-left: 1%;
							   text-align:left
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
						
							p { padding:0 !important; margin:0 !important;font-family: times; } 
							.content1 p { padding:0 !important;margin-bottom: 1% !important;font-family: times; } 
							ol {font-family: times; } 
							ol li {margin-top:1%;line-height:2}
							.table1 td,.table1 th 
								{
										border: 1px solid black;
								}	
								.gross td
								{
									background: #ecbfbf !important;
								}
							table td,th
							{
								font-family: times;
								font-size:14px;
								padding-right: 1%;
								padding-left: 1%;
								text-align:left
							}
						}
					</style>
					<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
				</head>
	<body onload="window.print()" class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none"> 
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
											<tr>
												
												<td style="padding-left:5%;padding-right:5%;">
													 <img src="<?php echo base_url()?>admin_assets/ffi_header.jpg">
													<div>
														<div style="color:#000;font-size: 21px;margin-top: 4%;margin-bottom: 0%;">
																											
														<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
															<div> 
																
																
															</div>
														</div>
											<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
												
												<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
													<tbody>
													  <tr>
														<td colspan="3" style="font-size:12px;text-align:left;padding:0px;width:80%">
														<p style="line-height:1.8;font-size:14px"><b>Date : <?php echo date("d-m-Y",strtotime($pip[0]['date']));?></b></p> 
														
																<p style="line-height:1.8;font-size:14px">	
																
																<b>To, 
																<br>Mr./Mrs./Ms, <?php echo $pip[0]['emp_name'];?></b>
																<br><?php echo $pip[0]['emp_id'];?></b> 
																<br><?php echo $pip[0]['location'];?></b> <br>
																</p>
														  </td>
														  <td style="font-size:12px;text-align:left;padding:0px;">
																
														  </td>
													  </tr>
													</tbody>
												</table>
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Sub : Termination of Employment</b></p>
													</div>
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Dear <?php echo $pip[0]['emp_name'];?>,</b></p>
													</div>
													<br>
													<div class="content1" style="line-height:2;font-size:14px">
														 This is further to our letters referred above calling upon you to report for duty immediately or to intimate to us in writing the reason for your unauthorized absence since the <span><strong><?php echo date("d-m-Y",strtotime($pip[0]['absent_date']));?> </strong><span> kindly submit all the assets with to the company. You have neither resumed duty nor provided any explanation for your continued unauthorized absence. In the circumstances, we are treating your unauthorized absence as voluntary abandonment of service, as communicated to you earlier vide our letter date  <span><strong><?php echo date("d-m-Y",strtotime($pip[0]['show_cause_date']));?></strong><span> above.
														Consequently, as permitted under the terms of your appointment letter, your employment with Fretus Folks India Pvt Ltd shall stand terminated effective from closing of  office hours  on <span><strong> <?php echo date("d-m-Y",strtotime($pip[0]['termination_date']));?></strong><span>
														Kindly note that as per terms and conditions of your appointment letter, you were to serve 15 days’ notice or compensate salary in lieu thereof.
														Please be informed that we are completing your full & final settlement formalities and there are no dues payable to you as per our records, after recovery of the notice period compensation due to the company.  The relieving letter and service certificate can be issued only after receipt of (a) your resignation letter along with your (b) supervisor’s formal no-due clearance, within seven days, after which, we regret, we cannot entertain any further queries on this matter.

													</div>
												
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p>Yours faithfully, </p>
													</div>
													 <br>
													
														<table style="border-collapse:collapse;width:100%;margin-bottom:0px;">
															<tbody>
															  <tr>
																<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
																		<p style="line-height:1.8;font-size:14px">	
																		 
																		<b>For : Fretus Folks India Pvt Ltd.</b> <br> 
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>admin_assets/seal.png" width="100">
<br> 																		
																		<b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
																		</p>
																  </td>
															  </tr>
															</tbody>
														</table>
											</div>
														</div>
														<br>
													</div>
													 
												</td>
											</tr>
										</tbody>
										</table>
										<img class="abc" src="<?php echo base_url()?>admin_assets/ffi_footer.jpg" > 
	</body>
</html>