<?php

class Weblator_Polling_Ajax {


    static function save_poll(){

        global $wpdb;

        $name         = sanitize_text_field($_POST["name"]);
        $chart        = sanitize_text_field($_POST["chart"]);
        $view_results = sanitize_text_field($_POST["view_results"]);
        $one_vote     = sanitize_text_field($_POST["one_vote"]);
        $is_live      = sanitize_text_field($_POST["is_live"]);
        $legend      = sanitize_text_field($_POST["legend"]);
        $legend_position      = sanitize_text_field($_POST["legend_position"]);
        $legend_font_size      = sanitize_text_field($_POST["legend_font_size"]);
        $legend_font_style      = sanitize_text_field($_POST["legend_font_style"]);
        $legend_font_colour      = sanitize_text_field($_POST["legend_font_colour"]);
        $maxWidth = $_POST["maxWidth"];
        $minWidth = $_POST["minWidth"];


        $q = $wpdb->query( $wpdb->prepare("
            INSERT INTO {$wpdb->prefix}weblator_polls ( poll_name, poll_chart_type, poll_allow_view_results, poll_one_vote, poll_is_live, poll_max_width, poll_min_width, chart_legend, chart_legend_position, chart_legend_font_size, chart_legend_font_style, chart_legend_font_colour )
            VALUES ( %s, %d, %d, %d, %d, %d, %d, %d, %s, %s, %s, %s )", $name, $chart, $view_results, $one_vote, $is_live, $maxWidth, $minWidth, $legend, $legend_position, $legend_font_size, $legend_font_style, $legend_font_colour) );

        //If the query could not be inserted then return
        if (!$q){
            echo 0;
            die();
        }

        $last_id = $wpdb->insert_id;

        foreach($_POST["options"] as $option){

            //if the value passed to the order array value is not an int then return
            if (!is_numeric($option[0])){
                echo 0;
                die();
            }


            $v = sanitize_text_field($option[1]);

            $wpdb->query( $wpdb->prepare("
                INSERT INTO {$wpdb->prefix}weblator_poll_options ( poll_id, option_value, option_order, option_colour )
                VALUES ( %d, %s, %d, %s )", $last_id, $v, $option[0], $option[3]) );

        }

        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}weblator_style_options");

        foreach($results as $result){

            $wpdb->query( $wpdb->prepare("INSERT INTO {$wpdb->prefix}weblator_style_values (poll_id, style_id, style_value) VALUES (%d, %d, %s)", $last_id, $result->id, $result->style_default));

        }

        foreach($_POST["styles"] as $style){

            $value = sanitize_text_field($style["value"]);
            $style_id = $style["id"];

            $wpdb->query( $wpdb->prepare("
                UPDATE {$wpdb->prefix}weblator_style_values SET style_value = %s WHERE poll_id = %d AND style_id = %d
            ", $value, $last_id, $style_id) );


        }


        echo $last_id;
        die();
    }

    static function update_poll(){

        global $wpdb;

        $poll_id      = sanitize_text_field($_POST["poll_id"]);
        $name         = sanitize_text_field($_POST["name"]);
        $chart        = sanitize_text_field($_POST["chart"]);
        $view_results = sanitize_text_field($_POST["view_results"]);
        $one_vote     = sanitize_text_field($_POST["one_vote"]);
        $is_live      = sanitize_text_field($_POST["is_live"]);
        $legend      = sanitize_text_field($_POST["legend"]);
        $legend_position      = sanitize_text_field($_POST["legend_position"]);
        $legend_font_size      = sanitize_text_field($_POST["legend_font_size"]);
        $legend_font_style      = sanitize_text_field($_POST["legend_font_style"]);
        $legend_font_colour      = sanitize_text_field($_POST["legend_font_colour"]);
        $maxWidth        = ($_POST["maxWidth"]);
        $minWidth       = ($_POST["minWidth"]);

        $wpdb->update( $wpdb->prefix . 'weblator_polls',
            array('poll_name' => $name, 'poll_chart_type' => $chart, 'poll_allow_view_results' => $view_results, 'poll_one_vote' => $one_vote, 'poll_is_live' => $is_live, 'poll_max_width' => $maxWidth, 'poll_min_width' => $minWidth, 'chart_legend' => $legend, 'chart_legend_position' => $legend_position, 'chart_legend_font_size' => $legend_font_size, 'chart_legend_font_style' => $legend_font_style, 'chart_legend_font_colour' => $legend_font_colour),
            array( 'id' => $poll_id ),
            array('%s', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s'), array( '%d' ));


        $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}weblator_poll_options SET `option_deleted_date` = NOW() WHERE `poll_id` = %d AND `option_deleted_date` IS NULL", $poll_id) );

        foreach($_POST["options"] as $option){

            //if the value passed to the order array value is not an int then return
            if (!is_numeric($option[0])){
                echo 0;
                die();
            }


            $v = sanitize_text_field($option[1]);

            $wpdb->query( $wpdb->prepare("
                INSERT INTO {$wpdb->prefix}weblator_poll_options ( poll_id, option_value, option_order, option_colour )
                VALUES ( %d, %s, %d, %s )", $poll_id, $v, $option[0], $option[3]) );

            $last_id = $wpdb->insert_id;

            $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}weblator_poll_votes SET option_id = %d WHERE poll_id = %d AND option_id = %d", $last_id, $poll_id, $option[2]) );

        }

        foreach($_POST["styles"] as $style){

            $value = sanitize_text_field($style["value"]);
            $style_id = $style["id"];

            $id = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT id FROM {$wpdb->prefix}weblator_style_values WHERE poll_id = %d AND style = %d", $poll_id, $style_id
                )
            );

            if ($id){
                $wpdb->query(
                    $wpdb->prepare("
                    UPDATE {$wpdb->prefix}weblator_style_values SET style_value = %s WHERE poll_id = %d AND style_id = %d
                ", $value, $poll_id, $style_id)
                );
            } else {

                $wpdb->query( $wpdb->prepare("INSERT INTO {$wpdb->prefix}weblator_style_values (poll_id, style_id, style_value) VALUES (%d, %d, %s)", $poll_id, $style_id, $value));

            }


        }

        echo 1;
        die();
    }

    static function delete_poll($id = null){

        global $wpdb;

        $posted_id = null;
        if ($id == null)
            $posted_id = $_POST["poll_id"];
        else
            $posted_id = $id;

        if (!is_numeric($posted_id)){
            echo 0;
            die();
        }

        $wpdb->query( $wpdb->prepare("UPDATE {$wpdb->prefix}weblator_polls SET `poll_deleted_date` = NOW() WHERE `id` = %d", $posted_id) );

        if ($id == null){
            echo 1;
            die();
        }


    }

    static function chart_style_options(){

        $chart_id = $_POST["chart_id"];


        if (!is_numeric($chart_id)){
            echo 0;
            die();
        }

        global $wpdb;



        if (isset($_POST["poll_id"])){

            $poll_id = $_POST["poll_id"];

            $query = $wpdb->get_results(
                            $wpdb->prepare("
                                SELECT
                                    {$wpdb->prefix}weblator_style_options.id,
                                    {$wpdb->prefix}weblator_style_options.style_option,
                                    CASE WHEN {$wpdb->prefix}weblator_style_options.style_bool = 1 THEN 'true' ELSE 'false' END AS style_bool,
                                    CASE WHEN {$wpdb->prefix}weblator_style_options.style_colorpicker = 1 THEN 'true' ELSE 'false' END AS style_colorpicker,
                                    CASE WHEN {$wpdb->prefix}weblator_style_options.style_dropdown = 1 THEN 'true' ELSE 'false' END AS style_dropdown,
                                    CASE WHEN {$wpdb->prefix}weblator_style_options.style_dropdown = 1 THEN (SELECT group_concat(dropdown_nicename, '||', dropdown_value separator ', ') FROM {$wpdb->prefix}weblator_poll_style_dropdowns WHERE style_id = {$wpdb->prefix}weblator_style_options.id LIMIT 1) ELSE NULL END as dropdown_options,
                                    {$wpdb->prefix}weblator_style_options.style_label,
                                    {$wpdb->prefix}weblator_style_options.style_description,
                                    (SELECT
                                      {$wpdb->prefix}weblator_style_values.style_value
                                    FROM {$wpdb->prefix}weblator_style_values
                                    WHERE {$wpdb->prefix}weblator_style_values.style_id = {$wpdb->prefix}weblator_style_options.id
                                    AND {$wpdb->prefix}weblator_style_values.poll_id = $poll_id
                                    ORDER BY id DESC LIMIT 1) AS style_default
                                FROM {$wpdb->prefix}weblator_style_chart_link, {$wpdb->prefix}weblator_style_options
                                WHERE {$wpdb->prefix}weblator_style_chart_link.chart_id = %d
                                AND {$wpdb->prefix}weblator_style_options.id = {$wpdb->prefix}weblator_style_chart_link.style_id
                                ORDER BY {$wpdb->prefix}weblator_style_options.style_order ASC", $chart_id), ARRAY_A );


        }else {

            $query = $wpdb->get_results(
                        $wpdb->prepare("
                          SELECT
                            {$wpdb->prefix}weblator_style_options.id,
                            {$wpdb->prefix}weblator_style_options.style_option,
                            CASE WHEN {$wpdb->prefix}weblator_style_options.style_bool = 1 THEN 'true' ELSE 'false' END AS style_bool,
                            CASE WHEN {$wpdb->prefix}weblator_style_options.style_colorpicker = 1 THEN 'true' ELSE 'false' END AS style_colorpicker,
                            CASE WHEN {$wpdb->prefix}weblator_style_options.style_dropdown = 1 THEN 'true' ELSE 'false' END AS style_dropdown,
                            CASE WHEN {$wpdb->prefix}weblator_style_options.style_dropdown = 1 THEN (SELECT group_concat(dropdown_nicename, '||', dropdown_value separator ', ') FROM {$wpdb->prefix}weblator_poll_style_dropdowns WHERE style_id = {$wpdb->prefix}weblator_style_options.id LIMIT 1) ELSE NULL END as dropdown_options,
                            {$wpdb->prefix}weblator_style_options.style_default,
                            {$wpdb->prefix}weblator_style_options.style_label,
                            {$wpdb->prefix}weblator_style_options.style_description
                          FROM
                            {$wpdb->prefix}weblator_style_chart_link,
                            {$wpdb->prefix}weblator_style_options
                          WHERE {$wpdb->prefix}weblator_style_chart_link.chart_id = %d
                          AND {$wpdb->prefix}weblator_style_options.id = {$wpdb->prefix}weblator_style_chart_link.style_id
                          ORDER BY {$wpdb->prefix}weblator_style_options.style_order ASC", $chart_id), ARRAY_A );


        }


        for ($i = 0; $i < count($query); $i++){

            $query[$i]["style_bool"] = ($query[$i]["style_bool"] == "true" ? true : false);
            $query[$i]["style_colorpicker"] = ($query[$i]["style_colorpicker"] == "true" ? true : false);
            $query[$i]["style_dropdown"] = ($query[$i]["style_dropdown"] == "true" ? true : false);

            if ($query[$i]["style_bool"] && $query[$i]["style_default"] == "0")
                $query[$i]["style_default"] = false;
            else if ($query[$i]["style_bool"] && $query[$i]["style_default"] == "1")
                $query[$i]["style_default"] = true;

            if ($query[$i]["dropdown_options"] != NULL){

                $dropdownOptions = array();

                $options = explode(",", $query[$i]["dropdown_options"]);
                foreach($options as $option){

                    $kv = explode("||", $option);
                    $dropdownOptions[] = array(
                        "key" => $kv[0],
                        "value" => $kv[1],
                        "selected" => ($kv[1] == $query[$i]["style_default"] ? true : false)
                    );
                }

                $query[$i]["dropdown_options"] = $dropdownOptions;

            }
        }


        echo json_encode($query);

        die();

    }
}