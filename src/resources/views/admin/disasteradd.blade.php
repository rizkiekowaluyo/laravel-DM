<!-- Modal Add Data -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Add Data</h3>									
        </div>
        <div class="modal-body">
            <form id="frmAddDisaster">
                @method("post")
                @csrf
                <div class="form-group @if ($errors->has('namawilayah')) has-error @endif">
                    <label for="namawilayah">Nama Wilayah</label>                
                    <input type="text" class="form-control" name="namawilayah" id="namawilayah" placeholder="Nama Wilayah">
                    @error('namawilayah')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @if ($errors->has('jumlahkejadian')) has-error @endif">
                    <label for="jumlahkejadian">jumlah kejadian</label>
                    <input type="text" class="form-control" name="jumlahkejadian" id="jumlahkejadian" placeholder="Jumlah Kejadian">
                    @error('jumlahkejadian')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>											
                <div class="form-group @if ($errors->has('jumlahkorban')) has-error @endif">
                    <label for="jumlahkorban">jumlah korban</label>
                    <input type="text" class="form-control" name="jumlahkorban" id="jumlahkorban" placeholder="Jumlah Korban">
                    @error('jumlahkorban')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>											
                <div class="form-group @if ($errors->has('jumlahkerusakan')) has-error @endif">
                    <label for="jumlahkerusakan">Jumlah Kerusakan</label>
                    <input type="text" class="form-control" name="jumlahkerusakan" id="jumlahkerusakan" placeholder="Jumlah Kerusakan">
                    @error('jumlahkerusakan')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
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