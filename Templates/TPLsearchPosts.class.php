<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 25.5.2016 г.
 * Time: 21:11 ч.
 */

class TPLsearchPosts extends Template {

    public function Title() {
        return "Резултати от търсене";
    }

    public function Body() {
        ?>
<!--            <form action="?page=searchPosts" method="post">-->
                <input type="text" id="search_query" name="search_query" placeholder="Търсачка...">
                <input type="submit" id="submit_search" value="Търси" name="submit_search">
<!--            </form>-->
            <div id="searchResultDisplay">
                <ol>

                </ol>
            </div>
        <script>
            $("#submit_search").on("click", function() {
                $("#searchResultDisplay ol").html("");

                var valueSearch = $('#search_query').val();
                $.ajax({
                    url: "Templates/ajax.php",
                    type: "POST",
                    data: {
                        submitSearch: true,
                        valueSearch: valueSearch
                    },
                    success: function(data){
                        var json = JSON.parse(data);
                        $.each(json, function(i){
                            console.log(json[i]);
                            $("#searchResultDisplay ol").append(
                                "<li><a href='?page=comments&post="+ json[i]["id"]+"'>"
                                +json[i]['post_name']
                                +json[i]['category_name']
                                +json[i]['user_name']
                                +json[i]['date_created']
                                +"</a></li><br>"
                            );
                        })
                    }});
            });
        </script>
        <?php
    }
}