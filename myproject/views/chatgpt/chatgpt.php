<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with ChatGPT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .message {
            margin-bottom: 10px;
            clear: both;
            overflow: auto;
        }
        .sent .card {
            background-color: #d9edf7;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            float: right;
        }
        .received .card {
            background-color: #337ab7;
            color: #fff;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            float: left;
        }
        .card-body {
            padding: 10px;
        }
        .card-footer {
            border-top: none;
        }
        .input-group {
            margin-bottom: 0;
        }
        .btn-primary {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Chat with ChatGPT
        </div>
        <div class="card-body" id="messageContainer" style="height: 300px; overflow-y: scroll;">
            <div class="message sent">
                <div class="card">
                    <div class="card-body">
                      
                    </div>
                </div>
            </div>
            
            <!-- More messages here -->
        </div>
        <div class="card-footer">
            <div class="input-group">
                <input type="text" id="messageInput" class="form-control" placeholder="Type your message...">
                <button class="btn btn-primary" onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let conversation = "";

    function sendMessage() {
        var message = document.getElementById('messageInput').value;
        if (message.trim() === '') {
            return;
        }
        conversation += "user" + message;

        // Clear input field
        document.getElementById('messageInput').value = '';

        // Add the sent message to the message container on the right side
        var messageContainer = document.getElementById('messageContainer');
        var messageDiv = document.createElement('div');
        messageDiv.classList.add('message', 'sent');
        var messageCard = document.createElement('div');
        messageCard.classList.add('card');
        var messageCardBody = document.createElement('div');
        messageCardBody.classList.add('card-body');
        messageCardBody.innerText = message;
        messageCard.appendChild(messageCardBody);
        messageDiv.appendChild(messageCard);
        messageContainer.appendChild(messageDiv);

        // Scroll to bottom
        messageContainer.scrollTop = messageContainer.scrollHeight;

        // Send message via AJAX
        $.ajax({
            type: "POST",
            url: "/myproject/chatgpt/message",
            data: { message: conversation },
            success: function(response) {
                // Add the received message to the message container on the left side
                var receivedMessageDiv = document.createElement('div');
                receivedMessageDiv.classList.add('message', 'received');
                var receivedMessageCard = document.createElement('div');
                receivedMessageCard.classList.add('card');
                var receivedMessageCardBody = document.createElement('div');
                receivedMessageCardBody.classList.add('card-body');
                receivedMessageCardBody.innerText = response;
                receivedMessageCard.appendChild(receivedMessageCardBody);
                receivedMessageDiv.appendChild(receivedMessageCard);
                messageContainer.appendChild(receivedMessageDiv);

                // Scroll to bottom
                messageContainer.scrollTop = messageContainer.scrollHeight;
                conversation += "AI" + response;
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
</body>
</html>
