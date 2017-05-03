<?php

class TPLcreate extends Template {
//    protected function templateSepc($where = false, $template_type = false) {
//    protected function templateSepc($template_type) {
//        $db = new Connect('site_builder');
//        $query = "SELECT *
//                    FROM templates WHERE template_type='$template_type'";
////        if($where) $query = $query . "WHERE template_type='$template_type'";
//        $connection = $db->connect->prepare($query);
//        $connection->execute();
//        $result = $connection->fetchAll(PDO::FETCH_ASSOC);
//        return $result;
//    }




    public function Title() {
        if(isset($this->aParams['template'])) {
            $template = $this->aParams['template'];
            return "Create $template";
        }else {
            return "Create";
        }
    }

    public function Body() {
        ?>
        <select id="template_type">
            <option value="Site">Site</option>
            <option value="Blog">Blog</option>
        </select>
        <div id="templateContainer">

        </div>
        <script>
            $(document).ready(function () {
                $('#template_type').change(function () {
                    $('#templateContainer').html('');
                    $.ajax({
                        url: "Templates/ajax.php",
                        type: "POST",
                        data: {
                            template_type: $('#template_type')[0].value
                        },
                        success: function (data) {
                            var json = JSON.parse(data);
                            $.each(json, function (i) {
//                        var jsonEl = json[i];
                                console.log(json);

                                var title = json[i].title;
                                var img = json[i].img;
                                var preview_link = json[i].preview_link;
                                var id = json[i].id;


                                var div = '<div class="w3-container w3-section w3-light-grey w3-padding-16 w3-card-2">' +
                                    '<h3 class="w3-center">' + title + '</h3>' +
                                    '<div class="w3-content" style="max-width:800px">' +
                                    '<img src="' + img + '" style="width:98%;margin:20px 0" alt="' + title + '"><br>' +
                                    '<div class="w3-row">' +
                                    '<div class="w3-col m6">' +
                                    '<a href="Sites/' + title + '.html" target="_blank" class="w3-btn w3-padding-large w3-dark-grey" style="width:98.5%">Preview</a>' +
                                    '</div>' +
                                    '<div class="w3-col m6">' +
                                    '<a href="?page=editTemplate&template=' + title + '&template_id='+id+'" class="w3-btn w3-padding-large w3-dark-grey" style="width:98.5%">Get This one</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                                $('#templateContainer').append(div);
                            })

                        }
                    });
                });
                $('#template_type').trigger('change');

            });
        </script>
        <?php


    }
}