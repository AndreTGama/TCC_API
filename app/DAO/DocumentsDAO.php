<?php

namespace App\DAO;

use App\Model\documents;
use Illuminate\Support\Facades\DB;

class DocumentsDAO
{
    /**
     * consultDocuments
     *
     * @param  array $dados
     * @return object
     */
    public function consultDocuments(array $dados) : ?object
    {
        $cpf = $dados['cpf'];
        $cnpj = $dados['cnpj'];

        $queryDocuments = DB::table('documents');
        if($cpf) $queryDocuments->where('cpf', '=', $cpf);
        if($cnpj) $queryDocuments->where('cnpj', '=', $cnpj);
        $queryDocuments = $queryDocuments->first();

        return $queryDocuments;
    }
    /**
     * createDocuments
     *
     * @param  array $dados
     * @return object
     */
    public function createDocuments(array $dados) : object
    {
        $queryDocuments = documents::create($dados);
        return $queryDocuments;
    }
    public function updateDocuments(int $idDocuments, array $dados)
    {
        $queryDocuments = documents::where('id_document', '=', $idDocuments)->update($dados);

        return $queryDocuments;
    }
}
