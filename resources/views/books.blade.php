@include('includes.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body >
    
    <?php
$movies = array(
    array("title" => "Everyone in My Family Has Killed Someone", "genre" => "Crime", "author" => "Benjamin Stevenson"),
    array("title" => "If He Had Been with Me", "genre" => "Romance", "author" => "Nowlin Laura"),
    // Alte filme...
);
?>

<div class="flex flex-wrap overflow-auto">
<?php
$i = 1;
foreach ($movies as $movie) {
  
    ?>
    <div class="m-2 mb-8 px-2  sm:w-1/4 md:w-1/5 ">
      <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
        <img src="{{ asset('pictures/c' . $i . '.jpg')}}" alt="movie poster" class="rounded-t-lg " />
        <div class="p-2 flex-grow">
          <h2 class="mb-2 text-lg font-semibold"><?php echo $movie['title']; ?></h2>
          <p class="mb-2 text-sm text-gray-700">Author: <?php echo $movie['author']; ?></p>
          <p class="mb-4 text-sm text-gray-700">Genre: <?php echo $movie['genre']; ?></p>
        </div>
          <div class="p-2 mt-auto">
            <a href="#" class="block rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600 mt-auto">Add to list</a>
          </div>  
      
      </div>
    </div>
    <?php
$i++;
}
?>
</div>
</body>
</html>