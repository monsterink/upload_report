@extends('layouts.app')

@section('title','Edit')

@section('sidebar')
    @parent

@endsection

@section('content')  
<head>
        <script src="{{ URL::asset('pdf.js') }}"></script>
        <script src="{{ URL::asset('pdf.worker.js') }}"></script>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

        <!-- Script -->
        <script src="{{URL::asset('jquery-3.3.1.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
</head>
<div class="mt-4">
    @if(session()->has('edit'))
        <div class="row">
            <div class="alert alert-danger">
                <button type="button" class="btn-close" data-dismiss="alert" aria-hidden="true"></button>
                <!-- <strong>Notification</strong> -->
                {{session()->get('edit')}}
            </div>
        </div>
    @endif
    <form id="searchForm" action="{{url('/uploads/edit/an/'.$uploadfiles->id)}}" method="post" enctype="multipart/form-data"> 
        @csrf
            <div class="input-group mb-3">
                <span class="input-group-text btn-secondary" id="basic-addon1">AN</span>
                @if(isset($patients))
                    @foreach($patients as $patient)
                        <input type="text" class="form-control" id="an_search" value="{{$patient->an}}" name="search" required>
                    @endforeach
                @endif
                @if(isset($patients)=='')
                    <input type="text" class="form-control" id='an_search' name="search" value="{{$uploadfiles->an}}" required>
                @endif
                
                <button type="submit" id="submit" class="btn btn-success">Search</button>
            </div>
    </form>
    <form id="myForm" action="{{url('/uploads/edit/'.$uploadfiles->id)}}" method="post" enctype="multipart/form-data" onsubmit="myFunction()">
        @csrf
            <div class="input-group shadow p-3 mb-5 bg-white rounded">
                @if(isset($patients)=='')
                    <input type="text" name="an" style="display:none" value="{{$uploadfiles->an}}">
                    HN: {{$uploadfiles->Patient->hn}}<br>
                    ชื่อ: {{$uploadfiles->Patient->name}}<br>
                    อายุ: {{$uploadfiles->Patient->age}}
                @endif        
                @if(isset($patients))
                    @foreach($patients as $patient)
                    <input type="text" name="an" style="display:none" value="{{$patient->an}}">
                    HN: {{$patient->hn}}<br>
                    ชื่อ: {{$patient->name}}<br>
                    อายุ: {{$patient->age}}
                    @endforeach
                @endif 
            </div>  
            <div class="form-file form-file-sm ">
                <input class="form-control" type="file" id="pdf-file" name="filereport" accept="application/pdf" style="display:none" />    
                <button type="button" id="upload-dialog" class="btn btn-secondary">Choose File</button>
                <input type="hidden" id="status" name="status" value="Upload">
            </div>

            <div class="input-group mb-3">
                <p><a href="{{url('/preview/'.$uploadfiles->id)}}" target="_blank">{{$uploadfiles->filename}}</a></p>
            </div>

            <div class="col-md-12 text-center">    
                <div id="pdf-loader" style="display:none">Loading Preview ..</div>
                <canvas id="pdf-preview" width="200" style="display:none"></canvas>
            </div>

            <div class="mt-4 col-md-12 text-center">
                <button type="submit" type="button" class="btn btn-primary">Save</button>
            </div>
    </form>
</div>
<script>
    document.getElementById("myForm").onkeypress = function(e) {
    var key = e.charCode || e.keyCode || 0;     
    if (key == 13) {
        // alert("I told you not to, why did you do it?");
        e.preventDefault();
    }
    }
    var _PDF_DOC;
            var _CANVAS = document.querySelector('#pdf-preview');
            var _OBJECT_URL;

            function showPDF(pdf_url) {
                PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
                    _PDF_DOC = pdf_doc;

                    showPage(1);

                    URL.revokeObjectURL(_OBJECT_URL);
                }).catch(function(error) {
                    alert(error.message);
                });;
            }

            function showPage(page_no) {
                _PDF_DOC.getPage(page_no).then(function(page) {
                    var scale_required = _CANVAS.width / page.getViewport(1).width;
                    var viewport = page.getViewport(scale_required);
                    _CANVAS.height = viewport.height;

                    var renderContext = {
                        canvasContext: _CANVAS.getContext('2d'),
                        viewport: viewport
                    };
                    
                    page.render(renderContext).then(function() {
                        document.querySelector("#pdf-preview").style.display = 'inline-block';
                        document.querySelector("#pdf-loader").style.display = 'none';
                    });
                });
            }

            document.querySelector("#upload-dialog").addEventListener('click', function() {
                document.querySelector("#pdf-file").click();
            });

            document.querySelector("#pdf-file").addEventListener('change', function() {
                var file = this.files[0];
                var mime_types = [ 'application/pdf' ];

                if(mime_types.indexOf(file.type) == -1) {
                    alert('Error : Incorrect file type');
                    return;
                }

                if(file.size > 10*1024*1024) {
                    alert('Error : Exceeded size 10MB');
                    return;
                }
        
                document.querySelector("#upload-dialog").style.display = 'none';
                document.querySelector("#pdf-loader").style.display = 'inline-block';

        
                _OBJECT_URL = URL.createObjectURL(file)

                showPDF(_OBJECT_URL);
            });
        //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //     $(document).ready(function(){

        //     $( "#an_search" ).autocomplete({
        //             source: function( request, response ) {
        //             // Fetch data
        //             $.ajax({
        //                 url:"{{url('/patients/getPatients')}}",
        //                 type: 'post',
        //                 dataType: "json",
        //                 data: {
        //                 _token: '{{csrf_token()}}',
        //                 search: request.term
        //                 },
        //                 success: function( data ) {
        //                 response( data );
        //                 }
        //             });
        //         },
        //         select: function (event, ui) {
        //         // Set selection
        //         $('#an_search').val(ui.item.label); // display the selected text
        //         $('#an').val(ui.item.value); // save selected id to input
        //         return false;
        //         }
        //     });
        //     document.getElementById("an_search").addEventListener('keydown', function (ui) {
        //         return $('#an').val("");
        //     });
        // });
</script>
@endsection