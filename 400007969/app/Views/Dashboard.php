<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="bg-black min-h-screen flex flex-col">
    <div class="fixed flex h-16 w-full text-white p-4 justify-between items-center">
      <a class="flex items-center" href="/">
        <img class="w-8 h-8" src="" alt="logo_here">
      </a>
      <div>
        <p>logout</p>
      </div>
    </div>

    <div class="container flex-1 flex flex-col mx-auto max-w-4xl p-5 text-white justify-center items-center">
      <div class="grid grid-cols-1 w-full my-8">
        <div class="flex flex-row justify-between">
          <div class="flex flex-col">
            <p class="font-bold">Researcher: </p><span id="researcher"></span>
          </div>
          <div class="flex flex-col">
            <p class="font-bold">Email: </p><span id="researcher-email"></span>
          </div>
        </div>
      </div>

      <hr class="my-3 w-full border-gray-500 opacity-10">

      <div class="grid grid-cols-1 sm:grid-cols-2 mt-5 w-full gap-10 mx-auto justify-center">
        <div class="flex flex-col rounded-md border border-gray-500 bg-gray-600/50 cursor-pointer p-10">
          Create New Study
        </div>
        <div class="flex flex-col rounded-md border border-gray-500 bg-gray-600/50 cursor-pointer p-10">
          View All Studies
        </div>
        <div class="flex flex-col rounded-md border border-gray-500 bg-gray-600/50 cursor-pointer p-10">
          Delete Previous Study
        </div>
        <div class="flex flex-col rounded-md border border-gray-500 bg-gray-600/50 cursor-pointer p-10">
          Create New Researchers
        </div>
      </div>
    </div>
    <footer class="flex border-t border-gray-500 bg-gray-600/50 justify-center items-center">
      <p class="text-sm text-gray-500 py-2">
        © Copyright 2023 Aaron Harris. All Rights Reserved
      </p>
    </footer>
  </div>
</body>

</html>