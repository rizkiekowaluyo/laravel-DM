$(document).ready(function(){
    //get base URL *********************
    var url = $('#url').val();

    $('#add-disaster').click(function(){
        $('#frmAddDisaster').trigger("reset");
        $('#addModal').modal('show');
    });

     //display modal form for product EDIT ***************************
     $(document).on('click','.edit-modal',function(){
        var id = $(this).val();
        url_route = $("#frmEditDisaster").attr('action');
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + id,
            success: function (data) {
                console.log(data);
                $('#id').val(data.id);
                $('#namawilayah').val(data.namawilayah);
                $('#jumlahkejadian').val(data.jumlahkejadian);                
                $('#jumlahkorban').val(data.jumlahkorban);                
                $('#jumlahkerusakan').val(data.jumlahkerusakan);                
                $('#editModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});