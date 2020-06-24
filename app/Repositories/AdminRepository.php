<?php

namespace App\Repositories;
use App\Admin;

class AdminRepository
{
    private $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function retrieve($limit)
    {
        $admins = $this->model->orderBy("id", "DESC")->paginate($limit);
        
        return [
            "row" => $admins->items(),
            "admin_total" => $admins->total()
        ];
    }

    public function retrieveById($id, $limit)
    {
        $loanTotal = 0;

        $admin = $this->model->with(["loans" => function($loans) use(&$loanTotal, &$limit){
            $loanTotal = $loans->count();
            $loans->paginate($limit);
        }])->find($id);

        return [
            "row" => $admin,
            "loan_total" => $loanTotal
        ];
    }

    public function retrieveByUsername($username)
    {
        $admins = $this->model->with("loans")->where("username", $username)->first();
        $data = [
            "row" => $admins,
        ];

        return $data;
    }

    public function add($body)
    {
        $admin = $this->model->create($body);
        
        return [
            "row" => $admin
        ];
    }

    public function update($id, $body)
    {
        $admin = $this->model->find($id);
        $admin->update($body);

        return [
            "row" => $admin
        ];
    }

    public function remove($id)
    {
        $adminTemp = $this->model->find($id);
        $admin = $adminTemp;
        $admin->delete();

        return [
            "row" => $adminTemp
        ];
    }
}