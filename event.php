<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Toggle</title>
    <style>
        /* Add some basic styling for the modal */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
        }

        /* Add some basic styling for the modal */
        #confirmationModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        #confirmationModal .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-footer {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <button class="status-toggle">Toggle Status</button>

    <div id="confirmationModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to change the status to <span id="newStatus"></span>?</p>
            <div class="modal-footer">
                <button id="cancelButton">Cancel</button>
                <button id="confirmButton">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.querySelector('.status-toggle');
            const modal = document.getElementById('confirmationModal');
            const closeBtn = document.getElementsByClassName('close')[0];
            const cancelButton = document.getElementById('cancelButton');
            const confirmButton = document.getElementById('confirmButton');
            const newStatusText = document.getElementById('newStatus');
            let currentStatus = 'Unverified'; // Initial status
            let newStatus; // Variable to store the new status

            button.textContent = currentStatus; // Set initial status text on button

            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default action

                // Toggle status
                newStatus = currentStatus === 'Verified' ? 'Unverified' : 'Verified';
                console.log(newStatus);
                newStatusText.textContent = newStatus; // Update status text in modal
                modal.style.display = 'block';
            });

            closeBtn.onclick = function() {
                modal.style.display = 'none';
            }

            cancelButton.onclick = function() {
                modal.style.display = 'none';
            }

            confirmButton.onclick = function() {
                // Perform the status change here
                console.log(`Changing status to ${newStatus}`);
                button.textContent = newStatus; // Update status text on button
                currentStatus = newStatus; // Update current status
                // Example: Submit a form or make an AJAX call
                // For demonstration purposes, we close the modal
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>
