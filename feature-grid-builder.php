<?php
/*-----------------------------------------------------------------------------------*/
/*	FEATURES GRID - VISUAL BUILDER
/*-----------------------------------------------------------------------------------*/

function nt_big_border_features_grid_4_vc( $atts, $content = null ) {
    extract( shortcode_atts(array(
		'section_id'        => '',
		'css'               => '',
		'heading'           => '',
		'link'           => '',
		'description'       => '',
		'f_2_item_grid'     => '',
		'item_img'      	=> '',
		'item_delay'      	=> '',
		'item_desc'      	=> '',
		'item_mini_heading' => '',
		'item_heading'    	=> ''
    ), $atts) );

    $css_class 		= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ),  $atts );
    $id 			= ($section_id != '') ? 'id="'. esc_attr($section_id) . '"' : '';
	$f_2_item_grid 	= (array) vc_param_group_parse_atts($f_2_item_grid);

	$out = ''; // start html
	$out .= '<div '. $id .' class="template-content-style-6 section-class-scroll'. esc_attr($css_class) . '">';
		$out .= '<div class="container">';

			$out .= '<div class="row p-b text-center">';
				$out .= '<div class="col-md-8 col-md-offset-2">';
					$out .= '<h2 class="template-heading wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">'. $heading .'</h2>';
					$out .= '<p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">'. $description .'</p>';
				$out .= '</div>';
			$out .= '</div>';

			$out .= '<div class="row">';

			// start item
			foreach ( $f_2_item_grid as $f2ig ) {

				if ( isset($f2ig['link'])){
					$link = ( $link == '||' ) ? '' : $link;
					$link = vc_build_link($f2ig['link']) ;
					$a_href = $link['url'];
					$a_title = $link['title'];
					$a_target = $link['target'];

					$link_a_target 	= ($a_target != '')  ? 'target="'. esc_attr($a_target) . '" ' : '';
					$link_a_title 	= ($a_title != '')   ? ''. esc_html($a_title) . '' : '';
					$link_a_href 	= ($a_href != '')    ? 'href="'. esc_url($a_href) . '" ' : '';
				}

				$delay 		= (isset($f2ig['item_delay']) != '') ? 'data-wow-delay="'. isset($f2ig['item_delay']) .'s"' : '';
				$img_url 	= wp_get_attachment_url( $f2ig['item_img'], 'full' );
				$image 		= nt_big_border_aq_resize( $img_url, 150, 150, true, true, true );

				$out .= '<div class="features-grid-4-item col-md-4 col-sm-6 col-xs-6 col-xxs-12 wow matchheightclass" data-wow-duration="1s" '. $delay .'>';
					$out .= '<div class="link-block">';
						if ( isset($f2ig['item_img'])){ $out .= '<figure><img src="'. $image .'" alt="'. get_the_title() .'" class="img-responsive img-rounded"></figure>'; }
						if ( isset($f2ig['item_heading'])){ $out .= '<h3>'.$f2ig['item_heading'].'</h3>'; }
						if ( isset($f2ig['item_desc'])){ $out .= '<p>'.$f2ig['item_desc'].'</p>'; }
						if ( isset($f2ig['link'])){ $out .= '<p><a '. $link_a_target .' '. $link_a_href .' class="cta cta-stroke btn btn-primary btn-sm">'. $link_a_title .'</a></p>'; }
					$out .= '</div>';
				$out .= '</div>';
			}

			$out .= '</div>'; // end row

		$out .= '</div>'; // end container
	$out .= '</div>';

	return $out;

} add_shortcode('nt_big_border_features_grid_4', 'nt_big_border_features_grid_4_vc');


/*-----------------------------------------------------------------------------------*/
/*	FEATURES GRID 3
/*-----------------------------------------------------------------------------------*/


add_action( 'vc_before_init', 'nt_big_border_features_grid_4_integrateWithVC' );
function nt_big_border_features_grid_4_integrateWithVC() {
	vc_map( array(
	"name" 	 	  => esc_html__( "Features Grid 4", "nt-big-border" ),
	"base" 	 	  => "nt_big_border_features_grid_4",
	"category" 	  => esc_html__( "Big border", "nt-big-border"),
	"params"   	  => array(
		array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Section ID', 'nt-big-border' ),
            'param_name'    => 'section_id',
            "description"   => esc_html__("Add Your Section ID", "nt-big-border"),
        ),
		array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Heading', 'nt-big-border' ),
            'param_name'    => 'heading',
            "description"   => esc_html__("Add your heading", "nt-big-border")
        ),
		array(
            'type'          => 'textarea',
            'heading'       => esc_html__('Description', 'nt-big-border' ),
            'param_name'    => 'description',
            "description"   => esc_html__("Add your description", "nt-big-border")
        ),
		array(
			'type'          => 'param_group',
			'heading'       => esc_html__('List items', 'nt-big-border' ),
			'param_name'    => 'f_2_item_grid',
			'group' 	    => esc_html__('Features items', 'nt-big-border' ),
			'params' 	    => array(
				array(
					'type'          	=> 'attach_image',
					'heading'       	=> esc_html__('Item image', 'nt-big-border' ),
					'param_name'    	=> 'item_img',
					"description"   	=> esc_html__("Add/select an image", "nt-big-border"),
				),
				array(
					"type" 				=> "textfield",
					"heading" 		  	=> esc_html__("Item heading ", "nt-big-border"),
					"param_name" 	  	=> "item_heading",
					"description" 	  	=> esc_html__("Add your item heading", "nt-big-border"),
				),
				array(
					"type" 			  	=> "textarea",
					"heading" 		  	=> esc_html__("Item description ", "nt-big-border"),
					"param_name" 	  	=> "item_desc",
					"description" 	  	=> esc_html__("Add your item description", "nt-big-border"),
				),
				array(
					'type'          	=> 'vc_link',
					'heading'       	=> esc_html__('Button (Link)', 'nt-big-border' ),
					'param_name'    	=> 'link',
					'description'   	=> esc_html__('Add custom link.', 'nt-big-border' ),
				),
				array(
					"type" 			  	=> "textfield",
					"heading" 		  	=> esc_html__("Item animation delay. ", "nt-big-border"),
					"param_name" 	  	=> "item_delay",
					"description" 	  	=> esc_html__("Add your item delay number. Example : 0.1, 0.5, 1.2 and more", "nt-big-border"),
				),
			)
		),
		array(
            'type'          => 'css_editor',
            'heading'       => esc_html__('Css', 'nt-big-border' ),
            'param_name'    => 'css',
            'group'   => esc_html__('Background options', 'nt-big-border' ),
        ),
	),
	));
} class WPBakeryShortCode_nt_big_border_features_grid_4 extends WPBakeryShortCode {}



