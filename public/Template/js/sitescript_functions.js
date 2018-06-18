function showComments() {
    var result;
    var all;
    var rate=[];
    var array=[];
    $.ajax({
        type: "POST",
        url: '/php/template/ajax/ajax_page_comments.php',
        dataType: "json",
        data: {domain: d_id},
        async: false,
        success: function (resp) {
            all =resp[0].length+resp[1].length;
            $.each(resp[0], function (index, value) {
                if(index<3) {
                    $('#review .lSide').append('<div class="review" id="'+value['id']+'">');
                    $('#review .lSide #'+value['id']).append('<p class="author">' + value['name'] + '  ' + value['rate'] + '/10');
                    $('#review .lSide #'+value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('#review .lSide #'+value['id']).append('<p>' + value['comment']);
                    rate.push(value['rate']);
                }
                if(index>2&&index<5){
                    $('#review .rSide').append('<div class="review" id="'+value['id']+'">');
                    $('#review .rSide #'+value['id']).append('<p class="author">' + value['name'] + '  ' + value['rate'] + '/10');
                    $('#review .rSide #'+value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('#review .rSide #'+value['id']).append('<p>' + value['comment']);
                    rate.push(value['rate']);
                }
                if(index>=5)
                {
                    $('#review #hidden').append('<div class="review" id="'+value['id']+'">');
                    $('#review #hidden #'+value['id']).append('<p class="author">' + value['name'] + '  ' + value['rate'] + '/10');
                    $('#review #hidden #'+value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('#review #hidden #'+value['id']).append('<p>' + value['comment']);
                    rate.push(value['rate']);
                }
            });
            if(resp[0].length>=6)
            {
                $('#review .padder').append('<a href="#" id="open_hidden">Show all ' + resp[0].length+' reviews');
                result =resp[0].length;
            }
            $('#review').append('<div class="clear">');
            $.each(resp[1], function (index, value) {
                $('#discussion .padder').append('<div class="review" id="anc'+value['id']+'">');
                $('#discussion #anc'+value['id']).append('<p class="author">'+value['name']+'  '+value['rate']+'/10  '+value['e_mail']);
                rate.push(value['rate']);
                $('#discussion #anc'+value['id']).append('<p class="date">'+'Published  '+value['date']);
                $('#discussion #anc'+value['id']).append('<p>'+value['comment']);
                if(index<4) {
                    $('.comments .inner').append('<div class="element" id="' + value['id'] + '">');
                    $('.comments #' + value['id']).append('<p class="author">' + value['name']);
                    $('.comments #' + value['id']).append('<p class="date">' + 'Published  ' + value['date']);
                    $('.comments #' + value['id']).append('<p id="' + value['id'] + '">' + value['comment'].substring(0,40)+'...');
                    $('.comments #' + value['id']+' p[id="' + value['id'] + '"]').append('<a href="#anc'+value['id']+'">more');
                    $('.comments #' + value['id']).append('<div class="rating">');
                    $('.comments #' + value['id'] + ' .rating').append('<div style="width:' + value['rate'] * 20 + '%;">');

                }
            });
            $('.comments .inner').append('<div class="clear">');
            $('.comments .inner').append('<a href="#discussion" class="more">view more');
        }

    });
    array.push(result);
    array.push(rate);
    array.push(all);
    return array;
}
function countRate(rates)
{
    var sum=0;
    var rate=0;
    if(rates.length) {
        $.each(rates, function (index, value) {
            sum += Number(value);
        });
        rate = sum / rates.length;
    }
    return rate;
}
function positiveNegative(rates, all)
{
    var pos=0;
    var neg=0;
    var rateP=0;
    var rateN=0;
    if(rates.length&&all) {
        $.each(rates, function (index, value) {
            if (value > 5) {
                pos++
            };
            if (value < 5) {
                neg++
            };
        });
        rateP = pos * 100 /all;
        rateN = neg*100/all;
    }
    var raiting=[rateP, rateN];
    return raiting;
}
function myGetDate(corr)
{
    corr=corr||0;
    var d = new Date();
    d.setDate(d.getDate()-corr);
    return d.getDate()+'.'+(d.getMonth()+1)
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

