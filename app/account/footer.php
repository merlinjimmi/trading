<style>
/* Mobile footer nav base */
.mobile-footer-nav {
  background-color: #fff; /* Light mode background */
}

.mobile-footer-nav .container a {
  flex: 1;
  font-size: 10px;
  margin: 0 4px;
  color: #6c757d;
  text-align: center;
  text-decoration: none;
  transition: color 0.3s ease;
}

.mobile-footer-nav .container a .footer-icon {
  font-size: 1.1rem;
  margin-bottom: 2px;
  display: block;
}

.mobile-footer-nav .container a .footer-label {
  display: block;
}

/* Active nav item */
.mobile-footer-nav .container a.active,
.mobile-footer-nav .container a.active .footer-icon,
.mobile-footer-nav .container a.active .footer-label {
  color: #28a745 !important; /* Green active color */
}

/* 🌙 Dark mode overrides */
body.dark .mobile-footer-nav {
  background-color: #000 !important; /* Pure black background */
}

body.dark .mobile-footer-nav .container a {
  color: #fff !important; /* White icons/labels in dark mode */
}

body.dark .mobile-footer-nav .container a .footer-icon,
body.dark .mobile-footer-nav .container a .footer-label {
  color: #fff !important;
}

body.dark .mobile-footer-nav .container a.active,
body.dark .mobile-footer-nav .container a.active .footer-icon,
body.dark .mobile-footer-nav .container a.active .footer-label {
  color: #28a745 !important; /* Keep green for active */
}
</style>


<!-- Desktop Footer -->
<footer class="d-none d-md-block mt-1 py-3 border-top" style="background: linear-gradient(179deg, #724fe5 6.25%);">
    <div class="container text-center text-white">
        <h6 class="mb-0">&copy; <?= date('Y') - 10 . ' - ' . date('Y') . ' ' . SITE_NAME; ?></h6>
    </div>
</footer>

<!-- Mobile Footer -->
<nav class="d-md-none navbar fixed-bottom shadow-lg border-top mobile-footer-nav">
    <div class="container d-flex justify-content-around py-1">
        <a href="./" class="text-center">
            <i class="fas fa-home footer-icon"></i><small class="footer-label">Home</small>
        </a>
        <a href="./market" class="text-center">
            <i class="fas fa-eye footer-icon"></i><small class="footer-label">Watchlist</small>
        </a>
        <a href="./trades" class="text-center">
            <i class="fas fa-chart-pie footer-icon"></i><small class="footer-label">Portfolio</small>
        </a>
        <a href="./traders" class="text-center">
            <i class="fas fa-search footer-icon"></i><small class="footer-label">Discover</small>
        </a>
        <a href="./deposit" class="text-center">
            <i class="fas fa-wallet footer-icon"></i><small class="footer-label">Wallet</small>
        </a>
    </div>
</nav>

<div class="modal fade" id="langmodal" tabindex="-1" aria-labelledby="langmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content text-center">
            <div class="modal-header justify-content-center">
                <h3 class=""><span class="fas fa-exclamation-circle"></span> information</h3>
                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class="modal-body py-4 my-3">
                <div class="gtranslate_wrapper"></div>
                <div id="message">
                    <div class="mt-2">
                        <button type='button' class='btn btn-md btn-outline-danger' data-mdb-dismiss='modal' aria-label='Close'>Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="../../assets/js/mdb.min.js"></script>
<script src="../../assets/js/switchtheme.js"></script>
<script src="../../assets/js/jquery-redirect.js"></script>
<script src="../../assets/js/tiny-slider.js"></script>
<script src="../../assets/js/toastr.js"></script>
<script src="https://cdn.gtranslate.net/widgets/v1.0.1/dropdown.js" defer></script>
<script>
    window.gtranslateSettings = {
        "default_language": "en",
        "wrapper_selector": ".gtranslate_wrapper"
    };

    const slimInstance = new mdb.Sidenav(document.getElementById('sidenav-1'));
    slimInstance.hide();

    const showpass = (pass, span) => {
        let password = document.getElementById(pass);
        if (password.type == 'password') {
            password.type = 'text';
            $('#' + span).html("<span class='fas fa-eye-slash'></span>");
        } else {
            password.type = 'password';
            $('#' + span).html("<span class='fas fa-eye'></span>");
        }
    }

    $("#switcher").click(function () {
        const ttt = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
        setTheme(ttt);
    });

    if (localStorage.getItem("hidebal") == "shown" || !localStorage.getItem("hidebal")) {
        $('#showBal11,#showBal13,#showBal131,#slashOnes,#slashTwos,#slashTwose,#showBal21,#showBal23,#showBal25').hide();
        $('#showBal1,#showBal12,#slashOne,#slashTwo,#slashTwoe,#showBal2,#showBal22,#showBal24').show();
    } else if (localStorage.getItem("hidebal") == "hidden") {
        $('#showBal11,#showBal13,#showBal131,#slashOne,#slashTwo,#slashTwoe,#showBal21,#showBal23,#showBal25').show();
        $('#showBal1,#showBal12,#showBal121,#slashOnes,#slashTwos,#slashTwose,#showBal2,#showBal22,#showBal24').hide();
    }

    function hideBal() {
        localStorage.setItem("hidebal", "hidden");
        $('#showBal11,#showBal13,#showBal131,#slashOne,#slashTwo,#slashTwoe,#showBal21,#showBal23,#showBal25').show();
        $('#showBal1,#showBal12,#showBal121,#slashOnes,#slashTwos,#slashTwose,#showBal2,#showBal22,#showBal24').hide();
    }

    function showBal() {
        localStorage.setItem("hidebal", "shown");
        $('#showBal11,#showBal13,#showBal131,#slashOne,#slashTwo,#slashTwoe,#showBal21,#showBal23,#showBal25').hide();
        $('#showBal1,#showBal12,#showBal121,#slashOnes,#slashTwos,#slashTwose,#showBal2,#showBal22,#showBal24').show();
    }

    $('#switchBtn').click(() => {
        let request = "changeType";
        let accts = 'demo';
        $.ajax({
            url: '../../ops/users',
            type: 'POST',
            data: { request, 'account': accts },
            success: function (data) {
                let response = $.parseJSON(data);
                toastr.info(response.message);
                if (response.status == "success") {
                    setTimeout('window.location.href = "./demo";', 2000);
                }
            },
            cache: false,
            error: function () {
                toastr.info("An error has occurred!!");
            }
        });
    });

    function redir(link, params) {
        $.redirect(link, params);
    }

   $(document).ready(function () {
    const path = window.location.pathname.toLowerCase();

    // Remove existing active classes
    $('.mobile-footer-nav .container a').removeClass('active');

    // Define route map with href and path match pattern
    const routeMap = [
        { href: './', match: /^\/app\/account\/?$/ },
        { href: './market', match: /^\/app\/account\/market/ },
        { href: './trades', match: /^\/app\/account\/trades/ },
        { href: './traders', match: /^\/app\/account\/traders/ },
        { href: './deposit', match: /^\/app\/account\/deposit/ }
    ];

    let matched = false;
    for (const route of routeMap) {
        if (route.match.test(path)) {
            $('.mobile-footer-nav .container a[href="' + route.href + '"]').addClass('active');
            matched = true;
            break;
        }
    }

    // Only fallback if path is the root (optional)
    if (!matched && /^\/(app\/account\/?)?$/.test(path)) {
        $('.mobile-footer-nav .container a[href="./"]').addClass('active');
    }

    // Responsive sidenav logic
    if (window.innerWidth <= 700) {
        slimInstance.hide();
        $("#sidenav-1").attr("data-mdb-mode", "over");
    } else {
        slimInstance.show();
        $("#sidenav-1").attr({
            "data-mdb-mode": "side",
            "data-mdb-close-on-esc": "false"
        });
    }
});


    


    window.addEventListener('resize', () => {
        if (window.innerWidth <= 700) {
            slimInstance.hide();
            $("#sidenav-1").attr("data-mdb-mode", "over");
        } else {
            slimInstance.show();
            $("#sidenav-1").attr({
                "data-mdb-mode": "side",
                "data-mdb-close-on-esc": "false"
            });
        }
    });
</script>

</html>
