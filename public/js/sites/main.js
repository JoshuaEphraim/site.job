
$(document).ready(function() {
    var array=showComments();
    $("#rate_1").html(parseFloat(array[2].toFixed(1)));
    $("#rate_2").html(Math.round(array[0])+'%');
    $("#rate_3").html(Math.round(array[1])+'%');
    var traffic = getTraffic();
    var tDates = traffic[0];
    traffic = traffic[1];
    var trafficMath=new TrafficMath(traffic);
    traffic=trafficMath.getTraffic();
    rou=trafficMath.getRou();
    yAxe=trafficMath.getYAxe();
    $(function () {

        Highcharts.chart('chart', {
            chart: {
                backgroundColor: 'rgba(255, 255, 255, 0)'
            },
            title: {
                text: 'Date'
            },
            xAxis: {
                lineColor: '#fff',
                lineWidth: 2,
                tickColor: '#fff',
                tickWidth: 2,
                labels: {
                    style: { 'color' : '#fff' }
                },
                categories: [tDates[0].substr(5), tDates[1].substr(5), tDates[2].substr(5), tDates[3].substr(5),
                    tDates[4].substr(5), tDates[5].substr(5)]
            },
            yAxis: {
                gridLineWidth: 0,
                lineColor: '#fff',
                lineWidth: 2,
                tickColor: '#fff',
                tickWidth: 2,
                title: {
                    text: yAxe,
                    style: { 'color' : '#ffd285' }
                },
                labels: {
                    style: { 'color' : '#fff' },
                    formatter: function() {
                        var label = this.axis.defaultLabelFormatter.call(this);
                        label=label/rou;
                        return Math.round(label);
                    }
                },
                minTickInterval: rou,
                categories: [0, 1000, 2000, 3000, 4000, 5000, 6000, 7000]
            },
            exporting: {
                enabled: false
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Line Number 1',
                color: '#ffd285',
                data: [traffic[0],traffic[1] , traffic[2], traffic[3],traffic[4],traffic[5]]
            }]
        });
    });
    $("#update").click(function () {
        if (confirm("Обновить все сайты?")) {
            $("#update").attr("class", "active");
            $.ajax({
                type: "POST",
                url: '/php/ajax/ajax_update.php',
                dataType: "json",
                data: {comment: "comment"},
                success: function (resp) {
                    alert("Сайты успешно обновлены!");
                    $("#update").attr("class", "_");
                }
            });
        }
    });
    $("#clean").click(function () {
        if (confirm("Удалить все комментарии?")) {
            $.ajax({
                type: "POST",
                url: '/php/ajax/ajax_comments_delete.php',
                dataType: "json",
                data: {comment: "comment"},
                success: function (resp) {
                    alert("Все комментарии удалены");
                }
            });
            location.reload();
        }
    });
    $(".delete").click(function () {

        if (confirm("Удалить комментарий?")) {
            var comment=$(this).attr("id");
            $.ajax({
                type: "POST",
                url: '/php/ajax/ajax_comment_delete.php',
                dataType: "json",
                data: {comment: comment},
                success: function (resp) {
                    alert("Комментарий удален");
                }
            });
            location.reload();
        }
    });
    $('body').on('click.smoothscroll', 'a[href^="#"]', function (e) {
        e.preventDefault();

        var target = this.hash,
            $target = $(target);
        if($target.offset()!=undefined) {
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 500, 'swing', function () {
                window.location.hash = target;
            });
        }
    });
    $("#add").click(function () {
        if($("#text").css("display")=="none") {
            $("#text").css("display", "block");
            $("#add").attr("class", "active");
        }
        else
        {
            $("#text").css("display", "none");
            $("#add").attr("class", "_");
        }
    });
    $('#header .lSide a.trigger').on('click', function(){
        $('#header .menu').slideToggle('fast');
        return false;
    });


});

