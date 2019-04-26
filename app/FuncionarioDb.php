<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncionarioDb extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'funcionario';

    protected $fillable = [
        'idfuncionario', 'nuit', 'nome', 'dataDeNascimento','codigoOrganico','descricaoDoOrganico','tipoDeQuadro','tipoDeContrato','dataDoFimDeContrato','estadoDeConformidadeDaVinculacao','tipoDeCadastro','dataDeCadastro','motivoDeCadastro','vinculacaoPrincipal','tipoDeProvaDeVida','dataDeRealizacaoDaProvaDeVida','estadoDaConformidadeDePV','dataDeAtribuicaoDeConformidadeDePV','dataDaAltercaoDaConformidadeDePV','impressoesDigitaisCoincidentes','marcadoParaRegularizacao','processoAdministrativoPA','mesAnoDoUltimoPagamento','formasDeProcessamento','formasDePagamento','situacaoDeVinculacaoDoFAE','estadoDaVinculacao','carreira','categoria','classe','escalaoSalarial','nib','salarioBruto','fk_user_id',
    ];
}
