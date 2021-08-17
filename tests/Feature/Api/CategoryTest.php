<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    protected $endpoint = '/categories';
    /**
     * get all categories.
     *
     * @return void
     */
    public function test_get_all_categories()
    {
        Category::factory()->count(6)->create();

        $response = $this->getJson($this->endpoint);

        $response->assertJsonCount(6, 'data');
        $response->assertStatus(200);
    }

    /**
     * error get a category.
     *
     * @return void
     */
    public function test_error_get_single_category()
    {
        $category = 'fake-url';

        $response = $this->getJson("{$this->endpoint}/{$category}");

        $response->assertStatus(404);
    }

    /**
     * get a category.
     *
     * @return void
     */
    public function test_get_single_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("{$this->endpoint}/{$category->url}");

        $response->assertStatus(200);
    }

    /**
     * error create a category.
     *
     * @return void
     */
    public function test_error_create_category()
    {
        $response = $this->postJson($this->endpoint, [
           'title' => '',
            'description' => ''
        ]);

        $response->assertStatus(422);
    }

    /**
     * create a category.
     *
     * @return void
     */
    public function test_create_category()
    {
        $response = $this->postJson($this->endpoint, [
           'title' => 'Category 01',
            'description' => 'description of category'
        ]);

        $response->assertStatus(201);
    }

    /**
     * update a category.
     *
     * @return void
     */
    public function test_update_category()
    {
        $category = Category::factory()->create();

        $data = [
            'title' => 'Title update',
            'description' => 'description update'
        ];

        $response = $this->putJson("$this->endpoint/fake-category", $data);
        $response->assertStatus(404);

        $response = $this->putJson("$this->endpoint/{$category->url}", []);
        $response->assertStatus(422);

        $response = $this->putJson("$this->endpoint/{$category->url}", $data);
        $response->assertStatus(200);
    }

    /**
     * delete a category.
     *
     * @return void
     */
    public function test_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("$this->endpoint/{$category->url}");
        $response->assertStatus(204);
    }
}
