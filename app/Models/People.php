<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $guarded = [];
    
    protected static $mockData = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123-456-7890',
            'address' => '123 Main St, New York, NY',
            'created_at' => '2024-01-15T10:30:00Z',
            'updated_at' => '2024-01-15T10:30:00Z'
        ],
        [
            'id' => 2,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '987-654-3210',
            'address' => '456 Oak Ave, Los Angeles, CA',
            'created_at' => '2024-01-16T11:30:00Z',
            'updated_at' => '2024-01-16T11:30:00Z'
        ],
        [
            'id' => 3,
            'name' => 'Robert Johnson',
            'email' => 'robert@example.com',
            'phone' => '555-123-4567',
            'address' => '789 Pine Rd, Chicago, IL',
            'created_at' => '2024-01-17T12:30:00Z',
            'updated_at' => '2024-01-17T12:30:00Z'
        ],
        [
            'id' => 4,
            'name' => 'Emily Davis',
            'email' => 'emily@example.com',
            'phone' => '444-555-6666',
            'address' => '321 Elm St, Houston, TX',
            'created_at' => '2024-01-18T09:15:00Z',
            'updated_at' => '2024-01-18T09:15:00Z'
        ],
        [
            'id' => 5,
            'name' => 'Michael Wilson',
            'email' => 'michael@example.com',
            'phone' => '777-888-9999',
            'address' => '654 Birch Blvd, Phoenix, AZ',
            'created_at' => '2024-01-19T14:45:00Z',
            'updated_at' => '2024-01-19T14:45:00Z'
        ],
        [
            'id' => 6,
            'name' => 'Sarah Brown',
            'email' => 'sarah@example.com',
            'phone' => '111-222-3333',
            'address' => '987 Cedar Ln, Philadelphia, PA',
            'created_at' => '2024-01-20T16:20:00Z',
            'updated_at' => '2024-01-20T16:20:00Z'
        ],
        [
            'id' => 7,
            'name' => 'David Miller',
            'email' => 'david@example.com',
            'phone' => '999-888-7777',
            'address' => '147 Maple Dr, San Antonio, TX',
            'created_at' => '2024-01-21T08:10:00Z',
            'updated_at' => '2024-01-21T08:10:00Z'
        ],
        [
            'id' => 8,
            'name' => 'Lisa Taylor',
            'email' => 'lisa@example.com',
            'phone' => '666-777-8888',
            'address' => '258 Walnut Way, San Diego, CA',
            'created_at' => '2024-01-22T13:25:00Z',
            'updated_at' => '2024-01-22T13:25:00Z'
        ],
        [
            'id' => 9,
            'name' => 'Thomas Anderson',
            'email' => 'thomas@example.com',
            'phone' => '333-444-5555',
            'address' => '369 Spruce Ct, Dallas, TX',
            'created_at' => '2024-01-23T17:40:00Z',
            'updated_at' => '2024-01-23T17:40:00Z'
        ],
        [
            'id' => 10,
            'name' => 'Jennifer White',
            'email' => 'jennifer@example.com',
            'phone' => '222-333-4444',
            'address' => '741 Ash St, San Jose, CA',
            'created_at' => '2024-01-24T10:50:00Z',
            'updated_at' => '2024-01-24T10:50:00Z'
        ]
    ];

    public static function all($columns = ['*'])
    {
        $data = collect(self::$mockData);
        
        return $data->map(function ($item) {
            return new static($item);
        });
    }

    public static function find($id)
    {
        $data = collect(self::$mockData);
        $personData = $data->firstWhere('id', $id);
        
        if ($personData) {
            return new static($personData);
        }
        
        return null;
    }

    public static function paginate($perPage = 10, $page = 1)
    {
        $data = collect(self::$mockData);
        $total = $data->count();
        $lastPage = ceil($total / $perPage);
        
        $items = $data->forPage($page, $perPage)
            ->map(function ($item) {
                return new static($item);
            });

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}