<?php

namespace App\Repositories;
use App\Loan;

class LoanRepository
{
    private $model;

    public function __construct(Loan $model)
    {
        $this->model = $model;
    }

    public function retrieve($limit)
    {
        $loans = $this->model->with("admin")->with("item")->with("member")->orderBy("id", "DESC")->paginate($limit);

        return [
            "row" => $loans->items(),
            "loan_total" => $loans->total()
        ];
    }

    public function retrieveById($id)
    {
        $loan = $this->model->with("admin")->with("item")->with("member")->find($id);

        return [
            "row" => $loan
        ];
    }

    public function add($body)
    {
        $loan = $this->model->create($body);

        return [
            "row" => $loan
        ];
    }

    public function update($id, $body)
    {
        $loan = $this->model->find($id);
        $loan->update($body);

        return [
            "row" => $loan
        ];
    }

    public function remove($id)
    {
        $loanTemp = $this->model->find($id);
        $loan = $loanTemp;
        $loan->delete($id);

        return [
            "row" => $loan
        ];
    }
}