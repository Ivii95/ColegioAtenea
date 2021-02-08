<?php
/**
 * Enfant courses template part
 *
 * @package Enfant
 */
?>
<div class="<?php enfant_bc( '4', '4', '6' ); ?>">
    <div class="ztl-course-item">
        <div class="image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('enfant-4-3');
                    }
                ?>
            </a>
        </div>

        <div class="course-title"><?php the_title(); ?></div>
        <div class="course-excerpt"><?php enfant_excerpt( 40, false ); ?></div>
        <div class="clear20"></div>
        <div class="course-description ztl-accent-font">
            <?php
                echo wp_kses( get_post_meta( get_the_ID(), 'enfant_course_description', true ),
                    array( 'div' => array(), 'span' => array( 'class' => array() ), 'i' => array( 'class' => array() ) ));
            ?>
        </div>
        <div class="clear40"></div>
        <div class="ztl-button-one ztl-center">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php esc_html_e( 'Read More', 'enfant' ) ?>
            </a>
        </div>
    </div>
    <div class="clear"></div>
</div>