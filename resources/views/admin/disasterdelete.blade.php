<!-- Modal Edit Data -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="" id="deleteForm">
            @method('delete')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Delete Data</h3>									
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin menghapus <span id="ket"></span> ?</p>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-toastr">Delete</button>
                </div>                            
            </div>
        </form>
    </div>
</div>