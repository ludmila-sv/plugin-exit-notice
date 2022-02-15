<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = Exit_Notice::$options_schema;
$fields  = $options[0]['fields'];

$enable      = ( null !== get_option( 'enableExitNotice' ) ) ? get_option( 'enableExitNotice' ) : $fields[0]['default'];
$title       = get_option( 'exitNoticeTitle' ) ? get_option( 'exitNoticeTitle' ) : $fields[1]['default'];
$text        = get_option( 'exitNoticeText' ) ? get_option( 'exitNoticeText' ) : $fields[2]['default'];
$btn_cancel  = get_option( 'btnCancel' ) ? get_option( 'btnCancel' ) : $fields[3]['default'];
$btn_proceed = get_option( 'btnProceed' ) ? get_option( 'btnProceed' ) : $fields[4]['default'];

if ( $enable ) {
	?>
	<div class="exit-notice__overlay"></div>
	<div class="exit-notice__popup">
		<div class="exit-notice__popup__body">
			<div class="exit-notice__popup__close"></div>
			<div class="exit-notice__popup__content">
				<h2 class="exit-notice__popup__title"><?php echo esc_html( $title ); ?></h2>
				<div class="exit-notice__popup__txt">
				<?php echo esc_html( $text ); ?>
				</div>
			</div>
			<div class="exit-notice__popup__btns">
				<button class="btn btn-secondary" id="exit-back"><?php echo esc_html( $btn_cancel ); ?></button>
				<button class="btn btn-primary" id="exit-continue"><?php echo esc_html( $btn_proceed ); ?></button>
			</div>
		</div>
	</div>
<?php } ?>
