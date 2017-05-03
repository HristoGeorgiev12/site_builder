<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 г.
 * Time: 18:11 ч.
 */

class TPLindex extends Template {

    public function Title() {
        return "Main Page";
    }

    public function Body() {
        foreach (allPosts('Blog') as $value) {
        ?>
        <div class="row">
            <!-- Blog entries -->
            <div class="col-lg-8 col-sm-12">
                <div class=" ">
                    <!-- Blog entry -->
                    <div class="well">

<!--                        <img class="img-circle" src="https://www.w3schools.comhttps://www.w3schools.com/w3images/woods.jpg" alt="Nature" style="width:50px; height: 50px; position: absolute; margin: 0 0 0 -20px ">-->
                        <p class="text-center post-meta padding" style="margin-bottom: 0px">Posted by <a href="#">Start Bootstrap</a> on September 24, 2014</p>

                        <img src="https://www.w3schools.com/w3images/woods.jpg" alt="Nature" style="width:100%">
                        <div class="container-fluid row">
                            <h3><b>TITLE HEADING</b></h3>
                            <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
                                tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class=" "><b>Comments &nbsp;</b> <span class="badge">0</span></span>
                                    <span><b>Likes &nbsp</b><span class="badge">0</span></span>
                                    <button class="btn pull-right"><b>READ MORE »</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <?php
        }
        ?>

<!--            <div class="col-lg-6 col-sm-12">-->
<!--                <div class=" ">-->
<!--                    <p class="post-meta padding">Posted by <a href="#">Start Bootstrap</a> on September 24, 2014</p>-->
<!--                    <!-- Blog entry -->
<!--                    <div class="well">-->
<!--                        <img src="https://www.w3schools.comhttps://www.w3schools.com/w3images/woods.jpg" alt="Nature" style="width:100%">-->
<!--                        <div class="container-fluid row">-->
<!--                            <h3><b>TITLE HEADING</b></h3>-->
<!--                            <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed-->
<!--                                tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <span class=" "><b>Comments &nbsp;</b> <span class="badge">0</span></span>-->
<!--                                    <span><b>Likes &nbsp</b><span class="badge">0</span></span>-->
<!--                                    <button class="btn pull-right"><b>READ MORE »</b></button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <hr>-->
<!--                </div>-->
<!--            </div>-->

<!--             Introduction menu-->
            <div class=" w3-col l4">
<!--Labels / tags-->
<!--                <div class="w3-card-2 w3-margin">-->
<!--                    <div class="well w3-padding">-->
<!--                        <h4>Tags</h4>-->
<!--                    </div>-->
<!--                    <div class="w3-container w3-white">-->
<!--                        <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>-->
<!--                            <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>-->
<!--                            <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>-->
<!--                            <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>-->
<!--                            <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--<!--                Popular topics-->
                <div class="well">
                    <p>Popular Posts</p>
                    <ul class="w3-ul w3-hoverable w3-white">
                        <li class="w3-padding-16">
                            <img src="https://www.w3schools.com/w3images/workshop.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                            <span class="w3-large">Lorem</span><br>
                            <span>Sed mattis nunc</span>
                        </li>
                        <li class="w3-padding-16">
                            <img src="https://www.w3schools.com/w3images/gondol.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                            <span class="w3-large">Ipsum</span><br>
                            <span>Praes tinci sed</span>
                        </li>
                        <li class="w3-padding-16">
                            <img src="https://www.w3schools.com/w3images/skies.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                            <span class="w3-large">Dorum</span><br>
                            <span>Ultricies congue</span>
                        </li>
                        <li class="w3-padding-16 w3-hide-medium w3-hide-small">
                            <img src="https://www.w3schools.com/w3images/rock.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                            <span class="w3-large">Mingsum</span><br>
                            <span>Lorem ipsum dipsum</span>
                        </li>
                    </ul>
                </div>
                <hr>



                <!-- END Introduction Menu
            </div>

            <!-- END GRID -->
        </div>

<!--            <div id="categories">-->
<!--                --><?php
//                    $result = $this->showCategories();
//
//                    foreach($result as $catValue) {
//
//
//                        $resultId = $catValue['catId'];
//                        $resultUsername = $catValue['catName'];
//                        $resultCountPosts = $catValue['countPosts'];
//
//
//                        ?>
<!--                        <table class="table table-bordered">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>--><?//= "<a href='?page=posts&cat={$resultId}'>{$resultUsername}</a> -{$resultCountPosts} -Поста<br>";?><!--</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!---->
<!--                            --><?php
//                                foreach($this->showPost($resultId) as $postValue) {
//                                    $postId = $postValue['id'];
//                                    $postName = $postValue['post_name'];
//                                    $creatorAndDare = "Създадена от:". $postValue['userName']." на ". $postValue['date_created'];
//
//                                    echo " <tr><td><a href='?page=comments&post={$postId}'>{$postName}</a> {$creatorAndDare}</td></tr>";
//                                }
//                            ?>
<!---->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                        --><?php
//
////                        echo "<a href='?page=posts&cat={$resultValue}'>{$resultValue}</a><br>";
//                    }
//                ?>
<!--            </div>-->






        <?php
    }
}