<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Add Animation */
    .modal-content {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {

        .modal-content {
            width: 100%;
        }
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .feedback-alert {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #003049;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        z-index: 9999;
    }

    /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>

<body>
    <div id="feedbackModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header" style="background-color: {{config('app.color')}}">
                <h5 class="modal-title text-white">Feedback</h5>
                <span id="feedbackClose" class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary mt-4">

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" id="feedbackForm">
                                @csrf

                                <div class="card-body">
                                    @if(Auth::user())
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="{{Auth::user()->email}}">

                                        <span id="emailError" class="text-danger small"></span>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <p class="text-bold">Rate Us</p>
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>

                                        </div>
                                    </div>
                                    <br><br>
                                    <span id="rateError" class="text-danger small"></span>

                                    <div id="loadingIndicator" style="display: none;">
                                        Loading...
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Comment" name="comment" rows="7">{{ old('comment') }}</textarea>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn text-white float-right" style="background-color: {{config('app.color')}}">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    let feedbackModal = document.getElementById("feedbackModal");
    let feedbackBtn = document.getElementById("feedbackBtn");

    feedbackBtn.onclick = function() {
        feedbackModal.style.display = "block";
    }

    $("#feedbackClose").click(function(e) {
        feedbackModal.style.display = "none";
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#feedbackForm').submit(function(event) {
        event.preventDefault();

        let formData = $(this).serialize();
        $('#loadingIndicator').show();

        $.ajax({
            url: action = "{{ route('feedback.store') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#loadingIndicator').hide();

                $('input[name="rate"]').prop('checked', false);
                $('textarea[name="comment"]').val('')

                showFeedbackAlert('Thank you for your feedback');

                setTimeout(function() {
                    feedbackModal.style.display = "none";
                    $('.wrapper').css('opacity', '1');
                    $('.middle').css('opacity', '1');
                }, 800);
            },
            error: function(xhr) {
                $('#loadingIndicator').hide();

                // Handle the error response
                $('.wrapper').css('opacity', '1');
                $('.middle').css('opacity', '0.1');

                let data = JSON.parse(xhr.responseText);

                let email = data.errors.email ? data.errors.email[0] : '';
                let rate = data.errors.rate ? data.errors.rate[0] : '';

                $('#emailError').html(email);
                $('#rateError').html(rate);
            }
        });
    });

    function showFeedbackAlert(message) {
        let alert = $('<div>', {
            class: 'feedback-alert',
            text: message
        });

        $('body').append(alert);

        setTimeout(function() {
            alert.remove();
        }, 5000);
    }
</script>