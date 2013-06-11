<?php


class GenerateInvoice extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('/libpdf/reporting.php');
        $this->load->library('num_to_words.php');
    }
    public function index(){
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $titles=array('tenant'=>'James Kukirisa Silas', 'room_no'=>'A5', 'building'=>'City Center Complex','ac_no'=>'512001251451
                ','billing_date'=>'30-12-2012','invoice_no'=>7125334,'pay_date'=>'05-05-2013',
                'tamount'=>758000,'tamountwords'=>'seven hundred fifty Eight thousand only');
        $dataelec= array(array('Electricity',382541,562141,2100,482.32,758000),array('Service Fee',382541,562141,2100,482.32,758000));
        $datarent= array(array('Rent','2months',2100,5266100,482.32,758000));


        $databuilding=Array (
	0 => Array (
			'ten_name' => 'Silas Kaggwa',
			'date' => '',
                        'trans_no'=>'',
			'particulars' => '',
			'debit' => '',
			'credit' => '',
			'balance' => ''),
	1 => Array (
			'ten_name' => '',
			'date' => '01-12-2012',
                        'trans_no'=>'',
			'particulars' =>' Balance B/F',
			'debit' => '',
			'credit' => 0,
			'balance' => '' ),
	2 => Array (
			'ten_name' => '',
			'date' => '',
                        'trans_no'=>'',
			'particulars' => 'TOTAL',
			'debit' => 0,
			'credit' => 0,
			'balance' => 0 ),
         3 => Array (
			'ten_name' => 'Silas Kaggwa',
			'date' => '',
                        'trans_no'=>'',
			'particulars' => '',
			'debit' => '',
			'credit' => '',
			'balance' => ''),
	4 => Array (
			'ten_name' => '',
			'date' => '01-12-2012',
                        'trans_no'=>'',
			'particulars' =>' Balance B/F',
			'debit' => '',
			'credit' => 0,
			'balance' => '' ),
	5 => Array (
			'ten_name' => '',
			'date' => '',
                        'trans_no'=>'',
			'particulars' => 'TOTAL',
			'debit' => 0,
			'credit' => 0,
			'balance' => 0 )

        );
        //$pdf->InvoiceHead($titles);
        //$pdf->EleInvoiceTable($dataelec,$titles['tamount']);
        $ltitles=array('landlord'=>'Ibra Boss','date'=> '12-05-2013' );
        $datalandlord=Array ( 
	0 => Array ( 
				'b_name' => 'city center complex', 
				'b_num_rooms' => '36', 
				'potential' => '',
				'vacant' => '', 
				'expected' => '',
				'received' => ''), 
	1 => Array ( 
				'b_name' => 'Speke Resort', 
				'b_num_rooms' => 5, 
				'potential' => '',
				'vacant' => '',
				'expected' => '',
				'received' => '' )
		) ;
        $datatenants=array(array('room_name'=>"A34", 'd_payment'=>'12-01-2014', 'particulars'=>'rent', 'bill_amount'=>230000,'pay_amount'=>560000,'bal'=>890000),
                    array('room_name'=>"A34", 'd_payment'=>'12-01-2014', 'particulars'=>'total', 'bill_amount'=>230000,'pay_amount'=>560000,'bal'=>890000));
        $ttitles=array('t_name'=>'Ibra Boss','date'=> '12-05-2013' );
        //$pdf->ReportHeaders();
        //$pdf->TenantsHead($ttitles);
        //$pdf->TenantsTable($datatenants);
        $pdf->Headers();
        $pdf->InvoiceHead($titles);
        $pdf->EleInvoiceTable($dataelec,$titles['tamount']);
        $pdf->InvoiceFoot($titles['tamountwords']);
        $pdf->Output();
    }

    public function buildingReports(){
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->BuildingHead($titles);
        $pdf->BuildingTable($databuilding);
        $pdf->Output();

    }
    public function landLordReport(){
        $ltitles=array('landlord'=>'Ibra Boss','date'=> '12-05-2013' );
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->LandLordHead($ltitles);
        $pdf->LandLordTable($datalandlord);
        $pdf->Output();
    }
    public function Umeme_Invoice($titles, $data, $amount_due, $amountwords){
        $pdf = new Reporting();
        $pdf->Headers();
        $pdf->InvoiceHead ($headInfo);
        $pdf->EleInvoiceTable($data,$amount_due);
        $pdf->InvoiceFoot($amountwords);
    }



}

?>
