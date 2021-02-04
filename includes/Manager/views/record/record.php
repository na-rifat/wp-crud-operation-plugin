
<?php
    if(isset($_GET['cmp_delete_successfull'])){
        ?>
            <div class="cmp-success">Successfully deleted.</div>
        <?php
    }
    if(isset($_GET['cmp_delete_failed'])){
        ?>
            <div class="cmp-failed">
                Failed to delete a content.
            </div>
        <?php
    }
?>
<table class="cmp-contents">
    <thead>
        <tr>
            <th>Code</th>
            <th>Vendor/Service Provider</th>
            <th>Product type</th>
            <th>Contract ID</th>
            <th>Contract Signed Date</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Invoice ID</th>
            <th>Invoice date</th>
            <th>Actions</th>
        </tr>        
    </thead>
    <tbody>
        <?php 
            foreach($records as $record){
                ?>
                    <tr data-code="<?php echo $record->code ?>">
                        <td><?php echo $record->code ?></td>
                        <td><?php echo $record->vendor_provider ?></td>
                        <td><?php echo $record->product_type ?></td>
                        <td><?php echo $record->contract_id ?></td>
                        <td><?php echo $record->contract_signed_date ?></td>
                        <td><?php echo $record->start_date ?></td>
                        <td><?php echo $record->end_date ?></td>
                        <td><?php echo $record->invoice_id ?></td>
                        <td><?php echo $record->invoice_date ?></td>
                        <td class="action-btns">
                            <div class="btn-edit"><i class="fas fa-pencil-alt"></i></div>
                            <div class="btn-view"><i class="fas fa-link"></i></div>
                            <div class="btn-delete"><i class="far fa-trash-alt"></i></div>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>