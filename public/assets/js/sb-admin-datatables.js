// Call the dataTables jQuery plugin

$(document).ready(function () {

    /************
     * RECIPIENTS PAGE Handlers
     */

    $('#RecipientsTable').DataTable({
        "ajax": 'recipients/table',
        "fnDrawCallback": function (oSettings, json) {
            // Every ajax update on this table, refresh DOM handlers

            // Form OK button handler
            $("#formRecipientsModalOk").off('click');
            $("#formRecipientsModalOk").on('click', function () {
                if ($("#formRecipients")[0].checkValidity()) {
                    $("#loader").fadeIn('fast');
                    $.ajax({
                        type: "POST",
                        url: "recipients/set",
                        data: $("#formRecipients").serialize(),
                        dataType: "json",
                        success: function (data) {
                            if (data != "1") alert("Error updating/creating record!");
                            $("#loader").fadeOut('fast');
                            $('#formRecipientsModal').modal('hide');
                            $('#RecipientsTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error sending request.');
                            $("#loader").fadeOut('fast');
                            $('#formRecipientsModal').modal('hide');
                        }
                    });
                } else {
                    $("#formRecipients")[0].reportValidity();
                }
            });

            // Edit Button Handler
            $(".recipient-edit-btn").off('click');
            $(".recipient-edit-btn").on('click', function () {
                var id = $(this).data('id');
                $("#loader").fadeIn('fast');
                $.getJSON("recipients/get/" + id, {}).done(function (data) {
                    $("#id_recipient").val(data.id_recipient);
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#loader").fadeOut('fast');
                    $('#formRecipientsModal').modal('show');
                });
            });

            // Delete button Handler
            $(".recipient-delete-btn").off('click');
            $(".recipient-delete-btn").on('click', function (e) {
                var id = $(this).data('id');
                $('#confirm').modal({}).one('click', '#yes', function (e) {
                    $("#loader").fadeIn('fast');
                    $.ajax({
                        type: "GET",
                        url: "recipients/del/" + id,
                        success: function (data) {
                            if (data != "1") alert("Error deleting record!");
                            $("#loader").fadeOut('fast');
                            $('#formRecipientsModal').modal('hide');
                            $('#RecipientsTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error sending request.');
                            $("#loader").fadeOut('fast');
                            $('#formRecipientsModal').modal('hide');
                        }
                    });
                });
            });

        }
    });


    /************
     * VOUCHERS PAGE Handlers
     */

    $('#VouchersTable').DataTable({
        "ajax": 'vouchers/table',
        "fnDrawCallback": function (oSettings, json) {
            // Every ajax update on this table, refresh DOM handlers

            // Form OK button handler
            $("#formVouchersModalOk").off('click');
            $("#formVouchersModalOk").on('click', function () {
                if ($("#formVouchers")[0].checkValidity()) {
                    $("#loader").fadeIn('fast');
                    $.ajax({
                        type: "POST",
                        url: "vouchers/set",
                        data: $("#formVouchers").serialize(),
                        dataType: "json",
                        success: function (data) {
                            if (data != "1") alert("Error updating/creating record!");
                            $("#loader").fadeOut('fast');
                            $('#formVouchersModal').modal('hide');
                            $('#VouchersTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error sending request.');
                            $("#loader").fadeOut('fast');
                            $('#formVouchersModal').modal('hide');
                        }
                    });
                } else {
                    $("#formVouchers")[0].reportValidity();
                }
            });

            // Edit Button Handler
            $(".voucher-edit-btn").off('click');
            $(".voucher-edit-btn").on('click', function () {
                var id = $(this).data('id');
                $("#loader").fadeIn('fast');
                $.getJSON("vouchers/get/" + id, {}).done(function (data) {

                    $("#id_voucher").val(data.id_voucher);

                    // populate recipients list
                    $.getJSON("recipients/list", function(json){
                        $('#id_recipient').empty();
                        $('#id_recipient').append($('<option>').text("Select"));
                        $.each(json.data, function(i, obj){
                            $('#id_recipient').append($('<option>').text(obj.name).attr('value', obj.value));
                        });
                        $("#id_recipient").val(data.id_recipient);  // select correct item
                    });

                    // populate offers list
                    $.getJSON("offers/list", function(json){
                        $('#id_offer').empty();
                        $('#id_offer').append($('<option>').text("Select"));
                        $.each(json.data, function(i, obj){
                            $('#id_offer').append($('<option>').text(obj.name).attr('value', obj.value));
                        });
                        $("#id_offer").val(data.id_offer);  // select correct item
                    });

                    $("#date_expiration").val(data.date_expiration);
                    $("#date_usage").val(data.date_usage);
                    $("#code").val(data.code);
                    $("#loader").fadeOut('fast');
                    $('#formVouchersModal').modal('show');
                });
            });

            // Delete button Handler
            $(".voucher-delete-btn").off('click');
            $(".voucher-delete-btn").on('click', function (e) {
                var id = $(this).data('id');
                $('#confirm').modal({}).one('click', '#yes', function (e) {
                    $("#loader").fadeIn('fast');
                    $.ajax({
                        type: "GET",
                        url: "vouchers/del/" + id,
                        success: function (data) {
                            if (data != "1") alert("Error deleting record!");
                            $("#loader").fadeOut('fast');
                            $('#formVouchersModal').modal('hide');
                            $('#VouchersTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error sending request.');
                            $("#loader").fadeOut('fast');
                            $('#formVouchersModal').modal('hide');
                        }
                    });
                });
            });

        }
    });


    /************
     * OFFERS PAGE Handlers
     */

    $('#OffersTable').DataTable({
        "ajax": 'offers/table',
        "fnDrawCallback": function (oSettings, json) {
            // Every ajax update on this table, refresh DOM handlers

            // Form OK button handler
            $("#formOffersModalOk").off('click');
            $("#formOffersModalOk").on('click', function () {
                if ($("#formOffers")[0].checkValidity()) {
                    $("#loader").fadeIn('fast');
                    $.ajax({
                        type: "POST",
                        url: "offers/set",
                        data: $("#formOffers").serialize(),
                        dataType: "json",
                        success: function (data) {
                            if (data != "1") alert("Error updating/creating record!");
                            $("#loader").fadeOut('fast');
                            $('#formOffersModal').modal('hide');
                            $('#OffersTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error sending request.');
                            $("#loader").fadeOut('fast');
                            $('#formOffersModal').modal('hide');
                        }
                    });
                } else {
                    $("#formOffers")[0].reportValidity();
                }
            });

            // Edit Button Handler
            $(".offer-edit-btn").off('click');
            $(".offer-edit-btn").on('click', function () {
                var id = $(this).data('id');
                $("#loader").fadeIn('fast');
                $.getJSON("offers/get/" + id, {}).done(function (data) {
                    $("#id_offer").val(data.id_offer);
                    $("#name").val(data.name);
                    $("#discount").val(data.discount);
                    $("#loader").fadeOut('fast');
                    $('#formOffersModal').modal('show');
                });
            });

            // Delete button Handler
            $(".offer-delete-btn").off('click');
            $(".offer-delete-btn").on('click', function (e) {
                var id = $(this).data('id');
                $('#confirm').modal({}).one('click', '#yes', function (e) {
                    $("#loader").fadeIn('fast');
                    $.ajax({
                        type: "GET",
                        url: "offers/del/" + id,
                        success: function (data) {
                            if (data != "1") alert("Error deleting record!");
                            $("#loader").fadeOut('fast');
                            $('#formOffersModal').modal('hide');
                            $('#OffersTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error sending request.');
                            $("#loader").fadeOut('fast');
                            $('#formOffersModal').modal('hide');
                        }
                    });
                });
            });

        }
    });


});
