<div class="wrap">
    <?php if ( get_sub_field('title') ) : ?>
        <h2><?php the_sub_field('title'); ?></h2>
    <?php endif; ?>
    <?php if(have_rows('accordion')):?>
        <div class="accordion js-accordion" data-accordion-prefix-classes="accordion">
            <?php while(have_rows('accordion')):the_row(); ?>
                <div class="accordion__item js-accordion__panel">
                    <?php if( get_sub_field('title') ): ?>
                        <h3 class="accordion__item__heading js-accordion__header screen-reader-text"><?php the_sub_field('title');?></h3>
                    <?php endif; ?>
                    <?php if( get_sub_field('content') ): ?>
                        <div class="accordion__item__content">
                            <?php the_sub_field('content');?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>