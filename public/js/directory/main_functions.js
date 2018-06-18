function makeOptions(){
    $.ajax({
        type: "POST",
        url: '/php/directory/ajax/ajax_directory_selector.php',
        dataType: "json",
        async: false,
        success: function (resp) {
            if(thisCountry=='All') {
                $('.config .countries').append('<a class="list-group-item active">All');
            }
            else
            {
                $('.config .countries').append('<a href="/index.php/directory/All/' + thisRate + '" class="list-group-item">All');
            }
            if(thisRate=='All')
            {
                $('.search .rate').append('<a class="list-group-item active">All');
            }
            else {
                $('.search .rate').append('<a href="/index.php/directory/' + encodeURIComponent(thisCountry) + '/All" class="list-group-item">All');
            }
            $.each(resp[0], function (index, value) {
                if(value['country']!=null)
                {
                    val=value['country'];
                    v= val.replace("\"", "");
                    v= v.replace("\"", "");
                    if(thisCountry==v) {
                        $('.config .countries').append('<a class="list-group-item active">' + v);
                    }
                    else
                    {
                        $('.config .countries').append('<a href="/index.php/directory/' + encodeURIComponent(v) + '/'+thisRate+'" class="list-group-item">' + v);

                    }
                }
            });
            $.each(resp[1], function (index, value) {
                if(value['rate']!='null')
                {
                    val=value['rate'];
                    if(thisRate==val) {
                        $('.search .rate').append('<a class="list-group-item active">' + val);
                    }
                    else
                    {
                        $('.search .rate').append('<a href="/index.php/directory/' + encodeURIComponent(thisCountry) + '/' + val + '" class="list-group-item">' + val);
                    }
                }
            });
        }

    });
}
function showDomains(page, country, rates) {
    page=page||1;
    country=country||'All';
    rates=rates||'All';
    var i=0;
    $.ajax({
        type: "POST",
        url: '/php/directory/ajax/ajax_directory_domains.php',
        dataType: "json",
        data: {page: page,country:country,rate:rates},
        async: false,
        success: function (resp) {
            $.each(resp[0], function (index, value) {
                ++i;
                rate=(value['comments']!=0)?parseFloat((value['sumR']/value['comments']).toFixed(1)):'-';
                reverse=(value['reverse_count'])?value['reverse_count']:'-';
                $('#second .table tbody').append('<tr id="'+i+'" class="domains">');
                $('#second .table #'+i).append('<th scope="row">'+i);
                $('#second .table #'+i).append('<td>');
                $('#second .table #'+i+' td:last-child').append('<a href="/'+value['domain']+'.html">' + value['domain']);
                $('#second .table #'+i).append('<td>' + value['comments']);
                $('#second .table #'+i).append('<td>' + rate);
                $('#second .table #'+i).append('<td>' + reverse);

            });
            if(resp[1]['rows_max']>10)
            {
                $('#second .col_table .p').append('<ul class="pagination">');
                var r=1;
                while(r<=Math.ceil(resp[1]['rows_max']/10))
                {
                    if(r!=thisPage)
                    {
                        $('#second .pagination').append('<li id="pag'+r+'">');
                        $('#second .pagination #pag'+r).append('<a href="/index.php/directory/' + encodeURIComponent(thisCountry) + '/'+thisRate+'/'+r+'" class="pag">'+r);
                    }
                    else
                    {
                        $('#second .pagination').append('<li class="active" id="pag'+r+'">');
                        $('#second .pagination #pag'+r).append('<a >'+r);
                    }
                    r++
                }
            }
        }

    });

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


