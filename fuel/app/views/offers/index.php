<!-- Latest Vouchers DataTable -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-ticket"></i> Offers List
        <a id="btnOffersNew" class="btn btn-success text-light pull-right" data-toggle="modal" data-target="#formOffersModal"><i class="fa fa-file"></i> New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="OffersTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Discount</th>
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
<div class="modal fade" id="formOffersModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Offer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formOffers">
                    <div class="form-group row">
                        <label for="id_offer" class="col-2 col-form-label">ID</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" id="id_offer" name="id_offer" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input required class="form-control" type="text" value="" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-2 col-form-label">Discount</label>
                        <div class="col-10">
                            <input required class="form-control" type="text" value="" id="discount" name="discount" placeholder="Discount">
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="formOffersModalOk" class="btn btn-primary" href="#">OK</a>
            </div>
        </div>
    </div>
</div>