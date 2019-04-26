@extends('layouts.principal')

@section('content')




<style type="text/css">

select.form-control:not([size]):not([multiple]) {
    height: 33px;
}
</style>

<style>
.vl {
    border-left: 6px solid green;
    height: 500px;
}
</style>


<div class="container">
@include('errors')

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if(Auth::user()->level=='2'||Auth::user()->level=='4')
                <div class="card-header">{{ __('Register Funcionario') }} </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('savefuncionario') }}" aria-label="{{ __('Register') }}">
                        @csrf

                    <!--primeira coluna-->    
                    <div class="form-group col-md-6">

                        <!--1-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('NUIT') }}</label>

                            <div class="col-md-8">
                                <input id="nuit" type="number" class="form-control{{ $errors->has('nuit') ? ' is-invalid' : '' }}" name="nuit" value="{{ old('nuit') }}" required autofocus>
                                <input hidden="" htype="" name="fk_user_id" id="fk_user_id" value="{{ Auth::user()->id }}">

                                @if ($errors->has('nuit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nuit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--2-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-8">
                                <input id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}" required autofocus>
                                

                                @if ($errors->has('nome'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--3-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DATA DE NASCIMENTO') }}</label>

                            <div class="col-md-8">
                                <input id="dataDeNascimento" type="date" class="form-control{{ $errors->has('dataDeNascimento') ? ' is-invalid' : '' }}" name="dataDeNascimento" value="{{ old('dataDeNascimento') }}" required autofocus>
                              

                                @if ($errors->has('dataDeNascimento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dataDeNascimento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--4-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CÓDIGO ORGÂNICO') }}</label>

                            <div class="col-md-8">
                                <input id="codigoOrganico" type="text" class="form-control{{ $errors->has('codigoOrganico') ? ' is-invalid' : '' }}" name="codigoOrganico" value="{{ old('codigoOrganico') }}" required autofocus>
                                
                                @if ($errors->has('codigoOrganico'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codigoOrganico') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--5-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DESCRIÇÃO DO ORGÂNICO') }}</label>

                            <div class="col-md-8">
                                <input id="descricaoDoOrganico" type="text" class="form-control{{ $errors->has('descricaoDoOrganico') ? ' is-invalid' : '' }}" name="descricaoDoOrganico" value="{{ old('descricaoDoOrganico') }}" required autofocus>
                                

                                @if ($errors->has('descricaoDoOrganico'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descricaoDoOrganico') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--6-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TIPO DE QUADRO') }}</label>

                            <div class="col-md-8">
                                <select id="tipoDeQuadro" type="" class="form-control" name="tipoDeQuadro" value="{{ old('tipoDeQuadro') }}" required autofocus>
                                    <option  > Seleciona o quadro...</option>
                                    <option value="Contractado" {{ old('tipoDeQuadro') == "Contractado" ? 'selected' : '' }}>Contractado</option>
                                    <option value="Quadro Definitivo" {{ old('tipoDeQuadro') == "Quadro Definitivo" ? 'selected' : '' }}>Quadro Definitivo</option>
                                    <option value="Quadro Provisório" {{ old('tipoDeQuadro') == "Quadro Provisório" ? 'selected' : '' }}>Quadro Provisório</option>
                                
                                </select>

                                @if ($errors->has('tipoDeQuadro'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipoDeQuadro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--7-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TIPO DE CONTRATO') }}</label>

                            <div class="col-md-8">
                
                                <select id="tipoDeContrato" type="" class="form-control" name="tipoDeContrato" value="{{ old('tipoDeContrato') }}" required autofocus>
                                    <option> Seleciona o contrato...</option>
                                    <option value="Determinado" {{old('tipoDeContrato')=="Determinado" ? 'selected' : ''}}>Determinado</option>
                                    <option value="Indeterminado" {{old('tipoDeContrato')=="Indeterminado" ? 'selected' : ''}}>Indeterminado</option>
                                    <option value="N/A" {{old('tipoDeContrato')=="N/A" ? 'selected' : ''}}>N/A</option>
                                
                                </select>

                                @if ($errors->has('tipoDeContrato'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipoDeContrato') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--8-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DATA DO FIM DE CONTRATO') }}</label>

                            <div class="col-md-8">
                                <input id="dataDoFimDeContrato" type="date" class="form-control{{ $errors->has('dataDoFimDeContrato') ? ' is-invalid' : '' }}" name="dataDoFimDeContrato" value="{{ old('dataDoFimDeContrato') }}" >
                                

                                @if ($errors->has('dataDoFimDeContrato'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dataDoFimDeContrato') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--9-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ESTADO DE CONFORMIDADE DA VINCULAÇÃO') }}</label>

                            <div class="col-md-8">
                             
                                <select id="estadoDeConformidadeDaVinculacao" type="" class="form-control" name="estadoDeConformidadeDaVinculacao" value="{{ old('estadoDeConformidadeDaVinculacao') }}" required autofocus>
                                    <option> Seleciona o conformidade...</option>
                                    <option value="Com Conformidade Sectorial" {{old('estadoDeConformidadeDaVinculacao')=="Com Conformidade Sectorial" ? 'selected' : ''}}>Com Conformidade Sectorial</option>
                                    <option value="Conferido pelo Recenseador Sectorial e Aguardando Conformidade Sectorial" {{old('estadoDeConformidadeDaVinculacao')=="Conferido pelo Recenseador Sectorial e Aguardando Conformidade Sectorial" ? 'selected' : ''}}>Conferido pelo Recenseador Sectorial e Aguardando Conformidade Sectorial</option>
                                    <option value="Sem Conformidada Sectorial" {{old('estadoDeConformidadeDaVinculacao')=="Sem Conformidada Sectorial" ? 'selected' : ''}}>Sem Conformidada Sectorial</option>
                                    <option value="Sem Conformidade" {{old('estadoDeConformidadeDaVinculacao')=="Sem Conformidade" ? 'selected' : ''}}>Sem Conformidade</option>
                                
                                </select>
                                @if ($errors->has('estadoDeConformidadeDaVinculacao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estadoDeConformidadeDaVinculacao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--10-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TIPO DE CADASTRO') }}</label>

                            <div class="col-md-8">
                          
                                <select id="tipoDeCadastro" type="" class="form-control" name="tipoDeCadastro" value="{{ old('tipoDeCadastro') }}" required autofocus>
                                    <option> Seleciona o tipo de cadastro...</option>
                                    <option value="Ausente" {{old('tipoDeCadastro')=="Ausente" ? 'selected' : ''}}>Ausente</option>
                                    <option value="Presencial" {{old('tipoDeCadastro')=="Presencial" ? 'selected' : ''}}>Presencial</option>
                                    
                                
                                </select>
                                @if ($errors->has(' tipoDeCadastro'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first(' tipoDeCadastro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--11-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DATA DE CADASTRO') }}</label>

                            <div class="col-md-8">
                                <input id="dataDeCadastro" type="date" class="form-control{{ $errors->has('dataDeCadastro') ? ' is-invalid' : '' }}" name="dataDeCadastro" value="{{ old('dataDeCadastro') }}" required autofocus>
                          
                                @if ($errors->has('dataDeCadastro'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dataDeCadastro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--12-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MOTIVO DE CADASTRO') }}</label>

                            <div class="col-md-8">
                               
                                <select id="motivoDeCadastro" type="" class="form-control" name="motivoDeCadastro" value="{{ old('motivoDeCadastro') }}" required autofocus>
                                    <option> Seleciona o motivo de cadastro...</option>
                                    <option value="Doença Prolongada" {{old('motivoDeCadastro')=="Doença Prolongada" ? 'selected' : ''}}>Doença Prolongada</option>
                                    <option value="Formação Dentro do País"  {{old('motivoDeCadastro')=="Formação Dentro do País" ? 'selected' : ''}}>Formação Dentro do País</option>
                                    <option value="Formação no Exterior"  {{old('motivoDeCadastro')=="Formação no Exterior" ? 'selected' : ''}}>Formação no Exterior</option>
                                    <option value="Licença Ilimitada"  {{old('motivoDeCadastro')=="Licença Ilimitada" ? 'selected' : ''}}>Licença Ilimitada</option>
                                    <option value="Licença Limitada"  {{old('motivoDeCadastro')=="Licença Limitada" ? 'selected' : ''}}>Licença Limitada</option>
                                    <option value="Missão de Serviço Dentro do País"  {{old('motivoDeCadastro')=="Missão de Serviço Dentro do País" ? 'selected' : ''}}>Missão de Serviço Dentro do País</option>
                                    <option value="Serviço no Exterior - Missão Diplomática"  {{old('motivoDeCadastro')=="Serviço no Exterior - Missão Diplomática" ? 'selected' : ''}}>Serviço no Exterior - Missão Diplomática</option>
                                    <option value="Serviço no Exterior - Não Diplomático"  {{old('motivoDeCadastro')=="Serviço no Exterior - Não Diplomático" ? 'selected' : ''}}>Serviço no Exterior - Não Diplomático</option>
                                    <option value="Tratamento Médico"  {{old('motivoDeCadastro')=="Tratamento Médico" ? 'selected' : ''}}>Tratamento Médico</option>
                                    <option value="urgência - Pagamento Via Directa"  {{old('motivoDeCadastro')=="urgência - Pagamento Via Directa" ? 'selected' : ''}}>urgência - Pagamento Via Directa</option>
                                    <option value="N/A" {{old('motivoDeCadastro')=="N/A" ? 'selected' : ''}}>N/A</option>
                                
                                </select>

                                @if ($errors->has('motivoDeCadastro'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('motivoDeCadastro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--13-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('VINCULAÇÃO PRINCIPAL') }}</label>

                            <div class="col-md-8">
                               <select id="vinculacaoPrincipal" type="" class="form-control" name="vinculacaoPrincipal" value="{{ old('vinculacaoPrincipal') }}" required autofocus>
                                    <option> Seleciona vinculação principal...</option>
                                    <option value="NÃO" {{old('vinculacaoPrincipal')=="NÃO" ? 'selected' : ''}}>NÃO</option>
                                    <option value="SIM" {{old('vinculacaoPrincipal')=="SIM" ? 'selected' : ''}}>SIM</option>
                                </select>
                                @if ($errors->has('vinculacaoPrincipal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vinculacaoPrincipal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--14-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TIPO DE PROVA DE VIDA') }}</label>

                            <div class="col-md-8">
                               <select id="tipoDeProvaDeVida" type="" class="form-control" name="tipoDeProvaDeVida" value="{{ old('tipoDeProvaDeVida') }}" required autofocus>
                                    <option> Seleciona tipo de prova de vida...</option>
                                    <option value="Não Biométrica" {{old('tipoDeProvaDeVida')=="Não Biométrica" ? 'selected' : ''}}>Não Biométrica</option>
                                    <option value="Não Presencial" {{old('tipoDeProvaDeVida')=="Não Presencial" ? 'selected' : ''}}>Não Presencial</option>
                                    <option value="Não Presencial Com Conformidade" {{old('tipoDeProvaDeVida')=="Não Presencial Com Conformidade" ? 'selected' : ''}}>Não Presencial Com Conformidade</option>
                                    <option value="Presencial" {{old('tipoDeProvaDeVida')=="Presencial" ? 'selected' : ''}}>Presencial</option>
                                    <option value="Presencial Com Conformidade" {{old('tipoDeProvaDeVida')=="Presencial Com Conformidade" ? 'selected' : ''}}>Presencial Com Conformidade</option>
                                    <option value="Provisória" {{old('tipoDeProvaDeVida')=="Provisória" ? 'selected' : ''}}>Provisória</option>
                                    <option value="Sem Prova de Vida" {{old('tipoDeProvaDeVida')=="Sem Prova de Vida" ? 'selected' : ''}}>Sem Prova de Vida</option>
                                </select>

                                @if ($errors->has('tipoDeProvaDeVida'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipoDeProvaDeVida') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--15-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DATA DE REALIZAÇÃO DA PROVA DE VIDA') }}</label>

                            <div class="col-md-8">
                                <input id="dataDeRealizacaoDaProvaDeVida" type="date" class="form-control{{ $errors->has('dataDeRealizacaoDaProvaDeVida') ? ' is-invalid' : '' }}" name="dataDeRealizacaoDaProvaDeVida" value="{{ old('dataDeRealizacaoDaProvaDeVida') }}"  >
                                

                                @if ($errors->has('dataDeRealizacaoDaProvaDeVida'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dataDeRealizacaoDaProvaDeVida') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--16-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ESTADO DA CONFORMIDADE DE PV') }}</label>

                            <div class="col-md-8">
                              <select id="estadoDaConformidadeDePV" type="" class="form-control" name="estadoDaConformidadeDePV" value="{{ old('estadoDaConformidadeDePV') }}" required autofocus>
                                    <option> Seleciona estado da confirmi...</option>
                                    <option value="Com Conformidade" {{old('estadoDaConformidadeDePV')=="Com Conformidade" ? 'selected' : ''}}>Com Conformidade</option>
                                    <option value="Sem Conformidade" {{old('estadoDaConformidadeDePV')=="Sem Conformidade" ? 'selected' : ''}}>Sem Conformidade</option>
                                    <option value="Sem Conformidade Definida" {{old('estadoDaConformidadeDePV')=="Sem Conformidade Definida" ? 'selected' : ''}}>Sem Conformidade Definida</option>
                                    <option value="N/A" {{old('estadoDaConformidadeDePV')=="N/A" ? 'selected' : ''}}>N/A</option>
                                    
                                </select>

                                @if ($errors->has('estadoDaConformidadeDePV'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estadoDaConformidadeDePV') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                    </div>

                    
                    <!--Segunda coluna-->
                    <div class="form-group col-md-6">
                                                 <!--1-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DATA DE ATRIBUIÇÃO DE CONFORMIDADE DE PV') }}</label>

                            <div class="col-md-8">
                                <input id="dataDeAtribuicaoDeConformidadeDePV" type="date" class="form-control{{ $errors->has('dataDeAtribuicaoDeConformidadeDePV') ? ' is-invalid' : '' }}" name="dataDeAtribuicaoDeConformidadeDePV" value="{{ old('dataDeAtribuicaoDeConformidadeDePV') }}" >
                                

                                @if ($errors->has('dataDeAtribuicaoDeConformidadeDePV'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dataDeAtribuicaoDeConformidadeDePV') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--2-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DATA DA ALTERAÇÃO DA CONFORMIDADE DE PV') }}</label>

                            <div class="col-md-8">
                                <input id="dataDaAltercaoDaConformidadeDePV" type="date" class="form-control{{ $errors->has('dataDaAltercaoDaConformidadeDePV') ? ' is-invalid' : '' }}" name="dataDaAltercaoDaConformidadeDePV" value="{{ old('dataDaAltercaoDaConformidadeDePV') }}" >
                                

                                @if ($errors->has('dataDaAltercaoDaConformidadeDePV'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dataDaAltercaoDaConformidadeDePV') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--3-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('IMPRESSÕES DIGITAIS COINCIDENTES') }}</label>

                            <div class="col-md-8">
                                 <select id="impressoesDigitaisCoincidentes" type="" class="form-control" name="impressoesDigitaisCoincidentes" value="{{ old('impressoesDigitaisCoincidentes') }}" required autofocus>
                                    <option> Seleciona impre...</option>
                                    <option value="NÃO" {{old('impressoesDigitaisCoincidentes')=="NÃO" ? 'selected' : ''}}>NÃO</option>
                                    <option value="SIM"  {{old('impressoesDigitaisCoincidentes')=="SIM" ? 'selected' : ''}}>SIM</option>
                                </select>
                                
                                @if ($errors->has('impressoesDigitaisCoincidentes'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('impressoesDigitaisCoincidentes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--4-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MARCADO PARA REGULARIZAÇÃO') }}</label>

                            <div class="col-md-8">
                                 <select id="marcadoParaRegularizacao" type="" class="form-control" name="marcadoParaRegularizacao" value="{{ old('marcadoParaRegularizacao') }}" required autofocus>
                                    <option> Seleciona marcado para...</option>
                                    <option value="NÃO" {{old('marcadoParaRegularizacao')=="NÃO" ? 'selected' : ''}}>NÃO</option>
                                    <option value="SIM"  {{old('marcadoParaRegularizacao')=="SIM" ? 'selected' : ''}}>SIM</option>
                                </select>
                              

                                @if ($errors->has('marcadoParaRegularizacao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('marcadoParaRegularizacao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--5-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('PROCESSO ADMINISTRATIVO (PA)') }}</label>

                            <div class="col-md-8">
                                <input id="processoAdministrativoPA" type="text" class="form-control{{ $errors->has('processoAdministrativoPA') ? ' is-invalid' : '' }}" name="processoAdministrativoPA" value="{{ old('processoAdministrativoPA') }}" required autofocus>
                               

                                @if ($errors->has('processoAdministrativoPA'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('processoAdministrativoPA') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--6-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('MÊS/ANO DO ÚLTIMO PAGAMENTO') }}</label>

                            <div class="col-md-8">
                                <input id="mesAnoDoUltimoPagamento" type="month" class="form-control{{ $errors->has('mesAnoDoUltimoPagamento') ? ' is-invalid' : '' }}" name="mesAnoDoUltimoPagamento" value="{{ old('mesAnoDoUltimoPagamento') }}" required autofocus>
                             

                                @if ($errors->has('mesAnoDoUltimoPagamento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mesAnoDoUltimoPagamento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--7-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FORMAS DE PROCESSAMENTO') }}</label>

                            <div class="col-md-8">
                                     <select id="formasDeProcessamento" type="" class="form-control" name="formasDeProcessamento" value="{{ old('formasDeProcessamento') }}" required autofocus>
                                    <option> Seleciona forma de processa...</option>
                                    <option value="e-Folha" {{old('formasDeProcessamento')=="e-Folha" ? 'selected' : ''}}>e-Folha</option>
                                    <option value="SNV" {{old('formasDeProcessamento')=="SNV" ? 'selected' : ''}}>SNV</option>
                                    <option value="SPAV" {{old('formasDeProcessamento')=="SPAV" ? 'selected' : ''}}>SPAV</option>
                                    <option value="SPS" {{old('formasDeProcessamento')=="SPS" ? 'selected' : ''}}>SPS</option>
                                    <option value="N/A" {{old('formasDeProcessamento')=="N/A" ? 'selected' : ''}}>N/A</option>
                                    
                                </select>

                                @if ($errors->has('formasDeProcessamento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('formasDeProcessamento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--8-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('SALÁRIO BRUTO') }}</label>

                            <div class="col-md-8">
                                <input id="salarioBruto" type="number" step="0.01" class="form-control{{ $errors->has('salarioBruto') ? ' is-invalid' : '' }}" name="salarioBruto" value="{{ old('salarioBruto') }}" required autofocus>
                                

                                @if ($errors->has('salarioBruto'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('salarioBruto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--9-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FORMAS DE PAGAMENTO') }}</label>

                            <div class="col-md-8">
                                         
                                <select id="formasDePagamento" type="" class="form-control" name="formasDePagamento" value="{{ old('formasDePagamento') }}" required autofocus>
                                    <option> Seleciona forma de pagament...</option>
                                    <option value="PPS" {{old('formasDePagamento')=="PPS" ? 'selected' : ''}}>PPS</option>
                                    <option value="RDG" {{old('formasDePagamento')=="RDG" ? 'selected' : ''}}>RDG</option>
                                    <option value="RPC" {{old('formasDePagamento')=="RPC" ? 'selected' : ''}}>RPC</option>
                                    <option value="N/A" {{old('formasDePagamento')=="N/A" ? 'selected' : ''}}>N/A</option>
                                    
                                    
                                </select>
                                
                                @if ($errors->has(' formasDePagamento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first(' formasDePagamento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--10-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('SITUAÇÃO DE VINCULAÇÃO DO FAE') }}</label>

                            <div class="col-md-8">
                                    <select id="situacaoDeVinculacaoDoFAE" type="" class="form-control" name="situacaoDeVinculacaoDoFAE" value="{{ old('situacaoDeVinculacaoDoFAE') }}" required autofocus>
                                    <option> Seleciona situação...</option>
                                    <option value="Ativo" {{old('situacaoDeVinculacaoDoFAE')=="Ativo" ? 'selected' : ''}}>Ativo</option>
                                    <option value="Aposentado" {{old('situacaoDeVinculacaoDoFAE')=="Aposentado" ? 'selected' : ''}}>Aposentado</option>
                                    <option value="Demitido" {{old('situacaoDeVinculacaoDoFAE')=="Demitido" ? 'selected' : ''}}>Demitido</option>
                                    <option value="Desligado" {{old('situacaoDeVinculacaoDoFAE')=="Desligado" ? 'selected' : ''}}>Desligado</option>
                                    <option value="Destacado" {{old('situacaoDeVinculacaoDoFAE')=="Destacado" ? 'selected' : ''}}>Destacado</option>
                                    <option value="Em Formação" {{old('situacaoDeVinculacaoDoFAE')=="Em Formação" ? 'selected' : ''}}>Em Formação</option>
                                    <option value="Exonerado" {{old('situacaoDeVinculacaoDoFAE')=="Exonerado" ? 'selected' : ''}}>Exonerado</option>
                                    <option value="Expulso" {{old('situacaoDeVinculacaoDoFAE')=="Expulso" ? 'selected' : ''}}>Expulso</option>
                                    <option value="Falecido" {{old('situacaoDeVinculacaoDoFAE')=="Falecido" ? 'selected' : ''}}>Falecido</option>
                                    <option value="Irregular" {{old('situacaoDeVinculacaoDoFAE')=="Irregular" ? 'selected' : ''}}>Irregular</option>
                                    <option value="Licença por doença" {{old('situacaoDeVinculacaoDoFAE')=="Licença por doença" ? 'selected' : ''}}>Licença por doença</option>
                                    <option value="Rescindido" {{old('situacaoDeVinculacaoDoFAE')=="Rescindido" ? 'selected' : ''}}>Rescindido</option>
                                    <option value="Sob Licença Especial" {{old('situacaoDeVinculacaoDoFAE')=="Sob Licença Especial" ? 'selected' : ''}}>Sob Licença Especial</option>
                                    <option value="Sob Licença Ilimitada" {{old('situacaoDeVinculacaoDoFAE')=="Sob Licença Ilimitada" ? 'selected' : ''}}>Sob Licença Ilimitada</option>
                                    <option value="Sob Licença Registada" {{old('situacaoDeVinculacaoDoFAE')=="Sob Licença Registada" ? 'selected' : ''}}>Sob Licença Registada</option>
                                    <option value="Suspenso" {{old('situacaoDeVinculacaoDoFAE')=="Suspenso" ? 'selected' : ''}}>Suspenso</option>
                                    
                                </select>
                                

                                @if ($errors->has('situacaoDeVinculacaoDoFAE'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('situacaoDeVinculacaoDoFAE') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--11-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ESTADO DA VINCULAÇÃO') }}</label>

                            <div class="col-md-8">         
                                <select id="estadoDaVinculacao" type="" class="form-control" name="estadoDaVinculacao" value="{{ old('estadoDaVinculacao') }}" required autofocus>
                                    <option> Seleciona estado de vincu...</option>
                                    <option value="Activo" {{old('estadoDaVinculacao')=="Activo" ? 'selected' : ''}}>Activo</option>
                                    <option value="Inactivo" {{old('estadoDaVinculacao')=="Inactivo" ? 'selected' : ''}}>Inactivo</option>
                                    
                                    
                                </select>
                                

                                @if ($errors->has('estadoDaVinculacao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estadoDaVinculacao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--12-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CARREIRA') }}</label>

                            <div class="col-md-8">
                                <input id="carreira" type="text" class="form-control{{ $errors->has('carreira') ? ' is-invalid' : '' }}" name="carreira" value="{{ old('carreira') }}" required autofocus>
                                

                                @if ($errors->has('carreira'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('carreira') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--13-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORIA') }}</label>

                            <div class="col-md-8">
                                <input id="categoria" type="text" class="form-control{{ $errors->has('categoria') ? ' is-invalid' : '' }}" name="categoria" value="{{ old('categoria') }}" required autofocus>
                               

                                @if ($errors->has('categoria'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('categoria') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--14-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CLASSE') }}</label>

                            <div class="col-md-8">         
                                <select id="classe" type="" class="form-control" name="classe" value="{{ old('classe') }}" required autofocus>
                                    <option> Seleciona classe...</option>
                                    <option value="A - A" {{old('classe')=="A - A" ? 'selected' : ''}}>A - A</option>
                                    <option value="B - B" {{old('classe')=="B - B" ? 'selected' : ''}}>B - B</option>
                                    <option value="C - C" {{old('classe')=="C - C" ? 'selected' : ''}}>C - C</option>
                                    <option value="E - E" {{old('classe')=="E - E" ? 'selected' : ''}}>E - E</option>
                                    <option value="N/A - N/A" {{old('classe')=="N/A - N/A" ? 'selected' : ''}}>N/A - N/A</option>
                                    <option value="U - Única" {{old('classe')=="U - Única" ? 'selected' : ''}}>U - Única</option>
                                    
                                </select>

                                @if ($errors->has('classe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('classe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--15-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ESCALÃO SALARIAL') }}</label>

                            <div class="col-md-8">
                                <input id="escalaoSalarial" type="text" class="form-control{{ $errors->has('escalaoSalarial') ? ' is-invalid' : '' }}" name="escalaoSalarial" value="{{ old('escalaoSalarial') }}" required autofocus>
                              

                                @if ($errors->has(' escalaoSalarial'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('escalaoSalarial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--16-->



                    </div>







                        <div class="fform-group col-md-6">
                            <div class="col-md-6 offset-md-4">
                               
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
                @else
                Erro: 450->Nao tens permissão
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
