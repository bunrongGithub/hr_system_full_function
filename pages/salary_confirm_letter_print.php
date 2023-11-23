<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Print</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@300;400&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .header {
            width: 100%;
            height: 140px;
            display: flex;
        }

        .header>.left-box {
            width: 15%;
            height: 100%;
            padding-left: 0;
        }

        .header>.center-box {
            width: 65%;
            height: 100%;
        }

        .header>.right-box {
            width: 20%;
            height: 100%;
            display: flex;
            align-items: end;
            padding-bottom: 8px;
        }

        .header>.center-box>h2 {
            color: green;
            font-family: 'Nokora';
        }

        .header>.center-box>h4 {
            color: orange;
            font-family: sans-serif;
        }

        .header>.center-box>p {
            font-size: 12px;
            font-family: Noto Sans Khmer;
        }

        .header>.center-box>.eng {
            font-size: 10px;
            font-family: Noto Sans Khmer;
        }

        .header>.right-box>.box {
            width: 100%;
            height: 35px;
            border: 2px solid;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        hr {
            height: 7px;
            background-color: black;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            border: none;
        }

        .title1 {
            width: 100%;
            height: auto;
            margin-top: 70px;
            display: flex;
            justify-content: center;
            font-family: sans-serif;
        }

        .title2 {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            font-family: sans-serif;
        }

        .paragraph1 {
            width: 100%;
            margin-top: 30px;
        }

        .paragraph1>p {
            font-size: 15px;
            font-family: sans-serif;
            line-height: 1.7;
        }

        .title3 {
            width: 100%;
            height: auto;
            margin-top: 25px;
            display: flex;
            justify-content: center;
            font-family: sans-serif;
        }

        .paragraph2 {
            width: 100%;
            height: auto;
            margin-top: 25px;
        }

        pre {
            font-size: 15px;
            font-family: sans-serif;
            line-height: 1.7;
        }

        .paragraph3>p {
            font-size: 15px;
            font-family: sans-serif;
        }

        .footer {
            width: 100%;
            height: auto;
            margin-top: 25px;
            display: flex;
        }
        .footer>.footer-left{
            width: 60%;
        }
        .footer>.footer-right{
            width: 40%;
            line-height: 1.7;
        }
        .footer>.footer-right>.footer-right-1{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            font-family: sans-serif;
        }
        .footer>.footer-right>.footer-right-2{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            font-family: sans-serif;
        }
        .footer>.footer-right>.footer-right-3{
            width: 100%;
            height: auto;
            margin-top: 100px;
            display: flex;
            justify-content: center;
            font-family: sans-serif;
        }
        .footer>.footer-right>p {
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="left-box">
            <img width="105px" src="../img/setra_logo.png" alt="">
        </div>
        <div class="center-box">
            <h2>ផ្សារទំនើប​ សុីត្រា</h2>
            <h4>SETRA SUPERMARKET</h4>
            <p>ផ្ទះលេខ ១៤៨​ ផ្លូវ៧៨ ភូមិអូរកន្សែង</p>
            <p>សង្កាត់បឹងកន្សែង ក្រុងបានលុង ខេត្តរតនគិរី ព្រះរាជាណាចក្រកម្ពុជា</p>
            <p class="eng">No.148,St.78 O'KANSANG Village,</p>
            <p class="eng">Sangkat BOEUNG KANSANG,BANLUNG TOWN,RATANAKKIRI Provine Cambodia</p>
            <p class="eng">Tel: 097 ### ### / 011 240 595 | E-mail: setra@gmail.com</p>
        </div>
        <div class="right-box">
            <div class="box">
                <p><b>Form N<sup>o</sup> : 36</b></p>
            </div>
        </div>
    </div>
    <hr>
    <div style="margin-top: 30px;  font-family: sans-serif;">
        <p><b>HEAD OFFICE</b></p>
        <P><B>N<sup>o</sup>: 0133/ 23</B></P>
    </div>
    <div class="title1">
        <h3>SALARY AND POSITION</h3>
    </div>
    <div class="title2">
        <h3>COMFIRMATION</h3>
    </div>
    <div class="paragraph1">
        <p>The SETRA Supermarket's Head Office located No.148, St.78 Kandoak Village,
            Kandoak Commune, kandal Steng District, Kandak Provine Cambodia</p>
    </div>
    <div class="title3">
        <h3><u>CONFIRMED</u></h3>
    </div>
    <div class="paragraph2">
        <div class="par2-1">
            <pre>
1-     Name: SRENG MADI Gender: Male Birthday: 15-jan-1980 ID N<sup>o</sup>: 240180932 Position:
        Head of Finance and Accountant Is Working In:  RATANAKIRI Head Office of SETRA
        Supermarket
            </pre>
        </div>
        <div class="par2-2">
            <pre>
2-     The Employee Information as detail below :
     -  Start Working Date: 01-May-2022
     -  Working Contract:  <input type="checkbox"> Permanant  <input type="checkbox"> Probation
     -  Basic Salary: USD 1,500 (One thousand and five hundred dollars)
     -  Qualification for work: Gentle, diligent, honest, flexible and good performs.
            </pre>
        </div>
    </div>
    <div class="paragraph3">
        <p>This LETTER was issued to employee above as individual for official using as much as possible</p>
    </div>
    <div class="footer">
        <div class="footer-left"></div>
        <div class="footer-right">
            <div class="footer-right-1">
                <p>RATANAKIRI, Date: 06<sup>th</sup> Oct. 2023</p>
            </div>
            <div class="footer-right-2">
                <p>Head of HR and ADMIN</p>
            </div>
            <div class="footer-right-3">
                <p><b>LUN KEMSROUN</b></p>
            </div>
        </div>

    </div>
    <!-- <button onclick="window.print()"></i>Print this page</button> -->
</body>

</html>