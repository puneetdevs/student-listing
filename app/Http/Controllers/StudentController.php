<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\StudentRepository;

class StudentController extends Controller
{
    public StudentRepository $studentRepo;
    
    public function __construct(StudentRepository $repo) {
       $this->studentRepo = $repo;
    }

    public function index() {
        return $this->studentRepo->index();
    }

    public function add() {
        return $this->studentRepo->add();
    }

    public function store(Request $request) {
        return $this->studentRepo->store($request);
    }

    public function destroy($id) {
        return $this->studentRepo->destroy($id);
    }
 
}
