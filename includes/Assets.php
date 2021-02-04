<?php

namespace cmp;

/**
 * Registers essential assets
 */
class Assets {
    /**
     * Construct assets class
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'register'] );
        add_action( 'admin_enqueue_scripts', [$this, 'register'] );
        add_action( 'wp_enqueue_scripts', [$this, 'load'] );
        add_action( 'admin_enqueue_scripts', [$this, 'load'] );
    }

    /**
     * Return scripts from array
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'cmp-frontend-script' => jsfile( 'style', ['jquery'] ),
        ];
    }

    /**
     * Return styles from array
     *
     * @return array
     */
    public function get_styles() {
        return [
            'cmp-frontend-style' => cssfile( 'style' ),
            'cmp-fontawesome'    => [
                'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css',
                'version' => '5.15.2',
            ],
        ];
    }

    /**
     * Return localize variable from array
     *
     * @return array
     */
    public function get_localize() {
        global $post;
        $slug       = $this->manager::slugs;
        $site_url   = site_url();
        $edit_url   = "{$site_url}/{$slug['edit_content']}?cmp_action=edit&code=";
        $view_url   = "{$site_url}/{$slug['view_content']}?cmp_action=view&code=";
        $delete_url = "{$site_url}/{$slug['contents']}?cmp_action=delete&code=";

        return [
            'cmp-frontend-script' => [
                'ajax_url'  => admin_url( 'admin-ajax.php' ),
                'site_url'  => $site_url,
                'edit_url'  => $edit_url,
                'view_url'  => $view_url,
                'delete_url' => $delete_url,
            ],
        ];
    }

    /**
     * Registers scripts, styles and localize variables
     *
     * @return void
     */
    public function register() {
        // Scripts
        $scripts = $this->get_scripts();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, ! empty( $script['version'] ) ? $script['version'] : false, true );

        }

        // Styles
        $styles = $this->get_styles();

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, ! empty( $style['version'] ) ? $style['version'] : false );
        }

        // Localization
        $localize = $this->get_localize();

        foreach ( $localize as $handle => $vars ) {
            wp_localize_script( $handle, 'cmp', $vars );
        }
    }

    /**
     * Loads the scripts to frontend
     *
     * @return void
     */
    public function load() {
        wp_enqueue_style( 'cmp-frontend-style' );
        wp_enqueue_style( 'cmp-fontawesome' );
        wp_enqueue_script( 'cmp-frontend-script' );
        if ( is_admin() ) {

            if ( isset( $_GET['page'] ) && $_GET['page'] == 'cmp' ) {
                // wp_enqueue_style( 'cmp-fontawesome' );
            }
        } else {

        }
    }
}