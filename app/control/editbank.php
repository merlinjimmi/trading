<?php include "header.php";

if (isset($_GET['main_id'])) {
    $main_id = filter_var(htmlentities($_GET['main_id']), FILTER_UNSAFE_RAW);
} else {
    header("Location: ./");
    exit();
}

$getBank = $db_conn->prepare("SELECT * FROM crypto WHERE main_id = :main_id AND is_bank = 1");
$getBank->bindParam(":main_id", $main_id, PDO::PARAM_STR);
$getBank->execute();
$row = $getBank->fetch(PDO::FETCH_ASSOC);

if ($getBank->rowCount() < 1) {
    header("Location: ./");
    exit();
}
?>
<title>Edit Bank Details | <?= SITE_NAME; ?></title>
<main class="py-5 px-2" id="content">
    <div class="container text-start pt-5">
        <h3 class="fw-bold ps-3"><i class="fas fa-tachometer-alt"></i> Hello, <?= ucfirst($admusername); ?></h3>
        <p class="small mt-0 pt-0 ps-3">Edit Bank Details</p>
        <div class="card shadow-3">
            <div class="card-body">
                <h3 class="fw-bold">Edit Bank Details</h3>
                <p class="">Make changes to Bank Details</p>
                <form class="" id="editbank" enctype="multipart/form-data">
                    <input type="hidden" name="main_id" value="<?= $row['main_id']; ?>">

                    <!-- Bank Name -->
                    <div class="form-outline mb-4">
                        <i class="fas fa-university trailing"></i>
                        <input type="text" id="bank_name" value="<?= $row['bank_name']; ?>" name="bank_name" class="form-control form-icon-trailing">
                        <label for="bank_name" class="form-label">Bank Name</label>
                    </div>

                    <!-- Account Number -->
                    <div class="form-outline mb-4">
                        <i class="fas fa-credit-card trailing"></i>
                        <input type="text" id="account_number" value="<?= $row['account_number']; ?>" name="account_number" class="form-control form-icon-trailing">
                        <label for="account_number" class="form-label">Account Number</label>
                    </div>

                    <!-- SWIFT Code -->
                    <div class="form-outline mb-4">
                        <i class="fas fa-code trailing"></i>
                        <input type="text" id="swift_code" value="<?= $row['swift_code']; ?>" name="swift_code" class="form-control form-icon-trailing">
                        <label for="swift_code" class="form-label">SWIFT Code</label>
                    </div>

                    <!-- Error/Success Message -->
                    <div class="form-group mt-3" align="center">
                        <p class="alert alert-primary" id="errorshow"></p>
                    </div>

                    <!-- Submit Button -->
                    <center>
                        <div class="col-md-5 ms-auto me-auto mb-3 mt-3">
                            <button type="submit" id="btnEditBank" class="btn btn-md btn-block btn-primary btn-rounded z-depth-1a">Update Bank Details</button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
<?php include "footer.php"; ?>
<script>
    $(document).ready(function() {
        $("#errorshow").fadeOut();
    });

    // Handle form submission
    $("form#editbank").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var request = "editbank";
        formData.append('request', request);

        $.ajax({
            url: '../../ops/adminauth',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#errorshow').html("Updating Bank Details <span class='fas fa-spinner fa-pulse'></span>").fadeIn();
            },
            success: function(data) {
                if (data == "success") {
                    $("#errorshow").html("Bank Details Updated Successfully. <br> Redirecting <span class='fas fa-spinner fa-spin'></span>").fadeIn();
                    setTimeout(function() {
                        window.close();
                    }, 4000);
                } else {
                    $("#errorshow").html(data).fadeIn();
                }
            },
            cache: false,
            error: function(err) {
                $('#errorshow').html("An error has occurred!! " + err.statusText).fadeIn();
            },
            contentType: false,
            processData: false
        });
    });
</script>