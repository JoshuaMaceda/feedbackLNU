<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Teacher Evaluation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Simple Tailwind CDN for styling; optional -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="text-center">
    <h1 class="text-3xl font-bold mb-6">Welcome to the Teacher Evaluation System</h1>
    <a 
      href="{{ route('evaluation.create', ['teacher' => $teacherId]) }}" 
      class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded"
    >
      Start Evaluation
    </a>
  </div>
</body>
</html>
