<!doctype html>
<html lang="en">

<head>
    <!-- Sweet Alert-->
    <link href="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('header-links')

    <link rel="stylesheet" href="{{ asset('theming/theme.css') }}">
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
            @include('admin.body.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @yield('footer-script')
    {{-- available to all --}}
    <script src="{{ asset('html5-qrcodes/html5-qrcode.min.js') }}"></script>
    <script src="{{ asset('html5-qrcodes/scan.js') }}"></script>
    {{-- <script src="{{ asset('html5-qrcodes/timeout.js') }}"></script> --}}

    <!-- Sweet Alerts js -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    {{-- <script src="{{ asset('backend/assets/js/pages/sweet-alerts.init.js') }}"></script> --}}
    <script>
        // Get the CSRF token from a meta tag in your HTML
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const print = false;
        let currentUtterance = null; // Store the current utterance
        let task = ''
        const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
        recognition.continuous = true;
        $(document).ready(function() {

            //assistant clicked
            $(document).on('click', '.assistant', function() {
                stopSpeaking() //stop speaking
                startToSpeak(`${welcomeMessage()}`)
                    .then((f) => {
                        console.log(f)
                        recognition.start(); //start speech
                    }) //start speaking again

                swalTrigger() //open swal modal

            })

            //function for swal trigger
            const swalTrigger = () => {
                Swal.fire({
                    title: "MADTRACK ASSISTANT",
                    html: `<div>
                            <img src="/images/assistant.png" alt="Header Image" style="width: 40%; max-height: 100px;">
                        </div>
                        <div>
                            <label for="custom-input">You can edit your question below?</label>
                            <input type="text" id="custom-input" class="swal2-input" placeholder="Enter your queries">
                        </div>
                        `,
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel",
                    confirmButtonColor: "#0f9cf3",
                    cancelButtonColor: "#f32f53",
                    preConfirm: function() {
                        const ask = document.getElementById("custom-input").value;
                        if (!ask) {
                            Swal.showValidationMessage("Please enter your queries.");
                        }
                        return ask;
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        const question = result.value;
                        // Call the function with the desired text and csrfToken
                        makeNLPRequest(question, csrfToken)
                            .done(function(response) {
                                // Handle the NLP response from Laravel
                                console.log(
                                    response); // Modify this to handle the response as needed
                                startToSpeak(response.init)
                                    .then((finished) => {
                                        if (finished) {
                                            console.log(finished)
                                        } else {
                                            console.log('not finished')
                                        }
                                    })
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
                                        switch (response.action) {
                                            case 'attendance':
                                                // Trigger the click event to open the modal automatically
                                                $("#openModalAttendance").trigger(
                                                    "click");
                                                break;
                                            case 'available':
                                                // Redirect to the desired route
                                                window.location.href =
                                                    "{{ route('inventory.available.stocks') }}";
                                                break;
                                            case 'employee.present':
                                                // Redirect to the desired route
                                                window.location.href =
                                                    "{{ route('employee.table') }}";
                                                break;
                                            case 'print.products':
                                                // Redirect to the desired route
                                            case 'printing.all':
                                                console.log('ginagawa')
                                                // Redirect to the desired route
                                                window.location.href =
                                                    `{{ route('reports.create') }}?p=${response.report_id}`;
                                                // $(".buttons-print").trigger(
                                                //     "click");//trigger button automatically
                                               
                                                break;

                                            default:
                                                break;
                                        }



                                    }

                                })

                            })
                            .fail(function(error) {
                                // Handle errors
                                console.error(error);
                            });

                    } else {
                        recognition.stop();
                        startToSpeak('is there anything i can do for you, just click the icon on top. thank you!')
                            .then((finished) => {
                                if (finished) {
                                    console.log(finished)
                                } else {
                                    console.log('not finished')
                                }
                            })
                    }
                });
            }

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

            // recofnition
            recognition.onresult = function(event) {
                const currentIndex = event.resultIndex;
                const transcript = event.results[currentIndex][0].transcript;
                takeCommand(transcript.toLowerCase());
            };

            recognition.onspeechstart = () => {
                console.log("Speech has been detected");
            };

            recognition.onspeechend = () => {
                console.log("Speech has stopped being detected");
            };

            async function takeCommand(message) {
                try {
                    console.log(message);
                    //store the first task question
                    if (task === '' && !message.includes('yes')) {
                        task = message;
                    }

                    $('#popup-continuation-speech').removeClass('active');
                    if (message.includes('yes')) {
                        recognition.stop();

                        makeNLPRequest(task, csrfToken)
                            .done(function(response) {
                                // Handle the NLP response from Laravel
                                console.log(response); // Modify this to handle the response as needed
                                startToSpeak(response.init)
                                    .then((finished) => {
                                        if (finished) {
                                            console.log(finished)
                                            task = ''
                                        } else {
                                            console.log('not finished')
                                        }
                                    })
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
                                                $("#openModalAttendance").trigger(
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

                            })
                            .fail(function(error) {
                                // Handle errors
                                console.error(error);
                            });

                        console.log('its a yes');
                    } else if (message.includes('no')) {
                        // Handle 'no' case
                        startToSpeak(
                            'Oh, sorry! can speak again or manually type your question!'
                        );
                        $('#custom-input').val('')
                        task = ''
                    } else {
                        startToSpeak(message + '..right?');
                        $('#custom-input').val(message + '?')
                    }


                    // recognition.start(); // Resume recognition after responding
                } catch (error) {
                    console.error('An error occurred:', error);
                    // Handle the error as needed
                }
            }
        });
    </script>
</body>

</html>
