<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
                <p class="site-description"><?php bloginfo('description'); ?></p>
                <?php
            }
            ?>
        </div>

        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu',
                'container' => false,
                'fallback_cb' => function() {
                    echo '<ul class="nav-menu">';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('首頁', 'matcha-kakigori') . '</a></li>';
                    echo '<li><a href="' . esc_url(get_post_type_archive_link('shop')) . '">' . __('店家列表', 'matcha-kakigori') . '</a></li>';
                    echo '</ul>';
                },
            ));
            ?>
        </nav>

        <div class="header-search">
            <?php get_search_form(); ?>
        </div>

        <div class="language-switcher">
            <?php
            if (function_exists('pll_the_languages')) {
                pll_the_languages(array(
                    'show_flags' => 1,
                    'show_names' => 1,
                    'dropdown' => 1
                ));
            }
            ?>
        </div>

        <?php if (is_singular('shop')) : ?>
            <div class="shop-header-meta">
                <?php
                $areas = get_the_terms(get_the_ID(), 'area');
                if ($areas && !is_wp_error($areas)) {
                    echo '<div class="shop-areas">';
                    foreach ($areas as $area) {
                        echo '<span class="area-tag">' . esc_html($area->name) . '</span>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="site-content">
    <div class="container">
        <?php
        if (!is_front_page()) {
            ?>
            <div class="breadcrumbs">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                } else {
                    echo '<p class="breadcrumbs-basic">';
                    echo '<a href="' . esc_url(home_url('/')) . '">' . __('首頁', 'matcha-kakigori') . '</a>';
                    if (is_singular('shop')) {
                        echo ' &gt; ';
                        echo '<a href="' . esc_url(get_post_type_archive_link('shop')) . '">' . __('店家列表', 'matcha-kakigori') . '</a>';
                        echo ' &gt; ';
                        the_title();
                    } elseif (is_archive()) {
                        echo ' &gt; ';
                        echo get_the_archive_title();
                    }
                    echo '</p>';
                }
                ?>
            </div>
            <?php
        }
        ?> 