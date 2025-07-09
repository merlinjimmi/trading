<?php include 'header.php'; ?>
<title>Copy Traders | <?= SITE_NAME; ?></title>
<main class="mt-30 pt-5" id="content">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: Independent Crypto Swipe Cards -->
                <div class="crypto-swiper-container mb-4">
                    <div class="swiper crypto-swiper" id="cryptoSwiper">
                        <div class="swiper-wrapper" id="crypto-cards-list">
                            <!-- Cards will be dynamically filled by JS -->
                        </div>
                    </div>
                </div>
                <!-- END: Crypto Swipe Cards -->

                <div class="card soft-card">
                    <div class="card-body lh-base">
                        <?php
                        $sql = $db_conn->prepare("SELECT trader, trader_status FROM members WHERE mem_id = :mem_id");
                        $sql->bindParam(":mem_id", $mem_id, PDO::PARAM_STR);
                        $sql->execute();
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <?php if ($row['trader'] == "" or $row['trader'] == NULL and $row['trader_status'] == 0) { ?>
                            <p class="small text-soft-muted">You are not currently copying any trader</p>
                        <?php } elseif ($row['trader'] != NULL and $row['trader_status'] == 1) {
                            $trader = filter_var(htmlentities($row['trader']), FILTER_UNSAFE_RAW);
                            $getTraders = $db_conn->prepare("SELECT trader_id, t_name, t_photo1, t_profit_share, t_followers FROM traders WHERE trader_id = :trader");
                            $getTraders->bindParam(":trader", $trader, PDO::PARAM_STR);
                            $getTraders->execute();
                            $rows = $getTraders->fetch(PDO::FETCH_ASSOC);
                            $copiers = $rows['t_followers'];
                            if ($copiers >= 1000) {
                                $copiers_display = number_format($copiers/1000, 1) . 'K';
                            } else {
                                $copiers_display = $copiers;
                            }
                            $profit_share = is_numeric($rows['t_profit_share']) ? number_format($rows['t_profit_share'], 2) : $rows['t_profit_share'];
                        ?>
                            <div class="currently-copying-listing d-flex align-items-center p-3 mb-4 rounded soft-bg">
                                <div class="me-3">
                                    <img src="../../assets/images/traders/<?= $rows['t_photo1']; ?>" class="rounded-circle border soft-avatar" alt="trader avatar" style="width:44px; height:44px; object-fit:cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-soft-title" style="font-size: 1.10rem;"><?= $rows['t_name']; ?></div>
                                    <div>
                                        <span class="text-soft-label" style="font-size:.98em;">Profit Share:</span>
                                        <span class="fw-bold ms-1 text-soft-green" style="font-size:1em;">
                                            ▲ <?= $profit_share; ?>%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-end ms-3">
                                    <span class="fw-bold text-soft-green" style="font-size:1.10rem;"><?= $copiers_display; ?></span>
                                    <div class="text-soft-label small">Copiers</div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <p class="mb-3 text-soft-muted">You are not currently copying any trader</p>
                        <?php } ?>
                        <hr class="soft-divider">
                        <h5 class="text-uppercase fw-bold mt-3 text-soft-title">Trending Investors</h5>
                        <div class="border-bottom w-25 border-2 mb-4 soft-divider2"></div>
                        <div class="col-md-4 ms-auto mb-3">
                            <div class="form-outline">
                                <input type="text" placeholder="Enter name" class="form-control soft-input" id="search" name="search">
                                <label class="form-label text-soft-label" for="search">Search trader</label>
                            </div>
                        </div>

                        <!-- SWIPEABLE CARDS: use Swiper.js for the swipe effect -->
                        <div class="traders-swiper-outer">
                            <div class="swiper traders-swiper" id="tradersSwiper">
                                <div class="swiper-wrapper">
                                    <?php
                                    $stat = 1;
                                    $getTraders = $db_conn->prepare("SELECT * FROM traders WHERE t_status = :stat ORDER BY main_id ASC");
                                    $getTraders->bindParam(":stat", $stat, PDO::PARAM_STR);
                                    $getTraders->execute();

                                    while ($rowss = $getTraders->fetch(PDO::FETCH_ASSOC)) :
                                        $copiers = $rowss['t_followers'];
                                        if ($copiers >= 1000) {
                                            $copiers_display = number_format($copiers / 1000, 1) . 'K';
                                        } else {
                                            $copiers_display = $copiers;
                                        }
                                        $profit_share = is_numeric($rowss['t_profit_share']) ? number_format($rowss['t_profit_share'], 2) : ($rowss['t_profit_share'] ?? "");
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="trader-card shadow rounded px-3 py-4 mb-3 soft-card-inner">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="trader-avatar me-3">
                                                        <img src="../../assets/images/traders/<?= $rowss['t_photo1']; ?>" class="rounded-circle border soft-avatar" alt="" style="width: 48px; height: 48px; object-fit: cover;">
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold h5 mb-1 text-soft-title"><?= $rowss['t_name']; ?></div>
                                                        <div>
                                                            <span class="badge soft-badge me-1"><?= $rowss['t_sector1'] ?? "Med Tech"; ?></span>
                                                            <span class="badge soft-badge"><?= $rowss['t_sector2'] ?? "Consumable Goods"; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 small text-soft-bio"><?= $rowss['t_bio'] ?? "Dividend investor since I am 12 years old - consistency is king 👑👑👑"; ?></div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        <span class="fw-bold text-soft-green" style="font-size: 1.3em;"><?= $profit_share; ?>%</span>
                                                        <div class="text-soft-label small">Profit Share</div>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="fw-bold text-soft-green"><?= $copiers_display; ?></span>
                                                        <div class="text-soft-label small">Copiers</div>
                                                    </div>
                                                </div>
                                                <button onclick="copytrader('<?= $rowss['trader_id'] ?>', 'requestBtn<?= $rowss["trader_id"]; ?>')" id="requestBtn<?= $rowss['trader_id']; ?>" class="btn btn-soft-green btn-sm w-100 shadow-none">
                                                    <?= $row['trader'] == $rowss['trader_id'] && $row['trader_status'] == 0 ? 'Requested' : ($row['trader'] == $rowss['trader_id'] && $row['trader_status'] == 1 ? 'Accepted' : 'Copy'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <!--<div class="swiper-pagination"></div>-->
                            </div>
                        </div>
                        <div id="searchres"></div>
                    </div>
                </div>
                
                
                <!--NEWS AREA-->
                <div class="card soft-card mt-5">
                    <div class="card-body">
                        <h5 class="fw-bold text-soft-title mb-3">Stock Market News</h5>
                        <div id="stockNewsArea">
                            <div class="text-soft-label mb-2">Loading stock news...</div>
                        </div>
                    </div>
                </div>
                <!--END NEWS AREA-->
                
            </div>
        </div>
    </div>
</main>
<br><br>

<?php include "footer.php"; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../assets/js/toastr.js"></script>
<script>
const cryptoData = [
    {
        symbol: 'BTC', name: 'Bitcoin', api: 'https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=2',
        priceApi: 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd&include_24hr_change=true',
        key: 'bitcoin', color: '#FFB300', logo: '₿', bg: 'linear-gradient(135deg, #FFB300 0%, #ff9b03 100%)'
    },
    {
        symbol: 'ETH', name: 'Ethereum', api: 'https://api.coingecko.com/api/v3/coins/ethereum/market_chart?vs_currency=usd&days=2',
        priceApi: 'https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd&include_24hr_change=true',
        key: 'ethereum', color: '#338AFF', logo: 'Ξ', bg: 'linear-gradient(135deg, #338AFF 0%, #1858d4 100%)'
    },
    {
        symbol: 'TRX', name: 'Tron', api: 'https://api.coingecko.com/api/v3/coins/tron/market_chart?vs_currency=usd&days=2',
        priceApi: 'https://api.coingecko.com/api/v3/simple/price?ids=tron&vs_currencies=usd&include_24hr_change=true',
        key: 'tron', color: '#E62B45', logo: 'TRX', bg: 'linear-gradient(135deg, #E62B45 0%, #ad1d2f 100%)'
    },
    {
        symbol: 'ADA', name: 'Cardano', api: 'https://api.coingecko.com/api/v3/coins/cardano/market_chart?vs_currency=usd&days=2',
        priceApi: 'https://api.coingecko.com/api/v3/simple/price?ids=cardano&vs_currencies=usd&include_24hr_change=true',
        key: 'cardano', color: '#2970FF', logo: 'ADA', bg: 'linear-gradient(135deg, #2970FF 0%, #2158c9 100%)'
    }
];

function renderCryptoCards() {
    const wrapper = document.getElementById('crypto-cards-list');
    wrapper.innerHTML = '';
    cryptoData.forEach((c, idx) => {
        wrapper.innerHTML += `
            <div class="swiper-slide">
                <div class="crypto-card keep-bg" style="background: ${c.bg};" data-symbol="${c.symbol}">
                    <div class="crypto-card-inner">
                        <div class="crypto-card-row">
                            <div>
                                <div class="crypto-symbol">${c.symbol}</div>
                                <div class="crypto-name">${c.name}</div>
                                <div class="crypto-price" id="crypto-price-${c.symbol}">--</div>
                            </div>
                            <div class="crypto-logo">${c.logo}</div>
                        </div>
                        <div class="crypto-graph-wrap">
                            <canvas id="crypto-chart-${c.symbol}" style="width:100%;height:100%;"></canvas>
                        </div>
                        <div class="crypto-price-row">
                            <div class="crypto-price" id="crypto-price-${c.symbol}">--</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
}

function updateCryptoPrices() {
    cryptoData.forEach(c => {
        fetch(c.priceApi)
        .then(r=>r.json())
        .then(d=>{
            let price = d[c.key].usd;
            let change = d[c.key].usd_24h_change;
            document.getElementById(`crypto-price-${c.symbol}`).innerHTML = price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
            document.getElementById(`crypto-change-${c.symbol}`).innerHTML = (change>0?'+':'')+change.toFixed(2)+'%';
            document.getElementById(`crypto-change-${c.symbol}`).style.color = change>=0 ? '#1cc88a' : '#e74a3b';
        });
    });
}

function drawCryptoCharts() {
    cryptoData.forEach(c => {
        fetch(c.api)
        .then(r=>r.json())
        .then(d=>{
            let prices = d.prices.map(a=>a[1]);
            let min = Math.min(...prices), max = Math.max(...prices);
            let ctx = document.getElementById(`crypto-chart-${c.symbol}`).getContext('2d');
            if(window['chart_'+c.symbol]) window['chart_'+c.symbol].destroy();
            window['chart_'+c.symbol] = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: prices.map((_,i)=>i),
                    datasets: [{
                        data: prices,
                        fill: true,
                        backgroundColor: c.color+'22',
                        borderColor: c.color,
                        borderWidth: 2,
                        tension: 0.45,
                        pointRadius: 0
                    }]
                },
                options: {
                    plugins: { legend: {display: false}, tooltip: {enabled: false} },
                    elements: { line: { borderJoinStyle: 'round' } },
                    scales: { x: {display:false}, y: {display:false, min, max} },
                    animation: false,
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', function(){
    renderCryptoCards();
    setTimeout(() => {updateCryptoPrices(); drawCryptoCharts();}, 150);
    setInterval(() => {updateCryptoPrices(); drawCryptoCharts();}, 15000);

    new Swiper('#cryptoSwiper', {
        slidesPerView: 'auto',
        spaceBetween: 0, // gap handled by CSS
        loop: false,
        freeMode: true,
        pagination: false
    });

    // document.getElementById('crypto-cards-list').addEventListener('click', function(e){
    //     let card = e.target.closest('.crypto-card');
    //     if(card && card.dataset.symbol) {
    //         window.location.href = "market.php?coin=" + card.dataset.symbol;
    //     }
    // });
});
</script>
<script>
// ----- STOCK NEWS SCRIPT USING ALPHAVANTAGE API -----

const alphaVantageKey = '1C8QR1SFFKVKA2AL'; // Replace with your AlphaVantage API key
const stocks = [
    'AAPL', 'GOOGL', 'MSFT', 'AMZN', 'TSLA',
    'NVDA', 'META', 'AMD', 'NFLX', 'INTC'
];

function renderStockNews(newsList) {
    const area = document.getElementById('stockNewsArea');
    if (!newsList.length) {
        area.innerHTML = `<div class="text-soft-label mb-2">No news found.</div>`;
        return;
    }
    let html = '<div class="list-group">';
    newsList.forEach(news => {
        html += `
        <a href="${news.url}" target="_blank" class="list-group-item list-group-item-action mb-2 soft-card-inner">
            <div class="fw-bold">${news.title}</div>
            <div class="small text-soft-label mb-1">${news.source} &bull; ${news.time}</div>
            <div class="text-soft-bio small">${news.summary}</div>
        </a>
        `;
    });
    html += '</div>';
    area.innerHTML = html;
}

async function fetchAlphaVantageNewsForStocks(stocks, apiKey) {
    let allNews = [];
    for (let i = 0; i < stocks.length; i++) {
        try {
            const res = await fetch(
                `https://www.alphavantage.co/query?function=NEWS_SENTIMENT&tickers=${stocks[i]}&limit=3&apikey=${apiKey}`
            );
            const data = await res.json();
            if (data.feed && Array.isArray(data.feed)) {
                // Limit to 1-2 top news per stock to avoid overfilling UI
                data.feed.slice(0, 2).forEach(feedItem => {
                    allNews.push({
                        title: feedItem.title,
                        url: feedItem.url,
                        source: feedItem.source,
                        time: (feedItem.time_published || '').slice(0, 16).replace('T', ' '),
                        summary: feedItem.summary
                    });
                });
            }
        } catch (e) {
            // Optionally handle error for this stock
        }
    }
    // Sort news by time desc
    allNews.sort((a, b) => b.time.localeCompare(a.time));
    return allNews.slice(0, 12); // Show at most 12 news items
}

document.addEventListener('DOMContentLoaded', async function() {
    const area = document.getElementById('stockNewsArea');
    area.innerHTML = `<div class="text-soft-label mb-2">Loading stock news...</div>`;
    const newsList = await fetchAlphaVantageNewsForStocks(stocks, alphaVantageKey);
    renderStockNews(newsList);
});
</script>
<script>
$(document).ready(function() {
    $('#searchres').hide();
    $("#errorshow").hide();
});

function copytrader(traderid, btn) {
    $.ajax({
        url: '../../ops/users',
        type: 'POST',
        data: {
            request: 'copyTrader',
            traderid: traderid
        },
        beforeSend: function() {
            toastr.info("Copying trader, Please wait <span class='fa fa-1x fa-spinner fa-spin'></span>");
            setTimeout(() => {
                toastr.clear();
            }, 5000);
        },
        success: function(data) {
            if (data == 'success') {
                toastr.info("Requested.");
                $("#" + btn).html('Requested');
                setTimeout(function(){
                    location.reload();
                }, 1500);
            } else {
                toastr.info(data);
            }
        },
        error: function(err) {
            toastr.info(err);
        }
    });
}

$('#search').on('input', function() {
    if ($("#search").val().length == 0) {
        $('.traders-swiper-outer').show();
        $('#searchres').hide();
    } else if ($("#search").val().length >= 3) {
        var searchkey = $(this).val();
        $.ajax({
            type: 'POST',
            url: '../../ops/users',
            data: {
                request: 'searchTrader',
                searchkey: searchkey
            },
            beforeSend: function() {
                $('#searchres').html("Please wait ...").show();
            },
            success: function(data) {
                $('#searchres').html(data).show();
                $(".traders-swiper-outer").hide();
            },
            error: function() {
                $('#searchres').html("<p class='text-center'>An error occured.</p>").show();
            }
        });
    }
});

var swiper = new Swiper('#tradersSwiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        576: {
            slidesPerView: 1.1,
        },
        768: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        }
    }
});
</script>
<style>
/* --- CRYPTO SWIPER FIXED STYLES --- */
/* ... (unchanged existing CSS) ... */
.crypto-swiper-container {
    width: 100%;
    overflow-x: hidden;
    background: transparent;
    margin-bottom: 2rem;
}
.crypto-swiper .swiper-wrapper {
    display: flex;
    flex-wrap: nowrap;
    gap: 32px;
    padding-left: 2px;
    padding-right: 2px;
    min-width: 0 !important;
}
.crypto-swiper .swiper-slide {
    min-width: 0 !important;
    width: 370px;
    max-width: 96vw;
    flex: 0 0 auto !important;
    display: flex;
    justify-content: flex-start;
    box-sizing: border-box;
}
@media (max-width: 700px) {
    .crypto-swiper .swiper-slide, .crypto-card { width: 94vw; max-width: 98vw; }
}
@media (max-width: 500px) {
    .crypto-swiper .swiper-slide, .crypto-card { width: 99vw; min-width: 93vw; max-width: 99vw; }
}
.crypto-card {
    width: 370px;
    height: 210px;
    max-width: 96vw;
    border-radius: 22px;
    box-sizing: border-box;
    background: transparent;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: stretch;
    box-shadow: 0 4px 24px 0 rgba(44,53,85,0.13);
    overflow: hidden;
    transition: box-shadow 0.18s;
}
.crypto-card-inner {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    justify-content: space-between;
    padding: 0;
}
.crypto-card-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: start;
    margin: 22px 28px 0 28px;
}
.crypto-logo {
    font-size: 3.35rem;
    font-weight: bold;
    line-height: 1;
    opacity: 0.98;
    margin-left: 0.5rem;
    margin-top: -0.4rem;
    color: #fff;
    text-shadow: 0 0 10px rgba(0,0,0,0.04);
}
.crypto-symbol {
    font-size: 1.08rem;
    font-weight: 700;
    letter-spacing: 1.7px;
    margin-bottom: 3px;
    margin-top: 0.1rem;
    color: #fff;
}
.crypto-name {
    font-family: 'Inter', sans-serif;
    font-size: 1.01rem;
    font-weight: 400;
    opacity: 0.91;
    color: #fff7;
    margin-bottom: 11px;
    margin-top: 0.02rem;
}
.crypto-price {
    font-size: 2.01rem;
    font-weight: 600;
    letter-spacing: .2px;
    opacity: 0.97;
    color: #fff;
    text-align: right;
}
.crypto-graph-wrap {
    width: 100%;
    height: 100px;
    min-height: 56px;
    margin-top: -40px;
    margin-bottom: 4px;
    padding: 0 0.9rem;
    flex: 0 0 auto;
    position: relative;
    display: flex;
    align-items: flex-end;
    justify-content: stretch;
}
.crypto-graph-wrap canvas {
    width: 100% !important;
    height: 100% !important;
    display: block;
}
.crypto-price-row {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: flex-end;
    margin: 0 28px 17px 28px;
}

/* --- TRADERS SWIPER FIX --- */
.traders-swiper-outer {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
    position: relative;
    margin-bottom: 1rem;
}
.traders-swiper {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}
.traders-swiper .swiper-wrapper {
    display: flex;
    flex-wrap: nowrap;
    min-width: 0 !important;
    box-sizing: border-box;
}
.traders-swiper .swiper-slide {
    min-width: 0 !important;
    width: 370px;
    max-width: 94vw;
    flex: 0 0 auto !important;
    display: flex;
    justify-content: flex-start;
    box-sizing: border-box;
}
@media (max-width: 1200px) {
    .traders-swiper .swiper-slide { width: 96vw; max-width: 98vw; }
}
@media (max-width: 700px) {
    .traders-swiper .swiper-slide { width: 98vw; max-width: 99vw; }
}
@media (max-width: 500px) {
    .traders-swiper .swiper-slide { width: 99vw; max-width: 99vw; }
}
.crypto-card-inner, .soft-card-inner, .trader-card {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    justify-content: space-between;
}
.trader-card {
    background: #fff !important;
    border-radius: 22px;
    box-shadow: 0 4px 24px 0 rgba(44,53,85,0.13);
    overflow: hidden;
}

/* --- Dark mode for trader cards ONLY --- */
body.dark .crypto-swiper-container,
body.dark .traders-swiper-outer { background: transparent; }
body.dark .trader-card {
    color: #fff !important;
    box-shadow: 0 3px 18px 0 rgba(0,0,0,0.21);
    background: #23272f !important;
}
body.dark .trader-card .fw-bold,
body.dark .trader-card .text-soft-title,
body.dark .trader-card .text-soft-green {
    color: #fff !important;
}
body.dark .trader-card .text-soft-label {
    color: #fff6 !important;
}

/* --- NO dark mode override for crypto-card (so it keeps its light/gradient bg) --- */
</style>