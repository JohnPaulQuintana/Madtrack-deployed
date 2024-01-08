<!doctype html>
<html lang="en">

<head>
    <!-- Sweet Alert-->
    <link href="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('header-links')

    <link rel="stylesheet" href="{{ asset('theming/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/face/face.css') }}">
    <link rel="stylesheet" href="https://sweetalert2.github.io/bootstrap4-buttons.css">
</head>

<body data-topbar="dark">

    @include('admin.loaderPage.preloader')

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('admin.body.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.body.sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('admin-dashboard')
            <!-- End Page-content -->


            @include('admin.attendance.attendance')
            @include('admin.attendance.day')

            @include('admin.modals.ai')
            @include('admin.body.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @yield('footer-script')
    {{-- available to all --}}
    {{-- <script src="{{ asset('html5-qrcodes/html5-qrcode.min.js') }}"></script>
    <script src="{{ asset('html5-qrcodes/scan.js') }}"></script> --}}
    {{-- <script src="{{ asset('html5-qrcodes/timeout.js') }}"></script> --}}

    <!-- Sweet Alerts js -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/face/face-api.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/assets/js/pages/sweet-alerts.init.js') }}"></script> --}}
    <script>
        // Get the CSRF token from a meta tag in your HTML
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const print = false;
        let currentUtterance = null; // Store the current utterance
        let task = ''
        const video = document.getElementById("video");
        $(document).ready(function() {

            //assistant clicked
            $(document).on('click', '.assistant', function() {
                const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
                recognition.continuous = true;
                let isListening = false;
                recognition.lang = 'en-US';
                stopSpeaking() //stop speaking
                startToSpeak(`${welcomeMessage()}`)
                    .then((f) => {
                        console.log(f)
                        recognition.start(); //start speech
                    }) //start speaking again

                $('#aiModal').modal('show')


                // recognition
                recognition.onresult = function(event) {
                    const currentIndex = event.resultIndex;
                    const transcript = event.results[currentIndex][0].transcript;

                    takeCommand(transcript.toLowerCase());

                };

                recognition.onspeechstart = () => {
                    console.log("Speech has been detected");
                    isListening = true;
                };

                recognition.onspeechend = () => {
                    console.log("Speech has stopped being detected");
                    isListening = false;
                };

                async function takeCommand(message) {
                    try {
                        console.log(message);
                        // List of valid commands
                        const validCommandsCancel = ['exit', 'close', 'stop', 'cancel'];
                        const validCommandsYes = ['yes', 'exactly', 'doit', 'yup', 'next',
                            'ofcourse', 'yep', 'do it', 'perfect'
                        ];
                        const validCommandsNo = ['no', 'nope', 'wrong', 'bobo',
                            'not exactly'
                        ];

                        if (validCommandsYes.some(commands => message.includes(commands))) {
                            recognition.stop();

                            makeNLPRequest(task, csrfToken)
                                .done(function(response) {
                                    // Handle the NLP response from Laravel
                                    console.log(
                                        response); // Modify this to handle the response as needed

                                    startToSpeak(response ? response.init :
                                            "Looks like i cant find the answer for that. rephrase your question."
                                        )
                                        .then((finished) => {
                                            if (finished) {
                                                if (response !== undefined || response !== '') {
                                                    recognition.start()
                                                }
                                                console.log(finished)
                                                task = ''
                                            } else {
                                                console.log('not finished')
                                            }
                                        })
                                    if (response !== undefined || response !== '') {
                                        let itemList = ''

                                        // Create a list of items using <li> tags
                                        itemList = response.answer.split('\n').map(item =>
                                            `<li>${item}</li>`).join('');

                                        Swal.fire({
                                            icon: "success",
                                            title: "Assistant Speaking...",
                                            html: `${itemList}!`,
                                            confirmButtonColor: "#0f9cf3",
                                            timer: 3000, // Time in milliseconds (e.g., 3000ms = 3 seconds)
                                            timerProgressBar: true, // Show a progress bar indicating the remaining time
                                            onClose: function() {
                                                console.log(response)
                                                switch (response.action) {
                                                    
                                                    case 'available':
                                                        console.log('ito yun')
                                                        // Redirect to the desired route
                                                        window.location.href =
                                                            "{{ route('inventory.available.stocks') }}";
                                                        break;
                                                    case 'employee.present':
                                                        // Redirect to the desired route
                                                        window.location.href =
                                                            "{{ route('employee.table') }}";
                                                        break;
                                                    case 'printing.all':
                                                        console.log('ginagawa')
                                                        // Redirect to the desired route
                                                        window.location.href =
                                                            `{{ route('reports.create') }}`;
                                                        // $(".buttons-print").trigger(
                                                        //     "click");//trigger button automatically
                                                        break;

                                                    default:
                                                        break;
                                                }



                                            }

                                        })
                                    }

                                })
                                .fail(function(error) {
                                    // Handle errors
                                    console.error(error);
                                });

                            console.log('its a yes');
                        } else if (validCommandsNo.some(command => message.includes(command))) {
                            // Handle 'no' case
                            startToSpeak(
                                    'Oh, sorry! can speak again or manually type your question!'
                                )
                                .then((f) => {
                                    if (f) {
                                        recognition.stop()
                                        setTimeout(() => {
                                            recognition.start()
                                        }, 200);
                                    }
                                })
                            $('#custom-input').val('')
                            task = ''
                        } else if (validCommandsCancel.some(command => message.includes(command))) {
                            $('.ai-query').val()
                            $('#aiModal').modal('hide')
                            startToSpeak('Have a nice day!')
                                .then((done) => {
                                    if (done) {
                                        // Close the Swal dialog
                                        Swal.close();
                                    }

                                })
                            recognition.stop();
                            stopSpeaking();
                        } else {
                            if (message !== null && message !== '') {
                                startToSpeak(message)
                                    .then((done) => {
                                        if (done) {
                                            $('#custom-input').val(message + '?')
                                            task = message
                                            recognition.stop()
                                            setTimeout(() => {
                                                recognition.start()
                                            }, 200);
                                        }
                                    })

                            }
                        }


                        // recognition.start(); // Resume recognition after responding
                    } catch (error) {
                        console.error('An error occurred:', error);
                        // Handle the error as needed
                    }
                }

                // close ai modal
                $('.ai-cancel').on('click', function() {
                    recognition.stop();
                    stopSpeaking()
                    $('.ai-query').val('')
                    $('#aiModal').modal('hide')
                })

                // send request
                $('.ai-submit').on('click', function() {
                    //check if not nut
                    var question = $('.ai-query').val()
                    if (question == '') {
                        stopSpeaking()
                        recognition.stop();
                        startToSpeak(
                                'Please Ask a question before clicking the submit button, Thank you!'
                                )
                            .then((done) => {
                                if (done) {
                                    // Close the Swal dialog
                                    recognition.start();
                                } else {
                                    stopSpeaking()
                                }

                            })
                    } else {
                        makeNLPRequest(question, csrfToken)
                            .done((response) => {
                                console.log(response)
                                startToSpeak(response ? response.init :
                                            "Looks like i cant find the answer for that. rephrase your question."
                                        )
                                        .then((finished) => {
                                            if (finished) {
                                                if (response !== undefined || response !== '') {
                                                    console.log('ginagawa')
                                                    recognition.start()
                                                }
                                                console.log(finished)
                                                task = ''
                                            } else {
                                                recognition.stop()
                                                console.log('not finished')
                                            }
                                        })
                                    if (response !== undefined || response !== '') {
                                        let itemList = ''

                                        // Create a list of items using <li> tags
                                        itemList = response.answer.split('\n').map(item =>
                                            `<li>${item}</li>`).join('');

                                        Swal.fire({
                                            icon: "success",
                                            title: "Assistant Speaking...",
                                            html: `${itemList}!`,
                                            confirmButtonColor: "#0f9cf3",
                                            timer: 3000, // Time in milliseconds (e.g., 3000ms = 3 seconds)
                                            timerProgressBar: true, // Show a progress bar indicating the remaining time
                                            onClose: function() {
                                                console.log(response)
                                                switch (response.action) {
                                                    case 'attendance':
                                                        // Trigger the click event to open the modal automatically
                                                        $("#openModalAttendance")
                                                            .trigger(
                                                                "click");
                                                        break;
                                                    case 'available':
                                                        console.log('ito yun')
                                                        // Redirect to the desired route
                                                        window.location.href =
                                                            "{{ route('inventory.available.stocks') }}";
                                                        break;
                                                    case 'employee.present':
                                                        // Redirect to the desired route
                                                        window.location.href =
                                                            "{{ route('employee.table') }}";
                                                        break;
                                                    case 'printing.all':
                                                        console.log('ginagawa')
                                                        // Redirect to the desired route
                                                        window.location.href =
                                                            `{{ route('reports.create') }}`;
                                                        // $(".buttons-print").trigger(
                                                        //     "click");//trigger button automatically
                                                        break;

                                                    default:
                                                        break;
                                                }



                                            }

                                        })
                                    }
                            })
                            .fail((err) => {
                                console.log(err)
                            })
                    }
                })
            })




            //function generate random welcome message
            const welcomeMessage = () => {

                const wm = [
                    'Speak Recognition Initialized! How can I assist you today?',
                    'Speak Recognition Initialized! What can I do for you?',
                    'Welcome! How may I help you?',
                    'Greetings! What can I assist you with?',
                    'Hello there! How can I be of service?',
                    'Good day! How may I be of assistance?',
                    'Hi, how can I assist you today?',
                    'Hello! What do you need help with?',
                    'Welcome! How can I make your day better?',
                    'Greetings! How may I be of service today?',
                ];

                return wm[Math.floor(Math.random() * wm.length)]
            }

            // make a request to the ai
            function makeNLPRequest(text, csrfToken) {
                return $.ajax({
                    method: 'POST',
                    url: '/nlp',
                    data: JSON.stringify({
                        text: text
                    }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            }

            // Function to stop the current speech synthesis
            const stopSpeaking = () => {
                if (currentUtterance) {
                    speechSynthesis.cancel(); // Cancel the current utterance
                    currentUtterance = null; // Clear the current utterance reference
                }
            };
            // speak
            const startToSpeak = async (sentence) => {
                // Stop any ongoing speech before starting a new one
                stopSpeaking();
                if ('speechSynthesis' in window) {
                    return new Promise((resolve, reject) => {
                        const utterance = new SpeechSynthesisUtterance();
                        utterance.volume = 1;
                        utterance.rate = 0.9;
                        utterance.pitch = 1;
                        utterance.text = sentence;

                        // Store the current utterance
                        currentUtterance = utterance;
                        var index = 1;
                        for (index; index < window.speechSynthesis.getVoices().length; index++) {
                            if (window.speechSynthesis.getVoices()[index].voiceURI.search(
                                    'Zeera') != -1) {
                                utterance.voice = window.speechSynthesis.getVoices()[index];
                            }
                        }
                        utterance.voice = window.speechSynthesis.getVoices()[index];

                        setTimeout(() => {
                            utterance.voice = window.speechSynthesis.getVoices()[1];
                        }, 1000);

                        utterance.addEventListener('end', () => {
                            console.log('Speech finished');
                            currentUtterance =
                                null; // Clear the current utterance reference when speech finishes
                            resolve(true); // Resolve the Promise when speech finishes
                        });

                        // start talked
                        setTimeout(() => {
                            speechSynthesis.speak(utterance);
                        }, 1000);
                    });
                } else {
                    console.log('Speech synthesis not supported in this browser');
                    return false; // Return false if speech synthesis is not supported
                }
            };



        });

        // Function to stop the current speech synthesis
        const stopSpeaking = () => {
            if (currentUtterance) {
                speechSynthesis.cancel(); // Cancel the current utterance
                currentUtterance = null; // Clear the current utterance reference
            }
        };
        // speak
        const startToSpeak = async (sentence) => {
            // Stop any ongoing speech before starting a new one
            stopSpeaking();
            if ('speechSynthesis' in window) {
                return new Promise((resolve, reject) => {
                    const utterance = new SpeechSynthesisUtterance();
                    utterance.volume = 1;
                    utterance.rate = 0.9;
                    utterance.pitch = 1;
                    utterance.text = sentence;

                    // Store the current utterance
                    currentUtterance = utterance;
                    var index = 1;
                    for (index; index < window.speechSynthesis.getVoices().length; index++) {
                        if (window.speechSynthesis.getVoices()[index].voiceURI.search(
                                'Zeera') != -1) {
                            utterance.voice = window.speechSynthesis.getVoices()[index];
                        }
                    }
                    utterance.voice = window.speechSynthesis.getVoices()[index];

                    setTimeout(() => {
                        utterance.voice = window.speechSynthesis.getVoices()[1];
                    }, 1000);

                    utterance.addEventListener('end', () => {
                        console.log('Speech finished');
                        currentUtterance =
                            null; // Clear the current utterance reference when speech finishes
                        resolve(true); // Resolve the Promise when speech finishes
                    });

                    // start talked
                    setTimeout(() => {
                        speechSynthesis.speak(utterance);
                    }, 1000);
                });
            } else {
                console.log('Speech synthesis not supported in this browser');
                return false; // Return false if speech synthesis is not supported
            }
        };

        Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri("{{ asset('backend/face/models') }}"),
            faceapi.nets.faceRecognitionNet.loadFromUri("{{ asset('backend/face/models') }}"),
            faceapi.nets.faceLandmark68Net.loadFromUri("{{ asset('backend/face/models') }}"),
        ]).then(startWebcam);

        function startWebcam() {
            navigator.mediaDevices
                .getUserMedia({
                    video: true,
                    audio: false,
                })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        async function getLabeledFaceDescriptions(labels) {
            return Promise.all(
                labels.map(async (label) => {
                    const descriptions = [];
                    let i = 1;

                    while (i < 2) {
                        try {
                            const img = await faceapi.fetchImage(
                                `{{ asset('backend/face/labels/${label}/${i}.jpg') }}`);
                            const detections = await faceapi
                                .detectSingleFace(img)
                                .withFaceLandmarks()
                                .withFaceDescriptor();

                            // If no error occurred, but no face was detected, skip to the next iteration
                            if (!detections) {
                                continue;
                            }

                            descriptions.push(detections.descriptor);
                            i++;
                        } catch (error) {
                            // Skip the iteration if the error is a "not found" error
                            if (error instanceof TypeError && error.message.includes(
                                    'Not Found')) {
                                continue;
                            } else {
                                // Break the loop for any other error
                                break;
                            }
                        }
                    }

                    return new faceapi.LabeledFaceDescriptors(label, descriptions);
                })
            );
        }



        video.addEventListener("loadeddata", async () => {
            getImageName().then(async (result) => {
                // console.log('Result:', result);
                await getLabeledFaceDescriptions(result.subFolder).then((
                    labeledFaceDescriptors) => {
                    const faceMatcher = new faceapi.FaceMatcher(
                        labeledFaceDescriptors);

                    const canvas = faceapi.createCanvasFromMedia(video);
                    document.body.append(canvas);

                    const displaySize = {
                        width: video.width,
                        height: video.height
                    };
                    faceapi.matchDimensions(canvas, displaySize);

                    let recognitionResults = [];
                    let recognitionStartTime = null;

                    setInterval(async () => {
                        const startTime = Date
                            .now(); // Record the start time for this iteration

                        const detections = await faceapi
                            .detectAllFaces(video)
                            .withFaceLandmarks()
                            .withFaceDescriptors();

                        const endTime = Date
                            .now(); // Record the end time for this iteration
                        const faceRecognitionTime = endTime -
                            startTime; // Calculate the face recognition time

                        const resizedDetections = faceapi
                            .resizeResults(
                                detections,
                                displaySize);

                        canvas.getContext("2d").clearRect(0, 0,
                            canvas
                            .width, canvas
                            .height);

                        const results = resizedDetections.map((
                            d) => {
                            return faceMatcher
                                .findBestMatch(d
                                    .descriptor);
                        });

                        const currentResult = results[0] ? results[
                                0]
                            ._label :
                            "unknown";

                        const box = resizedDetections[0] ?
                            resizedDetections[0]
                            .detection.box : null;
                        const drawBox = box ? new faceapi.draw
                            .DrawBox(
                                box, {
                                    label: currentResult
                                }) : null;

                        if (drawBox) {
                            // drawBox.style.display = 'none';
                            // drawBox.draw(canvas);
                        }

                        if (currentResult !== "unknown") {
                            recognitionResults.push(currentResult);

                            // Check if there are enough results for a stable recognition
                            if (recognitionResults.length >= 5) {
                                // Calculate the moving average
                                const movingAverage =
                                    recognitionResults
                                    .slice(-5)
                                    .reduce((sum, label) => sum + (
                                            label ===
                                            currentResult ? 1 : 0),
                                        0) / 5;

                                // Check if the moving average is high enough
                                if (movingAverage >= 0.8) {
                                    const currentTime = new Date();
                                    const options = {
                                        hour: "numeric",
                                        minute: "numeric",
                                        hour12: true
                                    };
                                    const formattedTime = new Intl
                                        .DateTimeFormat(
                                            "en-US", options)
                                        .format(
                                            currentTime);
                                    console.log(
                                        `${currentResult} Time: ${formattedTime}`
                                    )

                                    // Capture and save the image
                                    captureImage(video,
                                        currentResult,
                                        formattedTime);



                                    // Reset the recognition results array and timer
                                    recognitionResults = [];
                                    recognitionStartTime = null;
                                }
                            }
                        } else {
                            // Reset the recognition results array and timer if the current result is unknown
                            recognitionResults = [];
                            recognitionStartTime = null;
                        }
                    }, 500);
                });
            });
            // Example usage: were getting this into the database
            // const labels = ["Allen Dale", "John Paul", "Mark Louie"];


        });

        // Function to capture and save the image
        function captureImage(video, label, formattedTime) {
            const canvas = faceapi.createCanvasFromMedia(video);
            const context = canvas.getContext("2d");
            context.drawImage(video, 0, 0, video.width, video.height);

            const dataURL = canvas.toDataURL('image/jpeg');
            // Extract the base64 image data (remove the data URL prefix)
            const base64Image = dataURL.replace(/^data:image\/(png|jpg);base64,/, '');

            saveImageToLocal(base64Image, label, formattedTime)
            // const link = document.createElement('a');
            // link.href = dataURL;
            // link.download = `${label}_${formattedTime}.jpg`;
            // link.click();
        }

        async function saveImageToLocal(dataURL, label, formattedTime) {
            // Convert data URL to Blob
            const blob = await dataURLtoBlob(dataURL);
            // Create FormData and append the Blob along with other data
            const formData = new FormData();
            formData.append('image', blob, 'image.jpg');
            formData.append('label', label);
            formData.append('formattedTime', formattedTime);

            try {
                const response = await fetch('/store-attendance', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                });

                if (response.ok) {
                    const responseData = await response.json();
                    if (responseData.action !== null && responseData.action !== '') {
                        // take_snapshot()
                        startToSpeak(
                                `${label} ${responseData.action}: ${formattedTime}`
                            )
                            .then((f) => {
                                console.log(
                                    currentResult,
                                    "Recognition Time:",
                                    faceRecognitionTime,
                                    "ms");
                            }) //
                        console.log('Image saved:', responseData);
                    }

                } else {
                    console.error('Failed to save image:', response.statusText);
                }
            } catch (error) {
                console.error('Error saving image:', error);
            }
        }

        // Function to convert data URL to Blob
        async function dataURLtoBlob(dataURL) {
            return new Promise((resolve) => {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', dataURL);
                xhr.responseType = 'blob';
                xhr.onload = () => {
                    resolve(xhr.response);
                };
                xhr.send();
            });
        }

        //get the folder name
        async function getImageName() {
            return new Promise(async (resolve) => {
                const formDataLabels = new FormData();

                try {
                    const response = await fetch('/get-filename', {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                    });

                    if (response.ok) {
                        const responseData = await response.json();
                        // console.log('Image name:', responseData);
                        resolve(responseData); // Resolve with the response data
                    } else {
                        console.error('Failed to get image name:', response.statusText);
                        resolve(
                            null); // Resolve with a default value or handle the error as needed
                    }
                } catch (error) {
                    console.error('Error while fetching image name:', error);
                    resolve(null); // Resolve with a default value or handle the error as needed
                }
            });
        }
    </script>
</body>

</html>
