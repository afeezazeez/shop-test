<?php

namespace Tests\Feature\FileUpload;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_upload_form()
    {
        $user= \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/upload');

        $response->assertSuccessful();
        $response->assertViewIs('upload');
    }

    // not working
//    public function test_authenticated_user_can_upload_image(){
//        $user= \App\Models\User::factory()->create();
//
//        $name = 'html.png';
//        $path = 'C:\Users\Pc\Desktop\chilling\CodeWorld\Web Development projects\Laravel projects\Main Projects\Web based projects\shop-test\tests\images/' . $name;
//        $file = new UploadedFile($path, $name, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);
//
//        // Params contains any post parameters
//        $params = [];
//        $response =  $this->actingAs($user)->call('POST', '/upload', $params, [], ['upload' => $file]);
//        $response->assertSessionHas('success', 'Image uploaded to repository successfully');
//        //$response->assertRedirect('/upload');
//    }
}
