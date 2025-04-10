<?php
/**
 * Build Elementor Element
 *
 * @package Kadence Woocommerce Elementor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Element Product Short Description
 */
class Product_Short_Description_Element extends \Elementor\Widget_Base {

	public function get_name() {
		return 'product-short-description';
	}

	public function get_title() {
		return __( 'Product Short Description', 'kadence-woocommerce-elementor' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return array( 'woocommerce-elements' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Product Short Description', 'kadence-woocommerce-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'important_note',
			array(
				'label' => __( 'Element Information', 'kadence-woocommerce-elementor' ),
				'show_label' => false,
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( 'This outputs your products short description.', 'kadence-woocommerce-elementor' ),
				'content_classes' => 'kadence-woo-ele-info',
			)
		);

		$this->add_control(
			'product_short_description_color',
			[
				'label'     => __( 'Text Color', 'kadence-woocommerce-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-product-details__short-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'      => 'product_short_description_typography',
				'label'     => __( 'Typography', 'kadence-woocommerce-elementor' ),
				'selector'  => '{{WRAPPER}} .woocommerce-product-details__short-description',
			)
		);

		$this->add_responsive_control(
			'product_short_description_align',
			[
				'label'        => __( 'Alignment', 'kadence-woocommerce-elementor' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => [
					'left'   => [
						'title' => __( 'Left', 'kadence-woocommerce-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'kadence-woocommerce-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'kadence-woocommerce-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default'      => 'left',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {

		$post_type = get_post_type();
		if ( 'product' == $post_type ) {
				woocommerce_template_single_excerpt();
	    } else if ( 'ele-product-template' == $post_type ) {
			echo '<div class="woocommerce"><div class="product">';
			echo '<div class="woocommerce-product-details__short-description">
						<p>This is the products short descrtiption</p>
						<p>Mauris eu est placerat, fringilla tellus ut, rhoncus ante. Nulla maximus ultrices ullamcorper. Aliquam dictum risus et odio pellentesque vestibulum.</p>
					</div>';
			echo '</div></div>';
	    }
	}

	protected function content_template() {}
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Product_Short_Description_Element());
