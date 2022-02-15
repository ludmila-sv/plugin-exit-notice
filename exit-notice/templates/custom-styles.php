<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = Exit_Notice::$options_schema;
$fields  = $options[0]['fields'];
$enable  = get_option( 'enableExitNotice' ) ? get_option( 'enableExitNotice' ) : $fields[0]['default'];

$style_options            = $options[1]['fields'];
$overlay_bg               = get_option( 'exitNoticeOverlayBg' ) ? get_option( 'exitNoticeOverlayBg' ) : $style_options[0]['default'];
$overlay_opacity          = get_option( 'exitNoticeOverlayOpacity' ) ? get_option( 'exitNoticeOverlayOpacity' ) : $style_options[1]['default'];
$body_bg                  = get_option( 'exitNoticeBodyColor' ) ? get_option( 'exitNoticeBodyColor' ) : $style_options[2]['default'];
$h2_font_size             = get_option( 'exitNoticeH2FontSize' ) ? get_option( 'exitNoticeH2FontSize' ) : $style_options[3]['default'];
$h2_aligh                 = get_option( 'exitNoticeH2Align' ) ? get_option( 'exitNoticeH2Align' ) : $style_options[4]['default'];
$h2_margin                = get_option( 'exitNoticeH2Margin' ) ? get_option( 'exitNoticeH2Margin' ) : $style_options[5]['default'];
$h2_color                 = get_option( 'exitNoticeH2TextColor' ) ? get_option( 'exitNoticeH2TextColor' ) : $style_options[6]['default'];
$text_font_size           = get_option( 'exitNoticeTextFontSize' ) ? get_option( 'exitNoticeTextFontSize' ) : $style_options[7]['default'];
$text_aligh               = get_option( 'exitNoticeTextAlign' ) ? get_option( 'exitNoticeTextAlign' ) : $style_options[8]['default'];
$text_color               = get_option( 'exitNoticeTextColor' ) ? get_option( 'exitNoticeTextColor' ) : $style_options[9]['default'];
$btn_cancel_font_size     = get_option( 'btnCancelFontSize' ) ? get_option( 'btnCancelFontSize' ) : $style_options[10]['default'];
$btn_cancel_bg            = get_option( 'btnCancelBgColor' ) ? get_option( 'btnCancelBgColor' ) : $style_options[11]['default'];
$btn_cancel_text_color    = get_option( 'btnCancelTextColor' ) ? get_option( 'btnCancelTextColor' ) : $style_options[12]['default'];
$btn_cancel_border_color  = get_option( 'btnCancelBorderColor' ) ? get_option( 'btnCancelBorderColor' ) : $style_options[13]['default'];
$btn_proceed_font_size    = get_option( 'btnProceedFontSize' ) ? get_option( 'btnProceedFontSize' ) : $style_options[14]['default'];
$btn_proceed_bg           = get_option( 'btnProceedBgColor' ) ? get_option( 'btnProceedBgColor' ) : $style_options[15]['default'];
$btn_proceed_text_color   = get_option( 'btnProceedTextColor' ) ? get_option( 'btnProceedTextColor' ) : $style_options[16]['default'];
$btn_proceed_border_color = get_option( 'btnProceedBorderColor' ) ? get_option( 'btnProceedBorderColor' ) : $style_options[17]['default'];

if ( $enable ) {
	?>
	<style>
		.exit-notice__overlay {
			background-color: <?php echo $overlay_bg; ?>;
			opacity: <?php echo $overlay_opacity; ?>;
		}
		.exit-notice__popup__body {
			background-color: <?php echo $body_bg; ?>;
		}
		.exit-notice__popup__title {
			margin-bottom: <?php echo $h2_margin; ?>px;
			font-size: <?php echo $h2_font_size; ?>px;
			text-align: <?php echo $h2_aligh; ?>;
			color: <?php echo $h2_color; ?>;
		}
		.exit-notice__popup__txt {
			font-size: <?php echo $text_font_size; ?>px;
			text-align: <?php echo $text_aligh; ?>;
			color: <?php echo $text_color; ?>;
		}
		.exit-notice__popup__btns .btn-secondary {
			font-size: <?php echo $btn_cancel_font_size; ?>px;
			color: <?php echo $btn_cancel_text_color; ?>;
			background-color: <?php echo $btn_cancel_bg; ?>;
			border-color: <?php echo $btn_cancel_border_color; ?>;
		}
		.exit-notice__popup__btns .btn-primary {
			font-size: <?php echo $btn_proceed_font_size; ?>px;
			color: <?php echo $btn_proceed_text_color; ?>;
			background-color: <?php echo $btn_proceed_bg; ?>;
			border-color: <?php echo $btn_proceed_border_color; ?>;
		}
	</style>
<?php } ?>
