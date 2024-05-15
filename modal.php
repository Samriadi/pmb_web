<!-- Tombol untuk membuka modal -->
<a href="#" id="openModalBtn">Lihat Gambar</a>

<!-- Modal -->
<div id="myModal" class="modal">
  <!-- Konten modal -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php if ($file_path): ?>
      <img id="modalImg" src="<?= htmlspecialchars($file_path); ?>"><br>

      <form id="uploadForm" action="upload_bukti.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="member_id" value="<?=$member_id?>" required>

        <label for="file">Pilih jika ingin mengganti gambar</label>
        <input type="file" name="file" id="file" required><br><br>

        <input type="submit" name="submit" value="Upload">
      </form>

      <?php else: ?>
      <form id="uploadForm" action="upload_bukti.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="member_id" value="<?=$member_id?>" required>

        <label for="file">Pilih gambar untuk diupload</label>
        <input type="file" name="file" id="file" required><br><br>

        <input type="submit" name="submit" value="Upload">
      </form>
    <?php endif; ?>
  </div>
</div>
   
<style>
    .modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    align-items: center;
    }

    .modal-content {
    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
    margin: auto;
    width: 50%;
    max-width: 700px;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    background-color: #fefefe;
    padding: 20px;
    border-radius: 5px;
    }

    #modalImg {
    max-width: 100%; 
    max-height: 80vh; 
    }

    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    align-self: flex-end;
    }

    .close:hover,
    .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }

</style>

<script>
    var modalBtn = document.getElementById("openModalBtn");
    var modal = document.getElementById("myModal");
    var closeBtn = document.getElementsByClassName("close")[0];

    modalBtn.onclick = function() {
    modal.style.display = "block";
    }
    closeBtn.onclick = function() {
    modal.style.display = "none";
    }
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
</script>