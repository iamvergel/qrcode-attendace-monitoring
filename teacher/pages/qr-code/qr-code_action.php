<?php
include('../../authentication.php');
include('../../config/dbconn.php');
require '../../../vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

function generateQRCode($data)
{
    $result = Builder::create()
        ->writer(new PngWriter())
        ->data($data)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(200)
        ->margin(10)
        ->build();

    return 'data:image/png;base64,' . base64_encode($result->getString());
}

$grade = $section = '';
$males = $females = [];

if (isset($_GET['grade']) && isset($_GET['section'])) {
    $grade = $_GET['grade'];
    $section = $_GET['section'];

    $query = "SELECT * FROM tbluser WHERE grade='$grade' AND section='$section' ORDER BY gender ASC, lname ASC";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if (strtolower($row['gender']) == 'male') {
            $males[] = $row;
        } else {
            $females[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>QR Code - Grade <?php echo htmlspecialchars($grade); ?> Section <?php echo htmlspecialchars($section); ?>
    </title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {

            button,
            .no-print {
                display: none;
            }
        }

        body {
            font-family: Arial, sans-serif;
        }

        .section-title {
            margin-top: 30px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body class="container">

    <?php if ($grade && $section): ?>
        <div class="d-flex justify-content-between px-3 align-items-center mt-3">
            <h2>Grade: <?php echo htmlspecialchars($grade); ?> - Section: <?php echo htmlspecialchars($section); ?></h2>
            <div class="d-flex align-items-center justify-content-center">
                <button onclick="window.print()" class="btn btn-primary btn-sm print-btn mr-2 px-5">Print</button>
                <button onclick="window.location.href='../qr-code/index.php'" class="btn btn-secondary btn-sm">Back</button>
            </div>
        </div>
        <?php if (!empty($males)): ?>
            <div class="section-title">Male Students</div>
            <div class="row">
                <?php foreach ($males as $user): ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="<?php echo generateQRCode($user['id']); ?>" alt="QR Code" class="img-fluid"><br>
                                <strong><?php echo htmlspecialchars($user['lname'] . ', ' . $user['fname']); ?></strong><br>
                                <?php echo htmlspecialchars($user['grade']); ?> - <?php echo htmlspecialchars($user['section']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($females)): ?>
            <div class="section-title">Female Students</div>
            <div class="row">
                <?php foreach ($females as $user): ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="<?php echo generateQRCode($user['id']); ?>" alt="QR Code" class="img-fluid"><br>
                                <strong><?php echo htmlspecialchars($user['lname'] . ', ' . $user['fname']); ?></strong><br>
                                <?php echo htmlspecialchars($user['grade']); ?> - <?php echo htmlspecialchars($user['section']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <p>Please select a grade and section.</p>
    <?php endif; ?>

</body>

</html>