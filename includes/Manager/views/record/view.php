<table class="cmp-viewdata">
<tr>
        <th>Column name</th>
        <th>Value</th>
    </tr>
<?php
    $i = 0;
    foreach ( self::col_names as $col ) {
    ?>

    <tr>

    <?php
        switch ( $col ) {
                case 'contract':
                case 'approval_document':
                case 'upload_invoice':
                    echo "<th>" . self::col_title[$i] . "</th>";
                    echo "<td><a target='_blank' href='{$cells->$col}'>File</a></td>";
                    // echo ! empty( $cells->$col ) ? "<td><a target='_blank' href='{$cells->$col}'>File</a></td>" : 'No file';
                    break;
                default:
                    echo "<th>" . self::col_title[$i] . "</th>";
                    echo "<td>{$cells->$col}</td>";
                    break;
            }
        ?>
    </tr>
    <?php
        $i++;
        }
    ?>
</table>
