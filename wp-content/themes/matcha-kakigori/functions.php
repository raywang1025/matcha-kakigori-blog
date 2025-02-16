<?php
/**
 * Matcha Kakigori 主題功能
 */

// 設置主題支援
function matcha_kakigori_setup() {
    // 添加標題標籤支援
    add_theme_support('title-tag');
    
    // 添加特色圖片支援
    add_theme_support('post-thumbnails');
    
    // 添加自定義logo支援
    add_theme_support('custom-logo');
    
    // 註冊導航菜單
    register_nav_menus(array(
        'primary' => __('主導航菜單', 'matcha-kakigori'),
        'footer' => __('頁腳菜單', 'matcha-kakigori')
    ));
}
add_action('after_setup_theme', 'matcha_kakigori_setup');

// 註冊小工具區域
function matcha_kakigori_widgets_init() {
    register_sidebar(array(
        'name' => __('側邊欄', 'matcha-kakigori'),
        'id' => 'sidebar-1',
        'description' => __('添加小工具到側邊欄', 'matcha-kakigori'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'matcha_kakigori_widgets_init');

// 加載樣式和腳本
function matcha_kakigori_scripts() {
    // 加載 Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&display=swap');
    
    // 加載主題樣式表
    wp_enqueue_style('matcha-kakigori-style', get_stylesheet_uri());
    
    // 加載 jQuery
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'matcha_kakigori_scripts');

// 自定義文章類型：店家
function matcha_kakigori_register_post_types() {
    register_post_type('shop', array(
        'labels' => array(
            'name' => __('店家', 'matcha-kakigori'),
            'singular_name' => __('店家', 'matcha-kakigori'),
            'add_new' => __('新增店家', 'matcha-kakigori'),
            'add_new_item' => __('新增店家', 'matcha-kakigori'),
            'edit_item' => __('編輯店家', 'matcha-kakigori'),
            'new_item' => __('新店家', 'matcha-kakigori'),
            'view_item' => __('查看店家', 'matcha-kakigori'),
            'search_items' => __('搜尋店家', 'matcha-kakigori'),
            'not_found' => __('找不到店家', 'matcha-kakigori'),
            'not_found_in_trash' => __('回收桶中沒有店家', 'matcha-kakigori'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-store',
        'show_in_rest' => true, // 支援區塊編輯器
    ));
}
add_action('init', 'matcha_kakigori_register_post_types');

// 自定義分類法：地區
function matcha_kakigori_register_taxonomies() {
    register_taxonomy('area', 'shop', array(
        'labels' => array(
            'name' => __('地區', 'matcha-kakigori'),
            'singular_name' => __('地區', 'matcha-kakigori'),
            'search_items' => __('搜尋地區', 'matcha-kakigori'),
            'all_items' => __('所有地區', 'matcha-kakigori'),
            'parent_item' => __('父級地區', 'matcha-kakigori'),
            'parent_item_colon' => __('父級地區：', 'matcha-kakigori'),
            'edit_item' => __('編輯地區', 'matcha-kakigori'),
            'update_item' => __('更新地區', 'matcha-kakigori'),
            'add_new_item' => __('新增地區', 'matcha-kakigori'),
            'new_item_name' => __('新地區名稱', 'matcha-kakigori'),
            'menu_name' => __('地區', 'matcha-kakigori'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'area'),
        'show_in_rest' => true, // 支援區塊編輯器
    ));
}
add_action('init', 'matcha_kakigori_register_taxonomies');

// 添加多語言支援
function matcha_kakigori_load_theme_textdomain() {
    load_theme_textdomain('matcha-kakigori', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'matcha_kakigori_load_theme_textdomain');

// 添加自定義欄位
function matcha_kakigori_add_meta_boxes() {
    add_meta_box(
        'shop_details',
        __('店家詳情', 'matcha-kakigori'),
        'matcha_kakigori_shop_details_callback',
        'shop',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'matcha_kakigori_add_meta_boxes');

// 店家詳情欄位回調函數
function matcha_kakigori_shop_details_callback($post) {
    wp_nonce_field('matcha_kakigori_save_shop_details', 'matcha_kakigori_shop_details_nonce');
    
    $address = get_post_meta($post->ID, '_shop_address', true);
    $phone = get_post_meta($post->ID, '_shop_phone', true);
    $hours = get_post_meta($post->ID, '_shop_hours', true);
    $price_range = get_post_meta($post->ID, '_shop_price_range', true);
    
    echo '<p>';
    echo '<label for="shop_address">' . __('地址：', 'matcha-kakigori') . '</label><br>';
    echo '<input type="text" id="shop_address" name="shop_address" value="' . esc_attr($address) . '" size="50" />';
    echo '</p>';
    
    echo '<p>';
    echo '<label for="shop_phone">' . __('電話：', 'matcha-kakigori') . '</label><br>';
    echo '<input type="text" id="shop_phone" name="shop_phone" value="' . esc_attr($phone) . '" />';
    echo '</p>';
    
    echo '<p>';
    echo '<label for="shop_hours">' . __('營業時間：', 'matcha-kakigori') . '</label><br>';
    echo '<textarea id="shop_hours" name="shop_hours" rows="3" cols="50">' . esc_textarea($hours) . '</textarea>';
    echo '</p>';
    
    echo '<p>';
    echo '<label for="shop_price_range">' . __('價格範圍：', 'matcha-kakigori') . '</label><br>';
    echo '<input type="text" id="shop_price_range" name="shop_price_range" value="' . esc_attr($price_range) . '" />';
    echo '</p>';
}

// 保存店家詳情
function matcha_kakigori_save_shop_details($post_id) {
    if (!isset($_POST['matcha_kakigori_shop_details_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['matcha_kakigori_shop_details_nonce'], 'matcha_kakigori_save_shop_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'shop_address',
        'shop_phone',
        'shop_hours',
        'shop_price_range'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post', 'matcha_kakigori_save_shop_details'); 