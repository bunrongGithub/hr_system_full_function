<?php
include '../config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$datetime = date('Y-m-d H:i:s');
$yeardate = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
require('../fpdf/fpdf.php');

$id = $_GET['pdf_id'];
$sql = "SELECT * FROM admin_asset_in left join assest_code_creation on assest_code_creation.ac_id = admin_asset_in.adassi_code_id
LEFT JOIN text_asset_code_creation_type ON text_asset_code_creation_type.acct_id = admin_asset_in.adassi_type
LEFT JOIN text_asset_in_status ON text_asset_in_status.ais_id = admin_asset_in.adassi_status 
where adassi_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$info = [
   'Date' => $datetime,
   'No' => $row['adassi_no'],
   'AssetCode' => $row['ac_asset_code'],
   'location'=>$row['adassi_location'],
   'contact' => $row['adassi_contact'],
   'asset_type' => $row['acct_name'],
   'start_date' => $row['adassi_date'],
   'qty' => $row['adassi_qty'],
   'unit_price' => $row['adassi_unit_price'],
   'total_amount' => $row['adassi_total'],
   'status' => $row['ais_name'],
   'asset_name'=> $row['adassi_asset_name'],
   'asset_img' => '../img/upload/asset_in/'.$row['adassi_img'],
   $sql_id =  $row['adassi_category_id'],
   $sql_select = "SELECT * FROM assest_code_creation WHERE ac_id = $sql_id",
   $result = $connect->query($sql_select),
   $result_row = $result->fetch_assoc(),
   'categories' => $result_row['as_asset_category'],
   'supplierName'=>$row['adassi_supplier_name'],
   'Period' =>$row['adassi_war_peri'],
   'Condition'=>$row['adassi_war_con'],
   'Inspection'=>$row['adassi_insepection']
];
class PDF extends FPDF{
   function Header(){
      $this->SetFont('Arial','',20);
      $this->Cell(0,0,'Asset Information',0,1,'C');

      $this->SetFont('Arial','',20);
      $this->Cell(0,0,'Asset Photo',0,1,'L');

      $this->SetFont('Arial','',20);
      $this->Cell(0,0,'Auto Calendar',0,1,'R');
      $this->SetY(1);
      $this->SetX(-50);
      $this->SetFont('Arial','',6);
      $this->Cell(50,10,'Date: '.date('Y-m-d H:i:s'),0,1);
   }
   function body($info){
      $this->Image($info['asset_img'],10,25,50,50);
      $this->SetFont('Arial','',15);
      $this->Cell(0,25,'Asset No: '.$info['No'],0,1,'C',false,'');
      $this->SetY(30);
      $this->SetX(-210);
      $this->Cell(0,0,'Categories: '.$info['categories'],0,0,"C",false,'');
      $this->SetY(40);
      $this->SetX(-210);
      $this->Cell(0,0,'Asset Code: '.$info['AssetCode'],0,0,"C",false,'');
      $this->SetY(50);
      $this->SetX(-210);
      $this->Cell(0,0,'Asset type: '.$info['asset_type'],0,0,"C",false,'');
      $this->SetY(60);
      $this->SetX(-210);
      $this->Cell(0,0,'Asset Name: '.$info['asset_name'],0,0,"C",false,'');
      $this->SetY(70);
      $this->SetX(-210);
      $this->Cell(0,0,'QTY: '.$info['qty'],0,0,"C",false,'');
      $this->SetY(80);
      $this->Cell(0,0,'Unit Price: '.$info['unit_price'].'$',0,0,"C",false,'');
      $this->SetY(90);
      $this->SetX(-210);
      $this->Cell(0,0,'Total Amount: '.$info['total_amount'].'$',0,0,"C",false,'');
      $this->SetY(100);
      $this->SetX(-210);
      $this->Cell(0,0,'Location: '.$info['location'],0,0,"C",false,'');
      $this->SetY(10);
      $this->SetX(-60);
      $this->Cell(0,25,'Dart Start: '.$info['start_date'],0,0,"L",false,'');
      $this->SetY(20);
      $this->SetX(-60);
      $this->Cell(0,25,'Status: '.$info['status'],0,0,"L",false,'');
      $this->SetY(30);
      $this->SetX(-60);
      $this->Cell(0,25,'Supplier: '.$info['supplierName'],0,0,"L",false,'');
      $this->SetY(40);
      $this->SetX(-60);
      $this->Cell(0,25,'Contact: '.$info['contact'],0,0,"L",false,'');
      $this->SetY(50);
      $this->SetX(-60);
      $this->Cell(0,25,'Period: '.$info['Period'],0,0,"L",false,'');
      $this->SetY(60);
      $this->SetX(-60);
      $this->Cell(0,25,'Condition: '.$info['Condition'],0,0,"L",false,'');
      $this->SetY(70);
      $this->SetX(-60);
      $this->Cell(0,25,'Inspection: '.$info['Inspection'],0,0,"L",false,'');

   }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
// $path = '../img/upload/asset_in/';
// $image = $path.$row['adassi_img'];
// $pdf->Image($image,10,15,40,40);
$pdf->body($info);
$pdf->Output('D',$info['asset_name'].'.pdf',true);
