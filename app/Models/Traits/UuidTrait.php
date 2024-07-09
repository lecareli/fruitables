<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    /**
     * Define o método estático 'booted'. Este método é chamado automaticamente
     * pelo Laravel quando o modelo é inicializado.
    */
    public static function booted()
    {
        /**
         * Registra um 'callback' para o evento 'creating' do modelo.
         * Esse evento é disparado antes de um novo registro ser criado no banco de dados.
         * A função anônima recebe o modelo que está sendo criado como parâmetro.
        */
        static::creating(function($model){
            /**
             * Verifica se o valor da chave primária está vazia.
             * '$model->getKeyName', retorna o nome da chave primária do modelo (por padrão, geralmente é 'id').
            */
            if(empty($model->{$model->getKeyName()})){
                /**
                 * Se a chave estiver vazia, gera um UUID usando 'Str::uuid()' e o converte para string.
                 * Define o valor da chave primária do modelo para o UUID gerado.
                */
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
