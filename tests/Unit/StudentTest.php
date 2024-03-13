<?php
// StudentTest.php
use Tests\TestCase;
use App\Http\Repositories\StudentRepository;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentTest extends TestCase
{
    protected $studentRepository;
    protected $faker;


    public function setUp(): void
    {
        parent::setUp();

        // Create an instance of the StudentRepository
        $this->studentRepository = new StudentRepository();

        // Initialize Faker
        $this->faker = Faker::create();
    }

    public function testCanCreateStudent()
    {

        $data = [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'created_by' => 1,
        ];
        $student = $this->studentRepository->store($data,true);

        
        $this->assertInstanceOf(Student::class, $student);
        $this->assertDatabaseHas('students', ['id' => $student->id]);
        $this->assertDatabaseHas('students', ['username' => $data['username']]);
        $this->assertDatabaseHas('students', ['email' => $data['email']]);
        $this->assertDatabaseHas('students', ['created_by' => $data['created_by']]);
    }

    public function testCanDeleteStudent()
    {
        $student = new Student([
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'created_by' => 1,
        ]);
        $student->save();

        $this->studentRepository->destroy($student->id,true);

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    
}
