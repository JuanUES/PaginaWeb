@yield('content')
<!-- start page title -->
{{-- <div class="page-title-alt-bg color-top"></div>
<div class="page-title-box color-boton py-2 rounded">
    <h2 class="page-title text-white">Facultad Multidisciplinaria Paracentral</h2>
</div>
<div class="my-4"></div> --}}
<!-- end page title -->



<div class="row mt-1">
    <div class="col-12 col-sm-4">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-danger float-left">Documentos</div>
            <div class="ribbon-content">
                <div class="col order-first">
                    {{-- <p class="header-title">Facultades</p> --}}
                    @isset($documentos)
                        @foreach($documentos as $key => $item)
                            <div class="p-1" > <button type="button" data-id="{{ Hash::make($item->id) }}" class="documentos btn btn-link"><i class="fa fa-file-pdf"></i> {{ $item->titulo }}</button> </div>
                        {{-- @endforeach --}}
                    @endisset
                </div>
                <script type="text/javascript">
                    $(".documentos").on('click', function () {
                        alert('hola mundo');
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-8">
        <div class="card-box">

            <embed src="{{ asset('storage')."/uploads/transparencia/6CamQNqyM4QpBxm8OanSpGUCUtMZRclJPisuEEoW.pdf" }}" type="application/pdf" width="100%" height="600px" />

            {{-- <div id="my_pdf_viewer">
                <div id="canvas_container">
                    <canvas id="pdf_renderer"></canvas>
                </div>
            </div>
            <div id="navigation_controls">
                <button id="go_previous" class="btn btn-danger btn-sm"> <i class="fa fa-angle-left"></i> Anterior</button>
                <input id="current_page" value="1" type="number" class="form-control"/>
                <button id="go_next" class="btn btn-danger btn-sm">Siguiente <i class="fa fa-angle-right"></i></button>
            </div>
            <div id="zoom_controls">
                <button id="zoom_in" class="btn btn-sm btn-success">+</button>
                <button id="zoom_out" class="btn btn-sm btn-success">-</button>
            </div> --}}

        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<script>
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
    }
    // more code here
    function render() {
        myState.pdf.getPage(myState.currentPage).then((page) => {
            // more code here
            var canvas = document.getElementById("pdf_renderer");
            var ctx = canvas.getContext('2d');
            var viewport = page.getViewport(myState.zoom);
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }
    pdfjsLib.getDocument('{{ asset('storage')."/uploads/transparencia/6CamQNqyM4QpBxm8OanSpGUCUtMZRclJPisuEEoW.pdf" }}').then((pdf) => {
        // more code here
        myState.pdf = pdf;
        render();

    });
    document.getElementById('go_previous')
    .addEventListener('click', (e) => {
        if(myState.pdf == null
        || myState.currentPage == 1) return;
        myState.currentPage -= 1;
        document.getElementById("current_page")
                .value = myState.currentPage;
        render();
    });

    document.getElementById('go_next')
    .addEventListener('click', (e) => {
        if(myState.pdf == null
        || myState.currentPage > myState.pdf
                                        ._pdfInfo.numPages)
        return;

        myState.currentPage += 1;
        document.getElementById("current_page")
                .value = myState.currentPage;
        render();
    });

    document.getElementById('current_page')
    .addEventListener('keypress', (e) => {
        if(myState.pdf == null) return;

        // Get key code
        var code = (e.keyCode ? e.keyCode : e.which);

        // If key code matches that of the Enter key
        if(code == 13) {
            var desiredPage =
                    document.getElementById('current_page')
                            .valueAsNumber;

            if(desiredPage >= 1
            && desiredPage <= myState.pdf
                                        ._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page")
                            .value = desiredPage;
                    render();
            }
        }
    });
    document.getElementById('zoom_in')
    .addEventListener('click', (e) => {
        if(myState.pdf == null) return;
        myState.zoom += 0.5;
        render();
    });

    document.getElementById('zoom_out')
    .addEventListener('click', (e) => {
        if(myState.pdf == null) return;
        myState.zoom -= 0.5;
        render();
    });
</script>
<style>
    #canvas_container {
        width: 800px;
        height: 450px;
        overflow: auto;
        overflow-y:scroll;
    }
</style> --}}
