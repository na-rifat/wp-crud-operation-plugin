

<div class="cmp-form">
    <form action="" method="POST">
        <div class="input-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" value="<?php echo $ct->code; ?>">
        </div>
        <div class="input-group">
            <label for="vendor_provider">Vendor/Service Provider</label>
            <select name="vendor_provider" id="vendor_provider">
                <!-- Options goes here -->
                <?php echo $this->vendor_selected_options($ct->vendor_provider) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="contract_subscription_entity_used">Contract Subscription entity used</label>
            <select type="text" name="contract_subscription_entity_used" id="contract_subscription_entity_used">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'contract_subscription_entity_used' , $ct->contract_subscription_entity_used) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="product_type">Product type</label>
            <select name="product_type" id="product_type">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'product_type', $ct->product_type ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="product_description">Product description</label>
            <textarea name="product_description" id="product_description" cols="30" rows="10"><?php echo $ct->product_description ?></textarea>
        </div>
        <div class="input-group">
            <label for="contract_value">Contract Value</label>
            <input type="text" name="contract_value" id="contract_value" value="<?php echo $ct->contract_value ?>">
        </div>
        <div class="input-group">
            <label for="contract">Contract</label>
            <input type="file" name="contract" id="contract" disabled >
        </div>
        <div class="input-group">
            <label for="contract_currency">Contract Currency</label>
            <select name="contract_currency" id="contract_currency">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'contract_currency', $ct->contract_currency ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="contract_id">Contract ID</label>
            <input type="text" name="contract_id" id="contract_id" value="<?php echo $ct->contract_id ?>">
        </div>
        <div class="input-group">
            <label for="contract_signed_date">Contract Signed Date</label>
            <input type="date" name="contract_signed_date" id="contract_signed_date" value="<?php echo $ct->contract_signed_date ?>">
        </div>
        <div class="input-group">
            <label for="by_user">By user/EWL</label>
            <select name="by_user" id="by_user">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'by_user' , $ct->by_user) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="no_of_users">No of users</label>
            <input type="number" name="no_of_users" id="no_of_users" value="<?php echo $ct->no_of_users ?>">
        </div>
        <div class="input-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo $ct->start_date ?>">
        </div>
        <div class="input-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" value="<?php echo $ct->end_date ?>">
        </div>
        <div class="input-group">
            <label for="coordinator_person_in_change">Coordinator Person-in-charge</label>
            <input type="text" name="coordinator_person_in_change" id="coordinator_person_in_change" value="<?php echo $ct->coordinator_person_in_change ?>">
        </div>
        <div class="input-group">
            <label for="vendor_person_in_change">Vendor Person-in-charge</label>
            <input type="text" name="vendor_person_in_change" id="vendor_person_in_change" disabled value="<?php echo $ct->vendor_parson_in_change ?>">
        </div>
        <div class="input-group">
            <label for="vendor_email">Vendor Email</label>
            <input type="email" name="vendor_email" id="vendor_email" disabled value="<?php echo $ct->vendor_email ?>">
        </div>
        <div class="input-group">
            <label for="vendor_contact">Vendor Contact</label>
            <input type="text" name="vendor_contact" id="vendor_contact" disabled value="<?php echo $ct->vendor_contract ?>">
        </div>
        <div class="input-group">
            <label for="payment_entity_used">Payment entity used</label>
            <select name="payment_entity_used" id="payment_entity_used">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'payment_entity_used', $ct->payment_entity_used ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="payment_amount">Payment amount</label>
            <input type="text" name="payment_amount" id="payment_amount" value="<?php echo $ct->payment_amount ?>">
        </div>
        <div class="input-group">
            <label for="payment_currency">Payment currency</label>
            <select name="payment_currency" id="payment_currency">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'payment_currency', $ct->payment_currency ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="monthly_quarterly_semannual_annual">Monthly/Quarterly/semi-annual/Annual</label>
            <select name="monthly_quarterly_semannual_annual" id="monthly_quarterly_semannual_annual">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'monthly_quarterly_semannual_annual', $ct->monthly_quarterly_semannual_annual ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="invoice_id">Invoice ID</label>
            <input type="text" name="invoice_id" id="invoice_id"  value="<?php echo $ct->invoice_id ?>">
        </div>
        <div class="input-group">
            <label for="invoice_date">Invoice Date</label>
            <input type="date" name="invoice_date" id="invoice_date"  value="<?php echo $ct->invoice_date ?>>
        </div>
        <div class="input-group">
            <label for="approval_document">Approval document</label>
            <input type="file" name="approval_document" id="approval_document" disabled >
        </div>
        <div class="input-group">
            <label for="upload_invoice">Upload invoice</label>
            <input type="file" name="upload_invoice" id="upload_invoice" disabled>
        </div>
        <div class="input-group">
            <label for="subscription_module">Subscription module</label>
            <select name="subscription_module" id="subscription_module">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'subscription_module', $ct->subscription_module ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="fullfillment_name">Fullfillment name</label>
            <input type="text" name="fullfillment_name" id="fullfillment_name"  value="<?php echo $ct->fullfillment_name
             ?>" >
        </div>
        <div class="input-group">
            <label for="fullfillment_email">Fullfillment Email</label>
            <input type="email" name="fullfillment_email" id="fullfillment_email"  value="<?php echo $ct->fullfillment_email ?>" >
        </div>
        <div class="input-group">
            <label for="location_country_user">Location Country User</label>
            <select name="location_country_user" id="location_country_user">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'location_country_user', $ct->location_country_user ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="amount_per_user">Amount per user</label>
            <select name="amount_per_user" id="amount_per_user">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'amount_per_user', $ct->amount_per_user ) ?>
            </select>
        </div>
        <div class="input-group">
            <label for="department_user">Department User</label>
            <select name="department_user" id="department_user">
                <!-- Options goes here -->
                <?php echo $this->selected_drop_down( 'department_user', $ct->amount_per_user ) ?>
            </select>
        </div>
        <div class="input-group">
            <?php wp_nonce_field( 'cmp_insert_data' );?>
            <input type="hidden" name="action" value="cmp_edit_data">
            <input type="submit" value="Save">
        </div>

    </form>
</div>
