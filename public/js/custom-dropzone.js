Dropzone.options.brochureUpload = {

	uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 20,
    method: "post",
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 20MB',
    dictDefaultMessage: "Drop files here to upload",
    dictRemoveFile: "Remove file",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    init: function() {
    
        this.on("removedfile", function(file) {

            $.ajax({
                type: 'POST',
                url: 'upload/delete',
                data: {id: file.name, _token: $('#csrf-token').val()},
                dataType: 'html',
                success: function(data){
                    var rep = JSON.parse(data);
                    if(rep.code == 200)
                    {
                        photo_counter--;
                        $("#photoCounter").text( "(" + photo_counter + ")");
                    }

                }
            });

        });

        this.on("addedFile", function(file) {

            $.ajax({
                type: 'POST',
                url: 'upload/delete',
                data: {id: file.name, _token: $('#csrf-token').val()},
                dataType: 'html',
                success: function(data){
                    var rep = JSON.parse(data);
                    if(rep.code == 200)
                    {
                        photo_counter--;
                        $("#photoCounter").text( "(" + photo_counter + ")");
                    }

                }
            });

        });
    },

}