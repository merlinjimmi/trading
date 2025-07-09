<?php include('header.php'); ?>

<title>Markets - <?= SITE_NAME; ?></title>
<main class="my-5 pt-5" id="content" style="min-height:100vh;">
    <div class="container pt-5">
        <div class="col-md-12 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 market-title">
                    <i class="fas fa-star text-warning"></i> My Watchlist
                </h2>
                <button class="btn btn-success rounded-pill shadow-sm px-4" id="addAssetBtn">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
            <ul class="nav nav-pills mb-3 gap-2" id="watchlistTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill" id="stocks-tab" data-bs-toggle="pill" data-bs-target="#stocks-pane" type="button" role="tab" aria-controls="stocks-pane" aria-selected="true">Stocks</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill" id="crypto-tab" data-bs-toggle="pill" data-bs-target="#crypto-pane" type="button" role="tab" aria-controls="crypto-pane" aria-selected="false">Crypto</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill" id="forex-tab" data-bs-toggle="pill" data-bs-target="#forex-pane" type="button" role="tab" aria-controls="forex-pane" aria-selected="false">Forex</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill" id="index-tab" data-bs-toggle="pill" data-bs-target="#index-pane" type="button" role="tab" aria-controls="index-pane" aria-selected="false">Index</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill" id="etf-tab" data-bs-toggle="pill" data-bs-target="#etf-pane" type="button" role="tab" aria-controls="etf-pane" aria-selected="false">ETF</button>
                </li>
            </ul>
            <div class="tab-content" id="watchlistTabsContent">
                <div class="tab-pane fade show active" id="stocks-pane" role="tabpanel" aria-labelledby="stocks-tab">
                    <div id="stocks"></div>
                </div>
                <div class="tab-pane fade" id="crypto-pane" role="tabpanel" aria-labelledby="crypto-tab">
                    <div id="crypto"></div>
                </div>
                <div class="tab-pane fade" id="forex-pane" role="tabpanel" aria-labelledby="forex-tab">
                    <div id="forex"></div>
                </div>
                <div class="tab-pane fade" id="index-pane" role="tabpanel" aria-labelledby="index-tab">
                    <div id="index"></div>
                </div>
                <div class="tab-pane fade" id="etf-pane" role="tabpanel" aria-labelledby="etf-tab">
                    <div id="etf"></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>

<style>
/* -------- LIGHT MODE (default) -------- */
body, #content { background: #fff !important; color: #23263B; }
.market-title { color: #23263B; }
.market-list {
    background: #fff;
    border-radius: 1.1rem;
    overflow: hidden;
    margin-bottom: 2rem;
    box-shadow: 0 2px 16px 0 #10101811;
}
.market-list-header {
    color: #23263B;
    font-weight: 300;
    font-size: 1.1rem;
    padding: 1rem 1.3rem 0.3rem 1.3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ededf2;
    background: #fff;
}
.market-list-row {
    display: flex;
    align-items: center;
    padding: 1rem 1.3rem;
    border-bottom: 1px solid #f3f3f6;
    transition: background 0.12s;
    gap: 12px;
    background: #fff;
}
.market-list-row:last-child { border-bottom: none; }
.market-logo {
    background: #f3f3f6;
    border-radius: 12px;
    width: 38px; height: 38px;
    object-fit: cover;
}
.market-symbol {
    font-size: 1.01rem;
    font-weight: 300;
    color: #23263B;
}
.market-name {
    font-size: 0.86rem;
    color: #6F7A85;
}
.market-short, .market-buy {
    min-width: 74px;
    background: #EAF7F0;
    color: #23263B;
    border-radius: 1rem;
    display: inline-block;
    text-align: center;
    font-size: 0.7rem;
    padding: 0.45rem 0;
    margin: 0 0.1rem;
    font-weight: 300;
}
.market-buy.active {
    background: #15CE80;
    color: #fff;
}
.market-short.inactive, .market-buy.inactive {
    background: #f3f3f6 !important;
    color: #6C757D !important;
}

.markets-list { margin: 12px 0 0 0; }
.market-row {
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 13px;
    margin: 8px 12px;
    padding: 12px 10px;
    gap: 13px;
    box-shadow: 0 1px 8px 0 #23263B11;
    transition: background 0.08s;
}
.market-icon {
    width: 38px; height: 38px; border-radius: 8px; object-fit: cover;
    background: #f3f3f6;
}
.market-main { flex: 1; min-width: 0; }
.market-symbol { font-size: 0.8rem; font-weight: 300; color: #23263B; line-height: 1.2; }
.market-name { font-size: 0.72rem; color: #6F7A85; line-height: 1.15; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px; }
.market-spark { width: 60px; height: 28px; margin: 0 12px; display: flex; align-items: center; justify-content: center; }
.market-info { display: flex; flex-direction: column; align-items: flex-end; min-width: 80px; }
.market-price { font-size: 0.7rem; font-weight: 300; color: #13b76a; }
.market-price.down { color: #FF445A; }
.market-change { font-size: 0.5rem; font-weight: 500; color: #13b76a; margin-top: 1px; }
.market-change.down { color: #FF445A; }

.market-percent-up { color: #13b76a; font-weight: 300; }
.market-percent-down { color: #FF445A; font-weight: 300; }
.market-percent-zero { color: #AEB8C0; font-weight: 300; }
.market-add-btn {
    background: #15CE80;
    padding: 0.35rem 1.2rem;
    border-radius: 1.5rem;
    color: #fff;
    font-weight: 300;
    border: none;
    margin-left: 0.7rem;
    font-size: 1.04rem;
    transition: background 0.12s;
}
.market-add-btn:hover { background: #13b76a; }
@media (max-width: 600px) {
    .market-list-header, .market-list-row { padding: 0.7rem 0.5rem; gap: 6px; }
    .market-symbol { font-size: 0.95rem; }
    .market-short, .market-buy { min-width: 54px; font-size: 0.98rem; padding: 0.38rem 0; }
}
#watchlistTabs { flex-wrap: wrap; gap: 0.2rem !important; margin-bottom: 1.3rem; }
#watchlistTabs .nav-link { padding: 0.4rem 0.95rem !important; font-size: 0.97rem !important; border-radius: 1.2rem !important; min-width: 70px; text-align: center; margin-bottom: 0 !important; background: #f3f3f6; color: #23263B; }
#watchlistTabs .nav-link.active, #watchlistTabs .nav-link:active { background: #15CE80 !important; color: #fff !important;}
@media (max-width: 600px) {
  #watchlistTabs .nav-link { font-size: 0.6rem !important; padding: 0.35rem 0.6rem !important; min-width: 60px; }
}

/* -------- DARK MODE -------- */
.dark-mode body, 
.dark-mode #content {
    background: #181A20 !important;
    color: #fff !important;
}
.dark-mode .market-title { color: #fff !important; }
.dark-mode .market-list,
.dark-mode .market-list-header,
.dark-mode .market-list-row,
.dark-mode .market-logo,
.dark-mode .market-row,
.dark-mode .market-icon {
    background: #23263B !important;
    color: #fff !important;
}
.dark-mode .market-list-header,
.dark-mode .market-symbol,
.dark-mode .market-price,
.dark-mode .market-change,
.dark-mode .market-main,
.dark-mode .market-info {
    color: #fff !important;
}
.dark-mode .market-name { color: #AEB8C0 !important; }
.dark-mode .market-price.down, 
.dark-mode .market-change.down { color: #FF445A !important; }
.dark-mode .market-price, 
.dark-mode .market-change { color: #18FF99 !important; }
.dark-mode #watchlistTabs .nav-link {
    background: #23263B !important;
    color: #fff !important;
}
.dark-mode #watchlistTabs .nav-link.active, 
.dark-mode #watchlistTabs .nav-link:active {
    background: #15CE80 !important;
    color: #fff !important;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../assets/js/assets.js"></script>
<script>
function redir(page, params) {
    var url = page + ".php";
    if (params && typeof params === 'object') {
        var query = Object.keys(params).map(function(k){
            return encodeURIComponent(k) + "=" + encodeURIComponent(params[k]);
        }).join('&');
        url += "?" + query;
    }
    window.location.href = url;
}

$(document).ready(function() {
    getSeperate();

    $('#addAssetBtn').on('click', function() {
        alert('Feature coming soon!');
    });

    // Ensure theme is set on initial load and always matches switcher
    if (typeof setTheme === 'function') {
        let theme = localStorage.getItem('theme');
        if (!theme) {
            // Default to dark mode for first visit, change to 'light' if you prefer
            theme = 'dark';
            localStorage.setItem('theme', theme);
        }
        setTheme(theme);
    }
});
</script>