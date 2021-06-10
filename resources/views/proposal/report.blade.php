<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
</head>
<body>

    
    
    <table >
        <tr>
            <td width="25%">
                <img src="https://res.cloudinary.com/dpnumvpwv/image/upload/w_160/v1622547993/Logo_YBM_os2uvz.png" alt="AdminLTE Logo">
            </td>
            <td align="center" style="font-size: 15px;padding:5px 0px; ">
                <span><b>YAYASAN BAITUL MAAL (YBM) PLN</b></span><br>
                <span>UNIT INDUK TRANSMISI JAWA BAGIAN TENGAH</span><br>
                <small>JL.Moch Toha KM 4 Cigereleng-Bandung.Telepon(022)5201712 email:lazis.tjbt@gmail.com</small>
            </td>
        </tr>
    </table>
    <?php
    $createddate = $proposal->created_at->isoFormat(' dddd, D MMMM Y');                                             
    ?>         
    <table border="1"  width="100%" cellspacing='0' cellpadding="5" >
        <tr style="background-color:rgb(222, 241, 247)">
            <th>JENIS PENDANAAN </th>
            <th colspan="4">{{$proposal->kategori_ajuan}}</th>
        </tr>
        <tr>
            <td> TANGGAL PENGAJUAN </td>
            <td> {{$createddate}} </td>
            <td colspan="4"> {{$proposal->no_ajuan}} </td>
        </tr>
        @foreach ($ajuan as $item)
            
        <tr>
            <td>PIC</td>
            <td colspan="4">{{$item->pic}}</td>
        </tr>
        <tr>
            <td>METODE</td>
            <td colspan="4">{{$item->metode}}</td>
        </tr>
        <tr>
            <td rowspan="4">DIBAYARKAN KEPADA</td>
            
            <td colspan="4">Elan Sunarlan</td>
        </tr>
        <tr>
            
            <td>NO. REKENING</td>
            <td colspan="3">{{$item->no_rekening}}</td>
        </tr>
        <tr>
            
            <td>NAMA BANK</td>
            <td colspan="3">{{$item->nama_bank}}</td>
        </tr>
        <tr>
            
            <td>PEMILIK REKENING</td>
            <td colspan="3">{{$item->pemilik_rekening}}</td>
        </tr>
        <tr>
            <td>DIVISI/PROGRAM</td>
            <td colspan="4">PROGRAM BY PROPOSAL</td>
        </tr>
        <tr>
            <td rowspan="2">SUMBER DANA</td>
            <td colspan="4">{{$item->sumber_dana}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Empat Puluh Sembilan Juta Enam Ratus Sepuluh Ribu Lima Ratus Rupiah</td>
        </tr>

        <tr>
            <td>RINCIAN</td>
            <td>TERLAMPIR</td>
            <td colspan="3">SESUAI RINCIAN</td>
        </tr>    
    </table>
    <table border="1" cellspacing='0' cellpadding="5" width="100%">

        <tr style="background-color:rgb(115, 178, 197)">
            <th width="10%">NO</th>            
            <th>URAIAN</th>
            <th>QTY</th>
            <th>NOMINAL</th>
            <th>TOTAL</th>
        </tr>
        <?php
        $no=0;
        ?>
        @foreach ($rincian as $item)
            
        <tr style="background-color:rgb(222, 241, 247)">
            <td>{{++$no}}</td>
            <td>{{$item->uraian}}</td>
            <td>{{$item->qty}}</td>
            <td>Rp. {{number_format($item->nominal, 0,',','.')}}</td>                
              <td>Rp. {{number_format((int)$item->qty*$item->nominal,0 ,',','.')}}</td>                                                              
        </tr>
        @endforeach
    </table>
    <table border="1" cellspacing='0' cellpadding="5" width="100%">

        <tr>
            <td colspan="5">VERIFIKASI DAN OTORITAS(nama dan tandatangan)</td>

        </tr>
        <tr>
            <td>USER/AMIL</td>
            <td>VERIFIKASI/ATASAN LANGSUNG</td>
            <td>BAGIAN KEUANGAN</td>
            <td colspan="2">KETUA</td>
        </tr>
        <tr>
            <td width="25%" align="center">
                <img src="https://res.cloudinary.com/dpnumvpwv/image/upload/w_160/v1622554994/amil_pmpfdb.png" alt=""><br>
                ELAN SUNARLAN
            </td>
            <td width="25%" align="center">
                <img src="https://res.cloudinary.com/dpnumvpwv/image/upload/w_160/v1622554994/amil_pmpfdb.png" alt=""><br>
                CUCU KURNIAWAN
            </td>
            <td width="25%" align="center">
                <img src="https://res.cloudinary.com/dpnumvpwv/image/upload/w_160/v1622554994/amil_pmpfdb.png" alt=""><br>            
                FENNY FADYA
            </td>
            <td width="25%" align="center">
                <img src="https://res.cloudinary.com/dpnumvpwv/image/upload/w_160/v1622554994/amil_pmpfdb.png" alt=""><br>                
                DENDEN RUHDANI MASRI
            </td>
        </tr>
    </table>
</body>
</html>
{{-- {{$proposal->no_ajuan}} --}}