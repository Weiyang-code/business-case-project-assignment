@extends('layouts.app')
@section('title', 'Restaurant Add Food Item Page')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Add this link to import Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: burlywood;"
        }

        .container {
            max-width: 800px;
            margin: auto;
            margin-top: 25px;
            background: antiquewhite;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }


        h2 {
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .food-form .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        select,
        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="date"],
        textarea {
            padding: 12px;
            font-size: 13.5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #f7f8fc;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        select:focus,
        input:focus,
        textarea:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 8px rgba(92, 107, 192, 0.5);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group span {
            padding: 10px 14px;
            background: #eeeeee;
            border: 1px solid #ccc;
            border-right: none;
            border-radius: 6px 0 0 6px;
        }

        .input-group input {
            border-radius: 0 6px 6px 0;
            border-left: none;
            flex: 1;
        }

        .radio-group {
            display: flex;
            gap: 30px;
            align-items: center;
            font-size: 14px;
        }

        .radio-group label {
            font-weight: normal;
        }

        button {
            background-color: #5c6bc0;
            color: white;
            padding: 12px 28px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            align-self: flex-start;
        }

        button:hover {
            background-color: #3f51b5;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(1);
        }

        .no-resize {
            resize: none;
        }

        * {
            user-select: none;
        }

        input,
        textarea,
        select {
            user-select: text;
        }

        .file-upload-wrapper {
            display: flex;
            align-items: center;
            gap: 0;
            flex-wrap: wrap;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 10px 18px;
            background-color: #f1f1f1;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #ccc;
            border-radius: 6px 0 0 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #e2e2e2;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        }

        #file-chosen {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-left: none;
            border-radius: 0 6px 6px 0;
            background-color: #f7f8fc;
            font-size: 14px;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 8px;
        }
    </style>

    <div class="container">
        <h2>Add New Food Item</h2>
        <form class="food-form" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Food Category</label>
                <select name="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="main">Bendo Box</option>
                    <option value="dessert">Dessert</option>
                    <option value="beverage">Beverage</option>
                    <option value="snack">Snack</option>
                </select>
            </div>

            <div class="form-group">
                <label>Food Name</label>
                <input type="text" name="food_name" placeholder="e.g. Spaghetti Carbonara" required />
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="no-resize"
                    placeholder="Brief description of the dish, flavor, ingredients, etc."></textarea>
            </div>

            <div class="form-group">
                <label>Price (in RM)</label>
                <div class="input-group">
                    <span>RM</span>
                    <input type="number" name="price" placeholder="e.g. 12.90" required oninput="validatePrice(this)" />
                </div>
            </div>

            <div class="form-group">
                <label>Availability Start Date</label>
                <input type="date" name="start_date" required />
            </div>

            <div class="form-group">
                <label>Availability End Date</label>
                <input type="date" name="end_date" />
            </div>

            <div class="form-group">
                <label>Food Image</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg" style="display: none;" />

                    <label for="image" class="custom-file-upload">
                        Choose File
                    </label>

                    <span id="file-chosen">No file chosen</span>
                </div>
                <img id="preview-image" src="#" alt="Image Preview"
                    style="display: none; max-width: 30%; margin-top: 15px; border-radius: 8px;" />
            </div>

            <div class="form-group">
                <label>Availability Status</label>
                <div class="radio-group">
                    <label><input type="radio" name="status" value="active" checked style="background-color:transparent;">
                        Active</label>
                    <label><input type="radio" name="status" value="inactive"> Inactive</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Add Food Item</button>
            </div>
        </form>
    </div>

    <script>
        function validatePrice(input) {
            // Remove non-numeric characters
            input.value = input.value.replace(/[^0-9.]/g, '');

            let parts = input.value.split('.');
            if (parts.length > 2) {
                input.value = parts[0] + '.' + parts[1]; 
            }
        }


        const input = document.getElementById("image");
        const fileChosen = document.getElementById("file-chosen");
        const previewImage = document.getElementById("preview-image");

        input.addEventListener("change", function () {
            const file = this.files[0];
            const allowedTypes = ["image/jpeg", "image/png"];

            if (file) {
                if (!allowedTypes.includes(file.type)) {
                    alert("Only JPG and PNG images are allowed!");
                    this.value = "";
                    fileChosen.textContent = "No file chosen";
                    previewImage.style.display = "none";
                    previewImage.src = "#";
                    return;
                }

                fileChosen.textContent = file.name;

                // Image preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = "none";
                previewImage.src = "#";
            }
        });



    </script>


@endsection