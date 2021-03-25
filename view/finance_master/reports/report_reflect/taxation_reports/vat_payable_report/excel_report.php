<?php
include "../../../../../../model/model.php";
include_once('../gst_sale/sale_generic_functions.php');
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../../../../../../classes/PHPExcel-1.8/Classes/PHPExcel.php';

//This function generates the background color
function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}

//This array sets the font atrributes
$header_style_Array = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 12,
        'name'  => 'Verdana'
    ));
$table_header_style_Array = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Verdana'
    ));
$content_style_Array = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 9,
        'name'  => 'Verdana'
    ));

//This is border array
$borderArray = array(
          'borders' => array(
              'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN
              )
          )
      );

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                             ->setLastModifiedBy("Maarten Balliauw")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");

//////////////////////////****************Content start**************////////////////////////////////

$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$taxation_id=$_GET['taxation_id'];
$branch_status = $_GET['branch_status'];


if($from_date!="" && $to_date!=""){
    $date_str = $from_date.' to '.$to_date;
}
else{
    $date_str = "";
}
if($taxation_id != '0'){
  $sq_taxation = mysql_fetch_assoc(mysql_query("select * from taxation_master where taxation_id='$taxation_id'"));
  $sq_tax_type = mysql_fetch_assoc(mysql_query("select * from tax_type_master where tax_type_id='$sq_taxation[tax_type_id]'"));
}
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
           ->setCellValue('B2', 'Report Name')
            ->setCellValue('C2', 'VAT Payable')
            ->setCellValue('B3', 'From-To-Date')
            ->setCellValue('C3', $date_str)
            ->setCellValue('B4', 'Tax(%)')
            ->setCellValue('C4',$sq_tax_type['tax_type'].'-'.$sq_taxation['tax_in_percentage']);

$objPHPExcel->getActiveSheet()->getStyle('B2:C2')->applyFromArray($header_style_Array);
$objPHPExcel->getActiveSheet()->getStyle('B2:C2')->applyFromArray($borderArray);    

$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->applyFromArray($header_style_Array);
$objPHPExcel->getActiveSheet()->getStyle('B3:C3')->applyFromArray($borderArray);    

$objPHPExcel->getActiveSheet()->getStyle('B4:C4')->applyFromArray($header_style_Array);
$objPHPExcel->getActiveSheet()->getStyle('B4:C4')->applyFromArray($borderArray);

$row_count = 7;      


$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$row_count, "Sr.No")
        ->setCellValue('C'.$row_count, "Service Name")
        ->setCellValue('D'.$row_count, "Customer Name")
        ->setCellValue('E'.$row_count, "Booking ID")
        ->setCellValue('F'.$row_count, "Booking Date")
        ->setCellValue('G'.$row_count, "VAT Number")
        ->setCellValue('H'.$row_count, "Type Of Customer")
        ->setCellValue('I'.$row_count, "Rate")
        ->setCellValue('J'.$row_count, "Taxable Amount")
        ->setCellValue('K'.$row_count, "VAT Amount");


$objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($header_style_Array);
$objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);    

$row_count++;
  $count = 1;
  //Passport Booking
  $query = "select * from passport_master where 1 ";
  if($from_date !='' && $to_date != ''){
    $from_date = get_date_db($from_date);
    $to_date = get_date_db($to_date);
    $query .= " and created_at between '$from_date' and '$to_date' ";
  }
  if($taxation_id != '0'){
    $query .= " and taxation_id = '$taxation_id'";
  }
  $sq_query = mysql_query($query);
    while($row_query = mysql_fetch_assoc($sq_query))
    {
      //Total count
    $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from passport_master_entries where passport_id ='$row_query[passport_id]'"));

    //Cancelled count
    $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from passport_master_entries where passport_id ='$row_query[passport_id]' and status ='Cancel'"));
    if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
    {
        $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
        if($sq_cust['type'] == 'Corporate'){
          $cust_name = $sq_cust['company_name'];
        }else{
          $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
        }
        $taxable_amount = $row_query['passport_issue_amount'] + $row_query['service_charge'];
        $hsn_code = get_service_info('Passport');

        $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
        
      $tax_per = $row_query['service_tax'];
      $tax_amount = $row_query['service_tax_subtotal'];

       $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Passport Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_passport_booking_id($row_query['passport_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);    

      $row_count++;   
     }
  }

//Visa Booking
$query = "select * from visa_master where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
  $query .= " and taxation_id = '$taxation_id'";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from visa_master_entries where visa_id ='$row_query[visa_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from visa_master_entries where visa_id ='$row_query[visa_id]' and status ='Cancel'"));
  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
  {
      $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
      if($sq_cust['type'] == 'Corporate'){
        $cust_name = $sq_cust['company_name'];
      }else{
        $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
      }
      $taxable_amount = $row_query['visa_issue_amount'] + $row_query['service_charge'];
      $hsn_code = get_service_info('Visa');

      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
      
    $tax_per = $row_query['service_tax'];
    $tax_amount = $row_query['service_tax_subtotal']; 

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Visa Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_visa_booking_id($row_query['visa_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray); 
      
      $row_count++;   
    }
}

//Bus Booking
    $query = "select * from bus_booking_master where 1 ";
    if($from_date !='' && $to_date != ''){
      $from_date = get_date_db($from_date);
      $to_date = get_date_db($to_date);
      $query .= " and created_at between '$from_date' and '$to_date' ";
    }
    if($taxation_id != '0'){
      $query .= " and taxation_id = '$taxation_id'";
    }
    $sq_query = mysql_query($query);
      while($row_query = mysql_fetch_assoc($sq_query))
      {
        //Total count
      $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from bus_booking_entries where booking_id ='$row_query[booking_id]'"));

      //Cancelled count
      $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from bus_booking_entries where booking_id ='$row_query[booking_id]' and status ='Cancel'"));
      if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
      {
          $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
          if($sq_cust['type'] == 'Corporate'){
            $cust_name = $sq_cust['company_name'];
          }else{
            $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
          }
          $taxable_amount = $row_query['basic_cost'] + $row_query['service_charge'];
          $hsn_code = get_service_info('Bus');

          $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
          
        $tax_per = $row_query['service_tax'];
        $tax_amount = $row_query['service_tax_subtotal'];

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Bus Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_bus_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);  
      
      $row_count++;   
    }
}

//Forex Booking
    $query = "select * from forex_booking_master where 1 ";
    if($from_date !='' && $to_date != ''){
      $from_date = get_date_db($from_date);
      $to_date = get_date_db($to_date);
      $query .= " and created_at between '$from_date' and '$to_date' ";
    }
    if($taxation_id != '0'){
      $query .= " and taxation_id = '$taxation_id'";
    }
    $sq_query = mysql_query($query);
      while($row_query = mysql_fetch_assoc($sq_query))
      {
        $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
        if($sq_cust['type'] == 'Corporate'){
          $cust_name = $sq_cust['company_name'];
        }else{
          $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
        }
        $taxable_amount = $row_query['basic_cost'] + $row_query['service_charge'];
        $hsn_code = get_service_info('Forex');

        $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
        
      $tax_per = $row_query['service_tax'];
      $tax_amount = $row_query['service_tax_subtotal'];
    

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Forex Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_forex_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);  

      $row_count++;   
}  

//Excursion Booking
$query = "select * from excursion_master where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
  $query .= " and taxation_id = '$taxation_id'";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from excursion_master_entries where exc_id ='$row_query[exc_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from excursion_master_entries where exc_id ='$row_query[exc_id]' and status ='Cancel'"));
  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
  {
      $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
      if($sq_cust['type'] == 'Corporate'){
        $cust_name = $sq_cust['company_name'];
      }else{
        $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
      }
      $taxable_amount = $row_query['exc_issue_amount'] + $row_query['service_charge'];
      $hsn_code = get_service_info('Excursion');

      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
      
    $tax_per = $row_query['service_tax'];
    $tax_amount = $row_query['service_tax_subtotal'];

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Excursion Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_exc_booking_id($row_query['exc_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);  

      $row_count++;   
     }
  }

//Hotel Booking
$query = "select * from hotel_booking_master where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
  $query .= " and taxation_id = '$taxation_id'";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from hotel_booking_entries where booking_id ='$row_query[booking_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from hotel_booking_entries where booking_id ='$row_query[booking_id]' and status ='Cancel'"));

  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
  {
      $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
      if($sq_cust['type'] == 'Corporate'){
        $cust_name = $sq_cust['company_name'];
      }else{
        $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
      }
      $taxable_amount = $row_query['sub_total'] + $row_query['service_charge'];
      $hsn_code = get_service_info('Hotel / Accommodation');

      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
      
    $tax_per = $row_query['service_tax'];
    $tax_amount = $row_query['service_tax_subtotal'];

       $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Hotel Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_hotel_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);   

      $row_count++;   
     }
  }

//Car Rental Booking
$query = "select * from car_rental_booking where status != 'Cancel' ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
  $query .= " and taxation_id = '$taxation_id'";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
  if($sq_cust['type'] == 'Corporate'){
    $cust_name = $sq_cust['company_name'];
  }else{
    $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
  }
  $taxable_amount = $row_query['actual_cost'] + $row_query['km_total_fee'];
  $hsn_code = get_service_info('Car Rental');

  $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
  
  $tax_per = $row_query['service_tax'];
  $tax_amount = $row_query['service_tax_subtotal'];

   $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$row_count, $count++)
        ->setCellValue('C'.$row_count, "Car Rental Booking")
        ->setCellValue('D'.$row_count, $cust_name)
        ->setCellValue('E'.$row_count, get_car_rental_booking_id($row_query['booking_id']))
        ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
        ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
        ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
        ->setCellValue('I'.$row_count, $row_query['service_tax'])
        ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
        ->setCellValue('K'.$row_count, $tax_amount);


    $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);    

      $row_count++;   
 }

//Flight Booking
$query = "select * from ticket_master where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
  $query .= " and taxation_id = '$taxation_id'";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from ticket_master_entries where ticket_id ='$row_query[ticket_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from ticket_master_entries where ticket_id ='$row_query[ticket_id]' and status ='Cancel'"));
  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
  {
      $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
      if($sq_cust['type'] == 'Corporate'){
        $cust_name = $sq_cust['company_name'];
      }else{
        $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
      }
      $taxable_amount = $row_query['basic_cost'] + $row_query['basic_cost_markup'] - $row_query['basic_cost_discount']+ $row_query['yq_tax'] + $row_query['yq_tax_markup'] - $row_query['yq_tax_discount'] + $row_query['g1_plus_f2_tax'] + $row_query['service_charge'];
      $hsn_code = get_service_info('Flight');

      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
      
    $tax_per = $row_query['service_tax'];
    $tax_amount = $row_query['service_tax_subtotal'];
    
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Ticket Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_ticket_booking_id($row_query['ticket_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);    

      $row_count++;   
     }
  }
  
//Train Booking
$query = "select * from train_ticket_master where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and created_at between '$from_date' and '$to_date' ";
}
if($taxation_id != '0'){
  $query .= " and taxation_id = '$taxation_id'";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as booking_count from train_ticket_master_entries where train_ticket_id ='$row_query[train_ticket_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(entry_id) as cancel_count from train_ticket_master_entries where train_ticket_id ='$row_query[train_ticket_id]' and status ='Cancel'"));
  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
  {
      $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
      if($sq_cust['type'] == 'Corporate'){
        $cust_name = $sq_cust['company_name'];
      }else{
        $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
      }
      $taxable_amount = $row_query['basic_fair'] + $row_query['service_charge'] + $row_query['delivery_charges'];
      $hsn_code = get_service_info('Train');

      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));
      
    $tax_per = $row_query['service_tax'];
    $tax_amount = $row_query['service_tax_subtotal'];

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Train Ticket Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_train_ticket_booking_id($row_query['train_ticket_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['created_at']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);   

      $row_count++;   
     }
  }

//GIT Booking
$query = "select * from tourwise_traveler_details where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and form_date between '$from_date' and '$to_date' ";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(traveler_id) as booking_count from travelers_details where traveler_group_id ='$row_query[id]'"));

  //Group cancel or not
  $sq_group = mysql_fetch_assoc(mysql_query("select status from tour_groups where group_id ='$row_query[tour_group_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(traveler_id) as cancel_count from travelers_details where traveler_group_id ='$row_query[id]' and status ='Cancel'"));
  $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
  if($sq_cust['type'] == 'Corporate'){
    $cust_name = $sq_cust['company_name'];
  }else{
    $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
  }

  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'] || $sq_group['status'] != 'Cancel')
  {
      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));

      //Train
      if($row_query['train_taxation_id'] !='0'){
      $hsn_code = get_service_info('Train');
      $taxable_amount = $row_query['train_expense'] + $row_query['train_service_charge'];
      
    $tax_per = $row_query['train_service_tax'];
    $tax_amount = $row_query['train_service_tax_subtotal'];        

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Group Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_group_booking_id($row_query['id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['form_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['train_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);   

      $row_count++;   
     }
     //Flight
      if($row_query['plane_taxation_id'] !='0'){
      $hsn_code = get_service_info('Flight');
      $taxable_amount = $row_query['plane_expense'] + $row_query['plane_service_charge'];

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Group Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_group_booking_id($row_query['id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['form_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['plane_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);

        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);     

      $row_count++;   
     }
      //Cruise
      if($row_query['cruise_taxation_id'] !='0'){
      $hsn_code = get_service_info('Cruise');
      $taxable_amount = $row_query['cruise_expense'] + $row_query['cruise_service_charge'];

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Group Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_group_booking_id($row_query['id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['form_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['cruise_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);   
      $row_count++;   
     }
      //Visa
      if($row_query['visa_taxation_id'] !='0'){
      $hsn_code = get_service_info('Visa');
      $taxable_amount = $row_query['visa_amount'] + $row_query['visa_service_charge'];
      
      $tax_per = $row_query['visa_service_tax'];
      $tax_amount = $row_query['visa_service_tax_subtotal'];
      $tax_amount = $row_query['plane_service_tax_subtotal'];


        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Group Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_group_booking_id($row_query['id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['form_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['visa_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);      

      $row_count++;   
     }
     //Insurance
      if($row_query['insuarance_taxation_id'] !='0'){
      $hsn_code = get_service_info('Group Tour');
      $taxable_amount = $row_query['insuarance_amount'] + $row_query['insuarance_service_charge'];
      
    $tax_per = $row_query['insuarance_service_tax'];
    $tax_amount = $row_query['insuarance_service_tax_subtotal'];
    $tax_amount = $row_query['plane_service_tax_subtotal'];
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Group Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_group_booking_id($row_query['id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['form_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['insuarance_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);      

      $row_count++;   
     }
     //Tour
      if($row_query['tour_taxation_id'] !='0'){
      $hsn_code = get_service_info('Group Tour');
      $taxable_amount = $row_query['tour_fee_subtotal_1'];
      
    $tax_per = $row_query['service_tax_per'];
    $tax_amount = $row_query['service_tax'];
    $tax_amount = $row_query['plane_service_tax_subtotal'];

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Group Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_group_booking_id($row_query['id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['form_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['service_tax_per'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);  


      $row_count++;   
     }
  }
}
/////////////////////////

//FIT Booking
$query = "select * from package_tour_booking_master where 1 ";
if($from_date !='' && $to_date != ''){
  $from_date = get_date_db($from_date);
  $to_date = get_date_db($to_date);
  $query .= " and booking_date between '$from_date' and '$to_date' ";
}
$sq_query = mysql_query($query);
while($row_query = mysql_fetch_assoc($sq_query))
{
  //Total count
  $sq_count = mysql_fetch_assoc(mysql_query("select count(traveler_id) as booking_count from package_travelers_details where booking_id ='$row_query[booking_id]'"));

  //Cancelled count
  $sq_cancel_count = mysql_fetch_assoc(mysql_query("select count(traveler_id) as cancel_count from package_travelers_details where booking_id ='$row_query[booking_id]' and status ='Cancel'"));
  $sq_cust = mysql_fetch_assoc(mysql_query("select * from customer_master where customer_id='$row_query[customer_id]'"));
  if($sq_cust['type'] == 'Corporate'){
    $cust_name = $sq_cust['company_name'];
  }else{
    $cust_name = $sq_cust['first_name'].' '.$sq_cust['last_name'];
  }

  if($sq_count['booking_count'] != $sq_cancel_count['cancel_count'])
  {
      $sq_state = mysql_fetch_assoc(mysql_query("select * from state_master where id='$sq_cust[state_id]'"));

      //Train
      if($row_query['train_taxation_id'] !='0'){
      $hsn_code = get_service_info('Train');
      $taxable_amount = $row_query['train_expense'] + $row_query['train_service_charge'];
      
    $tax_per = $row_query['train_service_tax'];
    $tax_amount = $row_query['train_service_tax_subtotal'];

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Package Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_package_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['booking_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['train_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);  

      $row_count++;   
     }
     //Flight
      if($row_query['plane_taxation_id'] !='0'){
      $hsn_code = get_service_info('Flight');
      $taxable_amount = $row_query['plane_expense'] + $row_query['plane_service_charge'];
      
    $tax_per = $row_query['plane_service_tax'];
    $tax_amount = $row_query['plane_service_tax_subtotal'];

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Package Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_package_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['booking_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['plane_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);     

      $row_count++;   
     }
      //Cruise
      if($row_query['cruise_taxation_id'] !='0'){
      $hsn_code = get_service_info('Cruise');
      $taxable_amount = $row_query['cruise_expense'] + $row_query['cruise_service_charge'];
      
    $tax_per = $row_query['cruise_service_tax'];
    $tax_amount = $row_query['cruise_service_tax_subtotal'];
    $tax_amount = $row_query['plane_service_tax_subtotal'];


    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Package Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_package_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['booking_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['cruise_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);    

      $row_count++;   
     }
      //Visa
      if($row_query['visa_taxation_id'] !='0'){
      $hsn_code = get_service_info('Visa');
      $taxable_amount = $row_query['visa_amount'] + $row_query['visa_service_charge'];

      
    $tax_per = $row_query['visa_service_tax'];
    $tax_amount = $row_query['visa_service_tax_subtotal'];
    $tax_amount = $row_query['plane_service_tax_subtotal'];
    

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Package Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_package_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['booking_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['visa_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);   

      $row_count++;   
     }
     //Insurance
      if($row_query['insuarance_taxation_id'] !='0'){
      $hsn_code = get_service_info('Package Tour');
      $taxable_amount = $row_query['insuarance_amount'] + $row_query['insuarance_service_charge'];
      
    $tax_per = $row_query['insuarance_service_tax'];
    $tax_amount = $row_query['insuarance_service_tax_subtotal'];
    $tax_amount = $row_query['plane_service_tax_subtotal'];


    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Package Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_package_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['booking_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['insuarance_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray);    

      $row_count++;   
     }
     //Tour
      if($row_query['tour_service_tax_subtotal'] !='0'){
      $hsn_code = get_service_info('Package Tour');
      $taxable_amount = $row_query['subtotal'];
      
    $tax_per = $row_query['tour_service_tax'];
    $tax_amount = $row_query['tour_service_tax_subtotal'];


    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row_count, $count++)
            ->setCellValue('C'.$row_count, "Package Booking")
            ->setCellValue('D'.$row_count, $cust_name)
            ->setCellValue('E'.$row_count, get_package_booking_id($row_query['booking_id']))
            ->setCellValue('F'.$row_count, get_date_user($row_query['booking_date']))
            ->setCellValue('G'.$row_count,($sq_cust['service_tax_no'] == '') ? 'NA' : $sq_cust['service_tax_no'] )
            ->setCellValue('H'.$row_count, ($sq_cust['service_tax_no'] == '') ? 'Unregistered' : 'Registered')
            ->setCellValue('I'.$row_count, $row_query['tour_service_tax'])
            ->setCellValue('J'.$row_count, number_format($taxable_amount,2))
            ->setCellValue('K'.$row_count, $tax_amount);


        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($content_style_Array);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.':K'.$row_count)->applyFromArray($borderArray); 
         

      $row_count++;   
     }
  }
}
//////////////////////////****************Content End**************////////////////////////////////
  

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


for($col = 'A'; $col !== 'N'; $col++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
}


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="VAT Payable Report('.date('d-m-Y H:i:s').').xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
