<!-- Modal -->
<div class="modal fade" id="editorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Qrcode Generator</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="left" title="Cancel Qrcode"></button> --}}
            </div>
            <div class="modal-body">
                <p class="text-center text-info"><b>Note</b></p>
                <p class="text-secondary text-center" style="margin-top: -10px;">Make sure to click the print button or download button for your qrcodes. before clicking Close.</p>
                <iframe id="frame" src="" width="100%" height="550" frameborder="0"></iframe>

            </div>
            <div class="modal-footer">
                <a href="{{ route('employee.table') }}" id="qrsuccess" type="button" class="btn btn-danger qrclose"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Qrcodes is cancelled"
                >Cancel Qr</a>
                <a href="{{ route('employee.table') }}" id="qrclose" type="button" class="btn btn-dark">Mark as Generated</a>
                
            </div>
        </div>
    </div>
</div>
