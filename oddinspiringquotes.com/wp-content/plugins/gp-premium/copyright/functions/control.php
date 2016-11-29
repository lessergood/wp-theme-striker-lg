<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Generate_Copyright_Textarea_Custom_Control' ) ) :
/**
 * Class to create a custom tags control
 */
class Generate_Copyright_Textarea_Custom_Control extends WP_Customize_Control
{
	public $type = 'gp-copyright';
	public $id = '';
	
	public function enqueue() {
		wp_enqueue_script( 'gp-copyright-customizer', plugin_dir_url( __FILE__ )  . '/js/copyright-customizer.js', array( 'customize-controls' ), GENERATE_COPYRIGHT_VERSION, true );
	}
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ] = $this->get_link();
		$this->json[ 'value' ] = $this->value();
		$this->json[ 'id' ] = $this->id;
		$this->json[ 'current_year' ] = __('<code>%current_year%</code> to update year automatically.','generate-copyright');
		$this->json[ 'copyright' ] = __('<code>%copy%</code> to include the copyright symbol.','generate-copyright');
		$this->json[ 'html' ] = __('HTML is allowed.','generate-copyright');
		$this->json[ 'shortcodes' ] = __('Shortcodes are allowed.','generate-copyright');
	}
	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   10/16/2012
	 * @return  void
	 */
	public function content_template() {
		?>
		<label>
			<span class="customize-control-title">{{ data.label }}</span>
			<textarea id="{{ data.id }}" class="large-text gp-copyright-area" cols="20" rows="5" {{{ data.link }}}>{{{ data.value }}}</textarea>
			<small style="display:block;margin-bottom:5px;">{{{ data.current_year }}}</small>
			<small style="display:block;margin-bottom:5px;">{{{ data.copyright }}}</small>
			<small style="display:block;margin-bottom:5px;">{{{ data.html }}}</small>
			<small style="display:block;">{{{ data.shortcodes }}}</small>
		</label>
		<?php
	}
}
endif;