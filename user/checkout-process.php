<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../assets/midtrans-php-master/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-QKWObO5iQ2xc73Q6TB3mzMDr';
Config::$clientKey = 'SB-Mid-client-kF2i2-F_s7dkQbKV';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required

include "../assets/conn/koneksi.php";
$id_invoice = $_GET['id_invoice'];

$query = "SELECT user.*,invoice.* FROM user INNER JOIN invoice ON user.id_user=invoice.id_user WHERE id_invoice='" . $id_invoice . "'";
$sql = mysqli_query($conn, $query);
$data = mysqli_fetch_array($sql);
$biaya = $data['jumlah_invoice'];
$transaction_details = array(
    'order_id' => $id_invoice,
    'gross_amount' =>  $biaya,
);

$transaction = array(
    'transaction_details' => $transaction_details,
);

// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,

);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}


function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-QKWObO5iQ2xc73Q6TB3mzMDr\';');
        die();
    }
}

?>



<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Metode Pembayaran</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Dashboard/<a href="index.php?page=4">Metode Pembayaran</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                        <option selected>Aug 19</option>
                        <option value="1">July 19</option>
                        <option value="2">Jun 19</option>
                    </select>
                </div>
            </div> -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-body">
                        <button id="pay-button" class="btn btn-primary">PILIH METODE PEMBAYARAN</button>

                        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
                        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
                        <script type="text/javascript">
                            document.getElementById('pay-button').onclick = function() {
                                // SnapToken acquired from previous step
                                snap.pay('<?php echo $snap_token ?>');
                            };
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>