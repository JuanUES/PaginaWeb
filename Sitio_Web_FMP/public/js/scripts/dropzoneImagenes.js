Dropzone.autoDiscover = false;

$(".dropzone").dropzone({
    paramName: "file",
    acceptedFiles: "image/*",
    parallelUploads: 1,
});

$(".dropzone").on("complete", function(file) {
    $(".dropzone").removeFile(file);
});

$('#dropZoneCarrusel').on('hidden.bs.modal',function(){ location.reload();});