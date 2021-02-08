<?php
/**
 * Content template part for displaying single post
 *
 * @package Enfant
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content ztl-single">
		<div class="entry-meta centered">
			<span class="entry-title"><?php the_title(); ?></span>
			<div class="ztl-post">
                <div class="date">
                    <span class="date-tag ztl-date-line">
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                    </span>
                </div>
				<div class="image">
					<?php the_post_thumbnail( 'enfant-full' ); ?>
				</div>
               
			</div>
          <!-- ESTO ES LO DEL AUTOR, CATEGORIA Y COMENTARIOS QUE LO TENGO COMENTADO
		<div class="info">
                        <?php
                            $tags = get_the_tags();
                            if ( $tags ) {
                                echo '<span><i class="base-flaticon-business"></i>';
                                the_tags( '' );
                                echo '</span>';
                            }
                        ?>
                        <span>
                            <i class="base-flaticon-layout"></i>
                                <?php
                                    $categories = get_the_category();
                                    foreach ( $categories as $key => $category ) {
                                        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_html__( 'View all posts filed under ','enfant' ) . esc_attr( $category->name ) . '">';
                                        echo esc_attr( $category->name );
                                        echo '</a>';
                                        if ( $key >= 0 && $key + 1 < count( $categories ) ) {
                                            echo ', ';
                                        }
                                    }
                                ?>
                        </span>
                        <span>
                            <i class="base-flaticon-edit"></i>
                            <?php the_author_posts_link(); ?>
                        </span>
                            <span>
                        <i class="base-flaticon-networking"></i>
                        <a href="<?php the_permalink(); ?>#comments">
                            <?php echo esc_attr( get_comments_number() ); ?>
                            <?php echo esc_html__( 'Comments','enfant' );?>
                        </a>
                    </span>
                </div>-->
		</div><!-- .entry-meta -->
		<?php
		the_content( sprintf(
		/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'enfant' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'enfant' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php enfant_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
