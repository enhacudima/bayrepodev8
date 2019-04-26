<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarionovoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nuit'=>'required|numeric|min:9|unique:funcionario',
            'nome'=>'required|string|min:9|max:255|unique:funcionario',
            'dataDeNascimento'=>'required|string|max:255',
            'codigoOrganico'=>'required|string|max:255',
            'descricaoDoOrganico'=>'required|string|max:255',
            'tipoDeQuadro'=>'required|string|max:255',
            'tipoDeContrato'=>'required|string|max:255',
            'dataDoFimDeContrato'=>'max:255',
            'estadoDeConformidadeDaVinculacao'=>'required|string|max:255',
            'tipoDeCadastro'=>'required|string|max:255',
            'dataDeCadastro'=>'required|string|max:255',
            'motivoDeCadastro'=>'required|string|max:255',
            'vinculacaoPrincipal'=>'required|string|max:255',
            'tipoDeProvaDeVida'=>'required|string|max:255',
            'dataDeRealizacaoDaProvaDeVida'=>'string|max:255',
            'estadoDaConformidadeDePV'=>'required|string|max:255',
            'dataDeAtribuicaoDeConformidadeDePV'=>'max:255',
            'dataDaAltercaoDaConformidadeDePV'=>'max:255',
            'impressoesDigitaisCoincidentes'=>'required|string|max:255',
            'marcadoParaRegularizacao'=>'required|string|max:255',
            'processoAdministrativoPA'=>'required|string|max:255',
            'mesAnoDoUltimoPagamento'=>'required|string|max:255',
            'formasDeProcessamento'=>'required|string|max:255',
            'formasDePagamento'=>'required|string|max:255',
            'situacaoDeVinculacaoDoFAE'=>'required|string|max:255',
            'estadoDaVinculacao'=>'required|string|max:255',
            'carreira'=>'required|string|max:255',
            'categoria'=>'required|string|max:255',
            'classe'=>'required|string|max:255',
            'escalaoSalarial'=>'required|string|max:255',
            'salarioBruto'=>'required|regex:/^\d*(\.\d{2})?$/',
            'fk_user_id'=>'required',
        ];
    }
}
