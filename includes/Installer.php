<?php

namespace cmp;

/**
 * Installer class
 */
class Installer {

    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->create_tables();
    }

    /**
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS`{$wpdb->prefix}cmp_data` (
            `code` bigint(20) NOT NULL AUTO_INCREMENT,
            `vendor_provider` longtext DEFAULT NULL,
            `contract_subscription_entity_used` longtext DEFAULT NULL,
            `product_type` longtext DEFAULT NULL,
            `product_description` longtext DEFAULT NULL,
            `contract_value` longtext DEFAULT NULL,
            `contract` longtext DEFAULT NULL,
            `contract_currency` longtext DEFAULT NULL,
            `contract_id` longtext DEFAULT NULL,
            `contract_signed_date` longtext DEFAULT NULL,
            `by_user` longtext DEFAULT NULL,
            `no_of_users` longtext DEFAULT NULL,
            `start_date` longtext DEFAULT NULL,
            `end_date` longtext DEFAULT NULL,
            `coordinator_person_in_change` longtext DEFAULT NULL,
            `vendor_person_in_change` longtext DEFAULT NULL,
            `vendor_email` longtext DEFAULT NULL,
            `vendor_contact` longtext DEFAULT NULL,
            `payment_entity_used` longtext DEFAULT NULL,
            `payment_amount` longtext DEFAULT NULL,
            `payment_currency` longtext DEFAULT NULL,
            `monthly_quarterly_semannual_annual` longtext DEFAULT NULL,
            `invoice_id` longtext DEFAULT NULL,
            `invoice_date` longtext DEFAULT NULL,
            `approval_document` longtext DEFAULT NULL,
            `upload_invoice` longtext DEFAULT NULL,
            `subscription_module` longtext DEFAULT NULL,
            `fullfillment_name` longtext DEFAULT NULL,
            `fullfillment_email` longtext DEFAULT NULL,
            `location_country_user` longtext DEFAULT NULL,
            `amount_per_user` longtext DEFAULT NULL,
            `department_user` longtext DEFAULT NULL,
            PRIMARY KEY (`code`)
           ) {$charset_collate}";
// exit($schema);
        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }
}
