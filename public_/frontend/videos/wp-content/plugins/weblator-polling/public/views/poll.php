<?php

$legend = null;
$legendStyle = null;

if ($poll["poll_is_live"]){

    if ($poll["poll_max_width"] > 0){
        $width = $poll["poll_max_width"];

        if ($poll["poll_chart_type"] != 5 || $poll["poll_chart_type"] != 6)
            $height = $poll["poll_max_width"] / 2;
    }
    else {
        $width = "100%";
        $height = "";
    }

$var = '<div class="weblator-poll-container" data-poll-id="' . $poll["id"] . '">

    <div class="weblator-poll-loading">Loading</div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">' . stripslashes($poll["poll_name"]) . '</h3>
        </div>

        <div class="panel-body weblator-poll-vote">

            <div class="alert alert-success">Thank you for voting</div>
            <div class="alert alert-warning">You have already voted on this poll!</div>
            <div class="alert alert-danger">Please select an option!</div>

            <ul>';
                foreach($options as $option){
                    $var .= '<li><input type="radio" name="weblator-chart-options" id="option-' . $option["id"] . '" data-poll-id="' . $poll["id"] . '" value="' . $option["id"] . '"/>
                        <label for="option-' . $option["id"] . '">' . stripslashes($option["option_value"]) . '</label>
                    </li>';
                }

            $var .= '</ul></div>';

    $var .= '<div class="panel-footer">
            <div class="button-vote" style="float:left; text-align: left;">
                <button class="btn btn-default vote-button weblator-poll-submit"><i class="fa fa-spinner fa-spin vote-spin"></i> Vote</button>
            </div>
            <div class="weblator-view-results" style="float:right; text-align: right;">

                <a href="#" class="weblator-view-poll btn btn-default">View Results</a>
                <a href="#" class="weblator-hide-poll btn btn-default">Hide Results</a>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>';

    if ($poll["poll_chart_type"] == 2 || $poll["poll_chart_type"] == 3 || $poll ["poll_chart_type"] == 6){

        $legendStyle = "style='font-style:" . $poll["chart_legend_font_style"] . "; color:" . $poll["chart_legend_font_colour"] . "; '";

        if ($poll["chart_legend"])
            $var .= "<ul " . $legendStyle . " data-font-size='" . $poll["chart_legend_font_size"] . "' id=\"legend-" . $poll["id"] . "\" class=\"legend " . $poll["chart_legend_position"] . "\"></ul>";
    }


    $var .= '<canvas id="weblator-chart-' . $poll["id"] . '" class="weblator-chart" width="'.$width.'" height="'.$height.'"></canvas>';
    $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
    $var .= '<script>var ' . $randomString. ' = new Poll(' . $poll["id"] . ');</script>

</div>';
}