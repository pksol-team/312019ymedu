(function ($) {

    var Poll = function(){

        var poll = this;

        poll.options = {
            chartType : $("#weblator_polling_chart_type")
        }

        function init(){


            //Set up event handlers

            //Make sure all checkboxes are either 1 or 0
            $("body").on("change", "input[type='checkbox']", function(){
                setCheckboxes();
            });

            $("select[name='weblator_polling_view_results']").change(function(e){
                styleSettingsVisibility(this);
            });

            //Trigger style settings visibility on page load
            $("select[name='weblator_polling_view_results']").trigger("change");

            //New poll option button clicked
            $("#poll-option").click(function(){
                addPollOption();
            });

            //Delete Poll Option
            $("table.poll-options").on("click", ".poll-option-remove", function(e){
                deletePollOption(this);
            });

            //Save Chart
            $(".save-button").click(function(e){
                saveChart(this);
            });

            //Delete Poll
            $(".delete_poll").click(function(e){
                e.preventDefault();
                deletePoll(this);
            });

            //Reload chart settings when chart type changes
            $("#weblator_polling_chart_type").change(function(){
                $(".chart-settings tbody").empty().html("Loading");
                loadChartStyleSettings();
                showLegendOption();

            });

            $("#chart_legend").change(function(){
                showLegendOptionsSecondary();
            });

            //Make option table rows sortable
            $(".poll-options tbody").sortable({
                handle: ".drag",
                placeholder: "ui-state-highlight",
                update: reorderPollPotions,
                items: "tr"
            });

            loadChartStyleSettings();
            showLegendOption();
            showLegendOptionsSecondary();

            setCheckboxes();

        }

        function setCheckboxes(){
            $("input[type='checkbox']").each(function(){
                $(this).val((Number(this.checked)));
            });
        }

        function showLegendOption(){

            if (poll.options.chartType.val() == 2 || poll.options.chartType.val() == 3 || poll.options.chartType.val() == 6){
                $(".legend-option").css("display", "table-row");
            }else {
                $(".legend-option").css("display", "none");

            }

            showLegendOptionsSecondary();
        }

        function showLegendOptionsSecondary(){


            if ($(".legend-option:visible").length){


                if ($("#chart_legend").is(":checked")){
                    $(".legend-option-secondary").css("display", "table-row");

                }else{
                    $(".legend-option-secondary").css("display", "none");

                }


            }else {

                $(".legend-option-secondary").css("display", "none");

            }
        }

        function styleSettingsVisibility(e){


            if ($(e).val() == 4){

                $(".option_hide").css("display", "none");
                if ($(".style-settings:visible"))
                    $(".style-settings").slideUp();

            } else{

                $(".option_hide").css("display", "table-row");
                if ($(".style-settings:hidden"))
                    $(".style-settings").slideDown();
            }

        }

        function addPollOption(){

            var template = Handlebars.compile($("#optionTmpl").html());
            var html = template();

            $('table.poll-options tr:last-child')
                .after(html);

            switch (parseInt($("#weblator_polling_chart_type").val())) {

                case 6:
                case 2:
                case 3:
                case 7:
                    $(".poll-options td.colour-option").css("display", "table-cell");
                break;
                default:
                    $(".poll-options td.colour-option").css("display", "none");

            }

            reorderPollPotions();
            destroyPickers();
            showPickers();

        }

        function reorderPollPotions () {

            $("table.poll-options tr").each(function(i){

                $(this).attr("data-order", i+1);

            });
        }

        function showPickers(){

            $(".fill input").spectrum({
                showAlpha:true,
                preferredFormat: "rgb",
                showInput: true
            });

            $(".fill input").show();

        }

        function destroyPickers(){

            $(".fill input").spectrum("destroy");
        }

        function deletePollOption(e){

            if ($(".poll-option-remove:visible").length > 1)
                $(e).parent().parent().remove();

            reorderPollPotions();
        }

        function saveChart(e){

            var action = ($(e).hasClass("edit") ? "update_poll" : "save_poll");

            //Disable Update Button
            $(e).attr("disabled", "disabled");

            //If a message is visible then slide it up
            if ($("#message").is(':visible')){
                $("#message").slideUp();
            }

            //Show the animated Spinner
            $(".delete-action").css("visibility", "visible");
            $(".delete-action span.spinner").css("display", "inline-block");

            //Get Poll Options
            var options = [];
            $("table.poll-options tr").each(function(){
                var self = this;
                options.push([
                    parseInt($(self).attr("data-order")),
                    $(self).find("input").val(),
                    $(self).find("input").attr("data-id"),
                    $(self).find("input[name='poll_colour']").val()
                ]);
            });

            //Make sure all input that is necessary is complete
            if (!validateInput(options)){
                $(e).removeAttr("disabled");
                $(".delete-action span.spinner").css("display", "none");
                return;
            }


            var styleValues = getStyleValues();
            var data = getPollData(e, action, options, styleValues);

            //Post data to server
            $.post(ajaxurl, data, function(r){

                if (r == 0){

                    //There was an error adding the chart so show error message
                    $("#message").removeClass("updated").addClass("error")
                        .html("<p>There was an error adding your poll please try again</p>");

                    $("#message").slideDown();

                    //Remove disabled attribute from update button
                    $(e).removeAttr("disabled");

                    $(".delete-action span.spinner").css("display", "none");

                } else {

                    if (action == "save_poll")
                        window.location = "?page=polls&action=edit&m=1&edit_poll="+r;
                    else
                        window.location = "?page=polls&action=edit&m=1&edit_poll="+$(e).attr("data-poll-id");

                }

            });
        }

        function validateInput(options){

            if ($("[name='weblator_polling_name']").val() == ""){

                $("#message").removeClass("updated").addClass("error")
                    .html("<p>Please give your chart a name</p>").slideDown();

                $(".delete-action i").css("visibility", "hidden");
                $(self).removeAttr("disabled");
                return false;
            }

            if (options.length == 1 && options[0][1] == ""){

                $("#message").removeClass("updated").addClass("error")
                    .html("<p>Please add some options</p>");

                $(".delete-action i").css("visibility", "hidden");
                $(self).removeAttr("disabled");

                $("#message").slideDown();
                return false;
            }

            for(var i = 0; i < options.length; i++){

                if (options[i][1] == ""){
                    $("#message").removeClass("updated").addClass("error")
                        .html("<p>Please do not leave any options blank</p>");

                    $(".delete-action i").css("visibility", "hidden");
                    $(self).removeAttr("disabled");

                    $("#message").slideDown();
                    return false;

                }

            }


            return true;

        }

        function getStyleValues(){

            var values = [];
            $(".chart-settings input, .chart-settings select").each(function(){

                var obj = {
                    key: $(this).attr("name"),
                    value: $(this).val(),
                    id: $(this).attr("data-style-id")
                };

                values.push(obj);

            });

            return values;
        }

        function getPollData(e, action, options, style){

            return {

                poll_id : $(e).attr("data-poll-id"),
                action : action,
                options : options,
                name : $("[name='weblator_polling_name']").val(),
                chart : $("[name='weblator_polling_chart_type']").val(),
                view_results : $("[name='weblator_polling_view_results']").val(),
                one_vote : $("[name='weblator_polling_one_vote']").val(),
                is_live : $('input[name="poll_status"]:checked').val(),
                legend : $("[name='chart_legend']").val(),
                legend_position : $("[name='weblator_charts_legend_position']").val(),
                legend_font_size : $("[name='weblator_charts_legend_font_size']").val(),
                legend_font_style : $("[name='weblator_charts_chart_legend_font_style']").val(),
                legend_font_colour : $("[name='chart_legend_font_colour']").val(),
                maxWidth : $('input[name="poll_max_width"]').val(),
                minWidth : $('input[name="poll_max_width"]').val(),
                styles : style
            }
        }

        function deletePoll(e) {

            var id = $(e).attr("data-poll-id");

            var data = {
                poll_id : id,
                action: "delete_poll"
            };

            if (confirm('Are you sure you want to delete this poll?')) {
                $.post(ajaxurl, data, function(response){

                    if (response == 1)
                        window.location = "?page=polls";

                });
            }

        }

        function loadChartStyleSettings(){

            var chartTypeID = $("#weblator_polling_chart_type").val();

            switch (parseInt(chartTypeID)) {

                case 6:
                case 2:
                case 3:
                case 7:
                    $("td.colour-option").css("display", "table-cell");
                break;

                default:
                    $("td.colour-option").css("display", "none");


            }

            var pollID = $(".save-button").attr("data-poll-id");

            $.post(ajaxurl, {

                action : "chart_style_options",
                chart_id : chartTypeID,
                poll_id : pollID

            }, function(data){

                var json = $.parseJSON(data);

                for (var i = 0; i < json.length; i++) {


                    var template = Handlebars.compile($("#optionRow").html());
                    var html = html + template(json[i]);
                }

                $(".chart-settings tbody").html(html);
                showPickers();
                setCheckboxes();

            });


        }

        init();

    }

    var c = new Poll();

})(jQuery);
