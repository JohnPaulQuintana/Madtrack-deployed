// Your jQuery code to open the modal
$(document).ready(function () {


    const html5QrCode2 = new Html5Qrcode(/* element id */ "reader-out");
    let scannerIsRunning2 = false;

    // This method will trigger user permissions
    const availableCamera2 = () => {
        return Html5Qrcode.getCameras()
            .then((devices) => {
                /**
                 * devices would be an array of objects of type:
                 * { id: "id", label: "label" }
                 */
                if (devices && devices.length) {
                    // i want to return only the first one camera
                    var availableCamera2 = devices[0];
                    return availableCamera2;
                }
            })
            .catch((err) => {
                // handle err
                throw err; // Re-throw the error to be caught later
            });
    };

    async function startScanner2(camera) {
        try {
            await html5QrCode2.start(
                camera.id,
                {
                    fps: 20,
                    qrbox: { width: 250, height: 250 },
                },
                async (decodedText, decodedResult) => {
                    stopScanner2();
                    const data2 = {};
                    const fields2 = decodedResult.decodedText.split(", ");
                    fields2.forEach((field) => {
                        const [key, value] = field.split(": ");
                        data2[key] = value;
                    });
    
                    console.log(data2);
                    
                    try {
                        const response2 = await $.ajax({
                            url: '/time-out',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify(data2),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                        });
                        // Construct the image URL based on the image path
                        const imagePath2 = '/images'; // Replace this with the actual image path
                        const imageUrl2 = window.location.origin + imagePath2;
                        let htmlContent = '';
                        // Generate the HTML content
                        if(response2.status == 'success'){
                            htmlContent = `
                                <div class="card">
                                    <div class="card-body row">
                                        <h5 class="text-center" style="color: rgb(58, 25, 207);"><i class="ri-record-circle-line align-middle font-size-22"></i>${response2.message}</h5>
                                        <div class="col-md-6">
                                            <h3 class="card-title">Attendance Details</h3>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Email:</strong> <span style="color: rgb(58, 25, 207);">${response2.credentials.email}</span></p>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Name:</strong> <span style="color: rgb(58, 25, 207);">${response2.credentials.name}</span></p>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Date:</strong> <span style="color: rgb(58, 25, 207);">${response2.credentials.month} ${response2.credentials.day}, ${response2.credentials.year}</span></p>
                                            <p><i class="ri-record-circle-line align-middle font-size-16" style="color: rgb(58, 25, 207);"></i><strong> Time In:</strong> <span style="color: rgb(58, 25, 207);">${response2.credentials.time_in}</span></p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                                            <img src="${imageUrl2}/confirmed.png" alt="Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            `;
                        }else if(response2.status == 'already'){
                            htmlContent = `
                                <div class="card">
                                    <div class="card-body row">
                                        <h5 class="text-center" style="color: rgb(58, 25, 207);"><i class="ri-record-circle-line align-middle font-size-22"></i>${response2.message}</h5>
                                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                                            <img src="${imageUrl2}/confirmed.png" alt="Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            `;
                        } else {
                            htmlContent = `
                            <div class="card">
                                <div class="card-body row">
                                    <h5 class="text-center" style="color: rgb(58, 25, 207);"><i class="ri-record-circle-line align-middle font-size-22"></i>${response2.message}</h5>
                                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                                        <img src="${imageUrl2}/error.png" alt="Image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        `; 
                        }
                        $('#attendance-details-out').html(htmlContent);
    
                        setTimeout(async () => {
                            $('#attendance-details-out').empty();
                            startScanner2(await availableCamera2());
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
            scannerIsRunning2 = true;
        } catch (err) {
            // Start failed, handle it.
            console.log(err);
            const camera = await availableCamera2();
            startScanner2(camera);
        }
    }
    

    function stopScanner2() {
        if (scannerIsRunning2) {
            html5QrCode2.stop().then(() => {
                scannerIsRunning2 = false;
            });
        }
    }

    (async function () {
        try {
            const camera2 = await availableCamera2();
            console.log(camera2);

            $("#attendance").on("show.bs.modal", function () {
                startScanner2(camera2);
            });

            $("#attendance").on("hidden.bs.modal", function () {
                stopScanner2();
            });
        } catch (error) {
            console.error(error);
        }
    })();

    
});
