<!-- Modal -->
<div class="modal fade" id="aiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
    
            <div class="modal-body">

               <h3 class="text-center mb-4">MADTRACK ASSISTANT</h3>
               <div class="mx-auto border border-success text-center p-2" style="width: 40%; max-height: 150px; margin:auto;">
                    <img src="/images/assistant.png" alt="Header Image" style="width: 50%; max-height: 100px;">
                    <span class="badge bg-success">Speech Activated</span>
                </div>
            
                <div class="card row">
                    <div class="col-sm-12 mx-auto text-center">
                        {{-- <label for="custom-input">You can edit your question below?</label> --}}
                        <input type="text" id="custom-input" class="swal2-input ai-query" placeholder="Enter your queries">
                        <span class="badge bg-danger p-2">You can edit your question Manually.</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ai-cancel">Cancel</button>
                <button type="button" class="btn btn-success ai-submit">Submit</button>
            </div>
        </div>
    </div>
</div>
