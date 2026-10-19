<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetQuestionResource;
use App\Http\Resources\Admin\GetQuestionsResource;
use App\Models\Division;
use App\Models\Question;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $questions = Question::with(['division', 'section'])->orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $questions = $questions->where('question', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('option')) {
            $questions = $questions->where('option', '=', $request->option);
        }
        $questions = $questions->paginate(12)->withQueryString();
        return GetQuestionsResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'question' => 'required|string',
            'type' => 'required|in:Checklist,Text',
            'division' => 'required|exists:divisions,id',
            'part' => 'nullable|in:A,B,C,D,E,F,G,H',
            'section' => 'nullable|exists:sections,id'
        ], [
            'required' => ':attribute is required',
            'string' => 'Format input must be string',
            'type.in' => 'Only Checklist or Text',
            'part.in' => 'Only A until H part available',
            'exists' => ':attribute ID does not exists'
        ])->validate();
        $division = Division::where('id', '=', $valid['division'])->first();
        $part = null;
        if ($division->name === 'Security') {
            if ($valid['section']) {
                $section = Section::where('id', '=', $valid['section'])->first();
                if ($section->incident == 1) {
                    if ($valid['part']) {
                        $part = $valid['part'];
                    } else {
                        return response()->json(['message' => 'Part is required'], 422);
                    }
                }
            } else {
                return response()->json(['message' => 'Section is required'], 422);
            }
        }
        DB::beginTransaction();
        try {
            $question = Question::create([
                'question' => $valid['question'],
                'type' => $valid['type'],
                'division_id' => $division->id,
                'part' => $part,
            ]);
            if ($division->name == 'Security') {
                $question->section()->create([
                    'section_id' => $valid['section']
                ]);
            }
            $question->load('division', 'section');
            DB::commit();
            return new GetQuestionResource($question);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'new question',
                'file' => 'Controller : api/SuperAdmin/QuestionController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'question' => 'required|string',
            'type' => 'required|in:Checklist,Text',
            'division' => 'required|exists:divisions,id',
            'part' => 'nullable|in:A,B,C,D,E,F,G,H',
            'section' => 'nullable|exists:sections,id'
        ], [
            'required' => ':attribute is required',
            'string' => 'Format input must be string',
            'type.in' => 'Only Checklist or Text',
            'part.in' => 'Only A until H part available',
            'exists' => ':attribute ID does not exists'
        ])->validate();
        $question = Question::where('id', '=', $id)->first();
        if (!$question) {
            return response()->json(['message' => 'Question ID not found'], 404);
        }
        $division = Division::where('id', '=', $valid['division'])->first();
        $part = null;
        if ($division->name === 'Security') {
            if ($valid['section']) {
                $section = Section::where('id', '=', $valid['section'])->first();
                if ($section->incident == 1) {
                    if ($valid['part']) {
                        $part = $valid['part'];
                    } else {
                        return response()->json(['message' => 'Part is required'], 422);
                    }
                }
            } else {
                return response()->json(['message' => 'Section is required'], 422);
            }
        }
        DB::beginTransaction();
        try {
            $question->update([
                'question' => $valid['question'],
                'type' => $valid['type'],
                'division_id' => $division->id,
                'part' => $part,
            ]);
            if ($division->name === 'Security') {
                $question->section()->updateOrCreate(
                    [],
                    [
                        'section_id' => $valid['section'],
                    ]
                );
            } else {
                $question->section()->delete();
            }
            DB::commit();
            return response()->json(['data' => 'Success update question']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update question',
                'file' => 'Controller : api/SuperAdmin/QuestionController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = Question::where('id', '=', $id)->first();
        if (!$question) {
            return response()->json(['message' => 'Question ID not found'], 404);
        }
        $question->delete();
        return response()->json(['data' => 'Success delete question']);
    }
}
