<?php

class LessonsTest extends ApiTester {

	/** @test **/
	public function it_fetches_lessons()
	{
        $this->times(3)->create('App\Lesson');

        $lessons = $this->requestJson('/api/v1/lessons')->data;

        $this->assertResponseOk();

        $this->assertCount(3, $lessons);
	}

    /** @test **/
    public function it_fetches_a_single_lesson()
    {
        $this->times(3)->create('App\Lesson');

        $lesson = $this->requestJson('/api/v1/lessons/2');

        $this->assertResponseOk();

        $this->assertObjectHasAttributes($lesson->data, ['title', 'body', 'visible']);
    }
    
    /** @test **/
    public function it_creates_new_lesson_given_valid_parameters()
    {
        $this->requestJson('/api/v1/lessons', 'POST', $this->getStub());

        $this->assertResponseStatus(201);
    }

    /** @test **/
    public function it_returns_404_in_case_of_lesson_not_found()
    {
        // TODO: add user for basic auth

        $error = $this->requestJson('/api/v1/lessons/not-exist')->error;

        $this->assertResponseStatus(404);

        $this->assertObjectHasAttribute('message', $error);
    }

    public function getStub()
    {
        return [
            'title' => $this->faker->sentence(5),
            'body' => $this->faker->paragraph(3),
            'some_bool' => $this->faker->boolean()
        ];
    }
}
