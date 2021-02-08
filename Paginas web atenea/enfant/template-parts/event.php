<?php
/**
 * Enfant event template part
 *
 * @package Enfant
 */

$event_start_date = new DateTime(get_post_meta(get_the_ID(), 'enfant_event_start_date', true));
?>
<div class="ztl-grid-12 ztl-event-item">
    <div class="row table-row">
        <div class="first ztl-col <?php enfant_bc('10', '10', '12', '12')?>">
            <div class="ztl-flex">
                <div class="ztl-post-thumbnail">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('enfant-wide');
                            }
                        ?>
                    </a>
                </div>
                <div class="ztl-post-details">
                    <div class="ztl-event-info ztl-font-bold">
                        <span class="ztl-event-date ztl-date-line">
                            <a href="<?php get_the_permalink(); ?>" title="<?php the_title(); ?>"><?php  echo date_i18n(get_option( 'date_format' ), $event_start_date->getTimestamp()); ?></a>
                        </span>
                        <?php if ($enfant_event_duration = get_post_meta(get_the_ID(), 'enfant_event_duration', true)) { ?>
                            <span class="ztl-event-hour">
                                <span class="flaticon-clock"></span> <?php echo esc_html($enfant_event_duration); ?>
                            </span>
                        <?php } ?>
                        <?php
                            $event_location =  get_post_meta( get_the_ID(), 'enfant_event_location', true );
                            if ($event_location) {
                            echo '<span class="ztl-event-location">
                                      <span class="flaticon-signs"></span> ' . esc_html($event_location) . '
                                </span>';
                            }
                        ?>
                    </div>
                    <div class="ztl-event-title">
                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a></h3>
                    </div>
                    <div class="ztl-event-description">
                        <?php enfant_excerpt( 40, false ); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="second ztl-col <?php enfant_bc('2', '2', '12', '12'); ?>">
            <div class="ztl-button-one">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php echo esc_html__('Register', 'enfant'); ?></a>
            </div>
        </div>
    </div>
</div>
