<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Resources\TodoItemResource;

class TodoItemController extends Controller
{
    public function index()
    {
        $todo_items = TodoItem::where('user_id', Auth::id())->with('memos')->get();
        $success['todo_items'] = TodoItemResource::collection($todo_items);

        return $this->sendResponse($success, 'Todo items fetched successfully!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        $todo_item = TodoItem::create($request->all());

        $success['todo_item'] = new TodoItemResource($todo_item);

        return $this->sendResponse($success, 'Todo item added successfully!');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        $todo_item = TodoItem::find($id)->update($request->all());

        $success['todo_item'] = new TodoItemResource($todo_item);

        return $this->sendResponse($success, 'Todo item updated successfully!');
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        $todo_item = TodoItem::find($id)->delete();

        $success['todo_item'] = new TodoItemResource($todo_item);

        return $this->sendResponse($success, 'Todo item deleted successfully!');
    }
}
