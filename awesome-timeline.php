<?php 
/*
Plugin Name: Wp Awesome Timeline
Author: Nayon
Author Uri: http://www.nayonbd.com
Description:Awesome Timeline plugin allows you to showcase the most important events of your business in a chronological order.
Version:1.0
*/

class At_main_class{

	public function __construct(){
		add_action('init',array($this,'At_main_area'));
		add_action('wp_enqueue_scripts',array($this,'At_main_script_area'));
		add_shortcode('wp-timeline',array($this,'At_main_shortcode_area'));
	}

	public function At_main_area(){

		add_theme_support('title-tag');
		load_plugin_textdomain('At_timeline_textdomain', false, dirname( __FILE__).'/lang');
		register_post_type('wp-timeline',array(
			'labels'=>array(
				'name'=>'Timelines'
			),
			'public'=>true,
			'supports'=>array('title','editor'),
			'menu_icon'=>'dashicons-editor-alignleft'
	    ));
	}

	public function At_main_script_area(){
		wp_enqueue_style('timeline-maincss',PLUGINS_URL('css/style.css',__FILE__));
	}

	public function At_main_shortcode_area($attr,$content){
	ob_start();
	?>
	<div class="page">
	  <div class="page__demo">
		<div class="main-container page__container">
		  <div class="timeline">
			<?php $atimeline = new wp_Query(array(
				'post_type'=>'wp-timeline',
				'posts_per_page'=>-1
			));
				while( $atimeline->have_posts() ) : $atimeline->the_post();
			?>
			<div class="timeline__group">
			  <span class="timeline__year"><?php the_time('Y'); ?></span>
			  <div class="timeline__box">
				<div class="timeline__date">
				  <span class="timeline__day"><?php the_time('d'); ?></span>
				  <span class="timeline__month"><?php the_time('M'); ?></span>
				</div>
				<div class="timeline__post">
				  <div class="timeline__content">
					<p><?php the_content(); ?></p>
				  </div>
				</div>
			  </div>
			</div>
			<?php endwhile; ?>
		  </div>
		</div>
	  </div>
	</div>
	
	<?php
	return ob_get_clean();
}

}
new At_main_class();





