<?php

namespace LiZhineng\NovaRelationSearch;

trait HandleRelationSearch
{
    protected static function applySearch($query, $search)
    {
        return static::applyRelationSearch(parent::applySearch($query, $search), $search);
    }

    protected static function applyRelationSearch($query, $search)
    {
        foreach (static::searchableRelationColumns() as $relation => $searchableColumns) {
            $query->orWhereHas($relation, function ($query) use ($searchableColumns, $search) {
                static::buildSearchQuery($query, $search, $searchableColumns);
            });
        }

        return $query;
    }

    protected static function searchableRelationColumns()
    {
        return empty(static::$relationSearch)
            ? []
            : static::$relationSearch;
    }

    protected static function buildSearchQuery($query, $search, $columns)
    {
        return $query->where(function ($query) use ($search, $columns) {
            $model = $query->getModel();

            $connectionType = $query->getModel()->getConnection()->getDriverName();

            $canSearchPrimaryKey = is_numeric($search) &&
                in_array($query->getModel()->getKeyType(), ['int', 'integer']) &&
                ($connectionType != 'pgsql' || $search <= PHP_INT_MAX) &&
                in_array($query->getModel()->getKeyName(), $columns);

            if ($canSearchPrimaryKey) {
                $query->orWhere($query->getModel()->getQualifiedKeyName(), $search);
            }

            $likeOperator = $connectionType == 'pgsql' ? 'ilike' : 'like';

            foreach ($columns as $column) {
                $query->orWhere($model->qualifyColumn($column), $likeOperator, '%'.$search.'%');
            }
        });
    }
}