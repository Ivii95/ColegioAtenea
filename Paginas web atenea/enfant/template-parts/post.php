<?php
/**
 * Enfant default post item template part
 *
 * @package Enfant
 */
?>

<div class="item">
    <article class="common-blog clearfix">
        <div class="date">
			<span class="date-tag ztl-date-line">
                <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?> </a>
			</span>
        </div>

    	<div class="title">
    		<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    	</div>
    	<div class="image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'enfant-blog-full' ); ?>
			</a>
		</div>
		<div class="info">
			<?php if ( is_sticky() ) :  ?>
				<span class="sticky-tag"><i class="base-flaticon-shape"></i>
					<?php esc_html_e( 'Sticky','enfant' ); ?>
				</span>
			<?php endif; ?>

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
		</div>
        <div class="text-content"> 
        	<?php enfant_excerpt( 40 ); ?>
        </div>
        <div class="ztl-button-one read-more">
        	<a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read more','enfant' );?></a>
        </div>
    </article>
</div>
