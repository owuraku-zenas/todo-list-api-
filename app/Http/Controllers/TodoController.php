<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request) {

        try {
            $message = [];
            $category = Category::where('category', $request->category)->first();
            
            if(!$category) {
                $category = Category::create([
                    'category'=> $request->category,
                    'created_by' => $request->user()->id,
                ]);
                array_push($message, 'Category \''. $request->category . '\' created successfully!');
            }

            error_log(json_encode($category));

            $todo = Todo::create([
                'todo' => $request->todo,
                'created_by' => $request->user()->id,
                'category_id' => $category->id,
            ]);
            array_push($message, 'Todo \''. $request->todo . '\' created successfully!');

            return response()->json([
                'status_code' => 200,
                'message' => $message,
            ]);

        } catch (Exception $errors) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error Occured in Adding Todo',
                'error' => $errors,
            ]);
        }

    }
}
