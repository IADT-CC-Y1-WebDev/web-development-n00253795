<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';
//SAME PATTERN AS BOOK STORE AGAIN
startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];
    
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'id' => $_POST['id'] ?? null,
        'title' => $_POST['title'] ?? null,
        'release_date' => $_POST['release_date'] ?? null,
        'genre_id' => $_POST['genre_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'platform_ids' => $_POST['platform_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    // Define validation rules
    $rules = [
        'id' => 'required|integer',
        'title' => 'required|notempty|min:1|max:255',
        'release_date' => 'required|notempty',
        'genre_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'platform_ids' => 'required|array|min:1|max:10',
        'image' => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880' // optional -- no required rule
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // Find existing game
    $game = Game::findById($data['id']);
    if (!$game) {
        throw new Exception('Game not found.');
    }

    // Verify genre exists
    $genre = Genre::findById($data['genre_id']);
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }

    // Verify platforms exist
    foreach ($data['platform_ids'] as $platformId) {
        if (!Platform::findById($platformId)) {
            throw new Exception('One or more selected platforms do not exist.');
        }
    }

    // Process the uploaded image (validation already completed)
    $coverFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('cover')) {
        // Delete old image
        $uploader->deleteImage($book->cover_filename);
        // Process new image
        $coverFilename = $uploader->process($_FILES['cover']);
        // Check for processing errors
        if (!$coverFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    // Update the game instance  //just paste from book store 
    $game->title = $data['title'];
    $game->release_date = $data['release_date'];
    $game->genre_id = $data['genre_id'];
    $game->description = $data['description'];
    if ($coverFilename) {
        $book->cover_filename = $coverFilename;
    }

    // Save to database
    $game->save();

    // Delete existing platform associations
    GamePlatform::deleteByGame($game->id);
    // Create new platform associations
    if (!empty($data['platform_ids']) && is_array($data['platform_ids'])) {
        foreach ($data['platform_ids'] as $platformId) {
            GamePlatform::create($game->id, $platformId);
        }
    }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Game updated successfully.');

    // Redirect to game details page
    redirect('game_view.php?id=' . $game->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if ($coverFilename) {
        $uploader->deleteImage($coverFilename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to edit page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('book_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}
