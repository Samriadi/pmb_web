<!DOCTYPE html>
<html>
  <head>
    <style>
      .container {
        width: 70%;
        margin: 0 auto;
        padding: 20px;

      }
      table {
        height: 200px;
        padding: 15px;
      }
      tr,
      td,
      th {
        padding: 2px;
        margin: auto;
        border: none;
      }
      p {
        margin: 5px;
        font-size:large;
      }
      
      @media print {
        @page {
          size: auto;
          margin: 0mm;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <table border="2;" align="center">
      <tr style="height: 25%">
          <td colspan="3">
          <br><p align="center" style="font-size: 25px; font-weight:bold;">Pendaftaran Anda Berhasil! </p><br>
          </td>
        </tr>

        <tr style="height: 25%">
          <td style="width: 40%">
            <p>NAMA </p>
          </td>
          <td style="width: 10%">
           <p> = </p>
          </td>
          <td style="width: 60px">
           <p><?php echo $nama_lengkap?></p>
          </td>
        </tr>  
        
        <tr style="height: 25%">
          <td style="width: 30%">
            <p>Username</p> 
          </td>
          <td style="width: 10%">
            <p>=</p>
          </td>
          <td style="width: 60px">
          <p><?php echo $user_name?></p>
          </td>
        </tr> 

        <tr style="height: 25%">
          <td colspan="3">
            <br><p>Informasi Pembayaran :</p>  
          </td>
        </tr>

        <tr style="height: 25%">
          <td style="width: 30%">
            <p>Bank</p> 
          </td>
          <td style="width: 10%">
            <p>=</p>
          </td>
          <td style="width: 60px">
           <p>BSI</p>
          </td>
        </tr>

        <tr style="height: 25%">
          <td style="width: 30%">
            <P>Virtual Rekening</P> 
          </td>
          <td style="width: 10%">
            <p>=</p>
          </td>
          <td style="width: 60px">
          <p><?php echo $nomor_va?></p>
          </td>
        </tr>

        <tr style="height: 25%">
          <td style="width: 30%">
           <p> Biaya Pendaftaran </p>
          </td>
          <td style="width: 10%">
            <p>= </p>
          </td>
          <td style="width: 60px">
          <p><?php echo $tagihan?></p>
          </td>
        </tr>

        <tr style="height: 25%">
          <td colspan="3">
          <br><p style= font-weight:bold;">Silahkan lakukan pembayaran terlebih dahulu seperti yang tercantum diatas! </p><br>
          </td>
        </tr>

      </table>
    </div>
    <script>
      window.print();
    </script>
  </body>
</html>
