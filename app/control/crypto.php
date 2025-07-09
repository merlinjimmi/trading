<?php include 'header.php'; ?>
<title>Add/View Wallets | <?= SITE_NAME; ?></title>
<main class="py-5 px-2" id="content">
    <div class="container text-start pt-5">
        <div class="shadow-3 py-2">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-fill mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-nowrap" id="ex3-tab-1" data-mdb-toggle="pill" href="#acrypto" role="tab" aria-controls="acrypto" aria-selected="true"><i class="fas fa-wallet fa-fw me-2"></i> All Wallets</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-nowrap" id="ex3-tab-2" data-mdb-toggle="pill" href="#addcrypto" role="tab" aria-controls="addcrypto" aria-selected="false"><i class="fas fa-edit fa-fw me-2"></i>Add New Crypto</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-nowrap" id="ex3-tab-3" data-mdb-toggle="pill" href="#addbank" role="tab" aria-controls="addbank" aria-selected="false"><i class="fas fa-university fa-fw me-2"></i>Add Bank Details</a>
                </li>
            </ul>
            <!-- Pills navs -->
            <!-- Pills content -->
            <div class="tab-content" id="ex2-content">
                <div class="tab-pane card fade show active" id="acrypto" role="tabpanel" aria-labelledby="ex3-tab-1">
    <div class="card-body">
        <div class="col-md-6 me-auto ms-auto" align="center">
            <p class="alert alert-primary" id="errorshow1"></p>
        </div>
        <div class="table-wrapper table-responsive">
            <table class="table table-striped table-hover" id="allcrypto">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col-sm">S/N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">SWIFT Code</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch crypto wallets
                    $sqlCrypto = $db_conn->prepare("SELECT * FROM crypto WHERE is_bank = 0 ORDER BY main_id DESC");
                    $sqlCrypto->execute();
                    $b = 1;
                    if ($sqlCrypto->rowCount() < 1) {
                        echo "<tr><td class='text-center' colspan='6'>No crypto wallets available</td></tr>";
                    } else {
                        while ($row = $sqlCrypto->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr class="text-nowrap">
                                <td scope="row"><?= $b; ?></td>
                                <td class="text-left"><?= $row['crypto_name']; ?></td>
                                <td class="text-left"><?= $row['wallet_addr']; ?></td>
                                <td class="text-left">N/A</td>
                                <td class="text-left"><a class="btn btn-sm btn-rounded btn-primary" href="editcrypto?main_id=<?= $row['main_id']; ?>" target="_blank">Edit</a></td>
                                <td class="text-left"><button style="cursor: pointer;" class='btn btn-danger btn-rounded btn-sm' id='btnDel_<?= $row["main_id"]; ?>'> Delete</button></td>
                                <script>
                                    function dele_<?= $row['main_id']; ?>() {
                                        var main_id = "<?= $row['main_id']; ?>";
                                        var barcode = "<?= $row['barcode']; ?>";
                                        $.ajax({
                                            type: 'POST',
                                            url: '../../ops/adminauth',
                                            data: {
                                                request: 'deletecrypto',
                                                main_id,
                                                barcode
                                            },
                                            beforeSend: function() {
                                                $('#errorshow1').html("Deleting <span class='fas fa-spinner fa-spin'></span>").fadeIn();
                                            },
                                            success: function(data) {
                                                if (data == "success") {
                                                    $("#errorshow1").html("Wallet Deleted Successfully <span class='fas fa-check'></span>").fadeIn();
                                                    setTimeout(' window.location.href = "crypto"; ', 3000);
                                                } else {
                                                    $("#errorshow1").html(data).fadeIn();
                                                }
                                            },
                                            error: function(err) {
                                                $("#errorshow1").html("An error occured. <br> Try again. " + err.statusText).fadeIn();
                                            }
                                        });
                                    }

                                    $('#btnDel_<?= $row['main_id']; ?>').click(function() {
                                        dele_<?= $row['main_id']; ?>();
                                    });
                                </script>
                            </tr>
                        <?php $b++;
                        endwhile;
                    }

                    // Fetch bank details
                    $sqlBank = $db_conn->prepare("SELECT * FROM crypto WHERE is_bank = 1 ORDER BY main_id DESC");
                    $sqlBank->execute();
                    if ($sqlBank->rowCount() < 1) {
                        echo "<tr><td class='text-center' colspan='6'>No bank details available</td></tr>";
                    } else {
                        while ($row = $sqlBank->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr class="text-nowrap">
                                <td scope="row"><?= $b; ?></td>
                                <td class="text-left"><?= $row['bank_name']; ?></td>
                                <td class="text-left"><?= $row['account_number']; ?></td>
                                <td class="text-left"><?= $row['swift_code']; ?></td>
                                <td class="text-left"><a class="btn btn-sm btn-rounded btn-primary" href="editbank?main_id=<?= $row['main_id']; ?>" target="_blank">Edit</a></td>
                                <td class="text-left"><button style="cursor: pointer;" class='btn btn-danger btn-rounded btn-sm' id='btnDelBank_<?= $row["main_id"]; ?>'> Delete</button></td>
                                <script>
                                    function deleBank_<?= $row['main_id']; ?>() {
                                        var main_id = "<?= $row['main_id']; ?>";
                                        $.ajax({
                                            type: 'POST',
                                            url: '../../ops/adminauth',
                                            data: {
                                                request: 'deletebank',
                                                main_id
                                            },
                                            beforeSend: function() {
                                                $('#errorshow1').html("Deleting <span class='fas fa-spinner fa-spin'></span>").fadeIn();
                                            },
                                            success: function(data) {
                                                if (data == "success") {
                                                    $("#errorshow1").html("Bank Details Deleted Successfully <span class='fas fa-check'></span>").fadeIn();
                                                    setTimeout(' window.location.href = "crypto"; ', 3000);
                                                } else {
                                                    $("#errorshow1").html(data).fadeIn();
                                                }
                                            },
                                            error: function(err) {
                                                $("#errorshow1").html("An error occured. <br> Try again. " + err.statusText).fadeIn();
                                            }
                                        });
                                    }

                                    $('#btnDelBank_<?= $row['main_id']; ?>').click(function() {
                                        deleBank_<?= $row['main_id']; ?>();
                                    });
                                </script>
                            </tr>
                        <?php $b++;
                        endwhile;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
                
                
                
                
                
                
                
                
                
                
                
                
                <div class="tab-pane fade" id="addcrypto" role="tabpanel" aria-labelledby="ex3-tab-2">
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="font-weight-bold">Crypto Details</h3>
                                <p>Fill the form below to add a new Wallet </p>
                                <form class="container md-form" id="adcrypto" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <i class="fab fa-ethereum trailing"></i>
                                        <input type="text" id="crypto_name" name="crypto_name" class="form-control form-icon-trailing">
                                        <label for="crypto_name" class="form-label">Crypto Name (e.g. Ethereum)</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <i class="far fa-wallet trailing"></i>
                                        <input type="text" id="wallet_addr" name="wallet_addr" class="form-control form-icon-trailing">
                                        <label for="wallet_addr" class="form-label">Wallet Address</label>
                                    </div>
                                    <div class="md-form">
                                        <label class="form-label" for="qrcode"> Upload Image <span class="far fa-qrcode"></span></label>
                                        <input type="file" id="qrcode" class="form-control" name="qrcode" required="">
                                    </div>
                                    <div class="form-group mt-3" align="center">
                                        <p class="alert alert-primary" id="errorshow2"></p>
                                    </div>
                                    <center>
                                        <div class="col-md-5 ms-auto me-auto mb-3 mt-3">
                                            <button type="submit" id="btnAdd" class="btn btn-md btn-block btn-primary btn-rounded z-depth-1a">Add Crypto</button>
                                        </div>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="addbank" role="tabpanel" aria-labelledby="ex3-tab-3">
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="font-weight-bold">Bank Details</h3>
                                <p>Fill the form below to add bank details for deposits</p>
                                <form class="container md-form" id="adbank" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <i class="fas fa-university trailing"></i>
                                        <input type="text" id="bank_name" name="bank_name" class="form-control form-icon-trailing">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <i class="fas fa-credit-card trailing"></i>
                                        <input type="text" id="account_number" name="account_number" class="form-control form-icon-trailing">
                                        <label for="account_number" class="form-label">Account Number</label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <i class="fas fa-code trailing"></i>
                                        <input type="text" id="swift_code" name="swift_code" class="form-control form-icon-trailing">
                                        <label for="swift_code" class="form-label">SWIFT Code</label>
                                    </div>
                                    <div class="form-group mt-3" align="center">
                                        <p class="alert alert-primary" id="errorshow3"></p>
                                    </div>
                                    <center>
                                        <div class="col-md-5 ms-auto me-auto mb-3 mt-3">
                                            <button type="submit" id="btnAddBank" class="btn btn-md btn-block btn-primary btn-rounded z-depth-1a">Add Bank Details</button>
                                        </div>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<?php include 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $("#errorshow1").hide();
        $("#errorshow2").hide();
        $("#errorshow3").hide();

        var one = $('#allcrypto').DataTable({
            "pagingType": 'simple_numbers',
            "lengthChange": true,
            "pageLength": 6,
            dom: 'Bfrtip'
        });
    });

    $("form#adcrypto").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var request = "addcrypto";
        formData.append('request', request);
        $.ajax({
            url: '../../ops/adminauth',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#errorshow2').html("Adding wallet <span class='far fa-spinner fa-pulse'></span>").show();
            },
            success: function(data) {
                if (data == "success") {
                    $("#errorshow2").html("New wallet added successfully. <span class='far fa-check-circle'></span>").show();
                    setTimeout(' window.location.reload(); ', 3000);
                } else {
                    $("#errorshow2").html("<span class='far fa-exclamation-triangle'></span> " + data).show();
                }
            },
            cache: false,
            error: function(err) {
                $('#errorshow2').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!" + err).show();
            },
            contentType: false,
            processData: false
        });
    });

    $("form#adbank").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var request = "addbank";
        formData.append('request', request);
        $.ajax({
            url: '../../ops/adminauth',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#errorshow3').html("Adding bank details <span class='far fa-spinner fa-pulse'></span>").show();
            },
            success: function(data) {
                if (data == "success") {
                    $("#errorshow3").html("Bank details added successfully. <span class='far fa-check-circle'></span>").show();
                    setTimeout(' window.location.reload(); ', 3000);
                } else {
                    $("#errorshow3").html("<span class='far fa-exclamation-triangle'></span> " + data).show();
                }
            },
            cache: false,
            error: function(err) {
                $('#errorshow3').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!" + err).show();
            },
            contentType: false,
            processData: false
        });
    });
</script>