<?php

namespace App\Repositories;
use App\Item;

class ItemRepository 
{
    private $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    public function retrieve($limit)
    {
        $items = $this->model->orderBy("id", "DESC")->paginate($limit);
        
        return [
            "row" => $items->items(),
            "item_total" => $items->total()
        ];
    }

    public function retrieveById($id, $limit)
    {
        $loanTotal = 0;

        $item = $this->model->with(["loan" => function ($loans) use (&$loanTotal, &$limit) {
            $loanTotal = $loans->count();
            $loans->paginate($limit);
        }])->find($id);

        return [
            "row" => $item,
            "loan_total" => $loanTotal
        ];
    }

    public function add($body)
    {
        $item = $this->model->create($body);
        
        return [
            "row" => $item
        ];
    }

    public function update($id, $body)
    {
        $item = $this->model->find($id);
        $item->update($body);

        return [
            "row" => $item
        ];
    }

    public function remove($id)
    {
        $itemTemp = $this->model->find($id);
        $item = $itemTemp;
        $item->delete($id);

        return [
            "row" => $itemTemp
        ];
    }
}