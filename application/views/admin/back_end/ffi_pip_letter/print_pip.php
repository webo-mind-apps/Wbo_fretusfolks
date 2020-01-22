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
	<body onload="window.prinat()" class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
												<br>

												<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
											<tr>
												
												<td style="padding-left:5%;padding-right:5%;">
													
													<div>
														<div style="color:#000;font-size: 21px;margin-top: 4%;margin-bottom: 5%;">
																											
														<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
															<div><br>
																
																
															</div>
														</div>
											<div style="color: #000;font-family: Tahoma;font-size: 17px;line-height: 18px;text-align: justify; padding-left: 0%;">
												<h1 style="font-size:23px;text-align:center;">Performance Improvement Plan (PIP)</h1>
												
												<h2 style="font-size:18px;text-align:center;">Confidential</h2>
												
												<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
													<tbody>
													  <tr>
														<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
																<p style="line-height:1.8;font-size:14px">	
																<b>To : <?php echo $pip[0]['emp_name'];?></b> <br>
																<b>From : <?php echo $pip[0]['from_name'];?></b> <br>
																<b>Date : <?php echo date("d-m-Y",strtotime($pip[0]['date']));?></b> <br>
														  </td>
													  </tr>
													</tbody>
												</table>
									
													<div class="content" style="line-height:2;font-size:14px">
														<?php echo $pip[0]['content'];?>
													</div>
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Observations, Previous Discussions or Counseling:</b></p>
														<?php echo $pip[0]['observation'];?>
													</div>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Improvement Goals: These are the goals related to areas of concern to be improved and addressed:</b></p><br>
														<?php echo $pip[0]['goals'];?>
													</div>
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Follow-up Updates: You will receive feedback on your progress according to the following schedule:</b></p>
														<br>
														<?php echo $pip[0]['updates'];?>
													</div>
													<br><br>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Timeline for Improvement, Consequences & Expectations:</b></p>
														<br>
														<?php echo $pip[0]['timeline'];?>
													</div>
													<br>
													<br>
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p style="line-height:1.8;font-size:14px"><b>Signatures:</b></p>
														<p>Employee Name : <?php echo $pip[0]['emp_name'];?></p>
														<p>Employee Signature : __________________</p>
														<p>Date : <?php echo date("d-m-Y",strtotime($pip[0]['date']));?></p>
													</div>
													<br>
													<div class="content" style="line-height:2;font-size:14px">
														<p>Supervisor/Manager Name : <?php echo $pip[0]['from_name'];?></p>
														<p>Supervisor/Manager Signature : __________________</p>
														<p>Date : <?php echo date("d-m-Y",strtotime($pip[0]['date']));?></p>
													</div>
														<table style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr>
																<td colspan="3" style="font-size:12px;text-align:left;padding:7px">
																		<p style="line-height:1.8;font-size:14px">	
																		<br>
																		<b>For : Fretus Folks India Pvt Ltd.</b> <br>
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>admin_assets/seal.png" width="100"><br>
																		<b>&nbsp;&nbsp;&nbsp;Authorized Signatory</b> <br>
																		</p>
																  </td>
															  </tr>
															</tbody>
														</table>
												<br>
												
											</div>

														
														
														
														
														</div>
														<br>
													</div>
												</td>
											</tr>
										</tbody>
										</table>
	</body>
</html>