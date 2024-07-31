<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable =['name','contact_number','email','d_o_b','address'];
    // public function model(array $row)
    // {
    //     return new Employee([
    //         'name' => $row[0],
    //         'contact_number' => $row[1],
    //         'email' => $row[2],
    //         'd_o_b' => $row[3],
    //         'address' => $row[4],
    //     ]);
    // }
}
