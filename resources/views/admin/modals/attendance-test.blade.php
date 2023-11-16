<!-- Modal -->
<div class="modal fade" id="attendanceTestModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Attendance test
                        Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

               <form action="{{ route('upload-qr') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <input type="file" class="form-control" name="qr_code_image" id="qr_code_image">
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
               </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark">Generate Reports</button>
            </div>
        </div>
    </div>
</div>
