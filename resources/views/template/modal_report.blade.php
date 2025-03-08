<div class="modal fade reportModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title hartpiece-font-poppins" id="exampleModalLabel">Report This Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="report-id">
                <input type="hidden" id="reason">
                <div class="alert alert-success d-none" id="report-message" role="alert">
                </div>
                <label>Please select a reason</label>
                <button type="button" class="btn btn-outline-dark btn-block btn-sm report-reason">Harrasment</button>
                <button type="button" class="btn btn-outline-dark btn-block btn-sm report-reason">Misleading</button>
                <button type="button" class="btn btn-outline-dark btn-block btn-sm report-reason">Spam</button>
                <button type="button" class="btn btn-outline-dark btn-block btn-sm report-reason">Copyright</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn hartpiece-btn-reverse btn-sm btn-report" disabled><b>Submit</b></button>
            </div>
        </div>
    </div>
</div>