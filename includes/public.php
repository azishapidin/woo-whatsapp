<?php
require_once __DIR__ . '/main.php'; 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

$phoneNumber = esc_attr($wooWhatsAppObject->getOption('woo_wa_phone_number'));
$content = esc_attr($wooWhatsAppObject->getOption('woo_wa_content'));
$button = esc_attr($wooWhatsAppObject->getOption('woo_wa_button'));
?>
<style>
#<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?> {
	display: none;
}
</style>
<button class="<?php echo $wooWhatsAppObject->getOption('woo_wa_button_class') ?>" id="<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?>" style="<?php echo $wooWhatsAppObject->getOption('woo_wa_button_css') ?>" type="button" onclick="openWA()"><?php echo $button ?></button>
<script>
	var isMobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i);
	if (isMobile) {
		document.getElementById("<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?>").style.display = 'block';
	} else {
		<?php if ($wooWhatsAppObject->getOption('woo_wa_button_show_desktop') == 'yes') { ?>
		document.getElementById("<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?>").style.display = 'block';
		<?php } ?>
	}
	function openWA(){
		var phoneNumber = "<?php echo esc_attr($phoneNumber); ?>",
			content = "<?php echo esc_attr($wooWhatsAppObject->getContent($content, $product)) ?>";
			link = "";
		if (isMobile) {
			link = "https://wa.me/" + phoneNumber + "?text=" + content;
		} else {
			link = "https://web.whatsapp.com/send?phone=" + phoneNumber + "&text=" + content;
		}
		var n = window.open(link, "_blank");
		n ? n.focus() : alert("Please allow popups for this website")
	}
</script>