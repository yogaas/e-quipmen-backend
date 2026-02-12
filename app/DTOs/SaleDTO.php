<?php

namespace App\DTOs;

class SaleDTO
{
    public function __construct(
        public string $unique_code, 
        public int $owner_id, 
        public readonly int $section_id, 
        public readonly int $customer_id, 
        public readonly string $date_created, 
        public readonly string $time_created, 
        public readonly float $sub_total, 
        public readonly float $percen_ppn, 
        public readonly float $percen_discount, 
        public readonly float $price_ppn, 
        public readonly float $price_discount, 
        public readonly float $total_price, 
        public readonly int $status_paymen, 
        public readonly int $status_cancel, 
        public readonly int $status_jurnal, 
        public readonly int $status_closebook, 
        public readonly string $user_create, 
        public readonly array $details
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['unique_code'] ?? "",
            $data['owner_id'] ?? 0,
            $data['section_id'],
            $data['customer_id'],
            $data['date_created'],
            $data['time_created'],
            $data['sub_total'],
            $data['percen_ppn'],
            $data['percen_discount'],
            $data['price_ppn'],
            $data['price_discount'],
            $data['total_price'],
            $data['status_paymen'] ?? 0,
            $data['status_cancel'] ?? 0,
            $data['status_jurnal'] ?? 0,
            $data['status_closebook'] ?? 0,
            $data['user_create']  ?? 0,
            array_map(
                fn ($item) => SaleDetailDTO::fromArray($item),
                $data['details']
            )
        );
    }

    public function toArray(): array
    {
        return ([
            'unique_code'     => $this->unique_code ?? "",
            'owner_id'     => $this->owner_id,
            'section_id'     => $this->section_id,
            'customer_id'     => $this->customer_id,
            'date_created'     => $this->date_created,
            'time_created'     => $this->time_created,
            'sub_total'     => $this->sub_total,
            'percen_ppn'     => $this->percen_ppn,
            'percen_discount'     => $this->percen_discount,
            'price_ppn'     => $this->price_ppn,
            'price_discount'     => $this->price_discount,
            'total_price'     => $this->total_price,
            'status_paymen'     => $this->status_paymen,
            'status_cancel'     => $this->status_cancel,
            'status_jurnal'     => $this->status_jurnal,
            'status_closebook'     => $this->status_closebook,
            'user_create'     => $this->user_create,
            'details'       => array_map(
                fn ($item) => SaleDetailDTO::fromArray($item),
                $this->details
            )
        ]);
    }

    public function toArrayPost(): array
    {
        return ([
            'unique_code'     => $this->unique_code ?? "",
            'owner_id'     => $this->owner_id,
            'section_id'     => $this->section_id,
            'customer_id'     => $this->customer_id,
            'date_created'     => $this->date_created,
            'time_created'     => $this->time_created,
            'sub_total'     => $this->sub_total,
            'percen_ppn'     => $this->percen_ppn,
            'percen_discount'     => $this->percen_discount,
            'price_ppn'     => $this->price_ppn,
            'price_discount'     => $this->price_discount,
            'total_price'     => $this->total_price,
            'status_paymen'     => $this->status_paymen,
            'status_cancel'     => $this->status_cancel,
            'status_jurnal'     => $this->status_jurnal,
            'status_closebook'     => $this->status_closebook,
            'user_create'     => $this->user_create,
        ]);
    }
}