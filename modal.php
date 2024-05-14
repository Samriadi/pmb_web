<!-- Tombol untuk membuka modal -->
<a href="#" id="openModalBtn">Lihat Gambar</a>

<!-- Modal -->
<div id="myModal" class="modal">
  <!-- Konten modal -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php if ($bukti): ?>
      <img id="modalImg" src="./asset/<?= htmlspecialchars($bukti); ?>"><br>

      <form id="uploadForm" action="upload_image.php" method="post" enctype="multipart/form-data">
        <br><label for="fileToUpload">Ganti gambar:</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="hidden" name="member_id" value="<?= $member_id; ?>"><br>
        <br>
        <input type="submit" value="Simpan" name="submit">
      </form>

      <?php else: ?>
      <form id="uploadForm" action="upload_image.php" method="post" enctype="multipart/form-data">
        <p>Tidak ada gambar.</p><br>
        <label for="fileToUpload">Unggah gambar:</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="hidden" name="member_id" value="<?= $member_id; ?>"><br>
        <br>
        <input type="submit" value="Simpan" name="submit">
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