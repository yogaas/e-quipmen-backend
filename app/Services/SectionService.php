<?php

namespace App\Services;

use App\Models\Section;
use App\DTOs\SectionDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\SectionRepositoryInterface;

class SectionService
{
    public function __construct(
        protected SectionRepositoryInterface $repo
    ) {}

    public function list(array $params) : array
    {
        return $this->repo->paginate($params);
    }

    public function create(SectionDTO $dto)
    {
            return $this->repo->create($dto->toArray());
    }

    public function find(int $id)
    {
        $section = $this->repo->findById($id);
        if (!$section) {
            throw new \RuntimeException('Section not found');
        }
        return $section;
    }

    public function update(int $id, SectionDTO $dto)
    {
        $section = $this->repo->findById($id);
        if (!$section) {
            throw new \RuntimeException('Section not found');
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $section = $this->repo->findById($id);
        if (!$section) {
            throw new \RuntimeException('Section not found');
        }
        
        $this->repo->delete($id);
    }
}