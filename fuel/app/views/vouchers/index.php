<!-- Latest Vouchers DataTable -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-ticket"></i> Vouchers List
        <a id="btnGenerateVouchers" class="btn btn-primary text-light pull-right" data-toggle="modal" data-target="#formVouchersGenerate"><i class="fa fa-cog"></i> Generate Vouchers</a>
        <a id="btnVouchersNew" class="btn btn-success text-light pull-right mr-2" data-toggle="modal" data-target="#formVouchersModal"><i class="fa fa-file"></i> New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="VouchersTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Recipient</th>
                    <th>Offer</th>
                    <th>Expiration</th>
                    <th>Usage</th>
                    <th>Code</th>
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
<div class="modal fade" id="formVouchersModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voucher</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formVouchers">
                    <div class="form-group row">
                        <label for="id_voucher" class="col-3 col-form-label">ID</label>
                        <div class="col-9">
                            <input class="form-control" type="text" value="" id="id_voucher" name="id_voucher" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label">Recipient</label>
                        <div class="col-9">
                            <select required class="form-control" type="text" value="" id="id_recipient" name="id_recipient"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Offer</label>
                        <div class="col-9">
                            <select required class="form-control" type="text" value="" id="id_offer" name="id_offer"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Exp. Date</label>
                        <div class="col-9">
                            <input required class="form-control" type="date" value="" id="date_expiration" name="date_expiration" placeholder="Expiration Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Use Date</label>
                        <div class="col-9">
                            <input class="form-control" type="date" value="" id="date_usage" name="date_usage" placeholder="Usage Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Code</label>
                        <div class="col-9">
                            <input required class="form-control" type="text" value="" id="code" name="code" placeholder="Code" maxlength="8">
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="formVouchersModalOk" class="btn btn-primary" href="#">OK</a>
            </div>
        </div>
    </div>
</div>

<!-- Generate Vouchers Modal -->
<div class="modal fade" id="formVouchersGenerate" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formGenerateVouchers" action="<?php echo Uri::create('vouchers/generate'); ?>" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Batch Generate Vouchers</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Offer</label>
                        <div class="col-9">
                            <select required class="form-control" type="text" value="" id="id_offer_gen" name="id_offer_gen"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Exp. Date</label>
                        <div class="col-9">
                            <input required class="form-control" type="date" value="" id="date_expiration" name="date_expiration" placeholder="Offer">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button tyu class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button tyu>
                <input type="submit" class="btn btn-primary" value="Generate">
            </div>
            </form>
        </div>
    </div>
</div>