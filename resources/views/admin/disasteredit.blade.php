<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel"></h3>									
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('disasters.update', 'update') }}" id="editForm">
                @method('patch')
                @csrf
                <input type="hidden" name="id" id="id">
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
                    <button type="submit" class="btn btn-primary btn-toastr" >Edit</button>
                </div>
            </form>
    </div>
    </div>
</div>