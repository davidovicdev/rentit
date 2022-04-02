<?php
    session_start();
    include_once("views/header.php");
    include_once("views/navigation.php");
?>
    <div class="container-fluid min-vh-100 d-flex flex-row row align-items-center">
        <div class="col-lg-6 col-md-12 text-center">
            <img src="assets/img/author.png" alt ="author" class="img-fluid rounded" style="height:400px; width:282px">
        </div>
        <div class="col-lg-6 col-md-12  ">
            <h1 class='mb-5 font-weight-bold'>About author</h1>
            <h3 class='mb-5'>Hi, I'm <span class='text-danger font-weight-bold'>Matija Davidovic</span></h3>
            <p class='mb-2'>When I was younger I always needed something to do with computers. That could be playing games, watching movies or even trying some coding before high school. So now I'm following my wish to one day become successfully back-end Web developer.</p>
            <p>I choose Visoka ICT college to sharpen my skills of every aspect. Now when I can interprate my skills via Website I'm happy to see the difference between starting of college and now. This is my first PHP Website and it represents pre-examination obligation.</p>
        </div>
    </div>
<?php
    include_once("views/footer.php");
?>