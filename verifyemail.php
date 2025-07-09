<?php
session_start(); // Initialize the session
$currentPage = "verify-email";
include "header.php";

if (!isset($_GET["mem_id"]) || !isset($_GET['token'])) {
    header("Location: ./signin");
    exit();
} else {
    $mem_id = filter_var(htmlentities($_GET['mem_id']), FILTER_UNSAFE_RAW);
    $token = filter_var(htmlentities($_GET['token']), FILTER_UNSAFE_RAW);

    error_log("mem_id: $mem_id, token: $token");

    try {
        // Fetch the user
        $getuser = $db_conn->prepare("SELECT token FROM members WHERE mem_id = :mem_id AND token = :token");
        $getuser->bindParam(":mem_id", $mem_id, PDO::PARAM_STR);
        $getuser->bindParam(":token", $token, PDO::PARAM_STR);
        $getuser->execute();

        if ($getuser->rowCount() < 1) {
            $message = "Email Verification failed!";
            error_log("Email verification failed: No matching user found.");
        } else {
            $user = $getuser->fetch(PDO::FETCH_ASSOC);
            error_log("Database token: " . $user['token']);

            $optionsreset = array(
                SITE_NAME => 32,
            );
            $status = 1; 
            $newhash = password_hash($mem_id, PASSWORD_BCRYPT, $optionsreset);

            $updateHash = $db_conn->prepare("UPDATE members SET token = :newhash, trader_status = :status WHERE mem_id = :mem_id");
            $updateHash->bindParam(":newhash", $newhash, PDO::PARAM_STR);
            $updateHash->bindParam(":status", $status, PDO::PARAM_STR); 
            $updateHash->bindParam(":mem_id", $mem_id, PDO::PARAM_INT);

            if ($updateHash->execute()) {
                session_destroy();
                session_unset();
                $message = "Email address has been verified successfully";
                error_log("Email verification successful for mem_id: $mem_id");
            } else {
                $message = "There was an error verifying your email address";
                error_log("Email verification failed: Database update error.");
            }
        }
    } catch (PDOException $e) {
        $message = "There was an error verifying your email address";
        error_log("Database error: " . $e->getMessage());
    }
}
?>
<title>Email Verification - Best Trading Platform</title>
<?php include "pageheader.php"; ?>
<!-- Start About -->
<section class="section pt-5">
    <div class="container pt-4">
        <h2 class="text-center fw-bolder mb-4">Verify Email Address</h2>
        <p class="alert alert-primary text-center"><?= $message; ?></p>
    </div><!--end container-->
</section><!--end section-->
<!-- End About -->
<?php include "footer.php"; ?>
<script>
    <?php if ($message == "Email address has been verified successfully") { ?>
        console.log("Redirecting to signin page...");
        setTimeout(function() {
            window.location.href = "./signin";
        }, 5000);
    <?php } ?>
</script>