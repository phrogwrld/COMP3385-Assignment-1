<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin | Create Researcher</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="bg-black min-h-screen flex flex-col">
    <div class="fixed flex h-16 w-full text-white p-4 justify-between items-center">
      <a class="flex items-center" href="/400007969/index.php">
        <img class="w-8 h-8" src="./img/logo.svg" alt="logo_here"> ACompany Research
      </a>
      <form id="logoutForm" action="logout.php" method="POST">
        <input type="hidden" name="logout" value="1">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Logout</button>
      </form>
    </div>

    <div class="container flex-1 flex flex-col mx-auto max-w-4xl p-5 text-white justify-center items-center">
      <div class="grid grid-cols-1 w-full my-8">
        <div class="flex flex-row justify-between">
          <div class="flex flex-col">
            <p class="font-bold"><?php echo $role->value; ?>: </p><span id="researcher"><?php echo $username; ?></span>
          </div>
          <div class="flex flex-col">
            <p class="font-bold">Email: </p><span id="researcher-email"><?php echo $email; ?></span>
          </div>
        </div>
      </div>

      <hr class="my-3 w-full border-gray-500 opacity-10">

      <form method="POST" action="/400007969/createResearcher.php" class="flex flex-col mx-auto w-[422px]"> 
        <div class="flex flex-auto mb-7 justify-end">
          <label class="flex pr-2 min-w-[95px] font-semibold items-center">Username: </label>
          <div class="flex flex-col w-full relative">
            <input class="flex-1 h-10 py-2 px-3 rounded-lg text-black w-full border border-blue-100 focus:border-blue-200 focus:ring focus:outline-none" name="username" />
          </div>
        </div>

        <div class="flex flex-auto mb-7 justify-end">
          <label class="flex pr-2 min-w-[95px] font-semibold items-center">Email: </label>
          <div class="flex flex-col w-full relative">
            <input class="flex-1 h-10 py-2 px-3 rounded-lg text-black w-full border border-blue-100 focus:border-blue-200 focus:ring focus:outline-none" name="email" />
          </div>
        </div>

        <div class="flex flex-auto mb-7 justify-end">
          <label class="flex pr-2 min-w-[95px] font-semibold items-center">Password: </label>
          <div class="flex flex-col w-full relative">
            <input class="flex-1 h-10 py-2 px-3 rounded-lg text-black w-full border border-blue-100 focus:border-blue-200 focus:ring focus:outline-none" name="password" />
          </div>
        </div>

        <div class="flex flex-auto mb-7 justify-end">
          <label class="flex pr-2 min-w-[95px] font-semibold items-center">Role: </label>
          <div class="flex flex-col w-full relative">
            <select class="flex-1 h-10 py-2 px-3 rounded-lg text-black w-full border border-blue-100 focus:border-blue-200 focus:ring focus:outline-none" name="role">
              <?php // Set options as all roles from enum
                foreach ($options as $option) {
                  echo '<option value="' . $option . '">' . $option . '</option>';
                } 
              ?>
            </select>
            <?php
              $errors = $_GET['errors'] ?? [];
              $success = $_GET['success'] ?? '';

              if (!empty($errors)) {
                echo '<span class="text-red-500">' . implode('<br>', $errors) . '</span>';
              }

              if (!empty($success)) {
                echo '<span class="text-green-500">' . $success . '</span>';
              }
            ?>
          </div>
        </div>

        <div class="flex justify-between">
        <a href="/400007969/index.php" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
              Back To Dashboard
          </a>
          <button name="register" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg" value="Submit">
            Submit
          </button>
        </div>
      </form>
    </div>
    <footer class="flex border-t border-gray-500 bg-gray-600/50 justify-center items-center">
      <p class="text-sm text-gray-500 py-2">
        © Copyright 2023 Aaron Harris. All Rights Reserved
      </p>
    </footer>
  </div>
</body>

</html>