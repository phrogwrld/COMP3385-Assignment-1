<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="bg-black min-h-screen flex flex-col">
    <div class="fixed flex h-16 w-full text-white p-4 justify-between items-center">
      <a class="flex items-center" href="/">
        <img class="w-8 h-8" src="" alt="logo_here">
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

      <div class="grid grid-cols-1 sm:grid-cols-2 mt-5 w-full gap-10 mx-auto justify-center">
       <?php // Show different options based on the user's role
        foreach ($options[$role->value] as $option => $url) {
          echo '<a href="/400007969' . $url . '"> ';
          echo '<div class="flex flex-col rounded-md border border-gray-500 bg-gray-600/50 cursor-pointer p-10">' .
            $option .
            '</div>';
          echo '</a>';
        } 
       ?>
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