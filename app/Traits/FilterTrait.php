<?php

namespace app\Traits;

trait FilterTrait
{
  /* function to check status, order by column and pagination */
  public function Filter($query, $request, $perPage, $column = 'name', $order = 'ASC')
  {
    if ($request->status != null) {
      $query->where('is_active', $request->status);
    }

    if ($request->order != null) {
      $order = $request->order;
    }
    $query->orderBy($column, $order);


    if ($request->limit != null) {
      $perPage = $request->limit;
    }

    return $query->paginate($perPage);
  }
}
