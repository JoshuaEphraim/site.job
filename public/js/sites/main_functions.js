function showComments() {
    var rate;
    var positive;
    var negative;
    var array=[];
    $.ajax({
        type: "POST",
        url: '/php/sites/ajax/ajax_sites_comments.php',
        dataType: "json",
        async: false,
        success: function (resp) {
            if(resp[2]['count']>0) {
                rate = resp[2]['rate'] / resp[2]['count'];
                positive = resp[2]['pos'] * 100 / resp[2]['count'];
                negative = resp[2]['neg'] * 100 / resp[2]['count'];
            }
            $.each(resp[0], function (index, value) {
                if(index<3) {
                    $('#review .reviewL').append('<div class="review" id="'+value['id']+'">');
                    $('#review .reviewL #'+value['id']).append('<p class="author">');
                    $('#review .reviewL #'+value['id']+' .author').append('<a href="/'+value['domain']+'.html">' + value['name'] + '  ' + value['rate'] + '/10 for '+value['domain']);
                    $('#review .reviewL #'+value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('#review .reviewL #'+value['id']).append('<p>' + value['comment']);

                }
                if(index>2&&index<=5){
                    $('#review .reviewR').append('<div class="review" id="'+value['id']+'">');
                    $('#review .reviewR #'+value['id']).append('<p class="author">');
                    $('#review .reviewR #'+value['id']+' .author').append('<a href="/'+value['domain']+'.html">' + value['name'] + '  ' + value['rate'] + '/10 for '+value['domain']);
                    $('#review .reviewR #'+value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('#review .reviewR #'+value['id']).append('<p>' + value['comment']);

                }
            });
            $.each(resp[1], function (index, value) {
                if(index<10) {
                    $('#discussion .padder').append('<div class="review" id="anc' + value['id'] + '">');
                    $('#discussion #anc' + value['id']).append('<p class="author">');
                    $('#discussion #anc' + value['id']+' .author').append('<a href="/'+value['domain']+'.html">' + value['name'] + '  ' + value['rate'] + '/10  ' + value['e_mail'] + ' for ' + value['domain']);
                    $('#discussion #anc' + value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('#discussion #anc' + value['id']).append('<p>' + value['comment']);

                }
                if(index<4) {
                    $('.comments .inner').append('<div class="element" id="' + value['id'] + '">');
                    $('.comments #' + value['id']).append('<p class="author">');
                    $('.comments #' + value['id']+' .author').append('<a href="/'+value['domain']+'.html">' + value['name']+' for '+value['domain']);
                    $('.comments #' + value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('.comments #' + value['id']).append('<p id="' + value['id'] + '">' + value['comment'].substring(0,40)+'...');

                    $('.comments #' + value['id']).append('<div class="rating">');
                    $('.comments #' + value['id'] + ' .rating').append('<div style="width:' + value['rate'] * 20 + '%;">');

                }
            });
            $('.comments .inner').append('<div class="clear">');
        }

    });
    array.push(positive,negative,rate);
    return array;
}
function getTraffic()
{
    var traffic;
    $.ajax({
        type:"POST",
        url: '/php/sites/ajax/ajax_main_traffic.php',
        dataType: "json",
        async: false,
        success: function( resp ) {
            traffic=resp;
        }
    });
    return traffic;
}
class TrafficMath {
    constructor(traffic) {
        this.traffic = traffic;
        var tr=[];
        $.each(traffic, function (index, value) {
            if(value){tr.push(value);}

        });
        var tMin=Math.min.apply(null, tr);
        tMin=String(tMin);
        var leng=tMin.length;
        this.leng =Math.floor(leng/3);
        this.rou=Math.pow(1000,this.leng);
    }

    getTraffic() {
        var traffic=[];
        var rou=this.rou;
        $.each(this.traffic, function (index, value) {
            (value)?traffic[index]=Math.round(value/rou)*rou:traffic[index]=NaN;

        });
        return traffic;
    }
    getRou(){
        return this.rou;
    }
    getYAxe(){
        var yAxe;

        switch (this.leng) {
            case 1:
                yAxe = 'thousands of visits';
                break;
            case 2:
                yAxe = 'millions of visits';
                break;
            case 3:
                yAxe = 'billions of visits';
                break;
            default:
                yAxe = 'Visits';
        }
        return yAxe;
    }
}

