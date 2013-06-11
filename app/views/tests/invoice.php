
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Invoice</title>
<style type="text/css">
    .invh table, .invh th, .invh td{
        border: 1px solid #000000;
    }
    table {
        border-collapse:collapse;
        width: 70%;
        border-radius: 4px;
    }
    td{
        height: 40px;
    }
    .invheader {
        display: block;
        padding-left: 10%;
        font-family: arial,sans-serif;
        font-size: 14px;
    }
    .invhead {
        margin-top: -25px;
        position: relative;
        text-align: center;
    }
    .invimage{
        margin-left:10px;
        margin-top:10px;
        float:left;
    }
    .invaddr {
        font-size: 14px;
    }
    .invtitle{
        font-size:18px;
        font-weight:bold;
    }
    .num{
        color: red;
        font-size:19px;
        font-weight:bold;
        font-family:courier, sans-serif;
    }
    .gradeHD{
        font-weight:bold;
    }
    .gradeMM td{
        border-top: none;
        border-bottom:none;
    }
</style>

</head>
<body>
    <div class="invheader">
        <table class="invh">
            <tr height="112px" >
                <td colspan="7">
                    <div class="invimage"><img width="103px" align="center" src="<?php echo base_url(); ?>images/CMSlogo_103.png" alt="" /></div>
                    <div class="invhead">
                        <h2>CRANE MANAGEMENT SERVICES LTD</h2>
                        <span class="invaddr">
                            <b>P.O Box 12345,
                        </br>Kampala, Uganda.
                        <br>Tel: +25641254589</br></b>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="7" align="center"><span class="invtitle">INVOICE</span></td>
            </tr>
            <tr>
                <td class="center" rowspan="3" colspan="2">
                    &nbsp;<b>Tenant's Name:</b>&nbsp; &nbsp;<span>Silas Kaggwa</span><br></br>
                    &nbsp;<b>Room No:</b>&nbsp; &nbsp;<span>A5</span></br></br>
                    &nbsp;<b>Building:</b>&nbsp; &nbsp;<span>City Center Complex</span>
                </td>
                <td class="center" colspan="3"><b>&nbsp;Account No:</b>&nbsp;&nbsp;<span>5214000856</span></td>
                <td class="center" colspan="2"><b>&nbsp;Billing Date:</b>&nbsp;&nbsp;<span>12-01-2013</span></td>
            </tr>
            <tr>
                <td class="center" colspan="3"><b>&nbsp;Billing No:</b>&nbsp;&nbsp;<span class="num">71502</span></td>
                <td class="center" colspan="2"><b>&nbsp;Payment Due Date:</b>&nbsp;&nbsp;<span>11-02-2013</span></td>
            </tr>
            <tr >
               <td class="center" colspan="5"></td>
            </tr>
            <tr class="gradeHD" >
                <td class="center" width="5%" align="center">SN</td>
                <td class="center" align="center" >Bill Items</td>
                <td class="center" width="80px" align="center">Previous Reading</td>
                <td class="center" width="80px" align="center">Current Reading</td>
                <td class="center" width="80px" align="center">Units KWh/KVA</td>
                <td class="center" width="85px" align="center">Rate(UGX)</td>
                <td class="center" width="135px" align="center">Amount(UGX)</td>
            </tr>
            <tr class="gradeMM">
                <td class="center" width="5%" align="center">1</td>
                <td class="center" align="center" >Electricity</td>
                <td class="center" width="80px" align="center">385280</td>
                <td class="center" width="80px" align="center">385482</td>
                <td class="center" width="80px" align="center">2100</td>
                <td class="center" width="85px" align="center">458.32</td>
                <td class="center" width="135px" align="center">785,000</td>
            </tr>
             <tr class="gradeMM">
                <td class="center" width="5%" align="center">2</td>
                <td class="center" align="center" >VAT</td>
                <td class="center" width="80px" align="center">-</td>
                <td class="center" width="80px" align="center">-</td>
                <td class="center" width="80px" align="center">-</td>
                <td class="center" width="85px" align="center">18.00%</td>
                <td class="center" width="135px" align="center">141,300</td>
            </tr>
            <tr class="gradeHD">
                <td class="center" width="5%"></td>
                <td class="center" align="center" >Total Amount Due</td>
                <td class="center" width="80px"></td>
                <td class="center" width="80px"></td>
                <td class="center" width="80px"></td>
                <td class="center" width="85px"></td>
                <td class="center" width="135px" align="center" >926,300</td>
            </tr>
            <tr height="50px">
                <td class="center" colspan="7">&nbsp;Amount Chargeable(in words): &nbsp;<span>Uganda Shillings Seven hundred eighty five thousand only</span></td>
            </tr>
            <tr height="80px">
                <td class="center" width="5%" colspan="5"></td>
                <td class="center" width="85px" colspan="2" align="center" >Stamp</td>
            </tr>
        </table>
    </div>
</body>

</html>