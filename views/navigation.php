<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand font-weight-bold" href="index.php">RENTIT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <?php
          include_once("showMenu.php");
        ?> 
      </ul>
      <form class="form-inline my-2 my-lg-0" id='searchForm'>
        <input class="form-control mr-sm-2 relative" type="search" id='search' placeholder="Search">
        <div id="results" class='absolute'>No Results</div>
      </form>
    </div>
  </nav>