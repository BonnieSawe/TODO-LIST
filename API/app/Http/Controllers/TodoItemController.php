<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Memo;
use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MemoResource;
use App\Http\Resources\TodoItemResource;
use  Illuminate\Support\Facades\Validator;
use App\Http\Resources\WeekTodoItemResource;
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
                        ->with('memo')
                        ->where('pinned', false)
                        ->orWhere('pinned', null)
                        ->where('date', Carbon::parse($request->date))
                        ->orderBy('created_at', 'desc')
                        ->get();

        $pinned_items = TodoItem::where('user_id', Auth::id())
                        ->where('date', Carbon::parse($request->date))
                        ->with('memo')
                        ->where('pinned', true)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $success['pinned_items'] = TodoItemResource::collection($pinned_items);

        $success['todo_items'] = TodoItemResource::collection($todo_items);

        return $this->sendResponse($success, 'Todo items fetched successfully!');
    }

    public function getWeekItems(Request $request)
    {
        $from = Carbon::parse($request->startDate);
        $to = Carbon::parse($request->endDate);

        $days = TodoItem::where('user_id', Auth::id())
                        ->select( DB::raw('DAYNAME(todo_items.date) as day'), 'todo_items.*')
                        ->whereBetween('date', [$from, $to])
                        ->with('memo')
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->groupBy('day');

        $formatted_days = collect();
        
        $i = 0;
        foreach ($days as $key => $day_items) {
            $new_day = new \StdClass();
            $new_day->index = $i++;
            $new_day->day_name = $key;
            $new_day->todo_items = TodoItemResource::collection($day_items);
            $formatted_days->push($new_day);
        }

        $success['days'] = $formatted_days;

        return $this->sendResponse($success, 'Todo items fetched successfully!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'date' => 'required|date',
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

    public function pinItem(Request $request)
    {
        $item = TodoItem::find($request->input('todoId'));

        $item->update([
            'pinned' => $request->input('isPinned') ? true : false
        ]);

        $message = $item->pinned ? 'pinned' : 'unpinned';

        $success['pinned'] = new TodoItemResource($item);

        return $this->sendResponse($success, 'Todo item '.$message.' successfully!');
    }

    public function completeItem(Request $request)
    {
        $item = TodoItem::find($request->input('todoId'));

        $item->update([
            'completed' => $request->input('isChecked') ? true : false
        ]);

        $success['completed'] = new TodoItemResource($item);

        return $this->sendResponse($success, 'Todo item completed successfully!');
    }

    public function addMemo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'todo_item_id' => 'required|integer',
            'name' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        if ($memo = Memo::find($request->input('memoId'))) {
            $memo->update([
                'name' => $request->input('name'),
            ]);
        }else {
            $memo = Memo::create([
                'name' => $request->input('name'),
                'todo_item_id' => $request->input('todo_item_id'),
            ]);
        }


        $success['created'] = new MemoResource($memo);

        return $this->sendResponse($success, 'Memo added successfully!');
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
        info($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        $todo_item = TodoItem::find($request->input('id'));

        $success['deleted'] = new \stdClass();

        if ($todo_item) {
            $todo_item->delete();
            $success['deleted'] = new TodoItemResource($todo_item);
        }


        return $this->sendResponse($success, 'Todo item deleted successfully!');
    }
}
