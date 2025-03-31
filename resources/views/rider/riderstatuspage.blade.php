@extends('layouts.app')

@section('title', 'Rider Status Page')

@section('content')
    <style>

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .circle {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-weight: bold;
            color: white;
            margin: 0 auto;
            background-color: gray; /* Default color */
        }

        .active {
            background-color: blue !important;
        }

        #viewReceiptButton {
            display: none; /* Initially hidden */
            margin-top: 20px;
        }

        .status-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
    </style>

    <div class="container">
        <h1>Rider Status Page</h1>

        <!-- Visualization Section -->
        <div class="mt-4">
            <h2>Delivery Status Visualization</h2>
            <div class="status-container">
                <div class="text-center">
                    <div class="circle active" id="circle1">1</div>
                    <p>Preparing Food</p>
                </div>
                <div class="text-center">
                    <div class="circle" id="circle2">2</div>
                    <p>Rider Picked Up</p>
                </div>
                <div class="text-center">
                    <div class="circle" id="circle3">3</div>
                    <p>Sending Foods</p>
                </div>
                <div class="text-center">
                    <div class="circle" id="circle4">4</div>
                    <p>Finished</p>
                </div>
            </div>
        </div>

        <!-- Update Status Button -->
        <button type="button" id="updateStatusButton" class="btn btn-primary mt-4">Update Status</button>

        <!-- View Receipt Button (Hidden Initially) -->
        <button id="viewReceiptButton" class="btn btn-success">View Receipt</button>
    </div>

    <script>
        let currentStep = 1; // Track the current step

        document.getElementById('updateStatusButton').addEventListener('click', function() {
            if (currentStep < 4) {
                // Remove active class from all circles
                document.querySelectorAll('.circle').forEach(circle => {
                    circle.classList.remove('active');
                });

                // Move to the next step
                currentStep++;

                // Highlight the new active step
                document.getElementById('circle' + currentStep).classList.add('active');

                // Show "View Receipt" button if Finished
                if (currentStep === 4) {
                    document.getElementById('viewReceiptButton').style.display = 'block';
                    document.getElementById('updateStatusButton').disabled = true; // Disable button at last step
                }
            }
        });

        // Redirect to commission page when "View Receipt" button is clicked
        document.getElementById('viewReceiptButton').addEventListener('click', function() {
            window.location.href = 'commission.html'; // Update with actual commission page URL
        });
    </script>

@endsection
