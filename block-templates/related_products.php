<?php
if (! defined('ABSPATH') ) {
    exit;  // Exit if accessed directly.
}

$s_swiper_uniq_class = uniqid("related_productSwiper_");

$products = get_field('product');
$s_related_product_title = get_field('related_product_title');
if( $s_related_product_title == '' ) {
    $s_related_product_title = '이 포스팅과 연관된 제품';
}
?>
<div class="sv-custom-block">
    <div class="related-product">
        <p class="sec-label"><?php echo $s_related_product_title ?></p>
        <?php if (!empty($products)) { ?>
            <?php if (is_admin()) : ?>
                <?php
                $cnt = 1;
                foreach ($products as $item) : ?>
                    <p><?php echo $cnt ?>.선택된 항목 : <strong><?php echo get_the_title($item->ID); ?></strong></p>
                    <?php
                    $cnt++;
                endforeach; ?>
            <?php else : ?>
                <div class="<?php echo $s_swiper_uniq_class ?>">
                    <div class="swiper-wrapper">
                        <?php foreach ($products as $item) : ?>
                            <div class="swiper-slide">
                                <a href="<?php echo get_permalink($item->ID); ?>">
                                    <div class="thumbnail">
                                        <?php echo get_the_post_thumbnail($item->ID, 'thumbnail'); ?>
                                    </div>
                                    <p class="title"><?php echo get_the_title($item->ID); ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif ?>
        <?php } ?>
    </div>
</div>
<?php if (!is_admin() && !empty($products)) { ?>
    <script>
        // allow multiple swiper on a single page
        const <?php echo $s_swiper_uniq_class ?> = new Swiper('.<?php echo $s_swiper_uniq_class ?>', {
            slidesPerView: 1.4,
            spaceBetween: 30,
            breakpoints: {
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                }
            },
        });
    </script>
<?php } ?>
