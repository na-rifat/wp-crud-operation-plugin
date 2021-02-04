(function ($) {
    $(document).ready(() => {
        $(`#vendor_provider`)
            .on(`change`, function (e) {
                let self = $(this);
                let self_val = $(this).val();
                let current_op = $(this).find(`[value="${self_val}"]`);

                let vendor_person_in_change = current_op.data(
                    `vendor_person_in_change`
                );
                let vendor_email = current_op.data(`vendor_email`);
                let vendor_contact = current_op.data(`vendor_contact`);

                $(`#vendor_person_in_change`).val(vendor_person_in_change);
                $(`#vendor_email`).val(vendor_email);
                $(`#vendor_contact`).val(vendor_contact);
            })
            .trigger(`change`);

        $(`.btn-delete`).on(`click`, function (e) {
            if (confirm(`Are you sure you want to delte this content?`)) {
                window.open(
                    cmp.delete_url + $(this).parents("tr").data(`code`),
                    "_self"
                );
                // window.location.href =
                //     cmp.delete_url + $(this).parents("tr").data(`code`);
            }
        });

        $(`.btn-edit`).on(`click`, function (e) {
            window.location.href =
                cmp.edit_url + $(this).parents("tr").data(`code`);
        });

        $(`.btn-view`).on(`click`, function (e) {
            window.location.href =
                cmp.view_url + $(this).parents("tr").data(`code`);
        });
    });
})(jQuery);
