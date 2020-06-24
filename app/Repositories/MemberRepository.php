<?php

namespace App\Repositories;
use App\Member;

class MemberRepository 
{
    private $model;

    public function __construct(Member $model){
        $this->model = $model;
    }

    public function retrieve($limit)
    {
        $members = $this->model->orderBy("id", "DESC")->paginate($limit);

        return [
            "row" => $members->items(),
            "member_total" => $members->total()
        ];
    }

    public function retrieveById($id, $limit)
    {
        $loanTotal = 0;
        $member = $this->model->with(["loans" => function($loans) use (&$loanTotal, &$limit){
            $loanTotal = $loans->count();
            $loans->paginate();
        }]);

        return [
            "row" => $member,
            "loan_total" => $loanTotal
        ];
    }

    public function add($body)
    {
        $member = $this->model->create($body);

        return [
            "row" => $member
        ];
    }

    public function update($id, $body)
    {
        $member = $this->model->find($id);
        $member->update($id);

        return [
            "row" => $member
        ];
    }

    public function remove($id)
    {
        $memberTemp = $this->model->find($id);
        $member = $memberTemp;
        $member->delete($id);

        return [
            "row" => $memberTemp
        ];
    }
}