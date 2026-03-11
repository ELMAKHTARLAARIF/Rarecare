<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ChatGPT Laravel</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 flex flex-col">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Chat With AI</h2>

    <!-- Chat Messages -->
    <div id="response" class="flex-1 overflow-y-auto border rounded-lg p-4 mb-4 h-64 bg-gray-50 space-y-2">
      <!-- Messages will appear here -->
    </div>

    <!-- Input Area -->
    <div class="flex gap-2">
      <input id="message" type="text" placeholder="Type your message..."
             class="flex-1 border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
      <button onclick="sendMessage()"
              class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        Send
      </button>
    </div>
  </div>

  <script>
    function sendMessage() {
      let messageInput = document.getElementById('message');
      let message = messageInput.value.trim();
      if (!message) return;

      // Add user message to chat
      let responseDiv = document.getElementById('response');
      let userBubble = document.createElement('div');
      userBubble.className = "text-right";
      userBubble.innerHTML = `<span class="inline-block bg-blue-100 text-blue-800 p-2 rounded-lg max-w-xs">${message}</span>`;
      responseDiv.appendChild(userBubble);

      // Scroll to bottom
      responseDiv.scrollTop = responseDiv.scrollHeight;

      messageInput.value = '';

      fetch('/chatgpt', {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({message: message})
      })
      .then(res => res.json())
      .then(data => {
        let aiBubble = document.createElement('div');
        aiBubble.className = "text-left";
        aiBubble.innerHTML = `<span class="inline-block bg-gray-200 text-gray-800 p-2 rounded-lg max-w-xs">${data}</span>`;
        responseDiv.appendChild(aiBubble);
        responseDiv.scrollTop = responseDiv.scrollHeight;
      })
      .catch(err => {
        let errorBubble = document.createElement('div');
        errorBubble.className = "text-left text-red-600";
        errorBubble.textContent = "Error: " + err;
        responseDiv.appendChild(errorBubble);
      });
    }
  </script>

</body>
</html>