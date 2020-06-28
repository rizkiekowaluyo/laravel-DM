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
    
    $("#frmAddGeo").validate({
        rules: {
            namawilayah: {
                required: true,            
            },

            kemiringanlereng: {
                required: true,
                number: true
            },

            jenistanah: {
                required: true,
                number: true
            },
        
            curahhujan: {
                required: true,
                number: true
            },
        },
        messages: {

            namawilayah: {
                required: "Nama wilayah wajib diisi",
                unique: "Nama wilayah redundan",
            },
            kemiringanlereng: {
                required: "Jumlah kejadian wajib diisi",
                number: "Isi data dengan format angka",
            },
            jenistanah: {
                required: "Jumlah korban wajib diisi",
                number: "Isi data dengan format angka",
            },
            curahhujan: {
                required: "Jumlah kerusakan wajib diisi",                
                number: "Isi data dengan format angka",                
            },
        },
    })

    $("#frmEditGeo").validate({
        rules: {
            namawilayah: {
                required: true,            
            },

            kemiringanlereng: {
                required: true,
                number: true
            },

            jenistanah: {
                required: true,
                number: true
            },
        
            curahhujan: {
                required: true,
                number: true
            },
        },
        messages: {

            namawilayah: {
                required: "Nama wilayah wajib diisi",
                unique: "Nama wilayah redundan",
            },
            kemiringanlereng: {
                required: "Jumlah kejadian wajib diisi",
                number: "Isi data dengan format angka",
            },
            jenistanah: {
                required: "Jumlah korban wajib diisi",
                number: "Isi data dengan format angka",
            },
            curahhujan: {
                required: "Jumlah kerusakan wajib diisi",                
                number: "Isi data dengan format angka",                
            },
        },
    })

    $("#importGeographic").validate({
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