<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TableCheckController extends Controller
{
    public function checkTable($tableName)
    {
        if (Schema::hasTable($tableName)) {
            return response()->json(['message' => "Table '{$tableName}' exists."]);
        } else {
            return response()->json(['message' => "Table '{$tableName}' does not exist."]);
        }
    }
}

