@extends('layouts.app')

@section('title', 'Rider Status Page')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Rider Status Page</h1>

        <!-- Visualization Section -->
        <div class="mt-4">
            <h2 class="text-center">Delivery Status Visualization</h2>
            <div class="status-container d-flex justify-content-between">
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
        <div class="text-center mt-4">
            <button type="button" id="updateStatusButton" class="btn btn-primary">Update Status</button>
        </div>

        <!-- View Receipt Button (Hidden Initially) -->
        <div class="text-center mt-3">
            <button id="viewReceiptButton" class="btn btn-success" style="display: none;">View Receipt</button>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .status-container {
            margin-top: 30px;
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
            background-color: gray; /* Default color */
        }

        .active {
            background-color: blue !important;
        }
    </style>
@endsection

@section('scripts')
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
            window.location.href = '{{ route("commission") }}'; // Update with actual Laravel route name
        });
    </script>
@endsection
