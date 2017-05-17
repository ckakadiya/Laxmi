<?php session_start();
ob_start();
include 'header.php';
?>


<!--start wrapper-->
<section class="wrapper">
    <section class="page_head">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="page_title">
                        <h2>Login Page</h2>
                    </div>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="index.php">Home</a>/</li>
                            <li>Login Form</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    
    <div class="container">
        <div class="row sub_content">
            
            <div class="col-lg-6 col-sm-6 col-lg-6">
                <div class="dividerHeading">
                    <h4><span>Login Form</span></h4>
                </div>
               <fieldset>
                        <form action="#" method="post">
                        
                        <section>
                            
                            <div class="section-left">
                            <div class="section-input">
                            <input name="txtemail" id="text_field" class="form-control" type="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Enter Your Email ID">
                            </div>
                            </div>
                           
                            <div class="section-left">
                                <br>
                                <div class="section-input">
                                    <input type="Password"  placeholder="Enter Your Mobile Number" name="txtpass"  
                                    class="form-control" required >
                                </div>
                            </div>
                            <div class="section-left-s">
                                <br>
                            </div>
                            <div class="section-left">
                                <br>
                                <div class="section-input">
                                    <input name="submit"  class="btn btn-default btn-lg button" value="Login" type="submit">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </section>
                         </form>
                        </fieldset>    
                        <div class="section-input">
                            <span><?php  include_once("LoginCode.php"); ?></span>
                        </div>
                        <div class="clearfix"></div>
            </div>
            
        </div>
    </div>
</section>

<div class="section-input">
<span><?php  include_once("LoginCode.php"); ?></span>
</div>
<div class="clearfix"></div>
<!--end wrapper-->

                
<?php include 'footer.php';?>



