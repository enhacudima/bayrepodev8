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
            width: 100px;
            height: 40px;
            background-color: #474E69;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

    </style>

    <h2>Revisão de Detalhes</h2>
    <hr>
    <form action="{{ url('/store') }}" method="post" >
        {{ csrf_field() }}



        <table class="table">
            <tr>
                <td>NUIT:</td>
                <td><strong>{{$product->nuit}}</strong></td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><strong>{{$product->nome}}</strong></td>
            </tr>
            <tr>
                <td>Entidade:</td>
                <td><strong>{{$product->entidade}}</strong></td>
            </tr>
            <tr>
                <td>Documento de Identificação:</td>
                <td><strong>{{$product->documentodeidentificacao}}</strong></td>
            </tr>
            <tr>
                <td>Número do Documento:</td>
                <td><strong>{{$product->numerododocumento}}</strong></td>

            </tr>

            <tr>
                <td>Nome do Banco Associado ao Cliente:</td>
                <td><strong>{{$product->nomedobanco}}</strong></td>
            </tr>

            <tr>
                <td>Número Único de Identiicação Bancária (NIB):</td>
                <td><strong>{{$product->nib}}</strong></td>
            </tr>

            <tr>
                <td>Titular da conta:</td>
                <td><strong>{{$product->titulardaconta}}</strong></td>
            </tr>

            <tr>
                <td>Descrição da Solicitação:</td>
                <td><strong>{{$product->description}}</strong></td>
            </tr>








            <tr>
                <td>Anexo:</td>
                <td><strong><a class="fa fa-file fa-lg" aria-hidden="true" href="{{asset('storage/productimg/'.$product->productImg)}}" target="_self"> PDF</a></strong></td>



            </tr>
        </table>
        <a type="button" href="{{ url('/create-step1') }}" class="btn btn-warning">Voltar ao Formulário</a>
        <a type="button" href="{{ url('/create-step2B') }}" class="btn btn-warning">Voltar aos Anexos</a>
        <button type="submit" class="btn btn-primary">Submeter</button>
    </form>
@endsection
