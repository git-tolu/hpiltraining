<?php
include("includes/opendb.php");
	// course registration
// echo print_r($_SESSION["cart_item"]);
$order_C = 'order'.rand(1000, 90000);
$_SESSION['or_code'] = $order_C;
foreach ($_SESSION["cart_item"] as $items) {
	$category = $items["name"];
	$course_id =$items["code"];
	$snnnn = $_SESSION['cart_num'];
	$item_price = $items["quantity"] * $items["price"];
	$total_price = ($items["price"] * $items["quantity"]);
	// $_SESSION['t_amount'] = $total_price;
	// $sql2 = "INSERT INTO `shopping_cart` (`order_code`, `item_code`, `title`, `no_of_seats`, `unit_price`, `total_price`) VALUES ('$order_C', '".$items["code"]."','".$items["name"]."','".$items["quantity"]."','".$items["price"]."','$item_price')";
	// mysqli_query($conn, $sql2);

	// echo $category ;
	// echo $course_id ;
	// echo $snnnn;
}

    if (isset($_POST['name'])) {
        // var_dump($_POST);
        // Grab info from form
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        // $category = mysqli_real_escape_string($conn, $_POST['category']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $phoneno = mysqli_real_escape_string($conn, $_POST['number']);
        // $course_id = mysqli_real_escape_string($conn, $_POST['id']);
		// $course_id = $_GET['id'];

        // Check for empty fields
        // if(empty($name)){ echo 'name cannot be empty <br>';}
        // if(empty($email)){ echo  'email cannot be empty <br>';}
        // if(empty($category)){ echo  'category is required <br>';}
        // if(empty($message)){ echo  'message is required <br>';}

        if(!empty($name) && !empty($email) && !empty($category) && !empty($message) && !empty($phoneno)){
            //    Finally register the program
			$order_C = 'order'.rand(1000, 90000);
$_SESSION['or_code'] = $order_C;
		$total_price = 0;
		foreach ($_SESSION["cart_item"] as $items) {

			$category = $items["name"];
			$course_id = $items["code"];
			$snnnn = $_SESSION['cart_num'];
			$item_price = $items["quantity"] * $items["price"];
			$total_price += ($items["price"] * $items["quantity"]);
			$_SESSION['t_amount'] = $total_price;
			$sql2 = "INSERT INTO `shopping_cart` (`order_code`, `item_code`, `title`, `no_of_seats`, `unit_price`, `total_price`) VALUES ('$order_C', '" . $items["code"] . "','" . $items["name"] . "','" . $items["quantity"] . "','" . $items["price"] . "','$item_price')";
			mysqli_query($conn, $sql2);

			// $total_price = $_SESSION['t_amount'];

			$snnnn = $_SESSION['cart_num'];
		}
		$sql1 = "INSERT INTO course_participant (name, email, course_title, message, phoneno, course_id, grand_total) VALUES ('$name', '$email', '$category', '$message', '$phoneno', '" . $_SESSION['or_code'] . "', '".$_SESSION['t_amount']."')";
		mysqli_query($conn, $sql1);
			unset($_SESSION["cart_item"]);
			$_SESSION["bname"]= $name;
			$_SESSION["bemail"]= $email;
			$_SESSION["bcourse"]= $category;
			$_SESSION["bphone"]= $phoneno;
			header("location: successpage.php?id=$course_id");
            // echo "registered";
        }
    }
	// $id = $_GET['id'];
	// $sql="SELECT * FROM training_course where id  = '$id'";
	// $results=mysqli_query($conn, $sql);
	// $result = mysqli_fetch_array($results);

	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	if (!empty($_GET["action"])) {
		switch ($_GET["action"]) {
			case "add":
				if (!empty($_POST["quantity"])) {
					$productByCode = $db_handle->runQuery("SELECT * FROM training_course WHERE order_code='" . $_GET["code"] . "'");
					$itemArray = array($productByCode[0]["order_code"] => array('name' => $productByCode[0]["title"], 'code' => $productByCode[0]["order_code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["amount"], 'image' => $productByCode[0]["cover_image"]));
	
					if (!empty($_SESSION["cart_item"])) {
						if (in_array($productByCode[0]["order_code"], array_keys($_SESSION["cart_item"]))) {
							foreach ($_SESSION["cart_item"] as $k => $v) {
								if ($productByCode[0]["order_code"] == $k) {
									if (empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
							}
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
						}
					} else {
						$_SESSION["cart_item"] = $itemArray;
					}
				}
				break;
			case "remove":
				if (!empty($_SESSION["cart_item"])) {
					foreach ($_SESSION["cart_item"] as $k => $v) {
						if ($_GET["code"] == $k)
							unset($_SESSION["cart_item"][$k]);
						if (empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
					}
				}
				break;
			case "empty":
				unset($_SESSION["cart_item"]);
				break;
		}
	}
	// echo $_SESSION['cart_num'];
	
?>
<!DOCTYPE html>
<html lang="en-US" data-bt-theme="Avantage 2.2.9">

<!-- Mirrored from training.hpilgroup.com.ng/contact/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Nov 2022 10:29:32 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	 <title>Training Booking &#8211; HPIL Training</title>
	<meta name='robots' content='max-image-preview:large' />
	<link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
	<link rel="alternate" type="application/rss+xml" title="HPIL Training &raquo; Feed" href="../feed/index.html" />
	<link rel="alternate" type="application/rss+xml" title="HPIL Training &raquo; Comments Feed"
		href="../comments/feed/index.html" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<script type="text/javascript">
		window._wpemojiSettings = { "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/72x72\/", "ext": ".png", "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/svg\/", "svgExt": ".svg", "source": { "concatemoji": "https:\/\/training.hpilgroup.com.ng\/lib\/js\/wp-emoji-release.min.js" } };
		/*! This file is auto-generated */
		!function (e, a, t) { var n, r, o, i = a.createElement("canvas"), p = i.getContext && i.getContext("2d"); function s(e, t) { var a = String.fromCharCode, e = (p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, e), 0, 0), i.toDataURL()); return p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, t), 0, 0), e === i.toDataURL() } function c(e) { var t = a.createElement("script"); t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t) } for (o = Array("flag", "emoji"), t.supports = { everything: !0, everythingExceptFlag: !0 }, r = 0; r < o.length; r++)t.supports[o[r]] = function (e) { if (p && p.fillText) switch (p.textBaseline = "top", p.font = "600 32px Arial", e) { case "flag": return s([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) ? !1 : !s([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819]) && !s([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]); case "emoji": return !s([129777, 127995, 8205, 129778, 127999], [129777, 127995, 8203, 129778, 127999]) }return !1 }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]); t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function () { t.DOMReady = !0 }, t.supports.everything || (n = function () { t.readyCallback() }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function () { "complete" === a.readyState && t.readyCallback() })), (e = t.source || {}).concatemoji ? c(e.concatemoji) : e.wpemoji && e.twemoji && (c(e.twemoji), c(e.wpemoji))) }(window, document, window._wpemojiSettings);
	</script>
	<style type="text/css">
		img.wp-smiley,
		img.emoji {
			display: inline !important;
			border: none !important;
			box-shadow: none !important;
			height: 1em !important;
			width: 1em !important;
			margin: 0 0.07em !important;
			vertical-align: -0.1em !important;
			background: none !important;
			padding: 0 !important;
		}
	</style>
	<link rel='stylesheet' id='wp-block-library-css' href='lib/css/dist/block-library/style.min.css' type='text/css'
		media='all' />
	<link rel='stylesheet' id='classic-theme-styles-css' href='lib/css/classic-themes.min.css' type='text/css'
		media='all' />
	<style id='global-styles-inline-css' type='text/css'>
		body {
			--wp--preset--color--black: #000000;
			--wp--preset--color--cyan-bluish-gray: #abb8c3;
			--wp--preset--color--white: #ffffff;
			--wp--preset--color--pale-pink: #f78da7;
			--wp--preset--color--vivid-red: #cf2e2e;
			--wp--preset--color--luminous-vivid-orange: #ff6900;
			--wp--preset--color--luminous-vivid-amber: #fcb900;
			--wp--preset--color--light-green-cyan: #7bdcb5;
			--wp--preset--color--vivid-green-cyan: #00d084;
			--wp--preset--color--pale-cyan-blue: #8ed1fc;
			--wp--preset--color--vivid-cyan-blue: #0693e3;
			--wp--preset--color--vivid-purple: #9b51e0;
			--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
			--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
			--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
			--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
			--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
			--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
			--wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
			--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
			--wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
			--wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
			--wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
			--wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
			--wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');
			--wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');
			--wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');
			--wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');
			--wp--preset--duotone--midnight: url('#wp-duotone-midnight');
			--wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');
			--wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');
			--wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');
			--wp--preset--font-size--small: 13px;
			--wp--preset--font-size--medium: 20px;
			--wp--preset--font-size--large: 36px;
			--wp--preset--font-size--x-large: 42px;
			--wp--preset--spacing--20: 0.44rem;
			--wp--preset--spacing--30: 0.67rem;
			--wp--preset--spacing--40: 1rem;
			--wp--preset--spacing--50: 1.5rem;
			--wp--preset--spacing--60: 2.25rem;
			--wp--preset--spacing--70: 3.38rem;
			--wp--preset--spacing--80: 5.06rem;
		}

		:where(.is-layout-flex) {
			gap: 0.5em;
		}

		body .is-layout-flow>.alignleft {
			float: left;
			margin-inline-start: 0;
			margin-inline-end: 2em;
		}

		body .is-layout-flow>.alignright {
			float: right;
			margin-inline-start: 2em;
			margin-inline-end: 0;
		}

		body .is-layout-flow>.aligncenter {
			margin-left: auto !important;
			margin-right: auto !important;
		}

		body .is-layout-constrained>.alignleft {
			float: left;
			margin-inline-start: 0;
			margin-inline-end: 2em;
		}

		body .is-layout-constrained>.alignright {
			float: right;
			margin-inline-start: 2em;
			margin-inline-end: 0;
		}

		body .is-layout-constrained>.aligncenter {
			margin-left: auto !important;
			margin-right: auto !important;
		}

		body .is-layout-constrained> :where(:not(.alignleft):not(.alignright):not(.alignfull)) {
			max-width: var(--wp--style--global--content-size);
			margin-left: auto !important;
			margin-right: auto !important;
		}

		body .is-layout-constrained>.alignwide {
			max-width: var(--wp--style--global--wide-size);
		}

		body .is-layout-flex {
			display: flex;
		}

		body .is-layout-flex {
			flex-wrap: wrap;
			align-items: center;
		}

		body .is-layout-flex>* {
			margin: 0;
		}

		:where(.wp-block-columns.is-layout-flex) {
			gap: 2em;
		}

		.has-black-color {
			color: var(--wp--preset--color--black) !important;
		}

		.has-cyan-bluish-gray-color {
			color: var(--wp--preset--color--cyan-bluish-gray) !important;
		}

		.has-white-color {
			color: var(--wp--preset--color--white) !important;
		}

		.has-pale-pink-color {
			color: var(--wp--preset--color--pale-pink) !important;
		}

		.has-vivid-red-color {
			color: var(--wp--preset--color--vivid-red) !important;
		}

		.has-luminous-vivid-orange-color {
			color: var(--wp--preset--color--luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-amber-color {
			color: var(--wp--preset--color--luminous-vivid-amber) !important;
		}

		.has-light-green-cyan-color {
			color: var(--wp--preset--color--light-green-cyan) !important;
		}

		.has-vivid-green-cyan-color {
			color: var(--wp--preset--color--vivid-green-cyan) !important;
		}

		.has-pale-cyan-blue-color {
			color: var(--wp--preset--color--pale-cyan-blue) !important;
		}

		.has-vivid-cyan-blue-color {
			color: var(--wp--preset--color--vivid-cyan-blue) !important;
		}

		.has-vivid-purple-color {
			color: var(--wp--preset--color--vivid-purple) !important;
		}

		.has-black-background-color {
			background-color: var(--wp--preset--color--black) !important;
		}

		.has-cyan-bluish-gray-background-color {
			background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
		}

		.has-white-background-color {
			background-color: var(--wp--preset--color--white) !important;
		}

		.has-pale-pink-background-color {
			background-color: var(--wp--preset--color--pale-pink) !important;
		}

		.has-vivid-red-background-color {
			background-color: var(--wp--preset--color--vivid-red) !important;
		}

		.has-luminous-vivid-orange-background-color {
			background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-amber-background-color {
			background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
		}

		.has-light-green-cyan-background-color {
			background-color: var(--wp--preset--color--light-green-cyan) !important;
		}

		.has-vivid-green-cyan-background-color {
			background-color: var(--wp--preset--color--vivid-green-cyan) !important;
		}

		.has-pale-cyan-blue-background-color {
			background-color: var(--wp--preset--color--pale-cyan-blue) !important;
		}

		.has-vivid-cyan-blue-background-color {
			background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
		}

		.has-vivid-purple-background-color {
			background-color: var(--wp--preset--color--vivid-purple) !important;
		}

		.has-black-border-color {
			border-color: var(--wp--preset--color--black) !important;
		}

		.has-cyan-bluish-gray-border-color {
			border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
		}

		.has-white-border-color {
			border-color: var(--wp--preset--color--white) !important;
		}

		.has-pale-pink-border-color {
			border-color: var(--wp--preset--color--pale-pink) !important;
		}

		.has-vivid-red-border-color {
			border-color: var(--wp--preset--color--vivid-red) !important;
		}

		.has-luminous-vivid-orange-border-color {
			border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-amber-border-color {
			border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
		}

		.has-light-green-cyan-border-color {
			border-color: var(--wp--preset--color--light-green-cyan) !important;
		}

		.has-vivid-green-cyan-border-color {
			border-color: var(--wp--preset--color--vivid-green-cyan) !important;
		}

		.has-pale-cyan-blue-border-color {
			border-color: var(--wp--preset--color--pale-cyan-blue) !important;
		}

		.has-vivid-cyan-blue-border-color {
			border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
		}

		.has-vivid-purple-border-color {
			border-color: var(--wp--preset--color--vivid-purple) !important;
		}

		.has-vivid-cyan-blue-to-vivid-purple-gradient-background {
			background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
		}

		.has-light-green-cyan-to-vivid-green-cyan-gradient-background {
			background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
		}

		.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
			background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-orange-to-vivid-red-gradient-background {
			background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
		}

		.has-very-light-gray-to-cyan-bluish-gray-gradient-background {
			background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
		}

		.has-cool-to-warm-spectrum-gradient-background {
			background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
		}

		.has-blush-light-purple-gradient-background {
			background: var(--wp--preset--gradient--blush-light-purple) !important;
		}

		.has-blush-bordeaux-gradient-background {
			background: var(--wp--preset--gradient--blush-bordeaux) !important;
		}

		.has-luminous-dusk-gradient-background {
			background: var(--wp--preset--gradient--luminous-dusk) !important;
		}

		.has-pale-ocean-gradient-background {
			background: var(--wp--preset--gradient--pale-ocean) !important;
		}

		.has-electric-grass-gradient-background {
			background: var(--wp--preset--gradient--electric-grass) !important;
		}

		.has-midnight-gradient-background {
			background: var(--wp--preset--gradient--midnight) !important;
		}

		.has-small-font-size {
			font-size: var(--wp--preset--font-size--small) !important;
		}

		.has-medium-font-size {
			font-size: var(--wp--preset--font-size--medium) !important;
		}

		.has-large-font-size {
			font-size: var(--wp--preset--font-size--large) !important;
		}

		.has-x-large-font-size {
			font-size: var(--wp--preset--font-size--x-large) !important;
		}

		.wp-block-navigation a:where(:not(.wp-element-button)) {
			color: inherit;
		}

		:where(.wp-block-columns.is-layout-flex) {
			gap: 2em;
		}

		.wp-block-pullquote {
			font-size: 1.5em;
			line-height: 1.6;
		}
	</style>
	<link rel='stylesheet' id='bt_bb_content_elements-css'
		href='core/modules/478e514c83/css/front_end/content_elements.crush.css' type='text/css' media='all' />
	<link rel='stylesheet' id='bt_bb_slick-css' href='core/modules/478e514c83/slick/slick.css' type='text/css'
		media='all' />
	<link rel='stylesheet' id='bt_cc_style-css' href='core/modules/9f8e7542cc/style.min.css' type='text/css'
		media='all' />
	<link rel='stylesheet' id='contact-form-7-css' href='core/modules/8516d2654f/includes/css/styles.css'
		type='text/css' media='all' />
	<link rel='stylesheet' id='avantage-style-css' href='core/views/9febec6e99/design.css' type='text/css'
		media='screen' />
	<style id='avantage-style-inline-css' type='text/css'>
		select,
		input {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		input[type="file"]::-webkit-file-upload-button {
			background: #dd0000 !important;
			font-family: Montserrat;
		}

		input[type="file"]::-webkit-file-upload-button:hover {
			-webkit-box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
		}

		.fancy-select ul.options li:before {
			background: #dd0000;
		}

		.fancy-select ul.options li:hover {
			color: #dd0000;
		}

		.btContent a {
			color: #dd0000;
		}

		a:hover {
			color: #dd0000;
		}

		.btText a {
			color: #dd0000;
		}

		body {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btContentHolder table thead th {
			background-color: #dd0000;
		}

		.btAccentDarkHeader .btPreloader .animation>div:first-child,
		.btLightAccentHeader .btPreloader .animation>div:first-child,
		.btTransparentLightHeader .btPreloader .animation>div:first-child {
			background-color: #dd0000;
		}

		.btPreloader .animation .preloaderLogo {
			height: 140px;
		}

		.btLoader>div,
		.btLoader>span {
			background: #dd0000;
		}

		.btErrorPage .bt_bb_column.bt_bb_align_center .bt_bb_headline.bt_bb_dash_top .bt_bb_headline_content:before {
			border-top: 2px solid #dd0000;
		}

		.btErrorPage .bt_bb_column.bt_bb_align_center .bt_bb_headline_subheadline a {
			background: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.mainHeader {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.mainHeader a:hover {
			color: #dd0000;
		}

		.menuPort {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.menuPort nav>ul>li>a {
			line-height: 140px;
		}

		.btTextLogo {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
			line-height: 140px;
		}

		.btLogoArea .logo img {
			height: 140px;
		}

		.btTransparentDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btTransparentLightHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btAccentLightHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btAccentDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btLightDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btHasAltLogo.btStickyHeaderActive .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btAccentGradientHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:before,
		.btTransparentDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:after,
		.btTransparentLightHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:after,
		.btAccentLightHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:after,
		.btAccentDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:after,
		.btLightDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:after,
		.btHasAltLogo.btStickyHeaderActive .btHorizontalMenuTrigger:hover .bt_bb_icon:after,
		.btAccentGradientHeader .btHorizontalMenuTrigger:hover .bt_bb_icon:after {
			border-top-color: #dd0000;
		}

		.btTransparentDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btTransparentLightHeader .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btAccentLightHeader .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btAccentDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btLightDarkHeader .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btHasAltLogo.btStickyHeaderActive .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btAccentGradientHeader .btHorizontalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before {
			border-top-color: #dd0000;
		}

		.btMenuHorizontal .menuPort nav>ul>li.current-menu-ancestor>a:after,
		.btMenuHorizontal .menuPort nav>ul>li.current-menu-item>a:after {
			background-color: #dd0000;
		}

		.btMenuHorizontal .menuPort ul ul li a:hover {
			color: #dd0000;
		}

		.btMenuHorizontal .menuPort ul li.btMenuAlternateHoverDesign ul li a:after {
			background: #dd0000;
		}

		body.btMenuHorizontal .subToggler {
			line-height: 140px;
		}

		.btMenuHorizontal .menuPort>nav>ul>li>ul>li {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btMenuHorizontal .menuPort>nav>ul>li>ul li a:before {
			background: #dd0000;
		}

		.btMenuHorizontal .menuPort>nav>ul>li.btMenuAlternateHoverDesign>ul li a:before {
			background: #000000;
		}

		.btMenuHorizontal.btMenuCenter .logo {
			height: 140px;
		}

		.btMenuHorizontal.btMenuCenter .logo .btTextLogo {
			height: 140px;
		}

		html:not(.touch) body.btMenuHorizontal .menuPort>nav>ul>li.btMenuWideDropdown>ul>li>a {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btMenuHorizontal .topBarInMenu {
			height: 140px;
		}

		.btAccentLightHeader .btBelowLogoArea,
		.btAccentLightHeader .topBar {
			background-color: #dd0000;
		}

		.btAccentDarkHeader .btBelowLogoArea,
		.btAccentDarkHeader .topBar {
			background-color: #dd0000;
		}

		.btAccentDarkHeader:not(.btMenuBelowLogo) .topBarInMenu .btIconWidget:hover {
			color: #dd0000;
		}

		.btAccentTrasparentHeader .btBelowLogoArea,
		.btAccentTrasparentHeader .topBar {
			background-color: #dd0000;
		}

		.btAccentTrasparentHeader .btBelowLogoArea a:hover,
		.btAccentTrasparentHeader .topBar a:hover {
			color: #000000 !important;
		}

		.btAccentTrasparentHeader .btMenuHorizontal .menuPort ul ul li a:hover {
			color: #000000;
		}

		.btLightAccentHeader .btLogoArea,
		.btLightAccentHeader .btVerticalHeaderTop {
			background-color: #dd0000;
		}

		.btLightAccentHeader.btMenuHorizontal.btBelowMenu .mainHeader .btLogoArea {
			background-color: #dd0000;
		}

		.btAccentGradientHeader .btBelowLogoArea,
		.btAccentGradientHeader .topBar {
			background-color: #dd0000;
		}

		.btAccentGradientHeader.btMenuVertical .btVerticalMenuTrigger .bt_bb_icon {
			color: #dd0000;
		}

		.btAlternateGradientHeader .btBelowLogoArea,
		.btAlternateGradientHeader .topBar {
			background-color: #000000;
		}

		.btAlternateGradientHeader.btMenuBelowLogo .menuPort nav>ul>li>a:after {
			background-color: #dd0000;
		}

		.btAlternateGradientHeader.btMenuBelowLogo .topBarInMenu .btIconWidget.btAccentIconWidget .btIconWidgetIcon {
			color: #dd0000;
		}

		.btAlternateGradientHeader.btMenuBelowLogo .topBarInMenu .btIconWidget:hover {
			color: #dd0000;
		}

		.btAlternateGradientHeader.btMenuBelowLogo .topBarInMenu .widget_shopping_cart_content:hover .btCartWidgetIcon:hover {
			color: #dd0000;
		}

		.btAlternateGradientHeader .topBar .btIconWidget.btAccentIconWidget .btIconWidgetIcon {
			color: #dd0000;
		}

		.btAlternateGradientHeader .topBar .btIconWidget:hover {
			color: #dd0000;
		}

		.btAlternateGradientHeader .topBar .btIconWidget .widget_shopping_cart_content:hover .btCartWidgetIcon:hover {
			color: #dd0000;
		}

		.btAlternateGradientHeader .btBelowLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
		.btAlternateGradientHeader .topBar .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents {
			background: #dd0000;
		}

		.btAlternateGradientHeader.btMenuVertical .btVerticalMenuTrigger .bt_bb_icon {
			color: #000000;
		}

		.btLightAlternateHeader .btLogoArea,
		.btLightAlternateHeader .btVerticalHeaderTop {
			background-color: #000000;
		}

		.btLightAlternateHeader:not(.btMenuBelowLogo) .topBarInMenu .btIconWidget.btAccentIconWidget .btIconWidgetIcon {
			color: #dd0000;
		}

		.btLightAlternateHeader:not(.btMenuBelowLogo) .topBarInMenu .btIconWidget:hover {
			color: #dd0000;
		}

		.btLightAlternateHeader:not(.btMenuBelowLogo) .topBarInMenu .widget_shopping_cart_content:hover .btCartWidgetIcon:hover {
			color: #dd0000;
		}

		.btLightAlternateHeader.btMenuBelowLogo .topBarInLogoArea .btIconWidget.btAccentIconWidget .btIconWidgetIcon {
			color: #dd0000;
		}

		.btLightAlternateHeader.btMenuBelowLogo .topBarInLogoArea .btIconWidget:hover {
			color: #dd0000;
		}

		.btLightAlternateHeader.btMenuBelowLogo .topBarInLogoArea .btIconWidget:hover .btIconWidgetText {
			color: #dd0000;
		}

		.btLightAlternateHeader.btMenuBelowLogo .topBarInLogoArea .widget_shopping_cart_content:hover .btCartWidgetIcon:hover {
			color: #dd0000;
		}

		.btLightAlternateHeader .mainHeader .btTextLogo:hover {
			color: #dd0000;
		}

		.btLightAlternateHeader.btMenuHorizontal.btBelowMenu .mainHeader .btLogoArea {
			background-color: #000000;
		}

		.btStickyHeaderActive.btMenuHorizontal .mainHeader .btLogoArea .logo img {
			height: -webkit-calc(140px*0.5);
			height: -moz-calc(140px*0.5);
			height: calc(140px*0.5);
		}

		.btStickyHeaderActive.btMenuHorizontal .mainHeader .btLogoArea .btTextLogo {
			line-height: -webkit-calc(140px*0.5);
			line-height: -moz-calc(140px*0.5);
			line-height: calc(140px*0.5);
		}

		.btStickyHeaderActive.btMenuHorizontal .mainHeader .btLogoArea .menuPort nav>ul>li>a,
		.btStickyHeaderActive.btMenuHorizontal .mainHeader .btLogoArea .menuPort nav>ul>li>.subToggler {
			line-height: -webkit-calc(140px*0.5);
			line-height: -moz-calc(140px*0.5);
			line-height: calc(140px*0.5);
		}

		.btStickyHeaderActive.btMenuHorizontal .mainHeader .btLogoArea .topBarInMenu {
			height: -webkit-calc(140px*0.5);
			height: -moz-calc(140px*0.5);
			height: calc(140px*0.5);
		}

		.btStickyHeaderActive.btMenuBelowLogo.btMenuBelowLogoShowArea.btMenuHorizontal .mainHeader .btLogoArea .topBarInLogoArea {
			height: -webkit-calc(140px*0.5);
			height: -moz-calc(140px*0.5);
			height: calc(140px*0.5);
		}

		.btTransparentDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon:before,
		.btTransparentLightHeader .btVerticalMenuTrigger:hover .bt_bb_icon:before,
		.btAccentLightHeader .btVerticalMenuTrigger:hover .bt_bb_icon:before,
		.btAccentDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon:before,
		.btLightDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon:before,
		.btHasAltLogo.btStickyHeaderActive .btVerticalMenuTrigger:hover .bt_bb_icon:before,
		.btTransparentDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon:after,
		.btTransparentLightHeader .btVerticalMenuTrigger:hover .bt_bb_icon:after,
		.btAccentLightHeader .btVerticalMenuTrigger:hover .bt_bb_icon:after,
		.btAccentDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon:after,
		.btLightDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon:after,
		.btHasAltLogo.btStickyHeaderActive .btVerticalMenuTrigger:hover .bt_bb_icon:after {
			border-top-color: #dd0000;
		}

		.btTransparentDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btTransparentLightHeader .btVerticalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btAccentLightHeader .btVerticalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btAccentDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btLightDarkHeader .btVerticalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
		.btHasAltLogo.btStickyHeaderActive .btVerticalMenuTrigger:hover .bt_bb_icon .bt_bb_icon_holder:before {
			border-top-color: #dd0000;
		}

		.btMenuVertical .mainHeader .btCloseVertical:before:hover {
			color: #dd0000;
		}

		.btMenuHorizontal .topBarInLogoArea {
			height: 140px;
		}

		.btMenuHorizontal .topBarInLogoArea .topBarInLogoAreaCell {
			border: 0 solid #dd0000;
		}

		.btMenuVertical .mainHeader .btCloseVertical:before:hover {
			color: #dd0000;
		}

		.btMenuVertical .mainHeader nav>ul>li.current-menu-ancestor>a,
		.btMenuVertical .mainHeader nav>ul>li.current-menu-item>a {
			background: #dd0000;
		}

		.btMenuVertical .mainHeader .topBarInLogoArea .btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetTitle,
		.btMenuVertical .mainHeader .topBarInLogoArea .btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetText {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btSiteFooter .bt_bb_custom_menu li.bt_bb_back_to_top:before {
			color: #dd0000;
		}

		.btSiteFooter .bt_bb_custom_menu li.bt_bb_back_to_top_alternate_arrow:before {
			color: #000000;
		}

		.btSiteFooterCopyMenu {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btDarkSkin .btSiteFooterCopyMenu {
			background: #dd0000;
		}

		.btSiteFooterCopyMenu .port>div .btFooterMenu ul li a:before {
			background: #dd0000;
		}

		.btDarkSkin .btSiteFooter .port:before,
		.btLightSkin .btDarkSkin .btSiteFooter .port:before,
		.btDarkSkin.btLightSkin .btDarkSkin .btSiteFooter .port:before {
			background-color: #dd0000;
		}

		.btContent .btArticleHeadline .bt_bb_headline a:hover {
			color: #dd0000;
		}

		.btHideHeadline .btPostSingleItemStandard .btArticleHeadline .bt_bb_headline .bt_bb_headline_content {
			color: #000000;
		}

		.btPostSingleItemStandard .btArticleShareEtc>div.btReadMoreColumn .bt_bb_button a {
			background: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif !important;
		}

		.btPostSingleItemStandard .btArticleShareEtc .btTags ul a:hover {
			background: #dd0000;
		}

		.btAboutAuthor {
			border: 2px solid #dd0000;
		}

		.btMediaBox.btQuote:before,
		.btMediaBox.btLink:before {
			background-color: #dd0000;
		}

		.btMediaBox.btQuote p,
		.btMediaBox.btLink p {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.sticky.btArticleListItem .btArticleHeadline h1 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h2 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h3 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h4 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h5 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h6 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h7 .bt_bb_headline_content span a:after,
		.sticky.btArticleListItem .btArticleHeadline h8 .bt_bb_headline_content span a:after {
			color: #dd0000;
		}

		.btPostSingleItemColumns .btTags ul a:hover {
			background: #dd0000;
		}

		.post-password-form p:first-child {
			font-family: Montserrat, Arial, Helvetica, sans-serif;
		}

		.post-password-form p:nth-child(2) input[type="submit"] {
			background-color: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.post-password-form p:nth-child(2) input[type="submit"]:hover {
			-webkit-box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
		}

		.btPagination {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btPagination .paging a {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btPagination .paging a:hover {
			color: #dd0000;
		}

		.btPagination .paging a:after {
			background: #dd0000;
		}

		.btPrevNextNav .btPrevNext .btPrevNextImage:before {
			background: #dd0000;
		}

		.btPrevNextNav .btPrevNext .btPrevNextItem .btPrevNextTitle {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btPrevNextNav .btPrevNext .btPrevNextItem .btPrevNextDir {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btPrevNextNav .btPrevNext:hover .btPrevNextTitle {
			color: #dd0000;
		}

		.btLinkPages {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btLinkPages ul {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btLinkPages ul a {
			background: #dd0000;
		}

		.btContent .btArticleAuthor a:hover,
		.btContent .btArticleComments:hover {
			color: #dd0000;
		}

		.btArticleDate:before,
		.btArticleAuthor:before,
		.btArticleComments:before,
		.btArticleCategories:before {
			color: #dd0000;
		}

		.btArticleComments:before {
			color: #dd0000;
		}

		.bt-comments-box ul.comments li.pingback p a:not(.comment-edit-link) {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt-comments-box ul.comments li.pingback p a:not(.comment-edit-link):hover {
			color: #dd0000;
		}

		.bt-comments-box ul.comments li.pingback p .edit-link {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt-comments-box ul.comments li.pingback p .edit-link a:before {
			color: #dd0000;
		}

		.bt-comments-box .vcard h1.author a:hover,
		.bt-comments-box .vcard h2.author a:hover,
		.bt-comments-box .vcard h3.author a:hover,
		.bt-comments-box .vcard h4.author a:hover,
		.bt-comments-box .vcard h5.author a:hover,
		.bt-comments-box .vcard h6.author a:hover,
		.bt-comments-box .vcard h7.author a:hover,
		.bt-comments-box .vcard h8.author a:hover {
			color: #dd0000;
		}

		.bt-comments-box .vcard .posted {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt-comments-box .vcard .posted:before {
			color: #dd0000;
		}

		.bt-comments-box .commentTxt p.edit-link,
		.bt-comments-box .commentTxt p.reply {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt-comments-box .commentTxt p.edit-link a:before,
		.bt-comments-box .commentTxt p.reply a:before {
			color: #dd0000;
		}

		.bt-comments-box .comment-form input[type="checkbox"]:before {
			background: #dd0000;
		}

		.bt-comments-box .comment-navigation {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt-comments-box .comment-navigation a:hover {
			color: #dd0000;
		}

		.bt-comments-box .comment-navigation a:before,
		.bt-comments-box .comment-navigation a:after {
			color: #dd0000;
		}

		.comment-awaiting-moderation {
			color: #dd0000;
		}

		.comment-reply-title small {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.comment-reply-title small a#cancel-comment-reply-link:before {
			color: #dd0000;
		}

		.btCommentSubmit {
			background: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btCommentSubmit:hover {
			-webkit-box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
		}

		@media (max-width: 520px) {
			.bt-comments-box ul.comments ul.children li.comment article:after {
				background: #dd0000;
			}
		}

		body:not(.btNoDashInSidebar) .btBox>h4:after,
		body:not(.btNoDashInSidebar) .btCustomMenu>h4:after,
		body:not(.btNoDashInSidebar) .btTopBox>h4:after {
			border-bottom: 2px solid #dd0000;
		}

		.btBox ul li a:before,
		.btCustomMenu ul li a:before,
		.btTopBox ul li a:before {
			background: #dd0000;
		}

		.btBox ul li a:hover,
		.btCustomMenu ul li a:hover,
		.btTopBox ul li a:hover {
			color: #dd0000;
		}

		.btBox ul li.current-menu-item>a,
		.btCustomMenu ul li.current-menu-item>a,
		.btTopBox ul li.current-menu-item>a {
			color: #dd0000;
		}

		.widget_calendar table caption {
			background: #dd0000;
			background: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.widget_calendar table tbody tr td#today {
			color: #dd0000;
		}

		.widget_recent_comments {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.widget_recent_comments a {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.widget_recent_comments .comment-author-link a {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.widget_recent_comments .comment-author-link a:after {
			color: #dd0000;
		}

		.widget_rss li a.rsswidget {
			font-family: "Montserrat";
		}

		.widget_rss li .rss-date {
			font-family: PT Serif, Arial, Helvetica, sans-serif;
		}

		.widget_rss li .rss-date:before {
			color: #dd0000;
		}

		.widget_shopping_cart .total {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove {
			background-color: #dd0000;
		}

		.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove:hover {
			background: #000000;
		}

		.menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
		.topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
		.topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents {
			background-color: #dd0000;
			font: normal 11px/19px "Montserrat";
		}

		.menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent li.empty,
		.topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent li.empty,
		.topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent li.empty {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btMenuVertical .menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler:hover:after,
		.btMenuVertical .topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler:hover:after,
		.btMenuVertical .topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler:hover:after {
			color: #dd0000;
		}

		.menuPort .widget_shopping_cart .widget_shopping_cart_content:hover .btCartWidgetIcon:hover,
		.topTools .widget_shopping_cart .widget_shopping_cart_content:hover .btCartWidgetIcon:hover,
		.topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content:hover .btCartWidgetIcon:hover {
			color: #dd0000;
		}

		.btMenuHorizontal .topBarInMenu .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent {
			top: -webkit-calc((140px - 16px)/4 + 16px);
			top: -moz-calc((140px - 16px)/4 + 16px);
			top: calc((140px - 16px)/4 + 16px);
		}

		.widget_recent_reviews {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
			background: #dd0000;
		}

		.widget_price_filter .price_slider_amount .price_label {
			font-family: Montserrat, Arial, Helvetica, sans-serif;
		}

		.btBox .tagcloud a,
		.btTags ul a {
			background: #dd0000;
		}

		.topTools .btIconWidget:hover,
		.topBarInMenu .btIconWidget:hover {
			color: #dd0000;
		}

		.topTools .btIconWidget.btAlternateIconWidget .btIconWidgetIcon,
		.topBarInMenu .btIconWidget.btAlternateIconWidget .btIconWidgetIcon {
			color: #000000;
		}

		.topTools .btIconWidget.btBodyFontTextTitle .btIconWidgetText,
		.topTools .btIconWidget.btBodyFontTextTitle .btIconWidgetTitle,
		.topBarInMenu .btIconWidget.btBodyFontTextTitle .btIconWidgetText,
		.topBarInMenu .btIconWidget.btBodyFontTextTitle .btIconWidgetTitle {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btIconWidget.widget_bt_button_widget .bt_button_widget .bt_bb_button_text {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btIconWidget.widget_bt_button_widget .bt_button_widget.bt_button_widget_accent:before {
			background: #dd0000;
		}

		.btIconWidget.widget_bt_button_widget .bt_button_widget.bt_button_widget_alternate:before {
			background: #000000;
		}

		.btSidebar .btIconWidget .btIconWidgetContent .btIconWidgetTitle,
		footer .btIconWidget .btIconWidgetContent .btIconWidgetTitle,
		.topBarInLogoArea .btIconWidget .btIconWidgetContent .btIconWidgetTitle {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btSidebar .btIconWidget.btIconAccentTitle .btIconWidgetContent .btIconWidgetText,
		footer .btIconWidget.btIconAccentTitle .btIconWidgetContent .btIconWidgetText,
		.topBarInLogoArea .btIconWidget.btIconAccentTitle .btIconWidgetContent .btIconWidgetText {
			color: #dd0000;
		}

		.btSidebar .btIconWidget.btIconAlternateTitle .btIconWidgetContent .btIconWidgetText,
		footer .btIconWidget.btIconAlternateTitle .btIconWidgetContent .btIconWidgetText,
		.topBarInLogoArea .btIconWidget.btIconAlternateTitle .btIconWidgetContent .btIconWidgetText {
			color: #000000;
		}

		.btSidebar .btIconWidget.btAccentIconWidget .btIconWidgetIcon,
		footer .btIconWidget.btAccentIconWidget .btIconWidgetIcon,
		.topBarInLogoArea .btIconWidget.btAccentIconWidget .btIconWidgetIcon {
			color: #dd0000;
		}

		.btSidebar .btIconWidget.btAlternateIconWidget .btIconWidgetIcon,
		footer .btIconWidget.btAlternateIconWidget .btIconWidgetIcon,
		.topBarInLogoArea .btIconWidget.btAlternateIconWidget .btIconWidgetIcon {
			color: #000000;
		}

		.btAccentIconWidget.btIconWidget .btIconWidgetIcon {
			color: #dd0000;
		}

		a.btAccentIconWidget.btIconWidget:hover {
			color: #dd0000;
		}

		.btSiteFooterWidgets .btSearch button:hover,
		.btSiteFooterWidgets .btSearch input[type=submit]:hover,
		.btSidebar .btSearch button:hover,
		.btSidebar .btSearch input[type=submit]:hover,
		.btSidebar .widget_product_search button:hover,
		.btSidebar .widget_product_search input[type=submit]:hover {
			color: #dd0000 !important;
		}

		.btSoftRoundedButtons .btSiteFooterWidgets .btSearch button:hover,
		.btSoftRoundedButtons .btSiteFooterWidgets .btSearch input[type=submit]:hover,
		.btSoftRoundedButtons .btSidebar .btSearch button:hover,
		.btSoftRoundedButtons .btSidebar .btSearch input[type=submit]:hover,
		.btSoftRoundedButtons .btSidebar .widget_product_search button:hover,
		.btSoftRoundedButtons .btSidebar .widget_product_search input[type=submit]:hover {
			background: #dd0000 !important;
		}

		.btHardRoundedButtons .btSiteFooterWidgets .btSearch button:hover,
		.btHardRoundedButtons .btSiteFooterWidgets .btSearch input[type=submit]:hover,
		.btHardRoundedButtons .btSidebar .btSearch button:hover,
		.btHardRoundedButtons .btSidebar .btSearch input[type=submit]:hover,
		.btHardRoundedButtons .btSidebar .widget_product_search button:hover,
		.btHardRoundedButtons .btSidebar .widget_product_search input[type=submit]:hover {
			background: #dd0000 !important;
		}

		.btSearchInner.btFromTopBox .btSearchInnerClose .bt_bb_icon a.bt_bb_icon_holder {
			color: #dd0000;
		}

		.btSearchInner.btFromTopBox .btSearchInnerClose .bt_bb_icon:hover a.bt_bb_icon_holder {
			color: #910000;
		}

		.btSearchInner.btFromTopBox button:hover {
			color: #dd0000;
		}

		.btSoftRoundedButtons .btSearchInner.btFromTopBox button:hover {
			background: #dd0000;
		}

		.btHardRoundedButtons .btSearchInner.btFromTopBox button:hover {
			background: #dd0000;
		}

		.btMenuHorizontal .topBarInMenu .widget_bt_divider_widget>span {
			height: -webkit-calc(140px * .5);
			height: -moz-calc(140px * .5);
			height: calc(140px * .5);
		}

		::selection {
			background: #dd0000;
		}

		.bt_bb_dash_top.bt_bb_headline .bt_bb_headline_superheadline:before,
		.bt_bb_dash_top.bt_bb_headline .bt_bb_headline_superheadline:after,
		.bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_superheadline:before,
		.bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_superheadline:after {
			border-top: 2px solid #dd0000;
		}

		.bt_bb_dash_bottom.bt_bb_headline .bt_bb_headline_content:after,
		.bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_content:after {
			border-color: #dd0000;
		}

		.bt_bb_section[class*="accent_solid"]:before {
			background: #dd0000;
		}

		.bt_bb_section[class*="alternate_solid"]:before {
			background: #000000;
		}

		.bt_bb_headline .bt_bb_headline_superheadline {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt_bb_headline.bt_bb_subheadline .bt_bb_headline_subheadline {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt_bb_headline b {
			color: #dd0000;
		}

		.bt_bb_headline u {
			color: #000000;
		}

		.bt_bb_progress_bar .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #dd0000;
		}

		.bt_bb_button .bt_bb_button_text {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title b {
			color: #dd0000;
		}

		.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title u {
			color: #000000;
		}

		.bt_bb_service:hover .bt_bb_service_content_title a:hover {
			color: #dd0000;
		}

		.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #dd0000;
		}

		button.slick-arrow {
			background: #dd0000;
		}

		.bt_bb_arrows_style_accent_light button.slick-arrow {
			background: #dd0000 !important;
		}

		.bt_bb_arrows_style_accent_dark button.slick-arrow {
			background: #dd0000 !important;
		}

		.bt_bb_arrows_style_alternate_light button.slick-arrow {
			background: #000000 !important;
		}

		.bt_bb_arrows_style_alternate_dark button.slick-arrow {
			background: #000000 !important;
		}

		button.slick-arrow:hover {
			background: #dd0000;
		}

		.slick-dots li:after {
			background: #dd0000;
		}

		.bt_bb_dots_style_accent_dot .slick-dots li:after {
			background: #dd0000;
		}

		.bt_bb_dots_style_alternate_dot .slick-dots li:after {
			background: #000000;
		}

		.bt_bb_custom_menu div ul a:hover {
			color: #dd0000;
		}

		.bt_bb_style_simple ul.bt_bb_tabs_header li.on {
			border-color: #dd0000;
		}

		.bt_bb_tabs ul.bt_bb_tabs_header {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_style_simple.bt_bb_tabs ul.bt_bb_tabs_header li:after {
			background-color: #dd0000;
		}

		.bt_bb_accordion .bt_bb_accordion_item .bt_bb_accordion_item_title {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_style_simple.bt_bb_accordion .bt_bb_accordion_item .bt_bb_accordion_item_title:before {
			background-color: #dd0000 !important;
		}

		.bt_bb_price_list .bt_bb_price_list_title_subtitle_price .bt_bb_price_list_price {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_price_list .bt_bb_price_list_title_subtitle_price .bt_bb_price_list_title_subtitle .bt_bb_price_list_title {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_price_list .bt_bb_price_list_title_subtitle_price .bt_bb_price_list_title_subtitle .bt_bb_price_list_subtitle {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.wpcf7-form .wpcf7-submit {
			background: #dd0000 !important;
			font-family: "Montserrat", Arial, Helvetica, sans-serif !important;
		}

		.wpcf7-form .wpcf7-submit:hover {
			-webkit-box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
		}

		.wpcf7-form .bt_bb_alternate_submit .wpcf7-submit {
			background: #000000 !important;
		}

		div.wpcf7-validation-errors,
		div.wpcf7-acceptance-missing,
		div.wpcf7-response-output {
			border: 2px solid #dd0000;
		}

		.bt_bb_required:after {
			color: #dd0000 !important;
		}

		.required {
			color: #dd0000 !important;
		}

		button.mfp-close:hover {
			color: #dd0000;
		}

		button.mfp-arrow:hover {
			background: #dd0000;
		}

		.bt_bb_cost_calculator .bt_bb_cost_calculator_item input:not([type="checkbox"]):focus,
		.bt_bb_cost_calculator .bt_bb_cost_calculator_item input:not([type="radio"]):focus,
		.bt_bb_cost_calculator .bt_bb_cost_calculator_item input:not([type="submit"]):focus,
		.bt_bb_cost_calculator .bt_bb_cost_calculator_item .bt_bb_widget_select_selected:focus {
			-webkit-box-shadow: 0 3px 10px, 3px 0 0 0 #dd0000 inset;
			box-shadow: 0 3px 10px, 3px 0 0 0 #dd0000 inset;
		}

		.bt_bb_cost_calculator .bt_bb_cost_calculator_total {
			background: #dd0000;
		}

		.bt_bb_cost_calculator .bt_bb_cost_calculator_total .bt_bb_cost_calculator_total_amount {
			font-family: Montserrat, Arial, Helvetica, sans-serif;
		}

		.bt_bb_widget_select_items>div[data-value]:before {
			background: #dd0000;
		}

		.on.bt_bb_widget_switch>div {
			background: #dd0000;
		}

		.bt_bb_progress_bar_advanced .progressbar-text {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_counter_holder {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btCounterHolder {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btCounterHolder .btCountdownHolder span[class$="_text"] {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder span[class^="n"],
		.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder .days>span:first-child,
		.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder .days>span:nth-child(2),
		.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder .days>span:nth-child(3) {
			color: #dd0000;
		}

		.btWorkingHours .bt_bb_working_hours_inner_row .bt_bb_working_hours_inner_wrapper .bt_bb_working_hours_inner_link a {
			background-color: #dd0000;
		}

		.btWorkingHours .bt_bb_working_hours_inner_row .bt_bb_working_hours_inner_wrapper .bt_bb_working_hours_inner_link a:hover {
			background: #000000;
		}

		.bt_bb_masonry_image_grid .bt_bb_grid_item_inner>.bt_bb_grid_item_inner_image:after {
			background: #dd0000;
		}

		.bt_bb_post_grid_loader>div,
		.bt_bb_post_grid_loader>span {
			background: #dd0000;
		}

		.bt_bb_post_grid_filter {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_post_grid_filter .bt_bb_post_grid_filter_item:before {
			background-color: #dd0000;
		}

		.bt_bb_post_grid_filter .bt_bb_post_grid_filter_item:hover {
			color: #dd0000;
		}

		.bt_bb_masonry_post_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .bt_bb_grid_item_post_title,
		.bt_bb_masonry_portfolio_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .bt_bb_grid_item_post_title {
			color: #dd0000;
		}

		.bt_bb_look_triangular.bt_bb_masonry_post_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .triangle-starter:after,
		.bt_bb_look_triangular.bt_bb_masonry_portfolio_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .triangle-starter:after {
			border-color: transparent #000000 transparent transparent;
		}

		.bt_bb_look_triangle.bt_bb_masonry_post_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .triangle-starter:before,
		.bt_bb_look_triangle.bt_bb_masonry_portfolio_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .triangle-starter:before {
			background: #dd0000;
		}

		.bt_bb_look_circle.bt_bb_masonry_post_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .triangle-starter:before,
		.bt_bb_look_circle.bt_bb_masonry_portfolio_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .triangle-starter:before {
			background: #000000;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_category .post-categories {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta>span:before {
			color: #dd0000;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta>span.bt_bb_latest_posts_item_author a:hover {
			color: #dd0000;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_title {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_title a {
			color: #dd0000;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_read_more {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_read_more a {
			color: #dd0000;
		}

		.bt_bb_latest_posts.bt_bb_look_standard_highlighted .bt_bb_latest_posts_item:first-child .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_category .post-categories:before {
			background: #dd0000;
		}

		.bt_bb_latest_posts.bt_bb_look_standard_highlighted .bt_bb_latest_posts_item:first-child .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_title a:hover {
			color: #dd0000;
		}

		.bt_bb_latest_posts.bt_bb_look_standard.bt_bb_date_design_rounded .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta>.bt_bb_latest_posts_item_date,
		.bt_bb_latest_posts.bt_bb_look_standard_highlighted.bt_bb_date_design_rounded .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta>.bt_bb_latest_posts_item_date,
		.bt_bb_latest_posts.bt_bb_look_highlighted.bt_bb_date_design_rounded .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta>.bt_bb_latest_posts_item_date {
			background: #dd0000;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span:before,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span:before,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span:before,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span:before {
			color: #dd0000;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span.bt_bb_grid_item_item_author a:hover,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span.bt_bb_grid_item_item_author a:hover,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span.bt_bb_grid_item_item_author a:hover,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>span.bt_bb_grid_item_item_author a:hover {
			color: #dd0000;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title a,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title a,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title a,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title a {
			color: #dd0000;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_share .bt_bb_icon .bt_bb_icon_holder:before,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_share .bt_bb_icon .bt_bb_icon_holder:before,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_share .bt_bb_icon .bt_bb_icon_holder:before,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_share .bt_bb_icon .bt_bb_icon_holder:before {
			color: #dd0000;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more a,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more a,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more a,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_item_read_more a {
			color: #dd0000;
		}

		.bt_bb_masonry_post_grid.bt_bb_date_design_rounded .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>.bt_bb_grid_item_date,
		.bt_bb_masonry_portfolio_grid.bt_bb_date_design_rounded .bt_bb_grid_item_post_content .bt_bb_grid_item_meta>.bt_bb_grid_item_date {
			background: #dd0000;
		}

		.bt_bb_masonry_post_grid.bt_bb_look_image_above .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_thumbnail a:after,
		.bt_bb_masonry_post_grid.bt_bb_look_image_above .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_thumbnail a:after,
		.bt_bb_masonry_portfolio_grid.bt_bb_look_image_above .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_thumbnail a:after,
		.bt_bb_masonry_portfolio_grid.bt_bb_look_image_above .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_thumbnail a:after {
			background: #dd0000;
		}

		.btNoSearchResults {
			border: 2px solid #dd0000;
		}

		.btNoSearchResults .bt_bb_headline h2 {
			font-family: PT Serif, Arial, Helvetica, sans-serif;
		}

		.btNoSearchResults #searchform input[type='submit'] {
			background: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btNoSearchResults .bt_bb_button:last-child a {
			-webkit-box-shadow: 0 0 0 2px #dd0000 inset, 0 4px 0 0 rgba(24, 24, 24, .2) inset;
			box-shadow: 0 0 0 2px #dd0000 inset, 0 4px 0 0 rgba(24, 24, 24, .2) inset;
			color: #dd0000;
		}

		.btNoSearchResults .bt_bb_button:last-child a:hover {
			-webkit-box-shadow: 0 0 0 2px #dd0000 inset, 0 5px 0 0 rgba(24, 24, 24, .2) inset, 0 2px 10px rgba(0, 0, 0, .2) !important;
			box-shadow: 0 0 0 2px #dd0000 inset, 0 5px 0 0 rgba(24, 24, 24, .2) inset, 0 2px 10px rgba(0, 0, 0, .2) !important;
			color: #dd0000 !important;
		}

		.bt_bb_service_image .bt_bb_service_image_content .bt_bb_service_image_content_title h3 b {
			color: #dd0000;
		}

		.bt_bb_service_image .bt_bb_service_image_content .bt_bb_service_image_content_title h3 u {
			color: #000000;
		}

		.bt_bb_service_image .bt_bb_service_image_content_read_more {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bold_timeline_item_button {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.bt_bb_star_bullet_list ul li:before,
		.bt_bb_check_bullet_list ul li:before {
			color: #dd0000;
		}

		.products ul li.product .btWooShopLoopItemInner .bt_bb_image a:before,
		ul.products li.product .btWooShopLoopItemInner .bt_bb_image a:before {
			background: #dd0000;
		}

		.products ul li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_content a:hover,
		ul.products li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_content a:hover {
			color: #dd0000;
		}

		.products ul li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_subheadline .star-rating span:before,
		ul.products li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_subheadline .star-rating span:before {
			color: #dd0000;
		}

		.products ul li.product .btWooShopLoopItemInner .added:after,
		.products ul li.product .btWooShopLoopItemInner .loading:after,
		ul.products li.product .btWooShopLoopItemInner .added:after,
		ul.products li.product .btWooShopLoopItemInner .loading:after {
			background-color: #000000;
		}

		.products ul li.product .btWooShopLoopItemInner .added_to_cart,
		ul.products li.product .btWooShopLoopItemInner .added_to_cart {
			color: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.btShopSaleTagDesignRounded .products ul li.product .btWooShopLoopItemInner:hover .onsale,
		.btShopSaleTagDesignRound .products ul li.product .btWooShopLoopItemInner:hover .onsale,
		.btShopSaleTagDesignRounded ul.products li.product .btWooShopLoopItemInner:hover .onsale,
		.btShopSaleTagDesignRound ul.products li.product .btWooShopLoopItemInner:hover .onsale {
			background: #000000;
		}

		.btShopSaleTagDesignSlanted_right .products ul li.product .btWooShopLoopItemInner:hover .onsale:before,
		.btShopSaleTagDesignSlanted_left .products ul li.product .btWooShopLoopItemInner:hover .onsale:before,
		.btShopSaleTagDesignSlanted_right ul.products li.product .btWooShopLoopItemInner:hover .onsale:before,
		.btShopSaleTagDesignSlanted_left ul.products li.product .btWooShopLoopItemInner:hover .onsale:before {
			background: #000000;
		}

		.btShopSaleTagDesignRounded .products ul li.product .onsale,
		.btShopSaleTagDesignRound .products ul li.product .onsale,
		.btShopSaleTagDesignSquare .products ul li.product .onsale,
		.btShopSaleTagDesignSlanted_right .products ul li.product .onsale,
		.btShopSaleTagDesignSlanted_left .products ul li.product .onsale,
		.btShopSaleTagDesignRounded ul.products li.product .onsale,
		.btShopSaleTagDesignRound ul.products li.product .onsale,
		.btShopSaleTagDesignSquare ul.products li.product .onsale,
		.btShopSaleTagDesignSlanted_right ul.products li.product .onsale,
		.btShopSaleTagDesignSlanted_left ul.products li.product .onsale {
			background: #dd0000;
		}

		.btShopSaleTagDesignSlanted_right .products ul li.product .onsale:before,
		.btShopSaleTagDesignSlanted_left .products ul li.product .onsale:before,
		.btShopSaleTagDesignSlanted_right ul.products li.product .onsale:before,
		.btShopSaleTagDesignSlanted_left ul.products li.product .onsale:before {
			background: #dd0000;
		}

		.products ul li.product.product-category a:hover h2,
		ul.products li.product.product-category a:hover h2 {
			color: #dd0000;
		}

		nav.woocommerce-pagination ul {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		nav.woocommerce-pagination ul li a.next:before,
		nav.woocommerce-pagination ul li a.prev:before {
			background: #dd0000;
		}

		.btShopSaleTagDesignRounded div.product>.onsale,
		.btShopSaleTagDesignRound div.product>.onsale,
		.btShopSaleTagDesignSquare div.product>.onsale,
		.btShopSaleTagDesignSlanted_right div.product>.onsale,
		.btShopSaleTagDesignSlanted_left div.product>.onsale {
			background: #dd0000;
		}

		.btShopSaleTagDesignSlanted_right div.product>.onsale:before,
		.btShopSaleTagDesignSlanted_left div.product>.onsale:before {
			background: #dd0000;
		}

		div.product div.images .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image a:after {
			background: #dd0000;
		}

		div.product div.images .woocommerce-product-gallery__trigger:after {
			background: #dd0000;
		}

		div.product div.summary form.cart .group_table a {
			font-family: "Montserrat", Arial, Helvetica;
		}

		div.product div.summary form.cart .group_table a:hover {
			color: #dd0000;
		}

		table.shop_table td.product-remove a.remove {
			background-color: #dd0000;
		}

		table.shop_table td.product-remove a.remove:hover {
			background: #000000;
		}

		table.shop_table td.product-name {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		table.shop_table td.product-name a:hover {
			color: #dd0000;
		}

		ul.wc_payment_methods li .about_paypal {
			color: #dd0000;
		}

		.woocommerce-MyAccount-navigation ul {
			font-family: "Montserrat", Arial, Helvetica, sans-serif;
		}

		.woocommerce-MyAccount-navigation ul li a:after {
			background-color: #dd0000;
		}

		.woocommerce-MyAccount-navigation ul li a:hover {
			color: #dd0000;
		}

		.reset_variations {
			font-family: "PT Serif", Arial, Helvetica, sans-serif;
		}

		.reset_variations:before {
			color: #dd0000;
		}

		form fieldset legend {
			font-family: Montserrat, Arial, Helvetica, sans-serif;
		}

		.woocommerce-info a:not(.button),
		.woocommerce-message a:not(.button) {
			color: #dd0000;
		}

		.woocommerce-info a.showcoupon:before,
		.woocommerce-message a.showcoupon:before {
			color: #dd0000;
		}

		.woocommerce-info a.showcoupon:hover,
		.woocommerce-message a.showcoupon:hover {
			color: #dd0000;
		}

		.woocommerce-message:before,
		.woocommerce-info:before {
			background: #dd0000;
		}

		.woocommerce .btSidebar a.button,
		.woocommerce .btContent a.button,
		.woocommerce-page .btSidebar a.button,
		.woocommerce-page .btContent a.button,
		.woocommerce .btSidebar input[type="submit"],
		.woocommerce .btContent input[type="submit"],
		.woocommerce-page .btSidebar input[type="submit"],
		.woocommerce-page .btContent input[type="submit"],
		.woocommerce .btSidebar :not(.widget_product_search) button[type="submit"],
		.woocommerce .btContent :not(.widget_product_search) button[type="submit"],
		.woocommerce-page .btSidebar :not(.widget_product_search) button[type="submit"],
		.woocommerce-page .btContent :not(.widget_product_search) button[type="submit"],
		.woocommerce .btSidebar input.button,
		.woocommerce .btContent input.button,
		.woocommerce-page .btSidebar input.button,
		.woocommerce-page .btContent input.button,
		div.woocommerce a.button,
		div.woocommerce input[type="submit"],
		div.woocommerce :not(.widget_product_search) button[type="submit"],
		div.woocommerce input.button {
			background: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif !important;
		}

		.woocommerce .btSidebar a.button:hover,
		.woocommerce .btContent a.button:hover,
		.woocommerce-page .btSidebar a.button:hover,
		.woocommerce-page .btContent a.button:hover,
		.woocommerce .btSidebar input[type="submit"]:hover,
		.woocommerce .btContent input[type="submit"]:hover,
		.woocommerce-page .btSidebar input[type="submit"]:hover,
		.woocommerce-page .btContent input[type="submit"]:hover,
		.woocommerce .btSidebar :not(.widget_product_search) button[type="submit"]:hover,
		.woocommerce .btContent :not(.widget_product_search) button[type="submit"]:hover,
		.woocommerce-page .btSidebar :not(.widget_product_search) button[type="submit"]:hover,
		.woocommerce-page .btContent :not(.widget_product_search) button[type="submit"]:hover,
		.woocommerce .btSidebar input.button:hover,
		.woocommerce .btContent input.button:hover,
		.woocommerce-page .btSidebar input.button:hover,
		.woocommerce-page .btContent input.button:hover,
		div.woocommerce a.button:hover,
		div.woocommerce input[type="submit"]:hover,
		div.woocommerce :not(.widget_product_search) button[type="submit"]:hover,
		div.woocommerce input.button:hover {
			-webkit-box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .2) inset, 0 0 0 2.5em #dd0000 inset, 0 2px 10px rgba(0, 0, 0, .2);
		}

		.woocommerce .btSidebar input.alt,
		.woocommerce .btContent input.alt,
		.woocommerce-page .btSidebar input.alt,
		.woocommerce-page .btContent input.alt,
		.woocommerce .btSidebar a.button.alt,
		.woocommerce .btContent a.button.alt,
		.woocommerce-page .btSidebar a.button.alt,
		.woocommerce-page .btContent a.button.alt,
		.woocommerce .btSidebar .button.alt,
		.woocommerce .btContent .button.alt,
		.woocommerce-page .btSidebar .button.alt,
		.woocommerce-page .btContent .button.alt,
		.woocommerce .btSidebar button.alt,
		.woocommerce .btContent button.alt,
		.woocommerce-page .btSidebar button.alt,
		.woocommerce-page .btContent button.alt,
		.woocommerce .btSidebar .shipping-calculator-button,
		.woocommerce .btContent .shipping-calculator-button,
		.woocommerce-page .btSidebar .shipping-calculator-button,
		.woocommerce-page .btContent .shipping-calculator-button,
		div.woocommerce input.alt,
		div.woocommerce a.button.alt,
		div.woocommerce .button.alt,
		div.woocommerce button.alt,
		div.woocommerce .shipping-calculator-button {
			-webkit-box-shadow: 0 0 0 2px #dd0000 inset, 0 4px 0 0 rgba(24, 24, 24, .2) inset;
			box-shadow: 0 0 0 2px #dd0000 inset, 0 4px 0 0 rgba(24, 24, 24, .2) inset;
			color: #dd0000;
			font-family: "Montserrat", Arial, Helvetica, sans-serif !important;
		}

		.woocommerce .btSidebar input.alt:hover,
		.woocommerce .btContent input.alt:hover,
		.woocommerce-page .btSidebar input.alt:hover,
		.woocommerce-page .btContent input.alt:hover,
		.woocommerce .btSidebar a.button.alt:hover,
		.woocommerce .btContent a.button.alt:hover,
		.woocommerce-page .btSidebar a.button.alt:hover,
		.woocommerce-page .btContent a.button.alt:hover,
		.woocommerce .btSidebar .button.alt:hover,
		.woocommerce .btContent .button.alt:hover,
		.woocommerce-page .btSidebar .button.alt:hover,
		.woocommerce-page .btContent .button.alt:hover,
		.woocommerce .btSidebar button.alt:hover,
		.woocommerce .btContent button.alt:hover,
		.woocommerce-page .btSidebar button.alt:hover,
		.woocommerce-page .btContent button.alt:hover,
		.woocommerce .btSidebar .shipping-calculator-button:hover,
		.woocommerce .btContent .shipping-calculator-button:hover,
		.woocommerce-page .btSidebar .shipping-calculator-button:hover,
		.woocommerce-page .btContent .shipping-calculator-button:hover,
		div.woocommerce input.alt:hover,
		div.woocommerce a.button.alt:hover,
		div.woocommerce .button.alt:hover,
		div.woocommerce button.alt:hover,
		div.woocommerce .shipping-calculator-button:hover {
			-webkit-box-shadow: 0 0 0 2px #dd0000 inset, 0 5px 0 0 rgba(24, 24, 24, .2) inset, 0 2px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 0 0 2px #dd0000 inset, 0 5px 0 0 rgba(24, 24, 24, .2) inset, 0 2px 10px rgba(0, 0, 0, .2);
		}

		.woocommerce .btSidebar a.edit,
		.woocommerce .btContent a.edit,
		.woocommerce-page .btSidebar a.edit,
		.woocommerce-page .btContent a.edit,
		div.woocommerce a.edit {
			font-family: PT Serif, Arial, Helvetica, sans-serif;
		}

		.woocommerce .btSidebar a.edit:before,
		.woocommerce .btContent a.edit:before,
		.woocommerce-page .btSidebar a.edit:before,
		.woocommerce-page .btContent a.edit:before,
		div.woocommerce a.edit:before {
			color: #dd0000;
		}

		.widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
			background: #dd0000;
		}

		.widget_price_filter .price_slider_amount .price_label {
			font-family: Montserrat, Arial, Helvetica, sans-serif;
		}

		.star-rating span:before {
			color: #dd0000;
		}

		p.stars a[class^="star-"].active:after,
		p.stars a[class^="star-"]:hover:after {
			color: #dd0000;
		}

		.select2-container--default .select2-results__option--highlighted[aria-selected],
		.select2-container--default .select2-results__option--highlighted[data-selected] {
			background-color: #dd0000;
		}

		button.pswp__button.pswp__button--arrow--left:hover,
		button.pswp__button.pswp__button--arrow--right:hover {
			background: #dd0000 !important;
		}

		.woocommerce input[type="checkbox"]:before {
			background: #dd0000;
		}

		.btQuoteBooking .btContactNext {
			background: #dd0000;
		}

		.btQuoteBooking .btQuoteSlider .ui-slider-handle {
			background: #dd0000;
		}

		.btQuoteBooking .btQuoteSwitch.on .btQuoteSwitchInner {
			background: #dd0000;
		}

		.btQuoteBooking .ddChild ul li:before {
			background: #dd0000;
		}

		.btQuoteBooking .ddChild ul li.hover {
			color: #dd0000 !important;
		}

		.btQuoteBooking .btQuoteBookingForm .btQuoteTotal {
			background: #dd0000;
		}

		.btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
		.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea {
			border: 1px solid #dd0000;
			-webkit-box-shadow: 0 0 0 1px #dd0000 inset;
			box-shadow: 0 0 0 1px #dd0000 inset;
		}

		.btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
		.btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
		.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
		.btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
		.btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
		.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
		.btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover,
		.btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover,
		.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover,
		.btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus,
		.btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus,
		.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus {
			border: 1px solid #dd0000;
			-webkit-box-shadow: 0 0 0 1px #dd0000 inset, 0 2px 10px 0 rgba(0, 0, 0, .12);
			box-shadow: 0 0 0 1px #dd0000 inset, 0 2px 10px 0 rgba(0, 0, 0, .12);
		}

		.btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
		.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
		.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:hover,
		.btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
		.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
		.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
		.btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover,
		.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover,
		.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:hover,
		.btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus,
		.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus,
		.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus {
			border: 1px solid #dd0000;
			-webkit-box-shadow: 0 0 0 1px #dd0000 inset, 0 2px 10px 0 rgba(0, 0, 0, .12);
			box-shadow: 0 0 0 1px #dd0000 inset, 0 2px 10px 0 rgba(0, 0, 0, .12);
		}

		.btQuoteBooking .btSubmitMessage {
			color: #dd0000;
		}

		.btQuoteBooking .btContactSubmit {
			background: #dd0000;
		}

		.btQuoteBooking .btDatePicker .ui-datepicker-header {
			background-color: #dd0000;
		}

		.btQuoteBooking .bt_cc_email_confirmation_container [type="checkbox"]:not(:checked)+label:after,
		.btQuoteBooking .bt_cc_email_confirmation_container [type="checkbox"]:checked+label:after {
			background: #dd0000;
		}

		@font-face {
			font-family: "AnalyticsAndInvestment";
			src: url("core/views/9febec6e99/fonts/AnalyticsAndInvestment/AnalyticsAndInvestment.woff") format("woff"), url("core/views/9febec6e99/fonts/AnalyticsAndInvestment/AnalyticsAndInvestment.ttf") format("truetype");
		}

		*[data-ico-analyticsandinvestment]:before {
			font-family: AnalyticsAndInvestment;
			content: attr(data-ico-analyticsandinvestment);
		}

		@font-face {
			font-family: "Avantage";
			src: url("core/views/9febec6e99/fonts/Avantage/Avantage.woff") format("woff"), url("core/views/9febec6e99/fonts/Avantage/Avantage.ttf") format("truetype");
		}

		*[data-ico-avantage]:before {
			font-family: Avantage;
			content: attr(data-ico-avantage);
		}

		@font-face {
			font-family: "Business";
			src: url("core/views/9febec6e99/fonts/Business/Business.woff") format("woff"), url("core/views/9febec6e99/fonts/Business/Business.ttf") format("truetype");
		}

		*[data-ico-business]:before {
			font-family: Business;
			content: attr(data-ico-business);
		}

		@font-face {
			font-family: "BusinessAndFinance";
			src: url("core/views/9febec6e99/fonts/BusinessAndFinance/BusinessAndFinance.woff") format("woff"), url("core/views/9febec6e99/fonts/BusinessAndFinance/BusinessAndFinance.ttf") format("truetype");
		}

		*[data-ico-businessandfinance]:before {
			font-family: BusinessAndFinance;
			content: attr(data-ico-businessandfinance);
		}

		@font-face {
			font-family: "BusinessManagement";
			src: url("core/views/9febec6e99/fonts/BusinessManagement/BusinessManagement.woff") format("woff"), url("core/views/9febec6e99/fonts/BusinessManagement/BusinessManagement.ttf") format("truetype");
		}

		*[data-ico-businessmanagement]:before {
			font-family: BusinessManagement;
			content: attr(data-ico-businessmanagement);
		}

		@font-face {
			font-family: "BusinessOffice";
			src: url("core/views/9febec6e99/fonts/BusinessOffice/BusinessOffice.woff") format("woff"), url("core/views/9febec6e99/fonts/BusinessOffice/BusinessOffice.ttf") format("truetype");
		}

		*[data-ico-businessoffice]:before {
			font-family: BusinessOffice;
			content: attr(data-ico-businessoffice);
		}

		@font-face {
			font-family: "BusinessPeople";
			src: url("core/views/9febec6e99/fonts/BusinessPeople/BusinessPeople.woff") format("woff"), url("core/views/9febec6e99/fonts/BusinessPeople/BusinessPeople.ttf") format("truetype");
		}

		*[data-ico-businesspeople]:before {
			font-family: BusinessPeople;
			content: attr(data-ico-businesspeople);
		}

		@font-face {
			font-family: "Construction";
			src: url("core/views/9febec6e99/fonts/Construction/Construction.woff") format("woff"), url("core/views/9febec6e99/fonts/Construction/Construction.ttf") format("truetype");
		}

		*[data-ico-construction]:before {
			font-family: Construction;
			content: attr(data-ico-construction);
		}

		@font-face {
			font-family: "CorporateBusiness";
			src: url("core/views/9febec6e99/fonts/CorporateBusiness/CorporateBusiness.woff") format("woff"), url("core/views/9febec6e99/fonts/CorporateBusiness/CorporateBusiness.ttf") format("truetype");
		}

		*[data-ico-corporatebusiness]:before {
			font-family: CorporateBusiness;
			content: attr(data-ico-corporatebusiness);
		}

		@font-face {
			font-family: "CorporateManagement";
			src: url("core/views/9febec6e99/fonts/CorporateManagement/CorporateManagement.woff") format("woff"), url("core/views/9febec6e99/fonts/CorporateManagement/CorporateManagement.ttf") format("truetype");
		}

		*[data-ico-corporatemanagement]:before {
			font-family: CorporateManagement;
			content: attr(data-ico-corporatemanagement);
		}

		@font-face {
			font-family: "CustomerRelationshipManagement";
			src: url("core/views/9febec6e99/fonts/CustomerRelationshipManagement/CustomerRelationshipManagement.woff") format("woff"), url("core/views/9febec6e99/fonts/CustomerRelationshipManagement/CustomerRelationshipManagement.ttf") format("truetype");
		}

		*[data-ico-customerrelationshipmanagement]:before {
			font-family: CustomerRelationshipManagement;
			content: attr(data-ico-customerrelationshipmanagement);
		}

		@font-face {
			font-family: "CustomerService";
			src: url("core/views/9febec6e99/fonts/CustomerService/CustomerService.woff") format("woff"), url("core/views/9febec6e99/fonts/CustomerService/CustomerService.ttf") format("truetype");
		}

		*[data-ico-customerservice]:before {
			font-family: CustomerService;
			content: attr(data-ico-customerservice);
		}

		@font-face {
			font-family: "Design";
			src: url("core/views/9febec6e99/fonts/Design/Design.woff") format("woff"), url("core/views/9febec6e99/fonts/Design/Design.ttf") format("truetype");
		}

		*[data-ico-design]:before {
			font-family: Design;
			content: attr(data-ico-design);
		}

		@font-face {
			font-family: "Development";
			src: url("core/views/9febec6e99/fonts/Development/Development.woff") format("woff"), url("core/views/9febec6e99/fonts/Development/Development.ttf") format("truetype");
		}

		*[data-ico-development]:before {
			font-family: Development;
			content: attr(data-ico-development);
		}

		@font-face {
			font-family: "DigitalMarketing";
			src: url("core/views/9febec6e99/fonts/DigitalMarketing/DigitalMarketing.woff") format("woff"), url("core/views/9febec6e99/fonts/DigitalMarketing/DigitalMarketing.ttf") format("truetype");
		}

		*[data-ico-digitalmarketing]:before {
			font-family: DigitalMarketing;
			content: attr(data-ico-digitalmarketing);
		}

		@font-face {
			font-family: "Economy";
			src: url("core/views/9febec6e99/fonts/Economy/Economy.woff") format("woff"), url("core/views/9febec6e99/fonts/Economy/Economy.ttf") format("truetype");
		}

		*[data-ico-economy]:before {
			font-family: Economy;
			content: attr(data-ico-economy);
		}

		@font-face {
			font-family: "Essential";
			src: url("core/views/9febec6e99/fonts/Essential/Essential.woff") format("woff"), url("core/views/9febec6e99/fonts/Essential/Essential.ttf") format("truetype");
		}

		*[data-ico-essential]:before {
			font-family: Essential;
			content: attr(data-ico-essential);
		}

		@font-face {
			font-family: "FontAwesome";
			src: url("core/views/9febec6e99/fonts/FontAwesome/FontAwesome.woff") format("woff"), url("core/views/9febec6e99/fonts/FontAwesome/FontAwesome.ttf") format("truetype");
		}

		*[data-ico-fontawesome]:before {
			font-family: FontAwesome;
			content: attr(data-ico-fontawesome);
		}

		@font-face {
			font-family: "FontAwesome5Brands";
			src: url("core/views/9febec6e99/fonts/FontAwesome5Brands/FontAwesome5Brands.woff") format("woff"), url("core/views/9febec6e99/fonts/FontAwesome5Brands/FontAwesome5Brands.ttf") format("truetype");
		}

		*[data-ico-fontawesome5brands]:before {
			font-family: FontAwesome5Brands;
			content: attr(data-ico-fontawesome5brands);
		}

		@font-face {
			font-family: "FontAwesome5Regular";
			src: url("core/views/9febec6e99/fonts/FontAwesome5Regular/FontAwesome5Regular.woff") format("woff"), url("core/views/9febec6e99/fonts/FontAwesome5Regular/FontAwesome5Regular.ttf") format("truetype");
		}

		*[data-ico-fontawesome5regular]:before {
			font-family: FontAwesome5Regular;
			content: attr(data-ico-fontawesome5regular);
		}

		@font-face {
			font-family: "FontAwesome5Solid";
			src: url("core/views/9febec6e99/fonts/FontAwesome5Solid/FontAwesome5Solid.woff") format("woff"), url("core/views/9febec6e99/fonts/FontAwesome5Solid/FontAwesome5Solid.ttf") format("truetype");
		}

		*[data-ico-fontawesome5solid]:before {
			font-family: FontAwesome5Solid;
			content: attr(data-ico-fontawesome5solid);
		}

		@font-face {
			font-family: "GlobalBusiness";
			src: url("core/views/9febec6e99/fonts/GlobalBusiness/GlobalBusiness.woff") format("woff"), url("core/views/9febec6e99/fonts/GlobalBusiness/GlobalBusiness.ttf") format("truetype");
		}

		*[data-ico-globalbusiness]:before {
			font-family: GlobalBusiness;
			content: attr(data-ico-globalbusiness);
		}

		@font-face {
			font-family: "HumanResources";
			src: url("core/views/9febec6e99/fonts/HumanResources/HumanResources.woff") format("woff"), url("core/views/9febec6e99/fonts/HumanResources/HumanResources.ttf") format("truetype");
		}

		*[data-ico-humanresources]:before {
			font-family: HumanResources;
			content: attr(data-ico-humanresources);
		}

		@font-face {
			font-family: "Icon7Stroke";
			src: url("core/views/9febec6e99/fonts/Icon7Stroke/Icon7Stroke.woff") format("woff"), url("core/views/9febec6e99/fonts/Icon7Stroke/Icon7Stroke.ttf") format("truetype");
		}

		*[data-ico-icon7stroke]:before {
			font-family: Icon7Stroke;
			content: attr(data-ico-icon7stroke);
		}

		@font-face {
			font-family: "JobResume";
			src: url("core/views/9febec6e99/fonts/JobResume/JobResume.woff") format("woff"), url("core/views/9febec6e99/fonts/JobResume/JobResume.ttf") format("truetype");
		}

		*[data-ico-jobresume]:before {
			font-family: JobResume;
			content: attr(data-ico-jobresume);
		}

		@font-face {
			font-family: "MarketingAndAdvertising";
			src: url("core/views/9febec6e99/fonts/MarketingAndAdvertising/MarketingAndAdvertising.woff") format("woff"), url("core/views/9febec6e99/fonts/MarketingAndAdvertising/MarketingAndAdvertising.ttf") format("truetype");
		}

		*[data-ico-marketingandadvertising]:before {
			font-family: MarketingAndAdvertising;
			content: attr(data-ico-marketingandadvertising);
		}

		@font-face {
			font-family: "Productivity";
			src: url("core/views/9febec6e99/fonts/Productivity/Productivity.woff") format("woff"), url("core/views/9febec6e99/fonts/Productivity/Productivity.ttf") format("truetype");
		}

		*[data-ico-productivity]:before {
			font-family: Productivity;
			content: attr(data-ico-productivity);
		}

		@font-face {
			font-family: "Science";
			src: url("core/views/9febec6e99/fonts/Science/Science.woff") format("woff"), url("core/views/9febec6e99/fonts/Science/Science.ttf") format("truetype");
		}

		*[data-ico-science]:before {
			font-family: Science;
			content: attr(data-ico-science);
		}

		@font-face {
			font-family: "SocialMediaAndNetwork";
			src: url("core/views/9febec6e99/fonts/SocialMediaAndNetwork/SocialMediaAndNetwork.woff") format("woff"), url("core/views/9febec6e99/fonts/SocialMediaAndNetwork/SocialMediaAndNetwork.ttf") format("truetype");
		}

		*[data-ico-socialmediaandnetwork]:before {
			font-family: SocialMediaAndNetwork;
			content: attr(data-ico-socialmediaandnetwork);
		}

		@font-face {
			font-family: "Taxes";
			src: url("core/views/9febec6e99/fonts/Taxes/Taxes.woff") format("woff"), url("core/views/9febec6e99/fonts/Taxes/Taxes.ttf") format("truetype");
		}

		*[data-ico-taxes]:before {
			font-family: Taxes;
			content: attr(data-ico-taxes);
		}

		@font-face {
			font-family: "TaxesAccounting";
			src: url("core/views/9febec6e99/fonts/TaxesAccounting/TaxesAccounting.woff") format("woff"), url("core/views/9febec6e99/fonts/TaxesAccounting/TaxesAccounting.ttf") format("truetype");
		}

		*[data-ico-taxesaccounting]:before {
			font-family: TaxesAccounting;
			content: attr(data-ico-taxesaccounting);
		}

		@font-face {
			font-family: "TeamWork2";
			src: url("core/views/9febec6e99/fonts/TeamWork2/TeamWork2.woff") format("woff"), url("core/views/9febec6e99/fonts/TeamWork2/TeamWork2.ttf") format("truetype");
		}

		*[data-ico-teamwork2]:before {
			font-family: TeamWork2;
			content: attr(data-ico-teamwork2);
		}

		@font-face {
			font-family: "Teamwork";
			src: url("core/views/9febec6e99/fonts/Teamwork/Teamwork.woff") format("woff"), url("core/views/9febec6e99/fonts/Teamwork/Teamwork.ttf") format("truetype");
		}

		*[data-ico-teamwork]:before {
			font-family: Teamwork;
			content: attr(data-ico-teamwork);
		}

		@font-face {
			font-family: "Transportation";
			src: url("core/views/9febec6e99/fonts/Transportation/Transportation.woff") format("woff"), url("core/views/9febec6e99/fonts/Transportation/Transportation.ttf") format("truetype");
		}

		*[data-ico-transportation]:before {
			font-family: Transportation;
			content: attr(data-ico-transportation);
		}
	</style>
	<link rel='stylesheet' id='avantage-print-css' href='core/views/9febec6e99/print.css' type='text/css'
		media='print' />
	<link rel='stylesheet' id='avantage-fonts-css'
		href='https://fonts.googleapis.com/css?family=PT+Serif%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CMontserrat%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CMontserrat%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CPT+Serif%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CPT+Serif%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CMontserrat%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic&#038;subset=latin%2Clatin-ext'
		type='text/css' media='all' />
	<link rel='stylesheet' id='boldthemes-framework-css' href='core/views/9febec6e99/framework/css/style.css'
		type='text/css' media='all' />
	<script type='text/javascript' src='lib/js/jquery/jquery.min.js' id='jquery-core-js'></script>
	<script type='text/javascript' src='lib/js/jquery/jquery-migrate.min.js' id='jquery-migrate-js'></script>
	<script type='text/javascript' src='core/modules/478e514c83/slick/slick.min.js' id='bt_bb_slick-js'></script>
	<script type='text/javascript'
		src='core/modules/478e514c83/content_elements_misc/js/jquery.magnific-popup.min.js'
		id='bt_bb_magnific-js'></script>
	<script type='text/javascript' src='core/modules/478e514c83/content_elements_misc/js/content_elements.js'
		id='bt_bb-js'></script>
	<script type='text/javascript' src='core/modules/9f8e7542cc/jquery.dd.js' id='btcc_dd-js'></script>
	<script type='text/javascript' src='core/modules/9f8e7542cc/cc.main.js' id='btcc_main-js'></script>
	<script type='text/javascript' id='btcc_main-js-after'>
		window.bt_cc_translate = []; window.bt_cc_translate['prev'] = 'Prev'; window.bt_cc_translate['next'] = 'Next'; window.bt_cc_translate['su'] = 'Su'; window.bt_cc_translate['mo'] = 'Mo'; window.bt_cc_translate['tu'] = 'Tu'; window.bt_cc_translate['we'] = 'We'; window.bt_cc_translate['th'] = 'Th'; window.bt_cc_translate['fr'] = 'Fr'; window.bt_cc_translate['sa'] = 'Sa'; window.bt_cc_translate['january'] = 'January'; window.bt_cc_translate['february'] = 'February'; window.bt_cc_translate['march'] = 'March'; window.bt_cc_translate['april'] = 'April'; window.bt_cc_translate['may'] = 'May'; window.bt_cc_translate['june'] = 'June'; window.bt_cc_translate['july'] = 'July'; window.bt_cc_translate['august'] = 'August'; window.bt_cc_translate['september'] = 'September'; window.bt_cc_translate['october'] = 'October'; window.bt_cc_translate['november'] = 'November'; window.bt_cc_translate['december'] = 'December';
	</script>
	<link rel="canonical" href="index.html" />
	<link rel='shortlink' href='../index0bc9.html?p=1601' />
	<link rel="alternate" type="application/json+oembed"
		href="wp-json/oembed/1.0/embedc335.json?url=https%3A%2F%2Ftraining.hpilgroup.com.ng%2Fcontact%2F" />
	<link rel="alternate" type="text/xml+oembed"
		href="wp-json/oembed/1.0/embedd5ef?url=https%3A%2F%2Ftraining.hpilgroup.com.ng%2Fcontact%2F&amp;format=xml" />
	<script>
		// Select the node that will be observed for mutations
		const targetNode = document.documentElement;

		// Options for the observer (which mutations to observe)
		const config = { attributes: false, childList: true, subtree: true };

		var bold_timeline_item_button_done = false;
		var css_override_item_done = false;
		var css_override_group_done = false;
		var css_override_container_done = false;

		// Callback function to execute when mutations are observed
		const callback = function (mutationsList, observer) {
			var i;
			for (i = 0; i < mutationsList.length; i++) {
				if (mutationsList[i].type === 'childList') {
					if (typeof jQuery !== 'undefined' && jQuery('.bold_timeline_item_button').length > 0 && !bold_timeline_item_button_done) {
						bold_timeline_item_button_done = true;
						jQuery('.bold_timeline_item_button').each(function () {
							var css_override = jQuery(this).data('css-override');
							if (css_override != '') {
								var id = jQuery(this).attr('id');
								css_override = css_override.replace(/(\.bold_timeline_item_button)([\.\{\s])/g, '.bold_timeline_item_button#' + id + '$2');
								var head = document.getElementsByTagName('head')[0];
								var style = document.createElement('style');
								style.appendChild(document.createTextNode(css_override));
								head.appendChild(style);
							}
						});
					}
					if (typeof jQuery !== 'undefined' && jQuery('.bold_timeline_item').length > 0 && !css_override_item_done) {
						css_override_item_done = true;
						jQuery('.bold_timeline_item').each(function () {
							var css_override = jQuery(this).data('css-override');
							if (css_override != '') {
								var id = jQuery(this).attr('id');
								css_override = css_override.replace(/(\.bold_timeline_item)([\.\{\s])/g, '.bold_timeline_item#' + id + '$2');
								var head = document.getElementsByTagName('head')[0];
								var style = document.createElement('style');
								style.appendChild(document.createTextNode(css_override));
								head.appendChild(style);
							}
						});
					}
					if (typeof jQuery !== 'undefined' && jQuery('.bold_timeline_group').length > 0 && !css_override_group_done) {
						css_override_group_done = true;
						jQuery('.bold_timeline_group').each(function () {
							var css_override = jQuery(this).data('css-override');
							if (css_override != '') {
								var id = jQuery(this).attr('id');
								css_override = css_override.replace(/(\.bold_timeline_group)([\.\{\s])/g, '.bold_timeline_group#' + id + '$2');
								var head = document.getElementsByTagName('head')[0];
								var style = document.createElement('style');
								style.appendChild(document.createTextNode(css_override));
								head.appendChild(style);
							}
						});
					}
					if (typeof jQuery !== 'undefined' && jQuery('.bold_timeline_container').length > 0 && !css_override_container_done) {
						css_override_container_done = true;
						jQuery('.bold_timeline_container').each(function () {
							var css_override = jQuery(this).data('css-override');
							if (css_override != '') {
								var id = jQuery(this).attr('id');
								css_override = css_override.replace(/(\.bold_timeline_container)([\.\{\s])/g, '#' + id + '$2');
								var head = document.getElementsByTagName('head')[0];
								var style = document.createElement('style');
								style.appendChild(document.createTextNode(css_override));
								head.appendChild(style);
							}
						});
					}
				}
			}
		};

		// Create an observer instance linked to the callback function
		const observer = new MutationObserver(callback);

		// Start observing the target node for configured mutations
		observer.observe(targetNode, config);

		// Later, you can stop observing
		document.addEventListener('DOMContentLoaded', function () { observer.disconnect(); }, false);

	</script>
	<link rel="icon" href="../storage/2022/07/cropped-HPIL-Manpower-favicon-32x32.png" sizes="32x32" />
	<link rel="icon" href="../storage/2022/07/cropped-HPIL-Manpower-favicon-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="../storage/2022/07/cropped-HPIL-Manpower-favicon-180x180.png" />
	<meta name="msapplication-TileImage"
		content="https://training.hpilgroup.com.ng/storage/2022/07/cropped-HPIL-Manpower-favicon-270x270.png" />
	<style type="text/css" id="wp-custom-css">
		/* Clear background color on header */
		.btMenuHorizontal.btBelowMenu.btAccentLightHeader .mainHeader,
		.btMenuVertical.btBelowMenu.btAccentLightHeader:not(.btStickyHeaderActive) .btVerticalHeaderTop {
			background: transparent;
		}

		.btAccentLightHeader .btBelowLogoArea:before {
			display: none;
		}

		.btMenuHorizontal.btBelowMenu .mainHeader .btLogoArea .port {
			padding-left: 0;
			padding-right: 0;
		}

		/* Show background color when logo is shown and menu is below logo */
		.btMenuHorizontal.btBelowMenu.btMenuBelowLogoShowArea.btStickyHeaderActive .mainHeader .btLogoArea .port {
			padding-left: 30px;
			padding-right: 30px;
		}

		.btMenuHorizontal.btBelowMenu.btMenuBelowLogoShowArea.btStickyHeaderActive .mainHeader {
			background: #FFF;
		}

		.btMenuHorizontal.btBelowMenu.btMenuBelowLogoShowArea.btStickyHeaderActive .mainHeader .btLogoArea .port {
			padding-left: 30px;
			padding-right: 30px;
		}

		.btIconWidget.btSmallIconWidget {
			font-size: .875rem;
		}

		.btMenuHorizontal .topBarInMenu .btIconWidget.btSmallIconWidget:not(:first-child) {
			margin-left: 1.25em;
		}

		.topBarInMenu .btBodyFontWidget .btIconWidgetTitle {
			font-size: 14px;
			font-family: PT serif;
		}

		.btAccentLightHeader .btBelowLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents {
			color: #FFF;
			background: #18407c;
		}

		/* Remove text transform uppercase on multiple elements */
		.btBreadCrumbs,
		.btArticleCategories {
			text-transform: none;
		}

		.btBox .btImageTextWidget .btImageTextWidgetText .bt_bb_headline_superheadline,
		.btCustomMenu .btImageTextWidget .btImageTextWidgetText .bt_bb_headline_superheadline,
		.btTopBox .btImageTextWidget .btImageTextWidgetText .bt_bb_headline_superheadline {
			text-transform: none;
		}

		.btBox .tagcloud a,
		.btTags ul a {
			text-transform: none;
		}

		.btPrevNextNav .btPrevNext .btPrevNextItem .btPrevNextDir {
			text-transform: capitalize;
		}

		.bt_bb_masonry_post_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category,
		.bt_bb_masonry_post_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category,
		.bt_bb_masonry_portfolio_grid .bt_bb_masonry_portfolio_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category {
			text-transform: none;
		}

		.bt_bb_latest_posts .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_category .post-categories {
			text-transform: none;
		}

		.products ul li.product .onsale,
		ul.products li.product .onsale,
		div.product>.onsale {
			text-transform: none !important;
		}

		/* Bottom dash in people profiles */
		.bt_bb_dash_bottom.bt_bb_headline.btPeopleProfileDash h5 .bt_bb_headline_content:after {
			margin-top: .3em;
		}

		.bt_bb_headline.bt_bb_subheadline.btPeopleProfileDash .bt_bb_headline_subheadline {
			margin-top: .5em;
		}

		/* Customize default page title */
		.btPageHeadline header {
			max-width: 42%;
		}

		.btPageHeadline.bt_bb_section {
			color: #FFF;
			background-size: 65% auto;
			background-position: 100% center !important;
			background-attachment: scroll !important;
		}

		/* RTL version */
		.rtl .btPageHeadline.bt_bb_section {
			background-position: 0 center !important;
		}

		.btPageHeadline.bt_bb_section[class*="light_solid"]:before {
			background-color: rgb(24, 64, 124);
			right: auto;
			width: 46%;
			border-bottom-right-radius: 200px;
		}

		/* RTL version */
		.rtl .btPageHeadline.bt_bb_section[class*="light_solid"]:before {
			background-color: rgb(24, 64, 124);
			right: 0;
			left: auto;
			width: 46%;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 200px;
		}

		.btPageHeadline.bt_bb_section[class*="light_solid"]:after {
			display: block;
			content: "";
			position: absolute;
			left: 0;
			top: 0;
			right: 0;
			height: 140px;
			background: linear-gradient(to bottom, #FFF, transparent);
		}

		/* Single post + Single portfolio headline width */
		.single-post .btPageHeadline header,
		.single-portfolio .btPageHeadline header {
			max-width: 42%;
		}

		/* Swap responsive logo */
		.btMenuVertical .mainHeader .logo img.btMainLogo {
			display: none !important;
		}

		.btMenuVertical .mainHeader .logo img.btAltLogo {
			display: block !important;
		}

		.error404.btMenuHorizontal.btBelowMenu.btAccentLightHeader .mainHeader,
		.error404.btMenuVertical.btBelowMenu.btAccentLightHeader:not(.btStickyHeaderActive) .btVerticalHeaderTop {
			background: #FFF;
		}

		.error404.btMenuHorizontal.btBelowMenu .mainHeader .btLogoArea .port {
			padding: 0 30px;
		}

		.error404.btMenuHorizontal.btBelowMenu.btAccentLightHeader .mainHeader .btMainLogo {
			display: none;
		}

		.error404.btMenuHorizontal.btBelowMenu.btAccentLightHeader .mainHeader .btAltLogo {
			display: block;
		}

		/* Media query */
		@media (max-width: 1200px) {
			.btPageHeadline header {
				max-width: 100%;
			}

			.btPageHeadline.bt_bb_section {
				background-size: cover !important;
				background-position: center !important;
			}

			.btPageHeadline.bt_bb_section[class*="light_solid"]:before {
				background: rgb(24, 64, 124, .8);
				right: 0;
				width: 100%;
				border-bottom-right-radius: 0;
				box-shadow: 0 90px 0 0 rgb(24, 64, 124) inset;
			}
		}
	</style>
	<script>window.bt_bb_preview = false</script>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_1.bt_bb_icon a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_icon:hover a {
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #ffffff;
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #191919 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #191919 inset;
			background-color: #ffffff;
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #191919;
		}

		.bt_bb_colored_icon_color_scheme_1.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_1.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #ffffff;
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #191919 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset !important;
			background-color: #ffffff;
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #ffffff inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #ffffff inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_filled a {
			background-color: #191919;
			color: #ffffff;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #191919;
			color: #ffffff;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_borderless a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_1.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_lined a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_lined a:after {
			background: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_button.bt_bb_style_lined a:hover {
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_1.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #ffffff inset;
			background-color: #ffffff;
			color: #191919 !important;
		}

		.bt_bb_color_scheme_1.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #191919 inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_1.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #191919 inset;
			background-color: transparent;
			color: #191919 !important;
		}

		.bt_bb_color_scheme_1.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_headline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_headline .bt_bb_headline_superheadline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_1.bt_bb_price_list ul li:before {
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #191919 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #191919 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_1.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_1 {
			color: #ffffff;
			background-color: #191919;
		}

		.bt_bb_color_scheme_1 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #191919 !important;
		}

		.bt_bb_color_scheme_1 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_1 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #191919 !important;
		}

		.bt_bb_color_scheme_1 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #191919;
			color: #ffffff;
		}

		.bt_bb_color_scheme_1 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #ffffff !important;
		}

		.bt_bb_color_scheme_1 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_1.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_1 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_1.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #191919;
		}

		.bt_bb_color_scheme_1.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_1.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_1.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #ffffff;
		}

		.bt_bb_color_scheme_1.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #191919;
		}

		.bt_bb_colored_icon_color_scheme_1.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_1.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #191919;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_2.bt_bb_icon a {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_icon:hover a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #191919;
			box-shadow: 0 0 0 1em #191919 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #ffffff inset;
			background-color: #191919;
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_2.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #191919;
		}

		.bt_bb_colored_icon_color_scheme_2.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #191919 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #191919;
			box-shadow: 0 0 0 5em #191919 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset !important;
			background-color: #191919;
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #191919 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #191919 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_filled a {
			background-color: #ffffff;
			color: #191919;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #ffffff;
			color: #191919;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_borderless a {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_2.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_lined a {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_lined a:after {
			background: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_button.bt_bb_style_lined a:hover {
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
			background-color: transparent;
		}

		.bt_bb_color_scheme_2.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #191919 inset;
			background-color: #191919;
			color: #ffffff !important;
		}

		.bt_bb_color_scheme_2.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #191919;
			background-color: transparent;
		}

		.bt_bb_color_scheme_2.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #ffffff inset;
			background-color: transparent;
			color: #ffffff !important;
		}

		.bt_bb_color_scheme_2.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_headline {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_headline .bt_bb_headline_superheadline {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_2.bt_bb_price_list ul li:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #ffffff inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #ffffff inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_2.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_2 {
			color: #191919;
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_2 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #ffffff !important;
		}

		.bt_bb_color_scheme_2 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_2 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #ffffff !important;
		}

		.bt_bb_color_scheme_2 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #ffffff;
			color: #191919;
		}

		.bt_bb_color_scheme_2 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #191919 !important;
		}

		.bt_bb_color_scheme_2 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_2.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #191919;
		}

		.bt_bb_color_scheme_2 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_2.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_2.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_2.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_2.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #191919;
		}

		.bt_bb_color_scheme_2.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_2.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #191919;
		}

		.bt_bb_colored_icon_color_scheme_2.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #ffffff;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_3.bt_bb_icon a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_icon:hover a {
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #dd0000 inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #dd0000;
			box-shadow: 0 0 0 1em #dd0000 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #191919 inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #191919 inset;
			background-color: #dd0000;
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #191919;
		}

		.bt_bb_colored_icon_color_scheme_3.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_3.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #dd0000 inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #dd0000;
			box-shadow: 0 0 0 5em #dd0000 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #191919 inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset !important;
			background-color: #dd0000;
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #dd0000 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #dd0000 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_filled a {
			background-color: #191919;
			color: #dd0000;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #191919;
			color: #dd0000;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_borderless a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_3.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_lined a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_lined a:after {
			background: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_button.bt_bb_style_lined a:hover {
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #dd0000 inset;
			color: #dd0000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_3.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #dd0000 inset;
			background-color: #dd0000;
			color: #191919 !important;
		}

		.bt_bb_color_scheme_3.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #191919 inset;
			color: #dd0000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_3.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #191919 inset;
			background-color: transparent;
			color: #191919 !important;
		}

		.bt_bb_color_scheme_3.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_headline {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_headline .bt_bb_headline_superheadline {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_3.bt_bb_price_list ul li:before {
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #191919 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #191919 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_3.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_3 {
			color: #dd0000;
			background-color: #191919;
		}

		.bt_bb_color_scheme_3 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #191919 !important;
		}

		.bt_bb_color_scheme_3 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_3 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #191919 !important;
		}

		.bt_bb_color_scheme_3 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #191919;
			color: #dd0000;
		}

		.bt_bb_color_scheme_3 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #dd0000 !important;
		}

		.bt_bb_color_scheme_3 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_3.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #dd0000;
		}

		.bt_bb_color_scheme_3 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_3.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #191919;
		}

		.bt_bb_color_scheme_3.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_3.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_3.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #dd0000;
		}

		.bt_bb_color_scheme_3.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #191919;
		}

		.bt_bb_colored_icon_color_scheme_3.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_3.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #191919;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_4.bt_bb_icon a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_icon:hover a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #dd0000 inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #dd0000;
			box-shadow: 0 0 0 1em #dd0000 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #ffffff inset;
			background-color: #dd0000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_4.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_4.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #dd0000 inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #dd0000;
			box-shadow: 0 0 0 5em #dd0000 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset !important;
			background-color: #dd0000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #dd0000 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #dd0000 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_filled a {
			background-color: #ffffff;
			color: #dd0000;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #ffffff;
			color: #dd0000;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_borderless a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_4.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_lined a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_lined a:after {
			background: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_button.bt_bb_style_lined a:hover {
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #dd0000 inset;
			color: #dd0000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_4.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #dd0000 inset;
			background-color: #dd0000;
			color: #ffffff !important;
		}

		.bt_bb_color_scheme_4.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #dd0000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_4.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #ffffff inset;
			background-color: transparent;
			color: #ffffff !important;
		}

		.bt_bb_color_scheme_4.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_headline {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_headline .bt_bb_headline_superheadline {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_4.bt_bb_price_list ul li:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #ffffff inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #ffffff inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_4.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_4 {
			color: #dd0000;
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_4 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #ffffff !important;
		}

		.bt_bb_color_scheme_4 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_4 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #ffffff !important;
		}

		.bt_bb_color_scheme_4 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #ffffff;
			color: #dd0000;
		}

		.bt_bb_color_scheme_4 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #dd0000 !important;
		}

		.bt_bb_color_scheme_4 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_4.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #dd0000;
		}

		.bt_bb_color_scheme_4 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_4.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_4.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_4.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_4.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #dd0000;
		}

		.bt_bb_color_scheme_4.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_4.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_4.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #ffffff;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_5.bt_bb_icon a {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_icon:hover a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #191919;
			box-shadow: 0 0 0 1em #191919 inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #dd0000 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #dd0000 inset;
			background-color: #191919;
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_5.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #191919;
		}

		.bt_bb_colored_icon_color_scheme_5.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #191919 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #191919;
			box-shadow: 0 0 0 5em #191919 inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #dd0000 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #dd0000 inset !important;
			background-color: #191919;
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #191919 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #191919 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_filled a {
			background-color: #dd0000;
			color: #191919;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #dd0000;
			color: #191919;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_borderless a {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_5.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_lined a {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_lined a:after {
			background: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_button.bt_bb_style_lined a:hover {
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
			background-color: transparent;
		}

		.bt_bb_color_scheme_5.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #191919 inset;
			background-color: #191919;
			color: #dd0000 !important;
		}

		.bt_bb_color_scheme_5.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #dd0000 inset;
			color: #191919;
			background-color: transparent;
		}

		.bt_bb_color_scheme_5.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #dd0000 inset;
			background-color: transparent;
			color: #dd0000 !important;
		}

		.bt_bb_color_scheme_5.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_headline {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_headline .bt_bb_headline_superheadline {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_5.bt_bb_price_list ul li:before {
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #dd0000 inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #dd0000 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #dd0000 inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #dd0000 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_5.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_5 {
			color: #191919;
			background-color: #dd0000;
		}

		.bt_bb_color_scheme_5 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #dd0000 !important;
		}

		.bt_bb_color_scheme_5 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_5 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #dd0000 !important;
		}

		.bt_bb_color_scheme_5 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #dd0000;
			color: #191919;
		}

		.bt_bb_color_scheme_5 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #191919 !important;
		}

		.bt_bb_color_scheme_5 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_5.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #191919;
		}

		.bt_bb_color_scheme_5 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_5.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #dd0000;
		}

		.bt_bb_color_scheme_5.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_5.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_5.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #191919;
		}

		.bt_bb_color_scheme_5.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_5.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #191919;
		}

		.bt_bb_colored_icon_color_scheme_5.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #dd0000;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_6.bt_bb_icon a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_icon:hover a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #ffffff;
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #dd0000 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #dd0000 inset;
			background-color: #ffffff;
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_6.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_6.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #ffffff;
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #dd0000 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #dd0000 inset !important;
			background-color: #ffffff;
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #ffffff inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #ffffff inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_filled a {
			background-color: #dd0000;
			color: #ffffff;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #dd0000;
			color: #ffffff;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_borderless a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_6.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_lined a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_lined a:after {
			background: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_button.bt_bb_style_lined a:hover {
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_6.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #ffffff inset;
			background-color: #ffffff;
			color: #dd0000 !important;
		}

		.bt_bb_color_scheme_6.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #dd0000 inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_6.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #dd0000 inset;
			background-color: transparent;
			color: #dd0000 !important;
		}

		.bt_bb_color_scheme_6.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_headline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_headline .bt_bb_headline_superheadline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_6.bt_bb_price_list ul li:before {
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #dd0000 inset;
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #dd0000 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #dd0000 inset !important;
			color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #dd0000 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_6.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_6 {
			color: #ffffff;
			background-color: #dd0000;
		}

		.bt_bb_color_scheme_6 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #dd0000 !important;
		}

		.bt_bb_color_scheme_6 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_6 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #dd0000 !important;
		}

		.bt_bb_color_scheme_6 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #dd0000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_6 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #ffffff !important;
		}

		.bt_bb_color_scheme_6 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_6.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_6 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_6.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #dd0000;
		}

		.bt_bb_color_scheme_6.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_6.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_6.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #ffffff;
		}

		.bt_bb_color_scheme_6.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #dd0000;
		}

		.bt_bb_colored_icon_color_scheme_6.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_6.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #dd0000;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_7.bt_bb_icon a {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_icon:hover a {
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #000000;
			box-shadow: 0 0 0 1em #000000 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #191919 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #191919 inset;
			background-color: #000000;
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #191919;
		}

		.bt_bb_colored_icon_color_scheme_7.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #000000;
		}

		.bt_bb_colored_icon_color_scheme_7.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #000000 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #000000;
			box-shadow: 0 0 0 5em #000000 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #191919 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset !important;
			background-color: #000000;
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #000000 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #000000 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_filled a {
			background-color: #191919;
			color: #000000;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #191919;
			color: #000000;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_borderless a {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_7.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_lined a {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_lined a:after {
			background: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_button.bt_bb_style_lined a:hover {
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_7.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #000000 inset;
			background-color: #000000;
			color: #191919 !important;
		}

		.bt_bb_color_scheme_7.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #191919 inset;
			color: #000000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_7.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #191919 inset;
			background-color: transparent;
			color: #191919 !important;
		}

		.bt_bb_color_scheme_7.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_headline {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_headline .bt_bb_headline_superheadline {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_7.bt_bb_price_list ul li:before {
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #191919 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #191919 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_7.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_7 {
			color: #000000;
			background-color: #191919;
		}

		.bt_bb_color_scheme_7 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #191919 !important;
		}

		.bt_bb_color_scheme_7 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_7 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #191919 !important;
		}

		.bt_bb_color_scheme_7 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #191919;
			color: #000000;
		}

		.bt_bb_color_scheme_7 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #000000 !important;
		}

		.bt_bb_color_scheme_7 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_7.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #000000;
		}

		.bt_bb_color_scheme_7 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_7.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #191919;
		}

		.bt_bb_color_scheme_7.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_7.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_7.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #000000;
		}

		.bt_bb_color_scheme_7.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #191919;
		}

		.bt_bb_colored_icon_color_scheme_7.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #000000;
		}

		.bt_bb_colored_icon_color_scheme_7.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #191919;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_8.bt_bb_icon a {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_icon:hover a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #000000;
			box-shadow: 0 0 0 1em #000000 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #ffffff inset;
			background-color: #000000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_8.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #000000;
		}

		.bt_bb_colored_icon_color_scheme_8.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #000000 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #000000;
			box-shadow: 0 0 0 5em #000000 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset !important;
			background-color: #000000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #000000 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #000000 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_filled a {
			background-color: #ffffff;
			color: #000000;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #ffffff;
			color: #000000;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_borderless a {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_8.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_lined a {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_lined a:after {
			background: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_button.bt_bb_style_lined a:hover {
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_8.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #000000 inset;
			background-color: #000000;
			color: #ffffff !important;
		}

		.bt_bb_color_scheme_8.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #000000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_8.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #ffffff inset;
			background-color: transparent;
			color: #ffffff !important;
		}

		.bt_bb_color_scheme_8.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_headline {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_headline .bt_bb_headline_superheadline {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_8.bt_bb_price_list ul li:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #ffffff inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #ffffff inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_8.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_8 {
			color: #000000;
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_8 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #ffffff !important;
		}

		.bt_bb_color_scheme_8 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_8 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #ffffff !important;
		}

		.bt_bb_color_scheme_8 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #ffffff;
			color: #000000;
		}

		.bt_bb_color_scheme_8 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #000000 !important;
		}

		.bt_bb_color_scheme_8 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_8.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #000000;
		}

		.bt_bb_color_scheme_8 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_8.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_8.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_8.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_8.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #000000;
		}

		.bt_bb_color_scheme_8.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_8.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #000000;
		}

		.bt_bb_colored_icon_color_scheme_8.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #ffffff;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_9.bt_bb_icon a {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_icon:hover a {
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #191919;
			box-shadow: 0 0 0 1em #191919 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #000000 inset;
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000000 inset;
			background-color: #191919;
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #000000;
		}

		.bt_bb_colored_icon_color_scheme_9.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #191919;
		}

		.bt_bb_colored_icon_color_scheme_9.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #191919 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #191919;
			box-shadow: 0 0 0 5em #191919 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #000000 inset !important;
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset !important;
			background-color: #191919;
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #191919 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #191919 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_filled a {
			background-color: #000000;
			color: #191919;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #000000;
			color: #191919;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_borderless a {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_9.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_lined a {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_lined a:after {
			background: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_button.bt_bb_style_lined a:hover {
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #191919 inset;
			color: #191919;
			background-color: transparent;
		}

		.bt_bb_color_scheme_9.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #191919 inset;
			background-color: #191919;
			color: #000000 !important;
		}

		.bt_bb_color_scheme_9.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #000000 inset;
			color: #191919;
			background-color: transparent;
		}

		.bt_bb_color_scheme_9.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #000000 inset;
			background-color: transparent;
			color: #000000 !important;
		}

		.bt_bb_color_scheme_9.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_headline {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_headline .bt_bb_headline_superheadline {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_9.bt_bb_price_list ul li:before {
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #000000 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #000000 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_9.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_9 {
			color: #191919;
			background-color: #000000;
		}

		.bt_bb_color_scheme_9 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #000000 !important;
		}

		.bt_bb_color_scheme_9 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_9 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #000000 !important;
		}

		.bt_bb_color_scheme_9 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #000000;
			color: #191919;
		}

		.bt_bb_color_scheme_9 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #191919 !important;
		}

		.bt_bb_color_scheme_9 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_9.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #191919;
		}

		.bt_bb_color_scheme_9 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_9.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #000000;
		}

		.bt_bb_color_scheme_9.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_9.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_9.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #191919;
		}

		.bt_bb_color_scheme_9.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #000000;
		}

		.bt_bb_colored_icon_color_scheme_9.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #191919;
		}

		.bt_bb_colored_icon_color_scheme_9.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #000000;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_10.bt_bb_icon a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_icon:hover a {
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #ffffff;
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #000000 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000000 inset;
			background-color: #ffffff;
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #000000;
		}

		.bt_bb_colored_icon_color_scheme_10.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_10.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #ffffff;
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #000000 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset !important;
			background-color: #ffffff;
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #ffffff inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #ffffff inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_filled a {
			background-color: #000000;
			color: #ffffff;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #000000;
			color: #ffffff;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_borderless a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_10.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_lined a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_lined a:after {
			background: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_button.bt_bb_style_lined a:hover {
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_10.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #ffffff inset;
			background-color: #ffffff;
			color: #000000 !important;
		}

		.bt_bb_color_scheme_10.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #000000 inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_10.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #000000 inset;
			background-color: transparent;
			color: #000000 !important;
		}

		.bt_bb_color_scheme_10.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_headline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_headline .bt_bb_headline_superheadline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_10.bt_bb_price_list ul li:before {
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #000000 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #000000 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_10.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_10 {
			color: #ffffff;
			background-color: #000000;
		}

		.bt_bb_color_scheme_10 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #000000 !important;
		}

		.bt_bb_color_scheme_10 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_10 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #000000 !important;
		}

		.bt_bb_color_scheme_10 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #000000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_10 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #ffffff !important;
		}

		.bt_bb_color_scheme_10 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_10.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_10 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_10.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #000000;
		}

		.bt_bb_color_scheme_10.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_10.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_10.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #ffffff;
		}

		.bt_bb_color_scheme_10.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #000000;
		}

		.bt_bb_colored_icon_color_scheme_10.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_10.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #000000;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_11.bt_bb_icon a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_icon:hover a {
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #ffffff;
			box-shadow: 0 0 0 1em #ffffff inset;
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #000000 inset;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000000 inset;
			background-color: #ffffff;
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #000000;
		}

		.bt_bb_colored_icon_color_scheme_11.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_11.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #ffffff inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #ffffff;
			box-shadow: 0 0 0 5em #ffffff inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #000000 inset !important;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset !important;
			background-color: #ffffff;
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #ffffff inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #ffffff inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_filled a {
			background-color: #000000;
			color: #ffffff;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #000000;
			color: #ffffff;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_borderless a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_11.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_lined a {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_lined a:after {
			background: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_button.bt_bb_style_lined a:hover {
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #ffffff inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_11.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #ffffff inset;
			background-color: #ffffff;
			color: #000000 !important;
		}

		.bt_bb_color_scheme_11.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #000000 inset;
			color: #ffffff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_11.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #000000 inset;
			background-color: transparent;
			color: #000000 !important;
		}

		.bt_bb_color_scheme_11.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_headline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_headline .bt_bb_headline_superheadline {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_11.bt_bb_price_list ul li:before {
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000000 inset;
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #000000 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000000 inset !important;
			color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #000000 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_11.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_11 {
			color: #ffffff;
			background-color: #000000;
		}

		.bt_bb_color_scheme_11 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #000000 !important;
		}

		.bt_bb_color_scheme_11 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_11 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #000000 !important;
		}

		.bt_bb_color_scheme_11 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #000000;
			color: #ffffff;
		}

		.bt_bb_color_scheme_11 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #ffffff !important;
		}

		.bt_bb_color_scheme_11 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_11.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #ffffff;
		}

		.bt_bb_color_scheme_11 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_11.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #000000;
		}

		.bt_bb_color_scheme_11.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_11.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_11.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #ffffff;
		}

		.bt_bb_color_scheme_11.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #000000;
		}

		.bt_bb_colored_icon_color_scheme_11.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #ffffff;
		}

		.bt_bb_colored_icon_color_scheme_11.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #000000;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_12.bt_bb_icon a {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_icon:hover a {
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #181818 inset;
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #181818;
			box-shadow: 0 0 0 1em #181818 inset;
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #efefef inset;
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #efefef inset;
			background-color: #181818;
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #efefef;
		}

		.bt_bb_colored_icon_color_scheme_12.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #181818;
		}

		.bt_bb_colored_icon_color_scheme_12.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #181818 inset !important;
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #181818;
			box-shadow: 0 0 0 5em #181818 inset !important;
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #efefef inset !important;
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #efefef inset !important;
			background-color: #181818;
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #181818 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #181818 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_filled a {
			background-color: #efefef;
			color: #181818;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #efefef;
			color: #181818;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_borderless a {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_12.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_lined a {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_lined a:after {
			background: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_button.bt_bb_style_lined a:hover {
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #181818 inset;
			color: #181818;
			background-color: transparent;
		}

		.bt_bb_color_scheme_12.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #181818 inset;
			background-color: #181818;
			color: #efefef !important;
		}

		.bt_bb_color_scheme_12.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #efefef inset;
			color: #181818;
			background-color: transparent;
		}

		.bt_bb_color_scheme_12.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #efefef inset;
			background-color: transparent;
			color: #efefef !important;
		}

		.bt_bb_color_scheme_12.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_headline {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_headline .bt_bb_headline_superheadline {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_12.bt_bb_price_list ul li:before {
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #efefef inset;
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #efefef inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #efefef inset !important;
			color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #efefef inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_12.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_12 {
			color: #181818;
			background-color: #efefef;
		}

		.bt_bb_color_scheme_12 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #efefef !important;
		}

		.bt_bb_color_scheme_12 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_12 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #efefef !important;
		}

		.bt_bb_color_scheme_12 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #efefef;
			color: #181818;
		}

		.bt_bb_color_scheme_12 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #181818 !important;
		}

		.bt_bb_color_scheme_12 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_12.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #181818;
		}

		.bt_bb_color_scheme_12 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_12.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #efefef;
		}

		.bt_bb_color_scheme_12.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_12.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_12.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #181818;
		}

		.bt_bb_color_scheme_12.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #efefef;
		}

		.bt_bb_colored_icon_color_scheme_12.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #181818;
		}

		.bt_bb_colored_icon_color_scheme_12.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #efefef;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_13.bt_bb_icon a {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_icon:hover a {
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #000 inset;
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #000;
			box-shadow: 0 0 0 1em #000 inset;
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #fff inset;
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #fff inset;
			background-color: #000;
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #fff;
		}

		.bt_bb_colored_icon_color_scheme_13.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #000;
		}

		.bt_bb_colored_icon_color_scheme_13.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #000 inset !important;
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #000;
			box-shadow: 0 0 0 5em #000 inset !important;
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #fff inset !important;
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #fff inset !important;
			background-color: #000;
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #000 inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #000 inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_filled a {
			background-color: #fff;
			color: #000;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #fff;
			color: #000;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_borderless a {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_13.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_lined a {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_lined a:after {
			background: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_button.bt_bb_style_lined a:hover {
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000 inset;
			color: #000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_13.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #000 inset;
			background-color: #000;
			color: #fff !important;
		}

		.bt_bb_color_scheme_13.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #fff inset;
			color: #000;
			background-color: transparent;
		}

		.bt_bb_color_scheme_13.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #fff inset;
			background-color: transparent;
			color: #fff !important;
		}

		.bt_bb_color_scheme_13.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_headline {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_headline .bt_bb_headline_superheadline {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_13.bt_bb_price_list ul li:before {
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #fff inset;
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #fff inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #fff inset !important;
			color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #fff inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_13.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_13 {
			color: #000;
			background-color: #fff;
		}

		.bt_bb_color_scheme_13 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #fff !important;
		}

		.bt_bb_color_scheme_13 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_13 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #fff !important;
		}

		.bt_bb_color_scheme_13 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #fff;
			color: #000;
		}

		.bt_bb_color_scheme_13 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #000 !important;
		}

		.bt_bb_color_scheme_13 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_13.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #000;
		}

		.bt_bb_color_scheme_13 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_13.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #fff;
		}

		.bt_bb_color_scheme_13.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_13.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_13.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #000;
		}

		.bt_bb_color_scheme_13.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #fff;
		}

		.bt_bb_colored_icon_color_scheme_13.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #000;
		}

		.bt_bb_colored_icon_color_scheme_13.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #fff;
		}
	</style>
	<style data-id="bt_bb_color_schemes">
		.bt_bb_color_scheme_14.bt_bb_icon a {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_icon:hover a {
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			background-color: transparent;
			box-shadow: 0 0 0 2px #fff inset;
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
			background-color: #fff;
			box-shadow: 0 0 0 1em #fff inset;
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 1em #000 inset;
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000 inset;
			background-color: #fff;
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_borderless:hover a:hover,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder>span {
			color: #000;
		}

		.bt_bb_colored_icon_color_scheme_14.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-2 {
			fill: #fff;
		}

		.bt_bb_colored_icon_color_scheme_14.bt_bb_icon .bt_bb_icon_colored_icon svg .cls-1 {
			fill: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			background-color: transparent;
			box-shadow: 0 0 0 2px #fff inset !important;
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			background-color: #fff;
			box-shadow: 0 0 0 5em #fff inset !important;
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder {
			box-shadow: 0 0 0 5em #000 inset !important;
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right:hover a.bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left:hover a.bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000 inset !important;
			background-color: #fff;
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_outline {
			border: 0;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_outline a {
			box-shadow: 0 0 0 2px #fff inset, 0 4px 0 0 rgba(24, 24, 24, .15) inset;
			background-color: transparent;
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_outline:hover a,
		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_outline:hover a:hover {
			box-shadow: 0 0 0 2px #fff inset, 0 5px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
			background-color: transparent;
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_filled {
			border: 0;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_filled a {
			background-color: #000;
			color: #fff;
			box-shadow: 0 -2px 0 0 rgba(24, 24, 24, .15) inset;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_filled:hover a,
		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_filled a:hover {
			background-color: #000;
			color: #fff;
			box-shadow: 0 -3px 0 0 rgba(24, 24, 24, .15) inset, 0 3px 10px rgba(0, 0, 0, 0.3);
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_clean a,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_borderless a {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_clean:hover a,
		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_clean a:hover,
		.bt_bb_color_scheme_14.bt_bb_icon.bt_bb_style_borderless:hover a {
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_lined a {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_lined a:after {
			background: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_button.bt_bb_style_lined a:hover {
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_style_outline.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_style_outline.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #fff inset;
			color: #fff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_14.bt_bb_style_outline.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 1em #fff inset;
			background-color: #fff;
			color: #000 !important;
		}

		.bt_bb_color_scheme_14.bt_bb_style_filled.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_style_filled.bt_bb_service:hover .bt_bb_icon_holder {
			box-shadow: 0 0 0 1em #000 inset;
			color: #fff;
			background-color: transparent;
		}

		.bt_bb_color_scheme_14.bt_bb_style_filled.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			box-shadow: 0 0 0 2px #000 inset;
			background-color: transparent;
			color: #000 !important;
		}

		.bt_bb_color_scheme_14.bt_bb_style_borderless.bt_bb_service .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_style_borderless.bt_bb_service:hover .bt_bb_icon_holder {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_style_borderless.bt_bb_service:hover a.bt_bb_icon_holder:hover {
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_headline {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_headline .bt_bb_headline_superheadline {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_price_list_price,
		.bt_bb_color_scheme_14.bt_bb_price_list ul li:before {
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2px #000 inset;
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before {
			box-shadow: 0 0 0 2em #000 inset;
			color: #FFF;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before {
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 2px #000 inset !important;
			color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_outline.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder,
		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder {
			box-shadow: 0 0 0 4.5em #000 inset !important;
			color: #FFF;
		}

		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_left .bt_bb_icon_holder:before,
		.bt_bb_color_scheme_14.bt_bb_price_list .bt_bb_icon.bt_bb_style_filled.bt_bb_shape_slanted_right .bt_bb_icon_holder:before {
			color: currentColor;
		}

		.bt_bb_section.bt_bb_color_scheme_14 {
			color: #fff;
			background-color: #000;
		}

		.bt_bb_color_scheme_14 .bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_title_excerpt_holder:before {
			background-color: #000 !important;
		}

		.bt_bb_color_scheme_14 .bt_bb_masonry_post_grid .bt_bb_grid_item_post_content:before,
		.bt_bb_color_scheme_14 .bt_bb_masonry_portfolio_grid .bt_bb_grid_item_post_content:before {
			background-color: #000 !important;
		}

		.bt_bb_color_scheme_14 .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
			background-color: #000;
			color: #fff;
		}

		.bt_bb_color_scheme_14 .btWorkingHours .bt_bb_working_hours_inner_row:after {
			border-color: #fff !important;
		}

		.bt_bb_color_scheme_14 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_14.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
			background-color: #fff;
		}

		.bt_bb_color_scheme_14 .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
		.bt_bb_color_scheme_14.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
			background-color: #000;
		}

		.bt_bb_color_scheme_14.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
			color: currentColor;
		}

		.bt_bb_color_scheme_14.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner .bt_bb_progress_bar_percent {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_splitted_headline .bt_bb_splitted_headline_first,
		.bt_bb_color_scheme_14.bt_bb_splitted_headline .bt_bb_splitted_headline_second {
			color: #fff;
		}

		.bt_bb_color_scheme_14.bt_bb_splitted_headline .bt_bb_splitted_headline_line {
			background-color: #000;
		}

		.bt_bb_colored_icon_color_scheme_14.bt_bb_service .bt_bb_service_colored_icon svg .cls-2 {
			fill: #fff;
		}

		.bt_bb_colored_icon_color_scheme_14.bt_bb_service .bt_bb_service_colored_icon svg .cls-1 {
			fill: #000;
		}
	</style>
	<script>window.bt_bb_custom_elements = false;</script>
</head>


<body
	class="page-template-default page page-id-1601 bt_bb_plugin_active bt_bb_fe_preview_toggle btHeadingStyle_default btHasAltLogo btMenuLeftEnabled btMenuBelowLogo btStickyEnabled btLightSkin btBelowMenu noBodyPreloader btHardRoundedButtons btAccentLightHeader btNoSidebar btShopSaleTagDesignRound">


	<div class="btPageWrap" id="top">

		<div class="btVerticalHeaderTop">
			<div class="btVerticalMenuTrigger">&nbsp;<div class="bt_bb_icon" data-bt-override-class="null"><a href="#"
						target="_self" data-ico-fa="&#xf0c9;" class="bt_bb_icon_holder"></a></div>
			</div>

			<div class="btLogoArea">
				<div class="logo">
					<span>
						<a href="https://training.hpilgroup.com.ng"><img class="btMainLogo" data-hw="2.1327014218009"
								src="https://training.hpilgroup.com.ng/storage/2022/07/index-logo.png" alt="HPIL Training"><img class="btAltLogo"
								src="https://training.hpilgroup.com.ng/storage/2022/07/Hpil-training-logo-black.png" alt="HPIL Training"></a> </span>
				</div>
			</div>
		</div>
		<header class="mainHeader btClear gutter ">
			<div class="mainHeaderInner">
				<div class="btLogoArea menuHolder btClear">
					<div class="port">
						<div class="btHorizontalMenuTrigger">&nbsp;<div class="bt_bb_icon"
								data-bt-override-class="null"><a href="#" target="_self" data-ico-fa="&#xf0c9;"
									class="bt_bb_icon_holder"></a></div>
						</div>
						<div class="logo">
							<span>
								<a href="https://training.hpilgroup.com.ng"><img class="btMainLogo" data-hw="2.1327014218009"
										src="https://training.hpilgroup.com.ng/storage/2022/07/index-logo.png" alt="HPIL Training"><img
										class="btAltLogo" src="https://training.hpilgroup.com.ng/storage/2022/07/index-logo.png"
										alt="HPIL Training"></a> </span>
						</div>
					</div>
				</div>
				<div class="btBelowLogoArea btClear">
					<div class="port">
						<div class="menuPort">
							<div class="topBarInMenu">
								<div class="topBarInMenuCell">
									<div class="btTopBox widget_search">
										<div class="btSearch">
											<div class="bt_bb_icon" data-bt-override-class="null"><a href="#"
													target="_self" data-ico-fa="&#xf002;" class="bt_bb_icon_holder"></a>
											</div>
											<div class="btSearchInner gutter" role="search">
												<div class="btSearchInnerContent port">
													<form action="https://training.hpilgroup.com.ng/" method="get">
														<input type="text" name="s" placeholder="Looking for..."
															class="untouched">
														<button type="submit" data-icon="&#xf105;"></button>
													</form>
													<div class="btSearchInnerClose">
														<div class="bt_bb_icon" data-bt-override-class="null"><a
																href="#" target="_self" data-ico-fa="&#xf00d;"
																class="bt_bb_icon_holder"></a></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						  <nav>
                                    <ul id="menu-hpil-training" class="menu">
                                        <li id="menu-item-8137" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-8137"><a href="https://training.hpilgroup.com.ng">Home</a></li>
                                        <li id="menu-item-8138" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8138"><a href="https://training.hpilgroup.com.ng/about-us/">About Us</a></li>
                                        <li id="menu-item-8140" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8140">
                                            <a href="#">List Of Trainings</a>
                                            <ul class="sub-menu">
                                                <li id="menu-item-8141" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8141"><a href="https://training.hpilgroup.com.ng/business-based-trainings/">Business Based Training</a></li>
                                                <li id="menu-item-8142" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8142"><a href="https://training.hpilgroup.com.ng/technical-trainings/">Technical Based Training</a></li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-8144" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8144"><a href="https://training.hpilgroup.com.ng/trainingbooking">Training Booking</a></li>
                                        <li id="menu-item-8143" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1601 current_page_item menu-item-8143">
                                            <a href="https://training.hpilgroup.com.ng/contact/" aria-current="page">Enquiry</a>
                                        </li>
                                    </ul>
                                </nav>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="btContentWrap btClear">
			<section
				class="bt_bb_section gutter bt_bb_vertical_align_top btPageHeadline bt_bb_background_image bt_bb_background_overlay_light_solid bt_bb_parallax btLightSkin "
				style="background-image: url(images/booking.jpg);" data-parallax=""
				data-parallax-offset="-300">
				<div class="bt_bb_port port">
					<div class="bt_bb_cell">
						<div class="bt_bb_cell_inner">
							<div class="bt_bb_row">
								<div class="bt_bb_column">
									<div class="bt_bb_column_content">
										<header
											class="bt_bb_headline bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_large"
											data-bt-override-class="{}">
											<div class="bt_bb_headline_superheadline_outside"><span
													class="bt_bb_headline_superheadline"><span
														class="btBreadCrumbs"><span><a
																href="../index.html">Home</a></span></span></span></div>
											<h1 class="bt_bb_headline_tag"><span
													class="bt_bb_headline_content"><span>Training Booking</span></span></h1>
											<!-- <div class="bt_bb_headline_subheadline text-capitalize"><?= $result['category'] ?>/ <?= $result['title'] ?></div> -->
										</header>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="btContentHolder">

				<div class="btContent">
					<div class="bt_bb_wrapper">
						<section id="bt_bb_section638098d6679e8"
							class="bt_bb_section bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_section_show_left_boxed_content"
							style="box-shadow: 0 0 100px rgba(0,0,0,.07);" data-bt-override-class="null">
							<div class="bt_bb_port">
								<div class="bt_bb_cell">
									<div class="bt_bb_cell_inner">
										<div class="container">
											<div class="row">
												<div class="col-md-6"
													>
													<div class="bt_bb_column_content">
														<div class="bt_bb_floating_element bt_bb_floating_element_horizontal_position_left bt_bb_floating_element_vertical_position_top bt_bb_floating_element_animation_delay_default bt_bb_floating_element_animation_duration_default bt_bb_floating_element_animation_style_ease_out"
															style="margin: -4em 0 0 5em;" data-speed="1.0">
															<div class="bt_bb_floating_element_html" data-speed="1.0">
																<span
																	style="width: 124px; height: 124px; border-radius: 50%; box-shadow: 0 1.25em 4.5em rgba(0,0,0,.1);background-color: rgba(255, 255, 255, 1);"></span>
															</div>
														</div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_normal"
															data-bt-override-class="null"></div>
														<div class="bt_bb_text">
															<p>Fill out the form below to contact us. Please, bear in
																mind that required fields are marked with an asterisk.
															</p>
														</div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_normal"
															data-bt-override-class="null"></div>
														<div class="bt_bb_contact_form_7">
															<div  class="wpcf7" >
																<form
																	action="booking.php"
																	method="post" >
																	<div
																		class="bt_bb_cf7_form bt_bb_cf7_larger_spacing bt_bb_alternate_submit">
																		<div class="bt_bb_cf7_row">
																			<div class="bt_bb_cf7_element"><span
																					class="wpcf7-form-control-wrap"
																					data-name="your-name"><input
																						type="text" name="name"
																						value="" size="40" required
																						class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
																						placeholder="Your Name *" /></span>
																			</div>
																		</div>
																		<div class="bt_bb_cf7_row">
																			<div class="bt_bb_cf7_element"><span
																					class="wpcf7-form-control-wrap"
																					data-name="your-email"><input
																						type="email" name="email"
																						value="" size="40" required
																						class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
																						placeholder="Your Email Address *" /></span>
																			</div>
																		</div>
																		<div class="bt_bb_cf7_row">
																			<div class="bt_bb_cf7_element"><span
																					class="wpcf7-form-control-wrap"
																					data-name="your-email"><input
																						type="text" name="number"
																						value="" size="40" required
																						class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
																						placeholder="Your Phone No *" /></span>
																			</div>
																		</div>
																		<!-- <div class="bt_bb_cf7_row">
																			<div class="bt_bb_cf7_element"><span
																					class="wpcf7-form-control-wrap"
																					data-name="discussion">
																					<input
																						type="text" name="category"
																						 size="40" required readonly
																						class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
																						value="<?= $result['title'] ?>" />
																						</span></div>
																		</div> -->
																		<div class="bt_bb_cf7_row">
																			<div class="bt_bb_cf7_element"><span
																					class="wpcf7-form-control-wrap"
																					data-name="your-message"><textarea
																						name="message" cols="40"
																						rows="6" required
																						class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
																						placeholder="Your Message *"></textarea></span>
																			</div>
																		</div>
																		<div class="bt_bb_cf7_row">
																			<div
																				class="bt_bb_cf7_button bt_bb_cf7_element">
																				<button  type="submit" class="btn btn-dark" style="border-radius: 50px; background: #dd0000;
                                                                        font-family: 'Montserrat',Arial,Helvetica,sans-serif; box-shadow: 0 -2px 0 0 rgba(24,24,24,.15) inset;background: red;color: #fff;padding: 1.125em 1.875em;-webkit-transition: all 300ms ease;-moz-transition: all 300ms ease;transition: all 300ms ease;font-weight: 700;display: inline-block;line-height: 1;">Book Now</button>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_normal"
															data-bt-override-class="null"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="mt-3"  >
                            <div class="d-flex justify-content-between">
                                <div class="txt-heading btn">Shopping Cart</div>
								<div>
									<a  class="btn btn-outline-danger " href="index.php?action=add&code=<?= $_GET['code'] ?>">Go Back</a>
									<a id="btnEmpty" class="btn btn-outline-danger " href="index.php?action=empty">Empty Cart</a>
								</div>
                            </div>
		<?php
        if (isset($_SESSION["cart_item"])) {
	        $total_quantity = 0;
	        $total_price = 0;
			$sn = 0;
        ?>
		<div class="table-responsive  table-responsive-sm" style="  width: 100% !important; @media (max-width: 980px){width: 100vw !important;overflow-x: auto !important;} ">
			<table class="table table-border table-striped table-responsive table-sm  table-hover "  >
				<tbody>
					<tr>
						<th style="text-align:left;">Image</th>
						<th style="text-align:left;">Name</th>
						<th style="text-align:left;">Item Code</th>
						<th style="text-align:right;" >No Of Seats</th>
						<th style="text-align:right;" >Unit Price</th>
						<th style="text-align:right;" >Total Price</th>
						<th style="text-align:center;">Remove</th>
					</tr>
					<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<tr>
						
						<td><img src="../admin/controller/coursePic/<?php echo $item["image"]; ?>" class="img=fluid" style="width: 200px; height: 50px;" />
						</td>
						<td>
							<?php echo $_SESSION['cart_num'] = ++$sn; ?>
							<?php echo $item["name"]; ?>
						</td>
						<td>
							<?php echo $item["code"]; ?>
						</td>
						<td style="text-align:right;">
							<?php echo $item["quantity"]; ?>
						</td>
						<td style="text-align:right;">
							<?php echo "₦" . $item["price"]; ?>
						</td>
						<td style="text-align:right;">
							<?php echo "₦ " . number_format($item_price, 2); ?>
						</td>
						<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>"
								class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"] * $item["quantity"]);
				}
					?>
					<tr>
						<td colspan="3" align="right">Grand Total:</td>
						<td align="right">
							<?php echo $total_quantity; ?>
						</td>
						<td align="right" colspan="2"><strong>
								<?php echo " ₦ " . number_format($total_price, 2); ?>
							</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
        } else {
        ?>
		<div class="border text-center py-3">Your Cart is Empty</div>
		<?php
        }
        ?>
	</div>
													<!-- <img src="../admin/controller/coursePic/<?= $result['cover_image'] ?>" class="card-img-top" alt="..."> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						<section id="bt_bb_section638098d66911b"
							class="bt_bb_section bt_bb_color_scheme_1 bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_top_spacing_ bt_bb_bottom_spacing_ bt_bb_hidden_xs bt_bb_hidden_ms bt_bb_hidden_sm bt_bb_hidden_md bt_bb_hidden_lg bt_bb_section_show_right_boxed_content bt_bb_section_with_top_coverage_image"
							style=";background-color:#18407c;"
							data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_&quot;,&quot;xl&quot;:&quot;&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_&quot;,&quot;xl&quot;:&quot;&quot;}}">
							<div class="bt_bb_port">
								<div class="bt_bb_cell">
									<div class="bt_bb_cell_inner">
										<div class="bt_bb_row_wrapper">
											<div class="bt_bb_row">
												<div class="bt_bb_column col-xl-6 bt_bb_align_right bt_bb_vertical_align_top bt_bb_animation_fade_in animate bt_bb_padding_normal btLazyLoadBackground bt_bb_column_background_image bt_bb_mobile_align_to_both_edges bt_bb_animation_fade_in animate"
													style="padding-right: 0;background-image:url(https_/training.hpilgroup.com.ng/core/modules/478e514c83/img/blank.html);background-position:right top;background-size:cover;"
													data-background_image_src='https://training.hpilgroup.com.ng/storage/2019/04/blog-post-01.jpg'
													data-width="6" data-bt-override-class="{}">
													<div class="bt_bb_column_content">
														<div class="bt_bb_image bt_bb_shape_square bt_bb_target_self bt_bb_align_inherit bt_bb_hover_style_simple bt_bb_content_display_always bt_bb_content_align_middle bt_bb_hidden_xs bt_bb_hidden_ms bt_bb_hidden_sm bt_bb_fill_background_color_full"
															style="max-width: 142px;" data-bt-override-class="{}">
															<span><img width="142" height="142"
																	src="../storage/2020/04/img-blue-corner-top-right.png"
																	class="attachment-full size-full"
																	alt="https://training.hpilgroup.com.ng/storage/2020/04/img-blue-corner-top-right.png"
																	decoding="async" loading="lazy"
																	data-full_image_src="https://training.hpilgroup.com.ng/storage/2020/04/img-blue-corner-top-right.png"
																	srcset="https://training.hpilgroup.com.ng/storage/2020/04/img-blue-corner-top-right.png 142w, https://training.hpilgroup.com.ng/storage/2020/04/img-blue-corner-top-right-100x100.png 100w"
																	sizes="(max-width: 142px) 100vw, 142px" /></span>
														</div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_large"
															data-bt-override-class="null"></div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_large"
															data-bt-override-class="null"></div>
													</div>
												</div>
												<div class="bt_bb_column col-xl-6 bt_bb_align_left bt_bb_vertical_align_top bt_bb_animation_fade_in animate bt_bb_padding_normal bt_bb_animation_fade_in animate"
													data-width="6" data-bt-override-class="{}">
													<div class="bt_bb_column_content">
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_large bt_bb_hidden_xs bt_bb_hidden_ms bt_bb_hidden_sm"
															data-bt-override-class="null"></div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_medium bt_bb_bottom_spacing_normal bt_bb_hidden_md bt_bb_hidden_lg"
															data-bt-override-class="null"></div>
														<div class="bt_bb_row_inner">
															<div class="bt_bb_column_inner col-xl-2 bt_bb_align_left bt_bb_vertical_align_top"
																data-width="2" data-bt-override-class="{}">
																<div class="bt_bb_column_inner_content"></div>
															</div>
															<div class="bt_bb_column_inner col-xl-10 bt_bb_align_left bt_bb_vertical_align_top"
																data-width="10" data-bt-override-class="{}">
																<div class="bt_bb_column_inner_content">
																	<header
																		class="bt_bb_headline bt_bb_font_weight_900 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_extralarge bt_bb_align_inherit"
																		data-bt-override-class="{}">
																		<div
																			class="bt_bb_headline_superheadline_outside">
																			<span
																				class="bt_bb_headline_superheadline">Get
																				Solutions Fast</span>
																		</div>
																		<h2 class="bt_bb_headline_tag"><span
																				class="bt_bb_headline_content"><span><b>First
																						Class</b>
																					Consultants</span></span></h2>
																		<div class="bt_bb_headline_subheadline">Bring to
																			the table win-win survival strategies to
																			ensure proactive domination. At the end of
																			the day, going forward, a new normal that
																			has evolved from generation.</div>
																	</header>
																	<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_medium"
																		data-bt-override-class="null"></div>
																	<div class="bt_bb_button bt_bb_color_scheme_6 bt_bb_icon_position_left bt_bb_style_filled bt_bb_size_normal bt_bb_width_inline bt_bb_shape_inherit bt_bb_target_self bt_bb_align_inherit"
																		style="; --primary-color:#ffffff; --secondary-color:#dd0000;"
																		data-bt-override-class="{}"><a href="#"
																			target="_self" class="bt_bb_link"
																			title="Get a Quote Now"><span
																				class="bt_bb_button_text">Get a Quote
																				Now</span></a></div>
																</div>
															</div>
														</div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_large bt_bb_hidden_xs bt_bb_hidden_ms bt_bb_hidden_sm"
															data-bt-override-class="null"></div>
														<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_medium bt_bb_bottom_spacing_normal bt_bb_hidden_md bt_bb_hidden_lg"
															data-bt-override-class="null"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="bt_bb_section_top_section_coverage_image"><img
									src="../storage/2020/04/white-curve-top-right.png"
									alt="bt_bb_section_top_section_coverage_image" /></div>
						</section>
					</div>
				</div>

			</div>
		</div>

		<div class="btSiteFooter">

			<div class="bt_bb_wrapper">
				<section id="bt_bb_section638098d66a6aa"
					class="bt_bb_section bt_bb_color_scheme_1 bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_top_spacing_medium"
					style=";background-color:#18407c;" data-bt-override-class="null">
					<div class="bt_bb_port">
						<div class="bt_bb_cell">
							<div class="bt_bb_cell_inner">
								<div class="bt_bb_row_wrapper">
									<div class="bt_bb_row bt_bb_column_gap_10 bt_bb_hidden_xs bt_bb_hidden_ms">
										<div class="bt_bb_column col-xl-3 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="3" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<header
													class="bt_bb_headline bt_bb_font_weight_900 bt_bb_color_scheme_1 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_extrasmall bt_bb_align_inherit"
													style="; --primary-color:#ffffff; --secondary-color:#191919;"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_extrasmall&quot;,&quot;xl&quot;:&quot;extrasmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<div class="bt_bb_headline_superheadline_outside"><span
															class="bt_bb_headline_superheadline">HPIL Manpower
															Training</span></div>
													<h5 class="bt_bb_headline_tag"><span
															class="bt_bb_headline_content"><span><b>Our Mission
																</b></span></span></h5>
													<div class="bt_bb_headline_subheadline">To be the best provider of
														Engineering, Safety and Environmental services that constitute a
														complete solution to our “client” needs, thus enhancing their
														competitive edge. </div>
												</header>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:08033440310" target="_self" title="+2348033440310"
														data-ico-fontawesome5solid="&#xf879;"
														class="bt_bb_icon_holder"><span>+2348033440310</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="mailto:komodibo@hpilgroup.com " target="_self"
														title="komodibo@hpilgroup.com "
														data-ico-fontawesome5solid="&#xf0e0;"
														class="bt_bb_icon_holder"><span>komodibo@hpilgroup.com
														</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="../index.html" target="_blank"
														title="training.hpilgroup.com.ng"
														data-ico-fontawesome5solid="&#xf57d;"
														class="bt_bb_icon_holder"><span>training.hpilgroup.com.ng</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none"
													data-bt-override-class="null"></div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
											</div>
										</div>
										<div class="bt_bb_column col-xl-3 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="3" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<header
													class="bt_bb_headline bt_bb_font_weight_900 bt_bb_color_scheme_1 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_size_extrasmall bt_bb_align_inherit"
													style="; --primary-color:#ffffff; --secondary-color:#191919;"
													data-bt-override-class="{}">
													<div class="bt_bb_headline_superheadline_outside"><span
															class="bt_bb_headline_superheadline">Our locations</span>
													</div>
													<h5 class="bt_bb_headline_tag"><span
															class="bt_bb_headline_content"><span><b>Where to find
																	us?</b></span></span></h5>
												</header>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_image bt_bb_shape_square bt_bb_target_self bt_bb_align_inherit bt_bb_hover_style_simple bt_bb_content_display_always bt_bb_content_align_middle bt_bb_fill_background_color_full"
													data-bt-override-class="{&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="https://www.google.com/maps/place/Olawale+Morenikeji+Cl,+105101,+Lekki,+Nigeria/@6.4626767,3.6787911,673m/data=!3m2!1e3!4b1!4m5!3m4!1s0x103bfebe64103593:0xd44f7e169322d9f6!8m2!3d6.4626767!4d3.6809798?hl=en-US"
														target="_self"><img width="280" height="142"
															src="../storage/2020/04/img-footer-map.png"
															class="attachment-full size-full"
															alt="https://training.hpilgroup.com.ng/storage/2020/04/img-footer-map.png"
															decoding="async" loading="lazy"
															data-full_image_src="../storage/2020/04/img-footer-map.png" /></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none"
													data-bt-override-class="null"></div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
											</div>
										</div>
										<div class="bt_bb_column col-xl-3 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="3" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_medium bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:+2348033440310" target="_self"
														title="Lagos: +2348033440310"
														data-ico-fontawesome5solid="&#xf3c5;"
														class="bt_bb_icon_holder"><span>Lagos: +2348033440310</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:08033423144" target="_self"
														title="Lagos: +2348033423144"
														data-ico-fontawesome5solid="&#xf3c5;"
														class="bt_bb_icon_holder"><span>Lagos: +2348033423144</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:0+2347035196462" target="_self"
														title="Delta State: +2347035196462"
														data-ico-fontawesome5solid="&#xf3c5;"
														class="bt_bb_icon_holder"><span>Delta State:
															+2347035196462</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none"
													data-bt-override-class="null"></div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
											</div>
										</div>
										<div class="bt_bb_column col-xl-3 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="3" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<header
													class="bt_bb_headline bt_bb_font_weight_900 bt_bb_color_scheme_1 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_extrasmall bt_bb_align_inherit"
													style="; --primary-color:#ffffff; --secondary-color:#191919;"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_extrasmall&quot;,&quot;xl&quot;:&quot;extrasmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<div class="bt_bb_headline_superheadline_outside"><span
															class="bt_bb_headline_superheadline">Get in touch</span>
													</div>
													<h5 class="bt_bb_headline_tag"><span
															class="bt_bb_headline_content"><span><b>HPIL Manpower
																	Training Social links</b></span></span></h5>
													<div class="bt_bb_headline_subheadline">Taking seamless key
														performance indicators offline to maximise the long tail.</div>
												</header>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf09a;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf099;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf231;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf0e1;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none"
													data-bt-override-class="null"></div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="bt_bb_row_wrapper">
									<div
										class="bt_bb_row bt_bb_column_gap_10 bt_bb_hidden_sm bt_bb_hidden_md bt_bb_hidden_lg">
										<div class="bt_bb_column col-xl-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="12" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<header
													class="bt_bb_headline bt_bb_font_weight_900 bt_bb_color_scheme_1 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_extrasmall bt_bb_align_inherit"
													style="; --primary-color:#ffffff; --secondary-color:#191919;"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_extrasmall&quot;,&quot;xl&quot;:&quot;extrasmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<div class="bt_bb_headline_superheadline_outside"><span
															class="bt_bb_headline_superheadline">HPIL Manpower Training
														</span></div>
													<h5 class="bt_bb_headline_tag"><span
															class="bt_bb_headline_content"><span><b>About
																	Us</b></span></span></h5>
													<div class="bt_bb_headline_subheadline">HI-PREVUE INTERNATIONAL LTD
														is an indigenous company that functions<br />
														as a group of companies. The company is known by its acronym
														HPIL which<br />
														also means Hi-Prevue International Limited. </div>
												</header>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:+2348033440310" target="_self" title="+2348033440310"
														data-ico-fontawesome5solid="&#xf879;"
														class="bt_bb_icon_holder"><span>+2348033440310</span></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:+2348033423144" target="_self" title="+2348033423144"
														data-ico-fontawesome5solid="&#xf879;"
														class="bt_bb_icon_holder"><span>+2348033423144</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="mailto:komodibo@hpilgroup.com" target="_self"
														title="komodibo@hpilgroup.com"
														data-ico-fontawesome5solid="&#xf0e0;"
														class="bt_bb_icon_holder"><span>komodibo@hpilgroup.com</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="../index.html" target="_blank"
														title="training.hpilgroup.com.ng"
														data-ico-fontawesome5solid="&#xf57d;"
														class="bt_bb_icon_holder"><span>training.hpilgroup.com.ng</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none"
													data-bt-override-class="null"></div>
												<div class="bt_bb_separator bt_bb_border_style_solid bt_bb_top_spacing_medium bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
												<header
													class="bt_bb_headline bt_bb_font_weight_900 bt_bb_color_scheme_1 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_extrasmall bt_bb_align_inherit"
													style="; --primary-color:#ffffff; --secondary-color:#191919;"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_extrasmall&quot;,&quot;xl&quot;:&quot;extrasmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<div class="bt_bb_headline_superheadline_outside"><span
															class="bt_bb_headline_superheadline">Our locations</span>
													</div>
													<h5 class="bt_bb_headline_tag"><span
															class="bt_bb_headline_content"><span><b>Where to find
																	us?</b></span></span></h5>
													<div class="bt_bb_headline_subheadline">Km 5 Effurun / Sapele Road,
														Opposite Army Estate, Effurun, Delta State<br />
														Lagos Office: 06 Morinikeji Close, Lekki, Lagos<br />
													</div>
												</header>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_image bt_bb_shape_square bt_bb_target_self bt_bb_align_inherit bt_bb_hover_style_simple bt_bb_content_display_always bt_bb_content_align_middle bt_bb_fill_background_color_full"
													data-bt-override-class="{&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="https://www.google.com/maps/place/Olawale+Morenikeji+Cl,+105101,+Lekki,+Nigeria/@6.4626767,3.6787911,673m/data=!3m2!1e3!4b1!4m5!3m4!1s0x103bfebe64103593:0xd44f7e169322d9f6!8m2!3d6.4626767!4d3.6809798?hl=en-US"
														target="_self"><img width="280" height="142"
															src="../storage/2020/04/img-footer-map.png"
															class="attachment-full size-full"
															alt="https://training.hpilgroup.com.ng/storage/2020/04/img-footer-map.png"
															decoding="async" loading="lazy"
															data-full_image_src="../storage/2020/04/img-footer-map.png" /></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_6 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:08033440310," target="_self"
														title="Lagos: +2348033440310"
														data-ico-fontawesome5solid="&#xf3c5;"
														class="bt_bb_icon_holder"><span>Lagos: +2348033440310</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_6 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:08033423144" target="_self"
														title="Lagos: +2348033423144"
														data-ico-fontawesome5solid="&#xf3c5;"
														class="bt_bb_icon_holder"><span>Lagos: +2348033423144</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_extra_small"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_6 bt_bb_style_borderless bt_bb_size_xsmall bt_bb_shape_circle bt_bb_align_inherit"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_xsmall&quot;,&quot;xl&quot;:&quot;xsmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="tel:07035196462" target="_self"
														title="Delta State: +2347035196462"
														data-ico-fontawesome5solid="&#xf3c5;"
														class="bt_bb_icon_holder"><span>Delta State:
															+2347035196462</span></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none"
													data-bt-override-class="null"></div>
												<div class="bt_bb_separator bt_bb_border_style_solid bt_bb_top_spacing_medium bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
												<header
													class="bt_bb_headline bt_bb_font_weight_900 bt_bb_color_scheme_1 bt_bb_dash_top bt_bb_superheadline bt_bb_superheadline_outside bt_bb_subheadline bt_bb_size_extrasmall bt_bb_align_inherit"
													style="; --primary-color:#ffffff; --secondary-color:#191919;"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_extrasmall&quot;,&quot;xl&quot;:&quot;extrasmall&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<div class="bt_bb_headline_superheadline_outside"><span
															class="bt_bb_headline_superheadline">Get in touch</span>
													</div>
													<h5 class="bt_bb_headline_tag"><span
															class="bt_bb_headline_content"><span><b>HPIL Manpower
																	Training Social links</b></span></span></h5>
													<div class="bt_bb_headline_subheadline">Taking seamless key
														performance indicators offline to maximise the long tail.</div>
												</header>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal"
													data-bt-override-class="null"></div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf09a;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf099;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf231;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_icon bt_bb_color_scheme_8 bt_bb_style_filled bt_bb_size_small bt_bb_shape_circle bt_bb_align_inherit"
													style="min-width: 3em"
													data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_small&quot;,&quot;xl&quot;:&quot;small&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;xl&quot;:&quot;inherit&quot;}}">
													<a href="#" target="_blank" data-ico-fontawesome="&#xf0e1;"
														class="bt_bb_icon_holder"></a>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_bottom_spacing_medium"
													data-bt-override-class="null"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section id="bt_bb_section638098d66b85c"
					class="bt_bb_section bt_bb_color_scheme_2 bt_bb_layout_boxed_1200 bt_bb_vertical_align_top"
					style=";background-color:#ccb892;" data-bt-override-class="null">
					<div class="bt_bb_port">
						<div class="bt_bb_cell">
							<div class="bt_bb_cell_inner">
								<div class="bt_bb_row_wrapper">
									<div class="bt_bb_row">
										<div class="bt_bb_column col-xl-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="12" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal"
													data-bt-override-class="null"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="bt_bb_row_wrapper">
									<div class="bt_bb_row bt_bb_hidden_xs bt_bb_hidden_ms">
										<div class="bt_bb_column col-xl-4 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="4" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<div class="bt_bb_text">
													<p>Copyright by <strong>HPIL TRAINING</strong>. All rights reserved.
														Designed by<a href="https://uptechng.com/" target="_blank"
															rel="noopener"> UPTECH</a></p>
												</div>
											</div>
										</div>
										<div class="bt_bb_column col-xl-8 bt_bb_align_right bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="8" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<div
													class="bt_bb_custom_menu btBottomFooterMenu bt_bb_direction_horizontal">
													<div class="menu-footer-menu-container">
														<ul id="menu-footer-menu" class="menu">
															<li id="menu-item-2575"
																class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-2575">
																<a href="../index.html">Home</a>
															</li>
															<li id="menu-item-2577"
																class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2577">
																<a href="../about-us/index.html">About us</a>
															</li>
															<li id="menu-item-2579"
																class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2579">
																<a href="../services/index.html">Services</a>
															</li>
															<li id="menu-item-2581"
																class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2581">
																<a href="../cases/index.html">Portfolio</a>
															</li>
															<li id="menu-item-2583"
																class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2583">
																<a href="../blog/index.html">Blog</a>
															</li>
															<li id="menu-item-2584"
																class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2584">
																<a href="../shop-3/index.html">Shop</a>
															</li>
															<li id="menu-item-2527"
																class="bt_bb_back_to_top bt_bb_back_to_top_alternate_arrow menu-item menu-item-type-custom menu-item-object-custom menu-item-2527">
																<a href="#top">Back to top</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="bt_bb_row_wrapper">
									<div class="bt_bb_row bt_bb_hidden_sm bt_bb_hidden_md bt_bb_hidden_lg">
										<div class="bt_bb_column col-xl-12 bt_bb_align_center bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="12" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<div class="bt_bb_text">
													<p>Copyright by <strong>HPIL Training</strong>. All rights reserved.
														Designed By <a href="https://uptechng.com/">UPTECH</a></p>
												</div>
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal"
													data-bt-override-class="null"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="bt_bb_row_wrapper">
									<div class="bt_bb_row">
										<div class="bt_bb_column col-xl-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
											data-width="12" data-bt-override-class="{}">
											<div class="bt_bb_column_content">
												<div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_normal"
													data-bt-override-class="null"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<footer class="btLightSkin">
				<section class="gutter btSiteFooterCopyMenu">
					<div class="port">
						<div class="">
							<div class="btFooterMenu">
								<div class="bt_bb_column_content">
									<ul id="menu-hpil-training-1" class="menu">
										<li
											class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-8137">
											<a href="../index.html">Home</a>
										</li>
										<li
											class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8138">
											<a href="../about-us/index.html">About Us</a>
										</li>
										<li
											class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8140">
											<a href="#">List Of Trainings</a>
										</li>
										<li
											class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8144">
											<a href="../trainingbooking.html">Training Booking</a>
										</li>
										<li
											class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1601 current_page_item menu-item-8143">
											<a href="index.html" aria-current="page">Enquiry</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
			</footer>
		</div>

	</div>

	<script type='text/javascript' src='core/modules/8516d2654f/includes/swv/js/index.js' id='swv-js'></script>
	<script type='text/javascript' id='contact-form-7-js-extra'>
		/* <![CDATA[ */
		var wpcf7 = { "api": { "root": "https:\/\/training.hpilgroup.com.ng\/wp-json\/", "namespace": "contact-form-7\/v1" }, "cached": "1" };
/* ]]> */
	</script>
	<script type='text/javascript' src='core/modules/8516d2654f/includes/js/index.js'
		id='contact-form-7-js'></script>
	<script type='text/javascript' src='core/views/9febec6e99/framework/js/fancySelect.js'
		id='fancySelect-js'></script>
	<script type='text/javascript' id='avantage-header-js-before'>
		window.BoldThemesURI = "wp-content/themes/avantage/index.html"; window.BoldThemesAJAXURL = "../wp-admin/admin-ajax.html"; window.boldthemes_text = []; window.boldthemes_text.previous = 'previous'; window.boldthemes_text.next = 'next';
	</script>
	<script type='text/javascript' src='core/views/9febec6e99/framework/js/header.misc.js'
		id='avantage-header-js'></script>
	<script type='text/javascript' src='core/views/9febec6e99/framework/js/misc.js' id='avantage-misc-js'></script>
	<script type='text/javascript' src='core/views/9febec6e99/framework/js/framework_misc.js'
		id='boldthemes-framework-misc-js'></script>
	<script type='text/javascript' id='boldthemes-framework-misc-js-after'>
		var boldthemes_dropdown = document.querySelector(".widget_categories #cat");
		function boldthemes_onCatChange() {
			if (boldthemes_dropdown.options[boldthemes_dropdown.selectedIndex].value > 0) {
				location.href = "https://training.hpilgroup.com.ng/?cat=" + boldthemes_dropdown.options[boldthemes_dropdown.selectedIndex].value;
			}
		}
		if (boldthemes_dropdown !== null) {
			boldthemes_dropdown.onchange = boldthemes_onCatChange;
		}

	</script>
	<script type='text/javascript' src='core/modules/478e514c83/content_elements/bt_bb_section/bt_bb_elements.js'
		id='bt_bb_elements-js'></script>
	<script type='text/javascript'
		src='core/views/9febec6e99/bold-page-builder/content_elements/bt_bb_floating_element/bt_bb_floating_element.js'
		id='bt_bb_floating_element-js'></script>
	<script type='text/javascript'
		src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDfCP4-o7KxqBfbWE5VX5Qw5a_M8P-mGUU'
		id='gmaps_api-js'></script>

</body>

<!-- Mirrored from training.hpilgroup.com.ng/contact/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Nov 2022 10:29:37 GMT -->

</html>