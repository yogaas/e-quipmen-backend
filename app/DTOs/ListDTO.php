<?php

namespace App\DTOs;

class ListDTO
{
    public function __construct(
        public readonly mixed $data,
        public readonly int $totalCount,
        public readonly int $pageSize,
        public readonly int $pageIndex,
        public readonly string $sortOrder,
        public readonly string $orderByFieldName,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['data'],
            $data['totalCount'],
            $data['pageSize'],
            $data['pageIndex'], 
            $data['sortOrder'],
            $data['orderByFieldName'], 
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'data'              => $this->data,
            'totalCount'        => $this->totalCount,
            'pageSize'          => $this->pageSize,
            'pageIndex'         => $this->pageIndex,
            'sortOrder'         => $this->sortOrder,
            'orderByFieldName'  => $this->orderByFieldName,
        ]);
    }
}