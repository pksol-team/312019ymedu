var Poll = function(id) {

    var poll = this;

    this.options = {

        pollID : null,
        oneVote : null,
        pollData : null,
        showResults : null,
        chart : null,
        chartTotals : null

    };


    function init(id){

        poll.options.pollID = id;

        firstLoad();

        //Set up events
        jQuery(document).on('click', '[data-poll-id="'+ id +'"] .weblator-poll-submit', function () {
            submitVote();
        });

        jQuery(document).on('click', '[data-poll-id="'+ id +'"] .weblator-view-poll', function (e) {
            e.preventDefault();
            loadPoll();
        });

        jQuery(document).on('click', '[data-poll-id="'+ id +'"] .weblator-hide-poll', function (e) {
            e.preventDefault();
            hidePoll();
        });




    }

    function firstLoad(){

        //Check if a user is allowed only one vote and hasn't already voted if they are allowed only one vote
        jQuery.post(ajaxurl, {action:"has_voted", poll_id:poll.options.pollID}, function(response){

            //slide loading el up
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-poll-loading").slideUp();

            if (parseInt(response, 10) === 1){

                //User has voted and can't vote
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .alert-warning").slideDown();
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .vote-button").attr("disabled", "disabled");
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-view-poll").css("display", "block");
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] input[type=radio]").attr("disabled", "disabled");

                poll.options.oneVote = 0;

            }

            jQuery.post(ajaxurl, {action:"result_action", poll_id:poll.options.pollID}, function(response){

                poll.options.showResults = parseInt(response, 10);

                if (poll.options.showResults === 2){
                    hidePoll();
                    loadPoll();
                }
                else if(poll.options.showResults === 3)
                    jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-view-poll").css("display", "block");

                else if (poll.options.showResults === 4)
                    jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-view-poll, [data-poll-id='"+ poll.options.pollID +"'] .weblator-hide-poll").remove();


            });

        });

    }

    function loadPoll(){

        jQuery.post(ajaxurl, {action:"chart_data", poll_id:poll.options.pollID}, function(response){

            var json = jQuery.parseJSON(response), totalVotes = 0;;

            //Make totals integers
            for (var i=0; i < json.totals.length; i++)
                json.totals[i] = parseInt(json.totals[i]);


            if (json.chart_type == 1 || json.chart_type == 4 || json.chart_type == 5){

                var data = {

                    labels : json.labels,
                    datasets : [

                        {
                            fillColor : json.styles[0].fillColor,
                            strokeColor : json.styles[0].strokeColor,
                            pointColor : json.styles[0].pointColor,
                            pointStrokeColor : json.styles[0].pointStrokeColor,
                            data : json.totals

                        }
                    ]
                }

                for(var i = 0; i < data.datasets[0].data.length; i++)
                    totalVotes += data.datasets[0].data[i];

            }else {

                var data = [];

                for (var i = 0; i < json.totals.length; i++){

                    totalVotes += parseInt(json.totals[i]);

                    data.push({
                        value: parseInt(json.totals[i]),
                        color : json.option_colours[i],
                        label : json.labels[i]
                    });
                }


            }

            if (totalVotes > 0){

                poll.options.chartTotals = json.totals;
                var override = overrideOptions();

                json.options = jQuery.extend({}, override, json.options);



                if (parseInt(json.maxWidth) == 0){

                    //if (parseInt(json.chartType != 7)){
                    var width = jQuery("[data-poll-id='"+ poll.options.pollID +"'] #weblator-chart-" + poll.options.pollID).parent().width();

                    jQuery("[data-poll-id='"+ poll.options.pollID +"'] #weblator-chart-" + poll.options.pollID).attr({width: width});
                    jQuery("[data-poll-id='"+ poll.options.pollID +"'] #weblator-chart-" + poll.options.pollID).attr({height: parseInt(width) / 2});

                    if (parseInt(json.chartType) == 5 || parseInt(json.chartType)){
                        jQuery("[data-poll-id='"+ poll.options.pollID +"'] #weblator-chart-" + poll.options.pollID).removeAttr("height");
                    }

                }

                var ctx = document.getElementById("weblator-chart-" + poll.options.pollID).getContext("2d");

                jQuery("[data-poll-id='"+ poll.options.pollID +"'] #weblator-chart-" + poll.options.pollID).slideDown(function(){


                    switch(parseInt(json.chart_type)){

                        case 1:
                            poll.options.chart = new Chart(ctx).Bar(data, json.options);
                            break;

                        case 2:
                            poll.options.chart = new Chart(ctx).Pie(data,json.options);
                            if (parseInt(json.showLegend))
                                legend(document.getElementById("legend-" + poll.options.pollID), data);
                            break;

                        case 3:
                            poll.options.chart = new Chart(ctx).Doughnut(data,json.options);
                            if (parseInt(json.showLegend))
                                legend(document.getElementById("legend-" + poll.options.pollID), data);
                            break;

                        case 4:
                            poll.options.chart = new Chart(ctx).Line(data,json.options);
                            break;

                        case 5:
                            poll.options.chart = new Chart(ctx).Radar(data,json.options);

                            break;

                        case 6:
                            poll.options.chart = new Chart(ctx).PolarArea(data,json.options);
                            if (parseInt(json.showLegend))
                                legend(document.getElementById("legend-" + poll.options.pollID), data);
                            break;

                        case 7:
                            createBootstrapChart(data, json.options, json.maxWidth);
                            break;
                    }

                    //Move Legend
                    $leg = jQuery("[data-poll-id='"+ poll.options.pollID +"'] .legend");
                    if ($leg.hasClass("tl") || $leg.hasClass("tm") || $leg.hasClass("tr")){

                        $leg.insertBefore(jQuery("[data-poll-id='"+ poll.options.pollID +"'] canvas"));
                    }


                });
            } else {

                hidePoll();
            }

        });

        if (jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-view-poll:visible")){
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-view-poll").css("display", "none");
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-hide-poll").css("display", "block");
        }

    }

    function submitVote(){

        if (!jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-poll-vote ul li input[type='radio']:checked").length){
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .alert-danger").slideDown();

            setTimeout(function(){
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .alert-danger").slideUp();
            }, 3000);

            return
        }


        var option = jQuery("[data-poll-id='"+ poll.options.pollID +"'] input[name='weblator-chart-options']:checked").val();

        jQuery.post(ajaxurl, {action:"save_vote", option:option, poll_id:poll.options.pollID}, function(response){

            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .alert-success").slideDown();
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .vote-button").attr("disabled", "disabled");
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .vote-button .vote-spin").css("display", "inline-block");

            if (poll.options.showResults == 1){
                hidePoll();
                loadPoll();
            }

            if (poll.options.showResults != 4){
                if (jQuery("[data-poll-id='"+ poll.options.pollID +"'] canvas:visible")){
                    hidePoll();
                    loadPoll();
                }
            }

            if (!poll.options.oneVote){
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .vote-button").removeAttr("disabled");
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .vote-button .vote-spin").css("display", "none");
            }else {
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] input[type=radio]").attr("disabled", "disabled");
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .vote-button .vote-spin").css("display", "inline-block");
            }

            setTimeout(function(){
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .alert-success").slideUp();
            }, 2000);
        });

    }

    function hidePoll(){


        jQuery("[data-poll-id='"+ poll.options.pollID +"'] #weblator-chart-" + poll.options.pollID).slideUp();
        jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-view-poll").css("display", "block");
        jQuery("[data-poll-id='"+ poll.options.pollID +"'] .weblator-hide-poll").css("display", "none");

        var canvasID = "weblator-chart-" + poll.options.pollID;
        var canvasWidth = jQuery("#" + canvasID).width();
        var canvasHeight = jQuery("#" + canvasID).height();



        jQuery("#" + canvasID).remove();

        var canvas = jQuery('<canvas />').attr({
            id: canvasID,
            width:canvasWidth,
            height: canvasHeight
        });

        canvas.css("maxWidth", canvasWidth + "px");
        canvas.css("width", canvasWidth + "px");
        canvas.css("height", canvasHeight + "px");

        jQuery("[data-poll-id='"+ poll.options.pollID +"'] .panel").after(canvas);

        poll.options.chart = null;

        if (jQuery("[data-poll-id='"+ poll.options.pollID +"'] .bs-chart-container").length)
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .bs-chart-container").slideUp(function(){
                jQuery("[data-poll-id='"+ poll.options.pollID +"'] .bs-chart-container").remove();
            });

        if (jQuery("[data-poll-id='"+ poll.options.pollID +"'] .legend ").length){
            jQuery("[data-poll-id='"+ poll.options.pollID +"'] .legend ").empty();
        }
    }

    function overrideOptions(){

        var min = Infinity, max = -Infinity, x;
        for( x in poll.options.chartTotals) {
            if( poll.options.chartTotals[x] < min) min = poll.options.chartTotals[x];
            if( poll.options.chartTotals[x] > max) max = poll.options.chartTotals[x];
        }

        var scaleSteps = 20;
        var scaleStepWidth = 1;
        var scaleStart = 0;

        if (max < 20){
            scaleSteps = max;

        }else {

            scaleStepWidth = Math.ceil(max/scaleSteps);
        }

        if (poll.options.chartType == 5 || poll.options.chartType == 6){
            scaleSteps = poll.options.chartOptionsCount;
            scaleStart = 0;
            scaleStepWidth = Math.ceil(max/scaleSteps);
        }

        return options = {

            scaleOverride : true,
            scaleSteps : scaleSteps,
            scaleStepWidth : scaleStepWidth,
            scaleStartValue : scaleStart
        };

    }

    function createBootstrapChart(data, override, maxWidth){



        jQuery("#weblator-chart-" + poll.options.pollID).remove();

        var total = 0;
        for(var i=0; i < data.length; i++)
            total = total + parseInt(data[i].value);



        var bsChartContainer = jQuery('<div/>')
            .attr("class", "bs-chart-container")
            .css("display", "none")
            .css("max-width", maxWidth + "px");

        for(var i = 0; i < data.length; i++){

            var label = jQuery("<strong/>").html(data[i].label);

            var progressContainer = jQuery('<div/>').attr("class", "progress");

            var p = (data[i].value / total) * 100



            var progressBar = jQuery('<div/>')
                .attr("class", "progress-bar")
                .attr("role", "progressbar")
                .attr("aria-valuenow", p)
                .attr("aria-valuemin", 0)
                .css({
                    backgroundColor : data[i].color
                });

            if (override.bsBarStriped)
                progressContainer.addClass("progress-striped");

            var span = jQuery('<span/>')
                .attr("class", "")
                .html(data[i].value);

            if (p > 0)
                progressBar.append(span);

            progressContainer.append(progressBar);
            bsChartContainer.append(label);
            bsChartContainer.append(progressContainer);

        }

        jQuery("[data-poll-id='"+ poll.options.pollID +"'] .panel").after(bsChartContainer);

        bsChartContainer.slideDown();

        jQuery(".progress-bar").each(function(){

            var value = jQuery(this).attr("aria-valuenow");

            jQuery(this).animate({
                width:value + "%"
            }, 1000);

        });
    }

    init(id);
};
