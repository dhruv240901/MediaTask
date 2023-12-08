<?php

namespace app\Traits;

trait FilterTrait
{
  /* function to check status, order by column and pagination */
  public function Filter($query, $request, $column = 'name', $order = 'ASC')
  {
    if ($request->status!=null) {
      $query->where('is_active', $request->status);
    }

    if ($request->order) {
      $order = $request->order;
    }
    $query->orderBy($column, $order);

    if ($request->limit) {
      $perPage = $request->limit;
    } else {
      $perPage = $request->per_page;
    }

    return $query->paginate($perPage);
  }
}
