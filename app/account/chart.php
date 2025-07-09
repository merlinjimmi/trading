<?php
include 'header.php';
$price = 0;
$market = "";
$symbol = "";
if (isset($_GET) && isset($_GET['symbol'])) {
    extract($_GET);
    $price = 0.00;
} else {
    $price = 0;
    $market = "stock";
    $symbol = "AAPL";
}
?>
<title><?= ucfirst($symbol); ?> | Trading Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
    background: #f8fafc !important;
    color: #10182b !important;
    font-family: 'Inter', 'Segoe UI', 'Roboto', Arial, sans-serif;
}
.main-container {
    max-width: 700px;
    margin: 2.5rem auto 0 auto;
    padding-bottom: 4rem;
}
.asset-summary-box {
    background: #fff;
    border-radius: 1.8rem;
    box-shadow: 0 4px 18px 0 rgba(24,29,37,.11);
    padding: 2rem 1.6rem 1.2rem 1.6rem;
    margin-bottom: 2.2rem;
    position: relative;
}
.asset-summary-top {
    display: flex;
    align-items: center;
    gap: 1.1rem;
    margin-bottom: 1.2rem;
}
.asset-logo-lg {
    width: 44px;
    height: 44px;
    border-radius: 11px;
    background: #fff;
    border: 1.5px solid #e3e4e5;
    display: flex;
    align-items: center;
    justify-content: center;
}
.asset-meta-lg {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.asset-symbol-lg {
    font-size: 1.2rem;
    font-weight: 600;
    color: #24292f;
    letter-spacing: 1px;
    margin-bottom: 0.09rem;
}
.asset-name-lg {
    font-size: 0.99rem;
    color: #b0b6c7;
    font-weight: 400;
}
.asset-status-lg {
    font-size: .93rem;
    color: #47e2a0;
    margin-top: .1rem;
    font-weight: 400;
}
.asset-price-row {
    display: flex;
    align-items: flex-end;
    gap: 1.2rem;
    margin-bottom: 1.0rem;
}
.asset-price-main {
    font-size: 2.15rem;
    font-weight: 700;
    color: #23262f;
    letter-spacing: 1px;
    line-height: 1.1;
}
.asset-price-changes {
    display: flex;
    flex-direction: column;
    gap: 0.1rem;
}
.asset-price-abs {
    font-size: 1.01rem;
    color: #ff4e5b;
    font-weight: 500;
}
.asset-price-pct {
    font-size: .92rem;
    color: #ff4e5b;
    font-weight: 500;
}
.asset-price-positive .asset-price-abs,
.asset-price-positive .asset-price-pct { color: #47e2a0; }
.asset-market-caption {
    font-size: .92rem;
    color: #b0b6c7;
    margin-bottom: 0.7rem;
    font-weight: 400;
}
.asset-tabs {
    display: flex;
    gap: 1.5rem;
    border-bottom: 2px solid #eaeaea;
    margin: 1.4rem 0 1.3rem 0;
}
.asset-tab {
    font-size: 1.05rem;
    color: #8b92a5;
    padding-bottom: .55rem;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    font-weight: 500;
    transition: color .18s, border .18s;
    background: none;
    outline: none;
}
.asset-tab.active {
    color: #23262f;
    border-bottom: 2px solid #47e2a0;
    font-weight: 600;
}
.asset-tab-content {
    margin: 1.2rem 0 0 0;
    padding: 0 0.3rem 1.1rem 0.3rem;
    min-height: 120px;
}
.asset-tab-content .loader {
    text-align: center;
    color: #a4a9b6;
    font-size: 1.17rem;
    padding: 2.2rem 0;
}
.asset-chart-area {
    width: 100%;
    min-height: 200px;
    background: #f5f7fa;
    border-radius: 1.2rem;
    margin-bottom: 1.2rem;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
.asset-stats-row {
    display: flex;
    gap: 2rem;
    margin: 1.2rem 0 0 0;
    flex-wrap: wrap;
}
.asset-stat {
    color: #8c92a4;
    font-size: .98rem;
    display: flex;
    align-items: center;
    gap: .6rem;
}
.asset-stat .stat-label {
    font-weight: 500;
    color: #23262f;
}

/* Floating Trade Button */
.fab-trade-btn {
    position: fixed;
    right: 18px;
    bottom: 82px;
    z-index: 1100;
    background: #47e2a0;
    color: #fff;
    border-radius: 50px;
    box-shadow: 0 3px 24px 0 #47e2a055;
    font-size: .99rem;
    font-weight: 600;
    padding: .7rem 2.1rem .7rem 2.1rem;
    border: none;
    outline: none;
    cursor: pointer;
    display: flex;
    gap: 0.5rem;
    align-items: center;
    transition: background .18s, box-shadow .18s;
}
.fab-trade-btn:hover { background: #29c584; }
.fab-trade-btn .fa-arrow-right-arrow-left { font-size: 1.1rem; }
@media (max-width: 600px) {
    .fab-trade-btn { right: 8px; bottom: 65px; padding: .65rem 1.27rem .65rem 1.27rem; font-size: .97rem; }
}

/* --- Alvoro Modal Form --- */
#modalOverlay {
    position: fixed;
    z-index: 2100;
    inset: 0;
    background: rgba(30,32,38,0.29);
    display: none;
    align-items: flex-end;
    justify-content: center;
}
#modalOverlay.active { display: flex; }
.alvoro-form-modal {
    background: #fff;
    color: #23262f;
    border-radius: 1.2rem 1.2rem 0 0;
    box-shadow: 0 -2px 32px 0 rgba(24,29,37,.19);
    width: 100vw;
    max-width: 430px;
    margin: 0 auto;
    padding: 0 0 2.3rem 0;
    transition: background .3s;
    max-height: 97vh;
    overflow-y: auto;
    position: relative;
    bottom: 0;
}
.alvoro-form-header {
    padding: 1.3rem 1.2rem 0.5rem 1.2rem;
    border-radius: 1.2rem 1.2rem 0 0;
    text-align: center;
}
.alvoro-form-title {
    font-size: 1.13rem;
    font-weight: 500;
    margin-bottom: 1.1rem;
    letter-spacing: 0.01em;
    color: #23262f;
}
.alvoro-amount-input {
    font-size: 2.13rem;
    color: #6f7480;
    text-align: center;
    border: none;
    outline: none;
    width: 100%;
    font-weight: 500;
    background: transparent;
    margin-bottom: .10rem;
}
.alvoro-shares-display {
    font-size: 1.09rem;
    color: #b3bad0;
    text-align: center;
    margin-bottom: 1.5rem;
}
.alvoro-asset-row {
    display: flex;
    align-items: center;
    gap: .95rem;
    margin-bottom: 1.1rem;
    padding-left: 1.2rem;
    padding-right: 1.2rem;
}
.alvoro-asset-logo {
    width: 36px;
    height: 36px;
    border-radius: 7px;
    background: #fff;
    border: 1.2px solid #ececec;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.alvoro-asset-meta {
    display: flex;
    flex-direction: column;
    min-width: 0;
}
.alvoro-asset-symbol {
    font-size: 1.10rem;
    font-weight: 600;
    color: #222;
    margin-bottom: -.09rem;
    letter-spacing: 0.01em;
}
.alvoro-asset-name {
    font-size: .98rem;
    color: #b3bad0;
    font-weight: 400;
}
.alvoro-asset-price {
    margin-left: auto;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    min-width: 78px;
}
.alvoro-asset-price .price {
    font-size: 1.09rem;
    font-weight: 600;
    color: #23262f;
}
.alvoro-asset-price .change {
    font-size: .98rem;
    color: #47e2a0;
    font-weight: 500;
}
.alvoro-available-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #8b92a5;
    font-size: 1.07rem;
    padding: 0 1.2rem;
    margin-bottom: 1.0rem;
}
.alvoro-available-row .alvoro-available-label {
    color: #b3bad0;
}
.alvoro-available-row .alvoro-available-balance {
    color: #23262f;
    font-weight: 600;
}
.alvoro-form-select {
    width: 90%;
    margin: 0 auto 1.1rem auto;
    border-radius: 1rem;
    border: 1.1px solid #e5e6eb;
    font-size: 1.07rem;
    color: #10182b;
    padding: .85rem 1rem;
    background: #f8fafc;
    outline: none;
    box-sizing: border-box;
    display: block;
    transition: border .18s;
}
.alvoro-form-select:focus {
    border-color: #47e2a0;
}
.alvoro-form-btn {
    width: 90%;
    border-radius: 2.2rem;
    padding: 1.01rem 0;
    font-size: 1.13rem;
    font-weight: 700;
    border: none;
    margin: 1.2rem auto .2rem auto;
    transition: background .18s;
    background: #47e2a0;
    color: #fff;
    box-shadow: 0 2px 10px #47e2a02f;
    display: block;
}
.alvoro-form-btn:hover {
    background: #29c584;
}
.alvoro-form-btn-secondary {
    background: #ff4e5b;
    color: #fff;
    margin-top: .5rem;
}
.alvoro-form-btn-secondary:hover {
    background: #cc3340;
}
.alvoro-alert {
    border-radius: 1rem;
    margin: 1.1rem 1.2rem 0 1.2rem;
    text-align: center;
    font-size: 1rem;
    font-weight: 500;
    color: #ff4e5b;
    background: #fff0f1;
    border: none;
    display: none;
}
@media (max-width: 600px) {
    .alvoro-form-modal { max-width: 99vw; border-radius: 0; box-shadow: none; }
    .alvoro-form-header, .alvoro-asset-row, .alvoro-available-row { padding-left: .3rem; padding-right: .3rem; }
    .alvoro-form-select, .alvoro-form-btn { width: 98%; }
}
</style>
<main>
    <div class="main-container">
        <!-- Asset Overview Layer -->
        <div class="asset-summary-box">
            <div class="asset-summary-top">
                <div class="asset-logo-lg">
                    <img src="../../assets/images/svgs/<?= strtolower($symbol) ?>-image.svg" alt="<?= $symbol ?>" style="width: 32px; height: 32px;">
                </div>
                <div class="asset-meta-lg">
                    <div class="asset-symbol-lg"><?= strtoupper($symbol); ?></div>
                    <div class="asset-name-lg"><?= $assetName ?? ucfirst($market); ?></div>
                    <div class="asset-status-lg">Market Open</div>
                </div>
            </div>
            <div class="asset-price-row" id="assetPriceRow">
                <span class="asset-price-main" id="assetMainPrice">-</span>
                <span class="asset-price-changes" id="assetPriceChanges">
                    <span class="asset-price-abs" id="assetPriceAbs"></span>
                    <span class="asset-price-pct" id="assetPricePct"></span>
                </span>
            </div>
            <div class="asset-market-caption">PRICES BY ALVORO CAPITAL, IN USD</div>
            <div class="asset-tabs">
                <button class="asset-tab active" type="button" data-tab="overview" onclick="selectTab(this)">Overview</button>
                <button class="asset-tab" type="button" data-tab="chart" onclick="selectTab(this)">Chart</button>
                <button class="asset-tab" type="button" data-tab="analysis" onclick="selectTab(this)">Analysis</button>
                <button class="asset-tab" type="button" data-tab="news" onclick="selectTab(this)">News</button>
            </div>
            <div class="asset-tab-content" id="tabContent">
                <div class="loader">Loading overview...</div>
            </div>
            <div class="asset-stats-row">
                <div class="asset-stat"><span class="stat-label">Market Cap</span> <i class="far fa-info-circle"></i> <span id="marketCap">-</span></div>
                <div class="asset-stat"><span class="stat-label">Day's Range</span> <i class="far fa-info-circle"></i> <span id="daysRange">-</span></div>
            </div>
        </div>
    </div>
    <!-- Floating Trade Button -->
    <button class="fab-trade-btn" id="tradeFabBtn"><span>Trade</span> <i class="fas fa-arrow-right-arrow-left"></i></button>

    <!-- Trade Modal (modern, mobile-friendly, matches image 5)-->
    <div id="modalOverlay">
        <div class="alvoro-form-modal">
            <form id="tradeForm" autocomplete="off" onsubmit="return false;">
                <div class="alvoro-form-header">
                    <div class="alvoro-form-title">How much money would you like to invest?</div>
                    <input type="number" min="10" id="amount" class="alvoro-amount-input" placeholder="0.00" name="amount" autocomplete="off">
                    <div class="alvoro-shares-display" id="sharesDisplay">0 Shares</div>
                </div>
                <div class="alvoro-asset-row">
                    <div class="alvoro-asset-logo">
                        <img src="../../assets/images/svgs/<?= strtolower($symbol) ?>-image.svg" alt="<?= $symbol ?>" style="width: 26px; height: 26px;">
                    </div>
                    <div class="alvoro-asset-meta">
                        <div class="alvoro-asset-symbol"><?= strtoupper($symbol); ?></div>
                        <div class="alvoro-asset-name"><?= $assetName ?? ucfirst($market); ?></div>
                    </div>
                    <div class="alvoro-asset-price">
                        <span class="price" id="dPrice">$0.00</span>
                        <span class="change" id="priceChange"></span>
                    </div>
                </div>
                <div class="alvoro-available-row">
                    <span class="alvoro-available-label">Available $</span>
                    <span class="alvoro-available-balance"><?= number_format($available, 2); ?></span>
                </div>
                <select class="alvoro-form-select" id="time" name="time">
                    <option disabled selected>--Select Time--</option>
                    <option value="1 minute">1 minute</option>
                    <option value="5 minutes">5 minutes</option>
                    <option value="10 minutes">10 minutes</option>
                    <option value="30 minutes">30 minutes</option>
                    <option value="45 minutes">45 minutes</option>
                    <option value="1 hour">1 hour</option>
                    <option value="2 hours">2 hours</option>
                    <option value="5 hours">5 hours</option>
                    <option value="1 day">1 day</option>
                    <option value="3 days">3 days</option>
                    <option value="1 week">1 week</option>
                    <option value="2 weeks">2 weeks</option>
                    <option value="1 month">1 month</option>
                    <option value="3 months">3 months</option>
                    <option value="6 months">6 months</option>
                    <option value="1 year">1 year</option>
                </select>
                <select class="alvoro-form-select" id="leverage" name="leverage">
                    <option disabled selected>--Leverage--</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <option value="<?= $i * 5; ?>"><?= $i * 5; ?></option>
                    <?php } ?>
                </select>
                <select class="alvoro-form-select" required id="account" name="account">
                    <option class="" disabled selected>--Select account--</option>
                    <option value="available">Available Balance (<?= $_SESSION['symbol'] . number_format($available, 2); ?>)</option>
                    <option value="profit">Profit Balance (<?= $_SESSION['symbol'] . number_format($profit, 2); ?>)</option>
                </select>
                <div class="alvoro-alert" id="error"></div>
                <button type="button" id="buyBtn" class="alvoro-form-btn">Buy</button>
                <button type="button" id="sellBtn" class="alvoro-form-btn alvoro-form-btn-secondary">Sell</button>
                <div style="text-align: center; margin-top: .9rem;">
                    <button type="button" class="btn btn-link text-dark" onclick="closeTradeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="../../assets/js/assets.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
let pps = 0;
let balance = <?= $available; ?>;
let market = "<?= $market ?>";
let symbol = "<?= $symbol ?>";
let assetName = "<?= $assetName ?? ucfirst($market); ?>";
let available = <?= $available; ?>;
let profit = <?= $profit; ?>;

// Utility
function setMainPrice(price, change, marketCap, daysRange) {
    document.getElementById("assetMainPrice").textContent = price && !isNaN(price) ? Number(price).toLocaleString(undefined, {maximumFractionDigits:2, minimumFractionDigits:2}) : "N/A";
    let absChange = (change !== null && change !== undefined && !isNaN(change)) ? (price * change / 100) : 0;
    if (change !== null && change !== undefined && !isNaN(change)) {
        let absStr = (absChange > 0 ? "+" : "") + absChange.toLocaleString(undefined, {maximumFractionDigits:2, minimumFractionDigits:2});
        let pctStr = (change > 0 ? "+" : "") + change.toFixed(2) + "%";
        let positive = change > 0;
        document.getElementById("assetPriceAbs").textContent = absStr;
        document.getElementById("assetPricePct").textContent = "(" + pctStr + ")";
        document.getElementById("assetPriceAbs").classList.toggle("asset-price-positive", positive);
        document.getElementById("assetPricePct").classList.toggle("asset-price-positive", positive);
    } else {
        document.getElementById("assetPriceAbs").textContent = "";
        document.getElementById("assetPricePct").textContent = "";
    }
    document.getElementById("marketCap").textContent = marketCap ?? "-";
    document.getElementById("daysRange").textContent = daysRange ?? "-";
}
function setModalPrice(price, change) {
    pps = price;
    document.getElementById('dPrice').textContent = price && !isNaN(price) ? "$" + Number(price).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:6}) : "$0.00";
    if (change !== null && change !== undefined && !isNaN(change)) {
        let pct = (change > 0 ? "+" : "") + change.toFixed(2) + "%";
        document.getElementById('priceChange').textContent = pct;
        document.getElementById('priceChange').style.color = change >= 0 ? "#47e2a0" : "#ff4e5b";
    } else {
        document.getElementById('priceChange').textContent = "";
    }
    updateSharesDisplay();
}
function setPriceAll(price, change, marketCap, daysRange) {
    setMainPrice(price, change, marketCap, daysRange);
    setModalPrice(price, change);
}
function updateSharesDisplay() {
    let amount = parseFloat(document.getElementById("amount").value) || 0;
    let price = parseFloat(pps) || 1;
    let shares = (price > 0) ? (amount / price) : 0;
    document.getElementById("sharesDisplay").textContent = shares.toLocaleString(undefined, { maximumFractionDigits: 2 }) + " Shares";
}

// Real price fetch for both main/overview and modal
function fetchAndUpdatePrice() {
    <?php if ($market == "crypto") { ?>
        let coinCapId = '<?= strtolower($symbol) ?>';
        const symbolToId = {
            btc: 'bitcoin', eth: 'ethereum', bnb: 'binance-coin', usdt: 'tether', sol: 'solana',
            ada: 'cardano', xrp: 'ripple', doge: 'dogecoin', trx: 'tron', link: 'chainlink',
            matic: 'polygon', ltc: 'litecoin', bch: 'bitcoin-cash', xlm: 'stellar', etc: 'ethereum-classic',
            atom: 'cosmos', xmr: 'monero', fil: 'filecoin', vet: 'vechain', sand: 'the-sandbox',
            axs: 'axie-infinity', cro: 'crypto-com-coin', avax: 'avalanche', shib: 'shiba-inu', usdc: 'usd-coin'
        };
        if (symbolToId[coinCapId]) coinCapId = symbolToId[coinCapId];
        fetch('https://api.coincap.io/v2/assets/' + coinCapId)
            .then(r=>r.json())
            .then(json => {
                let price = 0, change = 0, marketCap = "-", daysRange = "-";
                if (json.data && json.data.priceUsd) {
                    price = parseFloat(json.data.priceUsd);
                    change = json.data.changePercent24Hr ? parseFloat(json.data.changePercent24Hr) : 0;
                    marketCap = json.data.marketCapUsd ? "$" + Number(json.data.marketCapUsd).toLocaleString(undefined, {maximumFractionDigits:0}) : "-";
                    daysRange = (json.data.high24hr && json.data.low24hr)
                        ? "$" + Number(json.data.low24hr).toLocaleString() + " - $" + Number(json.data.high24hr).toLocaleString()
                        : "-";
                }
                setPriceAll(price, change, marketCap, daysRange);
            })
            .catch(() => setPriceAll("-", "-", "-", "-"));
    <?php } else { ?>
        $.ajax({
            url: 'https://ratesjson.fxcm.com/DataDisplayerMKTs',
            method: 'GET',
            crossDomain: true,
            dataType: 'jsonp',
            success: function(json) {
                let price = 0, marketCap = "-", daysRange = "-";
                if (json && json.Rates && json.Rates.length > 0) {
                    let idx = json.Rates.findIndex(object => object.Symbol === symbol);
                    if (idx === -1) idx = 0;
                    price = json.Rates[idx] && json.Rates[idx].Ask ? parseFloat(json.Rates[idx].Ask) : 0;
                }
                setPriceAll(price, null, marketCap, daysRange);
            },
            error: function() {
                setPriceAll("-", "-", "-", "-");
            }
        });
    <?php } ?>
}

// Modal logic
function openTradeModal() {
    document.getElementById('modalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    fetchAndUpdatePrice();
}
function closeTradeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
    document.body.style.overflow = '';
}
document.getElementById('tradeFabBtn').addEventListener('click', openTradeModal);
document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeTradeModal();
});
document.addEventListener('DOMContentLoaded', function() {
    // Choices.js
    new Choices('#time', {searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false});
    new Choices('#leverage', {searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false});
    new Choices('#account', {searchEnabled: false, itemSelectText: '', shouldSort: false, allowHTML: false});
    balance = <?= $available; ?>;
    fetchAndUpdatePrice();
    loadTab('overview');
    document.getElementById("amount").addEventListener('input', updateSharesDisplay);
    document.getElementById("account").addEventListener('change', function() {
        balance = this.value === "available" ? <?= $available; ?> : <?= $profit; ?>;
    });

    // Attach working buy/sell handlers
    document.getElementById("buyBtn").addEventListener('click', function() { placeBuy('placeBuy'); });
    document.getElementById("sellBtn").addEventListener('click', function() { placeBuy('placeSell'); });
});

// AJAX for Buy/Sell
function placeBuy(requestType) {
    let amount = document.getElementById("amount").value;
    let time = document.getElementById("time").value;
    let leverage = document.getElementById("leverage").value;
    let account = document.getElementById("account").value;
    let price = parseFloat(pps);
    let symb = symbol;
    let marketType = market;
    let small = assetName;

    if (amount == null || amount === "" || parseFloat(amount) < 10) {
        showError("Please enter an amount above 10");
    } else if (!time || time === "--Select Time--") {
        showError("Please select a time");
    } else if (!leverage || leverage === "--Leverage--") {
        showError("Please select a leverage");
    } else if (balance <= 0) {
        showError("You do not have sufficient balance to trade, click <a href='./deposit'>here</a> to deposit");
    } else if (parseFloat(amount) > balance) {
        showError("The amount entered is greater than available balance, click <a href='./deposit'>here</a> to deposit");
    } else {
        $.ajax({
            url: '../../ops/users',
            type: 'POST',
            data: {
                request: requestType,
                amount: amount,
                time: time,
                leverage: leverage,
                asset: symb,
                price: price,
                market: marketType,
                symbol: symb,
                account: account,
                small: small
            },
            beforeSend: function() {
                showError("Processing <span class='fas fa-spinner fa-spin'></span>");
            },
            success: function(data) {
                let response = {};
                try { response = JSON.parse(data); }
                catch(e) { response = {status:'error', message: 'Invalid server response.'}; }
                if (response.status === "success") {
                    showError(response.message);
                    setTimeout(() => {
                        closeTradeModal();
                        location.reload();
                    }, 2000);
                } else {
                    showError(response.message || "Trade failed");
                }
            },
            error: function(err) {
                showError("An error has occured!! " + err.statusText);
            }
        });
    }
}

function showError(msg) {
    let error = document.getElementById("error");
    error.innerHTML = msg;
    error.style.display = "block";
    setTimeout(() => { error.style.display = "none"; }, 5000);
}

// --- TABS Section ---
function selectTab(el) {
    document.querySelectorAll('.asset-tab').forEach(tab => tab.classList.remove('active'));
    el.classList.add('active');
    let tab = el.getAttribute('data-tab');
    loadTab(tab);
}
function loadTab(tab) {
    let tabContent = document.getElementById('tabContent');
    tabContent.innerHTML = '<div class="loader">Loading ' + tab + '...</div>';
    if (tab === 'overview') {
        tabContent.innerHTML = `
        <div>
            <h3 style="font-size:1.14rem;font-weight:600;margin-bottom:.7rem;">About <?= strtoupper($symbol); ?></h3>
            <p style="color:#6c7480;font-size:1rem;line-height:1.6;"><?= $assetName ?? ucfirst($market); ?> (<?= strtoupper($symbol); ?>) is a leading asset traded on global markets. It represents a key holding in diversified portfolios and is tracked by many financial analysts. Check "Chart" for price history and "News" for latest developments.</p>
            <ul style="color:#6c7480;list-style:disc inside;font-size:.98rem;line-height:2;margin:1rem 0 0 0;">
                <li>Market Open: 9:30am - 4:00pm EST</li>
                <li>Exchange: NASDAQ</li>
                <li>Type: Stock</li>
                <li>Leverage: Up to 20x</li>
            </ul>
        </div>`;
    } else if (tab === 'chart') {
        tabContent.innerHTML = `
        <div style="width:100%;height:340px;max-width:100vw;">
            <iframe src="https://s.tradingview.com/widgetembed/?symbol=NASDAQ:<?= strtoupper($symbol) ?>&interval=15&theme=light&style=1&toolbar_bg=f8fafc&saveimage=1&studies=[]"
                style="width:100%;height:340px;border:0;border-radius:1.2rem;background:#fff;"></iframe>
        </div>`;
    } else if (tab === 'analysis') {
        tabContent.innerHTML = `
        <h3 style="font-size:1.14rem;font-weight:600;margin-bottom:.8rem;">Analysis &amp; Ratings</h3>
        <ul style="color:#6c7480;font-size:1rem;line-height:1.8;">
            <li>Analyst consensus: <b>Buy</b></li>
            <li>Average Target Price: $100.25</li>
            <li>52-week High: $120.00</li>
            <li>52-week Low: $60.00</li>
            <li>P/E Ratio: 18.7</li>
        </ul>
        <div style="margin-top:1rem;color:#a4a9b6;font-size:.95rem;">(Data from Yahoo Finance, TradingView, and Alvoro Capital research.)</div>
        `;
    } else if (tab === 'news') {
        tabContent.innerHTML = `
        <h3 style="font-size:1.14rem;font-weight:600;margin-bottom:.8rem;">Latest News</h3>
        <ul style="padding-left:0;list-style:none;">
            <li style="margin-bottom:1.1rem;">
                <a href="#" style="color:#29c584;text-decoration:none;font-weight:500;">Apple launches new product lineup in 2025</a>
                <div style="color:#a4a9b6;font-size:.93rem;">Reuters - 17 Jun 2025</div>
            </li>
            <li style="margin-bottom:1.1rem;">
                <a href="#" style="color:#29c584;text-decoration:none;font-weight:500;">AAPL shares climb after earnings beat estimates</a>
                <div style="color:#a4a9b6;font-size:.93rem;">Yahoo Finance - 16 Jun 2025</div>
            </li>
            <li style="margin-bottom:1.1rem;">
                <a href="#" style="color:#29c584;text-decoration:none;font-weight:500;">Analysts predict growth for tech sector in Q3</a>
                <div style="color:#a4a9b6;font-size:.93rem;">Seeking Alpha - 15 Jun 2025</div>
            </li>
        </ul>
        `;
    }
}
</script>