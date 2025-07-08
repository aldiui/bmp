<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>      
        @page { 
            size: A5 landscape;
            margin: 0.5cm ; 
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1;
            margin: 0px;
            padding: 0px;
            font-size : 12px;
        }

        p, h3, h2 {
            margin-bottom : 0
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse: collapse; border: 1px solid black;">
        <tr style="border-bottom: 1px solid black;">
            <td width="20%" align="center">
                <img src="img/logo.png" width="100px" alt="Logo Perusahaan" class="logo">
            </td>
            <td width="60%" align="center" valign="top">
                <h2>PT. BAHANA MEGA PRESTASI</h2>
                <h3>SLIP GAJI</h3>
            </td>
            <td width="20%" align="center">
            </td>
        </tr>
        <tr style="border-bottom: 1px solid black;">
            <td colspan="3" align="center">
                <table width="100%" cellpadding="6" cellspacing="0">
                    <tr>
                        <td width="15%">NAMA</td>
                        <td width="2%">:</td>
                        <td width="33%">AMANDA MARSELA PUTRI</td>
                        <td width="15%">PERIODE</td>
                        <td width="2%">:</td>
                        <td width="33%">MARET 2025</td>
                    </tr>
                    <tr>
                        <td width="15%">JABATAN</td>
                        <td width="2%">:</td>
                        <td width="33%">KA.DIV. DOKUMEN</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid black;">
            <td colspan="3" align="center">
                <table width="100%" cellpadding="6" cellspacing="0">
                    <tr>
                        <td colspan="3" width="50%"><b>PENERIMAAN</b></td>
                        <td colspan="3" width="50%"><b>POTONGAN</b></td>
                    </tr>
                    <tr>
                        <td width="17%">Gaji</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                        <td width="17%">BPJS JHT</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->bpjs_jht, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td width="17%">Tunjangan Jabatan</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                        <td width="17%">BPJS Kesehatan</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->bpjs_kesehatan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td width="17%">Bonus Lain-lain </td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                        <td width="17%">PPH 21</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->pph_21, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td width="17%">Tunjangan Pajak</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->tunjangan_pajak, 0, ',', '.') }}</td>
                        <td width="17%">Pinjaman</td>
                        <td width="2%">Rp</td>
                        <td width="31%" style="text-align:right">{{ number_format($gaji->pinjaman, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid black;">
            <td colspan="3" align="center">
                <table width="100%" cellpadding="6" cellspacing="0">
                    <tr>
                        <th width="17%" style="text-align:left">Total Penerimaan</th>
                        <th width="2%"  style="text-align:left">Rp</th>
                        <th width="31%" style="text-align:right">{{ number_format($gaji->gaji_kotor, 0, ',', '.') }}</th>
                        <th width="17%" style="text-align:left">Total Potongan</th>
                        <th width="2%"  style="text-align:left">Rp</th>
                        <th width="31%" style="text-align:right">{{ number_format($gaji->potongan, 0, ',', '.') }}</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid black;">
            <td colspan="3" align="center">
                <table width="100%" cellpadding="6" cellspacing="0">
                    <tr>
                        <th width="17%" style="text-align:left">THP</th>
                        <th width="2%"  style="text-align:left">Rp</th>
                        <th width="31%" style="text-align:right">{{ number_format($gaji->gaji_bersih, 0, ',', '.') }}</th>
                        <th width="50%"></th>
                    </tr>
                    <tr>
                        <td colspan="4" width="100%">
                            <div>
                                <p>Bekasi, {{ $tanggal_cetak }}</p>  
                                <div style="border-top: 1px solid #000; width: 200px; margin-top: 70px;"></div>
                                <p>( {{ $penandatangan }} )</p>
                                <br>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>