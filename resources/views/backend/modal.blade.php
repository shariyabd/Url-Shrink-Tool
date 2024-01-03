<div class="modal fade" id="createUrlModal" data-keyboard="false" data-backdrop="static" tabindex="-1"
aria-labelledby="createUrl" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalHeading"></h5>
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        <div class="message px-3 pt-2"></div>
        <div class="modal-body">
            <div class="message px-3 pt-2"></div>
            <form id="urlForm" name="urlForm">
                @csrf
                <input type="hidden" name="id" id="id">
                <label for="org_url" id="org_url">Your url:</label>
                <input type="text" name="org_url" id="org_url" class="form-control org-url" placeholder=" Url :">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveUrl" value="">Save Url</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>