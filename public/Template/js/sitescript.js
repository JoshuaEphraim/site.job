// JavaScript Document
$(document).ready(function(){
    $.each(ALEXA.viewsHelpers.map.areas, function (index, value) {
        $('.locations').append('<li><a href="#">'+value.title);
    });
    $.ajax({
        type:"POST",
        url: '/php/template/ajax/ajax_rate.php',
        data: {domain: d_id},
        async: false,
        success: function( resp ) {
            $('#rateit-range-2 > div.rateit-selected').width(resp*30);
        }
    });
    var array=showComments();
    var reviews=array[0];
    var rates=array[1];
    var all=array[2];
    $("#rate_1").html(parseFloat(countRate(rates).toFixed(1)));
    var rate = positiveNegative(rates, all);
    $("#rate_2").html(Math.round(rate[0])+'%');
    $("#rate_3").html(Math.round(rate[1])+'%');
	$('#header .lSide a.trigger').on('click', function(){
		$('#header .menu').slideToggle('fast');
		return false;
	});


    $("#comment_0").on("submit", function(){
        var comment = $("#comment_0 [placeholder='Your Comment']").val();
        var e_mail = $("#comment_0 [placeholder='Your E-Mail']").val();
        var name = $("#comment_0 [placeholder='Your Name']").val();
        var value = $("#comment_0 #rateit-range-4").attr('aria-valuenow');
        $.ajax({
            type:"POST",
            url: '/php/template/ajax/ajax_comment.php',
            data: {comment: comment, name: name, domain: d_id, type: 0, e_mail: e_mail, value: value},
            success: function( resp ) {
                alert(resp);
            }
        });

        location.reload();
        return false;
    });

    $("#comment_1").on("submit", function(){
        var comment = $("#comment_1 [placeholder='Your Comment']").val();
        var e_mail = $("#comment_1 [placeholder='Your E-Mail']").val();
        var name = $("#comment_1 [placeholder='Your Name']").val();
        var value = $("#comment_1 #rateit-range-3").attr('aria-valuenow');
        $.ajax({
            type:"POST",
            url: '/php/template/ajax/ajax_comment.php',
            data: {comment: comment, name: name, domain: d_id, type: 1, e_mail: e_mail, value: value},
            success: function( resp ) {
                alert(resp);
            }
        });

        location.reload();
        return false;
    });
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
                text: 'Visitors per month'
            },
            xAxis: {
                lineColor: '#fff',
                lineWidth: 2,
                tickColor: '#fff',
                tickWidth: 2,
                labels: {
                    style: { 'color' : '#fff' }
                },
                categories: [tDates[0].substr(5), tDates[1].substr(5), tDates[2].substr(5), tDates[3].substr(5), tDates[4].substr(5), tDates[5].substr(5)]
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


    $('.rSide .rateit-selected').append('<iframe name="frame" width=100% height=100% style="position:absolute;z-index:-1">');
    frame.onresize = function(){
        var firstDiv = $('.rSide .rateit-selected').width();
        var secondDiv = $('.rSide .rateit-hover').width();
        if(secondDiv==firstDiv&&firstDiv!=0) {
            var value = $(".rSide #rateit-range-2").attr('aria-valuenow');
            $.ajax({
                type:"POST",
                url: '/php/template/ajax/ajax_rate.php',
                data: {value: value, domain: d_id}
            });
        }
    }
     $('#leave_review').click(function(){
         $("#mask").show();
         $("#leave").show(300);
     });
    $('#leave_comment').click(function(){
        $("#mask").hide();
        $("#leave").hide(300);
    });



    $('body').on('click', '#open_hidden', function (){
        if($("#hidden").css("display")=="none") {
            $("#open_hidden").html("Hide");
            $("#hidden").show(300);
        }
        else{

            $("#open_hidden").html('Show all ' + reviews+' reviews');
            $("#hidden").hide(300);
        }
    });
    /*

     $('#main').click(function(){
     $("#main1").css("display", "block");
     $("#1").attr("class", "active");
     $("#main2").css("display", "none");
     $("#2").attr("class", "_");
     $("#main3").css("display", "none");
     $("#3").attr("class", "_");
     });
     $('#whois').click(function(){
     $("#main3").css("display", "block");
     $("#3").attr("class", "active");
     $("#main2").css("display", "none");
     $("#2").attr("class", "_");
     $("#main1").css("display", "none");
     $("#1").attr("class", "_");
     });
     */
    $('#rateit-range-2').change(function(){
        alert('Элемент foo был изменен.');
    });
    $('#header .lSide a.trigger').on('click', function(){
        $('#header .menu').slideToggle('fast');
        return false;
    });


});
