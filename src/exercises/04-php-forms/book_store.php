<?php
/**
 * User Registration Handler - Exercise
 *
 * Follow the steps below to progressively implement form handling.
 * Each step corresponds to an example in /examples/04-php-forms/
 *
 * This file processes the form submission from book_create.php
 */


// =============================================================================
// Write your code here
// =============================================================================
// Include the required library files
require_once './lib/config.php';
require_once './lib/session.php';
require_once './lib/forms.php';
require_once './lib/utils.php';

$data = [];
$errors = [];

// Start the session
startSession();

try {
    // =========================================================================
    // STEP 1: View Posted Data
    // See: /examples/04-php-forms/step-01-form-submission/
    // =========================================================================
    // TODO: First, just dump the posted data to see what's submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        dd($_POST); // <-- Exercise 1: This is exactly what Step 1 asks
    } else {
        throw new Exception('Invalid request method.');
    }
 
    // =========================================================================
    // STEP 2: Check Request Method
    // See: /examples/04-php-forms/step-02-request-method/
    // =========================================================================
    // TODO: Check that the request method is POST
      if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

   

    // =========================================================================
    // STEP 3: Extract Data
    // See: /examples/04-php-forms/step-03-data-extraction/
    // =========================================================================
    // TODO: Extract form data into $data array
    // Use the null coalescing operator (??) to provide default values

    $data = [
    'title' => $_POST['title'] ?? null,
    'price' => $_POST['price'] ?? null,
    'description' => $_POST['description'] ?? null,
    'format_ids' => $_POST['format_ids'] ?? [],
    'cover' => $_FILES['cover'] ?? null
];
    //
    // Hint: The format_ids field uses an array (format_ids[]) because multiple
    // checkboxes can be selected. This is already handled in the $data 
    // extraction:
    // 'format_ids' => $_POST['format_ids'] ?? []

        try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method.');
        }

        // Extract form data into an associative array
        // The ?? operator provides a default value if the key doesn't exist
        $data = [
            'title' => $_POST['title'] ?? null,
            'price' => $_POST['price'] ?? null,
            'description' => $_POST['description'] ?? null
        ];

        // Now we can work with $data instead of $_POST
        dd($data);
    }
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


    // =========================================================================
    // STEP 4: Validate Data
    // See: /examples/04-php-forms/step-04-validation/
    // =========================================================================
    // TODO: Define validation rules for each field
    // TODO: Check validation data against the rules
    // Create validator and check if validation fails; if so, store the first 
    // error for each field in the $errors array and throw an exception
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:2097152'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // =========================================================================
    // STEP 9: File Uploads
    // See: /examples/04-php-forms/step-09-file-uploads/
    // =========================================================================
    // TODO: Extract file from $_FILES
    // Hint: Add to $data extraction:
    // 'cover' => $_FILES['cover'] ?? null
        if ($data['cover'] && $data['cover']['error'] === UPLOAD_ERR_OK) {
        $uploader = new ImageUpload();
        try {
            $data['cover_filename'] = $uploader->process($data['cover']);
        } catch (Exception $e) {
            $errors['cover'] = $e->getMessage();
            throw new Exception('File upload failed.');
        }
    } else {
        $errors['cover'] = 'Cover file is required.';
        throw new Exception('File upload failed.');
    }
    //
    // TODO: Add validation for the cover:
    // Hint: Add to $rules
    // 'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:2097152'  // 2MB = 2 * 1024 * 1024
$rules['cover'] = 'required|file|image|mimes:jpg,jpeg,png|max_file_size:2097152';
    //
    // TODO: Process file upload
    // If there is an upload error, add to an error to the $errors array and 
    // throw an exception
    // Hint: Use the ImageUpload class to handle the upload

if ($data['cover'] && $data['cover']['error'] === UPLOAD_ERR_OK) {
    $uploader = new ImageUpload();
    $data['cover_filename'] = $uploader->process($data['cover']);
} else {
    $errors['cover'] = 'Error uploading cover image.';
    throw new Exception('File upload failed.');
}

    // =========================================================================
    // STEP 10: Complete Handler
    // See: /examples/04-php-forms/step-10-complete/
    // =========================================================================
    // TODO: Clear form data on success (before redirect)
    clearFormData();
    clearFormErrors();
    setFlashMessage('success', 'Product created successfully!');
    redirect('product_create.php');

} catch (Exception $e) {

    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On successful registration, set a success flash message and 
    // redirect back to the form
}
catch (Exception $e) {
    // =========================================================================
    // STEP 5: Store Errors and Redirect
    // See: /examples/04-php-forms/step-05-display-errors/
    // =========================================================================
    // TODO: In the catch block, store validation errors in the session
    // TODO: Redirect back to the form

    if (!empty($errors)) {
        setFormErrors($errors);
    }
    setFormData($data);


    // =========================================================================
    // STEP 6: Store Form Data for Repopulation
    // See: /examples/04-php-forms/step-06-repopulate-fields/
    // =========================================================================
    // TODO: Before redirecting on error, also store the form data

setFormData($data);
    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On validation error, you set an error flash message

        setFlashMessage('error', 'Error: ' . $e->getMessage());

    redirect('product_create.php');

}
