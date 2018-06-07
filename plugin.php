<?php
/*
Plugin Name: WordPress Shell Interface
PluginURI: https://github.com/LeanSibal/wp-bash-interface
Description: Shell interface using WordPress admin
Author: Lean Sibal
Version: 1.0.0
 */

class WPShellInterface {

	public function __construct() {
		add_action('admin_menu', [ $this, 'admin_menu' ] );
		add_action('admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action('wp_ajax_terminal_command', [ $this, 'terminal_command' ] );
	}


	public function admin_menu() {
		add_menu_page( 'Terminal', 'Terminal', 'manage_options', 'admin_terminal', [ $this, 'admin_page' ], 'dashicons-arrow-right-alt2') ;

	}

	public function admin_page() {
		wp_enqueue_script( 'shell-interface' );
		ob_start();
?>
<div>
	<textarea id="terminal" style="background-color:black;width:100%;height:80vh;color:white;">> </textarea>
</div>
<?php
		echo ob_get_clean();
	}

	public function admin_enqueue_scripts( $hook ) {
		wp_register_script( 'shell-interface', plugins_url( 'js/script.js', __FILE__ ), [ 'jquery' ], '1.0.0' );
		wp_localize_script( 'shell-interface', 'ajax_url', admin_url( 'admin-ajax.php' ) );
	}

	public function terminal_command() {
		if( empty( $_POST['command'] ) ) wp_die();
		echo shell_exec( $_POST['command'] );
		wp_die();
	}
}

$wpShellInterface = new WPShellInterface();
