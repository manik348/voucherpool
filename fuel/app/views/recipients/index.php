<!-- Latest Vouchers DataTable -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-ticket"></i> Recipients List
        <a id="btnRecipientsNew" class="btn btn-success text-light pull-right" data-toggle="modal" data-target="#formRecipientsModal"><i class="fa fa-file"></i> New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="RecipientsTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th width="1%">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="formRecipientsModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recipient</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRecipients">
                    <div class="form-group row">
                        <label for="id_recipient" class="col-2 col-form-label">ID</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" id="id_recipient" name="id_recipient" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input required class="form-control" type="text" value="" id="name" name="name" placeholder="Enter your Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <input required class="form-control" type="email" value="" id="email" name="email" placeholder="Enter your E-mail">
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="formRecipientsModalOk" class="btn btn-primary" href="#">OK</a>
            </div>
        </div>
    </div>
</div>