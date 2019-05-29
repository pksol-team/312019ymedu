@extends('frontend.template.single')
@section('title') <?= $title; ?> @stop
@section('content')

    <?php use App\Http\Controllers\Frontend\IndexController; ?>
    <?php use Illuminate\Support\Collection; ?>

    <main id="main" class="bg_image">
        <!-- breadcrumb nav -->

        <!-- two columns -->
        <div id="two-columns" class="container">
            <div class="row">
                <!-- content -->
                <article id="content" class="col-xs-12 col-md-12">
                    <!-- show head -->
                    <div class="fluid-container">
                        <!--   <h2>Carousel Example</h2> -->
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">

                                <?php
                                if ($coursesCount > 5) {
                                    if ($coursesCount / 5 > round($coursesCount / 5)) {
                                        $total_slides = (round($coursesCount / 5)) + 1;
                                    } else {
                                        $total_slides = round($coursesCount / 5);
                                    }

                                } else {
                                    $total_slides = 1;
                                }
                                ?>



                                @for ($i = 0; $i < $total_slides ; $i++)

                                    <?php
                                    $starting = $i * 5;
                                    $courses = DB::table('all_courses')->whereNull('deleted_at')->WHERE('status', 'Active')->skip($starting)->take(5)->get();
                                    $count = count($courses);
                                    if($courses){
                                    ?>
                                    <div class="item @if ($i == 0) active @endif">
                                        <?php
                                        if($count == 1){
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">

                                                <article class="popular-post">
                                                    <div class="aligncenter">
                                                        <a href="/single_course/<?= $courses[0]->id ?>">
                                                            <?php
                                                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[0]->image)->first();
                                                            if ($CourseImageGet) {
                                                                $CourseImage_0 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                                                            } else {
                                                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[0]->intro)->first();
                                                                if ($CourseIntroGet) {
                                                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                                                        $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                                                    } else {
                                                                        $CourseImage_0 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                                                    }
                                                                } else {
                                                                    $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                                                }
                                                            }
                                                            ?>
                                                            <img src="<?= $CourseImage_0?>" alt="image description">
                                                        </a>
                                                        <div class="pp-post-bottim">
                                                            <h3 class="post-heading">
                                                                <a href="/single_course/<?= $courses[0]->id ?>">{{ $courses[0]->name }}</a></h3>
                                                            <footer class="post-foot gutter-reset">
                                                                <?php
                                                                $total_stars = $courses[0]->add_stars;
                                                                $unfillStarts = 5 - $courses[0]->add_stars;
                                                                if($total_stars > 0){
                                                                for($x = 0; $x < $total_stars; $x++){
                                                                if($x < 5){
                                                                ?>
                                                                <span class="fa fa-star checked"></span>
                                                                <?php
                                                                }

                                                                }
                                                                }

                                                                if($unfillStarts > 0){
                                                                for($y = 0; $y < $unfillStarts; $y++){
                                                                ?>
                                                                <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                                <br>
                                                                <strike>Rs.3999</strike> <span
                                                                        style="font-weight:bold">  Rs.<?= $courses[0]->price ?></span>
                                                            </footer>
                                                            <footer style="color: #ffa300;">
                                                                <i class="far fa-user icn no-shrink"></i>
                                                                <?= $courses[0]->students ?>
                                                                Students
                                                            </footer>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4 "></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
        </div>
        <?php
        }
        else if($count == 2){
        ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[0]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[0]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_0 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[0]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_0 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_0?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[0]->id ?>">{{ $courses[0]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[0]->add_stars;
                            $unfillStarts = 5 - $courses[0]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                        <?php
                        }
                        }
                        ?>
                            <br>
                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[0]->price ?></span>
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[0]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[1]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[1]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_1 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[1]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_1 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_1?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[1]->id ?>">{{ $courses[1]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[1]->add_stars;
                            $unfillStarts = 5 - $courses[1]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>

                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[1]->price ?></span>
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[1]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
        </div>
        <?php
        }
        else if($count == 3){
        ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[0]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[0]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_0 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[0]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_0 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_0?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[0]->id ?>">{{ $courses[0]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[0]->add_stars;
                            $unfillStarts = 5 - $courses[0]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if ($unfillStarts > 0) {
                                for ($y = 0; $y < $unfillStarts; $y++) {
                                    ?>

                        <?php
                                }
                            }
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <br>
                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[0]->price ?></span>
                           
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[0]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[1]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[1]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_1 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[1]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_1 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_1?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[1]->id ?>">{{ $courses[1]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[1]->add_stars;
                            $unfillStarts = 5 - $courses[1]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>

                            <br>

                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[1]->price ?></span>
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[1]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[2]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[2]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_2 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[2]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_2 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_2?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[2]->id ?>">{{ $courses[2]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[2]->add_stars;
                            $unfillStarts = 5 - $courses[2]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>

                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[2]->price ?></span>
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[2]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>
        </div>
        <?php
        }
        else if($count == 4){
        ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[0]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[0]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_0 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[0]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_0 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_0?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[0]->id ?>">{{ $courses[0]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[0]->add_stars;
                            $unfillStarts = 5 - $courses[0]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike><span
                                    style="font-weight:bold">   Rs.<?= $courses[0]->price ?></span>
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[0]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[1]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[1]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_1 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[1]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_1 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_1?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[1]->id ?>">{{ $courses[1]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[1]->add_stars;
                            $unfillStarts = 5 - $courses[1]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[1]->price ?></span>
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[1]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[2]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[2]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_2 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[2]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_2 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_2?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[2]->id ?>">{{ $courses[2]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[2]->add_stars;
                            $unfillStarts = 5 - $courses[2]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span
                                    style="font-weight:bold">  Rs.<?= $courses[2]->price ?></span>

                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[2]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[3]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[3]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_3 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[3]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_3 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_3 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_3 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_3?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[3]->id ?>">{{ $courses[3]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[3]->add_stars;
                            $unfillStarts = 5 - $courses[3]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike><span
                                    style="font-weight:bold">   Rs.<?= $courses[3]->price ?></span>

                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[3]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4"></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>
        </div>
        <?php
        }
        else if($count == 5){
        ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[0]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[0]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_0 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[0]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_0 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                }
                            }

                            ?>
                            <img src="<?= $CourseImage_0?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[0]->id ?>">{{ $courses[0]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[0]->add_stars;
                            $unfillStarts = 5 - $courses[0]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>

                        <?php
                        }
                        }
                        ?>
                                <br>
                                <strike>Rs.3999</strike><span
                                        style="font-weight:bold">   Rs.<?= $courses[0]->price ?></span>
                       
                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[0]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[1]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[1]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_1 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[1]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_1 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_1?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[1]->id ?>">{{ $courses[1]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[1]->add_stars;
                            $unfillStarts = 5 - $courses[1]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span style="font-weight:bold"> Rs.<?= $courses[1]->price ?></span>

                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[1]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[2]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[2]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_2 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[2]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_2 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_2?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[2]->id ?>">{{ $courses[2]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[2]->add_stars;
                            $unfillStarts = 5 - $courses[2]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span style="font-weight:bold"> Rs.<?= $courses[2]->price ?></span>

                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[2]->students ?>
                            Students
                        </footer>
                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[3]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[3]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_3 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[3]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_3 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_3 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_3 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_3?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[3]->id ?>">{{ $courses[3]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[3]->add_stars;
                            $unfillStarts = 5 - $courses[3]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }


                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span style="font-weight:bold">
                                    Rs.<?= $courses[3]->price ?>
                                </span>

                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[3]->students ?>
                            Students
                        </footer>
                    </div>
                </article>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <article class="popular-post" style="border-radius: 0px !important;">
                    <div class="aligncenter">
                        <a href="/single_course/<?= $courses[4]->id ?>">
                            <?php
                            $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[4]->image)->first();
                            if ($CourseImageGet) {
                                $CourseImage_4 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                            } else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[4]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '4gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                        $CourseImage_4 = "/frontend/images/Image_not.jpg";
                                    } else {
                                        $CourseImage_4 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                } else {
                                    $CourseImage_4 = "/frontend/images/Image_not.jpg";
                                }
                            }
                            ?>
                            <img src="<?= $CourseImage_4?>" alt="image description">
                        </a>
                    </div>
                    <div class="pp-post-bottim">
                        <h3 class="post-heading"><a
                                    href="/single_course/<?= $courses[4]->id ?>">{{ $courses[4]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                            <?php
                            $total_stars = $courses[4]->add_stars;
                            $unfillStarts = 5 - $courses[4]->add_stars;
                            if($total_stars > 0){
                            for($x = 0; $x < $total_stars; $x++){
                            if($x < 5){
                            ?>
                            <span class="fa fa-star checked"></span>
                            <?php
                            }

                            }
                            }

                            if($unfillStarts > 0){
                            for($y = 0; $y < $unfillStarts; $y++){
                            ?>
                            <span class="far fa-star" style="color: #ffa300;"><span class="sr-only">star</span></span>
                            <?php
                            }
                            }
                            ?>
                            <br>
                            <strike>Rs.3999</strike> <span style="font-weight:bold">
                                    Rs.<?= $courses[4]->price ?>
                                </span>

                        </footer>
                        <footer style="color: #ffa300;">
                            <i class="far fa-user icn no-shrink"></i>
                            <?= $courses[4]->students ?>
                            Students
                        </footer>
                    </div>
                </article>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">

            </div>
        </div>
        <?php
        }
        ?>
        </div>
        <?php
        }



        ?>


        @endfor


        </div>

        <!-- Left and right controls -->

        <div class="carousel-btn-setting">
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fas fa-arrow-left"></i>
                <!-- <span class="sr-only">Previous</span> -->
            </a>
            <ol class="carousel-indicators">
                @for ($i = 0; $i < $total_slides ; $i++)
                    <li data-target="#myCarousel" data-slide-to="0" class="@if ($i == 0) active @endif"></li>
            @endfor
            <!--<li data-target="#myCarousel" data-slide-to="1"></li>-->
                <!--<li data-target="#myCarousel" data-slide-to="2"></li> -->
            </ol>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fas fa-arrow-right"></i>
                <!-- <span class="sr-only">Next</span> -->
            </a>
        </div>
        </div>
        </div>


        </div>
        </article>

        <footer>
            <div class="footer-text" style="font-family: 'Quicksand', sans-serif">
                <p>Frankeey | © 2019 , All Rights Reserved</p>
            </div>
        </footer>
        </div>
        </div>
    </main>
@stop
