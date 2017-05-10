<?php
/**
 * Primemovers functions and definitions
 *
 * @package Primemovers
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'primemovers_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function primemovers_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Primemovers, use a find and replace
	 * to change 'primemovers' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'primemovers', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'primemovers' ),
		'process' => __( 'Process Menu', 'primemovers' ),
		'testimonies' => __( 'Testimonies Menu', 'primemovers' ),
		'about' => __( 'About Menu', 'primemovers' ),
		'basic' => __( 'Basic Menu', 'primemovers' ),
		'prime' => __( 'Primemovers Menu', 'primemovers' ),
		'facilitator' => __( 'Facilitator Menu', 'primemovers' ),
		'convener' => __( 'Convener Menu', 'primemovers' ),
		'sessions' => __( 'Sessions Menu', 'primemovers' ),
		'footer' => __( 'Footer Menu', 'primemovers' )
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'primemovers_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // primemovers_setup
add_action( 'after_setup_theme', 'primemovers_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function primemovers_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'primemovers' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'primemovers_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function primemovers_scripts() {
	wp_enqueue_style( 'primemovers-style', get_stylesheet_uri() );

	wp_enqueue_script( 'primemovers-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'primemovers-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'primemovers-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'primemovers_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

add_action( 'init', 'create_ha_tax' );
function create_ha_tax() {
	register_taxonomy(
		'area',
		'ambitions',
		array(
			'label' => __( 'Area' ),
			'rewrite' => array( 'slug' => 'area' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'month',
		'news',
		array(
			'label' => __( 'Month' ),
			'labels'=> array('add_new_item' => 'Add New Month'),
			'rewrite' => array( 'slug' => 'month' ),
			'hierarchical' => true,
		)
	);
}


function create_post_type() {
	register_post_type( 'testimony',
		array(
			'labels' => array(
				'name' => __( 'Testimonies' ),
				'singular_name' => __( 'Testimony' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	register_post_type( 'Staff',
		array(
			'labels' => array(
				'name' => __( 'Staff' ),
				'singular_name' => __( 'Staff' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	register_post_type( 'News',
		array(
			'labels' => array(
				'name' => __( 'News' ),
				'singular_name' => __( 'News Item' )
			),
		'public' => true,
		'has_archive' => true,
		'taxonomies' => array( 'month' ),
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
		)
	);
	$ambitionArgs = array(
		'label'  => 'Ambitions',
		'labels' => array(
			'singular_name' => 'Ambition'
			),
		'public' => true,
		'has_archive' => true,
		//'taxonomies' => array( 'category','area')
	);
	register_post_type( 'ambitions', $ambitionArgs );
}
add_action( 'init', 'create_post_type' );

show_admin_bar(false);
/*function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );*/
function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}

/*****Custom fields to register*****/
/**
 * Adds the custom fields to the registration form
 *
 */

function pw_rcp_add_user_fields() {

	$address   = get_user_meta( get_current_user_id(), 'rcp_address', true );
	$city      = get_user_meta( get_current_user_id(), 'rcp_city', true );
	$state     = get_user_meta( get_current_user_id(), 'rcp_state', true );
	$zip       = get_user_meta( get_current_user_id(), 'rcp_zip', true );
	$contact   = get_user_meta( get_current_user_id(), 'rcp_contact', true );
	$type      = get_user_meta( get_current_user_id(), 'rcp_type', true );
	$mobile    = get_user_meta( get_current_user_id(), 'rcp_mobile', true );
	$home      = get_user_meta( get_current_user_id(), 'rcp_home', true );
	$work      = get_user_meta( get_current_user_id(), 'rcp_work', true );
	//$ambition  = get_user_meta( get_current_user_id(), 'rcp_ambition', true );
	$privacy   = get_user_meta( get_current_user_id(), 'rcp_privacy', true );
	$gender   = get_user_meta( get_current_user_id(), 'rcp_gender', true );

	?>
	<div class="custom-fields">
		<label for="rcp_gender"><?php _e( 'Gender', 'rcp' ); ?><span class="req">*</span></label>
		<ul class="radio-buttons">
			<li>
				<input id="male" name="rcp_gender" type="radio" value="<?php echo esc_attr( $gender ); ?>male" <?php if(esc_attr( $gender ) == 'male' || empty($gender)) {echo 'checked';} ?>/><label for="male">Male</label>
			</li>
			<li>
				<input id="female" name="rcp_gender" type="radio" value="<?php echo esc_attr( $gender ); ?>female" <?php if(esc_attr( $gender ) == 'female') {echo 'checked';} ?>/><label for="female">Female</label>
			</li>
		</ul>
	</div>
	<p class="custom-fields">
		<label for="rcp_address"><?php _e( 'Address', 'rcp' ); ?><span class="req">*</span></label>
		<input name="rcp_address" id="rcp_address" type="text" value="<?php echo esc_attr( $address ); ?>"/>
	</p>
	<p class="custom-fields">
		<label for="rcp_city"><?php _e( 'City', 'rcp' ); ?><span class="req">*</span></label>
		<input name="rcp_city" id="rcp_city" type="text" value="<?php echo esc_attr( $city ); ?>"/>
	</p>
	<p class="custom-fields">
		<label for="rcp_state"><?php _e( 'State', 'rcp' ); ?><span class="req">*</span></label>
		<input name="rcp_state" id="rcp_state" type="text" value="<?php echo esc_attr( $state ); ?>"/>
	</p>
	<p class="custom-fields">
		<label for="rcp_zip"><?php _e( 'Zip', 'rcp' ); ?><span class="req">*</span></label>
		<input name="rcp_zip" id="rcp_zip" type="text" value="<?php echo esc_attr( $zip ); ?>"/>
	</p>
	<p class="custom-fields contact-number group">
		<label for="rcp_contact"><?php _e( 'Contact Number', 'rcp' ); ?><span class="req">*</span></label>
		<input name="rcp_contact" id="rcp_contact" type="text" value="<?php echo esc_attr( $contact ); ?>"/>
		<select name="rcp_type" id="rcp_type">
			<option value="type" <?php if(esc_attr( $type ) == 'type' || empty($type)) {echo 'selected';} ?>>Type:</option>
			<option value="mobile" <?php if(esc_attr( $type ) == 'mobile') {echo 'selected';} ?>>Mobile</option>
			<option value="home" <?php if(esc_attr( $type ) == 'home') {echo 'selected';} ?>>Home</option>
			<option value="work" <?php if(esc_attr( $type ) == 'work') {echo 'selected';} ?>>Work</option>
		</select>
	</p>
	<p class="custom-fields">
		<label for="rcp_privacy"><?php _e( 'Privacy', 'rcp' ); ?> <span class="req">*</span></label>
		<input name="rcp_privacy" id="rcp_privacy" type="checkbox" <?php if( esc_attr( $privacy )) {echo 'checked';} ?>/><span>I agree to keep the content of the website within the Primemovers community only</span>
	</p>

	<?php
}
add_action( 'rcp_after_password_registration_field', 'pw_rcp_add_user_fields' );
/*****Custom fields to edit profile*****/
/**
 * Adds the custom fields to the profile editor
 *
 */

function pw_rcp_add_user_fields_profile() {
	$userid = get_current_user_id();
	$address   = get_user_meta( $userid, 'rcp_address', true );
	$city      = get_user_meta( $userid, 'rcp_city', true );
	$state     = get_user_meta( $userid, 'rcp_state', true );
	$zip       = get_user_meta( $userid, 'rcp_zip', true );
	$contact   = get_user_meta( $userid, 'rcp_contact', true );
	$type      = get_user_meta( $userid, 'rcp_type', true );
	$mobile    = get_user_meta( $userid, 'rcp_mobile', true );
	$home      = get_user_meta( $userid, 'rcp_home', true );
	$work      = get_user_meta( $userid, 'rcp_work', true );
	$ambition  = get_user_meta( $userid, 'rcp_ambition', true );
	$privacy   = get_user_meta( $userid, 'rcp_privacy', true );
	$ha        = get_user_meta( $userid, 'rcp_ha', true );
	$mission   = get_user_meta( $userid, 'rcp_mission', true );
	$strength1 = get_user_meta( $userid, 'rcp_strength1', true );
	$strength2 = get_user_meta( $userid, 'rcp_strength2', true );
	$strength3 = get_user_meta( $userid, 'rcp_strength3', true );
	$strength4 = get_user_meta( $userid, 'rcp_strength4', true );
	$strength5 = get_user_meta( $userid, 'rcp_strength5', true );
	$gift1     = get_user_meta( $userid, 'rcp_gift1', true );
	$gift2     = get_user_meta( $userid, 'rcp_gift2', true );
	$zohoid	   = get_user_meta( $userid, 'rcp_zohoid', true );
	if($zohoid == NULL) {
		$userdata = get_userdata($userid);
		$firstname   = $userdata->first_name;
		$lastname   = $userdata->last_name;
		$useremail = $userdata->user_email;
		header("Content-type: application/xml");
		if(site_url() == 'http://local-prime.com') {
			$token="1813e0019dcc82d21a0b7609365ed50a";
		} else {
			$token="e63e7ff339d6f3d8d4634e651191e98b";
		}
		$search = "&criteria=(Email:".$useremail.")";
		$url = "https://crm.zoho.com/crm/private/json/Contacts/searchRecords";
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$search;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($result);
		//var_dump($json->response->result->Contacts->row->FL);
		$rows = $json->response->result->Contacts->row->FL;
		foreach($rows as $row) {
		    if ($row->val == 'CONTACTID') {
		        $zohoid = $row->content;
		    }
		}
	}

	?>

	<p class="custom-fields">
		<label for="rcp_address"><?php _e( 'Address', 'rcp' ); ?></label>
		<input name="rcp_address" id="rcp_address" type="text" value="<?php echo esc_attr( $address ); ?>"/>
	</p>
	<p class="custom-fields">
		<label for="rcp_city"><?php _e( 'City', 'rcp' ); ?></label>
		<input name="rcp_city" id="rcp_city" type="text" value="<?php echo esc_attr( $city ); ?>"/>
	</p>
	<p class="custom-fields">
		<label for="rcp_state"><?php _e( 'State', 'rcp' ); ?></label>
		<input name="rcp_state" id="rcp_state" type="text" value="<?php echo esc_attr( $state ); ?>"/>
	</p>
	<p class="custom-fields">
		<label for="rcp_zip"><?php _e( 'Zip', 'rcp' ); ?></label>
		<input name="rcp_zip" id="rcp_zip" type="text" value="<?php echo esc_attr( $zip ); ?>"/>
	</p>
	<p class="custom-fields contact-number group">
		<label for="rcp_contact"><?php _e( 'Contact Number', 'rcp' ); ?></label>
		<input name="rcp_contact" id="rcp_contact" type="text" value="<?php echo esc_attr( $contact ); ?>"/>
		<select name="rcp_type" id="rcp_type">
			<option value="type" <?php if(esc_attr( $type ) == 'type' || empty($type)) {echo 'selected';} ?>>Type:</option>
			<option value="mobile" <?php if(esc_attr( $type ) == 'mobile') {echo 'selected';} ?>>Mobile</option>
			<option value="home" <?php if(esc_attr( $type ) == 'home') {echo 'selected';} ?>>Home</option>
			<option value="work" <?php if(esc_attr( $type ) == 'work') {echo 'selected';} ?>>Work</option>
		</select>
	</p>
	<div class="form-section">
		<h2 class="form-title"><?php _e( 'Privacy Options', 'rcp' ); ?></h2>
		<p class="custom-fields">
			<label for="rcp_privacy" class="edit-subtitle"><?php _e( 'Privacy', 'rcp' ); ?> <small>(Required)</small></label>
			<input name="rcp_privacy" id="rcp_privacy" type="checkbox" <?php if( esc_attr( $privacy )) {echo 'checked';} ?>/><span>I agree to keep the content of the website within the Primemovers community only</span>
		</p>
		<p class="custom-fields">
			<label for="rcp_ambition" class="edit-subtitle"><?php _e( 'Alumni Directory', 'rcp' ); ?> <small>(Optional)</small></label>
			<input name="rcp_ambition" id="rcp_ambition" type="checkbox" <?php if( esc_attr( $ambition )) {echo 'checked';} ?> /><span>I agree for my name, email, city, state and Holy Ambition overview to be viewable on the Primemovers Alumni Directory hosted on this secure Primemovers website.</span>
		</p>
	</div>
	<div class="form-section">
		<h2 class="form-title"><?php _e( 'Program Information', 'rcp' ); ?></h2>
		<p class="subheading">This information will be filled out as you progress through the Primemovers process.</p>
		<p class="custom-fields edit-ambition">
			<label for="rcp_ha" class="edit-subtitle"><?php _e( 'My Holy Ambition <i>(What I am going to do):</i>', 'rcp' ); ?></label>
			<textarea name="rcp_ha" id="rcp_ha" type="text" rows="4"><?php echo esc_attr( $ha ); ?></textarea>
		</p>
		<p class="custom-fields edit-mission">
			<label for="rcp_mission" class="edit-subtitle"><?php _e( 'My Mission Statement <i>(Why I exist):</i>', 'rcp' ); ?></label>
			<textarea name="rcp_mission" id="rcp_mission" type="text" rows="4"><?php echo esc_attr( $mission ); ?></textarea>
		</p>
		<div class="option-list">
			<h4>My Top Five Strengths</h4>
			<ol>
				<li>
					<select id="rcp_strength1" name="rcp_strength1">
						<option <?php if(esc_attr( $strength1 ) == 'Select from List') {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $strength1 ) == 'Achiever') {echo 'selected';} ?>>Achiever</option>
						<option <?php if(esc_attr( $strength1 ) == 'Activator') {echo 'selected';} ?>>Activator</option>
						<option <?php if(esc_attr( $strength1 ) == 'Adaptability') {echo 'selected';} ?>>Adaptability</option>
						<option <?php if(esc_attr( $strength1 ) == 'Analytical') {echo 'selected';} ?>>Analytical</option>
						<option <?php if(esc_attr( $strength1 ) == 'Arranger') {echo 'selected';} ?>>Arranger</option>
						<option <?php if(esc_attr( $strength1 ) == 'Belief') {echo 'selected';} ?>>Belief</option>
						<option <?php if(esc_attr( $strength1 ) == 'Command') {echo 'selected';} ?>>Command</option>
						<option <?php if(esc_attr( $strength1 ) == 'Communication') {echo 'selected';} ?>>Communication</option>
						<option <?php if(esc_attr( $strength1 ) == 'Competition') {echo 'selected';} ?>>Competition</option>
						<option <?php if(esc_attr( $strength1 ) == 'Connectedness') {echo 'selected';} ?>>Connectedness</option>
						<option <?php if(esc_attr( $strength1 ) == 'Consistency') {echo 'selected';} ?>>Consistency</option>
						<option <?php if(esc_attr( $strength1 ) == 'Context') {echo 'selected';} ?>>Context</option>
						<option <?php if(esc_attr( $strength1 ) == 'Deliberative') {echo 'selected';} ?>>Deliberative</option>
						<option <?php if(esc_attr( $strength1 ) == 'Developer') {echo 'selected';} ?>>Developer</option>
						<option <?php if(esc_attr( $strength1 ) == 'Discipline') {echo 'selected';} ?>>Discipline</option>
						<option <?php if(esc_attr( $strength1 ) == 'Empathy') {echo 'selected';} ?>>Empathy</option>
						<option <?php if(esc_attr( $strength1 ) == 'Focus') {echo 'selected';} ?>>Focus</option>
						<option <?php if(esc_attr( $strength1 ) == 'Futuristic') {echo 'selected';} ?>>Futuristic</option>
						<option <?php if(esc_attr( $strength1 ) == 'Harmony') {echo 'selected';} ?>>Harmony</option>
						<option <?php if(esc_attr( $strength1 ) == 'Ideation') {echo 'selected';} ?>>Ideation</option>
						<option <?php if(esc_attr( $strength1 ) == 'Includer') {echo 'selected';} ?>>Includer</option>
						<option <?php if(esc_attr( $strength1 ) == 'Individualization') {echo 'selected';} ?>>Individualization</option>
						<option <?php if(esc_attr( $strength1 ) == 'Input') {echo 'selected';} ?>>Input</option>
						<option <?php if(esc_attr( $strength1 ) == 'Intellection') {echo 'selected';} ?>>Intellection</option>
						<option <?php if(esc_attr( $strength1 ) == 'Learner') {echo 'selected';} ?>>Learner</option>
						<option <?php if(esc_attr( $strength1 ) == 'Maximizer') {echo 'selected';} ?>>Maximizer</option>
						<option <?php if(esc_attr( $strength1 ) == 'Positivity') {echo 'selected';} ?>>Positivity</option>
						<option <?php if(esc_attr( $strength1 ) == 'Relator') {echo 'selected';} ?>>Relator</option>
						<option <?php if(esc_attr( $strength1 ) == 'Responsibility') {echo 'selected';} ?>>Responsibility</option>
						<option <?php if(esc_attr( $strength1 ) == 'Restorative') {echo 'selected';} ?>>Restorative</option>
						<option <?php if(esc_attr( $strength1 ) == 'Self-Assurance') {echo 'selected';} ?>>Self-Assurance</option>
						<option <?php if(esc_attr( $strength1 ) == 'Significance') {echo 'selected';} ?>>Significance</option>
						<option <?php if(esc_attr( $strength1 ) == 'Strategic') {echo 'selected';} ?>>Strategic</option>
						<option <?php if(esc_attr( $strength1 ) == 'Woo') {echo 'selected';} ?>>Woo</option>
					</select>
				</li>
				<li>
					<select id="rcp_strength2" name="rcp_strength2">
						<option <?php if(esc_attr( $strength2 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $strength2 ) == 'Achiever' ) {echo 'selected';} ?>>Achiever</option>
						<option <?php if(esc_attr( $strength2 ) == 'Activator' ) {echo 'selected';} ?>>Activator</option>
						<option <?php if(esc_attr( $strength2 ) == 'Adaptability' ) {echo 'selected';} ?>>Adaptability</option>
						<option <?php if(esc_attr( $strength2 ) == 'Analytical' ) {echo 'selected';} ?>>Analytical</option>
						<option <?php if(esc_attr( $strength2 ) == 'Arranger' ) {echo 'selected';} ?>>Arranger</option>
						<option <?php if(esc_attr( $strength2 ) == 'Belief' ) {echo 'selected';} ?>>Belief</option>
						<option <?php if(esc_attr( $strength2 ) == 'Command' ) {echo 'selected';} ?>>Command</option>
						<option <?php if(esc_attr( $strength2 ) == 'Communication' ) {echo 'selected';} ?>>Communication</option>
						<option <?php if(esc_attr( $strength2 ) == 'Competition' ) {echo 'selected';} ?>>Competition</option>
						<option <?php if(esc_attr( $strength2 ) == 'Connectedness' ) {echo 'selected';} ?>>Connectedness</option>
						<option <?php if(esc_attr( $strength2 ) == 'Consistency' ) {echo 'selected';} ?>>Consistency</option>
						<option <?php if(esc_attr( $strength2 ) == 'Context' ) {echo 'selected';} ?>>Context</option>
						<option <?php if(esc_attr( $strength2 ) == 'Deliberative' ) {echo 'selected';} ?>>Deliberative</option>
						<option <?php if(esc_attr( $strength2 ) == 'Developer' ) {echo 'selected';} ?>>Developer</option>
						<option <?php if(esc_attr( $strength2 ) == 'Discipline' ) {echo 'selected';} ?>>Discipline</option>
						<option <?php if(esc_attr( $strength2 ) == 'Empathy' ) {echo 'selected';} ?>>Empathy</option>
						<option <?php if(esc_attr( $strength2 ) == 'Focus' ) {echo 'selected';} ?>>Focus</option>
						<option <?php if(esc_attr( $strength2 ) == 'Futuristic' ) {echo 'selected';} ?>>Futuristic</option>
						<option <?php if(esc_attr( $strength2 ) == 'Harmony' ) {echo 'selected';} ?>>Harmony</option>
						<option <?php if(esc_attr( $strength2 ) == 'Ideation' ) {echo 'selected';} ?>>Ideation</option>
						<option <?php if(esc_attr( $strength2 ) == 'Includer' ) {echo 'selected';} ?>>Includer</option>
						<option <?php if(esc_attr( $strength2 ) == 'Individualization' ) {echo 'selected';} ?>>Individualization</option>
						<option <?php if(esc_attr( $strength2 ) == 'Input' ) {echo 'selected';} ?>>Input</option>
						<option <?php if(esc_attr( $strength2 ) == 'Intellection' ) {echo 'selected';} ?>>Intellection</option>
						<option <?php if(esc_attr( $strength2 ) == 'Learner' ) {echo 'selected';} ?>>Learner</option>
						<option <?php if(esc_attr( $strength2 ) == 'Maximizer' ) {echo 'selected';} ?>>Maximizer</option>
						<option <?php if(esc_attr( $strength2 ) == 'Positivity' ) {echo 'selected';} ?>>Positivity</option>
						<option <?php if(esc_attr( $strength2 ) == 'Relator' ) {echo 'selected';} ?>>Relator</option>
						<option <?php if(esc_attr( $strength2 ) == 'Responsibility' ) {echo 'selected';} ?>>Responsibility</option>
						<option <?php if(esc_attr( $strength2 ) == 'Restorative' ) {echo 'selected';} ?>>Restorative</option>
						<option <?php if(esc_attr( $strength2 ) == 'Self-Assurance' ) {echo 'selected';} ?>>Self-Assurance</option>
						<option <?php if(esc_attr( $strength2 ) == 'Significance' ) {echo 'selected';} ?>>Significance</option>
						<option <?php if(esc_attr( $strength2 ) == 'Strategic' ) {echo 'selected';} ?>>Strategic</option>
						<option <?php if(esc_attr( $strength2 ) == 'Woo' ) {echo 'selected';} ?>>Woo</option>
					</select>
				</li>
				<li>
					<select id="rcp_strength3" name="rcp_strength3">
						<option <?php if(esc_attr( $strength3 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $strength3 ) == 'Achiever' ) {echo 'selected';} ?>>Achiever</option>
						<option <?php if(esc_attr( $strength3 ) == 'Activator' ) {echo 'selected';} ?>>Activator</option>
						<option <?php if(esc_attr( $strength3 ) == 'Adaptability' ) {echo 'selected';} ?>>Adaptability</option>
						<option <?php if(esc_attr( $strength3 ) == 'Analytical' ) {echo 'selected';} ?>>Analytical</option>
						<option <?php if(esc_attr( $strength3 ) == 'Arranger' ) {echo 'selected';} ?>>Arranger</option>
						<option <?php if(esc_attr( $strength3 ) == 'Belief' ) {echo 'selected';} ?>>Belief</option>
						<option <?php if(esc_attr( $strength3 ) == 'Command' ) {echo 'selected';} ?>>Command</option>
						<option <?php if(esc_attr( $strength3 ) == 'Communication' ) {echo 'selected';} ?>>Communication</option>
						<option <?php if(esc_attr( $strength3 ) == 'Competition' ) {echo 'selected';} ?>>Competition</option>
						<option <?php if(esc_attr( $strength3 ) == 'Connectedness' ) {echo 'selected';} ?>>Connectedness</option>
						<option <?php if(esc_attr( $strength3 ) == 'Consistency' ) {echo 'selected';} ?>>Consistency</option>
						<option <?php if(esc_attr( $strength3 ) == 'Context' ) {echo 'selected';} ?>>Context</option>
						<option <?php if(esc_attr( $strength3 ) == 'Deliberative' ) {echo 'selected';} ?>>Deliberative</option>
						<option <?php if(esc_attr( $strength3 ) == 'Developer' ) {echo 'selected';} ?>>Developer</option>
						<option <?php if(esc_attr( $strength3 ) == 'Discipline' ) {echo 'selected';} ?>>Discipline</option>
						<option <?php if(esc_attr( $strength3 ) == 'Empathy' ) {echo 'selected';} ?>>Empathy</option>
						<option <?php if(esc_attr( $strength3 ) == 'Focus' ) {echo 'selected';} ?>>Focus</option>
						<option <?php if(esc_attr( $strength3 ) == 'Futuristic' ) {echo 'selected';} ?>>Futuristic</option>
						<option <?php if(esc_attr( $strength3 ) == 'Harmony' ) {echo 'selected';} ?>>Harmony</option>
						<option <?php if(esc_attr( $strength3 ) == 'Ideation' ) {echo 'selected';} ?>>Ideation</option>
						<option <?php if(esc_attr( $strength3 ) == 'Includer' ) {echo 'selected';} ?>>Includer</option>
						<option <?php if(esc_attr( $strength3 ) == 'Individualization' ) {echo 'selected';} ?>>Individualization</option>
						<option <?php if(esc_attr( $strength3 ) == 'Input' ) {echo 'selected';} ?>>Input</option>
						<option <?php if(esc_attr( $strength3 ) == 'Intellection' ) {echo 'selected';} ?>>Intellection</option>
						<option <?php if(esc_attr( $strength3 ) == 'Learner' ) {echo 'selected';} ?>>Learner</option>
						<option <?php if(esc_attr( $strength3 ) == 'Maximizer' ) {echo 'selected';} ?>>Maximizer</option>
						<option <?php if(esc_attr( $strength3 ) == 'Positivity' ) {echo 'selected';} ?>>Positivity</option>
						<option <?php if(esc_attr( $strength3 ) == 'Relator' ) {echo 'selected';} ?>>Relator</option>
						<option <?php if(esc_attr( $strength3 ) == 'Responsibility' ) {echo 'selected';} ?>>Responsibility</option>
						<option <?php if(esc_attr( $strength3 ) == 'Restorative' ) {echo 'selected';} ?>>Restorative</option>
						<option <?php if(esc_attr( $strength3 ) == 'Self-Assurance' ) {echo 'selected';} ?>>Self-Assurance</option>
						<option <?php if(esc_attr( $strength3 ) == 'Significance' ) {echo 'selected';} ?>>Significance</option>
						<option <?php if(esc_attr( $strength3 ) == 'Strategic' ) {echo 'selected';} ?>>Strategic</option>
						<option <?php if(esc_attr( $strength3 ) == 'Woo' ) {echo 'selected';} ?>>Woo</option>
					</select>
				</li>
				<li>
					<select id="rcp_strength4" name="rcp_strength4">
						<option <?php if(esc_attr( $strength4 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $strength4 ) == 'Achiever' ) {echo 'selected';} ?>>Achiever</option>
						<option <?php if(esc_attr( $strength4 ) == 'Activator' ) {echo 'selected';} ?>>Activator</option>
						<option <?php if(esc_attr( $strength4 ) == 'Adaptability' ) {echo 'selected';} ?>>Adaptability</option>
						<option <?php if(esc_attr( $strength4 ) == 'Analytical' ) {echo 'selected';} ?>>Analytical</option>
						<option <?php if(esc_attr( $strength4 ) == 'Arranger' ) {echo 'selected';} ?>>Arranger</option>
						<option <?php if(esc_attr( $strength4 ) == 'Belief' ) {echo 'selected';} ?>>Belief</option>
						<option <?php if(esc_attr( $strength4 ) == 'Command' ) {echo 'selected';} ?>>Command</option>
						<option <?php if(esc_attr( $strength4 ) == 'Communication' ) {echo 'selected';} ?>>Communication</option>
						<option <?php if(esc_attr( $strength4 ) == 'Competition' ) {echo 'selected';} ?>>Competition</option>
						<option <?php if(esc_attr( $strength4 ) == 'Connectedness' ) {echo 'selected';} ?>>Connectedness</option>
						<option <?php if(esc_attr( $strength4 ) == 'Consistency' ) {echo 'selected';} ?>>Consistency</option>
						<option <?php if(esc_attr( $strength4 ) == 'Context' ) {echo 'selected';} ?>>Context</option>
						<option <?php if(esc_attr( $strength4 ) == 'Deliberative' ) {echo 'selected';} ?>>Deliberative</option>
						<option <?php if(esc_attr( $strength4 ) == 'Developer' ) {echo 'selected';} ?>>Developer</option>
						<option <?php if(esc_attr( $strength4 ) == 'Discipline' ) {echo 'selected';} ?>>Discipline</option>
						<option <?php if(esc_attr( $strength4 ) == 'Empathy' ) {echo 'selected';} ?>>Empathy</option>
						<option <?php if(esc_attr( $strength4 ) == 'Focus' ) {echo 'selected';} ?>>Focus</option>
						<option <?php if(esc_attr( $strength4 ) == 'Futuristic' ) {echo 'selected';} ?>>Futuristic</option>
						<option <?php if(esc_attr( $strength4 ) == 'Harmony' ) {echo 'selected';} ?>>Harmony</option>
						<option <?php if(esc_attr( $strength4 ) == 'Ideation' ) {echo 'selected';} ?>>Ideation</option>
						<option <?php if(esc_attr( $strength4 ) == 'Includer' ) {echo 'selected';} ?>>Includer</option>
						<option <?php if(esc_attr( $strength4 ) == 'Individualization' ) {echo 'selected';} ?>>Individualization</option>
						<option <?php if(esc_attr( $strength4 ) == 'Input' ) {echo 'selected';} ?>>Input</option>
						<option <?php if(esc_attr( $strength4 ) == 'Intellection' ) {echo 'selected';} ?>>Intellection</option>
						<option <?php if(esc_attr( $strength4 ) == 'Learner' ) {echo 'selected';} ?>>Learner</option>
						<option <?php if(esc_attr( $strength4 ) == 'Maximizer' ) {echo 'selected';} ?>>Maximizer</option>
						<option <?php if(esc_attr( $strength4 ) == 'Positivity' ) {echo 'selected';} ?>>Positivity</option>
						<option <?php if(esc_attr( $strength4 ) == 'Relator' ) {echo 'selected';} ?>>Relator</option>
						<option <?php if(esc_attr( $strength4 ) == 'Responsibility' ) {echo 'selected';} ?>>Responsibility</option>
						<option <?php if(esc_attr( $strength4 ) == 'Restorative' ) {echo 'selected';} ?>>Restorative</option>
						<option <?php if(esc_attr( $strength4 ) == 'Self-Assurance' ) {echo 'selected';} ?>>Self-Assurance</option>
						<option <?php if(esc_attr( $strength4 ) == 'Significance' ) {echo 'selected';} ?>>Significance</option>
						<option <?php if(esc_attr( $strength4 ) == 'Strategic' ) {echo 'selected';} ?>>Strategic</option>
						<option <?php if(esc_attr( $strength4 ) == 'Woo' ) {echo 'selected';} ?>>Woo</option>
					</select>
				</li>
				<li>
					<select id="rcp_strength5" name="rcp_strength5">
						<option <?php if(esc_attr( $strength5 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $strength5 ) == 'Achiever' ) {echo 'selected';} ?>>Achiever</option>
						<option <?php if(esc_attr( $strength5 ) == 'Activator' ) {echo 'selected';} ?>>Activator</option>
						<option <?php if(esc_attr( $strength5 ) == 'Adaptability' ) {echo 'selected';} ?>>Adaptability</option>
						<option <?php if(esc_attr( $strength5 ) == 'Analytical' ) {echo 'selected';} ?>>Analytical</option>
						<option <?php if(esc_attr( $strength5 ) == 'Arranger' ) {echo 'selected';} ?>>Arranger</option>
						<option <?php if(esc_attr( $strength5 ) == 'Belief' ) {echo 'selected';} ?>>Belief</option>
						<option <?php if(esc_attr( $strength5 ) == 'Command' ) {echo 'selected';} ?>>Command</option>
						<option <?php if(esc_attr( $strength5 ) == 'Communication' ) {echo 'selected';} ?>>Communication</option>
						<option <?php if(esc_attr( $strength5 ) == 'Competition' ) {echo 'selected';} ?>>Competition</option>
						<option <?php if(esc_attr( $strength5 ) == 'Connectedness' ) {echo 'selected';} ?>>Connectedness</option>
						<option <?php if(esc_attr( $strength5 ) == 'Consistency' ) {echo 'selected';} ?>>Consistency</option>
						<option <?php if(esc_attr( $strength5 ) == 'Context' ) {echo 'selected';} ?>>Context</option>
						<option <?php if(esc_attr( $strength5 ) == 'Deliberative' ) {echo 'selected';} ?>>Deliberative</option>
						<option <?php if(esc_attr( $strength5 ) == 'Developer' ) {echo 'selected';} ?>>Developer</option>
						<option <?php if(esc_attr( $strength5 ) == 'Discipline' ) {echo 'selected';} ?>>Discipline</option>
						<option <?php if(esc_attr( $strength5 ) == 'Empathy' ) {echo 'selected';} ?>>Empathy</option>
						<option <?php if(esc_attr( $strength5 ) == 'Focus' ) {echo 'selected';} ?>>Focus</option>
						<option <?php if(esc_attr( $strength5 ) == 'Futuristic' ) {echo 'selected';} ?>>Futuristic</option>
						<option <?php if(esc_attr( $strength5 ) == 'Harmony' ) {echo 'selected';} ?>>Harmony</option>
						<option <?php if(esc_attr( $strength5 ) == 'Ideation' ) {echo 'selected';} ?>>Ideation</option>
						<option <?php if(esc_attr( $strength5 ) == 'Includer' ) {echo 'selected';} ?>>Includer</option>
						<option <?php if(esc_attr( $strength5 ) == 'Individualization' ) {echo 'selected';} ?>>Individualization</option>
						<option <?php if(esc_attr( $strength5 ) == 'Input' ) {echo 'selected';} ?>>Input</option>
						<option <?php if(esc_attr( $strength5 ) == 'Intellection' ) {echo 'selected';} ?>>Intellection</option>
						<option <?php if(esc_attr( $strength5 ) == 'Learner' ) {echo 'selected';} ?>>Learner</option>
						<option <?php if(esc_attr( $strength5 ) == 'Maximizer' ) {echo 'selected';} ?>>Maximizer</option>
						<option <?php if(esc_attr( $strength5 ) == 'Positivity' ) {echo 'selected';} ?>>Positivity</option>
						<option <?php if(esc_attr( $strength5 ) == 'Relator' ) {echo 'selected';} ?>>Relator</option>
						<option <?php if(esc_attr( $strength5 ) == 'Responsibility' ) {echo 'selected';} ?>>Responsibility</option>
						<option <?php if(esc_attr( $strength5 ) == 'Restorative' ) {echo 'selected';} ?>>Restorative</option>
						<option <?php if(esc_attr( $strength5 ) == 'Self-Assurance' ) {echo 'selected';} ?>>Self-Assurance</option>
						<option <?php if(esc_attr( $strength5 ) == 'Significance' ) {echo 'selected';} ?>>Significance</option>
						<option <?php if(esc_attr( $strength5 ) == 'Strategic' ) {echo 'selected';} ?>>Strategic</option>
						<option <?php if(esc_attr( $strength5 ) == 'Woo' ) {echo 'selected';} ?>>Woo</option>
					</select>
				</li>
			</ol>
		</div>
		<div class="option-list">
			<h4>My Primary Spiritual Gifts</h4>
			<ol>
				<li>
					<select id="rcp_gift1" name="rcp_gift1">
						<option <?php if(esc_attr( $gift1 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $gift1 ) == 'Exhortation' ) {echo 'selected';} ?>>Exhortation</option>
						<option <?php if(esc_attr( $gift1 ) == 'Giving' ) {echo 'selected';} ?>>Giving</option>
						<option <?php if(esc_attr( $gift1 ) == 'Leadership' ) {echo 'selected';} ?>>Leadership</option>
						<option <?php if(esc_attr( $gift1 ) == 'Mercy' ) {echo 'selected';} ?>>Mercy</option>
						<option <?php if(esc_attr( $gift1 ) == 'Prophecy' ) {echo 'selected';} ?>>Prophecy</option>
						<option <?php if(esc_attr( $gift1 ) == 'Service' ) {echo 'selected';} ?>>Service</option>
						<option <?php if(esc_attr( $gift1 ) == 'Teaching' ) {echo 'selected';} ?>>Teaching</option>
					</select>
				</li>
				<li>
					<select id="rcp_gift2" name="rcp_gift2">
						<option <?php if(esc_attr( $gift2 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
						<option <?php if(esc_attr( $gift2 ) == 'Exhortation' ) {echo 'selected';} ?>>Exhortation</option>
						<option <?php if(esc_attr( $gift2 ) == 'Giving' ) {echo 'selected';} ?>>Giving</option>
						<option <?php if(esc_attr( $gift2 ) == 'Leadership' ) {echo 'selected';} ?>>Leadership</option>
						<option <?php if(esc_attr( $gift2 ) == 'Mercy' ) {echo 'selected';} ?>>Mercy</option>
						<option <?php if(esc_attr( $gift2 ) == 'Prophecy' ) {echo 'selected';} ?>>Prophecy</option>
						<option <?php if(esc_attr( $gift2 ) == 'Service' ) {echo 'selected';} ?>>Service</option>
						<option <?php if(esc_attr( $gift2 ) == 'Teaching' ) {echo 'selected';} ?>>Teaching</option>
					</select>
				</li>
			</ol>
		</div>
	</div>
	<input name="rcp_zohoid" id="rcp_zohoid" type="hidden" value="<?php echo esc_attr( $zohoid ); ?>"/>
	<div class="form-section">
		<h2 class="form-title"><?php _e( 'Change Password', 'rcp' ); ?></h2>
	</div>

	<?php
}
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_fields_profile' );

/**
 * Adds the custom fields to the member edit screen
 *
 */
function pw_rcp_add_member_edit_fields( $user_id = 0 ) {
	$gender    = get_user_meta( $user_id, 'rcp_gender', true );
	$address   = get_user_meta( $user_id, 'rcp_address', true );
	$city      = get_user_meta( $user_id, 'rcp_city', true );
	$state     = get_user_meta( $user_id, 'rcp_state', true );
	$zip       = get_user_meta( $user_id, 'rcp_zip', true );
	$contact   = get_user_meta( $user_id, 'rcp_contact', true );
	$type      = get_user_meta( $user_id, 'rcp_type', true );
	$ambition  = get_user_meta( $user_id, 'rcp_ambition', true );
	$privacy   = get_user_meta( $user_id, 'rcp_privacy', true );
	$ha        = get_user_meta( $user_id, 'rcp_ha', true );
	$mission   = get_user_meta( $user_id, 'rcp_mission', true );
	$strength1 = get_user_meta( $user_id, 'rcp_strength1', true );
	$strength2 = get_user_meta( $user_id, 'rcp_strength2', true );
	$strength3 = get_user_meta( $user_id, 'rcp_strength3', true );
	$strength4 = get_user_meta( $user_id, 'rcp_strength4', true );
	$strength5 = get_user_meta( $user_id, 'rcp_strength5', true );
	$gift1     = get_user_meta( $user_id, 'rcp_gift1', true );
	$gift2     = get_user_meta( $user_id, 'rcp_gift2', true );
	$zohoid    = get_user_meta( $user_id, 'rcp_zohoid', true );
	if($zohoid == NULL) {
		$userdata = get_userdata($user_id);
		$firstname   = $userdata->first_name;
		$lastname   = $userdata->last_name;
		$useremail = $userdata->user_email;
		header("Content-type: application/xml");
		if(site_url() == 'http://local-prime.com') {
			$token="1813e0019dcc82d21a0b7609365ed50a";
		} else {
			$token="e63e7ff339d6f3d8d4634e651191e98b";
		}
		$search = "&criteria=(Email:".$useremail.")";
		$url = "https://crm.zoho.com/crm/private/json/Contacts/searchRecords";
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$search;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($result);
		//var_dump($json->response->result->Contacts->row->FL);
		$rows = $json->response->result->Contacts->row->FL;
		foreach($rows as $row) {
		    if ($row->val == 'CONTACTID') {
		        $zohoid = $row->content;
		    }
		}
	}

	?>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_zohoid"><?php _e( 'Zoho ID', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_zohoid" id="rcp_zohoid" type="text" value="<?php echo esc_attr( $zohoid ); ?>"/>
			<p class="description"><?php _e( 'The member\'s ID in Zoho. Not visible to member', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_gender"><?php _e( 'Gender', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_gender" id="rcp_gender" type="text" value="<?php echo esc_attr( $gender ); ?>"/>
			<p class="description"><?php _e( 'male or female', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_address"><?php _e( 'Address', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_address" id="rcp_address" type="text" value="<?php echo esc_attr( $address ); ?>"/>
			<p class="description"><?php _e( 'The member\'s Address', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_city"><?php _e( 'City', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_city" id="rcp_city" type="text" value="<?php echo esc_attr( $city ); ?>"/>
			<p class="description"><?php _e( 'The member\'s City', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_state"><?php _e( 'State', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_state" id="rcp_state" type="text" value="<?php echo esc_attr( $state ); ?>"/>
			<p class="description"><?php _e( 'The member\'s State', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_zip"><?php _e( 'Zip', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_zip" id="rcp_zip" type="text" value="<?php echo esc_attr( $zip ); ?>"/>
			<p class="description"><?php _e( 'The member\'s Zip', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_contact"><?php _e( 'Contact Number', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_contact" id="rcp_contact" type="text" value="<?php echo esc_attr( $contact ); ?>" />
			<p class="description"><?php _e( 'The member\'s Contact Number', 'rcp' ); ?></p>
			<select name="rcp_type" id="rcp_type">
				<option value="type" <?php if(esc_attr( $type ) == 'type' || empty($type)) {echo 'selected';} ?>>Type:</option>
				<option value="mobile" <?php if(esc_attr( $type ) == 'mobile') {echo 'selected';} ?>>Mobile</option>
				<option value="home" <?php if(esc_attr( $type ) == 'home') {echo 'selected';} ?>>Home</option>
				<option value="work" <?php if(esc_attr( $type ) == 'work') {echo 'selected';} ?>>Work</option>
			</select>
			<p class="description"><?php _e( 'The member\'s Contact Preference', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_ha"><?php _e( 'Holy Ambition', 'rcp' ); ?></label>
		</th>
		<td>
			<textarea name="rcp_ha" id="rcp_ha" type="text" rows="4"><?php echo esc_attr( $ha ); ?></textarea>
			<p class="description"><?php _e( 'The member\'s Holy Ambition', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_mission"><?php _e( 'Mission Statement', 'rcp' ); ?></label>
		</th>
		<td>
			<textarea name="rcp_mission" id="rcp_mission" type="text" rows="4"><?php echo esc_attr( $mission ); ?></textarea>
			<p class="description"><?php _e( 'The member\'s Mission Statement', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_strength1"><?php _e( 'Top 5 Strengths', 'rcp' ); ?></label>
		</th>
		<td>
			<select name="rcp_strength1" id="rcp_strength1" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Select from List') {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Achiever') {echo 'selected';} ?>>Achiever</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Activator') {echo 'selected';} ?>>Activator</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Adaptability') {echo 'selected';} ?>>Adaptability</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Analytical') {echo 'selected';} ?>>Analytical</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Arranger') {echo 'selected';} ?>>Arranger</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Belief') {echo 'selected';} ?>>Belief</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Command') {echo 'selected';} ?>>Command</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Communication') {echo 'selected';} ?>>Communication</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Competition') {echo 'selected';} ?>>Competition</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Connectedness') {echo 'selected';} ?>>Connectedness</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Consistency') {echo 'selected';} ?>>Consistency</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Context') {echo 'selected';} ?>>Context</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Deliberative') {echo 'selected';} ?>>Deliberative</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Developer') {echo 'selected';} ?>>Developer</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Discipline') {echo 'selected';} ?>>Discipline</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Empathy') {echo 'selected';} ?>>Empathy</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Focus') {echo 'selected';} ?>>Focus</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Futuristic') {echo 'selected';} ?>>Futuristic</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Harmony') {echo 'selected';} ?>>Harmony</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Ideation') {echo 'selected';} ?>>Ideation</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Includer') {echo 'selected';} ?>>Includer</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Individualization') {echo 'selected';} ?>>Individualization</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Input') {echo 'selected';} ?>>Input</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Intellection') {echo 'selected';} ?>>Intellection</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Learner') {echo 'selected';} ?>>Learner</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Maximizer') {echo 'selected';} ?>>Maximizer</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Positivity') {echo 'selected';} ?>>Positivity</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Relator') {echo 'selected';} ?>>Relator</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Responsibility') {echo 'selected';} ?>>Responsibility</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Restorative') {echo 'selected';} ?>>Restorative</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Self-Assurance') {echo 'selected';} ?>>Self-Assurance</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Significance') {echo 'selected';} ?>>Significance</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Strategic') {echo 'selected';} ?>>Strategic</option>
				<option <?php if(esc_attr( esc_attr( $strength1 ) ) == 'Woo') {echo 'selected';} ?>>Woo</option>
			</select>
			<select name="rcp_strength2" id="rcp_strength2" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( $strength2 ) == 'Select from List') {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( $strength2 ) == 'Achiever') {echo 'selected';} ?>>Achiever</option>
				<option <?php if(esc_attr( $strength2 ) == 'Activator') {echo 'selected';} ?>>Activator</option>
				<option <?php if(esc_attr( $strength2 ) == 'Adaptability') {echo 'selected';} ?>>Adaptability</option>
				<option <?php if(esc_attr( $strength2 ) == 'Analytical') {echo 'selected';} ?>>Analytical</option>
				<option <?php if(esc_attr( $strength2 ) == 'Arranger') {echo 'selected';} ?>>Arranger</option>
				<option <?php if(esc_attr( $strength2 ) == 'Belief') {echo 'selected';} ?>>Belief</option>
				<option <?php if(esc_attr( $strength2 ) == 'Command') {echo 'selected';} ?>>Command</option>
				<option <?php if(esc_attr( $strength2 ) == 'Communication') {echo 'selected';} ?>>Communication</option>
				<option <?php if(esc_attr( $strength2 ) == 'Competition') {echo 'selected';} ?>>Competition</option>
				<option <?php if(esc_attr( $strength2 ) == 'Connectedness') {echo 'selected';} ?>>Connectedness</option>
				<option <?php if(esc_attr( $strength2 ) == 'Consistency') {echo 'selected';} ?>>Consistency</option>
				<option <?php if(esc_attr( $strength2 ) == 'Context') {echo 'selected';} ?>>Context</option>
				<option <?php if(esc_attr( $strength2 ) == 'Deliberative') {echo 'selected';} ?>>Deliberative</option>
				<option <?php if(esc_attr( $strength2 ) == 'Developer') {echo 'selected';} ?>>Developer</option>
				<option <?php if(esc_attr( $strength2 ) == 'Discipline') {echo 'selected';} ?>>Discipline</option>
				<option <?php if(esc_attr( $strength2 ) == 'Empathy') {echo 'selected';} ?>>Empathy</option>
				<option <?php if(esc_attr( $strength2 ) == 'Focus') {echo 'selected';} ?>>Focus</option>
				<option <?php if(esc_attr( $strength2 ) == 'Futuristic') {echo 'selected';} ?>>Futuristic</option>
				<option <?php if(esc_attr( $strength2 ) == 'Harmony') {echo 'selected';} ?>>Harmony</option>
				<option <?php if(esc_attr( $strength2 ) == 'Ideation') {echo 'selected';} ?>>Ideation</option>
				<option <?php if(esc_attr( $strength2 ) == 'Includer') {echo 'selected';} ?>>Includer</option>
				<option <?php if(esc_attr( $strength2 ) == 'Individualization') {echo 'selected';} ?>>Individualization</option>
				<option <?php if(esc_attr( $strength2 ) == 'Input') {echo 'selected';} ?>>Input</option>
				<option <?php if(esc_attr( $strength2 ) == 'Intellection') {echo 'selected';} ?>>Intellection</option>
				<option <?php if(esc_attr( $strength2 ) == 'Learner') {echo 'selected';} ?>>Learner</option>
				<option <?php if(esc_attr( $strength2 ) == 'Maximizer') {echo 'selected';} ?>>Maximizer</option>
				<option <?php if(esc_attr( $strength2 ) == 'Positivity') {echo 'selected';} ?>>Positivity</option>
				<option <?php if(esc_attr( $strength2 ) == 'Relator') {echo 'selected';} ?>>Relator</option>
				<option <?php if(esc_attr( $strength2 ) == 'Responsibility') {echo 'selected';} ?>>Responsibility</option>
				<option <?php if(esc_attr( $strength2 ) == 'Restorative') {echo 'selected';} ?>>Restorative</option>
				<option <?php if(esc_attr( $strength2 ) == 'Self-Assurance') {echo 'selected';} ?>>Self-Assurance</option>
				<option <?php if(esc_attr( $strength2 ) == 'Significance') {echo 'selected';} ?>>Significance</option>
				<option <?php if(esc_attr( $strength2 ) == 'Strategic') {echo 'selected';} ?>>Strategic</option>
				<option <?php if(esc_attr( $strength2 ) == 'Woo') {echo 'selected';} ?>>Woo</option>
			</select>
			<select name="rcp_strength3" id="rcp_strength3" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( $strength3 ) == 'Select from List') {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( $strength3 ) == 'Achiever') {echo 'selected';} ?>>Achiever</option>
				<option <?php if(esc_attr( $strength3 ) == 'Activator') {echo 'selected';} ?>>Activator</option>
				<option <?php if(esc_attr( $strength3 ) == 'Adaptability') {echo 'selected';} ?>>Adaptability</option>
				<option <?php if(esc_attr( $strength3 ) == 'Analytical') {echo 'selected';} ?>>Analytical</option>
				<option <?php if(esc_attr( $strength3 ) == 'Arranger') {echo 'selected';} ?>>Arranger</option>
				<option <?php if(esc_attr( $strength3 ) == 'Belief') {echo 'selected';} ?>>Belief</option>
				<option <?php if(esc_attr( $strength3 ) == 'Command') {echo 'selected';} ?>>Command</option>
				<option <?php if(esc_attr( $strength3 ) == 'Communication') {echo 'selected';} ?>>Communication</option>
				<option <?php if(esc_attr( $strength3 ) == 'Competition') {echo 'selected';} ?>>Competition</option>
				<option <?php if(esc_attr( $strength3 ) == 'Connectedness') {echo 'selected';} ?>>Connectedness</option>
				<option <?php if(esc_attr( $strength3 ) == 'Consistency') {echo 'selected';} ?>>Consistency</option>
				<option <?php if(esc_attr( $strength3 ) == 'Context') {echo 'selected';} ?>>Context</option>
				<option <?php if(esc_attr( $strength3 ) == 'Deliberative') {echo 'selected';} ?>>Deliberative</option>
				<option <?php if(esc_attr( $strength3 ) == 'Developer') {echo 'selected';} ?>>Developer</option>
				<option <?php if(esc_attr( $strength3 ) == 'Discipline') {echo 'selected';} ?>>Discipline</option>
				<option <?php if(esc_attr( $strength3 ) == 'Empathy') {echo 'selected';} ?>>Empathy</option>
				<option <?php if(esc_attr( $strength3 ) == 'Focus') {echo 'selected';} ?>>Focus</option>
				<option <?php if(esc_attr( $strength3 ) == 'Futuristic') {echo 'selected';} ?>>Futuristic</option>
				<option <?php if(esc_attr( $strength3 ) == 'Harmony') {echo 'selected';} ?>>Harmony</option>
				<option <?php if(esc_attr( $strength3 ) == 'Ideation') {echo 'selected';} ?>>Ideation</option>
				<option <?php if(esc_attr( $strength3 ) == 'Includer') {echo 'selected';} ?>>Includer</option>
				<option <?php if(esc_attr( $strength3 ) == 'Individualization') {echo 'selected';} ?>>Individualization</option>
				<option <?php if(esc_attr( $strength3 ) == 'Input') {echo 'selected';} ?>>Input</option>
				<option <?php if(esc_attr( $strength3 ) == 'Intellection') {echo 'selected';} ?>>Intellection</option>
				<option <?php if(esc_attr( $strength3 ) == 'Learner') {echo 'selected';} ?>>Learner</option>
				<option <?php if(esc_attr( $strength3 ) == 'Maximizer') {echo 'selected';} ?>>Maximizer</option>
				<option <?php if(esc_attr( $strength3 ) == 'Positivity') {echo 'selected';} ?>>Positivity</option>
				<option <?php if(esc_attr( $strength3 ) == 'Relator') {echo 'selected';} ?>>Relator</option>
				<option <?php if(esc_attr( $strength3 ) == 'Responsibility') {echo 'selected';} ?>>Responsibility</option>
				<option <?php if(esc_attr( $strength3 ) == 'Restorative') {echo 'selected';} ?>>Restorative</option>
				<option <?php if(esc_attr( $strength3 ) == 'Self-Assurance') {echo 'selected';} ?>>Self-Assurance</option>
				<option <?php if(esc_attr( $strength3 ) == 'Significance') {echo 'selected';} ?>>Significance</option>
				<option <?php if(esc_attr( $strength3 ) == 'Strategic') {echo 'selected';} ?>>Strategic</option>
				<option <?php if(esc_attr( $strength3 ) == 'Woo') {echo 'selected';} ?>>Woo</option>
			</select>
			<select name="rcp_strength4" id="rcp_strength4" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( $strength4 ) == 'Select from List') {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( $strength4 ) == 'Achiever') {echo 'selected';} ?>>Achiever</option>
				<option <?php if(esc_attr( $strength4 ) == 'Activator') {echo 'selected';} ?>>Activator</option>
				<option <?php if(esc_attr( $strength4 ) == 'Adaptability') {echo 'selected';} ?>>Adaptability</option>
				<option <?php if(esc_attr( $strength4 ) == 'Analytical') {echo 'selected';} ?>>Analytical</option>
				<option <?php if(esc_attr( $strength4 ) == 'Arranger') {echo 'selected';} ?>>Arranger</option>
				<option <?php if(esc_attr( $strength4 ) == 'Belief') {echo 'selected';} ?>>Belief</option>
				<option <?php if(esc_attr( $strength4 ) == 'Command') {echo 'selected';} ?>>Command</option>
				<option <?php if(esc_attr( $strength4 ) == 'Communication') {echo 'selected';} ?>>Communication</option>
				<option <?php if(esc_attr( $strength4 ) == 'Competition') {echo 'selected';} ?>>Competition</option>
				<option <?php if(esc_attr( $strength4 ) == 'Connectedness') {echo 'selected';} ?>>Connectedness</option>
				<option <?php if(esc_attr( $strength4 ) == 'Consistency') {echo 'selected';} ?>>Consistency</option>
				<option <?php if(esc_attr( $strength4 ) == 'Context') {echo 'selected';} ?>>Context</option>
				<option <?php if(esc_attr( $strength4 ) == 'Deliberative') {echo 'selected';} ?>>Deliberative</option>
				<option <?php if(esc_attr( $strength4 ) == 'Developer') {echo 'selected';} ?>>Developer</option>
				<option <?php if(esc_attr( $strength4 ) == 'Discipline') {echo 'selected';} ?>>Discipline</option>
				<option <?php if(esc_attr( $strength4 ) == 'Empathy') {echo 'selected';} ?>>Empathy</option>
				<option <?php if(esc_attr( $strength4 ) == 'Focus') {echo 'selected';} ?>>Focus</option>
				<option <?php if(esc_attr( $strength4 ) == 'Futuristic') {echo 'selected';} ?>>Futuristic</option>
				<option <?php if(esc_attr( $strength4 ) == 'Harmony') {echo 'selected';} ?>>Harmony</option>
				<option <?php if(esc_attr( $strength4 ) == 'Ideation') {echo 'selected';} ?>>Ideation</option>
				<option <?php if(esc_attr( $strength4 ) == 'Includer') {echo 'selected';} ?>>Includer</option>
				<option <?php if(esc_attr( $strength4 ) == 'Individualization') {echo 'selected';} ?>>Individualization</option>
				<option <?php if(esc_attr( $strength4 ) == 'Input') {echo 'selected';} ?>>Input</option>
				<option <?php if(esc_attr( $strength4 ) == 'Intellection') {echo 'selected';} ?>>Intellection</option>
				<option <?php if(esc_attr( $strength4 ) == 'Learner') {echo 'selected';} ?>>Learner</option>
				<option <?php if(esc_attr( $strength4 ) == 'Maximizer') {echo 'selected';} ?>>Maximizer</option>
				<option <?php if(esc_attr( $strength4 ) == 'Positivity') {echo 'selected';} ?>>Positivity</option>
				<option <?php if(esc_attr( $strength4 ) == 'Relator') {echo 'selected';} ?>>Relator</option>
				<option <?php if(esc_attr( $strength4 ) == 'Responsibility') {echo 'selected';} ?>>Responsibility</option>
				<option <?php if(esc_attr( $strength4 ) == 'Restorative') {echo 'selected';} ?>>Restorative</option>
				<option <?php if(esc_attr( $strength4 ) == 'Self-Assurance') {echo 'selected';} ?>>Self-Assurance</option>
				<option <?php if(esc_attr( $strength4 ) == 'Significance') {echo 'selected';} ?>>Significance</option>
				<option <?php if(esc_attr( $strength4 ) == 'Strategic') {echo 'selected';} ?>>Strategic</option>
				<option <?php if(esc_attr( $strength4 ) == 'Woo') {echo 'selected';} ?>>Woo</option>
			</select>
			<select name="rcp_strength5" id="rcp_strength5" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( $strength5 ) == 'Select from List') {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( $strength5 ) == 'Achiever') {echo 'selected';} ?>>Achiever</option>
				<option <?php if(esc_attr( $strength5 ) == 'Activator') {echo 'selected';} ?>>Activator</option>
				<option <?php if(esc_attr( $strength5 ) == 'Adaptability') {echo 'selected';} ?>>Adaptability</option>
				<option <?php if(esc_attr( $strength5 ) == 'Analytical') {echo 'selected';} ?>>Analytical</option>
				<option <?php if(esc_attr( $strength5 ) == 'Arranger') {echo 'selected';} ?>>Arranger</option>
				<option <?php if(esc_attr( $strength5 ) == 'Belief') {echo 'selected';} ?>>Belief</option>
				<option <?php if(esc_attr( $strength5 ) == 'Command') {echo 'selected';} ?>>Command</option>
				<option <?php if(esc_attr( $strength5 ) == 'Communication') {echo 'selected';} ?>>Communication</option>
				<option <?php if(esc_attr( $strength5 ) == 'Competition') {echo 'selected';} ?>>Competition</option>
				<option <?php if(esc_attr( $strength5 ) == 'Connectedness') {echo 'selected';} ?>>Connectedness</option>
				<option <?php if(esc_attr( $strength5 ) == 'Consistency') {echo 'selected';} ?>>Consistency</option>
				<option <?php if(esc_attr( $strength5 ) == 'Context') {echo 'selected';} ?>>Context</option>
				<option <?php if(esc_attr( $strength5 ) == 'Deliberative') {echo 'selected';} ?>>Deliberative</option>
				<option <?php if(esc_attr( $strength5 ) == 'Developer') {echo 'selected';} ?>>Developer</option>
				<option <?php if(esc_attr( $strength5 ) == 'Discipline') {echo 'selected';} ?>>Discipline</option>
				<option <?php if(esc_attr( $strength5 ) == 'Empathy') {echo 'selected';} ?>>Empathy</option>
				<option <?php if(esc_attr( $strength5 ) == 'Focus') {echo 'selected';} ?>>Focus</option>
				<option <?php if(esc_attr( $strength5 ) == 'Futuristic') {echo 'selected';} ?>>Futuristic</option>
				<option <?php if(esc_attr( $strength5 ) == 'Harmony') {echo 'selected';} ?>>Harmony</option>
				<option <?php if(esc_attr( $strength5 ) == 'Ideation') {echo 'selected';} ?>>Ideation</option>
				<option <?php if(esc_attr( $strength5 ) == 'Includer') {echo 'selected';} ?>>Includer</option>
				<option <?php if(esc_attr( $strength5 ) == 'Individualization') {echo 'selected';} ?>>Individualization</option>
				<option <?php if(esc_attr( $strength5 ) == 'Input') {echo 'selected';} ?>>Input</option>
				<option <?php if(esc_attr( $strength5 ) == 'Intellection') {echo 'selected';} ?>>Intellection</option>
				<option <?php if(esc_attr( $strength5 ) == 'Learner') {echo 'selected';} ?>>Learner</option>
				<option <?php if(esc_attr( $strength5 ) == 'Maximizer') {echo 'selected';} ?>>Maximizer</option>
				<option <?php if(esc_attr( $strength5 ) == 'Positivity') {echo 'selected';} ?>>Positivity</option>
				<option <?php if(esc_attr( $strength5 ) == 'Relator') {echo 'selected';} ?>>Relator</option>
				<option <?php if(esc_attr( $strength5 ) == 'Responsibility') {echo 'selected';} ?>>Responsibility</option>
				<option <?php if(esc_attr( $strength5 ) == 'Restorative') {echo 'selected';} ?>>Restorative</option>
				<option <?php if(esc_attr( $strength5 ) == 'Self-Assurance') {echo 'selected';} ?>>Self-Assurance</option>
				<option <?php if(esc_attr( $strength5 ) == 'Significance') {echo 'selected';} ?>>Significance</option>
				<option <?php if(esc_attr( $strength5 ) == 'Strategic') {echo 'selected';} ?>>Strategic</option>
				<option <?php if(esc_attr( $strength5 ) == 'Woo') {echo 'selected';} ?>>Woo</option>
			</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_gift1"><?php _e( 'Primary Gifts', 'rcp' ); ?></label>
		</th>
		<td>
			<select id="rcp_gift1" name="rcp_gift1" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( $gift1 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( $gift1 ) == 'Exhortation' ) {echo 'selected';} ?>>Exhortation</option>
				<option <?php if(esc_attr( $gift1 ) == 'Giving' ) {echo 'selected';} ?>>Giving</option>
				<option <?php if(esc_attr( $gift1 ) == 'Leadership' ) {echo 'selected';} ?>>Leadership</option>
				<option <?php if(esc_attr( $gift1 ) == 'Mercy' ) {echo 'selected';} ?>>Mercy</option>
				<option <?php if(esc_attr( $gift1 ) == 'Prophecy' ) {echo 'selected';} ?>>Prophecy</option>
				<option <?php if(esc_attr( $gift1 ) == 'Service' ) {echo 'selected';} ?>>Service</option>
				<option <?php if(esc_attr( $gift1 ) == 'Teaching' ) {echo 'selected';} ?>>Teaching</option>
			</select>
			<select id="rcp_gift2" name="rcp_gift2" style="display: block; margin-bottom: 0.5em;">
				<option <?php if(esc_attr( $gift2 ) == 'Select from List' ) {echo 'selected';} ?>>Select from List</option>
				<option <?php if(esc_attr( $gift2 ) == 'Exhortation' ) {echo 'selected';} ?>>Exhortation</option>
				<option <?php if(esc_attr( $gift2 ) == 'Giving' ) {echo 'selected';} ?>>Giving</option>
				<option <?php if(esc_attr( $gift2 ) == 'Leadership' ) {echo 'selected';} ?>>Leadership</option>
				<option <?php if(esc_attr( $gift2 ) == 'Mercy' ) {echo 'selected';} ?>>Mercy</option>
				<option <?php if(esc_attr( $gift2 ) == 'Prophecy' ) {echo 'selected';} ?>>Prophecy</option>
				<option <?php if(esc_attr( $gift2 ) == 'Service' ) {echo 'selected';} ?>>Service</option>
				<option <?php if(esc_attr( $gift2 ) == 'Teaching' ) {echo 'selected';} ?>>Teaching</option>
			</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_ambition"><?php _e( 'Ambition', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_ambition" id="rcp_ambition" type="checkbox" <?php if( esc_attr( $ambition ) == 1) {echo 'checked';} ?>/>
			<p class="description"><?php _e( 'The member\'s Holy Ambition Preference', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_privacy"><?php _e( 'Privacy', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_privacy" id="rcp_privacy" type="checkbox" <?php if( esc_attr( $privacy )) {echo 'checked';} ?>/>
			<p class="description"><?php _e( 'The member\'s privacy', 'rcp' ); ?></p>
		</td>
	</tr>

	<?php
}
add_action( 'rcp_edit_member_after', 'pw_rcp_add_member_edit_fields' );

/**
 * Determines if there are problems with the registration data submitted
 *
 */
function pw_rcp_validate_user_fields_on_register( $posted ) {
	if ( rcp_get_subscription_id() ) {
	   return;
	}
	if( empty( $posted['rcp_gender'] ) ) {
		rcp_errors()->add( 'invalid_gender', __( 'Please indicate your gender', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_address'] ) ) {
		rcp_errors()->add( 'invalid_address', __( 'Please enter your street address', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_city'] ) ) {
		rcp_errors()->add( 'invalid_city', __( 'Please enter your city', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_state'] ) ) {
		rcp_errors()->add( 'invalid_state', __( 'Please enter your state', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_zip'] ) ) {
		rcp_errors()->add( 'invalid_zip', __( 'Please enter your zip code', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_contact'] ) ) {
		rcp_errors()->add( 'invalid_contact', __( 'Please enter a contact number', 'rcp' ), 'register' );
	}
	if( ! isset( $posted['rcp_privacy'] ) ) {
		rcp_errors()->add( 'invalid_location', __( 'Please agree to our privacy policy', 'rcp' ), 'register' );
	}

}
add_action( 'rcp_form_errors', 'pw_rcp_validate_user_fields_on_register', 10 );

/**
 * Stores the information submitted during registration
 *
 */
function pw_rcp_save_user_fields_on_register( $posted, $user_id ) {
	if( ! empty( $posted['rcp_user_first'] ) ) {
		$regfirstxml = '<FL val="First Name">'.$posted['rcp_user_first'].'</FL>';
	}
	if( ! empty( $posted['rcp_user_last'] ) ) {
		$reglastxml = '<FL val="Last Name">'.$posted['rcp_user_last'].'</FL>';
	}
	if( ! empty( $posted['rcp_user_email'] ) ) {
		$regemailxml = '<FL val="Email">'.$posted['rcp_user_email'].'</FL>';
		$useremail = $posted['rcp_user_email'];
		header("Content-type: application/xml");
		if(site_url() == 'http://local-prime.com') {
			$token="1813e0019dcc82d21a0b7609365ed50a";
		} else {
			$token="e63e7ff339d6f3d8d4634e651191e98b";
		}
		$search = "&criteria=(Email:".$useremail.")";
		$url = "https://crm.zoho.com/crm/private/json/Contacts/searchRecords";
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$search;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($result);
		//var_dump($json->response->result->Contacts->row->FL);
		$rows = $json->response->result->Contacts->row->FL;
		foreach($rows as $row) {
		    if ($row->val == 'CONTACTID') {
		        $regzohoid = $row->content;
		    }
		}
		if($regzohoid) {
			update_user_meta( $user_id, 'rcp_zohoid', sanitize_text_field( $zohoid ) );
		}
	}
	if( ! empty( $posted['rcp_gender'] ) ) {
		update_user_meta( $user_id, 'rcp_gender', sanitize_text_field( $posted['rcp_gender'] ) );
	}
	if( ! empty( $posted['rcp_address'] ) ) {
		update_user_meta( $user_id, 'rcp_address', sanitize_text_field( $posted['rcp_address'] ) );
		$regaddressxml = '<FL val="Mailing Street">'.$posted['rcp_address'].'</FL>';
	}
	if( ! empty( $posted['rcp_city'] ) ) {
		update_user_meta( $user_id, 'rcp_city', sanitize_text_field( $posted['rcp_city'] ) );
		$regcityxml = '<FL val="Mailing City">'.$posted['rcp_city'].'</FL>';
	}
	if( ! empty( $posted['rcp_state'] ) ) {
		update_user_meta( $user_id, 'rcp_state', sanitize_text_field( $posted['rcp_state'] ) );
		$regstatexml = '<FL val="Mailing State">'.$posted['rcp_state'].'</FL>';
	}
	if( ! empty( $posted['rcp_zip'] ) ) {
		update_user_meta( $user_id, 'rcp_zip', sanitize_text_field( $posted['rcp_zip'] ) );
		$regzipxml = '<FL val="Mailing Zip">'.$posted['rcp_zip'].'</FL>';
	}
	if( ! empty( $posted['rcp_contact'] ) ) {
		update_user_meta( $user_id, 'rcp_contact', sanitize_text_field( $posted['rcp_contact']));
		if($posted['rcp_type'] == 'mobile') {
			$phonetype = 'Mobile';
		} elseif($posted['rcp_type'] == 'home') {
			$phonetype = 'Home Phone';
		} else {
			$phonetype = 'Phone';
		}
		$regcontactxml = '<FL val="'.$phonetype.'">'.$posted['rcp_contact'].'</FL>';
	}
	if( ! empty( $posted['rcp_type'] ) ) {
		update_user_meta( $user_id, 'rcp_type', sanitize_text_field( $posted['rcp_type']));
	}

	if( isset( $posted['rcp_ambition'] ) ) {
		update_user_meta( $user_id, 'rcp_ambition', 1 );
	} else {
		update_user_meta( $user_id, 'rcp_ambition', 0 );
	}

	if( isset( $posted['rcp_privacy'] ) ) {
		update_user_meta( $user_id, 'rcp_privacy', 1 );
	}

	header("Content-type: application/xml");
	if(site_url() == 'http://local-prime.com') {
		$token="1813e0019dcc82d21a0b7609365ed50a";
	} else {
		$token="e63e7ff339d6f3d8d4634e651191e98b";
	}
	//Build XMl
	$addedxml = '<FL val="Description">Added/Edited by website integration</FL>';
	$xml = '&xmlData=<Contacts><row no="1">'.$regfirstxml.$reglastxml.$regemailxml.$regaddressxml.$regcityxml.$regstatexml.$regzipxml.$regcontactxml.$addedxml.'</row></Contacts>';
	if($regzohoid) {
		$url = "https://crm.zoho.com/crm/private/xml/Contacts/updateRecords";
		$id = "&id=".$regzohoid;
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$id.$xml;
	} else {
		$url = "https://crm.zoho.com/crm/private/xml/Contacts/insertRecords";
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$xml;
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	$result = curl_exec($ch);
	curl_close($ch);
	$file = 'results.txt';
	// Open the file to get existing content
	$current = file_get_contents($file);
	// Append to the file
	$current .= $param."\n".$result."\n";
	// Write the contents back to the file
	file_put_contents($file, $current);
}
add_action( 'rcp_form_processing', 'pw_rcp_save_user_fields_on_register', 10, 2 );

/**
 * Stores the information submitted profile update
 *
 */
function pw_rcp_save_user_fields_on_profile_save( $user_id ) {
	/*Begin RCP fields*/
	$user_info = get_userdata($user_id);
	if( ! empty( $_POST['rcp_first_name'] ) ) {
		$firstxml = '<FL val="First Name">'.$_POST['rcp_first_name'].'</FL>';
		$first_name = $_POST['rcp_first_name'];
	} else {
		$first_name = $user_info->first_name;
	}
	if( ! empty( $_POST['rcp_last_name'] ) ) {
		$lastxml = '<FL val="Last Name">'.$_POST['rcp_last_name'].'</FL>';
	} else {
		$last_name = $user_info->last_name;
	}
	if( ! empty( $_POST['rcp_email'] ) ) {
		$emailxml = '<FL val="Email">'.$_POST['rcp_email'].'</FL>';
	}
	if( ! empty( $_POST['rcp_gender'] ) ) {
		update_user_meta( $user_id, 'rcp_gender', sanitize_text_field( $_POST['rcp_gender'] ) );
	}
	if( ! empty( $_POST['rcp_address'] ) ) {
		$oldaddress = get_user_meta( $user_id, 'rcp_address', true );
		$newaddress = update_user_meta( $user_id, 'rcp_address', sanitize_text_field( $_POST['rcp_address'] ) );
		$addressxml = '<FL val="Mailing Street">'.$_POST['rcp_address'].'</FL>';
		if($newaddress) {
			if ( function_exists("SimpleLogger") ) {
				SimpleLogger()->notice(
					"{first} {last} edited their address from {old} to {new}",
					array(
						"first" => $first_name,
						"last" => $last_name,
						"old" => $oldaddress,
						"new" => $_POST['rcp_address'],
					)
				);
			}
		}
	}
	if( ! empty( $_POST['rcp_city'] ) ) {
		$oldcity = get_user_meta( $user_id, 'rcp_city', true );
		$newcity = update_user_meta( $user_id, 'rcp_city', sanitize_text_field( $_POST['rcp_city'] ) );
		$cityxml = '<FL val="Mailing City">'.$_POST['rcp_city'].'</FL>';
		if($newcity) {
			if ( function_exists("SimpleLogger") ) {
				SimpleLogger()->notice(
					"{first} {last} edited their city from {old} to {new}",
					array(
						"first" => $first_name,
						"last" => $last_name,
						"old" => $oldcity,
						"new" => $_POST['rcp_city'],
					)
				);
			}
		}
	}
	if( ! empty( $_POST['rcp_state'] ) ) {
		$oldstate = get_user_meta( $user_id, 'rcp_state', true );
		$newstate = update_user_meta( $user_id, 'rcp_state', sanitize_text_field( $_POST['rcp_state'] ) );
		$statexml = '<FL val="Mailing State">'.$_POST['rcp_state'].'</FL>';
		if($newstate) {
			if ( function_exists("SimpleLogger") ) {
				SimpleLogger()->notice(
					"{first} {last} edited their state from {old} to {new}",
					array(
						"first" => $first_name,
						"last" => $last_name,
						"old" => $oldstate,
						"new" => $_POST['rcp_state'],
					)
				);
			}
		}
	}
	if( ! empty( $_POST['rcp_zip'] ) ) {
		$oldzip = get_user_meta( $user_id, 'rcp_zip', true );
		$newzip = update_user_meta( $user_id, 'rcp_zip', sanitize_text_field( $_POST['rcp_zip'] ) );
		$zipxml = '<FL val="Mailing Zip">'.$_POST['rcp_zip'].'</FL>';
		if($newzip) {
			if ( function_exists("SimpleLogger") ) {
				SimpleLogger()->notice(
					"{first} {last} edited their zip from {old} to {new}",
					array(
						"first" => $first_name,
						"last" => $last_name,
						"old" => $oldzip,
						"new" => $_POST['rcp_zip'],
					)
				);
			}
		}
	}
	if( ! empty( $_POST['rcp_contact'] ) ) {
		$oldcontact = get_user_meta( $user_id, 'rcp_contact', true );
		$newcontact = update_user_meta( $user_id, 'rcp_contact', sanitize_text_field( $_POST['rcp_contact'] ) );
		if($_POST['rcp_type'] == 'mobile') {
			$phonetype = 'Mobile';
		} elseif($_POST['rcp_type'] == 'home') {
			$phonetype = 'Home Phone';
		} else {
			$phonetype = 'Phone';
		}
		$contactxml = '<FL val="'.$phonetype.'">'.$_POST['rcp_contact'].'</FL>';
		if($newcontact) {
			if ( function_exists("SimpleLogger") ) {
				SimpleLogger()->notice(
					"{first} {last} edited their phone number from {old} to {new}",
					array(
						"first" => $first_name,
						"last" => $last_name,
						"old" => $oldcontact,
						"new" => $_POST['rcp_contact'],
					)
				);
			}
		}
	}

	update_user_meta( $user_id, 'rcp_type', $_POST['rcp_type'] );

	if( isset( $_POST['rcp_ambition'] ) ) {
		update_user_meta( $user_id, 'rcp_ambition', 1 );
	} else {
		update_user_meta( $user_id, 'rcp_ambition', 0 );
	}

	if( isset( $_POST['rcp_privacy'] ) ) {
		update_user_meta( $user_id, 'rcp_privacy', $_POST['rcp_privacy'] );
	}

	$oldha = get_user_meta( $user_id, 'rcp_ha', true );
	$newha = update_user_meta( $user_id, 'rcp_ha', sanitize_text_field( $_POST['rcp_ha'] ) );
	$haxml = '<FL val="Holy Ambition">'.$_POST['rcp_ha'].'</FL>';
	if($newha) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Holy Ambition from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldha,
					"new" => $_POST['rcp_ha'],
				)
			);
		}
	}

	$oldmission = get_user_meta( $user_id, 'rcp_mission', true );
	$newmission = update_user_meta( $user_id, 'rcp_mission', sanitize_text_field( $_POST['rcp_mission'] ) );
	$missionxml = '<FL val="Mission Statement">'.$_POST['rcp_mission'].'</FL>';
	if($newmission) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Mission from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldmission,
					"new" => $_POST['rcp_mission'],
				)
			);
		}
	}

	$oldstrength1 = get_user_meta( $user_id, 'rcp_strength1', true );
	$newstrength1 = update_user_meta( $user_id, 'rcp_strength1', $_POST['rcp_strength1'] );
	$strength1xml = '<FL val="Strengths 1">'.$_POST['rcp_strength1'].'</FL>';
	if($newstrength1) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Strength 1 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldstrength1,
					"new" => $_POST['rcp_strength1'],
				)
			);
		}
	}

	$oldstrength2 = get_user_meta( $user_id, 'rcp_strength2', true );
	$newstrength2 = update_user_meta( $user_id, 'rcp_strength2', $_POST['rcp_strength2'] );
	$strength2xml = '<FL val="Strengths 2">'.$_POST['rcp_strength2'].'</FL>';
	if($newstrength2) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Strength 2 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldstrength2,
					"new" => $_POST['rcp_strength2'],
				)
			);
		}
	}


	$oldstrength3 = get_user_meta( $user_id, 'rcp_strength3', true );
	$newstrength3 = update_user_meta( $user_id, 'rcp_strength3', $_POST['rcp_strength3'] );
	$strength3xml = '<FL val="Strengths 3">'.$_POST['rcp_strength3'].'</FL>';
	if($newstrength3) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Strength 3 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldstrength3,
					"new" => $_POST['rcp_strength3'],
				)
			);
		}
	}

	$oldstrength4 = get_user_meta( $user_id, 'rcp_strength4', true );
	$newstrength4 = update_user_meta( $user_id, 'rcp_strength4', $_POST['rcp_strength4'] );
	$strength4xml = '<FL val="Strengths 4">'.$_POST['rcp_strength4'].'</FL>';
	if($newstrength4) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Strength 4 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldstrength4,
					"new" => $_POST['rcp_strength4'],
				)
			);
		}
	}

	$oldstrength5 = get_user_meta( $user_id, 'rcp_strength5', true );
	$newstrength5 = update_user_meta( $user_id, 'rcp_strength5', $_POST['rcp_strength5'] );
	$strength5xml = '<FL val="Strengths 5">'.$_POST['rcp_strength5'].'</FL>';
	if($newstrength5) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Strength 5 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldstrength5,
					"new" => $_POST['rcp_strength5'],
				)
			);
		}
	}


	$oldgift1 = get_user_meta( $user_id, 'rcp_gift1', true );
	$newgift1 = update_user_meta( $user_id, 'rcp_gift1', $_POST['rcp_gift1'] );
	$gift1xml = '<FL val="Spiritual Gift 1">'.$_POST['rcp_gift1'].'</FL>';
	if($newgift1) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Gift 1 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldgift1,
					"new" => $_POST['rcp_gift1'],
				)
			);
		}
	}
	$oldgift2 = get_user_meta( $user_id, 'rcp_gift2', true );
	$newgift2 = update_user_meta( $user_id, 'rcp_gift2', $_POST['rcp_gift2'] );
	$gift2xml = '<FL val="Spiritual Gift 2">'.$_POST['rcp_gift2'].'</FL>';
	if($newgift2) {
		if ( function_exists("SimpleLogger") ) {
			SimpleLogger()->notice(
				"{first} {last} edited their Gift 2 from {old} to {new}",
				array(
					"first" => $first_name,
					"last" => $last_name,
					"old" => $oldgift2,
					"new" => $_POST['rcp_gift2'],
				)
			);
		}
	}

	if( empty( $_POST['rcp_zohoid'] ) ) {
		$zohoid = get_user_meta( $user_id, 'rcp_zohoid', true );
	} else {
		$zohoid = $_POST['rcp_zohoid'];
	}

	if( ! empty( $zohoid ) ) {
		update_user_meta( $user_id, 'rcp_zohoid', sanitize_text_field( $zohoid ) );
		header("Content-type: application/xml");
		if(site_url() == 'http://local-prime.com') {
			$token="1813e0019dcc82d21a0b7609365ed50a";
		} else {
			$token="e63e7ff339d6f3d8d4634e651191e98b";
		}
		$id = "&id=".$zohoid;
		//Build XMl
		$xml = '&xmlData=<Contacts><row no="1">'.$firstxml.$lastxml.$emailxml.$addressxml.$cityxml.$statexml.$zipxml.$contactxml.$haxml.$missionxml.$strength1xml.$strength2xml.$strength3xml.$strength4xml.$strength5xml.$gift1xml.$gift2xml.'</row></Contacts>';
		$url = "https://crm.zoho.com/crm/private/xml/Contacts/updateRecords";
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$id.$xml;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
	}


}
add_action( 'rcp_user_profile_updated', 'pw_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'pw_rcp_save_user_fields_on_profile_save', 10 );
/*History log if email changed*/
function user_profile_update_email( $user_id, $old_user_data ) {
	$user = get_userdata( $user_id );
	if($old_user_data->user_email != $user->user_email) {
		//Send to Zoho
		$zohoid = get_user_meta( $user_id, 'rcp_zohoid', true );
		$emailxml = '<FL val="Email">'.$user->user_email.'</FL>';
		if( ! empty( $zohoid ) ) {
			header("Content-type: application/xml");
			if(site_url() == 'http://local-prime.com') {
				$token="1813e0019dcc82d21a0b7609365ed50a";
			} else {
				$token="e63e7ff339d6f3d8d4634e651191e98b";
			}
			$id = "&id=".$zohoid;
			//Build XMl
			$xml = '&xmlData=<Contacts><row no="1">'.$emailxml.'</row></Contacts>';
			$url = "https://crm.zoho.com/crm/private/xml/Contacts/updateRecords";
			$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$id.$xml;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		//Track in SimpleLogger
  		if ( function_exists("SimpleLogger") ) {
  			SimpleLogger()->notice(
  				"{name} edited their email from {old} to {new}",
  				array(
  					"name" => $user->display_name,
  					"old" => $old_user_data->user_email,
  					"new" => $user->user_email,
  				)
  			);
  		}
	} else {
		if ( function_exists("SimpleLogger") ) {
  			SimpleLogger()->notice(
  				"{name} probably changed their name",
  				array(
  					"name" => $user->display_name,
  				)
  			);
  		}
	}
}

add_action( 'profile_update', 'user_profile_update_email', 10, 2 );
/**
 * Stores the the first name last name and email if edited from user edit page
 *
 */
function edit_user_page( $user_id ) {
	if( ! empty( $_POST['first_name'] ) ) {
		$firstxml = '<FL val="First Name">'.$_POST['first_name'].'</FL>';
	}
	if( ! empty( $_POST['last_name'] ) ) {
		$lastxml = '<FL val="Last Name">'.$_POST['last_name'].'</FL>';
	}
	if( ! empty( $_POST['email'] ) ) {
		$emailxml = '<FL val="Email">'.$_POST['email'].'</FL>';
	}
	if( empty( $_POST['rcp_zohoid'] ) ) {
		$zohoid = get_user_meta( $user_id, 'rcp_zohoid', true );
	} else {
		$zohoid = $_POST['rcp_zohoid'];
	}

	if( ! empty( $zohoid ) ) {
		update_user_meta( $user_id, 'rcp_zohoid', sanitize_text_field( $zohoid ) );
		header("Content-type: application/xml");
		if(site_url() == 'http://local-prime.com') {
			$token="1813e0019dcc82d21a0b7609365ed50a";
		} else {
			$token="e63e7ff339d6f3d8d4634e651191e98b";
		}
		$id = "&id=".$zohoid;
		//Build XMl
		$xml = '&xmlData=<Contacts><row no="1">'.$firstxml.$lastxml.$emailxml.'</row></Contacts>';
		$url = "https://crm.zoho.com/crm/private/xml/Contacts/updateRecords";
		$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$id.$xml;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
	}

}
add_action( 'edit_user_profile_update', 'edit_user_page', 10 );

function my_mce_buttons_2($buttons) {
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'superscript';

	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
/**Notify of Profile Update**/
//add_action( 'profile_update', 'ngtj_updated_user_profile_notify', 10, 2 );
function ngtj_updated_user_profile_notify( $user_id, $old_user_data )
{
	// get the user data into an object
	$user = get_userdata( $user_id );
	// get metadata
	//$user_meta = get_user_meta( $user_id );
	// get the site administrator's email address
	$admin_email = get_option( 'admin_email' );
	// the email body
	$message = sprintf( __( '%s has updated their profile' ), $user->display_name ) . "\r\n\r\n";
	$message .= sprintf( __( 'Display Name: %s' ), $user->display_name ). "\r\n\r\n";
	$message .= sprintf( __( 'Username: %s' ), $user->user_login ). "\r\n\r\n";
	//$message .= sprintf( __( 'Old Email: %s' ), $old_user_data->user_email ). "\r\n\r\n";
	$message .= sprintf( __( 'Email: %s' ), $user->user_email ). "\r\n\r\n";
	/*$message .= sprintf( __( 'Street: %s' ), $user_meta['rcp_address'][0] ). "\r\n\r\n";
	$message .= sprintf( __( 'City: %s' ), $user_meta['rcp_city'][0] ). "\r\n\r\n";
	$message .= sprintf( __( 'State: %s' ), $user_meta['rcp_state'][0] ). "\r\n\r\n";
	$message .= sprintf( __( 'Zip: %s' ), $user_meta['rcp_zip'][0] ). "\r\n\r\n";
	$message .= sprintf( __( 'Contact: %s' ), $user_meta['rcp_contact'][0] ). "\r\n\r\n";*/
	$message .= sprintf( __( 'View: http://secure.primemoversonline.com/wp-admin/admin.php?page=rcp-members&edit_member=%s' ), $user_id ). "\r\n\r\n";
	// send the email
	wp_mail( 'kitty.allen@lote.org,sandra.bash@lote.org', sprintf( __( '%s updated their Profile' ), $user->display_name ), $message );
}
//* Password reset activation E-mail -> Body
//add_filter( 'retrieve_password_message', 'wpse_retrieve_password_message', 10, 2 );
function wpse_retrieve_password_message( $message, $key ){
    $user_data = '';
    // If no value is posted, return false
    if( ! isset( $_POST['user_login'] )  ){
            return '';
    }
    // Fetch user information from user_login
    if ( strpos( $_POST['user_login'], '@' ) ) {

        $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    if( ! $user_data  ){
        return '';
    }
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    // Setting up message for retrieve password
    $message = "Looks like you want to reset your password!\n\n";
    $message .= "Please click on this link:\n";
    $message .= '<a href="';
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    $message .= '">"';
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    $message .= '"</a>\n\n"';
    $message .= 'Kind Regards,<br/>Primemovers';
    // Return completed message for retrieve password
    return $message;
}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Login Form Settings',
		'menu_title'	=> 'Login Settings',
		'menu_slug' 	=> 'login-form-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
/*Zoho API Integration*/
function zohoAPI() {
	/*echo '<h1>zoho</h1>';
	header("Content-type: application/xml");
	$token="1813e0019dcc82d21a0b7609365ed50a";
	$id = "&id=925406000000487001";
	$xml = '&xmlData=<Contacts><row no="1"><FL val="First Name">Josh</FL></row></Contacts>';
	$url = "https://crm.zoho.com/crm/private/xml/Contacts/updateRecords";
	$param= "authtoken=".$token."&scope=crmapi&newFormat=1".$id.$xml;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	$result = curl_exec($ch);
	curl_close($ch);
	var_dump($result);*/
}
add_action('rcp_profile_editor_after','zohoAPI');
add_filter( 'send_email_change_email', '__return_false' );
