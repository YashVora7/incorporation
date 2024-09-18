<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once 'before-incorporation/vendor/autoload.php'; // Adjust path if needed


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// First part of the HTML content
$html1 = '
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
';

$pdf->writeHTML($html1, true, false, true, false, '');

// Insert a page break
$pdf->AddPage();

// Second part of the HTML content
$html2= '
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>';
$pdf->writeHTML($html2, true, false, true, false, '');
// Insert a page break
$pdf->AddPage();
$html3 = '<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif;">
    <thead>
        <tr style="background-color:#f2f2f2; color:#333333; text-align:left;">
            <th style="border:1px solid #dddddd; padding:8px; text-align:center;">Name and Address of Subscriber</th>
            <th style="border:1px solid #dddddd; padding:8px; text-align:center;">No of Shares Taken</th>
        </tr>
    </thead>
    <tbody>
';


        $html3 .= "
        <tr>
            <td style='border:1px solid #dddddd; padding:8px;'>DigiEn LTD</td>
            <td style='border:1px solid #dddddd; padding:8px; text-align:center;'>25%</td>
        </tr>
        ";
   
    $html3 .= '
    <tr>
        <td colspan="2" style="border:1px solid #dddddd; padding:8px; text-align:center; background-color:#f9f9f9;">No records found</td>
    </tr>
    ';


$html3 .= '
    </tbody>
</table>
';
$pdf->writeHTML($html3, true, false, true, false, '');
$pdf->AddPage();
$html4= '
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>';
// Print text using writeHTMLCell()

$pdf->writeHTML($html4, true, false, true, false, '');
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//=====================================
    <script>
    $(document).ready(function() {
        $('#three_countries').siblings().remove();

        // List of countries with corresponding SSIC codes (example codes provided)
        let countries = [{
                name: 'Afghanistan'
            },
            {
                name: 'Albania'
            },
            {
                name: 'Algeria'
            },
            {
                name: 'Andorra'
            },
            {
                name: 'Angola'
            },
            {
                name: 'Antigua and Barbuda'
            },
            {
                name: 'Argentina'
            },
            {
                name: 'Armenia'
            },
            {
                name: 'Australia'
            },
            {
                name: 'Austria'
            },
            {
                name: 'Azerbaijan'
            },
            {
                name: 'Bahamas'
            },
            {
                name: 'Bahrain'
            },
            {
                name: 'Bangladesh'
            },
            {
                name: 'Barbados'
            },
            {
                name: 'Belarus'
            },
            {
                name: 'Belgium'
            },
            {
                name: 'Belize'
            },
            {
                name: 'Benin'
            },
            {
                name: 'Bhutan'
            },
            {
                name: 'Bolivia'
            },
            {
                name: 'Bosnia and Herzegovina'
            },
            {
                name: 'Botswana'
            },
            {
                name: 'Brazil'
            },
            {
                name: 'Brunei'
            },
            {
                name: 'Bulgaria'
            },
            {
                name: 'Burkina Faso'
            },
            {
                name: 'Burundi',
                ssic: 'A028'
            },
            {
                name: 'Cabo Verde'
            },
            {
                name: 'Cambodia'
            },
            {
                name: 'Cameroon'
            },
            {
                name: 'Canada'
            },
            {
                name: 'Central African Republic'
            },
            {
                name: 'Chad'
            },
            {
                name: 'Chile'
            },
            {
                name: 'China'
            },
            {
                name: 'Colombia'
            },
            {
                name: 'Comoros'
            },
            {
                name: 'Congo, Democratic Republic of the'
            },
            {
                name: 'Congo, Republic of the'
            },
            {
                name: 'Costa Rica'
            },
            {
                name: 'Cote d\'Ivoire'
            },
            {
                name: 'Croatia'
            },
            {
                name: 'Cuba'
            },
            {
                name: 'Cyprus'
            },
            {
                name: 'Czech Republic'
            },
            {
                name: 'Denmark'
            },
            {
                name: 'Djibouti'
            },
            {
                name: 'Dominica'
            },
            {
                name: 'Dominican Republic'
            },
            {
                name: 'Ecuador'
            },
            {
                name: 'Egypt'
            },
            {
                name: 'El Salvador'
            },
            {
                name: 'Equatorial Guinea'
            },
            {
                name: 'Eritrea'
            },
            {
                name: 'Estonia'
            },
            {
                name: 'Eswatini'
            },
            {
                name: 'Ethiopia'
            },
            {
                name: 'Fiji'
            },
            {
                name: 'Finland'
            },
            {
                name: 'France'
            },
            {
                name: 'Gabon'
            },
            {
                name: 'Gambia'
            },
            {
                name: 'Georgia'
            },
            {
                name: 'Germany'
            },
            {
                name: 'Ghana'
            },
            {
                name: 'Greece'
            },
            {
                name: 'Grenada'
            },
            {
                name: 'Guatemala'
            },
            {
                name: 'Guinea'
            },
            {
                name: 'Guinea-Bissau'
            },
            {
                name: 'Guyana'
            },
            {
                name: 'Haiti'
            },
            {
                name: 'Honduras'
            },
            {
                name: 'Hungary'
            },
            {
                name: 'Iceland'
            },
            {
                name: 'India'
            },
            {
                name: 'Indonesia'
            },
            {
                name: 'Iran'
            },
            {
                name: 'Iraq'
            },
            {
                name: 'Ireland'
            },
            {
                name: 'Israel'
            },
            {
                name: 'Italy'
            },
            {
                name: 'Jamaica'
            },
            {
                name: 'Japan'
            },
            {
                name: 'Jordan'
            },
            {
                name: 'Kazakhstan'
            },
            {
                name: 'Kenya'
            },
            {
                name: 'Kiribati'
            },
            {
                name: 'Kuwait'
            },
            {
                name: 'Kyrgyzstan'
            },
            {
                name: 'Laos'
            },
            {
                name: 'Latvia'
            },
            {
                name: 'Lebanon'
            },
            {
                name: 'Lesotho'
            },
            {
                name: 'Liberia'
            },
            {
                name: 'Libya'
            },
            {
                name: 'Liechtenstein'
            },
            {
                name: 'Lithuania'
            },
            {
                name: 'Luxembourg'
            },
            {
                name: 'Madagascar'
            },
            {
                name: 'Malawi'
            },
            {
                name: 'Malaysia'
            },
            {
                name: 'Maldives'
            },
            {
                name: 'Mali'
            },
            {
                name: 'Malta'
            },
            {
                name: 'Marshall Islands'
            },
            {
                name: 'Mauritania'
            },
            {
                name: 'Mauritius'
            },
            {
                name: 'Mexico'
            },
            {
                name: 'Micronesia'
            },
            {
                name: 'Moldova'
            },
            {
                name: 'Monaco'
            },
            {
                name: 'Mongolia'
            },
            {
                name: 'Montenegro'
            },
            {
                name: 'Morocco'
            },
            {
                name: 'Mozambique'
            },
            {
                name: 'Myanmar'
            },
            {
                name: 'Namibia'
            },
            {
                name: 'Nauru'
            },
            {
                name: 'Nepal'
            },
            {
                name: 'Netherlands'
            },
            {
                name: 'New Zealand'
            },
            {
                name: 'Nicaragua'
            },
            {
                name: 'Niger'
            },
            {
                name: 'Nigeria'
            },
            {
                name: 'North Korea'
            },
            {
                name: 'North Macedonia'
            },
            {
                name: 'Norway'
            },
            {
                name: 'Oman'
            },
            {
                name: 'Pakistan'
            },
            {
                name: 'Palau'
            },
            {
                name: 'Panama'
            },
            {
                name: 'Papua New Guinea'
            },
            {
                name: 'Paraguay'
            },
            {
                name: 'Peru'
            },
            {
                name: 'Philippines'
            },
            {
                name: 'Poland'
            },
            {
                name: 'Portugal'
            },
            {
                name: 'Qatar'
            },
            {
                name: 'Romania'
            },
            {
                name: 'Russia'
            },
            {
                name: 'Rwanda'
            },
            {
                name: 'Saint Kitts and Nevis'
            },
            {
                name: 'Saint Lucia'
            },
            {
                name: 'Saint Vincent and the Grenadines'
            },
            {
                name: 'Samoa'
            },
            {
                name: 'San Marino'
            },
            {
                name: 'Sao Tome and Principe'
            },
            {
                name: 'Saudi Arabia'
            },
            {
                name: 'Senegal'
            },
            {
                name: 'Serbia'
            },
            {
                name: 'Seychelles'
            },
            {
                name: 'Sierra Leone'
            },
            {
                name: 'Singapore'
            },
            {
                name: 'Slovakia'
            },
            {
                name: 'Slovenia'
            },
            {
                name: 'Solomon Islands'
            },
            {
                name: 'Somalia'
            },
            {
                name: 'South Africa'
            },
            {
                name: 'South Korea'
            },
            {
                name: 'South Sudan'
            },
            {
                name: 'Spain'
            },
            {
                name: 'Sri Lanka'
            },
            {
                name: 'Sudan'
            },
            {
                name: 'Suriname'
            },
            {
                name: 'Sweden'
            },
            {
                name: 'Switzerland'
            },
            {
                name: 'Syria'
            },
            {
                name: 'Taiwan'
            },
            {
                name: 'Tajikistan'
            },
            {
                name: 'Tanzania'
            },
            {
                name: 'Thailand'
            },
            {
                name: 'Timor-Leste'
            },
            {
                name: 'Togo'
            },          
            {
                name: 'Tonga'
            },
            {
                name: 'Trinidad and Tobago'
            },
            {
                name: 'Tunisia'
            },
            {
                name: 'Turkey'
            },
            {
                name: 'Turkmenistan'
            },
            {
                name: 'Tuvalu'
            },
            {
                name: 'Uganda'
            },
            {
                name: 'Ukraine'
            },
            {
                name: 'United Arab Emirates'
            },
            {
                name: 'United Kingdom'
            },
            {
                name: 'United States'
            },
            {
                name: 'Uruguay'
            },
            {
                name: 'Uzbekistan'
            },
            {
                name: 'Vanuatu'
            },
            {
                name: 'Vatican City'
            },
            {
                name: 'Venezuela'
            },
            {
                name: 'Vietnam'
            },
            {
                name: 'Yemen'
            },
            {
                name: 'Zambia'
            },
            {
                name: 'Zimbabwe'
            }
        ];


        let selectCountries = $('#three_countries');
        selectCountries.empty();
        selectCountries.append('<option selected disabled>Select Option</option>');

        countries.forEach(country => {
            selectCountries.append(`<option value="${country.ssic}">${country.name} - ${country.ssic}</option>`);
        });

        new MultiSelectTag('three_countries');
    });