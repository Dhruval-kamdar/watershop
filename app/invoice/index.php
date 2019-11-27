<?php
	include("../include/config.inc.php");
	//include("session.php");
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$dbfunction1 = new dbfunctions();
	//$dbConn = mysqli_connect(DATABASE_SERVER, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
	$dbfunction = mysqli_query($dbConn,"SELECT * FROM tbl_orders WHERE invoiceNo='".$converter->decode($_GET['id'])."'");
	$objsel = mysqli_fetch_array($dbfunction);

	require_once('tcpdf.php');
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
	// $pdf->SetCreator(PDF_CREATOR);
	// $pdf->SetAuthor('Nicola Asuni');
	// $pdf->SetTitle('TCPDF Example 061');
	// $pdf->SetSubject('TCPDF Tutorial');
	// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	// set default header data
	// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 008', PDF_HEADER_STRING);
	
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}
	$pdf->SetFont('dejaVuSans', '', 12);
	// set some language dependent data:
	$lg = Array();
	$lg['a_meta_charset'] = 'UTF-8';
	$lg['a_meta_dir'] = 'ltr';
	$lg['a_meta_language'] = 'fa';
	$lg['w_page'] = 'page';

	$pdf->setLanguageArray($lg);
	$pdf->AddPage();
	$html0="<table>
		<tr>
			<td height='35'>&nbsp;</td>
			<td height='35'><b>WaterShop - #".$objsel['invoiceNo']."</b></td>
			<td height='35'>&nbsp;</td>
		</tr>
		</table>";
	$pdf->writeHTML($html0, true, false, true, false, '');	
	$pdf->SetFont('dejaVuSans', '', 10);
	$dbfunction1->SimpleSelectQuery("SELECT * FROM `tbl_order_status` WHERE orderStatusId=".$objsel["orderStatus"]);
	$objsel1 = $dbfunction1->getFetchArray();
	$html1 = '
	<table cellpadding="2">
		<tr>
			<td width="60%" align="left">'.date('d/m/Y h:i a').'&nbsp;<b>وصيل:</b></td>
			<td width="40%" align="right">'.$objsel1['orderStatus'].'&nbsp;<b>حالة الطلب:</b></td>
		</tr>
		</table><br><br>';
		$dbfunction = mysqli_query($dbConn,"SELECT * FROM tbl_customers WHERE custId=".$objsel['custId']);
		$objsel1 = mysqli_fetch_array($dbfunction);	
	$html1 .= '
	<table border="1" cellpadding="2" align="right">
		<tr>
			<td width="60%" >'.$objsel1['address'].'&nbsp;<b>العنوان:</b></td>
			<td width="40%" >'.$objsel1['fullName'].'&nbsp;<b>الاسم الكامل:</b></td>
		</tr>
		<tr>
			<td width="60%">'.$objsel1['email'].'&nbsp;<b>البريد الإلكتروني:</b></td>
			<td width="40%">'.$objsel1['phone'].'&nbsp;<b>رقم التواصل:</b></td>
		</tr>
		</table>';
		
	$pdf->writeHTML($html1, true, false, true, false, '');	
	$pdf->SetFont('dejaVuSans', '', 13);
	
	$html2 ='<table>
		<tr>
			<td align="right">تفاصيل المنتج</td>
		</tr>
		</table>';
	$pdf->writeHTML($html2, true, false, true, false, '');	
	$pdf->SetFont('dejaVuSans', '', 10);
		
	$html3 = '
	<table border="1" cellpadding="2" align="right">
		<tr>
			<td width="60%" >'.((strpos($objsel['deliveryTimestamp'], ' ') !== false)?$objsel['deliveryTimestamp']:date('d/m/Y h:i a',$objsel['deliveryTimestamp'])).'&nbsp;<b>وقت التوصيل:</b></td>
			<td width="40%" >'.date("d/m/Y H:i",$objsel['orderTimestamp']).'&nbsp;<b>وقت الطلب:</b></td>
		</tr>
		<tr>
			<td width="60%">'.$objsel['paymentType'].'&nbsp;<b>خيار الدفع:</b></td>
			<td width="40%">'.ucfirst($objsel['orderType']).'&nbsp;<b>نوع الطلب:</b></td>
		</tr>
	</table>';	
	
	if($objsel['orderType']=="charity") { 
	$html3 .= '
	<table border="1" cellpadding="2" align="right">
		<tr>
			<td width="60%" >'.$objsel['charityPhone'].'&nbsp;<b>رقم التواصل:</b></td>
			<td width="40%" >'.$objsel['charityName'].'&nbsp;<b>اسم الجهة الخيرية:</b></td>
		</tr>
		<tr>
			<td width="60%">'.$objsel['charityStreet'].'&nbsp;<b>الشارع:</b></td>
			<td width="40%">'.$objsel['recipientName'].'&nbsp;<b>اسم المستلم:</b></td>
		</tr>
		<tr>
			<td width="60%">'.$objsel['charityNeighbor'].'&nbsp;<b>الحي:</b></td>
			<td width="40%">'.$objsel['charityCity'].'&nbsp;<b>المدينة:</b></td>
		</tr>
		</table>';
	}	
	$pdf->writeHTML($html3, true, false, true, false, '');	
	/*$pdf->SetFont('dejaVuSans', '', 13);
	$html4 ='<table>
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		</table>';
	$pdf->writeHTML($html4, true, false, true, false, '');*/	
	$pdf->SetFont('dejaVuSans', '', 10);
	
	$html ='<table border="1" cellpadding="2" align="right">
		<tr>
			<th width="15%" align="right">المجموع</th>
			<th width="10%" align="right">الكمية</th>
			<th width="30%" align="right">سعر الوحدة</th>
			<th width="30%" align="right">اسم المنتج</th> 
			<th width="15%" align="right">ريال سعودى. رقم</th>
		</tr>';
		$prd = json_decode($objsel['productDetails']);
		for($i=0;$i<count($prd);$i++)
		{
			if(is_numeric($prd[$i]->prdId))
			{
			$dbfunction = mysqli_query($dbConn,"SELECT prdName FROM tbl_products WHERE prdId=".$prd[$i]->prdId);
			$objsel1 = mysqli_fetch_array($dbfunction);
		$html .='<tr>
			<td width="15%" align="right">'. $prd[$i]->prdTotalPrice .CURRENCY .'</td>
			<td width="10%" align="right">'. $prd[$i]->prdQty .'</td>
			<td width="30%" align="right">'. $prd[$i]->prdUnitPrice.CURRENCY." per ".$prd[$i]->qtyUnit .'</td>
			<td width="30%" align="right">'. $prd[$i]->prdName .'</td>
			<td width="15%" align="right">'. ($i+1) .'</td>
			</tr>';
			} } 
	$html .='
		<tr>
			<td width="15%">'. $objsel['subtotal'].CURRENCY .'</td>
			<td width="85%" colspan="4" align="right">:المبلغ الإجمالي</td>
		</tr>
		<tr>
			<td width="15%">'. $objsel['vat'].CURRENCY .'</td>
			<td width="85%" colspan="4" align="right">:الضريبة المضافة</td>
		</tr> 
		<tr>
			<td width="15%">'. $objsel['discount'].CURRENCY .'</td>
			<td width="85%" colspan="4" align="right">:الخصم</td>
		</tr> 

		<tr>
			<td width="15%">'. $objsel['remainBalance'].CURRENCY .'</td>
			<td width="85%" colspan="4" align="right">:الرصيد</td>
		</tr>
		<tr>
			<td width="15%">'. $objsel['grandTotal'].CURRENCY .'</td>
			<td  width="85%" colspan="4" align="right">:مجموع القيمة</td>
		</tr>
	
	</table>';
	$pdf->writeHTML($html, true, false, true, false, '');

	/*if($_SERVER['HTTP_HOST'] == 'localhost'){
		$path = $_SERVER['DOCUMENT_ROOT'] .'/adhmn-web/uploads/pdf/';
	}else{
		$path = $_SERVER['DOCUMENT_ROOT'] .'app/uploads/pdf/';
	}*/
	header("Content-Encoding: None", true);
	//$pdf->Output($path.$filename,'F');
	$pdf->Output();
	//ob_clean();
?>