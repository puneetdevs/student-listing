<?php 

namespace App\Http\Repositories;
use Inertia\Inertia;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use App\Rules\AlphaNumeric;


class StudentRepository {

    public function index()
    {
        $users = Student::where('created_by',auth()->user()->id)->select('id','username','email')->get();

        $fields  = [
            'username','email','Action'
        ];

       return Inertia::render('Student/List',['users'=>$users,'fields' => $fields,'addStudentLink'=>route('student.add')]);
    }

    public function add() {
        return Inertia::render('Student/Add',['addRoute'=>route('student.store')]);
    }

    public function store($request,$isTest=false) 
    {
        // Validation rules
        $rules = [
            'username' => ['required','min:3','unique:students', new AlphaNumeric()], 
            'email' => 'required|email|unique:students'
        ];
    
        // Custom error messages
        $messages = [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least :min characters long.',
            'username.unique' => 'Username is already taken.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email is already taken.'
        ];
    
        // Validate the request
        $request1  = $isTest ? $request : $request->all();

        $validator = Validator::make($request1, $rules, $messages);
    
        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
    
        try {
            $request  = $isTest ? (object)$request : $request;
            // Create student record
            $student = Student::create([
                'username' => $request->username,
                'email' => $request->email,
                'created_by' => !$isTest ? auth()->user()->id : $request->created_by
            ]);
    
            if ( $isTest ) {
                return $student;
            }

            return response()->json([
                'status' => true,
                'redirect' => route('student.list'),
                'message' => 'Student created successfully.'
            ]);
        } catch (Exception $e) {
            // Return error message in case of exception
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id,$isTest=false)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:students,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $student = Student::where('id', $id)->delete();
            
            if ( $isTest )
              return $id;

            return response()->json([
                'status' => true,
                'redirect' => route('student.list'),
                'message' => 'Student deleted successfully.'
            ]);
        } catch(Exception $e) {
            // Handle any exceptions
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
}
