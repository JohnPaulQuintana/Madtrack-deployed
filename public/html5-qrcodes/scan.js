// Your jQuery code to open the modal
$(document).ready(function () {
    $("#openModalAttendance").click(function () {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: "Attendance System?",
            text: "Select your attendance options!",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Time-In",
            cancelButtonText: "Time-Out",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
            //   swalWithBootstrapButtons.fire({
            //     title: "Time-In!",
            //     text: "Your file has been deleted.",
            //     icon: "success"
            //   });
              $("#attendance").modal("show");
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
                $("#attendance-timeout").modal("show");
            }
          });
        // $("#attendance").modal("show");
    });

    // This method will trigger user permissions
    const availableCamera = () => {
        return Html5Qrcode.getCameras()
            .then((devices) => {
                /**
                 * devices would be an array of objects of type:
                 * { id: "id", label: "label" }
                 */
                if (devices && devices.length) {
                    // i want to return only the first one camera
                    var availableCamera = devices[0];
                    return availableCamera;
                }
            })
            .catch((err) => {
                // handle err
                throw err; // Re-throw the error to be caught later
            });
    };

    const html5QrCode = new Html5Qrcode(/* element id */ "reader");
    let scannerIsRunning = false;

    async function startScanner(camera) {
        try {
            await html5QrCode.start(
                camera.id,
                {
                    fps: 20,
                    qrbox: { width: 250, height: 250 },
                },
                async (decodedText, decodedResult) => {
                    stopScanner();
                    const data = {};
                    const fields = decodedResult.decodedText.split(", ");
                    fields.forEach((field) => {
                        const [key, value] = field.split(": ");
                        data[key] = value;
                    });
    
                    console.log(data);
                    
                    try {
                        const response = await $.ajax({
                            url: '/store-attendance',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify(data),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        });
                        // Construct the image URL based on the image path
                        const imagePath = '/images'; // Replace this with the actual image path
                        const imageUrl = window.location.origin + imagePath;
                        let htmlContent = '';
                        // Generate the HTML content
                        if(response.status == 'success'){
                            htmlContent = `
                                <div class="card">
                                    <div class="card-body row">
                                        <h5 class="text-center" style="color: rgb(58, 25, 207);"><i class="ri-record-circle-line align-middle font-size-22"></i>${response.message}</h5>
                                        <div class="col-md-6">
                                            <h3 class="card-title">Attendance Details</h3>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Email:</strong> <span style="color: rgb(58, 25, 207);">${response.credentials.email}</span></p>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Name:</strong> <span style="color: rgb(58, 25, 207);">${response.credentials.name}</span></p>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Date:</strong> <span style="color: rgb(58, 25, 207);">${response.credentials.month} ${response.credentials.day}, ${response.credentials.year}</span></p>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Time In:</strong> <span style="color: rgb(58, 25, 207);">${response.credentials.time_in}</span></p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                                            <img src="${imageUrl}/confirmed.png" alt="Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            `;
                        }else if(response.status == 'already'){
                            htmlContent = `
                                <div class="card">
                                    <div class="card-body row">
                                        <h5 class="text-center" style="color: rgb(58, 25, 207);"><i class="ri-record-circle-line align-middle font-size-22"></i>${response.message}</h5>
                                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                                            <img src="${imageUrl}/confirmed.png" alt="Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            `;
                        } else {
                            htmlContent = `
                            <div class="card">
                                <div class="card-body row">
                                    <h5 class="text-center" style="color: rgb(58, 25, 207);"><i class="ri-record-circle-line align-middle font-size-22"></i>${response.message}</h5>
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <img src="${imageUrl}/error.png" alt="Image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        `; 
                        }
                        $('#attendance-details').html(htmlContent);
    
                        setTimeout(async () => {
                            $('#attendance-details').empty();
                            startScanner(await availableCamera());
                        }, 5000);
                    } catch (error) {
                        // Handle error if needed
                        console.error('Failed to send data:', error);
                    }
                },
                (errorMessage) => {
                    // parse error, ignore it.
                    console.log(errorMessage);
                }
            );
            scannerIsRunning = true;
        } catch (err) {
            // Start failed, handle it.
            console.error(err);
        }
    }
    

    function stopScanner() {
        if (scannerIsRunning) {
            html5QrCode.stop().then(() => {
                scannerIsRunning = false;
            });
        }
    }

    (async function () {
        try {
            const camera = await availableCamera();
            console.log(camera);

            $("#attendance").on("show.bs.modal", function () {
                startScanner(camera);
            });

            $("#attendance").on("hidden.bs.modal", function () {
                stopScanner();
            });
        } catch (error) {
            console.error(error);
        }
    })();

    
});
