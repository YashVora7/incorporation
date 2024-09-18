<?php
require_once '../../session.php';
require_once '../../db.php';
require_once '../../baseUrl.php';
?>
<?php
 $get_officer_id = isset($_GET['officer_id'])? $_GET['officer_id']:' ';

   $sql = "SELECT o.*, c.company_name,c.company_suffix,c.created_at
        FROM officer o
        JOIN register_company c ON o.cr_id = c.id
        WHERE o.id = '$get_officer_id'
        ORDER BY o.id DESC";

    $excute = mysqli_query($link,$sql);
    $result = mysqli_fetch_assoc($excute);
    //print_r($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directors' Resolutions</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <style type="text/css">
        .border-bottom-dot {
            border-radius: none;
            border-top: none;
            border-right: none;
            border-left: none;
            border-bottom: 2px dotted black; /* Dotted border with color #999 */
        }
        .resolution-title {
           text-decoration: underline;
        }

    </style>
</head>
<body>
<section id="pfd_create">
    <div class="container-sm pt-5">
        <div class="row justify-content-center m-4">
            <div class="col-lg-12 text-center">
                <div class="p-3 mb-3">
                    <h5 class="text-center">IMARSHI SOFTWARE TECHNOLOGY PTE. LTD.</h5>
                    <p class="text-center">Incorporated in the Republic of Singapore</p>
                    <p class="text-center mb-4">Company No. 202102883R <br> (the “Company”)</p>
                </div>
            </div>  
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12 text-center">
                <div class="">
                    <h5>DIRECTORS’ RESOLUTIONS IN WRITING PASSED PURSUANT TO THE<br></h5>
                    <h5> COMPANY’S CONSTITUTION</h5>
                </div>
            </div>  
        </div>
    </div>

    <div class="container w-50 ">
        <hr class=" ">
        <div class="mb-4">
            <h5 class="resolution-title">1. CHANGE IN BUSINESS ACTIVITIES</h5>
            <p><span><b>IT WAS RESOLVED THAT</b></span> the Company’s primary business activity and Singapore
            Industrial Classification (SSIC) code be changed to “Other holding companies
            (64202)” with immediate effect;</p>
        </div>
        
        <div class="mb-4">
            <h5 class="resolution-title">2. NOTIFICATION AND LODGEMENT</h5>
            <p><span><b>IT WAS RESOLVED THAT</b></span> the Secretarial Agent of the Company be authorized to
            lodge with the Accounting and Corporate Regulatory Authority all necessary
            documents and forms be completed and signed.</p>
        </div>
        
        <div class=" mt-5">
            <h3>By: ______________________</h3>
            <h6><?php echo $result['officer_name']; ?></h6>
            <h6><?php echo $result['officer_designation']; ?></h6>
            <div class="signature-line mx-auto mt-4"></div>
            <p class="mt-3">Dated: <?php echo date('Y-m-d', strtotime($result['created_at'])); ?></p>
        </div>
    </div>
   </section> 
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            generatePDF();
        });

        // Function to generate PDF
        function generatePDF() {
            const element = document.getElementById('pfd_create');

            html2canvas(element, {
                scale: 2, // Increase the scale to improve quality (optional)
                useCORS: true // Enable CORS (optional)
            }).then(canvas => {

                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                const imgData = canvas.toDataURL('image/png');

                // Calculate dimensions to fit one A4 page (210mm x 297mm)
                const imgWidth = 210; // mm
                const pageHeight = 297; // mm
                const imgHeight = canvas.height * imgWidth / canvas.width;
                
                let yPos = 0;
                let leftHeight = imgHeight;

                pdf.addImage(imgData, 'PNG', 0, yPos, imgWidth, imgHeight);
                
                pdf.save('company_constitution.pdf');
                window.print();
                // Redirect back to the previous page after a delay (optional)
               window.close();
            });
        }
    </script>
</body>
</html>
