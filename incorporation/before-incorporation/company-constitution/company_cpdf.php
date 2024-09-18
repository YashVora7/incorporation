<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>

</head>

<body>


    <?php
    require_once '../../session.php';
    require_once '../../db.php';
    require_once '../../baseUrl.php';
    ?>
    <?php
    $get_officer_id = isset($_GET['officer_id']) ? $_GET['officer_id'] : ' ';

    $sql = "SELECT o.*, c.company_name,c.company_suffix,c.created_at
        FROM officer o
        JOIN register_company c ON o.cr_id = c.id
        WHERE o.id = '$get_officer_id'
        ORDER BY o.id DESC";

    $excute = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($excute);

    $sql_company = "SELECT company_name, company_suffix, number_of_shares FROM register_company";
    $resultcompany = $link->query($sql_company);
    //print_r($result);
    ?>

    <?php
    require_once '../vendor/autoload.php'; // Adjust path if needed


    $sql_token = "SELECT * FROM apis_access_tokens";

    $execute_token = mysqli_query($link, $sql_token);
    $result_token = mysqli_fetch_assoc($execute_token);
// check if company constition has already sign by another officer
   $sql = "SELECT id, cr_id, verify_sign_document_company_constition_pdf FROM officer WHERE cr_id = 39";
    $result2 = $link->query($sql);

    if ($result2->num_rows > 0) {
        // Output data of each row
        while($row = $result2->fetch_assoc()) {
            $id = $row['id'];
            $cr_id = $row['cr_id'];
            $pdf = $row['verify_sign_document_company_constition_pdf'];

            // Check if 'verify_sign_document_company_constition_pdf' is NULL
            if (is_null($pdf)) {
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                // Set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Your Name');
                $pdf->SetTitle('Consent to Act as Director');
                $pdf->SetSubject('Form 45');

                // Add a page
                $pdf->AddPage();

                // Set font
                // Set font
                $pdf->SetFont('helvetica', '', 12);

                // Define HTML content with inline CSS
                $html = '<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                    <title>Microsoft Word - Constitution (Amended).docx</title>

                    <meta name="author" content="Dell"/>
                  


                    <style type="text/css">
                        * {
                            margin: 0;
                            padding: 0;
                            text-indent: 0;
                        }

                        .s1 {
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: bold;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        p {
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                            margin: 0pt;
                        }

                        .s2 {
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: bold;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        .s3 {
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        h1 {
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: italic;
                            font-weight: bold;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        .s5 {
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: italic;
                            font-weight: bold;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        li {
                            display: block;
                        }

                        #l1 {
                            padding-left: 0pt;
                            counter-reset: c1 1;
                        }

                        #l1> li>*:first-child:before {
                            counter-increment: c1;
                            content: counter(c1, decimal)" ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l1> li:first-child>*:first-child:before {
                            counter-increment: c1 0;
                        }

                        li {
                            display: block;
                        }

                        #l2 {
                            padding-left: 0pt;
                            counter-reset: d1 6;
                        }

                        #l2> li>*:first-child:before {
                            counter-increment: d1;
                            content: counter(d1, decimal)" ";
                            color: black;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                        }

                        #l2> li:first-child>*:first-child:before {
                            counter-increment: d1 0;
                        }

                        #l3 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l3> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l3> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l4 {
                            padding-left: 0pt;
                            counter-reset: d3 1;
                        }

                        #l4> li>*:first-child:before {
                            counter-increment: d3;
                            content: "("counter(d3, lower-latin)") ";
                            color: #0E0E0E;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l4> li:first-child>*:first-child:before {
                            counter-increment: d3 0;
                        }

                        #l5 {
                            padding-left: 0pt;
                            counter-reset: e1 1;
                        }

                        #l5> li>*:first-child:before {
                            counter-increment: e1;
                            content: "("counter(e1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l5> li:first-child>*:first-child:before {
                            counter-increment: e1 0;
                        }

                        #l6 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l6> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l6> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l7 {
                            padding-left: 0pt;
                            counter-reset: f1 1;
                        }

                        #l7> li>*:first-child:before {
                            counter-increment: f1;
                            content: "("counter(f1, lower-latin)") ";
                            color: #0E0E0E;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l7> li:first-child>*:first-child:before {
                            counter-increment: f1 0;
                        }

                        #l8 {
                            padding-left: 0pt;
                            counter-reset: g1 2;
                        }

                        #l8> li>*:first-child:before {
                            counter-increment: g1;
                            content: "("counter(g1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l8> li:first-child>*:first-child:before {
                            counter-increment: g1 0;
                        }

                        #l9 {
                            padding-left: 0pt;
                            counter-reset: g2 1;
                        }

                        #l9> li>*:first-child:before {
                            counter-increment: g2;
                            content: "("counter(g2, lower-latin)") ";
                            color: #0E0E0E;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l9> li:first-child>*:first-child:before {
                            counter-increment: g2 0;
                        }

                        #l10 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l10> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l10> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l11 {
                            padding-left: 0pt;
                            counter-reset: d3 1;
                        }

                        #l11> li>*:first-child:before {
                            counter-increment: d3;
                            content: "("counter(d3, lower-latin)") ";
                            color: #0E0E0E;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l11> li:first-child>*:first-child:before {
                            counter-increment: d3 0;
                        }

                        #l12 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l12> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l12> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l13 {
                            padding-left: 0pt;
                            counter-reset: h1 1;
                        }

                        #l13> li>*:first-child:before {
                            counter-increment: h1;
                            content: "("counter(h1, lower-latin)") ";
                            color: #0E0E0E;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l13> li:first-child>*:first-child:before {
                            counter-increment: h1 0;
                        }

                        #l14 {
                            padding-left: 0pt;
                            counter-reset: i1 2;
                        }

                        #l14> li>*:first-child:before {
                            counter-increment: i1;
                            content: "("counter(i1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l14> li:first-child>*:first-child:before {
                            counter-increment: i1 0;
                        }

                        #l15 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l15> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l15> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l16 {
                            padding-left: 0pt;
                            counter-reset: d3 1;
                        }

                        #l16> li>*:first-child:before {
                            counter-increment: d3;
                            content: "("counter(d3, lower-latin)") ";
                            color: #0E0E0E;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l16> li:first-child>*:first-child:before {
                            counter-increment: d3 0;
                        }

                        #l17 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l17> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l17> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l18 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l18> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l18> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l19 {
                            padding-left: 0pt;
                            counter-reset: j1 1;
                        }

                        #l19> li>*:first-child:before {
                            counter-increment: j1;
                            content: "("counter(j1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l19> li:first-child>*:first-child:before {
                            counter-increment: j1 0;
                        }

                        #l20 {
                            padding-left: 0pt;
                            counter-reset: k1 2;
                        }

                        #l20> li>*:first-child:before {
                            counter-increment: k1;
                            content: "("counter(k1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l20> li:first-child>*:first-child:before {
                            counter-increment: k1 0;
                        }

                        #l21 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l21> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l21> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l22 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l22> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l22> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l23 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l23> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l23> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l24 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l24> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l24> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l25 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l25> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l25> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l26 {
                            padding-left: 0pt;
                            counter-reset: l1 1;
                        }

                        #l26> li>*:first-child:before {
                            counter-increment: l1;
                            content: "("counter(l1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l26> li:first-child>*:first-child:before {
                            counter-increment: l1 0;
                        }

                        #l27 {
                            padding-left: 0pt;
                            counter-reset: m1 1;
                        }

                        #l27> li>*:first-child:before {
                            counter-increment: m1;
                            content: "("counter(m1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l27> li:first-child>*:first-child:before {
                            counter-increment: m1 0;
                        }

                        #l28 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l28> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l28> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l29 {
                            padding-left: 0pt;
                            counter-reset: n1 1;
                        }

                        #l29> li>*:first-child:before {
                            counter-increment: n1;
                            content: "("counter(n1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l29> li:first-child>*:first-child:before {
                            counter-increment: n1 0;
                        }

                        #l30 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l30> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l30> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l31 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l31> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l31> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l32 {
                            padding-left: 0pt;
                            counter-reset: o1 1;
                        }

                        #l32> li>*:first-child:before {
                            counter-increment: o1;
                            content: "("counter(o1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l32> li:first-child>*:first-child:before {
                            counter-increment: o1 0;
                        }

                        #l33 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l33> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l33> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l34 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l34> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l34> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l35 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l35> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l35> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l36 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l36> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l36> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l37 {
                            padding-left: 0pt;
                            counter-reset: d2 2;
                        }

                        #l37> li>*:first-child:before {
                            counter-increment: d2;
                            content: "("counter(d2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l37> li:first-child>*:first-child:before {
                            counter-increment: d2 0;
                        }

                        #l38 {
                            padding-left: 0pt;
                            counter-reset: p1 1;
                        }

                        #l38> li>*:first-child:before {
                            counter-increment: p1;
                            content: "("counter(p1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l38> li:first-child>*:first-child:before {
                            counter-increment: p1 0;
                        }

                        #l39 {
                            padding-left: 0pt;
                            counter-reset: q1 2;
                        }

                        #l39> li>*:first-child:before {
                            counter-increment: q1;
                            content: "("counter(q1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l39> li:first-child>*:first-child:before {
                            counter-increment: q1 0;
                        }

                        li {
                            display: block;
                        }

                        #l40 {
                            padding-left: 0pt;
                            counter-reset: r1 2;
                        }

                        #l40> li>*:first-child:before {
                            counter-increment: r1;
                            content: "("counter(r1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l40> li:first-child>*:first-child:before {
                            counter-increment: r1 0;
                        }

                        #l41 {
                            padding-left: 0pt;
                            counter-reset: r2 1;
                        }

                        #l41> li>*:first-child:before {
                            counter-increment: r2;
                            content: "("counter(r2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l41> li:first-child>*:first-child:before {
                            counter-increment: r2 0;
                        }

                        li {
                            display: block;
                        }

                        #l42 {
                            padding-left: 0pt;
                            counter-reset: s1 60;
                        }

                        #l42> li>*:first-child:before {
                            counter-increment: s1;
                            content: counter(s1, decimal)" ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l42> li:first-child>*:first-child:before {
                            counter-increment: s1 0;
                        }

                        #l43 {
                            padding-left: 0pt;
                            counter-reset: s2 1;
                        }

                        #l43> li>*:first-child:before {
                            counter-increment: s2;
                            content: "("counter(s2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l43> li:first-child>*:first-child:before {
                            counter-increment: s2 0;
                        }

                        #l44 {
                            padding-left: 0pt;
                            counter-reset: t1 2;
                        }

                        #l44> li>*:first-child:before {
                            counter-increment: t1;
                            content: "("counter(t1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l44> li:first-child>*:first-child:before {
                            counter-increment: t1 0;
                        }

                        #l45 {
                            padding-left: 0pt;
                            counter-reset: s2 1;
                        }

                        #l45> li>*:first-child:before {
                            counter-increment: s2;
                            content: "("counter(s2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l45> li:first-child>*:first-child:before {
                            counter-increment: s2 0;
                        }

                        #l46 {
                            padding-left: 0pt;
                            counter-reset: s2 1;
                        }

                        #l46> li>*:first-child:before {
                            counter-increment: s2;
                            content: "("counter(s2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l46> li:first-child>*:first-child:before {
                            counter-increment: s2 0;
                        }

                        #l47 {
                            padding-left: 0pt;
                            counter-reset: s2 1;
                        }

                        #l47> li>*:first-child:before {
                            counter-increment: s2;
                            content: "("counter(s2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l47> li:first-child>*:first-child:before {
                            counter-increment: s2 0;
                        }

                        #l48 {
                            padding-left: 0pt;
                            counter-reset: s3 1;
                        }

                        #l48> li>*:first-child:before {
                            counter-increment: s3;
                            content: "("counter(s3, lower-roman)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l48> li:first-child>*:first-child:before {
                            counter-increment: s3 0;
                        }

                        li {
                            display: block;
                        }

                        #l49 {
                            padding-left: 0pt;
                            counter-reset: u1 68;
                        }

                        #l49> li>*:first-child:before {
                            counter-increment: u1;
                            content: counter(u1, decimal)" ";
                            color: black;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                        }

                        #l49> li:first-child>*:first-child:before {
                            counter-increment: u1 0;
                        }

                        #l50 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l50> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l50> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l51 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l51> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l51> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l52 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l52> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l52> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l53 {
                            padding-left: 0pt;
                            counter-reset: v1 1;
                        }

                        #l53> li>*:first-child:before {
                            counter-increment: v1;
                            content: "("counter(v1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l53> li:first-child>*:first-child:before {
                            counter-increment: v1 0;
                        }

                        #l54 {
                            padding-left: 0pt;
                            counter-reset: w1 2;
                        }

                        #l54> li>*:first-child:before {
                            counter-increment: w1;
                            content: "("counter(w1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l54> li:first-child>*:first-child:before {
                            counter-increment: w1 0;
                        }

                        #l55 {
                            padding-left: 0pt;
                            counter-reset: x1 1;
                        }

                        #l55> li>*:first-child:before {
                            counter-increment: x1;
                            content: "("counter(x1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l55> li:first-child>*:first-child:before {
                            counter-increment: x1 0;
                        }

                        #l56 {
                            padding-left: 0pt;
                            counter-reset: y1 2;
                        }

                        #l56> li>*:first-child:before {
                            counter-increment: y1;
                            content: "("counter(y1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l56> li:first-child>*:first-child:before {
                            counter-increment: y1 0;
                        }

                        #l57 {
                            padding-left: 0pt;
                            counter-reset: z1 1;
                        }

                        #l57> li>*:first-child:before {
                            counter-increment: z1;
                            content: "("counter(z1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l57> li:first-child>*:first-child:before {
                            counter-increment: z1 0;
                        }

                        #l58 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l58> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l58> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l59 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l59> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l59> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l60 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l60> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l60> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l61 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l61> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l61> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l62 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l62> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l62> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l63 {
                            padding-left: 0pt;
                            counter-reset: c1 1;
                        }

                        #l63> li>*:first-child:before {
                            counter-increment: c1;
                            content: "("counter(c1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l63> li:first-child>*:first-child:before {
                            counter-increment: c1 0;
                        }

                        #l64 {
                            padding-left: 0pt;
                            counter-reset: c2 1;
                        }

                        #l64> li>*:first-child:before {
                            counter-increment: c2;
                            content: "("counter(c2, lower-roman)") ";
                            color: black;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                        }

                        #l64> li:first-child>*:first-child:before {
                            counter-increment: c2 0;
                        }

                        #l65 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l65> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l65> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l66 {
                            padding-left: 0pt;
                            counter-reset: d1 1;
                        }

                        #l66> li>*:first-child:before {
                            counter-increment: d1;
                            content: "("counter(d1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l66> li:first-child>*:first-child:before {
                            counter-increment: d1 0;
                        }

                        #l67 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l67> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l67> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l68 {
                            padding-left: 0pt;
                            counter-reset: e1 1;
                        }

                        #l68> li>*:first-child:before {
                            counter-increment: e1;
                            content: "("counter(e1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l68> li:first-child>*:first-child:before {
                            counter-increment: e1 0;
                        }

                        #l69 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l69> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l69> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l70 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l70> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l70> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l71 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l71> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l71> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l72 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l72> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l72> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l73 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l73> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l73> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l74 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l74> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l74> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l75 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l75> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l75> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l76 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l76> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l76> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l77 {
                            padding-left: 0pt;
                            counter-reset: f1 1;
                        }

                        #l77> li>*:first-child:before {
                            counter-increment: f1;
                            content: "("counter(f1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l77> li:first-child>*:first-child:before {
                            counter-increment: f1 0;
                        }

                        #l78 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l78> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l78> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l79 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l79> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l79> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l80 {
                            padding-left: 0pt;
                            counter-reset: g1 1;
                        }

                        #l80> li>*:first-child:before {
                            counter-increment: g1;
                            content: "("counter(g1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l80> li:first-child>*:first-child:before {
                            counter-increment: g1 0;
                        }

                        #l81 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l81> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l81> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l82 {
                            padding-left: 0pt;
                            counter-reset: u3 1;
                        }

                        #l82> li>*:first-child:before {
                            counter-increment: u3;
                            content: "("counter(u3, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l82> li:first-child>*:first-child:before {
                            counter-increment: u3 0;
                        }

                        #l83 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l83> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l83> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l84 {
                            padding-left: 0pt;
                            counter-reset: u3 1;
                        }

                        #l84> li>*:first-child:before {
                            counter-increment: u3;
                            content: "("counter(u3, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l84> li:first-child>*:first-child:before {
                            counter-increment: u3 0;
                        }

                        #l85 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l85> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l85> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l86 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l86> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l86> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l87 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l87> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l87> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l88 {
                            padding-left: 0pt;
                            counter-reset: h1 2;
                        }

                        #l88> li>*:first-child:before {
                            counter-increment: h1;
                            content: "("counter(h1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l88> li:first-child>*:first-child:before {
                            counter-increment: h1 0;
                        }

                        #l89 {
                            padding-left: 0pt;
                            counter-reset: h2 1;
                        }

                        #l89> li>*:first-child:before {
                            counter-increment: h2;
                            content: "("counter(h2, lower-roman)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l89> li:first-child>*:first-child:before {
                            counter-increment: h2 0;
                        }

                        #l90 {
                            padding-left: 0pt;
                            counter-reset: i1 1;
                        }

                        #l90> li>*:first-child:before {
                            counter-increment: i1;
                            content: "("counter(i1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l90> li:first-child>*:first-child:before {
                            counter-increment: i1 0;
                        }

                        #l91 {
                            padding-left: 0pt;
                            counter-reset: j1 1;
                        }

                        #l91> li>*:first-child:before {
                            counter-increment: j1;
                            content: "("counter(j1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l91> li:first-child>*:first-child:before {
                            counter-increment: j1 0;
                        }

                        #l92 {
                            padding-left: 0pt;
                            counter-reset: k1 1;
                        }

                        #l92> li>*:first-child:before {
                            counter-increment: k1;
                            content: "("counter(k1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l92> li:first-child>*:first-child:before {
                            counter-increment: k1 0;
                        }

                        #l93 {
                            padding-left: 0pt;
                            counter-reset: l1 2;
                        }

                        #l93> li>*:first-child:before {
                            counter-increment: l1;
                            content: "("counter(l1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l93> li:first-child>*:first-child:before {
                            counter-increment: l1 0;
                        }

                        #l94 {
                            padding-left: 0pt;
                            counter-reset: l2 1;
                        }

                        #l94> li>*:first-child:before {
                            counter-increment: l2;
                            content: "("counter(l2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l94> li:first-child>*:first-child:before {
                            counter-increment: l2 0;
                        }

                        #l95 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l95> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l95> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l96 {
                            padding-left: 0pt;
                            counter-reset: m1 1;
                        }

                        #l96> li>*:first-child:before {
                            counter-increment: m1;
                            content: "("counter(m1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l96> li:first-child>*:first-child:before {
                            counter-increment: m1 0;
                        }

                        #l97 {
                            padding-left: 0pt;
                            counter-reset: n1 2;
                        }

                        #l97> li>*:first-child:before {
                            counter-increment: n1;
                            content: "("counter(n1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l97> li:first-child>*:first-child:before {
                            counter-increment: n1 0;
                        }

                        #l98 {
                            padding-left: 0pt;
                            counter-reset: n2 1;
                        }

                        #l98> li>*:first-child:before {
                            counter-increment: n2;
                            content: "("counter(n2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l98> li:first-child>*:first-child:before {
                            counter-increment: n2 0;
                        }

                        #l99 {
                            padding-left: 0pt;
                            counter-reset: o1 1;
                        }

                        #l99> li>*:first-child:before {
                            counter-increment: o1;
                            content: "("counter(o1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l99> li:first-child>*:first-child:before {
                            counter-increment: o1 0;
                        }

                        #l100 {
                            padding-left: 0pt;
                            counter-reset: o2 1;
                        }

                        #l100> li>*:first-child:before {
                            counter-increment: o2;
                            content: "("counter(o2, lower-roman)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l100> li:first-child>*:first-child:before {
                            counter-increment: o2 0;
                        }

                        #l101 {
                            padding-left: 0pt;
                            counter-reset: o2 1;
                        }

                        #l101> li>*:first-child:before {
                            counter-increment: o2;
                            content: "("counter(o2, lower-roman)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l101> li:first-child>*:first-child:before {
                            counter-increment: o2 0;
                        }

                        #l102 {
                            padding-left: 0pt;
                            counter-reset: p1 2;
                        }

                        #l102> li>*:first-child:before {
                            counter-increment: p1;
                            content: "("counter(p1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l102> li:first-child>*:first-child:before {
                            counter-increment: p1 0;
                        }

                        #l103 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l103> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l103> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l104 {
                            padding-left: 0pt;
                            counter-reset: u3 1;
                        }

                        #l104> li>*:first-child:before {
                            counter-increment: u3;
                            content: "("counter(u3, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l104> li:first-child>*:first-child:before {
                            counter-increment: u3 0;
                        }

                        #l105 {
                            padding-left: 0pt;
                            counter-reset: u4 1;
                        }

                        #l105> li>*:first-child:before {
                            counter-increment: u4;
                            content: "("counter(u4, lower-roman)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l105> li:first-child>*:first-child:before {
                            counter-increment: u4 0;
                        }

                        #l106 {
                            padding-left: 0pt;
                            counter-reset: q1 1;
                        }

                        #l106> li>*:first-child:before {
                            counter-increment: q1;
                            content: "("counter(q1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l106> li:first-child>*:first-child:before {
                            counter-increment: q1 0;
                        }

                        #l107 {
                            padding-left: 0pt;
                            counter-reset: r1 2;
                        }

                        #l107> li>*:first-child:before {
                            counter-increment: r1;
                            content: "("counter(r1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l107> li:first-child>*:first-child:before {
                            counter-increment: r1 0;
                        }

                        #l108 {
                            padding-left: 0pt;
                            counter-reset: r2 1;
                        }

                        #l108> li>*:first-child:before {
                            counter-increment: r2;
                            content: "("counter(r2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l108> li:first-child>*:first-child:before {
                            counter-increment: r2 0;
                        }

                        #l109 {
                            padding-left: 0pt;
                            counter-reset: r3 1;
                        }

                        #l109> li>*:first-child:before {
                            counter-increment: r3;
                            content: "("counter(r3, lower-roman)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l109> li:first-child>*:first-child:before {
                            counter-increment: r3 0;
                        }

                        #l110 {
                            padding-left: 0pt;
                            counter-reset: s1 1;
                        }

                        #l110> li>*:first-child:before {
                            counter-increment: s1;
                            content: "("counter(s1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l110> li:first-child>*:first-child:before {
                            counter-increment: s1 0;
                        }

                        #l111 {
                            padding-left: 0pt;
                            counter-reset: t1 2;
                        }

                        #l111> li>*:first-child:before {
                            counter-increment: t1;
                            content: "("counter(t1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l111> li:first-child>*:first-child:before {
                            counter-increment: t1 0;
                        }

                        #l112 {
                            padding-left: 0pt;
                            counter-reset: u2 2;
                        }

                        #l112> li>*:first-child:before {
                            counter-increment: u2;
                            content: "("counter(u2, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l112> li:first-child>*:first-child:before {
                            counter-increment: u2 0;
                        }

                        #l113 {
                            padding-left: 0pt;
                            counter-reset: u1 1;
                        }

                        #l113> li>*:first-child:before {
                            counter-increment: u1;
                            content: "("counter(u1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l113> li:first-child>*:first-child:before {
                            counter-increment: u1 0;
                        }

                        #l114 {
                            padding-left: 0pt;
                            counter-reset: v1 1;
                        }

                        #l114> li>*:first-child:before {
                            counter-increment: v1;
                            content: "("counter(v1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l114> li:first-child>*:first-child:before {
                            counter-increment: v1 0;
                        }

                        #l115 {
                            padding-left: 0pt;
                            counter-reset: w1 2;
                        }

                        #l115> li>*:first-child:before {
                            counter-increment: w1;
                            content: "("counter(w1, decimal)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l115> li:first-child>*:first-child:before {
                            counter-increment: w1 0;
                        }

                        #l116 {
                            padding-left: 0pt;
                            counter-reset: w2 1;
                        }

                        #l116> li>*:first-child:before {
                            counter-increment: w2;
                            content: "("counter(w2, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l116> li:first-child>*:first-child:before {
                            counter-increment: w2 0;
                        }

                        #l117 {
                            padding-left: 0pt;
                            counter-reset: x1 1;
                        }

                        #l117> li>*:first-child:before {
                            counter-increment: x1;
                            content: "("counter(x1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l117> li:first-child>*:first-child:before {
                            counter-increment: x1 0;
                        }

                        #l118 {
                            padding-left: 0pt;
                            counter-reset: y1 1;
                        }

                        #l118> li>*:first-child:before {
                            counter-increment: y1;
                            content: "("counter(y1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9.5pt;
                        }

                        #l118> li:first-child>*:first-child:before {
                            counter-increment: y1 0;
                        }

                        li {
                            display: block;
                        }

                        #l119 {
                            padding-left: 0pt;
                            counter-reset: z1 1;
                        }

                        #l119> li>*:first-child:before {
                            counter-increment: z1;
                            content: counter(z1, lower-latin)") ";
                            color: black;
                            font-family: Arial, sans-serif;
                            font-style: normal;
                            font-weight: normal;
                            text-decoration: none;
                            font-size: 9pt;
                        }

                        #l119> li:first-child>*:first-child:before {
                            counter-increment: z1 0;
                        }

                        table {
                        width: 80%;
                        border-collapse: collapse;
                        text-align: center;
                        margin: auto;
                        }
                        table, th, td {
                            border: 1px solid #dee2e6;
                        }
                        th, td {
                            padding: 50px;
                            text-align: left;
                        }
                    </style>
                </head>
                <body>
                    <p class="s1" style="padding-top: 4pt;padding-left: 33pt;text-indent: 0pt;text-align: center;">' . $result['company_name'] . ' ' . $result['company_suffix'] . '</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l1">
                        <li data-list-text="1">
                            <p style="padding-left: 49pt;text-indent: -39pt;text-align: left;">The name of the company is ' . $result['company_name'] . ' ' . $result['company_suffix'] . '.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="2">
                            <p style="padding-left: 49pt;text-indent: -39pt;text-align: left;">The registered office of the company is situated in the Republic of Singapore.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="3">
                            <p style="padding-left: 49pt;text-indent: -39pt;text-align: left;">The liability of the members is limited.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="4">
                            <p style="padding-left: 50pt;text-indent: -39pt;text-align: justify;">The Company undertakes to take over all the business, assets and liabilities of GODESIGN (ACRA No: 30173600J).</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="5">
                            <p style="padding-left: 49pt;text-indent: -39pt;text-align: left;">The shares capital of the company is SGD50,000.00</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="6">
                            <p style="padding-left: 50pt;text-indent: -39pt;text-align: justify;">We,  the  persons  whose  names  and  occupations  are  set  out  in  this Constitution, desire to form a company in pursuance of this Constitution and we each agree to take the number of shares in the capital of the company set out against our respective names:-</p>
                        </li>
                    </ol>
                    <p style="padding-top: 9pt;text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <table>
                    <thead>
                        <tr>
                            <th>Name and address of sub scriber</th>
                            <th>No of Shares taken</th>
                        </tr>
                    </thead>
                    <tbody>';

                if ($resultcompany->num_rows > 0) {
                    // Output data of each row
                    while ($row = $resultcompany->fetch_assoc()) {
                        $html .= "<tr>
                                    <td>{$row['company_name']} {$row['company_suffix']}</td>
                                    <td>{$row['number_of_shares']}</td>
                                </tr>";
                    }
                } else {
                    $html .= "<tr><td colspan='3'>No records found</td></tr>";
                }

                $html .= '</tbody>
                     </table>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p class="s1" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Date: 14 November 2022</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Interpretation</h1>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l2">
                        <li data-list-text="6">
                            <p style="padding-left: 38pt;text-indent: -38pt;text-align: right;">(1)  In this Constitution —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">“Act” means the Companies Act 1967 (or any statutory modification, amendment or re-enactment thereof for the time being in force or any and every other act for the time being in force concerning companies and affecting the Company and any reference to any provision of the Act is to that provision as so modified, amended or re-enacted or contained in any such subsequent Companies Act;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">“board of directors” means the board of directors of the company;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">“directors” means the directors of the company. A reference in the Constitution to the directors or to any act to be done by the directors, shall where the Company has only one director, be construed to be a reference to that director and a reference to the doing of that act by that director, respectively. Any act to be done by a single director may be done by his alternate director appointed and acting in accordance with the Constitution;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">“electronic register of members” means the electronic register of members kept and maintained by the Registrar for private companies under section 196A of the Act;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">“general meeting” means a general meeting of the company; “member” means a member of the company. A reference in the Constitution to the Members or to any act to be done by the Members, shall where the Company has only one Member be construed to be a reference to that Member, and a reference to the doing of that act by that Member, respectively;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;line-height: 204%;text-align: left;">“Registrar” has the same meaning as in section 4(1) of the Act; “seal” means the common seal of the company;</p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: left;">“secretary” means a secretary of the company appointed under section 171 of the Act.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l3">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 22pt;text-indent: -22pt;text-align: right;">In this Constitution —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l4">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 109pt;text-indent: -37pt;text-align: justify;">expressions referring to writing include, unless the contrary intention appears, references to printing, lithography, photography and other modes of representing or reproducing words in a visible form; and</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 109pt;text-indent: -37pt;text-align: justify;">words or expressions contained in this Constitution must be interpreted in accordance with the provisions of the Interpretation Act (Cap. 1), and of the Act in force as at the date at which this Constitution becomes binding on the company.</p>
                                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <h1 style="padding-left: 180pt;text-indent: 0pt;text-align: left;">Business</h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="7">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Subject to the provisions of the Act, any other written law, or this Constitution, any branch or kind of business is expressly or by implication authorised to be undertaken by the company and may be undertaken by the directors at such time or times as they shall think fit, and further may be suffered by them to be in abeyance, whether such branch or kind of business may have been actually commenced or not, so long as the directors may deem it expedient not to commence or proceed with such branch or kind of business.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 181pt;text-indent: 0pt;text-align: left;">Private Company</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="8">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The company is a private company, and accordingly:-</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l5">
                                <li data-list-text="(1)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">the number of the members of the company (not including persons who are in the employment of the company or of its subsidiary and persons who having been formerly in the employment of the company or of its subsidiary were while in the employment and have continued after the determination of that employment to be members of the company) shall be limited to fifty provided that for the purposes of this provision where two or more persons hold one or more shares in the company jointly they shall be treated as a single member; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">the right to transfer the shares of the company shall be restricted in the manner hereinafter appearing.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 180pt;text-indent: 0pt;text-align: left;">Shares</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="9">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Save as provided by Section 161 of the Act, no shares may be issued by the directors without the prior approval of the company in general meeting but subject thereto and to the provisions of this Constitution, the directors may allot or grant options over or otherwise dispose of the same to such persons on such terms and conditions (subject to the provisions of the Act) and at such time as the company in general meeting may approve.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="10">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The company shall not exercise any right in respect of treasury shares other than as provided by the Act. The rights in relation to treasury shares are to be suspended except for the purposes of bonus shares, share splits and consolidations. Subject thereto, the company may hold or deal with its treasury shares in the manner authorised by, or prescribed pursuant to, the Act.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="11">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">If two or more persons are registered as joint holders of any share any one of such persons may give effectual receipts for any dividend payable in respect of such share and the joint holders of a share shall, subject to the provisions of the Act, be severally as well as jointly liable for the payment of all instalments and calls and interest due in respect of such shares. Such joint holders shall be deemed to be one member and the delivery of a certificate for a share to one of several joint holders shall be sufficient delivery to all such holders.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="12">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">No person shall be recognised by the company as having title to a fractional part of a share or otherwise than as the sole or a joint holder of the entirety of such share.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="13">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">If by the conditions of allotment of any shares the whole or any part of the amount of the issue price thereof shall be payable by instalments every such instalment shall, when due, be paid to the company by the person who for the time being shall be the registered holder of the share or his personal representatives, but this provision shall not affect the liability of any allottee who may have agreed to pay the same.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="14">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The certificate of title to shares in the capital of the company shall be issued under the seal in such form as the directors shall from time to time prescribe and shall bear the autographic or facsimile signatures of at least one director and the secretary or some other person appointed by the directors, and shall specify the number and class of shares to which it relates, whether the shares are fully or partly paid up and the amount (if any) unpaid thereon. No certificate shall be issued representing shares of more than one class. The facsimile signatures may be reproduced by mechanical or other means provided the method or system of reproducing signatures has first been approved by the auditors of the company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Share capital and variation of rights</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="15">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  Without prejudice to any special rights previously conferred on the holders of any existing shares or class of shares but subject to the Act, shares in the company may be issued by the directors.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l6">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Shares referred to in paragraph (1) may be issued with preferred, deferred, or other special rights, privileges, conditions or restrictions, whether in regard to dividend, voting, return of capital, or otherwise, as the directors, subject to any ordinary resolution of the company, determine. The rights attached to shares issued upon special conditions shall be clearly defined in this Constitution.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="16">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  If at any time the share capital is divided into different classes of shares, the rights attached to any class (unless otherwise provided by the terms of issue of the shares of that class) may, subject to the provisions of the Act, whether or not the company is being wound up, be varied or abrogated with</p>
                            <p style="padding-left: 71pt;text-indent: 0pt;text-align: left;">—</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l7">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 109pt;text-indent: -37pt;text-align: justify;">the consent in writing of the holders of 75% of the total voting rights of that class; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 109pt;text-indent: -37pt;text-align: justify;">the sanction of a special resolution passed at a separate general meeting of the holders of the shares of the class.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l8">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">The regulations of this Constitution relating to general meetings apply with the necessary modifications to every separate general meeting of the holders of the shares of the class referred to in paragraph (1), except that —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l9">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 109pt;text-indent: -37pt;text-align: justify;">the necessary quorum is at least 1 person holding or representing by proxy or by attorney one-third of the total voting rights of the class; and</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 109pt;text-indent: -37pt;text-align: justify;">any holder of shares of the class present in person or by proxy or by attorney may demand a poll.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Section 184 of the Act applies with the necessary modifications to every special resolution passed at a separate general meeting of the holders of the shares of the class under paragraph (1).</p>
                                </li>
                            </ol>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="17">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The rights conferred upon the holders of the shares of any class issued with preferred or other rights are, unless otherwise expressly provided by the terms of issue of the shares of that class or by this Constitution as is in force at the time of such issue, treated as being varied by the creation or issue of further shares which rank equally with the shares of that class.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="18">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The company may on any issue of shares pay any commission or brokerage that is permitted by law. Such commission or brokerage may be satisfied by the payment of cash or the allotment of fully or partly paid shares or partly in one way and partly in the other.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="19">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  Except as required by law, no person is to be recognised by the company as holding any share upon any trust.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l10">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Except as required by law or by this Constitution, the company is not bound by or compelled in any way to recognise —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l11">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 109pt;text-indent: -37pt;text-align: left;">any equitable, contingent, future or partial interest in any share or unit of a share; or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 109pt;text-indent: -37pt;text-align: left;">any other rights in respect of any share or unit of share,</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-left: 71pt;text-indent: 0pt;text-align: left;">other than the registered holder’s absolute right to the entirety of the share or unit of share.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Paragraph (2) applies even when the company has notice of any interest or right referred to in paragraph (2)(a) and (b) respectively.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="20">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  Every person whose name is entered as a member in the electronic register of members is entitled without payment within two months after allotment or within one month after the lodgement of any transfer to receive one certificate for all his  shares  of  any  one  class  or  to  several  certificates  in  reasonable denominations each for a part of the shares so allotted or transferred. Where a member transfers part only of the shares comprised in a certificate or where a member requires the company to cancel any certificate or certificates and issue new certificates for the purpose of subdividing his holding in a different manner the old certificate or certificates shall be cancelled and a new certificate or certificates for the balance of such shares issued in lieu thereof and the member shall pay a fee not exceeding $2/ for each such new certificate as the directors may determine.</p>
                            <ol id="l12">
                                <li data-list-text="(2)">
                                    <p style="padding-top: 10pt;padding-left: 71pt;text-indent: -22pt;text-align: justify;">In respect of a share or shares held jointly by several persons, the company is not bound to issue more than one certificate, and delivery of a certificate for a share to one of several joint holders is sufficient delivery to all such holders.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Subject to the provisions of the Act, if any share certificate or other document of title of shares or debentures shall be defaced, worn out, destroyed or lost, it may be renewed on such evidence being produced and such indemnity deemed adequate being given as the Directors shall require, and (in case of defacement or wearing out) on delivery of the old certificate, and upon payment of a fee not exceeding $2, a new certificate or document in lieu thereof shall be given to the person entitled to such defaced, worn out, destroyed or lost certificate.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Lien</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="21">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  The company has a first and paramount lien and charge on —</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l13">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 95pt;text-indent: -23pt;text-align: justify;">every share (that is not a fully paid share) for all money (whether presently payable or not) called or payable at a fixed time in respect of that share, and interest and expenses thereon; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -23pt;text-align: justify;">all shares (other than fully paid shares) registered in the name of a single person for all money presently payable by the person or the person’s estate to the company.</p>
                                </li>
                            </ol>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l14">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">The company’s lien, if any, on a share extends to all dividends payable on the share.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">The directors may at any time declare any share to be wholly or partly exempt from paragraph (1) or (2), or both.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="22">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  Subject to paragraph (2), the company may sell, in any manner as the directors think fit, any shares on which the company has a lien.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l15">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: left;">No sale may be made under paragraph (1) unless —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l16">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 94pt;text-indent: -23pt;text-align: left;">a sum in respect of which the lien exists is presently payable;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 95pt;text-indent: -23pt;text-align: justify;">a notice in writing, stating and demanding payment of the amount in respect of which the lien exists as is presently payable, has been given by the company to the registered holder for the time being of the share, or the person entitled to the share by reason of the death or bankruptcy of the registered holder of the share; and</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(c)">
                                            <p style="padding-left: 95pt;text-indent: -23pt;text-align: justify;">
                                                a period of 14 days has expired after the giving of the notice in sub- paragraph (<i>b</i>
                                                ).
                                            </p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="23">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  To give effect to any sale of shares under regulation 22, the directors may authorise any person to transfer the shares sold to the purchaser of the shares.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l17">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Subject to regulations 33, 34 and 35, the company must lodge a notice of transfer of shares in relation to the shares sold to the purchaser with the Registrar.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">The purchaser of any shares referred to in paragraph (1) is not bound to see to the application of the purchase money, and the purchaser’s title to the shares is not affected by any irregularity or invalidity in the proceedings with respect to the sale of the shares.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="24">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  The proceeds of any sale of shares under regulation 22 received by the company must be applied in payment of any part of the amount in respect of which the lien exists as is presently payable.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l18">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Any remaining proceeds from the sale of shares must (subject to any lien for sums not presently payable as existed upon the shares before the sale but which have become presently payable) be paid to the person entitled to the shares at the date of the sale.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Calls on shares</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="25">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  The directors may from time to time make calls upon the members in respect of any money unpaid on their shares, other than in accordance with the conditions of the allotment of the shares, if both of the following conditions are met:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l19">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 95pt;text-indent: -23pt;text-align: left;">no call is payable at less than one month after the date fixed for the payment of the last preceding call;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -23pt;text-align: left;">at least 14 days’ notice specifying the time or times and the place of payment is given by the company to the members.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l20">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Each member must pay to the company at the time or times and place specified in the notice referred to in paragraph (1) the amount called on the member’s shares.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: left;">The directors may revoke or postpone a call.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="26">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  A call is treated as having been made at the time when the resolution of the directors authorising the call was passed.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l21">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: left;">A call may be required to be paid by instalments.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="27">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The joint holders of a share are jointly and severally liable to pay all calls and instalments and interest in respect of the share.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="28">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  If a sum called in respect of a share is not paid before or on the day appointed for payment of the sum, the person from whom the sum is due must pay interest on the sum for the period beginning on the day appointed for payment of the sum to the time of actual payment of the sum at the rate of 8% per annum.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l22">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">The directors may waive, wholly or in part, the payment of the interest referred to in paragraph (1).</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="29">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  Any sum which, by the terms of issue of a share, becomes payable on allotment or at any fixed date is to be treated as a call duly made and payable on the date on which, by the terms of issue of the share, the sum becomes payable.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l23">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">In the case of non-payment of any sum referred to in paragraph (1), all the provisions of this Constitution as to payment of interest and expenses, forfeiture or otherwise shall apply as if the sum had become payable by virtue of a call duly made and notified.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="30">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The directors may from time to time, on the issue of shares, differentiate between the holders as to the amount of calls to be paid and the times of payment.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="31">
                            <p style="padding-left: 71pt;text-indent: -61pt;text-align: justify;">(1)  The directors may, if they think fit, receive in advance from any member (if the member is willing) all or any part of the money uncalled and unpaid upon any shares held by the member.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l24">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 71pt;text-indent: -22pt;text-align: justify;">Upon the company receiving the money referred to in paragraph (1), the directors may (until the amount would, but for the advance, become payable) pay interest to the member at such rate not exceeding (unless the company in general meeting otherwise directs) 10% per annum as may be agreed upon between the directors and the member.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Transfer of shares</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="32">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to this Constitution, any member may transfer all or any of the member’s shares by instrument in writing in any usual or common form or in any other form which the directors may approve. Shares of different class shall not be comprised in the same instrument of transfer.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l25">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">The instrument of transfer must be executed by or on behalf of the transferor and must be signed by the transferee, and by the witness or witnesses thereto, and the transferor remains the holder of the shares transferred until the name of the transferee is entered in the electronic register of members.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="33">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  To enable the company to lodge a notice of transfer of shares with the Registrar under section 128(1)(a) of the Act, the following items in relation to the transfer of shares must be delivered by the transferor to the registered office of the company:-</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l26">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -22pt;text-align: left;">the instrument of transfer;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 94pt;text-indent: -22pt;text-align: left;">a fee not exceeding $1 as the directors from time to time may require;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 94pt;text-indent: -22pt;text-align: left;">the certificate of the shares to which the instrument of transfer relates;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 95pt;text-indent: -22pt;text-align: left;">any other evidence as the directors may reasonably require to show the right of the transferor to make the transfer.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">(2)  Upon receipt of the items referred to in paragraph (1), the company must, subject to regulation 34, lodge with the Registrar a notice of transfer of shares under section 128 of the Act and retain the instrument of transfer referred to in regulation 32, but any instrument of transfer which the directors may refuse to register shall (except in any case of fraud) be returned to the party presenting the same.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="34">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may decline to lodge a notice of transfer of shares with the Registrar if —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l27">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -22pt;text-align: left;">the shares are not fully paid shares;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 94pt;text-indent: -22pt;text-align: left;">the directors do not approve of the transferee; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 94pt;text-indent: -22pt;text-align: left;">the company has a lien on the shares.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: 0pt;text-align: justify;">but shall in such event, within one month after the date on which the transfer was lodged with the company, send to the transferor and transferee notice of the refusal. If the directors refuse to register a transfer they shall within one month of the date of application for the transfer by notice in writing to the applicant state the facts which are considered to justify the refusal to register the transfer.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">(2)  No share shall in any circumstances be knowingly transferred to any minor who has not attained the age of 18 years, bankrupt or person of unsound mind, and any purported transfer shall be deemed to be void.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="35">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The lodging of any notice of transfer of shares with the Registrar for the purpose of updating the electronic register of members may be suspended at any time and for any period as the directors may from time to time determine, but not for more than a total of 30 days in any year.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Transmission of shares</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="36">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Where a sole holder of shares of the company dies, the company may recognise only the legal personal representatives of the deceased as having any title to the deceased’s interest in the shares.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l28">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">Where a joint holder of shares of the company dies, the company may recognise only the survivor or survivors of the deceased as having any title to the deceased’s interest in the shares</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">Nothing in paragraph (2) releases the estate of the deceased from any liability in respect of any share which had been jointly held by the deceased with other persons.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="37">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Any person becoming entitled to a share in consequence of the death or bankruptcy of a member may, upon such evidence being produced as may from time to time properly be required by the directors, elect to —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l29">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 95pt;text-indent: -22pt;text-align: left;">be registered as holder of the share in the electronic register of members; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -22pt;text-align: left;">nominate another person to be registered as the transferee of the share in the electronic register of members.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">(2)  Despite paragraph (1), the directors have the same right to decline or suspend the lodging of a notice of transfer of shares with the Registrar for the purpose of updating the electronic register of members under regulations 34 and 35 as they would have had in the case of a transfer of the share by the member referred to in paragraph (1) before the death or bankruptcy of the member.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="38">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  If a person becoming entitled to a share in consequence of the death or bankruptcy of a member elects to be registered as holder of the share in the electronic register of members, the person must deliver or send to the company a notice in writing signed by the person stating that the person elects to be registered in the electronic register of members as the holder of the share.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l30">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">If a person becoming entitled to a share in consequence of the death or bankruptcy of a member elects to nominate another person to be registered as the transferee of the share in the electronic register of members, the person must execute a transfer to that other person.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">All the limitations, restrictions, and provisions of this Constitution relating to the right to transfer and the lodging of a notice of transfer by the company in relation to any transfer of shares are applicable to any notice referred to in paragraph (1) or transfer referred to in paragraph (2), as if the death or bankruptcy of the member concerned had not occurred and the notice or transfer were a transfer signed by the member.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="39">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Where the registered holder of any share dies or becomes bankrupt, the personal representative of the registered holder or the assignee of the registered holder’s estate, as the case may be, is, upon the production of such evidence as may from time to time be properly required by the directors, entitled to the same dividends and other advantages, and to the same rights (whether in relation to meetings of the company, or to voting, or otherwise), that the registered holder would have been entitled to if the registered holder had not died or become bankrupt.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l31">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">Where 2 or more persons are jointly entitled to any share in consequence of the death of the registered holder, they are, for the purposes of this Constitution, treated as joint holders of the share.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Forfeiture of shares</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="40">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">If a member fails to pay the whole or any part of any call or instalment of a call on the day appointed for payment of the call or instalment of the call, the directors may, as long as any part of the call or instalment remains unpaid, serve a notice on the member requiring payment of the unpaid part of the call or instalment, together with any interest which may have accrued.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="41">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The notice under regulation 40 must —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l32">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 73pt;text-indent: -24pt;text-align: justify;">name a day (not earlier than 14 days after the date of service of the notice) on or before which the payment required by the notice is to be made; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 73pt;text-indent: -24pt;text-align: justify;">state that, in the event of non-payment at or before the time appointed, the shares in respect of which the call was made is liable to be forfeited.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="42">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  If the requirements of a notice referred to in regulation 41 are not complied with, any share in respect of which the notice was given may, at any time after the notice is given but before the payment required by the notice has been made, be forfeited by a resolution of the directors passed for the purpose of forfeiting the share.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l33">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">Forfeiture under paragraph (1) includes all dividends declared in respect of the forfeited shares and not paid before the forfeiture. The directors may accept a surrender of any share liable to be forfeited hereunder.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="43">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">A forfeited or surrendered share shall become the property of the company and may be sold or otherwise disposed of on any terms and in any manner as the directors think fit, and at any time before a sale or disposition the forfeiture or surrender may be cancelled on any terms as the directors think fit. To give effect to any such sale, the directors may, if necessary, authorise some person to transfer a forfeited or surrendered share to any such person as aforesaid.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="44">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  A person whose shares have been forfeited or surrendered ceases to be a member in respect of the forfeited or surrendered shares.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l34">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">Despite paragraph (1), the person referred to in that paragraph remains liable to pay to the company all money which, at the date of forfeiture or surrender, was payable by the person to the company in respect of the shares (together with interest at the rate of 10% per annum beginning on the date of forfeiture or surrender on the money for the time being unpaid if the directors think fit to enforce payment of such interest).</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="45">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">A statutory declaration in writing that the declarant is a director or the secretary of the company, and that a share in the Company has been forfeited or surrendered or sold to satisfy a lien of the Company on a date stated in the declaration, is conclusive evidence of the facts stated in the declaration as against all persons claiming to be entitled to the share.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="46">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The company may receive the consideration, if any, given for a forfeited or surrendered share on any sale or disposition of the forfeited or surrendered share and may execute a transfer of the share in favour of the person to whom the share is sold or disposed of (called in this regulation the transferee).</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l35">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">Upon the company  executing  a transfer of the  share  in favour of the transferee, the company must lodge a notice of transfer of share with the Registrar under section 128 of the Act for the purpose of updating the electronic register of members to reflect the transferee as the registered owner of the forfeited or surrendered share.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -22pt;text-align: justify;">The transferee is not bound to see to the application of the purchase money, if any, and the transferee’s title to the share is not affected by any irregularity or invalidity in the proceedings with respect to the forfeiture, surrender, sale, or disposal of the share.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="47">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The provisions of this Constitution as to forfeiture and surrender apply in the case of non-payment of any sum which, by the terms of issue of a share, becomes payable at a fixed time as if the sum had been payable by virtue of a call duly made and notified.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 125pt;text-indent: 0pt;text-align: left;">Conversion of shares into stock</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="48">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The company may from time to time by ordinary resolution passed at a general meeting convert any paid-up shares into stock and by like resolution reconvert any stock, from time to time, into paid-up shares.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="49">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to paragraph (2), the holders of stock may transfer the stock or any part of the stock in the same manner, and subject to the same regulations, by which the shares from which the stock arose might, prior to conversion, have been transferred.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l36">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may from time to time fix the minimum amount of stock transferable and restrict or forbid the transfer of fractions of that minimum.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="50">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to paragraph (2), the holders of stock have, according to the amount of the stock held by the holders, the same rights, privileges and advantages in relation to dividends, return of capital, voting at meetings of the company and other matters as if they held the shares from which the stock arose.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l37">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">No privilege or advantage (except participation in the dividends and profits of the company and return of capital and in the distribution of assets on winding up) is to be conferred by any aliquot part of stock on the holder of such stock which would not, if existing in shares, have conferred that privilege or advantage on the holder of such stock; and no such conversion shall affect or prejudice any preference or other special privileges attached to the shares so converted.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="51">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Provisions of this Constitution applicable to paid-up shares apply to stock, and references to “share” and “shareholder” in this Constitution are to be read as if they were references to “stock” and “stockholder”, respectively.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Alteration of Capital</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="52">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The company in general meeting may from time to time by ordinary resolution, whether all the shares for the time being in issue have been fully called up or not, increase its capital by such amount as may be deemed expedient.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="53">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Subject to any special rights for the time being attached to any existing class of shares, the new shares shall be issued upon such terms and conditions and with such rights and privileges annexed thereto as the general meeting resolving upon the creation thereof shall direct and if no direction be given as the directors shall determine subject to the regulations of this Constitution and in particular (but without prejudice to the generality of the foregoing) such shares may be issued with a preferential or qualified right to dividends and in the distribution of assets of the company or otherwise.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="54">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Except so far as otherwise provided by the conditions of issue or by this Constitution all new shares shall be subject to the provisions of this Constitution with reference to allotments, payment of calls, lien, transfer, transmission, forfeiture and otherwise.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="55">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The company may from time to time by ordinary resolution do one or more of the following:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l38">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">consolidate and divide all or any of its share capital;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">subdivide its shares or any of them (subject nevertheless to the provisions of the Act) such that in the subdivision the proportion between the amount paid and the amount, if any, unpaid on each reduced share is the same as it was in the case of the share from which the reduced share is derived;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">cancel the number of shares which at the date of the passing of the resolution have not been taken or agreed to be taken by any person or which have been forfeited, and diminish the amount of its share capital by the number of the shares so cancelled;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">subject to the provisions of these regulations and the Act, convert any class of shares into any other class of shares, or from one currency to another currency.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">55A   (1)  Subject to any direction to the contrary that may be given by the company in general meeting, all new shares must, before issue, be offered to all persons who, as at the date of the offer, are entitled to receive notices from the company of general meetings, in proportion, or as nearly as the circumstances admit, to the amount of the existing shares to which they are entitled.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l39">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The offer must be made by notice specifying the number of shares offered, and limiting a time within which the offer, if not accepted, is treated to be declined.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">After the expiration of the time referred to in paragraph (2), or upon the person to whom the offer is made declining the shares offered, the directors may dispose of those shares in any manner as they think is the most beneficial to the company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may dispose of any new shares which (by reason of the ratio which the new shares bear to shares held by persons entitled to an offer of new shares) cannot, in the opinion of the directors, be conveniently offered under this regulation.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="56">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The company may, by special resolution, reduce its share capital or other undistributable reserve in any manner and with and subject to any incident authorised and consent required by law.</p>
                        </li>
                    </ol>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <table style="border-collapse:collapse;margin-left:8.38pt" cellspacing="0">
                        <tr style="height:133pt">
                            <td style="width:27pt" rowspan="2">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-right: 5pt;text-indent: 0pt;line-height: 10pt;text-align: right;">(2)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">Subject to and in accordance with the provisions of the Act, the company may authorise the directors in general meeting to purchase or otherwise acquire ordinary shares issued by it on such terms as the company may think fit and in the manner prescribed by the Act. If required by the Act, all shares purchased by the company shall, unless held in treasury in accordance with the Act, be cancelled immediately upon purchase. On the cancellation of the aforesaid shares, the rights and privileges attached to those shares shall expire and the number of issued shares of the company shall be diminished by the number of shares so cancelled. Where the shares purchased by the company are not cancelled, the company may hold or deal with any such share so purchased by it in such manner as may be permitted by, and in accordance with, the Act.</p>
                            </td>
                        </tr>
                        <tr style="height:22pt">
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s5" style="padding-top: 5pt;padding-left: 3pt;text-indent: 0pt;text-align: center;">General meeting</p>
                            </td>
                        </tr>
                        <tr style="height:43pt">
                            <td style="width:27pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">57</p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(1)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">Unless dispensed with in accordance with the provisions of the Act, an annual general meeting of the company must be held in accordance with the provisions of the Act.</p>
                            </td>
                        </tr>
                        <tr style="height:32pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(2)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 4pt;text-indent: 0pt;text-align: left;">All general meetings other than the annual general meetings are called extraordinary general meetings.</p>
                            </td>
                        </tr>
                        <tr style="height:32pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(3)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 4pt;text-indent: 0pt;text-align: left;">The time and place of any general meeting shall be determined by the directors.</p>
                            </td>
                        </tr>
                        <tr style="height:22pt">
                            <td style="width:27pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">58</p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(1)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">An extraordinary general meeting may be requisitioned by —</p>
                            </td>
                        </tr>
                        <tr style="height:22pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">(a)  the directors, whenever they think fit; or</p>
                            </td>
                        </tr>
                        <tr style="height:22pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">(b)  any requisitionist as provided for by the Act.</p>
                            </td>
                        </tr>
                        <tr style="height:32pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(2)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 4pt;text-indent: 0pt;text-align: left;">Upon a requisition being made under paragraph (1), an extraordinary general meeting must be convened.</p>
                            </td>
                        </tr>
                        <tr style="height:54pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(3)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">If at any time there are not within Singapore sufficient directors capable of acting to form a quorum at a meeting of directors, any director may convene an extraordinary general meeting in the same manner as nearly as possible as that in which meetings may be convened by the directors.</p>
                            </td>
                        </tr>
                        <tr style="height:96pt">
                            <td style="width:27pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">59</p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(1)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">Subject to the provisions of the Act relating to special resolutions and special notice, at least 14 days’ notice (exclusive both of the day on which the notice is served or treated to be served, and of the day for which notice is given) in writing of any general meeting must be given to such persons (including the auditors) entitled to receive notices of general meetings from the company, provided that a general meeting notwithstanding that it has been called by a shorter notice than that specified above shall be deemed to have been duly called if it is so agreed -</p>
                            </td>
                        </tr>
                        <tr style="height:16pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;line-height: 9pt;text-align: left;">(a)  in the case of an annual general meeting by all the members entitled to</p>
                            </td>
                        </tr>
                    </table>
                    <p style="padding-left: 95pt;text-indent: 0pt;text-align: left;">attend and vote thereat; and</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">(b)  in the case of an extraordinary general meeting by that number or majority in number of the members having a right to attend and vote thereat as is required by the Act.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 73pt;text-indent: 0pt;text-align: justify;">Provided also that the accidental omission to give notice to or the non-receipt of notice by person entitled thereto shall not invalidate the proceedings at that general meeting.</p>
                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l40">
                        <li data-list-text="(2)">
                            <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">A notice of a general meeting must specify the following:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l41">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">the place at which the general meeting is held;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">the date and time of the general meeting;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">in case of special business to be transacted at the general meeting, the general nature of that business; and if any resolution is to be proposed as a Special Resolution or as requiring special notice, the notice shall contain a statement to that effect;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">In the case of an annual general meeting, the notice shall also specify the meeting as such,</p>
                                </li>
                            </ol>
                        </li>
                    </ol>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 73pt;text-indent: 0pt;text-align: justify;">and there shall appear with reasonable prominence in every such notice a statement that a member entitled to attend and vote is entitled to appoint a proxy to attend and to vote instead of him and that a proxy need not be a member of the company.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l42">
                        <li data-list-text="60">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">All business shall be deemed special that is transacted at any extraordinary general meeting, and all that is transacted at an annual general meeting shall also be deemed special, with the exception of:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l43">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">declaring a dividend;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">reading, considering and adopting the financial statements, the reports of the auditors and the statements of the directors and any other accounts or documents required to be annexed to the financial statements;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">appointing auditors and fixing of the remuneration of the auditors or determining the manner in which such remuneration is to be fixed (if the company is not exempt from audit or audits its financial statements, in any case); and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">fixing the remuneration of the directors &#39;proposed to be paid under regulation 84.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Proceedings at general meetings</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="61">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: left;">(1)  No business is to be transacted at any general meeting unless a quorum of members is present at the time when the meeting proceeds to business.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l44">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Except as otherwise provided in this Constitution, 2 members present in person or by proxy form a quorum.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If a quorum be present, notwithstanding the fact that such quorum may be represented by only one person, then such person may resolve any matter and a certificate signed by such person accompanied where such person is a proxy by a copy of the proxy form shall constitute a valid resolution of members. In the event of a corporation being beneficially entitled to the whole of the issued capital of the company one person representing such corporation shall be a quorum and shall be deemed to constitute a meeting and, if applicable, the provisions of Section 179 of the Act shall apply.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">In this regulation, “member” includes a person attending as a proxy or by attorney or as representing a corporation or a limited liability partnership which is a member.</p>
                                </li>
                            </ol>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="62">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">If within half an hour after the time appointed for a general meeting a quorum is not present, the meeting —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l45">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">in the case where the meeting is convened upon the requisition of members, is dissolved; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">in any other case, is adjourned to the same day in the next week at the same time and place, or to another day and at another time and place as the directors may determine, and if at such adjourned meeting a quorum is not present within fifteen minutes from the time appointed for holding the meeting, the meeting shall be dissolved. No notice of any such adjournment as aforesaid shall be required to be given to the members.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="63">
                            <p style="padding-left: 67pt;text-indent: -56pt;text-align: justify;">(1)  Subject to the provisions of the Act, a resolution in writing signed by the members (or in the case of a member being a corporation, by its duly authorised representative) holding as at the date on which the resolution is agreed to in writing:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l46">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 95pt;text-indent: -22pt;text-align: justify;">in the case of a resolution proposed as an ordinary resolution, not less than half of the votes of the shares or class or series of shares entitled to vote on the resolution; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -22pt;text-align: justify;">in the case of a resolution proposed as a special resolution, not less than three-quarters of the votes of the shares or class or series of shares entitled to vote on the resolution in writing,</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">shall have the same effect and validity as an ordinary resolution or special resolution, as the case may be, of the company passed at a general meeting duly convened, held and constituted, and may consist of several documents in the like form, each signed by one or more of such members.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <p style="padding-left: 67pt;text-indent: -18pt;text-align: justify;">(2)  The expressions “in writing” and “signed” include approval by facsimile transmission, telex, cable or telegram or any other form of electronic communications by the members where it shall comprise record or signature to be created, generated, sent, communicated, received, stored or otherwise processed or used by electronic means or in electronic forms.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="64">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The chairman of a general meeting is —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l47">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">where the board of directors has appointed a chairman amongst the directors, the chairman; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">where —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l48">
                                        <li data-list-text="(i)">
                                            <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">the chairman of the board of directors is unwilling to act as the chairman of the general meeting;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(ii)">
                                            <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">the chairman is not present within 15 minutes after the time appointed for the holding of the general meeting; or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(iii)">
                                            <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">the board of directors has not appointed a chairman amongst the directors,</p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                    </ol>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 73pt;text-indent: 0pt;text-align: justify;">some director elected by the members present for the purpose of being the chairman of the general meeting or, if no director be present or if all the directors present are unwilling to act as the chairman of the general meeting, the member elected by the members present for the purpose of being the chairman of the general meeting.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <table style="border-collapse:collapse;margin-left:8.38pt" cellspacing="0">
                        <tr style="height:38pt">
                            <td style="width:27pt">
                                <p class="s3" style="padding-left: 2pt;text-indent: 0pt;line-height: 10pt;text-align: left;">65</p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-right: 5pt;text-indent: 0pt;line-height: 10pt;text-align: right;">(1)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">The chairman may, with the consent of a general meeting at which a quorum is present, and must if so directed by a general meeting, adjourn the general meeting from time to time and from place to place.</p>
                            </td>
                        </tr>
                        <tr style="height:43pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(2)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">No business is to be transacted at any adjourned meeting other than the business left unfinished at the general meeting from which the adjournment took place (called in this regulation the original general meeting).</p>
                            </td>
                        </tr>
                        <tr style="height:54pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(3)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">There is no need to give any notice of an adjourned meeting or of the business to be transacted at an adjourned meeting unless the adjourned meeting is to be held more than 30 days after the date of the original general meeting.</p>
                            </td>
                        </tr>
                        <tr style="height:43pt">
                            <td style="width:27pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">66</p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(1)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">At any general meeting, a resolution put to the vote of the meeting must be decided on a show of hands unless a poll is (before or on the declaration of the result of the show of hands) demanded —</p>
                            </td>
                        </tr>
                        <tr style="height:22pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">(a)  by the chairman;</p>
                            </td>
                        </tr>
                        <tr style="height:32pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 28pt;padding-right: 3pt;text-indent: -22pt;text-align: left;">(b)  by at least 2 members present in person or by proxy or by attorney or in the case of a corporation by a representative;</p>
                            </td>
                        </tr>
                        <tr style="height:54pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 28pt;padding-right: 2pt;text-indent: -22pt;text-align: justify;">(c) by any member or members present in person or by proxy or by attorney or in the case of a corporation by a representative and representing not less than 5% of the total voting rights of all the members having the right to vote at the meeting; or</p>
                            </td>
                        </tr>
                        <tr style="height:54pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 28pt;padding-right: 2pt;text-indent: -22pt;text-align: justify;">(d)  by a member or members holding shares in the company conferring a right to vote at the meeting being shares on which an aggregate sum has been paid up equal to not less than 5% of the total sum paid up on all the shares conferring that right.</p>
                            </td>
                        </tr>
                        <tr style="height:75pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(2)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">Unless a poll is demanded (and the demand be not withdrawn), a declaration by the chairman that a resolution has on a show of hands been carried or carried unanimously, or by a particular majority, or lost, and an entry to that effect in the book containing the minutes of the proceedings of the company is conclusive evidence of the fact without proof of the number or proportion of the votes recorded in favour of or against the resolution.</p>
                            </td>
                        </tr>
                        <tr style="height:22pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(3)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">The demand for a poll may be withdrawn.</p>
                            </td>
                        </tr>
                        <tr style="height:64pt">
                            <td style="width:27pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">67</p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(1)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">Subject to paragraph (2), if a poll is demanded (and the demand be not withdrawn) it must be taken in such manner and either at once or after an interval or adjournment (not being more than thirty days from the date of the meeting) or otherwise as the chairman directs. No notice need be given of a poll not taken immediately.</p>
                            </td>
                        </tr>
                        <tr style="height:32pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(2)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">A poll demanded on the election of a chairman or on a question of adjournment must be taken immediately.</p>
                            </td>
                        </tr>
                        <tr style="height:48pt">
                            <td style="width:27pt">
                                <p style="text-indent: 0pt;text-align: left;">
                                    <br/>
                                </p>
                            </td>
                            <td style="width:31pt">
                                <p class="s3" style="padding-top: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">(3)</p>
                            </td>
                            <td style="width:326pt">
                                <p class="s3" style="padding-top: 5pt;padding-left: 6pt;padding-right: 2pt;text-indent: 0pt;text-align: justify;">The result of the poll is a resolution of the meeting at which the poll was demanded. The chairman may, and if so requested shall, appoint scrutineers and may adjourn the meeting to some place and time fixed by him for the</p>
                                <p class="s3" style="padding-left: 6pt;text-indent: 0pt;line-height: 9pt;text-align: justify;">purpose of declaring the result of the poll.</p>
                            </td>
                        </tr>
                    </table>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l49">
                        <li data-list-text="68">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">In the case of an equality of votes, whether on a show of hands or on a poll, the chairman of the meeting at which the show of hands takes place or at which the poll is demanded is entitled to a second or casting vote.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="69">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">If any votes be counted which ought not to have been counted or might have been rejected, the error shall not vitiate the result of the voting unless it be pointed out at the same meeting or at any adjournment thereof and not in any case unless it shall in the opinion of the chairman be of sufficient magnitude.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="70">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The demand for a poll shall not prevent the continuance of a meeting for the transaction of any business, other than the question on which the poll has been demanded.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="71">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to this Constitution and to any rights or restrictions for the time being attached to any class or classes of shares, at meetings of members or classes of members, each member entitled to vote may vote in person or by proxy (subject to a limit of two proxies per member) or by attorney or in the case of a corporation by a representative.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l50">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">On a show of hands every member or representative of a member or proxy appointed by a member who is present in person has one vote. Where a proxy is the proxy of more than one member, the proxy may not vote on a show of hands and may only vote on a poll.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">On a poll every member present in person or by proxy or by attorney or other duly authorised representative has one vote for each share the member holds (provided that in the case of a member who is represented by two proxies, the appointment of the proxies shall be invalid unless the member specifies the proportion of his holdings to be represented by each proxy).</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="72">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  In the case of joint holders, the vote of the senior who tenders a vote, whether in person or by proxy or by attorney or in the case of a corporation by a representative, is accepted to the exclusion of the votes of the other joint holders.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l51">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">For the purposes of paragraph (1), seniority is to be determined by the order in which the names stand in the electronic register of members.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Several executors or administrators of a deceased member in whose name any share stands shall for the purpose of this regulation be deemed joint holders thereof.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="73">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">A member who is mentally disordered or whose person or estate is liable to be dealt with in any way under the law relating to mental capacity may vote, whether on a show of hands or on a poll, by a person who properly has the management of the estate of the member, and any such person may vote by proxy or attorney, provided that such evidence as the directors may require of the authority of the person claiming to vote shall have been deposited at the registered office of the company not less than 72 hours before the time appointed for holding the meeting.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="74">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">No member is entitled to vote at any general meeting unless all calls or other sums presently payable by the member in respect of shares in the company have been paid.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="75">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  No objection may be raised as to the qualification of any voter except at the meeting or adjourned meeting at which the vote objected to is given or tendered.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l52">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any objection made in due time must be referred to the chairman of the meeting, whose decision is final and conclusive.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">Every vote not disallowed at the meeting is valid for all purposes.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="76">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">On a poll votes may be given either personally or by proxy or by attorney or in the case of a corporation by its representative and a person entitled to more than one vote need not use all his votes or cast all the votes he uses in the same way.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="77">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The instrument appointing a proxy must be in writing, in the common or usual form or any form approved by the directors, and —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l53">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">where the appointer is a corporation or a limited liability partnership, either under seal or under the hand of an officer or attorney duly authorised; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">in any other case, under the hand of the appointer or of the attorney of the appointer duly authorised in writing.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l54">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may, but shall not be bound to, require evidence of the authority of any such attorney or officer.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">A proxy may but need not be a member of the company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The instrument appointing a proxy is treated as conferring authority to demand or join in demanding a poll.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(5)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">An instrument appointing a proxy shall, unless the contrary is stated thereon, be valid as well for any adjournment of the meeting as for the meeting to which it relates and need not be witnessed.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="78">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The following documents must be deposited at the registered office of the company, or at such other place in Singapore as is specified in the notice convening the meeting by the time specified in paragraph (2) for the purpose of appointing a proxy:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l55">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">the instrument appointing a proxy;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">the power of attorney or other authority, if any, under which the instrument appointing the proxy is signed, or a notarially certified copy of that power of attorney or authority.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l56">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">For the purposes of paragraph (1), the time is not less than 72 hours before the time for holding the meeting or adjourned meeting at which the person named in the instrument proposes to vote or for taking the poll.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">An instrument of proxy is not valid if paragraph (1) is not complied with, unless the directors otherwise determine.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="79">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to paragraph (2), a vote given in accordance with the terms of an instrument of proxy or attorney is valid despite —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l57">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">the previous death or mental disorder of the principal;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">the revocation of the instrument or of the authority under which the instrument was executed; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">the transfer of the share in respect of which the instrument is given.</p>
                                </li>
                            </ol>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">(2)  Paragraph (1) does not apply if an intimation in writing of such death, mental disorder, revocation, or transfer has been received by the company at its registered office (or such other place as may be specified for the deposit of instruments appointing proxies) before the commencement of the meeting or adjourned meeting (or in the case of a poll before the time appointed for the taking of the poll) at which the instrument is used.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="80">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Any corporation which is a member of the company may by resolution of its directors or other governing body authorise such person as it thinks fit to act as its representative at any meeting of the company or of any class of members of the company and the person so authorised shall be entitled to exercise the same powers on behalf of the corporation as the corporation could exercise if it were an individual member of the company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Resolution passed by written means</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="81">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Resolutions of members of the company may be passed by written means in accordance with the provisions of the Act.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l58">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">A resolution by written means signed by members for the time being entitled to receive notice of and attend and vote at general meetings shall be valid and effective as if the same had been passed at a general meeting of the company duly convened and held, and may consist of several documents in the like form each signed by one or more members.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Subject to the provisions of the Act, a resolution by written means may be signed on behalf of a member by his proxy or, his attorney or, being corporations by its duly authorised representatives.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Notwithstanding any other provision in these regulations, where the company has only one member, the company may pass a resolution by that member recording the resolution and signing the record.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(5)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The expression “written means” or “signed” includes approval by facsimile transmission, telex, cable or telegram or any other form of electronic communications by the members wherein it shall comprise record or signature to be created, generated, sent, communicated, received, stored or otherwise processed or used by electronic means or in electronic forms.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 55pt;text-indent: 0pt;text-align: center;">Directors</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="82">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Subject to the provisions of the Act and unless otherwise determined by a general meeting, there shall be at least one director and no maximum number of directors. All directors shall be natural persons.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="83">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The shareholding qualification for directors may be fixed by the company in general meeting. A director need not be a member but shall be entitled to attend and speak at general meeting.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="84">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to Section 169 of the Act, the remuneration of the directors is, from time to time, to be determined by the company in general meeting, and shall be divisible among the directors in such proportions and manner as they may agree and in default of agreement equally, except that in the latter event any director who shall hold office for part only of the period in respect of which such remuneration is payable shall be entitled only to rank in such division for the proportion of remuneration related to the period during which he has held office.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l59">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">The remuneration of the directors is treated as accruing from day to day.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may also be paid all travelling, hotel, and other expenses properly incurred by them in attending and returning from meetings of the directors or any committee of the directors or general meetings of the company or in connection with the business of the company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="85">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Any director who is appointed to any executive office or serves on any committee or who otherwise performs or renders services, which in the opinion of the directors are outside his ordinary duties as a director, may, subject to Section 169 of the Act, be paid such extra remuneration as the directors may determine.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="86">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Other than the office of auditor, a director may hold any other office or place of profit under the company and he or any firm of which he is a member may act in a professional capacity for the company in conjunction with his office of director for such period and on such terms (as to remuneration and otherwise) as the directors may determine. Subject to the Act, no director or intending director shall be disqualified by his office from contracting or entering into any arrangement with the company either as vendor, purchaser or otherwise nor shall such contract or arrangement or any contract or arrangement entered into by or on behalf of the company in which any director shall be in any way interested be avoided nor shall any director so contracting or being so interested be liable to account to the company for any profit realised by any such contract or arrangement by reason only of such director holding that office or of the fiduciary relation thereby established.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l60">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Every director shall observe the provisions of Section 156 of the Act relating to the disclosure of the interests of the directors in transactions or proposed transactions with the company or of any office or property held by a director which might create duties or interests in conflict with his duties or interests as a director.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="87">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  A director may be or become a director of or hold any office or place of profit (other than as auditor) or be otherwise interested in any company in which the company may be interested as vendor, purchaser, shareholder or otherwise and unless otherwise agreed shall not be accountable for any fees, remuneration or other benefits received by him as a director or officer of or by virtue of his interest in such other company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l61">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may exercise the voting power conferred by the shares in any company held or owned by the company in such manner and in all respects as the directors think fit in the interests of the company (including the exercise thereof in favour of any resolution appointing the directors or any of them to be directors of such company or voting or providing for the payment of remuneration to the directors of such company) and any such director of the company may vote in favour of the exercise of such voting powers in the manner aforesaid notwithstanding that he may be or be about to be appointed a director of such other company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Directors: Appointment, etc.</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="88">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors have power at any time, and from time to time, to appoint any person to be a director, either to fill a casual vacancy or as an addition to the existing directors, but the total number of directors must not at any time exceed the number fixed in accordance with this Constitution.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l62">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any director appointed under paragraph (1) holds office only until the next annual general meeting, and is then eligible for re-election. If a resolution to dispense with annual general meetings is in force, any director due to retire under this regulation may, if he/she consents to such re-election, be re-elected by way of a written resolution of the company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If the company has only one director, that director shall not be required to retire under this regulation and shall continue in office.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If the company has only one director, that director may not act or be appointed as the company secretary.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="89">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The company may by ordinary resolution or by resolution by written means remove any director before the expiration of his or her period of office, notwithstanding anything in this Constitution or in any agreement between the company and such director, and may by an ordinary resolution appoint another person in place of the removed director.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="90">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The office of director becomes vacant if the director —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l63">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: left;">ceases to be a director by virtue of the Act or this Constitution;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">is adjudged a bankrupt (whether by a Singapore Court or a foreign court having jurisdiction in bankruptcy) unless he/she has been granted leave of Court or permission from the Official Assignee to be a Director, or if he makes any arrangement or composition with his creditors;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">becomes prohibited from being a director by reason of any order made under the provisions of the Act;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">becomes  disqualified from being a  director  by virtue  of his  or  her disqualification or removal or the revocation of his or her appointment as a director, as the case may be, including those under —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l64">
                                        <li data-list-text="(i)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 148, 149, 149A, 154, 155, 155A or 155C of the Act;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(ii)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 50 or 54 of the Banking Act (Cap. 19);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(iii)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 47 of the Finance Companies Act (Cap. 108);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(iv)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 57 of the Financial Advisers Act (Cap. 110);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(v)">
                                            <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">section 62 or 63 of the Financial Holdings Companies Act 2013 (Act 13 of 2013)</p>
                                        </li>
                                        <li data-list-text="(vi)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 31, 31A, 35ZJ or 41(2)(a)(ii) of the Insurance Act (Cap. 142);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(vii)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 40 of the Monetary Authority of Singapore Act (Cap. 186);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(viii)">
                                            <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">section 12A of the Money-changing and Remittance Businesses Act (Cap. 187);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(ix)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 22 of the Payment Systems (Oversight) Act (Cap. 222A);</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(x)">
                                            <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">section 44, 46Z, 81P, 81ZJ, 97,123Y, 123ZU or 292A of the Securities and Futures Act (Cap. 289); or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(xi)">
                                            <p style="padding-left: 93pt;text-indent: -20pt;text-align: left;">section 14 of the Trust Companies Act (Cap. 336);</p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="(e)">
                                    <p style="padding-top: 4pt;padding-left: 72pt;text-indent: -22pt;text-align: justify;">being a director of a Registered Fund Management Company as defined in the Securities and Futures (Licensing and Conduct of Business) Regulations (Cap. 289, Rg 10), he or she has been removed by the Registered Fund Management Company as director in accordance with those Regulations;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(f)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">becomes mentally disordered and incapable of managing himself or herself or his or her affairs or a person whose person or estate is liable to be dealt with in any way under the law relating to mental capacity;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(g)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">subject to section 145 of the Act, resigns his or her office by notice in writing to the company;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(h)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">for more than 6 months is absent without permission of the directors from meetings of the directors held during that period, and the directors resolve that his office be vacated;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(i)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">without the consent of the company in general meeting, holds any other office of profit under the company except that of managing director;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(j)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">is directly or indirectly interested in any contract or proposed contract with the company and deliberately fails to declare the nature of his or her interest in manner required by the Act;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(k)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">If he was nominated for appointment as director by a member and the nomination is withdrawn by that member; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(l)">
                                    <p style="padding-left: 72pt;text-indent: -21pt;text-align: left;">If by notice in writing given to the Company he resigns his office.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Powers and duties of directors</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="91">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: left;">(1)  The business of a company is managed by or under the direction or supervision of the directors.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l65">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may exercise all the powers of a company except any power that the Act or this Constitution requires the company to exercise in general meeting.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="92">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Without limiting the generality of regulation 91, the directors may exercise all the powers of the company to do all or any of the following for any debt, liability, or obligation of the company or of any third party:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l66">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: left;">borrow money;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: justify;">mortgage or charge its undertaking, property, and uncalled or called but unpaid capital, or any part of its undertaking, property and uncalled or called but unpaid capital;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 72pt;text-indent: -22pt;text-align: left;">issue debentures and other securities whether outright or as security,</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: justify;">provided that the directors shall not carry into effect any proposals for disposing of the whole or substantially the whole of the company &#39;s undertaking or property unless those proposals have been approved by the company in general meeting.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="93">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The directors may exercise all the powers of the company in relation to any official seal for use outside Singapore and in relation to branch registers.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="94">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may from time to time by power of attorney appoint any corporation, firm, limited liability partnership or person or body of persons, whether nominated directly or indirectly by the directors, to be the attorney or attorneys of the company for the purposes and with such powers, authorities, and discretions (not exceeding those vested in or exercisable by the directors under this Constitution) and for a period and subject to any conditions as the directors may think fit.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l67">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any powers of attorney granted under paragraph (1) may contain provisions for the protection and convenience of persons dealing with the attorney as the directors may think fit and may also authorise the attorney to delegate all or any of the powers, authorities, and discretions vested in the attorney.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="95">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">All cheques, promissory notes, drafts, bills of exchange, and other negotiable or transferable instruments, and all receipts for money paid to the company, must be signed, drawn, accepted, endorsed, or otherwise executed, as the case may be, by any 2 directors or in such other manner as the directors from time to time determine. In a case of the company having a sole director, then by the sole director would suffice.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="96">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  The directors must cause minutes to be made of all of the following matters:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l68">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">all appointments of officers to be engaged in the management of the company’s affairs;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">names of directors present at all meetings of the company and of the directors;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">all proceedings at all meetings of the company and of the directors and committees of directors.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">(2)  The minutes referred to in paragraph (1) must be signed by the chairman of the meeting at which the proceedings were held or by the chairman of the next succeeding meeting to be conclusive evidence.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Proceedings of directors</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="97">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may meet together for the despatch of business, adjourn and otherwise regulate their meetings as they think fit.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l69">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">A director may at any time summon a meeting of the directors.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The secretary must, on the requisition of a director, summon a meeting of the directors, by providing reasonable notice to all directors.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Every such notice shall specify the place, the day and the hour of the meeting and the general nature of the business to be transacted.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(5)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The accidental omission to give any director, or the non-receipt by any director of, a notice of meeting of directors shall not invalidate the proceedings at that meeting.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="98">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to this Constitution, questions arising at any meeting of directors must be decided by a majority of votes and a determination by a majority of directors is for all purposes treated as a determination of the directors.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l70">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">In case of an equality of votes the chairman of the meeting has a second or casting vote.</p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-top: 4pt;padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any director may participate at a meeting of the directors by telephone or video conference or other methods of simultaneous communication by electronic, telegraphic or other similar means of communication equipment whereby all persons participating in the meeting are able to hear and if applicable, see and be seen by all other participants without the need for physical presence where in such event such director shall be deemed to be present at the meeting. A director participating in a meeting in the manner aforesaid may also be taken into account in ascertaining the presence of a quorum at the meeting. A meeting conducted in the manner aforesaid is deemed to be held at the place agreed upon by the directors attending the meeting, provided always that at least one of the directors present at the meeting was at that place for the duration of the meeting..</p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="99">
                            <p style="padding-top: 10pt;padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  A director must not vote in respect of any transaction or proposed transaction with the company in which the director is interested, or in respect of any matter arising from such transaction or proposed transaction.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l71">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If a director referred to in paragraph (1) does vote in respect of any transaction or proposed transaction referred to in that paragraph, the director’s vote must not be counted.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">A director who is in any way, whether directly or indirectly, interested in a transaction or proposed transaction with the Company or holds any office or possesses any property which might create duties or interests in conflict with his interests as a Director shall declare the nature of his interest in accordance with the provisions of the Act.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The restrictions in this Constitution in respect of voting by a director shall not apply where the Company has only one Director who is also the sole member.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="100">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The quorum necessary for the transaction of the business of the directors may be fixed by the directors, and unless so fixed is 2. But if the company has only one director, that director shall form the quorum and constitute the meeting.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="101">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to paragraph (2), the directors may act despite any vacancy in their body.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l72">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If and so long as the number of directors is reduced below the number fixed  by this Constitution as the necessary quorum of directors, the continuing directors or director may not act except for the purpose of increasing the number of directors to that number or for the purpose of summoning a general meeting of the company. If there being no directors or director able or willing to act, then any two members may summon a general meeting for the purpose of appointing directors.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="102">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may elect a chairman of their meetings and determine the period for which the chairman is to hold office.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l73">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If no chairman is elected, or if at any meeting the chairman is not present within 10 minutes after the time appointed for holding the meeting, the directors present may choose one of their numbers to be chairman of the meeting.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="103">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may delegate any of their powers to committees consisting of any member or members of their body as the directors think fit.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l74">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any committee formed under paragraph (1) must in the exercise of the delegated powers conform to any regulation that may be imposed on it by the directors.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="104">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  A committee may elect a chairman of its meetings.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l75">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If no chairman is elected, or if at any meeting the chairman is not present within 10 minutes after the time appointed for holding the meeting, the members present may choose one of their numbers to be chairman of the meeting.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="105">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  A committee may meet and adjourn as its members think proper.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l76">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Questions arising at any meeting must be determined by a majority of votes of the members present, and in the case of an equality of votes the chairman has a second or casting vote.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="106">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">All acts bona fide done by any meeting of the directors or of a committee of directors or by any person acting as a director shall as regards all persons dealing in good faith with the company be as valid as if every such person had been duly appointed and was qualified to be a director, even if it is afterwards discovered that —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l77">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">there was some defect in the appointment of any director or person acting as a director; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">the  directors  or person acting as  a director  or any of them were disqualified or had vacated office or were not entitled to vote.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="107">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  A resolution in writing signed by the majority of directors or their alternates or substitutes being not less than are sufficient to form a quorum shall be as valid and effectual as a resolution passed at a meeting of the directors duly called and constituted. Any such resolutions may consist of several documents in like form, each signed by one or more directors, provided that where a director has appointed an alternate director but is not himself in Singapore the signature of such alternate director (if in Singapore) shall be required.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l78">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The expressions &quot;in writing &quot;and &quot;signed &quot;include approval by facsimile transmission, telex, cable or telegram or any other form of electronic communications by any such director where it may comprise record or signature to be created, generated, sent, communicated, received, stored or otherwise  processed  or  used  via  electronic  means  such  as  digital authentication, photographic, voice or text in any electronic medium capable of being traced. All such resolutions shall be described as &quot;Directors &#39;Resolutions &quot;and shall be forwarded or otherwise delivered to the secretary without delay, and shall be recorded by him in the company &#39;s minute book.</p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="108">
                            <p style="padding-top: 10pt;padding-left: 49pt;text-indent: -38pt;text-align: justify;">Where the company has only one director, the director may pass a resolution by recording it and signing the record.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Managing directors</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="109">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may from time to time appoint one or more of their body to the office of managing director for such period and on such terms as they think fit and, subject to the provisions of any contract between him and the company, may revoke any such appointment.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l79">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">A managing director appointed under paragraph (1) shall, subject to the provisions of any contract between him and the company, be subject to the same provisions as to resignation and removal as the other directors of the company, and his or her appointment automatically determines if he or she ceases from any cause to be a director.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="110">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">A managing director may, subject to the terms of any agreement entered into in any particular case, receive remuneration by one or more of the following ways as the directors may determine:</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l80">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">salary;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">commission;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">participation in profits.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="111">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The directors may entrust to and confer upon a managing director any of the powers exercisable by them for such time and upon such terms and conditions and with such restrictions as they may think fit, and either collaterally with or to the exclusion of and in substitution for their own powers, and may from time to time revoke, withdraw, alter, or vary all or any of those powers.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Alternate directors and substitute directors</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="112">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Any director (called in this regulation the appointer), may with the approval of the board of directors, appoint any person, whether a member of the company or not, to be an alternate or substitute director in the appointer’s place for any period as the appointer thinks fit.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l81">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The appointer may make such appointment at any time by writing under his hand and deposited at the registered office of the company or by telefax, telex or by cable sent to the secretary, and may in like manner at any time terminate such appointment. Any appointment or removal by telefax, telex or cable shall be confirmed as soon as possible by letter, but may be acted upon by the company meanwhile.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any person holding office as an alternate or substitute director is entitled to notice of meetings of the directors and to attend and vote at meetings of the directors at which the director appointing him is not present, and to exercise all the powers of the appointer in the appointer’s place (except the power to appoint an alternate director) and to sign any resolution in accordance with the provisions of regulation 107.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">A director or any other person may act as an alternate director to represent more than one director and such alternate director shall be entitled at directors &#39;meetings to one vote for every director whom he represents in addition to his own vote if he is a director.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(5)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">An alternate or substitute director —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l82">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 94pt;text-indent: -19pt;text-align: left;">is not required to hold any shares to qualify him or her for appointment; and</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 94pt;text-indent: -19pt;text-align: left;">must vacate office if the appointer vacates office as a director or removes the appointee from office.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="(6)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The appointment of an alternate director shall automatically determine on the happening of any event which if he were a director would render his office as a director to be vacated and his appointment shall also automatically determine if his appointor ceases for any reason to be a director.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(7)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">An alternate director shall not be taken into account in reckoning the minimum or maximum number of directors allowed for the time being under this Constitution but he shall be counted for the purpose of reckoning whether a quorum is present at any meeting of the directors attended by him at which he is entitled to vote provided that he shall not constitute a quorum if he is the only person present at the meeting notwithstanding that he may be an alternate to more than one director.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(8)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">An alternate director may be repaid by the company such expenses as might properly be repaid to him if he were a director and he shall be entitled to receive from the company such proportion (if any) of the remuneration otherwise payable to his appointor as such appointor may by notice in writing to the company from time to time direct, but save as aforesaid he shall not in respect of such appointment be entitled to receive any remuneration from the company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Associate directors</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="113">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The directors may from time to time appoint any person to be an associate director and may from time to time cancel any such appointment.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l83">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may fix, determine and vary the powers, duties and remuneration of any person appointed as an associate director.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">A person appointed as an associate director —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l84">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">is not required to hold any shares to qualify him or her for appointment; and</p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 94pt;text-indent: -21pt;text-align: left;">does not have any right to attend or vote at any meeting of directors except by the invitation and with the consent of the directors.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <h1 style="padding-left: 55pt;text-indent: 0pt;text-align: center;">Secretary</h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="114">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  The secretary must be appointed by the directors in accordance with the Act for any term, at any remuneration, and upon any conditions as the directors may think fit.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l85">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The directors may from time to time, by resolution appoint an assistant or deputy secretary or joint secretaries, who shall be deemed also to be the secretary during the term of his appointment.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">Any secretary appointed under paragraphs (1) and (2) may be removed by the directors.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 55pt;text-indent: 0pt;text-align: center;">Authentication of documents</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="115">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Any director or the secretary or any person appointed by the directors for the purpose shall have power to authenticate any documents affecting the constitution of the company and any resolutions passed by the company or the directors, and any books, records, documents and accounts relating to the business of the company, and to certify copies thereof or extracts therefrom as true copies or extracts; and where any books, records, documents or accounts are elsewhere than at the registered office of the company, the local manager and other officer of the company having the custody thereof shall be deemed to be a person appointed by the directors as aforesaid.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l86">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">A document purporting to be a copy of a resolution of the directors or an extract from the minutes of a meeting of directors which is certified as such in accordance with the provisions of the last preceding paragraph of this regulation shall be conclusive evidence in favour of all persons dealing with the company upon the faith thereof that such resolution has been duly passed or, as the case may be, that such extract is a true and accurate record of a duly constituted meeting of the directors.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Seal</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="116">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  The directors must provide for the safe custody of the seal.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l87">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The seal must only be used by the authority of the directors or of a committee of the directors authorised by the directors to use the seal.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 97pt;text-indent: -48pt;text-align: justify;">(a)  Every instrument to which the seal is affixed must (subject to the provisions of this Constitution as to certificates for shares) be signed by a director and must be countersigned by the secretary or by a second director or by another person appointed by the directors for the purpose of countersigning the instrument to which the seal is affixed. During any period where the Company has only one director, and where the Company does not have a secretary, an instrument to which the seal is affixed need only be signed by that one director.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l88">
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 97pt;text-indent: -22pt;text-align: justify;">Subject to the Act, should the company decided not to elect  in maintaining a seal, any documents that is required under any written law or rule of law to be executed under seal shall be effective if it is signed in the following manner (without affixing the seal onto the document):</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l89">
                                                <li data-list-text="(i)">
                                                    <p style="padding-left: 115pt;text-indent: -17pt;text-align: left;">on behalf of the company by a director and a secretary of the company;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(ii)">
                                                    <p style="padding-left: 114pt;text-indent: -17pt;text-align: left;">on behalf of the company by at least 2 directors of the company; or</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(iii)">
                                                    <p style="padding-left: 115pt;text-indent: -17pt;text-align: left;">on behalf of the company by a director of the company in the presence of a witness who attests the signature.</p>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The company may have a duplicate seal as referred to in the Act which shall be a facsimile of the common seal with the addition on its face of the words “Share Seal”.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(5)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">The company may exercise the powers conferred by the Act with regard to having an official seal for use outside Singapore, and such powers shall be vested in the directors.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Financial Statements</h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="117">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  The directors must —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l90">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 94pt;text-indent: -19pt;text-align: justify;">cause proper accounting and other records to be kept as are necessary to comply with the provisions of the Act and shall cause those records to be kept in such manner as to enable them to be conveniently and properly audited;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 94pt;text-indent: -19pt;text-align: justify;">distribute copies of financial statements and other documents as required by the Act, not less than fourteen days before the date of the meeting to every person entitled to receive notices from the company; and</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 94pt;text-indent: -19pt;text-align: justify;">determine whether, to what extent, at what times and places, and under what conditions or regulations the accounting and other records of the company are open to the inspection of members who are not directors,</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: 0pt;text-align: justify;">provided that this regulation shall not require a copy of these documents to be sent to any person of whose address the company is not aware or to more than one of the joint holders of a share in the company or the several persons entitled thereto in consequence of the death or bankruptcy of the holder or otherwise but any member to whom a copy of these documents has not been sent shall be entitled to receive a copy free of charge on application at the registered office of the company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">(2)  No member (who is not a director) has any right of inspecting any account or book or paper of the company except as conferred by statute or authorised by the directors or by the company in general meeting.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Dividends and reserves</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="118">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The company in general meeting may declare dividends, but any dividend declared must not exceed the amount recommended by the directors.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="119">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The directors may from time to time pay to the members such interim dividends as appear to the directors to be justified by the profits of the Company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="120">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">Without prejudice to the powers of the company to pay interest on share capital as hereinbefore provided, no dividend is to —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l91">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">be paid otherwise than out of profits; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 72pt;text-indent: -23pt;text-align: left;">bear interest against the company.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="121">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">(1)  The directors may, before recommending any dividend —</p>
                            <ol id="l92">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">set aside out of the profits of the company sums as they think proper as reserves; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 95pt;text-indent: -21pt;text-align: justify;">carry forward any profits which they may think prudent not to divide, without placing the profits to reserve.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l93">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: left;">
                                        The reserves set aside under paragraph (1)(<i>a</i>
                                        ) —
                                    </p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l94">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 94pt;text-indent: -17pt;text-align: justify;">are, at the discretion of the directors, to be applied for any purpose to which the profits of the company may be properly applied; and</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 94pt;text-indent: -17pt;text-align: justify;">
                                                may, pending any application under sub-paragraph (<i>a</i>
                                                ) and at the discretion of the directors, be employed in the business of the company or be invested in any investments (other than shares in the company) as the directors may from time to time think fit.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="122">
                            <p style="padding-left: 73pt;text-indent: -62pt;text-align: justify;">(1)  Subject to the rights of persons, if any, entitled to shares with special rights as to dividend, all dividends must be declared and paid by reference to the amounts paid or credited as paid on the shares in respect of which the dividend is paid.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l95">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">For the purposes of paragraph (1), no amount paid or credited as paid on a share in advance of calls is to be treated for the purposes of this regulation as paid on the share.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">All dividends must be apportioned and paid proportionately to the amounts paid or credited as paid on the shares during any portion or portions of the period in respect of which the dividend is paid.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 73pt;text-indent: -23pt;text-align: justify;">If any share is issued on terms providing that it ranks for dividend as from a particular date, that share ranks for dividend accordingly.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="123">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The directors may deduct from any dividend payable to any member all sums of money, if any, presently payable by the member to the company on account of calls or otherwise in relation to the shares of the company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="124">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The directors may retain any dividend or other moneys payable on or in respect of a share on which the company has a lien and may apply the same in or towards satisfaction of the debts, liabilities or engagements in respect of which the lien exists.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="125">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The directors may retain the dividends payable on shares in respect of which any person is under the provisions as to the transmission of shares hereinbefore contained entitled to become a member or which any person under those provisions is entitled to transfer until such person shall become a member in respect of such shares or shall duly transfer the same.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="126">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">The payment by the directors of any unclaimed dividends or other moneys payable on or in respect of a share into a separate account shall not constitute the company a trustee in respect thereof. All dividends unclaimed after being declared may be invested or otherwise made use of by the directors for the benefit of the company and any dividend unclaimed after a period of six years from the date of declaration of such dividend may be forfeited and if so shall revert to the company but the directors may at any time thereafter at their absolute discretion annul any such forfeiture and pay the dividend so forfeited to the person entitled thereto prior to the forfeiture.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="127">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: justify;">(1)   Any general meeting declaring a dividend or bonus may by resolution direct payment of the dividend or bonus wholly or partly by the distribution of specific assets, including —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l96">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">paid-up shares of any other company;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">debentures or debenture stock of any other company; or</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">any combination of any specific assets,</p>
                                </li>
                            </ol>
                            <p style="padding-left: 77pt;text-indent: 0pt;text-align: left;">and the directors must give effect to the resolution.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l97">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Where any difficulty arises with regard to a distribution directed under paragraph (1), the directors may do all or any of the following:</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l98">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">settle the distribution as they think expedient;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">fix the value for distribution of the specific assets or any part of the specific assets;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(c)">
                                            <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">determine that cash payments be made to any members on the basis of the value fixed by the directors, in order to adjust the rights of all parties;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(d)">
                                            <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">vest any specific assets in trustees as may seem expedient to the directors.</p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="128">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: justify;">(1)   Any dividend, interest, or other money payable in cash in respect of shares may be paid by cheque or warrant sent through the post directed</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l99">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 103pt;text-indent: -26pt;text-align: left;">in the case of joint holders —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l100">
                                        <li data-list-text="(i)">
                                            <p style="padding-left: 120pt;text-indent: -16pt;text-align: justify;">to the registered address of the joint holder who is first named on the electronic register of members; or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(ii)">
                                            <p style="padding-left: 120pt;text-indent: -16pt;text-align: justify;">to a person or to an address as the joint holders may in writing direct; or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 103pt;text-indent: -26pt;text-align: left;">in any other case —</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l101">
                                        <li data-list-text="(i)">
                                            <p style="padding-left: 120pt;text-indent: -16pt;text-align: left;">to the registered address of the holder; or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(ii)">
                                            <p style="padding-left: 120pt;text-indent: -16pt;text-align: left;">to a person or to an address as the holder may in writing direct</p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l102">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Every cheque or warrant made under paragraph (1) must be made payable to the order of the person to whom it is sent.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Every such cheque or warrant shall be sent at the risk of the person entitled to the money represented thereby.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(4)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Any one of 2 or more joint holders may give effectual receipts for any dividends, bonuses, or other money payable in respect of the shares held by them as joint holders.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="129">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">A transfer of shares shall not pass the right to any dividend declared on such shares before the registration of the transfer.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Capitalisation of profits</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="130">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: justify;">(1)   The company in general meeting may, upon the recommendation of the directors, resolve to capitalise any part of the amount for the time being standing to the credit of any of the company’s reserve accounts or to the credit of the profit and loss account or otherwise available for distribution, provided that such sum be not required for paying the dividends on any shares carrying a fixed cumulative preferential dividend.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l103">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">The amount capitalised under paragraph (1) is set free for distribution amongst the members who would have been entitled to the amount had it been distributed by way of dividend and in the same proportions subject to the following conditions:</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l104">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">the capitalised amount must not be paid in cash;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 98pt;text-indent: -21pt;text-align: left;">the capitalised amount must be applied in or towards either or both of the following:</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l105">
                                                <li data-list-text="(i)">
                                                    <p style="padding-left: 116pt;text-indent: -16pt;text-align: justify;">paying up any amounts for the time being unpaid on any shares held by the members respectively;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(ii)">
                                                    <p style="padding-left: 116pt;text-indent: -16pt;text-align: justify;">paying up in full unissued shares or debentures of the company to be allotted, distributed and credited as fully paid up to and amongst such members in the same proportions.</p>
                                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="131">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: left;">(1)   Whenever a resolution under regulation 130(1) has been passed, the directors must —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l106">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;line-height: 115%;text-align: left;">make all appropriations and applications of the undivided profits resolved to be capitalised by the resolution;</p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-top: 5pt;padding-left: 98pt;text-indent: -21pt;line-height: 115%;text-align: left;">make all allotments and issues of fully-paid shares or debentures, if any; and</p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-top: 4pt;padding-left: 98pt;text-indent: -21pt;text-align: left;">do all acts and things required to give effect to the resolution.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l107">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: left;">The directors have full power to —</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l108">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 98pt;text-indent: -21pt;line-height: 118%;text-align: justify;">make provision by the issue of fractional certificates or by payment in cash or otherwise as they think fit for the case of shares or debentures becoming distributable in fractions; and</p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-top: 5pt;padding-left: 98pt;text-indent: -21pt;line-height: 117%;text-align: justify;">authorise any person to enter on behalf of all the members entitled to the distribution into an agreement with the company providing —</p>
                                            <ol id="l109">
                                                <li data-list-text="(i)">
                                                    <p style="padding-top: 10pt;padding-left: 124pt;text-indent: -26pt;line-height: 118%;text-align: justify;">for the allotment to the members respectively, credited as fully paid up, of any further shares or debentures to which they may be entitled upon the capitalisation; or</p>
                                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(ii)">
                                                    <p style="padding-left: 124pt;text-indent: -26pt;line-height: 118%;text-align: justify;">for the payment up by the company on the member’s behalf of the amounts or any part of the amounts remaining unpaid on their existing shares by the application of their respective proportions of the profits resolved to be capitalised,</p>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 77pt;text-indent: 0pt;line-height: 118%;text-align: justify;">and any agreement made under such authority is effective and binding on all members entitled to the distribution.</p>
                            <h1 style="padding-top: 9pt;padding-left: 33pt;text-indent: 0pt;text-align: center;">Notices</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="132">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: left;">(1)   A notice may be given by the company to any member either personally or by sending it by post to the member —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l110">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">at the member’s registered address or where such address is outside Singapore by prepaid air mail;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">if the member has no registered address in Singapore, to the address, if any, in Singapore supplied by the member to the company for the giving of notices to the member,</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 77pt;text-indent: 0pt;text-align: justify;">or by sending a cable or telex, or telefax containing the text of the notice to him at his registered address in Singapore or where such address is outside Singapore to such address or to any other address as might have been previously notified by the member concerned to the company.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l111">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: left;">Where a notice is sent by post, service of the notice is treated as effected by properly addressing, prepaying, and posting a letter containing the notice.</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Any notice served under any of the provisions of this Constitution on or by the company or any officer of the company may be tested or verified by telex or telefax or telephone or such other manner as may be convenient in the circumstances but the company and its officers are under no obligation so to test or verify any such notice.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="133">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: justify;">(1)   A notice may also be sent or supplied by the company by electronic means (e.g. by electronic mail) to a member.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l112">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Where the notice is given by electronic means, service of the notice is treated as effected properly by sending or supplying it to an address specified for the purpose by the member generally or specifically.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">Members agree to receive any notice or document by way of such electronic means and acknowledge that they do not have a right to elect to receive a physical copy of such notice or document.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="134">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: justify;">(1)   Any notice given in conformity with regulation 132 or 133 shall be deemed to have been given at any of the following times as may be appropriate:-</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l113">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">when it is delivered personally to the Member, at the time when it is so delivered;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">when it is sent by post to an address in Singapore or by prepaid airmail to an address outside Singapore, on the day following that on which the notice was put into the post;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">when the notice is sent by cable or telex, or telefax on the day it is so sent; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">when the notice is sent by electronic communications, on the day the communication is so sent.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">(2)   In proving such service or sending, it shall be sufficient to prove that the letter containing the notice or document was properly addressed and put into the post office as a prepaid letter or airmail letter as the case may be or that a telex or telefax was properly addressed and transmitted or that a cable was properly addressed and handed to the relevant authority for despatch or that the electronic communication was properly addressed.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="135">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Any notice on behalf of the company or of the directors shall be deemed effectual if it purports to bear the signature of the secretary or other duly authorised officer of the company, whether such signature is printed or written.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="136">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">All notices shall be given by the company to the joint holders of a share by giving the notice to the joint holder first named in the electronic register of members in respect of the share and notice so given shall be sufficient notice to all the holders of such shares.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="137">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: justify;">(1)   A notice may be given by the company to the persons entitled to a share in consequence of the death or bankruptcy of a member by sending it through the post in a prepaid letter addressed to the persons by—</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l114">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -19pt;text-align: left;">name;</p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-top: 6pt;padding-left: 98pt;text-indent: -19pt;text-align: justify;">the title of representatives of the deceased, or assignee of the bankrupt; or</p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-top: 6pt;padding-left: 98pt;text-indent: -18pt;text-align: left;">any like description.</p>
                                </li>
                            </ol>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l115">
                                <li data-list-text="(2)">
                                    <p style="padding-left: 77pt;text-indent: -28pt;text-align: left;">The notice referred to in paragraph (1) may be given —</p>
                                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l116">
                                        <li data-list-text="(a)">
                                            <p style="padding-left: 98pt;text-indent: -19pt;line-height: 117%;text-align: justify;">at the address, if any, in Singapore supplied for the purpose by the persons claiming to be so entitled; or</p>
                                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="(b)">
                                            <p style="padding-left: 98pt;text-indent: -19pt;line-height: 117%;text-align: justify;">if no address in Singapore has been supplied, by giving the notice in any manner in which notice might have been given if the death or bankruptcy had not occurred.</p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="(3)">
                                    <p style="padding-top: 9pt;padding-left: 77pt;text-indent: -28pt;text-align: justify;">such service shall for all purposes be deemed a sufficient service of such notice on all persons interested (whether jointly with or as claiming through or under him) in the share.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="138">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: left;">(1)   Notice of every general meeting must be given in any manner authorised in regulations 132, 133 and 137 to —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l117">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">every member;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">every person entitled to a share in consequence of the death or bankruptcy of a member who, but for his or her death or bankruptcy, would be entitled to receive notice of the meeting; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 98pt;text-indent: -20pt;text-align: left;">the auditor for the time being of the company.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 49pt;text-indent: 0pt;text-align: left;">(2)  No other person is entitled to receive notices of general meetings.</p>
                            <p style="padding-top: 3pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="139">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: left;">The provisions of regulations 133 to 135 shall apply mutatis mutandis to notices of meetings of directors or any committee of directors.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Winding up</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="140">
                            <p style="padding-left: 77pt;text-indent: -66pt;text-align: left;">(1)   If the company is wound up, the liquidator may, with the sanction of a special resolution of the company —</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l118">
                                <li data-list-text="(a)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">divide amongst the members in specie or in kind the whole or any part of the assets of the company, whether they consist of property of the same kind or not;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(b)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">
                                        set a value as the liquidator considers fair upon the property referred to in sub-paragraph (<i>a</i>
                                        );
                                    </p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(c)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">determine how the division of property is to be carried out as between the members or different classes of members; and</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="(d)">
                                    <p style="padding-left: 98pt;text-indent: -21pt;text-align: justify;">vest the whole or any part of the assets of the company in trustees upon such trusts for the benefit of the contributories as the liquidator thinks fit.</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 77pt;text-indent: -28pt;text-align: justify;">(2)   No member is compelled to accept any shares or other securities on which there is any liability.</p>
                            <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Indemnity</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="141">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Every officer of the company is to be indemnified out of the assets of the company against any liability (other than any liability referred to in section 172B(1)(a) or (b) of the Act) incurred by the officer to a person other than the company attaching to the officer in connection with any negligence, default, breach of duty or breach of trust.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="142">
                            <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">Every auditor is to be indemnified out of the assets of the company against any liability incurred by the auditor in defending any proceedings, whether civil or criminal, in which judgment is given in the auditor’s favour or in which the auditor is acquitted or in connection with any application under the Act in which relief is granted to the auditor by the Court in respect of any negligence, default, breach of duty or breach of trust.</p>
                        </li>
                    </ol>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p class="s1" style="padding-left: 33pt;text-indent: 0pt;text-align: center;">Personal Data</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-top: 4pt;padding-left: 10pt;text-indent: 0pt;text-align: left;">143</p>
                    <p style="padding-left: 10pt;text-indent: 0pt;text-align: left;">(a)</p>
                    <p style="padding-top: 4pt;padding-left: 13pt;text-indent: 0pt;text-align: justify;">A member who is a natural person is deemed to have consented to the collection, use and disclosure of his personal data (whether such personal data is provided by that member or is collected through a third party) by the Company (or its agents or service providers) from time to time for any of the following purposes:</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l119">
                        <li data-list-text="a)">
                            <p style="padding-left: 52pt;text-indent: -41pt;text-align: justify;">implementation and administration of any corporate action by the Company (or its agents or service providers);</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="b)">
                            <p style="padding-left: 52pt;text-indent: -39pt;text-align: justify;">internal analysis and/or market research by the Company (or its agents or service providers);</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="c)">
                            <p style="padding-left: 52pt;text-indent: -39pt;text-align: justify;">investor relations communications by the Company (or its agents or service providers);</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="d)">
                            <p style="padding-left: 52pt;text-indent: -39pt;text-align: justify;">administration by the Company (or its agents or service providers) of that member’s holding of shares in the capital of the Company;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="e)">
                            <p style="padding-left: 52pt;text-indent: -39pt;text-align: justify;">implementation and administration of any service provided by the Company (or its agents or service providers) to its members to receive notices  of  meetings,  financial  statements  and  other  shareholder communications and/or for proxy appointment, whether by electronic means or otherwise;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="f)">
                            <p style="padding-left: 52pt;text-indent: -39pt;text-align: justify;">processing, administration and analysis by the Company (or its agents or service providers) of proxies and representatives appointed for any General  Meeting  (including  any  adjournment  thereof)  and  the preparation and compilation of the attendance lists, minutes and other documents relating to any General Meeting (including any adjournment thereof);</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="g)">
                            <p style="padding-left: 52pt;text-indent: -41pt;text-align: justify;">implementation and administration of, and compliance with, any provision of this Constitution;</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="h)">
                            <p style="padding-left: 52pt;text-indent: -41pt;text-align: left;">compliance with any applicable laws, regulations and/or guidelines; and</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="i)">
                            <p style="padding-left: 52pt;text-indent: -41pt;text-align: left;">purposes which are reasonably related to any of the above purposes.</p>
                        </li>
                    </ol>
                    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 49pt;text-indent: -38pt;text-align: justify;">143(b)  Any member who appoints a proxy and/or representative for any General Meeting and/or any adjournment thereof is deemed to have warranted that where such member discloses the personal data of such proxy and/or representative to the Company (or its agents or service providers), that member has obtained the prior consent of such proxy and/or representative for the collection, use and disclosure by the Company (or its agents or service providers) of the personal data of such proxy and/or representative for the purposes specified in Regulation 143(a)(f) and 143(a)(h) above, and is deemed to have agreed to indemnify the Company in respect of any penalties, liabilities, claims, demands, losses and damages as a result of such member’s breach of warranty.</p>

                    <h3 style="padding:100px">Signature:</h3>
                ';
                // Output the HTML content to PDF
                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->lastPage();
                // Define the path to save the PDF file
                $uploadDir = __DIR__ . '/upload_form_company_constitution/'; // Ensure this directory exists and is writable
                $pdfFilePath = $uploadDir . 'company_constitution.pdf';

                // Save the file locally
                $pdf->Output($pdfFilePath, 'F');
            } else {
               $pdfFilePath = __DIR__ . '/upload_form_company_constitution/'.$result['verify_sign_document_company_constition_pdf'];
            }
        }
    } else {
        echo "<script>Not able to check if company constition has already sign by another officer</script>";
    }

    // Get data from the database

    // Create new PDF document
    

    // Read the PDF file and encode it to Base64
    $documentBase64 = base64_encode(file_get_contents($pdfFilePath));

    $accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336';
    // Example usage
    $accessToken = $result_token['access_token'];

    //$accessToken = getAccessToken();
    //$freshtoken =  refreshAccessToken($accessToken);

    // Replace with your account ID

    $baseUrl_1 = $baseUrl;

    // Usage example
    $brandId = '11ebcdcd-9f59-4414-98ca-35404d6e6d53';
    $envelopeId = sendEnvelope($accessToken, $accountId, $documentBase64, $result, $brandId);


    function sendEnvelope($accessToken, $accountId, $documentBase64, $result, $brandId)
    {
        $apiBase = 'https://demo.docusign.net/restapi';

        // Prepare the API request URL
        $url = "$apiBase/v2.1/accounts/$accountId/envelopes";

        // Prepare the envelope data
        $postData = [
            'emailSubject' => 'Please sign this document',
            'documents' => [
                [
                    'documentBase64' => $documentBase64,
                    'name' => 'Document.pdf',
                    'fileExtension' => 'pdf',
                    'documentId' => '1'
                ]
            ],
            'recipients' => [
                'signers' => [
                    [
                        'email' => $result['officer_email_address'],
                        'name' => $result['officer_name'],
                        'recipientId' => '1', // Consistent ID for first recipient
                        'routingOrder' => '1',
                        'tabs' => [
                            'signHereTabs' => [
                                [
                                    'documentId' => '1',
                                    'pageNumber' => '52',
                                    'xPosition' => '40',
                                    'yPosition' => '400'
                                ],
                                [
                                    'documentId' => '1',
                                    'pageNumber' => '1',
                                    'xPosition' => '40',
                                    'yPosition' => '700'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'customFields' => [
                'textCustomFields' => [
                    [
                        'name' => 'RecipientCustomField1',
                        'value' => $result['id']
                    ],
                    [
                        'name' => 'RecipientCustomField2',
                        'value' => 'company_con'
                    ]
                ]
            ],
            'status' => 'sent', // Change to 'created' if you don't want to send immediately
            'brandId' => $brandId // Add the brand ID here
        ];

    

        // Initialize cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);

        // Set the post fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        // Execute the cURL request
        $response = curl_exec($ch);

        if ($response === false) {
            // Output cURL error if any
            echo 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        // Get the HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 201) {
            // Handle non-201 responses (201 is the expected code for a successful envelope creation)
            echo "Error: HTTP $httpCode - $response";
            return null;
        }

        // Decode the response
        $responseData = json_decode($response, true);

    ?>

        <script>
            swal.fire({
                title: '<?php echo $result['officer_email_address']; ?>',
                text: 'Please check your registered email ID sign the document.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay'
            }).then(function(isConfirm) {

                if (isConfirm.value) {
                    window.location = '../index.php';
                }
            });
        </script>

    <?php
        // Return the envelope ID
        return $responseData['envelopeId'] ?? null;
    }

    function getEnvelopeRecipients($accessToken, $accountId, $envelopeId)
    {
        $apiBase = 'https://demo.docusign.net/restapi';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$apiBase/v2.1/accounts/$accountId/envelopes/$envelopeId/recipients");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            echo 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            echo "Error fetching recipients: HTTP $httpCode - $response";
            return;
        }

        $responseJson = json_decode($response, true);
        return $responseJson;
        // Print response to check recipient details
    }

    function envelopeView($accessToken, $accountId, $envelopeId, $baseUrl, $officer_id, $result)
    {
        $apiBase = 'https://demo.docusign.net/restapi';
        $recipientData = getEnvelopeRecipients($accessToken, $accountId, $envelopeId);

        // Extract recipient details from the provided recipient data
        $recipientId = $recipientData['signers'][0]['recipientId']; // Ensure this matches '1'
        $officerName = $recipientData['signers'][0]['name'];
        $officerEmail = $recipientData['signers'][0]['email'];

        // Step 2: Fetch signing URL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$apiBase/v2.1/accounts/$accountId/envelopes/$envelopeId/views/recipient");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);

        $data = [
            "returnUrl" => $baseUrl . "/incorporation/before-incorporation/company-constitution/download_cc.php?en_id=" . $envelopeId . "&director_id=" . $officer_id,
            "authenticationMethod" => "PaperDocuments",
            "recipientId" => $recipientId, // Ensure this is the correct recipient ID
            "userName" => "Tialong Services Pte. Ltd.",
            "email" => "dhruvdaruwala03@gmail.com"
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        if ($response === false) {
            echo 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $responseJson = json_decode($response, true);

        if (isset($responseJson['url'])) {
            $signingUrl = $responseJson['url'];
            echo "Signing URL: " . $signingUrl;
            header("Location: " . $signingUrl);
        } else {
            echo 'Error: Unable to retrieve signing URL. Response: ' . print_r($responseJson, true);
        }
    }
    ?>
</body>

</html>
</body>

</html>