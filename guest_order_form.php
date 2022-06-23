<?
include_once '_common.php';
$g5['title'] = "추가물품신청";
?>
<!doctype html>
<html lang="ko">

<head>
	<meta charset="utf-8">
	<meta http-equiv="imagetoolbar" content="no">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=320,initial-scale=1">
	<title>추가물품신청 | ITABUS</title>
	<link rel="stylesheet" href="http://itabus.kr/css/default.css?ver=191202">
	<link rel="stylesheet" href="http://itabus.kr/js/font-awesome/css/font-awesome.min.css?ver=191202">
	<link rel="stylesheet" href="http://itabus.kr/skin/connect/basic/style.css?ver=191202">
	<link rel="stylesheet" href="/css/custom.css?v=1">
	<link href="/css/featherlight.css" type="text/css" rel="stylesheet" />
	<!--[if lte IE 8]>
<script src="http://itabus.kr/js/html5.js"></script>
<![endif]-->
	<script>
		// 자바스크립트에서 사용하는 전역변수 선언
		var g5_url = "http://itabus.kr";
		var g5_bbs_url = "http://itabus.kr/bbs";
		var g5_is_member = "1";
		var g5_is_admin = "super";
		var g5_is_mobile = "";
		var g5_bo_table = "";
		var g5_sca = "";
		var g5_editor = "";
		var g5_cookie_domain = "";
	</script>
	<script src="http://itabus.kr/js/jquery-1.12.4.min.js"></script>
	<script src="http://itabus.kr/js/jquery-migrate-1.4.1.min.js"></script>
	<script src="http://itabus.kr/js/jquery.menu.js?ver=191202"></script>
	<script src="http://itabus.kr/js/common.js?ver=191202"></script>
	<script src="http://itabus.kr/js/wrest.js?ver=191202"></script>
	<script src="http://itabus.kr/js/placeholders.min.js"></script>
	<script src="http://itabus.kr/js/featherlight.js"></script>
</head>

<body>
	<div id="hd_wrapper" style="height:100px;width: 100%">
		<div id="logo" style="padding:10px 0 0;">
			<a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/nemo.png" style="height:80px;" alt="<?php echo $config['cf_title']; ?>"><img src="<?php echo G5_IMG_URL ?>/logo2.png" alt="<?php echo $config['cf_title']; ?>"></a>
		</div>
	</div>
	<?
	//include_once '_head.php';

	/*
if(!($member['mb_level']>4 && $member['mb_level']!=6)) alert('권한이 없습니다');
*/

	//주문기록
	if ($mode == 'finish') {
		echo "<h5 style='font-size:32px;font-weight:bold;color:#555;'>주문 접수 완료</h1>";
		exit;
	}
	if ($mode == 'order') {

		$orderer = $_POST['orderer'];
		$card_qty = $_POST['card_qty'];
		$rill_qty = $_POST['rill_qty'];
		$order_amount = $_POST['order_amount'];
		$order_name = $_POST['order_name'];
		$order_address = $_POST['order_address'];
		$order_phone = preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})$/", "\\1-\\2-\\3", preg_replace("/[^0-9]/i", "", $_POST['order_phone']));
		$bank_name = $_POST['bank_name'];
		//	$phone=preg_replace("/[^0-9]/i","",$_POST['order_phone']);
		//preg_replace("/([0-9]{3})([0-9]{2})([0-9]{5})$/","\\1-\\2-\\3" ,preg_replace("/[^0-9]/i","",$_POST['order_phone']))

		if (!is_numeric($card_qty) && !is_numeric($rill_qty)) alert('주문수량을 입력해주세요');
		if (!$orderer) alert('주문자명을 정확히 입력해주세요.');
		if (!$order_address) alert('배송주소를 정확히 입력해주세요.');
		if (!$order_name) alert('수령인 이름을 정확히 입력해주세요.');
		if (!$order_phone) alert('수령인 연락처를 정확히 입력해주세요.');
		if (!$bank_name) alert('입금자 이름을 정확히 입력해주세요.');

		$order_amount2 = $card_qty * 4000 + $rill_qty * 2500;
		if ($order_amount2 < 30000) $order_amount2 = $order_amount2 + 3000;



		//if($order_amount!=$order_amount2) alert('입력값에 문제가 있습니다');

		$sql = "insert into ita_guest_order  
								set orderer='{$orderer}', 
								card_qty='{$card_qty}', 
								rill_qty='{$rill_qty}', 
								order_amount='{$order_amount2}', 
								order_name='{$order_name}',
								order_address='{$order_address}',
								order_phone='{$order_phone}',
								bank_name='{$bank_name}',
								order_date=now(), 
								order_state='0'";
		//echo $sql;
		sql_query($sql);
		alert("신청되었습니다.", "guest_order_form.php?mode=finish");
		exit;
	}

	/*
//레벨5가지사
if($member['mb_level']=='5' && $member['mb_1']) $orderer=$member['mb_1'];

if(!$orderer) $orderer='2003';




$br=sql_fetch("select * from ita_orderer where id='{$orderer}'");

$orderStateArr['0']='주문접수';
$orderStateArr['1']='입금확인/배송준비';
$orderStateArr['2']='배송중';
$orderStateArr['3']='배송완료';
*/

	?>
	<div class="tbl_head01 tbl_wrap">
		<form name="theForm" id="theForm" method="post">
			<input type='hidden' name='mode' value='order' />
			<table>
				<caption>주문서</caption>
				<tbody>

					<tr>
						<th colspan="2" style="font-size:18px;">추가물품주문서</th>
					</tr>
					<tr>
						<th style="width:30%;">주문자명</th>
						<td><input type="text" name='orderer' id='orderer' value="" min=0 class="frm_input" style="min-width:150px;" /></td>
					</tr>
					<tr>
						<th>카드주문</th>
						<td><input type="number" name='card_qty' id='card_qty' value="" min=0 class="frm_input" style="width:20%;max-width:100px;text-align: center" onchange="calc_amount();" /> 장</td>
					</tr>
					<tr>
						<th>릴고리주문</th>
						<td><input type="number" name='rill_qty' id='rill_qty' value="" min=0 class="frm_input" style="width:20%;max-width:100px;text-align: center" onchange="calc_amount();" /> 개</td>
					</tr>
					<tr>
						<th>주문금액</th>
						<td>
							<input type="text" name='order_amount' id='order_amount' value="" readonly class="frm_input" style="width:20%;border:none;background:transparent;box-shadow: none;text-align:center;" />
							(배송비 포함, 3만원 이상 주문시 배송비(3,000원) 무료)
						</td>
					</tr>
					<tr>
						<th>배송주소</th>
						<td>
							<input type="text" name='order_address' id='order_address' value="<?= $br['address'] ?>" min=0 class="frm_input" style="min-width:100%;max-width:600px;" />
						</td>
					</tr>
					<tr>
						<th>수령인</th>
						<td><input type="text" name='order_name' id='order_name' value="<?= $br['owner'] ?>" min=0 class="frm_input" style="min-width:150px;" /></td>
					</tr>
					<tr>
						<th>수령인 연락처</th>
						<td><input type="text" name='order_phone' id='order_phone' value="<?= $br['phone'] ?>" min=0 class="frm_input" style="min-width:150px;" /></td>
					</tr>
					<tr>
						<th>입금계좌</th>
						<td><strong>신한은행 100-033-876766 주식회사 아이커넥트</strong>
							&nbsp; &nbsp; &nbsp; <span style="color:red;">* 입금확인후 배송 하고 있습니다. </span></td>
					</tr>
					<tr>
						<th>입금자이름</th>
						<td>
							<input type="text" name='bank_name' value="<?= $br['owner'] ?>" class="frm_input" style="min-width:150px;text-align: center" />
							&nbsp; &nbsp; &nbsp; <span style="color:red;">* 입금하실분의 이름을 정확히 입력해주세요. </span>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="padding:10px;text-align: center">
				<input type="submit" id="form_submit" class="btn btn_b02" value="    주문하기    " style="display:none" />
				<input type="button" id="submit" class="btn btn_b02" value="    주문하기    " onclick="button_event();">
			</div>
		</form>
	</div>
	<script>
		function calc_amount() {
			var card_qty = $("#card_qty").val();
			var rill_qty = $("#rill_qty").val();
			var calc_amount = card_qty * 4000 + rill_qty * 2500;
			if (calc_amount < 30000) calc_amount = calc_amount + 3000;
			$("#order_amount").val(calc_amount);
		}

		$(document).ready(function() {
			$('#submit').click(function() {
				if ($('#orderer').val() == '') {
					alert('주문자명을 정확히 입력해주세요.');
					return;
				}
				if ($('#card_qty').val() == '' && $('#rill_qty').val() == '') {
					alert('주문수량을 입력해주세요.');
					return;
				}
				if ($('#order_address').val() == '') {
					alert('배송주소를 정확히 입력해주세요.');
					return;
				}
				if ($('#order_name').val() == '') {
					alert('수령인 이름을 정확히 입력해주세요.');
					return;
				}
				if ($('#order_phone').val() == '') {
					alert('수령인 연락처를 정확히 입력해주세요.');
					return;
				}
				if ($('#bank_name').val() == '') {
					alert('입금자 이름을 정확히 입력해주세요.');
					return;
				}
				if (confirm("주문 내용이 맞습니까?") == true) { //확인
					$('#form_submit').click();
				} else { //취소
					return;
				}
				return true;
			});

		});
	</script>
</body>

</html>