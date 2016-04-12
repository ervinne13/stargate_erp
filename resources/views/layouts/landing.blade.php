<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Pratt - Free Bootstrap 3 Theme">
        <meta name="author" content="Alvarez.is - BlackTie.co">

        <title>Stargate ERP</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('/js/smoothscroll.js') }}"></script>


    </head>

    <body data-spy="scroll" data-offset="0" data-target="#navigation">

        <!-- Fixed navbar -->
        <div id="navigation" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><b>StargateERP</b></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#home" class="smoothScroll">Home</a></li>
                        <li><a href="#desc" class="smoothScroll">Description</a></li>
                        <li><a href="#showcase" class="smoothScroll">Showcase</a></li>
                        <li><a href="#contact" class="smoothScroll">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>                        
                        @else
                        <li><a href="/logout">Logout</a></li>
                        @endif
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>


        <section id="home" name="home"></section>
        <div id="headerwrap">
            <div class="container">
                <div class="row centered">
                    <div class="col-lg-12">
                        <h1>ERP <b><a target="_blank" href="http://stargate-bsi.com.ph">Stargate Solutions</a></b></h1>
                        <h3>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </h3>                        
                    </div>
                    <div class="col-lg-2">
                        <h5>Business Solutions ERP</h5>
                        <p>Purchasing | Accounting | Inventory | Sales | Production Tracking | Payroll | Time Keeping | Fixed Asset | Human Resource & Recruitment</p>
                        <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/arrow1.png') }}">
                    </div>
                    <div class="col-lg-8">
                        <img class="img-responsive" src="{{ asset('/img/wof.png') }}" alt="">
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/arrow2.png') }}">
                        <h5>Awesome packaged...</h5>
                        <p>... by <a href="https://www.facebook.com/jasondelacruz08">Jason Dela Cruz</a> at <a href="http://stargate-bsi.com.ph">stargate-bsi.com.ph</a></p>
                    </div>
                </div>
            </div> <!--/ .container -->
        </div><!--/ #headerwrap -->


        <section id="desc" name="desc"></section>
        <!-- INTRO WRAP -->
        <div id="intro">
            <div class="container">
                <div class="row centered">
                    <h1>Designed To Excel</h1>
                    <br>
                    <br>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro01.png') }}" alt="">
                        <h3>Communication</h3>
                        <p>Facilitate seamless and convenient communication with your employees.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro02.png') }}" alt="">
                        <h3>Schedule</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro03.png') }}" alt="">
                        <h3>Monitoring</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>
                <br>
                <hr>
            </div> <!--/ .container -->
        </div><!--/ #introwrap -->

        <!-- FEATURES WRAP -->
        <div id="features">
            <div class="container">
                <div class="row">
                    <h1 class="centered">What's New?</h1>
                    <br>
                    <br>
                    <div class="col-lg-6 centered">
                        <img class="centered" src="{{ asset('/img/mobile.png') }}" alt="">
                    </div>

                    <div class="col-lg-6">
                        <h3>Some Features</h3>
                        <br>
                        <!-- ACCORDION -->
                        <div class="accordion ac" id="accordion2">
                             <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                        Integrations
                                    </a>
                                </div><!-- /accordion-heading -->
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                        <p>
                                            With RESTful web services, POS systems and other client applications may easily integrate with Stargate ERP
                                        </p>
                                    </div><!-- /accordion-inner -->
                                </div><!-- /collapse -->
                            </div><!-- /accordion-group -->
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                        Mobility
                                    </a>
                                </div><!-- /accordion-heading -->
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                        <p>
                                            Offline access available right at your fingertips
                                        </p>
                                    </div><!-- /accordion-inner -->
                                </div><!-- /collapse -->
                            </div><!-- /accordion-group -->
                            <br>

                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                        Responsive Design
                                    </a>
                                </div>
                                <div id="collapseFour" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </p>
                                    </div><!-- /accordion-inner -->
                                </div><!-- /collapse -->
                            </div><!-- /accordion-group -->
                        </div><!-- Accordion -->
                    </div>
                </div>
            </div><!--/ .container -->
        </div><!--/ #features -->


        <section id="showcase" name="showcase"></section>
        <div id="showcase">
            <div class="container">
                <div class="row">
                    <h1 class="centered">Some Screenshots</h1>
                    <br>
                    <div class="col-lg-8 col-lg-offset-2">
                        <div id="carousel-example-generic" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="{{ asset('/img/01-asset-disposal.png') }}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('/img/02-requisition.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div><!-- /container -->
        </div>


        <section id="contact" name="contact"></section>
        <div id="footerwrap">
            <div class="container">
                <div class="col-lg-5">
                    <h3>Contact</h3>
                    <p>
                        (02) 370 - 7703<br/>
                        sales@stargate-bsi.com.ph
                    </p>
                </div>

                <div class="col-lg-7">
                    <h3>Drop Us A Line</h3>
                    <br>
                    <form role="form" action="#" method="post" enctype="plain">
                        <div class="form-group">
                            <label for="name1">Your Name</label>
                            <input type="name" name="Name" class="form-control" id="name1" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email1">Email address</label>
                            <input type="email" name="Mail" class="form-control" id="email1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Your Text</label>
                            <textarea class="form-control" name="Message" rows="3"></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-large btn-success">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="c">
            <div class="container">
                <p>                    
                    <strong>Copyright &copy; 2016 </strong> | All Rights Reserved Stargate Business Solution Inc.                   
                </p>
            </div>
        </div>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script>
$('.carousel').carousel({
    interval: 3500
})
        </script>
    </body>
</html>
