<?php include('header.php'); ?>
<br><br>
<title>Dashboard | <?= SITE_NAME; ?></title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
<style>
:root {
  --background: #f4f7fa;
  --container-bg: #fff;
  --primary: #28a745;
  --primary-dark: #12b568;
  --card-border: #e3e8f3;
  --text: #23272f;
  --text-secondary: #727b88;
  --icon-bg: #f2f3fa;
  --icon-color: #28a745;
  --quick-action-label: #697189;
  --news-title: #28a745;
  --metrics-card-gradient: linear-gradient(122deg, #f5f7f7 90%, #ffffff 100%);
  --quick-action-hover-bg: #e0e3f8;
}
body.dark {
  --background: #181c23;
  --container-bg: #232736;
  --primary: #28a745;
  --primary-dark: #12b568;
  --card-border: #232736;
  --text: #f3f6fa;
  --text-secondary: #bfc5d9;
  --icon-bg: #242d3e;
  --icon-color: #28a745;
  --quick-action-label: #c3c8e4;
  --news-title: #28a745;
  --metrics-card-gradient: linear-gradient(122deg, #232736 90%, #28a74510 100%);
  --quick-action-hover-bg: #28a745;
}
html, body {
    font-family: 'Inter', sans-serif;
    background: var(--background);
    color: var(--text);
    transition: background .3s, color .3s;
}
main#content {
    background: var(--background);
    min-height: 100vh;
}
.dashboard-container {
    padding-top: 32px;
    padding-bottom: 32px;
}
.dashboard-welcome {
    font-size: 2.2rem;
    font-weight: 300;
    color: var(--text);
    margin-bottom: 1.5rem;
}
/* Theme Toggle */
.theme-toggle {
    position: fixed;
    top: 18px;
    right: 24px;
    z-index: 99;
    background: var(--container-bg);
    border: 1px solid var(--card-border);
    border-radius: 30px;
    box-shadow: 0 2px 12px 0 #0001;
    padding: 0.2rem 0.7rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    cursor: pointer;
    transition: background .2s, color .2s;
}
.theme-toggle i {
    font-size: 1.3rem;
    color: var(--primary);
}
.theme-toggle span {
    font-size: 0.94rem;
    font-weight: 300;
    color: var(--text-secondary);
    margin-left: .15rem;
    margin-right: .1rem;
}
/* Verification Card */
.verify-card {
    background: var(--container-bg);
    border-radius: 18px;
    border: 1px solid var(--card-border);
    box-shadow: 0 4px 20px 0 rgba(21,41,91,0.13);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    padding: 1.5rem;
    gap: 1.5rem;
    transition: background .3s, border .3s;
}
.verify-progress {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 0.2rem;
}
.verify-progress .step {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #10131a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 300;
    font-size: 1.1rem;
    color: #a0a6b9;
}
body:not(.dark) .verify-progress .step { background: #e3e8f3; color: #727b88; }
.verify-progress .step.active,
.verify-progress .step.checked {
    background: var(--primary);
    color: #fff;
}
.verify-progress .step-line {
    width: 22px;
    height: 4px;
    background: var(--primary);
    border-radius: 2px;
}
.verify-title {
    font-size: 1.4rem;
    font-weight: 300;
    color: var(--text);
    margin-bottom: 0.2rem;
}
.verify-desc {
    color: var(--text-secondary);
    font-size: 1.04rem;
    margin-bottom: 1rem;
}
.verify-btn {
    background: var(--primary);
    color: #16222a;
    font-weight: 300;
    border-radius: 12px;
    padding: 0.5rem 1.6rem;
    margin-bottom: 0.7rem;
    transition: background .18s;
    border: none;
    outline: none;
    font-size: 1.1rem;
}
.verify-btn:hover { background: var(--primary-dark); color: #fff; }
.verify-banner {
    border-radius: 16px;
    overflow: hidden;
    background: #222b34;
    width: 320px;
    min-width: 200px;
}
.verify-banner-img {
    width: 100%;
    height: 130px;
    object-fit: cover;
    display: block;
    background: #191c24;
    position: relative;
}
.verify-banner-cta {
    position: absolute;
    left: 0; bottom: 0; width: 100%; 
    background: rgba(24,28,35,0.7);
    color: var(--primary);
    font-size: 1.6rem;
    font-weight: 300;
    padding: 0.6rem 1.2rem;
    letter-spacing: 1px;
    text-shadow: 0 2px 12px #0006;
}
/* Metrics Cards */
.dashboard-metrics {
    display: flex;
    flex-wrap: wrap;
    gap: 1.2rem;
    margin-bottom: 2rem;
}
.metrics-card {
    background: var(--metrics-card-gradient);
    border-radius: 20px;
    min-width: 220px;
    max-width: 260px;
    flex: 1 1 170px;
    padding: 0.8rem 1rem 0.6rem 1rem;
    color: var(--text);
    box-shadow: 0 6px 24px 0 rgba(21,41,91,0.10);
    border: none;
    margin-bottom: 0.5rem;
    position: relative;
    height: 110px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    transition: background .3s, color .3s;
}
.metrics-label {
    font-size: 0.96rem;
    color: var(--text-secondary);
    margin-bottom: 0.17rem;
}
.metrics-value {
    font-size: 1.37rem;
    font-weight: 300;
    color: var(--text);
    margin-bottom: 0.25rem;
}
.metrics-toggle {
    position: absolute;
    top: 0.85rem;
    right: 1rem;
}
.metrics-row {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    margin-bottom: 0.05rem;
}
.metrics-row .metrics-label { font-size: 0.91rem; }
.metrics-row .metrics-value { font-size: 0.96rem; }
/* Quick Actions */
.quick-actions-card {
    background: var(--container-bg);
    border-radius: 18px;
    border: 1px solid var(--card-border);
    box-shadow: 0 6px 24px 0 rgba(21,41,91,0.10);
    margin-bottom: 2.5rem;
    padding: 1.1rem 1.1rem 0.7rem 1.1rem;
    transition: background .3s, border .3s;
}
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1.1rem 0.2rem;
    justify-items: center;
}
.quick-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: var(--text);
    min-width: 55px;
    margin-bottom: 0.1rem;
    cursor: pointer;
    transition: color 0.18s;
}
.quick-action-icon {
    width: 38px;
    height: 38px;
    background: var(--icon-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--icon-color);
    box-shadow: 0 2px 12px 0 #28a74510;
    margin-bottom: 0.2rem;
    transition: background .18s, color .18s, transform .16s;
    position: relative;
}
.quick-action:hover .quick-action-icon {
    background: var(--quick-action-hover-bg);
    color: var(--primary-dark);
    transform: scale(1.13) rotate(-3deg);
}
.quick-action-label {
    font-size: 0.82rem;
    font-weight: 300;
    color: var(--quick-action-label);
    text-align: center;
    letter-spacing: 0.01em;
    margin-bottom: 0;
}
/* News Feed */
.news-feed-card {
    background: var(--container-bg);
    border-radius: 18px;
    border: 1px solid var(--card-border);
    box-shadow: 0 6px 24px 0 rgba(21,41,91,0.07);
    margin-bottom: 1.5rem;
    padding: 1.5rem 2rem 2rem 2rem;
    transition: background .3s, border .3s;
}
.news-feed-title {
    color: var(--news-title);
    font-size: 1.18rem;
    font-weight: 300;
    margin-bottom: 1.2rem;
    letter-spacing: 1px;
}
.news-feed-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.news-feed-list li {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    margin-bottom: 1.2rem;
    padding-bottom: 1.2rem;
    border-bottom: 1px solid #28a74510;
    font-size: 1.07rem;
}
.news-feed-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}
.news-feed-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    background: #f0f1f5;
    flex-shrink: 0;
    box-shadow: 0 2px 8px 0 #0001;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
body.dark .news-feed-img { background: #181c23; }
.news-feed-img img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    display: block;
}
.news-feed-content {
    flex: 1 1 0%;
    min-width: 0;
}
.news-feed-headline {
    color: var(--primary);
    font-weight: 600;
    font-size: 1.05em;
    margin-bottom: 3px;
    text-decoration: none;
    word-break: break-word;
    display: block;
}
.news-feed-timestamp {
    color: var(--text-secondary);
    font-size: 0.91rem;
    margin-top: 0.2rem;
    display: block;
}
.news-feed-summary {
    color: var(--text-secondary);
    font-size: 0.98em;
    margin-top: 0.15em;
    word-break: break-word;
}
@media (max-width: 992px) {
    .dashboard-metrics { flex-direction: column; }
    .metrics-card { min-width: 100%; max-width: 100%; height: 95px; }
    .verify-banner { display: none;}
    .quick-actions-card { padding: 0.7rem 0.2rem 0.3rem 0.2rem; }
    .news-feed-card { padding: 1.2rem 1rem 1.5rem 1rem; }
    .quick-actions-grid { grid-template-columns: repeat(5, 1fr); }
}
@media (max-width: 600px) {
    .metrics-card { height: 90px; font-size: 0.97em;}
    .quick-actions-grid { grid-template-columns: repeat(5, 1fr);}
    .verify-card { flex-direction: column; gap: 1rem; padding: 1rem 0.5rem;}
}
</style>
<!-- Theme Toggle Button -->

<main id="content">
    <div class="container dashboard-container">
        <!-- Welcome -->
        <div class="dashboard-welcome">Welcome, <span style="color:var(--primary)"><?= htmlspecialchars($_SESSION['username']); ?></span></div>
        <!-- Verification Card -->
        <?php if ($_SESSION['identity'] != 3) { ?>
        <div class="verify-card">
            <div class="flex-fill">
                <div class="verify-progress mb-2">
                    <div class="step checked"><i class="mdi mdi-check"></i></div>
                    <div class="step-line"></div>
                    <div class="step active">2</div>
                    <div class="step-line"></div>
                    <div class="step">3</div>
                </div>
                <div class="verify-title"><?= htmlspecialchars($_SESSION['username']); ?>, is it really you?</div>
                <div class="verify-desc">
                    Verifying your identity helps us prevent someone else from creating an account in your name.
                </div>
                <a href="./verification" class="verify-btn">Verify Your Account</a>
            </div>
            <div class="verify-banner d-none d-md-block">
                <div style="position:relative;">
                    <img class="verify-banner-img" src="../../assets/images/userverify.png" alt="Verification Prompt">
                    <div class="verify-banner-cta">LET’S TALK<br>VERIFICATION</div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- Metrics Cards -->
        <div class="dashboard-metrics mb-2">
            <div class="metrics-card">
                <div class="metrics-label">Trading Balance</div>
                <div class="metrics-value"><span id="showBal1"><?= $_SESSION['symbol'] . number_format($available, 2); ?></span><span id="showBal11" style="display:none;">******</span></div>
                <div class="metrics-toggle">
                    <a href="javascript:void(0)" id="slashOne" onclick="showBal();"><i class="mdi mdi-eye-off-outline text-secondary"></i></a>
                    <a href="javascript:void(0)" id="slashOnes" onclick="hideBal();" style="display:none;"><i class="mdi mdi-eye-outline text-success"></i></a>
                </div>
                <div class="metrics-row">
                    <span class="metrics-label">Current day loss</span>
                    <span class="text-danger metrics-value" style="font-size:1em;"><span id="showBal22">-<?= $_SESSION['symbol'].number_format($currdayloss, 2); ?></span><span id="showBal23" style="display:none;">*****</span></span>
                </div>
                <div class="metrics-row">
                    <span class="metrics-label">All day gain</span>
                    <span class="text-success metrics-value" style="font-size:1em;"><span id="showBal24">+<?= $_SESSION['symbol'].number_format($alldaygain, 2); ?></span><span id="showBal25" style="display:none;">*****</span></span>
                </div>
            </div>
            <!-- (other metrics cards can go here) -->
        </div>
        <!-- Quick Actions -->
        <div class="quick-actions-card mb-4">
            <div class="quick-actions-grid">
                <a class="quick-action" href="chart">
                    <div class="quick-action-icon"><i class="mdi mdi-chart-line-variant"></i></div>
                    <div class="quick-action-label">Trade</div>
                </a>
                <a class="quick-action" href="market">
                    <div class="quick-action-icon"><i class="mdi mdi-finance"></i></div>
                    <div class="quick-action-label">Market</div>
                </a>
                <a class="quick-action" href="deposit">
                    <div class="quick-action-icon"><i class="mdi mdi-cash-plus"></i></div>
                    <div class="quick-action-label">Deposit</div>
                </a>
                <a class="quick-action" href="withdrawal">
                    <div class="quick-action-icon"><i class="mdi mdi-cash-minus"></i></div>
                    <div class="quick-action-label">Withdraw</div>
                </a>
                <a class="quick-action" href="portfolio">
                    <div class="quick-action-icon"><i class="mdi mdi-wallet"></i></div>
                    <div class="quick-action-label">Portfolio</div>
                </a>
                
                
                <a class="quick-action" href="commodities">
                    <div class="quick-action-icon"><i class="mdi mdi-cube"></i></div>
                    <div class="quick-action-label">Commodity</div>
                </a>
                
            
                <a class="quick-action" href="upgrade">
                    <div class="quick-action-icon"><i class="mdi mdi-arrow-up-bold"></i></div>
                    <div class="quick-action-label">Upgrade</div>
                </a>
                <a class="quick-action" href="traders">
                    <div class="quick-action-icon"><i class="mdi mdi-account-multiple"></i></div>
                    <div class="quick-action-label">CopyTrader</div>
                </a>
                
                <a class="quick-action" href="claimbonus">
                    <div class="quick-action-icon"><i class="mdi mdi-gift"></i></div>
                    <div class="quick-action-label">Bonus</div>
                </a>
                
                <a class="quick-action" href="settings">
                    <div class="quick-action-icon"><i class="mdi mdi-cog-outline"></i></div>
                    <div class="quick-action-label">Settings</div>
                </a>
            </div>
        </div>
        <!-- Real-Time News Feed -->
        <div class="news-feed-card" id="newsFeedContainer">
            <div class="news-feed-title">
                <i class="mdi mdi-newspaper-variant-multiple-outline"></i> Real-Time Financial News
            </div>
            <ul class="news-feed-list" id="newsFeedList">
                <li>Loading latest news...</li>
            </ul>
        </div>
    </div>
</main>
<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script>
function setTheme(mode) {
    if (mode === "dark") {
        document.body.classList.add("dark");
        document.getElementById('themeLabel').innerText = "Dark";
        document.getElementById('darkIcon').style.display = "";
        document.getElementById('lightIcon').style.display = "none";
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.remove("dark");
        document.getElementById('themeLabel').innerText = "Light";
        document.getElementById('darkIcon').style.display = "none";
        document.getElementById('lightIcon').style.display = "";
        localStorage.setItem('theme', 'light');
    }
}
function toggleTheme() {
    if (document.body.classList.contains("dark")) {
        setTheme('light');
    } else {
        setTheme('dark');
    }
}
(function() {
    let mode = localStorage.getItem('theme');
    if (mode === "dark") setTheme("dark");
    else setTheme("light");
})();

// Hide/Show Balance
function showBal() {
    $("[id^='showBal1'],[id^='showBal12'],[id^='showBal121'],[id^='showBal2'],[id^='showBal24'],[id^='showBal22']").show();
    $("[id^='showBal11'],[id^='showBal13'],[id^='showBal131'],[id^='showBal21'],[id^='showBal23'],[id^='showBal25']").hide();
    $("[id^='slashOne'],[id^='slashTwo'],[id^='slashTwoe']").hide();
    $("[id^='slashOnes'],[id^='slashTwos'],[id^='slashTwose']").show();
}
function hideBal() {
    $("[id^='showBal1'],[id^='showBal12'],[id^='showBal121'],[id^='showBal2'],[id^='showBal24'],[id^='showBal22']").hide();
    $("[id^='showBal11'],[id^='showBal13'],[id^='showBal131'],[id^='showBal21'],[id^='showBal23'],[id^='showBal25']").show();
    $("[id^='slashOne'],[id^='slashTwo'],[id^='slashTwoe']").show();
    $("[id^='slashOnes'],[id^='slashTwos'],[id^='slashTwose']").hide();
}
// Real-time news - using finnhub.io, with images and better layout
function loadNewsFeed() {
    const apiKey = 'd16a6q1r01qvtdbhagtgd16a6q1r01qvtdbhagu0'; // <-- Replace with your finnhub.io API key
    $.ajax({
        url: "https://finnhub.io/api/v1/news?category=general&token=" + apiKey,
        method: "GET",
        success: function(data) {
            let newsList = $("#newsFeedList");
            newsList.html("");
            if (Array.isArray(data) && data.length > 0) {
                data.slice(0, 7).forEach(function(news) {
                    let date = new Date(news.datetime * 1000);
                    let image = news.image ? news.image : "https://via.placeholder.com/60x60?text=News";
                    let headline = news.headline ? news.headline : "No title";
                    let summary = news.summary ? news.summary : "";
                    let url = news.url ? news.url : "#";
                    newsList.append(
                        `<li>
                            <div class="news-feed-img">
                                <img src="${image}" alt="News" width="60" height="60" loading="lazy">
                            </div>
                            <div class="news-feed-content">
                                <a href="${url}" target="_blank" class="news-feed-headline">${headline}</a>
                                <span class="news-feed-timestamp">${date.toLocaleString()}</span>
                                ${summary ? `<div class="news-feed-summary">${summary}</div>` : ""}
                            </div>
                        </li>`
                    );
                });
            } else {
                newsList.html("<li>No news found at the moment.</li>");
            }
        },
        error: function() {
            $("#newsFeedList").html("<li>Failed to load news. Please try again later.</li>");
        }
    });
}
$(document).ready(function() {
    loadNewsFeed();
    setInterval(loadNewsFeed, 60000); // refresh every 60 seconds
});
</script>