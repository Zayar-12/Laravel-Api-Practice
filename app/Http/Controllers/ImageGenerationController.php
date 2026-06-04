<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePromptRequest;
use Illuminate\Http\Request;

class ImageGenerationController extends Controller
{
    public function index(){

    }

   public function store(GeneratePromptRequest $request)
{
    $user = $request->user();
    $image = $request->file('image');

    $originalName = $image->getClientOriginalName();
    $sanitizedName = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
    $extension = $image->getClientOriginalExtension();
    $safeFilename = $sanitizedName . '_' . time() . '.' . $extension;

    $imagePath = $image->storeAs('uploads/images', $safeFilename, 'public');
}
}
