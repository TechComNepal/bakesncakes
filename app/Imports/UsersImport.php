<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable,SkipsErrors;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row['role']=='admin') {
                $role='admin';
            } elseif ($row['role']=='employee') {
                $role='vendor';
            } elseif ($row['role']=='user') {
                $role='user';
            }

            $user= User::create([
                'name'=>$row['name'],
                'username'=>$row['username'],
                'email'=>$row['email'],
                'password'=>Hash::make('password'),
                'phone'=>$row['phone'],
                'city'=>$row['city'],
                'address'=>$row['address'],
            ]);
            $user->assignRole($role??null);
        }
    }
    public function rules(): array
    {
        return[
            '*.name'=>['required','unique:users,name'],
            '*.username'=>['required','unique:users,username'],
            '*.email' => ['required','email','unique:users,email'],
            '*.phone'=>['required'],
            '*.city'=>['required'],
            '*.address'=>['required'],
            '*.role'=>['required','exists:roles,name'],

        ];
    }
}
