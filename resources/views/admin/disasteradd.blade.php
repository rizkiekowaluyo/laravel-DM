<!-- Modal Add Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Add Data</h3>									
        </div>
        <div class="modal-body">
            <form id="frmAddDisaster" method="post" action="/disasters">
                @csrf
                <div class="form-group">
                  <label for="namawilayah">Nama Wilayah</label>
                  <input type="text" class="form-control" name="namawilayah" id="namawilayah">											
                </div>
                <div class="form-group">
                  <label for="jumlahkejadian">Jumlah Kejadian</label>
                  <input type="text" class="form-control" name="jumlahkejadian" id="jumlahkejadian">
                </div>											
                <div class="form-group">
                  <label for="jumlahkorban">Jumlah Korban</label>
                  <input type="text" class="form-control" name="jumlahkorban" id="jumlahkorban">
                </div>											
                <div class="form-group">
                  <label for="jumlahkerusakan">Jumlah Kerusakan</label>
                  <input type="text" class="form-control" name="jumlahkerusakan" id="jumlahkerusakan">
                </div>																				
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-toastr" id="btn-add" data-context="success" data-message="Data telah ditambahkan" data-position="bottom-right">Save</button>
                </div>
            </form>
    </div>
    </div>
</div>