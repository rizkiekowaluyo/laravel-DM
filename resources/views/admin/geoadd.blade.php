<!-- Modal Add Data -->
<div class="modal fade" id="addGeoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Add Data</h3>									
        </div>
        <div class="modal-body">
            <form id="frmAddGeo" method="post" action="/geographics">
                @csrf
                <div class="form-group">
                  <label for="namawilayah">Nama Wilayah</label>
                  <input type="text" class="form-control" name="namawilayah" id="namawilayah">											
                </div>
                <div class="form-group">
                  <label for="kemiringanlereng">Kemiringan Lereng</label>
                  <input type="text" class="form-control" name="kemiringanlereng" id="kemiringanlereng">
                </div>											
                <div class="form-group">
                  <label for="jenistanah">Jenis Tanah</label>
                  <input type="text" class="form-control" name="jenistanah" id="jenistanah">
                </div>											
                <div class="form-group">
                  <label for="curahhujan">Curah Hujan</label>
                  <input type="text" class="form-control" name="curahhujan" id="curahhujan">
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