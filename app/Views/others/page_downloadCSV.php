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
                    </select>
                  </div>
                </div>
              </form>
              <button style="margin-bottom: 10px;" type="submit" onclick="downloadCSV()" class="btn btn-primary">
                <i class=" fas fa-download"></i>
              </button>

            </div>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
    </script>


    <script>
      var table;
      var data;
      var columnsToDownload;
      var nameFileXlsx;

      function setPendaftarDataTable() {
        data = <?php echo json_encode($dataPendaftar); ?>;
        columnsToDownload = data.map(item => ({
          'Nama Lengkap': item['NamaLengkap'],
          'Pilihan Pertama': item['Pilihan Pertama'],
          'Pilihan Kedua': item['Pilihan Kedua'],
          'Pilihan Ketiga': item['Pilihan Ketiga'],
          'Jenjang': item['jenjang'],
          'Periode': item['Periode'],
        }));
        nameFileXlsx = 'data-pendaftar.xlsx';

        const keys = [];

        Object.keys(data[0]).forEach(key => {
          keys.push(key);
        });


        const valuesToMatch = ['Nama Lengkap', 'Pilihan Pertama', 'Pilihan Kedua', 'Pilihan Ketiga'];

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
        data = <?php echo json_encode($dataUjian); ?>;
        columnsToDownload = data.map(item => ({
          'No Ujian': item['no_ujian'],
          'Nama Lengkap': item['NamaLengkap'],
          'Kelulusan': item['kelulusan'],
        }));
        nameFileXlsx = 'data-ujian.xlsx';


        const keys = [];

        Object.keys(data[0]).forEach(key => {
          keys.push(key);
        });


        const valuesToMatch = ['no_ujian', 'NamaLengkap', 'member_id', 'kelulusan'];
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

      function initEventListeners() {
        var filterColumn = document.getElementById('filterColumn');

        if (filterColumn) {
          setPendaftarDataTable();
          filterColumn.addEventListener('change', function() {
            if (filterColumn.value === 'pendaftar') {
              setPendaftarDataTable();
            } else if (filterColumn.value === 'ujian') {
              setUjianDataTable();
            }
          });
        }
      }


      function downloadCSV() {

        console.log(columnsToDownload);

        let workbook = XLSX.utils.book_new();
        let worksheet = XLSX.utils.json_to_sheet(columnsToDownload);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Data');

        // Mengunduh file
        XLSX.writeFile(workbook, nameFileXlsx);

      }
    </script>
    </body>

    </html>