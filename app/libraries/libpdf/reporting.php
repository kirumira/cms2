<?php

require_once("fpdf.php");
class Reporting extends FPDF{
    // Load data
    var $B;
    var $I;
    var $U;
    var $HREF;
    var $column_sizes = null;
    var $head_data = null;
    var $title = null;
    var $headinfo = null;

    public function header(){
        if($this->title=='GENERAL TOTAL LANDLORD COLLECTIONS REPORT'){
            $this->Image('images/CMSlogo_103.png', 15, 15);
            $this->SetFont('Times','B',12);
            $this->Cell(35,18,'','LTR','C');
            $this->Cell(245,18,"CRANE MANAGEMENT SERVICES LTD",'LTR',1,'C');
            $this->SetFont('Arial','',10);

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(245,9,"GENERAL TOTAL LANDLORD COLLECTIONS REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(140,8,"Ownership: ".$this->headinfo['landlord_name'],'LRT',0,'L');
            $this->Cell(140,8,"From: ".$this->headinfo['start']." to: ".$this->headinfo['end'],'LRT',0,'L');
            $this->Ln();

            for($i=0;$i<count($this->head_data);$i++){
                $this->SetFont('','B',9);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='BUILDING REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"BUILDING REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"Building: ".$this->headinfo["building"],1,0,'L');
            $this->Cell(83,8,"Export Date: ".$this->headinfo['date'],1,0,'L');
            $this->Ln();

            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->SetFont('','B',9);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],'B',0,'C');
                $this->SetLineWidth(.2);
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='LANDLORD REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"LANDLORD REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"Landlord: ".strtoupper($this->headinfo["landlord"]),1,0,'L');
            $this->Cell(83,8,"Export Date: ".$this->headinfo['date'],1,0,'L');
            $this->Ln();

            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='TENANT REPORT1'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"TENANT REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"Tenant's Name: ".strtoupper($this->headinfo["t_name"]),1,0,'L');
            $this->Cell(183,8,"Export Date: ".$this->headinfo['date'],1,0,'L');
            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='TENANT REPORT'){
            $this->ReportHeadersLandscape();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(235,9,"TENANT REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(170,8,"Tenant's Name: ".strtoupper($this->headinfo["t_name"]),1,0,'L');
            $this->Cell(100,8,"Export Date: ".$this->headinfo['date'],1,0,'L');
            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='ROOM REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"ROOM REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"Room Name: ".strtoupper($this->headinfo["r_name"]),1,0,'L');
            $this->Cell(83,8,"Export Date: ".$this->headinfo['date'],1,0,'L');
            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='DEBTORS REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"DEBTORS REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"",1,0,'L');
            $this->Cell(83,8,"Export Date: ".$this->headinfo['date'],1,0,'L');
            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='UMEME REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"UMEME REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"Room Name: ".strtoupper($this->headinfo["r_name"]),1,0,'L');
            $this->Cell(83,8,"Export Date: ".$this->headinfo['date'],1,0,'L');

            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='DAILY PAYMENTS REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"DAILY PAYMENTS REPORT",1,1,'C');
            $this->SetFont('Arial','',10);
            $this->Cell(100,8,"Building Name: ".strtoupper($this->headinfo["b_name"]),'LRT',0,'L');
            $this->Cell(83,8,"Date: ".$this->headinfo['date'],1,1,'L');

            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='GENERAL TOTAL DAILY COLLECTIONS REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(245,9,"GENERAL TOTAL DAILY COLLECTIONS REPORT",1,1,'C');
            $this->SetFont('Arial','',10);

            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='BOUNCED CHEQUES REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(245,9,"BOUNCED CHEQUES REPORT",1,1,'C');
            $this->SetFont('Arial','',10);

            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }elseif($this->title=='AGENT REPORT'){
            $this->ReportHeaders();

            $this->Cell(35,9,"",'LR',0,'C');
            $this->SetFont('Times','B',12);
            $this->Cell(148,9,"AGENT REPORT",1,1,'C');
            $this->SetFont('Arial','',10);

            $this->Ln();
            for($i=0;$i<count($this->head_data);$i++){
                $this->SetLineWidth(.4);
                $this->Cell($this->column_sizes[$i],7,$this->head_data[$i],1,0,'C');
                $this->SetFont('');
            }
            $this->Ln();
        }
    }
    public function footer(){
        if(($this->title=='GENERAL TOTAL LANDLORD COLLECTIONS REPORT')||($this->title=='BOUNCED CHEQUES REPORT')){
            $this->Cell(35,9,"",'T',0,'R');
            $this->SetFont('Times','B',7);
            $this->Cell(235,9,"CMS",'T',0,'R');
            $this->Cell(10,9,$this->PageNo(),'T',1,'R');
            $this->SetFont('Arial','',10);
        }
    }
    public function PDF($orientation='P', $unit='mm', $size='A4'){
        // Call parent constructor
        $this->FPDF($orientation,$unit,$size);
        // Initialization
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
    }
    public function Headers(){
        $this->Image('images/CMSlogo_103.png', 15, 15);
        $this->Cell(183,10,"CRANE MANAGEMENT SERVICES LTD",'LTR',1,'C');
        $this->Cell(183,5,"P.O. Box 12354",'LR',1,'C');
        $this->Cell(183,5,"Kampala, Uganda",'LR',1,'C');
        $this->Cell(183,8,"Tel: +24577695156",'LR',1,'C');
        $this->SetFont('Times','',12);
    }
    public function mainHeaders(){
        $this->Image('images/CMSlogo_103.png', 15, 15);
        $this->SetFont('Times','B',12);
        $this->Cell(35,18,'','LTR','C');
        $this->Cell(148,18,"CRANE MANAGEMENT SERVICES LTD",'LTR',1,'C');
        $this->SetFont('Arial','',10);
    }
    public function ReportHeaders(){
        $this->Image('images/CMSlogo_103.png', 15, 15);
        $this->SetFont('Times','B',12);
        $this->Cell(35,18,'','LTR','C');
        $this->Cell(148,18,"CRANE MANAGEMENT SERVICES LTD",'LTR',1,'C');
        $this->SetFont('Arial','',10);

    }
    public function ReportHeadersLandscape(){
        $this->Image('images/CMSlogo_103.png', 15, 15);
        $this->SetFont('Times','B',12);
        $this->Cell(35,18,'','LTR','C');
        $this->Cell(235,18,"CRANE MANAGEMENT SERVICES LTD",'LTR',1,'C');
        $this->SetFont('Arial','',10);
    }
    public function InvoiceHead ($headInfo){
        $this->Cell(35,9,"",'LRB',0,'C');
        $this->Cell(148,9,"INVOICE",1,1,'C');
        $this->Cell(78,8,"Tenant's Name: ".$headInfo["tenant"],'LR',0,'L');
        $this->Cell(60,8,"Account No: ".$headInfo['ac_no'],1,0,'L');
        $this->Cell(45,8,"Billing Date: ".$headInfo['billing_date'],1,1,'L');
        $this->Cell(78,8,"Room Number: ".$headInfo['room_no'],'LR',0,'L');
        $this->Cell(60,8,"Billing Number: ".$headInfo['invoice_no'],1,0,'L');
        $this->Cell(45,8,"Due Date: ".$headInfo['pay_date'],1,1,'L');
        $this->Cell(78,8,"Building: ".$headInfo['building'],'LR',0,'L');
        $this->Cell(105,8,"",1,1,'L');
    }
     public function RentInvoiceTable($data){
        $header = array('SN','Particulars','Amount');

        // Column widths
        $w = array(8, 150, 25);
        // Header
        for($i=0;$i<count($header);$i++){
            $this->SetFont('Times','B',12);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');}
        $this->Ln();
        // Data
        $index=1;
        $total = 0;
        foreach($data as $row){
            $this->Cell($w[0],9,$index,'LR',0,'C');
            $this->Cell($w[1],9,$row['Particulars'],'LR',0,'C');
            $this->Cell($w[2],9,number_format($row['amount'], 0, '', ','),'LR',0,'C');
            $this->Ln();
            $index++;
            $total += $row['amount'];
        }
        $footer= array('', 'TOTAL',$total);
        for($i=0;$i<count($footer);$i++){
            $this->SetFont('Times','B',12);
            if(number_format(intval($footer[$i]))){ $this->Cell($w[$i],7,number_format(intval($footer[$i])),1,0,'C');
            }else {$this->Cell($w[$i],7,$footer[$i],1,0,'C');}
            $this->SetFont('');}
        $this->Ln();
        // Closing line
        //$this->Cell(array_sum($w),0,'','T');
    }
    public function BuildingHead($column_sizes, $columnNames, $title,$headInfo){
        $this->head_data = $columnNames;
        $this->column_sizes = $column_sizes;
        $this->title = $title;
        $this->headinfo = $headInfo;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"BUILDING REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"Building: ".$headInfo["building"],1,0,'L');
        $this->Cell(83,8,"Export Date: ".$headInfo['date'],1,0,'L');
    }
    public function LandLordHead($column_sizes, $columnNames,$title, $headInfo){
        $this->head_data = $columnNames;
        $this->column_sizes = $column_sizes;
        $this->title = $title;
        $this->headinfo = $headInfo;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"LANDLORD REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"Landlord: ".strtoupper($headInfo["landlord"]),1,0,'L');
        $this->Cell(83,8,"Export Date: ".$headInfo['date'],1,0,'L');
    }
    public function TenantsHead($column_sizes, $columnNames,$title,$headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"TENANT REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"Tenant's Name: ".strtoupper($headInfo["t_name"]),1,0,'L');
        $this->Cell(83,8,"Export Date: ".$headInfo['date'],1,0,'L');
        $this->Ln();
        $this->Cell(100,8,"Building: ".strtoupper($headInfo["b_name"]),1,0,'L');
        $this->Cell(83,8,"From: ".$headInfo['s_date']."        To: ".$headInfo['e_date'],1,0,'L');
    }
    public function TenantsHead2($column_sizes, $columnNames,$title,$headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(235,9,"TENANT REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(170,8,"Tenant's Name: ".strtoupper($headInfo["t_name"]),1,0,'L');
        $this->Cell(100,8,"Export Date: ".$headInfo['date'],1,0,'L');
        $this->Ln();
        $this->Cell(170,8,"Building: ".strtoupper($headInfo["b_name"]),1,0,'L');
        $this->Cell(100,8,"From: ".$headInfo['s_date']."        To: ".$headInfo['e_date'],1,0,'L');
    }
    public function RoomHead($column_sizes, $columnNames,$title,$headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"ROOM REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"Room Name: ".strtoupper($headInfo["r_name"]),1,0,'L');
        $this->Cell(83,8,"Export Date: ".$headInfo['date'],1,0,'L');
    }
    public function DebtsHead($column_sizes, $columnNames,$title, $headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"DEBTORS REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"",1,0,'L');
        $this->Cell(83,8,"Export Date: ".$headInfo['date'],1,0,'L');
    }
    public function UmemeHead($column_sizes, $columnNames,$title,$headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"UMEME REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"Room Name: ".strtoupper($headInfo["r_name"]),1,0,'L');
        $this->Cell(83,8,"Export Date: ".$headInfo['date'],1,0,'L');
    }
    public function UmemeTable($data){
        $header = array('Date', 'Old Reading', 'New Reading', 'Units', 'Debit', 'Credit', 'Balance');
        // Column widths
        $w = array(29, 29, 25, 25, 25, 25, 25);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],'TB',0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['units'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['date'],0,0,'C');
                if($row['old_read']==0){$this->Cell($w[1],9,"",0,0,'C');}else{$this->Cell($w[1],9,$row['old_read'],0,0,'C');}
                if($row['new_read']==0){$this->Cell($w[2],9,"",0,0,'C');}else{$this->Cell($w[2],9,$row['new_read'],0,0,'C');}
                if($row['units']==0){$this->Cell($w[3],9, "",'TB',0,'C');}else{$this->Cell($w[3],9,$row['units'],'TB',0,'C');}
                if($row['debit']==0){$this->Cell($w[4],9,"",'TB',0,'R');}else{$this->Cell($w[4],9,number_format($row['debit']),'TB',0,'R');}
                if($row['credit']==0){$this->Cell($w[4],9,"",'TB',0,'R');}else{$this->Cell($w[4],9,number_format($row['credit']),'TB',0,'R');}
                if($row['balance']==0){$this->Cell($w[5],9,"",'TB',0,'R');}else{$this->Cell($w[5],9,number_format($row['balance']),'TB',0,'R');}
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['date'],0,0,'C');
                if($row['old_read']==0){$this->Cell($w[1],9,"",0,0,'C');}else{$this->Cell($w[1],9,$row['old_read'],0,0,'C');}
                if($row['new_read']==0){$this->Cell($w[2],9,"",0,0,'C');}else{$this->Cell($w[2],9,$row['new_read'],0,0,'C');}
                if($row['units']==0){$this->Cell($w[3],9, "",0,0,'C');}else{$this->Cell($w[3],9,$row['units'],0,0,'C');}
                if($row['debit']==0){$this->Cell($w[4],9,"",0,0,'R');}else{$this->Cell($w[4],9,number_format($row['debit']),0,0,'R');}
                if($row['credit']==0){$this->Cell($w[4],9,"",0,0,'R');}else{$this->Cell($w[4],9,number_format($row['credit']),0,0,'R');}
                if($row['balance']==0){$this->Cell($w[5],9,"",0,0,'R');}else{$this->Cell($w[5],9,number_format($row['balance']),0,0,'R');}
            }

            $this->Ln();
        }
    }
    public function ReportHeadersTABLE(){
        $this->Image('images/CMSlogo_103.png', 15, 15);
        $this->SetFont('Times','B',12);
        $this->Cell(35,18,'','LTR','C');
        $this->Cell(245,18,"CRANE MANAGEMENT SERVICES LTD",'LTR',1,'C');
        $this->SetFont('Arial','',10);
    }
    public function DailyBuildingsTableHeader($column_sizes, $columnNames, $title){
        $this->head_data = $columnNames;
        $this->column_sizes = $column_sizes;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(245,9,"GENERAL TOTAL DAILY COLLECTIONS REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        //$this->Cell(280,8," ",'LRT',1,'L');
        //$this->Cell(83,8,"Date: ",1,1,'L');
    }
    public function DailyBuildingsTable($data){
        foreach($data as $x){
            if($x['x_rate']!=0){
                $this->Cell(197,8,"Date: ".$x['date'],'LRT',0,'L');
                $this->Cell(83,8,"Dollar Rate: ".$x['x_rate']."/=",1,0,'L');
                break;
            }else{
                $this->Cell(197,8,"Date: ".$x['date'],'LRT',0,'L');
                $this->Cell(83,8,"Dollar Rate: ",1,0,'L');
                break;
            }
        }

        $header = array('Property', 'Tenant Name', 'Receipt No.','Period','(UGX)','EQV(USD)', '(USD)', 'Landlord');
        // Column widths
        $w = array(47, 40, 25, 43, 25, 25, 25, 50);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['mode'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['b_name'],1,0,'C');
                $this->Cell($w[1],9,$row['tenant'],1,0,'C');
                $this->Cell($w[2],9,strtoupper($row['receipt']),1,0,'C');
                $this->Cell($w[3],9,$row['mode'],1,0,'R');
                $this->Cell($w[4],9,number_format(intval($row['eq_amount']))==0?'':number_format($row['eq_amount']),1,0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['amount2']), '2', '.', ',')==0?'':number_format($row['amount2'], '2', '.', ','),1,0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['amount']), '2', '.', ',')==0?'':number_format($row['amount'], '2', '.', ','),1,0,'R');
                $this->Cell($w[7],9,$row['landlord'],1,0,'C');
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['b_name'],'LR',0,'C');
                $this->Cell($w[1],9,$row['tenant'],'LR',0,'C');
                $this->Cell($w[2],9,strtoupper($row['receipt']),'LR',0,'C');
                $this->Cell($w[3],9,$row['mode'],'LR',0,'C');
                $this->Cell($w[4],9,number_format(intval($row['eq_amount']))==0?'':number_format($row['eq_amount']),'LR',0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['amount2']), '2', '.', ',')==0?'':number_format($row['amount2'], '2', '.', ','),'LR',0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['amount']), '2', '.', ',')==0?'':number_format($row['amount'], '2', '.', ','),'LR',0,'R');
                $this->Cell($w[7],9,$row['landlord'],'LR',0,'C');
            }

            $this->Ln();
        }
    }
    public function BouncedChequesHeader($column_sizes, $columnNames, $title, $headinfo){
        $this->head_data = $columnNames;
        $this->column_sizes = $column_sizes;
        $this->title = $title;
        $this->headinfo = $headinfo;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(245,9,"BOUNCED CHEQUES REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(140,8,"Ownership: ".$headinfo['landlord_name'],'LRT',0,'L');
        $this->Cell(140,8,"From: ".$headinfo['start']." to: ".$headinfo['end'],'LRT',0,'L');
    }
    public function BouncedChequesTable($data){
        $header = array('Date', 'Property', 'Tenants','Period','Cheque', 'Reason','AMOUNT(UGX)','AMOUNT(USD)');
        // Column widths
        $w = array(25, 40, 40, 25, 50, 50, 25, 25);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['reason'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['date'],1,0,'C');
                $this->Cell($w[1],9,$row['b_name'],1,0,'L');
                $this->Cell($w[2],9,$row['tenant'],1,0,'L');
                $this->Cell($w[3],9,$row['period'],1,0,'L');
                $this->Cell($w[4],9,$row['cheque'],1,0,'L');
                $this->Cell($w[5],9,$row['reason'],1,0,'L');
                //$this->Cell($w[4],9,number_format(intval($row['amountUGX']))==0?'':number_format($row['amountUGX']),1,0,'R');
                //$this->Cell($w[5],9,number_format(intval($row['vatUGX']))==0?'':number_format($row['vatUGX']),1,0,'R');
                $this->Cell($w[6],9,number_format(intval($row['totalUGX']))==0?'':number_format($row['totalUGX']),1,0,'R');
                //$this->Cell($w[],9,number_format(floatval($row['amountUSD']), '2', '.', ',')==0?'':number_format($row['amountUSD'], '2', '.', ','),1,0,'R');
                //$this->Cell($w[8],9,number_format(floatval($row['vatUSD']), '2', '.', ',')==0?'':number_format($row['vatUSD'], '2', '.', ','),1,0,'R');
                $this->Cell($w[7],9,number_format(floatval($row['totalUSD']), '2', '.', ',')==0?'':number_format($row['totalUSD'], '2', '.', ','),1,0,'R');
                //$this->Cell($w[7],9,$row['landlord'],1,0,'C');
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['date'],'LR',0,'C');
                $this->Cell($w[1],9,$row['b_name'],'LR',0,'L');
                $this->Cell($w[2],9,$row['tenant'],'LR',0,'L');
                $this->Cell($w[3],9,$row['period'],'LR',0,'L');
                $this->Cell($w[4],9,$row['cheque'],'LR',0,'L');
                $this->Cell($w[5],9,$row['reason'],'LR',0,'L');
                //$this->Cell($w[4],9,number_format(intval($row['amountUGX']))==0?'':number_format($row['amountUGX']),'LR',0,'R');
                //$this->Cell($w[5],9,number_format(intval($row['vatUGX']))==0?'':number_format($row['vatUGX']),'LR',0,'R');
                $this->Cell($w[6],9,number_format(intval($row['totalUGX']))==0?'':number_format($row['totalUGX']),'LR',0,'R');
                //$this->Cell($w[7],9,number_format(floatval($row['amountUSD']), '2', '.', ',')==0?'':number_format($row['amountUSD'], '2', '.', ','),'LR',0,'R');
                //$this->Cell($w[8],9,number_format(floatval($row['vatUSD']), '2', '.', ',')==0?'':number_format($row['vatUSD'], '2', '.', ','),'LR',0,'R');
                $this->Cell($w[7],9,number_format(floatval($row['totalUSD']), '2', '.', ',')==0?'':number_format($row['totalUSD'], '2', '.', ','),'LR',0,'R');
                //$this->Cell($w[8],9,$row['landlord'],'LR',0,'C');
            }

            $this->Ln();
        }
    }

    public function LandlordsCollectionsHeader($column_sizes, $columnNames, $title, $headinfo){
        $this->head_data = $columnNames;
        $this->column_sizes = $column_sizes;
        $this->title = $title;
        $this->headinfo = $headinfo;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(245,9,"GENERAL TOTAL LANDLORD COLLECTIONS REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(140,8,"Ownership: ".$headinfo['landlord_name'],'LRT',0,'L');
        $this->Cell(140,8,"From: ".$headinfo['start']." to: ".$headinfo['end'],'LRT',0,'L');

        //$this->Cell(83,8,"Date: ",1,1,'L');
    }
    public function LandlordsCollectionsTable($data){
//        foreach($data as $x){
//            if($x['x_rate']!=0){
//                //$this->Cell(197,8,"Date: ".$x['date'],'LRT',0,'L');
//                $this->Cell(280,8,"Dollar Rate: ".$x['x_rate']."/=",1,0,'L');
//                break;
//            }
//        }

        $header = array('Date', 'Property', 'Tenants','Period','Rent(UGX)','VAT(UGX)','TOTAL(UGX)','Rent(USD)','VAT(USD)','TOTAL(USD)');
        // Column widths
        $w = array(25, 40, 40, 25, 25, 25, 25, 25, 25, 25);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['period'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['date'],1,0,'C');
                $this->Cell($w[1],9,$row['b_name'],1,0,'L');
                $this->Cell($w[2],9,$row['tenant'],1,0,'L');
                $this->Cell($w[3],9,$row['period'],1,0,'L');
                $this->Cell($w[4],9,number_format(intval($row['amountUGX']))==0?'':number_format($row['amountUGX']),1,0,'R');
                $this->Cell($w[5],9,number_format(intval($row['vatUGX']))==0?'':number_format($row['vatUGX']),1,0,'R');
                $this->Cell($w[6],9,number_format(intval($row['totalUGX']))==0?'':number_format($row['totalUGX']),1,0,'R');
                $this->Cell($w[7],9,number_format(floatval($row['amountUSD']), '2', '.', ',')==0?'':number_format($row['amountUSD'], '2', '.', ','),1,0,'R');
                $this->Cell($w[8],9,number_format(floatval($row['vatUSD']), '2', '.', ',')==0?'':number_format($row['vatUSD'], '2', '.', ','),1,0,'R');
                $this->Cell($w[9],9,number_format(floatval($row['totalUSD']), '2', '.', ',')==0?'':number_format($row['totalUSD'], '2', '.', ','),1,0,'R');
                //$this->Cell($w[7],9,$row['landlord'],1,0,'C');
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['date'],'LR',0,'C');
                $this->Cell($w[1],9,$row['b_name'],'LR',0,'L');
                $this->Cell($w[2],9,$row['tenant'],'LR',0,'L');
                $this->Cell($w[3],9,$row['period'],'LR',0,'L');
                $this->Cell($w[4],9,number_format(intval($row['amountUGX']))==0?'':number_format($row['amountUGX']),'LR',0,'R');
                $this->Cell($w[5],9,number_format(intval($row['vatUGX']))==0?'':number_format($row['vatUGX']),'LR',0,'R');
                $this->Cell($w[6],9,number_format(intval($row['totalUGX']))==0?'':number_format($row['totalUGX']),'LR',0,'R');
                $this->Cell($w[7],9,number_format(floatval($row['amountUSD']), '2', '.', ',')==0?'':number_format($row['amountUSD'], '2', '.', ','),'LR',0,'R');
                $this->Cell($w[8],9,number_format(floatval($row['vatUSD']), '2', '.', ',')==0?'':number_format($row['vatUSD'], '2', '.', ','),'LR',0,'R');
                $this->Cell($w[9],9,number_format(floatval($row['totalUSD']), '2', '.', ',')==0?'':number_format($row['totalUSD'], '2', '.', ','),'LR',0,'R');
                //$this->Cell($w[8],9,$row['landlord'],'LR',0,'C');
            }

            $this->Ln();
        }
    }

    public function DailyTableHead($column_sizes, $columnNames,$title,$headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;

        $this->Cell(35,9,"",'LR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"DAILY PAYMENTS REPORT",1,1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(100,8,"Building Name: ".strtoupper($headInfo["b_name"]),'LRT',0,'L');
        $this->Cell(83,8,"Date: ".$headInfo['date'],1,0,'L');
    }
    public function DailyTable($data){

        /*foreach($data as $x){
            if($x['x_rate']!=0){
                $this->Ln();
                $this->Cell(100,8,"",'LR',0,'L');
                $this->Cell(83,8,"Dollar Rate: ".$x['x_rate']."/=",1,0,'L');
                break;
            }
        }*/

        $this->Ln();
        $header = array('Tenant Name', 'Receipt No.','Mode of Payment','(UGX)', 'Rate','EQV(USD)', '(USD)');
        // Column widths
        $w = array(43, 20, 40, 20, 20, 20, 20);
        // Header
        //$this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['mode'])==strtoupper('TOTAL')){
                $this->SetFont('','B');                
                $this->Cell($w[0],9,$row['tenant'],1,0,'C');
                $this->Cell($w[1],9,strtoupper($row['receipt']),1,0,'C');
                $this->Cell($w[2],9,$row['mode'],1,0,'R');
                $this->Cell($w[3],9,number_format(intval($row['eq_amount']))==0?'':number_format($row['eq_amount']),1,0,'R');
                $this->Cell($w[4],9,$row['x_rate'],1,0,'C');
                //$this->Cell($w[4],9,number_format(intval($row['eq_amount']))==0?'':number_format($row['eq_amount']),1,0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['amount2']), '2', '.', ',')==0?'':number_format($row['amount2'], '2', '.', ','),1,0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['amount']), '2', '.', ',')==0?'':number_format($row['amount'], '2', '.', ','),1,0,'R');
                $this->SetFont('');
            }else{

                $current_y = $this->GetY();$current_x = $this->GetX();
                $this->MultiCell($w[0],9,$row['tenant'],'LR');
                $current_y2 = $this->GetY();
                $this->SetXY($current_x + $w[0], $current_y);
                $this->Cell($w[1],9,strtoupper($row['receipt']),'LR',0,'C');
                $this->Cell($w[2],9,$row['mode'],'LR',0,'C');
                $this->Cell($w[3],9,number_format(intval($row['eq_amount']))==0?'':number_format($row['eq_amount']),'LR',0,'R');
                $this->Cell($w[4],9,($row['x_rate']==0?'':number_format($row['x_rate'])),'LR',0,'C');
                //$this->Cell($w[4],9,number_format(intval($row['eq_amount']))==0?'':number_format($row['eq_amount']),'LR',0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['amount2']), '2', '.', ',')==0?'':number_format($row['amount2'], '2', '.', ','),'LR',0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['amount']), '2', '.', ',')==0?'':number_format($row['amount'], '2', '.', ','),'LR',0,'R');
                if($current_y2!=$current_y){
                    $yH = $current_y2 - $current_y;
                    for($i = 0; $i < $yH; $i+=9){
                        $this->Ln();
                        $this->setY($current_y+$i);
                        $this->Cell($w[0],9,'','LR',0,'C');
                        $this->Cell($w[1],9,'','LR',0,'C');
                        $this->Cell($w[2],9,'','LR',0,'C');
                        $this->Cell($w[3],9,'','LR',0,'C');
                        $this->Cell($w[4],9,'','LR',0,'C');
                        $this->Cell($w[5],9,'','LR',0,'C');
                        $this->Cell($w[6],9,'','LR',0,'C');
                    }                    
                }
                $this->SetY($current_y2);
            }
        }

    }
    public function DailyTableUGX($data){
        $header = array('Date', 'Tenant Name', 'Receipt No.','Mode of Payment','Amount (UGX)');
        // Column widths
        $w = array(25, 48, 25, 55, 30);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['mode'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['date'],1,0,'C');
                $this->Cell($w[1],9,$row['tenant'],1,0,'C');
                $this->Cell($w[2],9,strtoupper($row['receipt']),1,0,'C');
                $this->Cell($w[3],9,$row['mode'],1,0,'R');
                $this->Cell($w[4],9,number_format(intval($row['amount'])),1,0,'R');
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['date'],'LR',0,'C');
                $current_y = $this->GetY();$current_x = $this->GetX();
                $this->MultiCell($w[1],9,$row['tenant'],'LR');
                $current_y2 = $this->GetY();
                $this->SetXY($current_x + $w[1], $current_y);
                $this->Cell($w[2],9,strtoupper($row['receipt']),'LR',0,'C');
                $this->Cell($w[3],9,$row['mode'],'LR',0,'C');
                $this->Cell($w[4],9,number_format(intval($row['amount'])),'LR',0,'R');
                if($current_y2!=$current_y){
                    $yH = $current_y2 - $current_y;
                    for($i = 0; $i < $yH; $i+=9){
                        $this->Ln();
                        $this->setY($current_y+$i);
                        $this->Cell($w[0],9,'','LR',0,'C');
                        $this->Cell($w[1],9,'','LR',0,'C');
                        $this->Cell($w[2],9,'','LR',0,'C');
                        $this->Cell($w[3],9,'','LR',0,'C');
                        $this->Cell($w[4],9,'','LR',0,'C');
                    }                    
                }
                $this->SetY($current_y2);   
            }
        }

    }
    public function PendingHeader($column_sizes, $columnNames, $title, $headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;
        
        $this->Cell(35,9,"",'BLR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"PENDING TENANTS REPORT",1,1,'C');
    }

    public function PendingTable($data){
        $header = array('Tenant', 'Room', 'Date');
        // Column widths
        $w = array(61, 61, 61);
        // Header
        //$this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->SetFont('');
        $this->Ln();
        // Data
        foreach($data as $row){
                $this->Cell($w[0],9,$row['tenant_name'],'LR',0,'C');
                $this->Cell($w[1],9,$row['room'],'LR',0,'C');
                $this->Cell($w[2],9,$row['date'],'LR',0,'C');     
                
                $this->Ln();
        }
        $this->Cell(183,9,'','T',0,'C'); 
    }

    public function AgentHeader($column_sizes, $columnNames,$title,$headInfo){
        $this->column_sizes = $column_sizes;
        $this->head_data = $columnNames;
        $this->headinfo = $headInfo;
        $this->title = $title;
        
        $this->Cell(35,9,"",'BLR',0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(148,9,"AGENT REPORT",1,1,'C');
    }
    public function AgentTable($data){
        $header = array('Agent', 'Tenant', 'Building', 'Room', 'Tenant Status');
        // Column widths
        $w = array(39, 36, 36, 36, 36);
        // Header
        //$this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->SetFont('');
        $this->Ln();
        // Data
        foreach($data as $row){
                $this->SetFont('','B',9);            
                $this->Cell($w[0],9,$row['agent_name'],'LR',0,'C');
                $this->SetFont('');
                $this->Cell($w[1],9,$row['tenant_name'],'LR',0,'C');
                $this->Cell($w[2],9,$row['building'],'LR',0,'C');
                $this->Cell($w[3],9,$row['room'],'LR',0,'C');
                $this->Cell($w[4],9,$row['date'],'LR',0,'C');       
                
                $this->Ln();
        }
        $this->Cell(183,9,'','T',0,'C'); 
    }

     public function RoomTable($data){
        $header = array('Tenant Name', 'Trans. Date', 'Particulars','Debit','Credit', 'Balance');
        // Column widths
        $w = array(40, 25, 63, 20, 20, 15);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],'TB',0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['particulars'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['tenant_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,strtoupper($row['particulars']),'TB',0,'C');
                $this->Cell($w[3],9,number_format(intval($row['debit']))==0?'':number_format(intval($row['debit']),0),'TB',0,'R');
                $this->Cell($w[4],9,number_format(intval($row['credit']))==0?'':number_format(intval($row['credit']),0),'TB',0,'R');
                $this->Cell($w[5],9,number_format(intval($row['balance']))==0?'':number_format(intval($row['balance']),0),'TB',0,'R');


                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['tenant_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,$row['particulars'],0,0,'C');
                $this->Cell($w[3],9,number_format(intval($row['debit']))==0?'':number_format(intval($row['debit']),0),0,0,'R');
                $this->Cell($w[4],9,number_format(intval($row['credit']))==0?'':number_format(intval($row['credit']),0),0,0,'R');
                $this->Cell($w[5],9,number_format(intval($row['balance']))==0?'':number_format(intval($row['balance']),0),0,0,'R');
            }

            $this->Ln();
        }
    }

    public function RoomTableUSD($data){
        $header = array('Tenant Name', 'Trans. Date', 'Particulars','Debit','Credit', 'Balance');
        // Column widths
        $w = array(35, 25, 63, 20, 20, 20);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],'TB',0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['particulars'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['tenant_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,strtoupper($row['particulars']),'TB',0,'C');
                $this->Cell($w[3],9,number_format(floatval($row['debit']), '2', '.', ',')==0?'':number_format($row['debit'], '2', '.', ','),'TB',0,'R');
                $this->Cell($w[4],9,number_format(floatval($row['credit']), '2', '.', ',')==0?'':number_format($row['credit'], '2', '.', ','),'TB',0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['balance']), '2', '.', ',')==0?'':number_format($row['balance'], '2', '.', ','),'TB',0,'R');


                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['tenant_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,$row['particulars'],0,0,'C');
                $this->Cell($w[3],9,number_format(floatval($row['debit']), '2', '.', ',')==0?'':number_format($row['debit'], '2', '.', ','),0,0,'R');
                $this->Cell($w[4],9,number_format(floatval($row['credit']), '2', '.', ',')==0?'':number_format($row['credit'], '2', '.', ','),0,0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['balance']), '2', '.', ',')==0?'':number_format($row['balance'], '2', '.', ','),0,0,'R');
            }

            $this->Ln();
        }
    }

    public function DebtsTable($data){
        $header = array('Tenant Name', 'Status', 'Room No.','Tel. Contact','Amount');
        // Column widths
        $w = array(40, 35, 43, 35, 30);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['Phone'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['ten_name'],1,0,'C');
                $this->Cell($w[1],9,$row['status'],1,0,'C');
                $this->Cell($w[2],9,strtoupper($row['rm']),1,0,'C');
                $this->Cell($w[3],9,$row['Phone'],1,0,'R');
                $this->Cell($w[4],9,number_format(intval($row['amount'])),1,0,'R');
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['ten_name'],'LR',0,'C');
                $this->Cell($w[1],9,$row['status'],'LR',0,'C');
                $this->Cell($w[2],9,$row['rm'],'LR',0,'C');
                $this->Cell($w[3],9,$row['Phone'],'LR',0,'R');
                $this->Cell($w[4],9,number_format(intval($row['amount'])),'LR',0,'R');
            }

            $this->Ln();
        }
    }
    public function TenantsTable($data){
        $header = array('Room Name', 'Trans. Date', 'Particulars','Debit','Credit','Balance');
        // Column widths
        $w = array(15, 25, 48, 30, 30, 35, 30);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],'B',0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){            
            if(strtoupper($row['particulars'])==strtoupper('TOTAL')){
                //print_r($row);
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['room_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,strtoupper($row['particulars']),'TB',0,'C');
                $this->Cell($w[3],9,number_format(intval($row['debit']))==0?'':number_format(intval($row['debit'])),'TB',0,'R');
                $this->Cell($w[4],9,number_format(intval($row['credit']))==0?'':number_format(intval($row['credit'])),'TB',0,'R');
                $this->Cell($w[5],9,number_format(intval($row['bal']))==0?'':number_format(intval($row['debit']-$row['credit'])),'TB',0,'R');
                $this->SetFont('');
            }else{
                $this->Cell($w[0],9,$row['room_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,ucwords(strtolower($row['particulars'])),0,0,'C');
                $this->Cell($w[3],9,number_format(intval($row['debit']))==0?'':number_format(intval($row['debit'])),0,0,'R');
                $this->Cell($w[4],9,number_format(intval($row['credit']))==0?'':number_format(intval($row['credit'])),0,0,'R');
                $this->Cell($w[5],9,number_format(intval($row['bal']))==0?'':number_format(intval($row['bal'])),0,0,'R');
            }

            $this->Ln();
        }


    }
    public function TenantsTableUSD($data){
        $header = array('Room', 'Trans. Date', 'Particulars','Debit (USD)', 'UGX', '@', 'Credit (USD)','Balance (USD)');
        // Column widths
        $w = array(20, 48, 40, 38, 38, 18, 28, 38);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            if(($header[$i]=='Debit (USD)')||($header[$i]=='Credit (USD)')||($header[$i]=='UGX')||($header[$i]=='Balance (USD)')){
                $this->Cell($w[$i],7,$header[$i],'B',0,'R');
            }else{
                $this->Cell($w[$i],7,$header[$i],'B',0,'C');
            }
            
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            if(strtoupper($row['particulars'])==strtoupper('TOTAL')){
                $this->SetFont('','B');
                $this->Cell($w[0],9,$row['room_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,strtoupper($row['particulars']),'TB',0,'C');
                $this->Cell($w[3],9,number_format(floatval($row['debit']), '2', '.', ',')==0?'':number_format($row['debit'], '2', '.', ','),'TB',0,'R');                
                $this->Cell($w[4],9,'','TB',0,'R');
                $this->Cell($w[5],9,'','TB',0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['credit']), '2', '.', ',')==0?'':number_format($row['credit'], '2', '.', ','),'TB',0,'R');
                $this->Cell($w[7],9,number_format(floatval($row['bal']), '2', '.', ',')==0?'':number_format($row['bal'], '2', '.', ','),'TB',0,'R');
                $this->SetFont('');
            }else{

                $this->Cell($w[0],9,$row['room_name'],0,0,'C');
                $this->Cell($w[1],9,$row['d_payment'],0,0,'C');
                $this->Cell($w[2],9,$row['particulars'],0,0,'C');
                $this->Cell($w[3],9,number_format(floatval($row['debit']), '2', '.', ',')==0?'':number_format($row['debit'], '2', '.', ','),0,0,'R');
                
                //$this->Cell($w[5],9,number_format(floatval($row['vat']), '2', '.', ',')==0?'':number_format($row['vat'], '2', '.', ','),0,0,'C');
                //$this->Cell($w[4],9,number_format(floatval($row['credit']), '2', '.', ',')==0?'':number_format($row['credit'], '2', '.', ','),0,0,'C');
                
                $this->Cell($w[4],9,number_format(intval($row['pay_amount_shs']), '2', '.', ',')==0?'':number_format($row['pay_amount_shs'], '0', '.', ','),0,0,'R');
                //$this->Cell($w[5],9,number_format(intval($row['credit']*$row['xrate']), '2', '.', ',')==0?'':'('.number_format($row['credit']*$row['xrate'], '0', '.', ',').' UGX)',0,0,'R');
                $this->Cell($w[5],9,number_format(intval($row['xrate']), '2', '.', ',')==0?'':number_format($row['xrate'], '0', '.', ','),0,0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['credit']), '2', '.', ',')==0?'':number_format($row['credit'], '2', '.', ','),0,0,'R');
                $this->Cell($w[7],9,number_format(floatval($row['bal']), '2', '.', ',')==0?'':number_format($row['bal'], '2', '.', ','),0,0,'R');
            }

            $this->Ln();
        }


    }

    public function LandLordTable($data){
        $header = array('Building Name', 'Potential Revenue','Expected Revenue','Vacant Revenue','Actual Revenue', 'Outstanding');
        // Column widths
        $w = array(48, 30, 30, 25, 25, 25);
        // Header
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B',9);
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
        }
        $this->Ln();
        // Data
        foreach($data as $row){
            $this->Cell($w[0],9,$row['b_name'],'LR',0,'C');
            $this->Cell($w[1],9,number_format($row['potential']),'LR',0,'C');
            $this->Cell($w[2],9,number_format($row['expected']),'LR',0,'C');
            $this->Cell($w[3],9,number_format($row['vacant']),'LR',0,'C');
            $this->Cell($w[4],9,number_format($row['received']),'LR',0,'C');
            $this->Cell($w[4],9,number_format($row['outstanding']),'LR',0,'C');
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');

    }

    public function BuildingTable($data){
        $header = array('    Tenant Name', '', 'Trans. No', 'Details','Debit','Credit','Balance');
        //$footer= array('','Total Amount Due','','','',$amount_due);
        // Column widths
         $w = array(5, 23, 22, 73, 24, 24, 24);
        $this->SetFont('','B');
        // Header
        $this->Cell(183,4,'',0,1,'L');
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetLineWidth(.4);
            $this->Cell($w[$i],10,$header[$i],'B',0,'C');
            $this->SetLineWidth(.2);
        }
        $this->Ln();
        $this->SetFont('');
        $this->SetFontSize(9);

        foreach($data as $row){
            if($row['ten_name']!='' || $row['ten_name']!=null){
                $this->SetFont('Arial','B',10);
                $this->Cell($w[0],9,strtoupper($row['ten_name']),'B',0,'L');
                $this->SetFont('Arial','',10);
                $this->Cell($w[1],9,$row['date'],'B',0,'L');
                $this->Cell($w[2],9,$row['trans_no'],'B',0,'L');
            }else{
                $this->Cell($w[0],9,$row['ten_name'],0,0,'L');
                $this->Cell($w[1],9,$row['date'],0,0,'L');
                $this->Cell($w[2],9,$row['trans_no'],0,0,'L');
            }
            if(strtolower($row['particulars'])==strtolower('TOTAL')){
                $this->SetFont('Arial','B',10);
                $this->Cell($w[3],9,$row['particulars'],0,0,'L');
                $this->Cell($w[4],9,number_format(intval($row['debit'])),'TB',0,'R');
                $this->Cell($w[5],9,number_format(intval($row['credit'])),'TB',0,'R');
                $this->Cell($w[6],9,number_format(intval($row['balance'])),'TB',0,'R');
                $this->SetFont('Arial','',10);
            }else{
                $this->Cell($w[3],9,$row['particulars'],0,0,'L');
                $this->Cell($w[4],9,number_format(intval($row['debit']))==0?'':number_format($row['debit']),0,0,'R');
                $this->Cell($w[5],9,number_format(intval($row['credit']))==0?'':number_format($row['credit']),0,0,'R');
                $this->Cell($w[6],9,number_format(intval($row['balance']))==0?'':number_format($row['balance']),0,0,'R');
            }
            $this->Ln();
        }
    }
    public function BuildingTableUSD($data){
        $header = array('    Tenant Name', '', 'Trans. No', 'Details','Debit','Credit','Balance');
        //$footer= array('','Total Amount Due','','','',$amount_due);
        // Column widths
         $w = array(5, 23, 22, 73, 24, 24, 24);
        $this->SetFont('','B');
        // Header
        $this->Cell(183,4,'',0,1,'L');
        $this->Ln();
        for($i=0;$i<count($header);$i++){
            $this->SetLineWidth(.4);
            $this->Cell($w[$i],10,$header[$i],'B',0,'C');
            $this->SetLineWidth(.2);
        }
        $this->Ln();
        $this->SetFont('');
        $this->SetFontSize(9);

        foreach($data as $row){
            if($row['ten_name']!='' || $row['ten_name']!=null){
                $this->SetFont('Arial','B',10);
                $this->Cell($w[0],9,strtoupper($row['ten_name']),'B',0,'L');
                $this->SetFont('Arial','',10);
                $this->Cell($w[1],9,$row['date'],'B',0,'L');
                $this->Cell($w[2],9,$row['trans_no'],'B',0,'L');
            }else{
                $this->Cell($w[0],9,$row['ten_name'],0,0,'L');
                $this->Cell($w[1],9,$row['date'],0,0,'L');
                $this->Cell($w[2],9,$row['trans_no'],0,0,'L');
            }
            if(strtolower($row['particulars'])==strtolower('TOTAL')){
                $this->SetFont('Arial','B',10);
                $this->Cell($w[3],9,$row['particulars'],0,0,'L');
                $this->Cell($w[4],9,number_format(floatval($row['debit']), '2', '.', ','),'TB',0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['credit']), '2', '.', ','),'TB',0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['balance']), '2', '.', ','),'TB',0,'R');
                $this->SetFont('Arial','',10);
            }else{
                $this->Cell($w[3],9,$row['particulars'],0,0,'L');
                $this->Cell($w[4],9,number_format(floatval($row['debit']), '2', '.', ',')==0?'':number_format($row['debit'], '2', '.', ','),0,0,'R');
                $this->Cell($w[5],9,number_format(floatval($row['credit']), '2', '.', ',')==0?'':number_format($row['credit'], '2', '.', ','),0,0,'R');
                $this->Cell($w[6],9,number_format(floatval($row['balance']), '2', '.', ',')==0?'':number_format($row['balance'], '2', '.', ','),0,0,'R');
            }
            $this->Ln();
        }
    }

    public function EleInvoiceTable($data){
        $header = array('SN', 'Bill Items', 'Prev. Reading', 'Curr. Reading','Units','Amount');

        // Column widths
        $w = array(8, 75, 25, 25, 25, 25);
        // Header

        for($i=0;$i<count($header);$i++){
            $this->SetFont('','B');
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            $this->SetFont('');
            }
        $this->Ln();
        // Data
        $index=1;
        $total = 0;
        foreach($data as $row){
            $this->Cell($w[0],7,$index,'LR',0,'C');
            $this->Cell($w[1],7,$row['Particulars'],'LR',0,'C');
            $this->Cell($w[2],7,$row['old_read'],'LR',0,'C');
            //if(isset($row[2]))
                $this->Cell($w[3],7,$row['new_read'],'LR',0,'C');
            //if(isset($row[3]))
                $this->Cell($w[4],7,$row['units'],'LR',0,'C');
            //if(isset($row[4]))
            //if(isset($row[5]))
                $this->Cell($w[5],7,number_format($row['amount']),'LR',0,'C');
            $this->Ln();
            $total += $row['amount'];
            $index++;
        }

        $footer= array('','Total Amount Due','','','',$total);
        for($i=0;$i<count($footer);$i++){
            $this->SetFont('','B');
            if(number_format(intval($footer[$i]))) $this->Cell($w[$i],7,number_format(intval($footer[$i])),1,0,'C');
            else $this->Cell($w[$i],7,$footer[$i],1,0,'C');}
        $this->SetFont('');
        $this->Ln();
    }
    public function InvoiceFoot($amountwords){
        $this->Cell(183, 15, 'Amount in words: '.$amountwords,1,1,'L');
        $this->Cell(128, 26, '',1,0,'L');
        $this->Cell(55, 26, 'Stamp',1,0,'C');
    }

    public function WriteHTML($html){
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3)){
                            $attr[strtoupper($a3[1])] = $a3[2];}
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    public function OpenTag($tag, $attr){
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    public function CloseTag($tag){
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    public function SetStyle($tag, $enable){
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    public function PutLink($URL, $txt){
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

}


?>