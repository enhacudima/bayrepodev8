@extends('layouts.principal')

@section('content')

    <style>

        /*
	Theme Name: CSS3 Contact Form
	Date: April 2013
	Description: Basic HTML5/CSS3 contact form
	Version: 1.0
	Author: Christian Vasile
	Author URL: http://christianvasile.com
*/

        /* ===========================
           ======= Body style ========
           =========================== */

        body {
            padding: 50px 100px;
            font-size: 13px;
            font-style: Verdana, Tahoma, sans-serif;
        }

        h2 {
            margin-bottom: 20px;
            color: #474E69;
        }

        /* ===========================
           ====== Contact Form =======
           =========================== */

        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 200px;
            color: #999999;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

        textarea {
            width: 400px;
            height: 150px;
            max-width: 400px;
            line-height: 18px;
        }

        input:hover, textarea:hover,
        input:focus, textarea:focus {
            border-color: 1px solid #C9C9C9;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
        }

        .form label {
            margin-left: 10px;
            color: #999999;
        }

        /* ===========================
           ====== Submit Button ======
           =========================== */

        .submit input {
            width: 130px;
            height: 40px;
            background-color: #474E69;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        .submit2 input {
            width: 130px;
            height: 40px;
            background-color: #963c39;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

    </style>
<h2>Inserção de Anexo</h2>
<hr>
@if(isset($product->productImg))
Anexos:
<td><strong><a class="fa fa-file fa-lg" aria-hidden="true" href="{{asset('storage/productimg/'.$product->productImg)}}" target="_self"> PDF</a></strong></td>
@endif
<form action="{{ url('/create-step2') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <h3>Upload PDF</h3><br/><br/>

    <div class="form-group">
        <input type="file" {{ (!empty($product->productImg)) ? "disabled" : ''}} class="form-control-file" name="productimg" id="productimg" aria-describedby="fileHelp" style="width: 400px">
        <small id="fileHelp" class="form-text text-muted">Por favor carregue o PDF com os todos documentos. O PDF não pode ser superior à 10MB</small>
    </div>
    <p class="submit">
    <input type="submit" value="Rever detalhes">
    </p>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</form><br/>
@if(isset($product->productImg))
<form action="{{route('remove-image')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <p class="submit2">
    <input type="submit" value="Remover Anexo">
    </p>
</form>

@endif
@endsection
