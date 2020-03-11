<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Edit Data</h3>									
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('disasters.update', 'update') }}" id="frmEditDisaster">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group @if ($errors->has('namawilayah')) has-error @endif">
                    <label for="namawilayah">Nama Wilayah</label>
                    <input type="text" class="form-control" name="namawilayah" id="namawilayah">
                    @error('namawilayah')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror											
                </div>
                <div class="form-group @if ($errors->has('jumlahkejadian')) has-error @endif">
                    <label for="jumlahkejadian">Jumlah Kejadian</label>
                    <input type="text" class="form-control" name="jumlahkejadian" id="jumlahkejadian" value="{{old('jumlahkejadian')}}">
                    @error('jumlahkejadian')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>											
                <div class="form-group @if ($errors->has('jumlahkorban')) has-error @endif">
                    <label for="jumlahkorban">Jumlah Korban</label>
                    <input type="text" class="form-control" name="jumlahkorban" id="jumlahkorban" value="{{old('jumlahkorban')}}">
                    @error('jumlahkorban')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>											
                <div class="form-group @if ($errors->has('jumlahkerusakan')) has-error @endif">
                    <label for="jumlahkerusakan">Jumlah Kerusakan</label>
                    <input type="text" class="form-control" name="jumlahkerusakan" id="jumlahkerusakan" value="{{old('jumlahkerusakan')}}">
                    @error('jumlahkerusakan')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>																				
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-toastr" id="editBtn">Edit</button>
                </div>
            </form>
    </div>
    </div>
</div>