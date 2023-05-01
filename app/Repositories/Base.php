<?php

namespace App\Repositories;


use App\Util\Trait\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Base {

    use ApiResponse;

    /**
     * Nome da model
     *
     * @var $model
     */
    protected $model;

    /**
     * Realiza a criação do dado dentro da banco
     *
     * @author Dereck Silva
     * @since 30/0/2023
     * @param array $input
     * @return Collection|HttpResponseException
     */
    public function create(array $input): Collection|HttpResponseException {

        DB::beginTransaction();

        try {

            $table = app('App\Models\\' . $this->model);
            collect($input)->map(function($data, $key) use ($table) {

                /* Realiza a inserção dos dados com base no nome da model do repositório */
                $table->fill([
                    $key => $data
                ]);
            });

            $table->save();
            DB::commit();

            return $table;

        } catch (HttpResponseException $error) {
            DB::rollBack();

            $this->httpException($error->getMessage(), [], 500);
        }

    }
}
