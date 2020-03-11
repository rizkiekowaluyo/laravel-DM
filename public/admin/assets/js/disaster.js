$(document).ready(function() {
    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight: function(element) {
          $(element)
            .closest('.form-group')
            .addClass('has-error');
        },
        unhighlight: function(element) {
          $(element)
            .closest('.form-group')
            .removeClass('has-error');
        }
      });
    
    $("#frmAddDisaster").validate({
        rules: {
            namawilayah: {
                required: true,            
            },

            jumlahkejadian: {
                required: true,
                number: true
            },

            jumlahkorban: {
                required: true,
                number: true
            },
        
            jumlahkerusakan: {
                required: true,
                number: true
            },
        },
        messages: {

            namawilayah: {
                required: "Nama wilayah wajib diisi",
                unique: "Nama wilayah redundan",
            },
            jumlahkejadian: {
                required: "Jumlah kejadian wajib diisi",
                number: "Isi data dengan format angka",
            },
            jumlahkorban: {
                required: "Jumlah korban wajib diisi",
                number: "Isi data dengan format angka",
            },
            jumlahkerusakan: {
                required: "Jumlah kerusakan wajib diisi",                
                number: "Isi data dengan format angka",                
            },
        },
    })

    $("#frmEditDisaster").validate({
        rules: {
            namawilayah: {
                required: true,            
            },

            jumlahkejadian: {
                required: true,
                number: true
            },

            jumlahkorban: {
                required: true,
                number: true
            },
        
            jumlahkerusakan: {
                required: true,
                number: true
            },
        },
        messages: {

            namawilayah: {
                required: "Nama wilayah wajib diisi",
                unique: "Nama wilayah redundan",
            },
            jumlahkejadian: {
                required: "Jumlah kejadian wajib diisi",
                number: "Isi data dengan format angka",
            },
            jumlahkorban: {
                required: "Jumlah korban wajib diisi",
                number: "Isi data dengan format angka",
            },
            jumlahkerusakan: {
                required: "Jumlah kerusakan wajib diisi",                
                number: "Isi data dengan format angka",                
            },
        },
    })

    $("#importDisaster").validate({
        rules: {
            file: {
              required: true,
              extension: "xlsx"
            }
        },
        messages: {
            file: {
              required: "Data import tidak ada",
              extension: "Format data harus (*.xlsz)"
            }
        },
    })
    
})