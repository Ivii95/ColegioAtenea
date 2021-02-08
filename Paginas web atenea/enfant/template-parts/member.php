<?php
/**
 * Enfant staff template part
 *
 * @package Enfant
 */
?>
        <div class="ztl-staff-item">
            <div class="variation-2">
                <div class="<?php enfant_bc( '6', '6' ); ?>">
                    <div class="item-left">
                        <div class="image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php
                                    if ( has_post_thumbnail() ) {
									    the_post_thumbnail( 'enfant-column' );
                                    }
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="<?php enfant_bc( '6', '6' ); ?>">
                    <div class="item-right">
                        <div class="staff-title"><?php the_title(); ?></div>
                        <div class="staff-position">
                            <?php echo esc_html( get_post_meta( get_the_ID(), 'enfant_staff_position', true ) ); ?>
                        </div>
                        <ul class="ztl-social ztl-social-mini">
                            <?php if ( get_post_meta( get_the_ID(), 'enfant_staff_member_facebook', true ) ) { ?>
                                <li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'enfant_staff_member_facebook', true ) ); ?>"
                                       target="_blank"><i class="base-flaticon-facebook"></i></a> </li><?php } ?>
                            <?php if ( get_post_meta( get_the_ID(), 'enfant_staff_member_twitter', true ) ) { ?>
                                <li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'enfant_staff_member_twitter', true ) ); ?>"
                                       target="_blank"><i class="base-flaticon-twitter"></i></a></li> <?php } ?>
                            <?php if ( get_post_meta( get_the_ID(), 'enfant_staff_member_linkedin', true ) ) { ?>
                                <li><a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'enfant_staff_member_linkedin', true ) ); ?>"
                                       target="_blank"><i class="base-flaticon-linkedin"></i></a></li> <?php } ?>
                        </ul>
                        <div class="staff-excerpt"><?php enfant_excerpt( 40, false ); ?></div>
                        <div class="clear20"></div>
                        <div class="ztl-button-one ztl-center">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php esc_html_e( 'More About Me', 'enfant' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
