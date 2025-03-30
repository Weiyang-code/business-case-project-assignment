@extends('layouts.app')
@section('title', 'Customer Home Page')

   


@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Rider Status Page</h1>
        
        <!-- Update Section -->
        <div class="mb-3">
            <label for="status" class="form-label">Update Delivery Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Preparing Food" selected>Preparing Food</option>
                <option value="Rider Picked Up">Rider Picked Up</option>
                <option value="Sending Foods">Sending Foods</option>
                <option value="Finished">Finished</option>
            </select>
        </div>
        <button type="button" id="updateStatusButton" class="btn btn-primary">Update Status</button>

        <!-- Visualization Section -->
        <div class="mt-5">
            <h2 class="text-center">Delivery Status Visualization</h2>
	    </br>
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <div class="circle bg-primary text-white" id="circle1">1</div> <!-- Default blue -->
                    <p>Preparing Food</p>
                </div>
                <div class="text-center">
                    <div class="circle bg-secondary text-white" id="circle2">2</div>
                    <p>Rider Picked Up</p>
                </div>
                <div class="text-center">
                    <div class="circle bg-secondary text-white" id="circle3">3</div>
                    <p>Sending Foods</p>
                </div>
                <div class="text-center">
                    <div class="circle bg-secondary text-white" id="circle4">4</div>
                    <p>Finished</p>
                </div>
            </div>
        </div>
    </div>

    

    <style>
        .circle {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            margin: 0 auto;
            font-weight: bold;
        }
        .bg-primary {
            background-color: blue !important;
        }
    </style>

    <script>
        document.getElementById('updateStatusButton').addEventListener('click', function() {
            // Reset all circles to secondary color
            document.querySelectorAll('.circle').forEach(circle => {
                circle.classList.remove('bg-primary');
                circle.classList.add('bg-secondary');
            });

            // Get the selected status
            const selectedStatus = document.getElementById('status').value;

            // Map status to circle IDs
            const statusToCircleMap = {
                'Preparing Food': 'circle1',
                'Rider Picked Up': 'circle2',
                'Sending Foods': 'circle3',
                'Finished': 'circle4'
            };

            // Get the corresponding circle element and update its color
            const selectedCircleId = statusToCircleMap[selectedStatus];
            if (selectedCircleId) {
                document.getElementById(selectedCircleId).classList.remove('bg-secondary');
                document.getElementById(selectedCircleId).classList.add('bg-primary');
            }
        });
    </script>
@endsection


@section('scripts')
@endsection
