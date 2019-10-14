<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Contacts List</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ml-auto right">
            <li class="nav-item active">{{ link_to('', 'Home', "class" : "nav-link", "name" : "home" ) }}</li>
            <li class="nav-item">{{ link_to('about', 'About', "class" : "nav-link", "name" : "about" ) }}<li>
         </ul>
      </div>
    </div>
  </nav>


{{ flash.output() }}
{{ content() }}
