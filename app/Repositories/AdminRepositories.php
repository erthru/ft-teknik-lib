<?php

namespace App\Repositories;
use App\Admin;

class AdminRepositories
{
    private $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function retrieve($limit)
    {
        $admins = $this->model->orderBy("id", "DESC")->paginate($limit);
        $data = [
            "row" => $admins->items(),
            "admin_total" => $admins->total()
        ];

        return $data;
    }

    public function retrieveById($id, $limit)
    {
        $loanTotal = 0;

        $admins = $this->model->with(["loans" => function($loans) use(&$loanTotal, &$limit){
            $loanTotal = $loans->count();
            $loans->paginate($limit);
        }])->find($id);

        $data = [
            "row" => $admins,
            "loan_total" => $loanTotal
        ];

        return $data;
    }

    public function retrieveByUsername($username, $limit)
    {
        $admins = $this->model->with("loans")->where("username", $username);
        $data = [
            "row" => $admins,
        ];

        return $data;
    }

    public function add($body)
    {
        $admin = $model->create($body);
        $data = [
            "row" => $admin
        ];

        return $data;
    }

    public function update($id, $body)
    {
        $admin = $model->find($id);
        $admin->update($body);

        $data = [
            "row" => $admin
        ];

        return $data;
    }

    public function remove($id)
    {
        $adminTemp = $model->find($id);
        $admin = $model->find($id);
        $admin->delete();

        $data = [
            "row" => $adminTemp
        ];

        return $data;
    }
}