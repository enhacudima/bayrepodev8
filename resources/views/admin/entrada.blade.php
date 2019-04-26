
@extends('admin.layout')
@section('content')

    <style>
        #nr-campos{
            background: #f8fbf8;
            margin-bottom: 20px;
            padding: 15px;
        }
    </style>

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Entradas de Produtos</h4> </div>
    </div>
    <!-- /.row -->


    <div class="col-xs-12">
        <div class="white-box">
            @include('admin.mensagens.msg')
            <form class="form-horizontal form-material" method="POST" action="{{ route('entradas.store')}}">
            {{ csrf_field() }}
                <div id="nr-campos">

            <!--User ID-->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <div class="form-group">
                    <label class="col-md-12">Franquia</label>
                    <div class="col-md-4">
                        <select name="franquia_id" id="franquia_id" class="form-control form-control-line">
                            <option value="">Seleciona a Franquia...</option>
                            @foreach($franquias as $franquia)
                                <option value="{{$franquia->id}}">{{$franquia->nome}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                    <div class="form-group">
                        <label class="col-md-12">Mês</label>
                        <div class="col-md-3">
                            <input type="month" name="mes" class="form-control form-control-line">
                        </div>
                    </div>
              </div>

                    <div class="form-group">
                        <table  class="table table-bordered table-hover table-sortable col-md-12">
                            <thead>



                            <tr id="tHeader2">
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Comentario</th>
                                <th>
                                    <button class="btn btn-info center-block" id="add"><b>+</b> add</button>
                                </th>
                            </tr>
                            </thead>

                            <tbody id="corpo-pro">

                            <tr id="trDistribuicao">

                            </tr>

                            </tbody>
                        </table>
                     </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success pull-right">Gravar</button>
                        </div>
                    </div>

            </form>
        </div>
    </div>


    <script>
        var totalInput=5;
        $(document).ready(function () {
            createForm(totalInput);
        });

        $(document).on('click','button.remove', function () {
            $(this).closest('tr').remove();
            return false;
        });



        $('#add').click(function () {
            var total = parseInt($('#add_v').val());
            var distribuicao = '<tr>'+
                '<td>'+
                '<select id="produto_id'+ i + '" name="produto_id[]" class="form-control nprodutos" oninput=" Calctotal(\'untqd' + i + '\', \'qd' + i + '\', \'total' + i + '\');" onchange="fillUnidade(\'nprodutos'+ i + '\', \'untqd' + i + '\');  Calctotal(\'untqd' + i + '\', \'qd' + i + '\', \'total' + i + '\');">'+
                '<option value="">Carregar Lista Produto...</option>'+
                    @foreach($produtos as $produto)
                        '<option value="{{$produto->id}}">{{$produto->codigo}} - {{$produto->nome}}</option>'+
                    @endforeach
                        '</select>'+
                '</td>'+
                '<td>'+
                '<input id="quantidade' + i + '" name="quantidade[]" type="number" placeholder="0"  class="form-control untqd" >'+
                '</td>'+
                '<td>'+
                '<input id="comentario' + i + '" name="comentario[]" type="text" placeholder="0" class="form-control total" >'+
                '</td>'+
                '<td>'+
                '<button class="btn btn-danger remove center-block" onclick="return false;"><b>X</b></button>'+
                '</td>'+
                '</tr>';
            $('#corpo-pro').append(distribuicao);
            return false;
        });
        // Cria os campos para input
        function createForm(totalPaginas) {
            var distribuicao='';
            var totalInput = totalPaginas;

            for (i = 1; i <= totalInput; i++) {
                distribuicao += '<tr>'+
                    '<td>'+
                    '<select id="produto_id'+ i + '" name="produto_id[]" class="form-control nprodutos" oninput=" Calctotal(\'untqd' + i + '\', \'qd' + i + '\', \'total' + i + '\');" onchange="fillUnidade(\'nprodutos'+ i + '\', \'untqd' + i + '\');  Calctotal(\'untqd' + i + '\', \'qd' + i + '\', \'total' + i + '\');">'+
                    '<option value="">Carregar Lista Produto...</option>'+
                        @foreach($produtos as $produto)
                            '<option value="{{$produto->id}}">{{$produto->codigo}} - {{$produto->nome}}</option>'+
                        @endforeach
                    '</select>'+
                    '</td>'+
                    '<td>'+
                    '<input id="quantidade' + i + '" name="quantidade[]" type="number" placeholder="0"  class="form-control untqd" >'+
                    '</td>'+
                    '<td>'+
                    '<input id="comentario' + i + '" name="comentario[]" type="text" placeholder="0" class="form-control total" >'+
                    '</td>'+
                    '<td>'+
                    '<button class="btn btn-danger remove center-block" onclick="return false;"><b>X</b></button>'+
                    '</td>'+
                    '</tr>';
            }

            $('#corpo-pro').html(distribuicao).show();

        }

        $('input').click(function () {
            $('.alert').hide();
        });
    </script>



@endsection()