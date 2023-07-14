<body>
    <div class="position-fixed p-2" style="z-index: 1; right: 0; bottom: 0;">
        <div id="toast" class="alert" style="background-color: {{config('app.color')}}; padding: 5px 10px !important;">
            <div class="text-white">
                {{ Session::get('success') }}
                <button type="button" class="btn" style="color: #f1f1f1; font-weight: bold;">
                    <span id="close-btn">&times;</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Alert Box
        let toast = document.getElementById('toast');
        let closeBtn = document.getElementById('close-btn');

        setInterval(function() {
            $("#toast").fadeOut();
        }, 5000);

        closeBtn.onclick = function() {
            toast.style.display = "none";
        }
    </script>
</body>