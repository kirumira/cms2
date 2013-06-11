<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Controller {
    var $x;
     function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->library('/libpdf/reporting.php');
        $this->load->library('num_to_words.php');
        $this->load->model('tenant');
        $this->load->model('bill');
        $this->load->model('landlord');
        $this->load->model('building');
        $this->load->model('floor');
        $this->load->model('room');
        $this->x = $this->building->reg_form_drops();
        $this->x['floor_names'] = $this->floor->get_all_floors();
    }
    public function rooms_report($room_id, $start, $end){
        $data = $this->room->get_excel_data(array('rm_id'=>$room_id, 'start'=>date('Y-m-d', strtotime($start)), 'end'=>date('Y-m-d', strtotime($end))));
        $rm_name = $this->room->get_room_name(array('rm_id'=>$room_id));
        $info_title = $rm_name[0]['room_name']." Room Report";
        $col_titles = array('Tenant Name', 'Transaction Date', 'Particulars', 'Debit', 'Credit', 'Balance');
        $last_col = 'G';
        $header = array('Tenant Name', 'Trans. Date', 'Particulars','Debit','Credit', 'Balance');
        // Column widths
        $w = array(40, 25, 63, 20, 20, 15);
        //print_r($data);

        $ltitles=array('r_name'=>$rm_name[0]['room_name'],'date'=> date('d-m-Y') );
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->RoomHead($w, $header, 'ROOM REPORT', $ltitles);
        if($this->session->userdata('currency')=='USD'){$pdf->RoomTableUSD($data);}else{$pdf->RoomTable($data);}
        $pdf->Output();

//        $this->to_excel($info_title, $col_titles, $data['ex_data'], $last_col, $data['dr'], $data['cr']);
//
//        $x = $this->building->reg_form_drops();
//        $x['active'] = 'REP';
//        $this->load->view('accounts_header');
//        $this->load->view('xx_menu',$x);
//        $this->load->view('payment_page');
//        $this->load->view('xx_footer');
    }
    public function Umeme_report($rm_id, $start_date, $end_date){
        $this->load->model('bill');
        $data = $this->bill->umeme_report(array('start_date'=>date('Y-m-d', strtotime($start_date)), 'end_date'=>date('Y-m-d', strtotime($end_date)), 'rm_id'=>$rm_id));
        //print_r($data);
        $rm = $this->room->get_room_name(array('rm_id'=>$rm_id));

        $headInfo=array('r_name'=>$rm[0]['room_name'],'date'=> date('d-m-Y') );
        $header = array('Date', 'Old Reading', 'New Reading', 'Units', 'Debit', 'Credit', 'Balance');
        // Column widths
        $w = array(29, 29, 25, 25, 25, 25, 25);
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->UmemeHead($w, $header,'UMEME REPORT',$headInfo);
        $pdf->UmemeTable($data);
        $pdf->Output();
    }

    public function pending_report(){
        $this->load->model('room');
        $data = $this->room->get_pending_excel_data(array('building_id'=>$this->session->userdata('building_id')));

        $column_sizes = array(61, 61, 61);
        $columnNames = array('Tenant', 'Room', 'Date');
        $headinfo = array();
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->PendingHeader($column_sizes, $columnNames, 'PENDING TENANTS REPORT', $headinfo);
        $pdf->PendingTable($data);
        $pdf->Output();
    }

    public function agent_report(){
        $this->load->model('user');
        $data = $this->user->get_agents_excel_data();
        $column_sizes = array(39, 36, 36, 36, 36);
        $columnNames = array('Agent','Tenant', 'Building', 'Room', 'Tenant Status');
        $headinfo = array();
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->AgentHeader($column_sizes, $columnNames, 'AGENT REPORT', $headinfo);
        $pdf->AgentTable($data);
        $pdf->Output();
    }

    public function tenants_report($tenant_id, $start, $end){
        $data = $this->tenant->get_excel_data(array('ten_id'=>$tenant_id, 'start_date'=>date('Y-m-d', strtotime($start)), 'end_date'=>date('Y-m-d', strtotime($end))));
        $ten_name = $this->tenant->get_tenant_name(array('ten_id'=>$tenant_id));
        $info_title = $ten_name[0]['f_name']." ".$ten_name[0]['l_name']." Tenant Report";
        $col_titles = array('Room Name', 'Transaction Date', 'Particulars', 'Debit', 'Credit', '','Balance');
        $last_col = 'G';
        $header = array('Room', 'Trans. Date', 'Particulars','Debit','Credit', '', '','Balance');
        // Column widths
        $w = array(20, 28, 40, 38, 28, 38, 20, 18, 38);
        $w2 = array(15, 25, 48, 30, 30, 5, 30);

        $ltitles=array(
                    'b_name'=>$this->session->userdata('building_name'), 
                    's_date'=>date('d-m-Y', strtotime($start)), 
                    'e_date'=>date('d-m-Y', strtotime($end)), 
                    't_name'=>$ten_name[0]['f_name']." ".$ten_name[0]['l_name'],
                    'date'=> date('d-m-Y') );
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);       
        if($this->session->userdata('currency')=='USD'){
            $pdf->AddPage('L');
            $pdf->ReportHeadersLandscape();
            $pdf->TenantsHead2($w, $header, 'TENANT REPORT',$ltitles);
            $pdf->TenantsTableUSD($data);
        }else{
            $pdf->AddPage();
            $pdf->ReportHeaders();
            $pdf->TenantsHead($w2, $header, 'TENANT REPORT1',$ltitles);
            $pdf->TenantsTable($data);}
        $pdf->Output();
    }

    public function landlords_report($landlord_id, $start, $end){
        $data = $this->landlord->get_excel_data(array('landlord_id'=>$landlord_id, 'start_date'=>date('Y-m-d', strtotime($start)),'end_date'=>date('Y-m-d', strtotime($end))));
        $name = $this->landlord->get_landlord_name(array('landlord_id'=>$landlord_id));
        $col_titles = array('Building Name', 'Num. Rooms', 'Potential Revenue', 'Expected Revenue', 'Vacant Revenue', 'Received Revenue');
        $last_col = 'G';
        $info_title = $name.": Landlord Report";
        $columnNames=array('Building Name', 'Potential Revenue','Expected Revenue','Vacant Revenue','Actual Revenue', 'Outstanding');
        $column_sizes=array(48, 30, 30, 25, 25, 25);

        // Column widths

        $ltitles=array('landlord'=>$name,'date'=> date('d-m-Y') );
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->LandLordHead($column_sizes, $columnNames, 'LANDLORD REPORT',$ltitles);
        $pdf->LandLordTable($data);
        $pdf->Output();
    }
    public function building_report( $start_date, $end_date){
        $data = $this->building->get_excel_data($this->session->userdata('building_id'), $start_date, $end_date);
//        $col_titles = array('Tenant Name', 'Transaction Date', 'Details', 'Debit', 'Credit', 'Balance');
//        $last_col = 'G';
//        $info_title = $this->session->userdata('building_name').": Building Report";
//        $this->to_excel($info_title, $col_titles, $data, $last_col);
        $titles = array('building'=>$this->session->userdata('building_name'), 'date'=>date('d-m-Y'));
        $columnNames = array('    Tenant Name', '', 'Trans. No', 'Details','Debit','Credit','Balance');
        $columnSizes = array(5, 23, 22, 73, 24, 24, 24);
        $title = 'BUILDING REPORT';
           //print_r($data);
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',8);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->BuildingHead($columnSizes, $columnNames, $title, $titles);
        if($this->session->userdata('currency')=='USD'){$pdf->BuildingTableUSD($data);}else{$pdf->BuildingTable($data);}
        $pdf->Output();

        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'REP';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu',$this->x);
        $this->load->view('payment_page');
        $this->load->view('xx_footer');
    }
//    public function closing_report($building_id){
//        $data = $this->bill->get_closing_excel(array('b_id'=>$building_id));
//    }

    public function get_total_collections(){
        $date = '2012-02-08';
        $data = $this->bill->get_total_daily_collection(array('date'=>date('Y-m-d', strtotime($date))));
        print_r($data);
    }
    public function general_payments_report($date){
        $this->load->model('bill');
        //$date = '2013-02-08';
        $data = $this->bill->get_total_daily_collection(array('date'=>date('Y-m-d', strtotime($date))));
        $header = array('Property', 'Tenant Name', 'Receipt No.','Period','(UGX)','EQV(USD)', '(USD)', 'Landlord');
        $w = array(47, 40, 25, 43, 25, 25, 25, 50);

        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage('L');
        $pdf->ReportHeadersTABLE();
        $pdf->DailyBuildingsTableHeader($w, $header, 'GENERAL TOTAL DAILY COLLECTIONS REPORT');
        $pdf->DailyBuildingsTable($data);
        $pdf->Output();
    }
    public function landlords_collections($l_id, $start, $end){
//        $l_id = 1;
//        $start = date('Y-m-d', strtotime('2013-02-01'));
//        $end = date('Y-m-d', strtotime('2013-02-12'));

        $data = $this->bill->get_landlord_collection(array('landlord_id'=>$l_id,'start'=>date('Y-m-d', strtotime($start)), 'end'=>date('Y-m-d', strtotime($end))));
        //print_r($options=array('landlord_id'=>$l_id,'start'=>$start, 'end'=>$end));
        //print_r($data);

        $headinfo = array('start'=>date('d-M-Y',strtotime($start)),'end'=>date('d-M-Y',strtotime($end)));
        $headinfo['landlord_name'] = $this->landlord->get_landlord_name(array('landlord_id'=>$l_id)) ;
        $columnNames = array('Date', 'Property', 'Tenants','Period','Rent(UGX)','VAT(UGX)','TOTAL(UGX)','Rent(USD)','VAT(USD)','TOTAL(USD)');
        $column_sizes =array(25, 40, 40, 25, 25, 25, 25, 25, 25, 25);

        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage('L');
        $pdf->ReportHeadersTABLE();
        $pdf->LandlordsCollectionsHeader($column_sizes, $columnNames, 'GENERAL TOTAL LANDLORD COLLECTIONS REPORT', $headinfo,$headinfo);
        $pdf->LandlordsCollectionsTable($data);
        $pdf->Output();
    }
    public function bounced_report($l_id, $start, $end){
        //$l_id=3;$start='01-02-2013';$end='21-02-2013';
        $this->load->model('landlord');
        $data = $this->landlord->get_bounced_data(array('landlord_id'=>$l_id, 'start'=>date('Y-m-d', strtotime($start)),'end'=>date('Y-m-d', strtotime($end))));
        //print_r($data);return;
        $headinfo = array('start'=>date('d-M-Y',strtotime($start)),'end'=>date('d-M-Y',strtotime($end)));
        $headinfo['landlord_name'] = $this->landlord->get_landlord_name(array('landlord_id'=>$l_id)) ;
        $columnNames = array('Date', 'Property', 'Tenant','Receipt No','Amount(UGX)','VAT(UGX)','TOTAL(UGX)','Amount(USD)','VAT(USD)','TOTAL(USD)');
        $column_sizes =array(25, 40, 40, 25, 25, 25, 25, 25, 25, 25);

        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage('L');
        $pdf->ReportHeadersTABLE();
        $pdf->BouncedChequesHeader($column_sizes, $columnNames, 'BOUNCED CHEQUES REPORT', $headinfo,$headinfo);
        $pdf->BouncedChequesTable($data);
        $pdf->Output();
    }
    public function daily_report($date){
        $ltitles=array('b_name'=>$this->session->userdata('building_name'), 'date'=> date('d-m-Y', strtotime($date)));

        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();

        if($this->session->userdata('currency')=='UGX'){
            $w = array(25, 33, 25, 55, 45);
            $header = array('Date', 'Tenant Name', 'Receipt No.','Mode of Payment','Amount (UGX)');
            $data = $this->bill->get_daily_excel_UGX(array('building_id'=>$this->session->userdata('building_id'), 'date'=>date('Y-m-d', strtotime($date))));
            $pdf->DailyTableHead($w, $header, 'DAILY PAYMENTS REPORT',$ltitles);
            $pdf->DailyTableUGX($data);
        }else{
            $header = array('Tenant Name', 'Receipt No.','Mode of Payment', '(UGX)', 'Rate','EQV(USD)', '(USD)');
            $w = array(43, 20, 40, 20, 20, 20, 20);
            $data = $this->bill->get_daily_excel(array('building_id'=>$this->session->userdata('building_id'), 'date'=>date('Y-m-d', strtotime($date))));
            $pdf->DailyTableHead($w, $header, 'DAILY PAYMENTS REPORT',$ltitles);
            $pdf->DailyTable($data);
        }
        $pdf->Output();
    }
    public function debtors_report(){
        $data = $this->bill->get_debt_excel(array('building_id'=>$this->session->userdata('building_id')));
        $col_titles = array('Tenant Name', 'Status', 'Room Name', 'Phone', 'Amount');
        $last_col = 'F';
        $info_title = $this->session->userdata('building_name').": Debtors Report as at ".date('l, F d, Y');
        //print_r($data);
        //

       $ltitles=array('date'=> date('d-m-Y') );
       $header = array('Tenant Name', 'Status', 'Room No.','Tel. Contact','Amount');
        $w = array(40, 35, 43, 35, 30);
        $pdf = new Reporting();
        $pdf->SetFont('Arial','',10);
        $pdf->AddPage();
        $pdf->ReportHeaders();
        $pdf->DebtsHead($w, $header,'DEBTORS REPORT',$ltitles);
        $pdf->DebtsTable($data);
        $pdf->Output();
//        $this->to_excel($info_title, $col_titles, $data, $last_col);
//
//        $x = $this->building->reg_form_drops();
//        $x['active'] = 'REP';
//        $this->load->view('accounts_header');
//        $this->load->view('xx_menu',$x);
//        $this->load->view('payment_page');
//        $this->load->view('xx_footer');
    }
    public function umeme_invoice($invoice_num){
        $data = array();
        $data2 = array();
        //$invoice_num = 'INV-70000';
        $this->load->model('bill');
        $datax = $this->bill->get_umeme_invoice_excel(array('inv'=>$invoice_num));
        //print_r($datax);
        $data = $this->bill->get_invoice(array('inv'=>$invoice_num));


        $pdf = new Reporting();
        $num_wrd = new Num_to_words();
//

        if($data[0]['tenant_id']!=0){
            $ten = $this->tenant->get_tenant_name(array('ten_id'=>$data[0]['tenant_id']));
            $titles['tenant'] = $ten[0]['f_name']." ".$ten[0]['l_name'];
        }else{
            $titles['tenant'] = "";
        }

        $titles['room_no'] = $data[0]['room_name'];
        $titles['building'] = $this->session->userdata('building_name');
        $titles['ac_no'] = '1002332322';
        $titles['billing_date'] = date('d-m-Y', strtotime($data[0]['inv_date']));
        $titles['invoice_no'] = $invoice_num;
        $titles['pay_date'] = date('d-m-Y', strtotime($data[0]['inv_date']."+14 day"));
        //print_r($titles);

        $total = 0;
        foreach($datax as $row){
            $total += $row['amount'];
        }
        //echo $total;
        $pdf->AddPage();
        $pdf->mainHeaders();
        $pdf->InvoiceHead($titles);
        $pdf->EleInvoiceTable($datax);
        $pdf->InvoiceFoot($num_wrd->convert_number_to_words($total).' Uganda Shillings');
        $pdf->Output();
    }
    public function rent_invoice($invoice_number){
        $data = array();
        $data2 = array();
        $this->load->model('bill');
        $datax = $this->bill->get_rent_invoice_excel(array('inv'=>$invoice_number));
        $data = $this->bill->get_invoice(array('inv'=>$invoice_number));

        $pdf = new Reporting();
        $num_wrd = new Num_to_words();

        if($data[0]['tenant_id']!=0){
            $ten = $this->tenant->get_tenant_name(array('ten_id'=>$data[0]['tenant_id']));
            $titles['tenant'] = $ten[0]['f_name']." ".$ten[0]['l_name'];
        }else{
            $titles['tenant'] = "";
        }
        $titles['room_no'] = $data[0]['room_name'];
        $titles['building'] = $this->session->userdata('building_name');
        $titles['ac_no'] = '1002332322';
        $titles['billing_date'] = date('d-m-Y', strtotime($data[0]['inv_date']));
        $titles['invoice_no'] = $invoice_number;
        $titles['pay_date'] = date('d-m-Y', strtotime($data[0]['inv_date']."+14 day"));

        $total = 0;
        //print_r($datax);
        foreach($datax as $row){
            $total += $row['amount'];
        }
        $pdf->AddPage();
        $pdf->mainHeaders();
        $pdf->InvoiceHead($titles);
        $pdf->RentInvoiceTable($datax);
        $pdf->InvoiceFoot($this->session->userdata('currency').' '.$num_wrd->convert_number_to_words($total));
        $pdf->Output();
    }

    public function to_excel($info_title, $col_titles, $data, $last_col){
        $sheet = array($col_titles);
        $sheet = array_merge($sheet,$data);

        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        //$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'Title: '.'hbbvclxbmxbmdkmhmhmdooh');
        //$objPHPExcel->getActiveSheet()->mergeCells('B1:E1');

        $objPHPExcel->getProperties()->setCreator("Crane Management Services");
        $objPHPExcel->getProperties()->setLastModifiedBy('Crane Management Services');
        $objPHPExcel->getProperties()->setTitle("Crane Management Services Document");
        $objPHPExcel->getProperties()->setSubject("Reports");

        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);


        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(1);
        //$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getStyle('B6:'.$last_col.'6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAF4FD');

        $rowID = 6;
        foreach($sheet as $rowArray) {
            $columnID = 'B';
            //$rowArray = array('ten_name' => 'Silas Kaggwa','date' =>'','particulars' =>'', 'debit' =>'', 'credit' =>'', 'balance' => '');
            foreach($rowArray as $columnValue) {
                $objPHPExcel->getActiveSheet()->setCellValue($columnID.$rowID, $columnValue);
                $columnID++;
            }
            $objPHPExcel->getActiveSheet()->getRowDimension($rowID)->setRowHeight(30);
            $rowID++;
        }

        $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FF1C252A'))
                )
        );
        $styleArray1 = array(
                'borders' => array(
                    'outline' => array(
                        'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                        'color' => array('argb' => 'FF1C252A'))
                )
        );
        $objPHPExcel->getActiveSheet()->getStyle('B6:'.$last_col.''.($rowID-1))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('B6:'.$last_col.''.($rowID-1))->applyFromArray($styleArray1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPrintArea('B1:'.$last_col.''.($rowID));
        $objPHPExcel->getActiveSheet()->setShowGridlines(false);

        //heading
        $objPHPExcel->getActiveSheet()->mergeCells('C2:'.$last_col.'2');
        $objPHPExcel->getActiveSheet()->mergeCells('C3:'.$last_col.'3');
        $head = 'Crane Management Services';
        $objPHPExcel->getActiveSheet()->getCell('C2')->setValue($head);
        $objPHPExcel->getActiveSheet()->getCell('C3')->setValue($info_title);//date('dMy')
        $objPHPExcel->getActiveSheet()->getCell('C4')->setValue('Exported on: '.date('d M Y'));

        $style_header = array(
                'font' => array('bold' => true));
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B6:'.$last_col.'6')->applyFromArray($style_header);

        //logo
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('images/CMSlogo_103.png');
        $objDrawing->setHeight(100);
        $objDrawing->setWidth(60);
        $objDrawing->setCoordinates('B2');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

        $columnID = 'B';
        $lastColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
        while ($columnID <= $lastColumn){
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            $columnID++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$info_title.'_'.date('dMY').'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
        $objPHPExcel->disconnectWorksheets();
        //unset($objPHPExcel);
        exit;
    }
}
?>
