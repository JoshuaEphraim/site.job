function showDomains() {
    var i=0;
    $.ajax({
        type: "POST",
        url: '/php/featured/ajax/ajax_directory_domains.php',
        dataType: "json",
        async: false,
        success: function (resp) {
            $.each(resp[0], function (index, value) {
                ++i;
                rate=(value['comments']!=0)?parseFloat((value['sumR']/value['comments']).toFixed(1)):'-';
                reverse=(value['reverse_count'])?value['reverse_count']:'-';
                $('#second .rate tbody').append('<tr id="'+i+'" class="domains">');
                $('#second .rate #'+i).append('<th scope="row">'+i);
                $('#second .rate #'+i).append('<td>');
                $('#second .rate #'+i+' td:last-child').append('<a href="/'+value['domain']+'.html">' + value['domain']);
                $('#second .rate #'+i).append('<td>' + rate);
                $('#second .rate #'+i).append('<td>' + value['comments']);
                $('#second .rate #'+i).append('<td>' + reverse);

            });
            i=0;
            $.each(resp[1], function (index, value) {
                ++i;
                rate=(value['comments']!=0)?parseFloat((value['sumR']/value['comments']).toFixed(1)):'-';
                reverse=(value['reverse_count'])?value['reverse_count']:'-';
                $('#second .comment tbody').append('<tr id="'+i+'" class="domains">');
                $('#second .comment #'+i).append('<th scope="row">'+i);
                $('#second .comment #'+i).append('<td>');
                $('#second .comment #'+i+' td:last-child').append('<a href="/'+value['domain']+'.html">' + value['domain']);
                $('#second .comment #'+i).append('<td>' + value['comments']);
                $('#second .comment #'+i).append('<td>' + rate);
                $('#second .comment #'+i).append('<td>' + reverse);

            });
        }

    });

}