<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            max-width: 600px;
            height: 650px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: #fff;
            position: relative; 
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h2 {
            font-size: 24px;
            font-weight: bold;
        }
        .invoice-section {
            margin-bottom: 20px;
        }
        .invoice-section h4 {
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .invoice-table {
            width: 100%;
            margin-top: 10px;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #666;
        }
        #saveBtn {
            position: absolute; 
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%); 
        }
    </style>
</head>
<body>

<div class="container mt-5 invoice-container" id="infoSection">
    <div class="invoice-header mt-4">
        <h2>Universitas Almarisah Madani</h2>
        <h5>Informasi Login</h5>
    </div>

    <div class="invoice-section mt-5">
        <h4>Data Login</h4>
        <table class="table invoice-table">
            <tr>
                <th>User Login</th>
                <td id="nik"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td id="pas"></td>
            </tr>
        </table>
    </div>

    <div class="invoice-section">
    <h4>Pilihan Program Studi</h4>
    <table class="table invoice-table">
        <?php 
        $program_studies = [$prodi1, $prodi2, $prodi3]; 
        $pilihan = ['Pertama', 'Kedua', 'Ketiga'];
        foreach ($program_studies as $index => $prodi) {
            if (!empty($prodi)) { 
                echo "<tr>
                        <th>Pilihan " . $pilihan[$index] . "</th>
                        <td>" . htmlspecialchars($prodi) . "</td>
                    </tr>";
            }
        }
        ?>
    </table>
    </div>



    <button style="width:150px" id="saveBtn" class="btn btn-primary btn-save">Save to Image</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    var formData = JSON.parse(sessionStorage.getItem('formData'));
    $('#nik').text(formData.nik);
    $('#pas').text(formData.password);
    
    document.getElementById("saveBtn").addEventListener("click", function() {
        this.style.display = 'none'; 
        
        html2canvas(document.getElementById("infoSection"), {
            background: '#fff', 
        }).then(function(canvas) {
            var link = document.createElement("a");
            link.download = "invoice-" + formData.name + ".png"; 
            link.href = canvas.toDataURL(); // Image data
            link.click(); 
            
            document.getElementById("saveBtn").style.display = 'block'; 
        }).catch(function(error) {
            console.error("Error capturing the image:", error);
            document.getElementById("saveBtn").style.display = 'block'; 
        });
    });
});
</script>



</body>
</html>
