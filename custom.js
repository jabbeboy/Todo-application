$(document).ready(function() {



    // Popover
    $("[data-toggle=popover]").each(function(i, obj) {
        $(this).popover({
            html: true,
            content: function() {
                var id = $(this).attr('id')
                return $('#popover-content-' + id).html();
            }
        });
    });

    // Datepicker
    $("#datepicker").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        startDate: new Date()
    }).datepicker('update', new Date('yyyy-mm-dd'));

    // End date from value of datetimepicker for edit.
    var date = new Date($('#end_date').val());

   ///var endStartDate = date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate();

    // Datepicker edit
    $("#datepicker_edit").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        startDate: new Date()
    }).datepicker('update', new Date('yyyy-mm-dd'));

});
