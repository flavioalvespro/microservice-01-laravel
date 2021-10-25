<?php

namespace App\Services;

use App\Models\Company;

class CompanyService 
{
    private $repository;

    public function __construct(Company $company)
    {
        $this->repository = $company;    
    }

    public function getCompanies(string $filter = '')
    {
        return $this->repository->getCompanies($filter);
    }

    public function createNewCompany(array $data)
    {
        return $this->repository->create($data);
    }

    public function getCompanyByUuid(string $uuid = '')
    {
        return $this->repository->where('uuid', $uuid)->firstOrFail();
    }

    public function deleteCompany(string $uuid = '')
    {
        $company = $this->getCompanyByUuid($uuid);

        return $company->delete();
    }

    public function updateCompany(string $uuid = '', array $data)
    {
        $company = $this->getCompanyByUuid($uuid);

        return $company->update($data);
    }
}