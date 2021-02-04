<?php

    /**
     * This files contains all important functions for cmp4sale website project
     */

    /**
     * Return a css files url
     *
     * @param  [type] $filename
     * @return void
     */
    if ( ! function_exists( 'cssfile' ) ) {
        function cssfile( $filename, $deps = [] ) {
            return [
                'src'     => CMP_CSS . "/{$filename}.css",
                'version' => cssversion( $filename ),
                'deps'    => $deps,
            ]
            ;
        }
    }

    /**
     * Return a js files url
     *
     * @param  [type] $filename
     * @return void
     */
    if ( ! function_exists( 'jsfile' ) ) {
        function jsfile( $filename, $deps = [] ) {
            return [
                'src'     => CMP_JS . "/{$filename}.js",
                'version' => jsversion( $filename ),
                'deps'    => $deps,
            ];
        }
    }

    /**
     * Return a image files url
     *
     * @param  [type] $filename
     * @return void
     */
    if ( ! function_exists( 'imgfile' ) ) {
        function imgfile( $filename ) {
            return CMP_IMAGES . "/$filename";
        }
    }

    /**
     * Get js files version based on date modified
     *
     * @param  [type] $filename
     * @return void
     */
    if ( ! function_exists( 'jsversion' ) ) {
        function jsversion( $filename ) {
            return filemtime( convert_path_slash( CMP_PATH . "/assets/js/{$filename}.js" ) );
        }
    }
    /**
     * Get css files version based on date modified
     *
     * @param  [type] $filename
     * @return void
     */
    if ( ! function_exists( 'cssversion' ) ) {
        function cssversion( $filename ) {
            return filemtime( convert_path_slash( CMP_PATH . "/assets/css/{$filename}.css" ) );
        }
    }

    /**
     * Replaces back slashes with slashes from a files path
     *
     * @param  [type] $path
     * @return void
     */
    if ( ! function_exists( 'convert_path_slash' ) ) {
        function convert_path_slash( $path ) {
            return str_replace( "\\", "/", $path );
        }
    }

    /**
     * Pulls a template from views folder
     *
     * @param  [type] $dir
     * @param  [type] $filename
     * @return void
     */
    if ( ! function_exists( 'cmp_template' ) ) {
        function cmp_template( $dir, $filename ) {
            ob_start();
            include convert_path_slash( "{$dir}/views/{$filename}.php" );
            return ob_get_clean();
        }
    }

    if ( ! function_exists( 'cmp_admin_template' ) ) {
        /**
         * Returns a template for admin panel
         *
         * @param  [type] $dir
         * @param  [type] $filename
         * @return void
         */
        function cmp_admin_template( $dir, $filename ) {
            ob_start();
            include convert_path_slash( "{$dir}/views/{$filename}.php" );
            echo ob_get_clean();
            return;
        }
    }
    /**
     * Echos cmps localized text
     *
     * @param  [type] $text
     * @return void
     */
    // if ( ! function_exists( 'b' ) ) {
    //     function n( $text ) {
    //         _e( $text, 'cmp' );
    //     }
    // }

    /**
     * Return cmps localized value
     *
     * @param  [type] $val
     * @return void
     */
    // if ( ! function_exists( '__b' ) ) {
    //     function __n( $val ) {
    //         return __( $val, 'cmp' );
    //     }
    // }

    /**
     * Creates a action field for forms
     *
     * @param  [type] $action
     * @return void
     */
    if ( ! function_exists( 'cmp_form_action' ) ) {
        function cmp_form_action( $action ) {
            ob_start();
        ?>
        <input type="hidden" name="action" value="<?php echo $action ?>" />
    <?php
        echo ob_get_clean();
            }
        }

        /**
         * Returns user location object from IP
         *
         * @return object|array
         */
        if ( ! function_exists( 'cmp_user_location' ) ) {
            function cmp_user_location() {
                $ip                            = strlen( $_SERVER['REMOTE_ADDR'] ) > 3 ? $_SERVER['REMOTE_ADDR'] : '';
                $ip_response                   = file_get_contents( 'http://ip-api.com/json/' . $ip );
                $ip_array                      = json_decode( $ip_response );
                $GLOBALS['cmp_location'] = $ip_array;
                return $ip_array;
            }
        }

        /**
         * get's google recaptcha response
         *
         * @param  [type] $recaptcha
         * @return void
         */
        if ( ! function_exists( 'reCaptcha' ) ) {
            function reCaptcha( $recaptcha ) {
                $secret = get_option( 'cmp_captcha_secret' ) ? get_option( 'cmp_captcha_secret' ) : '';
                $ip     = $_SERVER['REMOTE_ADDR'];

                $postvars = array( "secret" => $secret, "response" => $recaptcha, "remoteip" => $ip );
                $url      = "https://www.google.com/recaptcha/api/siteverify";
                $ch       = curl_init();
                curl_setopt( $ch, CURLOPT_URL, $url );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $postvars );
                $data = curl_exec( $ch );
                curl_close( $ch );

                return json_decode( $data, true );
            }
        }

        /**
         * Verifies if a function is okay or not
         *
         * @return void
         */
        if ( ! function_exists( 'verify_cmp_captcha' ) ) {
            function verify_cmp_captcha() {
                $recaptcha = $_POST['g-recaptcha-response'];
                $res       = reCaptcha( $recaptcha );
                if ( ! $res['success'] ) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        if ( ! function_exists( 'cmp_ajax' ) ) {
            /**
             * Registers an ajax hook
             *
             * @param  [type] $action
             * @param  array  $func
             * @return void
             */
            function cmp_ajax( $action, $func = [] ) {
                add_action( "wp_ajax_$action", $func );
                add_action( "wp_ajax_nopriv_$action", $func );
            }
        }

        if ( ! function_exists( 'cmp_var' ) ) {
            /**
             * Returns formatted variable
             *
             * @param  [type]                        $var
             * @return void|string|int|array|mixed
             */
            function cmp_var( $var ) {
                return isset( $_POST[$var] ) && ! empty( $_POST[$var] ) ? $_POST[$var] : '';
            }

            if ( ! function_exists( 'cmp_get_option' ) ) {
                function cmp_get_option( $key ) {
                    return stripslashes( get_option( $key ) );
                }
            }
        }

        if ( ! function_exists( 'cmp_user_tab' ) ) {
            function cmp_user_tab( $slug ) {
                echo "?cmp_page=user-dashboard&tab={$slug}";
            }
        }

        if ( ! function_exists( 'cmp_what_tab' ) ) {
            function cmp_what_tab() {
                return isset( $_GET['tab'] ) ? $_GET['tab'] : false;
            }

            if ( ! function_exists( 'do_cmp_shortcodes' ) ) {
                function do_cmp_shortcodes( $id, $elid = '', $get_from_db = true ) {
                    if ( $get_from_db ) {
                        $raw_codes = cmp_get_option( $id );
                    } else {
                        $raw_codes = $id;
                    }
                    $result = do_shortcode( stripslashes( $raw_codes ) );
                    return "<div class='cmp-shortcoded-layout' id='{$elid}'>{$result}</div>";
                }
            }
        }

        if ( ! function_exists( 'cmp_folder_name2index' ) ) {
            function cmp_folder_name2index( $name ) {
                $folder_index = [
                    'W2/Income documents'                => 't0',
                    'Business & other relevant expenses' => 't1',
                    'Draft Tax returns'                  => 't2',
                    'Final Tax Returns'                  => 't3',
                ];
                return $folder_index[$name];
            }
        }

        if ( ! function_exists( 'cmp_folder_index2name' ) ) {
            function cmp_folder_index2name( $index ) {
                $folder_index = [
                    't0' => 'W2/Income documents',
                    't1' => 'Business & other relevant expenses',
                    't2' => 'Draft Tax returns',
                    't3' => 'Final Tax Returns',
                ];
                return $folder_index[$index];
            }
        }

        if ( ! function_exists( 'folder_info' ) ) {
            function folder_info( $name = '' ) {
            ob_start();
            ?> <div class="folder-logo"><img src="<?php echo imgfile( 'folder.png' ) ?>" src="<?php _e( $name, 'cmp-tax' )?>"> </div>
        <div class="folder-title" data-folder-index="<?php echo cmp_folder_name2index( $name ) ?>"><?php _e( $name, 'cmp-tax' )?></div>
<?php
    return ob_get_clean();
        }
    }

    if ( ! function_exists( 'cmp_active_tab' ) ) {
        function cmp_active_tab( $tab_name ) {
            if ( ! empty( $_GET['tab'] ) && $_GET['tab'] == $tab_name ) {
                return ' id="active-tab" ';
            }
        }
    }

    if ( ! function_exists( 'array2options' ) ) {
        function array2options( $array ) {
            $result = '';
            foreach ( $array as $item ) {
                $caption = ucwords( $item );
                $result .= "<option value='{$item}'>{$caption}</option";
            }
            return $result;
        }
    }

    if ( ! function_exists( 'std2array' ) ) {
        function std2array( $std ) {
            return json_decode( json_encode( $std ), true );
        }
    }
    if ( ! function_exists( 'cmp_toggle' ) ) {
        function cmp_toggle( $atts ) {
            $curernt_val = get_option( $atts['key'] );
            $val1        = $atts['val1'];
            $val2        = $atts['val2'];
            $title1      = $atts['title1'];
            $title2      = $atts['title2'];

            ob_start();
            if ( $curernt_val == $val2 ) {
            ?>
                <div id="<?php echo $atts['id']?>" class="cp-toggle shad" data-key="<?php echo $atts['key'] ?>" data-value="<?php echo $curernt_val ?>">
                    <div class="toggle-item" data-value="<?php echo $val1 ?>"><?php _e( $title1, 'cmp' )?></div>
                    <div class="toggle-item active-toggle" data-value="<?php echo $val2 ?>"><?php _e( $title2, 'cmp' )?></div>
                </div>
                <?php
                    } else {
                            ?>
                <div id="<?php echo $atts['id']?>" class="cp-toggle shad" data-key="<?php echo $atts['key'] ?>" data-value="<?php echo $curernt_val ?>">
                    <div class="toggle-item active-toggle" data-value="<?php echo $val1 ?>"><?php _e( $title1, 'cmp' )?></div>
                    <div class="toggle-item" data-value="<?php echo $val2 ?>"><?php _e( $title2, 'cmp' )?></div>
                </div>
                <?php
                    }

                    }
                }