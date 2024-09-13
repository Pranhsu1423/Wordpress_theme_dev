<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() || false === astra_get_option( 'enable-comments-area', true ) ) {
	return;
}

$comment_form_position = astra_get_option( 'comment-form-position', 'below' );
$container_selector    = 'outside' === astra_get_option( 'comments-box-placement' ) ? 'ast-container--' . astra_get_option( 'comments-box-container-width', '' ) : '';

if ( is_customize_preview() && is_callable( 'Astra_Builder_UI_Controller::render_customizer_edit_button' ) ) {
	?>
		<div id="comments" class="customizer-item-block-preview customizer-navigate-on-focus comments-area comment-form-position-<?php echo esc_attr( $comment_form_position ); ?> <?php echo esc_attr( $container_selector ); ?>" data-section="ast-sub-section-comments" data-type="section">
	<?php
	Astra_Builder_UI_Controller::render_customizer_edit_button( 'row-editor-shortcut' );
} else {
	?>
		<div id="comments" class="comments-area comment-form-position-<?php echo esc_attr( $comment_form_position ); ?> <?php echo esc_attr( $container_selector ); ?>">
	<?php
}
?>

	<?php astra_comments_before(); ?>

	<?php
	if ( 'above' === $comment_form_position ) {
		comment_form();
	}
	if ( have_comments() ) :
		astra_markup_open( 'comment-count-wrapper' );
		$title_tag = apply_filters( 'astra_comment_title_tag', 'h3' );
		?>
			<<?php echo esc_attr( $title_tag ); ?> class="comments-title">
				<?php
				$astra_comments_title = apply_filters(
					'astra_comment_form_title',
					sprintf( // WPCS: XSS OK.
						/* translators: 1: number of comments */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'astra' ) ),
						number_format_i18n( get_comments_number() ),
						get_the_title()
					)
				);

				echo esc_html( $astra_comments_title );
				?>
			</<?php echo esc_attr( $title_tag ); ?>>
		<?php
		astra_markup_close( 'comment-count-wrapper' );
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
		<nav id="comment-nav-above" class="navigation comment-navigation" aria-label="<?php esc_attr_e( 'Comments Navigation', 'astra' ); ?>">
			<h3 class="screen-reader-text"><?php echo esc_html( astra_default_strings( 'string-comment-navigation-next', false ) ); ?></h3>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( astra_default_strings( 'string-comment-navigation-previous', false ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( astra_default_strings( 'string-comment-navigation-next', false ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; ?>

		<ol class="ast-comment-list">
			<?php
			wp_list_comments(
				array(
					'callback' => 'astra_theme_comment',
					'style'    => 'ol',
				)
			);
			?>
		</ol><!-- .ast-comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" aria-label="<?php esc_attr_e( 'Comments Navigation', 'astra' ); ?>">
			<h3 class="screen-reader-text"><?php echo esc_html( astra_default_strings( 'string-comment-navigation-next', false ) ); ?></h3>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( astra_default_strings( 'string-comment-navigation-previous', false ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( astra_default_strings( 'string-comment-navigation-next', false ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; ?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php echo esc_html( astra_default_strings( 'string-comment-closed', false ) ); ?></p>
	<?php
	endif;

	// Array of arguments for comment form
$comments_args = array(
	// Define Fields
	'fields' => array('
        <p class="comment-form-comment"><br />Comment *<textarea id="comment" name="comment" aria-required="true"></textarea></p>
        <div class="d-flex">
        <p class="comment-form-author half"><br />Name *<input id="author" name="author" aria-required="true" placeholder="' . esc_attr__( 'Name', 'astra' ) . '"></p>
        <p class="comment-form-email half"><br />Email *<input id="email" name="email" aria-required="true" placeholder="' . esc_attr__( 'Email', 'astra' ) . '"></p></div>
        <p class="comment-form-url full"><br />Website<input id="website" name="website" placeholder="' . esc_attr__( 'Website', 'astra' ) . '"></p>',
		'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" type="checkbox" required>' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'astra' ) . '<a href="' . esc_url( get_privacy_policy_url() ) . '">' ,'</a></p>',
	),
	// Change the title of send button
	'label_submit' => esc_html__( 'Post Comment', 'astra' ),
	// Change the title of the reply section
	'title_reply' => esc_html__( 'LEAVE A REPLY', 'astra' )
);
comment_form( $comments_args ); 

?>

<?php astra_comments_after(); ?>


</div><!-- #comments -->

<?php do_action( 'astra_after_comments_module' ); ?>
