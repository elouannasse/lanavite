<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="bg-gray-100">

  <!-- Main container -->
  <div class="flex">
    <!-- Sidebar -->
    <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000 p-2 w-[300px] overflow-y-auto text-center bg-gray-900 shadow h-screen">
      <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center rounded-md">
          <i class="bi bi-app-indicator px-2 py-1 bg-blue-600 rounded-md"></i>
          <h1 class="text-[15px] ml-3 text-xl text-gray-200 font-bold">Tailwindbar</h1>
          <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i>
        </div>
        <hr class="my-2 text-gray-600">

        <div>
          <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700">
            <i class="bi bi-search text-sm"></i>
            <input class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" placeholder="Search" />
          </div>

          <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="bi bi-house-door-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200">Home</span>
          </div>
          <a href="/admin/societes" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="bi bi-bookmark-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200">Sociétés</span>
          </a>
          <a href="/admin/create-societe" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="bi bi-bookmark-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200">Ajouter Sociétés</span>
          </a>
          <hr class="my-4 text-gray-600">
          <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="bi bi-envelope-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200">Messages</span>
          </div>

          <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="bi bi-chat-left-text-fill"></i>
            <div class="flex justify-between w-full items-center" onclick="dropDown()">
              <span class="text-[15px] ml-4 text-gray-200">Chatbox</span>
              <span class="text-sm rotate-180" id="arrow">
                <i class="bi bi-chevron-down"></i>
              </span>
            </div>
          </div>
          <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu">
            <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Social</h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Personal</h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Friends</h1>
          </div>
          <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
            <i class="bi bi-box-arrow-in-right"></i>
            <span class="text-[15px] ml-4 text-gray-200">Logout</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content area -->
    <div class="ml-[300px] p-4 w-full">

      {{ $slot }}
    </div>
  </div>

  <script>
    function dropDown() {
      document.querySelector('#submenu').classList.toggle('hidden')
      document.querySelector('#arrow').classList.toggle('rotate-0')
    }
    dropDown()

    function Openbar() {
      document.querySelector('.sidebar').classList.toggle('left-[-300px]')
    }
  </script>
</body>

</html>
