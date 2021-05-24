<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Memo;
use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TodoItemResource;
use  Illuminate\Support\Facades\Validator;

class TodoItemController extends Controller
{
    public function index()
    {
        $todo_items = TodoItem::where('user_id', Auth::id())->with('memos')->get();
        $success['todo_items'] = TodoItemResource::collection($todo_items);

        return $this->sendResponse($success, 'Todo items fetched successfully!');
    }

    public function getDayItems(Request $request)
    {
        $todo_items = TodoItem::where('user_id', Auth::id())
                        ->where('date', Carbon::parse($request->date))
                        ->with('memos')
                        ->orderBy('created_at', 'desc')
                        ->get();
        $success['todo_items'] = TodoItemResource::collection($todo_items);

        return $this->sendResponse($success, 'Todo items fetched successfully!');
    }

    public function getWeekItems(Request $request)
    {
        $from = Carbon::parse($request->startDate);
        $to = Carbon::parse($request->endDate);

        $todo_items = TodoItem::where('user_id', Auth::id())
                        ->select( DB::raw('DAYNAME(todo_items.date) as day'), 'todo_items.*')
                        ->whereBetween('date', [$from, $to])
                        ->with('memos')
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->groupBy('day');

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

        $todo_item = TodoItem::create([
            'name' => $request->input('name'),
            'date' => Carbon::parse($request->input('date')),
            'user_id' => Auth::id(),
        ]);

        $success['created'] = new TodoItemResource($todo_item);

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
