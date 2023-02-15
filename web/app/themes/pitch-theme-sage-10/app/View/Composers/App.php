<?php

namespace App\View\Composers;

use App\Controllers\wp_bootstrap4_navwalker;
use bootstrap_5_wp_nav_menu_walker;
use Roots\Acorn\View\Composer;
use function get_field;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'header_data' => $this->headerData(),
            'footer_data' => $this->footerData(),
            'options_data' => $this->optionsData(),
            'data' => $this->sectionsData(),
            'mainMenu' => $this->mainMenu(),
            'mobilemenu' => $this->mobileMenu(),
            'siteName' => $this->siteName(),
            'template_list' => $this->templateList(),
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Header
     *
     * @return array
     */
    public function headerData()
    {
        $data = get_field('header_group', 'options');
        $data = array(
            'data' => $data,
        );
        return $data;
    }

    /**
     * Footer
     *
     * @return array
     */
    public function footerData()
    {
        $data = get_field('footer_group', 'options');
        $data = array(
            'data' => $data,
        );
        return $data;
    }

    /**
     * Options
     *
     * @return array
     */
    public function optionsData()
    {
        $blog = get_field('blog_group', 'options');
        $modal_login = get_field('modal_login_group', 'options');
        $other_option = get_field('option_group', 'options');
        $modal_site_selector_group = get_field('modal_site_selector_group', 'options');
        $data = array(
            'blog' => $blog,
            'modal_login' => $modal_login,
            'other' => $other_option,
            'modal_site_selector' => $modal_site_selector_group,
        );
        return $data;
    }

    /**
     * Primary Nav Menu arguments
     * @return array
     */
    public function mainMenu()
    {
        $args = array(
            'theme_location' => 'primary_navigation',
            'container_id' => 'navbarSupportedContent',
            'container_class' => 'navbar-desktop',
            'menu_class' => 'nav navbar-nav w-100',
            'walker' => new bootstrap_5_wp_nav_menu_walker()
        );
        return $args;
    }

    /**
     * Mobile Nav Menu arguments
     * @return array
     */
    public function mobileMenu()
    {
        $args = array(
            'theme_location' => 'primary_mobile_navigation',
            'container_id' => 'navbarSupportedContent',
            'container_class' => 'navbar-collapse navbar-mobile',
            'menu_class' => 'nav navbar-nav',
            'walker' => new bootstrap_5_wp_nav_menu_walker()
        );
        return $args;
    }

    /**
     * Sections
     * @return array
     */
    public function sectionsData()
    {
        $flexible_sections = get_field('section_flexible');
        $data = array(
            'flexible-sections' => $flexible_sections,
        );
        return $data;
    }

    /**
     * Sections
     * @return array
     */
    public function templateList()
    {
        $post_type = get_field('post_type');
        $data = array(
            'post-type' => $post_type,
        );
        return $data;
    }
}
