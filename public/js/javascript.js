
// search
function handleCLickChechbox(event, ID) {
    var status = event.target.checked ? 1 : 0;
    $.ajax({
        type: 'PUT',
        url: '/update',
        dataType: "json",
        headers: {'X-CSRF-TOKEN': $('#csrf_token').attr('content')},
        data: {
            ID,
            status,
        },
    });
}


$(document).ready(function() {
    $('#search').on('keyup', function() {
        let value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/todo-search',
            dataType: "json",
            data: {
                'search': value,
                'ID': value,
            },
            headers: {'X-CSRF-TOKEN': $('#csrf_token').attr('content')},
            success: function(data) {
                $('tbody').html(data.output);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
});

$(document).ready(function() {
    $('#search1').on('keyup', function() {
        let value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/todos/todo-search1',
            dataType: "json",
            data: {
                'search': value,
                'ID': value,
            },
            headers: {'X-CSRF-TOKEN': $('#csrf_token').attr('content')},
            success: function(data) {
                $('tbody').html(data.output);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
});

$(document).ready(function() {
    $('#search2').on('keyup', function() {
        let value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/todos/todo-search2',
            dataType: "json",
            data: {
                'search': value,
                'ID': value,
            },
            headers: {'X-CSRF-TOKEN': $('#csrf_token').attr('content')},
            success: function(data) {
                $('tbody').html(data.output);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });
});


// drag and drop



$(document).click(function () {
    $('#tableTodo #sortThis').sortable({
        update: function (event, ui) {
            saveNewPositions();
        },
        start: function(event, ui) {
            ui.item.startPos = ui.item.index();
        },
        stop: function(event, ui) {
            var startPos = ui.item.startPos;
            var stopPos = ui.item.index();
            // console.log("start pos: "+ startPos);
            // console.log("stop pos: " + stopPos);
        }
    });
    function saveNewPositions() {
        var order = [];
        var display = [];
        $('tr.row1').each(function(index,element) {
            display.push({
                displayorder: $(this).attr('data-display'),
            });
            order.push({
                id: $(this).attr('data-id'),
                position: index+1
            });
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('#csrf_token').attr('content')},
            url: "/post-sortable",
            data: {
                order:order,
            },
            success: function(response) {
                if (response.status == "success") {
                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });
    }
});

$('th').click(function(){
    var table = $(this).parents('table').eq(0)
    var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
    this.asc = !this.asc
    if (!this.asc){rows = rows.reverse()}
    for (var i = 0; i < rows.length; i++){table.append(rows[i])}
})
function comparer(index) {
    return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index)
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
    }
}
function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

// pagination
/*

$(document).ready(function(){

    $(document).on('click', '.page-link', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page)
    {
        var _token = $("input[name=_token]").val();
        $.ajax({
            url:"todos/fetch",
            method:"POST",
            headers: {'X-CSRF-TOKEN': $('#csrf_token').attr('content')},
            data:{
                page:page,
            },
            success:function(data)
            {
                $('#table_data').html(data);
            }
        });
    }

});
*/
