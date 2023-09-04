<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Database\Query\Builder;
use App\Models\User;

class UsersExport implements FromQuery, WithHeadings
{
    public function query(): Builder
    {
        return User::query()
        ->select('id', 'name', 'email', 'created_at') // Select the desired columns
        ->orderBy('name', 'asc'); // Sort by 'name' column in ascending order
    }

    public function headings():array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Created At'
        ];
    }
}
