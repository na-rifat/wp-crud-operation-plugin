<?php

namespace cmp\Manager;

class Manager {
    /**
     * Useful variables
     */
    public $db;
    public $db_prefix;

    const col_names = [
        'code',
        'vendor_provider',
        'contract_subscription_entity_used',
        'product_type',
        'product_description',
        'contract_value',
        'contract',
        'contract_currency',
        'contract_id',
        'contract_signed_date',
        'by_user',
        'no_of_users',
        'start_date',
        'end_date',
        'coordinator_person_in_change',
        'vendor_person_in_change',
        'vendor_email',
        'vendor_contact',
        'payment_entity_used',
        'payment_amount',
        'payment_currency',
        'monthly_quarterly_semannual_annual',
        'invoice_id',
        'invoice_date',
        'approval_document',
        'upload_invoice',
        'subscription_module',
        'fullfillment_name',
        'fullfillment_email',
        'location_country_user',
        'amount_per_user',
        'department_user',
    ];

    const col_title = [
        "Code",
        "Vendor/Service Provider",
        "Contract Subscription entity used",
        "Product type",
        "Product description",
        "Contract Value",
        "contract",
        "Contract Currency",
        "Contract ID",
        "Contract Signed Date",
        "By user/EWL",
        "No of users",
        "Start Date",
        "End Date",
        "Coordinator Person-in-charge",
        "Vendor Person-in-charge",
        "Vendor Email",
        "Vendor Contact",
        "Payment entity used",
        "Payment amount",
        "Payment currency",
        "Monthly/Quarterly/semi-annual/Annual",
        "Invoice ID",
        "Invoice Date",
        "approval document",
        "upload invoice",
        "Subscription module",
        "Fulfillment Name",
        "Fulfillment Email",
        "Location Country User",
        "Amount per user",
        "Department User",
    ];

    const need_break_cols = [
        'contract',
        'approval_document',
        'upload_invoice',
        'code',
    ];

    const slugs = [
        'new_content'  => 'new-content',
        'contents'     => 'contents',
        'edit_content' => 'edit-content',
        'view_content' => 'view-content',
        'login_page'   => 'login',
    ];

    // const drop_downs = [
    //     'vendor_provider'                    => 'Vendor/Service Provider',
    //     'contract_subscription_entity_used'  => 'Contract Subscription entity used',
    //     'product_type'                       => 'Product type',
    //     'contract_currency'                  => 'Contract Currency',
    //     'by_user'                            => 'By user/EWL',
    //     'payment_currency'                   => 'Payment currency',
    //     'monthly_quarterly_semannual_annual' => 'Monthly/Quarterly/semi-annual/Annual',
    //     'subscription_module'                => 'Subscription module',
    //     'location_country_user'              => 'Location Country User',
    //     'amount_per_user'                    => 'Amount per user',
    //     'department_user'                    => 'Department User',
    // ];

    const drop_downs = [
        'contract_subscription_entity_used'  =>
        [
            'items',
            'items',
        ],
        'product_type'                       =>
        [
            'type a',
            'type b',
        ],
        'contract_currency'                  =>
        [
            '$',
        ],
        'by_user'                            =>
        [
            'item',
        ],
        'payment_currency'                   =>
        [
            '$',
        ],
        'monthly_quarterly_semannual_annual' =>
        [
            'item',
        ],
        'subscription_module'                =>
        [
            'item',
        ],
        'location_country_user'              =>
        [
            'item',
        ],
        'amount_per_user'                    =>
        [
            'item',
        ],
        'department_user'                    =>
        [
            'item 0',//dropdown item
			'item 1',//dropdown item
        ],
    ];

    const vendors = [
        'Test vendor' => [ //Vendor name
            'Vendor person in charge',
            'vendor email',
            'vendor contact',
        ],
        'Mr. Vendor'  => [
            'Person in charge', // Person in charge
            'His email', //Vendor email
            'His contact', //Vendor contact
        ],
    ];

    /**
     * Builds the class
     */
    function __construct() {
        $this->prepare_path();

        add_shortcode( 'cmp_new_data', [$this, 'template_new'] );
        add_shortcode( 'cmp_edit_data', [$this, 'template_new'] );

        add_shortcode( 'cmp-page', [$this, 'cmp_page'] );

        global $wpdb;
        $this->db        = $wpdb;
        $this->db_prefix = $this->db->prefix;
        add_action( 'template_redirect', [$this, 'redirect'] );

        if ( isset( $_POST['action'] ) && $_POST['action'] == 'cmp_insert_data' ) {
            $this->insert_data();
        }

        if ( isset( $_POST['action'] ) && $_POST['action'] == 'cmp_edit_data' ) {
            $this->edit_data();
        }

        if ( isset( $_GET['cmp_action'] ) ) {
            switch ( $_GET['cmp_action'] ) {
                case 'edit':

                    break;
                case 'delete':
                    $this->delete_data( isset( $_GET['code'] ) ? $_GET['code'] : 0 );
                    break;
                case 'view':
                    // wp_redirect(site_url("/" . self::slugs['view_content'] . "?cmp_actio"))
                    break;
            }
        }

        if ( isset( $_GET['cmp_logout'] ) ) {
            wp_logout();
            wp_redirect( site_url() );
            exit;
        }

    }

    public function redirect() {
        if ( ! is_user_logged_in() && ! is_page( self::slugs['login_page'] ) ) {
            wp_redirect( site_url( "/" . self::slugs['login_page'] ) );
            exit;
        }

        if ( is_user_logged_in() && is_page( self::slugs['login_page'] ) ) {
            wp_redirect( site_url() );
            exit;
        }
    }

    public function cmp_page( $atts ) {
        // $page = isset( $_GET['cmp_page'] ) ? $_GET['cmp_page'] : '';
        $page = isset( $atts['page'] ) ? $atts['page'] : '';

        switch ( $page ) {
            case 'new_data':
                ob_start();
                include __DIR__ . "/views/record/new.php";
                return ob_get_clean();
                break;
            case 'edit_data':
                $ct = $this->get_data_for_edit( isset( $_GET['code'] ) ? $_GET['code'] : 0 );
                ob_start();
                include __DIR__ . "/views/record/edit.php";
                return ob_get_clean();
                break;
            case 'view_data':
                $cells = $this->view_data( isset( $_GET['code'] ) ? $_GET['code'] : 0 );
                ob_start();
                include __DIR__ . "/views/record/view.php";
                return ob_get_clean();
                break;
            default:
                $records = $this->show_record();
                ob_start();
                include __DIR__ . "/views/record/record.php";
                return ob_get_clean();
                break;
        }
    }

    // public function single_cell($cell){
    //     switch($cell){
    //         case: 'code'
    //     }
    // }
    public function template_new() {}

    public function insert_data() {
        $data = [];

        foreach ( self::col_names as $col ) {
            if ( in_array( $col, self::need_break_cols ) ) {
                continue;
            }

            $data[$col] = cmp_var( $col );
        }
        // Data collection finished

        // Process files
        $data['contract']          = $this->move_file( isset( $_FILES['contract'] ) ? $_FILES['contract'] : '' );
        $data['approval_document'] = $this->move_file( isset( $_FILES['approval_document'] ) ? $_FILES['approval_document'] : '' );
        $data['contract']          = $this->move_file( isset( $_FILES['contract'] ) ? $_FILES['contract'] : '' );

        $last_id = $this->db->insert(
            "{$this->db_prefix}cmp_data",
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );

        if ( $last_id ) {
            update_option( 'cmp_last_id', $last_id );
            wp_redirect( site_url( "/" . self::slugs['new_content'] . "?cmp_insert_success=true" ) );
            exit;
        }
        wp_redirect( site_url( "/" . self::slugs['new_content'] . "?cmp_insert_failed=true" ) );
        exit;
    }

    public function move_file( $file ) {
        if ( empty( $file ) ) {
            return '';
        }

        $info = $this->process_file( $file );

        move_uploaded_file( $info['tmp_name'], $info['destination'] );

        return $info['url'];
    }

    public function process_file( $file ) {
        $result    = [];
        $timestamp = time();

        $result['tmp_name']     = $file['tmp_name'];
        $result['real_name']    = $file['name'];
        $result['type']         = $file['type'];
        $result['size']         = $file['size'];
        $result['ext']          = strtolower( explode( '.', $file['name'] )[sizeof( explode( '.', $file['name'] ) ) - 1] );
        $result['name']         = explode( '.', $file['name'] )[0];
        $result['storage_name'] = "{$this->current_user}_{$result['name']}_{$timestamp}.{$result['ext']}";
        $result['destination']  = "{$this->upload_path}{$this->current_user}_{$result['name']}_{$timestamp}.{$result['ext']}";
        $result['url']          = "$this->upload_url{$result['storage_name']}";

        return $result;
    }

    public function prepare_path() {
        $path    = wp_upload_dir()['basedir'] . "/cmp-files/";
        $urlpath = wp_upload_dir()['baseurl'] . "/cmp-files/";
        if ( ! file_exists( $path ) ) {
            wp_mkdir_p( $path );
        }
        $this->upload_path = $path;
        $this->upload_url  = $urlpath;
    }

    public function delete_data( $id ) {

        if ( $id == 0 ) {
            wp_redirect( site_url( "/" . self::slugs['contents'] . "?cmp_delete_failed" ) );
        }

        $this->db->delete(
            "{$this->db_prefix}cmp_data",
            ['code' => $id],
            ['%d']
        );

        // header('Location: ' .  site_url( "/" . self::slugs['contents'] . "?cmp_delete_succcessfull=true" )) ;
        // exit(site_url( "/" . self::slugs['contents'] . "?cmp_delete_succcessfull=true" ));
        wp_redirect( site_url( "/" . self::slugs['contents'] . "?cmp_delete_successfull=true" ) );
        exit;
    }

    public function view_data( $code ) {
        return $this->db->get_row(
            $this->db->prepare(
                "SELECT * FROM {$this->db_prefix}cmp_data WHERE code={$code}"
            )
        );
    }

    public function get_data_for_edit( $id ) {
        return $this->db->get_row(
            $this->db->prepare(
                "SELECT * FROM {$this->db_prefix}cmp_data WHERE code='{$id}'"
            )
        );
    }

    public function edit_data() {
        $data = [];

        foreach ( self::col_names as $col ) {
            if ( in_array( $col, self::need_break_cols ) ) {
                continue;
            }

            $data[$col] = cmp_var( $col );
        }
        // Data collection finished

        // echo sizeof($data);
        // exit(print_r($data));
        $last_id = $this->db->update(
            "{$this->db_prefix}cmp_data",
            $data,
            ['code' => isset( $_POST['code'] ) ? $_POST['code'] : 0],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ],
            ['%d']
        );

        if ( $last_id ) {
            wp_redirect( site_url( "/" . self::slugs['contents'] . "?cmp_edit_success=true" ) );
            exit;
        }
        wp_redirect( site_url( "/" . self::slugs['contents'] . "?cmp_edit_failed=true" ) );
        exit;
    }

    public function show_record() {
        $records = $this->db->get_results(
            $this->db->prepare(
                "SELECT * FROM {$this->db_prefix}cmp_data"
            )
        );

        return $records;
    }

    public function drop_down( $name ) {
        $result = '';

        foreach ( self::drop_downs[$name] as $option ) {
            $result .= "<option value='{$option}'>{$option}</option>";
        }

        return $result;
    }

    public function selected_drop_down( $name, $selected ) {
        $result = '';

        foreach ( self::drop_downs[$name] as $option ) {

            if ( $option == $selected ) {
                $result .= "<option value='{$option}'>{$option}</option>";
            } else {
                $result .= "<option value='{$option}'>{$option}</option>";
            }
        }

        return $result;
    }

    public function vendor_options() {
        $result = '';

        foreach ( self::vendors as $vendor => $info ) {
            $result .= "<option value='{$vendor}' data-vendor_person_in_change='{$info[0]}' data-vendor_email='{$info[1]}' data-vendor_contact='{$info[2]}'>{$vendor}</option>";
        }

        return $result;
    }

    public function vendor_selected_options( $selected ) {
        $result = '';

        foreach ( self::vendors as $vendor => $info ) {
            if ( $vendor == $selected ) {
                $result .= "<option selected value='{$vendor}' data-vendor_person_in_change='{$info[0]}' data-vendor_email='{$info[1]}' data-vendor_contact='{$info[2]}'>{$vendor}</option>";
            } else {
                $result .= "<option value='{$vendor}' data-vendor_person_in_change='{$info[0]}' data-vendor_email='{$info[1]}' data-vendor_contact='{$info[2]}'>{$vendor}</option>";
            }
        }

        return $result;
    }
}