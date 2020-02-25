$(document).ready(function() {
    $("#btn-add").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/disasters',
            data: {
                namawilayah: $("#frmAddDisaster input[name=namawilayah]").val(),
                jumlahkejadian: $("#frmAddDisaster input[name=jumlahkejadian]").val(),
                jumlahkorban: $("#frmAddDisaster input[name=jumlahkorban]").val(),
                jumlahkerusakan: $("#frmAddDisaster input[name=jumlahkerusakan]").val()
            },
            dataType: 'json',
            success: function(data) {
                $('#frmAddDisaster').trigger("reset");
                $("#frmAddDisaster .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#add-task-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    });
    $("#btn-edit").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/tasks/' + $("#frmEditDisaster input[name=id]").val(),
            data: {
                namawilayah: $("#frmEditDisaster input[name=namawilayah]").val(),
                jumlahkejadian: $("#frmEditDisaster input[name=jumlahkejadian]").val(),
                jumlahkorban: $("#frmEditDisaster input[name=jumlahkorban]").val(),
                jumlahkerusakan: $("#frmEditDisaster input[name=jumlahkerusakan]").val()
            },
            dataType: 'json',
            success: function(data) {
                $('#frmEditDisaster').trigger("reset");
                $("#frmEditDisaster .close").click();
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#edit-task-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });
    $("#btn-delete").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '/tasks/' + $("#frmDeleteDisaster input[name=id]").val(),
            dataType: 'json',
            success: function(data) {
                $("#frmDeleteTask .close").click();
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});

function addDisasterForm() {
    $(document).ready(function() {
        $("#add-error-bag").hide();
        $('#addModal').modal('show');
    });
}

function editDisasterForm(id) {
    $.ajax({
        type: 'GET',
        url: '/tasks/' + id,
        success: function(data) {
            $("#edit-error-bag").hide();
            $("#frmEditDisaster input[name=namawilayah]").val(data.disaster.namawilayah);
            $("#frmEditDisaster input[name=jumlahkejadian]").val(data.disaster.description);
            $("#frmEditDisaster input[name=jumlahkorban]").val(data.disaster.jumlahkorban);
            $("#frmEditDisaster input[name=jumlahkerusakan]").val(data.disaster.jumlahkerusakan);        
            $('#editDisasterModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteDisasterForm(id) {
    $.ajax({
        type: 'GET',
        url: '/tasks/' + id,
        success: function(data) {
            $("#frmDeleteDisaster #delete-title").html("Delete Task (" + data.disaster.disaster + ")?");
            $("#frmDeleteDisaster input[name=id]").val(data.disaster.id);
            $('#deleteTaskModal').modal('show');
        },
        error: function(data) {
            console.log(data);
        }
    });
}