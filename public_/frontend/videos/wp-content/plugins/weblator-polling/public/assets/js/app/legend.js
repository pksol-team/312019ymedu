function legend(parent, data) {

    //parent.className = 'legend';
    var datas = data.hasOwnProperty('datasets') ? data.datasets : data;


    datas.forEach(function(d) {

        var span = jQuery("<div></div>")
            .html(d.label)
            .addClass("weblator-label")
            .css({
                fontSize : jQuery(parent).attr("data-font-size") + "px"
            });

        var title = jQuery("<li></li>")
            .attr("class", "title")
            .append(span);

        var box = jQuery("<div></div>")
            .addClass("box")
            .css({
                backgroundColor : d.color,

            });

        if (jQuery(parent).hasClass("tr"))
            title.append(box);
        else
            title.prepend(box);

        jQuery(parent).append(title);


    });
}