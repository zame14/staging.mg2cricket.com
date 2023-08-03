<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
require_once('modal/class.Base.php');
require_once('modal/class.Bat.php');
require_once('modal/class.Service.php');
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    //wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    //wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick.css');
    //wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css');
}
//add_image_size( 'grid', 600, 400, true);
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );
function dg_remove_page_templates( $templates ) {
    unset( $templates['page-templates/blank.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );
    unset( $templates['page-templates/both-sidebarspage.php'] );
    unset( $templates['page-templates/empty.php'] );
    unset( $templates['page-templates/fullwidthpage.php'] );
    unset( $templates['page-templates/left-sidebarpage.php'] );
    unset( $templates['page-templates/right-sidebarpage.php'] );

    return $templates;
}
add_filter( 'theme_page_templates', 'dg_remove_page_templates' );
function mainMenu()
{
    $html = '<ul>
        <li><a href="#cricket-bats">cricket bats</a></li>
        <li><a href="#services">services</a></li>
        <li><a href="#soft-goods">soft goods</a></li>
        <li><a href="#contact">contact</a></li>
    </ul>';
    return $html;
}
function getBats()
{
    $arr = Array();
    $posts_array = get_posts([
        'post_type' => 'bat',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
    ]);
    foreach ($posts_array as $post) {
        $bat = new Bat($post);
        $arr[] = $bat;
    }
    return $arr;
}
function bats_shortcode()
{
    $html = '<div class="row justify-content-center">';
        foreach (getBats() as $bat) {
            $html .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3 bat-panel">
                <div class="inner-wrapper">
                    <div class="image-wrapper">
                        ' . $bat->getFeatureImage() . '
                    </div>
                    <div class="content-wrapper">
                        <h4>' . $bat->getTitle() . '</h4>
                        <div class="price">' . $bat->getContent() . '</div>
                    </div>
                </div>
            </div>';
        }
    $html .= '</div>';
    return $html;
}
add_shortcode('cricket_bats', 'bats_shortcode');
function getFeatureServices()
{
    $services = Array();
    $posts_array = get_posts([
        'post_type' => 'service',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'wpcf-service-feature',
                'value' => 1
            ]
        ],
    ]);
    foreach ($posts_array as $post) {
        $service = new Service($post);
        $services[] = $service;
    }
    return $services;
}
function featureServices_shortcode()
{
    $html = '<div class="row justify-content-center">';
    foreach(getFeatureServices() as $service)
    {
        $html .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3 service-panel">
                <div class="inner-wrapper">
                    <div class="image-wrapper">
                        ' . $service->getFeatureImage() . '
                    </div>
                    <div class="content-wrapper">
                        <h4>' . $service->getTitle() . '</h4>
                        <div class="price">' . $service->getCustomField('service-price') . '</div>
                    </div>
                </div>
            </div>';
    }
    $html .= '</div>';
    return $html;
}
add_shortcode('services', 'featureServices_shortcode');
function getServices()
{
    $services = Array();
    $posts_array = get_posts([
        'post_type' => 'service',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'menu_order',
    ]);
    foreach ($posts_array as $post) {
        $service = new Service($post);
        $services[] = $service;
    }
    return $services;
}
function servicesTable_shortcode()
{
    $html = '<table class="table table-striped">
        <thead>
            <tr>
                <th>Service</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>';
        foreach (getServices() as $service)
        {
            $title = $service->getTitle();
            if($service->getCustomField('service-extra-info') <> "")
            {
                $title .= ' (' . $service->getCustomField('service-extra-info') . ')';
            }
            $html .= '<tr>
                <td>' . $title . '</td>
                <td>' . $service->getCustomField('service-price') . '</td>
            </tr>';
        }
        $html .= '</tbody>
    </table>';
    return $html;
}
add_shortcode('services_table', 'servicesTable_shortcode');
function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}