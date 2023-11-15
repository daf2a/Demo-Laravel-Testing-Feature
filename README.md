<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup

1. Clone this repository
    ```
    git clone https://github.com/daf2a/Demo-Laravel-Testing-Feature.git
    ```
2. Run `composer install` at directory project
3. Copy `.env.example` to `.env`
4. Run `php artisan migrate`
5. Run `php artisan key:generate`
6. Run `php artisan serve`

## Testing Feature

1. Make Feature Test and Unit Test
    ```
    php artisan make:test NoteTest
    php artisan make:test NoteUnitTest --unit
    ```
2. Update NoteTest Feature with this code
    ```
    <?php

    namespace Tests\Feature;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use App\Models\Note;
    use App\Models\User;

    class NoteTest extends TestCase
    {
        use RefreshDatabase;
        protected $user; 
        
        protected function setUp(): void
        {
            parent::setUp();
            $this->user = User::factory()->create();
        }

        protected function tearDown(): void
        {
            parent::tearDown();
            unset($this->user);
        }

        /** 
        * @test
        * @group test1
        */
        public function a_note_can_be_created()
        {
            $this->withoutExceptionHandling();
            $response = $this->actingAs($this->user)->post('/notes', [
                'note' => 'Test Note'
            ]);

            $response->assertRedirect('/notes');
            $this->assertCount(1, Note::all());
        }

        /** 
        * @test
        * @group test1
        */
        public function a_note_can_be_updated()
        {
            $this->withoutExceptionHandling();
            $this->actingAs($this->user)->post('/notes', [
                'note' => 'Test Note'
            ]);

            $note = Note::first();

            $response = $this->actingAs($this->user)->put('/notes/' . $note->id, [
                'note' => 'Updated Note'
            ]);

            $response->assertRedirect('/notes/' . $note->id);
            $this->assertEquals('Updated Note', Note::first()->note);
        }

        /** 
        * @test
        * @group test2
        */
        public function a_note_can_be_deleted()
        {
            $this->withoutExceptionHandling();
            $this->actingAs($this->user)->post('/notes', [
                'note' => 'Test Note'
            ]);

            $note = Note::first();

            $response = $this->actingAs($this->user)->delete('/notes/' . $note->id);

            $response->assertRedirect('/notes');
            $this->assertCount(0, Note::all());
        }
    }

    ```
3. Update Note Unit Test with this code
    ```
    <?php

    namespace Tests\Unit;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use App\Models\Note;

    class NoteUnitTest extends TestCase
    {
        use RefreshDatabase; 

        /** @test */
        public function it_can_create_a_note()
        {
            $noteData = [
                'note' => 'This is a test note.'
            ];

            $note = Note::create($noteData);

            $this->assertInstanceOf(Note::class, $note);
            $this->assertEquals($noteData['note'], $note->note);
        }

        /** @test */
        public function it_requires_note_field()
        {
            // Example Fail
            // $note = Note::create(['note' => null]);
            // $this->assertNull($note);

            // Example Pass
            $note = Note::create(['note' => 'is not null']);
            $this->assertNotNull($note);
        }
    }
    ```
4. Run `php artisan test` for testing