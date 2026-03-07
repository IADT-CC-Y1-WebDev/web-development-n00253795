<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

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

    // Get form data  //DO SAME PATTERN HERE AND NAMES MATCH
    $data = [ 
        'title' => $_POST['title'] ?? null,
        'release_date' => $_POST['release_date'] ?? null,
        'genre_id' => $_POST['genre_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'platform_ids' => $_POST['platform_ids'] ?? [],
        'cover' => $_FILES['cover'] ?? null
    ];

    // Define validation rules
    $year = date("Y");
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty|min:1|max:255',
        'publisher_id' => 'required|notempty|integer',
        'year' => 'required|notempty|integer|minvalue:1900|maxvalue:' . $year,
        'isbn' => 'required|notempty|min:13|max:13',
        'format_ids' => 'required|notempty|array|min:1|max:4',
        'description' => 'required|notempty|min:10|max:1000',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
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

    // All validation passed - now process and save
    // Verify genre exists
    $genre = Genre::findById($data['genre_id']); //publisher instead of genre
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }

    // Process the uploaded image (validation already completed)
    $uploader = new ImageUpload();
    $cover_filename = $uploader->process($_FILES['cover']); 

    if (!$cover_filename) {
        throw new Exception('Failed to process and save the image.');
    }

    // Create new game instance //change all games to books //same pattern aswell
    $game = new Game();
    $game->title = $data['title'];
    $game->release_date = $data['release_date'];
    $game->genre_id = $data['genre_id'];
    $game->description = $data['description'];
    $game->image_filename = $imageFilename;

    // Save to database
    $game->save();
    // Create platform associations //change platform to formats
    if (!empty($data['formats_id']) && is_array($data['platform_ids'])) {
        foreach ($data['platform_ids'] as $platformId) {
            // Verify platform exists before creating relationship
            if (Platform::findById($platformId)) {
                GamePlatform::create($game->id, $platformId);
            }
        }
    }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Book stored successfully.');

    // Redirect to book details page
    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if (isset($cover_filename) && $cover_filename) {
        $uploader->deleteImage($cover_filename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    redirect('book_create.php');
}
