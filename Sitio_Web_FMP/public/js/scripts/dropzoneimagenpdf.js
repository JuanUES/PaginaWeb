Dropzone.autoDiscover = false;

$(".dropzoneimagen").dropzone({
    paramName: "file",
    acceptedFiles: "image/*",
    parallelUploads: 1,
});


$(".dropzonepdf").dropzone({
    paramName: "file",
    acceptedFiles: "application/pdf",
    parallelUploads: 1,
});

$('.bs-example-modal-center').on('hidden.bs.modal', function() { location.reload(); });