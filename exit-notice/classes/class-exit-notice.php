<?php
class Exit_Notice {

	/**
	 * Option name where all options got saved.
	 *
	 * @var string
	 */
	public static $options_group_name = 'EXITNOTICE';

	/**
	 * Schema of plugin's options.
	 *
	 * @var array[]
	 */
	private static $options_schema = array(
		array(
			'name'   => 'EXITNOTICE_main',
			'title'  => 'Exit Notice Settings',
			'fields' => array(
				array(
					'name'    => 'enableExitNotice',
					'title'   => 'Enable Exit Notice',
					'type'    => 'checkbox',
					'default' => 1,
				),
				array(
					'name'    => 'exitNoticeTitle',
					'title'   => 'Message Title',
					'type'    => 'text',
					'default' => 'Exit Notice',
				),
				array(
					'name'    => 'exitNoticeText',
					'title'   => 'Message Text',
					'type'    => 'textarea',
					'default' => 'You are about to leave for a third-party site.',
				),
				array(
					'name'    => 'btnCancel',
					'title'   => 'Button Cancel Text',
					'type'    => 'text',
					'default' => 'Cancel',
				),
				array(
					'name'    => 'btnProceed',
					'title'   => 'Button Proceed Text',
					'type'    => 'text',
					'default' => 'Proceed',
				),
				array(
					'name'        => 'exitNoticeWhitelist',
					'title'       => 'White List',
					'type'        => 'textarea',
					'default'     => '',
					'description' => 'Add domains, separate them with commas.',
				),
			),
		),
		array(
			'name'   => 'EXITNOTICE_styles',
			'title'  => 'Exit Notice Styles',
			'fields' => array(
				array(
					'name'    => 'exitNoticeOverlayBg',
					'title'   => 'Overlay Background',
					'type'    => 'color',
					'default' => 'rgba(31,52,74,0.75)',
				),
				array(
					'name'    => 'exitNoticeOverlayOpacity',
					'title'   => 'Overlay Opacity',
					'type'    => 'number',
					'default' => '1',
				),
				array(
					'name'    => 'exitNoticeBodyColor',
					'title'   => 'Body Color',
					'type'    => 'color',
					'default' => '#fff',
				),
				array(
					'name'    => 'exitNoticeH2FontSize',
					'title'   => 'Heading Font Size, px',
					'type'    => 'number',
					'default' => '30',
				),
				array(
					'name'    => 'exitNoticeH2Align',
					'title'   => 'Heading Alignment',
					'type'    => 'select',
					'default' => 'left',
					'options' => array(
						'left'   => 'Left',
						'right'  => 'Right',
						'center' => 'Center',
					),
				),
				array(
					'name'    => 'exitNoticeH2Margin',
					'title'   => 'Heading Margin-bottom, px',
					'type'    => 'number',
					'default' => '30',
				),
				array(
					'name'    => 'exitNoticeH2TextColor',
					'title'   => 'Heading Text Color',
					'type'    => 'color',
					'default' => '#000',
				),
				array(
					'name'    => 'exitNoticeTextFontSize',
					'title'   => 'Text Font Size, px',
					'type'    => 'number',
					'default' => '16',
				),
				array(
					'name'    => 'exitNoticeTextAlign',
					'title'   => 'Text Alignment',
					'type'    => 'select',
					'default' => 'left',
					'options' => array(
						'left'   => 'Left',
						'right'  => 'Right',
						'center' => 'Center',
					),
				),
				array(
					'name'    => 'exitNoticeTextColor',
					'title'   => 'Text Color',
					'type'    => 'color',
					'default' => '#000',
				),
				array(
					'name'    => 'btnCancelFontSize',
					'title'   => 'Button Cancel Font Size, px',
					'type'    => 'number',
					'default' => '14',
				),
				array(
					'name'    => 'btnCancelBgColor',
					'title'   => 'Button Cancel Background Color',
					'type'    => 'color',
					'default' => '#fff',
				),
				array(
					'name'    => 'btnCancelTextColor',
					'title'   => 'Button Cancel Text Color',
					'type'    => 'color',
					'default' => '#1a78b6',
				),
				array(
					'name'    => 'btnCancelBorderColor',
					'title'   => 'Button Cancel Border Color',
					'type'    => 'color',
					'default' => '#1a78b6',
				),
				array(
					'name'    => 'btnProceedFontSize',
					'title'   => 'Button Proceed Font Size, px',
					'type'    => 'number',
					'default' => '14',
				),
				array(
					'name'    => 'btnProceedBgColor',
					'title'   => 'Button Proceed Background Color',
					'type'    => 'color',
					'default' => '#1a78b6',
				),
				array(
					'name'    => 'btnProceedTextColor',
					'title'   => 'Button Proceed Text Color',
					'type'    => 'color',
					'default' => '#fff',
				),
				array(
					'name'    => 'btnProceedBorderColor',
					'title'   => 'Button Proceed Border Color',
					'type'    => 'color',
					'default' => '#1a78b6',
				),
			),
		),
	);

	/**
	 * Admin page slug for options page.
	 *
	 * @var string
	 */
	public static $options_page_name = 'exit-notice';

	public static function init() {

		register_activation_hook( EXITNOTICE_PLUGIN_FILE, array( __CLASS__, 'install' ) );
		register_deactivation_hook( EXITNOTICE_PLUGIN_FILE, array( __CLASS__, 'deactivate' ) );
		register_uninstall_hook( EXITNOTICE_PLUGIN_FILE, array( __CLASS__, 'uninstall' ) );

		add_action( 'admin_menu', array( __CLASS__, 'init_menu' ), 82 );

		add_action( 'init', array( __CLASS__, 'init_assets' ) );

		add_action( 'admin_init', array( __CLASS__, 'setting_fields' ), 20 );

		add_action( 'wp_footer', array( __CLASS__, 'render_popup' ) );

		add_action( 'wp_footer', array( __CLASS__, 'render_styles' ) );

	}

	public static function init_menu() {
		add_menu_page( 'Exit Notice', 'Exit Notice', 'manage_options', self::$options_page_name, array( __CLASS__, 'admin_page' ), 'dashicons-format-aside', 82 );
	}

	public static function init_assets() {
		$options = self::$options_schema;
		$fields  = $options[0]['fields'];
		$enable  = get_option( 'enableExitNotice' ) ? get_option( 'enableExitNotice' ) : $fields[0]['default'];

		function exit_notice_plugin_styles() {
			wp_register_style( 'exit-notice-style', EXITNOTICE_PLUGIN_URL . 'assets/css/styles.css', array(), EXITNOTICE_VERSION );
			wp_enqueue_style( 'exit-notice-style', EXITNOTICE_PLUGIN_URL . 'assets/css/styles.css', null, EXITNOTICE_VERSION );

			wp_register_script( 'exit-notice-scripts', EXITNOTICE_PLUGIN_URL . '/assets/js/scripts.js', array( 'jquery' ), EXITNOTICE_VERSION, true );
			wp_enqueue_script( 'exit-notice-scripts', EXITNOTICE_PLUGIN_URL . '/assets/js/scripts.js', array( 'jquery' ), EXITNOTICE_VERSION, true );

			$whitelist = get_option( 'exitNoticeWhitelist' ) ? explode( ',', get_option( 'exitNoticeWhitelist' ) ) : array();
			wp_localize_script( 'exit-notice-scripts', 'EXITNOTICE_WHITELIST', $whitelist );
		}
		function exit_notice_admin_scripts() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker-alpha', EXITNOTICE_PLUGIN_URL . '/assets/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '3.0.2', true );
			wp_enqueue_script( 'wp-color-picker-init', EXITNOTICE_PLUGIN_URL . '/assets/js/wp-color-picker-init.js', array( 'wp-color-picker-alpha' ), '1.0.0', true );
		}
		add_action( 'admin_enqueue_scripts', 'exit_notice_admin_scripts' );

		if ( $enable ) {
			add_action( 'wp_enqueue_scripts', 'exit_notice_plugin_styles' );
		}
	}

	public static function admin_page() {
		?>
		<div class="wrap">
			<h2><?php get_admin_page_title(); ?></h2>

			<form action="options.php" method="post">
			<?php
			settings_fields( self::$options_group_name );
			do_settings_sections( self::$options_page_name );
			submit_button();
			?>
			</form>
		</div>
		<?php
	}

	public static function setting_fields() {
		// we create one section and add fields to this section
		$options_sections = self::$options_schema;
		foreach ( $options_sections as $section ) {
			$section_name  = $section['name'];
			$section_title = $section['title'];
			add_settings_section( $section_name, $section_title, false, self::$options_page_name );

			$fields = $section['fields'];
			foreach ( $fields as $field ) {

				register_setting( self::$options_group_name, $field['name'] );

				add_settings_field(
					$field['name'],
					$field['title'],
					function () use ( $field ) {
						self::field_callback( $field );
					},
					self::$options_page_name,
					$section_name
				);
			}
		}
	}

	public static function field_callback( $field ) {
		$option_name = $field['name'];
		$option_type = $field['type'];
		switch ( $option_type ) {
			case 'text':
				$value = get_option( $option_name ) ? get_option( $option_name ) : $field['default'];
				echo '<input name="' . $option_name . '" type="text" value="' . $value . '"  size="50" />';
				break;
			case 'color':
				$value = get_option( $option_name ) ? get_option( $option_name ) : $field['default'];
				echo '<input name="' . $option_name . '" type="text" value="' . $value . '"  size="50" class="color-picker" data-alpha-enabled="true" data-default-color="' . $value . '" />';
				break;
			case 'number':
				$value = get_option( $option_name ) ? get_option( $option_name ) : $field['default'];
				echo '<input name="' . $option_name . '" type="number" step="1" value="' . $value . '"  size="50" />';
				break;
			case 'textarea':
				$value = get_option( $option_name ) ? get_option( $option_name ) : $field['default'];
				echo '<textarea name="' . $option_name . '"  rows="3" cols="53">' . $value . '</textarea>';
				if ( ! empty( $field['description'] ) ) {
					echo '<p class="description">' . $field['description'] . '</p>';
				}
				break;
			case 'checkbox':
				$value   = get_option( $option_name ) ? get_option( $option_name ) : $field['default'];
				$checked = ( $value ) ? ' checked' : '';
				echo '<input name="' . $option_name . '" type="checkbox" value="1"' . $checked . ' />';
				break;
			case 'select':
				$value = get_option( $option_name ) ? get_option( $option_name ) : $field['default'];
				if ( ! empty( $field['options'] ) && is_array( $field['options'] ) ) {
					echo '<select name="' . $option_name . '">';
					foreach ( $field['options'] as $key => $label ) {
						$selected = ( $value === $key ) ? ' selected' : '';
						echo '<option value="' . $key . '"' . $selected . '>' . $label . '</option>';
					}
					echo '</select>';
				}
				break;
		}
	}

	/**
	 * Complete Analog of locate_template() but for plugins.
	 * Supports overriding plugin's templates by theme or stylesheet (child theme)
	 *
	 * @param string[]   $template_names   Array of template names to find.
	 * @param bool|false $load             If we should load template or just find it.
	 * @param bool|true  $require_once     Whether to require_once or require.
	 * @param array      $args             Optional. Additional arguments passed to the template.
	 *                                     Default empty array.
	 *
	 * @return string
	 */
	public static function locate_template( $template_name, $load = false, $require_once = true, $args = array() ) {

		$located = '';
		if ( file_exists( STYLESHEETPATH . '/exit-notice/' . $template_name . '.php' ) ) {
			$located = STYLESHEETPATH . '/exit-notice/' . $template_name . '.php';
		} elseif ( file_exists( TEMPLATEPATH . '/exit-notice/' . $template_name . '.php' ) ) {
			$located = TEMPLATEPATH . '/exit-notice/' . $template_name . '.php';
		} elseif ( file_exists( EXITNOTICE_PLUGIN_DIR . 'templates/' . $template_name . '.php' ) ) {
			$located = EXITNOTICE_PLUGIN_DIR . 'templates/' . $template_name . '.php';
		}

		if ( $load && '' !== $located ) {
			load_template( $located, $require_once, $args );
		}

		return $located;
	}

	public static function render_popup() {
		require_once self::locate_template( 'exit-popup' );
	}

	public static function render_styles() {
		require_once EXITNOTICE_PLUGIN_DIR . 'templates/custom-styles.php';
	}

	/**
	 * Update permalinks settings upon install.
	 */
	public static function install() {
		self::init_assets();
		flush_rewrite_rules();
	}

	/**
	 * Cleanup permalinks rules after deactivation.
	 */
	public static function deactivate() {
		remove_menu_page( self::$options_page_name );
		delete_option( self::$options_group_name );
		flush_rewrite_rules();
	}

	/**
	 * Clean up option's data upon uninstall of plugin.
	 */
	public static function uninstall() {
		delete_option( self::$options_group_name );
	}

}
