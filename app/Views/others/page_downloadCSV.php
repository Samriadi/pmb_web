<?php include '../app/Views/others/layouts/header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">

  <?php include '../app/Views/others/layouts/sidebar.php'; ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <?php include '../app/Views/others/layouts/topbar.php'; ?>

      <!-- End of Topbar -->
      <div class="container-fluid">
        <!-- Button trigger modal -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">DOWNLOAD</h5>
            <h6 id="filterSubtitle" class="m-0 font-weight-bold text-primary"></h6>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <form id="filterForm" method="GET" action="">
                <div class="row g-3 align-items-center mb-3">
                  <div class="col-auto">
                    <select class="form-control" id="filterColumn" name="filterColumn">
                      <option value="pendaftar" selected>Data Pendaftar</option>
                      <option value="ujian">Data Ujian</option>
                      <option value="lulus">Data Lulus</option>
                    </select>
                  </div>
                </div>
              </form>
              <button style="margin-bottom: 10px;" type="submit" onclick="downloadCSV()" class="btn btn-primary">
                <i class=" fas fa-download"></i>
              </button>

            </div>

            <div class="table-responsive"  id="tableResponsiveA">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

            <div class="table-responsive"  id="tableResponsiveB">
              <table class="table table-bordered" id="dataTableB" width="100%" cellspacing="0">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <?php include '../app/Views/others/layouts/footer.php'; ?>


    <script defer>
      document.addEventListener('DOMContentLoaded', function() {
        initEventListeners();
      });

      $(document).ready(function() {
        $('#filterColumn').on('change', function() {
          var selectedValue = $(this).val();

          console.log(selectedValue)

          if (selectedValue === 'pendaftar' || selectedValue === 'ujian') {
            $('#tableResponsiveA').show();
            $('#tableResponsiveB').hide();
          } else if (selectedValue === 'lulus') {
            $('#tableResponsiveA').hide();
            $('#tableResponsiveB').show();
          }
        });

        // Trigger change event on page load to display the correct table initially
        $('#filterColumn').trigger('change');
      });

    </script>


    <script>
      var table;
      var data;
      var columnsToDownload;
      var nameFileXlsx;

      function setPesertaPMBDataTable() {
        data = <?php echo json_encode($dataPesertaPMB); ?>;
        columnsToDownload = data.map(item => ({
          'NIK': item['nik'],
          'User Login': item['UserName'],
          'Nama Lengkap': item['Nama Lengkap'],
          'Nomor VA': item['nomor_va'],
          'Catatan Bank': item['catatan'],
          'Jumlah Tagihan': item['tagihan'],
          'Pilihan Pertama': item['Pilihan Pertama'],
          'Pilihan Kedua': item['Pilihan Kedua'],
          'Pilihan Ketiga': item['Pilihan Ketiga'],
          'Jenjang': item['jenjang'],
          'Periode': item['Periode'],
        }));
        nameFileXlsx = 'pesertaPMB.xlsx';

        const keys = [];

        Object.keys(data[0]).forEach(key => {
          keys.push(key);
        });


        const valuesToMatch = ['nik','UserName','Nama Lengkap', 'nomor_va', 'catatan', 'tagihan', 'Pilihan Pertama', 'Pilihan Kedua', 'Pilihan Ketiga', 'jenjang', 'Periode'];


        let columns = [];

        if ($.fn.DataTable.isDataTable('#dataTable')) {
          $('#dataTable').DataTable().destroy();
        }

        columns.push({
          data: null,
          title: 'No',
          render: function(data, type, row, meta) {
            return meta.row + 1;
          }
        });

        valuesToMatch.forEach(value => {
          if (keys.includes(value)) {
            columns.push({
              data: value,
              title: value
            });
          }
        });

        if (data.length > 0) {
          $('#dataTable').DataTable({
            data: data,
            columns: columns,
            destroy: true
          });
        }
      }

      function setUjianDataTable() {
        data = <?php echo json_encode($dataPesertaUjian); ?>;
        columnsToDownload = data.map(item => ({
          'NIK': item['nik'],
          'User Login': item['UserName'],
          'Nama Lengkap': item['Nama Lengkap'],
          'Va Number': item['va_number'],
          'Catatan Bank': item['catatan'],
          'Jumlah Tagihan': item['tagihan'],
          'Pilihan Pertama': item['Pilihan Pertama'],
          'Pilihan Kedua': item['Pilihan Kedua'],
          'Pilihan Ketiga': item['Pilihan Ketiga'],
          'Jenjang': item['jenjang'],
          'Periode': item['Periode'],
        }));
        nameFileXlsx = 'pesertaUjian.xlsx';

        const keys = [];

        Object.keys(data[0]).forEach(key => {
          keys.push(key);
        });


        const valuesToMatch = ['nik','UserName','Nama Lengkap', 'nomor_va', 'catatan', 'tagihan', 'Pilihan Pertama', 'Pilihan Kedua', 'Pilihan Ketiga', 'jenjang', 'Periode'];


        let columns = [];

        if ($.fn.DataTable.isDataTable('#dataTable')) {
          $('#dataTable').DataTable().destroy();
        }

        columns.push({
          data: null,
          title: 'No',
          render: function(data, type, row, meta) {
            return meta.row + 1;
          }
        });

        valuesToMatch.forEach(value => {
          if (keys.includes(value)) {
            columns.push({
              data: value,
              title: value
            });
          }
        });

        if (data.length > 0) {
          $('#dataTable').DataTable({
            data: data,
            columns: columns,
            destroy: true
          });
        }
      }

      function setLulusDataTable() {
        data = <?php echo json_encode($dataPesertaLulus); ?>;
        columnsToDownload = data.map(item => ({
          'NIK': item['nik'],
          'User Login': item['UserName'],
          'Nama Lengkap': item['Nama Lengkap'],
          'Va Number': item['va_number'],
          'Catatan Bank': item['catatan'],
          'Jumlah Tagihan': item['tagihan'],
          'Pilihan Lulus': item['prodi_lulus'],
          'Jenjang': item['jenjang'],
          'Periode': item['Periode'],
        }));
        nameFileXlsx = 'pesertaLulus.xlsx';

        const keys = [];

        Object.keys(data[0]).forEach(key => {
          keys.push(key);
        });


        const valuesToMatch = ['nik','UserName','Nama Lengkap', 'nomor_va', 'catatan', 'tagihan', 'prodi_lulus','jenjang', 'Periode'];

        let columns = [];

        if ($.fn.DataTable.isDataTable('#dataTableB')) {
          $('#dataTableB').DataTable().destroy();
        }

        columns.push({
          data: null,
          title: 'No',
          render: function(data, type, row, meta) {
            return meta.row + 1;
          }
        });

        valuesToMatch.forEach(value => {
          if (keys.includes(value)) {
            columns.push({
              data: value,
              title: value
            });
          }
        });

        if (data.length > 0) {
          $('#dataTableB').DataTable({
            data: data,
            columns: columns,
            destroy: true
          });
        }
      }

      function initEventListeners() {
        var filterColumn = document.getElementById('filterColumn');

        if (filterColumn) {
          setPesertaPMBDataTable();
          filterColumn.addEventListener('change', function() {
            if (filterColumn.value === 'pendaftar') {
              setPesertaPMBDataTable();
            } 
            else if (filterColumn.value === 'ujian') {
              setUjianDataTable();
            }
            else if (filterColumn.value === 'lulus') {
              setLulusDataTable();
            }
          });
        }
      }


      function downloadCSV() {

        let workbook = XLSX.utils.book_new();
        let worksheet = XLSX.utils.json_to_sheet(columnsToDownload);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Data');

        // Mengunduh file
        XLSX.writeFile(workbook, nameFileXlsx);

      }
      
    </script>

    
    </body>

    </html>