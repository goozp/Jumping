$(function() {
    var nextDataNumber = 5;
    var ulNode = $('ul.timeline');
    function initLiNodes() {
        var liNodes = ulNode.find('li'), count = liNodes.length, i, liNode, leftCount = nextDataNumber * 20;
        for(i=0; i<count; i++) {
            liNode = $(liNodes.get(i));
            if(i % 2 !== 0) {
                liNode.addClass('alt');
            } else {
                liNode.removeClass('alt');
            }
        }
    }

    $('#fetchNextData').click(function() {
        var $this = $(this);
        $this.addClass('disabled').text('......');
        $.get('./version_data_' + nextDataNumber +'.txt', function(data) {
            ulNode.append(data);
            $this.removeClass('disabled').text('后二十条数据');
            nextDataNumber--;
            if(nextDataNumber === 0) {
                $this.hide();
            }
            initLiNodes();
        });
    });
    initLiNodes();
});
