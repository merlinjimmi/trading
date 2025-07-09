<?php include "header.php"; ?>
<br><br>
<title>Deposit - <?= SITE_NAME; ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    body { background: #f4f6fa; }
    #blurContent.blur-bg-active {
        filter: blur(6px) brightness(0.94);
        transition: filter .3s;
        pointer-events: none;
        user-select: none;
    }
    .wallet-card {
        border-radius: 18px;
        box-shadow: 0 2px 14px 0 rgba(60,80,180,0.06);
        background: #fff;
        padding: 0;
        margin-top: 40px;
        margin-bottom: 20px;
    }
    .wallet-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        padding: 20px 14px 10px 14px;
    }
    .total-value-label {
        color: #4a4a4a;
        font-weight: 300;
        font-size: 1rem;
        margin-top: 0;
        margin-bottom: 5px;
    }
    .total-value {
        font-size: 2rem;
        font-weight: 600;
        color: #222;
        margin-bottom: 2px;
        margin-top: 0;
        line-height: 1.2;
    }
    .currency-dropdown-wrapper {
        position: relative;
        margin-left: 18px;
        min-width: 80px;
        display: flex;
        align-items: center;
    }
    .currency-dropdown {
        border-radius: 20px;
        padding: 4px 34px 4px 14px;
        font-size: 1.07rem;
        font-weight: 600;
        color: #222;
        border: 1px solid #e5e9f2;
        background: transparent;
        cursor: pointer;
        outline: none;
        min-width: 80px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        box-sizing: border-box;
        position: relative;
        background-image: none;
        transition: color 0.2s, border 0.2s;
    }
    .currency-dropdown:focus {
        border: 1.2px solid #1ac451;
    }
    .currency-dropdown-arrow {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 1em;
        color: #222;
        z-index: 2;
        transition: color 0.2s;
    }
    .currency-symbol {
        vertical-align: 0.0em;
        margin-right: 2px;
        font-size: 1em;
    }
    .currency-converted-value {
        font-size: 1.15rem;
        color: #1ac451;
        font-weight: 400;
        margin-bottom: 4px;
        padding-left: 14px;
        padding-top: 2px;
    }
    .wallet-card-update-row {
        padding: 0 14px 14px 14px;
        color: #888;
        font-size: .96rem;
    }
    /* Light & Dark mode for dropdown */
    .currency-dropdown, .currency-dropdown option {
        background: transparent;
        color: #222;
    }
    body.dark .currency-dropdown, body.dark .currency-dropdown option {
        color: #fff !important;
        background: transparent !important;
        border-color: #3a3a4d !important;
    }
    body.dark .currency-dropdown-arrow {
        color: #fff !important;
    }
    .account-block {
        background: #f6fafd;
        border-radius: 12px;
        padding: 1.2rem 1rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        position: relative;
        transition: background 0.15s;
    }
    .account-block:hover, .account-block.active { background: #e6f9f0; }
    .account-label {
        font-weight: 300;
        display: flex;
        align-items: center;
        gap: .6rem;
        font-size: 1.1rem;
        color: #111;
    }
    .account-icon {
        background: #28a745;
        color: #fff;
        border-radius: 6px;
        padding: 5px 10px;
        font-size: 1.3rem;
        margin-right: 8px;
    }
    .account-balance { font-size: 1.1rem; font-weight: 300; color: #444; }
    .account-dropdown {
        display: none;
        background: #f6fafd;
        border-radius: 0 0 12px 12px;
        border-top: 1px solid #e5e9f2;
        padding: 0.7rem 1.1rem 0.7rem 2.8rem;
        margin-top: -10px;
        margin-bottom: 14px;
        animation: fadeInDrop .3s;
    }
    @keyframes fadeInDrop {
        0% { opacity: 0; transform: translateY(-12px);}
        100% { opacity: 1; transform: translateY(0);}
    }
    .account-dropdown-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }
    .account-dropdown-label {
        font-size: 1.07rem;
        color: #111;
        font-weight: 300;
    }
    .account-dropdown-value {
        font-size: 1.07rem;
        color: #1ac451;
        font-weight: 300;
    }
    .add-funds-link {
        color: #1ac451;
        font-weight: 300;
        text-align: center;
        display: block;
        font-size: 1.1rem;
        margin: 20px 0 0;
        cursor: pointer;
        transition: color .15s;
    }
    .add-funds-link:hover { color: #19b34b; text-decoration: underline; }
    .chevron-toggle {
        margin-left: 8px;
        transition: transform .23s;
        font-size: 1.08rem;
        color: #28a745;
    }
    .account-block.active .chevron-toggle { transform: rotate(90deg); }
    .fab-transfer {
        background: #28a745 !important;
        color: #fff;
        border: none;
        border-radius: 50px;
        min-width: 56px;
        height: 35px;
        box-shadow: 0 2px 8px 0 rgba(60,180,80,0.12);
        position: fixed;
        right: 22px;
        bottom: 70px;
        z-index: 200;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 300;
        gap: 0.5rem;
        padding: 0 24px 0 18px;
        cursor: pointer;
        transition: filter .1s, background .2s;
        outline: none;
    }
    .fab-transfer:active { filter: brightness(.93); }
    .fab-transfer .fab-icon { font-size: 0.7rem; margin-right: 0.6rem; display: inline-block; }
    .fab-transfer .fab-x { font-size: 0.7rem; margin-right: 0.6rem; display: none; }
    .fab-transfer.open .fab-icon { display: none; }
    .fab-transfer.open .fab-x { display: inline-block; }
    .fab-actions {
        position: fixed;
        right: 38px;
        bottom: 110px;
        display: none;
        flex-direction: column;
        align-items: flex-end;
        z-index: 201;
    }
    .fab-action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 17px;
        background: #fff;
        box-shadow: 0 3px 14px 0 rgba(60,60,60,0.13);
        border-radius: 1.7em;
        padding: 0.60em 1.25em 0.60em 0.7em;
        border: none;
        min-width: 128px;
        font-size: 0.7rem;
        font-weight: 300;
        color: #232323;
        cursor: pointer;
        transition: background .13s, box-shadow .13s;
    }
    .fab-action-btn i {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #eafaf1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        margin-right: 3px;
        color: #28a745 !important;
    }
    .fab-action-btn:active { background: #f4f6fa; box-shadow: 0 2px 6px 0 rgba(60,60,60,0.13); }
    .fab-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.09);
        z-index: 199;
    }
    /* Deposit Modal Styles */
    .deposit-process-modal {
        z-index: 300;
        background: rgba(0,0,0,.22);
        position: fixed;
        left: 0; top: 0; right: 0; bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .deposit-process-dialog {
        background: #fff;
        border-radius: 20px;
        padding: 1.4rem 1rem 1.3rem 1rem;
        width: 92vw;
        max-width: 350px;
        margin: 0 auto;
        box-shadow: 0 3px 28px 0 rgba(40,80,180,0.14);
        position: relative;
        animation: popin .25s cubic-bezier(.67,.06,.38,1.23);
    }
    @keyframes popin {
        0% { transform: scale(.96); opacity: .6; }
        100% { transform: scale(1); opacity: 1; }
    }
    .deposit-title {
        font-weight: 700;
        font-size: 1.07rem;
        margin-bottom: 7px;
        letter-spacing: -.5px;
        text-align: center;
        color: #232323;
    }
    .deposit-note {
        font-size: .96rem;
        color: #7d7d7d;
        margin-bottom: 14px;
        text-align: center;
    }
    .modern-input, .modern-select {
        border-radius: 8px;
        border: 1.2px solid #e5e9f2;
        font-size: 1.02rem;
        padding: .7rem 1rem;
        margin-bottom: 11px;
        width: 100%;
        transition: border .15s;
        background: #fafdff;
        color: #232;
    }
    .modern-input:focus, .modern-select:focus {
        border: 1.2px solid #1ac451;
        outline: none;
    }
    .modern-select {
        padding: .67rem 1rem;
        background: #fafdff;
    }
    .deposit-submit-btn {
        width: 100%;
        background: #1ac451;
        color: #fff;
        border-radius: 8px;
        font-size: 1.06rem;
        font-weight: 300;
        border: none;
        padding: 0.7rem 0;
        margin-top: 9px;
        transition: background .15s;
        letter-spacing: .01em;
    }
    .deposit-submit-btn:active { background: #18a549; }
    .deposit-modal-close {
        position: absolute;
        right: 13px;
        top: 12px;
        border: none;
        background: transparent;
        font-size: 1.25rem;
        color: #888;
        cursor: pointer;
        transition: color .15s;
        z-index: 2;
    }
    .deposit-modal-close:hover { color: #1ac451; }
    .deposit-modal-section-title {
        font-weight: 300;
        font-size: .96rem;
        color: #222;
        margin-bottom: 7px;
        margin-top: 2px;
    }
    .deposit-form-bottom {
        margin-top: 6px;
        text-align: center;
    }
    .deposit-alert {
        color: #d3002d;
        font-size: .91rem;
        text-align: center;
        margin-bottom: 8px;
        display: none;
    }
    
    .btn-primary,
.bg-primary,
.text-primary,
.border-primary,
.alert-primary,
.badge-primary,
.list-group-item-primary,
.table-primary,
.page-link.active,
.active>.page-link,
.btn-outline-primary {
    color: #fff !important;
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}

.btn-outline-primary {
    color: #28a745 !important;
    background-color: transparent !important;
    border-color: #28a745 !important;
}

.text-primary {
    color: #28a745 !important;
}

.bg-primary {
    background-color: #28a745 !important;
}

.border-primary {
    border-color: #28a745 !important;
}

.alert-primary {
    color: #fff !important;
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}

.badge-primary {
    background-color: #28a745 !important;
}

.list-group-item-primary {
    background-color: #28a745 !important;
    color: #fff !important;
}

.table-primary,
.table-primary>td,
.table-primary>th {
    background-color: #28a745 !important;
    color: #fff !important;
}
    
    /* Dark Mode */
    body.dark .wallet-card,
    body.dark .deposit-process-dialog { background: #222633 !important; }
    body.dark .total-value-label,
    body.dark .account-label,
    body.dark .deposit-title,
    body.dark .deposit-note,
    body.dark .account-dropdown-label { color: #e6eaea !important; }
    body.dark .total-value,
    body.dark .account-balance,
    body.dark .account-dropdown-value { color: #fff !important; }
    body.dark .account-block,
    body.dark .account-dropdown { background: #222633 !important; border-color: #32363e !important; }
    body.dark .account-block:hover, body.dark .account-block.active { background: #222633 !important; }
    body.dark .modern-input, body.dark .modern-select { background: #222633 !important; color: #f1f3f4 !important; border-color: #3a3a4d !important; }
    body.dark .modern-input::placeholder { color: #c2c7d0 !important; }
    body.dark .deposit-submit-btn { background: #28a745 !important; color: #fff !important; }
    body.dark .deposit-modal-close { color: #aaa !important; }
    body.dark .deposit-modal-close:hover { color: #28a745 !important; }
</style>
<main id="content">
<?php
    $total_balance = isset($available) ? $available : 0.00;
    $profit = isset($profit) ? $profit : 0.00;
    $bonus = isset($bonus) ? $bonus : 0.00;
    $investment_account = $profit + $bonus;
    // The default currency. You can set this via session or config.
    $default_currency = isset($_SESSION['currency']) ? $_SESSION['currency'] : 'USD';
?>
<div id="blurContent">
    <div class="container" style="position: relative;">
        <div class="wallet-card" style="position: relative;">
            <div class="wallet-header-row">
                <div>
                    <div class="total-value-label">Your Total Value</div>
                    <div class="total-value" id="totalValueDisplay">
                        <span class="currency-symbol" id="currencySymbol"><?= $_SESSION['symbol']; ?></span>
                        <span id="balanceAmount"><?= number_format($total_balance, 2); ?></span>
                    </div>
                </div>
                <div class="currency-dropdown-wrapper">
                    <select id="currencyDropdown" class="currency-dropdown">
                        <option value="USD" data-symbol="$">USD</option>
                        <option value="EUR" data-symbol="€">EUR</option>
                        <option value="GBP" data-symbol="£">GBP</option>
                        <!-- Add more currencies if needed -->
                    </select>
                    <span class="currency-dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                </div>
            </div>
            <div class="currency-converted-value" id="convertedValue" style="display:none;"></div>
            <div class="wallet-card-update-row">
                Last update at <?= date('H:i, d/m/Y'); ?>
            </div>
        </div>
        <div style="padding: 8px 0 10px 0;">
            <div class="account-block" id="investmentAccountBlock" tabindex="0">
                <div class="account-label">
                    <span class="account-icon"><i class="fas fa-chart-pie"></i></span>
                    Investment Account
                    <span class="chevron-toggle"><i class="fas fa-chevron-right"></i></span>
                </div>
                <div class="account-balance"><?= $_SESSION['symbol']; ?><?= number_format($investment_account, 2); ?></div>
            </div>
            <div class="account-dropdown" id="investmentDropdown">
                <div class="account-dropdown-row">
                    <span class="account-dropdown-label">Profit</span>
                    <span class="account-dropdown-value"><?= $_SESSION['symbol']; ?><?= number_format($profit, 2); ?></span>
                </div>
                <div class="account-dropdown-row">
                    <span class="account-dropdown-label">Bonus</span>
                    <span class="account-dropdown-value"><?= $_SESSION['symbol']; ?><?= number_format($bonus, 2); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAB and Actions OUTSIDE the blur area -->
<button class="fab-transfer" id="fabTransferBtn" onclick="toggleFabActions()" aria-label="Transfer">
    <span class="fab-icon"><i class="fas fa-plus"></i></span>
    <span class="fab-x"><i class="fas fa-times"></i></span>
    Transfer
</button>
<div class="fab-actions" id="fabActions">
    <button class="fab-action-btn withdraw" onclick="fabAction('withdraw')">
        <i class="fas fa-arrow-up"></i>
        Withdraw
    </button>
    <button class="fab-action-btn deposit" onclick="fabAction('deposit')">
        <i class="fas fa-arrow-down"></i>
        Deposit
    </button>
</div>
<div class="fab-backdrop" id="fabBackdrop" onclick="toggleFabActions()"></div>
<!-- Deposit Modal (updated with robust multi-step process and correct field names/logic) -->
<div id="depositProcessModal" class="deposit-process-modal" style="display:none;">
    <div class="deposit-process-dialog">
        <button class="deposit-modal-close" onclick="closeDepositModal()">&times;</button>
        <div class="deposit-title">Fund Your Account</div>
        <form id="depositForm" enctype="multipart/form-data" method="POST" autocomplete="off">
            <p class="alert alert-primary" id="errorshow" style="display:none;"></p>
            <div id="amountDiv">
                <div class="input-group form-outline my-3">
                    <input value="0" type="number" class="modern-input form-control" placeholder="Amount" min="10" required id="amount" name="amount" aria-label="Amount" aria-describedby="amount-addon" />
                    <span class="input-group-text" id="amount-addon"><?= $_SESSION['currency']; ?></span>
                    <label class="form-label" for="amount">Amount</label>
                </div>
                <div class="form-group my-3">
                    <label class="form-label mb-2" for="aactType">Select option</label>
                    <select class="modern-select form-control browser-default" readonly data-mdb-select-initialized="true" required id="aactType" name="aactType">
                        <option disabled selected>Trading Balance Deposit</option>
                    </select>
                </div>
                <div class="my-3" align="center">
                    <button type="button" id="amountBtn" class="btn btn-md btn-primary btn-block">Proceed</button>
                </div>
            </div>
            <!-- End amount -->
            <div id="selectDiv" style="display:none;">
                <p>Funding Trading Balance Deposit</p>
                <h4><?= $_SESSION['symbol']; ?><span id="amtShow" class="fw-bold"></span></h4>
                <div class="form-group my-3">
                    <label class="form-label mb-2" for="type">Select Payment method</label>
                    <select class="modern-select form-control browser-default" data-mdb-select-initialized="true" required id="type" name="type">
                        <option class="" disabled selected value="">--Select payment methods--</option>
                        <?php
                        // Fetch crypto methods
                        $sqlCrypto = $db_conn->prepare("SELECT * FROM crypto WHERE is_bank = 0");
                        $sqlCrypto->execute();
                        while ($rowCrypto = $sqlCrypto->fetch(PDO::FETCH_ASSOC)) : ?>
                            <option value="<?= $rowCrypto['crypto_name']; ?>"><?= $rowCrypto['crypto_name']; ?></option>
                        <?php endwhile; ?>
                        <!-- Add Bank Deposit Option -->
                        <option value="bank">Bank Deposit</option>
                    </select>
                </div>
                <div class="my-3" align="center">
                    <span class="fas fa-spinner fa-spin" id="spinner"></span>
                    <button type="button" id="selectBtn" class="btn btn-md btn-primary btn-block">Proceed</button>
                </div>
            </div>
            <!-- End select Div -->
            <div id="depositDiv" style="display:none;">
                <p id="sendP" class="text-center"></p>
                <!-- Crypto Fields (Hidden by Default) -->
                <div id="crypto-fields" class="my-4">
                    <div class="input-group form-outline mt-4 mb-3">
                        <input type="text" class="modern-input form-control" readonly placeholder="Wallet address" id="address" name="address" aria-label="address" />
                        <button class="btn btn-primary" id="copyBtn" type="button" data-mdb-ripple-init aria-expanded="false">
                            Copy
                        </button>
                    </div>
                    <a href="javascript:void(0)" onclick="showQrModal();" class="d-flex mb-2 fw-semibold justify-content-end mb-3">
                        <small>Or tap here to reveal Qr Code</small>
                    </a>
                </div>
                <!-- Bank Fields (Hidden by Default) -->
                <div id="bank-fields" class="my-4" style="display: none;">
                    <?php
                    // Fetch all bank details
                    $sqlBank = $db_conn->prepare("SELECT * FROM crypto WHERE is_bank = 1");
                    $sqlBank->execute();
                    while ($rowBank = $sqlBank->fetch(PDO::FETCH_ASSOC)) : ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= $rowBank['bank_name']; ?></h5>
                                <p class="card-text">
                                    <strong>Account Number:</strong> <?= $rowBank['account_number']; ?><br>
                                    <strong>SWIFT Code:</strong> <?= $rowBank['swift_code']; ?>
                                </p>
                                <button type="button" class="btn btn-sm btn-primary copy-btn" data-bank-name="<?= $rowBank['bank_name']; ?>" data-account-number="<?= $rowBank['account_number']; ?>" data-swift-code="<?= $rowBank['swift_code']; ?>">
                                    Copy Details
                                </button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div id="proofDiv" style="display:none;">
                    <div>
                        <label class="form-label mb-0" for="proof">Proof</label>
                        <div class="form-outline my-3">
                            <i class="fas fa-image trailing text-muted"></i>
                            <input type="file" id="proof" name="proof" class="form-control form-icon-trailing">
                        </div>
                    </div>
                </div>
                <div class="my-3" align="center">
                    <button type="button" id="proofBtn" class="btn btn-md btn-outline-primary btn-block mb-3">Upload Proof</button>
                    <button type="submit" class="btn btn-md btn-primary btn-block">Submit request</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="qrModal" class="deposit-process-modal" style="display:none;">
    <div class="deposit-process-dialog" style="text-align:center;">
        <button class="deposit-modal-close" onclick="closeQrModal()">&times;</button>
        <div style="font-weight:600; color:#232; margin-bottom:12px;">Scan to Deposit</div>
        <img id="qrImg" src="" alt="QR Code" style="width:70%;max-width:250px;">
    </div>
</div>
<script>
    // Currency conversion logic
    let currencyRates = {
        "USD": 1,
        "EUR": 0.93, // Example rate, replace with live rate if needed
        "GBP": 0.79
    };
    let currencySymbols = {
        "USD": "$",
        "EUR": "€",
        "GBP": "£"
    };
    document.addEventListener('DOMContentLoaded', function() {
        const defaultCurrency = "<?= $default_currency ?>";
        const dropdown = document.getElementById('currencyDropdown');
        if (dropdown && defaultCurrency) {
            dropdown.value = defaultCurrency;
        }
        updateCurrencyDisplay();

        dropdown.addEventListener('change', function() {
            updateCurrencyDisplay();
        });

        // Investment account dropdown toggle
        var accBlock = document.getElementById('investmentAccountBlock');
        var accDropdown = document.getElementById('investmentDropdown');
        accBlock.addEventListener('click', function(){
            accBlock.classList.toggle('active');
            if(accDropdown.style.display === "block") {
                accDropdown.style.display = "none";
            } else {
                accDropdown.style.display = "block";
            }
        });
        accBlock.addEventListener('blur', function(){
            setTimeout(function() {
                accBlock.classList.remove('active');
                accDropdown.style.display = "none";
            }, 180);
        });

        // Deposit modal logic (jQuery)
        let t_id = '';
        $("#errorshow").fadeOut();
        $("#spinner").hide();
        $("#selectDiv").hide();
        $("#depositDiv").hide();
        $("#proofDiv").hide();

        $("#type").change(() => {
            let val = $('#type').val();
            if (val === "bank") {
                $("#crypto-fields").hide();
                $("#bank-fields").show();
            } else {
                $("#crypto-fields").show();
                $("#bank-fields").hide();
                let request = "getcoin";
                $.ajax({
                    url: '../../ops/users',
                    type: 'POST',
                    data: {
                        request: request,
                        type: val
                    },
                    success: function(data) {
                        var response = $.parseJSON(data);
                        if (response.wallet && response.qrcode) {
                            $('#address').val(response.wallet);
                            $('#address2').val(response.wallet);
                            $('#crypAmount').html($('#amount').val());
                            $('#crypto').html(val);
                            $('#paywith').html(val);
                            $('#qrImg').attr('src', `../../assets/images/wallets/${response.qrcode}`);
                        } else {
                            $('#errorshow').html("No wallet address found for the selected crypto.").fadeIn();
                        }
                    },
                    cache: false,
                    error: function(err) {
                        $('#errorshow').html("An error occurred while fetching the wallet address.").fadeIn();
                        setTimeout(() => {
                            $('#errorshow').fadeOut();
                        }, 5000);
                    }
                });
            }
        });

        $('#amountBtn').click(function() {
            if ($('#amount').val() === "0" || $('#amount').val() === null || $('#amount').val() === "") {
                $("#errorshow").html("Please enter a valid amount").fadeIn();
            } else {
                $('#crypAmount').html($('#amount').val());
                $('#amtShow').html($('#amount').val());
                $("#amountDiv").fadeOut();
                $("#selectDiv").fadeIn();
            }
        });

        $('#selectBtn').click(function() {
            if ($('#type').val() == "" || $('#type').val() == null) {
                $("#errorshow").html("Select a payment method").fadeIn();
            } else {
                $("#selectBtn").fadeOut();
                $("#spinner").fadeIn();
                setTimeout(function() {
                    $("#spinner").fadeOut();
                    $("#selectDiv").fadeOut();
                    $("#depositDiv").fadeIn();
                }, 1200);
                $("#sendP").html(`Send <?= $_SESSION['symbol']; ?>${$("#amount").val()} to the ${$("#type").val()} <br><br> <span class="text-uppercase">to the wallet address Or Bank below or scan the QR code for crypto</span>`);
                let request = "deposit";
                let amount = $('#amount').val();
                let type = $('#type').val();

                $.ajax({
                    url: '../../ops/users',
                    type: 'POST',
                    data: {
                        request,
                        amount,
                        type
                    },
                    beforeSend: function() {
                        $('#errorshow').html("Please wait <span class='fas fa-spinner fa-spin'></span>").fadeIn();
                    },
                    success: function(data) {
                        let response = $.parseJSON(data);
                        if (response.status == "success") {
                            setTimeout(() => {
                                $("#errorshow").html(response.message).fadeIn();
                            }, 1200);
                            t_id = response.transc_id
                        } else {
                            $("#errorshow").html(response.message);
                        }
                    },
                    error: function(err) {
                        $('#errorshow').html("An error has occured! " + err.statusText).fadeIn();
                    }
                });
            }
        });

        $('#proofBtn').click(function() {
            $('#proofDiv').toggle();
        });

        $("#copyBtn").click(function() {
            let text = document.getElementById("address");
            text.select();
            document.execCommand('copy');
            alert('Address copied!');
        });

        $(".copy-btn").click(function() {
            const bankName = $(this).data('bank-name');
            const accountNumber = $(this).data('account-number');
            const swiftCode = $(this).data('swift-code');
            const textToCopy = `Bank Name: ${bankName}\nAccount Number: ${accountNumber}\nSWIFT Code: ${swiftCode}`;
            navigator.clipboard.writeText(textToCopy).then(() => {
                alert('Bank details copied to clipboard!');
            }).catch(() => {
                alert('Failed to copy bank details.');
            });
        });

        $("form#depositForm").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let req = "deposits";
            formData.append('request', req);
            formData.append('transc_id', t_id);
            if ($("#type").val() == null || $("#type").val() == "") {
                $('#errorshow').html("Select a payment method").fadeIn();
            } else {
                $.ajax({
                    url: '../../ops/users',
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        $('#errorshow').html("Please wait <span class='fas fa-spinner fa-spin'></span>").fadeIn();
                    },
                    success: function(data) {
                        let response = $.parseJSON(data);
                        if (response.status == "success") {
                            $("#errorshow").html(response.message).fadeIn();
                            setTimeout(() => {
                                location.reload();
                            }, 2200);
                        } else {
                            $("#errorshow").html(response.message);
                        }
                    },
                    cache: false,
                    error: function(err) {
                        $('#errorshow').html("An error has occured! " + err.statusText).fadeIn();
                    },
                    contentType: false,
                    processData: false
                });
            }
        });
    });

    function updateCurrencyDisplay() {
        const dropdown = document.getElementById('currencyDropdown');
        const selectedCurrency = dropdown.value;
        const rate = currencyRates[selectedCurrency] || 1;
        const symbol = currencySymbols[selectedCurrency] || "$";
        const balance = parseFloat("<?= $total_balance ?>");
        const converted = balance * rate;
        document.getElementById('currencySymbol').textContent = symbol;
        document.getElementById('balanceAmount').textContent = converted.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
        // Show USD equivalent if not USD
        const convertedValueDiv = document.getElementById('convertedValue');
        if(selectedCurrency !== "USD") {
            convertedValueDiv.style.display = 'block';
            convertedValueDiv.textContent = `≈ $${balance.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} USD`;
        } else {
            convertedValueDiv.style.display = 'none';
        }
    }

    function openWithdrawAlert() { alert('Withdraw process coming soon!'); }
    function showFabActions() { toggleFabActions(true); }
    function toggleFabActions(force) {
        const fabActions = document.getElementById('fabActions');
        const fabBackdrop = document.getElementById('fabBackdrop');
        const fabTransferBtn = document.getElementById('fabTransferBtn');
        const blurContent = document.getElementById('blurContent');
        const isOpen = fabActions.style.display === 'flex';
        if ((force === true) || (!isOpen && force === undefined)) {
            fabActions.style.display = 'flex';
            fabBackdrop.style.display = 'block';
            fabTransferBtn.classList.add('open');
            blurContent.classList.add('blur-bg-active');
        } else {
            fabActions.style.display = 'none';
            fabBackdrop.style.display = 'none';
            fabTransferBtn.classList.remove('open');
            blurContent.classList.remove('blur-bg-active');
        }
    }
    function fabAction(type) {
        toggleFabActions(false);
        if (type === 'deposit') {
            openDepositModal();
        } else if (type === 'withdraw') {
            openWithdrawAlert();
        }
    }
    function openDepositModal() {
        document.getElementById('depositProcessModal').style.display = 'flex';
    }
    function closeDepositModal() {
        document.getElementById('depositProcessModal').style.display = 'none';
    }
    function showQrModal() {
        document.getElementById('qrModal').style.display = 'flex';
    }
    function closeQrModal() {
        document.getElementById('qrModal').style.display = 'none';
    }
</script>
<?php include "footer.php"; ?>