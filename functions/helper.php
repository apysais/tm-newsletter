<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function tnl_debug_print( $var ) {
	$arr_var = [];
	if ( tnl_debug() ) {
		$arr_var[] = $var;
		tnl_dd($arr_var);
	}
}
function tnl_excerpt_or_content($post_id, $content) {
	if ( has_excerpt( $post_id ) ) {
	    echo get_the_excerpt($post_id);
	} else {
	    echo wp_trim_words( wpautop($content) );
	}
}
function tnl_debug() {
	if ( isset($_GET['tnl-debug']) ) {
		return true;
	}
	return false;
}
function tnl_newsletter_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="'.get_the_date().'">'.get_the_date().'</time>';
	echo $time_string;
}
function tnl_newsletter_archive_title() {
	$title = tnl_verbage('newsletter_archive_title');
	if ( $title ) {
		echo $title;
	}
}

function tnl_news_archive_title() {
	$title = tnl_verbage('news_archive_title');
	if ( $title ) {
		echo $title;
	}
}

function tnl_verbage( $key, $args = [] ) {
	$defaults = array (
		'newsletter_archive_title' => __('Our Newsletters'),
		'news_archive_title' 	=> __('Community News'),
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	if ( isset($args[$key]) ) {
		return $args[$key];
	}

	return false;
}

/**
 * wrap the array to pre tag.
 *
 * @param array $arr
 *
 * @return html|array
 */
function tnl_dd( $arr = [] ) {
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}

function tnl_get_news_settings($post_id) {
	$newsletter = get_field('settings', $post_id);
	return $newsletter;
}

function tnl_get_newsletter_post($post_id) {
	$news = tnl_get_news_settings($post_id);
	$get_post = get_post($news['newsletter']);
	if ( $get_post ) {
		return $get_post;
	}
	return false;
}

function tnl_cta($post_id, $output = 'OBJ') {
	$arr_cta = [
		'url' => '',
		'classpopup' => ''
	];

	$cta = TNL_News_MetaFields::get_instance()->cta($post_id);

	if ( $cta ){
		$arr_cta = [
			'url' => $cta,
			'classpopup' => 'cta-popup'
		];

		if ( $output == 'OBJ') {
			$ret = json_decode(json_encode($arr_cta), FALSE);
		} else {
			$ret = $arr_cta;
		}
	}
	return $ret;
}

function tnl_cta_url($post_id) {
	$cta = TNL_News_MetaFields::get_instance()->cta($post_id);
	if ( $cta ) {
		?>
			<a href="<?php echo $cta;?>" class="xbutton cta-popup"><?php echo $cta;?></a>
		<?php
	}
}

function tnl_newsletter_link($post_id) {
	$newsletter_link = TNL_News_MetaFields::get_instance()->news_link($post_id);
	if ( $newsletter_link ) {
		return get_permalink($newsletter_link);
	}
	return false;
}

function tnl_featured_img($post_id) {
	$cta = TNL_News_MetaFields::get_instance()->cta($post_id);
	if ( $cta && trim($cta) !== '' ) {
		return $cta;
	} else {
		return get_permalink($post_id);
	}
}

function tnl_naked_url( $post_id, $text = 'Read Full Article' ) {
	?>
	<div class="naked-url">
		<a href="<?php echo get_permalink( $post_id );?>" target="_xblank" class="button"><?php echo $text;?></a>
	</div>
	<?php
}

function tnl_add_feature_img_video_class($post_id) {
	$class = '';
	if ( is_object_in_term( $post_id, 'category_news', 'video' ) ) {
	    $class = 'video-popup';
	}
	return $class;
}

function tnl_set_private_categories($post_id) {
	 // If this is a revision, get real post ID
	 if ( $parent_id = wp_is_post_revision( $post_id ) )
			 $post_id = $parent_id;

	 $news_cat = [];
	 if ( isset($_POST['tax_input']['category_news']) ) {
		 // unhook this function so it doesn't loop infinitely
		 remove_action( 'save_post_news', 'tnl_set_private_categories' );

		 foreach($_POST['tax_input']['category_news'] as $k => $v ) {
			 $category = get_term_by('id', $v, 'category_news');
			 if ( isset($category->term_id) ) {
				 $news_cat[$category->term_id] = [
					 'slug' => $category->slug,
					 'name' => $category->name,
				 ];
		 	}
		 }

		 $newsletter_post_id = false;
		 if ( $news_cat && !empty($news_cat) ) {
			 if ( isset($_POST['acf']['field_5e8079bc1155e']['field_5e8181aa65675'])) {
				 $newsletter_post_id = $_POST['acf']['field_5e8079bc1155e']['field_5e8181aa65675'];
			 }
			 $arr_news_post_id = [];
			 foreach($news_cat as $k_cat => $v_cat) {
				 $field_slug = str_replace('-','_', $v_cat['slug']) . '_news_post';
				 $news_post = get_post_meta($newsletter_post_id, $field_slug, true);
				 if ( $news_post ) {
					 if (!in_array($post_id, $news_post) ) {
					 	array_push($news_post, $post_id);
						update_post_meta( $newsletter_post_id, $field_slug, $news_post );
				 	 }
				 }else{
					 $field_slug = str_replace('-','_', $v_cat['slug']) . '_news_post';
		       $news_post = [$post_id];
		       update_post_meta( $newsletter_post_id, $field_slug, $news_post );
				 }
			 }
		 }//if
		 add_action( 'save_post_news', 'tnl_set_private_categories' );
	 }//if
	 //exit();
}
add_action( 'save_post_news', 'tnl_set_private_categories' );
add_action('pre_post_update', 'before_data_is_saved_function');

function before_data_is_saved_function($post_id) {
	if ( isset($_POST['post_type']) && $_POST['post_type'] == 'news') {

		$newsletter_post_id = false;

		if ( isset($_POST['acf']['field_5e8079bc1155e']['field_5e8181aa65675'])) {
			$newsletter_post_id = $_POST['acf']['field_5e8079bc1155e']['field_5e8181aa65675'];
		}//if acf newsletter id

		if ( $newsletter_post_id ) {
			$news_cat = [];
			$arr_news_cat = [];
			$remove_this = [];
			foreach($_POST['tax_input']['category_news'] as $k => $v ) {
				$category = get_term_by('id', $v, 'category_news');
				if ( isset($category->term_id) ) {
					$news_cat[$category->term_id] = [
						'slug' => $category->slug,
						'name' => $category->name,
					];
					$arr_news_cat[] = $category->term_id;
					$post_category_id[] = $v;
			 }//if isset cat term id
		 }//foreach

		 $terms = get_the_terms( $post_id, 'category_news' );

		 foreach($terms as $k => $v ){
			 if ( !in_array($v->term_id, $arr_news_cat) ) {
				 $field_slug = str_replace('-','_', $v->slug) . '_news_post';
				 $get_post = get_post_meta($newsletter_post_id, $field_slug, true);
				 if (($key = array_search($post_id, $get_post)) !== false) {
           unset($get_post[$key]);
					 tnl_dd($get_post);
           update_post_meta($newsletter_post_id, $field_slug, $get_post);
         }
			 }else{
				 //tnl_dd($arr_news_cat);
			 }
		 }
		}//if newsletter id
	}//if post type news
	//exit();
}
