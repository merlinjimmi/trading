<?php include 'header.php'; ?>
<br><br>
<title>My Trades - <?= SITE_NAME; ?></title>

<style>
:root {
  --finapp-bg-main: #f8f9fa;
  --finapp-bg-card: #ffffff;
  --finapp-bg-header: #f1f3f7;
  --finapp-bg-tab: #f1f3f7;
  --finapp-bg-tab-active: #e9ecef;
  --finapp-bg-trade: #f1f3f7;
  --finapp-bg-cash: #e9ecef;
  --finapp-border: #e2e6ea;
  --finapp-text-main: #181B24;
  --finapp-text-muted: #6c757d;
  --finapp-success: #28a745;
  --finapp-danger: #F55A5A;
  --finapp-btn-deposit-bg: #28a745;
  --finapp-btn-deposit-text: #fff;
  --eh-sidebar-width: 420px;
}
body.dark {
  --finapp-bg-main: #181B24;
  --finapp-bg-card: #23283A;
  --finapp-bg-header: #222633;
  --finapp-bg-tab: #252B3A;
  --finapp-bg-tab-active: #363C4F;
  --finapp-bg-trade: #222633;
  --finapp-bg-cash: #23283A;
  --finapp-border: #31374B;
  --finapp-text-main: #fff;
  --finapp-text-muted: #b8bece;
  --finapp-success: #28a745;
  --finapp-danger: #F55A5A;
  --finapp-btn-deposit-bg: #28a745;
  --finapp-btn-deposit-text: #181B24;
}
body, #content {
    background: var(--finapp-bg-main) !important;
    color: var(--finapp-text-main) !important;
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
}
.finapp-header {
    background: var(--finapp-bg-header);
    padding: 2rem 1.5rem 1rem 1.5rem;
    border-radius: 1.2rem;
    margin-bottom: 2rem;
}
.finapp-header h2 {
    font-weight: 300;
    font-size: 2rem;
    margin-bottom: .5rem;
    color: var(--finapp-text-main);
}
.finapp-header .finapp-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.finapp-tabs .tab {
    border: none;
    background: var(--finapp-bg-tab);
    color: var(--finapp-text-muted);
    padding: .6rem 1.4rem;
    border-radius: 1.5rem;
    font-weight: 300;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background .2s,color .2s;
}
.finapp-tabs .tab.active, .finapp-tabs .tab:hover {
    background: var(--finapp-bg-tab-active);
    color: var(--finapp-text-main);
}
.finapp-card {
    background: var(--finapp-bg-card);
    border-radius: 1.2rem;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    border: none;
    margin-bottom: 1.2rem;
}
.finapp-card .card-body {
    padding: 1.4rem 1.2rem;
}
.trade-list .finapp-trade-card {
    background: var(--finapp-bg-trade);
    border-radius: 1.1rem;
    margin-bottom: 1rem;
    border: 1.5px solid var(--finapp-border);
    transition: border .2s;
    cursor: pointer;
}
.trade-list .finapp-trade-card:hover {
    border: 1.5px solid var(--finapp-success);
}
.finapp-trade-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.finapp-trade-asset {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.finapp-trade-asset img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--finapp-bg-main);
    padding: 3px;
}
.finapp-trade-asset h6, .finapp-trade-asset span {
    font-weight: 300;
    font-size: 1.1rem;
    color: var(--finapp-text-main);
    margin-bottom: 0;
}
.finapp-badge {
    padding: .5rem 1rem;
    border-radius: 999px;
    font-weight: 300;
    font-size: 1rem;
    background: var(--finapp-bg-card);
    color: var(--finapp-text-main);
    min-width: 82px;
    text-align: center;
}
.finapp-badge.buy {
    background: var(--finapp-success);
    color: var(--finapp-btn-deposit-text);
}
.finapp-badge.sell {
    background: var(--finapp-danger);
    color: #fff;
}
.finapp-trade-profit {
    font-size: 1rem;
    font-weight: 300;
}
.finapp-trade-profit.positive { color: var(--finapp-success); }
.finapp-trade-profit.negative { color: var(--finapp-danger); }
.finapp-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 4rem 1rem 2.5rem 1rem;
    background: var(--finapp-bg-card);
    border-radius: 1.2rem;
    margin-bottom: 2rem;
}
.finapp-empty img {
    width: 110px;
    opacity: .55;
    margin-bottom: 1.2rem;
}
.finapp-empty h4 {
    font-size: 1.4rem;
    font-weight: 300;
    margin-bottom: .5rem;
    color: var(--finapp-text-main);
}
.finapp-empty p {
    color: var(--finapp-text-muted);
    font-size: 1.07rem;
    margin-bottom: 0;
}
.finapp-cash-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--finapp-bg-cash);
    border-radius: 1.1rem;
    padding: 1.5rem 1.2rem;
    margin-top: 1.5rem;
    margin-bottom: 2.5rem;
}
.finapp-cash-row .cash-label {
    color: var(--finapp-text-muted);
}
.finapp-cash-row .cash {
    font-size: 1.2rem;
    color: var(--finapp-text-main);
    font-weight: 300;
}
.finapp-cash-row .deposit-btn {
    background: var(--finapp-btn-deposit-bg);
    color: var(--finapp-btn-deposit-text);
    font-weight: 300;
    border: none;
    border-radius: 2rem;
    padding: .8rem 2.2rem;
    font-size: 1.1rem;
    box-shadow: 0 2px 8px rgba(56,217,150,.09);
    transition: background .2s;
}
.finapp-cash-row .deposit-btn:hover {
    background: #28a745;
}
.earning-history-table th, .earning-history-table td {
    background: transparent !important;
    color: var(--finapp-text-muted);
    font-size: 1rem;
    vertical-align: middle;
}
.earning-history-table th {
    font-weight: 300;
    color: var(--finapp-text-main);
    border-bottom: 1.5px solid var(--finapp-border) !important;
}
.earning-history-table td {
    border-bottom: 1px solid var(--finapp-bg-card) !important;
}
@media (max-width: 600px) {
    .finapp-header {
        padding: 1.2rem .5rem .8rem .5rem;
    }
    .finapp-card .card-body, .finapp-cash-row {
        padding: 1rem .6rem;
    }
}

/* Earning History Side Modal */
.eh-fab-btn {
    position: fixed;
    right: 32px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1051;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--finapp-success);
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 24px rgba(56,217,150,0.16);
    font-size: 2rem;
    transition: background 0.2s, box-shadow 0.2s;
    cursor: pointer;
}

.eh-fab-btn:active, .eh-fab-btn:hover {
    background: #28a745;
}
@media (max-width: 600px) {
    .eh-fab-btn {
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
    }
}
.eh-overlay {
    display: none;
    position: fixed;
    z-index: 1050;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(24,27,36,0.33);
    transition: opacity 0.22s;
}
.eh-overlay.active { display: block; }
.eh-sidebar {
    position: fixed;
    top: 0; right: -100vw;
    width: var(--eh-sidebar-width);
    max-width: 100vw;
    height: 100vh;
    background: var(--finapp-bg-card);
    box-shadow: -6px 0 32px rgba(0,0,0,0.14);
    z-index: 1052;
    transition: right 0.28s cubic-bezier(.24,.97,.53,.9);
    overflow-y: auto;
    border-top-left-radius: 1.35rem;
    border-bottom-left-radius: 1.35rem;
    display: flex;
    flex-direction: column;
}
.eh-sidebar.active { right: 0; }
@media (max-width: 600px) {
    .eh-sidebar { width: 100vw; border-radius: 0; }
}
.eh-sidebar-header {
    background: var(--finapp-bg-header);
    border-top-left-radius: 1.35rem;
    padding: 1.25rem 1.35rem 1rem 1.35rem;
    border-bottom: 1px solid var(--finapp-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.eh-sidebar-header h5 {
    color: var(--finapp-text-main);
    font-weight: 300;
    margin: 0;
    font-size: 1.15rem;
    letter-spacing: 0.01em;
}
.eh-close-btn {
    background: transparent;
    border: none;
    color: var(--finapp-text-muted);
    font-size: 2rem;
    font-weight: 300;
    line-height: 1;
    cursor: pointer;
    transition: color .2s;
}
.eh-close-btn:hover { color: var(--finapp-danger); }
.eh-sidebar .card-body {
    padding: 1.1rem 1.1rem 2rem 1.1rem;
    background: none;
}
</style>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<main class="mt-3 pt-2" id="content">
    <div class="container pt-2">
        <!-- Portfolio Header, Tabs, and Market Status -->
        <div class="finapp-header">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h2>My Portfolio</h2>
                
            </div>
            <div class="finapp-tabs">
                <button class="tab active" id="tab-open" onclick="showTab('open')">Open</button>
                <button class="tab" id="tab-closed" onclick="showTab('closed')">Closed</button>
                <button class="tab disabled" disabled>Market Open</button>
            </div>
        </div>

        <!-- Trades Lists -->
        <div id="tab-content-open" class="trade-list">
            <?php
            $stat = 1;
            $getOpen = $db_conn->prepare("SELECT * FROM trades WHERE tradestatus = :stat AND mem_id = :mem_id");
            $getOpen->bindParam(":stat", $stat, PDO::PARAM_STR);
            $getOpen->bindParam(":mem_id", $mem_id, PDO::PARAM_STR);
            $getOpen->execute();
            if ($getOpen->rowCount() < 1) { ?>
               <div class="finapp-empty">
    <img src="data:image/svg+xml;charset=utf-8;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNDkgMTQ3Ij48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iI0QxRDFEMSIgZD0iTTgxIDR2NTZoNjdDMTMyLTEgODEgNCA4MSA0eiIvPjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjREFEQURBIiBkPSJNNjMgODNWOS4zQzI3LjcgMTIuNSAwIDQyIDAgNzhjMCAzOC4xIDMxLjEgNjkgNjkuNCA2OSAyMS42IDAgNDEtOS45IDUzLjctMjUuM0w2MyA4M3oiLz48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iI0QxRDFEMSIgZD0iTTEzNCA3OEg3NGw1MyAzNGM5LjMtMTMuNiA3LTM0IDctMzR6Ii8+PC9zdmc+" alt="Pie Chart" style="width:150px;opacity:.55;margin-bottom:1.2rem;" />
    <h4>Your portfolio is empty</h4>
    <p style="font-size:1rem; text-align: center">Start exploring investment opportunities by copying people and investing in markets or SmartPortfolios</p>
</div>
            <?php } else {
                while ($row = $getOpen->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="finapp-trade-card" onclick="redir('tradedetails', {tradeid: '<?= $row['tradeid'] ?>'})">
                        <div class="finapp-trade-details">
                            <div class="finapp-trade-asset">
                                <img src="../../assets/images/svgs/<?= strtolower($row['asset']); ?>-image.svg" alt="<?= $row['small_name']; ?>">
                                <h6><?= ucfirst($row['small_name']); ?></h6>
                            </div>
                            <div class="finapp-badge <?= strtolower($row['tradetype']) == 'buy' ? 'buy' : 'sell' ?>">
                                <?= $row['tradetype']; ?>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>

        <div id="tab-content-closed" class="trade-list" style="display:none;">
            <?php
            $stat = 0;
            $getClosed = $db_conn->prepare("SELECT * FROM trades WHERE tradestatus = :stat AND mem_id = :mem_id");
            $getClosed->bindParam(":stat", $stat, PDO::PARAM_STR);
            $getClosed->bindParam(":mem_id", $mem_id, PDO::PARAM_STR);
            $getClosed->execute();
            if ($getClosed->rowCount() < 1) { ?>
                <div class="finapp-empty">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828774.png" alt="No Closed Trades" />
                    <h4>No closed trades</h4>
                    <p style="text-align: center">You have no trades that have been closed. Past trades will appear here.</p>
                </div>
            <?php } else {
                while ($row = $getClosed->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="finapp-trade-card" onclick="redir('tradedetails', {tradeid: '<?= $row['tradeid'] ?>'})">
                        <div class="finapp-trade-details">
                            <div class="finapp-trade-asset">
                                <img src="../../assets/images/svgs/<?= strtolower($row['asset']); ?>-image.svg" alt="<?= $row['small_name']; ?>">
                                <span><?= ucfirst($row['small_name']); ?></span>
                            </div>
                            <div class="finapp-badge <?= strtolower($row['tradetype']) == 'buy' ? 'buy' : 'sell' ?>">
                                <?= $row['tradetype']; ?>
                            </div>
                            <div class="finapp-trade-profit <?= $row['outcome'] == "Profit" ? "positive" : "negative" ?>">
                                <?= $row['outcome'] == "Profit"
                                    ? "+".$_SESSION['symbol']. number_format($row['oamount'],2)
                                    : "-".$_SESSION['symbol']. number_format($row['oamount'],2); ?>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>

        <!-- Total Cash and Deposit button -->
        <div class="finapp-cash-row">
            <div>
                <div class="cash-label">Total Available Cash</div>
                <div class="cash"><?= $_SESSION['symbol']; ?><?= isset($_SESSION['cash']) ? number_format($_SESSION['cash'], 2) : "0.00"; ?></div>
            </div>
            <button class="deposit-btn" onclick="location.href='deposit.php'">
                <i class="bi bi-currency-dollar me-2"></i>Deposit
            </button>
        </div>

        <!-- Earning History FAB button (hidden on sidebar open) -->
        <button class="eh-fab-btn" id="ehFabBtn" onclick="toggleEhSidebar(true)" title="Earning History">
            <i class="fa-regular fa-clock"></i>
        </button>

        <!-- Earning History Sidebar Modal & Overlay -->
        <div class="eh-overlay" id="ehSidebarOverlay" onclick="toggleEhSidebar(false)"></div>
        <aside class="eh-sidebar" id="ehSidebar">
            <div class="eh-sidebar-header">
                <h5>Earning History</h5>
                <button class="eh-close-btn" onclick="toggleEhSidebar(false)" aria-label="Close">&times;</button>
            </div>
            <div class="card-body">
                <div class="table-wrapper table-responsive">
                    <table class="table earning-history-table">
                        <thead>
                            <tr>
                                <th class="text-nowrap">SN</th>
                                <th class="text-nowrap">Date</th>
                                <th class="text-nowrap">Outcome</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $mem_id = $_SESSION['mem_id'];
                            $sql2 = $db_conn->prepare("SELECT * FROM earninghistory WHERE mem_id = :mem_id ORDER BY main_id DESC");
                            $sql2->bindParam(':mem_id', $mem_id, PDO::PARAM_STR);
                            $sql2->execute();
                            if ($sql2->rowCount() < 1) {
                                echo "<tr class='text-center'><td colspan='5'>No earning history available to show</td></tr>";
                            } else {
                                $n = 1;
                                while ($row2 = $sql2->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $n; ?></td>
                                        <td><?= $row2['earndate']; ?></td>
                                        <td>
                                            <?= $row2['outcome'] == 'Profit'
                                                ? '<span class="text-success fw-bold">Profit</span>'
                                                : '<span class="text-danger fw-bold">Loss</span>'; ?>
                                        </td>
                                        <td><?= $_SESSION['symbol']; ?><?= number_format($row2['amount'], 2); ?></td>
                                        <td>
                                            <a href="./tradedetails?tradeid=<?= $row2['tradeid']; ?>" class="btn btn-sm btn-primary">
                                                <span>View</span>
                                            </a>
                                        </td>
                                    </tr>
                            <?php $n++; endwhile;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
    </div>
</main>

<script>
function showTab(tab) {
    document.getElementById('tab-content-open').style.display = (tab === 'open') ? '' : 'none';
    document.getElementById('tab-content-closed').style.display = (tab === 'closed') ? '' : 'none';
    document.getElementById('tab-open').classList.toggle('active', tab === 'open');
    document.getElementById('tab-closed').classList.toggle('active', tab === 'closed');
}

function toggleEhSidebar(open) {
    var sidebar = document.getElementById('ehSidebar');
    var overlay = document.getElementById('ehSidebarOverlay');
    var fab = document.getElementById('ehFabBtn');
    if (open) {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        fab.style.display = 'none';
        document.body.style.overflow = 'hidden';
    } else {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        fab.style.display = '';
        document.body.style.overflow = '';
    }
}
</script>

<br><br><br>
<?php include 'footer.php'; ?>