<!-- Modal Edit Data -->
<div class="modal fade" id="editGeoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Geographics</h3>									
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('geographics.update', 'update') }}" id="frmEditGeo">
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
                <div class="form-group @if ($errors->has('kemiringanlereng')) has-error @endif">
                    <label for="kemiringanlereng">Kemiringan Lereng</label>
                    <input type="text" class="form-control" name="kemiringanlereng" id="kemiringanlereng" value="{{old('kemiringanlereng')}}">
                    @error('kemiringanlereng')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>											
                <div class="form-group @if ($errors->has('jenistanah')) has-error @endif">
                    <label for="jenistanah">Jenis Tanah</label>
                    <input type="text" class="form-control" name="jenistanah" id="jenistanah" value="{{old('jenistanah')}}">
                    @error('jenistanah')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>											
                <div class="form-group @if ($errors->has('curahhujan')) has-error @endif">
                    <label for="curahhujan">Curah Hujan</label>
                    <input type="text" class="form-control" name="curahhujan" id="curahhujan" value="{{old('curahhujan')}}">
                    @error('curahhujan')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>																				
                <div class="form-group @if ($errors->has('tegal')) has-error @endif">
                    <label for="tegal">Tegal/Kebun</label>
                    <input type="text" class="form-control" name="tegal" id="tegal" value="{{old('tegal')}}">
                    @error('tegal')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>																				
                <div class="form-group @if ($errors->has('huma')) has-error @endif">
                    <label for="huma">Huma/Lahan</label>
                    <input type="text" class="form-control" name="huma" id="huma" value="{{old('huma')}}">
                    @error('huma')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group @if ($errors->has('sementaratidakdiusahakan')) has-error @endif">
                    <label for="sementaratidakdiusahakan">Lahan Sementara</label>
                    <input type="text" class="form-control" name="sementaratidakdiusahakan" id="sementaratidakdiusahakan" value="{{old('sementaratidakdiusahakan')}}">
                    @error('sementaratidakdiusahakan')
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