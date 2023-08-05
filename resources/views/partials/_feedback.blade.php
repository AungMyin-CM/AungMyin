<style>
    .feedback-modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding: 0;
        bottom: 10px;
        left: 90px;
        max-width: 400px;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0);
    }

    /* Add Slide Animation */
    .feedback-modal-content {
        -webkit-animation-name: slideInFromLeft;
        -webkit-animation-duration: 0.6s;
        animation-name: slideInFromLeft;
        animation-duration: 0.6s;
        margin: 0;
        display: block;
        background-color: #003049;
    }

    @-webkit-keyframes slideInFromLeft {
        from {
            -webkit-transform: translateX(-100%);
        }

        to {
            -webkit-transform: translateX(0);
        }
    }

    @keyframes slideInFromLeft {
        from {
            transform: translateX(-100%);
        }

        to {
            transform: translateX(0);
        }
    }

    @keyframes slideOutToLeft {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-100%);
        }
    }

    @media only screen and (max-width: 700px) {
        .feedback-modal-content {
            width: 100%;
        }
    }

    .feedback-card {
        width: 400px;
        background-color: #003049;
        color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .feedback-card .rate {
        /* Align the stars to the left */
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .feedback-card .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .feedback-card .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .feedback-card .rate:not(:checked)>label:before {
        content: "★ ";
    }

    .feedback-card .rate>input:checked~label {
        color: #ffc700;
    }

    .feedback-card .rate:not(:checked)>label:hover,
    .feedback-card .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .feedback-card .rate>input:checked+label:hover,
    .feedback-card .rate>input:checked+label:hover~label,
    .feedback-card .rate>input:checked~label:hover,
    .feedback-card .rate>input:checked~label:hover~label,
    .feedback-card .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .feedback-card textarea {
        width: 100%;
        margin-bottom: 10px;
        resize: none;
    }

    #message {
        margin-top: 20px;
        text-align: center;
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
    <div id="feedbackModal" class="feedback-modal">
        <div class="feedback-card feedback-modal-content">
            <h3 class="text-center">Rate Us</h3>
            <form method="post" id="feedbackForm">
                @csrf
                @if(Auth::user())
                <div class="form-group" style="display: none;">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="{{Auth::user()->email}}">

                    <span id="emailError" class="text-danger small"></span>
                </div>
                @endif
                <div class="rate">
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="1 star"></label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="2 stars"></label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="3 stars"></label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="4 stars"></label>
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="5 stars"></label>
                </div><br><br>
                <p id="rateError" class="text-danger small alert-msg"></p>

                <div class="form-group mt-2">
                    <textarea class="form-control" id="feedbackMessage" rows="4" name="comment" placeholder="Write your feedback here...">{{ old('comment') }}</textarea>
                </div>

                <button class="btn btn-success w-100" id="submitBtn">Submit Feedback</button>
                <div id="message"></div>
            </form>
        </div>
    </div>
</body>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $(document).ready(function() {
        let feedbackModal = $("#feedbackModal");
        let feedbackBtn = $("#feedbackBtn");

        feedbackBtn.click(function() {
            feedbackModal.show();
        });

        $(document).mouseup(function(event) {
            if (!feedbackModal.is(event.target) && feedbackModal.has(event.target).length === 0) {
                closeFeedbackModal();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#feedbackForm').submit(function(event) {
            event.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('feedback.store') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('input[name="rate"]').prop('checked', false);
                    $('textarea[name="comment"]').val('');

                    showFeedbackAlert('Thank you for your feedback');

                    closeFeedbackModal();

                    $('.wrapper').css('opacity', '1');
                    $('.middle').css('opacity', '1');
                },
                error: function(xhr) {
                    // Handle the error response
                    $('.wrapper').css('opacity', '1');
                    $('.middle').css('opacity', '0.1');

                    let data = JSON.parse(xhr.responseText);

                    let email = data.errors.email ? data.errors.email[0] : '';
                    let rate = data.errors.rate ? data.errors.rate[0] : '';

                    $('#emailError').html(email);
                    $('#rateError').html(rate);

                    $(".alert-msg").show().delay(4000).fadeOut();
                }
            });
        });

        function closeFeedbackModal() {
            feedbackModal.css({
                animationName: "slideOutToLeft",
                animationDuration: "0.6s"
            }).fadeOut(600, function() {
                feedbackModal.css({
                    animationName: "",
                    animationDuration: ""
                });
            });
        }

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
    });
</script>