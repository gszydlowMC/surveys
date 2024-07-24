<?php

namespace App\Repositories;

use App\Libs\Components\XlsGenerator;
use DB;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;

abstract class BaseRepository extends Builder
{
    /**
     * @var Model
     */
    protected $model = null;
    protected $select2Term = null;

    public function __construct()
    {
        parent::__construct(new QueryBuilder(
            app(ConnectionInterface::class),
            new MySqlGrammar()
        ));

        if (!empty($this->model)) {
            $this->setModel(new $this->model);
        }

        $this->select2Term = request()->get('term', null);

    }

    public function newQuery()
    {
        $this->setModel(new $this->model);

        return $this;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function setWhereFilters($query, $searchColumns = [], $aliases = [])
    {
        if (!empty($searchColumns)) {
            foreach ($searchColumns as $searchColumn => $searchColumnValue) {
                if (is_array($searchColumnValue)) {
                    $query->whereIn($searchColumn, $searchColumnValue);
                } else {
                    if (is_numeric($searchColumnValue) && preg_match('/id/', $aliases[$searchColumn] ?? $searchColumn)) {
                        $query->where(DB::Raw(($aliases[$searchColumn] ?? $searchColumn) . ""), '=', $searchColumnValue);
                    }
                    $query->where(DB::Raw("UPPER(CAST(" . ($aliases[$searchColumn] ?? $searchColumn) . " AS CHAR))"), 'like', DB::Raw("'%" . mb_strtoupper($searchColumnValue, 'utf-8') . "%'"));
                }
            }
        }
        return $query;
    }

    public function setOrdersAngPaginate($query, $input, $aliases = [], $customOrders = [], $stringColumns = [])
    {
        $limit = $input['limit'] ?? 0;
        $page = $input['page'] ?? 1;
        $total = $query->count();
        if (!empty($input['orders'] ?? [])) {
            foreach ($input['orders'] as $column => $orderType) {
                if (in_array($column, $stringColumns)) {
                    $query->orderByRaw("LOWER(" . ($customOrders[$column] ?? $aliases[$column] ?? $column) . ") {$orderType}");
                } else {
                    $query->orderByRaw(($customOrders[$column] ?? $aliases[$column] ?? $column) . "  {$orderType}");
                }
            }
        }
        if ($page > 1) {
            $offset = ($page - 1) * $limit;
            $query->offset($offset);
        }
        if ($limit > 0) {
            $query->limit($limit);
        }

        return [$query, $total];
    }

    public function setPaginateResponse($items, $total, $input)
    {
        $count = count($items);
        $total = (int)nextIfEmpty($total, $count);
        $perPage = (int)($input['limit'] ?? $count);
        $perPage = nextIfEmpty($perPage, 50);

        $totalPages = ceil($total / $perPage);
        return [
            'data' => (array)$items,
            'pagination' => [
                'total' => $total,
                'perPage' => $perPage,
                'totalPages' => $totalPages,
                'currentPage' => $input['page'] ?? 1,
                'search' => $input['search'] ?? [],
                'orders' => $input['orders'] ?? []
            ]
        ];
    }
}
